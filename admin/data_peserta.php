      

      <?php

        include 'header.php';
        require_once ('../proses/koneksi_db.php');
        require_once ('../proses/convert_date.php');
        require_once ('../proses/helper.php');



      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Data Peserta</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Tabel Peserta</h4>
                <hr>
                <a style="margin-bottom:10px" href="../proses/admin/excel_peserta.php" target="_blank" class="btn btn-primary pull-right" >Ekspor Excel</a>
                <br>

               
                <?php

                  if(isset($_SESSION['error'])){

                    echo "<div class=\"alert alert-danger\" style=\"margin-top:15px\">";
                    echo "<p>".$_SESSION['error']."</p>";
                    echo "</div>";


                    unset($_SESSION['error']);

                  }else if(isset($_SESSION['success'])){
                    echo "<div class=\"alert alert-success\" style=\"margin-top:15px\">";
                    echo "<p>".$_SESSION['success']."</p>";
                    echo "</div>";
                    unset($_SESSION['success']);

                  }

                ?>

                <table class="table table-hover" id="table_peserta">
                  <thead>
                    <tr>
                      <th>Nama Peserta</th>
                      <th>Nomor KTP</th>                      
                      <th>Nomor HP</th>
                      <th>Pendidikan Terakhir</th>     
                      <th>Kecamatan</th>                      
                      <th>Tanggal Daftar</th>                      
                      <th>Aksi</th>
                    </tr>

                  </thead>

                  <tbody>

                    <?php

                      $query = mysqli_query($connect, "SELECT * FROM peserta WHERE status_hapus = 0 ORDER BY peserta.tanggal_daftar DESC");

                      if(!$query){
                        die("QUERY FAILED : ". mysqli_error($connect));
                      }

                      $num = mysqli_num_rows($query);

                      if($num<=0){

                        /*echo "<tr align=center><td colspan=7>Tidak ada data jadwal....</td></tr>";*/

                      }else{

                        
                        while ($row=mysqli_fetch_object($query)) {

                          
                          echo "<tr>";
                          echo "<td>".$row->nama."</td>";
                          echo "<td>".$row->no_ktp."</td>";                          
                          echo "<td>".$row->telepon."</td>";
                          echo "<td>".$row->pendidikan_terakhir."</td>";
                          echo "<td>".$row->kecamatan."</td>";                          
                          echo "<td>".convertDate($row->tanggal_daftar, 'd M Y')."</td>";                         
                          echo "<td>";
                          echo "<a href=\"detail_peserta.php?id_peserta=".$row->id."\" class=\"btn btn-primary btn-xs\" data-tooltip=\"true\" title=\"Lihat Detail Peserta\" ><i class=\"fa fa-eye\"></i></a> ";
                          echo "<a href=\"form_ubah_peserta.php?id_peserta=".$row->id."\" class=\"btn btn-info btn-xs\" data-tooltip=\"true\" title=\"Ubah Data Peserta\" ><i class=\"fa fa-pencil\"></i></a> ";
                          echo "<a href=\"../proses/admin/hapus_peserta.php?id_peserta=".$row->id."\" onclick=\"return confirm('Anda Yakin akan menghapus peserta ini??')\" class=\"btn btn-danger btn-xs\" data-tooltip=\"true\" title=\"Hapus Peserta\" ><i class=\"fa fa-trash-o\"></i></a>";
                          echo "</td>";
                          echo "</tr>";

                          
                        }
                     
                        
                      }

                    ?>

                   <!--  <tr>
                      <td>Mohammad Fajar Ainul Bashri</td>
                      <td>3374011407940002</td>
                      <td>iniemail@email.com</td>
                      <td>088888888888</td>
                      <td>SMA</td>
                      <td>23 Februari 2017 12:12:12</td>                      
                      <td>
                        <a href=\"detail_peserta.php?id_peserta=".$row->id."\" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Lihat Detail Peserta" ><i class="fa fa-eye"></i></a>
                        <a href="ubah_peserta.php" class="btn btn-info btn-xs" data-toggle="tooltip" title="Ubah Data Peserta" ><i class="fa fa-pencil"></i></a>
                        <a href="" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus Peserta" ><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>

                    -->

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

    <!--main content end-->
      
      
     

      <?php

        include 'footer.php';

      ?>

      <script>
        $(document).ready(function(){

            var table = $('#table_peserta').DataTable();

            
            
            $('[data-toggle="tooltip"]').tooltip();   
        });
      </script>