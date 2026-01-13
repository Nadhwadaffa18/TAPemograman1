<?php
session_start();
include '../includes/config.php';

// Cek login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$message = '';
$error = '';

// PROSES UPDATE STATUS
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
    $booking_id = escape($_POST['booking_id']);
    $status = escape($_POST['status']);

    if (execute("UPDATE pemesanan SET status = '$status' WHERE id = '$booking_id'")) {
        $message = 'Status pemesanan berhasil diupdate!';
    } else {
        $error = 'Gagal mengupdate status!';
    }
}

// PROSES DELETE
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = escape($_GET['id']);
    if (execute("DELETE FROM pemesanan WHERE id = '$id'")) {
        $message = 'Pemesanan berhasil dihapus!';
    } else {
        $error = 'Gagal menghapus pemesanan!';
    }
}

// Ambil filter
$filter_status = isset($_GET['status']) ? escape($_GET['status']) : '';
$filter_bulan = isset($_GET['bulan']) ? escape($_GET['bulan']) : date('Y-m');

// Build query
$where = "1=1";
if (!empty($filter_status)) {
    $where .= " AND status = '$filter_status'";
}
if (!empty($filter_bulan)) {
    $where .= " AND DATE_FORMAT(tanggal_event, '%Y-%m') = '$filter_bulan'";
}

// Ambil semua pemesanan
$bookings = query("
    SELECT b.*, p.nama_paket, p.harga 
    FROM pemesanan b 
    JOIN paket p ON b.paket_id = p.id 
    WHERE $where 
    ORDER BY b.tanggal_event DESC
");

// Hitung statistik
$total_bookings = querySingle("SELECT COUNT(*) as total FROM pemesanan")['total'];
$pending_bookings = querySingle("SELECT COUNT(*) as total FROM pemesanan WHERE status = 'Pending'")['total'];
$completed_bookings = querySingle("SELECT COUNT(*) as total FROM pemesanan WHERE status = 'Selesai'")['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Admin StudioFoto Pro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="admin-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><i class="fas fa-camera"></i> Admin Panel</h2>
        </div>

        <ul class="sidebar-menu">
            <li><a href="dashboard.php"><i class="fas fa-dashboard"></i> Dashboard</a></li>
            <li><a href="portfolio-crud.php"><i class="fas fa-images"></i> Portofolio</a></li>
            <li><a href="packages-crud.php"><i class="fas fa-box"></i> Paket Fotografi</a></li>
            <li><a href="bookings.php" class="active"><i class="fas fa-calendar"></i> Pemesanan</a></li>
            <li><a href="messages.php"><i class="fas fa-envelope"></i> Pesan Kontak</a></li>
            <li><a href="logout.php" style="color: #ff6b6b;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1><i class="fas fa-calendar"></i> Kelola Pemesanan</h1>
        </div>

        <div class="content">
            <!-- Statistik Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(52, 152, 219, 0.2); color: #3498db;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $total_bookings; ?></h3>
                        <p>Total Pemesanan</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.2); color: #ffc107;">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $pending_bookings; ?></h3>
                        <p>Menunggu</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(76, 175, 80, 0.2); color: #4caf50;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $completed_bookings; ?></h3>
                        <p>Selesai</p>
                    </div>
                </div>
            </div>

            <?php if (!empty($message)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <!-- Filter -->
            <div class="filter-section">
                <form method="GET" action="" style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <select name="status" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="Pending" <?php echo $filter_status === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="Dikonfirmasi" <?php echo $filter_status === 'Dikonfirmasi' ? 'selected' : ''; ?>>Dikonfirmasi</option>
                        <option value="Selesai" <?php echo $filter_status === 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                        <option value="Dibatalkan" <?php echo $filter_status === 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                    </select>

                    <input type="month" name="bulan" value="<?php echo $filter_bulan; ?>" onchange="this.form.submit()">
                </form>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Klien</th>
                            <th>Email</th>
                            <th>Paket</th>
                            <th>Tanggal Event</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($bookings)): ?>
                            <tr>
                                <td colspan="8" style="text-align: center; color: #999;">Belum ada pemesanan</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($bookings as $b): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong><?php echo $b['nama_klien']; ?></strong></td>
                                    <td><?php echo $b['email']; ?></td>
                                    <td><?php echo $b['nama_paket']; ?></td>
                                    <td><?php echo formatTanggal($b['tanggal_event']); ?></td>
                                    <td><?php echo $b['lokasi']; ?></td>
                                    <td>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="booking_id" value="<?php echo $b['id']; ?>">
                                            <select name="status" onchange="this.form.submit()" class="status-select">
                                                <option value="Pending" <?php echo $b['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="Dikonfirmasi" <?php echo $b['status'] === 'Dikonfirmasi' ? 'selected' : ''; ?>>Dikonfirmasi</option>
                                                <option value="Selesai" <?php echo $b['status'] === 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                                <option value="Dibatalkan" <?php echo $b['status'] === 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button type="button" class="btn btn-info" onclick="showDetails(<?php echo htmlspecialchars(json_encode($b)); ?>)">
                                                Detail
                                            </button>
                                            <a href="bookings.php?action=delete&id=<?php echo $b['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Detail Pemesanan</h2>
        <div id="detailContent" style="margin-top: 20px;"></div>
    </div>
</div>

<style>
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 30px;
    border-radius: 10px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: #000;
}

.detail-row {
    display: grid;
    grid-template-columns: 150px 1fr;
    gap: 20px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.detail-label {
    font-weight: bold;
    color: #666;
}

.detail-value {
    color: #333;
}

.status-select {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}
</style>

<script>
function showDetails(booking) {
    const content = `
        <div class="detail-row">
            <div class="detail-label">Nama Klien:</div>
            <div class="detail-value">${booking.nama_klien}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Email:</div>
            <div class="detail-value">${booking.email}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Nomor HP:</div>
            <div class="detail-value">${booking.nomor_hp}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Paket:</div>
            <div class="detail-value">${booking.nama_paket}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Harga:</div>
            <div class="detail-value">Rp ${new Intl.NumberFormat('id-ID').format(booking.harga)}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Tanggal Event:</div>
            <div class="detail-value">${new Date(booking.tanggal_event).toLocaleDateString('id-ID')}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Lokasi:</div>
            <div class="detail-value">${booking.lokasi}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Catatan:</div>
            <div class="detail-value">${booking.catatan || 'Tidak ada'}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Status:</div>
            <div class="detail-value"><strong style="color: #d4af37;">${booking.status}</strong></div>
        </div>
    `;
    document.getElementById('detailContent').innerHTML = content;
    document.getElementById('detailModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('detailModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('detailModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

</body>
</html>
