<?php
	include "header.php";

	/* Koneksi ke DB */
    require_once ('proses/koneksi_db.php');
	require_once ('proses/helper.php');

	$_SESSION['page'] = "hasil_seleksi";

	// pagination
	// http://code.runnable.com/U8dzQWEzMxxqeQ_E/php-pagination-example-using-mysql-database-for-dbms
	$num_rec_per_page = 25;
	if (isset($_GET["page"])) {
		$page  = $_GET["page"]; }
	else {
		$page = 1;
	}
	$start_from = ($page-1) * $num_rec_per_page;

	// ambil daftar peserta lulus
	$tahun = date('Y');
	$get_sql = "SELECT registrasi_pelatihan.no_registrasi, jadwal.angkatan, kejuruan.nama_kejuruan, peserta.nama
				FROM registrasi_pelatihan, jadwal, kejuruan, peserta WHERE registrasi_pelatihan.status='6' AND registrasi_pelatihan.id_jadwal=jadwal.id_jadwal AND registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan AND registrasi_pelatihan.id_peserta=peserta.id AND YEAR(jadwal.pelatihan_awal)='$tahun'
				ORDER BY registrasi_pelatihan.no_registrasi LIMIT $start_from, $num_rec_per_page";
	$result = mysqli_query($connect, $get_sql);

	// pencarian no_registrasi
	if (isset($_POST['search'])) {
		$keyword = $_POST['search'];
		// if (!empty($keyword)) {
			$search = "SELECT registrasi_pelatihan.no_registrasi, jadwal.angkatan, kejuruan.nama_kejuruan, peserta.nama, registrasi_pelatihan.status
						FROM registrasi_pelatihan, jadwal, kejuruan, peserta WHERE registrasi_pelatihan.no_registrasi='$keyword' AND registrasi_pelatihan.id_jadwal=jadwal.id_jadwal AND registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan AND registrasi_pelatihan.id_peserta=peserta.id AND YEAR(jadwal.pelatihan_awal)='$tahun'
						ORDER BY registrasi_pelatihan.no_registrasi";
			$search_result = mysqli_query($connect, $search);

			$check = mysqli_query($connect, $search);
			$check = mysqli_fetch_array($check);
			if (empty($check['no_registrasi'])) {
				$search_2 = "SELECT registrasi_pelatihan.no_registrasi, kejuruan.nama_kejuruan, peserta.nama,
								registrasi_pelatihan.status
							FROM registrasi_pelatihan, kejuruan, peserta WHERE registrasi_pelatihan.no_registrasi='$keyword' AND registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan AND registrasi_pelatihan.id_peserta=peserta.id AND YEAR(registrasi_pelatihan.tanggal_registrasi)='$tahun'
							ORDER BY registrasi_pelatihan.no_registrasi";
				$search_result = mysqli_query($connect, $search_2);
			}
		// }
	}
?>

<div class="page">
	<div class="page-title">
		<div class="container">
			<h3>Pengumuman Hasil Seleksi</h3>
		</div>
	</div>
	<div class="content">
		<div class="container">
			<div class="filter">
				<div class="row">
					<form action="<?php echo ROOT; ?>hasil_seleksi.php" method="POST">
						<div class="form-group col-sm-3">
							<label>Search</label>
							<input type="search" name="search" placeholder="Nomor peserta" value="<?php echo (!empty($keyword)) ? $keyword : '';?>" >
						</div>
						<div class="form-group col-sm-3" style="padding-left: 0px;">
							<input class="btn btn-primary" type="submit" value="Search">
						</div>
					</form>
				</div>
			</div>
			<br>
			<div>
				<?php
					if (!empty($keyword)) {
				?>
				<div class="col-sm-10 col-sm-offset-1">
				<h4 style="font-weight: 600">Hasil Pencarian untuk Seleksi Tahun <?php echo $tahun;?></h4>
					<table class="table table-striped green-table">
						<thead>
							<tr>
								<th class="number">No</th>
								<th>Nomor Pendaftaran</th>
								<th class="name">Nama</th>
								<th>Kejuruan</th>
								<th>Angkatan</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = $start_from + 1;
								while ($row=mysqli_fetch_array($search_result)) {
									echo "<tr>";
									echo '<td class="number">'. $no .'</td>';
									echo '<td>'. $row['no_registrasi'] .'</td>';
									echo '<td>'. $row['nama'] .'</td>';
									echo '<td>'. $row['nama_kejuruan'] .'</td>';
									echo '<td>'. $row['angkatan'] .'</td>';
									echo '<td>'. convertStatusRegistrasi($row['status']) .'</td>';
									echo "</tr>";
									$no++;
								}
							?>
						</tbody>
					</table>
				<?php
					}
					else {
				?>
				<h4 class="schedule-title">Daftar Peserta Lulus Registrasi Pelatihan Tahun <?php echo $tahun;?></h4>
				<div class="col-sm-8 col-sm-offset-2">
					<table class="table table-striped green-table">
						<thead>
							<tr>
								<th class="number">No</th>
								<th>Nomor Pendaftaran</th>
								<th class="name">Nama</th>
								<th>Kejuruan</th>
								<th>Angkatan</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = $start_from + 1;
								while ($row=mysqli_fetch_array($result)) {
									echo "<tr>";
									echo '<td class="number">'. $no .'</td>';
									echo '<td>'. $row['no_registrasi'] .'</td>';
									echo '<td>'. $row['nama'] .'</td>';
									echo '<td>'. $row['nama_kejuruan'] .'</td>';
									echo '<td>'. $row['angkatan'] .'</td>';
									echo "</tr>";
									$no++;
								}
							?>
						</tbody>
					</table>
					<!-- Pagination -->
					<?php
						$page_sql = "SELECT registrasi_pelatihan.no_registrasi, jadwal.angkatan, kejuruan.nama_kejuruan, peserta.nama
							FROM registrasi_pelatihan, jadwal, kejuruan, peserta WHERE registrasi_pelatihan.status='6' AND registrasi_pelatihan.id_jadwal=jadwal.id_jadwal AND registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan AND registrasi_pelatihan.id_peserta=peserta.id AND YEAR(jadwal.pelatihan_awal)='$tahun'
							ORDER BY registrasi_pelatihan.no_registrasi";
						$page_result = mysqli_query($connect, $page_sql);
						$total_records = mysqli_num_rows($page_result);  //count number of records
						$total_pages = ceil($total_records / $num_rec_per_page);
					?>
					<nav aria-label="Page navigation">
						<ul class="pagination">
						<?php
							echo "<li><a href='hasil_seleksi.php?page=1' aria-label='Previous'>".
								'<span aria-hidden="true">|&laquo;</span>'.
								"</a></li> "; // Goto 1st page  

							for ($i=1; $i<=$total_pages; $i++) {
								if($i == $page)
									echo "<li class='active'><a href='hasil_seleksi.php?page=".$i."'>".$i."</a><li> ";
								else
									echo "<li><a href='hasil_seleksi.php?page=".$i."'>".$i."</a><li> "; 
							}; 
							echo "<li><a href='hasil_seleksi.php?page=$total_pages' aria-label='Next'>".
								'<span aria-hidden="true">&raquo;|</span>'.
								"</a></li> "; // Goto last page
						?>
						</ul>
					</nav>

				<?php
					}	// end of else
				?>
				</div>
			</div>

		</div>
	</div>	<!-- ./content -->
</div>

<?php
  include "footer.php";
?>


  </body>
</html>