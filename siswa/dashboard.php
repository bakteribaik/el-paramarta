<?php 
    include '../connection.php';
    include '../validation/session.php';
    include '../validation/checkSession.php';
    if ($_SESSION['roles'] == '1') {
        header('location:../guru/dashboard');
    }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dash_siswa.css">
    <title>Elearning SMK Paramarta | Dashboard</title>
</head>
<body>
    <div class="sidebar">
            <div class="sidebar-title">
                Elearning
            </div>
            <div class="sidebar-subtitle">
                SMK Paramarta
            </div>
            <a href="" class="active"> Dashboard</a>
        
        <a href="../validation/logout">Logout</a>

        <div class="mapel-title-container">
            <div class="mapel-title">
                Elearning saat ini
            </div>
        </div>

        <div class="mapel-container">
            <div class="mapel-logo">

            </div>
            <div class="mapel-detail-container">
                <div class="mapel-guru">
                    Bahasa Inggris
                </div>
                <div class="mapel">
                    Eko Satrio, S.Pd.
                </div>
            </div>
        </div>
        <div class="mapel-container">
            <div class="mapel-logo">

            </div>
            <div class="mapel-detail-container">
                <div class="mapel-guru">
                    Bahasa Indonesia
                </div>
                <div class="mapel">
                    Reni Saifullah, S.Pd.
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <h1>Welcome, <?php echo $_SESSION['name']?> - <?php echo $_SESSION['username']?></h1>
    </div>
</body>
</html>

