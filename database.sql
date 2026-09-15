-- Database Structure for Laundry Management System

CREATE DATABASE IF NOT EXISTS `laundry_db`;
USE `laundry_db`;

-- Tabel Admin/User
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `nama_lengkap` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password bawaan: admin (MD5)
INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

-- Tabel Pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `telepon` VARCHAR(20) NOT NULL,
  `alamat` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Layanan Laundry
CREATE TABLE IF NOT EXISTS `layanan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` VARCHAR(100) NOT NULL,
  `harga` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `layanan` (`id`, `nama_layanan`, `harga`) VALUES
(1, 'Cuci Kering', 6000),
(2, 'Cuci Setrika', 8000),
(3, 'Express (1 Hari)', 12000);

-- Tabel Transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pelanggan_id` INT(11) NOT NULL,
  `layanan_id` INT(11) NOT NULL,
  `berat` FLOAT NOT NULL,
  `total_harga` INT(11) NOT NULL,
  `status` ENUM('Proses','Selesai','Diambil') DEFAULT 'Proses',
  `tanggal` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`layanan_id`) REFERENCES `layanan`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;