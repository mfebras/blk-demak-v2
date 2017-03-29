      

      <?php

        include 'header.php';

      ?>

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height" style="min-height: 500px;">
          <h3><i class="fa fa-angle-right"></i> Ekspor Basis Data</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="showback" style="min-height: 300px;">
                <?php

                  if(isset($_SESSION['error'])){

                    echo "<div class=\"alert alert-danger\" style=\"margin-top:15px\">";
                    echo "<p>".$_SESSION['error']."</p>";
                    echo "</div>";

                    unset($_SESSION['error']);
                  }
                  else if(isset($_SESSION['success'])){
                    echo "<div class=\"alert alert-success\" style=\"margin-top:15px\">";
                    echo "<p>".$_SESSION['success']."</p>";
                    echo "</div>";

                    unset($_SESSION['success']);
                  }

                ?>
                
                <p>Basis data akan diekspor ke dalam bentuk sql.</p>
                <a href="../proses/admin/ekspor.php"><button class="btn btn-success" role="button">Ekspor</button></a>
              </div>
              <!-- END SHOWBACK -->
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

        });
      </script>