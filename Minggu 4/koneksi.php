<?php
$host = 'localhost';
$db   = 'db_akun';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opsi = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $opsi);
} catch (\PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
