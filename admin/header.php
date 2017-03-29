<?php
  session_start();

  if(!isset($_SESSION['login'])){

    header("Location: login.php");

  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Muhammad Syarifuddin Latief">
    <meta name="keyword" content="balai, latihan, kerja">

    <title>Administrator Aplikasi Pendaftaran dan Pengolahan Data Pelatihan Kerja</title>

    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css"/>
 
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
    <link href="../assets/css/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" />
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style type="text/css">
      .message .badge{
        margin-left: 5px;
        background-color: #fff;
        color: #ffb300;
        padding-left: 9px;
        padding-right: 9px;
      }
    </style>
  </head>

  <body>

    <!-- CONTAINER START -->
    <section id="container" >
      <!--header start-->
      <header class="header black-bg">
        <div class="sidebar-toggle-box">
          <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>

        <!--logo start-->
        <a href="index.html" class="logo"><b> Administrator Aplikasi Pendaftaran dan Pengolahan Data Pelatihan Kerja</b></a>
        <!--logo end-->

        <div class="top-menu">
          <ul class="nav pull-right top-menu">
            <li>

              <div class="dropdown" style="margin:10px">
                <button class="btn btn-default dropdown-toggle" type="button" id="tombol_akun" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Pengaturan
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <li><a href="ubah_akun.php">Pengaturan Akun</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="../proses/admin/logout.php">Logout</a></li>
                </ul>
              </div>

            </li>
          </ul>
        </div>
      </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
        <div id="sidebar"  class="nav-collapse ">
          <!-- sidebar menu start-->
          <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href="ubah_akun.php"><img src="../assets/img/admin.png" class="img-circle" width="60"></a></p>
            <h5 class="centered"><?php echo $_SESSION['nama'];?></h5>

            <li class="mt">
              <a href="index.php">
                <i class="fa fa-home"></i>
                <span>Beranda</span>
              </a>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" >
                <i class="fa fa-database"></i>
                <span>Data - Data</span>
              </a>
              <ul class="sub">
      
                <li><a  href="data_kejuruan.php">Data Kejuruan</a></li>
                <li><a  href="data_peserta.php">Data Peserta</a></li>
                <li><a  href="data_jadwal.php">Data Jadwal</a></li>
                <li><a  href="data_register.php">Data Register</a></li>
                <?php

                  if($_SESSION['jabatan']=='admin'){
                    echo "<li><a  href=\"data_karyawan.php\">Data Karyawan</a></li>";
                  }

                ?>
                
                <!-- <li><a  href="panels.html">Data Sesi</a></li>
                <li><a  href="general.html">Data Program</a></li> -->
              </ul>
            </li>

            <!-- <li class="sub-menu">
              <a href="javascript:;" >
                <i class=" fa fa-bar-chart-o"></i>
                <span>Laporan - Laporan</span>
              </a>
              <ul class="sub">
                <li><a  href="calendar.html">Laporan Peserta</a></li>
                <li><a  href="gallery.html">Laporan Ruang</a></li>
                <li><a  href="todo_list.html">Laporan Sesi</a></li>
                <li><a  href="todo_list.html">Laporan Daftar Pelatihan</a></li>
              </ul>
            </li> -->

            <li>
              <a href="laporan.php">
                <i class="fa fa-file"></i>
                <span>Laporan</span>
              </a>
            </li>

            <li class="message">
              <a href="pesan.php">
                <i class="fa fa-envelope"></i>
                <span>Pesan</span>
              </a>
            </li>

            <?php

              if($_SESSION['jabatan']=='admin'){

                echo "<li>
                      <a href=\"ekspor.php\">
                        <i class=\"fa fa-database\"></i>
                        <span>Ekspor Basis Data</span>
                      </a>
                    </li>";
                
              }

            ?>
            
            
            
          </ul>
        <!-- sidebar menu end-->
        </div>
      </aside>
      <!--sidebar end-->