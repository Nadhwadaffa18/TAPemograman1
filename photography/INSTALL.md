# PANDUAN INSTALASI LENGKAP
# StudioFoto Pro - Photography Website

## ⚡ QUICK INSTALLATION (5 Menit)

### Step 1: Setup Folder
```
1. Download/Extract project ke: D:\xampp\htdocs\photography
   atau: C:\xampp\htdocs\photography (sesuaikan path XAMPP Anda)
```

### Step 2: Import Database
```
1. Buka XAMPP Control Panel
2. Klik START untuk Apache & MySQL
3. Buka phpMyAdmin: http://localhost/phpmyadmin
4. Klik "New" atau "+ Database"
5. Nama database: fotografi_db
6. Klik CREATE
7. Pilih database fotografi_db
8. Klik tab "Import"
9. Klik "Choose File" → select database/setup.sql
10. Klik GO
```

**Via Command Line (Alternative):**
```bash
cd D:\xampp\mysql\bin
mysql -u root -p

# Kemudian ketik:
CREATE DATABASE fotografi_db;
USE fotografi_db;
SOURCE D:/xampp/htdocs/photography/database/setup.sql;
EXIT;
```

### Step 3: Verify Database Connection
Edit file: includes/config.php
```php
$host = 'localhost';      // Biasanya localhost
$username = 'root';       // Default XAMPP
$password = '';           // Kosongkan jika tidak ada password
$database = 'fotografi_db'; // Database yang sudah dibuat
```

### Step 4: Access Website
```
Frontend:  http://localhost/photography/
Admin:     http://localhost/photography/admin/login.php
Structure: http://localhost/photography/index.html
```

### Step 5: Login Admin
```
Username: admin
Password: admin123
```

---

## 🔧 TROUBLESHOOTING

### Error: "Cannot connect to database"
**Solusi:**
1. Pastikan MySQL service running (lihat XAMPP Control Panel)
2. Check database name & credentials di config.php
3. Pastikan database fotografi_db sudah di-import
4. Coba buat test connection:
```php
// Tambah di config.php untuk testing
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connection successful!";
```

### Error: "No such file or directory" pada setup.sql
**Solusi:**
1. Pastikan file database/setup.sql ada
2. Gunakan path absolut atau relative dengan benar
3. Copy-paste content dari setup.sql jika import gagal

### White screen atau "500 Internal Server Error"
**Solusi:**
1. Enable error reporting di config.php:
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```
2. Check error log: D:\xampp\apache\logs\error.log
3. Verify PHP syntax: php -l includes/config.php

### Form tidak bisa submit
**Solusi:**
1. Check method="POST" di form tag
2. Verify database connection working
3. Check error di browser console (F12)
4. Verify input names match di PHP file

### Admin login tidak berfungsi
**Solusi:**
1. Pastikan session_start() di awal file
2. Check admin table punya data:
```sql
SELECT * FROM admin;
```
3. Verify password hash jika diubah manual

### CSS/JS tidak loading (styling berantakan)
**Solusi:**
1. Check file path di HTML (gunakan relative path)
2. Clear browser cache (Ctrl+Shift+Delete)
3. Verify folder structure benar
4. Check console untuk 404 errors

---

## 🔒 SECURITY CHECKLIST

### 1. Change Admin Password
```
1. Login ke admin panel
2. Di database, update admin table
3. Gunakan password hash:

Buka phpMyAdmin:
admin table → Edit row
password field → Click "Function" dropdown → pilih MD5 atau password()
Atau gunakan PHP:
echo password_hash("password_baru", PASSWORD_DEFAULT);
```

### 2. Secure Database Credentials
- ✅ Jangan commit config.php ke git
- ✅ Set strong MySQL password untuk production
- ✅ Use .htaccess untuk protect sensitive files
- ✅ Remove default users dari MySQL

### 3. Input Validation
- ✅ Semua input sudah di-escape dengan escape() function
- ✅ Use prepared statements untuk extra security
- ✅ Validate file uploads jika ditambahkan

### 4. File Permissions
```bash
# Unix/Linux (jika di production server)
chmod 755 folder/      # Directory
chmod 644 file.php     # File
chmod 777 assets/      # Writable folder
```

### 5. Regular Backups
- ✅ Backup database regularly
- ✅ Export portfolio photos
- ✅ Keep git repository in sync

---

## 📁 FILE DESCRIPTIONS

### /includes
- **config.php** - Database connection & helper functions
- **header.php** - Navigation bar template
- **footer.php** - Footer template
- **get-portfolio.php** - API untuk portfolio detail

### /admin
- **login.php** - Admin login page
- **dashboard.php** - Admin statistics & overview
- **portfolio-crud.php** - Manage portfolio photos
- **packages-crud.php** - Manage service packages
- **bookings.php** - Manage client bookings
- **messages.php** - Manage contact messages
- **logout.php** - Logout handler

### /css
- **style.css** - Frontend styling (responsive)
- **admin.css** - Admin panel styling

### /js
- **script.js** - Frontend & admin JavaScript

### /database
- **setup.sql** - Database schema & sample data

### /assets
- **images/** - Folder untuk portofolio photos

---

## 🎨 CUSTOMIZATION

### Change Colors
Edit `/css/style.css`:
```css
:root {
  --primary-color: #1a1a1a;     /* Dark Black */
  --accent-color: #d4af37;      /* Gold */
  --light-color: #f5f5f5;       /* Light Gray */
}
```

### Change Brand Name
1. Edit header.php: Ganti "StudioFoto Pro"
2. Edit footer.php: Ganti company name
3. Edit admin panel: Ganti judul & logo

### Add New Pages
1. Create file: pages/new-page.php
2. Include header.php & footer.php
3. Add link di header navigation
4. Style dengan CSS yang ada

### Add Portfolio Categories
```sql
INSERT INTO kategori (nama_kategori, deskripsi) 
VALUES ('Wedding', 'Dokumentasi pernikahan profesional');

