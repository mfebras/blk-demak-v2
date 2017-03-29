<?php
	/* Koneksi ke DB */
    require_once ('koneksi_db.php');
    require_once ('../.env.php');

	session_start();

	$nama = $_POST['blk_nama'];
	$email = $_POST['blk_email'];
	$subyek = $_POST['subyek'];
	$pesan = $_POST['pesan'];

	$previous_page = $_POST['page'];

	// jika terdapat field yang belum diisi
	if (($nama=="") || ($email=="") || ($subyek=="") || ($pesan=="")) {
		$_SESSION['error'] = "Pesan gagal dikirim<br>
							Pastikan semua formulir sudah terisi";
	}
	else{
		$sql = "INSERT INTO pesan (nama, email, subyek, pesan)
					VALUES ('$nama', '$email', '$subyek', '$pesan')";

		if (mysqli_query($connect, $sql)){
			$_SESSION['success'] = "Pesan Anda telah dikirim";
		} else {
			die("QUERY UPDATE FAILED : ". mysqli_error($connect));
			$_SESSION['error'] = "Pesan gagal dikirim";
		}
		mysqli_close($connect);
	}

	// redirect ke halaman kontak
	header("Location: ". ROOT . $previous_page .".php");
	die();