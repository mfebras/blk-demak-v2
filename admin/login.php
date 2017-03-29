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
	  		
	  		
		      <form class="form-login" action="../proses/admin/cek_login.php" method="POST" >
		        <h2 class="form-login-heading">Login Area</h2>
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
		            <input type="text" class="form-control" name="email" placeholder="Email" autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" placeholder="Password">
		            <br>
		            <select name="jabatan" class="form-control" required>
			                    
	                    <option value="staff" selected>Staff / Ketua</option> 
	                    <option value="admin">Admin</option> 
	                    
	                    
	                 </select>
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Lupa Password?</a>
		
		                </span>
		            </label>
		            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-lock"></i> Login</button>
		            <hr>
		            
		            
		
		        </div>
		
		          
		
		      </form>	  	
	  	
	  	</div>
	  </div>


	  <!-- Modal -->
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Lupa Password</h4>
                  </div>
                  <div class="modal-body col-sm-12">
                      <form class="form-horizontal style-form" action="../proses/admin/kirim_email.php" method="POST">
			              
			              <div class="form-group">
			                <label class="col-sm-4 control-label">Email</label>
			                <div class="col-sm-8">
			                  <input type="email" name="email" class="form-control" placeholder="Email" required >
			                </div>
			              </div>

			              <div class="form-group">
			                <label class="col-sm-4 control-label">Jabatan</label>
			                <div class="col-sm-8">
			                  <select name="jabatan" class="form-control" required>
			                    
			                    <option value="karyawan" selected>Staff / Ketua</option> 
			                    <option value="admin">Admin</option> 
			                    
			                    
			                  </select>
			                </div>
			              </div>

	                  </div>
	                  <div class="modal-footer">
	                      <button data-dismiss="modal" class="btn btn-danger" type="button">Batal</button>
	                      <input class="btn btn-primary" type="submit" value="Kirim">
	                  </div>
                  </form>
              </div>
          </div>
      </div>
      <!-- modal -->

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
