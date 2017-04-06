<?php
  include "header.php";

  /* Koneksi ke DB */
  require_once ('proses/koneksi_db.php');
  require_once ('proses/convert_date.php');

  $_SESSION['page'] = "jadwal";

  // ambil daftar jadwal
  $tahun = date('Y');
  $get_sql = "SELECT registrasi_pelatihan.no_registrasi, peserta.*, kejuruan.nama_kejuruan
              FROM registrasi_pelatihan, peserta, kejuruan
              WHERE registrasi_pelatihan.id_peserta = peserta.id AND registrasi_pelatihan.id_kejuruan = kejuruan.id_kejuruan AND YEAR(registrasi_pelatihan.tanggal_registrasi) = $tahun
              ORDER BY (registrasi_pelatihan.no_registrasi)";
  $result = mysqli_query($connect, $get_sql);

?>
    
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <script type="text/javascript" src="datatables/datatables.min.js"></script>

    <div class="page">
      <div class="page-title">
        <div class="container">
          <h3>Daftar Peserta</h3>
        </div>
      </div>
      <div class="content">
        <div class="container">
          <h4 class="schedule-title">Daftar Peserta Pelatihan Tahun <?php echo $tahun;?></h4>
          <div style="overflow-x: auto;">
            <table class="table table-striped green-table" id="table_peserta" style="width: 200%; max-width: 200%;">
              <thead>
                <tr>
                  <th style="width: 45px;">No</th>
                  <th style="width: 130px;">No Pendaftaran</th>
                  <th style="width: 200px;">Nama</th>
                  <th style="width: 150px;">No KTP</th>
                  <th>Jenis Kelamin</th>
                  <th style="width: 140px;">Tempat Lahir</th>
                  <th style="width: 160px;">Tanggal Lahir</th>
                  <th>Agama</th>
                  <th style="width: 300px;">Alamat</th>
                  <th style="width: 140px;">Kecamatan</th>
                  <th style="width: 140px;">No Telepon</th>
                  <th style="width: 170px;">Pendidikan Terakhir</th>
                  <th>Sumber Info</th>
                  <th style="width: 200px;">Kejuruan</th>
                </tr>
              </thead>
              <tbody>
          <?php
            $num = mysqli_num_rows($result);
            if ($num <= 0) {
              echo '<tr><td colspan=14 class="text-center">Belum ada peserta terdaftar.</td></tr>';
            }
            else {
            $no = 1;
              while ($row=mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>'. $no .'</td>';
                echo '<td>'. $row['no_registrasi'] .'</td>';
                echo '<td>'. ucwords(strtolower($row['nama'])) .'</td>';
                echo '<td>'. $row['no_ktp'] .'</td>';
                echo '<td>'. $row['jenis_kelamin'] .'</td>';
                echo '<td>'. $row['tempat_lahir'] .'</td>';
                echo '<td>'. date('d F Y', strtotime($row['tanggal_lahir'])) .'</td>';
                echo '<td>'. $row['agama'] .'</td>';
                echo '<td>'. $row['alamat'] .'</td>';
                echo '<td>'. $row['kecamatan'] .'</td>';
                echo '<td>'. $row['telepon'] .'</td>';
                echo '<td>'. $row['pendidikan_terakhir'] .'</td>';
                echo '<td>'. $row['sumber_info'] .'</td>';
                echo '<td>'. $row['nama_kejuruan'] .'</td>';
                $no++;
              }
            }
          ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>

    <?php
      include "footer.php";
    ?>

    <script>
      $(document).ready(function(){
          var table = $('#table_peserta').DataTable();   
      });
    </script>

  </body>
</html>
