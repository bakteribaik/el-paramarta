<?php 
    include '../connection.php';
    include '../validation/session.php';
    include '../validation/checkSession.php';
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Selamat Datang  Guru <?php echo $_SESSION['name'];?></h1>
    <a href="../validation/logout">Logout</a>
</body>
</html>