      

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
        $tempat_lahir = $data->tempat_lahir;
        $sumber_info = $data->sumber_info;

        if(is_null($data->tanggal_lahir)){
          $tgl_lahir = '';
        }else{
          $tgl_lahir = convertDate($data->tanggal_lahir, 'd M Y');
        }
        

        
      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Data Peserta</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Ubah Peserta</h4>
                <hr>

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

                <form class="form-horizontal style-form" method="POST" action="../proses/admin/ubah_peserta.php?id_peserta=<?php echo $id_peserta;?>" style="margin-top:20px">

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-4">
                      <input value="<?php echo $nama;?>" type="text" name="nama_peserta" class="form-control" placeholder="Nama Lengkap" required >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nomor KTP</label>
                    <div class="col-sm-4">
                      <input value="<?php echo $no_ktp;?>" type="text" name="nomor_ktp" class="form-control" placeholder="Nomor KTP" required >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Jenis Kelamin</label>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                          <input type="radio" name="jk" value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'Checked'; ?> >Laki - laki
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="jk" value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'Checked'; ?>>Perempuan
                        </label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Tempat dan Tanggal Lahir</label>
                    <div class="col-sm-3">
                      <input value="<?php echo $tempat_lahir;?>" type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required >
                    </div>
                    <div class="col-sm-3">
                      <input value="<?php echo $tgl_lahir;?>" type="text" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" required >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Agama</label>
                    <div class="col-sm-4">
                        <select name="agama" class="form-control" required>
                          <option value="">Pilih Agama</option> 
                          <option value="Islam" <?php if ($agama == 'Islam') echo ' selected="selected"'; ?> >Islam</option> 
                          <option value="Kristen" <?php if ($agama == 'Kristen') echo ' selected="selected"'; ?>>Kristen</option> 
                          <option value="Katolik" <?php if ($agama == 'Katolik') echo ' selected="selected"'; ?> >Katolik</option> 
                          <option value="Hindu" <?php if ($agama == 'Hindu') echo ' selected="selected"'; ?>>Hindu</option> 
                          <option value="Buddha" <?php if ($agama == 'Buddha') echo ' selected="selected"'; ?>>Buddha</option> 

                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2  control-label">Alamat</label>
                    <div class="col-sm-4">
                        <textarea name="alamat" class="form-control" placeholder="Alamat" required ><?php echo $alamat;?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nomor HP</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $telepon;?>" type="text" name="no_hp" class="form-control" placeholder="Nomor HP" required >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                        <input value="<?php echo $email;?>" type="email" name="email" class="form-control" placeholder="Email" required >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Pendidikan Terakhir</label>
                    <div class="col-sm-4">
                        <!-- <select name="pendidikan_terakhir" class="form-control" required>
                          <option value="">Pilih Pendidikan</option> 
                          <option value="tidak sekolah">Tidak Sekolah</option> 
                          <option value="sd">SD/Sederajat</option> 
                          <option value="smp">SMP/Sederajat</option> 
                          <option value="sma">SMA/Sederajat</option> 
                          <option value="lainnya">Lainnya</option> 

                        </select> -->
                        <input value="<?php echo $pendidikan_terakhir;?>" type="text" name="pendidikan_terakhir" class="form-control" placeholder="Pendidikan Terakhir" required >
                    </div>
                  </div>                

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Sumber Info</label>
                    <div class="col-sm-4">
                        <select name="sumber_info" class="form-control" required>
                          <option value=""  >Pilih Sumber Info</option> 
                          <option value="Brosur" <?php if ($sumber_info == 'Brosur') echo ' selected="selected"'; ?>>Brosur</option> 
                          <option value="Media Sosial" <?php if ($sumber_info == 'Media Sosial') echo ' selected="selected"'; ?>>Media Sosial</option> 
                          <option value="Teman" <?php if ($sumber_info == 'Teman') echo ' selected="selected"'; ?>>Teman</option> 
                          
                        </select>
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
        </section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

    <!--main content end-->
    

      <?php

        include 'footer.php';

      ?>

      <script>
        $(document).ready(function(){
            $('#kejuruan, #tanggal_daftar').keyup( function() {
              table.draw();
            });
            
  

            $('input[name="tanggal_lahir"]').datepicker({              
              dateFormat: "mm/dd/yy ",
              altField : $('input[name="tanggal_lahir"]'),
              altFormat : "dd M yy",
            });

        });

        /*END DOCUMENT READY*/
      </script>