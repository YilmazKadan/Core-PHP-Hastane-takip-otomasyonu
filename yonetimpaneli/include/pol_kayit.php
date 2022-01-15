<?php

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Poliklinik Kayıt Ekle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/pol_kayitliste" class="btn btn-info btn-lg float-right">Tüm poliklnik kayıtları</a>
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
                            <h3 class="card-title">Poliklinik Kaydı Ekle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Hasta seçin</label>
                                        <select class="form-control select2" name="hastaId" style="width: 100%;">
                                            <?php
                                            $hastalar = $VT->veriGetir("SELECT * from hastane.hasta");
                                            foreach ($hastalar as $hasta)
                                            echo "<option value='{$hasta['ID']}'>{$hasta['h_tcno']} -- {$hasta['h_ad']} {$hasta['h_soyad']}</option>";
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Poliklinik seçin</label>
                                        <select class="form-control select2" name="polId" style="width: 100%;">
                                            <?php
                                            $hastalar = $VT->veriGetir("SELECT * from hastane.pol_dal");
                                                foreach ($hastalar as $hasta)
                                                        echo "<option value='{$hasta['ID']}'>{$hasta['pol_ad']}</option>";
                                            ?>
                                        </select>
                                    </div>
                                    <label>Doktor</label>
                                    <select class="form-control select2" name="doktorId" style="width: 100%;">
                                        <?php
                                        $doktorlar = $VT->veriGetir("SELECT * from hastane.doktor");
                                            foreach ($doktorlar as $doktor)
                                                    echo "<option value='{$doktor['ID']}'>{$doktor['AD']} {$doktor['SOYAD']} </option>";
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Reçete için  ilaç seçin</label>
                                    <select class="form-control select2" name="ilacNo" style="width: 100%;">
                                        <?php
                                        $polDal = $VT->veriGetir("SELECT * from hastane.ilac");
                                            foreach ($polDal as $dal)
                                                 echo "<option value='{$dal['ID']}'>{$dal['ilac_ad']} </option>";
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>İlaç kullanma süresi</label>
                                    <input type="number" value="" name="kulSure" class="form-control" required placeholder="İlaç kullanma süresi giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>İlaç dozaj</label>
                                    <input type="number" value="" name="dozaj" class="form-control" required placeholder="İlaç dozasj  giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Tanı</label>
                                    <textarea name="tani" class="form-control" required placeholder="Tanı giriniz..."></textarea>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="polKayitEkle" class="btn btn-primary ml-auto">Ekle</button>
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