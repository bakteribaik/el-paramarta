<?php 
    include '../connection.php';
    include '../validation/session.php';
    include '../validation/checkSession.php';
    if ($_SESSION['roles'] == '1') {
        header('location:../guru/dashboard');
    }

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

        mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text')");
    }

    if (isset($_POST['kirim-sub-comment'])) {
        $idparent = $_POST['subidparent'];
        $text = $_POST['input-subcomment'];
        $userid = $_SESSION['userid'];
        $name = $_SESSION['name'];

        mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text')");
    }

    if (isset($_POST['kirim-subsub-comment'])) {
        $idparent = $_POST['subsubidparent'];
        $text = $_POST['input-subsubcomment'];
        $userid = $_SESSION['userid'];
        $name = $_SESSION['name'];

        mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text')");
    }
?>  

<!DOCTYPE html>
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
                    <?php echo $row['pesan']?>
                    <div class="image-container">
                        <img src="../image/logo_paramarta.png" alt="">
                    </div>
                </div>
                <div class="reply-button-container">
                    <input type="button" value="balas" class="reply-btn">
                    <div class="reply-container">
                        <form action="" method="POST">
                            <input type="hidden" name="idparent" value="<?php echo $row['id_postingan']; ?>">
                            <textarea placeholder="Tuliskan komentar..." name="input-comment" id="input-pesan" cols="30" rows="10"></textarea>
                            <div class="upload-container">
                                    <label for="upload-file" class="file-btn">Pilih File</label>
                                    <span class="file-name">Tidak ada file yang dipilih</span>
                                    <input type="file" style="visibility:hidden;" name="upload-file" id="upload-file">
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
                        <?php echo $row_comment['pesan']?>
                    </div>
                    <div class="reply-button-container">
                        <input type="button" value="balas" class="reply-btn">
                        <div class="reply-container">
                            <form action="" method="post">
                                <input type="hidden" name="subidparent" value="<?php echo $row_comment['id_postingan'] ?>">
                                <textarea placeholder="Tuliskan komentar..." name="input-subcomment" id="input-pesan" cols="30" rows="10"></textarea>
                                <div class="upload-container">
                                        <label for="upload-file" class="file-btn">Pilih File</label>
                                        <span class="file-name">Tidak ada file yang dipilih</span>
                                        <input type="file" style="visibility:hidden;" name="upload-file" id="upload-file">
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
                            <?php echo $row_subcomment['pesan']?>
                        </div>
                        <div class="reply-button-container">
                            <input type="button" value="balas" class="reply-btn">
                            <div class="reply-container">
                                <form action="" method="POST">
                                    <input type="hidden" name="subsubidparent" value="<?php echo $row_subcomment['id_parent']?>">
                                    <textarea placeholder="Tuliskan komentar..." name="input-subsubcomment" id="input-pesan" cols="30" rows="10"></textarea>
                                    <div class="upload-container">
                                            <label for="upload-file" class="file-btn">Pilih File</label>
                                            <span class="file-name">Tidak ada file yang dipilih</span>
                                            <input type="file" style="visibility:hidden;" name="upload-file" id="upload-file">
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
    <div class="footer">
        copyright	&#169; - SMK Paramarta
    </div>
</body>




<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.reply-btn').click(function(){
            if ( this.value === 'Batal' ) {
                // if it's open close it
                open = false;
                this.value = 'Balas';
                $(this).next("div.reply-container").slideUp("fast");
            }
            else {
                // if it's close open it
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
</script>
</html>