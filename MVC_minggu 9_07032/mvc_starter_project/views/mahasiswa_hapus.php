<?php
$conn = new mysqli("localhost", "root", "", "db_mvc");

$stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
