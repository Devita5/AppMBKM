<?php

$conn = new mysqli("localhost", "root", "root", "universitas");


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


$id_laporan = $_GET['id'];


$query = $conn->prepare("DELETE FROM dokumen_laporan WHERE id = ?");
if (!$query) {
    die("Kesalahan prepare: " . $conn->error); 


$query->bind_param("i", $id_laporan);


if ($query->execute()) {
    
    header("Location: user.php#laporan");
    exit; 
} else {
    echo "Gagal menghapus data: " . $query->error; 
}


$query->close();
$conn->close();
?>
