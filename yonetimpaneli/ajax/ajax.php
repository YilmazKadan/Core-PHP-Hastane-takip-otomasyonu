<?php
@session_start();
@ob_start();
define("SINIF", "../class/");
include_once("../data/baglanti.php");
define("SITE", $url . "yonetimpaneli/");
if ($VT->yetkiKontrol() and !empty($_GET['mode'])) {

    // SSP sınıfı
    require SINIF . 'ssp.php';

    $dbDetails = array(
        'host' => 'DESKTOP-QFAKDN8\MSSQLSERVER01',
        'user' => 'yilmaz',
        'pass' => '159753',
        'db'   => 'hastane'
    );
    //  Kitap listesi için
    if ($_GET['mode'] == 'kitapliste') {
        $table = "
    (
        SELECT 
        ki.*,
        ka.AD as kategoriAd
                                    
        from  tblkitap ki  LEFT JOIN tblkategori ka ON ka.ID = ki.KATEGORI
    ) temp";
        $primaryKey = 'ID';

        $columns = array(
            array('db' => 'ID', 'dt' => 0, 'formatter' => function ($id) {
                return $id;
            }),
            array('db' => 'KITAPRESIM', 'dt' => 1, 'formatter' => function ($resim) {
                if (!empty($resim)) {
                    // Resim bir url ise src yapımızı değiştiriyoruz.
                    if (filter_var($resim, FILTER_VALIDATE_URL)) {
                        return "<img class='td-image'  src='{$resim}'>";
                    }
                    return "<img class='td-image'  src='../images/kitapresim/{$resim}'>";
                } else {
                    return "Resim yüklenmemiş";
                }
            }),
            array('db' => 'AD', 'dt' => 2, 'formatter' => function ($data) {
                return stripslashes($data);
            }),
            array('db' => 'kategoriAd',  'dt' => 3, 'formatter' => function ($data) {
                return stripslashes($data);
            }),
            array('db' => 'ISBN',     'dt' => 4, 'formatter' => function ($data) {
                return stripslashes($data);
            }),
            array('db' => 'DURUM',     'dt' => 6, 'formatter' => function ($data) {
                return ($data == 1) ? "<span class = 'text-danger'> ÖDÜNÇTE </span>" : "<span class = 'text-success'>RAFTA </span>";
            }),
            array('db' => 'ID',  'dt' => 7, 'formatter' => function ($ID) {
                return "<a class ='btn btn-danger mr-3 silbuton' href='sil/tblkitap/{$ID}'>Sil</a>
            <a class ='btn btn-primary' href='duzenle/kitapduzenle/{$ID}'>Düzenle</a> ";
            })

        );
        $kitaplar = SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns);
        // Kitapların yazarlarını çekip tekrar diziye ekliyoruz.
        foreach ($kitaplar['data'] as $kitapIndis => $deger) {
            //Kullanıcı yetkisi admin değil ise düzenleme ve silme işlemlerini diziden çıkartıyoruz.
            if (!$VT->yetkiKontrol(2)) {
                unset($kitaplar['data'][$kitapIndis][7]);
            }
            $kitapId = $deger[0];
            $yazarlar = $VT->veriGetir(
                "SELECT CONCAT(yz.AD, ' ', yz.SOYAD) as isim 
        from tblyazarkitap yzk 
        INNER JOIN tblyazar yz on yzk.yazarId = yz.ID",
                "where yzk.kitapId = ?",
                array($kitapId),
                "ORDER BY yz.AD ASC"
            );
            if ($yazarlar != false) {
                // Yazarların her biri bir array içinde geldiği için yeni listeye aktarım yapıyoruz .
                $birlesmisYazarlarListesi = array();
                foreach ($yazarlar as $yazar) {
                    $birlesmisYazarlarListesi[] = $yazar['isim'];
                }
                $birlesmisYazarlarListesi = implode(",", $birlesmisYazarlarListesi);
                $kitaplar['data'][$kitapIndis][5] = $birlesmisYazarlarListesi;
            } else {
                $kitaplar['data'][$kitapIndis][5] = "Yazarsız";
            }
        }
        // Json çıkışı
        echo json_encode(
            $kitaplar
        );
    }
    //  KASA LİSTESİ
    else if ($_GET['mode'] == 'kasaliste' and $VT->yetkiKontrol(2)) {
        $table = "
    (
        SELECT 
         kasa.*, hareket.ID as islemNumarasi,
         CONCAT(uyeler.Ad ,' ' , uyeler.Soyad) as uyeAd,
         uyeler.TCNO as TCNO
         
        from tblkasa kasa LEFT JOIN tblhareket hareket
        ON hareket.ID = kasa.HAREKET 
        LEFT JOIN tbluyeler uyeler
        ON hareket.UYE = uyeler.ID
    ) temp ";
        $primaryKey = 'ID';

        $columns = array(
            array('db' => 'ID', 'dt' => 0, 'formatter' => function ($id) {
                return $id;
            }),
            array('db' => 'islemNumarasi', 'dt' => 1, 'formatter' => function ($islemNumarasi) {
                return ($islemNumarasi);
            }),
            array('db' => 'TAHSILTARIH',  'dt' => 2, 'formatter' => function ($tahsilTarihi) {
                return date_format(date_create($tahsilTarihi), "Y-m-d");
            }),
            array('db' => 'uyeAd',     'dt' => 3, 'formatter' => function ($data) {
                return stripslashes($data);
            }),
            array('db' => 'TUTAR',     'dt' => 4, 'formatter' => function ($data) {
                return "<span class = 'text-success' > {$data} TL </span>";
            }),
        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    //  ODUNC LİSTESİ
    else if ($_GET['mode'] == 'oduncliste' and $VT->yetkiKontrol(2)) {
        $table = "
    (
        SELECT hareket.*,
        kitap.AD as kitapAd,
        CONCAT(uye.AD , ' ', uye.SOYAD) as uyeAd,
        DATEDIFF(CURDATE(),hareket.IADETARIH) as Gecikme
        
        from  tblhareket hareket
        INNER JOIN tbluyeler uye ON hareket.UYE = uye.ID
         INNER JOIN tblkitap kitap on hareket.KITAP = kitap.ID
         where ISLEMDURUM = 0
    ) temp
    ";
        $primaryKey = 'ID';

        $columns = array(
            array('db' => 'ID', 'dt' => 0, 'formatter' => function ($id) {
                return $id;
            }),
            array('db' => 'uyeAd',     'dt' => 1, 'formatter' => function ($data) {
                return stripslashes($data);
            }),
            array('db' => 'kitapAd', 'dt' => 2, 'formatter' => function ($kitapAd) {
                return stripslashes($kitapAd);
            }),
            array('db' => 'ALISTARIH',  'dt' => 3, 'formatter' => function ($ALISTARIH) {
                return date_format(date_create($ALISTARIH), "Y-m-d");
            }),
            array('db' => 'IADETARIH',  'dt' => 4, 'formatter' => function ($IADETARIH) {
                return date_format(date_create($IADETARIH), "Y-m-d");
            }),
            array('db' => 'Gecikme',  'dt' => 5, 'formatter' => function ($gecikmeSuresi) {
                if ($gecikmeSuresi > 0)
                    $gecikmeMetin = "<span class='text-danger'>[" . $gecikmeSuresi . "] Gün geç kalındı</span>";
                else if ($gecikmeSuresi < 0)
                    $gecikmeMetin = "<span class='text-success'>Teslim için [" . abs($gecikmeSuresi) . "] gün daha var</span>";
                else
                    $gecikmeMetin = "<span class ='text-warning'>Tesim için son gün</span>";
                return $gecikmeMetin;
            }),
            array('db' => 'ID',     'dt' => 6, 'formatter' => function ($data) {
                return "<a class ='btn btn-primary' href='oduncteslimal/{$data}'>Teslim Al</a>";
            })
        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    // DUYURU LİSTESİ
    else if ($_GET['mode'] == 'duyuruliste') {
        $table =
            "tblduyurular";
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'ID', 'dt' => 0, 'formatter' => function ($id) {
                return $id;
            }),
            array('db' => 'TARIH', 'dt' => 1, 'formatter' => function ($tarih) {
                return date_format(date_create($tarih), 'Y-m-d');
            }),
            array('db' => 'BASLIK', 'dt' => 2, 'formatter' => function ($baslik) {
                return stripslashes($baslik);
            }),
            array('db' => 'ICERIK', 'dt' => 3, 'formatter' => function ($icerik) {
                return mb_substr(strip_tags(stripslashes($icerik)), 0, 50);
            }),
            array('db' => 'ID',  'dt' => 4, 'formatter' => function ($ID) {
                return "<a class ='btn btn-danger mr-3 silbuton' href='sil/tblduyuru/{$ID}'>Sil</a>
            <a class ='btn btn-primary' href='duzenle/duyuruduzenle/{$ID}'>Düzenle</a> ";
            })

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    // İLETİŞİM LİSTESİ
    else if ($_GET['mode'] == 'iletisimliste' and $VT->yetkiKontrol(2)) {
        $table =
            "tbliletisim";
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'AD', 'dt' => 0, 'formatter' => function ($ad) {
                return stripslashes($ad);
            }),
            array('db' => 'MAIL', 'dt' => 1, 'formatter' => function ($mail) {
                return stripslashes($mail);
            }),
            array('db' => 'KONU', 'dt' => 2, 'formatter' => function ($konu) {
                return stripslashes($konu);
            }),
            array('db' => 'MESAJ', 'dt' => 3, 'formatter' => function ($icerik) {
                return mb_substr(strip_tags(stripslashes($icerik)), 0, 50);
            }),
            array('db' => 'TARIH', 'dt' => 4, 'formatter' => function ($tarih) {
                return $tarih;
            }),
            array('db' => 'ID',  'dt' => 5, 'formatter' => function ($ID) {
                return "<a class ='btn btn-danger mr-3 silbuton' href='sil/tbliletisim/{$ID}'>Sil</a>
            <a class ='btn btn-primary' href='iletisimdetay/{$ID}'>Detay</a> ";
            })

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    // KATEGORİ LİSTESİ
    else if ($_GET['mode'] == 'polliste' and $VT->yetkiKontrol(2)) {
        $table =
            "hastane.pol_dal";
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'ID', 'dt' => 0, 'formatter' => function ($id) {
                return $id;
            }),
            array('db' => 'pol_ad', 'dt' => 1, 'formatter' => function ($ad) {
                return stripslashes($ad);
            }),
            array('db' => 'ID',  'dt' => 2, 'formatter' => function ($ID) {
                return "<a class ='btn btn-danger mr-3 silbuton' href='sil/pol_dal/{$ID}'>Sil</a>
            <a class ='btn btn-primary' href='duzenle/polduzenle/{$ID}'>Düzenle</a> ";
            })

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    // Doktor  LİSTESİ
    else if ($_GET['mode'] == 'doktorliste' and $VT->yetkiKontrol(2)) {
        $table = "(SELECT doktor.*, pol_dal.pol_ad as pol_ad from
         hastane.doktor doktor INNER JOIN hastane.pol_dal pol_dal
                                    
        ON  doktor.DAL_NO = pol_dal.ID)temp";
        $primaryKey = 'ID';
        $columns = array(

            array('db' => 'AD', 'dt' => 0, 'formatter' => function ($ad) {
                return stripslashes($ad);
            }),
            array('db' => 'SOYAD', 'dt' => 1, 'formatter' => function ($soyad) {
                return stripslashes($soyad);
            }),
            array('db' => 'pol_ad', 'dt' => 2, 'formatter' => function ($detay) {
                return (strlen($detay) >= 80) ? mb_substr(strip_tags(stripslashes($detay)), 0, 80) . "..." : $detay;
            }),
            array('db' => 'ID',  'dt' => 3, 'formatter' => function ($ID) {
                return "<a class ='btn btn-danger mr-3 silbuton' href='sil/doktor/{$ID}'>Sil</a>
            <a class ='btn btn-primary' href='duzenle/doktorduzenle/{$ID}'>Düzenle</a>";
            })

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    // UYE  LİSTESİ
    else if ($_GET['mode'] == 'hastaliste' and $VT->yetkiKontrol(2)) {
        $table =
            "(SELECT * from  hastane.hasta)temp";
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'h_ad', 'dt' => 0, 'formatter' => function ($ad) {
                return $ad;
            }),
            array('db' => 'h_soyad', 'dt' => 1, 'formatter' => function ($soyad) {
                return stripslashes($soyad);
            }),
            array('db' => 'h_tcno', 'dt' => 2, 'formatter' => function ($tcno) {
                return stripslashes($tcno);
            }),
            array('db' => 'h_cinsiyet', 'dt' => 3, 'formatter' => function ($cinsiyet) {
                return stripslashes($cinsiyet);
            }),
            array('db' => 'h_telno', 'dt' => 4, 'formatter' => function ($okul) {
                return stripslashes($okul);
            }),
            array('db' => 'h_dogum_tarihi', 'dt' => 5, 'formatter' => function ($dogumTarihi) {
                return date_format(date_create($dogumTarihi), "Y-m-d H:i:s");
            }),
            array('db' => 'ID',  'dt' => 6, 'formatter' => function ($ID) {
                return "<a class ='btn btn-danger mr-3 silbuton' href='sil/hasta/{$ID}'>Sil</a>
            <a class ='btn btn-primary' href='duzenle/hasta/{$ID}'>Düzenle</a> ";
            })

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    // İlaç  LİSTESİ
    else if ($_GET['mode'] == 'ilacliste' and $VT->yetkiKontrol(2)) {
        $table =
            "(SELECT * from  hastane.ilac)temp";
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'ilac_ad', 'dt' => 0, 'formatter' => function ($ad) {
                return $ad;
            }),
            array('db' => 'ilac_barkod_no', 'dt' => 1, 'formatter' => function ($soyad) {
                return stripslashes($soyad);
            }),
            array('db' => 'ilac_miktar', 'dt' => 2, 'formatter' => function ($tcno) {
                return stripslashes($tcno);
            }),
            array('db' => 'ilac_tipi', 'dt' => 3, 'formatter' => function ($cinsiyet) {
                return stripslashes($cinsiyet);
            }),
            array('db' => 'ID',  'dt' => 4, 'formatter' => function ($ID) {
                return "<a class ='btn btn-danger mr-3 silbuton' href='sil/ilac/{$ID}'>Sil</a>
            <a class ='btn btn-primary' href='duzenle/ilacduzenle/{$ID}'>Düzenle</a> ";
            })

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    // YETKİ  LİSTESİ
    else if ($_GET['mode'] == 'yetkiliste' and $VT->yetkiKontrol(4)) {
        $table =
            "(SELECT uye.*, yetki.YETKIAD as YETKIAD from hastane.users uye
             INNER JOIN hastane.tblyetkiler yetki
                                    
             ON  yetki.ID = uye.KULLANICIYETKI)temp";
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'FOTOGRAF', 'dt' => 0, 'formatter' => function ($foto) {
                $uyeresim = (!empty($foto) ? "../images/uyeresim/" . $foto : "../images/uyeresim/varsayilanuser.png");
                return "<img class='img-fluid' src = '{$uyeresim}'>";
            }),
            array('db' => 'AD', 'dt' => 1, 'formatter' => function ($ad) {
                return stripslashes($ad);
            }),
            array('db' => 'SOYAD', 'dt' => 2, 'formatter' => function ($soyad) {
                return stripslashes($soyad);
            }),
            array('db' => 'MAIL', 'dt' => 3, 'formatter' => function ($mail) {
                return stripslashes($mail);
            }),
            array('db' => 'KAYITTARIHI', 'dt' => 4, 'formatter' => function ($kayit) {
                return date_format(date_create($kayit), "Y-m-d H:i:s");
            }),
            array('db' => 'YETKIAD', 'dt' => 5, 'formatter' => function ($yetkiAd) {
                $yetkiRenk = ($yetkiAd == "Admin") ? "success" : "warning";
                $yetkiRenk = ($yetkiAd == "Hemsire") ? "info" : $yetkiRenk;
                return "<a href = '#' class = 'btn btn-{$yetkiRenk}'>{$yetkiAd}</a>";
            }),
            array('db' => 'ID',  'dt' => 6, 'formatter' => function ($ID) {

                return "<a class ='btn btn-primary' href='duzenle/yetkiduzenle/{$ID}'>Yetki Değiştir</a> ";
            })

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    // ÜYE  LİSTESİ
    else if ($_GET['mode'] == 'uyeliste' and $VT->yetkiKontrol(2)) {
        $table =
            "(SELECT uye.*, yetki.YETKIAD as YETKIAD from hastane.users uye
             INNER JOIN hastane.tblyetkiler yetki
                                    
             ON  yetki.ID = uye.KULLANICIYETKI)temp";
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'FOTOGRAF', 'dt' => 0, 'formatter' => function ($foto) {
                $uyeresim = (!empty($foto) ? "../images/uyeresim/" . $foto : "../images/uyeresim/varsayilanuser.png");
                return "<img class='img-fluid' src = '{$uyeresim}'>";
            }),
            array('db' => 'AD', 'dt' => 1, 'formatter' => function ($ad) {
                return stripslashes($ad);
            }),
            array('db' => 'SOYAD', 'dt' => 2, 'formatter' => function ($soyad) {
                return stripslashes($soyad);
            }),
            array('db' => 'MAIL', 'dt' => 3, 'formatter' => function ($mail) {
                return stripslashes($mail);
            }),
            array('db' => 'KAYITTARIHI', 'dt' => 4, 'formatter' => function ($kayit) {
                return date_format(date_create($kayit), "Y-m-d H:i:s");
            }),
            array('db' => 'YETKIAD', 'dt' => 5, 'formatter' => function ($yetkiAd) {
                $yetkiRenk = ($yetkiAd == "Admin") ? "success" : "warning";
                $yetkiRenk = ($yetkiAd == "Hemsire") ? "info" : $yetkiRenk;
                return "<a href = '#' class = 'btn btn-{$yetkiRenk}'>{$yetkiAd}</a>";
            }),
            array('db' => 'ID',  'dt' => 6, 'formatter' => function ($ID) {

                return "<a class ='btn btn-primary' href='duzenle/uyeduzenle/{$ID}'>Düzenle</a> ";
            })

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
    // ÖDÜNÇ  LİSTESİ
    else if ($_GET['mode'] == 'oduncliste' and $VT->yetkiKontrol(2)) {
        $table =
            "(SELECT hareket.*,
    kitap.AD as kitapAd,
        uye.AD as uyeAd,
        uye.SOYAD as uyeSoyad,
        DATEDIFF(CURDATE(),hareket.IADETARIH) as Gecikme
        
         from  tblhareket hareket
         INNER JOIN tbluyeler uye ON hareket.UYE = uye.ID
         INNER JOIN tblkitap kitap on hareket.KITAP = kitap.ID
         WHERE ISLEMDURUM = 0)temp";
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'ID', 'dt' => 0, 'formatter' => function ($id) {
                return $id;
            }),
            array('db' => 'uyeAd', 'dt' => 1, 'formatter' => function ($ad) {
                return stripslashes($ad);
            }),
            array('db' => 'kitapAd', 'dt' => 2, 'formatter' => function ($soyad) {
                return stripslashes($soyad);
            }),
            array('db' => 'ALISTARIH', 'dt' => 3, 'formatter' => function ($alis) {
                return stripslashes($alis);
            }),
            array('db' => 'IADETARIH', 'dt' => 4, 'formatter' => function ($iadeTarihi) {
                return stripslashes($iadeTarihi);
            }),
            array('db' => 'Gecikme', 'dt' => 5, 'formatter' => function ($gecikmeSuresi) {
                if ($gecikmeSuresi > 0)
                    $gecikmeMetin = "<span class='text-danger'>[" . $gecikmeSuresi . "] Gün geç kalındı</span>";
                else if ($gecikmeSuresi < 0)
                    $gecikmeMetin = "<span class='text-success'>Teslim için [" . abs($gecikmeSuresi) . "] gün daha var</span>";
                else
                    $gecikmeMetin = "<span class ='text-warning'>Tesim için son gün</span>";
                return $gecikmeMetin;
            }),
            array('db' => 'ID',  'dt' => 6, 'formatter' => function ($ID) {

                return "<a class ='btn btn-primary' href='oduncteslimal/{$ID}'>Düzenle</a> ";
            })

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }  // ÖDÜNÇ GEÇMİŞ
    else if ($_GET['mode'] == 'oduncgecmis' and $VT->yetkiKontrol(2)) {
        $table =
            "(
        SELECT hareket.*,
         kitap.AD as kitapAd, CONCAT(uye.AD , ' ',uye.SOYAD) as uyeIsim,
         DATEDIFF(hareket.UYEGETIRTARIH,hareket.IADETARIH) as Gecikme
        
         from  tblhareket hareket
         LEFT JOIN tbluyeler uye ON hareket.UYE = uye.ID
         LEFT JOIN tblkitap kitap on hareket.KITAP = kitap.ID
         WHERE ISLEMDURUM = 1
         )temp";
        $primaryKey = 'ID';

        $columns = array(

            array('db' => 'ID', 'dt' => 0, 'formatter' => function ($id) {
                return $id;
            }),
            array('db' => 'uyeIsim', 'dt' => 1, 'formatter' => function ($ad) {
                return stripslashes($ad);
            }),
            array('db' => 'kitapAd', 'dt' => 2, 'formatter' => function ($kitap) {
                if (empty($kitap)) {
                    return "<span class = 'text-red text-bold' >Kitap silinmiş</span>";
                }
                return stripslashes($kitap);
            }),
            array('db' => 'ALISTARIH', 'dt' => 3, 'formatter' => function ($alis) {
                return stripslashes($alis);
            }),
            array('db' => 'IADETARIH', 'dt' => 4, 'formatter' => function ($iadeTarihi) {
                return stripslashes($iadeTarihi);
            }),
            array('db' => 'UYEGETIRTARIH', 'dt' => 5, 'formatter' => function ($uyeGetirTarih) {
                return stripslashes($uyeGetirTarih);
            }),
            array('db' => 'Gecikme', 'dt' => 6, 'formatter' => function ($gecikmeSuresi) {
                if ($gecikmeSuresi > 0)
                    $gecikmeMetin = "<span class='text-danger'>[" . $gecikmeSuresi . "] Gün geç kalındı</span>";
                else if ($gecikmeSuresi < 0)
                    $gecikmeMetin = "<span class='text-success'>Teslim için [" . abs($gecikmeSuresi) . "] gün daha var</span>";
                else
                    $gecikmeMetin = "<span class ='text-warning'>Tesim için son gün</span>";
                return $gecikmeMetin;
            }),

        );
        // Json çıkışı
        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
} else {
    echo '<center><h1>Bu sayfaya direkt erişiminiz yasaktır ! </h1></center>';
}
