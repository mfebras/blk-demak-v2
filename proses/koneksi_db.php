<?php
	$host = "127.0.0.1";
	$username = "root";
	$password = "";
	$database = "blk_demak";
	
	$connect = mysqli_connect($host, $username, $password, $database);
	
	if(!$connect){
		die("Connection failed: " . mysqli_connect_error());
	}