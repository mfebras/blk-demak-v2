<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

	session_start();

	$id_peserta = $_SESSION['id-peserta'];

	$id_data_kerja = $_POST['id_data_kerja'];
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
		header("Location: ". ROOT . "peserta/ubah_data_kerja.php");
		die();
	}
	else {
		if ($status_kerja == "Belum") {
			$sql = "UPDATE data_kerja
					SET status_kerja='$status_kerja', jenis_pekerjaan='',
						nama_perusahaan='', alamat_perusahaan='',
						telepon_perusahaan=''
					WHERE id_data_kerja=$id_data_kerja AND id_peserta=$id_peserta";
		}
		else {
			$sql = "UPDATE data_kerja
					SET status_kerja='$status_kerja', jenis_pekerjaan='$jenis_pekerjaan',
						nama_perusahaan='$nama_perusahaan', alamat_perusahaan='$alamat_perusahaan',
						telepon_perusahaan='$telepon_perusahaan'
					WHERE id_data_kerja=$id_data_kerja AND id_peserta=$id_peserta";
		}

		if (mysqli_query($connect, $sql)){
			$_SESSION['success'] = "Ubah data kerja sukses.";
			mysqli_close($connect);
			
			// redirect ke form peserta/index
			header("Location: ". ROOT . "peserta/index.php#job");
			die();
		}
		else {
			die("QUERY UPDATE FAILED : ". mysqli_error($connect));
			$_SESSION['error'] = "Ubah data kerja gagal.";

			// redirect ke form tambah_data_kerja
			header("Location: ". ROOT . "peserta/ubah_data_kerja.php");
			die();
		}
	}