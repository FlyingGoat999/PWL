<?php
session_start(); // Jika ID pengguna disimpan di session
$id_pengguna = $_SESSION['id_pengguna'] ?? 0; // Default 0 jika belum login

$target_dir = "profile_pics/";
$timestamp = date("YmdHis");
$imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));

// Buat nama file baru
$filename = $id_pengguna . "_" . $timestamp . "." . $imageFileType;
$target_file = $target_dir . $filename;

$check = getimagesize($_FILES["gambar"]["tmp_name"]);
if ($check === false) {
    echo "File bukan gambar.";
    exit;
}

$allowed = ['jpg', 'jpeg', 'png', 'gif'];
if (!in_array($imageFileType, $allowed)) {
    echo "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
    exit;
}

if ($_FILES["gambar"]["size"] > 2 * 1024 * 1024) {
    echo "Ukuran file terlalu besar.";
    exit;
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES["gambar"]["tmp_name"]);
finfo_close($finfo);
$allowed_mime = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($mime, $allowed_mime)) {
    echo "Tipe MIME tidak sesuai.";
    exit;
}

if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
    echo "File " . htmlspecialchars($filename) . " berhasil diupload.<br>";

    $thumb_path = null;
    $width = $check[0];
    $height = $check[1];

    if ($imageFileType === "jpg" || $imageFileType === "jpeg") {
        if (!function_exists('imagecreatefromjpeg')) {
            echo "Fungsi imagecreatefromjpeg tidak tersedia. Aktifkan ekstensi GD di php.ini.";
            exit;
        }

        $src = imagecreatefromjpeg($target_file);
        $new_width = 200;
        $new_height = floor($height * ($new_width / $width));
        $tmp = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        $thumb_path = $target_dir . "thumb_" . $filename;
        imagejpeg($tmp, $thumb_path, 80);
        imagedestroy($src);
        imagedestroy($tmp);

        echo "Thumbnail berhasil dibuat.<br>";
    }

    $conn = new mysqli("localhost", "root", "", "db_gambar");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $uploaded_at = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO gambar (filename, filepath, thumbpath, width, height, uploaded_at) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdds", $filename, $target_file, $thumb_path, $width, $height, $uploaded_at);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan ke database.";
    } else {
        echo "Gagal menyimpan ke database: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Gagal mengupload file.";
}
?>
