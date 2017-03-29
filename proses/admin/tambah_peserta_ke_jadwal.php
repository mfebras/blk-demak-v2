<?php
	
	require_once ('../koneksi_db.php');
	
	session_start();

	$id_jadwal = $_GET['id_jadwal'];
	$id_kejuruan = $_GET['id_kejuruan'];
	$kapasitas = $_GET['kapasitas'];

	$id_registrasi = $_GET['id_registrasi'];

	$query_check = mysqli_query($connect, "SELECT * FROM registrasi_pelatihan WHERE id_jadwal=$id_jadwal ");

	if(!$query_check){

		die("QUERY CHECK NUM JADWAL FAILED : ". mysqli_error($connect));	

	}



	$num = mysqli_num_rows($query_check);



	if($num>=$kapasitas){

		$_SESSION['error'] = "Tambah peserta gagal! Jumlah peserta sudah memenuhi kapasitas yang tersedia";

	}else{

		$query_update = mysqli_query($connect, "UPDATE registrasi_pelatihan SET id_jadwal = $id_jadwal WHERE id_registrasi=$id_registrasi"); 

		if(!$query_update){

			die("QUERY INSERT PESERTA KE JADWAL FAILED : ". mysqli_error($connect));	

		}		


	}

	$_SESSION['success'] = "Tambah peserta sukses!";

	header("Location: ../../admin/detail_jadwal.php?id=".$id_jadwal);



	