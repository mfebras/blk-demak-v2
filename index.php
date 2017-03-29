<?php
	include "header.php";

	$_SESSION['page'] = "index";
?>

	<div class="page">
		<div class="page-title">
			<div class="container">
				<h3>Beranda</h3>
			</div>
		</div>
		<div class="content">
			<div class="container">
				<p>Kami menyediakan berbagai pelatihan:</p>
				<div class="gallery row">
					<figure>
						<img src="assets/img/beranda/computer.jpg">
						<div class="img-layer">
							<p class="text-center">
								Pelatihan<br>
								Operator Komputer
							</p>
						</div>
					</figure>
					<figure>
						<img src="assets/img/beranda/phone.jpg">
						<div class="img-layer">
							<p class="text-center">
								Pelatihan<br>
								Teknisi Handphone
							</p>
						</div>
					</figure>
					<figure>
						<img src="assets/img/beranda/ac.jpg">
						<div class="img-layer">
							<p class="text-center">
								Pelatihan<br>
								Teknisi AC Split
							</p>
						</div>
					</figure>

					<figure>
						<img src="assets/img/beranda/vespa.jpg">
						<div class="img-layer">
							<p class="text-center">
								Pelatihan<br>
								Mekanik Junior Sepeda Motor
							</p>
						</div>
					</figure>
					<figure>
						<img src="assets/img/beranda/weld.jpg">
						<div class="img-layer">
							<p class="text-center">
								Pelatihan<br>
								Las SMAW
							</p>
						</div>
					</figure>
					<figure>
						<img src="assets/img/beranda/car.jpg">
						<div class="img-layer">
							<p class="text-center">
								Pelatihan<br>
								Mekanik Junior Mobil
							</p>
						</div>
					</figure>

					<figure>
						<img src="assets/img/beranda/sew.jpg">
						<div class="img-layer">
							<p class="text-center">
								Pelatihan<br>
								Menjahit Pakaian
							</p>
						</div>
					</figure>
					<figure>
						<img src="assets/img/beranda/cosmetic.jpg">
						<div class="img-layer">
							<p class="text-center">
								Pelatihan<br>
								Tata Rias Pengantin
							</p>
						</div>
					</figure>
					<figure>
						<img src="assets/img/beranda/agriculture.jpg">
						<div class="img-layer">
							<p class="text-center">
								Pelatihan<br>
								Pemrosesan Hasil Pertanian
							</p>
						</div>
					</figure>
				</div>
				
				<br><br>

				<div class="text-center">
					<a href="<?php echo ROOT; ?>jadwal.php" class="btn blue-btn">
						Lihat Jadwal
					</a>
				</div>
			</div>
		</div>
	</div>

	<?php
		include "footer.php";
	?>

	</body>
</html>