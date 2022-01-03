<?php
// Yönlendirme kod tekrarından kaçınmak için bu değişken.
$yonlendirme = false;
if (!empty($_GET['id'])) {
    $id = $VT->filter($_GET['id']);
    $odunc = $VT->veriGetir("SELECT * from tbliletisim ", "WHERE ID = ?", array($id));
    if (!$odunc) {
        $yonlendirme = true;
    } else {
        $iletisim  = $odunc[0];
    }
} else {
    $yonlendirme = true;
}
if ($yonlendirme)
    $VT->yonlendir(SITE . "sayfa/iletisimliste");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">İletişim Detay</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/iletisimliste" class="btn btn-info btn-lg float-right">Tüm İletişim Kayıtarı</a>
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
                            <h3 class="card-title">Ödünç Teslim Al</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tarih</label>
                                    <input type="text" disabled value="<?php echo $iletisim['TARIH'] ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>Gönderen</label>
                                    <input type="text" disabled value="<?php echo $iletisim['AD'] ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>Mail</label>
                                    <input type="text" disabled value="<?php echo $iletisim['MAIL'] ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>Konu</label>
                                    <input type="text" disabled value="<?php echo $iletisim['KONU'] ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>İletişim Detay</label>
                                    <textarea disabled name="yazarDetay"  class="form-control" > <?= htmlspecialchars(stripslashes($iletisim['MESAJ'])) ?></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= $oduncIslem['ID'] ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>