# Panduan CA MySQL — XAMPP Windows / Laravel

Panduan ini menyediakan fail CA untuk sambungan PHP ke MySQL training. Fail CA
**tidak perlu diimport ke Windows Certificate Store, browser atau phpMyAdmin**.
Laravel/PDO akan membacanya daripada path yang ditetapkan.

## 1. Simpan fail CA

Ambil `training-ca.pem` dalam folder `docs` projek ini daripada trainer. Cipta folder
`C:\training` dan salin fail itu ke `C:\training\training-ca.pem`. Pastikan namanya
bukan `training-ca.pem.txt`. Fail ini ialah CA awam, bukan password atau private key.

Dari PowerShell, ketika berada di direktori projek Windows:

```powershell
New-Item -ItemType Directory -Force C:\training | Out-Null
Copy-Item .\docs\training-ca.pem C:\training\training-ca.pem
Test-Path C:\training\training-ca.pem
```

Output terakhir perlu `True`. Jika projek hanya berada di WSL, ambil fail melalui
File Explorer pada folder projek WSL dan salin ke lokasi Windows di atas.

## 2. Semak PHP XAMPP

```powershell
C:\xampp\php\php.exe -v
C:\xampp\php\php.exe -m | Select-String 'PDO|pdo_mysql|openssl'
```

Jika XAMPP dipasang di lokasi lain, ubah path. Jika `pdo_mysql` tiada, semak fail
konfigurasi aktif dengan `C:\xampp\php\php.exe --ini` dan aktifkan extension tersebut
dalam fail itu. Restart Apache selepas perubahan PHP untuk aplikasi melalui browser;
Artisan menggunakan proses PHP CLI yang baharu.

Tidak perlu mengubah sijil HTTPS Apache XAMPP untuk menyambung ke database ini.

## 3. Konfigurasi .env Laravel

Contoh di bawah untuk Fairus; peserta lain perlu menukar akaun dan database.

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql-training.fairus.vip
DB_PORT=3306
DB_DATABASE=training01
DB_USERNAME=student01
DB_PASSWORD="GANTI_DENGAN_PASSWORD_SENDIRI"
MYSQL_ATTR_SSL_CA="C:/training/training-ca.pem"
```

Gunakan slash `/` dalam path `.env` seperti contoh. Port `3306` ialah sambungan terus
ke server. **Sambungan terus dari Wi-Fi latihan belum disahkan berjaya** pada semakan
14 September 2026; pemasangan CA tidak menjamin laluan rangkaian tersebut berfungsi.

Jangan tukar ke `13306` secara automatik: port itu hanya digunakan oleh tunnel WSL
Fairus. Panduan ini tidak menyediakan tunnel Windows atau akaun SSH peserta.
Jika sambungan terus gagal, gunakan phpMyAdmin dahulu dan hubungi trainer untuk
kaedah akses yang diluluskan. Jangan kongsi SSH key trainer.

## 4. Jalankan Artisan menggunakan PHP yang betul

Buka PowerShell di direktori projek Windows yang mengandungi fail `artisan`:

```powershell
C:\xampp\php\php.exe artisan config:clear
C:\xampp\php\php.exe artisan migrate:status
```

Jika mahu menjalankan migration latihan:

```powershell
C:\xampp\php\php.exe artisan migrate
```

Dalam arahan `php artisan ...` di bahagian seterusnya, gunakan
`C:\xampp\php\php.exe artisan ...` jika PHP XAMPP belum berada dalam PATH.

## Akaun peserta

Gunakan akaun sendiri, bukan akaun root. Dapatkan password daripada trainer; jangan
kongsi atau commit `.env` yang mengandungi password.

| Peserta | Username | Database |
|---|---|---|
| Fairus | student01 | training01 |
| Zihan | student02 | training02 |
| Haziq | student03 | training03 |
| Firas | student04 | training04 |
| Irfan | student05 | training05 |
| Faizah | student06 | training06 |

## Tetapan Laravel untuk mengesahkan sijil

Dalam `config/database.php`, bahagian `connections.mysql.options` projek ini sudah
mempunyai tetapan CA dan pengesahan sijil. Kekalkan tetapan tersebut. Untuk projek
PHP 8.3 lain yang belum mempunyainya, bentuk konfigurasi ialah:

```php
'options' => extension_loaded('pdo_mysql') ? array_filter([
    PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
]) : [],
```

Jika projek menggunakan pilihan `PHP_VERSION_ID >= 80500 ? Mysql::ATTR_SSL_CA :
PDO::MYSQL_ATTR_SSL_CA`, kekalkan pilihan sedia ada itu; jangan gantikan seluruh
konfigurasi database. Jangan matikan pengesahan sijil untuk mengatasi ralat.

Pastikan `DB_URL` tidak menetapkan sambungan lain dan `DB_SOCKET` kosong atau tidak
ditetapkan. Selepas mengubah `.env`, jalankan `php artisan config:clear`.

## Semak TLS dari Laravel

Dari direktori projek:

```bash
php artisan tinker
```

Dalam Tinker:

```php
DB::selectOne('SELECT CURRENT_USER() AS account, DATABASE() AS db');
DB::select("SHOW SESSION STATUS LIKE 'Ssl_cipher'");
```

Pastikan akaun/database betul dan `Value` bagi `Ssl_cipher` tidak kosong. Taip `exit`
untuk keluar. Untuk menyemak status migration gunakan `php artisan migrate:status`.
Jika database masih baharu, mesej migration table belum wujud boleh berlaku; jalankan
`php artisan migrate` apabila bersedia mencipta jadual latihan. Jangan gunakan
`migrate:fresh` kerana ia memadam jadual.

## Jika sambungan gagal

- `could not find driver`: PHP yang menjalankan Artisan perlu extension `pdo_mysql`.
- Fail CA tidak ditemui: semak path penuh, kewujudan fail dan kebenaran baca.
- Certificate verification failed: semak hostname, fail CA dan tarikh/jam komputer;
  gunakan `mysql-training.fairus.vip`, bukan IP server atau `localhost`.
- Access denied: semak akaun, password, database dan port; kosongkan cache konfigurasi.
- Timeout atau `MySQL server has gone away`: pemasangan CA sahaja tidak menyelesaikan
  masalah laluan rangkaian. Semak tunnel jika digunakan dan hubungi trainer.
- Jika bertukar Wi-Fi/VPN/hotspot, IP awam mungkin berubah. Minta trainer menyemak
  allowlist; jangan membuka akses kepada semua IP.

phpMyAdmin tersedia di https://db-training.fairus.vip/ dan tidak memerlukan pemasangan
CA secara manual dalam browser. Login menggunakan akaun peserta sendiri.
