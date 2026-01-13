# 📷 StudioFoto Pro - Website Jasa Fotografi Profesional

Website jasa fotografi yang modern, responsif, dan profesional dengan admin panel lengkap untuk mengelola portofolio, paket, pemesanan, dan pesan kontak.

## ✨ Fitur Utama

### Frontend Publik
- **Beranda** - Hero section dengan call-to-action menarik
- **Tentang Kami** - Informasi studio, tim profesional, dan pengalaman
- **Portofolio** - Galeri foto dinamis dengan filter kategori
- **Paket Fotografi** - Daftar paket layanan dengan harga dan fitur
- **Pemesanan** - Form untuk melakukan reservasi event
- **Kontak** - Form kontak dan informasi lengkap studio

### Admin Panel
- **Login** - Autentikasi admin dengan username dan password
- **Dashboard** - Statistik dan ringkasan terbaru
- **Portofolio CRUD** - Tambah/edit/hapus foto portofolio
- **Paket CRUD** - Kelola paket fotografi dan harga
- **Pemesanan** - Lihat dan kelola status pemesanan
- **Pesan Kontak** - Lihat pesan dari pengunjung website

### Desain & UX
- ✅ Responsive design (desktop, tablet, mobile)
- ✅ Warna elegan (hitam, putih, emas)
- ✅ Smooth animations dan hover effects
- ✅ User-friendly interface
- ✅ Fast loading dan optimized

## 🛠️ Teknologi yang Digunakan

- **Frontend**: HTML5, CSS3, JavaScript ES6
- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Server**: Apache (XAMPP/LAMPP)
- **Icons**: Font Awesome 6.0.0

## 📦 Struktur Folder

```
photography/
├── index.php                 # Halaman beranda
├── about.php                 # Halaman tentang
├── portfolio.php             # Halaman galeri portofolio
├── packages.php              # Halaman paket fotografi
├── booking.php               # Halaman pemesanan
├── contact.php               # Halaman kontak
│
├── admin/
│   ├── login.php             # Login admin
│   ├── dashboard.php         # Dashboard admin
│   ├── portfolio-crud.php    # Kelola portofolio
│   ├── packages-crud.php     # Kelola paket
│   ├── bookings.php          # Kelola pemesanan
│   ├── messages.php          # Kelola pesan kontak
│   └── logout.php            # Logout
│
├── includes/
│   ├── config.php            # Konfigurasi database & functions
│   ├── header.php            # Header & navbar
│   ├── footer.php            # Footer
│   └── get-portfolio.php     # API untuk detail portofolio
│
├── css/
│   ├── style.css             # Styling frontend
│   └── admin.css             # Styling admin panel
│
├── js/
│   └── script.js             # JavaScript frontend & admin
│
├── assets/
│   └── images/               # Folder untuk menyimpan foto
│
├── database/
│   └── setup.sql             # Schema database & data sample
│
└── README.md                 # Dokumentasi ini
```

## 🚀 Cara Instalasi

### Prerequisites
- XAMPP / LAMPP / WAMP sudah terinstall
- MySQL running
- PHP 7.4 atau lebih tinggi

### Langkah-langkah Instalasi

#### 1. **Clone atau Download Project**
```bash
# Download dan extract ke folder htdocs (XAMPP)
# Contoh: D:\xampp\htdocs\photography
# Atau: /var/www/html/photography
```

#### 2. **Setup Database**
```bash
# Buka phpMyAdmin
# URL: http://localhost/phpmyadmin

# Buat database baru:
# Nama: fotografi_db

# Import file SQL:
# 1. Pilih database "fotografi_db"
# 2. Tab "Import"
# 3. Pilih file: database/setup.sql
# 4. Klik "Go"
```

**Atau via MySQL Command Line:**
```bash
mysql -u root -p
CREATE DATABASE fotografi_db;
USE fotografi_db;
SOURCE D:/xampp/htdocs/photography/database/setup.sql;
```

#### 3. **Konfigurasi Database Connection**
Edit file `includes/config.php`:
```php
$host = 'localhost';
$username = 'root';
$password = '';           // Kosongkan jika tidak ada password
$database = 'fotografi_db';
```

#### 4. **Akses Website**
```
Frontend: http://localhost/photography/
Admin:    http://localhost/photography/admin/login.php
```

## 🔐 Default Admin Credentials

```
Username: admin
Password: admin123
```

**⚠️ PENTING:** Ubah password default setelah instalasi untuk keamanan!

## 📄 Database Schema

### Tabel: admin
```sql
id (Primary Key)
username (Unique)
password (Hashed)
email
nama
created_at
```

### Tabel: kategori
```sql
id (Primary Key)
nama_kategori
deskripsi
created_at
```

### Tabel: portofolio
```sql
id (Primary Key)
kategori_id (Foreign Key → kategori)
judul
deskripsi
foto (nama file)
created_at
```

### Tabel: paket
```sql
id (Primary Key)
nama_paket
deskripsi
harga
durasi (dalam jam)
fitur
created_at
```

### Tabel: pemesanan
```sql
id (Primary Key)
nama_klien
email
nomor_hp
tanggal_event
paket_id (Foreign Key → paket)
lokasi
catatan
status (Pending/Dikonfirmasi/Selesai/Dibatalkan)
created_at
```

