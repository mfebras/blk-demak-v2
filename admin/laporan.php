      

      <?php

        include 'header.php';

      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Laporan</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Cetak Laporan</h4>
                <hr>

                <form class="form-inline">
                  <div class="form-group">
                    <label for="tahun">Tahun Pelatihan</label>
                    <select class="form-control" name="tahun">

                      <?php

                        $yearNow = date('Y');
                        $minYear = date('Y', strtotime('-5 years'));                        
                        
                        for ($i=$minYear; $i <= $yearNow; $i++) { 
                          $selected = '';
                          if($i == $yearNow){
                            $selected = 'selected';
                          }
                          echo "<option value=".$i." ".$selected.">".$i."</option>";
                        }

                      ?>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="angkatan">Angkatan</label>
                    <select class="form-control" name="angkatan">
                      <option value="all">Semua Angkatan</option>
                      <option value="I">Angkatan I</option>
                      <option value="II">Angkatan II</option>
                      <option value="III">Angkatan III</option>
                      <option value="IV">Angkatan IV</option>
                      <option value="V">Angkatan V</option>
                    </select>
                  </div>
                  <button type="button" class="btn btn-primary" id="cari">Cari!</button>
                </form>
              </div>

              <div class="showback hidden" id="resultLaporan">



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

        $('#cari').click(function(){
          
          var tahun = $("select[name='tahun']").val();
          var angkatan = $("select[name='angkatan']").val();

          var url = "../proses/admin/ambil_laporan.php";

          $.ajax({

            url       : url,

            method    : 'POST',

            data      : {tahun : tahun, angkatan:angkatan},

            dataType  : 'html',

            cache     : false,

            success   : function(data){

              $("#resultLaporan").removeClass('hidden');
              $("#resultLaporan").html(data);

            },

            error     : function(){

              alert("Terjadi error saat mengambil data Laporan");

            },

            complete  : function(){

            }

          });
          

        });


      </script>

