<?php 
    include 'connection.php';
    include 'validation/session.php';
    
    if (empty($_SESSION) == false) {
        if ($_SESSION['roles'] == "1") {
            header("location:guru/dashboard");
            exit();
        }
        if ($_SESSION['roles'] == "2") {
            header("location:siswa/dashboard");
            exit();
        }
    }

    if (isset($_POST['login'])) {

        $username = $_POST["username"];
        $password = $_POST["password"]; 

        $get = mysqli_query($conn, "SELECT username, u_pass, roles, nama_user, kode_jurusan FROM db_siswa WHERE username=$username AND 
               u_pass=$password UNION SELECT username, u_pass, roles, nama_user, kode_jurusan FROM db_guru WHERE username=$username AND u_pass=$password LIMIT 1");
        $row = mysqli_fetch_array($get);

        if (mysqli_num_rows($get) === 1) {
          
          // if (isset($row['roles'])) {  < ini gak perlu, karena sudah ada checker line 25 => if (mysqli_num_rows($get) === 1). jika line 25 lolos, ['roles'] sudah pasti ada
          // Karena value set session antara guru dan siswa sama, dijadiin 1 aja. gak perlu per masing-masing if
          $_SESSION['username'] 	= $row['username'];
          $_SESSION['name'] 		= $row['nama_user'];
          $_SESSION['roles'] 		= $row['roles'];
          $_SESSION['jurusan']      = $row['kode_jurusan'];
            
          if ($row['roles'] == "1") {
            mysqli_query($conn, "UPDATE db_guru SET statuses='ONLINE' WHERE username=$username"); //update status to online when login
            header('location:guru/dashboard');
            exit();
          }
          
          if ($row['roles'] == "2") {
            mysqli_query($conn, "UPDATE db_siswa SET statuses='ONLINE' WHERE username=$username"); //update status to online when login
            header('location:siswa/dashboard');
            exit();
          }
        
        } else{
            echo "<script>alert('Login Gagal!');</script>";
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/welcome.css" rel="stylesheet" type="text/css" />
    <title>SMK Paramarta | elearning portal</title>
</head>
<body>
    <nav class="navbar">
        <img src="image/logo_paramarta.png" class='logo'>
        <a href="https://smkparamarta.sch.id/" class = "active">Website</a>
        <a href="#">Panduan</a>
        <a href="#">Bantuan</a>
    </nav>

    <table>
        <tr>
            <td>
                <div class = "welcome-text">
                    SMK PARAMARTA
                </div><br>
                <div class = "welcome-text2">
                    E-Learning Portal
                </div>
                <img src="image/welcome_image.png" class='welcome-image'>
            </td>
            <td>
                <div class = 'login-container'>
                    <div class = 'login-welcome'>
                        Login dengan akunmu
                    </div>
                    <form action="" method="post" onsubmit="return loginCheck()">
                        <input type="text" name="username" id="forminput" placeholder='NISN/NIP' autofocus>
                        <p>
                        <input type="password" name="password" id="forminputPassword" placeholder='Password'>
                        <p>
                            <div class='rememberme-wrapper'>
                                <input type="checkbox" name="showPass" id="showPass" onClick="showPassword()">
                                Lihat Password
                            </div>
                        <p>
                        <input type="submit" name="login" value="login" id='submitbutton'>
                    </form>
                    <a href="#" class = 'lupapassword'>Lupa Password?</a>
                </div>
            </td>
        </tr>
    </table>
</body>
<script type="text/javascript" src="js/login.js""></script>
</html>