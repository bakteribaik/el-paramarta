<?php
    header('refresh:2;url=pages/dashboard');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .loader {
            margin: 450px auto;
            border: 8px solid #f3f3f3; /* Light grey */
            border-top: 8px solid #3498db; /* Blue */
            border-radius: 100%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
            }

            @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
            }
    </style>
    <title>Loading..</title>
</head>
<body>
<div class="loader"></div>
</body>
</html>