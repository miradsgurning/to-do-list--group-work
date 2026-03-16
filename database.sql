-- Proyek UAS - Elite Squad To-Do List
-- File ini digunakan untuk membuat struktur tabel di phpMyAdmin

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- 1. Buat tabel `tasks`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 2. Masukkan data awal (agar aplikasi tidak kosong saat dibuka)
-- --------------------------------------------------------

INSERT INTO `tasks` (`title`, `description`, `status`, `created_at`, `updated_at`) VALUES
('Instalasi CodeIgniter 4', 'Setup environment dan server lokal menggunakan XAMPP.', 'completed', NOW(), NOW()),
('Desain Antarmuka Kelompok', 'Membuat tampilan header gradien dan daftar anggota Elite Squad.', 'completed', NOW(), NOW()),
('Laporan Akhir UAS', 'Mengumpulkan file proyek dalam format ZIP ke dosen.', 'pending', NOW(), NOW());

COMMIT;