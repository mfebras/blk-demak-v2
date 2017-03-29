<?php
  require_once ('../.env.php');
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
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet"> 

    <!-- Custom styles for this template -->
    <link href="../assets/css/blk-demak.css" rel="stylesheet">
    <!-- <link href="assets/css/style-responsive.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
  </head>

  <body style="background-color: #f0f0f0;">

    <header>
      <div class="header-top">
        <p class="text-center" style="margin-bottom: 0px;">Aplikasi Pendaftaran dan Pengolahan Data Pelatihan Kerja</p>
      </div>
    </header>

    <div class="col-sm-4 col-sm-offset-4" style="margin-top: 110px;">
    <div class="panel panel-default">
		<div class="panel-heading" style="background-color: #e9e9e9;">
			<h4 class="panel-title">Ganti Password</h4>
		</div>
		<div class="panel-body">
			<form action="<?php echo ROOT; ?>proses/peserta/ganti_password.php" method="POST">
        <input type="hidden" name="id" value="<?php session_start(); echo $_SESSION['id-peserta']; ?>">
				<div class="form-group">
          <label>Password baru*</label>
					<input class="form-control" type="password" name="blk_password" placeholder="Password" required autofocus>
				</div>
        <div class="form-group">
          <label>Ulangi Password*</label>
          <input class="form-control" type="password" name="blk_password_confirm" placeholder="Password" required>
        </div>
				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Kirim">
				</div>
			</form>
		</div>
	</div>

  </body>
</html>