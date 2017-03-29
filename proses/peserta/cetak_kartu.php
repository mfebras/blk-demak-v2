<?php
	/* Koneksi ke DB */
    require_once ('../koneksi_db.php');
	require_once ('../helper.php');
	require_once ('../../fpdf/mc_table.php');

	session_start();

	$no_registrasi = $_GET['data-riwayat'];
	$id_peserta = $_GET['data-peserta'];

	$sql = "SELECT peserta.nama, peserta.alamat, peserta.telepon, registrasi_pelatihan.no_registrasi, registrasi_pelatihan.status, kejuruan.nama_kejuruan FROM peserta, registrasi_pelatihan,kejuruan
		WHERE peserta.id='$id_peserta' AND registrasi_pelatihan.no_registrasi='$no_registrasi'
		AND registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan";

	$result = mysqli_query($connect, $sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	// var_dump($row); die();


	$pdf = new PDF_MC_Table();
	
	$pdf->AddPage('P', 'A4');

	$pdf->setXY(5, 5);
	$pdf->Cell(200,30,'',1, 0, 'C');

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

	$pdf->setXY(5, 35);
	$pdf->Cell(200,130,'',1, 0, 'C');

	$pdf->SetFont('Arial','B',12);
	$pdf->setXY(150, 40);
	$pdf->SetFillColor(149, 165, 166);
	$pdf->Cell(50,8,'UNTUK PESERTA',0, 0, 'C', true);

	$pdf->setXY(5, 55);
	$pdf->Cell(200,25,'',1, 0, 'C');

	$pdf->SetFont('Arial','',16);
	$pdf->setXY(10, 60);
	$pdf->Cell(150,6,'KARTU PESERTA PENDAFTARAN',0, 0, 'C');
	$pdf->ln();

	$pdf->setXY(155, 55);
	$pdf->Cell(50,25,'',1, 0, 'C');
	$pdf->SetFont('Arial','',12);
	$pdf->setXY(150, 60);
	$pdf->Cell(60,6,'Nomor Registrasi',0, 0, 'C');

	$pdf->SetFont('Arial','B',14);
	$pdf->setXY(150, 67);
	$pdf->Cell(60,6,$row['no_registrasi'],0, 0, 'C');

	$pdf->setXY(155, 80);
	$pdf->Cell(50,85,'',1, 0, 'C');


	//kotak untuk foto
	$pdf->setXY(165, 90);
	$pdf->Cell(30,40,'',1, 0, 'C');

	$pdf->SetFont('Arial','',12);
	$pdf->setXY(170, 100);
	$pdf->Cell(20,7,'Pas Photo',0, 0, 'C');
	$pdf->setXY(170, 110);
	$pdf->Cell(20,7,'3 X 4',0, 0, 'C');


	$pdf->SetFont('Arial','',12);
	$pdf->setXY(10, 70);
	$pdf->Cell(100,6,'NAMA PELATIHAN : '.strtoupper($row['nama_kejuruan']),0, 0, 'C');
	$pdf->ln();

	$pdf->setXY(20, 90);
	$pdf->Cell(50,6,'Nama  ',0, 0, 'L');
	$pdf->ln();

	$pdf->setXY(50, 90);
	$pdf->Cell(5,6,':',0, 0, 'L');
	
	$pdf->setXY(55, 91);
	$pdf->SetWidths(array(100));
	$pdf->Row(array($row['nama']), false);
	$pdf->ln();
	//$pdf->Cell(100,6,$row['nama'],0, 0, 'L');

	//$pdf->setXY(20, 100);
	$pdf->setXY($pdf->getX()+10, $pdf->getY());
	$pdf->Cell(50,6,'Alamat  ',0, 0, 'L');

	//$pdf->setXY(50, 100);
	$pdf->setXY($pdf->getX()-20, $pdf->getY());
	$pdf->Cell(5,6,':',0, 0, 'L');

	//$pdf->setXY(55, 100);
	$pdf->setXY($pdf->getX(), $pdf->getY()+1);
	$pdf->SetWidths(array(100));
	$pdf->Row(array($row['alamat']), false);
	$pdf->ln();
	//$pdf->Cell(100,6,$row['alamat'],0, 0, 'L');

	$pdf->setXY($pdf->getX()+10, $pdf->getY());
	$pdf->Cell(50,6,'No Telp/HP  ',0, 0, 'L');
	

	$pdf->setXY($pdf->getX()-20, $pdf->getY());
	$pdf->Cell(5,6,':',0, 0, 'L');

	$pdf->setXY($pdf->getX(), $pdf->getY());
	$pdf->Cell(100,6,$row['telepon'],0, 0, 'L');
	$pdf->ln();
	$pdf->ln();

	$pdf->setXY($pdf->getX()+10, $pdf->getY());
	$pdf->Cell(50,6,'Status  ',0, 0, 'L');

	$pdf->setXY($pdf->getX()-20, $pdf->getY());
	$pdf->Cell(5,6,':',0, 0, 'L');

	$pdf->setXY($pdf->getX(), $pdf->getY());
	$pdf->Cell(100,6,convert_status($row['status']),0, 0, 'L');



	$pdf->SetTitle('Kartu - '.$row['nama']);
	

	$pdf->Output();

	function convert_status($int){
		switch ($int) {
			case 1:
				return 'Belum Dipanggil';
				break;

			case 2:
				return 'Sudah Dipanggil';
				break;

			case 3:
				return 'Belum Lulus Tes dan Wawancara';
				break;

			case 4:
				return 'Lulus Tes dan Wawancara';
				break;

			case 5:
				return 'Belum Lulus Pelatihan';
				break;

			case 6:
				return 'Lulus Pelatihan';
				break;
			
			default:
				return 'Status Undefined';
				break;
		}
	}
?>

