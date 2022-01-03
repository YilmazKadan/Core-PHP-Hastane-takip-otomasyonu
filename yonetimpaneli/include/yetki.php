<?php 
// Admin seviyesinden biri sadece bu sayfaya erişebilir
if(!$VT->yetkiKontrol(4))
    $VT->yonlendir(SITE);

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Üyeler</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <a href="sayfa/uyeekle" class="btn btn-info btn-lg float-right">Üye Ekle</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tüm üyelerin listesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" data-ajaxid="yetkiliste" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Üye Resim</th>
                                        <th>Üye Adı</th>
                                        <th>Üye Soyadı</th>
                                        <th>Üye Mail</th>
                                        <th>Üye Kayıt</th>
                                        <th>Üye Yetki</th>
                                        <th witdh=50 >İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>