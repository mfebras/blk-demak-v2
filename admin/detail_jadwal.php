      <?php

        include 'header.php';
        require_once ('../proses/koneksi_db.php');
        require_once ('../proses/convert_date.php');
        require_once ('../proses/helper.php');

        $id_jadwal = $_GET['id'];

        $query = mysqli_query($connect, "SELECT * FROM jadwal, kejuruan WHERE jadwal.id_kejuruan=kejuruan.id_kejuruan AND id_jadwal=$id_jadwal ");

        $num = mysqli_num_rows($query);

        if($num<=0){
          die("DATA TIDAK DITEMUKAN");
        }

        $data = mysqli_fetch_object($query);

        $nama_kejuruan = $data->nama_kejuruan;
        $id_kejuruan = $data->id_kejuruan;
        $kapasitas = $data->kapasitas;

        $status_pelaksanaan = $data->status_pelaksanaan;

        $status_hapus = $data->status_hapus;

        $tgl_pelaksanaan = concateDate($data->pelatihan_awal, $data->pelatihan_akhir);

        if($status_hapus==1){
          header("Location: ../../admin/data_jadwal.php");die();
        }


      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Detail Jadwal</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Tabel Peserta Pelatihan <?php echo "<b>".$nama_kejuruan."</b> (".$tgl_pelaksanaan.") kapasitas = ".$kapasitas." peserta"?></h4>  
                <hr>
                
                <a href="../proses/admin/cetak_absen.php?id_jadwal=<?php echo $id_jadwal?>" target="_blank" style="margin-bottom:10px" class="btn btn-primary pull-right"  >Cetak Absen</a>
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
                
                <table class="table table-hover">
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

                      $query = mysqli_query($connect, "SELECT * FROM peserta, registrasi_pelatihan, kejuruan WHERE registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan AND registrasi_pelatihan.id_peserta = peserta.id AND registrasi_pelatihan.id_jadwal=$id_jadwal ");
                      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                      if(!$query){

                        die("QUERY FAILED : ".mysqli_error($connect));

                      }
                      $num = mysqli_num_rows($query);

                      if($num<=0){

                       

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
                          
                          if($status_pelaksanaan=='belum'){
                            echo "<a onclick=\"return confirm('Hapus peserta ini dari Jadwal?');\" href=\"../proses/admin/hapus_peserta_dari_jadwal.php?id_registrasi=".$row->id_registrasi."&id_jadwal=".$id_jadwal."&id_kejuruan=".$id_kejuruan."\" class=\"btn btn-danger btn-xs\" data-tooltip=\"true\" title=\"Hapus Peserta dari Pelatihan\"><i class=\"fa fa-times\"></i></a>";
                          }


                          echo "</td>";
                          echo "</tr>";

                          $no++;
                        }
                     
                        
                      }

                    ?>


                    <!-- <tr>
                      <td>Mohammad Fajar Ainul Bashri</td>
                      <td>3374011407940002</td>
                      <td>iniemail@email.com</td>
                      <td>088888888888</td>
                      <td>23 Februari 2017 12:12:12</td>
                      <td>Elektro</td>
                      <td><span  class="label label-info">Lulus</span></td>
                      <td>
                        <a href="detail_peserta.php" class="btn btn-primary btn-xs" data-tooltip="true" title="Lihat Detail Peserta" ><i class="fa fa-eye"></i></a>
                        <a href="" class="btn btn-danger btn-xs" data-tooltip="true" title="Hapus Peserta dari Pelatihan"><i class="fa fa-times"></i></a>
                      </td>
                    </tr> -->

                  </tbody>
                </table>
              
              </div>
            </div>
            <!-- END COL 12 -->
            <?php

              if($status_pelaksanaan=='belum'){


            ?>
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Tabel Peserta yang Mendaftar Pelatihan<?php echo "<b> ".$nama_kejuruan."</b> yang lulus tahap tes dan wawancara"?></h4>  
                <hr>
              
                <table class="table table-hover">
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

                      $query = mysqli_query($connect, "SELECT * FROM peserta, registrasi_pelatihan, kejuruan WHERE registrasi_pelatihan.id_kejuruan=kejuruan.id_kejuruan AND peserta.id = registrasi_pelatihan.id_peserta AND registrasi_pelatihan.status=4  AND registrasi_pelatihan.id_kejuruan=$id_kejuruan AND registrasi_pelatihan.id_jadwal=0 ");

                      if(!$query){

                        die("QUERY FAILED : ".mysqli_error($connect));

                      }
                      $num = mysqli_num_rows($query);

                      if($num<=0){

                       

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
                          echo "<a onclick=\"return confirm('Tambahkan peserta ini ke Jadwal?');\" href=\"../proses/admin/tambah_peserta_ke_jadwal.php?id_registrasi=".$row->id_registrasi."&id_jadwal=".$id_jadwal."&kapasitas=".$kapasitas."\" class=\"btn btn-success btn-xs\" data-tooltip=\"true\" title=\"Tambah Peserta ke Pelatihan\"><i class=\"fa fa-plus\"> </i></a>";
                          echo "</td>";
                          echo "</tr>";

                    

                          $no++;
                        }
                     
                        
                      }

                    ?>
                 
                  </tbody>
                </table>
              
              </div>
            </div>

            <?php
              }
            ?>

          
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

          var tabel = $('table').DataTable({
              "language": {
                "emptyTable": "Tidak ada data peserta"
              }
          });

          $("#batal").click(function(){
            $("#collapseForm").collapse('hide');
            $('#tambah').focus();
          });



          /*JS for DATE*/
          $('input[name="seleksi_awal"]').datepicker({
            dateFormat: "mm/dd/yy ",
            altField : $('input[name="seleksi_awal"]'),
            altFormat : "dd M yy",
            onSelect : function(date, obj){
              tgl_seleksi_awal = date;
              

              $('input[name="seleksi_akhir"]').prop('disabled', false);
              $('input[name="pelatihan_awal"]').prop('disabled', false);
              

              $('input[name="seleksi_akhir"]').val("");
              $('input[name="pelatihan_awal"]').val("");
              $('input[name="pelatihan_akhir"]').val("");


              $('input[name="seleksi_akhir"]').datepicker("option",{ minDate: new Date(tgl_seleksi_awal)});

              $('input[name="pelatihan_awal"]').datepicker("option",{ minDate: new Date(tgl_seleksi_awal)})
            }

          });

          $('input[name="seleksi_akhir"]').datepicker({
            dateFormat: "mm/dd/yy ",
            altField : $('input[name="seleksi_akhir"]'),
            altFormat : "dd M yy",
          });


          $('input[name="pelatihan_awal"]').datepicker({
            dateFormat: "mm/dd/yy ",
            altField : $('input[name="pelatihan_awal"]'),
            altFormat : "dd M yy",
            onSelect : function(date, obj){
              tgl_pelatihan_awal = date;
              
              $('input[name="pelatihan_akhir"]').prop('disabled', false);

              $('input[name="pelatihan_akhir"]').val("");

              $('input[name="pelatihan_akhir"]').datepicker("option",{ minDate: new Date(tgl_pelatihan_awal)})
            }

          });

          $('input[name="pelatihan_akhir"]').datepicker({
            dateFormat: "mm/dd/yy ",
            altField : $('input[name="pelatihan_akhir"]'),
            altFormat : "dd M yy",
          });


          /*JS FOR MODAL*/
          $('#modalPeserta').on('show.bs.modal', function(e){
             var id = $(e.relatedTarget).data('id_registrasi');
             var no_pendaftaran = $(e.relatedTarget).data('no_pendaftaran');
             var nama_kejuruan = $(e.relatedTarget).data('nama_kejuruan');
             var nama = $(e.relatedTarget).data('nama');
             var tanggal_registrasi = $(e.relatedTarget).data('tanggal');
             var status = $(e.relatedTarget).data('status');

            
             var action = "../proses/admin/ubah_status_register.php?id="+id+"&prev_page=detail_jadwal&id_jadwal=<?php echo $id_jadwal?>";

             $('.modal input[name="no_pendaftaran"]').val(no_pendaftaran);
             $('.modal input[name="nama_kejuruan"]').val(nama_kejuruan);
             $('.modal input[name="nama_peserta"]').val(nama);
             $('.modal select[name="status"]').val(status);

             $('.modal input[name="tanggal_registrasi"]').val(tanggal_registrasi);
             

             $('.modal form').attr('action', action);

             
          });  


          


        });
      </script>