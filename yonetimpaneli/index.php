<?php
@session_start();
@ob_start();
define("DATA", "data/");
define("SAYFA", "include/");
define("SINIF", "class/");
define("AJAX", "ajax/");
include_once(DATA . "baglanti.php");
// Css ve js dosyalarını yonetim panelinden çekeceğimiz için ayrı bir sabit daha
define("SITE", $url);
if ($VT->yetkiKontrol()) {
  if (!$VT->yetkiKontrol(2)) {
    $VT->mesajOlustur("hata", "Yönetici seviyesinden bir alana erişim sağlayamazsınız!!");
    $VT->yonlendir(SITE . "../uyepanel/Anasayfa");
  } else {
    $uyeresim = (!empty($_SESSION['uye']['FOTOGRAF']) ? "../images/uyeresim/" . $_SESSION['uye']['FOTOGRAF'] : "../images/uyeresim/varsayilanuser.png");
  }
} else {
  $VT->yonlendir(SITE . "giris-yap");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$baslik?></title>
  <base href="<?= SITE ?>">
  <link rel="icon" href="<?php SITE ?>../images/logo.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= SITE ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= SITE ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= SITE ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/toastr/toastr.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= SITE ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/summernote/summernote-bs4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <style>
    .td-image {
      width: 100px;
      height: 150px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include_once(DATA . "ust.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include_once(DATA . "menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <?php
    if ($_GET and !empty($_GET['sayfa'])) {
      $sayfa = $_GET['sayfa'] . ".php";
      if (file_exists(SAYFA . $sayfa)) {
        include_once(SAYFA . $sayfa);
      } else {
        include_once(SAYFA . "home.php");
      }
    } else {

      include_once(SAYFA . "home.php");
    }
    ?>

    <?php include_once(DATA . "footer.php");  ?>




    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= SITE ?>plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= SITE ?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= SITE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?= SITE ?>plugins/select2/js/select2.full.min.js"></script>
  <!-- Summernote -->
  <script src="<?= SITE ?>plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= SITE ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= SITE ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= SITE ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= SITE ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= SITE ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= SITE ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= SITE ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= SITE ?>plugins/jszip/jszip.min.js"></script>
  <script src="<?= SITE ?>plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= SITE ?>plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= SITE ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= SITE ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= SITE ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Summernote -->
  <script src="<?= SITE ?>plugins/summernote/summernote-bs4.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= SITE ?>plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="<?= SITE ?>plugins/toastr/toastr.min.js"></script>
  <!-- CUSTOM JS -->
  <script src="<?= SITE ?>dist/js/custom.js"></script>
  <script>
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
  <!-- AdminLTE App -->
  <script src="<?= SITE ?>dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= SITE ?>dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= SITE ?>dist/js/pages/dashboard.js"></script>

</body>

</html>