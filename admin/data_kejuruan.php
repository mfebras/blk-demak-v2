      

      <?php

        include 'header.php';
        require_once ('../proses/koneksi_db.php');

      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Data Kejuruan</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Tabel Kejuruan</h4>
                <hr>

                <button style="margin-bottom:10px" class="btn btn-primary pull-right" id="tambah" type="button" data-toggle="collapse" href="#collapseForm"  >Tambah Kejuruan</button>
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
                      <h4><i class="fa fa-angle-right"></i> Form Kejuruan</h4>  
                      <hr>

                      <form class="form-horizontal style-form" method="POST" action="../proses/admin/tambah_kejuruan.php" style="margin-top:20px">

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nama Kejuruan</label>
                          <div class="col-sm-8">
                            <input type="text" name="nama_kejuruan" class="form-control" placeholder="Nama Kejuruan" required >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Kode Kejuruan</label>
                          <div class="col-sm-8">
                            <input type="text" name="kode_kejuruan" class="form-control" placeholder="Kode Kejuruan" required >
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
                <!-- END COLLAPSE FORM -->

                
                <table class="table table-hover" id="table_kejuruan">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kejuruan</th>
                      <th>Kode Kejuruan</th>
                      <th>Status</th>
                      <th>Aksi</th>
      
                    </tr>

                  </thead>
                  <tbody>
                    <?php

                      $query = mysqli_query($connect, "SELECT * FROM kejuruan ORDER BY date_created DESC");

                      $num = mysqli_num_rows($query);

                      if($num<=0){

                        /*echo "<tr align=center><td  colspan=3>Tidak ada data kejuruan....</td></tr>";*/

                      }else{

                        $no = 1;
                        while ($row=mysqli_fetch_object($query)) {

                          //jika status hapus == 0 maka belum dihapus
                          //jika status hapus == 1 maka sudah dihapus
                          if($row->status_hapus==0){

                            $action = "<a href=\"../proses/admin/hapus_kejuruan.php?id=".$row->id_kejuruan."\" onclick=\"return confirm('Anda Yakin akan menonaktifkan kejuruan ini??')\" class=\"btn btn-danger btn-xs\" data-tooltip=\"true\" title=\"Non Aktifkan Kejuruan\" ><i class=\"fa fa-trash-o\"></i></a>";
                            
                            $status = "<span class=\"label label-success\">Aktif</span>";
                          }else{

                            $action = "<a href=\"../proses/admin/kembalikan_kejuruan.php?id=".$row->id_kejuruan."\" onclick=\"return confirm('Anda Yakin akan mengaktifkan kejuruan ini??')\"class=\"btn btn-success btn-xs\" data-tooltip=\"true\" title=\"Aktifkan Kejuruan\" ><i class=\"fa fa-undo\"></i></a>";
                            
                            $status = "<span class=\"label label-danger\">Tidak Aktif</span>";
                          }

                          echo "<tr>";
                          echo "<td>".$no."</td>";
                          echo "<td>".$row->nama_kejuruan."</td>";
                          echo "<td>".$row->kode_kejuruan."</td>";
                          echo "<td>".$status."</td>";
                          echo "<td>";
                          echo "<a href=\"#\" data-target=\"#modalKejuruan\" data-toggle=\"modal\" data-id=\"".$row->id_kejuruan."\" data-kejuruan=\"".$row->nama_kejuruan."\" data-kode=\"".$row->kode_kejuruan."\" class=\"btn btn-info btn-xs\" data-tooltip=\"true\" title=\"Ubah Kejuruan\" ><i class=\"fa fa-pencil\"></i></a> ";
                          echo $action;
                          /*echo "<a href=\"../proses/admin/hapus_kejuruan.php?id=".$row->id_kejuruan."\" onclick=\"return confirm('Anda Yakin akan menghapus kejuruan ini??')\"class=\"btn btn-danger btn-xs\" data-tooltip=\"true\" title=\"Hapus Kejuruan\" ><i class=\"fa fa-trash-o\"></i></a>";*/
                          echo "</td>";
                          echo "</tr>";

                          $no++;
                        }
                     
                        
                      }

                    ?>

                    <!-- <tr>
                      <td>1</td>
                      <td>Menjahit Pakaian</td>
                      <td>
                        <a href="#" class="btn btn-info btn-xs" data-toggle="tooltip" title="Ubah Kejuruan" ><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus Kejuruan" ><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr> -->


                  </tbody>
                </table>
              </div>
              <!-- END SHOWBACK -->
            </div>

          </div>
        </section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

    <!--main content end-->
    <!-- MODAL-->
    <div class="modal fade" id="modalKejuruan" tabindex="-1" role="dialog" aria-labelledby="modalKejuruanLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="modalKejuruanLabel">Ubah Kejuruan</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal style-form" method="POST">
              <fieldset id="fieldset">
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Nama Kejuruan</label>
                    <div class="col-sm-8">
                        <input type="text" name="nama_kejuruan" class="form-control" placeholder="Nama Kejuruan" required >
                    </div>
                </div>                

                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Kode Kejuruan</label>
                    <div class="col-sm-8">
                        <input type="text" name="kode_kejuruan" class="form-control" placeholder="Kode Kejuruan" required >
                    </div>
                </div>
              </fieldset>
            

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
        $(document).ready(function(){

            var table = $('#table_kejuruan').DataTable({
              "language": {
                "emptyTable": "Tidak ada data kejuruan"
              }
          });

            $("#batal").click(function(){
              $("#collapseForm").collapse('hide');
              $('#tambah').focus();
            });

            $('#modalKejuruan').on('show.bs.modal', function(e){
               var id = $(e.relatedTarget).data('id');
               var nama_kejuruan = $(e.relatedTarget).data('kejuruan');
               var kode_kejuruan = $(e.relatedTarget).data('kode');
               var action = "../proses/admin/ubah_kejuruan.php?id="+id;

               $('.modal input[name="nama_kejuruan"]').val(nama_kejuruan);

               $('.modal input[name="kode_kejuruan"]').val(kode_kejuruan);

               $('.modal form').attr('action', action);

               
            });  
        });
      </script>