# Core-PHP-Hastane-takip-otomasyonu

WEB based PHP Hospital automation using MSSQL database.


# Kurulum
You can import your database files into your MSSQL database. 

After this process, you should go to yonetimpaneli>class>vt.php file and change the following database information according to your own database information.
```php
  
	private $host = "host_name";
	private $user = "user";
	private $password = "password";
	private $dbname = "hastane";
  // Don't change dbname,  and  you must  create  dbname  as  real database name  'hastane' because own sql queries require 'hastane' dbname and schema.

```
And after this process , you should change website url in the 'tblayar' table . If you pass this process system can not upload image , style and script files . `http://localhost/VTYS/yonetimpaneli/`
The URL must end with 'yonetimpaneli/' , the other part is for you . For example  `https://www.mywebsite.com/yonetimpaneli/` or `http://www.mywebsite.com/hospital/yonetimpaneli/`

# Screenshots

# Genel Yönetim Ve İstatistik 
![image](https://user-images.githubusercontent.com/44698680/149620271-54676bb3-f46e-471c-912e-a1b4b0121e16.png)

# Giriş Ekranı
![image](https://user-images.githubusercontent.com/44698680/149620272-1d2e9040-c32b-4244-b9fc-97f60ff6c9d2.png)

# Bilgilerim Güncelleme/Görüntüleme
![image](https://user-images.githubusercontent.com/44698680/149620289-5ca5acbb-7a1f-4692-96a7-563683e83cd2.png)

# Poliklinik Kayıtları
![image](https://user-images.githubusercontent.com/44698680/149620401-c774de6e-4cb6-4123-90e8-bdd6ab410503.png)

# Üyeler
![image](https://user-images.githubusercontent.com/44698680/149620393-06729b20-463e-439a-9917-ba224e911581.png)


# Poliklinik Kayıt Ekleme Formu
![image](https://user-images.githubusercontent.com/44698680/149620390-025dc24c-461f-4e5c-bd3b-32c3b003f341.png)
