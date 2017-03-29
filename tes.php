<?php
	/* Koneksi ke DB */
    require_once ('proses/koneksi_db.php');
    require_once ('proses/convert_date.php');
    require_once ('.env.php');

	$timeout = $_SERVER['REQUEST_TIME'];
	echo gmdate("H:i:s", $timeout);
	
    

// var_dump($row); die();
