<?php
  require_once ('../proses/koneksi_db.php');
  // cek pesan
  $query = mysqli_query($connect, "SELECT COUNT(*) as jumlah_unread FROM pesan WHERE status='belum' ");

  if(!$query){
    die("QuERY CHECK UNREAD PESAN GAGAL ".mysqli_error($connect));
  }

  $message = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>

    <!--footer start-->
      <footer class="site-footer">
        <div class="text-center">
          &copy Balai Latihan Kerja Demak
         <!--  <a href="blank.html#" class="go-top">
            <i class="fa fa-angle-up"></i>
          </a> -->
        </div>
      </footer>
    <!--footer end-->
    </section>
    <!-- CONTAINER END -->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" src="../datatables/datatables.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    

    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>

    <script type="text/javascript" src="../assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../assets/js/gritter-conf.js"></script>

    <!--script for this page-->

   

    <script>

      $(document).ready(function () {

        $("#batal").click(function(){
          $("#collapseForm").collapse('hide');
          $('#tambah').focus();
        });

        $('[data-tooltip="true"]').tooltip();


        <?php

          if(isset($_SESSION['success_login'])){

            $jabatan = $_SESSION['jabatan'];

        ?>

        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Login berhasil!',
            // (string | mandatory) the text inside the notification
            text: 'Anda login sebagai <?php echo $_SESSION['jabatan']?>',
            // (string | optional) the image to display on the left
            image: '../assets/img/logo.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: 10,
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        <?php

            unset($_SESSION['success_login']);

          }


        ?>
      });
      
      // Penghitung pesan belum terbaca
      var countMessage = "<?php echo $message['jumlah_unread']; ?>";
      if (countMessage > 0) {
        $('aside .message a').append('<span class="badge">'+ countMessage +'</span>');
      }

    </script>

  </body>
</html>
