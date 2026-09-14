# Panduan CA MySQL — WSL / Laravel

Fail CA hanya perlu disimpan sebagai fail yang boleh dibaca oleh PHP dalam WSL.
Tidak perlu import ke browser atau menjalankan `update-ca-certificates` kerana
Laravel/PDO akan membaca CA daripada path yang ditetapkan.

## 1. Semak PHP dalam WSL

Jalankan di terminal WSL, bukan PowerShell:

```bash
php -v
php -m | rg 'PDO|pdo_mysql|openssl'
```

Jika `rg` tiada, gunakan `php -m` dan semak senarai secara manual. WSL Fairus sudah
mempunyai PHP 8.3 dan `pdo_mysql`. Untuk WSL lain yang tiada driver, pasang pakej
MySQL untuk versi PHP CLI yang digunakan melalui pengurus pakej distro, kemudian
semak semula `php -m`; jangan anggap extension XAMPP tersedia dalam WSL.

## 2. Simpan fail CA

Dari direktori projek yang mengandungi `docs/training-ca.pem`:

```bash
mkdir -p "$HOME/.local/share/mysql-training"
chmod 700 "$HOME/.local/share/mysql-training"
cp docs/training-ca.pem "$HOME/.local/share/mysql-training/training-ca.pem"
chmod 600 "$HOME/.local/share/mysql-training/training-ca.pem"
realpath "$HOME/.local/share/mysql-training/training-ca.pem"
```

Gunakan path penuh yang dipaparkan untuk `.env`. Jangan letak `~` atau `$HOME` dalam
nilai path `.env`. Pada WSL Fairus, fail sudah tersedia di:

```text
/home/sysadmin/.local/share/mysql-training/training-ca.pem
```

Jika CA asal berada di `C:\training\training-ca.pem`, WSL boleh membacanya melalui
`/mnt/c/training/training-ca.pem`, atau salin ke lokasi WSL di atas.

## 3. Pilih port berdasarkan kaedah sambungan

| Kaedah | Host Laravel | Port | Status |
|---|---|---|---|
| Sambungan terus | mysql-training.fairus.vip | 3306 | Belum berjaya disahkan dari Wi-Fi latihan |
| Tunnel WSL Fairus | mysql-training.fairus.vip | 13306 | Berjaya; TLS dan migration Laravel sudah diuji |

**Untuk WSL Fairus yang telah disediakan**, hidupkan tunnel:

```bash
cd ~/training-mysql
./start.sh
```

Masukkan password sudo WSL apabila diminta. Skrip menggunakan akses SSH sedia ada,
menambah entri bertanda dalam `/etc/hosts` supaya hostname MySQL menunjuk ke
`127.0.0.1`, dan membuka tunnel pada port `13306`. Hostname sebenar dikekalkan untuk
pengesahan sijil TLS. Ia tidak menukar `.env` setiap projek secara automatik.

Jangan gunakan port `3306` ketika entri hosts tunnel aktif: sambungan itu boleh
tersasar ke MySQL lokal, seperti ralat `student01@localhost` yang berlaku sebelum ini.

Skrip ini khusus WSL Fairus; ia tidak tersedia secara automatik pada WSL peserta lain.
Peserta lain perlukan akses tunnel tersendiri yang disediakan trainer jika sambungan
terus tidak berfungsi. Jangan salin private key atau password trainer.

## 4. Konfigurasi .env Laravel

Konfigurasi WSL Fairus dengan tunnel aktif:

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql-training.fairus.vip
DB_PORT=13306
DB_DATABASE=training01
DB_USERNAME=student01
DB_PASSWORD="GANTI_DENGAN_PASSWORD_SENDIRI"
MYSQL_ATTR_SSL_CA=/home/sysadmin/.local/share/mysql-training/training-ca.pem
```

Password sebenar sudah dikonfigurasi dalam projek Fairus; **jangan gantikannya dengan
teks placeholder contoh ini**. Pada WSL peserta lain, sesuaikan username Linux,
akaun database dan port mengikut kaedah akses yang benar-benar telah disediakan.

## 5. Semak projek

```bash
cd ~/repos/work/training/latihan_laravel
php artisan config:clear
php artisan migrate:status
```

Semua lima migration projek Fairus sudah berjaya dijalankan. Untuk migration baharu,
jalankan `php artisan migrate` apabila bersedia.

## 6. Selepas restart atau tamat latihan

Selepas restart WSL, jalankan `~/training-mysql/start.sh` semula sebelum menggunakan
Laravel. Jika container MySQL server dicipta semula dan tunnel lama gagal, hentikan
dan hidupkan semula tunnel untuk mendapatkan alamat container terkini.

Untuk menghentikan tunnel Fairus:

```bash
~/training-mysql/stop.sh
```

Skrip membuang entri hosts khusus tunnel dan menghentikan SSH. Laravel tidak boleh
lagi menggunakan `13306` sehingga tunnel dihidupkan semula. `stop.sh` tidak mengubah
`.env` Laravel. Jangan terus menukar Laravel ke `3306` tanpa mengesahkan akses terus.

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
