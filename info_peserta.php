<?php
  include 'header.php';

  require_once ('proses/koneksi_db.php');
  require_once ('.env.php');

  // ambil daftar kejuruan
  $id_peserta = $_SESSION['id_peserta'];

  $get_sql = "SELECT peserta.*, kejuruan.nama_kejuruan
              FROM peserta
              RIGHT JOIN registrasi_pelatihan ON peserta.id = registrasi_pelatihan.id_peserta
              RIGHT JOIN kejuruan ON registrasi_pelatihan.id_kejuruan = kejuruan.id_kejuruan
              WHERE peserta.id=$id_peserta";
        
  $result = mysqli_query($connect, $get_sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $_SESSION['page'] = "info_peserta";

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
              <?php
                if (isset($_SESSION['success-register'])) {
                  echo '<div class="alert alert-success">'. $_SESSION['success-register'] .'</div>';
                  session_unset($_SESSION['success-register']);
                }
              ?>
              <table class="table">
                <tbody>
                  <tr>
                    <th class="attribute">No KTP*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['no_ktp']; ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">Nama Lengkap*</th>
                    <td class="colon">:</td>
                    <td><?php echo ucwords($row['nama']); ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">Jenis Kelamin*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['jenis_kelamin']; ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">Tempat Lahir*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['tempat_lahir']; ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">Tanggal Lahir*</th>
                    <td class="colon">:</td>
                    <td><?php echo ($id_peserta == '') ? '' : date('d F Y', strtotime($row['tanggal_lahir'])); ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">Agama*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['agama']; ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">Alamat*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['alamat']; ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">Kecamatan*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['kecamatan']; ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">No Telepon/ HP*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['telepon']; ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">Pendidikan Terakhir*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['pendidikan_terakhir']; ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">Anda mendapat informasi pendaftaran pelatihan kerja (BLK) dari*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['sumber_info']; ?></td>
                  </tr>

                  <tr>
                    <td colspan="3">
                      <hr>
                    </td>
                  </tr>
                  
                  <tr>
                    <th class="attribute">Kejuruan*</th>
                    <td class="colon">:</td>
                    <td><?php echo $row['nama_kejuruan']; ?></td>
                  </tr>

                </tbody>
              </table>

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

  </body>
</html>