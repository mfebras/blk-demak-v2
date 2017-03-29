<?php
	
	//konversi status registrasi peserta
	function convertStatusRegistrasi($status){


		switch ($status) {
			case 1:
				$result = '<span class="label label-danger">Belum Dipanggil</span>';
				break;

			case 2:
				$result = '<span class="label label-success">Sudah Dipanggil</span>';
				break;

			case 3:
				$result = '<span class="label label-danger">Belum Lulus Tes dan Wawancara</span>';
				break;

			case 4:
				$result = '<span class="label label-success">Lulus Tes dan Wawancara</span>';
				break;

			case 5:
				$result = '<span class="label label-danger">Belum Lulus Pelatihan</span>';
				break;

			case 6:
				$result = '<span class="label label-success">Lulus Pelatihan</span>';
				break;

			default:
				$result = '<span class="label label-warning">Status Undefined</span>';
				break;
		}

		return $result;
	}

	// Fungsi membuat random string
	// http://www.lateralcode.com/creating-a-random-string-with-php/
	function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}



	function convertStatusPesan($status){

		if($status=='belum'){
			$result = '<span class="label label-danger">Belum dibaca</span>';
		}else if($status=='sudah'){
			$result = '<span class="label label-success">Sudah dibaca</span>';
		}

		return $result;
	}

?>