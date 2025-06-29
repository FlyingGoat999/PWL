<?php
$conn = new mysqli("localhost", "root", "", "db_mvc");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $nama = htmlspecialchars($_POST['nama']);
    $nim = htmlspecialchars($_POST['nim']);

    $stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, nim=? WHERE id=?");
    $stmt->bind_param("ssi", $nama, $nim, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengedit data: " . $stmt->error;
    }

    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM mahasiswa WHERE id = $id");
    $mhs = $result->fetch_assoc();
}
?>

<h2>Edit Mahasiswa</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $mhs['id'] ?>">

    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $mhs['nama'] ?>" required><br><br>

    <label>NIM:</label><br>
    <input type="text" name="nim" value="<?= $mhs['nim'] ?>" required><br><br>

    <input type="submit" value="Update">
</form>
