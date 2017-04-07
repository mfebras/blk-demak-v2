<?php
	
	require_once('../../phpexcel/Classes/PHPExcel.php');
	require_once('../koneksi_db.php');
	require_once ('../convert_date.php');



	$objPHPExcel = new PHPExcel();

	$header = array(
	    'font' => array(
	        'bold' => true,
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	    ),
	    
	);

	$headerTable = array(
	    'font' => array(
	        'bold' => true,
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
	    ),
	    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '95a5a6')
        )
	);


	$styleKejuruan = array(
	    'font' => array(
	        'bold' => true,
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
	    ),
	);

	$objPHPExcel->getProperties()->setCreator("Ahmad Syarifudin Latif")
						 ->setLastModifiedBy("Ahmad Syarifudin Latif")
						 ->setTitle("Data peserta BLK");


	$objPHPExcel->setActiveSheetIndex(0);
     
    $sheet = $objPHPExcel->getActiveSheet();

    $sheet->setTitle('Data peserta BLK');

    $sheet->getStyle("A2:I2")->applyFromArray($header)->getFont()->setSize(16);

    //merge cell
	$sheet->mergeCells('A2:I2')					
				->setCellValue('A2', 'DATA PESERTA BLK DEMAK');									

	foreach (range('A','I') as $columnID) {
		$sheet->getColumnDimension($columnID)->setAutoSize(true);
	}

	$sheet->getStyle("A4:I4")->applyFromArray($headerTable);
	$sheet->getRowDimension('4')->setRowHeight(30);

	$arrayHeader = array('Timestamp',	'Nama Lengkap',	'Tempat Lahir', 'Tanggal Lahir', 'Alamat',	'Kecamatan', 'Pendidikan', 'Nomor HP', 'Nomor KTP (NIK)');
	
	//create tabel header
	foreach (range('A', 'I') as $key => $value) {

		$sheet->setCellValue($value.'4', $arrayHeader[$key]);

	}


	$query_kejuruan = mysqli_query($connect, "SELECT * FROM kejuruan");

	if(!$query_kejuruan){
		die("QUERY KEJURUAN FAILED ".mysqli_error($connect));
	}
	$data = array();

	while ($row=mysqli_fetch_object($query_kejuruan)) {
		
		$data[$row->nama_kejuruan] = array();

	}

	$query_peserta = mysqli_query($connect, "SELECT pe.*, ke.nama_kejuruan, re.tanggal_registrasi FROM registrasi_pelatihan re, peserta pe, kejuruan ke WHERE re.id_peserta=pe.id AND re.id_kejuruan=ke.id_kejuruan ");

	if(!$query_peserta){
		die("QUERY PESERTA FAILED ".mysqli_error($connect));
	}
	

	while ($row=mysqli_fetch_array($query_peserta)) {
		

		array_push($data[$row['nama_kejuruan']], $row);

	}

	//echo "<pre>";print_r($data);echo "</pre>";die();

	$idx = 5;
	foreach ($data as $key => $eachKejuruan) {
		
		if(empty($eachKejuruan)){
			continue;
		}

		//merge cell
		$sheet->mergeCells('A'.$idx.':I'.$idx)					
				->setCellValue('A'.$idx, $key);

		$sheet->getStyle('A'.$idx.':I'.$idx)->applyFromArray($styleKejuruan);

		$idx++;

		foreach ($eachKejuruan as $key2 => $eachPeserta) {
			
			$sheet->setCellValue('A'.$idx, convertDate($eachPeserta['tanggal_registrasi'], 'd M Y'));
			$sheet->setCellValue('B'.$idx, strtoupper($eachPeserta['nama']));
			$sheet->setCellValue('C'.$idx, $eachPeserta['tempat_lahir']);
			$sheet->setCellValue('D'.$idx, convertDate($eachPeserta['tanggal_lahir'], 'd M Y'));
			$sheet->setCellValue('E'.$idx, $eachPeserta['alamat']);
			$sheet->setCellValue('F'.$idx, $eachPeserta['kecamatan']);
			$sheet->setCellValue('G'.$idx, $eachPeserta['pendidikan_terakhir']);
			$sheet->setCellValue('H'.$idx, $eachPeserta['telepon']);
			$sheet->setCellValue('I'.$idx, $eachPeserta['no_ktp']);

			$idx++;

		}

		$idx++;

			
		

	}




	$filename = 'DATA PESERTA BLK DEMAK.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'.$filename.'"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');

?>