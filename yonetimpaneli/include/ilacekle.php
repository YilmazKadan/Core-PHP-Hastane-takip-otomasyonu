<?php

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">İlaç Ekle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/ilacliste" class="btn btn-info btn-lg float-right">Tüm ilaçlar</a>
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
                            <h3 class="card-title">İlaç Ekle</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>İlaç Adı</label>
                                    <input type="text"  name="ilacAd" class="form-control" required placeholder="İlaç adı giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>İlaç Barkod</label>
                                    <input type="text"  name="ilacBarkod" class="form-control" required placeholder="İlaç barkod giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>İlaç Adet</label>
                                    <input type="number"  name="ilacMiktar" class="form-control" required placeholder="İlaç adeti giriniz..">
                                </div>
                                <div class="form-group">
                                    <label>İlaç Tipi</label>
                                    <input type="text"  name="ilacTipi" class="form-control" required placeholder="İlaç tipi giriniz...">
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="ilacEkle" class="btn btn-primary ml-auto">Ekle</button>
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