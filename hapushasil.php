<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "root", "universitas");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
echo "Koneksi berhasil!";

// Ambil ID dari request
$id_hasil = $_GET['id'];

// Siapkan query
$query = $conn->prepare("DELETE FROM dokumen_hasil WHERE id = ?");
if (!$query) {
    die("Kesalahan prepare: " . $conn->error); // Debugging jika prepare gagal
}

// Bind parameter
$query->bind_param("i", $id_hasil);

// Eksekusi query
if ($query->execute()) {
    echo "Data berhasil dihapus!";
    header("Location: user.php#hasil");
    exit;
} else {
    echo "Gagal menghapus data: " . $query->error; // Debugging jika eksekusi gagal
}

// Tutup koneksi
$query->close();
$conn->close();
?>
