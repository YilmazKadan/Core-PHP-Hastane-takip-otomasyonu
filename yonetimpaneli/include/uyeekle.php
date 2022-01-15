<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Üye Ekle</h1>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <a href="sayfa/uyeliste" class="btn btn-info btn-lg float-right">Tüm Üyeler</a>
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
                            <h3 class="card-title">Üye Ekleme</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?= DATA ?>islem.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Üye Adı</label>
                                        <input type="text" name="uyeAd" required class="form-control" placeholder="Üye adı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Üye Email Adresi</label>
                                        <input type="email" name="uyeMail" required class="form-control" placeholder="Üye adı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Üye Tc Kimlik Numarası</label>
                                        <input type="text" name="uyeTc" required class="form-control" placeholder="Üye TC kimlik numarası giriniz...">
                                    </div>
                                </div>
                                <!-- SAĞ TARAF -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Üye Soyadı</label>
                                        <input type="text" name="uyeSoyad" required class="form-control" placeholder="Üye soyadı giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Üye Şifre</label>
                                        <input type="password"  name="uyeSifre" required class="form-control" placeholder="Üye şifresi giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label>Üye Fotoğraf(Eklenmeyebilir)</label>
                                        <input type="file" accept="image/*" name="uyeResim"  class="form-control" ">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" name="uyeEkle" class="btn btn-primary ml-auto">Ekle</button>
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