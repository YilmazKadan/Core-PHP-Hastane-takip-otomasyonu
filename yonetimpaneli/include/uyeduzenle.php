<?php
// Yönlendirme kod tekrarından kaçınmak için bu değişken.
$yonlendirme = false;
if (!empty($_GET['id'])) {
    $id = $VT->filter($_GET['id']);
    $veri = $VT->veriGetir("SELECT * from hastane.users", "where ID = ?", array($id));
    if (!$veri) {
        $yonlendirme = true;
        $VT->mesajOlustur("hata","Böyle bir kayıt yok");
    }
    else{
        $uye = $veri[0];
        $uyeresim = (!empty($uye['FOTOGRAF']) ? "../images/uyeresim/".$uye['FOTOGRAF'] : "../images/uyeresim/varsayilanuser.png");
    }
} else {
    $yonlendirme = true;
}
if($yonlendirme)
    $VT->yonlendir(SITE . "sayfa/uyeliste");
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Üye Düzenle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/uyeliste" class="btn btn-info btn-lg float-right">Tüm Üyeler</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- SELECT2 EXAMPLE -->
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Üye Düzenle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Üye Adı</label>
                                        <input type="text" name="uyeAd" value="<?= stripslashes($uye['AD']) ?>" required class="form-control" placeholder="Üye adı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Üye Email Adresi</label>
                                        <input type="email" name="uyeMail" value="<?= stripslashes($uye['MAIL']) ?>" required class="form-control" placeholder="Üye adı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Üye Tc Kimlik Numarası</label>
                                        <input type="text" name="uyeTc" value="<?= stripslashes($uye['TCNO']) ?>" required class="form-control" placeholder="Üye TC kimlik numarası giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Yüklü Resim</label>
                                        <img class="img-fluid" src="<?= $uyeresim ?>" alt="">
                                    </div>
                                    <input type="hidden" name="id" value="<?= $uye['ID'] ?>">
                                </div>
                                <!-- SAĞ TARAF -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Üye Soyadı</label>
                                        <input type="text" name="uyeSoyad" value="<?= stripslashes($uye['SOYAD']) ?>" required class="form-control" placeholder="Üye soyadı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Üye Fotoğraf(Eklenmeyebilir)</label>
                                        <input type="file" accept="image/*" name="uyeresim"  class="form-control" ">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="uyeDuzenle" class="btn btn-primary ml-auto">Güncelle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>