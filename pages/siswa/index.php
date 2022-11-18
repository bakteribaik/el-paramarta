<?php 
    include '../../connection.php';
    include '../../validation/session.php';
    include '../../validation/checkSession.php';
    if ($_SESSION['roles'] == '1') {
        header('location:../guru');
    }

    $randomColor = function(){
        $colors = [
            '#554994','#F675A8','#F29393','#FFCCB3','#A7D2CB','#F2D388','#C98474','#874C62','#F4BFBF','#FFD9C0'
            ,'#FAF0D7','#8CC0DE','#68A7AD','#FFF89A'
        ];
        $rand = rand(0, count($colors) - 1);
        return isset($colors[$rand]) ? $colors[$rand] : $colors[0];
    }
    
    // $siswaID = $_SESSION['userid'];
    // $siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM db_siswa WHERE userid = $siswaID"));

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/newDashboardSiswa.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard Siswa | SMK Paramarta</title>
</head>
<body>
    <div class="navbar">
        <div class="web-logo">
            LMS SMK Paramarta
            <!-- <img src="../../assets/image/logo_paramarta.png" style="height: 60px;"> -->
        </div>
        <div class="navitems">
            <span><a href="">Official Website</a></span>
            <span><a href="">Panduan</a></span>
            <span><a href="">Bantuan</a></span>
            <span class="username"><a href=""><?= $_SESSION['name'] ?></a></span>
        </div>
    </div>
    <div class="content-container">
        <div class="sideleft-bar">
            <div class="side-item">
                <div class="item"><span class="material-symbols-outlined">home</span><a href="">Dashboard</a></div>
                <div class="item"><span class="material-symbols-outlined">account_circle</span><a href="">Profile</a></div>
                <div class="item"><span class="material-symbols-outlined">logout</span><a href="../../validation/logout.php">Keluar</a></div>
            </div>
            <div class="mapel-header">
                Mata Pelajaran
            </div>
            <div class="mapel-container">
                <?php
                    $kodejurusan = $_SESSION['jurusan'];
                    $queryMapel = mysqli_query($conn, "SELECT * FROM db_mapel WHERE kode_jurusan = '$kodejurusan'");
                    while($mapel = mysqli_fetch_array($queryMapel)) :
                ?>
                    <div class="mapel-card">
                        <div class="avatar" style="background-color: <?php echo $randomColor(); ?>"></div>
                        <div class="mapel-details">
                            <div class="mapel-title"><?= $mapel['nama_mapel']?></div>
                            <div class="mapel-subtitle"><?= $mapel['nama_guru']?></div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="centerside">
            <div class="available-forum-header">
                Forum yang tersedia saat ini
            </div>
            <div class="available-forum-subheader">
                > klik pada bagian judul forum untuk diskusi, dan klik kerjakan quiz untuk melihat quiz
            </div>
            <div class="forum-container">
                <?php
                    $kodejurusan = $_SESSION['jurusan'];
                    $queryForum = mysqli_query($conn, "SELECT * FROM db_forum WHERE kode_jurusan = '$kodejurusan' ORDER BY status_forum DESC");
                    while($forum = mysqli_fetch_array($queryForum)) :
                ?>
                    <div class="forum-card">
                        <a href="../forum?id=<?=$forum['id_forum']?>">
                            <div class="forum-title"><?= $forum['judul_forum']?></div>
                        </a>
                        <div class="user-container">
                            <div class="user-details">
                                <div class="user"><?= $forum['nama_guru']?></div>
                                <div class="userjob"><?= $forum['nama_mapel']?></div>
                            </div>
                            <div class="right-tag">
                                <?php if($forum['id_quiz'] != NULL) { ?>
                                    <a href="../quiz?id=<?=$forum['id_quiz']?>">
                                        <div class="forum-tag">
                                            klik disini untuk mengerjakan Quiz 📰
                                        </div>
                                    </a>
                                <?php } ?>
                                <?php if($forum['status_forum'] == 'OPEN') { ?>
                                    <div class="forum-tag status">
                                        Sesi Sedang Berjalan 🏃‍♀️
                                    </div>
                                <?php } else { ?>
                                    <div class="forum-tag closed">
                                        Sesi Berakhir 👋
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="forum-desc">
                        <?= $forum['deskripsi_forum']?>
                        </div>
                        <div class="created-at">
                            Forum dibuat: <?= $forum['created_at']?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="rightside-bar">
            <div class="right-user-details">
                <div class="user-jurusan-title"><?= $_SESSION['jurusan'] ?></div>
                <div class="user-jurusan-subtitle"> > Otomatisasi Keuangan Perkantoran</div>
                <center>
                    <div class="right-avatar">
                        <div class="photo"></div>
                    </div>
                </center>
                <div class="right-username"><center><?= $_SESSION['name'] ?></center></div>
            </div>
            <hr>
            <!-- <div class="user-button">
                <div class="user-item">Lihat Profil</div>
            </div> -->
            <div class="useronline-header">
                Pengguna Online
            </div>
            <div class="useronline-container">
                <?php
                    $quryonline = mysqli_query($conn, "SELECT * FROM db_siswa WHERE statuses = 'ONLINE'");
                    while($online = mysqli_fetch_array($quryonline)) :
                ?>
                    <div class="useronline-card">
                        <div class="avatar" style="background-color: <?php echo $randomColor(); ?>"></div>
                        <div class="online-detail"><?= $online['nama_user']?> - <?= $online['kode_jurusan']?></div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>