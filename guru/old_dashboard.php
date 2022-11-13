<?php 
    include '../connection.php';
    include '../validation/session.php';
    include '../validation/checkSession.php';
    if ($_SESSION['roles'] == '2') {
        header('location:../siswa/dashboard');
    }

    $userid = $_SESSION['userid'];
    $default = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM db_mapel WHERE id_guru = $userid"));

    if(isset($_POST['create-btn'])){
        if (isset($_POST['checkbox']) == 'checked') {
            $userid     = $_SESSION['userid'];
            $username   = $_SESSION['name'];
            $mapel      = $_POST['mata-pelajaran'];
            $judul      = $_POST['judul-kelas'];
            $deskripsi  = $_POST['deskripsi-kelas'];
            $kelas      = $_POST['pilih-kelas'];
            $deskmateri = $_POST['deskripsi-materi'];

            // INSERT DATA QUIZ
            $query = mysqli_query($conn, "INSERT INTO db_quiz (id_guru, nama_guru) VALUES ($userid, '$username')");
            if ($query) {
                $id = $conn->insert_id;

                for ($i=1; $i <= 5 ; $i++) { 
                    $q    = $_POST["q{$i}"];
                    $answer_a = $_POST["q{$i}-answer-a"];
                    $answer_b = $_POST["q{$i}-answer-b"];
                    $answer_c = $_POST["q{$i}-answer-c"];
                    $answer_d = $_POST["q{$i}-answer-d"];
                    $correct  = $_POST["q{$i}-answer"];

                    mysqli_query($conn, "INSERT INTO db_pertanyaan (pertanyaan, jawaban_a, jawaban_b, jawaban_c, jawaban_d, jawaban_benar, id_quiz) VALUES ('$q','$answer_a','$answer_b','$answer_c','$answer_d','$correct', $id)");
                }

                // INSERT DATA FORUM
                $queryForum = mysqli_query($conn, "INSERT INTO db_forum (id_guru, id_quiz, judul_forum, deskripsi_forum, nama_mapel, nama_guru, kode_jurusan, status_forum) VALUES ($userid, $id, '$judul', '$deskripsi', '$mapel', '$username', '$kelas', 'OPEN')");
                if ($queryForum) {
                    $idForum = $conn->insert_id;
                    mysqli_query($conn, "INSERT INTO db_postingan (id_forum,  userid, nama_user, pesan) VALUES ($idForum, $userid, '$username', '$deskmateri')");
                }
                // END OF INSERT DATA FORUM
                header("location:dashboard", true);
            }
            // END OF INSERT DATA QUIZ
        }else{
            $userid     = $_SESSION['userid'];
            $username   = $_SESSION['name'];
            $mapel      = $_POST['mata-pelajaran'];
            $judul      = $_POST['judul-kelas'];
            $deskripsi  = $_POST['deskripsi-kelas'];
            $kelas      = $_POST['pilih-kelas'];
            $deskmateri = $_POST['deskripsi-materi'];
    
            $query = mysqli_query($conn, "INSERT INTO db_forum (id_guru, judul_forum, deskripsi_forum, nama_mapel, nama_guru, kode_jurusan, status_forum) VALUES ($userid, '$judul', '$deskripsi', '$mapel', '$username', '$kelas', 'OPEN')");
            
            if ($query) {
                $id = $conn->insert_id;
                mysqli_query($conn, "INSERT INTO db_postingan (id_forum,  userid, nama_user, pesan) VALUES ($id, $userid, '$username', '$deskmateri')");
                header("location:dashboard", true);
            }
        }   
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
                <!-- <div class="avatar"></div> -->
                <div class="user">
                    <div class="user-name"><?php echo $default['nama_guru'];?></div>
                    <div class="user-title"><?php echo $default['nama_mapel'];?></div>
                </div>
            </div>
        </div>
        <div class="menu-container">
            <div class="menu-item">
                <span class="title"><a href="">Dashboard</a></span>
                <span class="material-symbols-outlined">apps</span>
            </div>
            <div class="menu-item">
                <span class="title"><a href="">Lihat Semua Forum</a></span>
                <span class="material-symbols-outlined">travel_explore</span>
            </div>
            <div class="menu-item" id="buatkelas">
                <span class="title">Buat Forum</span>
                <span class="material-symbols-outlined">draw</span>
            </div>
            <div class="menu-item">
                <span class="title"><a href="">Daftar Siswa Anda</a></span>
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
                    <b>69</b> Siswa
                </div>
                <div class="detail-menu">
                    <a href="">Lihat Detail</a>
                </div>
            </div>
            <div class="menu-content2">
                <div class="title-menu">
                    Buat Forum Online?
                </div>
                <div class="data-menu">
                    <span id="buatkelasatas">+ Buat Forum</span>
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
                <img src="../image/Red_circle.gif" height="30">
                <div class="title-text">Forum yang sedang berlangsung</div>
            </div>
            <div class="table-list">
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Judul Forum</th>
                        <th>Quiz Forum</th>
                        <th>Deskripsi Forum</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                    </tr>
                    <?php 
                        $x = 1;
                        $userid = $_SESSION['userid'];
                        $query = mysqli_query($conn, "SELECT * FROM db_forum WHERE id_guru = $userid AND status_forum = 'OPEN' ");
                        while($row = mysqli_fetch_array($query)) :
                    ?>
                    <tr>
                        <td>&nbsp;<?= $x?>.</td>
                        <td><a href="../pages/forum?id=<?= $row['id_forum'];?>">Lihat <?= $row['judul_forum'];?></a></td>
                            <?php if($row['id_quiz'] == null) { ?>
                                <td>Tidak ada Quiz</td>
                            <?php } else { ?>
                                <td><a href="../pages/quiz?id=<?= $row['id_quiz'];?>">Lihat Quiz</a></td>
                            <?php }; ?>
                        <td><?= $row['deskripsi_forum'];?></td>
                        <td><?= $row['kode_jurusan'];?></td>
                        <td><?= $row['status_forum'];?></td>
                        <td><button>Edit Forum</button></td>
                    </tr>
                    <?php $x++; endwhile; ?>
                </table>
            </div>
        </div>
    </div>
    <div class="buatkelas-modal" <?php if(isset($_POST['create-btn'])){echo "style='display:none;'";}?> style="display:block;">
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