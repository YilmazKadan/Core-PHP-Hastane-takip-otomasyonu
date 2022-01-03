
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Poliklinik Ekle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/polliste" class="btn btn-info btn-lg float-right">Tüm Poliklinikler</a>
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
                            <h3 class="card-title">Poliklinik Ekleme</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Poliklinik Adı</label>
                                    <input type="text" name="polAd" class="form-control" placeholder="Poliklinik adı giriniz...">
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="polEkle" class="btn btn-primary ml-auto">Ekle</button>
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