<?php
    $id_forum = $_GET['id'];
    $query_forum = mysqli_query($conn, "SELECT * FROM db_forum WHERE id_forum=$id_forum");
    $header = mysqli_fetch_array($query_forum);

    if (isset($_POST['kirim-comment'])) {
        $idparent = $_POST['idparent'];
        $text = $_POST['input-comment'];
        $userid = $_SESSION['userid'];
        $name = $_SESSION['name'];

        if ($text != '' && $_FILES['upload-file'] != NULL) { //jika text ada isi dan attachment ada isi
            $random = rand(0, 999999);
            $files = $_FILES['upload-file'];
            $file_dir = '../uploads/'.$random."_".$files['name'];
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text', '$file_dir')");
        }else if($text == '' && $_FILES['upload-file'] != NULL){ //jika text gak ada isi dan attachment ada isi
            $random = rand(0, 999999);
            $files = $_FILES['upload-file'];
            $file_dir = '../uploads/'.$random."_".$files['name'];
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$file_dir')");
        }else{
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text')");
        }
    }

    if (isset($_POST['kirim-sub-comment'])) {
        $idparent = $_POST['subidparent'];
        $text = $_POST['input-subcomment'];
        $userid = $_SESSION['userid'];
        $name = $_SESSION['name'];

        if ($text != '' && $_FILES['upload-file'] != NULL) { //jika text ada isi dan attachment ada isi
            $random = rand(0, 999999);
            $files = $_FILES['upload-file'];
            $file_dir = '../uploads/'.$random."_".$files['name'];
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text', '$file_dir')");
        }else if($text == '' && $_FILES['upload-file'] != NULL){ //jika text gak ada isi dan attachment ada isi
            $random = rand(0, 999999);
            $files = $_FILES['upload-file'];
            $file_dir = '../uploads/'.$random."_".$files['name'];
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name','$file_dir')");
        }else{
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text')");
        }
    }

    if (isset($_POST['kirim-subsub-comment'])) {
        $idparent = $_POST['subsubidparent'];
        $text = $_POST['input-subsubcomment'];
        $userid = $_SESSION['userid'];
        $name = $_SESSION['name'];

        if ($text != '' && $_FILES['upload-file'] != NULL) { //jika text ada isi dan attachment ada isi
            $random = rand(0, 999999);
            $files = $_FILES['upload-file'];
            $file_dir = '../uploads/'.$random."_".$files['name'];
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text', '$file_dir')");
        }else if($text == '' && $_FILES['upload-file'] != NULL){ //jika text gak ada isi dan attachment ada isi
            $random = rand(0, 999999);
            $files = $_FILES['upload-file'];
            $file_dir = '../uploads/'.$random."_".$files['name'];
            move_uploaded_file($files['tmp_name'], $file_dir);
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, file_dir) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$file_dir')");
        }else{
            mysqli_query($conn, "INSERT INTO db_postingan (id_parent, id_forum, userid, nama_user, pesan) VALUES ('$idparent', '$id_forum', '$userid', '$name', '$text')");
        }
    }
?>