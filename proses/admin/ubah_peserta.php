<?php
	
	require_once ('../koneksi_db.php');
	require_once ('../convert_date.php');

	session_start();

	$id = $_GET['id_peserta'];

	$no_ktp = $_POST['nomor_ktp'];
	$nama = $_POST['nama_peserta'];
	$jenis_kelamin = $_POST['jk'];
	$tempat_lahir = $_POST['tempat_lahir'];

	$tanggal_lahir = convertDate($_POST['tanggal_lahir'], 'Y-m-d');

	$agama = $_POST['agama'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['no_hp'];
	$email = $_POST['email'];
	$pendidikan_terakhir = $_POST['pendidikan_terakhir'];
	$sumber_info = $_POST['sumber_info'];


	$query_update = mysqli_query($connect, "UPDATE peserta SET nama='".$nama."', email='".$email."', no_ktp='".$no_ktp."',
		jenis_kelamin='".$jenis_kelamin."', agama='".$agama."', tempat_lahir='".$tempat_lahir."', 
		tanggal_lahir='".$tanggal_lahir."', alamat	='".$alamat	."', telepon='".$telepon."',
		pendidikan_terakhir='".$pendidikan_terakhir."', sumber_info='".$sumber_info."' WHERE id=$id ");

	if(!$query_update){

		die("QUERY UPDATE FAILED : ". mysqli_error($connect));

	}

	$_SESSION['success'] = "Ubah data peserta sukses!";


	header("Location: ../../admin/form_ubah_peserta.php?id_peserta=".$id);

	