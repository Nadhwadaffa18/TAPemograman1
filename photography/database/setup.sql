-- Database untuk Website Fotografi Profesional
-- Create database
CREATE DATABASE IF NOT EXISTS photography_studio;
USE photography_studio;

-- Tabel Admin
CREATE TABLE IF NOT EXISTS admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Kategori Portofolio
CREATE TABLE IF NOT EXISTS kategori (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Portofolio (Foto)
CREATE TABLE IF NOT EXISTS portofolio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kategori_id INT NOT NULL,
    judul VARCHAR(150) NOT NULL,
    deskripsi TEXT,
    foto VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE CASCADE
);

-- Tabel Paket Fotografi
CREATE TABLE IF NOT EXISTS paket (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_paket VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    harga INT NOT NULL,
    durasi VARCHAR(50),
    fitur TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Pemesanan
CREATE TABLE IF NOT EXISTS pemesanan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_klien VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    nomor_hp VARCHAR(15) NOT NULL,
    tanggal_event DATE NOT NULL,
    paket_id INT NOT NULL,
    lokasi VARCHAR(150),
    catatan TEXT,
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (paket_id) REFERENCES paket(id) ON DELETE CASCADE
);

-- Tabel Kontak (Pesan dari Website)
CREATE TABLE IF NOT EXISTS kontak (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subjek VARCHAR(150) NOT NULL,
    pesan TEXT NOT NULL,
    status VARCHAR(50) DEFAULT 'belum dibaca',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Data Admin
INSERT INTO admin (username, password, email, nama) VALUES 
('admin', '$2y$10$UyiP7UQ8P8J8P8J8P8J8P.uG8Z8Z8Z8Z8Z8Z8Z8Z8Z8Z8Z8Z8Z8Z8', 'admin@fotografi.com', 'Administrator');
-- password default: admin123

-- Insert Kategori
INSERT INTO kategori (nama_kategori, deskripsi) VALUES 
('Wedding', 'Fotografi pernikahan dengan konsep modern dan elegan'),
('Event', 'Fotografi acara korporat, launching, dan gathering'),
('Portrait', 'Fotografi potret profesional untuk keperluan pribadi'),
('Produk', 'Fotografi produk untuk keperluan e-commerce dan katalog'),
('Prewedding', 'Sesi pemotretan sebelum hari pernikahan');

-- Insert Paket
INSERT INTO paket (nama_paket, deskripsi, harga, durasi, fitur) VALUES 
('Paket Basic', 'Dokumentasi foto dengan 1 lokasi dan 100 foto edit', 2000000, '4 jam', '- Fotographer 1 orang\n- 100 foto edit\n- 1 lokasi\n- Soft copy semua foto'),
('Paket Standar', 'Dokumentasi foto dengan 2 lokasi dan 200 foto edit', 3500000, '6 jam', '- Fotographer 1 orang\n- 200 foto edit\n- 2 lokasi\n- Soft copy semua foto\n- Album digital'),
('Paket Premium', 'Dokumentasi lengkap dengan 3 lokasi dan 300 foto edit', 5000000, '8 jam', '- Fotographer + Videografer\n- 300 foto edit\n- 3 lokasi\n- Soft copy + USB\n- Album digital + Hardcopy album\n- Video highlight 3 menit'),
('Paket Exclusive', 'Paket all-in-one dengan coverage maksimal sepanjang hari', 7500000, '12 jam', '- 2 Fotographer + 1 Videografer\n- 400+ foto edit\n- Unlimited lokasi\n- Soft copy + USB + Hardcopy album\n- Video highlight 5 menit\n- Drone shot\n- Konsultasi pre-wedding');

-- Insert Portofolio Contoh
INSERT INTO portofolio (kategori_id, judul, deskripsi, foto) VALUES 
(1, 'Pernikahan Budi & Siti', 'Dokumentasi pernikahan adat modern', 'wedding1.jpg'),
(1, 'Pernikahan Rinto & Maya', 'Pernikahan dengan tema rustic garden', 'wedding2.jpg'),
(2, 'Event Launching Produk X', 'Dokumentasi acara launching produk elektronik', 'event1.jpg'),
(2, 'Corporate Gathering PT ABC', 'Gathering karyawan dengan suasana casual', 'event2.jpg'),
(3, 'Portrait Headshot CEO', 'Fotografi headshot profesional untuk LinkedIn', 'portrait1.jpg'),
(3, 'Portrait Keluarga', 'Fotografi keluarga di studio indoor', 'portrait2.jpg'),
(4, 'Fotografi Produk Skincare', 'Produk skincare dengan lighting profesional', 'produk1.jpg'),
(4, 'Fotografi Fashion', 'Koleksi fashion musim panas', 'produk2.jpg'),
(5, 'Prewedding Pantai Sunset', 'Prewedding dengan latar pantai sunset', 'prewedding1.jpg'),
(5, 'Prewedding Indoor Studio', 'Prewedding dengan konsep modern di studio', 'prewedding2.jpg');
