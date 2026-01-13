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

// PROSES UPDATE STATUS (Mark as read)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message_id'])) {
    $message_id = escape($_POST['message_id']);
    $status = $_POST['status'] === 'Dibaca' ? 'Dibaca' : 'Belum Dibaca';

    if (execute("UPDATE kontak SET status = '$status' WHERE id = '$message_id'")) {
        $message = 'Status pesan berhasil diupdate!';
    } else {
        $error = 'Gagal mengupdate status!';
    }
}

// PROSES DELETE
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = escape($_GET['id']);
    if (execute("DELETE FROM kontak WHERE id = '$id'")) {
        $message = 'Pesan berhasil dihapus!';
    } else {
        $error = 'Gagal menghapus pesan!';
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
    $where .= " AND DATE_FORMAT(created_at, '%Y-%m') = '$filter_bulan'";
}

// Ambil semua pesan
$messages = query("
    SELECT * FROM kontak 
    WHERE $where 
    ORDER BY created_at DESC
");

// Hitung statistik
$total_messages = querySingle("SELECT COUNT(*) as total FROM kontak")['total'];
$unread_messages = querySingle("SELECT COUNT(*) as total FROM kontak WHERE status = 'Belum Dibaca'")['total'];
$read_messages = querySingle("SELECT COUNT(*) as total FROM kontak WHERE status = 'Dibaca'")['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak - Admin StudioFoto Pro</title>
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
            <li><a href="bookings.php"><i class="fas fa-calendar"></i> Pemesanan</a></li>
            <li><a href="messages.php" class="active"><i class="fas fa-envelope"></i> Pesan Kontak</a></li>
            <li><a href="logout.php" style="color: #ff6b6b;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1><i class="fas fa-envelope"></i> Pesan Kontak</h1>
        </div>

        <div class="content">
            <!-- Statistik Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(233, 30, 99, 0.2); color: #e91e63;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $total_messages; ?></h3>
                        <p>Total Pesan</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.2); color: #ffc107;">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $unread_messages; ?></h3>
                        <p>Belum Dibaca</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(76, 175, 80, 0.2); color: #4caf50;">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $read_messages; ?></h3>
                        <p>Sudah Dibaca</p>
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
                        <option value="Belum Dibaca" <?php echo $filter_status === 'Belum Dibaca' ? 'selected' : ''; ?>>Belum Dibaca</option>
                        <option value="Dibaca" <?php echo $filter_status === 'Dibaca' ? 'selected' : ''; ?>>Sudah Dibaca</option>
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Subjek</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($messages)): ?>
                            <tr>
                                <td colspan="7" style="text-align: center; color: #999;">Belum ada pesan</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($messages as $m): ?>
                                <tr <?php echo $m['status'] === 'Belum Dibaca' ? 'style="background-color: #f9f3f0;"' : ''; ?>>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong><?php echo $m['nama']; ?></strong></td>
                                    <td><?php echo $m['email']; ?></td>
                                    <td><?php echo $m['subjek']; ?></td>
                                    <td><?php echo formatTanggal($m['created_at']); ?></td>
                                    <td>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="message_id" value="<?php echo $m['id']; ?>">
                                            <select name="status" onchange="this.form.submit()" class="status-select">
                                                <option value="Belum Dibaca" <?php echo $m['status'] === 'Belum Dibaca' ? 'selected' : ''; ?>>Belum Dibaca</option>
                                                <option value="Dibaca" <?php echo $m['status'] === 'Dibaca' ? 'selected' : ''; ?>>Sudah Dibaca</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button type="button" class="btn btn-info" onclick="showMessage(<?php echo htmlspecialchars(json_encode($m)); ?>)">
                                                Baca
                                            </button>
                                            <a href="messages.php?action=delete&id=<?php echo $m['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
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

<!-- Modal Baca Pesan -->
<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Detail Pesan</h2>
        <div id="messageContent" style="margin-top: 20px;"></div>
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
    max-height: 80vh;
    overflow-y: auto;
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
    margin-bottom: 20px;
}

.detail-label {
    font-weight: bold;
    color: #666;
    font-size: 14px;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.detail-value {
    color: #333;
    padding: 10px;
    background-color: #f5f5f5;
    border-radius: 5px;
    word-wrap: break-word;
}

.message-content {
    background-color: #f9f3f0;
    border-left: 4px solid #d4af37;
    padding: 15px;
    border-radius: 5px;
    line-height: 1.6;
    white-space: pre-wrap;
    word-wrap: break-word;
}

.status-select {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}
</style>

<script>
function showMessage(msg) {
    const content = `
        <div class="detail-row">
            <div class="detail-label">Nama:</div>
            <div class="detail-value">${msg.nama}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Email:</div>
            <div class="detail-value">${msg.email}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Subjek:</div>
            <div class="detail-value">${msg.subjek}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Tanggal:</div>
            <div class="detail-value">${new Date(msg.created_at).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            })}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Pesan:</div>
            <div class="message-content">${msg.pesan}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Status:</div>
            <div class="detail-value" style="color: ${msg.status === 'Belum Dibaca' ? '#ff6b6b' : '#4caf50'}; font-weight: bold;">
                ${msg.status}
            </div>
        </div>
    `;
    document.getElementById('messageContent').innerHTML = content;
    document.getElementById('messageModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('messageModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('messageModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

</body>
</html>
