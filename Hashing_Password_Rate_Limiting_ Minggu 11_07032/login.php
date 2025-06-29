<?php 
session_start(); 
include "config.php"; 

// Rate limit: maksimal 5 percobaan gagal per 15 menit
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

// reset counter jika sudah lewat 15 menit
if (time() - $_SESSION['last_attempt_time'] > 900) { 
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if ($_SESSION['login_attempts'] >= 5) {
        echo "Terlalu banyak percobaan login gagal. Silakan coba lagi setelah 15 menit.";
        exit();
    }

    $username = $_POST["username"]; 
    $password = $_POST["password"]; 

    // hanya simpan username di cookie
    if (isset($_POST["remember_me"]) && ($_POST["remember_me"] == '1' || $_POST["remember_me"] == 'on')) {
        $hour = time() + 3600 * 24 * 30; 
        setcookie('username', $username, $hour, "", "", false, true); 
    }

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?"); 
    $stmt->bind_param("s", $username); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if ($result->num_rows === 1) { 
        $user = $result->fetch_assoc(); 

        if (password_verify($password, $user["password"])) { 
            $_SESSION["user_id"] = $user["id"]; 

            $_SESSION['login_attempts'] = 0; // reset hitung percobaan
            header("Location: dashboard.php");
            exit(); 
        } else { 
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();
            echo "Username atau password salah!";
        } 
    } else { 
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = time();
        echo "Username atau password salah!";
    } 

    $stmt->close(); 
    $conn->close(); 
} 
?>
<form method="POST"> 
    Username: <input type="text" name="username" value="<?php echo isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '' ?>" required><br>
    Password: <input type="password" name="password" required><br>
    Ingat saya: <input type="checkbox" name="remember_me"><br>
    <button type="submit">Login</button> 
</form>
