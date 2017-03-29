<?php
	
	require_once ('../koneksi_db.php');
	require_once ('../convert_date.php');

	session_start();



	$angkatan = $_POST['angkatan'];
	$id_kejuruan = $_POST['kejuruan'];
	$sumber_dana = $_POST['sumber_dana'];
	$kapasitas = $_POST['kapasitas'];
	$seleksi_awal = $_POST['seleksi_awal'];
	$seleksi_akhir = $_POST['seleksi_akhir'];
	$pelatihan_awal = $_POST['pelatihan_awal'];
	$pelatihan_akhir = $_POST['pelatihan_akhir'];

	$seleksi_awal = convertDate($seleksi_awal, 'Y-m-d');
	$seleksi_akhir = convertDate($seleksi_akhir, 'Y-m-d');
	$pelatihan_awal = convertDate($pelatihan_awal, 'Y-m-d');
	$pelatihan_akhir = convertDate($pelatihan_akhir, 'Y-m-d');

	$query_insert = mysqli_query($connect, "INSERT INTO jadwal (angkatan, id_kejuruan, 
		sumber_dana, kapasitas, seleksi_awal, seleksi_akhir, pelatihan_awal, pelatihan_akhir)  
		values ('".$angkatan."', '".$id_kejuruan."', '".$sumber_dana."', '".$kapasitas."',
			'".$seleksi_awal."', '".$seleksi_akhir."', '".$pelatihan_awal."', '".$pelatihan_akhir."')"); 

	if(!$query_insert){

		die("QUERY INSERT JADWAL FAILED : ". mysqli_error($connect));	

	}

	$_SESSION['success'] = "Tambah jadwal sukses!";

	header("Location: ../../admin/data_jadwal.php");



	