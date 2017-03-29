<?php
	
	require_once ('../../fpdf/mc_table.php');
	require_once ('../koneksi_db.php');
	require_once ('../convert_date.php');
	
	session_start();

	$query = mysqli_query($connect, "SELECT * FROM registrasi_pelatihan re, peserta pe, kejuruan ke WHERE re.id_peserta=pe.id AND re.id_kejuruan=ke.id_kejuruan AND re.status=4 ORDER BY re.id_kejuruan ");

	if(!$query){
		die("QUERY FAILED ". mysqli_error($connect));
	}  


    $pdf = new PDF_MC_Table();
	
	$pdf->AddPage('P', 'A4');

	$pdf->Image('../../assets/img/logo.png', 12, 10, 0, 20);

	$pdf->SetFont('Arial','',12);
	$pdf->setXY(10, 10);

	$pdf->Cell(200,6,'PEMERINTAH KABUPATEN DEMAK',0, 0, 'C');
	$pdf->ln();

	$pdf->Cell(200,6,'DINAS TENAGA KERJA DAN PERINDUSTRIAN',0, 0, 'C');
	$pdf->ln();

	$pdf->SetFont('Arial','',14);
	$pdf->Cell(200,6,'UPTD BALAI LATIHAN KERJA KABUPATEN DEMAK',0, 0, 'C');
	$pdf->ln();

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(200,5,'Jalan Raya Katonsari No. 19 Demak. Telp (0291) 681718',0, 0, 'C');
	$pdf->ln();
	$pdf->ln();

	$pdf->SetFont('Arial','',12);
	$pdf->Cell(200,7,'PENGUMUMAN PESERTA YANG LOLOS TES DAN WAWANCARA',0, 0, 'C');
	$pdf->ln();

	$pdf->SetFont('Arial','B',10);
	$pdf->setXY(20, 55);
	$pdf->Cell(15,7,'No',1, 0, 'C');
	$pdf->Cell(40,7,'No Registrasi',1, 0, 'C');
	$pdf->Cell(60,7,'Nama Lengkap',1, 0, 'C');
	$pdf->Cell(60,7,'Kejuruan',1, 0, 'C');	
	$pdf->Ln();

	$pdf->SetFont('Arial','',10);
	$pdf->setXY(20, 62);
	$no=1;
	while ($row=mysqli_fetch_object($query)) {
		
		$pdf->SetWidths(array(15, 40,60,60));
		$pdf->Row(array($no, $row->no_registrasi, $row->nama, $row->nama_kejuruan));
		$pdf->setX(20);
		$no++;
	}


	
	
	$pdf->SetTitle('Pengumuman lolos tes dan wawancara');

	$pdf->Output();