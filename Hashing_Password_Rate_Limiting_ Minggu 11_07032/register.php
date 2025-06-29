<?php 
include "config.php"; 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST["username"]; 
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);  


    
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)"); 
    $stmt->bind_param("ss", $username, $password);

    
    if ($stmt->execute()) { 
        echo "Registrasi berhasil!"; 
    } else { 
        echo "Gagal mendaftar: " . $stmt->error; 
    }

    $stmt->close(); 
    $conn->close(); 
} 
?> 

<form method="POST"> 
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Daftar</button> 
</form>
