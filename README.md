AWS Image-Based Analysis Web-App

This project is a web-based application that allows users to upload images for analysis using AWS services like AWS Lambda and AWS Rekognition.

🚀 Features

Image Upload and Analysis

AWS Lambda for Backend Processing

PHP Frontend for User Interaction

AWS Rekognition for Image Analysis



---

🛠 Project Structure

Aws-Image-Analysis-App
├── aws
│   ├── lambda_function.py          # AWS Lambda function for image analysis
│   ├── setup_instructions.txt      # Setup guide for AWS services
├── php-app
│   ├── index.php                   # Homepage for image upload
│   ├── upload.php                  # Handles image uploads
│   ├── composer.json               # PHP dependencies (AWS SDK)
├── docs                            # Documentation and reports
├── .gitignore                      # Ignore unnecessary files
├── README.md                       # Project description
└── LICENSE                         # License information


---

⚙ Installation

1. Clone the repository:

git clone https://github.com/YourUsername/Aws-Image-Analysis-App.git
cd Aws-Image-Analysis-App


2. Install PHP dependencies:

cd php-app
composer install


3. Deploy AWS Lambda function using AWS CLI:

aws lambda create-function --function-name ImageAnalysisFunction \
  --zip-file fileb://lambda_function.zip \
  --handler lambda_function.lambda_handler \
  --runtime python3.x \
  --role arn:aws:iam::YOUR_ACCOUNT_ID:role/YOUR_LAMBDA_ROLE




---

📧 Contact

For questions or contributions, reach out to srikanthberla@gmail.com.
