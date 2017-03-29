<?php
	include 'header.php';

	/* Koneksi ke DB */
	require_once ('../proses/koneksi_db.php');
	require_once ('../proses/helper.php');

	$_SESSION['page'] = "peserta/index";

	// ambil data peserta
	if (isset($_SESSION['id-peserta'])) {
		$id = $_SESSION['id-peserta'];
		$sql = "SELECT * FROM peserta WHERE id = '$id'";

		$result = mysqli_query($connect, $sql);

		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	}
	else {
		// ambil data peserta untuk pendaftar baru
		$no_ktp = $_SESSION['ktp-peserta'];
		$sql = "SELECT * FROM peserta WHERE no_ktp = '$no_ktp'";

		$result = mysqli_query($connect, $sql);

		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$id = $row['id'];
	}

	// ambil daftar kejuruan
	$get_sql = "SELECT * FROM kejuruan WHERE status_hapus=0 ORDER BY date_created";
	$result_kejuruan = mysqli_query($connect, $get_sql);

	// ambil riwayat pelatihan untuk peserta dengan status <= 3
	$get_sql = "SELECT registrasi_pelatihan.no_registrasi, registrasi_pelatihan.status, registrasi_pelatihan.tanggal_registrasi, kejuruan.nama_kejuruan
		FROM registrasi_pelatihan, kejuruan WHERE registrasi_pelatihan.id_peserta='$id' AND registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan AND registrasi_pelatihan.status<='4'";
	$result_pelatihan_status = mysqli_query($connect, $get_sql);

	// ambil riwayat pelatihan
	$get_sql = "SELECT registrasi_pelatihan.no_registrasi, registrasi_pelatihan.status, kejuruan.nama_kejuruan, jadwal.angkatan, jadwal.seleksi_awal FROM registrasi_pelatihan, kejuruan, jadwal WHERE registrasi_pelatihan.id_peserta='$id' AND registrasi_pelatihan.status>='5' AND registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan AND registrasi_pelatihan.id_jadwal=jadwal.id_jadwal ORDER BY registrasi_pelatihan.tanggal_registrasi DESC";
	$result_pelatihan = mysqli_query($connect, $get_sql);

	// ambil daftar kerja
	$get_sql = "SELECT * FROM data_kerja WHERE id_peserta = '$id' ORDER BY date_created";
	$result_kerja = mysqli_query($connect, $get_sql);
	
?>

