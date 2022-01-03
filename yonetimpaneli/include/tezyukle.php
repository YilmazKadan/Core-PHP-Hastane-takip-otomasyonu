<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Boş Sayfa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h3>Lütfen aşağıdaki formata sahip bir excell dosyası yükleyin.</h3>
                    <ul>
                        <li>Başlık kısımları görseldeki gibi büyük harflerden oluşmalı</li>
                        <li>Hiçbir başlık eksik olmamalı</li>
                        <li>Her satırda bir kayıt olmalı, iki satır veya sütun birleştirilmemeli !</li>
                    </ul>
                    <img src="<?= SITE ?>../images/tezYukleFormat.jpg" alt="">
                </div>
                <div class="row mt-4">
                    <form action="<?= SITE ?>data/islem.php" method="POST" enctype="multipart/form-data">
                        <div class="card p-3 pt-4">
                            <div class="form-group d-flex">
                                <input type="file" class="form-control" required name="excell">
                                <input type="submit" name="tezYukle" class="btn btn-primary ml-3">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>