### Tabel: kontak
```sql
id (Primary Key)
nama
email
subjek
pesan
status (Belum Dibaca/Dibaca)
created_at
```

## 🎨 Palet Warna

```css
Primary Color:   #1a1a1a (Dark Black)
Accent Color:    #d4af37 (Gold)
Light Color:     #f5f5f5 (Light Gray)
Dark Gray:       #333333
Light Gray:      #999999
Error Color:     #ff6b6b
Success Color:   #4caf50
Warning Color:   #ffc107
```

## 📱 Responsive Breakpoints

```css
Desktop:  >= 1024px (Full width)
Tablet:   768px - 1023px
Mobile:   < 768px
```

## 🔧 Fitur Admin Panel

### Dashboard
- Statistik total pemesanan, paket, kontak
- Daftar pemesanan terbaru
- Daftar pesan kontak terbaru
- Quick access links

### Portfolio Management
- **List View**: Tampilkan semua foto portofolio
- **Add New**: Tambah portofolio baru dengan kategori
- **Edit**: Ubah detail portofolio
- **Delete**: Hapus portofolio

### Package Management
- **List View**: Daftar semua paket
- **Add New**: Buat paket baru dengan harga dan durasi
- **Edit**: Ubah detail paket
- **Delete**: Hapus paket

### Booking Management
- **View All**: Daftar pemesanan dengan filter status & bulan
- **Statistics**: Total booking, pending, completed
- **Change Status**: Update status pemesanan
- **View Details**: Modal dengan informasi lengkap
- **Delete**: Hapus pemesanan

### Message Management
- **View Messages**: Daftar pesan dari pengunjung
- **Filter**: Berdasarkan status (Dibaca/Belum Dibaca)
- **Mark as Read**: Tandai pesan sebagai sudah dibaca
- **View Details**: Modal dengan konten pesan lengkap
- **Delete**: Hapus pesan

## 🎯 Fungsi Helper (config.php)

### `escape($str)`
Mengamankan input dari SQL injection
```php
$nama = escape($_POST['nama']);
```

### `query($sql)`
Menjalankan SELECT query dan return array
```php
$portofolios = query("SELECT * FROM portofolio");
```

### `querySingle($sql)`
Menjalankan SELECT query single row dan return associative array
```php
$user = querySingle("SELECT * FROM admin WHERE id = 1");
```

### `execute($sql)`
Menjalankan INSERT, UPDATE, DELETE query
```php
$success = execute("INSERT INTO kontak (...) VALUES (...)");
```

### `formatRupiah($number)`
Format angka menjadi format Rupiah
```php
echo formatRupiah(5000000); // Output: Rp 5.000.000
```

### `formatTanggal($date)`
Format tanggal menjadi format Indonesia
```php
echo formatTanggal('2024-01-15'); // Output: 15 Januari 2024
```

## 🖼️ Menambah Foto Portofolio

1. Upload foto ke folder `assets/images/`
2. Pergi ke Admin → Portofolio
3. Klik "Tambah Portofolio"
4. Isi form dengan detail foto
5. Masukkan nama file (contoh: `wedding_1.jpg`)
6. Klik Simpan

**Note**: File foto harus sudah ada di folder `assets/images/` sebelum menambahkan ke database.

## 📧 Integrasi Email (Optional)

Untuk mengirim email konfirmasi pemesanan, tambahkan ke `booking.php`:
```php
// Setelah pemesanan berhasil
mail($email, "Konfirmasi Pemesanan", "Terima kasih atas pemesanan Anda...");
```

Require SMTP configuration di `config.php`.

## 🔒 Security Tips

1. **Ubah Password Admin**
   - Buka phpMyAdmin → admin table
   - Update password dengan hash PHP:
   ```php
   password_hash("password_baru", PASSWORD_DEFAULT)
   ```

2. **Proteksi File Sensitif**
   - Jangan expose `config.php` secara publik
   - Gunakan `.htaccess` untuk protect admin folder

3. **Validasi Input**
   - Semua input sudah di-escape dengan `escape()` function
   - Gunakan prepared statements jika mungkin

4. **Update Database Credentials**
   - Jangan gunakan default MySQL password
   - Set strong password untuk admin user

## 🐛 Troubleshooting

### "Cannot connect to MySQL"
- Pastikan MySQL service sudah berjalan
- Check database credentials di `config.php`
- Verify database "fotografi_db" sudah di-import

### "White screen of death"
- Check error logs di `storage/logs/`
- Enable PHP error reporting di `config.php`:
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

### "404 Not Found on pages"
- Pastikan `.htaccess` setting sudah benar
- Check `mod_rewrite` sudah enable di Apache
- Verify file permissions (755 untuk folder, 644 untuk file)

### "Form submission tidak bekerja"
- Pastikan method POST dan input `name` attribute benar
- Check if JavaScript tidak blocking form submission
- Verify database connection berfungsi

## 📞 Support & Contact

Untuk pertanyaan atau issue:
- Email: info@studiofoto.com
- WhatsApp: +62 xxx-xxxx-xxxx
- Website: www.studiofoto.com

## 📝 License

Dokumentasi ini adalah proprietary dan hanya untuk keperluan internal.

---

**Dibuat dengan ❤️ untuk StudioFoto Pro**
