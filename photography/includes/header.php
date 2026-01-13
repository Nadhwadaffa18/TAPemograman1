<?php
// Cek session
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    $_SESSION['user_logged_in'] = false;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudioFoto Pro - Jasa Fotografi Profesional</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar">
    <div class="container">
        <div class="navbar-brand">
            <h1><i class="fas fa-camera"></i> StudioFoto Pro</h1>
        </div>
        <ul class="nav-menu">
            <li><a href="index.php">Beranda</a></li>
            <li><a href="about.php">Tentang Kami</a></li>
            <li><a href="portfolio.php">Portofolio</a></li>
            <li><a href="packages.php">Paket & Harga</a></li>
            <li><a href="booking.php">Pesan Sekarang</a></li>
            <li><a href="contact.php">Kontak</a></li>
            <li><a href="admin/login.php" class="btn-admin">Admin</a></li>
        </ul>
    </div>
</nav>
