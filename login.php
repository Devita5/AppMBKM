<?php
session_start(); // Memulai session

// Username dan password statik yang sudah diatur manual di kode PHP
$valid_username_mahasiswa = 'mhs1';  // Username untuk mahasiswa
$valid_password_mahasiswa = '123';   // Password untuk mahasiswa

$valid_username_admin = 'admin1';  // Username untuk admin
$valid_password_admin = '123';   // Password untuk admin

// Cek jika form login disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Ambil username dari form
    $password = $_POST['password']; // Ambil password dari form

    // Verifikasi untuk mahasiswa
    if ($username === $valid_username_mahasiswa && $password === $valid_password_mahasiswa) {
        // Username dan password cocok, login berhasil untuk mahasiswa
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'mahasiswa'; // Menyimpan role mahasiswa

        header('Location: user.php'); // Halaman mahasiswa
        exit();

    // Verifikasi untuk admin
    } elseif ($username === $valid_username_admin && $password === $valid_password_admin) {
        // Username dan password cocok, login berhasil untuk admin
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin'; // Menyimpan role admin

        header('Location: admin.php'); // Halaman admin
        exit();
    } else {
        $error_message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Reset beberapa styling default */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Style untuk halaman login */
        body {
            font-family: Arial, sans-serif;
            background-color: #173b4f;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Styling untuk heading */
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #133E87; /* Warna border saat focus */
            outline: none;
        }

        /* Tombol submit */
        button[type="submit"] {
            background-color: #133E87;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color:rgb(69, 87, 160);
        }

        /* Styling untuk pesan kesalahan */
        p {
            color: red;
            font-size: 14px;
        }

        /* Responsive Design untuk tampilan mobile */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
                width: 90%;
            }

            h2 {
                font-size: 20px;
            }

            input[type="text"],
            input[type="password"],
            button[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <!-- Form Login -->
        <form method="POST" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
