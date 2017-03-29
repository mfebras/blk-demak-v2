<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

	session_start();

	$email = $_POST['blk_email'];
	$password = $_POST['blk_password'];

	$previous_page = $_POST['page'];
	// mengecek password
	$get_pass_sql = "SELECT id, password, status FROM peserta WHERE email = '$email'";
	$result = mysqli_query($connect, $get_pass_sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	$password = md5($password);

	if (isset($row['password']) && $row['password'] == $password) {
		if (($row['status']) == "Sudah konfirmasi") {
			$_SESSION['success'] = "Login sukses.";
			$_SESSION['login-peserta'] = true;
			$_SESSION['id-peserta'] = $row['id'];
			$_SESSION['status-peserta'] = $row['status'];
		}
		else {
			$_SESSION['error'] = "Anda belum mengaktifkan akun.<br>
									Silakan cek email Anda untuk aktivasi.";
		}
	} else {
		$_SESSION['error'] = "Email atau password tidak benar.";
	}
	
	// redirect ke halaman profil
	header("Location: ". ROOT . "peserta/index.php");
	die();