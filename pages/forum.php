<?php 
    include '../connection.php';
    include '../validation/session.php';
    include '../validation/checkSession.php';
    if ($_SESSION['roles'] == '1') {
        header('location:../guru/dashboard');
    }

    $id = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM db_postingan WHERE id_forum=$id");
    $sqli = mysqli_query($conn, "SELECT * FROM db_forum WHERE id_forum=$id");
    $rows = mysqli_fetch_array($sqli);

    $randomColor = function(){
        $colors = [
            '#554994','#F675A8','#F29393','#FFCCB3','#A7D2CB','#F2D388','#C98474','#874C62','#F4BFBF','#FFD9C0'
            ,'#FAF0D7','#8CC0DE','#68A7AD','#FFF89A'
        ];
        $rand = rand(0, count($colors) - 1);
        return isset($colors[$rand]) ? $colors[$rand] : $colors[0];
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
    <title>Forum Diskusi</title>
</head>
<body>
    <div class="page-header-container">
        <div class="page-title">
            <?php echo $rows['nama_mapel'] ?> | <?php echo $rows['nama_guru'] ?>
        </div>
        <div class="page-subtitle">
            kode kelas/jurusan
        </div>
    </div>
    <?php
        while($row = mysqli_fetch_array($sql)) :
    ?>
        <div class="content-container">
            <?php if($row['userid'] === $_SESSION['userid']){ ?>
                <div class="content" style="border-left: 4px solid rgb(0, 182, 206);">
            <?php } else { ?>
                <div class="content">
            <?php } ?>
                <div class="header-container">
                    <div class="icon-container">
                        <div class="icon" style="background-color: <?php echo $randomColor(); ?>"></div>
                    </div>
                    <div class="title-container">
                        <div class="title">
                            [Topik] <?php echo $rows['judul_forum']; ?> | <?php echo $rows['nama_guru']; ?>
                        </div>
                        <div class="username">
                            Dari: <?php echo $row['nama_user']; ?> - <?php echo $row['userid']; ?>
                        </div>
                    </div>
                </div>
                <div class="pesan-container">
                    <?php echo $row['pesan']; ?>
                </div>
                <div class="button-container">
                    <input type="button" value="Balas" class="reply">
                    <div class="input-pesan-container">
                        <textarea name="" id="" cols="30" rows="10" class="input-form" placeholder="Tuliskan Komentar.."></textarea><p>
                        <div class="kirim-container">
                           <button class='button-kirim'>Kirim</button> 
                        </div>
                    </div>
                </div>
            </div>
                <?php
                    $id_posting = $row['id_postingan'];
                    $sql_comment = mysqli_query($conn, "SELECT * FROM db_comment WHERE id_postingan=$id_posting");
                    while($comment = mysqli_fetch_array($sql_comment)):
                ?>
                <div class="comment-container">
                    <div class="header-container">
                        <div class="icon-container">
                                <div class="icon" style="background-color: <?php echo $randomColor(); ?>"></div>
                            </div>
                        <div class="title-container">
                            <div class="title">
                                [Topik] <?php echo $rows['judul_forum']; ?> | <?php echo $rows['nama_guru']; ?>
                            </div>
                            <div class="username">
                                Dari: <?php echo $comment['nama_user']; ?> - <?php echo $row['userid']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="pesan-container">
                        <?php echo $comment['comment']; ?>
                    </div>
                    <div class="button-container">
                    <input type="button" value="Balas" class="reply">
                    <div class="input-pesan-container">
                        <textarea name="" id="" cols="30" rows="10" class="input-form" placeholder="Tuliskan Komentar.."></textarea><p>
                        <div class="kirim-container">
                           <button class='button-kirim'>Kirim</button> 
                        </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
        </div>
    <?php endwhile;?>
</body>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.reply').click(function(){
            if ( this.value === 'Batal' ) {
                // if it's open close it
                open = false;
                this.value = 'Balas';
                $(this).next("div.input-pesan-container").slideUp("fast");
            }
            else {
                // if it's close open it
                open = true;
                this.value = 'Batal';
                $(this).siblings("[value='Batal']").click();
                $(this).next("div.input-pesan-container").slideDown("fast");
            }
        });
    });
</script>
</html>