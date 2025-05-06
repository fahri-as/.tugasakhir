-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 08:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `...aku`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `criteria_id` varchar(50) NOT NULL,
  `job_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `weight` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`criteria_id`, `job_id`, `name`, `code`, `description`, `weight`, `created_at`, `updated_at`) VALUES
('1', 'JOB001', 'Keahlian Dasar Memasak', 'K1', 'Kemampuan dalam teknik dasar memasak seperti menumis, menggoreng, merebus, dll.', 0.42, '2025-05-05 02:26:29', '2025-05-05 08:11:11'),
('10', 'JOB004', 'Kemampuan Kerja Sama Tim', 'K5', 'Kemampuan bekerja sama dalam tim dapur, komunikasi, dan koordinasi dengan anggota tim lain.', 0.00, '2025-05-05 02:26:29', '2025-05-05 02:26:29'),
('2', 'JOB001', 'Kualitas Hasil Masakan', 'K2', 'Kualitas rasa, penampilan, dan tekstur dari hasil masakan yang dihasilkan.', 0.26, '2025-05-05 02:26:29', '2025-05-05 08:11:11'),
('3', 'JOB001', 'Pemahaman Kebersihan dan Keamanan', 'K3', 'Pemahaman dan implementasi standar kebersihan dan keamanan pangan dalam bekerja.', 0.16, '2025-05-05 02:26:29', '2025-05-05 08:11:11'),
('4', 'JOB001', 'Konsistensi & Ketelitian', 'K4', 'Konsistensi hasil masakan dan ketelitian dalam proses persiapan dan pemasakan.', 0.10, '2025-05-05 02:26:29', '2025-05-05 08:11:11'),
('5', 'JOB001', 'Kemampuan Kerja Sama Tim', 'K5', 'Kemampuan bekerja sama dalam tim dapur, komunikasi, dan koordinasi dengan anggota tim lain.', 0.06, '2025-05-05 02:26:29', '2025-05-05 08:11:11'),
('6', 'JOB004', 'Keahlian Dasar Pastry', 'K1', 'Kemampuan dalam teknik dasar pembuatan pastry seperti adonan, pengembangan, dekorasi, dll.', 0.00, '2025-05-05 02:26:29', '2025-05-05 02:26:29'),
('7', 'JOB004', 'Kualitas Hasil Pastry', 'K2', 'Kualitas rasa, penampilan, tekstur, dan estetika dari hasil pastry yang dihasilkan.', 0.00, '2025-05-05 02:26:29', '2025-05-05 02:26:29'),
('8', 'JOB004', 'Pemahaman Kebersihan dan Keamanan', 'K3', 'Pemahaman dan implementasi standar kebersihan dan keamanan pangan dalam bekerja.', 0.00, '2025-05-05 02:26:29', '2025-05-05 02:26:29'),
('9', 'JOB004', 'Konsistensi & Ketelitian', 'K4', 'Konsistensi hasil pastry dan ketelitian dalam proses persiapan dan pembuatan.', 0.00, '2025-05-05 02:26:29', '2025-05-05 02:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_comparisons`
--

CREATE TABLE `criteria_comparisons` (
  `comparisons_id` varchar(50) NOT NULL,
  `criteria_column_id` varchar(50) NOT NULL,
  `criteria_row_id` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_mingguan_magang`
--

CREATE TABLE `evaluasi_mingguan_magang` (
  `evaluasi_id` varchar(50) NOT NULL,
  `magang_id` varchar(50) NOT NULL,
  `rating_id` varchar(50) NOT NULL,
  `minggu_ke` int(11) NOT NULL,
  `skor_minggu` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `interview_id` varchar(50) NOT NULL,
  `pelamar_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kualifikasi_skor` int(11) DEFAULT 0,
  `komunikasi_skor` int(11) DEFAULT 0,
  `sikap_skor` int(11) DEFAULT 0,
  `total_skor` decimal(10,2) DEFAULT 0.00,
  `jadwal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`interview_id`, `pelamar_id`, `user_id`, `kualifikasi_skor`, `komunikasi_skor`, `sikap_skor`, `total_skor`, `jadwal`, `created_at`, `updated_at`) VALUES
