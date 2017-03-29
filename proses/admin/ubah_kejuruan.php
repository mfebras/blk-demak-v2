<?php
	
	require_once ('../koneksi_db.php');
	session_start();

	$id = $_GET['id'];
	$nama_kejuruan = $_POST['nama_kejuruan'];
	$kode_kejuruan = $_POST['kode_kejuruan'];

	$query_check = mysqli_query($connect, "SELECT * FROM kejuruan WHERE (nama_kejuruan='".$nama_kejuruan."' OR kode_kejuruan='".$kode_kejuruan."') AND id_kejuruan!=$id "); 

	if(!$query_check){

		die("QUERY CHECK FAILED : ". mysqli_error($connect));	

	}

	$num = mysqli_num_rows($query_check);	

	if($num>0){

		$_SESSION['error'] = "Ubah kejuruan gagal, kejuruan dengan nama <b>".$nama_kejuruan."</b> atau dengan kode <b>".$kode_kejuruan."</b> sudah ada!";

		//error sudah ada
	}else{


		$query_update = mysqli_query($connect, "UPDATE kejuruan SET nama_kejuruan='".$nama_kejuruan."', kode_kejuruan='".$kode_kejuruan."' WHERE id_kejuruan=$id ");

		if(!$query_update){

			die("QUERY UPDATE FAILED : ". mysqli_error($connect));	

		}

		$_SESSION['success'] = "Ubah kejuruan sukses!";

	}	

	header("Location: ../../admin/data_kejuruan.php");

