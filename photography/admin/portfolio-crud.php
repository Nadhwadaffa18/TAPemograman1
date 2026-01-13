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

// Ambil kategori
$kategoris = query("SELECT * FROM kategori");

// PROSES DELETE
if ($action === 'delete' && !empty($id)) {
    if (execute("DELETE FROM portofolio WHERE id = '$id'")) {
        $message = 'Portofolio berhasil dihapus!';
        $action = 'list';
    } else {
        $error = 'Gagal menghapus portofolio!';
    }
}

// PROSES ADD/EDIT
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori_id = escape($_POST['kategori_id']);
    $judul = escape($_POST['judul']);
    $deskripsi = escape($_POST['deskripsi']);
    $foto = escape($_POST['foto']);

    if (empty($kategori_id) || empty($judul) || empty($deskripsi) || empty($foto)) {
        $error = 'Semua field harus diisi!';
    } else {
        if ($action === 'edit' && !empty($id)) {
            $sql = "UPDATE portofolio SET kategori_id = '$kategori_id', judul = '$judul', deskripsi = '$deskripsi', foto = '$foto' WHERE id = '$id'";
            if (execute($sql)) {
                $message = 'Portofolio berhasil diupdate!';
                $action = 'list';
            } else {
                $error = 'Gagal mengupdate portofolio!';
            }
        } else {
            $sql = "INSERT INTO portofolio (kategori_id, judul, deskripsi, foto) VALUES ('$kategori_id', '$judul', '$deskripsi', '$foto')";
            if (execute($sql)) {
                $message = 'Portofolio berhasil ditambahkan!';
                $action = 'list';
            } else {
                $error = 'Gagal menambahkan portofolio!';
            }
        }
    }
}

// Ambil data untuk edit
$portofolio = null;
if (($action === 'edit' || $action === 'view') && !empty($id)) {
    $portofolio = querySingle("SELECT * FROM portofolio WHERE id = '$id'");
    if (!$portofolio) {
        $error = 'Portofolio tidak ditemukan!';
        $action = 'list';
    }
}

// Ambil semua portofolio
$all_portofolios = query("SELECT p.*, k.nama_kategori FROM portofolio p JOIN kategori k ON p.kategori_id = k.id ORDER BY p.created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - Admin StudioFoto Pro</title>
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
            <li><a href="portfolio-crud.php" class="active"><i class="fas fa-images"></i> Portofolio</a></li>
            <li><a href="packages-crud.php"><i class="fas fa-box"></i> Paket Fotografi</a></li>
            <li><a href="bookings.php"><i class="fas fa-calendar"></i> Pemesanan</a></li>
            <li><a href="messages.php"><i class="fas fa-envelope"></i> Pesan Kontak</a></li>
            <li><a href="logout.php" style="color: #ff6b6b;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1><i class="fas fa-images"></i> Kelola Portofolio</h1>
            <a href="portfolio-crud.php?action=add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Portofolio
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
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Foto</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($all_portofolios)): ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; color: #999;">Belum ada portofolio</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($all_portofolios as $p): ?>
                                    <tr>
                                        <td><?php echo $p['judul']; ?></td>
                                        <td><?php echo $p['nama_kategori']; ?></td>
                                        <td><?php echo $p['foto']; ?></td>
                                        <td><?php echo formatTanggal($p['created_at']); ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="portfolio-crud.php?action=edit&id=<?php echo $p['id']; ?>" class="btn btn-primary">Edit</a>
                                                <a href="portfolio-crud.php?action=delete&id=<?php echo $p['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
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
                        <label for="kategori"><i class="fas fa-folder"></i> Kategori *</label>
                        <select id="kategori" name="kategori_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategoris as $k): ?>
                                <option value="<?php echo $k['id']; ?>" <?php echo ($portofolio && $portofolio['kategori_id'] == $k['id']) ? 'selected' : ''; ?>>
                                    <?php echo $k['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul"><i class="fas fa-heading"></i> Judul *</label>
                        <input type="text" id="judul" name="judul" required value="<?php echo $portofolio ? $portofolio['judul'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi"><i class="fas fa-pencil-alt"></i> Deskripsi *</label>
                        <textarea id="deskripsi" name="deskripsi" required><?php echo $portofolio ? $portofolio['deskripsi'] : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="foto"><i class="fas fa-image"></i> Nama File Foto *</label>
                        <input type="text" id="foto" name="foto" placeholder="contoh: wedding1.jpg" required value="<?php echo $portofolio ? $portofolio['foto'] : ''; ?>">
                        <small style="color: #666; margin-top: 5px; display: block;">Pastikan file foto sudah ada di folder assets/images/</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> <?php echo $action === 'edit' ? 'Update' : 'Simpan'; ?>
                        </button>
                        <a href="portfolio-crud.php" class="btn btn-secondary">
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
