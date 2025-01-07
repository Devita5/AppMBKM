<?php
include 'koneksi.php';

$query_profil = "SELECT * FROM profil WHERE id = 2"; 
$query_ttg = "SELECT * FROM ttg_pembuat WHERE id = 1";
$query = "SELECT * FROM grafik_mbkm ORDER BY id ASC";

$result_profil = mysqli_query($koneksi, $query_profil);
$result_ttg = mysqli_query($koneksi, $query_ttg);
$result = mysqli_query($koneksi, $query);

$profil = $result_profil ? mysqli_fetch_assoc($result_profil) : null;
$ttg = $result_ttg ? mysqli_fetch_assoc($result_ttg) : null;
$grafik_mbkm = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<body>
  <section>
    <!-- Profil -->
        <div id="profil">
            <h2>Profil Akun Mahasiswa</h2>
            <div>
                <div>
                    <img src="asset/ochaa.png" alt="Foto Profil">
                </div>
                <div>
                    <?php if ($profil): ?>
                        <p><strong>Nama:</strong> <?php echo htmlspecialchars($profil['nama']); ?></p>
                        <p><strong>NIM:</strong> <?php echo htmlspecialchars($profil['nim']); ?></p>
                        <p><strong>Prodi:</strong> <?php echo htmlspecialchars($profil['prodi']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($profil['email']); ?></p>
                    <?php else: ?>
                        <p>Data profil tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

  <!-- Tentang Pembuat -->
        <div id="ttg">
            <h2>Tentang Pembuat</h2>
            <div class="ttg-content">
                <div class="ttg-text">
                    <?php if ($ttg): ?>
                        <p><strong></strong> <?php echo $ttg['deskripsi']; ?></p>
                    <?php else: ?>
                        <p>Informasi tentang pembuat tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
                <img src="asset/ocha.jpg" alt="Foto Pembuat" class="ttg-photo">
            </div>
        </div>
  </section>

  <aside>
        <h2>Grafik MBKM UPJ</h2>
        <div class="grafik-container">
            <?php foreach ($grafik_mbkm as $grafik): ?>
                <div class="grafik-item">
                    <!-- Grafik Lingkaran -->
                    <div class="grafik-lingkaran" style="--percentage: <?php echo $grafik['persentase']; ?>%;">
                        <div class="grafik-pusat">
                            <span><?php echo $grafik['persentase']; ?>%</span>
                        </div>
                    </div>
                    <!-- Kategori dan Deskripsi -->
                    <h3><?php echo htmlspecialchars($grafik['kategori']); ?></h3>
                    <p><?php echo htmlspecialchars($grafik['deskripsi']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </aside>

  <script>
        function showSection(contentId) {
        const sections = document.querySelectorAll('#content > div');
        sections.forEach(section => section.style.display = 'none');
        document.getElementById(contentId).style.display = 'block';
        }

        document.addEventListener("DOMContentLoaded", () => {
        showSection('beranda'); 
        });
    </script>
</body>
</html>
