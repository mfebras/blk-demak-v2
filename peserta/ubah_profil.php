<?php
	include 'header.php';

	/* Koneksi ke DB */
    require_once ('../proses/koneksi_db.php');

	$_SESSION['page'] = "peserta/ubah_profil";

	$id = $_SESSION['id-peserta'];
	$sql = "SELECT * FROM peserta WHERE id = '$id'";

	$result = mysqli_query($connect, $sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
				<div class="col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Ubah Profil
								<a href="<?php echo ROOT; ?>peserta/index.php"><button type="button" class="btn btn-danger btn-xs">Batal</button></a>
							</h3>
						</div>
						<div class="panel-body">
							<form action="<?php echo ROOT; ?>proses/peserta/ubah_profil.php" method="POST">
								<input type="hidden" name="id_peserta" value="<?php echo $_SESSION['id-peserta']; ?>">
								<table class="table">
									<tbody>
										<tr>
											<th class="attribute">No KTP*</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="text" name="no_ktp" required value="<?php echo $row['no_ktp'];?>"></td>
										</tr>
										<tr>
											<th class="attribute">Nama*</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="text" name="blk_nama" required value="<?php echo $row['nama'];?>"></td>
										</tr>
										<tr>
											<th class="attribute">Jenis Kelamin*</th>
											<td class="colon">:</td>
											<td>
												<input id="male" type="radio" name="jenis_kelamin" value="Laki-laki" required <?php echo ($row['jenis_kelamin'] == "Laki-laki") ? "checked" : ""; ?> >
												<label for="male">Laki-laki</label><br>
												<input id="female" type="radio" name="jenis_kelamin" value="Perempuan" required <?php echo ($row['jenis_kelamin'] == "Perempuan") ? "checked" : ""; ?> >
												<label for="female">Perempuan</label>
											</td>
										</tr>
										<tr>
											<th class="attribute">Tempat Lahir*</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="text" name="tempat_lahir" required value="<?php echo $row['tempat_lahir'];?>"></td>
										</tr>
										<tr>
											<th class="attribute">Tanggal Lahir*</th>
											<td class="colon">:</td>
											<td>
												<input class="form-control" type="text" name="tanggal_lahir" required value="<?php echo date('m/d/Y', strtotime($row['tanggal_lahir']));?>" data-provide="datepicker">
												<span class="text-muted"><i>Bulan/hari/tahun</i></span>
											</td>
										</tr>
										<tr>
											<th class="attribute">Agama*</th>
											<td class="colon">:</td>
											<td>
												<select name="agama" class="form-control" required>
						                          <option value="">Pilih Agama</option> 
						                          <option value="Islam" <?php echo ($row['agama'] == "Islam") ? "selected" : ""; ?> >Islam</option> 
						                          <option value="Kristen" <?php echo ($row['agama'] == "Kristen") ? "selected" : ""; ?> >Kristen</option> 
						                          <option value="Katolik" <?php echo ($row['agama'] == "Katolik") ? "selected" : ""; ?> >Katolik</option> 
						                          <option value="Hindu" <?php echo ($row['agama'] == "Hindu") ? "selected" : ""; ?> >Hindu</option> 
						                          <option value="Buddha" <?php echo ($row['agama'] == "Buddha") ? "selected" : ""; ?> >Buddha</option> 
						                        </select>
											</td>
										</tr>
										<tr>
											<th class="attribute">Alamat*</th>
											<td class="colon">:</td>
											<td><textarea class="form-control" type="text" name="alamat" required ><?php echo $row['alamat'];?></textarea></td>
										</tr>
										<tr>
											<th class="attribute">No HP*</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="tel" name="telepon" required value="<?php echo $row['telepon'];?>"></td>
										</tr>
										<tr>
											<th class="attribute">Email*</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="email" name="blk_email" required value="<?php echo $row['email'];?>"></td>
										</tr>
										<tr>
											<th class="attribute">Pendidikan Terakhir*</th>
											<td class="colon">:</td>
											<td>
												<select name="pendidikan_terakhir" class="form-control" required>
						                          <option value="">Pilih Pendidikan</option> 
						                          <option value="Tidak Sekolah" <?php echo ($row['pendidikan_terakhir'] == "Tidak Sekolah") ? "selected" : ""; ?> >Tidak Sekolah</option> 
						                          <option value="SD Sederajat" <?php echo ($row['pendidikan_terakhir'] == "SD Sederajat") ? "selected" : ""; ?> >SD Sederajat</option> 
						                          <option value="SMP Sederajat" <?php echo ($row['pendidikan_terakhir'] == "SMP Sederajat") ? "selected" : ""; ?> >SMP Sederajat</option> 
						                          <option value="SMA Sederajat" <?php echo ($row['pendidikan_terakhir'] == "SMA Sederajat") ? "selected" : ""; ?> >SMA Sederajat</option> 
											</td>
										</tr>
										<tr>
											<th class="attribute">Anda mendapat informasi pendaftaran pelatihan kerja (BLK) dari*</th>
											<td class="colon">:</td>
											<td>
						                        <select name="sumber_info" class="form-control" required>
						                          <option value="">Pilih Sumber Info</option> 
						                          <option value="Brosur" <?php echo ($row['sumber_info'] == "Brosur") ? "selected" : ""; ?> >Brosur</option>
						                          <option value="Media Sosial" <?php echo ($row['sumber_info'] == "Media Sosial") ? "selected" : ""; ?> >Media Sosial</option>
						                        </select>
											</td>
										</tr>
										<tr>
											<th class="attribute">Password</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="password" name="blk_password"></td>
										</tr>
										<tr>
											<th class="attribute">Ulangi Password</th>
											<td class="colon">:</td>
											<td><input class="form-control" type="password" name="blk_password_confirm"></td>
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

    <script src="../assets/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript">
	
        $('input[name="tanggal_lahir"]').datepicker({
            dateFormat: "mm/dd/yy ",
            altField : $('input[name="pelatihan_akhir"]'),
            altFormat : "dd M yy",
        });

	</script>

  </body>
</html>