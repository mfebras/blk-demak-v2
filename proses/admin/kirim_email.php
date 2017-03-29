<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

	require '../_send_email.php';
	require '../helper.php';

	session_start();

	$email = $_POST['email'];
	$jabatan = $_POST['jabatan'];

	$id_column = 'id_'. $jabatan;

	$check_sql = "SELECT $id_column FROM $jabatan WHERE email='$email'";
	$result = mysqli_query($connect, $check_sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	if ($row[$id_column] != null) {
		// membuat token
		$timestamp = date('Ymd-His');
		$random_string = rand_string(10);
		$token = $row[$id_column]. $random_string ."-". $timestamp;
		$token = md5($token);

		$id = $row[$id_column];
		$sql = "UPDATE $jabatan SET token='$token' WHERE $id_column=$id";
		if (mysqli_query($connect, $sql)){
			// kirim notifikasi email
			$link = ROOT ."proses/admin/cek_token.php?type=".$jabatan."&token=". $token;
			$subyek = "Ganti Password [".$jabatan."]";
			$pesanEmail = "	Silakan klik link di bawah ini untuk mengganti password Anda.<br>
							<a href='". $link ."'>". $link ."</a>
							<br><br>
							BLK Kabupaten Demak<br>
							Jl. Kantonsari No. 19 Demak (Belakang kantor BAPERMAS/PNPM)<br>
							0291-681718<br>
							blkdemak@gmail.com";

			$pesanSukses = "Silakan cek email Anda untuk mengganti password.<br>
							Apabila tidak ditemukan, silakan periksa spam.";

			send_email($email, $nama, $subyek, $pesanEmail, $pesanSukses);
		}
		else {
			die("QUERY UPDATE FAILED : ". mysqli_error($connect));
			$_SESSION['error'] = mysqli_error($connect);
		}
	}
	else {
		die("QUERY UPDATE FAILED : ". mysqli_error($connect));
		$_SESSION['error'] = "Email yang Anda masukkan belum terdaftar.";
	}
	mysqli_close($connect);

	// redirect ke halaman kirim_email
	header("Location: ". ROOT . "admin/login.php");
	die();