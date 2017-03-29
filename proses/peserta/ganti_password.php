<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

	session_start();

	$id = $_POST['id'];
	$password = $_POST['blk_password'];
	$password_confirm = $_POST['blk_password_confirm'];

	if ($password === $password_confirm) {
		$password = md5($password);

		$sql = "UPDATE peserta SET password='$password', token='' WHERE id=$id";

		if (mysqli_query($connect, $sql)){
			$_SESSION['success'] = "Ganti password sukses.";
		}
		else {
			die("QUERY UPDATE FAILED : ". mysqli_error($connect));
			$_SESSION['error'] = "Ganti password gagal.";
		}
		mysqli_close($connect);
	}
	else {
		$_SESSION['error'] = "Password dan Ulangi Password tidak sesuai.";
	}

	// redirect ke halaman beranda
	header("Location: ". ROOT);
	die();