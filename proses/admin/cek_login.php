<?php
	
	session_start();
	require_once ('../koneksi_db.php');

	$email = $_POST['email'];
	$password = $_POST['password'];
	$jabatan = $_POST['jabatan'];

	$password = md5($password);

	if($jabatan=='staff'){

		$query_check = mysqli_query($connect, 'SELECT * FROM karyawan WHERE email="'.$email.'" AND password="'.$password.'" ');

	}else if($jabatan=='admin'){

		$query_check = mysqli_query($connect, 'SELECT * FROM admin WHERE email="'.$email.'" AND password="'.$password.'" ');
	}

	if(!$query_check){
		die("query_check CHECK LOGIN GAGAL ".mysqli_error($connect));
	}

	$num = mysqli_num_rows($query_check);

	if($num<=0){

		$_SESSION['error'] = "Email dan Password tidak ditemukan ";

		header("Location: ../../admin/login.php");

	}else{

		$row = mysqli_fetch_object($query_check);

		if($jabatan=='staff'){
			$_SESSION['id'] = $row->id_karyawan;
			$_SESSION['nama'] = $row->nama_karyawan;
			$_SESSION['jabatan'] = 'staff';
			$_SESSION['email'] = $row->email;
			$_SESSION['password'] = $row->password;
			$_SESSION['login'] = true;
			$_SESSION['success_login'] = true;


		}else if($jabatan=='admin'){

			$_SESSION['id'] = $row->id_admin;
			$_SESSION['nama'] = $row->nama_admin;
			$_SESSION['jabatan'] = 'admin';
			$_SESSION['email'] = $row->email;
			$_SESSION['password'] = $row->password;
			$_SESSION['login'] = true;

			$_SESSION['success_login'] = true;

			

		}

		header("Location: ../../admin/index.php");

		

	}
	

?>