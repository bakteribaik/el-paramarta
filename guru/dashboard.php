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
        <link rel="stylesheet" href="../css/dash_guru.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>SMK Paramarta | Tenaga Pengajar</title>
</head>
<body>
    <div class="sidebar">
        <div class="user-name-container">
            <div class="user-container">
                <div class="avatar"></div>
                <div class="user">
                    <div class="user-name">Diding Sudrajat, S.Pd</div>
                    <div class="user-title">Bahasa Inggris</div>
                </div>
            </div>
        </div>
        <div class="menu-container">
            <div class="menu-item">
                <span class="title"><a href="">Dashboard</a></span>
                <span class="material-symbols-outlined">apps</span>
            </div>
            <div class="menu-item">
                <span class="title"><a href="">Buat Kelas</a></span>
                <span class="material-symbols-outlined">draw</span>
            </div>
            <div class="menu-item">
                <span class="title"><a href="">Daftar Siswa</a></span>
                <span class="material-symbols-outlined">list_alt</span>
            </div>
            <div class="menu-item">
                <span class="title"><a href="../validation/logout.php">Logout</a></span>
                <span class="material-symbols-outlined">exit_to_app</span>
            </div>
            <!-- .... -->
        </div>
    </div>
    <div class="content-container">
        <div class="menu-content-container">
            <div class="menu-content1">
                <div class="title-menu">
                    Siswa yang online saat ini
                </div>
                <div class="data-menu">
                    <b>69696969</b> Siswa
                </div>
                <div class="detail-menu">
                    <a href="">Lihat Detail</a>
                </div>
            </div>
            <div class="menu-content2">
                <div class="title-menu">
                    Buat Kelas Online?
                </div>
                <div class="data-menu">
                    <a href="">+ Buat Kelas</a>
                </div>
            </div>
            <div class="menu-content3">
                <div class="title-menu">
                    Lihat daftar siswa anda
                </div>
                <div class="data-menu3">
                    <span class="material-symbols-outlined">visibility</span>&nbsp;
                    <a href="">Lihat Disini</a>
                </div>
            </div>
        </div>
        <div class="list-kelas-container">
            <div class="title-list">
                Kelas yang anda buat
            </div>
            <div class="table-list">
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Judul Kelas</th>
                        <th>Deskripsi Kelas</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td><a href="">Tugas Bahasa Inggris</a></td>
                        <td>Kerjakan Tugas Ini atau ka....</td>
                        <td>XIMM2</td>
                        <td>OPEN</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>