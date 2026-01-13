<?php 
include 'includes/header.php'; 
include 'includes/config.php';

// Ambil semua paket
$pakets = query("SELECT * FROM paket ORDER BY harga ASC");
?>

<section class="section section-alt" style="margin-top: 40px;">
    <div class="container">
        <div class="section-title">
            <h2>Paket & Harga</h2>
            <p>Pilih paket yang sesuai dengan kebutuhan dan budget Anda</p>
        </div>

        <div class="packages-grid">
            <?php 
            $index = 0;
            foreach ($pakets as $paket): 
                $isFeatured = $index === 2; // Paket ketiga sebagai featured
            ?>
                <div class="package-card <?php echo $isFeatured ? 'featured' : ''; ?>">
                    <?php if ($isFeatured): ?>
                        <div style="background: #d4af37; color: #1a1a1a; padding: 10px; text-align: center; font-weight: 700; margin: -30px -30px 20px -30px;">
                            ⭐ PALING POPULER
                        </div>
                    <?php endif; ?>
                    
                    <h3><?php echo $paket['nama_paket']; ?></h3>
                    
                    <div class="package-price">
                        <?php echo formatRupiah($paket['harga']); ?>
                    </div>
                    
                    <div class="package-duration">
                        <i class="fas fa-clock"></i> <?php echo $paket['durasi']; ?>
                    </div>
                    
                    <p style="margin-bottom: 25px; color: #666;">
                        <?php echo $paket['deskripsi']; ?>
                    </p>
                    
                    <ul class="package-features">
                        <?php 
                        $fitur_array = explode("\n", trim($paket['fitur']));
                        foreach ($fitur_array as $fitur): 
                            if (trim($fitur) !== ''):
                        ?>
                            <li><?php echo trim(str_replace('-', '', $fitur)); ?></li>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </ul>
                    
                    <a href="booking.php?paket=<?php echo $paket['id']; ?>" class="btn-primary" style="display: block; text-align: center; margin-top: 25px;">Pesan Paket Ini</a>
                </div>
            <?php 
                $index++;
            endforeach; 
            ?>
        </div>

        <!-- FAQ Section -->
        <div style="margin-top: 80px; background: white; padding: 40px; border-radius: 8px;">
            <h2 style="text-align: center; margin-bottom: 40px; font-size: 2rem;">Pertanyaan Umum</h2>
            
            <div style="max-width: 700px; margin: 0 auto;">
                <div style="margin-bottom: 25px; border-bottom: 1px solid #ddd; padding-bottom: 20px;">
                    <h4 style="color: #d4af37; margin-bottom: 10px;"><i class="fas fa-question-circle"></i> Apakah paket bisa dikustomisasi?</h4>
                    <p>Ya, semua paket kami dapat disesuaikan dengan kebutuhan Anda. Silakan hubungi kami untuk konsultasi lebih lanjut.</p>
                </div>

                <div style="margin-bottom: 25px; border-bottom: 1px solid #ddd; padding-bottom: 20px;">
                    <h4 style="color: #d4af37; margin-bottom: 10px;"><i class="fas fa-question-circle"></i> Berapa biaya untuk additional hours?</h4>
                    <p>Biaya tambahan adalah Rp 500.000 per jam. Hubungi kami untuk penawaran spesial.</p>
                </div>

                <div style="margin-bottom: 25px; border-bottom: 1px solid #ddd; padding-bottom: 20px;">
                    <h4 style="color: #d4af37; margin-bottom: 10px;"><i class="fas fa-question-circle"></i> Kapan bisa kami lihat hasil foto?</h4>
                    <p>Hasil editing akan siap dalam 7-14 hari kerja setelah hari pemotretan tergantung paket yang dipilih.</p>
                </div>

                <div style="margin-bottom: 25px; border-bottom: 1px solid #ddd; padding-bottom: 20px;">
                    <h4 style="color: #d4af37; margin-bottom: 10px;"><i class="fas fa-question-circle"></i> Apa saja yang termasuk dalam harga?</h4>
                    <p>Harga termasuk sesi pemotretan, editing foto, dan soft copy semua hasil. Detail lengkap ada di deskripsi paket.</p>
                </div>

                <div>
                    <h4 style="color: #d4af37; margin-bottom: 10px;"><i class="fas fa-question-circle"></i> Apakah ada diskon untuk pemesanan grup?</h4>
                    <p>Tersedia diskon khusus untuk pemesanan grup atau paket tahunan. Hubungi kami untuk penawaran terbaik.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
