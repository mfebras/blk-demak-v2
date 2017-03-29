<?php
  require_once ('.env.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="description" content="Pendaftaran dan Pengolahan Data Pelatihan Kerja Kabupaten Demak, BLK">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Aplikasi Pendaftaran dan Pengolahan Data Pelatihan Kerja</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet"> 

    <!-- Custom styles for this template -->
    <link href="assets/css/blk-demak.css" rel="stylesheet">
    <!-- <link href="assets/css/style-responsive.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
  </head>

  <body>

    <header>
      <div class="header-top">
        <p class="text-center" style="margin-bottom: 0px;">Aplikasi Pendaftaran dan Pengolahan Data Pelatihan Kerja</p>
      </div>

      <div class="header-middle">
        <div class="container valign-wrapper">
              <div class="brand">
                <a href="index.php"><img src="assets/img/logo.png"></a>
              </div>

              <div class="brand-title">
                <h4>
                  Unit Pelaksana Teknis Balai Latihan Kerja<br>
                  Dinas Tenaga Kerja dan Perindustrian<br>
                  Pemerintah Kabupaten Demak
                </h4>
              </div>
<?php
  // check is user logged in?
  session_start();
  if (!isset($_SESSION['login-peserta'])) {
?>
              <div class="auth valign">
                <button class="login-btn" data-tab="login" data-toggle="modal" data-target="#modal-auth">Login</button>
                <button class="signup-btn" data-tab="register" data-toggle="modal" data-target="#modal-auth">Daftar</button>
              </div>
<?php
  }   /* end of check login*/
?>
        </div>
      </div>

      <div class="header-bottom">
        <div class="container">
          <nav class="navbar navbar-collapse collapse pull-left">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo ROOT; ?>index.php">Beranda</a></li>
              <li><a href="<?php echo ROOT; ?>jadwal.php">Lihat Jadwal dan Jenis Pelatihan</a></li>
              <li><a href="<?php echo ROOT; ?>hasil_seleksi.php">Pengumuman Hasil Seleksi</a></li>
              <li><a href="<?php echo ROOT; ?>tentang.php">Tentang</a></li>
              <li><a href="<?php echo ROOT; ?>kontak.php">Kontak</a></li>
            </ul>
          </nav>
<?php
  // check is user logged in?
  if (isset($_SESSION['login-peserta'])) {
?>
          <div class="dropdown pull-right">
            <button id="profile-menu" class="login-btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Profil
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="profile-menu">
              <li><a href="<?php echo ROOT; ?>peserta/index.php">Profil Saya</a></li>
              <li><a href="<?php echo ROOT; ?>proses/peserta/logout.php">Logout</a></li>
            </ul>
          </div>
<?php
  }   /* end of check login*/
?>
        </div>
      </div>
    </header>