('INT001', 'PL001', 1, 4, 4, 4, 4.00, '2025-05-01', '2025-04-20 05:00:00', '2025-05-06 11:03:27'),
('INT002', 'PL002', 2, 5, 5, 5, 5.00, '2025-05-02', '2025-04-20 05:00:00', '2025-05-06 11:03:40'),
('INT003', 'PL003', 3, 4, 3, 2, 3.00, '2025-05-03', '2025-04-20 05:00:00', '2025-05-06 11:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` varchar(50) NOT NULL,
  `nama_job` varchar(50) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `nama_job`, `deskripsi`, `created_at`, `updated_at`) VALUES
('JOB001', 'Cooks', 'Pria, usia maks. 35 tahun', '2025-04-19 22:00:00', '2025-04-19 22:00:00'),
('JOB002', 'Steward', 'Pria, usia maks. 25 tahun', '2025-04-19 22:00:00', '2025-04-19 22:00:00'),
('JOB003', 'Cook Helper', 'Pria, usia maks. 25 tahun', '2025-04-19 22:00:00', '2025-04-19 22:00:00'),
('JOB004', 'Pastry Chef', 'Pria, usia maks. 25 tahun', '2025-04-19 22:00:00', '2025-04-19 22:00:00'),
('JOB005', 'Barista', 'Pria/wanita, usia maks. 25 tahun', '2025-04-19 22:00:00', '2025-04-19 22:00:00'),
('JOB006', 'Cleaning Service', 'Pria/wanita, usia maks. 30 tahun', '2025-04-19 22:00:00', '2025-04-19 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `magang`
--

CREATE TABLE `magang` (
  `magang_id` varchar(50) NOT NULL,
  `pelamar_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_skor` decimal(10,2) DEFAULT 0.00,
  `rank` int(11) DEFAULT NULL,
  `status_seleksi` enum('Pending','Lulus','Tidak Lulus','Sedang Berjalan','Selesai') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `magang`
--

INSERT INTO `magang` (`magang_id`, `pelamar_id`, `user_id`, `total_skor`, `rank`, `status_seleksi`, `created_at`, `updated_at`) VALUES
('MAG001', 'PL001', 1, 0.00, NULL, 'Pending', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('MAG002', 'PL002', 2, 0.00, NULL, 'Pending', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('MAG003', 'PL003', 3, 0.00, NULL, 'Pending', '2025-04-20 05:00:00', '2025-04-20 12:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_05_06_180017_create_sessions_table', 1),
(2, '2025_05_06_180113_create_cache_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE `pelamar` (
  `pelamar_id` varchar(50) NOT NULL,
  `periode_id` varchar(20) DEFAULT NULL,
  `job_id` varchar(50) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nomor_wa` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `lama_pengalaman` int(11) DEFAULT NULL,
  `tempat_pengalaman` varchar(100) DEFAULT NULL,
  `deskripsi_tempat` text DEFAULT NULL,
  `berkas_cv` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`pelamar_id`, `periode_id`, `job_id`, `nama`, `email`, `nomor_wa`, `tgl_lahir`, `alamat`, `pendidikan`, `lama_pengalaman`, `tempat_pengalaman`, `deskripsi_tempat`, `berkas_cv`, `created_at`, `updated_at`) VALUES
('PL001', 'PER001', 'JOB001', 'John Doe', 'john.doe@example.com', '08123456789', '1990-01-01', 'Jakarta', 'S1', 5, 'PT. ABC', 'Pengalaman kerja di perusahaan besar.', 'cv_johndoe.pdf', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PL002', 'PER001', 'JOB002', 'Jane Smith', '  jane.smith@example.com', '08123456789', '1990-01-01', 'Jakarta', 'S1', 5, 'PT. ABC', 'Pengalaman kerja di perusahaan besar.', 'cv_janesmith.pdf', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PL003', 'PER002', 'JOB003', 'Alice Johnson', 'alice.johnson@example.com', '08123456789', '1990-01-01', 'Jakarta', 'S1', 5, 'PT. ABC', 'Pengalaman kerja di perusahaan besar.', 'cv_alicejohnson.pdf', '2025-04-20 05:00:00', '2025-04-20 12:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `periode_id` varchar(20) NOT NULL,
  `nama_periode` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `durasi_minggu_magang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`periode_id`, `nama_periode`, `tanggal_mulai`, `tanggal_selesai`, `deskripsi`, `created_at`, `updated_at`, `durasi_minggu_magang`) VALUES
('12', '12', '2025-05-07', '2025-05-29', '11', '2025-05-06 11:08:45', '2025-05-06 11:08:45', 3),
('PER001', 'Periode 1', '2025-04-20', '2025-05-20', 'Periode pertama untuk rekrutmen.', '2025-04-20 05:00:00', '2025-05-06 18:08:21', 4),
('PER002', 'Periode 2', '2025-06-01', '2025-07-01', 'Periode kedua untuk rekrutmen.', '2025-04-20 05:00:00', '2025-05-06 18:07:48', 12);

-- --------------------------------------------------------

--
-- Table structure for table `periode_job`
--

CREATE TABLE `periode_job` (
  `periode_id` varchar(20) NOT NULL,
  `job_id` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_job`
--

INSERT INTO `periode_job` (`periode_id`, `job_id`, `created_at`, `updated_at`) VALUES
('12', 'JOB001', '2025-05-06 11:08:45', '2025-05-06 11:08:45'),
('12', 'JOB002', '2025-05-06 11:08:45', '2025-05-06 11:08:45'),
('12', 'JOB003', '2025-05-06 11:08:45', '2025-05-06 11:08:45'),
('12', 'JOB004', '2025-05-06 11:08:45', '2025-05-06 11:08:45'),
('PER001', 'JOB001', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PER001', 'JOB002', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PER002', 'JOB003', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PER002', 'JOB004', '2025-04-20 05:00:00', '2025-04-20 12:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `rating_scales`
--

CREATE TABLE `rating_scales` (
  `rating_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `singkatan` varchar(50) DEFAULT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_scales`
--

INSERT INTO `rating_scales` (`rating_id`, `name`, `singkatan`, `value`, `created_at`, `updated_at`) VALUES
('1', 'Sangat Buruk', 'SBR', 10, '2025-05-05 02:26:29', '2025-05-05 02:26:29'),
('2', 'Buruk', 'BR', 20, '2025-05-05 02:26:29', '2025-05-05 02:26:29'),
('3', 'Cukup', 'C', 30, '2025-05-05 02:26:29', '2025-05-05 02:26:29'),
('4', 'Baik', 'B', 40, '2025-05-05 02:26:30', '2025-05-05 02:26:30'),
('5', 'Sangat Baik', 'SB', 50, '2025-05-05 02:26:30', '2025-05-05 02:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Z5PwE5afhPwqxatdHnLZkfTQ4tPwxWde8mXS5a6v', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVHA1WlVFT3NodUhlM3NweXdWeTFROVdheGY4RGQ0eEFxUW9XbVBMcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXJpb2RlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1746555092);

-- --------------------------------------------------------

--
-- Table structure for table `tes_kemampuan`
--

CREATE TABLE `tes_kemampuan` (
  `tes_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pelamar_id` varchar(50) NOT NULL,
  `catatan` text DEFAULT NULL,
  `jadwal` date DEFAULT NULL,
  `skor` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_kemampuan`
--

INSERT INTO `tes_kemampuan` (`tes_id`, `user_id`, `pelamar_id`, `catatan`, `jadwal`, `skor`, `created_at`, `updated_at`) VALUES
('TES001', 1, 'PL001', 'Tes kemampuan memasak dasar.', '2025-05-10', 85, '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('TES002', 2, 'PL002', 'Tes kemampuan memasak dasar.', '2025-05-11', 80, '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('TES003', 3, 'PL003', 'Tes kemampuan memasak dasar.', '2025-05-12', 75, '2025-04-20 05:00:00', '2025-04-20 12:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'jiwaraga', '$2y$12$WIVHFZyu8TJYnMWSJo/3Z..t0IIyAbbk4mZ8daCy9SVKcmk9C3z5C', 'jiwaraga@perusahaan.com', 'hr', '2025-04-20 05:00:00', '2025-04-21 12:00:34'),
(2, 'cook', '$2y$12$3EqqNgvpwx.97vgLhkv3Q.jxLjCgYKxm2hLhY6pqQE7ZimrS5e0/u', 'cook@perusahaan.com', 'cook', '2025-04-20 05:00:00', '2025-04-21 12:00:34'),
(3, 'pastry', '$2y$12$CmjDs5.XIqyWOBo77busku86IE74V1Eg4Jn5TBlADww77Q71QU./m', 'pastry@perusahaan.com', 'pastry', '2025-04-20 05:00:00', '2025-04-21 12:00:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`criteria_id`),
  ADD KEY `IDX_Criteria_Job` (`job_id`);

--
-- Indexes for table `criteria_comparisons`
--
ALTER TABLE `criteria_comparisons`
  ADD PRIMARY KEY (`comparisons_id`),
  ADD KEY `FK_Criteria_Comparisons_Criteria_Col` (`criteria_column_id`),
  ADD KEY `FK_Criteria_Comparisons_Criteria_Row` (`criteria_row_id`);

--
-- Indexes for table `evaluasi_mingguan_magang`
--
ALTER TABLE `evaluasi_mingguan_magang`
  ADD PRIMARY KEY (`evaluasi_id`),
  ADD UNIQUE KEY `UK_Evaluasi_Mingguan` (`magang_id`,`minggu_ke`),
  ADD KEY `FK_Evaluasi_Mingguan_Magang_Rating_Scales` (`rating_id`),
  ADD KEY `IDX_Evaluasi_Mingguan_Magang_Minggu` (`magang_id`,`minggu_ke`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`interview_id`),
  ADD KEY `FK_Interview_Pelamar` (`pelamar_id`),
  ADD KEY `FK_Interview_User` (`user_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `magang`
--
ALTER TABLE `magang`
  ADD PRIMARY KEY (`magang_id`),
  ADD KEY `FK_Magang_Pelamar` (`pelamar_id`),
  ADD KEY `FK_Magang_User` (`user_id`),
  ADD KEY `IDX_Magang_Status_Seleksi` (`status_seleksi`),
  ADD KEY `IDX_Magang_Total_Skor` (`total_skor`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`pelamar_id`),
  ADD UNIQUE KEY `UK_Pelamar_Email` (`email`),
  ADD KEY `IDX_Pelamar_Periode` (`periode_id`),
  ADD KEY `IDX_Pelamar_Job` (`job_id`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`periode_id`);

--
-- Indexes for table `periode_job`
--
ALTER TABLE `periode_job`
  ADD PRIMARY KEY (`periode_id`,`job_id`),
  ADD KEY `FK_Periode_Job_Job` (`job_id`);

--
-- Indexes for table `rating_scales`
--
ALTER TABLE `rating_scales`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tes_kemampuan`
--
ALTER TABLE `tes_kemampuan`
  ADD PRIMARY KEY (`tes_id`),
  ADD KEY `FK_Tes_kemampuan_Pelamar` (`pelamar_id`),
  ADD KEY `FK_Tes_kemampuan_User` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UK_User_username` (`username`),
  ADD UNIQUE KEY `UK_User_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criteria`
--
ALTER TABLE `criteria`
  ADD CONSTRAINT `FK_Criteria_Job` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `criteria_comparisons`
--
ALTER TABLE `criteria_comparisons`
  ADD CONSTRAINT `FK_Criteria_Comparisons_Criteria_Col` FOREIGN KEY (`criteria_column_id`) REFERENCES `criteria` (`criteria_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Criteria_Comparisons_Criteria_Row` FOREIGN KEY (`criteria_row_id`) REFERENCES `criteria` (`criteria_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluasi_mingguan_magang`
--
ALTER TABLE `evaluasi_mingguan_magang`
  ADD CONSTRAINT `FK_Evaluasi_Mingguan_Magang_Magang` FOREIGN KEY (`magang_id`) REFERENCES `magang` (`magang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Evaluasi_Mingguan_Magang_Rating_Scales` FOREIGN KEY (`rating_id`) REFERENCES `rating_scales` (`rating_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interview`
--
ALTER TABLE `interview`
  ADD CONSTRAINT `FK_Interview_Pelamar` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`pelamar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Interview_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `magang`
--
ALTER TABLE `magang`
  ADD CONSTRAINT `FK_Magang_Pelamar` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`pelamar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Magang_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD CONSTRAINT `FK_Pelamar_Job` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Pelamar_Periode` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `periode_job`
--
ALTER TABLE `periode_job`
  ADD CONSTRAINT `FK_Periode_Job_Job` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Periode_Job_Periode` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tes_kemampuan`
--
ALTER TABLE `tes_kemampuan`
  ADD CONSTRAINT `FK_Tes_kemampuan_Pelamar` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`pelamar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Tes_kemampuan_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
