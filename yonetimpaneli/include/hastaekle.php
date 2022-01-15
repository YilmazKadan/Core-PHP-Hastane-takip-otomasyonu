<?php

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hasta Ekle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/hastaliste" class="btn btn-info btn-lg float-right">Tüm hastalar</a>
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
                            <h3 class="card-title">Hasta Ekle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Hasta Adı</label>
                                    <input type="text" name="hastaAd" class="form-control" required placeholder="Hasta adı giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Hasta Soyadı</label>
                                    <input type="text" value="" name="hastaSoyad" class="form-control" required placeholder="Hasta soyadı giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Hasta TC</label>
                                    <input type="text" value="" name="hastaTc" class="form-control" required placeholder="Hasta TC NO giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Hasta Cinsiyet</label>
                                    <select class="form-control" name="hastaCinsiyet" id="">
                                        <option value="Erkek">Erkek</option>
                                        <option value="Kadın">Kadın</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hasta Telefon</label>
                                    <input type="text" value="" name="hastaTel" class="form-control" required placeholder="Hasta telefon giriniz...">
                                </div>
                                <!-- Date -->
                                <div class="form-group">
                                    <label>Dogum tarihi:</label>
                                    <div class="input-group date"id="dogumtarihi" data-target-input="nearest">
                                        <input type="text" name="dogumTarihi"  class="form-control datetimepicker-input" data-target="#dogumtarihi" />
                                        <div class="input-group-append" data-target="#dogumtarihi" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="hastaEkle" class="btn btn-primary ml-auto">Ekle</button>
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