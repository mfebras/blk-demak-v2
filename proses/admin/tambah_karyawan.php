<?php
	
	require_once ('../koneksi_db.php');

	session_start();

	$email = $_POST['email'];
	$nama_karyawan = $_POST['nama_karyawan'];
	$jabatan = $_POST['jabatan'];
	$password = $_POST['password'];

	$password = md5($password);


	$query_check = mysqli_query($connect, "SELECT * FROM karyawan WHERE email='".$email."' "); 

	if(!$query_check){

		die("QUERY CHECK FAILED : ". mysqli_error($connect));	

	}

	$num = mysqli_num_rows($query_check);	

	if($num>0){

		$_SESSION['error'] = "Tambah karyawan gagal, karyawan dengan email <b>".$email."</b> sudah ada!";

		//error sudah ada
	}else{


		$query_insert = mysqli_query($connect, "INSERT INTO karyawan (nama_karyawan, email, jabatan, password)  values ('".$nama_karyawan."', '".$email."', '".$jabatan."', '".$password."')"); 

		if(!$query_insert){

			die("QUERY INSERT FAILED : ". mysqli_error($connect));	

		}

		$_SESSION['success'] = "Tambah karyawan sukses!";

	}	

	header("Location: ../../admin/data_karyawan.php");

	