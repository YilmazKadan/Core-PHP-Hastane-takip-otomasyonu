<?php


class VT
{

	private $host = "DESKTOP-QFAKDN8\MSSQLSERVER01";
	private $user = "yilmaz";
	private $password = "159753";
	private $dbname = "hastane";
	private $db;
	public 	static $lastInsertId;

	public function __construct()
	{
		try {

			$this->db = new PDO('sqlsrv:Server=' . $this->host . ';Database=' . $this->dbname, $this->user, $this->password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $ex) {
			echo 'Bir hata ile karşılaşıldı , hata : ' . $ex->getMessage();
			exit();
		}
	}
	// Veritabanından veri getirme fonksiyonu
	public function veriGetir($sorgu, $where = "", $whereArray = "", $orderBy = "ORDER BY ID ASC ", $limit = "")
	{
		$sql = $sorgu;
		if (!empty($where) and !empty($whereArray)) {
			$sql .= " " . $where;

			if (!empty($orderBy)) {
				$sql .= " " . $orderBy;
			}
			if (!empty($limit)) {
				$sql .= "  LIMIT " . $limit;
			}

			$calistir = $this->db->prepare($sql);
			$calistir->execute($whereArray);
			$veri =  $calistir->fetchAll(PDO::FETCH_ASSOC);
		} else {
			if (!empty($orderBy)) {
				$sql .= " " . $orderBy;
			}
			if (!empty($limit)) {
				$sql .= "  LIMIT " . $limit;
			}
			$veri = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		}
		return (!empty($veri) and $veri != false) ? $veri : false;
	}

	// Sorgu çalıştırma fonksiyonu
	public function sorguCalistir($sorgu, $degerlerArray = "")
	{
			if (!empty($degerlerArray)) {
				$calistir = $this->db->prepare($sorgu);
				$sonuc = $calistir->execute($degerlerArray);
			} else {
				$calistir = $this->db->query($sorgu);
				$sonuc = $calistir->execute();
			}
			self::$lastInsertId = $this->db->lastInsertId();
		return $sonuc;
	}
	// Tablo veritabanında var mı kontrol etme
	public function tabloVarmi($tabloAdi)
	{
		// Bu kod bize veritabanındaki tüm tabloları bir dizi halinde listeler
		$tablolar = $this->db->query("SELECT
		TABLE_NAME
  FROM
		INFORMATION_SCHEMA.COLUMNS
	  
	  ")->fetchAll(PDO::FETCH_COLUMN);
		if (in_array($tabloAdi, $tablolar))
			return true;
		else
			return false;
	}

	// Eşleşen kayıt  bulma fonksiyonu
	public function eslesenKayit($sorgu, $degerlerArray = "")
	{
		if (!empty($degerlerArray)) {
			$calistir = $this->db->prepare($sorgu);
			$calistir->execute($degerlerArray);
			$kayitSayisi = $calistir->rowCount();
		} else {
			$calistir = $this->db->query($sorgu);
			$calistir->execute();
			$kayitSayisi = $calistir->rowCount();
		}
		return $kayitSayisi;
	}

	// Yönlendirme fonksiyonu
	public function yonlendir($link)
	{
		header("Location: " . $link);
		// Exit yönlendirme olan sayfanın devamını işleme almaması için.
		exit();
	}
	// Bilgi sessionu oluşturma fonksiyonu  Alert vb. durumlarda kullanmak için

	public function mesajOlustur($mesajTur, $mesajIcerik)
	{
		$_SESSION['durum']['tur'] = $mesajTur;
		$_SESSION['durum']['mesaj'] = $mesajIcerik;
	}
	// Yetki kontrol fonksiyonu
	public function yetkiKontrol($yetkiSeviye = 1)
	{
		if (!empty($_SESSION['uye']['KULLANICIYETKI'])) {
			if ($_SESSION['uye']['KULLANICIYETKI'] >= $yetkiSeviye) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	// Verileri filtreleme fonksiyonu

	public function filter($val, $tf = false)
	{
		if ($tf == false) {
			$val = strip_tags($val);
		}
		$val = addslashes(trim($val));
		return $val;
	}
	// Uzantı fonksiyonu
	public function uzanti($dosyaadi)
	{
		$parca = explode(".", $dosyaadi);
		$uzanti = end($parca);
		$donustur = strtolower($uzanti);
		return $donustur;
	}
	// Veronet upload sınıfı için fonksiyon
	public function upload($nesnename, $yuklenecekyer = 'images/', $tur = 'img', $w = '', $h = '', $resimyazisi = '')
	{
		if ($tur == "img") {
			if (!empty($_FILES[$nesnename]["name"])) {
				$dosyanizinadi = $_FILES[$nesnename]["name"];
				$tmp_name = $_FILES[$nesnename]["tmp_name"];
				$uzanti = $this->uzanti($dosyanizinadi);
				if ($uzanti == "png" || $uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "gif") {
					$classIMG = new \Verot\Upload\Upload($_FILES[$nesnename]);
					if ($classIMG->uploaded) {
						if (!empty($w)) {
							if (!empty($h)) {
								$classIMG->image_resize = true;
								$classIMG->image_x = $w;
								$classIMG->image_y = $h;
							} else {
								if ($classIMG->image_src_x > $w) {
									$classIMG->image_resize = true;
									$classIMG->image_ratio_y = true;
									$classIMG->image_x = $w;
								}
							}
						} else if (!empty($h)) {
							if ($classIMG->image_src_h > $h) {
								$classIMG->image_resize = true;
								$classIMG->image_ratio_x = true;
								$classIMG->image_y = $h;
							}
						}

						if (!empty($resimyazisi)) {
							$classIMG->image_text = $resimyazisi;

							$classIMG->image_text_direction = 'v';

							$classIMG->image_text_color = '#FFFFFF';

							$classIMG->image_text_position = 'BL';
						}
						$rand = uniqid(true);
						$classIMG->file_new_name_body = $rand;
						$classIMG->Process($yuklenecekyer);
						if ($classIMG->processed) {
							$resimadi = $rand . "." . $uzanti;
							return $resimadi;
						} else {
							return false;
						}
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else if ($tur == "ds") {

			if (!empty($_FILES[$nesnename]["name"])) {

				$dosyanizinadi = $_FILES[$nesnename]["name"];
				$tmp_name = $_FILES[$nesnename]["tmp_name"];
				$uzanti = $this->uzanti($dosyanizinadi);
				if ($uzanti == "doc" || $uzanti == "docx" || $uzanti == "pdf" || $uzanti == "xlsx" || $uzanti == "xls" || $uzanti == "ppt" || $uzanti == "xml" || $uzanti == "mp4" || $uzanti == "avi" || $uzanti == "mov") {

					$classIMG = new \Verot\Upload\Upload($_FILES[$nesnename]);
					if ($classIMG->uploaded) {
						$rand = uniqid(true);
						$classIMG->file_new_name_body = $rand;
						$classIMG->Process($yuklenecekyer);
						if ($classIMG->processed) {
							$dokuman = $rand . "." . $uzanti;
							return $dokuman;
						} else {
							return false;
						}
					}
				}
			}
		} else {
			return false;
		}
	}
	public function seoUrl($str, $options = array())
	{
		$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
		$defaults = array(
			'delimiter' => '-',
			'limit' => null,
			'lowercase' => true,
			'replacements' => array(),
			'transliterate' => true
		);
		$options = array_merge($defaults, $options);
		$char_map = array(
			// Latin
			'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
			'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
			'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
			'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
			'ß' => 'ss',
			'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
			'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
			'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
			'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
			'ÿ' => 'y',
			// Latin symbols
			'©' => '(c)',
			// Greek
			'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
			'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
			'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
			'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
			'Ϋ' => 'Y',
			'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
			'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
			'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
			'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
			'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
			// Turkish
			'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
			'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
			// Russian
			'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
			'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
			'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
			'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
			'Я' => 'Ya',
			'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
			'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
			'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
			'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
			'я' => 'ya',
			// Ukrainian
			'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
			'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
			// Czech
			'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
			'Ž' => 'Z',
			'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
			'ž' => 'z',
			// Polish
			'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
			'Ż' => 'Z',
			'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
			'ż' => 'z',
			// Latvian
			'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
			'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
			'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
			'š' => 's', 'ū' => 'u', 'ž' => 'z'
		);
		$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
		if ($options['transliterate']) {
			$str = str_replace(array_keys($char_map), $char_map, $str);
		}
		$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
		$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
		$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
		$str = trim($str, $options['delimiter']);
		return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
	}
}
