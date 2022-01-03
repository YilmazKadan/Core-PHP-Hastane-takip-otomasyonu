<?php
// Yönlendirme kod tekrarından kaçınmak için bu değişken.
$yonlendirme = false;
if (!empty($_GET['id'])) {
    $id = $VT->filter($_GET['id']);
    $veri = $VT->veriGetir("SELECT * from hastane.doktor", "where ID = ?", array($id));
    $uye = $veri[0];
    if (!$veri) {
        $yonlendirme = true;
        $VT->mesajOlustur("hata","Böyle bir kayıt yok");
    }
} else {
    $yonlendirme = true;
}
if($yonlendirme)
    $VT->yonlendir(SITE . "sayfa/doktorliste");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Doktor Düzenle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/doktorliste" class="btn btn-info btn-lg float-right">Tüm doktorlar</a>
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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">doktor Düzenle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Doktor Adı</label>
                                    <input type="text" value="<?php echo $uye['AD'] ?>" name="doktorAd" class="form-control" required placeholder="doktor adı giriniz...">
                                    <input type="hidden" name="id" value="<?= $uye['ID'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Doktor Soyadı</label>
                                    <input type="text" value="<?php echo $uye['SOYAD'] ?>" name="doktorSoyad" class="form-control" required placeholder="doktor soyadı giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Poliklinik</label>
                                    <select class="form-control select2" name="doktorPol" style="width: 100%;">
                                        <?php
                                        $polDal = $VT->veriGetir("SELECT * from hastane.pol_dal");
                                        if ($polDal != false) {
                                            foreach ($polDal as $dal)
                                                if ($dal['ID'] != $uye['DAL_NO'])
                                                    echo "<option value='{$dal['ID']}'>{$dal['pol_ad']} </option>";
                                                else
                                                    echo "<option selected value='{$dal['ID']}'>{$dal['pol_ad']} </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="doktorDuzenle" class="btn btn-primary ml-auto">Güncelle</button>
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