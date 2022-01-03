<?php
if(!$VT->yetkiKontrol(4))
    $VT->yonlendir(SITE);
$hakkimizda = $VT->veriGetir("SELECT * from tblhakkimizda")[0];
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hakkımızda Düzenle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
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
                            <h3 class="card-title">Hakkımızda Düzenle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Hakkımızda Başlık</label>
                                    <input type="text" value="<?php echo $hakkimizda['BASLIK'] ?>" name="hakkimizdaBaslik" class="form-control" required placeholder="Duyuru başlığı giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Hakkımızda İçerik</label>
                                    <textarea name="hakkimizdaIcerik" id="summernote" > <?= htmlspecialchars(stripslashes($hakkimizda['ACIKLAMA'])) ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="hakkimizdaGuncelle" class="btn btn-primary ml-auto">Güncelle</button>
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