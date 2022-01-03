<?php
// Yönlendirme kod tekrarından kaçınmak için bu değişken.
$yonlendirme = false;
if (!empty($_GET['id'])) {
    $id = $VT->filter($_GET['id']);
    $odunc = $VT->veriGetir("SELECT hareket.*, kitap.AD as kitapAd, uye.AD as uyeAd, uye.SOYAD as uyeSoyad, uye.TCNO,
    DATEDIFF(CURDATE(),hareket.IADETARIH) as Gecikme
    
     from  tblhareket hareket
     INNER JOIN tbluyeler uye ON hareket.UYE = uye.ID
     INNER JOIN tblkitap kitap on hareket.KITAP = kitap.ID
     
      ", "where ISLEMDURUM = ? and hareket.ID = ?", array(0, $id));
    if (!$odunc) {
        $yonlendirme = true;
    } else {
        $oduncIslem  = $odunc[0];
        $gecikmeSuresi = $oduncIslem['Gecikme'];
        if ($gecikmeSuresi > 0)
            $gecikmeMetin = "<input disabled class='text-danger text-bold form-control' value='Teslim için [" . $gecikmeSuresi . "] Gün geç kalındı. Tahsil edilmesi gereken miktar:{$gecikmeSuresi} TL'></input>";
        else if ($gecikmeSuresi < 0)
            $gecikmeMetin = "<input disabled class='text-success text-bold form-control' value = 'Teslim için [" . abs($gecikmeSuresi) . "] gün daha var'></input>";
        else
            $gecikmeMetin = "<input disabled class='text-warning text-bold form-control' value = 'Teslim için son gün'></input>";
    }
} else {
    $yonlendirme = true;
}
if ($yonlendirme)
    $VT->yonlendir(SITE . "sayfa/oduncliste");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ödünç Teslim Al</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/oduncliste" class="btn btn-info btn-lg float-right">Tüm ödünçteki kitaplar</a>
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
                        <form action="<?= DATA ?>islem.php" method="POST" id="oduncTeslimAlForm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Ödünç İşlem Numarası</label>
                                    <input type="text" disabled value="<?php echo $oduncIslem['ID'] ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>Ödünç Alan Üye</label>
                                    <input type="text" disabled value="<?php echo "{" . $oduncIslem['TCNO'] . "} " . $oduncIslem['uyeAd'] . " " . $oduncIslem['uyeSoyad'] ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>Ödünç Alınan Kitap</label>
                                    <input type="text" disabled value="<?php echo stripslashes($oduncIslem['kitapAd']) ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>Alış Tarihi</label>
                                    <input type="text" disabled value="<?php echo $oduncIslem['ALISTARIH'] ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>Teslim Edilmesi Gereken Tarih</label>
                                    <input type="text" disabled value="<?php echo $oduncIslem['IADETARIH'] ?>" class="form-control" required ">
                                </div>
                                <div class="form-group">
                                    <label>Gecikme</label>
                                    <?= $gecikmeMetin ?>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= $oduncIslem['ID'] ?>">
                            <!-- Jquery ile submit edildiği için buton postda gözükmüyor, o nedenle aynı isimde input oluşturuyoruz. -->
                            <input type="hidden" name="oduncTeslimAl">
                            <div class="card-footer d-flex">
                                <button type="submit" name="oduncTeslimAl" id="oduncTeslimAlBtn" class="btn btn-primary ml-auto">Teslim Al</button>
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