-- 1️⃣ Buat Database
CREATE DATABASE IF NOT EXISTS presensi_magang;
USE presensi_magang;

-- 2️⃣ Tabel Users (akun siswa & admin)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    tempat_magang VARCHAR(150),
    foto VARCHAR(255),
    role ENUM('admin','siswa') DEFAULT 'siswa'
);

-- Tambahkan akun admin utama
INSERT INTO users (nama, email, password, role)
VALUES ('Admin PKL SMKN Purwosari', 'pklsmknpurwosari@gmail.com', 'SMKNPURWOSARI', 'admin');

-- 3️⃣ Tabel Absensi
CREATE TABLE absensi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tanggal DATE NOT NULL,
    jam_masuk TIME DEFAULT NULL,
    jam_pulang TIME DEFAULT NULL,
    status ENUM('Hadir','Izin','Sakit','Alpa') DEFAULT 'Hadir',
    keterangan VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 4️⃣ Tabel Izin
CREATE TABLE izin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tanggal DATE NOT NULL,
    alasan TEXT,
    bukti VARCHAR(255),
    status ENUM('Menunggu','Disetujui','Ditolak') DEFAULT 'Menunggu',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 5️⃣ Tabel Jurnal
CREATE TABLE jurnal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tanggal DATE NOT NULL,
    kegiatan TEXT,
    kendala TEXT,
    pembelajaran TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
