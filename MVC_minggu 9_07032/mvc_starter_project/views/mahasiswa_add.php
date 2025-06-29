<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "db_mvc");

    $nama = htmlspecialchars($_POST['nama']);
    $nim = htmlspecialchars($_POST['nim']);

    $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, nim) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $nim);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirect setelah tambah
        exit;
    } else {
        echo "Gagal menambahkan data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<h2>Tambah Mahasiswa</h2>
<form method="POST" action="">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>NIM:</label><br>
    <input type="text" name="nim" required><br><br>

    <input type="submit" value="Simpan">
</form>
