<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

    session_start();

	$id_peserta = $_POST['id_peserta'];
	$id_kejuruan = $_POST['id_kejuruan'];
	$kode_kejuruan = $_POST['kode_kejuruan'];
	$status = 1;	// belum dipanggil

	// mengecek kelengkapan data profil peserta
	$check_sql = "SELECT flag FROM peserta WHERE id = '$id_peserta'";
	$result = mysqli_query($connect, $check_sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	if ($row['flag'] == 0) {
		$_SESSION['error'] = "Data profil Anda belum lengkap.";
		header("Location: ". ROOT . "peserta/index.php#register");
		die();
	}

	// mengecek apakah peserta sudah daftar
	$check_sql = "SELECT status FROM registrasi_pelatihan WHERE id_peserta = '$id_peserta'";
	$result = mysqli_query($connect, $check_sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		// status = 1-4 => peserta sudah pernah dafar dan belum selesai pengumuman
		if ($row['status'] < 5) {
			$_SESSION['error'] = "Pendaftaran gagal.";
			$_SESSION['error-register'] = "Maaf, Anda tidak dapat mendaftar lebih dari satu kali.<br>
									Anda memiliki riwayat pendaftaran yang belum memiliki status <b>Lulus</b> atau <b>Tidak Lulus</b>.";
			header("Location: ". ROOT . "peserta/index.php#register");
			die();
		}
	}

	// membuat no. pendaftaran
	$tahun = date('y');
	$prefix = $kode_kejuruan.$tahun;

    $check_sql = "SELECT no_registrasi FROM registrasi_pelatihan WHERE id_kejuruan = '$id_kejuruan'";
	$result = mysqli_query($connect, $check_sql);
	// membuat no_urut
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	    preg_match("/^". $prefix .".*/", $row['no_registrasi'], $output_array);
	    if (!empty($output_array))
	    	$array_no[] = $output_array[0];
	}

	if (empty($array_no)) {
		$no_urut = 1;
	}
	else {
		rsort($array_no);
		// ambil 3 angka terakhir dari no_registrasi
		$no_urut = substr($array_no[0], 4);
		$no_urut += 1;
	}
	$no_urut = str_pad($no_urut, 3, '0', STR_PAD_LEFT);
	$no_registrasi = $prefix.$no_urut;
	$tanggal_registrasi = date('Y-m-d H:i:s');

	$sql = "INSERT INTO registrasi_pelatihan (no_registrasi, id_peserta, id_kejuruan, status, tanggal_registrasi)
			VALUES ('$no_registrasi', '$id_peserta', '$id_kejuruan', '$status', '$tanggal_registrasi')";
	if (mysqli_query($connect, $sql)){
		$_SESSION['success'] = 'Registrasi pelatihan sukses.';
		$_SESSION['success-registrasi'] = 'Registrasi pelatihan telah berhasil.<br>
											Silakan menunggu maksimal 1 pekan untuk mendapatkan jadwal pelatihan.<br>
											Jadwal pelatihan akan ditampilkan pada halaman Profil Saya pada menu Riwayat Pelatihan.';
	}
	else {
		die("QUERY UPDATE FAILED : ". mysqli_error($connect));
		$_SESSION['error'] = "Registrasi pelatihan gagal.";
	}
	mysqli_close($connect);

	// redirect ke halaman sebelumnya
	header("Location: ". ROOT . "peserta/index.php#register");
	die();