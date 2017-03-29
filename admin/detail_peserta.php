      

      <?php

        include 'header.php';
        require_once ('../proses/koneksi_db.php');
        require_once ('../proses/convert_date.php');
        require_once ('../proses/helper.php');

        $id_peserta = $_GET['id_peserta'];

        $query = mysqli_query($connect, "SELECT * FROM peserta WHERE id=$id_peserta ");

        $num = mysqli_num_rows($query);

        if($num<=0){

          die("DATA PESERTA TIDAK DITEMUKAN");        }

        $data = mysqli_fetch_object($query);

        $nama = $data->nama;
        $no_ktp = $data->no_ktp;
        $agama = $data->agama;
        $email = $data->email;
        $telepon = $data->telepon;
        $alamat = $data->alamat;
        $jenis_kelamin = $data->jenis_kelamin;
        $pendidikan_terakhir = $data->pendidikan_terakhir;
      
        $sumber_info = $data->sumber_info;
        $status = $data->status;

        $tanggal_daftar = convertDate($data->tanggal_daftar, 'd M Y');
        $ttl = $data->tempat_lahir.", ".convertDate($data->tanggal_lahir, 'd M Y');


      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Data Peserta</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Detail Peserta</h4>
                <hr>

                <table border="0" class="table">

                  <tr>
                    <td>Nama Lengkap</td>
                    <td> : </td>
                    <td><?php echo $nama;?></td>
                  </tr>

                  <tr>
                    <td>Nomor KTP</td>
                    <td> : </td>
                    <td><?php echo $no_ktp?></td>
                  </tr>

                  <tr>
                    <td>Jenis Kelamin</td>
                    <td> : </td>
                    <td><?php echo $jenis_kelamin?></td>
                  </tr>

                  <tr>
                    <td>Tempat dan Tanggal Lahir</td>
                    <td> : </td>
                    <td><?php echo $ttl?></td>
                  </tr>

                  <tr>
                    <td>Agama</td>
                    <td> : </td>
                    <td><?php echo $agama?></td>
                  </tr>

                  <tr>
                    <td>Alamat</td>
                    <td> : </td>
                    <td><?php echo $alamat?></td>
                  </tr>

                  <tr>
                    <td>Nomor HP</td>
                    <td> : </td>
                    <td><?php echo $telepon?></td>
                  </tr>

                  <tr>
                    <td>Email</td>
                    <td> : </td>
                    <td><?php echo $email?></td>
                  </tr>

                  <tr>
                    <td>Pendidikan Terakhir</td>
                    <td> : </td>
                    <td><?php echo $pendidikan_terakhir?></td>
                  </tr>

                  <tr>
                    <td>Tanggal Daftar</td>
                    <td> : </td>
                    <td><?php echo $tanggal_daftar?></td>
                  </tr>

                  <tr>
                    <td>Sumber Info</td>
                    <td> : </td>
                    <td><?php echo $sumber_info?></td>
                  </tr>

                  <tr>
                    <td>Status</td>
                    <td> : </td>
                    <td><?php echo $status?></td>
                  </tr>

                  <tr>
                    <td>History Peserta</td>
                    <td> : </td>
                    <td>
                      <?php 
                        $query = mysqli_query($connect, "SELECT re.status, ke.nama_kejuruan, re.tanggal_registrasi FROM registrasi_pelatihan re, kejuruan ke WHERE re.id_kejuruan=ke.id_kejuruan AND re.id_kejuruan=$id_peserta ORDER BY re.tanggal_registrasi DESC ");
                      
                        if(!$query){

                          die("QUERY GAGAL : ".mysqli_error($connect));

                        }

                        $num = mysqli_num_rows($query);

                        if($num <= 0){
                          echo " - ";
                        }else{

                          echo "<table>";

                          while ($row = mysqli_fetch_object($query)) {
                            echo "<tr>";
                            echo "<td><span>".$row->nama_kejuruan."</span></td>";
                            echo "<td><span style=\"margin-left:20px\">".convertStatusRegistrasi($row->status)."</span></td>";
                            echo "</tr>";
                          }
                          
                          echo "</table>";
                        }
                      ?>
                    </td>                      
                  </tr>

                </table>
                
                <div style="text-align:right" >

                   <a href="#" class="btn btn-danger">Hapus Peserta</a>
                   <a href="form_ubah_peserta.php?id_peserta=<?php echo $id_peserta?>" class="btn btn-primary">Ubah Peserta</a>

                </div>
               
                
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

            $('#kejuruan, #tanggal_daftar').keyup( function() {
              table.draw();
            });
            
            $('[data-toggle="tooltip"]').tooltip(); 


            //JS untuk ubah status
            /*$('#ubah_status').click(function(){
            
              var html_before = $('#status_peserta').html();

              var select = '';
              select = select + '<div class="col-sm-3">';
              select = select + '<select name="status" class="form-control">';
              select = select + '<option value="Menunggu">Menunggu</option>';
              select = select + '<option value="Wawancara">Wawancara</option>';
              select = select + '<option value="Lulus">Lulus</option>';
              select = select + '</select>';
              select = select + '</div>';

              select = select + '<button id="simpan_status" class="btn btn-primary btn-sm" style="margin-left:10px">Simpan</button>';

              $('#status_peserta').html(select);

              $('#simpan_status').click(function(){

                 $('#status_peserta').html(html_before); 

              });
            });  */


        });
      </script>