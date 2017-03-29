      

      <?php
      
        include 'header.php';
        require_once ('../proses/koneksi_db.php');
        require_once ('../proses/helper.php');


        $query = mysqli_query($connect, "SELECT COUNT(*) as jumlah_unread FROM pesan WHERE status='belum' ");

        if(!$query){
          die("QuERY CHECK UNREAD PESAN GAGAL ".mysqli_error($connect));
        }

        $data = mysqli_fetch_object($query);

        $unread = $data->jumlah_unread;

      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Pesan</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Tabel Pesan <?php if($unread>0){ echo "<b>(".$unread." pesan belum dibaca)</b>"; } ?></h4>  
                <hr>

                                           

                <table class="table table-hover" id="table_pesan">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Subjek</th>
                      <th>Pesan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>

                  </thead>
                  <tbody>

                    <?php

                      $query = mysqli_query($connect, "SELECT * FROM pesan ORDER BY date_created DESC");

                      $num = mysqli_num_rows($query);

                      if($num<=0){

                        
                      }else{

                        $no = 1;
                        while ($row=mysqli_fetch_object($query)) {

                          $status = convertStatusPesan($row->status);  

                          $pesan = substr ( $row->pesan , 0, 50);

                          $pesan = htmlspecialchars($pesan);

                          $pesan = $pesan.'...';                        

                          echo "<tr>";
                          echo "<td>".$no."</td>";
                          echo "<td>".$row->nama."</td>";
                          echo "<td>".$row->email."</td>";
                          echo "<td>".$row->subyek."</td>";
                          echo "<td>".$pesan."</td>";
                          echo "<td>".$status."</td>"; 
                          echo "<td>";
                          echo "<a href=\"detail_pesan.php?id_pesan=".$row->id."\" class=\"btn btn-primary btn-xs\" data-tooltip=\"true\" title=\"Lihat Detail Pesan\" ><i class=\"fa fa-eye\"></i></a> ";
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
        var table = $('#table_pesan').DataTable(
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