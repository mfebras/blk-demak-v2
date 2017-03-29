<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

	require '../_send_email.php';

	session_start();

	$email = $_POST['blk_email'];

	$check_sql = "SELECT id, no_ktp, nama FROM peserta WHERE email = '$email'";
	$result = mysqli_query($connect, $check_sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	if ($row['no_ktp'] != null) {
		// membuat token
		$timestamp = date('Ymd-His');
		$token = $row['no_ktp'] ."-". $timestamp;
		$token = md5($token);

		$id = $row['id'];
		$sql = "UPDATE peserta SET token='$token' WHERE id=$id";

		if (mysqli_query($connect, $sql)){
			// kirim notifikasi email
			$link = ROOT ."proses/peserta/cek_token.php?token=". $token;
			$subyek = "Ganti Password";
			$pesanEmail = "Dear, " .$row['nama']. ".<br>
							Silakan klik link di bawah ini untuk mengganti password Anda.<br>
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
	header("Location: ". ROOT . "peserta/kirim_email.php");
	die();