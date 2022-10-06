<?php
    include 'session.php';
    include '../connection.php';

    $username = $_SESSION['userid'];
    if($_SESSION['roles'] == '1'){
        mysqli_query($conn, "UPDATE db_guru SET statuses='OFFLINE' WHERE userid=$username");
    }
    if ($_SESSION['roles'] == '2') {
        mysqli_query($conn, "UPDATE db_siswa SET statuses='OFFLINE' WHERE userid=$username");
    }
    
    unset($_SESSION['userid']);
    unset($_SESSION['password']);
    session_destroy();
    header("location:../home");
?>