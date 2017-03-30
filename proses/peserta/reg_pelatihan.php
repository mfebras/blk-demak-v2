<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
    require_once ('../../.env.php');

    session_start();

    // data diri
	$no_ktp = $_POST['no_ktp'];
	$nama = $_POST['blk_nama'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$tempat_lahir = $_POST['tempat_lahir'];

	$tanggal = strtotime($_POST['tanggal_lahir']);
	$tanggal_lahir = date('Y-m-d', $tanggal);

	$agama = $_POST['agama'];
	$alamat = $_POST['alamat'];
	$kecamatan = $_POST['kecamatan'];
	$telepon = $_POST['telepon'];
	$pendidikan_terakhir = $_POST['pendidikan_terakhir'];
	$sumber_info = $_POST['sumber_info'];

    // registrasi
	$id_kejuruan = $_POST['kejuruan'];
	$kode_kejuruan = $_POST['kode_kejuruan'];

	// cek field kosong
	if (empty($nama) || empty($no_ktp) || empty($telepon) || empty($alamat) || empty($kecamatan) ||
		empty($jenis_kelamin) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($agama) ||
		empty($pendidikan_terakhir) || empty($sumber_info) || empty($id_kejuruan) || empty($kode_kejuruan)) {
		$_SESSION['error-register'] = "Formulir tidak lengkap.<br>
								Anda harus mengisi semua bagian yang kosong.";
		header("Location: ". ROOT . "reg_pelatihan.php");
		die();
	}

	// mengecek duplikasi no ktp
	$check_ktp_sql = "SELECT id, no_ktp FROM peserta WHERE no_ktp = '$no_ktp'";
	$result = mysqli_query($connect, $check_ktp_sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	// jika sudah pernah daftar (data peserta sudah ada)
	if ($row['no_ktp'] != null) {
		$id_peserta = $row['id'];

		// update data peserta
		$sql = "UPDATE peserta
				SET nama='$nama', jenis_kelamin='$jenis_kelamin',
					tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', agama='$agama',
					alamat = '$alamat', kecamatan = '$kecamatan', telepon='$telepon',
					pendidikan_terakhir='$pendidikan_terakhir', sumber_info='$sumber_info'
				WHERE id=$id_peserta";
		mysqli_query($connect, $sql);

		// registrasi pelatihan
		$no_registrasi = createNoRegister($connect, $id_kejuruan, $kode_kejuruan);
		register($connect, $no_registrasi, $id_peserta, $id_kejuruan);
	}
	else {
		// insert data peserta
		$sql = "INSERT INTO peserta (nama, no_ktp, jenis_kelamin, tempat_lahir, tanggal_lahir,
					agama, alamat, kecamatan, telepon, pendidikan_terakhir, sumber_info)
				VALUES ('$nama', '$no_ktp', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$agama',
						'$alamat', '$kecamatan', '$telepon', '$pendidikan_terakhir', '$sumber_info')";
		if (mysqli_query($connect, $sql)){
			$id_peserta_2 = mysqli_query( "SELECT LAST_INSERT_ID()" );
			$sql = "SELECT id FROM peserta ORDER BY id DESC LIMIT 1";
			$result = mysqli_query($connect, $sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$id_peserta = $row['id'];
		}
		// registrasi pelatihan
		$no_registrasi = createNoRegister($connect, $id_kejuruan, $kode_kejuruan);
		register($connect, $no_registrasi, $id_peserta, $id_kejuruan);
	}

	mysqli_close($connect);
	// redirect ke halaman sebelumnya
	header("Location: ". ROOT . "reg_pelatihan.php");
	die();


	// Fungsi-fungsi
	function createNoRegister($connect, $id_kejuruan, $kode_kejuruan){
		// membuat no. pendaftaran
		$tahun = date('y');
		$prefix = $kode_kejuruan.$tahun;

	    $check_sql = "SELECT no_registrasi FROM registrasi_pelatihan WHERE id_kejuruan='$id_kejuruan'";
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

		return $no_registrasi;
	}

	function register($connect, $no_registrasi, $id_peserta, $id_kejuruan){
		$tanggal_registrasi = date('Y-m-d H:i:s');

		$sql = "INSERT INTO registrasi_pelatihan (no_registrasi, id_peserta, id_kejuruan, tanggal_registrasi)
				VALUES ('$no_registrasi', '$id_peserta', '$id_kejuruan', '$tanggal_registrasi')";

		if (mysqli_query($connect, $sql)){
			$_SESSION['success'] = 'Registrasi pelatihan sukses.';
			$_SESSION['success-register'] = 'Registrasi pelatihan telah berhasil.';
		}
		else {
			$_SESSION['error'] = "Registrasi pelatihan gagal.";
			$_SESSION['error-register'] = mysqli_error($connect);
		}
	}