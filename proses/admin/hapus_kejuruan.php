<?php
	
	require_once ('../koneksi_db.php');
	session_start();

	$id = $_GET['id'];

	$query = mysqli_query($connect, "UPDATE kejuruan SET status_hapus=1 WHERE id_kejuruan=$id");


	if(!$query){
		die("QUERY DELETE KEJURUAN FAILED : ". mysqli_error($connect));
	}


	$_SESSION['success'] = "Kejuruan sukses dinonaktifkan!";

	header("Location: ../../admin/data_kejuruan.php");
	
	

	