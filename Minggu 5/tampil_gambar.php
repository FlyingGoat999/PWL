<h2>Dashboard Gambar</h2> 
<?php 
$conn = new mysqli("localhost", "root", "", "db_gambar"); 
$result = $conn->query("SELECT * FROM gambar"); 
while ($row = $result->fetch_assoc()) { 
echo "<img src='" . $row['filepath'] . "' width='150'><br>"; 
} 
?>