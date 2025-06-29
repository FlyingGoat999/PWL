<?php 
session_start();
session_unset();
session_destroy();
setcookie('username', '', time() - 3600, '/Minggu%203');
setcookie('password', '', time() - 3600, '/Minggu%203'); 
header("Location: login.php"); 

exit(); 
?> 