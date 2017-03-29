<?php
	
	require_once ('../koneksi_db.php');
	session_start();

	$id = $_GET['id'];

	$query = mysqli_query($connect, "DELETE FROM karyawan WHERE id_karyawan=$id");


	if(!$query){
		die("QUERY DELETE KARYAWAN FAILED : ". mysqli_error($connect));
	}


	$_SESSION['success'] = "Hapus karyawan sukses!";

	header("Location: ../../admin/data_karyawan.php");
	
	

	