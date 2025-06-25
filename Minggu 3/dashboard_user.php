<?php 
session_start(); 
if (!isset($_SESSION["user_id"])) { 
    header("Location: X"); 
    exit(); 
} 

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    echo "Welcome back, $username!";
    
} else {
    echo "Cookie 'username' not found or has expired.";
    
}
?> 
<h2>Selamat datang user di Dashboard!</h2> 
<a href="logout.php">Logout</a>