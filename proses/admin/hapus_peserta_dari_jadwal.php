<?php
	
	require_once ('../koneksi_db.php');
	session_start();

	$id_jadwal = $_GET['id_jadwal'];
	$id_registrasi = $_GET['id_registrasi'];
	$id_kejuruan = $_GET['id_kejuruan'];


	$query_update = mysqli_query($connect, "UPDATE registrasi_pelatihan SET id_jadwal = 0 WHERE id_registrasi=$id_registrasi ");

	if(!$query_update){
		die("QUERY DELETE PESERTA DARI JADWAL FAILED : ". mysqli_error($connect));
	}

	$_SESSION['success'] = "Hapus peserta sukses!";

	header("Location: ../../admin/detail_jadwal.php?id=".$id_jadwal);
	
	

	