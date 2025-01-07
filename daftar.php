<?php
// Koneksi ke database
$host = 'localhost'; 
$username = 'root'; 
$password = 'root'; 
$dbname = 'uas_pibs'; 

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form jika tombol submit ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil informasi file
    $file_name = $_FILES['fileUpload']['name'];
    $file_tmp = $_FILES['fileUpload']['tmp_name'];
    $file_size = $_FILES['fileUpload']['size'];
    $file_error = $_FILES['fileUpload']['error'];

    
    $upload_dir = "uploads/"; 

    
    if ($file_error === 0) {
     
        $file_path = $upload_dir . basename($file_name);

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($file_tmp, $file_path)) {
      
            $stmt = $conn->prepare("INSERT INTO daftar (nama_file) VALUES (?)");
            $stmt->bind_param("s", $file_name); 
            if ($stmt->execute()) {
                echo "File berhasil diunggah dan data disimpan!";
            } else {
                echo "Gagal menyimpan data ke database.";
            }
            $stmt->close();
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Error saat mengunggah file: " . $file_error;
    }
}

$conn->close();
?>
