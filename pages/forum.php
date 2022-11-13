<?php 
    include '../connection.php';
    include '../validation/session.php';
    include '../validation/checkSession.php';

    $randomColor = function(){
        $colors = [
            '#554994','#F675A8','#F29393','#FFCCB3','#A7D2CB','#F2D388','#C98474','#874C62','#F4BFBF','#FFD9C0'
            ,'#FAF0D7','#8CC0DE','#68A7AD','#FFF89A'
        ];
        $rand = rand(0, count($colors) - 1);
        return isset($colors[$rand]) ? $colors[$rand] : $colors[0];
    };

    $id_forum = $_GET['id'];
    $query_forum = mysqli_query($conn, "SELECT * FROM db_forum WHERE id_forum=$id_forum");
    $header = mysqli_fetch_array($query_forum);

    if ($header['kode_jurusan'] != $_SESSION['jurusan']) {
        header('Location:javascript:history.go(-1)');
    }

    if (isset($_POST['kirim-comment'])) {

        $idparent = $_POST['idparent'];
        $text = $_POST['input-comment'];
        $userid = $_SESSION['userid'];
        $name = $_SESSION['name'];

        $random = rand(0, 999999);
        $files = $_FILES['upload-file'];
        $file_dir = '../uploads/'.$random."_".$files['name'];

        if ($text != '' && $_FILES['upload-file']['size'] != 0) {
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text', '$file_dir')");
        }else if($text == '' && $_FILES['upload-file']['size'] != 0){
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$file_dir')");
        }else if($text != '' && $_FILES['upload-file']['size'] == 0){
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text')");
        }else{
            echo "alert text harus diisi";
        }
    }

    if (isset($_POST['kirim-sub-comment'])) {

        $idparent = $_POST['subidparent'];
        $text = $_POST['input-subcomment'];
        $userid = $_SESSION['userid'];
        $name = $_SESSION['name'];

        $random = rand(0, 999999);
        $files = $_FILES['upload-file'];
        $file_dir = '../uploads/'.$random."_".$files['name'];

        if ($text != '' && $_FILES['upload-file']['size'] != 0) {
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text', '$file_dir')");
        }else if($text == '' && $_FILES['upload-file']['size'] != 0){
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$file_dir')");
        }else if($text != '' && $_FILES['upload-file']['size'] == 0){
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text')");
        }else{
            echo "alert text harus diisi";
        }
    }

    if (isset($_POST['kirim-subsub-comment'])) {

        $idparent = $_POST['subsubidparent'];
        $text = $_POST['input-subsubcomment'];
        $userid = $_SESSION['userid'];
        $name = $_SESSION['name'];

        $random = rand(0, 999999);
        $files = $_FILES['upload-file'];
        $file_dir = '../uploads/'.$random."_".$files['name'];

        if ($text != '' && $_FILES['upload-file']['size'] != 0) {
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text', '$file_dir')");
        }else if($text == '' && $_FILES['upload-file']['size'] != 0){
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$file_dir')");
        }else if($text != '' && $_FILES['upload-file']['size'] == 0){
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text')");
        }else{
            echo "alert text harus diisi";
        }
    }
?>  

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/forum.css">
    <title>Forum Diskusi <?php echo $header['kode_jurusan'];?> | <?php echo $header['judul_forum'];?></title>
