<?php 
include 'includes/header.php'; 
include 'includes/config.php';

// Ambil kategori dari URL
$kategori = isset($_GET['kategori']) ? escape($_GET['kategori']) : '';

// Query kategori
$kategoris = query("SELECT * FROM kategori");

// Query portofolio berdasarkan kategori
if ($kategori) {
    $portofolios = query("SELECT p.*, k.nama_kategori FROM portofolio p JOIN kategori k ON p.kategori_id = k.id WHERE k.nama_kategori = '$kategori' ORDER BY p.created_at DESC");
} else {
    $portofolios = query("SELECT p.*, k.nama_kategori FROM portofolio p JOIN kategori k ON p.kategori_id = k.id ORDER BY p.created_at DESC");
}
?>

<section class="section" style="margin-top: 40px;">
    <div class="container">
        <div class="section-title">
            <h2>Portofolio Kami</h2>
            <p>Lihat koleksi karya terbaik dari berbagai jenis fotografi</p>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-buttons">
            <button class="filter-btn <?php echo empty($kategori) ? 'active' : ''; ?>" data-filter="semua" onclick="location.href='portfolio.php'">Semua</button>
            <?php foreach ($kategoris as $kat): ?>
                <button class="filter-btn <?php echo $kategori === $kat['nama_kategori'] ? 'active' : ''; ?>" data-filter="<?php echo $kat['nama_kategori']; ?>" onclick="location.href='portfolio.php?kategori=<?php echo urlencode($kat['nama_kategori']); ?>'"><?php echo $kat['nama_kategori']; ?></button>
            <?php endforeach; ?>
        </div>

        <!-- Portfolio Grid -->
        <div class="portfolio-grid">
            <?php if (empty($portofolios)): ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 50px; color: #999;">
                    <p style="font-size: 1.2rem;">Tidak ada portofolio untuk kategori ini</p>
                </div>
            <?php else: ?>
                <?php foreach ($portofolios as $portfolio): ?>
                    <div class="portfolio-item" data-category="<?php echo $portfolio['nama_kategori']; ?>">
                        <img src="assets/images/<?php echo $portfolio['foto']; ?>" alt="<?php echo $portfolio['judul']; ?>" onerror="this.src='https://via.placeholder.com/300x300?text=<?php echo urlencode($portfolio['judul']); ?>'">
                        <div class="portfolio-overlay">
                            <h3><?php echo $portfolio['judul']; ?></h3>
                            <p><?php echo substr($portfolio['deskripsi'], 0, 50); ?>...</p>
                            <button class="btn-primary" style="margin-top: 15px;" onclick="showPortfolioDetail(<?php echo $portfolio['id']; ?>)">Lihat Detail</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Modal Detail -->
<div id="portfolioModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.7); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 8px; padding: 30px; max-width: 600px; max-height: 80vh; overflow-y: auto;">
        <button onclick="closePortfolioModal()" style="float: right; background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
        <div id="portfolioDetail"></div>
    </div>
</div>

<script>
function showPortfolioDetail(id) {
    fetch('includes/get-portfolio.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const portfolio = data.data;
                const detailHtml = `
                    <img src="assets/images/${portfolio.foto}" alt="${portfolio.judul}" style="width: 100%; border-radius: 8px; margin-bottom: 20px;" onerror="this.src='https://via.placeholder.com/500x400?text=${encodeURIComponent(portfolio.judul)}'">
                    <h2>${portfolio.judul}</h2>
                    <p style="color: #d4af37; margin-bottom: 15px;"><strong>${portfolio.nama_kategori}</strong></p>
                    <p>${portfolio.deskripsi}</p>
                `;
                document.getElementById('portfolioDetail').innerHTML = detailHtml;
                document.getElementById('portfolioModal').style.display = 'flex';
            }
        })
        .catch(error => console.error('Error:', error));
}

function closePortfolioModal() {
    document.getElementById('portfolioModal').style.display = 'none';
}

document.addEventListener('click', function(event) {
    const modal = document.getElementById('portfolioModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
</script>

<?php include 'includes/footer.php'; ?>
