<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kitap Ekle</h1>
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
                            <h3 class="card-title">Kitap Ekleme</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kitap Adı</label>
                                        <input type="text" name="kitapAd" required class="form-control" placeholder="Kitap adı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Seçin</label>
                                        <select class="form-control select2" name="kitapKategori" style="width: 100%;">
                                            <?php
                                            $kategoriler = $VT->veriGetir("SELECT * from tblkategori", "", "", "ORDER BY AD ASC");
                                            if ($kategoriler != false) {
                                                foreach ($kategoriler as $kategori)
                                                    echo "<option value='{$kategori['ID']}'>{$kategori['AD']} </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kitap Yayınevi</label>
                                        <input type="text" name="kitapYayinEvi" required class="form-control" placeholder="Kitap yayın evi giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Kitap Basım Yılı</label>
                                        <input type="text" required title="Yıl 4 haneli ve sayı olmalı" pattern="[0-9]{4}" name="kitapBasimYili" required class="form-control" placeholder="Kitap basım yılı giriniz...">
                                    </div>
                                </div>
                                <!-- SAĞ TARAF -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sayfa Sayısı</label>
                                        <input type="number" min="1" step="1" name="kitapSayfa" required class="form-control" placeholder="Kitap sayfa sayısı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Yazar veya Yazarlar</label>
                                        <div class="select2-purple">
                                            <select name="yazarlar[]" class="select2" multiple="multiple" data-placeholder="Yazar seçin" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <?php
                                                $yazarlar = $VT->veriGetir("SELECT * , CONCAT(AD, ' ' , SOYAD) as yazarBilgi from tblyazar ", "", "", "ORDER BY AD ASC");

                                                if ($yazarlar != false) {
                                                    foreach ($yazarlar as $yazar) {
                                                            echo "<option  value='{$yazar['ID']}'>{$yazar['yazarBilgi']} </option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>İSBN</label>
                                        <input type="text"  name="kitapIsbn" required class="form-control" placeholder="Kitap ISBN  giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Kitap Resmi(Yükleme yapmaziseniz ISBN numarasına göre otomatik fotoğraf çekecektir)</label>
                                        <input type="file" accept="image/*" name="kitapResim"  class="form-control" ">
                                    </div>
                                    <div class="form-group">
                                        <label>Kitap Detay </label>
                                        <textarea name="kitapDetay" id="summernote" cols="30" rows="100"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="kitapEkle" class="btn btn-primary ml-auto">Ekle</button>
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