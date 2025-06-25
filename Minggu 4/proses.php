<?php
require 'csrf.php';
require 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || !verifikasiToken($_POST['csrf_token'])) {
        die("Token CSRF tidak valid.");
    }

    
    $nama  = htmlspecialchars(trim($_POST['nama']));
    $email = htmlspecialchars(trim($_POST['email']));

    if (empty($nama) || empty($email)) {
        die("Semua kolom wajib diisi.");
    }

    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (nama, email) VALUES (:nama, :email)");
        $berhasil = $stmt->execute(['nama' => $nama, 'email' => $email]);
    
        if ($berhasil) {
            echo "Pendaftaran berhasil!";
        } else {
            echo "Pendaftaran gagal. Silakan coba lagi.";
        }
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
    
}
?>
