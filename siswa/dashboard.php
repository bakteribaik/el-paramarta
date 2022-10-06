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
    }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dash_siswa.css">
    <link href='../fullcalendar/main.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Elearning SMK Paramarta | Dashboard</title>
</head>
<body>
    <div class="sidebar">
            <div class="sidebar-title">
                Elearning
            </div>
            <div class="sidebar-subtitle">
                SMK Paramarta
            </div>
            <div class="sidebar-menu-container">
                <div class="menu-container">
                    <div class="menu-logo-container">
                        <div class="menu-logo">
                            <i class="material-icons">apps</i>
                        </div>
                    </div>
                    <div class="menu-title">
                        <a href="">Dashboard</a>
                    </div>
                </div>
                <div class="menu-container">
                    <div class="menu-logo-container">
                        <div class="menu-logo">
                            <i class="material-icons">waving_hand</i>
                        </div>
                    </div>
                    <div class="menu-title">
                        <a href="../validation/logout.php">Keluar</a>
                    </div>
                </div>
            </div>

        <div class="mapel-title-container">
            <div class="mapel-title">
                Mata Pelajaran
            </div>
        </div>

        <?php
            $jurusan = $_SESSION['jurusan'];
            $sql = mysqli_query($conn, "SELECT * FROM db_mapel WHERE kode_jurusan='$jurusan' ");
            while($row = mysqli_fetch_array($sql)): //nampilin semua mapel sesuai kode_jurusan
        ?>
        <div class="mapel-container">
            <div class="mapel-logo" style="background-color: <?php echo $randomColor(); ?>">
            </div>
            <div class="mapel-detail-container">
                <div class="nama-mapel">
                    <?php echo $row['nama_mapel']?> <!-- tampil nama mapel-->
                </div>
                <div class="mapel-guru">
                <?php echo $row['nama_guru']?> <!-- tampil nama guru-->
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <div class="content-container">
        <div class="content">
            <canvas id="myChart" width="250" height="50"></canvas>
            <div class="scrollable-container">
                <div class="daring-header">
                    Kelas online yang tersedia saat ini
                </div>

                <?php
                    $jurusan = $_SESSION['jurusan'];
                    $sql = mysqli_query($conn, "SELECT * FROM db_forum WHERE kode_jurusan='$jurusan' ORDER BY status_forum='OPEN' DESC");
                    while($row = mysqli_fetch_array($sql)):
                ?>

                <div class="daring-parent-container">
                    <div class="daring-detail-container">
                        <div class="daring-logo-container" style="background-color: <?php echo $randomColor(); ?>"></div>
                        <div class="detail-container">
                            <div class="nama-guru">
                                <?php echo $row['nama_guru']?> | <?php echo $row['nama_mapel']?> | 04 Oktober 2022
                            </div>
                            <div class="daring-detail">
                                <span class="judul-daring">
                                    <?php
                                        if ($row['status_forum'] == "OPEN"){
                                    ?>
                                        <a href="../pages/forum.php?id=<?php echo $row['id_forum']?>"><?php echo $row['judul_forum']?></a>
                                    <?php } else { ?>
                                        <?php echo $row['judul_forum']?>
                                    <?php } ?>
                                    <?php
                                        if ($row['status_forum'] == "OPEN"){
                                    ?>
                                        <span class='forum-status-online'>
                                            Open
                                        </span>
                                    <?php } else { ?>
                                        <span class='forum-status-offline'>
                                            Close
                                        </span>
                                    <?php } ?>
                                </span>
                                <br>
                                <span class="deskripsi-daring"><?php echo $row['deskripsi_forum']?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile;?>

            </div>
        </div>
        <div class="content-kanan">
            <div class="topbar-kanan-container">
                <div class="topbar-title">
                    <a href=""><?php echo $_SESSION['name']?></a>
                </div>
                <div class="topbar-profile">

                </div>
            </div>
            <div class="online-header">
                Siswa Online
            </div>
            <div class="online-container">
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM db_siswa WHERE statuses='ONLINE' ORDER BY userid ASC");    
                    if (mysqli_num_rows($sql) > 0) {
                        while ($row = mysqli_fetch_array($sql)) {
                            if ($row['userid'] == $_SESSION['userid']) {
                                echo '👉 ';
                            }
                            echo $row['nama_user'];
                            echo ' - ';
                            echo $row['userid'];
                            echo ' - ';
                            echo $row['kode_jurusan'];
                            echo '<br>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels = [
    'Awal',
    'Semester 1',
    'Semester 2',
    'Semester 3',
    'Semester 4',
    'Semester 5',
    'Semester 6',
    'Semester 7',
    'Semester 8',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Rata - Rata Nilai Setiap Semester',
      backgroundColor: 'rgb(69, 61, 110)',
      borderColor: 'rgb(69, 61, 110)',
      data: [0, 80, 75, 80, 95, 85, 75, 100, 90],
      tension: 0.1,
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
        
    }
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

</html>

