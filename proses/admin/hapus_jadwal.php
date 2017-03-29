<?php
	
	require_once ('../koneksi_db.php');
	session_start();

	$id = $_GET['id'];

	//langkah pertama cek status pelaksanaan
	$query_check_status_pelaksanaan = mysqli_query($connect, "SELECT status_pelaksanaan FROM jadwal WHERE id_jadwal=$id");

	if(!$query_check_status_pelaksanaan){
		die("QUERY CHECK STATUS FAILED : ". mysqli_error($connect));
	}

	$data = mysqli_fetch_object($query_check_status_pelaksanaan);

	$status = $data->status_pelaksanaan;

	if($status=='belum'){
		//kalau status pelaksanaan belum, maka dilakukan pengecekan
		//apakah ada peserta yang terdaftar

		$query_check_peserta = mysqli_query($connect, "SELECT * FROM registrasi_pelatihan WHERE id_jadwal=$id");

		if(!$query_check_peserta){
			die("QUERY CHECK PESERTA FAILED : ". mysqli_error($connect));
		}

		$num = mysqli_num_rows($query_check_peserta);

		if($num>0){
			//jika ada peserta yang terdaftar pada jadwal ini, maka hapus jadwal error
			$_SESSION['error'] = "Hapus jadwal gagal! Pada jadwal ini terdapat ".$num." peserta yang terdaftar, Anda harus menghapus peserta yang terdaftar terlebih dahulu";

		}else{
			//jika tidak ada peserta yang terdaftar, maka hapus jadwal dari tabel (HARD DELETE)
			$query = mysqli_query($connect, "DELETE FROM jadwal WHERE id_jadwal=$id");


			if(!$query){
				die("QUERY DELETE JADWAL FAILED : ". mysqli_error($connect));
			}

			$_SESSION['success'] = "Hapus jadwal sukses!";

		}

	}else if($status=='sudah'){
		//kalau status pelaksanaan sudah, maka hapus dengan SOFT DELETE

		$query = mysqli_query($connect, "UPDATE jadwal SET status_hapus=1 WHERE id_jadwal=$id");


		if(!$query){
			die("QUERY DELETE JADWAL FAILED : ". mysqli_error($connect));
		}

		$_SESSION['success'] = "Hapus jadwal sukses!";

	}
	

	header("Location: ../../admin/data_jadwal.php");
	
	

	