<div class="page">
	<div class="page-title">
		<div class="container">
			<h3>Profil Saya</h3>
		</div>
	</div>
	<div class="content" style="padding-top: 10px;">
		<div class="container">
			<div class="row profile">
				<div class="col-sm-3">
					<ul class="nav nav-pills nav-stacked" role="tablist">
						<li id="profile-tab" role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profil</a></li>
						<li id="register-tab" role="presentation"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Registrasi Pelatihan</a></li>
						<li id="training-tab" role="presentation"><a href="#training" aria-controls="training" role="tab" data-toggle="tab">Riwayat Pelatihan</a></li>
						<li id="job-tab" role="presentation"><a href="#job" aria-controls="job" role="tab" data-toggle="tab">Data Kerja</a></li>
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="profile">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Profil
										<a href="<?php echo ROOT; ?>peserta/ubah_profil.php"><button type="button" class="btn btn-primary btn-xs">Ubah</button></a>
									</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<tbody>
											<tr>
												<th class="attribute">No KTP</th>
												<td class="colon">:</td>
												<td><?php echo $row['no_ktp']; ?></td>
											</tr>
											<tr>
												<th class="attribute">Nama</th>
												<td class="colon">:</td>
												<td><?php echo $row['nama']; ?></td>
											</tr>
											<tr>
												<th class="attribute">Jenis Kelamin</th>
												<td class="colon">:</td>
												<td><?php echo $row['jenis_kelamin']; ?></td>
											</tr>
											<tr>
												<th class="attribute">Tempat dan Tanggal Lahir</th>
												<td class="colon">:</td>
												<td>
												<?php
												 if($row['tanggal_lahir'] != null) {
												 	$tanggal = strtotime($row['tanggal_lahir']);
												 	echo $row['tempat_lahir'] . ", " . date('j F Y', $tanggal);
												 }
												 ?>	
												 </td>
											</tr>
											<tr>
												<th class="attribute">Agama</th>
												<td class="colon">:</td>
												<td><?php echo $row['agama']; ?></td>
											</tr>
											<tr>
												<th class="attribute">Alamat</th>
												<td class="colon">:</td>
												<td><?php echo $row['alamat']; ?></td>
											</tr>
											<tr>
												<th class="attribute">No HP</th>
												<td class="colon">:</td>
												<td><?php echo $row['telepon']; ?></td>
											</tr>
											<tr>
												<th class="attribute">Email</th>
												<td class="colon">:</td>
												<td><?php echo $row['email']; ?></td>
											</tr>
											<tr>
												<th class="attribute">Pendidikan Terakhir</th>
												<td class="colon">:</td>
												<td><?php echo $row['pendidikan_terakhir']; ?></td>
											</tr>
											<tr>
												<th class="attribute">Anda mendapat informasi pendaftaran pelatihan kerja (BLK) dari</th>
												<td class="colon">:</td>
												<td><?php echo $row['sumber_info']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="register">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Registrasi Pelatihan</h3>
								</div>
								<div class="panel-body">
									<form action="<?php echo ROOT; ?>proses/peserta/reg_pelatihan.php" method="POST">
										<input type="hidden" name="id_peserta" value="<?php echo $id; ?>">
										<?php
											if (isset($_SESSION['error-register'])) {
												echo '<div class="alert alert-danger">'. $_SESSION['error-register'] .'</div>';
												session_unset($_SESSION['error-register']);
											}
											if (isset($_SESSION['success-register'])) {
												echo '<div class="alert alert-success">'. $_SESSION['success-register'] .'</div>';
												session_unset($_SESSION['success-register']);
											}
										?>
										<div class="alert alert-info">Untuk mendaftar pelatihan, pastikan data profil Anda sudah <b>lengkap</b>.<br>
										</div>
										<p>Silakan memilih kejuruan yang ingin diikuti.</p>
										<div class="col-sm-4">
											<div class="form-group row">
												<select id="kejuruan" class="form-control" name="id_kejuruan" required>
													<option value="">-- Pilih kejuruan --</option>
													<?php
														while ($row_kejuruan = mysqli_fetch_array($result_kejuruan)) {
															echo "<option value='".$row_kejuruan['id_kejuruan']."' data-kode='".$row_kejuruan['kode_kejuruan']."'>".$row_kejuruan['nama_kejuruan']."</option>";
														}
													?>
												</select>
												<!-- untuk menyimpan kode kejuruan -->
												<input id="kode_kejuruan" type="hidden" name="kode_kejuruan">
											</div>
											<div class="form-group row">
												<input class="btn btn-primary" type="submit" value="Kirim">
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="training">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Riwayat Pelatihan yang Pernah Diikuti</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>No Pendaftaran</th>
												<th>Kejuruan</th>
												<th>Gelombang</th>
												<th>Tahun</th>
												<th>Status</th>
												<th>
											</tr>
										</thead>
										<tbody>
											<?php
												$no_pelatihan = 1;
												while ($row_pelatihan_status = mysqli_fetch_array($result_pelatihan_status)) {
													echo "<tr>";
													echo "<td>$no_pelatihan</td>";
													echo "<td>". $row_pelatihan_status['no_registrasi'] ."</td>";
													echo "<td>". $row_pelatihan_status['nama_kejuruan'] ."</td>";
													echo "<td></td>";
													echo "<td>". date('Y', strtotime($row_pelatihan_status['tanggal_registrasi'])). "</td>";
													echo "<td>". convertStatusRegistrasi($row_pelatihan_status['status']) ."</td>";
													echo '<td><a href="../proses/peserta/cetak_kartu.php?data-riwayat='. $row_pelatihan_status["no_registrasi"] .'&data-peserta='. $id .'" target="_blank" class="btn btn-primary btn-xs" data-tooltip="true" data-original-title="Cetak Kartu"><i class="fa fa-print"></i></a></td>';
													echo "</tr>";
													$no_pelatihan++;
												}
												while ($row_pelatihan = mysqli_fetch_array($result_pelatihan)) {
													echo "<tr>";
													echo "<td>$no_pelatihan</td>";
													echo "<td>". $row_pelatihan['no_registrasi'] ."</td>";
													echo "<td>". $row_pelatihan['nama_kejuruan'] ."</td>";
													echo "<td>". $row_pelatihan['angkatan'] ."</td>";
													if(empty($row_pelatihan['angkatan'])){
														echo "<td>". date('Y'). "</td>";
													}
													else{
														echo "<td>". date('Y', strtotime($row_pelatihan['seleksi_awal'])). "</td>";
													}
													echo "<td>". convertStatusRegistrasi($row_pelatihan['status']) ."</td>";
													echo '<td><a href="../proses/peserta/cetak_kartu.php?data-riwayat='. $row_pelatihan["no_registrasi"] .'&data-peserta='. $id .'" target="_blank" class="btn btn-primary btn-xs" data-tooltip="true" data-original-title="Cetak Kartu"><i class="fa fa-print"></i></a></td>';
													echo "</tr>";
													$no_pelatihan++;
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="job">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Data Kerja
										<a href="<?php echo ROOT; ?>peserta/tambah_data_kerja.php"><button type="button" class="btn btn-success btn-xs">Tambah</button></a>
									</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Jenis Pekerjaan</th>
												<th>Nama Perusahaan</th>
												<th>Alamat Perusahaan</th>
												<th>Telepon Perusahaan</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
												$no_kerja = 1;
												while ($row_kerja = mysqli_fetch_array($result_kerja)) {
													echo "<tr>";
													if ($row_kerja['status_kerja'] == "Belum"){
														echo "<td>$no_kerja</td>";
														echo "<td class='text-center' colspan=4>Belum Bekerja</td>";
														echo '<td><a href="ubah_data_kerja.php?data-kerja='.$row_kerja["id_data_kerja"]. '" class="btn btn-primary btn-xs" data-tooltip="true" title="" data-original-title="Ubah Data Kerja"><i class="fa fa-pencil"></i></a></td>';
													}
													else {
														echo "<td>$no_kerja</td>";
														echo "<td>". $row_kerja['jenis_pekerjaan'] ."</td>";
														echo "<td>". $row_kerja['nama_perusahaan'] ."</td>";
														echo "<td>". $row_kerja['alamat_perusahaan'] ."</td>";
														echo "<td>". $row_kerja['telepon_perusahaan'] ."</td>";
														echo '<td><a href="ubah_data_kerja.php?data-kerja='.$row_kerja["id_data_kerja"]. '" class="btn btn-primary btn-xs" data-tooltip="true" title="" data-original-title="Ubah Data Kerja"><i class="fa fa-pencil"></i></a></td>';
													}
													echo "</tr>";
													$no_kerja++;
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	include 'footer.php';
?>
	<script type="text/javascript">

		$(document).ready(function () {
        	$('[data-tooltip="true"]').tooltip();
        });

		// ambil data kode kejuruan dan mengisikannya ke form
		$('#kejuruan').change(function(){
			var kode = $('#kejuruan option:selected').data('kode');
			$('#kode_kejuruan').val(kode);
		});
	</script>

  </body>
</html>