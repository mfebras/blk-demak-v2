<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

	session_start();

	$token = $_GET['token'];

	// $no_ktp = explode('-', $token);
	// $no_ktp = $no_ktp[0];

	// mengecek token
	$check_sql = "SELECT id FROM peserta WHERE token = '$token'";
	$result = mysqli_query($connect, $check_sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	if ($row['id'] != null) {
		$id = $row['id'];
		$sql = "UPDATE peserta SET status='Sudah konfirmasi', token='' WHERE id=$id";

		if (mysqli_query($connect, $sql)){
			$_SESSION['success'] = "Aktivasi akun telah berhasil.<br>
									Silakan login menggunakan akun Anda.";
		}
		else {
			die("QUERY UPDATE FAILED : ". mysqli_error($connect));
			$_SESSION['error'] = "Aktivasi akun gagal.";
		}
		mysqli_close($connect);
	}
	else{
		$_SESSION['error'] = "Token telah kadaluarsa.<br>
							Silakan hubungi pihak BLK Kabupaten Demak untuk proses aktivasi.";
	}

	// redirect ke beranda
	header("Location: ". ROOT);
	die();