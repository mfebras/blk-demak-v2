<?php
	include 'header.php';


	require_once ('proses/koneksi_db.php');
	require_once ('.env.php');

	// ambil daftar kejuruan
	$this_year = date('Y');
	$get_sql = "SELECT jadwal.id_kejuruan, kejuruan.kode_kejuruan, kejuruan.nama_kejuruan
				FROM jadwal RIGHT JOIN kejuruan ON jadwal.id_kejuruan = kejuruan.id_kejuruan
				WHERE YEAR(jadwal.seleksi_awal) = '$this_year' GROUP BY kejuruan.id_kejuruan";
				
	$result_kejuruan = mysqli_query($connect, $get_sql);

	$_SESSION['page'] = "reg_pelatihan";

?>

<div class="page">
	<div class="page-title">
		<div class="container">
			<h3>Daftar Pelatihan</h3>
		</div>
	</div>
	<div class="content" style="padding-top: 10px;">
		<div class="container">
			<div class="row profile">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="alert alert-info">Silakan isi data berikut untuk mendaftar pelatihan.</div>
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
							<form action="<?php echo ROOT; ?>proses/peserta/reg_pelatihan.php" method="POST">
								<table class="table">
									<tbody>
										<tr>
											<th class="attribute">No KTP*</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="text" name="no_ktp" required></td>
										</tr>
										<tr>
											<th class="attribute">Nama Lengkap*</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="text" name="blk_nama" required></td>
										</tr>
										<tr>
											<th class="attribute">Jenis Kelamin*</th>
											<td class="colon">:</td>
											<td>
												<input id="male" type="radio" name="jenis_kelamin" value="Laki-laki" required>
												<label for="male">Laki-laki</label><br>
												<input id="female" type="radio" name="jenis_kelamin" value="Perempuan" required>
												<label for="female">Perempuan</label>
											</td>
										</tr>
										<tr>
											<th class="attribute">Tempat Lahir*</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="text" name="tempat_lahir" required></td>
										</tr>
										<tr>
											<th class="attribute">Tanggal Lahir*</th>
											<td class="colon">:</td>
											<td>
												<input class="form-control" type="text" name="tanggal_lahir" required data-provide="datepicker">
												<span class="text-muted"><i>Bulan/hari/tahun</i></span>
											</td>
										</tr>
										<tr>
											<th class="attribute">Agama*</th>
											<td class="colon">:</td>
											<td>
												<select name="agama" class="form-control" required>
						                          <option value="">Pilih Agama</option> 
						                          <option value="Islam">Islam</option> 
						                          <option value="Kristen">Kristen</option> 
						                          <option value="Katolik">Katolik</option> 
						                          <option value="Hindu">Hindu</option> 
						                          <option value="Buddha">Buddha</option> 
						                        </select>
											</td>
										</tr>
										<tr>
											<th class="attribute">Alamat*</th>
											<td class="colon">:</td>
											<td><textarea class="form-control" type="text" name="alamat" required ></textarea></td>
										</tr>
										<tr>
											<th class="attribute">Kecamatan*</th>
											<td class="colon">:</td>
											<td>
						                        <select name="kecamatan" class="form-control" required>
						                          <option value="">Pilih Kecamatan Tempat Tinggal</option> 
						                          <option value="Bonang">Bonang</option> 
						                          <option value="Demak">Demak</option>
						                          <option value="Dempet">Dempet</option>
						                          <option value="Gajah">Gajah</option>
						                          <option value="Guntur">Guntur</option>
						                          <option value="Karanganyar">Karanganyar</option>
						                          <option value="Karangawen">Karangawen</option>
						                          <option value="Karangtengah">Karangtengah</option>
						                          <option value="Kebonagung">Kebonagung</option>
						                          <option value="Mijen">Mijen</option>
						                          <option value="Mranggen">Mranggen</option>
						                          <option value="Sayung">Sayung</option>
						                          <option value="Wedung">Wedung</option>
						                          <option value="Wonosalam">Wonosalam</option>
						                        </select>
											</td>
										</tr>
										<tr>
											<th class="attribute">No Telepon/ HP*</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="tel" name="telepon" required></td>
										</tr>
										<tr>
											<th class="attribute">Pendidikan Terakhir*</th>
											<td class="colon">:</td>
											<td>
												<select name="pendidikan_terakhir" class="form-control" required>
						                          <option value="">Pilih Pendidikan</option> 
						                          <option value="Tidak Sekolah">Tidak Sekolah</option> 
						                          <option value="SD Sederajat">SD Sederajat</option> 
						                          <option value="SMP Sederajat">SMP Sederajat</option> 
						                          <option value="SMA Sederajat">SMA Sederajat</option> 
											</td>
										</tr>
										<tr>
											<th class="attribute">Anda mendapat informasi pendaftaran pelatihan kerja (BLK) dari*</th>
											<td class="colon">:</td>
											<td>
						                        <select name="sumber_info" class="form-control" required>
						                          <option value="">Pilih Sumber Info</option> 
						                          <option value="Brosur">Brosur</option>
						                          <option value="Media Sosial">Media Sosial</option>
						                        </select>
											</td>
										</tr>

										<tr>
											<td colspan="3">
												<hr>
											</td>
										</tr>
										
										<tr>
											<th class="attribute">Kejuruan*</th>
											<td class="colon">:</td>
											<td>
						                        <select id="kejuruan" name="kejuruan" class="form-control" required>
						                          <option value="">Pilih Kejuruan</option> 
						                          <?php
														while ($row_kejuruan = mysqli_fetch_array($result_kejuruan)) {
															echo "<option value='".$row_kejuruan['id_kejuruan']."' data-kode='".$row_kejuruan['kode_kejuruan']."'>".$row_kejuruan['nama_kejuruan']."</option>";
														}
													?>
						                        </select>
												<!-- untuk menyimpan kode kejuruan -->
												<input id="kode_kejuruan" type="hidden" name="kode_kejuruan">
											</td>
										</tr>

										<tr>
											<td colspan="3"><i>*) Wajib diisi.</i></td>
										</tr>
										<tr>
											<th class="attribute"></th>
											<td class="colon"></td>
											<td><input class="btn btn-primary" type="submit" value="Kirim"></td>
										</tr>
									</tbody>
								</table>
							</form>
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

    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript">
	
        $('input[name="tanggal_lahir"]').datepicker({
            dateFormat: "mm/dd/yy ",
            altField : $('input[name="pelatihan_akhir"]'),
            altFormat : "dd M yy",
        });

        // ambil data kode kejuruan dan mengisikannya ke form
		$('#kejuruan').change(function(){
			var kode = $('#kejuruan option:selected').data('kode');
			$('#kode_kejuruan').val(kode);
		});

	</script>

  </body>
</html>