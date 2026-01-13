<?php 
include 'includes/header.php'; 
include 'includes/config.php';

// Ambil semua paket untuk dropdown
$pakets = query("SELECT id, nama_paket, harga FROM paket ORDER BY harga ASC");
$paket_selected = isset($_GET['paket']) ? escape($_GET['paket']) : '';

$success_message = '';
$error_message = '';

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_klien = escape($_POST['nama_klien']);
    $email = escape($_POST['email']);
    $nomor_hp = escape($_POST['nomor_hp']);
    $tanggal_event = escape($_POST['tanggal_event']);
    $paket_id = escape($_POST['paket_id']);
    $lokasi = escape($_POST['lokasi']);
    $catatan = escape($_POST['catatan']);

    // Validasi
    if (empty($nama_klien) || empty($email) || empty($nomor_hp) || empty($tanggal_event) || empty($paket_id) || empty($lokasi)) {
        $error_message = 'Semua field harus diisi!';
    } else {
        $sql = "INSERT INTO pemesanan (nama_klien, email, nomor_hp, tanggal_event, paket_id, lokasi, catatan) 
                VALUES ('$nama_klien', '$email', '$nomor_hp', '$tanggal_event', '$paket_id', '$lokasi', '$catatan')";
        
        if (execute($sql)) {
            $success_message = 'Pemesanan Anda berhasil diterima! Kami akan menghubungi Anda segera.';
            // Reset form
            $_POST = [];
            $paket_selected = '';
        } else {
            $error_message = 'Terjadi kesalahan saat memproses pemesanan. Silakan coba lagi.';
        }
    }
}
?>

<section class="section" style="margin-top: 40px; margin-bottom: 40px;">
    <div class="container">
        <div class="section-title">
            <h2>Pesan Jasa Fotografi Kami</h2>
            <p>Isi form di bawah untuk memulai proses pemesanan</p>
        </div>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="form-section">
            <form method="POST" action="" onsubmit="return validateForm('bookingForm');">
                <input type="hidden" id="bookingForm" name="bookingForm">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama_klien" required value="<?php echo isset($_POST['nama_klien']) ? $_POST['nama_klien'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="hp">Nomor HP/WhatsApp *</label>
                        <input type="tel" id="hp" name="nomor_hp" placeholder="08xx-xxxx-xxxx" required value="<?php echo isset($_POST['nomor_hp']) ? $_POST['nomor_hp'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Event/Pemotretan *</label>
                        <input type="date" id="tanggal" name="tanggal_event" required value="<?php echo isset($_POST['tanggal_event']) ? $_POST['tanggal_event'] : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="paket">Pilih Paket *</label>
                    <select id="paket" name="paket_id" required>
                        <option value="">-- Pilih Paket --</option>
                        <?php foreach ($pakets as $paket): ?>
                            <option value="<?php echo $paket['id']; ?>" <?php echo $paket_selected == $paket['id'] ? 'selected' : ''; ?>>
                                <?php echo $paket['nama_paket']; ?> - <?php echo formatRupiah($paket['harga']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi Pemotretan *</label>
                    <input type="text" id="lokasi" name="lokasi" placeholder="Misal: Gedung Serbaguna ABC, Jakarta" required value="<?php echo isset($_POST['lokasi']) ? $_POST['lokasi'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="catatan">Catatan Tambahan</label>
                    <textarea id="catatan" name="catatan" placeholder="Berikan informasi tambahan atau permintaan khusus (opsional)"><?php echo isset($_POST['catatan']) ? $_POST['catatan'] : ''; ?></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Kirim Pemesanan
                </button>

                <p style="margin-top: 20px; text-align: center; color: #999; font-size: 0.9rem;">
                    Dengan mengirim form ini, Anda setuju dengan syarat dan ketentuan kami.
                </p>
            </form>

            <div style="background: #f0f0f0; padding: 20px; border-radius: 8px; margin-top: 40px;">
                <h3 style="margin-bottom: 15px;"><i class="fas fa-info-circle" style="color: #d4af37;"></i> Informasi Penting</h3>
                <ul style="margin-left: 20px; color: #555;">
                    <li>Kami akan menghubungi Anda dalam 24 jam untuk konfirmasi pemesanan</li>
                    <li>Deposit sebesar 50% diperlukan untuk mengamankan jadwal Anda</li>
                    <li>Sisa pembayaran harus dilunasi sebelum hari pemotretan</li>
                    <li>Pembatalan gratis hingga 7 hari sebelum jadwal</li>
                    <li>Hubungi kami untuk perubahan jadwal atau lokasi</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