-- Kemudian di admin, add portfolio foto dengan kategori baru
```

---

## 📊 DATABASE INFO

### Tables & Fields

**admin**
- id (INT, PK)
- username (VARCHAR, UNIQUE)
- password (VARCHAR, hashed)
- email (VARCHAR)
- nama (VARCHAR)
- created_at (TIMESTAMP)

**kategori**
- id (INT, PK)
- nama_kategori (VARCHAR)
- deskripsi (TEXT)
- created_at (TIMESTAMP)

**portofolio**
- id (INT, PK)
- kategori_id (INT, FK)
- judul (VARCHAR)
- deskripsi (TEXT)
- foto (VARCHAR)
- created_at (TIMESTAMP)

**paket**
- id (INT, PK)
- nama_paket (VARCHAR)
- deskripsi (TEXT)
- harga (INT)
- durasi (INT)
- fitur (TEXT)
- created_at (TIMESTAMP)

**pemesanan**
- id (INT, PK)
- nama_klien (VARCHAR)
- email (VARCHAR)
- nomor_hp (VARCHAR)
- tanggal_event (DATE)
- paket_id (INT, FK)
- lokasi (VARCHAR)
- catatan (TEXT)
- status (ENUM)
- created_at (TIMESTAMP)

**kontak**
- id (INT, PK)
- nama (VARCHAR)
- email (VARCHAR)
- subjek (VARCHAR)
- pesan (TEXT)
- status (VARCHAR)
- created_at (TIMESTAMP)

---

## 🔗 API ENDPOINTS

### GET Portfolio Detail (JSON)
```
URL: /includes/get-portfolio.php?id=1
Response: { "id", "judul", "deskripsi", "foto", "nama_kategori" }
```

---

## 📝 ADMIN FEATURES

### Dashboard
- View statistics (bookings, packages, messages)
- See recent bookings & messages
- Quick access to all management pages

### Portfolio Management
- List all portfolio items
- Add new portfolio with category
- Edit portfolio details
- Delete portfolio
- View by category

### Package Management  
- List all packages
- Create new package with pricing
- Edit package details
- Delete package
- Set features & duration

### Booking Management
- List all bookings
- Filter by status & date range
- Change booking status
- View booking details in modal
- Delete booking

### Message Management
- List all contact messages
- Filter by read status
- Mark messages as read/unread
- View full message content
- Delete message

---

## 🚀 DEPLOYMENT (Production)

### Local to Server (Simple Steps)
1. Upload via FTP:
   - Exclude: .git, node_modules, .env
   - Upload: app, config, includes, css, js, database folder

2. Set Permissions (via SSH):
```bash
chmod 755 /var/www/html/photography
chmod 644 /var/www/html/photography/*.php
chmod 777 /var/www/html/photography/assets
```

3. Update config.php:
   - Change DB host/username/password
   - Update file paths if needed

4. Migrate Database:
   - Create database di server
   - Import setup.sql
   - Verify connection

5. SSL Certificate:
   - Use HTTPS
   - Update links di code jika perlu

---

## 💡 TIPS & TRICKS

### Faster Development
- Use VSCode Live Server extension
- Enable PHP built-in server: php -S localhost:8000
- Use browser DevTools (F12) untuk debug

### Performance
- Cache static files
- Compress images di assets/images/
- Minify CSS & JS untuk production
- Use CDN untuk Font Awesome

### Maintenance
- Regular backups of database
- Monitor error logs
- Update admin password periodically
- Check form submissions regularly

### SEO Optimization
- Add meta descriptions
- Use semantic HTML
- Optimize image alt text
- Create sitemap
- Add robots.txt

---

## ❓ FAQ

**Q: Bisa tidak upload foto langsung dari form?**
A: Bisa, tambahkan:
```php
if ($_FILES['foto']['error'] === 0) {
    move_uploaded_file($_FILES['foto']['tmp_name'], 
                       'assets/images/' . $_FILES['foto']['name']);
}
```

**Q: Bagaimana cara backup database?**
A: Di phpMyAdmin → Database → Export → Download

**Q: Bisa tidak menambah user admin baru?**
A: Bisa, di database insert ke admin table dengan password hashed

**Q: Bagaimana email notification?**
A: Tambahkan mail() function setelah booking berhasil

**Q: Bisa tidak customize warna?**
A: Ya, edit :root variables di style.css

---

## 📞 SUPPORT

Jika ada pertanyaan atau issue:
1. Check README.md untuk dokumentasi lengkap
2. Check file comments untuk penjelasan code
3. Test database connection terlebih dahulu
4. Verify file struktur sudah benar
5. Check browser console untuk JavaScript errors

---

**Selamat menggunakan StudioFoto Pro! 📷✨**
