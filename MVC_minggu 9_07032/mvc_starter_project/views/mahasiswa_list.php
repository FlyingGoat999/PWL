<?php
$conn = new mysqli("localhost", "root", "", "db_mvc");

// Proses hapus jika ada parameter ?delete=
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    include 'mahasiswa_hapus.php';
}

// Ambil semua data mahasiswa
$result = $conn->query("SELECT * FROM mahasiswa");
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($data as $mhs): ?>
        <tr>
            <td><?= $mhs['id']; ?></td>
            <td><?= $mhs['nama']; ?></td>
            <td><?= $mhs['nim']; ?></td>
            <td>
                <a href="?edit=<?= $mhs['id'] ?>">Edit</a> |
                <a href="?delete=<?= $mhs['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <hr>

    <?php
    // Menampilkan form edit atau tambah
    if (isset($_GET['edit'])) {
        $id = (int)$_GET['edit'];
        include 'mahasiswa_edit.php';
    } else {
        include 'mahasiswa_add.php';
    }

    $conn->close();
    ?>
</body>
</html>
