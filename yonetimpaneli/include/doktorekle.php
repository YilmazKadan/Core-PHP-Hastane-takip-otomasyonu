<?php

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Doktor Ekle</h1>
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
                            <h3 class="card-title">Doktor Ekle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Doktor Adı</label>
                                    <input type="text"  name="doktorAd" class="form-control" required placeholder="Doktor adı giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Doktor Soyadı</label>
                                    <input type="text" value="" name="doktorSoyad" class="form-control" required placeholder="Doktor soyadı giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Poliklinik Seçin</label>
                                    <select class="form-control select2" name="doktorPol" style="width: 100%;">
                                        <?php
                                        $polDal = $VT->veriGetir("SELECT * from hastane.pol_dal");
                                            foreach ($polDal as $dal)
                                                    echo "<option value='{$dal['ID']}'>{$dal['pol_ad']} </option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="doktorEkle" class="btn btn-primary ml-auto">Güncelle</button>
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