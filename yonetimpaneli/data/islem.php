<?php
// Bu sayfa çoğu post işlemini  karşılar.
@session_start();
@ob_start();
define("SINIF", "../class/");
include_once("baglanti.php");
define("SITE", $url);
date_default_timezone_set('Europe/Istanbul');

// Aktif olarak bir oturum açılmış ise ve kullanıcı seviyesi 2 ve üzeri yani personel ve üzeri ise işlem yapılabilir.
if (!empty($_SESSION['uye']) and $_SESSION['uye']['KULLANICIYETKI'] >= 2) {
    // Kullanıcının hangi işlemlere erişebileceğini belirlemek amaçlı bu değişkeni kullanıyoruz.
    $kullaniciYetki = $_SESSION['uye']['KULLANICIYETKI'];
    if (!empty($_POST) or !empty($_GET)) {
        //***************************************GENEL SİLME İŞLEMİ*****************************************************************************************
        // Tablo ve id değerine göre genel silme (Tüm silme işlemleri buradan oluyor ve ilgili liste sayfasına yönlendiriliyor.)
        if (!empty($_GET['islem']) and $_GET['islem'] == "sil") {
            $tablo = $VT->filter($_GET['tablo']);
            // Gelen tablo ismi veritabanında var mı diye kontrol ediliyor.
            if ($VT->tabloVarmi($tablo)) {
                $id = $VT->filter($_GET['id']);

                // Silinen tablo ile ilişkili  olan veriler var mı diye kontrol ediyoruz.
                $baglilik = false;

                if ($baglilik == false) {
                    // Fotoğraf içeren alanlar var ise onları siliyoruz
                    if ($tablo == "hastane.users") {
                        $fotograf = $VT->veriGetir("Select FOTOGRAF from hastane.users", "where ID = ?", array($id))[0]["FOTOGRAF"];
                        unlink("../../images/uyeresim/" . $fotograf);
                    } else {
                        $VT->mesajOlustur("hata", $silmeHatasi);
                    }
                    
                    $sil = $VT->sorguCalistir("DELETE FROM hastane." . $tablo . " where ID = ?", array($id));
                    ($sil) ? $VT->mesajOlustur("basarili", $tabloAdi . " Silme işlemi başarılı") : $VT->mesajOlustur("hata", $tabloAdi . " Silme işlemi başarısız");
                } else {
                    $VT->mesajOlustur("hata", $tablo . " isminde bir tablo ismi yoktu hile hurda yapmayın");
                }
                $VT->yonlendir(SITE . "sayfa/" . $tablo . "liste");
            }
        }
        //***************************************GENEL SİLME İŞLEMİ BİTİŞ*****************************************************************************************
        //***************************************DOKTOR İŞLEMLERİ  *************************************************************************************************
        // Doktor ekleme alanı 
        else if (isset($_POST['doktorEkle'])) {

            if (!empty($_POST['doktorAd']) and  !empty($_POST['doktorSoyad'])) {
                $doktorAd = $VT->filter($_POST['doktorAd']);
                $doktorSoyad = $VT->filter($_POST['doktorSoyad']);
                $doktorPol = $VT->filter($_POST['doktorPol']);
                $kayitKontrol = $VT->veriGetir("Select * from hastane.doktor", " where AD = ? and SOYAD = ?", array($doktorAd, $doktorSoyad));

                if ($kayitKontrol == false) {
                    $kayit = $VT->sorguCalistir("INSERT INTO hastane.doktor (AD, SOYAD , DAL_NO) VALUES ( ?, ?, ?)", array($doktorAd, $doktorSoyad, $doktorPol));
                    ($kayit) ? $VT->mesajOlustur("basarili", "Kayıt Başarılı!") : $VT->mesajOlustur("hata", "doktor kaydı sırasında bir hata meydana geldi!");
                } else {
                    $VT->mesajOlustur("hata", "Bu isim ve soyisimde farklı bir doktor var.");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }

            $VT->yonlendir(SITE . "sayfa/doktorekle");
        }
        // Hasta ekleme alanı 
        else if (isset($_POST['hastaEkle'])) {

            if (
                
                !empty($_POST['hastaAd'])
                and  !empty($_POST['hastaSoyad'])
                and  !empty($_POST['hastaTc'])
                and  !empty($_POST['hastaCinsiyet'])
                and  !empty($_POST['hastaTel'])
                
                ) {
                $hastaAd = $VT->filter($_POST['hastaAd']);
                $hastaSoyad = $VT->filter($_POST['hastaSoyad']);
                $hastaTc = $VT->filter($_POST['hastaTc']);
                $hastaCinsiyet = $VT->filter($_POST['hastaCinsiyet']);
                $hastaTel = $VT->filter($_POST['hastaTel']);
                $hastaDogumTarihi = $VT->filter($_POST['dogumTarihi']);

                $kayitKontrol = $VT->veriGetir("Select * from hastane.hasta", " where h_tcno = ?", array($hastaTc));

                if ($kayitKontrol == false) {
                    $kayit = $VT->sorguCalistir("INSERT INTO hastane.hasta (h_ad, h_soyad , h_tcno , h_cinsiyet , h_telno , h_dogum_tarihi) VALUES ( ?, ?, ? , ? , ? , ?)", array($hastaAd, $hastaSoyad, $hastaTc, $hastaCinsiyet , $hastaTel, $hastaDogumTarihi));
                    ($kayit) ? $VT->mesajOlustur("basarili", "Kayıt Başarılı!") : $VT->mesajOlustur("hata", "doktor kaydı sırasında bir hata meydana geldi!");
                } else {
                    $VT->mesajOlustur("hata", "Bu TC NO'da başka bir hasta kayıtlıdır !.");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }

            $VT->yonlendir(SITE . "sayfa/hastaekle");
        }
        // Poliklinik ekleme alanı 
        else if (isset($_POST['polEkle'])) {

            if (!empty($_POST['polAd'])) {
                $polAd = $VT->filter($_POST['polAd']);
                $kayitKontrol = $VT->veriGetir("Select * from hastane.pol_dal", " where pol_ad = ?", array($polAd));

                if ($kayitKontrol == false) {
                    $kayit = $VT->sorguCalistir("INSERT INTO hastane.pol_dal (pol_ad) VALUES (?)", array($polAd));
                    ($kayit) ? $VT->mesajOlustur("basarili", "Kayıt Başarılı!") : $VT->mesajOlustur("hata", "Poliklinik kaydı sırasında bir hata meydana geldi!");
                } else {
                    $VT->mesajOlustur("hata", "Bu isimde farklı bir poliklinik var.");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }

            $VT->yonlendir(SITE . "sayfa/polekle");
        }
        // İlaç ekleme alanı 
        else if (isset($_POST['ilacEkle'])) {

            if (
                !empty($_POST['ilacAd'])
                and !empty($_POST['ilacBarkod'])
                and !empty($_POST['ilacMiktar'])
                and !empty($_POST['ilacBarkod'])
                and !empty($_POST['ilacTipi'])

            ) {
                $ilacAd = $VT->filter($_POST['ilacAd']);
                $ilacMiktar = $VT->filter($_POST['ilacMiktar']);
                $ilacBarkod = $VT->filter($_POST['ilacBarkod']);
                $ilacTipi = $VT->filter($_POST['ilacTipi']);
                $kayitKontrol = $VT->veriGetir("Select * from hastane.ilac", " where ilac_barkod_no = ?", array($ilacBarkod));

                if ($kayitKontrol == false) {
                    $kayit = $VT->sorguCalistir(
                        "INSERT INTO 
                    
                    
                    hastane.ilac (ilac_ad,ilac_barkod_no, ilac_miktar, ilac_tipi) VALUES (? , ? , ?, ? )",


                        array($ilacAd, $ilacBarkod, $ilacMiktar, $ilacTipi)
                    );
                    ($kayit) ? $VT->mesajOlustur("basarili", "Kayıt Başarılı!") : $VT->mesajOlustur("hata", "Poliklinik kaydı sırasında bir hata meydana geldi!");
                } else {
                    $VT->mesajOlustur("hata", "Sistemde aynı barkod numarasında iki kayıt olamaz !.");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }

            $VT->yonlendir(SITE . "sayfa/ilacekle");
        }
        // Poliklinik düzenleme alanı 
        else if (isset($_POST['polDuzenle'])) {

            if (!empty($_POST['polAd'])) {
                $polAd = $VT->filter($_POST['polAd']);
                $kayitKontrol = $VT->veriGetir("SELECT * from hastane.pol_dal", " where pol_ad = ?", array($polAd));
                $id = $VT->filter($_POST['id']);
                // Aynı isimde farklı bir poliklinik yok ise .
                if ($kayitKontrol == false or $kayitKontrol[0]['ID'] == $id) {
                    $update = $VT->sorguCalistir("UPDATE  hastane.pol_dal SET  pol_ad = ? where ID = ?", array($polAd, $id));
                    ($update) ? $VT->mesajOlustur("basarili", "Güncelleme Başarılı!") : $VT->mesajOlustur("hata", "Poliklinik güncelleme sırasında bir hata meydana geldi!");
                } else {
                    $VT->mesajOlustur("hata", "Bu isimde farklı bir poliklinik var.");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }

            $VT->yonlendir(SITE . "duzenle/polduzenle/" . $id);
        }
        // Doktor Düzenleme alanı
        else if (isset($_POST['doktorDuzenle'])) {
            if (!empty($_POST['doktorAd']) && !empty($_POST['id'])  and  !empty($_POST['doktorSoyad'])) {
                $doktorAd = $VT->filter($_POST['doktorAd']);
                $doktorSoyad = $VT->filter($_POST['doktorSoyad']);
                $doktorPol = $VT->filter($_POST['doktorPol']);

                $id = $VT->filter($_POST['id']);

                $kayitKontrol = $VT->veriGetir("Select * from hastane.doktor", " where AD = ? and SOYAD = ?", array($doktorAd, $doktorSoyad));
                // Aynı isimde soyisimde iki doktor olamaz.
                if ($kayitKontrol == false or $kayitKontrol[0]['ID'] == $id) {
                    $update = $VT->sorguCalistir("UPDATE hastane.doktor SET  AD = ? ,  SOYAD = ?  , DAL_NO = ?  WHERE ID = ? ", array($doktorAd, $doktorSoyad, $doktorPol, $id));
                    if ($update != false)
                        $VT->mesajOlustur("basarili", "Doktor güncelleme başarılı!");
                    else
                        $VT->mesajOlustur("hata", "Doktor güncelleme sırasında bir hata meydana geldi");
                } else {
                    $VT->mesajOlustur("hata", "Bu isim ve soyisimde farklı bir doktor var!");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }
            $VT->yonlendir(SITE . "duzenle/doktorduzenle/" . $_POST['id']);
        }

        //***************************************DOKTOR İŞLEMLERİ BİTİŞ *****************************************************************************************


        //***************************************SİTE AYARLARI GÜNCELLEME İŞLEMLERİ  *****************************************************************************************
        // Duyuru düzenleme alanı
        else if (isset($_POST['siteAyarDuzenle'])) {
            // Admin seviyesinden değil ise işlemleri yapmıyoruz.
            if (!$VT->yetkiKontrol(4)) {
                $VT->yonlendir(SITE);
            }
            if (!empty($_POST['siteBaslik']) && !empty($_POST['siteUrl'])) {
                $siteBaslik = $VT->filter($_POST['siteBaslik']);
                $siteUrl = $VT->filter($_POST['siteUrl']);
                $siteAnahtar = $VT->filter($_POST['siteAnahtar']);
                $siteAciklama = $VT->filter($_POST['siteAciklama']);
                $siteTel1 = $VT->filter($_POST['siteTel1']);
                $siteTel2 = $VT->filter($_POST['siteTel2']);


                $update = $VT->sorguCalistir("UPDATE hastane.tblayar SET
                     baslik = ?, 
                     aciklama = ?,
                     anahtar = ?,
                     url = ?,
                     telefon1 = ?,
                     telefon2 = ?
                     ", array($siteBaslik, $siteAciklama, $siteAnahtar, $siteUrl, $siteTel1, $siteTel2));
                if ($update != false)
                    $VT->mesajOlustur("basarili", "Ayar güncelleme başarılı!");
                else
                    $VT->mesajOlustur("hata", "Ayar güncelleme sırasında bir hata meydana geldi!");
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }
            $VT->yonlendir(SITE . "ayarlar/genelayarlar");
        }
        //***************************************SİTE AYARLARI GÜNCELLEME İŞLEMLERİ BİTİŞ *****************************************************************************************

        //  Poliklinik kayit ekleme
        else if (isset($_POST['polKayitEkle']) and $VT->yetkiKontrol(2)) {
            if (
                !empty($_POST['doktorId'])
                and  !empty($_POST['hastaId'])
                and  !empty($_POST['polId'])
                and  !empty($_POST['ilacNo'])
                and  !empty($_POST['tani'])
                and  !empty($_POST['kulSure'])
                and  !empty($_POST['dozaj'])
            ) {
                $doktorId = $VT->filter($_POST['doktorId']);
                $polId = $VT->filter($_POST['polId']);
                $hastaId = $VT->filter($_POST['hastaId']);
                $ilacNo = $VT->filter($_POST['ilacNo']);
                $kulSure = $VT->filter($_POST['kulSure']);
                $dozaj = $VT->filter($_POST['dozaj']);
                $tani = $VT->filter($_POST['tani']);
                $kayit = $VT->sorguCalistir("INSERT INTO hastane.pol_kayit 
                            (
                                pol_no,
                                dr_no,
                                hasta_id ,
                                tani
                          )
                            values(
                                ?,
                                ?,
                                ?,
                                ?
                            )
                            ", array($polId, $doktorId,  $hastaId, $tani));
                // Kayıt başarılı olduktan sonra reçeteyi ekliyoruz ve gelen reçete numarasını son eklenen kayda atıyoruz .
                if ($kayit) {
                    $sonEklenenPolKaydi = $VT::$lastInsertId;

                    $ilacKaydi =  $VT->sorguCalistir("INSERT INTO hastane.recete (ilac_no, kayit_no , kul_suresi, dozaj) 
                        VALUES (? , ? , ? , ?)
                    ", array($ilacNo, $sonEklenenPolKaydi, $kulSure, $dozaj));

                    if ($ilacKaydi) {
                        $VT->mesajOlustur("basarili", "Kayıt başarılı!");
                    } else {
                        $VT->mesajOlustur("hata", "İlaç kaydı  sırasında bir hata meydana geldi!");
                    }
                } else {

                    $VT->mesajOlustur("hata", "Poliklinik kaydı sırasında bir hata meydana geldi!");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }

            $VT->yonlendir(SITE . "sayfa/pol_kayit");
        }
        //***************************************ÜYE İŞLEMLERİ  **********************************************************************************************
        // Üye ekleme alanı 
        else if (isset($_POST['uyeEkle']) and $VT->yetkiKontrol(2)) {

            if (
                !empty($_POST['uyeAd'])
                and  !empty($_POST['uyeMail'])
                and  !empty($_POST['uyeSoyad'])
                and  !empty($_POST['uyeSifre'])
                and  !empty($_POST['uyeTc'])

            ) {
                $uyeAd = $VT->filter($_POST['uyeAd']);
                $uyeSoyad = $VT->filter($_POST['uyeSoyad']);
                $uyeMail = $VT->filter($_POST['uyeMail']);
                $uyeSifre = $_POST['uyeSifre'];
                $uyeTc = $VT->filter($_POST['uyeTc']);

                $kayitKontrol = $VT->veriGetir("Select * from hastane.users", " where TCNO = ? OR MAIL = ?", array($uyeTc, $uyeMail));

                if ($kayitKontrol == false) {
                    if (!empty($_FILES['uyeResim']['name'])) {
                        $yukle = $VT->upload("uyeResim", "../../images/uyeresim");
                        if ($yukle != false) {
                            $kayit = $VT->sorguCalistir("INSERT INTO hastane.users 
                            (
                            AD,
                            SOYAD,
                            TCNO ,
                            MAIL ,
                            kullaniciAdi, 
                            FOTOGRAF,
                            SIFRE)
                            values(
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?
                            )
                            ", array($uyeAd, $uyeSoyad,  $uyeTc, $uyeMail, $uyeMail,  $yukle, $uyeSifre));
                            ($kayit) ? $VT->mesajOlustur("basarili", "Kayıt Başarılı!") : $VT->mesajOlustur("hata", "Üye kaydı sırasında bir hata meydana geldi!");
                        } else {
                            $VT->mesajOlustur("uyari", "Resim yükleme işlemi başarısız(Sadece resim uzantıları kabul edilir).");
                        }
                    } else {
                        $kayit = $VT->sorguCalistir("INSERT INTO hastane.users 
                            (
                            AD,
                            SOYAD,
                            TCNO ,
                            MAIL ,
                            kullaniciAdi, 
                            SIFRE)
                            values(
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?
                            )
                            ", array($uyeAd, $uyeSoyad,  $uyeTc, $uyeMail, $uyeMail, $uyeSifre));
                        ($kayit) ? $VT->mesajOlustur("basarili", "Kayıt Başarılı!") : $VT->mesajOlustur("hata", "Üye kaydı sırasında bir hata meydana geldi!");
                    }
                } else {
                    $VT->mesajOlustur("hata", "Girilen TC numarası veya Mail sistemde farklı bir hesapta kayıtlıdır!");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }

            $VT->yonlendir(SITE . "sayfa/uyeekle");
        }
        // Üye Düzenleme alanı
        else if (isset($_POST['uyeDuzenle']) and $VT->yetkiKontrol(2)) {
            if (
                !empty($_POST['uyeAd'])
                and  !empty($_POST['uyeMail'])
                and  !empty($_POST['uyeSoyad'])
                and  !empty($_POST['uyeSoyad'])
                and  !empty($_POST['uyeTc'])
                and  !empty($_POST['id'])
            ) {
                $id = $VT->filter($_POST['id']);
                $uyeAd = $VT->filter($_POST['uyeAd']);
                $uyeSoyad = $VT->filter($_POST['uyeSoyad']);
                $uyeMail = $VT->filter($_POST['uyeMail']);
                $uyeTc = $VT->filter($_POST['uyeTc']);
                $kayitKontrol = $VT->veriGetir("Select * from hastane.users", " where TCNO = ? OR MAIL = ?", array($uyeTc, $uyeMail));
                // Aynı TCNO veya MAİL'e sahip iki üye olamaz
                if ($kayitKontrol == false or $kayitKontrol[0]['ID'] == $id) {
                    if (!empty($_FILES['uyeresim']['name'])) {
                        $yukluGorsel = $kayitKontrol[0]['FOTOGRAF'];
                        $yukle = $VT->upload("uyeresim", "../../images/uyeresim");
                        if ($yukle != false) {
                            $guncelle = $VT->sorguCalistir("UPDATE  hastane.users SET 
                            AD = ?,
                            SOYAD = ?,
                            TCNO = ?,
                            MAIL = ?,
                            kullaniciAdi = ?,
                            FOTOGRAF = ?
                            WHERE ID = ?
                            ", array($uyeAd, $uyeSoyad, $uyeTc, $uyeMail, $uyeMail, $yukle, $id));
                            ($guncelle) ?  $VT->mesajOlustur("basarili", "Üye güncelleme Başarılı!") : $VT->mesajOlustur("hata", "Üye güncelleme sırasında bir hata meydana geldi!");
                            // Eğer yüklü görsel var ise ve güncelleme başarılı ise fotoğrafı siliyoruz
                            if ($guncelle == true and !empty($yukluGorsel) and file_exists("../../images/uyeresim/{$yukluGorsel}")) {

                                unlink("../../images/uyeresim/{$yukluGorsel}");
                            }
                        } else {
                            $VT->mesajOlustur("uyari", "Resim yükleme işlemi başarısız(Sadece resim uzantıları kabul edilir).");
                        }
                    } else {
                        $guncelle = $VT->sorguCalistir("UPDATE  hastane.users SET 
                            AD = ?,
                            SOYAD = ?,
                            TCNO = ?,
                            MAIL = ?,
                            kullaniciAdi = ?
                        WHERE ID = ?
                        ", array($uyeAd, $uyeSoyad, $uyeTc, $uyeMail, $uyeMail, $id));
                        ($guncelle) ? $VT->mesajOlustur("basarili", "Üye güncelleme başarılı!") : $VT->mesajOlustur("hata", "Üye güncellemesi sırasında bir hata meydana geldi!");
                    }
                } else {
                    $VT->mesajOlustur("hata", "Girilen TC numarası veya Mail sistemde farklı bir hesapta kayıtlıdır!");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }
            $VT->yonlendir(SITE . "duzenle/uyeduzenle/" . $id);
        }

        //***************************************ÜYE İŞLEMLERİ BİTİŞ *****************************************************************************************
        //***************************************Bilgilerim ALANI *****************************************************************************************
        // Bilgi güncelleme alanı
        else if (isset($_POST['bilgilerimiGuncelle'])) {
            if (
                !empty($_POST['uyeAd'])
                and  !empty($_POST['uyeMail'])
                and  !empty($_POST['uyeSoyad'])
                and  !empty($_POST['uyeSoyad'])
                and  !empty($_POST['uyeTc'])
            ) {
                $id = $_SESSION['uye']['ID'];
                $uyeAd = $VT->filter($_POST['uyeAd']);
                $uyeSoyad = $VT->filter($_POST['uyeSoyad']);
                $uyeMail = $VT->filter($_POST['uyeMail']);
                $uyeTc = $VT->filter($_POST['uyeTc']);
                $kayitKontrol = $VT->veriGetir("Select * from hastane.users", " where TCNO = ? OR MAIL = ?", array($uyeTc, $uyeMail));
                // Aynı TCNO veya MAİL'e sahip iki üye olamaz
                if ($kayitKontrol == false or $kayitKontrol[0]['ID'] == $id) {
                    if (!empty($_FILES['uyeresim']['name'])) {
                        $yukluGorsel = $kayitKontrol[0]['FOTOGRAF'];
                        $yukle = $VT->upload("uyeresim", "../../images/uyeresim");
                        if ($yukle != false) {
                            $guncelle = $VT->sorguCalistir("UPDATE  hastane.users SET 
                            AD = ?,
                            SOYAD = ?,
                            TCNO = ?,
                            MAIL = ?,
                            FOTOGRAF = ?
                            WHERE ID = ?
                            ", array($uyeAd, $uyeSoyad, $uyeTc, $uyeMail, $yukle, $id));
                            ($guncelle) ?  $VT->mesajOlustur("basarili", "Üye güncelleme Başarılı!") : $VT->mesajOlustur("hata", "Üye güncelleme sırasında bir hata meydana geldi!");
                            // Eğer yüklü görsel var ise ve güncelleme başarılı ise fotoğrafı siliyoruz
                            if ($guncelle == true and !empty($yukluGorsel) and file_exists("../../images/uyeresim/{$yukluGorsel}")) {

                                unlink("../../images/uyeresim/{$yukluGorsel}");
                            }
                        } else {
                            $VT->mesajOlustur("uyari", "Resim yükleme işlemi başarısız(Sadece resim uzantıları kabul edilir).");
                        }
                    } else {
                        $guncelle = $VT->sorguCalistir("UPDATE  hastane.users SET 
                        AD = ?,
                        SOYAD = ?,
                        TCNO = ?,
                        MAIL = ?
                        WHERE ID = ?
                        ", array($uyeAd, $uyeSoyad, $uyeTc, $uyeMail, $id));
                        ($guncelle) ? $VT->mesajOlustur("basarili", "Üye güncelleme başarılı!") : $VT->mesajOlustur("hata", "Üye güncellemesi sırasında bir hata meydana geldi!");
                    }
                } else {
                    $VT->mesajOlustur("hata", "Girilen TC numarası veya Mail sistemde farklı bir hesapta kayıtlıdır!");
                }
            } else {
                $VT->mesajOlustur("hata", "Boş alan bırakmayınız!");
            }
            $VT->yonlendir(SITE . "sayfa/bilgilerim");
        }
        // Şifre güncelleme alanı
        else if (isset($_POST['sifreDegistir'])) {
            if (!empty($_POST['sifre'] and !empty($_POST['sifreTekrar']))) {
                if ($_POST['sifre'] == $_POST['sifreTekrar']) {
                    $id = $_SESSION['uye']['ID'];
                    // Şifreyi md5 ardından sha1 ile şifreliyoruz.
                    $sifre = sha1(md5($_POST['sifre']));
                    $guncelle = $VT->sorguCalistir("UPDATE hastane.users SET sifre = ? WHERE ID = ?", array($sifre, $id));
                    if ($guncelle)
                        $VT->mesajOlustur("basarili", "Başarılı bir şekilde şifreniz güncellendi");
                    else
                        $VT->mesajOlustur("hata", "Şifre güncelleme sırasında bir hata meydana geldi");
                } else {
                    $VT->mesajOlustur("hata", "Şifreler uyuşmuyor!");
                }
            } else {
                $VT->mesajOlustur("hata", "Şifre alanları boş olamaz!");
            }
            $VT->yonlendir(SITE . "sayfa/sifre");
        }
        //***************************************Bilgierlim  Alanı bitiş  *****************************************************************************************

        //***************************************YETKİLENDİRME İŞLEMLERİ  *****************************************************************************************
        else if (isset($_POST['yetkiDuzenle'])) {
            // Sadece Admin seviyesinde bir oturum bu işlemi yapabilir.
            if ($VT->yetkiKontrol(4)) {
                if (!empty($_POST['id']) and !empty($_POST['uyeYetki'])) {
                    $id = $_POST['id'];
                    $yetki = $_POST['uyeYetki'];

                    $yetkiKontrol = $VT->veriGetir("SELECT * from hastane.tblyetkiler", "WHERE ID = ?", array($yetki));
                    if ($yetkiKontrol != false) {
                        $guncelle = $VT->sorguCalistir("UPDATE hastane.users SET KULLANICIYETKI = ? WHERE ID = ?", array($yetki, $id));
                        if ($guncelle)
                            $VT->mesajOlustur("basarili", "Yetki güncelleme başarılı!");
                        else
                            $VT->mesajOlustur("hata", "Yetki güncelleme sırasında bilinmeyen bir hata oluştu!");
                    } else {
                        $VT->mesajOlustur("hata", "Böyle bir yetki türü yoktur!");
                    }
                }
            } else {
                $VT->mesajOlustur("hata", "Yetkilendirme işlemi yapmak için yetkiniz bulunmamaktadır.");
                $VT->yonlendir(SITE . "Anasayfa");
            }
            $VT->yonlendir(SITE . "duzenle/yetkiduzenle/" . $id);
        }
        //***************************************YETKİLENDİRME İŞLEMLERİ BİTİŞ *****************************************************************************************



    } else {
        echo 'Bu sayfaya direkt erişiminiz yasaktır.';
    }
} else {
    echo '<h1>Bu sayfadan işlem yapabilmek için oturum açmanız gerekmekte ve  sadece personel  seviyesi ve üzerindeki hesaplar işlem yapabilir<h1> ';
}
