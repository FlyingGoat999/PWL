CREATE TABLE IF NOT EXISTS mahasiswa (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nim VARCHAR(15) NOT NULL,
 nama VARCHAR(100) NOT NULL,
 jurusan VARCHAR(100)
);
INSERT INTO mahasiswa (nim, nama, jurusan) VALUES
('23001', 'Budi Santoso', 'Teknik Informatika'),
('23002', 'Dewi Anggraini', 'Sistem Informasi'),
('23003', 'Adi Wijaya', 'Teknik Komputer'),
('23004', 'Putri Lestari', 'Manajemen'),
('23005', 'Rizky Hidayat', 'Sistem Informasi');