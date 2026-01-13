<?php 
include 'includes/header.php'; 
include 'includes/config.php';

$success_message = '';
$error_message = '';

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = escape($_POST['nama']);
    $email = escape($_POST['email']);
    $subjek = escape($_POST['subjek']);
    $pesan = escape($_POST['pesan']);

    // Validasi
    if (empty($nama) || empty($email) || empty($subjek) || empty($pesan)) {
        $error_message = 'Semua field harus diisi!';
    } else {
        $sql = "INSERT INTO kontak (nama, email, subjek, pesan) 
                VALUES ('$nama', '$email', '$subjek', '$pesan')";
        
        if (execute($sql)) {
            $success_message = 'Pesan Anda berhasil dikirim! Kami akan merespons dalam waktu 24 jam.';
            $_POST = [];
        } else {
            $error_message = 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.';
        }
    }
}
?>

<section class="section" style="margin-top: 40px;">
    <div class="container">
        <div class="section-title">
            <h2>Hubungi Kami</h2>
            <p>Kami siap menjawab pertanyaan dan kebutuhan Anda</p>
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

        <div class="contact-grid">
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h3>Telepon</h3>
                        <p>Hubungi kami untuk pertanyaan cepat</p>
                        <a href="tel:+62812345678">+62 812 345 678</a>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="fab fa-whatsapp"></i>
                    <div>
                        <h3>WhatsApp</h3>
                        <p>Chat dengan kami melalui WhatsApp</p>
                        <a href="https://wa.me/62812345678" target="_blank">+62 812 345 678</a>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h3>Email</h3>
                        <p>Kirim email untuk pertanyaan detail</p>
                        <a href="mailto:info@studiofotopro.com">info@studiofotopro.com</a>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h3>Alamat</h3>
                        <p>Kunjungi studio kami</p>
                        <p>Jl. Sudirman No. 123<br>Jakarta Pusat, 12345<br>Indonesia</p>
                    </div>
                </div>

                <div style="background: #f0f0f0; padding: 20px; border-radius: 8px; margin-top: 20px;">
                    <h3 style="margin-bottom: 15px;">Jam Operasional</h3>
                    <p><strong>Senin - Jumat:</strong> 09:00 - 18:00</p>
                    <p><strong>Sabtu:</strong> 10:00 - 16:00</p>
                    <p><strong>Minggu:</strong> Tutup</p>
                </div>

                <div style="margin-top: 20px;">
                    <h3 style="margin-bottom: 15px;">Ikuti Kami</h3>
                    <div style="display: flex; gap: 15px;">
                        <a href="https://instagram.com" target="_blank" style="background: #d4af37; color: white; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 1.5rem;"><i class="fab fa-instagram"></i></a>
                        <a href="https://facebook.com" target="_blank" style="background: #d4af37; color: white; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 1.5rem;"><i class="fab fa-facebook"></i></a>
                        <a href="https://youtube.com" target="_blank" style="background: #d4af37; color: white; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 1.5rem;"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="form-section" style="box-shadow: none; border: 1px solid #ddd;">
                <h3 style="margin-bottom: 30px;">Kirim Pesan</h3>
                <form method="POST" action="" onsubmit="return validateForm('contactForm');">
                    <input type="hidden" id="contactForm" name="contactForm">
                    
                    <div class="form-group">
                        <label for="nama">Nama Anda *</label>
                        <input type="text" id="nama" name="nama" required value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="subjek">Subjek *</label>
                        <input type="text" id="subjek" name="subjek" required value="<?php echo isset($_POST['subjek']) ? $_POST['subjek'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="pesan">Pesan *</label>
                        <textarea id="pesan" name="pesan" required><?php echo isset($_POST['pesan']) ? $_POST['pesan'] : ''; ?></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
