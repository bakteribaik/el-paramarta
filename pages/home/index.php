<?php 
    include '../../connection.php';
    include '../../validation/session.php';
    
    if (empty($_SESSION) == false) {
        if ($_SESSION['roles'] == "1") {
            header("location:../guru");
            exit();
        }
        if ($_SESSION['roles'] == "2") {
            header("location:../siswa");
            exit();
        }
    }

    if (isset($_POST['login'])) {

        $username = $_POST["username"];
        $password = $_POST["password"]; 

        $get = mysqli_query($conn, "SELECT userid, u_pass, roles, nama_user, kode_jurusan FROM db_siswa WHERE userid=$username AND 
               u_pass=$password UNION SELECT userid, u_pass, roles, nama_user, kode_jurusan FROM db_guru WHERE userid=$username AND u_pass=$password LIMIT 1");
        $row = mysqli_fetch_array($get);

        if (mysqli_num_rows($get) === 1) {
          
          // if (isset($row['roles'])) {  < ini gak perlu, karena sudah ada checker line 25 => if (mysqli_num_rows($get) === 1). jika line 25 lolos, ['roles'] sudah pasti ada
          // Karena value set session antara guru dan siswa sama, dijadiin 1 aja. gak perlu per masing-masing if
          $_SESSION['userid'] 	    = $row['userid'];
          $_SESSION['name'] 		= $row['nama_user'];
          $_SESSION['roles'] 		= $row['roles'];
          $_SESSION['jurusan']      = $row['kode_jurusan'];
            
          if ($row['roles'] == "1") {
            mysqli_query($conn, "UPDATE db_guru SET statuses='ONLINE' WHERE userid=$username"); //update status to online when login
            header('location:../guru');
            exit();
          }
          
          if ($row['roles'] == "2") {
            mysqli_query($conn, "UPDATE db_siswa SET statuses='ONLINE' WHERE userid=$username"); //update status to online when login
            header('location:../siswa');
            exit();
          }
        
        } else{
            echo "<script>alert('invalid username or password')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/welcome.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <title>SMK Paramarta | elearning portal</title>
</head>
<body>
    <div class="logo-sekolah">
        <img src="../../assets/image/logo_paramarta.png" style="z-index: 2; position: absolute; height: 80px; margin-left:20px; margin-top: 20px;" class="logo">
    </div>
    <div class="content-container">
        <div class="welcome-container">
            <div class="welcome-image-container">
                <img src="../../assets/image/welcome_image2.png" class="welcome-image">
            </div>
            <div class="login-container">
                <form method="post">
                    <div class="title">SMK PARAMARTA</div>
                    <div class="subtitle">study from every where with e-learning</div>
                    <div class="input-container">
                        <input type="number" name="username" placeholder="Username/NISN" autofocus required><br>
                        <input type="password" name="password" id="password" placeholder="PASSWORD">
                        <span class="material-symbols-outlined" id="lihatpassword" style="position: absolute; margin-top: 40px; margin-left: -45px; color: grey; cursor: pointer;" onclick='showPassword()'>visibility</span><p>
                        <input type="submit" name="login" value="LOGIN"><p>
                        <a href="#">Lupa Password?</a>
                        <hr width="20%" style="opacity: 0.5; margin-top: 40px;"><br>
                        <div class="notice-text">
                            jika ada kendala ketika menggunakan LMS<br>harap untuk menghubungi pihak sekolah
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    function showPassword(){
        x = document.getElementById('lihatpassword')
        z = document.getElementById("password")
        if (z.type === 'password') {
            z.type = "text"
            x.textContent = "visibility_off";
        }else{
            z.type = "password"
            x.textContent = "visibility";
        }
    }
</script>
</html>