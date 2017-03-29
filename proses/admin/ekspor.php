<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');

    session_start();

    $date = date('Y-m-d-H-i-s');
    $filename = 'BlkDemakBackup'. $date .'.sql';
    $exportPath ='../../database/'. $filename;

    $return_var = NULL;
	$output = NULL;

	// time out 1 jam
	set_time_limit(3600);

	// untuk linux
    $sql = "/opt/lampp/bin/mysqldump --user=$username --password=$password --host=$host $database > $exportPath";

    // untuk windows
    // $sql = "C://xampp/mysql/bin/mysqldump --user=$username --password=$password --host=$host $database > $exportPath";
   
	// ekspor sql
	exec($sql, $output, $return_var);

	if($return_var != 0) {
		$_SESSION['error'] = "Basis data gagal diekspor";
	}
	else{
		$_SESSION['success'] = "Basis data telah diekspor dengan nama ". $filename;
	}

	// download basis data
	if (file_exists($exportPath)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.basename($exportPath).'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($exportPath));
	    readfile($exportPath);
	    exit;
	}

	// redirect ke beranda
	header("Location: ../../admin/ekspor.php");
	die();