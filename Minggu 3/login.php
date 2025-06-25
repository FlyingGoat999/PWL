<?php 
session_start(); 
include "koneksi.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST["username"]; 
    $password = $_POST["password"]; 

    
    if (isset($_POST["remember_me"]) && ($_POST["remember_me"] == '1' || $_POST["remember_me"] == 'on')) {
        $hour = time() + 3600 * 24 * 30; // 30 hari
        setcookie('username', $username, $hour);
        setcookie('password', $password, $hour);
    }

    
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?"); 
    $stmt->bind_param("s", $username); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if ($result->num_rows === 1) { 
        $user = $result->fetch_assoc(); 

        
        if (password_verify($password, $user["password"])) { 
            $_SESSION["user_id"] = $user["id"]; 
            $_SESSION["role"] = $user["role"]; 

            
            if ($user["role"] === "Admin") {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_user.php");
            }
            exit(); 
        } else { 
            echo "Password salah!";
        } 
    } else { 
        echo "Username tidak ditemukan!";
    } 

    $stmt->close(); 
    $conn->close(); 
} 
?>
<form method="POST"> 
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Ingat saya: <input type="checkbox" name="remember_me"><br>
    <button type="submit">Login</button> 
</form>
