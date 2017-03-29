<?php
	
	require_once ('../koneksi_db.php');
	session_start();

	$id_peserta = $_GET['id_peserta'];

	$query = mysqli_query($connect, "UPDATE peserta SET status_hapus=1 WHERE id=$id_peserta");


	if(!$query){
		die("QUERY DELETE PESERTA FAILED : ". mysqli_error($connect));
	}


	$_SESSION['success'] = "Hapus peserta sukses!";

	header("Location: ../../admin/data_peserta.php");
	
	

	