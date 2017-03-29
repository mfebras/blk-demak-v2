<?php
	
	require_once ('../koneksi_db.php');

	session_start();

	$id = $_GET['id'];
	$email = $_POST['email'];
	$nama_karyawan = $_POST['nama_karyawan'];
	$jabatan = $_POST['jabatan'];


	$query_check = mysqli_query($connect, "SELECT * FROM karyawan WHERE email='".$email."' "); 

	if(!$query_check){

		die("QUERY CHECK FAILED : ". mysqli_error($connect));	

	}

	$num = mysqli_num_rows($query_check);	

	if($num>0){

		$_SESSION['error'] = "Ubah karyawan gagal, karyawan dengan email <b>".$email."</b> sudah ada!";

		//error sudah ada
	}else{


		$query_update = mysqli_query($connect, "UPDATE karyawan SET nama_karyawan='".$nama_karyawan."', email='".$email."', jabatan='".$jabatan."' WHERE id_karyawan=$id ");

		if(!$query_update){

			die("QUERY UPDATE FAILED : ". mysqli_error($connect));

		}

		$_SESSION['success'] = "Ubah karyawan sukses!";

	}	

	header("Location: ../../admin/data_karyawan.php");

	