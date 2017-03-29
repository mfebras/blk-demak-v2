<?php
	include "header.php";

	$_SESSION['page'] = "kontak";
?>

<div class="page">
	<div class="page-title">
		<div class="container">
			<h3>Kontak</h3>
		</div>
	</div>
	<div class="content">
        <div class="container">
			<div class="row">
				<div class="col-sm-6" style="margin-top: 75px;">
					<div class="valign-wrapper">
						<div class="icon-wrapper">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
						</div>
						<div class="icon-info valign">Jl. Kantonsari No. 19 Demak (Belakang kantor BAPERMAS/PNPM)</div>
					</div>
					<div class="valign-wrapper" style="margin-top: 10px;">
						<div class="icon-wrapper">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</div>
						<div class="icon-info valign">0291-681718</div>
					</div>
					<div class="valign-wrapper" style="margin-top: 10px;">
						<div class="icon-wrapper">
							<i class="fa fa-paper-plane" aria-hidden="true"></i>
						</div>
						<div class="icon-info valign"><a href="mailto:blkdemak@gmail.com?Subject=Hello" target="_top">blkdemak@gmail.com</a></div>
					</div>
				</div>
				<div class="col-sm-6">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.874261801096!2d110.6190523139467!3d-6.9056359950102335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70eb8b353c312f%3A0xb96403faa0fcfa75!2sBalai+Latihan+Kerja+Demak!5e0!3m2!1sen!2sid!4v1487814127897" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>

			<br>

			<h3 style="margin-bottom: 20px;">Hubungi Kami</h3>
			<div class="row">
				<form action="<?php echo ROOT; ?>proses/kontak.php" method="POST">
	                <input type="hidden" name="page" value="<?php echo $_SESSION['page']; ?>">
	                
					<div class="col-sm-6">
						<div class="form-group">
							<label>Nama*</label>
							<input class="form-control" type="text" name="blk_nama" placeholder="Nama" required>
						</div>
						<div class="form-group">
							<label>Email*</label>
							<input class="form-control" type="text" name="blk_email" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label>Subyek*</label>
							<input class="form-control" type="text" name="subyek" placeholder="Subyek" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Pesan*</label>
							<textarea class="form-control" style="height: 185px;" name="pesan" required></textarea>
						</div>
						<div class="form-group">
							<input class="btn btn-primary pull-right" type="submit" value="Kirim">
						</div>
					</div>
				</form>
			</div>
			<br>
			<br>
			<br>
		</div>
	</div>
</div>

<?php
  include "footer.php";
?>

  </body>
</html>