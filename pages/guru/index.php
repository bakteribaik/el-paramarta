<?php
    include '../../connection.php';
    include '../../validation/session.php';
    include '../../validation/checkSession.php';
    if ($_SESSION['roles'] == '2') {
        header('location:../../siswa');
    }

    $userid = $_SESSION['userid'];
    $default = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM db_mapel WHERE id_guru = $userid"));

    // if(isset($_POST['create-btn'])){
    //     if (isset($_POST['checkbox']) == 'checked') {
    //         date_default_timezone_set('Asia/Jakarta');
    //         $userid     = $_SESSION['userid'];
    //         $username   = $_SESSION['name'];
    //         $mapel      = $_POST['mata-pelajaran'];
    //         $judul      = $_POST['judul-kelas'];
    //         $deskripsi  = $_POST['deskripsi-kelas'];
    //         $kelas      = $_POST['pilih-kelas'];
    //         $deskmateri = $_POST['deskripsi-materi'];
    //         $created    = date("d F Y H:i");

    //         // INSERT DATA QUIZ
    //         $query = mysqli_query($conn, "INSERT INTO db_quiz (id_guru, nama_guru, created_at) VALUES ($userid, '$username', '$created')");
    //         if ($query) {
    //             $id = $conn->insert_id;

    //             for ($i=1; $i <= 5 ; $i++) { 
    //                 $q    = $_POST["q{$i}"];
    //                 $answer_a = $_POST["q{$i}-answer-a"];
    //                 $answer_b = $_POST["q{$i}-answer-b"];
    //                 $answer_c = $_POST["q{$i}-answer-c"];
    //                 $answer_d = $_POST["q{$i}-answer-d"];
    //                 $correct  = $_POST["q{$i}-answer"];

    //                 mysqli_query($conn, "INSERT INTO db_pertanyaan (pertanyaan, jawaban_a, jawaban_b, jawaban_c, jawaban_d, jawaban_benar, id_quiz) VALUES ('$q','$answer_a','$answer_b','$answer_c','$answer_d','$correct', $id)");
    //             }

    //             // INSERT DATA FORUM
    //             $queryForum = mysqli_query($conn, "INSERT INTO db_forum (id_guru, id_quiz, judul_forum, deskripsi_forum, nama_mapel, nama_guru, kode_jurusan, status_forum, created_at) VALUES ($userid, $id, '$judul', '$deskripsi', '$mapel', '$username', '$kelas', 'OPEN', '$created')");
    //             if ($queryForum) {
    //                 $idForum = $conn->insert_id;
    //                 mysqli_query($conn, "INSERT INTO db_postingan (id_forum,  userid, nama_user, pesan) VALUES ($idForum, $userid, '$username', '$deskmateri')");
    //             }
    //             // END OF INSERT DATA FORUM
    //             header("Refresh: 0", true);
    //         }
    //         // END OF INSERT DATA QUIZ
    //     }else{
    //         date_default_timezone_set('Asia/Jakarta');

    //         $userid     = $_SESSION['userid'];
    //         $username   = $_SESSION['name'];
    //         $mapel      = $_POST['mata-pelajaran'];
    //         $judul      = $_POST['judul-kelas'];
    //         $deskripsi  = $_POST['deskripsi-kelas'];
    //         $kelas      = $_POST['pilih-kelas'];
    //         $deskmateri = $_POST['deskripsi-materi'];
    //         $created    = date("d F Y H:i");
    
    //         $query = mysqli_query($conn, "INSERT INTO db_forum (id_guru, judul_forum, deskripsi_forum, nama_mapel, nama_guru, kode_jurusan, status_forum, created_at) VALUES ($userid, '$judul', '$deskripsi', '$mapel', '$username', '$kelas', 'OPEN', '$created')");
            
    //         if ($query) {
    //             $id = $conn->insert_id;
    //             mysqli_query($conn, "INSERT INTO db_postingan (id_forum,  userid, nama_user, pesan) VALUES ($id, $userid, '$username', '$deskmateri')");
    //             header("Refresh: 0", true);
    //         }
    //     }   
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/guru-forum.css">
    <link rel="stylesheet" href="../../assets/css/guru-navbar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Buat Forum | SMK Paramarta</title>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left-container">
            <div class="navbar-burger" id="opensidebar"><span class="material-symbols-outlined">menu</span></div>
            <div class="navbar-title-container">
                <div class="navbar-title">E-Learning Portal</div>
                <div class="navbar-subtitle">SMK Paramarta</div>
            </div>
        </div>
        <div class="navbar-menu">
            <div class="navbar-user">Dadang Junaedi S.Pd</div>
            <div class="navbar-avatar"></div>
        </div>
    </div>
    <div class="sidebar-container" hidden>
        <div class="sidebar-menu-container">
            <hr>
            <a href="../guru">
                <div class="sidebar-menu">
                    <span class="material-symbols-outlined">home</span>
                    <span class="menu-subtitle">Dashboard</span>
                </div>
            </a>
            <a href="">
                <div class="sidebar-menu">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span class="menu-subtitle">Lihat data siswa anda</span>
                </div>
            </a>
            <a href="../../validation/logout.php">
                <div class="sidebar-menu">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="menu-subtitle">Logout</span>
                </div>
            </a>
        </div>
    </div>

    <div class="content-container">
        <div class="forum-container">
            <div class="forum-create-btn" id="buatkelas">
                Tambah Forum
                <span class="material-symbols-outlined">add</span>
            </div>
            <div class="forum-card-container">
                <?php for($i=1;$i<=9;$i++) : ?>
                    <div class="forum-card">
                        <div class="forum-card-section1">
                            <div class="forum-card-avatar"></div>
                            <div class="forum-card-detail">
                                    <div class="forum-card-title">Materi pembukaan dari tadi</div>
                                    <div class="forum-card-class">
                                        <span class="created-date">Kelas: XI Multimedia 2</span>
                                    </div>
                                    <div class="forum-card-status">
                                        <span class="statuses">Sedang Berlangsung</span>
                                    </div>
                                    <div class="forum-card-created">
                                        <span class="created-date">Dibuat pada: 22 January 2022</span>
                                    </div>
                                    <div class="forum-card-desc">Forum deskripsi yang sangat panjang dan tidak ada gunakaya gauawd wadawin dawdawindwad wijawdawinawd awdinawd oifwaojawf  awd ojiawd nwd a</div>
                            </div>
                            <div class="forum-card-comment">
                                <span class="material-symbols-outlined">mode_comment</span>
                                <span>15</span>
                            </div>
                        </div>
                        <div class="forum-card-section2">
                            <span>
                                <button class="close">Close Forum</button>
                                <button class="edit">Edit Forum</button>
                            </span>
                        </div>
                    </div>
                <?php endfor; ?>
            </div> 
        </div>
        <div class="online-user-container">
            <div class="report-button"> ⚠ Laporkan Kendala</div>
            <div class="additional-menu">
                <a href="">
                    <div class="menu-detail">
                        <span class="material-symbols-outlined">receipt_long</span>
                        <span>Lihat daftar siswa anda</span>
                    </div>
                </a>
                <a href="">
                    <div class="menu-detail">
                        <span class="material-symbols-outlined">door_open</span>
                        <span>Lihat semua forum</span>
                    </div>
                </a>
            </div>
            <hr>
            <div class="online-title">
                Pengguna Online
            </div>
            <?php for($i=1; $i <= 5; $i++) : ?>
                <div class="online-user">
                    <div class="online-user-avatar"></div>
                    <div class="online-user-nickname">Zulfikar Alwi - X MM 1</div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Popup Modal -->
    <div class="buatkelas-modal" <?php if(isset($_POST['create-btn'])){echo "style='display:none;'";}?> style="display:none;">
        <form action="" method="post">
            <div class="create-class-container">
                <div class="create-title">Buat forum diskusi anda</div>
                <div class="form-input-container">
                    <input type="hidden" name="mata-pelajaran" value="<?php echo $default['nama_mapel'];?>">
                    <input type="text" name="" placeholder="<?php echo $default['nama_mapel'];?>" disabled>
                    <input type="text" name="judul-kelas" placeholder="Judul Forum" required>
                    <input type="text" name="deskripsi-kelas" placeholder="Deskripsi Forum">
                    <select name="pilih-kelas" class="pilih-kelas">
                        <option value="">Pilih Kelas</option>
                        <option value="XMM1">X MM 1</option>
                        <option value="XMM2">X MM 2</option>
                        <option value="XIMM1">XI MM 1</option>
                        <option value="XIMM2">XI MM 2</option>
                        <option value="XIIMM1">XII MM 1</option>
                        <option value="XIIMM2">XII MM 2</option>
                    </select>
                    <input type="text" name="deskripsi-materi" placeholder="Deskripsi materi untuk forum">
                    <div class="check-quiz">
                        <input type="checkbox" name="checkbox" id="checkbox" value="checked" onchange="valueChanged()">
                        <label for="checkbox" style="color: grey;">Aktifkan Quizz?</label>
                    </div>
                </div>
                <hr>
                <span class="form-button">
                    <div class="close-button">Batal</div>
                    <input class="create-btn" id="create-btn" name="create-btn" type="submit" value="Buat Kelas" onclick="hideFrom()">
                </span>
            </div>
            <div class="form-input-quiz" style="display:none;">
                <hr>
                <div class="quiz-title">
                    Buat Quiz
                </div>
                <div class="quiz-subtitle">
                    buat quiz sebanyak 5 pertanyaan, dan lingkari salah satu jawaban sebagai jawaban yang benar
                </div>
                <?php for($i=1; $i <= 5; $i++) : ?>
                <input class="pertanyaan" type="text" placeholder="Pertanyaan <?= $i ?>" name="<?= "q{$i}" ?>"><br>
                <span>
                    <input type="radio" name="<?= "q{$i}-answer" ?>" value="A"><input class="input-jawaban" type="text" name="<?= "q{$i}-answer-a" ?>" placeholder="A. .....">
                    <input type="radio" name="<?= "q{$i}-answer" ?>" value="B"><input class="input-jawaban" type="text" name="<?= "q{$i}-answer-b" ?>" placeholder="B. .....">
                </span><br>
                <span>
                    <input type="radio" name="<?= "q{$i}-answer" ?>" value="C"><input class="input-jawaban" type="text" name="<?= "q{$i}-answer-c" ?>" placeholder="C. .....">
                    <input type="radio" name="<?= "q{$i}-answer" ?>" value="D"><input class="input-jawaban" type="text" name="<?= "q{$i}-answer-d" ?>" placeholder="D. .....">
                </span>
                <?php endfor; ?>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(document).ready(
        function(){
            $("#opensidebar").click(function(){
                var inner = '<span class="material-symbols-outlined">menu</span>';
                if($("#opensidebar")[0].innerHTML == inner){
                    $("#opensidebar")[0].innerHTML = '<span class="material-symbols-outlined">close</span>';
                }else{
                    $("#opensidebar")[0].innerHTML = inner;
                }
                $(".sidebar-container").fadeToggle();
            })
        }
    )
    

    // jika form checked maka buat field pertanyaan menjadi required
    function valueChanged(){
            if($('#checkbox').is(":checked")){
                $(".form-input-quiz").slideDown();
                $(".pertanyaan").attr("required", "required")
            }else{
                $(".form-input-quiz").slideUp();
                $(".pertanyaan").removeAttr("required", "required")

            }
    }

    // tampilkan modal untuk membuat kelas (popup)
    $(document).ready(
        function(){
            $("#buatkelas").click(function(){
                console.log('clicked')
                $(".buatkelas-modal").fadeIn();
            })
            $("#buatkelasatas").click(function(){
                console.log('clicked')
                $(".buatkelas-modal").fadeIn();
            })
            $(".close-button").click(function(){
                $(".buatkelas-modal").fadeOut();
            })
        }
    )
</script>
</html>