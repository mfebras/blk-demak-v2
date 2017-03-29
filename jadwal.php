<?php
  include "header.php";

  /* Koneksi ke DB */
  require_once ('proses/koneksi_db.php');
  require_once ('proses/convert_date.php');

  $_SESSION['page'] = "jadwal";

  // ambil daftar jadwal
  $tahun = date('Y');
  $get_sql = "SELECT jadwal.*, kejuruan.nama_kejuruan FROM jadwal, kejuruan 
              WHERE jadwal.id_kejuruan=kejuruan.id_kejuruan AND jadwal.status_hapus=0
              AND YEAR(jadwal.pelatihan_awal)='$tahun' ORDER BY jadwal.angkatan";
  $result = mysqli_query($connect, $get_sql);

  // membuat array jadwal per angkatan
  $tahap = array();
  while ($row=mysqli_fetch_array($result)) {
    $tgl_seleksi = concateDate($row['seleksi_awal'], $row['seleksi_akhir']);
    $tgl_pelatihan = concateDate($row['pelatihan_awal'], $row['pelatihan_akhir']);

    $tahap[$row['angkatan']][] = array('kejuruan'=>$row['nama_kejuruan'], 'dana'=>$row['sumber_dana'],
                    'kapasitas'=>$row['kapasitas'], 'tgl_seleksi'=>$tgl_seleksi, 'tgl_pelatihan'=>$tgl_pelatihan);
  }
?>

    <div class="page">
      <div class="page-title">
        <div class="container">
          <h3>Jadwal dan Jenis Pelatihan</h3>
        </div>
      </div>
      <div class="content">
        <div class="container">
          <?php
            $angkatan = 0;
            if (empty($tahap)) {
              echo '<div class="alert alert-info">Jadwal Pelatihan Tahun '. $tahun .' Belum Tersedia</div>';
            }
            else {
              foreach ($tahap as $key => $jadwal) {
                  echo '<div class="schedule-item">';
                  echo '<h4 class="schedule-title">Pelatihan Tahap '. $key .' Tahun '. $tahun .'</h4>';
                  echo '<table class="table table-striped green-table">';
                  echo '<thead><tr>';
                  echo '<th>No</th>
                      <th class="field">Kejuruan</th>
                      <th class="text-center">Sumber Dana</th>
                      <th>Kapasitas Siswa</th>
                      <th class="date">Rekrutmen dan Seleksi</th>
                      <th class="date">Pelaksanaan Pelatihan</th>
                      ';
                  echo '</tr></thead>';
                  echo '<tbody>';
                  $no = 1;
                  foreach ($jadwal as $value) {
                      echo "<tr>";
                      echo "<td>". $no ."</td>";
                      echo "<td class='field'>". $value['kejuruan'] ."</td>";
                      echo "<td class='text-center'>". $value['dana'] ."</td>";
                      echo "<td class='text-center'>". $value['kapasitas'] ."</td>";
                      echo "<td class='date'>". $value['tgl_seleksi'] ."</td>";
                      echo "<td class='date'>". $value['tgl_pelatihan'] ."</td>";
                      echo "</tr>";
                      $no++;
                  }
                  echo '</tbody>';
                  echo '</table>';
                  echo '</div>';
              }
            }
          ?>

            <!-- Pagination -->
            <!-- <nav aria-label="Page navigation">
              <ul class="pagination">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav> -->
        </div>
      </div>
    </div>

    <?php
      include "footer.php";
    ?>

  </body>
</html>