</head>
<body>
    <div class="navbar">
        <a href="../siswa/dashboard" class="back-btn">Dashboard</a>
    </div>
    <div class="page-header">
        <div class="judul-forum">
            <?php echo $header['judul_forum'] ?>
        </div>
        <div class="deskripsi-forum">
            <?php echo $header['deskripsi_forum'] ?>
        </div>
        <div class="nama-guru">
            <?php echo $header['nama_guru'] ?> - <?php echo $header['kode_jurusan'] ?>
        </div>
    </div>
    <?php
        $query = mysqli_query($conn, "SELECT * FROM db_postingan WHERE id_forum=$id_forum AND id_parent is null");
        while($row  = mysqli_fetch_array($query)):
    ?>
        <div class="main-post-container">
            <div class="post-container">
                <div class="post-header-container">
                    <div class="avatar" style="background-color: <?php echo $randomColor(); ?>"></div>
                    <div class="header-container">
                        <div class="topic">
                            <?php echo $header['judul_forum']?> - <?php echo $header['nama_guru']?>
                        </div>
                        <div class="user">
                            Dari: <?php echo $row['nama_user']?> - <?php echo $row['userid']?>
                        </div>
                    </div>
                </div>
                <div class="message-container">
                    <?php echo $row['pesan']?><br>
                    <?php if($row['file_dir'] != NULL){ ?>
                        <a href="<?php echo $row['file_dir']?>">See Attachment</a>
                    <?php } ?>
                </div>
                <div class="reply-button-container">
                    <input type="button" value="Tambah Komentar" class="reply-btn">
                    <div class="reply-container">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="idparent" value="<?php echo $row['id_postingan']; ?>">
                            <textarea placeholder="Tuliskan komentar..." name="input-comment" id="input-pesan" cols="30" rows="10"></textarea>
                            <div class="upload-container">
                                <label for="upload-file" class="file-btn">Sematkan File</label>
                                <span class="file-name">Tidak ada file yang dipilih</span>
                                <input type="file" name="upload-file" id="upload-file" hidden>
                            </div>
                            <div class="kirim-button-container">
                                <input type="submit" name="kirim-comment" value="Kirim" id="kirim-btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                $id_post = $row['id_postingan'];
                $query_comment = mysqli_query($conn, "SELECT * FROM db_postingan WHERE id_forum=$id_forum AND id_parent=$id_post");
                while($row_comment = mysqli_fetch_array($query_comment)):
            ?>
                <div class="post-container" style="margin-left: 50px; margin-top: 10px;">
                    <div class="post-header-container">
                        <div class="avatar" style="background-color: <?php echo $randomColor(); ?>"></div>
                        <div class="header-container">
                            <div class="topic">
                                <?php echo $header['judul_forum']?> - <?php echo $header['nama_guru']?>
                            </div>
                            <div class="user">
                                Dari: <?php echo $row_comment['nama_user']?> - <?php echo $row_comment['userid']?>
                            </div>
                        </div>
                    </div>
                    <div class="message-container">
                        <?php echo $row_comment['pesan']?><br>
                        <?php if($row_comment['file_dir'] != NULL){ ?>
                            <a href="<?php echo $row_comment['file_dir']?>">See Attachment</a>
                        <?php } ?>
                    </div>
                    <div class="reply-button-container">
                        <input type="button" value="Tambah Komentar" class="reply-btn2">
                        <div class="reply-container">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="subidparent" value="<?php echo $row_comment['id_postingan'] ?>">
                                <textarea placeholder="Tuliskan komentar..." name="input-subcomment" id="input-pesan" cols="30" rows="10"></textarea>
                                <div class="upload-container">
                                    <label for="subupload-file" class="file-btn">Sematkan File</label>
                                    <span class="file-name">Tidak ada file yang dipilih</span>
                                    <input type="file" name="upload-file" id="subupload-file" hidden>
                                </div>
                                <div class="kirim-button-container">
                                    <input type="submit" name="kirim-sub-comment" value="Kirim" id="kirim-btn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    $id_post = $row_comment['id_postingan'];
                    $query_subcomment = mysqli_query($conn, "SELECT * FROM db_postingan WHERE id_forum=$id_forum AND id_parent=$id_post");
                    while($row_subcomment = mysqli_fetch_array($query_subcomment)):
                ?>
                    <div class="post-container" style="margin-left: 90px; margin-top: 10px;">
                        <div class="post-header-container">
                            <div class="avatar" style="background-color: <?php echo $randomColor(); ?>"></div>
                            <div class="header-container">
                                <div class="topic">
                                    <?php echo $header['judul_forum']?> - <?php echo $header['nama_guru']?>
                                </div>
                                <div class="user">
                                    Dari: <?php echo $row_subcomment['nama_user']?> - <?php echo $row_subcomment['userid']?>
                                </div>
                            </div>
                        </div>
                        <div class="message-container">
                            <?php echo $row_subcomment['pesan']?><br>
                            <?php if($row_subcomment['file_dir'] != NULL){ ?>
                                <a href="<?php echo $row_subcomment['file_dir']?>">See Attachment</a>
                            <?php } ?>
                        </div>
                        <div class="reply-button-container">
                            <!-- <input type="button" value="balas" class="reply-btn"> -->
                            <div class="reply-container">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="subsubidparent" value="<?php echo $row_subcomment['id_parent']?>">
                                    <textarea placeholder="Tuliskan komentar..." name="input-subsubcomment" id="input-pesan" cols="30" rows="10"></textarea>
                                    <div class="upload-container">
                                        <label for="subsubupload-file" class="file-btn">Sematkan File</label>
                                        <span class="file-name">Tidak ada file yang dipilih</span>
                                        <input type="file" name="upload-file" id="subsubupload-file" hidden>
                                    </div>
                                    <div class="kirim-button-container">
                                        <input type="submit" name='kirim-subsub-comment' value="Kirim" id="kirim-btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endwhile; ?>
        </div>
    <?php endwhile; ?> 
</body>

<script src="https://cdn.tiny.cloud/1/gy8go9ziagm3lv37b4affh37b9m8mj55k10beso6l1rab8ac/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ]
    });
</script>


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.reply-btn').click(function(){
            if ( this.value === 'Batal' ) {
                // if it's open close it
                $('.reply-btn').css('background-color', '#f0f0f0')
                open = false;
                this.value = 'Tambah Komentar';
                $(this).next("div.reply-container").slideUp("fast");
            }
            else {
                // if it's close open it
                $('.reply-btn').css('background-color', 'aquamarine')
                open = true;
                this.value = 'Batal';
                $(this).siblings("[value='Batal']").click();
                $(this).next("div.reply-container").slideDown("fast");
            }
        });
        $('.reply-btn2').click(function(){
            if ( this.value === 'Batal' ) {
                // if it's open close it
                $('.reply-btn2').css('background-color', '#f0f0f0')
                open = false;
                this.value = 'Tambah Komentar';
                $(this).next("div.reply-container").slideUp("fast");
            }
            else {
                // if it's close open it
                $('.reply-btn2').css('background-color', 'aquamarine')
                open = true;
                this.value = 'Batal';
                $(this).siblings("[value='Batal']").click();
                $(this).next("div.reply-container").slideDown("fast");
            }
        });
    });

    $("#upload-file").change(function() {
        filename = this.files[0].name;
        $(".file-name").text(filename);
    });
    $("#subupload-file").change(function() {
        filename = this.files[0].name;
        $(".file-name").text(filename);
    });
    $("#subsubupload-file").change(function() {
        filename = this.files[0].name;
        $(".file-name").text(filename);
    });
</script>
</html>