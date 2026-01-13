<?php
session_start();
include '../includes/config.php';

// Cek login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? escape($_GET['id']) : '';
$message = '';
$error = '';

// PROSES DELETE
if ($action === 'delete' && !empty($id)) {
    if (execute("DELETE FROM paket WHERE id = '$id'")) {
        $message = 'Paket berhasil dihapus!';
        $action = 'list';
    } else {
        $error = 'Gagal menghapus paket!';
    }
}

// PROSES ADD/EDIT
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_paket = escape($_POST['nama_paket']);
    $deskripsi = escape($_POST['deskripsi']);
    $harga = escape($_POST['harga']);
    $durasi = escape($_POST['durasi']);
    $fitur = escape($_POST['fitur']);

    if (empty($nama_paket) || empty($deskripsi) || empty($harga) || empty($durasi)) {
        $error = 'Semua field harus diisi!';
    } else {
        if ($action === 'edit' && !empty($id)) {
            $sql = "UPDATE paket SET nama_paket = '$nama_paket', deskripsi = '$deskripsi', harga = '$harga', durasi = '$durasi', fitur = '$fitur' WHERE id = '$id'";
            if (execute($sql)) {
                $message = 'Paket berhasil diupdate!';
                $action = 'list';
            } else {
                $error = 'Gagal mengupdate paket!';
            }
        } else {
            $sql = "INSERT INTO paket (nama_paket, deskripsi, harga, durasi, fitur) VALUES ('$nama_paket', '$deskripsi', '$harga', '$durasi', '$fitur')";
            if (execute($sql)) {
                $message = 'Paket berhasil ditambahkan!';
                $action = 'list';
            } else {
                $error = 'Gagal menambahkan paket!';
            }
        }
    }
}

// Ambil data untuk edit
$paket = null;
if (($action === 'edit' || $action === 'view') && !empty($id)) {
    $paket = querySingle("SELECT * FROM paket WHERE id = '$id'");
    if (!$paket) {
        $error = 'Paket tidak ditemukan!';
        $action = 'list';
    }
}

// Ambil semua paket
$all_pakets = query("SELECT * FROM paket ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Fotografi - Admin StudioFoto Pro</title>
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
            <li><a href="packages-crud.php" class="active"><i class="fas fa-box"></i> Paket Fotografi</a></li>
            <li><a href="bookings.php"><i class="fas fa-calendar"></i> Pemesanan</a></li>
            <li><a href="messages.php"><i class="fas fa-envelope"></i> Pesan Kontak</a></li>
            <li><a href="logout.php" style="color: #ff6b6b;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1><i class="fas fa-box"></i> Kelola Paket Fotografi</h1>
            <a href="packages-crud.php?action=add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Paket
            </a>
        </div>

        <div class="content">
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

            <?php if ($action === 'list'): ?>
                <!-- List View -->
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Durasi</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($all_pakets)): ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; color: #999;">Belum ada paket</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($all_pakets as $p): ?>
                                    <tr>
                                        <td><strong><?php echo $p['nama_paket']; ?></strong></td>
                                        <td><?php echo formatRupiah($p['harga']); ?></td>
                                        <td><?php echo $p['durasi']; ?></td>
                                        <td><?php echo substr($p['deskripsi'], 0, 50) . '...'; ?></td>
                                        <td><?php echo formatTanggal($p['created_at']); ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="packages-crud.php?action=edit&id=<?php echo $p['id']; ?>" class="btn btn-primary">Edit</a>
                                                <a href="packages-crud.php?action=delete&id=<?php echo $p['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            <?php elseif ($action === 'add' || $action === 'edit'): ?>
                <!-- Form Add/Edit -->
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nama_paket"><i class="fas fa-heading"></i> Nama Paket *</label>
                        <input type="text" id="nama_paket" name="nama_paket" required value="<?php echo $paket ? $paket['nama_paket'] : ''; ?>">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="harga"><i class="fas fa-money-bill"></i> Harga (Rp) *</label>
                            <input type="number" id="harga" name="harga" required value="<?php echo $paket ? $paket['harga'] : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="durasi"><i class="fas fa-clock"></i> Durasi (jam) *</label>
                            <input type="number" id="durasi" name="durasi" required value="<?php echo $paket ? $paket['durasi'] : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi"><i class="fas fa-pencil-alt"></i> Deskripsi *</label>
                        <textarea id="deskripsi" name="deskripsi" required><?php echo $paket ? $paket['deskripsi'] : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="fitur"><i class="fas fa-list"></i> Fitur (pisahkan dengan koma)</label>
                        <textarea id="fitur" name="fitur" placeholder="Contoh: 1 lokasi, 2 fotografer, Album digital"><?php echo $paket ? $paket['fitur'] : ''; ?></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> <?php echo $action === 'edit' ? 'Update' : 'Simpan'; ?>
                        </button>
                        <a href="packages-crud.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>

            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
