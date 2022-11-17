<?php
    include '../../connection.php';
    include '../../validation/session.php';
    include '../../validation/checkSession.php';
    if ($_SESSION['roles'] == '2') {
        header('location:../../siswa');
    }

    $userid = $_SESSION['userid'];
    $default = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM db_mapel WHERE id_guru = $userid"));

    if(isset($_POST['create-btn'])){
        if (isset($_POST['checkbox']) == 'checked') {
            date_default_timezone_set('Asia/Jakarta');
            $userid     = $_SESSION['userid'];
            $username   = $_SESSION['name'];
            $mapel      = $_POST['mata-pelajaran'];
            $judul      = $_POST['judul-kelas'];
            $deskripsi  = $_POST['deskripsi-kelas'];
            $kelas      = $_POST['pilih-kelas'];
            $deskmateri = $_POST['deskripsi-materi'];
            $created    = date("d F Y H:i");

            // INSERT DATA QUIZ
            $query = mysqli_query($conn, "INSERT INTO db_quiz (id_guru, nama_guru, created_at) VALUES ($userid, '$username', '$created')");
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
                $queryForum = mysqli_query($conn, "INSERT INTO db_forum (id_guru, id_quiz, judul_forum, deskripsi_forum, nama_mapel, nama_guru, kode_jurusan, status_forum, created_at) VALUES ($userid, $id, '$judul', '$deskripsi', '$mapel', '$username', '$kelas', 'OPEN', '$created')");
                if ($queryForum) {
                    $idForum = $conn->insert_id;
                    mysqli_query($conn, "INSERT INTO db_postingan (id_forum,  userid, nama_user, pesan) VALUES ($idForum, $userid, '$username', '$deskmateri')");
                }
                // END OF INSERT DATA FORUM
                header("Refresh: 0", true);
            }
            // END OF INSERT DATA QUIZ
        }else{
            date_default_timezone_set('Asia/Jakarta');

            $userid     = $_SESSION['userid'];
            $username   = $_SESSION['name'];
            $mapel      = $_POST['mata-pelajaran'];
            $judul      = $_POST['judul-kelas'];
            $deskripsi  = $_POST['deskripsi-kelas'];
            $kelas      = $_POST['pilih-kelas'];
            $deskmateri = $_POST['deskripsi-materi'];
            $created    = date("d F Y H:i");
    
            $query = mysqli_query($conn, "INSERT INTO db_forum (id_guru, judul_forum, deskripsi_forum, nama_mapel, nama_guru, kode_jurusan, status_forum, created_at) VALUES ($userid, '$judul', '$deskripsi', '$mapel', '$username', '$kelas', 'OPEN', '$created')");
            
            if ($query) {
                $id = $conn->insert_id;
                mysqli_query($conn, "INSERT INTO db_postingan (id_forum,  userid, nama_user, pesan) VALUES ($id, $userid, '$username', '$deskmateri')");
                header("Refresh: 0", true);
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
    <link rel="stylesheet" href="../../assets/css/newDashboard.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Guru Dashboard | LMS Paramarta</title>
</head>
<body>
    <div class="web-container">
        <div class="sidebar-container">
            <div class="icon active"><span class="material-symbols-outlined">home</span></div>
            <div class="icon" id="buatkelas"><span class="material-symbols-outlined">draw</span></div>
            <div class="icon"><span class="material-symbols-outlined">list_alt</span></div>
            <a href="../../validation/logout.php"><div class="icon"><span class="material-symbols-outlined">exit_to_app</span></div></A>
        </div>
        <div class="content-container">
            <div class="header-container">
                <div class="header-title">Dashboard</div>
                <div class="user-container">
                    <div class="username"><?php echo $default['nama_guru'];?></div>
                    <div class="responsibility"><?php echo $default['nama_mapel'];?></div>
                </div>
            </div>
            <div class="body-container">
                <div class="body-left">
                    <div class="card-container">
                        <div class="card-left">
                            <span class="material-symbols-outlined" style="color:white;">draw</span>
                            <div class="card-title">Buat Forum</div>
                            <div class="card-subtitle">Membuat forum diskusi sebagai media interaksi antara tenaga pengajar dan peserta didik secara daring atau online.</div>
                            <div class="element"><span class="material-symbols-outlined">more_horiz</span></div>
                        </div>
                        <div class="card-right">
                            <span class="material-symbols-outlined" style="color:#012330;">list_alt</span>
                            <div class="card-title2">Lihat siswa anda</div>
                            <div class="card-subtitle2">Lihat daftar peserta didik anda secara lengkap dan detail</div>
                            <div class="element2"><span class="material-symbols-outlined">more_horiz</span></div>
                        </div>
                    </div>
                    <div class="forum-list-container">
                        <div class="list-container-title">Forum yang sedang berjalan</div>
                        <div class="list-container-subtitle">Klik judul forum untuk berdiskusi di forum dan klik lihat quiz untuk melihat quiz pada forum</div>
                        <div class="list-forum">
                            <?php 
                                $x = 1;
                                $userid = $_SESSION['userid'];
                                $query = mysqli_query($conn, "SELECT * FROM db_forum WHERE id_guru = $userid ORDER BY status_forum='OPEN' DESC");
                                while($row = mysqli_fetch_array($query)) :
                            ?>
                                <div class="forum-card">
                                    <div class="title-container">
                                        <?php if($row['id_quiz'] != NULL){ ?>
                                            <div class="forum-title"><a href="../forum?id=<?= $row['id_forum']?>"><?= $row['judul_forum'];?></a>  &nbsp;|&nbsp;  <a href="../quiz?id=<?= $row['id_quiz'];?>" style="color:#3A8099;">Lihat Quiz</a> &nbsp;|&nbsp; <?= $row['kode_jurusan']?></div>
                                        <?php } else { ?>
                                            <a href="../forum?id=<?= $row['id_forum']?>">
                                                <div class="forum-title"><?= $row['judul_forum'];?> &nbsp;|&nbsp; <?= $row['kode_jurusan']?></div>
                                            </a>
                                        <?php } ?>
                                        <div class="edit-btn">Edit Forum</div>
                                    </div>
                                    <div class="forum-desc"><?= $row['deskripsi_forum']; ?></div>
                                    <div class="last-comment-container">
                                        <?php 
                                            $id_forum = $row['id_forum'];
                                            $q = mysqli_query($conn, "SELECT nama_user FROM db_postingan WHERE id_forum = $id_forum ORDER BY id_postingan DESC limit 1");
                                            $c = mysqli_query($conn, "SELECT COUNT(*) FROM db_postingan WHERE id_forum = $id_forum");
                                            $last = mysqli_fetch_array($q);
                                            $count = mysqli_fetch_array($c);
                                        ?>
                                        <div class="last-username">
                                        <strong>Komentar terakhir dari:</strong> <?= $last['nama_user'] ?> | 💬 <?= $count[0] ?> | 
                                            <?php if($row['status_forum'] == 'OPEN'){?> <span class="status">Sedang berjalan</span> <?php } else {?> <span class="status closed">Sesi sudah berakhir</span> <?php } ?></div>
                                        <div class="date-created">
                                            Dibuat pada: <?= $row['created_at']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <div class="body-right">
                    <div class="online-user-container">
                        <div class="online-title"><center>Pengguna Sedang Online</center></div>
                        <div class="online-subtitle"><center>daftar peserta didik yang saat ini sedang menggunakan sistem LMS SMK Paramarta</center></div>
                        <hr>
                        <div class="online-list">
                            <?php
                                $data = mysqli_query($conn, "SELECT * FROM db_siswa WHERE statuses = 'ONLINE'");
                                while($user = mysqli_fetch_array($data)) :
                            ?>
                                <div class="online-user"><?= $user['nama_user'] ?> - <?= $user['userid'] ?> - <?= $user['kode_jurusan'] ?></div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
<script>
    // Get all buttons with class="btn" inside the container
    var btns = document.getElementsByClassName("icon");
    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>
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
