<?php
	
	require_once ('../../fpdf/mc_table.php');
	require_once ('../koneksi_db.php');
	require_once ('../convert_date.php');
	
	session_start();

	$tahun 		= $_GET['tahun'];
	$angkatan 	= $_GET['angkatan'];


	if($angkatan=='all'){

		$query_check = mysqli_query($connect, "SELECT id_jadwal FROM jadwal WHERE YEAR(pelatihan_awal)='".$tahun."' ");


	}else{
		
		$query_check = mysqli_query($connect, "SELECT id_jadwal FROM jadwal WHERE angkatan='".$angkatan."' AND YEAR(pelatihan_awal)='".$tahun."' ");
	
	}
	

	if(!$query_check){

		die("QUERY CHECK FAILED ". mysqli_error($connect));

	}

	$num = mysqli_num_rows($query_check);

	if($num<=0){

		die("DATA TIDAK DITEMUKAN! ");

	}






	$data = array();
	
	$arrayAngkatan = array();

	if($angkatan=='all'){

		$query_get_num_angkatan = mysqli_query($connect, "SELECT count(angkatan), angkatan FROM jadwal GROUP BY angkatan ORDER BY angkatan");

		if(!$query_get_num_angkatan){
			die("QUERY CHECK FAILED ". mysqli_error($connect));
		}			

		$numAngkatan = mysqli_num_rows($query_get_num_angkatan);
		$i= 0;
		while ($row=mysqli_fetch_object($query_get_num_angkatan)) {
			
			$arrayAngkatan[$i] = $row->angkatan; 
			$i++;
		}


	}else{

		$numAngkatan = 1;

		$arrayAngkatan[0] = $angkatan;

	}
			
	$query_get_kejuruan = mysqli_query($connect, "SELECT * FROM kejuruan");

	if(!$query_get_kejuruan){
		die("QUERY CHECK FAILED ". mysqli_error($connect));
	}

	$numKejuruan = mysqli_num_rows($query_get_kejuruan);

	$arrayKejuruan = array();
	$arrayNamaKejuruan = array();

	$i = 0;

	while ($row=mysqli_fetch_object($query_get_kejuruan)) {
		
		$arrayNamaKejuruan[$row->id_kejuruan] = $row->nama_kejuruan;
		$arrayKejuruan[$i] = $row->id_kejuruan;

		$i++;
		
	}


	$total = array();
	
	foreach ($arrayAngkatan as $angkatanItem) {		
		
		$data[$angkatanItem] = array();

		$total[$angkatanItem]['l'] = 0;
		$total[$angkatanItem]['p'] = 0;
		$total[$angkatanItem]['j'] = 0;

		foreach ($arrayKejuruan as $key => $kejuruanItem) {
			
			$data[$angkatanItem][$kejuruanItem] = array();				

			$data[$angkatanItem][$kejuruanItem]['l'] = 0;
			$data[$angkatanItem][$kejuruanItem]['p'] = 0;
			$data[$angkatanItem][$kejuruanItem]['j'] = 0;

			$query = mysqli_query($connect, "SELECT sum(case when pe.jenis_kelamin = 'Laki-laki' then 1 else 0 end) males,
														sum(case when pe.jenis_kelamin = 'Perempuan' then 1 else 0 end) females,
														count(*) total
														

														FROM registrasi_pelatihan re LEFT JOIN peserta pe ON re.id_peserta = pe.id
                                                    							 LEFT JOIN jadwal ja ON  re.id_jadwal = ja.id_jadwal 
                                                                                 LEFT JOIN kejuruan ke ON re.id_kejuruan = ke.id_kejuruan                                                                                 

														WHERE ja.angkatan = '".$angkatanItem."' AND YEAR(ja.pelatihan_awal) = '".$tahun."' 
														AND re.status = 6 AND re.id_kejuruan = $kejuruanItem  														

														");

			if(!$query){

				die("QUERY GET LAPORAN FAILED ". mysqli_error($connect));

			}
			$row = mysqli_fetch_object($query);

			$data[$angkatanItem][$kejuruanItem]['l'] = $row->males;
			$data[$angkatanItem][$kejuruanItem]['p'] = $row->females;
			$data[$angkatanItem][$kejuruanItem]['j'] = $row->total;

		}

	}


	$pdf = new PDF_MC_Table();
	
	$pdf->AddPage('L', 'A4');

	$pdf->Image('../../assets/img/logo.png', 20, 10, 0, 20);

	//set font header
	$pdf->SetFont('Arial','B',12);

	$pdf->setXY(13, 30);

	$pdf->Cell(30,7,'APBN / APBD',0, 0, 'C');

	$pdf->setXY(20, 50);

	$pdf->Cell(38,7,'Laporan Tahun '.$tahun.'',0, 0, 'C');

	if($angkatan!='all'){
		$pdf->Cell(30,7,'Angkatan '.$angkatan.'',0, 0, 'C');
	}


	$pdf->SetFont('Arial','B',16);
	$pdf->setXY(10, 10);

	$pdf->Cell(280,7,'DATA PELATIHAN',0, 0, 'C');
	$pdf->ln();

	$pdf->Cell(280,7,'UPTD BALAI LATIHAN KERJA KABUPATEN DEMAK',0, 0, 'C');
	$pdf->ln();

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(280,5,'Jl. Katonsari No. 19 Demak. Telp (0291) 681718',0, 0, 'C');
	$pdf->ln();

	$pdf->Cell(280,5,'Email : blkdemak@gmail.com',0, 0, 'C');
	$pdf->ln();

	

	if($angkatan=='all'){

		$pdf->setXY(10, 60);

		$pdf->SetFont('Arial','B',10);

		$pdf->Cell(10,14,'NO',1, 0, 'C');
		$pdf->Cell(30,14,'KEJURUAN',1, 0, 'C');


		$x = 50; $y1= 60;$y2 = 67;
		foreach ($arrayAngkatan as $key => $angkatanItem) {
			$pdf->setXY($x, $y1);
			$pdf->Cell(45,7,'Angkatan '.$angkatanItem,1, 0, 'C');


			$pdf->setXY($x, $y2);
			$pdf->Cell(15,7,'LK',1, 0, 'C');
			$pdf->Cell(15,7,'PR',1, 0, 'C');
			$pdf->Cell(15,7,'JUM',1, 0, 'C');

			$x = $x + 45;


		}

		$pdf->SetFont('Arial','',10);

		$pdf->setXY(10, 74);

		$no = 1;

		foreach ($arrayNamaKejuruan as $id_kejuruan => $nama_kejuruan) {
			/*$pdf->Cell(10,7,$no,1, 0, 'C');
			$pdf->Cell(30,7,$nama_kejuruan,1, 0, 'C');*/

			$width = array(10, 30);

			$content = array($no, $nama_kejuruan);

			$align = array('C', '');
			
			foreach ($arrayAngkatan as $key => $angkatanItem) {
				$laki 		= isset($data[$angkatanItem][$id_kejuruan]['l']) ? $data[$angkatanItem][$id_kejuruan]['l'] : 0;
				$perempuan 	= isset($data[$angkatanItem][$id_kejuruan]['p']) ? $data[$angkatanItem][$id_kejuruan]['p'] : 0;
				$jumlah		= isset($data[$angkatanItem][$id_kejuruan]['j']) ? $data[$angkatanItem][$id_kejuruan]['j'] : 0;
				
				$total[$angkatanItem]['l'] +=  $laki;
				$total[$angkatanItem]['p'] +=  $perempuan;
				$total[$angkatanItem]['j'] +=  $jumlah;
				
				$tempWidth = array(15,15,15);

				$tempContent = array($laki, $perempuan, $jumlah);

				$tempAlign = array('C', 'C', 'C');

				$width = array_merge($width, $tempWidth);

				$content = array_merge($content, $tempContent);

				$align = array_merge($align, $tempAlign);
			}

			//print_r($width);echo "<br><br>";print_r($content);die();

			$pdf->SetAligns($align);
			$pdf->SetWidths($width);

			$pdf->Row($content);

			$no++;
			//$pdf->ln();
		}

		$pdf->SetFont('Arial','B',10);

		$pdf->Cell(40,7,'JUMLAH',1, 0, 'C');

		foreach ($arrayAngkatan as $key => $angkatanItem) {

			$pdf->Cell(15,7, $total[$angkatanItem]['l'] ,1, 0, 'C');
			$pdf->Cell(15,7, $total[$angkatanItem]['p'] ,1, 0, 'C');
			$pdf->Cell(15,7, $total[$angkatanItem]['j'] ,1, 0, 'C');

		}


		//jika hanya ada satu ANGKATAN
	}else{

		$pdf->setXY(30, 60);

		$pdf->SetFont('Arial','B',10);

		$pdf->Cell(10,14,'NO',1, 0, 'C');
		$pdf->Cell(100,14,'KEJURUAN',1, 0, 'C');

		$pdf->Cell(120,7,'Angkatan '.$angkatanItem,1, 0, 'C');

		$pdf->setXY(140, 67);
		$pdf->Cell(40,7,'LK',1, 0, 'C');
		$pdf->Cell(40,7,'PR',1, 0, 'C');
		$pdf->Cell(40,7,'JUM',1, 0, 'C');


		$pdf->SetFont('Arial','',10);

		$pdf->setXY(30, 74);

		$no = 1;

		foreach ($arrayNamaKejuruan as $id_kejuruan => $nama_kejuruan) {
			/*$pdf->Cell(10,7,$no,1, 0, 'C');
			$pdf->Cell(30,7,$nama_kejuruan,1, 0, 'C');
*/
			$width = array(10, 100);

			$posX = array(30, 40);

			$content = array($no, $nama_kejuruan);

			$align = array('C', '');

			foreach ($arrayAngkatan as $key => $angkatanItem) {
				$laki 		= isset($data[$angkatanItem][$id_kejuruan]['l']) ? $data[$angkatanItem][$id_kejuruan]['l'] : 0;
				$perempuan 	= isset($data[$angkatanItem][$id_kejuruan]['p']) ? $data[$angkatanItem][$id_kejuruan]['p'] : 0;
				$jumlah		= isset($data[$angkatanItem][$id_kejuruan]['j']) ? $data[$angkatanItem][$id_kejuruan]['j'] : 0;
				
				$total[$angkatanItem]['l'] +=  $laki;
				$total[$angkatanItem]['p'] +=  $perempuan;
				$total[$angkatanItem]['j'] +=  $jumlah;
				
				
				$tempWidth = array(40,40,40);

				$tempContent = array($laki, $perempuan, $jumlah);

				$tempAlign = array('C', 'C', 'C');

				$tempPosX = array(140,180,220);

				$width = array_merge($width, $tempWidth);

				$content = array_merge($content, $tempContent);

				$align = array_merge($align, $tempAlign);

				$posX = array_merge($posX, $tempPosX);

			}

			$pdf->SetAligns($align);
			$pdf->SetWidths($width);
			$pdf->SetPosX($posX);
			$pdf->Row($content);

			$no++;

		}
		$pdf->setXY(30, $pdf->getY());
		$pdf->SetFont('Arial','B',10);

		$pdf->Cell(110,7,'JUMLAH',1, 0, 'C');

		foreach ($arrayAngkatan as $key => $angkatanItem) {

			$pdf->Cell(40,7, $total[$angkatanItem]['l'] ,1, 0, 'C');
			$pdf->Cell(40,7, $total[$angkatanItem]['p'] ,1, 0, 'C');
			$pdf->Cell(40,7, $total[$angkatanItem]['j'] ,1, 0, 'C');			
		}




	}

	if($angkatan=='all'){
		$pdf->SetTitle('Laporan Pelatihan BLK - '.$tahun);
	}else{
		$pdf->SetTitle('Laporan Pelatihan BLK - '.$tahun.' angkatan '.$angkatan);
	}
	
	

	$pdf->Output();

	

?>




