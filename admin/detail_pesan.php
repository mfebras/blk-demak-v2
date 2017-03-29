      

      <?php

        include 'header.php';
        require_once ('../proses/koneksi_db.php');
        require_once ('../proses/convert_date.php');        

        $id_pesan = $_GET['id_pesan'];

        $query = mysqli_query($connect, "SELECT * FROM pesan WHERE id=$id_pesan ");

        $num = mysqli_num_rows($query);

        if($num<=0){

          die("DATA PESAN TIDAK DITEMUKAN");        
        }
        

        $data = mysqli_fetch_object($query);

        $nama = $data->nama;
        $email = $data->email;
        $subjek = $data->subyek;
        $status = $data->status;

        $pesan = $data->pesan;

        $pesan = htmlspecialchars($pesan);

        $tanggal = $data->date_created;

        $tanggal = convertDate($tanggal, 'd M Y');

        if($status='belum'){
          $query_update =mysqli_query($connect, "UPDATE pesan SET status='sudah' WHERE id=$id_pesan ");

          if(!$query_update){
            die('QUERY UPDATE STATUS PESAN GAGAL, '. mysqli_error($connect));
          }
        }

      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Pesan</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Detail Pesan</h4>                
                <hr>

                <table border="0" class="table">

                  <tr>
                    <td>Tanggal Pengiriman</td>
                    <td> : </td>
                    <td><?php echo $tanggal;?></td>
                  </tr>

                  <tr>
                    <td>Nama Pengirim</td>
                    <td> : </td>
                    <td><?php echo $nama;?></td>
                  </tr>

                  <tr>
                    <td>Alamat Email</td>
                    <td> : </td>
                    <td><?php echo $email?></td>
                  </tr>

                  <tr>
                    <td>Subjek</td>
                    <td> : </td>
                    <td><?php echo $subjek?></td>
                  </tr>

                  <tr>
                    <td>Isi Pesan</td>
                    <td> : </td>
                    <td><?php echo $pesan?></td>
                  </tr>

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