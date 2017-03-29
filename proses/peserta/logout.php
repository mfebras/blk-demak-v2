<?php
    require_once ('../../.env.php');
    
	session_start();
	$_SESSION['login-peserta'] = false;
	session_unset($_SESSION['id-peserta']);
	session_unset($_SESSION['ktp-peserta']);
	session_unset($_SESSION['status-peserta']);
	
	$_SESSION['success'] = "Logout sukses.";

	// redirect ke beranda
	header("Location: ". ROOT);
	die();