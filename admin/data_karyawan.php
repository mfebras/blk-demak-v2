      

      <?php        
        
        include 'header.php';
        require_once ('../proses/koneksi_db.php');

        if($_SESSION['jabatan']!='admin'){

          header("Location: index.php");
        }
        

      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Data Karyawan</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Tabel Karyawan</h4>  
                <hr>

                <button style="margin-bottom:10px" class="btn btn-primary pull-right" id="tambah" type="button" data-toggle="collapse" href="#collapseForm"  >Tambah Karyawan</button>
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
                      <h4><i class="fa fa-angle-right"></i> Form Karyawan</h4>  
                      <hr>

                      <form class="form-horizontal style-form" method="POST" action="../proses/admin/tambah_karyawan.php" style="margin-top:20px">

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nama Karyawan</label>
                          <div class="col-sm-8">
                            <input type="text" name="nama_karyawan" class="form-control" placeholder="Nama Karyawan" required >
                          </div>
                        </div>                        

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Jabatan</label>
                          <div class="col-sm-8">
                            <select name="jabatan" class="form-control" required>
                              
                              <option value="staff" selected>Staff</option> 
                              <option value="ketua">Ketua</option> 
                              
                              
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Email</label>
                          <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" placeholder="Email" required >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Password</label>
                          <div class="col-sm-8">
                            <input type="text" name="password" class="form-control" placeholder="Password" required >
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

                <table class="table table-hover" id="table_karyawan">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Karyawan</th>
                      <th>Email</th>
                      <th>Jabatan</th>
                      <th>Aksi</th>
                    </tr>

                  </thead>
                  <tbody>

                    <?php

                      $query = mysqli_query($connect, "SELECT * FROM karyawan ORDER BY date_created DESC");

                      $num = mysqli_num_rows($query);

                      if($num<=0){

                        
                      }else{

                        $no = 1;
                        while ($row=mysqli_fetch_object($query)) {

                          echo "<tr>";
                          echo "<td>".$no."</td>";
                          echo "<td>".$row->nama_karyawan."</td>";
                          echo "<td>".$row->email."</td>";
                          echo "<td>".ucfirst($row->jabatan)."</td>";
                          echo "<td>";
                          echo "<a href=\"#\" data-toggle=\"modal\" data-target=\"#modalKaryawan\" data-email=\"".$row->email."\" data-id=\"".$row->id_karyawan."\" data-jabatan=\"".$row->jabatan."\" data-nama_karyawan=\"".$row->nama_karyawan."\" class=\"btn btn-info btn-xs\" data-tooltip=\"true\" title=\"Ubah Karyawan\" ><i class=\"fa fa-pencil\"></i></a> ";
                          echo "<a href=\"../proses/admin/hapus_karyawan.php?id=".$row->id_karyawan."\" onclick=\"return confirm('Anda Yakin akan menghapus karyawan ini??')\"class=\"btn btn-danger btn-xs\" data-tooltip=\"true\" title=\"Hapus Karyawan\" ><i class=\"fa fa-trash-o\"></i></a>";
                          echo "</td>";
                          echo "</tr>";

                          $no++;
                        }
                     
                        
                      }

                    ?>

                    <!-- <tr>
                      <td>1</td>
                      <td>Mohammad Fajar Ainul Bashri</td>
                      <td>iniemail@email.com</td>
                      <td>Staff</td>
                      <td>
                        <a href="#" class="btn btn-info btn-xs" data-toggle="tooltip" title="Ubah Data Karyawan" ><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus Data Karyawan" ><i class="fa fa-trash-o"></i></a>
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
    <div class="modal fade" id="modalKaryawan" tabindex="-1" role="dialog" aria-labelledby="modalKaryawanLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="modalKaryawanLabel">Ubah Karyawan</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal style-form" method="POST">

              <div class="form-group">
                <label class="col-sm-4 control-label">Nama Karyawan</label>
                <div class="col-sm-8">
                  <input type="text" name="nama_karyawan" class="form-control" placeholder="Nama Karyawan" required >
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" name="email" class="form-control" placeholder="Email" required >
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">Jabatan</label>
                <div class="col-sm-8">
                  <select name="jabatan" class="form-control" required>
                    
                    <option value="staff" selected>Staff</option> 
                    <option value="ketua">Ketua</option> 
                    
                    
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
        var table = $('#table_karyawan').DataTable(
          {
              "language": {
                "emptyTable": "Tidak ada data karyawan"
              }
          });

        $('#modalKaryawan').on('show.bs.modal', function(e){
           var id = $(e.relatedTarget).data('id');
           var nama_karyawan = $(e.relatedTarget).data('nama_karyawan');
           var jabatan = $(e.relatedTarget).data('jabatan');
           var email = $(e.relatedTarget).data('email');

           var action = "../proses/admin/ubah_karyawan.php?id="+id;

           $('.modal input[name="nama_karyawan"]').val(nama_karyawan);
           $('.modal select[name="jabatan"]').val(jabatan);
           $('.modal input[name="email"]').val(email);


           $('.modal form').attr('action', action);

           
        }); 
      </script>