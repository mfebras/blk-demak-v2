      

      <?php

        include 'header.php';
        require_once ('../proses/koneksi_db.php');
        require_once ('../proses/convert_date.php');
        require_once ('../proses/helper.php');



      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Data Register</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Tabel Register Pelatihan</h4>  
                <hr>

                <a href="../proses/admin/cetak_register.php" target="_blank" style="margin-bottom:10px" class="btn btn-primary pull-right"  >Cetak Peserta yang lolos tes dan wawancara</a>
                <br>
                <div class="clearfix" ></div>
                
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
                
                <table class="table table-hover" id="tableRegister">
                  <thead>
                    <tr>
                      <th>No Pendaftaran</th>
                      <th>Nama Peserta</th>
                      <th>Kejuruan</th>
                      <th>Tanggal Registrasi</th>
                      <th>Status Peserta</th>
                      <!-- <th>Tahun Pelatihan</th> -->
                      <th>Aksi</th>
                    </tr>

                  </thead>
                  <tbody>
                    <?php

                      $query = mysqli_query($connect, "SELECT * FROM peserta, registrasi_pelatihan, kejuruan WHERE registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan AND registrasi_pelatihan.id_peserta =peserta.id ORDER BY registrasi_pelatihan.status, registrasi_pelatihan.tanggal_registrasi DESC ");

                      if(!$query){
                        die("QUERY FAILED : ". mysqli_error($connect));
                      }

                      $num = mysqli_num_rows($query);

                      if($num<=0){

                        /*echo "<tr align=center><td colspan=7>Tidak ada data jadwal....</td></tr>";*/

                      }else{

                        $no = 1;
                        while ($row=mysqli_fetch_object($query)) {

                          $tanggal_registrasi = convertDate($row->tanggal_registrasi, 'd M Y');

                          echo "<tr>";
                          echo "<td>".$row->no_registrasi."</td>";
                          echo "<td>".$row->nama."</td>";
                          echo "<td>".$row->nama_kejuruan."</td>";
                          echo "<td>".$tanggal_registrasi."</td>";
                          echo "<td>".convertStatusRegistrasi($row->status)."</td>";
                          echo "<td>";
                          echo "<a href=\"detail_peserta.php?id_peserta=".$row->id."\" class=\"btn btn-primary btn-xs\" data-tooltip=\"true\" title=\"Lihat Detail Peserta\" ><i class=\"fa fa-eye\"></i></a> ";
                          echo "<a href=\"#\" data-id_registrasi=\"".$row->id_registrasi."\" data-no_pendaftaran=\"".$row->no_registrasi."\" data-nama=\"".$row->nama."\" data-nama_kejuruan=\"".$row->nama_kejuruan."\" data-tanggal=\"".$tanggal_registrasi."\" data-status=\"".$row->status."\" data-target=\"#modalPeserta\" data-toggle=\"modal\"  class=\"btn btn-info btn-xs\" data-tooltip=\"true\" title=\"Ubah Status Peserta\" ><i class=\"fa fa-pencil\"></i></a> ";
                          /*echo "<a href=\"#\" onclick=\"return confirm('Anda Yakin akan menghapus peserta ini??')\"class=\"btn btn-danger btn-xs\" data-tooltip=\"true\" title=\"Hapus Peserta\" ><i class=\"fa fa-trash-o\"></i></a>";*/
                          echo "</td>";
                          echo "</tr>";

                          $no++;
                        }
                     
                        
                      }

                    ?>
                   <!--  <tr>
                      <td>I</td>
                      <td>Memasak</td>
                      <td>APPBN</td>
                      <td>12 Peserta</td>
                      <td>12 Januari 2017</td>
                      <td>19 Januari 2017</td> -->
                      <!-- <td>2017</td> -->
                      <!-- <td>
                        <a href="#" class="btn btn-info btn-xs" data-toggle="tooltip" title="Ubah Data Jadwal" ><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus Data Jadwal" ><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr> -->
                  </tbody>
                </table>
              
              </div>
            </div>

          
          </div>
        </section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

    <!--main content end-->
     <!-- MODAL-->
      <div class="modal fade" id="modalPeserta" tabindex="-1" role="dialog" aria-labelledby="modalPesertaLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="modalPesertaLabel">Ubah Jadwal</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal style-form" method="POST" >

                <div class="form-group">
                  <label class="col-sm-4 control-label">No Peserta</label>
                  <div class="col-sm-8">
                    <input type="text"  name="no_pendaftaran" disabled class="form-control" placeholder="Nama Peserta" required > 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Nama Peserta</label>
                  <div class="col-sm-8">
                    <input type="text" name="nama_peserta" disabled class="form-control" placeholder="Nama Peserta" required > 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Kejuruan</label>
                  <div class="col-sm-8">
                    <input type="text" name="nama_kejuruan" disabled class="form-control" placeholder="Kejuruan" required > 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Tanggal Registrasi</label>
                  <div class="col-sm-8">
                    <input type="text" name="tanggal_registrasi"disabled class="form-control" placeholder="Tanggal Register" required > 
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Status Peserta</label>
                  <div class="col-sm-8">
                    <select class="form-control"  name="status">
                      <option value="1">Belum Dipanggil</option>
                      <option value="2">Sudah Dipanggil</option>
                      <option value="3">Belum Lulus Tes dan Wawancara</option>
                      <option value="4">Lulus Tes dan Wawancara</option>
                      <option value="5">Belum Lulus Pelatihan</option>
                      <option value="6">Lulus Pelatihan</option>
                    </select>
                  </div>
                </div>

            </div>
            <div class="modal-footer">
              <div id="footerModalDetail">
              <button type="submit" class="btn btn-primary" id="edit">Ubah</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>  
       <!-- END MODAL--> 
    

      <?php

        include 'footer.php';

      ?>
      <script>
        var tgl_seleksi_awal;
        var tgl_pelatihan_awal;

        $(document).ready(function(){

          var tabel = $('#tableRegister').DataTable({
              "language": {
                "emptyTable": "Tidak ada data registrasi"
              }
          });



          /*JS FOR MODAL*/
          $('#modalPeserta').on('show.bs.modal', function(e){
             var id = $(e.relatedTarget).data('id_registrasi');
             var no_pendaftaran = $(e.relatedTarget).data('no_pendaftaran');
             var nama_kejuruan = $(e.relatedTarget).data('nama_kejuruan');
             var nama = $(e.relatedTarget).data('nama');
             var tanggal_registrasi = $(e.relatedTarget).data('tanggal');
             var status = $(e.relatedTarget).data('status');

            
             var action = "../proses/admin/ubah_status_register.php?id="+id+"&prev_page=data_register";

             $('.modal input[name="no_pendaftaran"]').val(no_pendaftaran);
             $('.modal input[name="nama_kejuruan"]').val(nama_kejuruan);
             $('.modal input[name="nama_peserta"]').val(nama);
             $('.modal select[name="status"]').val(status);

             $('.modal input[name="tanggal_registrasi"]').val(tanggal_registrasi);
             

             $('.modal form').attr('action', action);

             
          });  


        });
      </script>