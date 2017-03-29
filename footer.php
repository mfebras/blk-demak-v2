<footer>
  <div class="container">
    <p>&copy; BLK Kabupaten Demak 2017</p>
  </div>
</footer>

<!-- Modal Auth -->
<div class="modal fade" id="modal-auth" tabindex="-1" role="dialog" aria-labelledby="ModalAuth">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li id="login-li" role="presentation"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
          <li id="register-li" role="presentation"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Daftar</a></li>
        </ul>
      </div>
      <div class="modal-body">
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade collapse clearfix" id="login">
            <div class="col-md-7">
              <!-- Form Login -->
              <form action="<?php echo ROOT; ?>proses/peserta/login.php" method="POST">
                <input type="hidden" name="page" value="<?php echo $_SESSION['page']; ?>">
                <div class="form-group">
                  <input class="form-control" type="email" name="blk_email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" name="blk_password" placeholder="Password" required>
                </div>
                <div class="form-group clearfix">
                  <a href="peserta/kirim_email.php" style="font-size: 14px; position: relative; top: 6px;">Lupa password?</a>
                  <input class="btn btn-primary pull-right" type="submit" value="Login">
                </div>
              </form>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade collapse clearfix" id="register">
            <div class="col-md-7">
              <!-- Form Register -->
              <form action="<?php echo ROOT; ?>proses/peserta/daftar.php" method="POST">
                <input type="hidden" name="page" value="<?php echo $_SESSION['page']; ?>">
                <div class="form-group">
                  <input class="form-control" type="text" name="blk_nama" placeholder="Nama" required>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="no_ktp" placeholder="No. KTP" required>
                </div>
                <div class="form-group">
                  <input class="form-control" type="tel" name="telepon" placeholder="No. Telepon" required>
                </div>
                <div class="form-group">
                  <input class="form-control" type="email" name="blk_email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" name="blk_password" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" name="blk_password_confirm" placeholder="Ulangi Password" required>
                </div>
                <div class="form-group">
                  <input class="btn btn-success" type="submit" value="Daftar">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pesan -->
<?php
  if (isset($_SESSION['success'])) {
    include '_pesan_sukses.php';
  }
  if (isset($_SESSION['error'])) {
    include '_pesan_error.php';
  }

  // Menghapus pesan sukses dan error
  unset($_SESSION['error']);
  unset($_SESSION['success']);
?>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script>
    $(function(){
      // Mengaktifkan Auth Tab ketika tombol Login / Register ditekan
      $('.auth button').on('click', function(){
        var type = $(this).attr('data-tab');
        if( !$('#'+type+'-li, #'+type+'').hasClass('active') ) {
          // Deactivate another tab
          $('#modal-auth .nav-tabs .active, #modal-auth .tab-content .active').removeClass('in active');

          $('#'+type+'-li, #'+type+'').addClass('in active');
        }
      });

      // Fungsi menghilangkan pesan/ notifikasi
      function close_pop_up(){
        var width = $('.pop-up').width();
        $('.pop-up').animate({
          'opacity': 0,
          'right': -width
        }, 300);
      }

      // Menampilkan pesan/ notifikasi
      if ($('.pop-up').length) {
        $('.pop-up').css('z-index', 1).animate({
          'opacity': 1,
          'right': "75px"
        }, 300).animate({ 'right': "65px" }, 400);

        // menghilangkan notifikasi
        setTimeout(close_pop_up, 5000);
      }

      // Menghilangkan pesan/ notifikasi
      $('.pop-up .close').click(close_pop_up);

      // Menghilangkan notifikasi ketika diklik pada selain notifikasi
      $(document).click(function(e) {
        var pop_up = $('.pop-up');
        if (!pop_up.is(e.target)) {
          close_pop_up();
        }
      });

    });
</script>