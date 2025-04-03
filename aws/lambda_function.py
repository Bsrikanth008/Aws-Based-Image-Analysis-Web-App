import boto3

def lambda_handler(event, context):
    client = boto3.client('rekognition')

    bucket = event['Records'][0]['s3']['bucket']['name']
    key = event['Records'][0]['s3']['object']['key']

    response = client.detect_labels(Image={'S3Object': {'Bucket': bucket, 'Name': key}})

    labels = [label['Name'] for label in response['Labels']]

    return {
        'statusCode': 200,
        'body': labels
    }

