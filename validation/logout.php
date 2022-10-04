<?php
    include 'session.php';
    include '../connection.php';

    $username = $_SESSION['username'];
    if($_SESSION['roles'] == '1'){
        mysqli_query($conn, "UPDATE db_guru SET statuses='OFFLINE' WHERE username=$username");
    }
    if ($_SESSION['roles'] == '2') {
        mysqli_query($conn, "UPDATE db_siswa SET statuses='OFFLINE' WHERE username=$username");
    }
    
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    session_destroy();
    header("location:../home");
?>