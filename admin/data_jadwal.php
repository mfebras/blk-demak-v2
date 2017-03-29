      

      <?php

        include 'header.php';
        require_once ('../proses/koneksi_db.php');
        require_once ('../proses/convert_date.php');



      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Data Jadwal</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Tabel Jadwal Pelatihan</h4>  
                <hr>
                <button style="margin-bottom:10px" class="btn btn-primary pull-right" id="tambah" type="button" data-toggle="collapse" href="#collapseForm"  >Tambah Jadwal</button>
                <br>
                <div class="clearfix" >

                </div>
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
                <!-- COLLAPSE FORM -->
                <div class="collapse col-sm-12" style="margin-top:15px" id="collapseForm">
                  <div class="well">
                    <div class="showback">
                      <h4><i class="fa fa-angle-right"></i> Form Jadwal</h4>  
                      <hr>

                      <form class="form-horizontal style-form" method="POST" action="../proses/admin/tambah_jadwal.php" style="margin-top:20px">

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Angkatan</label>
                          <div class="col-sm-8">
                            <select name="angkatan" class="form-control" required>
                              <option value="I">Angkatan I</option>
                              <option value="II">Angkatan II</option>
                              <option value="III">Angkatan III</option>
                              <option value="IV">Angkatan IV</option>
                              <option value="V">Angkatan V</option>
                            </select>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nama Kejuruan</label>
                          <div class="col-sm-8">
                            <select name="kejuruan" class="form-control" required>
                              <?php

                                $query = mysqli_query($connect, "SELECT * FROM kejuruan WHERE  status_hapus = 0 ORDER BY date_created DESC");

                                while($row=mysqli_fetch_object($query)){
                                  echo "<option value=".$row->id_kejuruan.">".$row->nama_kejuruan."</option>";
                                }


                              ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Sumber Dana</label>
                          <div class="col-sm-8">
                            <select name="sumber_dana" class="form-control" required>
                              <option value="APBD">APBD</option>
                              <option value="APBN">APBN</option>
                             
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Kapasitas</label>
                          <div class="col-sm-3">
                            <input type="number" name="kapasitas" min="1" class="form-control" placeholder="Kapasitas" required > 
                          </div>
                          <span class="col-sm-1" style="padding:5px">peserta</span>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Seleksi</label>
                          <div class="col-sm-3">
                            <input type="text" name="seleksi_awal" class="form-control" placeholder="Awal Seleksi" required >
                          </div>
                          <span class="col-sm-1" style="padding:5px">sampai</span>
                          <div class="col-sm-3">
                            <input type="text" name="seleksi_akhir" class="form-control" disabled placeholder="Akhir Seleksi" required >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Pelatihan</label>
                          <div class="col-sm-3">
                            <input type="text" name="pelatihan_awal" class="form-control" disabled placeholder="Awal Pelatihan" required >
                          </div>
                          <span class="col-sm-1" style="padding:5px">sampai</span>
                          <div class="col-sm-3">
                            <input type="text" name="pelatihan_akhir" class="form-control" disabled placeholder="Akhir Pelatihan" required >
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-12">
                              <input type="submit" class="btn btn-primary pull-right" value="Simpan"></input>
                              <button type="button" class="btn btn-danger pull-right" style="margin-right:20px" id="batal">Batal</button>               
                          </div>        
                        </div>
                      
                      </form>
                    </div>

                  </div>

                </div>
                <table class="table table-hover" id="tableJadwal">
                  <thead>
                    <tr>
                      <th>Angkatan</th>
                      <th>Nama Kejuruan</th>
                      <th>Sumber Dana</th>
                      <th>Kapasitas</th>
                      <th>Jumlah Peserta</th>
                      <th>Tanggal Seleksi</th>
                      <th>Tanggal Pelatihan</th>
                      <th>Status</th>
                      <!-- <th>Tahun Pelatihan</th> -->
                      <th>Aksi</th>
                    </tr>

                  </thead>
                  <tbody>
                    <?php

                      $query = mysqli_query($connect, "SELECT * FROM jadwal, kejuruan WHERE jadwal.id_kejuruan=kejuruan.id_kejuruan AND jadwal.status_hapus=0 ORDER BY jadwal.date_created DESC");

                      if(!$query){
                        die("QUERY FAILED : ". mysqli_error($connect));
                      }

                      $num = mysqli_num_rows($query);

                      if($num<=0){

                        /*echo "<tr align=center><td colspan=7>Tidak ada data jadwal....</td></tr>";*/

                      }else{

                        $no = 1;
                        while ($row=mysqli_fetch_object($query)) {

                          if($row->status_pelaksanaan=='sudah'){
                            $status = "<span  class=\"label label-success\">Sudah Terlaksana</span>";
                          }else{
                            $status = "<span  class=\"label label-danger\">Belum Terlaksana</span>";
                          }

                          $tgl_seleksi = concateDate($row->seleksi_awal, $row->seleksi_akhir);
                          $tgl_pelatihan = concateDate($row->pelatihan_awal, $row->pelatihan_akhir);

                          $seleksi_awal = convertDate($row->seleksi_awal, "d M Y");
                          $seleksi_akhir = convertDate($row->seleksi_akhir, "d M Y");
                          $pelatihan_awal = convertDate($row->pelatihan_awal, "d M Y");
                          $pelatihan_akhir = convertDate($row->pelatihan_akhir, "d M Y");

                          $query_jumlah_peserta = mysqli_query($connect, "SELECT count(*) as jumlah_peserta FROM registrasi_pelatihan WHERE id_jadwal=$row->id_jadwal ");


                          $data = mysqli_fetch_object($query_jumlah_peserta);

                          $jumlah_peserta = $data->jumlah_peserta;

                          echo "<tr>";
                          echo "<td>".$row->angkatan."</td>";
                          echo "<td>".$row->nama_kejuruan."</td>";
                          echo "<td>".$row->sumber_dana."</td>";
                          echo "<td>".$row->kapasitas."</td>";
                          echo "<td>".$jumlah_peserta."</td>";
                          echo "<td>".$tgl_seleksi."</td>";
                          echo "<td>".$tgl_pelatihan."</td>";
                          echo "<td>".$status."</td>";
                          echo "<td>";
                          echo "<a href=\"detail_jadwal.php?id=".$row->id_jadwal."\" class=\"btn btn-primary btn-xs\" data-tooltip=\"true\" title=\"Detail Jadwal\" ><i class=\"fa fa-eye\"></i></a> ";
                          echo "<a href=\"#\" data-target=\"#modalJadwal\" data-toggle=\"modal\" data-id=\"".$row->id_jadwal."\" data-id_kejuruan=\"".$row->id_kejuruan."\" data-angkatan=\"".$row->angkatan."\" data-kapasitas=\"".$row->kapasitas."\" data-status=\"".$row->status_pelaksanaan."\"  data-sumber_dana=\"".$row->sumber_dana."\" data-seleksi_awal=\"".$seleksi_awal."\" data-seleksi_akhir=\"".$seleksi_akhir."\" data-pelatihan_awal=\"".$pelatihan_awal."\" data-pelatihan_akhir=\"".$pelatihan_akhir."\" class=\"btn btn-info btn-xs\" data-tooltip=\"true\" title=\"Ubah Jadwal\" ><i class=\"fa fa-pencil\"></i></a> ";
                          /*echo "<a href=\"#\" onclick=\"return confirm('Anda Yakin akan menghapus jadwal ini??')\"class=\"btn btn-danger btn-xs\" data-tooltip=\"true\" title=\"Hapus Jadwal\" ><i class=\"fa fa-trash-o\"></i></a>";*/
                          echo "<a href=\"../proses/admin/hapus_jadwal.php?id=".$row->id_jadwal."\" onclick=\"return confirm('Anda Yakin akan menghapus jadwal ini??')\"class=\"btn btn-danger btn-xs\" data-tooltip=\"true\" title=\"Hapus Jadwal\" ><i class=\"fa fa-trash-o\"></i></a>";
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
      <div class="modal fade" id="modalJadwal" tabindex="-1" role="dialog" aria-labelledby="modalJadwalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="modalJadwalLabel">Ubah Jadwal</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal style-form" method="POST">
                <div class="form-group">
                  <label class="col-sm-4 control-label">Angkatan</label>
                  <div class="col-sm-8">
                    <select name="angkatan" class="form-control" required>
                      <option value="I">Angkatan I</option>
                      <option value="II">Angkatan II</option>
                      <option value="III">Angkatan III</option>
                      <option value="IV">Angkatan IV</option>
                      <option value="V">Angkatan V</option>
                    </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-4 control-label">Nama Kejuruan</label>
                  <div class="col-sm-8">
                    <select name="kejuruan" class="form-control" required>
                      <?php

                        $query = mysqli_query($connect, "SELECT * FROM kejuruan ORDER BY date_created DESC");

                        while($row=mysqli_fetch_object($query)){
                          echo "<option value=".$row->id_kejuruan.">".$row->nama_kejuruan."</option>";
                        }


                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Sumber Dana</label>
                  <div class="col-sm-8">
                    <select name="sumber_dana" class="form-control" required>
                      <option value="APBD">APBD</option>
                      <option value="APBN">APBN</option>
                     
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Kapasitas</label>
                  <div class="col-sm-3">
                    <input type="number" name="kapasitas" min="1" class="form-control" placeholder="Kapasitas" required > 
                  </div>
                  <span class="col-sm-1" style="padding:5px">peserta</span>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Tanggal Seleksi</label>
                  <div class="col-sm-3">
                    <input type="text" name="seleksi_awal" class="form-control" placeholder="Awal Seleksi" required >
                  </div>
                  <span class="col-sm-1" style="padding:5px">sampai</span>
                  <div class="col-sm-3">
                    <input type="text" name="seleksi_akhir" class="form-control" placeholder="Akhir Seleksi" required >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Tanggal Pelatihan</label>
                  <div class="col-sm-3">
                    <input type="text" name="pelatihan_awal" class="form-control" placeholder="Awal Pelatihan" required >
                  </div>
                  <span class="col-sm-1" style="padding:5px">sampai</span>
                  <div class="col-sm-3">
                    <input type="text" name="pelatihan_akhir" class="form-control" placeholder="Akhir Pelatihan" required >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Status Pelaksanaan</label>
                  <div class="col-sm-8">
                    <select name="status" class="form-control" required>
                      <option value="belum">Belum Terlaksana</option>
                      <option value="sudah">Sudah Terlaksana</option>
                     
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

          var tabel = $('#tableJadwal').DataTable({
              "language": {
                "emptyTable": "Tidak ada data jadwal"
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
          $('#modalJadwal').on('show.bs.modal', function(e){
             var id = $(e.relatedTarget).data('id');
             var angkatan = $(e.relatedTarget).data('angkatan');
             var id_kejuruan = $(e.relatedTarget).data('id_kejuruan');
             var kapasitas = $(e.relatedTarget).data('kapasitas');
             var sumber_dana = $(e.relatedTarget).data('sumber_dana');
             var status = $(e.relatedTarget).data('status');


             var seleksi_awal = $(e.relatedTarget).data('seleksi_awal');
             var seleksi_akhir = $(e.relatedTarget).data('seleksi_akhir');
             var pelatihan_awal = $(e.relatedTarget).data('pelatihan_awal');
             var pelatihan_akhir = $(e.relatedTarget).data('pelatihan_akhir');



             var action = "../proses/admin/ubah_jadwal.php?id="+id;

             $('.modal select[name="angkatan"]').val(angkatan);
             $('.modal select[name="kejuruan"]').val(id_kejuruan);
             $('.modal input[name="kapasitas"]').val(kapasitas);
             $('.modal select[name="sumber_dana"]').val(sumber_dana);
             $('.modal select[name="status"]').val(status);

             $('.modal input[name="seleksi_awal"]').val(seleksi_awal);
             $('.modal input[name="seleksi_akhir"]').val(seleksi_akhir);
             $('.modal input[name="pelatihan_awal"]').val(pelatihan_awal);
             $('.modal input[name="pelatihan_akhir"]').val(pelatihan_akhir);

             $('.modal form').attr('action', action);

             
          });  


        });
      </script>