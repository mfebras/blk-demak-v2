<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');

	session_start();

	$id = $_POST['id'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	$table = $_POST['jabatan'];
	$id_column = 'id_'. $table;

	if ($password === $password_confirm) {
		$password = md5($password);

		$sql = "UPDATE $table SET password='$password', token='' WHERE $id_column='$id'";
// var_dump($sql); die();
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
	header("Location: ../../admin/login.php");
	die();