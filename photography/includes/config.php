<?php
// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'photography_studio');

// Membuat koneksi
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8");

// Fungsi untuk escape string
function escape($string) {
    global $conn;
    return $conn->real_escape_string($string);
}

// Fungsi untuk query SELECT
function query($sql) {
    global $conn;
    $result = $conn->query($sql);
    $rows = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    return $rows;
}

// Fungsi untuk query single row
function querySingle($sql) {
    global $conn;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

// Fungsi execute (INSERT, UPDATE, DELETE)
function execute($sql) {
    global $conn;
    return $conn->query($sql);
}

// Fungsi untuk format rupiah
function formatRupiah($nominal) {
    return "Rp " . number_format($nominal, 0, ',', '.');
}

// Fungsi untuk format tanggal
function formatTanggal($tanggal) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}
?>
