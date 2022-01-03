<!-- jQuery -->
<script src="<?= SITE ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= SITE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= SITE ?>dist/js/adminlte.min.js"></script>
 <!-- Toastr -->
 <script src="<?= SITE ?>plugins/toastr/toastr.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
    $('[data-mask]').inputmask();
    <?php
    // TOAST FIRE MESAJI VERME
    if (isset($_SESSION['durum'])) {
      $durumTuru = $_SESSION['durum']['tur'];
      $mesaj = $_SESSION['durum']['mesaj'];
      switch ($durumTuru) {
        case "basarili":
          echo "toastr.success('{$mesaj}');";
          break;
        case "hata":
          echo "toastr.error('{$mesaj}');";
          break;
        case "bilgi":
          echo "toastr.info('{$mesaj}');";
          break;
        case "uyari":
          echo "toastr.warning('{$mesaj}');";
          break;
      }
      unset($_SESSION['durum']);
    }
    ?>
</script>
</body>
</html>