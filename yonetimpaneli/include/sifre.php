

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Şifre Değiştirme</h1>
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
                            <h3 class="card-title">Şifre Güncelleme</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Şifre</label>
                                    <input type="text"  name="sifre" class="form-control" required placeholder="Şifre giriniz...">
                                </div>
                                <div class="form-group">
                                    <label>Şifre Tekrar</label>
                                    <input type="text"  name="sifreTekrar" class="form-control" required placeholder="Şifrenizi tekrar giriniz...">
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="sifreDegistir" class="btn btn-primary ml-auto">Şifre Değiştir</button>
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