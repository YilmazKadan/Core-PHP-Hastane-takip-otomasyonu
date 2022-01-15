<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Veritabanı yedek alma ve yedekten dönme .</h1>
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
                </div>
                <div class="row mt-4">
                    <form action="<?= SITE ?>data/backup.php" method="POST" enctype="multipart/form-data">
                        <div class="card p-3 pt-4">
                            <div class="form-group d-flex">
                                <input type="file" class="form-control" required name="backupFile">
                                <input type="submit" name="restoreYap" class="btn btn-primary ml-3">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <form method="POST" action="<?= SITE ?>data/backup.php">
                <input type="submit" name="backupAl" class="btn btn-primary" value="Yedek Al">
            </form>

        </div><!-- /.pontainer-fluid -->
    </section>
    <!-- /.content -->
</div>