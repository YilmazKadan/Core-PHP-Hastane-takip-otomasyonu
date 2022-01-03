<?php
include_once(SINIF."class.upload.php");
include_once(SINIF."vt.php");
// VT sınıfı nesnesi
$VT = new VT();
$ayarlar = $VT->veriGetir("SELECT * from hastane.tblayar","WHERE ID = ?",[1]);

if($ayarlar != false){
    $url = $ayarlar[0]['url'];
    $baslik = $ayarlar[0]['baslik'];
    $aciklama = $ayarlar[0]['aciklama'];
    $anahtar = $ayarlar[0]['anahtar'];
    $telefon1 = $ayarlar[0]['telefon1'];
    $telefon2 = $ayarlar[0]['telefon2'];
}
else{
    echo 'Sistem ayar bilgileri çekilirken hata ile karşılaşıldı';
    exit();
}