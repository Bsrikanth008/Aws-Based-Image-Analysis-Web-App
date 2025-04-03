<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Lambda\LambdaClient;

$bucket = 'my-image-analysis-bucket';  // Your S3 bucket name
$key = basename($_FILES['image']['name']);  // Get the uploaded file's name
$tmpFilePath = $_FILES['image']['tmp_name'];  // Temporary file path

// Upload the image to S3
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-west-2',  // Your AWS region
]);

try {
    $result = $s3->putObject([
        'Bucket' => $bucket,
        'Key'    => $key,
        'SourceFile' => $tmpFilePath,
        'ACL'    => 'public-read',  // Make the file publicly accessible
    ]);

    echo "<p>Image uploaded successfully: <a href='{$result['ObjectURL']}'>{$result['ObjectURL']}</a></p>";

    // Trigger the Lambda function
    $lambda = new LambdaClient([
        'version' => 'latest',
        'region'  => 'us-west-2',
    ]);

    $lambdaResult = $lambda->invoke([
        'FunctionName' => 'ImageLabelingFunction',
        'Payload' => json_encode([
            'Records' => [
                [
                    's3' => [
                        'bucket' => ['name' => $bucket],
                        'object' => ['key' => $key],
                    ]
                ]
            ]
        ]),
    ]);

    $labels = json_decode($lambdaResult->get('Payload'), true);

    echo "<h2>Detected Labels:</h2>";
    echo "<ul>";
    foreach ($labels['body'] as $label) {
        echo "<li>{$label}</li>";
    }
    echo "</ul>";

} catch (Exception $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>

