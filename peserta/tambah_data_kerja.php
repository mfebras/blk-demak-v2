<?php
	include 'header.php';

	$_SESSION['page'] = "peserta/tambah_data_kerja";
?>

<link href="../assets/css/jquery-ui.css" rel="stylesheet">

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
							<h3 class="panel-title">Tambah Data Kerja
								<a href="<?php echo ROOT; ?>peserta/index.php#job"><button type="button" class="btn btn-danger btn-xs">Batal</button></a>
							</h3>
						</div>
						<div class="panel-body">
							<form action="<?php echo ROOT; ?>proses/peserta/tambah_data_kerja.php" method="POST">
								<input type="hidden" name="id_peserta" value="<?php echo $_SESSION['id-peserta']?>">
								<table class="table">
									<tbody>
										<tr>
											<th class="attribute">Status Kerja*</th>
											<td class="colon">:</td>
											<td>
												<select id="status_kerja" class="form-control" name="status_kerja" required>
													<option value="Sudah">Sudah bekerja</option>
													<option value="Belum">Belum bekerja</option>
												</select>
											</td>
										</tr>
										<tr>
											<th class="attribute">Jenis Pekerjaan</th>
											<td class="colon">:</td>
											<td>
												<select class="form-control disable" name="jenis_pekerjaan">
													<option value="Karyawan">Karyawan</option>
													<option value="Wirausaha">Wirausaha</option>
												</select>
											</td>
										</tr>
										<tr>
											<th class="attribute">Nama Perusahaan</th>
											<td class="colon">:</td>
											<td>
												<input class="form-control disable" type="text" name="nama_perusahaan">
											</td>
										</tr>
										<tr>
											<th class="attribute">Alamat Perusahaan</th>
											<td class="colon">:</td>
											<td>
												<input class="form-control disable" type="text" name="alamat_perusahaan">
											</td>
										</tr>
										<tr>
											<th class="attribute">Telepon Perusahaan</th>
											<td class="colon">:</td>
											<td>
												<input class="form-control disable" type="text" name="telepon_perusahaan">
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

    <script src="../assets/js/jquery.js"></script>
    <script type="text/javascript">
    	// mengaktifkan dan men-non-aktifkan form
    	$('#status_kerja').change(function(){
    		var status = $('#status_kerja').val();
    		if (status == "Belum") {
    			$('.disable').prop("disabled", true);
    			$(".disable").prop("required",false);
    		} else {
    			$('.disable').prop("disabled", false);
    			$(".disable").prop("required",true);
    		}
    	});
    </script>

  </body>
</html>