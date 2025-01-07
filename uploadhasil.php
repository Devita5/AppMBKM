<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_file = mysqli_real_escape_string($conn, $_POST["nama_file"]);
    $kategori = mysqli_real_escape_string($conn, $_POST["kategori"]);
    $file = $_FILES["file"]["name"];

    $target_dir = "files/hasil/";
    $target_file = $target_dir . basename($file);

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO dokumen_hasil (nama_file, kategori, file_path, created_at) 
                VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nama_file, $kategori, $target_file);

        if ($stmt->execute()) {
            header("Location: user.php?success=true");
        } else {
            header("Location: user.php?error=true");
        }
        $stmt->close();
    } else {
        header("Location: user.php?upload_error=true");
    }

    if ($query) {
      
        header("Location: user.php#laporan");
        exit; 
    } else {
        echo "Gagal menyimpan data.";
    }
}
$conn->close();
