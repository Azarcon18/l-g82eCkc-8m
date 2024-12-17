<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success Modal</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
        }
        .success-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        .success-icon {
            font-size: 72px;
            color: #2ecc71;
            margin-bottom: 20px;
        }
        .success-title {
            color: #2ecc71;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .success-message {
            color: #7f8c8d;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .close-button {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .close-button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="success-wrapper">
        <div class="success-icon">✓</div>
        <h2 class="success-title">Success!</h2>
        <p class="success-message">Your request has been successfully sent. Please wait for confirmation once the management reviews it. Thank you and God Bless :)</p>
        <button class="close-button" type="button" data-dismiss="modal">Close</button>
    </div>
</body>
</html>