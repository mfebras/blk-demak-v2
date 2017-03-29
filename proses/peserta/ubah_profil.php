<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

	session_start();

	$id = $_POST['id_peserta'];
	$no_ktp = $_POST['no_ktp'];
	$nama = $_POST['blk_nama'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$tempat_lahir = $_POST['tempat_lahir'];

	$tanggal = strtotime($_POST['tanggal_lahir']);
	$tanggal_lahir = date('Y-m-d', $tanggal);

	$agama = $_POST['agama'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['telepon'];
	$email = $_POST['blk_email'];
	$pendidikan_terakhir = $_POST['pendidikan_terakhir'];
	$sumber_info = $_POST['sumber_info'];

	$password = $_POST['blk_password'];
	$password_confirm = $_POST['blk_password_confirm'];
	// tanda bahwa data peserta sudah lengkap
	$flag = 1;

	// cek field kosong
	if (empty($nama) || empty($no_ktp) || empty($telepon) || empty($email) || empty($alamat) ||
		empty($jenis_kelamin) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($agama) ||
		empty($pendidikan_terakhir) || empty($sumber_info)) {
		$_SESSION['error'] = "Formulir tidak lengkap.<br>
								Anda harus mengisi semua bagian yang kosong.";
		header("Location: ". ROOT . "peserta/ubah_profil.php");
		die();
	}

	// password dan password confirm tidak sama
	if (($password != "") && ($password != $password_confirm)) {
		$_SESSION['error'] = "Password dan Ulangi Password tidak sesuai.";
		header("Location: ". ROOT . "peserta/ubah_profil.php");
		die();
	}
	elseif (($password != "") && ($password === $password_confirm)) {
		// enkripsi password
		$password = md5($password);
		// update data (ganti password)
		$sql = "UPDATE peserta
				SET no_ktp='$no_ktp', nama='$nama', jenis_kelamin='$jenis_kelamin',
					tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', agama='$agama',
					alamat = '$alamat', telepon='$telepon', email='$email', pendidikan_terakhir='$pendidikan_terakhir',
					sumber_info='$sumber_info', password='$password', flag='$flag'
				WHERE id=$id";
	}
	else {
		// update data
		$sql = "UPDATE peserta
				SET no_ktp='$no_ktp', nama='$nama', jenis_kelamin='$jenis_kelamin',
					tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', agama='$agama',
					alamat = '$alamat', telepon='$telepon', email='$email', pendidikan_terakhir='$pendidikan_terakhir',
					sumber_info='$sumber_info', flag='$flag'
				WHERE id=$id";
	}

	if (mysqli_query($connect, $sql)){
		$_SESSION['success'] = "Ubah profil sukses.";
		header("Location: ". ROOT . "peserta/");
		die();
	} else {
		die("QUERY UPDATE FAILED : ". mysqli_error($connect));
		$_SESSION['error'] = "Ubah profil gagal.";
	}
	mysqli_close($connect);