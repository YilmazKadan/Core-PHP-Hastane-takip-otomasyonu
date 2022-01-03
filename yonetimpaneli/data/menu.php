<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="Anasayfa" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Hastane Yönetim</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= $uyeresim ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION['uye']['AD'] . "(" . $_SESSION['uye']['uyelikturu'] . ")" ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="Anasayfa" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              ANALİZ
            </p>
          </a>
        </li>
        <!-- Yetki seviyesini kontrol  ediyoruz  hemşire  ve üstü girebilir .-->
        <?php if ($VT->yetkiKontrol(2)) {

        ?>
          <li class="nav-item">
            <a href="sayfa/pol_kayit" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Poliklinik Kayıt
              </p>
            </a>
          </li>
        <?php
        }
        ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Poliklinik
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="sayfa/polliste" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Poliklinikler</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="sayfa/polekle" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Poliklinik Ekle</p>
              </a>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-pencil-alt"></i>
            <p>
              Doktor
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="sayfa/doktorliste" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Doktorlar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="sayfa/doktorekle" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Doktor Ekle</p>
              </a>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-pencil-alt"></i>
            <p>
              Hasta
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="sayfa/hastaliste" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Hastalar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="sayfa/hastaekle" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Hasta Ekle</p>
              </a>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-pencil-alt"></i>
            <p>
              İlaç
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="sayfa/ilacliste" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>İlaçlar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="sayfa/ilacekle" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>İlaç Ekle</p>
              </a>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Bilgilerim
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="sayfa/bilgilerim" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bilgilerim</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="sayfa/sifre" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Şifre İşlemleri</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Yetki seviyesini kontrol  ediyoruz  hemşire  ve üstü girebilir .-->
        <?php if ($VT->yetkiKontrol(2)) {

        ?>
          <li class="nav-item">
            <a href="sayfa/uyeliste" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Üyeler
              </p>
            </a>
          </li>
        <?php
        }
        ?>
        <!-- Yetki seviyesini kontrol  ediyoruz  admin ve üstü girebilir .-->
        <?php if ($VT->yetkiKontrol(4)) {

        ?>
          <li class="nav-item">
            <a href="sayfa/yetki" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                YETKİ İŞLEMLERİ
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                SİTE AYARLARI
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="ayarlar/genelayar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Genel Ayarlar</p>
                </a>
              </li>
            </ul>
          </li>
        <?php  } ?>
        <li class="nav-item">
          <a href="sayfa/cikis" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              ÇIKIŞ
            </p>
          </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>