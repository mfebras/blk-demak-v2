<?php
	
	require_once ('../koneksi_db.php');

	session_start();

	$id_registrasi = $_GET['id'];
	$status = $_POST['status'];
	$prev_page = $_GET['prev_page'];

	if($prev_page=='detail_jadwal'){
		$id = $_GET['id_jadwal'];
		$redirect = 'detail_jadwal.php?id='.$id; 
	}else{
		$redirect = 'data_register.php'; 
	}
	

	$query_update = mysqli_query($connect, "UPDATE registrasi_pelatihan SET status='".$status."' WHERE id_registrasi=$id_registrasi ");

	if(!$query_update){

		die("QUERY UPDATE STATUS REGISTER FAILED : ". mysqli_error($connect));

	}

	$_SESSION['success'] = "Ubah status sukses!";

	
	header("Location: ../../admin/".$redirect);

	