<?php
	
	require_once ('../koneksi_db.php');
	session_start();

	$id = $_GET['id'];

	$query = mysqli_query($connect, "UPDATE kejuruan SET status_hapus=0 WHERE id_kejuruan=$id");


	if(!$query){
		die("QUERY KEMBALIKAN KEJURUAN FAILED : ". mysqli_error($connect));
	}


	$_SESSION['success'] = "Kejuruan sukses diaktifkan!";

	header("Location: ../../admin/data_kejuruan.php");
	
	

	