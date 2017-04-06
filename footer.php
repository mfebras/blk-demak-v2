<footer>
  <div class="container">
    <p>&copy; BLK Kabupaten Demak 2017</p>
  </div>
</footer>

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