<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

	session_start();

	$id_peserta = $_POST['id_peserta'];
	$status_kerja = $_POST['status_kerja'];
	$jenis_pekerjaan = $_POST['jenis_pekerjaan'];
	$nama_perusahaan = $_POST['nama_perusahaan'];
	$alamat_perusahaan = $_POST['alamat_perusahaan'];
	$telepon_perusahaan = $_POST['telepon_perusahaan'];
	$tanggal = date('Y-m-d H:i:s');

	if (($status_kerja == "Sudah") && (empty($jenis_pekerjaan) || empty($nama_perusahaan) ||
		empty($alamat_perusahaan) || empty($telepon_perusahaan))) {
		$_SESSION['error'] = "Formulir tidak lengkap.<br>
								Anda harus mengisi semua bagian yang kosong.";
		// redirect ke form tambah_data_kerja
		header("Location: ". ROOT . "peserta/tambah_data_kerja.php");
		die();
	}
	else {
		$sql = "INSERT INTO data_kerja (id_peserta, status_kerja, jenis_pekerjaan, nama_perusahaan,
							alamat_perusahaan, telepon_perusahaan, date_created)
				VALUES ('$id_peserta', '$status_kerja', '$jenis_pekerjaan', '$nama_perusahaan', '$alamat_perusahaan', '$telepon_perusahaan', '$tanggal')";
		if (mysqli_query($connect, $sql)){
			$_SESSION['success'] = "Tambah data kerja sukses.";
			// redirect ke form peserta/index
			header("Location: ". ROOT . "peserta/index.php#job");
			die();
		}
		else {
			die("QUERY UPDATE FAILED : ". mysqli_error($connect));
			$_SESSION['error'] = "Tambah data kerja gagal.";
			// redirect ke form tambah_data_kerja
			header("Location: ". ROOT . "peserta/tambah_data_kerja.php");
			die();
		}
		mysqli_close($connect);
	}