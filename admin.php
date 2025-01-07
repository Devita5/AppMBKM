<?php
include 'koneksi.php';

$query_pendaftaran = "SELECT * FROM pendaftaran ORDER BY id ASC";

$result_pendaftaran = mysqli_query($koneksi, $query_pendaftaran);

<!DOCTYPE html>
<html lang="id">
  <body>
    <section id="content">
      <!-- Tabel Data Pendaftaran -->
            <h2>Data Pendaftaran MBKM</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>File</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th> <!-- Kolom baru untuk tombol hapus -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data pendaftaran dari database

                    // Cek apakah data tersedia
                    if ($result_pendaftaran && mysqli_num_rows($result_pendaftaran) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result_pendaftaran)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                            echo "<td><a href='" . htmlspecialchars($row['file_upload']) . "' target='_blank'>Unduh File</a></td>";
                            echo "<td>" . htmlspecialchars($row['tanggal_upload']) . "</td>";
                            // Menambahkan kolom aksi dengan tombol hapus
                            echo "<td><a href='hapus_pendaftaran.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data pendaftaran.</td></tr>"; // Sesuaikan kolom menjadi 5 karena ada kolom aksi
                    }
                    ?>
                </tbody>
            </table>

            <!-- Modal Form Edit -->
            <div id="editModal" style="display:none;">
                <form method="POST" action="admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <label for="edit_nama_file">Nama File:</label>
                    <input type="text" name="edit_nama_file" id="edit_nama_file" required>
                    <label for="edit_file">Pilih File Baru:</label>
                    <input type="file" name="edit_file" id="edit_file" accept=".pdf,.doc,.docx,.jpg,.png" required>
                    <button type="submit">Simpan</button>
                </form>
            </div>
        </div>    
    </section>
    <script>
        function showSection(contentId) {
        const sections = document.querySelectorAll('#content > div');
        sections.forEach(section => section.style.display = 'none');
        document.getElementById(contentId).style.display = 'block';
        }

        document.addEventListener("DOMContentLoaded", () => {
        showSection('beranda'); 
        });

        function editFile(id, nama) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama_file').value = nama;
            document.getElementById('editModal').style.display = 'block';
        }
    </script>
  </body>
</html>
