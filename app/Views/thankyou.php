<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-6r6NfNr2/cdBMvaA4+Izr3nK2U+ohe2O4eDdaL/Wn7E1e17VEiV+09sm/d+OkTzF" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .thank-you-container {
            margin-top: 50px;
            text-align: center;
        }
        .thank-you-icon {
            font-size: 5rem;
            color: #28a745;
        }
        .thank-you-heading {
            margin-top: 20px;
            font-size: 2rem;
            color: #333;
        }
        .thank-you-text {
            margin-top: 10px;
            font-size: 1.2rem;
            color: #666;
        }
        .back-to-home-btn {
            margin-top: 30px;
            padding: 10px 20px;
            font-size: 1.2rem;
        }
        .token-container {
            margin-top: 30px;
        }
        .token-label {
            font-size: 1.2rem;
            color: #666;
        }
        .token-value {
            font-size: 1.5rem;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 thank-you-container">
                <i class="bi bi-check-circle-fill thank-you-icon"></i>
                <h1 class="thank-you-heading">Thank You!</h1>
                <p class="thank-you-text">Your submission has been received successfully.</p>
                <div class="token-container">
                    <span class="token-label">Your Token Number:</span>
                    <span class="token-value"><?= session()->get('Token') ?></span>
                </div>
                <a href="<?= base_url('/request-status')?>" class="btn btn-primary back-to-home-btn">Back to know your application status</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-vAqtuLf/02z3U5Nd8gU+ep8vCxV6vDlDQQi8uN0znDwRy1UQxytscgLfRPQmVceB" crossorigin="anonymous"></script>
</body>
</html>
