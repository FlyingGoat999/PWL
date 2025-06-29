<?php
require_once 'models/Mahasiswa.php';

class MahasiswaController {
    public function index() {
        $model = new Mahasiswa();
        $data = $model->getAll();
        require 'views/mahasiswa_list.php';
    }
}
?>