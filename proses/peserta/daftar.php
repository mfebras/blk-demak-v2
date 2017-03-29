<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

	require '../_send_email.php';

	session_start();

	$nama = $_POST['blk_nama'];
	$no_ktp = $_POST['no_ktp'];
	$telepon = $_POST['telepon'];
	$email = $_POST['blk_email'];
	$password = $_POST['blk_password'];
	$password_confirm = $_POST['blk_password_confirm'];
	$tanggal_daftar = date('Y-m-d');
	$status = "Belum konfirmasi";
	// tanda bahwa data peserta belum lengkap
	$flag = 0;

	// membuat token dengan fungsi dari file helper.php
	$timestamp = date('Ymd-His');
	// $random = rand_string(17);
	$token = $no_ktp ."-". $timestamp;
	$token = md5($token);

	$previous_page = $_POST['page'];

	// cek field kosong
	if (empty($nama) || empty($no_ktp) || empty($telepon) || empty($email) || empty($password)) {
		$_SESSION['error'] = "Formulir tidak lengkap.<br>
								Anda harus mengisi semua bagian yang kosong.";
		header("Location: ". ROOT . $previous_page .".php");
		die();
	}

	// mengecek duplikasi no ktp
	$check_ktp_sql = "SELECT no_ktp FROM peserta WHERE no_ktp = '$no_ktp'";
	$result = mysqli_query($connect, $check_ktp_sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	if ($row['no_ktp'] != null) {
		$_SESSION['error'] = "Nomor KTP Anda telah terdaftar sebagai peserta.";
		header("Location: ". ROOT . $previous_page .".php");
		die();
	}

	// cek password dan password confirm
	if($password === $password_confirm){
		$password = md5($password); 

		$sql = "INSERT INTO peserta (nama, no_ktp, telepon, email, password, tanggal_daftar, status, token, flag)
				VALUES ('$nama', '$no_ktp', '$telepon', '$email', '$password', '$tanggal_daftar', '$status', '$token', '$flag')";
		
		if (mysqli_query($connect, $sql)){
			// kirim notifikasi email
			$link = ROOT ."proses/peserta/aktivasi_akun.php?token=". $token;
			$subyek = "Pengaktifan Akun";
			$pesanEmail = "Dear, " .$nama. ".<br>
							Silakan klik link di bawah ini untuk mengaktifkan akun Anda.<br>
							<a href='". $link ."'>". $link ."</a><br>
							Anda dapat mendaftar pelatihan setelah aktivasi akun.<br><br>
							BLK Kabupaten Demak<br>
							Jl. Kantonsari No. 19 Demak (Belakang kantor BAPERMAS/PNPM)<br>
							0291-681718<br>
							blkdemak@gmail.com";

			$pesanSukses = "Pendaftaran sukses.<br>
							Silakan cek email Anda untuk mengaktifkan akun.";

			send_email($email, $nama, $subyek, $pesanEmail, $pesanSukses);
		}
		else {
			die("QUERY UPDATE FAILED : ". mysqli_error($connect));
			$_SESSION['error'] = "Pendaftaran Gagal.";
		}
		mysqli_close($connect);
	}
	else{
		$_SESSION['error'] = "Password dan Ulangi Password tidak sesuai.";
	}

	// redirect ke halaman sebelumnya
	header("Location: ". ROOT . $previous_page .".php");
	die();