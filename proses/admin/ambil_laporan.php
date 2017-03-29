<?php
	
	session_start();
	require_once ('../koneksi_db.php');
	require_once ('../../.env.php');

	$tahun 		= $_POST['tahun'];
	$angkatan 	= $_POST['angkatan'];
	

	$result = '';

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

		$result = $result .'<h4><i class="fa fa-angle-right"></i> Tabel Hasil Pencarian</h4><hr>';

		$result = $result .' <div class="alert alert-danger"> Data pelatihan tidak ada </div>';

	}else{

		$data = array();

		//$properties = array("laki", "perempuan", "jumlah", "industri", "wirausaha");

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
			$total[$angkatanItem]['i'] = 0;
			$total[$angkatanItem]['w'] = 0;

			foreach ($arrayKejuruan as $key => $kejuruanItem) {
				
				$data[$angkatanItem][$kejuruanItem] = array();				

				$data[$angkatanItem][$kejuruanItem]['l'] = 0;
				$data[$angkatanItem][$kejuruanItem]['p'] = 0;
				$data[$angkatanItem][$kejuruanItem]['j'] = 0;
				$data[$angkatanItem][$kejuruanItem]['i'] = 0;
				$data[$angkatanItem][$kejuruanItem]['w'] = 0;

				$query = mysqli_query($connect, "SELECT sum(case when pe.jenis_kelamin = 'Laki-laki' then 1 else 0 end) males,
  														sum(case when pe.jenis_kelamin = 'Perempuan' then 1 else 0 end) females,
  														count(*) total,
  														sum(case when dk.jenis_pekerjaan = 'Karyawan' then 1 else 0 end) industri,
  														sum(case when dk.jenis_pekerjaan = 'Wirausaha' then 1 else 0 end) wir

  														FROM registrasi_pelatihan re LEFT JOIN peserta pe ON re.id_peserta = pe.id
                                                        							 LEFT JOIN jadwal ja ON  re.id_jadwal = ja.id_jadwal 
                                                                                     LEFT JOIN kejuruan ke ON re.id_kejuruan = ke.id_kejuruan 
                                                                                     LEFT JOIN data_kerja dk ON pe.id=dk.id_peserta

  														WHERE ja.angkatan = '".$angkatanItem."' AND YEAR(ja.pelatihan_awal) = '".$tahun."' 
  														AND re.status = 6 AND re.id_kejuruan = $kejuruanItem  														

  														");

				/*$query = mysqli_query($connect, "SELECT sum(case when pe.jenis_kelamin = 'Laki-laki' then 1 else 0 end) males,
  														sum(case when pe.jenis_kelamin = 'Perempuan' then 1 else 0 end) females,
  														count(*) total,
  														sum(case when dk.jenis_pekerjaan = 'Karyawan' then 1 else 0 end) industri,
  														sum(case when dk.jenis_pekerjaan = 'Wirausaha' then 1 else 0 end) wir

  														FROM registrasi_pelatihan re, peserta pe, jadwal ja, kejuruan ke, data_kerja dk

  														WHERE re.id_peserta = pe.id AND re.id_jadwal = ja.id_jadwal AND re.id_kejuruan = ke.id_kejuruan 
  														AND pe.id=dk.id_peserta AND ja.angkatan = '".$angkatanItem."' AND YEAR(ja.pelatihan_awal) = '".$tahun."' 
  														AND re.status = 6 AND re.id_kejuruan = $kejuruanItem  														

  														");*/
				
				if(!$query){

					die("QUERY GET LAPORAN FAILED ". mysqli_error($connect));

				}
				$row = mysqli_fetch_object($query);

				$data[$angkatanItem][$kejuruanItem]['l'] = $row->males;
				$data[$angkatanItem][$kejuruanItem]['p'] = $row->females;
				$data[$angkatanItem][$kejuruanItem]['j'] = $row->total;
				$data[$angkatanItem][$kejuruanItem]['i'] = $row->industri;
				$data[$angkatanItem][$kejuruanItem]['w'] = $row->wir;




			}

		}

		

?>
		<div class="table-title">
			<div class="logo col-sm-2" style="text-align: right;">
				<img src="<?php echo ROOT; ?>assets/img/logo.png">
				<div style="margin-top: 7px;">APBN/APBD</div>
			</div>
			<div class="col-sm-8" style="text-align: center;">
				<h3>DATA PELATIHAN</h3>
				<h3 style="margin-bottom: 5px;">UPTD BALAI LATIHAN KERJA KABUPATEN DEMAK</h3>
				<p>Jl. Kantonsari No. 19 Demak. Telp (0291) 681718</p>
				<p>Email : blkdemak@gmail.com</p>
			</div>
		</div>

		<table border="1" class="table table-striped" align="center" valign="center" style="vertical-align:middle">

			<thead>

				<tr>
					<th rowspan="2">NO</th>
					<th rowspan="2">KEJURUAN</th>

					<?php

						foreach ($arrayAngkatan as $key => $angkatanItem) {
							echo "<th colspan=\"5\">Angkatan ".$angkatanItem."</th>";
						}

					?>

				</tr>
				<tr>
					<?php

						foreach ($arrayAngkatan as $key => $angkatanItem) {
							echo "<th>LK</th>";
							echo "<th>PR</th>";
							echo "<th>JUM</th>";
							echo "<th>IND</th>";
							echo "<th>WIR</th>";
						}

					?>
				</tr>
				

			</thead>

			<tbody>

				<?php
					$no = 1;

					foreach ($arrayNamaKejuruan as $id_kejuruan => $nama_kejuruan) {
					
						echo "<tr>";
						echo "<td>".$no."</td>";
						echo "<td class='kejuruan'>".$nama_kejuruan."</td>";
						foreach ($arrayAngkatan as $key => $angkatanItem) {
							echo "<td>";echo isset($data[$angkatanItem][$id_kejuruan]['l']) ? $data[$angkatanItem][$id_kejuruan]['l'] : 0;echo "</td>";
							echo "<td>";echo isset($data[$angkatanItem][$id_kejuruan]['p']) ? $data[$angkatanItem][$id_kejuruan]['p'] : 0;echo "</td>";
							echo "<td>";echo isset($data[$angkatanItem][$id_kejuruan]['j']) ? $data[$angkatanItem][$id_kejuruan]['j'] : 0;echo "</td>";
							echo "<td>";echo isset($data[$angkatanItem][$id_kejuruan]['i']) ? $data[$angkatanItem][$id_kejuruan]['i'] : 0;echo "</td>";
							echo "<td>";echo isset($data[$angkatanItem][$id_kejuruan]['w']) ? $data[$angkatanItem][$id_kejuruan]['w'] : 0;echo "</td>";
							
							$total[$angkatanItem]['l'] +=  isset($data[$angkatanItem][$id_kejuruan]['l']) ? $data[$angkatanItem][$id_kejuruan]['l'] : 0;
							$total[$angkatanItem]['p'] +=  isset($data[$angkatanItem][$id_kejuruan]['p']) ? $data[$angkatanItem][$id_kejuruan]['p'] : 0;
							$total[$angkatanItem]['j'] +=  isset($data[$angkatanItem][$id_kejuruan]['j']) ? $data[$angkatanItem][$id_kejuruan]['j'] : 0;
							$total[$angkatanItem]['i'] +=  isset($data[$angkatanItem][$id_kejuruan]['i']) ? $data[$angkatanItem][$id_kejuruan]['i'] : 0;
							$total[$angkatanItem]['w'] +=  isset($data[$angkatanItem][$id_kejuruan]['w']) ? $data[$angkatanItem][$id_kejuruan]['w'] : 0;
						}
						echo "</tr>";

						$no++;

					}

				?>

				<tr>
					<td colspan="2"><b>Jumlah</b></td>
					<?php

						foreach ($arrayAngkatan as $key => $angkatanItem) {
							echo "<td><b>".$total[$angkatanItem]['l']."</b></td>";
							echo "<td><b>".$total[$angkatanItem]['p']."</b></td>";
							echo "<td><b>".$total[$angkatanItem]['j']."</b></td>";
							echo "<td><b>".$total[$angkatanItem]['i']."</b></td>";
							echo "<td><b>".$total[$angkatanItem]['w']."</b></td>";
						}

					?>

				</tr>
				
			</tbody>
			

		</table>

		<div style="text-align:right" >

			<a href="../proses/admin/cetak_laporan.php?tahun=<?php echo $tahun;?>&angkatan=<?php echo $angkatan;?>" target="_blank" class="btn btn-primary">Cetak Laporan</a>	
           
        </div>
			


<?php

	}


	echo $result;

?>

	