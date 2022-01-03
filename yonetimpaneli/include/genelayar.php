


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ayar Düzenleme</h1>
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
                            <h3 class="card-title">Ayarları Düzenle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Site Başlık (Html etiketi için)</label>
                                    <input type="text" value="<?=$baslik ?>" name="siteBaslik" class="form-control" required placeholder="Site başlığı giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Site Url</label>
                                    <input type="text" value="<?=$url ?>" name="siteUrl" class="form-control" required placeholder="Site url giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Site Anahtar Kelimeler(Keywrods)</label>
                                    <input type="text" value="<?=$anahtar ?>" name="siteAnahtar" class="form-control" required placeholder="Site anahtar kelimeleri giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Site Açıklaması</label>
                                    <input type="text" value="<?=$aciklama ?>" name="siteAciklama" class="form-control" required placeholder="Site açıklaması giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Site Telefon 1</label>
                                    <input type="text" value="<?=$telefon1 ?>" name="siteTel1" class="form-control"  placeholder="Site Telefon 1 giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Site Telefon 2</label>
                                    <input type="text" value="<?=$telefon2 ?>" name="siteTel2" class="form-control"  placeholder="Site Telefon 2 giriniz...">
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="siteAyarDuzenle" class="btn btn-primary ml-auto">Güncelle</button>
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