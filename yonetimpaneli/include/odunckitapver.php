<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ödünç İşlemleri</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/oduncliste" class="btn btn-info btn-lg float-right">Tüm Ödünçteki Kitaplar</a>
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
                            <h3 class="card-title">Ödünç Verme</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Üye Seçin</label>
                                        <select class="form-control select2" name="oduncUye" style="width: 100%;">
                                            <?php
                                            // SADECE ÜYE SEVİYESİNDE ÜYELERİ ÇEKİYORUZ
                                            $uyeler = $VT->veriGetir("SELECT * from tbluyeler", "where KULLANICIYETKI = ?",array(1), "ORDER BY AD ASC");
                                            if ($uyeler != false) {
                                                foreach ($uyeler as $uye)
                                                    echo "<option value='{$uye['ID']}'>{{$uye['TCNO']}} {$uye['AD']} {$uye['SOYAD']} </option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Personel Seçin</label>
                                        <select class="form-control select2" name="oduncPersonel" style="width: 100%;">
                                            <?php
                                            // PERSONEL VE ADMIN SEVİYESİNDE ÜYELERİ ÇEKİYORUZ
                                            $personeller = $VT->veriGetir("SELECT * from tbluyeler", "where KULLANICIYETKI >= ?", array(2), "ORDER BY AD ASC");
                                            if ($personeller != false) {
                                                foreach ($personeller as $personel)
                                                    echo "<option value='{$personel['ID']}'>{{$personel['TCNO']}} {$personel['AD']} {$personel['SOYAD']} </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- SAĞ TARAF -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kitap Seçin</label>
                                        <select class="form-control select2" name="oduncKitap" style="width: 100%;">
                                            <?php
                                            // Boşta olan kitapları çekiyoruz.
                                            $kitaplar = $VT->veriGetir("SELECT * from tblkitap", "where durum = ?", array(0), "ORDER BY AD ASC");
                                            if ($kitaplar != false) {
                                                foreach ($kitaplar as $kitap)
                                                {
                                                    
                                                    echo "<option value='{$kitap['ID']}'>".stripslashes($kitap['AD']) ."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="oduncVer" class="btn btn-primary ml-auto">Ödünç Ver</button>
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