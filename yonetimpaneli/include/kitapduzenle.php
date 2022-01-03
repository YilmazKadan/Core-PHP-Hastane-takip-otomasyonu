<?php
// Yönlendirme kod tekrarından kaçınmak için bu değişken.
$yonlendirme = false;
if (!empty($_GET['id'])) {
    $id = $VT->filter($_GET['id']);
    $veri = $VT->veriGetir("SELECT * from tblkitap", "where ID = ?", array($id));
    if (!$veri) {
        $yonlendirme = true;
        $VT->mesajOlustur("hata", "Böyle bir kayıt yok");
    } else {
        $kitap = $veri[0];
        $kitapKategori = $kitap["KATEGORI"];
        $resim = $kitap['KITAPRESIM'];
        if (!empty($resim)) {
            // Resim bir url ise src yapımızı değiştiriyoruz.
            if (filter_var($resim, FILTER_VALIDATE_URL)) {
                $resim =  "{$resim}";
            }else{

                $resim =  "../images/kitapresim/{$resim}";
            }
        }
    }
} else {
    $yonlendirme = true;
}
if ($yonlendirme)
    $VT->yonlendir(SITE . "sayfa/kitapliste");
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kitap Düzenle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/kitapliste" class="btn btn-info btn-lg float-right">Tüm Kitaplar</a>
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
                            <h3 class="card-title">Kitap Düzenle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kitap Adı</label>
                                        <input type="text" name="kitapAd" value="<?= stripslashes($kitap['AD']) ?>" required class="form-control" placeholder="Kitap adı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Seçin</label>
                                        <select class="form-control select2" name="kitapKategori" style="width: 100%;">
                                            <?php
                                            $kategoriler = $VT->veriGetir("SELECT * from tblkategori", "", "", "ORDER BY AD ASC");
                                            if ($kategoriler != false) {
                                                foreach ($kategoriler as $kategori) {
                                                    if ($kategori['ID'] != $kitapKategori)
                                                        echo "<option value='{$kategori['ID']}'>{$kategori['AD']} </option>";
                                                    else
                                                        echo "<option selected value='{$kategori['ID']}'>{$kategori['AD']} </option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kitap Yayınevi</label>
                                        <input type="text" value="<?= stripslashes($kitap['YAYINEVI'])  ?>" name="kitapYayinEvi" required class="form-control" placeholder="Kitap adı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Kitap Basım Yılı</label>
                                        <input type="text" value="<?= stripslashes($kitap['BASIMYIL'])  ?>" required title="Yıl 4 haneli ve sayı olmalı" pattern="[0-9]{4}" name="kitapBasimYili" required class="form-control" placeholder="Kitap basım yılı giriniz...">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Yüklü Resim</label>
                                        <img class="img-fluid" src="<?= $resim ?>" alt="">
                                    </div>
                                </div>
                                <!-- SAĞ TARAF -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sayfa Sayısı</label>
                                        <input type="number" min="1" step="1" value="<?= stripslashes($kitap['SAYFA'])  ?>" name="kitapSayfa" required class="form-control" placeholder="Kitap sayfa sayısı giriniz...">
                                        <input type="hidden" name="id" value="<?= $kitap['ID'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Yazar veya Yazarlar</label>
                                        <div class="select2-purple">
                                            <select name="yazarlar[]" class="select2" multiple="multiple" data-placeholder="Yazar seçin" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <?php
                                                /* 
                                                Burada işlemdeki kitaba ait olan kitap bilgilerini alıyoruz .
                                                Yalnız  tüm yazarlar dizi  karşılaştırması yapacağımız için INNER JOIN işleminde sadece
                                                yazar tablosunun bilgilerini çekiyoruz .

                                                */
                                                $simdikiKitapinYazarlari = $VT->veriGetir("SELECT yazar.* , CONCAT(yazar.AD, ' ' , yazar.SOYAD) as yazarBilgi from tblyazarkitap yk INNER JOIN tblyazar yazar ON yazar.ID = yk.yazarId ", "where yk.kitapId = ?", array($id), "ORDER BY yazar.AD ASC");
                                                $yazarlar = $VT->veriGetir("SELECT * , CONCAT(AD, ' ' , SOYAD) as yazarBilgi from tblyazar ", "", "", "ORDER BY AD ASC");
                                                if ($yazarlar != false) {
                                                    foreach ($yazarlar as $yazar) {
                                                        // Eğer kitaba ait bir dizi dönmüş ise ve gelen yazar bu tabloda var ise selected olarak yazdırıyoruz.
                                                        if (is_array($simdikiKitapinYazarlari) && in_array($yazar,$simdikiKitapinYazarlari))
                                                            echo "<option selected value='{$yazar['ID']}'>{$yazar['yazarBilgi']} </option>";
                                                        else
                                                            echo "<option  value='{$yazar['ID']}'>{$yazar['yazarBilgi']} </option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>İSBN</label>
                                        <input type="text" value="<?= stripslashes($kitap['ISBN']) ?>" name="kitapIsbn" required class="form-control" placeholder="Kitap sayfa sayısı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Kitap Resmi(Yükleme yapmaz iseniz ve aşağıdaki kutucuğu onarylarsanız ISBN numarasına göre otomatik fotoğraf çekecektir)</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" name="linktenCek" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Kitap resmi otomatik olarak çekilsin mi ?
                                            </label>
                                        </div>
                                        <input type="file" accept="image/*" name="kitapResim" class="form-control" ">
                                    </div>
                                    <div class=" form-group">
                                        <label>Kitap Detay </label>
                                        <textarea name="kitapDetay" id="summernote" cols="30" rows="100"><?= stripslashes($kitap['DETAY']) ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="kitapDuzenle" class="btn btn-primary ml-auto">Güncelle</button>
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