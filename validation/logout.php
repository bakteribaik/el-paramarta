<?php
    include 'session.php';
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    session_destroy();
    header("location:../home");
?>