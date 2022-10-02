<?php
    include "../validation/session.php";
    include "../connection.php";

    if (isset($_POST['login'])) {

        $username = $_POST["username"];
        $password = $_POST["password"]; 

        $get = mysqli_query($conn, "SELECT * FROM db_siswa WHERE username=$username AND password_siswa=$password");
        $row = mysqli_fetch_array($get);

        // if (mysqli_num_rows($get) === 1) {
            
        //     $_SESSION['username'] = $row['username'];
        //     $_SESSION['role'] = $row['role'];

        //     header('location:../pages/dashboard');
        //     exit();
        // }else{
        //     header('location:../home');
        //     exit();
        // }

        // if (is_array($row)) {
        //     $_SESSION['username'] = $row['username'];
        //     $_SESSION['password'] = $row['password_siswa'];
        // }

        // if (isset($_SESSION['username'])) {
        //     header('location:../pages/dashboard');
        //     exit();
        // }else{
        //     header('location:../home');
        //     exit();
        // }
    }

?>