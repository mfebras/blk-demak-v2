<?php
	
	require_once ('../koneksi_db.php');

	session_start();


	$email = $_POST['email'];
	$nama = $_POST['nama_akun'];

	$jabatan = $_SESSION['jabatan'];
	$id = $_SESSION['id'];
	$email_old = $_SESSION['email'];

	//check apakah user mengubah email
	if($email!=$email_old){

		if($jabatan=='staff'){

			$query_check = mysqli_query($connect, "SELECT * FROM karyawan WHERE email='".$email."' "); 

		}else if($jabatan=='admin'){

			$query_check = mysqli_query($connect, "SELECT * FROM admin WHERE email='".$email."' "); 

		}


		if(!$query_check){

			die("QUERY CHECK FAILED : ". mysqli_error($connect));	

		}

		$num = mysqli_num_rows($query_check);

		if($num>0){

			$_SESSION['error_profile'] = "Ubah profil gagal, email <b>".$email."</b> sudah ada!";

			header("Location: ../../admin/ubah_akun.php");

			die();

		}



		
	}

	//jika tidak mengubah email

		

	if($jabatan=='staff'){

		$query_update = mysqli_query($connect, "UPDATE karyawan SET nama_karyawan = '".$nama."', email = '".$email."' WHERE id_karyawan = $id "); 

	}else if($jabatan=='admin'){

		$query_update = mysqli_query($connect, "UPDATE admin SET nama_admin = '".$nama."', email = '".$email."' WHERE id_admin = $id "); 

	}
	

	if(!$query_update){

		die("QUERY UPDATE PROFILE FAILED : ". mysqli_error($connect));	

	}

	$_SESSION['email'] = $email;
	$_SESSION['nama'] = $nama;

	$_SESSION['success_profile'] = "Ubah profil sukses!";

	header("Location: ../../admin/ubah_akun.php");

	