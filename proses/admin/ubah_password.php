<?php
	
	require_once ('../koneksi_db.php');

	session_start();


	$new_password = $_POST['new_password'];
	$re_password = $_POST['re_password'];
	$old_password = $_POST['old_password'];

	
	$old_password = md5($old_password);
	$curr_password = $_SESSION['password'];

	$jabatan = $_SESSION['jabatan'];
	$id = $_SESSION['id'];



	
	if($re_password!=$new_password){

		$_SESSION['error_password'] = 'Konfirmasi password harus sesuai!';

	}else{

		if($old_password!=$curr_password){
			

			$_SESSION['error_password'] = 'Password lama anda tidak sesuai!';

		}else{

			$new_password = md5($new_password);

			if($jabatan=='staff'){

				$query_update = mysqli_query($connect, "UPDATE karyawan SET password = '".$new_password."' WHERE id_karyawan = $id "); 

			}else if($jabatan=='admin'){

				$query_update = mysqli_query($connect, "UPDATE admin SET password = '".$new_password."' WHERE id_admin = $id "); 

			}

			if(!$query_update){

				die("QUERY CHECK FAILED : ". mysqli_error($connect));	

			}

			$_SESSION['password'] = $new_password;

			$_SESSION['success_password'] = "Ubah password sukses!";

		}

	}


	header("Location: ../../admin/ubah_akun.php");

	