<?php
// Yönlendirme kod tekrarından kaçınmak için bu değişken.
$yonlendirme = false;
if (!empty($_GET['id'])) {
    $id = $VT->filter($_GET['id']);
    $veri = $VT->veriGetir("SELECT * from hastane.pol_dal", "where ID = ?", array($id));
    if (!$veri) {
        $yonlendirme = true;
    }
} else {
    $yonlendirme = true;
}
if($yonlendirme)
    $VT->yonlendir(SITE . "sayfa/kategoriliste");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Poliklinik Ekle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/polliste" class="btn btn-info btn-lg float-right">Tüm Poliklinik</a>
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
                            <h3 class="card-title">Poliklinik Düzenle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Poliklinik Adı :</label>
                                    <input type="text" value="<?php echo $veri[0]['pol_ad'] ?>" name="polAd" class="form-control" placeholder="Kategori adı giriniz...">
                                    <input type="hidden" name="id" value="<?= $veri[0]['ID'] ?>">
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="polDuzenle" class="btn btn-primary ml-auto">Güncelle</button>
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