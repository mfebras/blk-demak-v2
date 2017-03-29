<?php
	
	session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Aplikasi Pendaftaran dan Pengolahan Data Pelatihan Kerja</title>

   <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  		
	  		
		      <form class="form-login" action="../proses/admin/ganti_password.php" method="POST" >
		        <h2 class="form-login-heading">Ganti Password</h2>
		        <div class="login-wrap">
		        	<?php

			              if(isset($_SESSION['error'])){

			                echo "<div class=\"alert alert-danger\" style=\"margin-top:15px\">";
			                echo "<p>".$_SESSION['error']."</p>";
			                echo "</div>";


			                unset($_SESSION['error']);

			              }else if(isset($_SESSION['success'])){
			                echo "<div class=\"alert alert-success\" style=\"margin-top:15px\">";
			                echo "<p>".$_SESSION['success']."</p>";
			                echo "</div>";
			                unset($_SESSION['success']);

			              }

			            ?>
        			<input type="hidden" name="id" value="<?php echo $_SESSION['id-operator']; ?>">
		            <input type="password" class="form-control" name="password" placeholder="Password Baru">
		            <br>
		            <input type="password" class="form-control" name="password_confirm" placeholder="Konfirmasi Password">
		            <br>
		            <select name="jabatan" class="form-control" required>
	                    <option value="karyawan" selected>Staff / Ketua</option> 
	                    <option value="admin">Admin</option> 
	                 </select>
	                 <br>
		            <button class="btn btn-primary btn-block" type="submit">Kirim</button>
		            <hr>
		        </div>
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="../assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
