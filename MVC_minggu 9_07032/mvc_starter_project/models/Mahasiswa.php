<?php
require_once 'config.php';

class Mahasiswa {
    public function getAll() {
        global $conn;
        $sql = "SELECT * FROM mahasiswa";
        $result = $conn->query($sql);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
}
?>