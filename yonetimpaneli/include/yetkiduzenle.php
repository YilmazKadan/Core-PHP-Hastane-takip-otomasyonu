<?php
// Yönlendirme kod tekrarından kaçınmak için bu değişken.
if(!$VT->yetkiKontrol(4))
    $VT->yonlendir(SITE);

$yonlendirme = false;
if (!empty($_GET['id'])) {
    $id = $VT->filter($_GET['id']);
    $veri = $VT->veriGetir("SELECT * from hastane.users", "where ID = ?", array($id));
    if ($veri) {
        $uye = $veri[0];
    } else {
        $yonlendirme = true;
        $VT->mesajOlustur("hata","Böyle bir kayıt yok");
    }
} else {
    $yonlendirme = true;
}
if ($yonlendirme)
    $VT->yonlendir(SITE . "sayfa/yetki");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Yetkilendirme</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- SELECT2 EXAMPLE -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Yetki Düzenleme</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Üye isim-soyisim</label>
                                    <input disabled type="text" value="<?= $uye['AD'] . " " . $uye['SOYAD'] ?>" class="form-control" required placeholder="Site başlığı giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Üye email</label>
                                    <input disabled type="text" value="<?= $uye['MAIL'] ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>Yetki Seçin</label>
                                    <select class="form-control select2" name="uyeYetki" style="width: 100%;">
                                        <?php
                                        $yetkiler = $VT->veriGetir("SELECT * from hastane.tblyetkiler");
                                        if ($yetkiler != false) {
                                            foreach ($yetkiler as $yetki)
                                                if ($yetki['ID'] != $uye['KULLANICIYETKI'])
                                                    echo "<option value='{$yetki['ID']}'>{$yetki['YETKIAD']} </option>";
                                                else
                                                    echo "<option selected value='{$yetki['ID']}'>{$yetki['YETKIAD']} </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" value="<?= $uye['ID']?>" name="id">
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="yetkiDuzenle" class="btn btn-primary ml-auto">Yetki Güncelle</button>
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