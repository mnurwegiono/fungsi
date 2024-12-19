-- Membuat database
CREATE DATABASE db_mahasiswa;

-- Menggunakan database
USE db_mahasiswa;

-- Membuat tabel mahasiswa
CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    jurusan VARCHAR(50),
    tahun_ajaran INT,
    nilai DECIMAL(5,2),
    tanggal_daftar DATE
);

-- Menambahkan beberapa data mahasiswa ke dalam tabel
INSERT INTO mahasiswa (nama, jurusan, tahun_ajaran, nilai, tanggal_daftar)
VALUES 
    ('Andi', 'Teknik Informatika', 2021, 85.5, '2021-08-01'),
    ('Budi', 'Sistem Informasi', 2021, 90.0, '2021-08-02'),
    ('Citra', 'Teknik Informatika', 2021, 78.5, '2021-08-03'),
    ('Dedi', 'Sistem Informasi', 2021, 88.0, '2021-08-04'),
    ('Eka', 'Teknik Informatika', 2022, 92.0, '2022-09-01'),
    ('Fani', 'Sistem Informasi', 2022, 79.5, '2022-09-02');
