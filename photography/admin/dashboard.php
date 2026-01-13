<?php
session_start();

include '../includes/config.php';

// Cek login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Query data
$total_pemesanan = querySingle("SELECT COUNT(*) as total FROM pemesanan")['total'];
$total_kontak = querySingle("SELECT COUNT(*) as total FROM kontak")['total'];
$total_portofolio = querySingle("SELECT COUNT(*) as total FROM portofolio")['total'];
$pemesanan_pending = querySingle("SELECT COUNT(*) as total FROM pemesanan WHERE status = 'pending'")['total'];

// Pemesanan terbaru
$pemesanan_terbaru = query("SELECT * FROM pemesanan ORDER BY created_at DESC LIMIT 5");
$kontak_terbaru = query("SELECT * FROM kontak WHERE status = 'belum dibaca' ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - StudioFoto Pro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="admin-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><i class="fas fa-camera"></i> Admin Panel</h2>
            <p style="font-size: 0.8rem; color: #999; margin-top: 5px;">StudioFoto Pro</p>
        </div>

        <ul class="sidebar-menu">
            <li><a href="dashboard.php" class="active"><i class="fas fa-dashboard"></i> Dashboard</a></li>
            <li><a href="portfolio-crud.php"><i class="fas fa-images"></i> Portofolio</a></li>
            <li><a href="packages-crud.php"><i class="fas fa-box"></i> Paket Fotografi</a></li>
            <li><a href="bookings.php"><i class="fas fa-calendar"></i> Pemesanan</a></li>
            <li><a href="messages.php"><i class="fas fa-envelope"></i> Pesan Kontak</a></li>
            <li><a href="logout.php" style="color: #ff6b6b;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <div class="user-menu">
                <span>Selamat datang, <strong><?php echo $_SESSION['admin_nama']; ?></strong></span>
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="content">
            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3><?php echo $total_pemesanan; ?></h3>
                    <p><i class="fas fa-calendar"></i> Total Pemesanan</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $pemesanan_pending; ?></h3>
                    <p><i class="fas fa-hourglass-half"></i> Pemesanan Pending</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $total_kontak; ?></h3>
                    <p><i class="fas fa-envelope"></i> Pesan Masuk</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $total_portofolio; ?></h3>
                    <p><i class="fas fa-images"></i> Foto Portofolio</p>
                </div>
            </div>

            <!-- Recent Bookings -->
            <h2 style="margin-top: 40px; margin-bottom: 20px;">Pemesanan Terbaru</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Klien</th>
                            <th>Email</th>
                            <th>Tanggal Event</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pemesanan_terbaru)): ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: #999;">Belum ada pemesanan</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pemesanan_terbaru as $pemesanan): ?>
                                <tr>
                                    <td><?php echo $pemesanan['nama_klien']; ?></td>
                                    <td><?php echo $pemesanan['email']; ?></td>
                                    <td><?php echo formatTanggal($pemesanan['tanggal_event']); ?></td>
                                    <td>
                                        <span style="background: <?php echo $pemesanan['status'] === 'pending' ? '#ffc107' : '#28a745'; ?>; color: white; padding: 5px 10px; border-radius: 4px; font-size: 0.85rem;">
                                            <?php echo ucfirst($pemesanan['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="bookings.php?id=<?php echo $pemesanan['id']; ?>" class="btn btn-secondary" style="font-size: 0.9rem;">Lihat Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Recent Messages -->
            <h2 style="margin-top: 40px; margin-bottom: 20px;">Pesan Kontak Terbaru</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Subjek</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($kontak_terbaru)): ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: #999;">Tidak ada pesan baru</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($kontak_terbaru as $pesan): ?>
                                <tr>
                                    <td><?php echo $pesan['nama']; ?></td>
                                    <td><?php echo $pesan['email']; ?></td>
                                    <td><?php echo substr($pesan['subjek'], 0, 30); ?>...</td>
                                    <td>
                                        <span style="background: #ffc107; color: white; padding: 5px 10px; border-radius: 4px; font-size: 0.85rem;">
                                            <?php echo $pesan['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="messages.php?id=<?php echo $pesan['id']; ?>" class="btn btn-secondary" style="font-size: 0.9rem;">Baca</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Quick Links -->
            <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-top: 40px;">
                <h2 style="margin-bottom: 20px;">Akses Cepat</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                    <a href="portfolio-crud.php?action=add" class="btn btn-primary" style="text-align: center;">
                        <i class="fas fa-plus"></i> Tambah Portofolio
                    </a>
                    <a href="packages-crud.php?action=add" class="btn btn-primary" style="text-align: center;">
                        <i class="fas fa-plus"></i> Tambah Paket
                    </a>
                    <a href="bookings.php" class="btn btn-primary" style="text-align: center;">
                        <i class="fas fa-list"></i> Lihat Pemesanan
                    </a>
                    <a href="messages.php" class="btn btn-primary" style="text-align: center;">
                        <i class="fas fa-envelope"></i> Lihat Pesan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
