<?php include 'csrf.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulir Pendaftaran Aman</title>
    <script>
    function validasiForm() {
        const nama = document.forms["daftar"]["nama"].value;
        const email = document.forms["daftar"]["email"].value;
        if (nama == "" || email == "") {
            alert("Semua kolom wajib diisi!");
            return false;
        }
        return true;
    }
    </script>
</head>
<body>
    <h2>Formulir Pendaftaran</h2>
    <form name="daftar" method="POST" action="proses.php" onsubmit="return validasiForm();">
        <input type="hidden" name="csrf_token" value="<?php echo buatToken(); ?>">
        Nama: <input type="text" name="nama"><br><br>
        Email: <input type="email" name="email"><br><br>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
