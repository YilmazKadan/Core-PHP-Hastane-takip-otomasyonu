<?php include_once('data/miniinc/header.php') ?>
<!-- /.login-logo -->
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Giriş yap</p>
    <?php
    if(isset($_POST['girisYap'])){
      if(!empty($_POST['email']) and !empty($_POST['sifre'])){
        $email = $_POST['email'];
        // $sifre = sha1(md5($_POST['sifre']));
        $sifre = $_POST['sifre'];
        $uye = $VT->veriGetir("SELECT * from hastane.users","WHERE kullaniciAdi = ? AND sifre = ?",array($email,$sifre));
        if($uye!=false){
          $_SESSION['uye'] = $uye[0];
          // Giriş yapan kullanıcının hesabının hangi yetkide(Admin,user,personel)olduğunu veritabanından çekiyoruz ve sessiona aktarıyoruz.
          $_SESSION['uye']['uyelikturu'] = $VT->veriGetir("SELECT * from hastane.tblyetkiler  ","WHERE ID = ?",array($uye[0]['KULLANICIYETKI']))[0]['YETKIAD'];
          if($VT->yetkiKontrol(2))
            $VT->yonlendir(SITE."Anasayfa");
          else
            $VT->yonlendir(SITE."../uyepanel/Anasayfa");
        }
        else{
          echo "<div class='alert alert-danger text-center'>Kullanıcı adı veya şifreniz yanlıştı!</div>";
        }
      }
      else{
        echo "<div class='alert alert-danger text-center'>Boş alan bırakmayınız!</div>";
      }
    }
    ?>
    

      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="sifre" required  placeholder="Şifre">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Beni hatırla
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="girisYap" class="btn btn-primary btn-block">Giriş Yap</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="sifre-kurtar">Şifremi unuttum</a>
      </p>
      <p class="mb-0">
        <a href="kayit-ol" class="text-center">Kayıt Ol</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php include_once("data/miniinc/footer.php") ?>
