<?php
@session_start();
@ob_start();
define("DATA", "data/");
define("SAYFA", "include/");
define("SINIF", "class/");
define("AJAX", "ajax/");
include_once(DATA . "baglanti.php");
define("SITE", $url);
if (!empty($_SESSION['uye'])) {
  $VT->yonlendir("index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kütühane Yönetim | Giriş Ekranı</title>
  <link rel="icon" href="<?php SITE ?>../images/logo.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= SITE ?>/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= SITE ?>plugins/toastr/toastr.min.css">
  <style>
    body {
      background-image: url('https://www.openathens.net/app/uploads/2021/08/alfons-morales-YLSwjSy7stw-unsplash.jpg');
    }

    .login-logo {
      background-color: white;
    }

    .login-logo a {
      color: #666;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="giris.php"><b>Hastane Takip Otomasyonu</a>
    </div>