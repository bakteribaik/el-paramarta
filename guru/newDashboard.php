<?php
    include '../connection.php';
    include '../validation/session.php';
    include '../validation/checkSession.php';
    if ($_SESSION['roles'] == '2') {
        header('location:../siswa/dashboard');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/newDashboard.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Guru Dashboard | LMS Paramarta</title>
</head>
<body>
    <div class="web-container">
        <div class="sidebar-container">
            <div class="icon active"><span class="material-symbols-outlined">home</span></div>
            <div class="icon"><span class="material-symbols-outlined">draw</span></div>
            <div class="icon"><span class="material-symbols-outlined">list_alt</span></div>
            <div class="icon"><span class="material-symbols-outlined">exit_to_app</span></div>
        </div>
        <div class="content-container">
            <div class="header-container">
                <div class="header-title">Dashboard</div>
                <div class="user-container">
                    <div class="username">Dadang Junaedi S.Ag</div>
                    <div class="responsibility">Pendidikan Agama Islam</div>
                </div>
            </div>
            <div class="body-container">
                <div class="body-left">
                    <div class="card-container">
                        <div class="card-left">
                            <div class="card-title">Buat Forum</div>
                            <div class="card-subtitle">Membuat forum diskusi sebagai media interaksi antara tenaga pengajar dan peserta didik secara daring atau online.</div>
                            <div class="element"><span class="material-symbols-outlined">more_horiz</span></div>
                        </div>
                        <div class="card-right">
                            <div class="card-title2">Lihat siswa anda</div>
                            <div class="card-subtitle2">Lihat daftar peserta didik anda secara lengkap dan detail</div>
                            <div class="element2"><span class="material-symbols-outlined">more_horiz</span></div>
                        </div>
                    </div>
                    <div class="forum-list-container">
                        <div class="list-container-title">Forum yang anda buat</div>
                        <div class="list-container-subtitle">Klik judul forum untuk berdiskusi di forum dan klik lihat quiz untuk melihat quiz pada forum</div>
                        <div class="list-forum">
                            <?php for($i=1;$i<=5;$i++) : ?>
                                <span class="list-container">
                                    <span class="list-title"><a href="">Tugas Bahasa Agama</a></span>
                                    <span class="list-desc">Dikumpulkan 20 Maret 2080</span>
                                    <span class="list-quiz"><a href="">Lihat Quiz</a></span>
                                    <span class="list-class">X MM 2</span>
                                    <span class="list-status">Running</span>
                                    <span class="list-button">Edit Forum</span>
                                </span>
                            <?php endfor;?>
                        </div>
                    </div>
                </div>
                <div class="body-right">
                    Daftar siswa online
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Get all buttons with class="btn" inside the container
    var btns = document.getElementsByClassName("icon");

    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>
</html>
