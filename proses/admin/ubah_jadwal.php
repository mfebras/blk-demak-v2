<?php
	
	require_once ('../koneksi_db.php');
	require_once ('../convert_date.php');

	session_start();

	$id 			= $_GET['id'];
	$id_kejuruan 	= $_POST['kejuruan'];
	$angkatan 		= $_POST['angkatan'];
	$kapasitas 		= $_POST['kapasitas'];
	$sumber_dana 	= $_POST['sumber_dana'];
	$status 	= $_POST['status'];

	$seleksi_awal 	= $_POST['seleksi_awal'];
	$seleksi_akhir 	= $_POST['seleksi_akhir'];
	$pelatihan_awal = $_POST['pelatihan_awal'];
	$pelatihan_akhir = $_POST['pelatihan_akhir'];

	$seleksi_awal 	= convertDate($seleksi_awal, 'Y-m-d');
	$seleksi_akhir 	= convertDate($seleksi_akhir, 'Y-m-d');
	$pelatihan_awal = convertDate($pelatihan_awal, 'Y-m-d');
	$pelatihan_akhir = convertDate($pelatihan_akhir, 'Y-m-d');


	$query_update = mysqli_query($connect, "UPDATE jadwal SET id_kejuruan='".$id_kejuruan."', 
					angkatan='".$angkatan."', kapasitas='".$kapasitas."',status_pelaksanaan='".$status."',
					sumber_dana='".$sumber_dana."', seleksi_awal='".$seleksi_awal."', 
					seleksi_akhir='".$seleksi_akhir."', pelatihan_awal='".$pelatihan_awal."',
					pelatihan_akhir='".$pelatihan_akhir."' WHERE id_jadwal=$id ");

	if(!$query_update){

		die("QUERY UPDATE FAILED : ". mysqli_error($connect));

	}

	$_SESSION['success'] = "Ubah jadwal sukses!";



	header("Location: ../../admin/data_jadwal.php");

