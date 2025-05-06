-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 09:26 PM
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
-- Database: `1benar`
--

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_mingguan_magang`
--

CREATE TABLE `evaluasi_mingguan_magang` (
  `evaluasi_id` varchar(50) NOT NULL,
  `magang_id` varchar(50) DEFAULT NULL,
  `pelamar_id` varchar(50) DEFAULT NULL,
  `minggu_ke` int(11) DEFAULT NULL,
  `kriteria1` int(11) DEFAULT NULL,
  `kriteria2` int(11) DEFAULT NULL,
  `kriteria3` int(11) DEFAULT NULL,
  `kriteria4` int(11) DEFAULT NULL,
  `kriteria5` int(11) DEFAULT NULL,
  `skor_minggu` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluasi_mingguan_magang`
--

INSERT INTO `evaluasi_mingguan_magang` (`evaluasi_id`, `magang_id`, `pelamar_id`, `minggu_ke`, `kriteria1`, `kriteria2`, `kriteria3`, `kriteria4`, `kriteria5`, `skor_minggu`, `created_at`, `updated_at`) VALUES
('EVAL001', 'MG001', 'PL001', 1, 4, 4, 4, 4, 4, 4.00, '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
('EVAL002', 'MG001', 'PL001', 2, 4, 5, 4, 5, 5, 4.60, '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
('EVAL003', 'MG002', 'PL002', 1, 3, 4, 4, 3, 4, 3.60, '2025-04-20 12:00:00', '2025-04-20 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `interview_id` varchar(50) NOT NULL,
  `pelamar_id` varchar(50) DEFAULT NULL,
  `kualifikasi_skor` int(11) DEFAULT NULL,
  `komunikasi_skor` int(11) DEFAULT NULL,
  `sikap_skor` int(11) DEFAULT NULL,
  `total_skor` decimal(10,2) DEFAULT NULL,
  `jadwal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`interview_id`, `pelamar_id`, `kualifikasi_skor`, `komunikasi_skor`, `sikap_skor`, `total_skor`, `jadwal`, `created_at`, `updated_at`) VALUES
('INT001', 'PL001', 4, 4, 5, 4.33, '2023-05-15', '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
('INT002', 'PL002', 3, 5, 4, 4.00, '2023-05-15', '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
('INT003', 'PL003', 5, 4, 5, 4.67, '2023-05-16', '2025-04-20 12:00:00', '2025-04-20 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` varchar(50) NOT NULL,
  `nama_job` varchar(50) NOT NULL,
  `deskripsi` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `nama_job`, `deskripsi`, `created_at`, `updated_at`) VALUES
('JOB001', 'Cooks', 'Pria, usia maks. 35 tahun', '2025-04-20 05:00:00', '2025-04-20 05:00:00'),
('JOB002', 'Steward', 'Pria, usia maks. 25 tahun', '2025-04-20 05:00:00', '2025-04-20 05:00:00'),
('JOB003', 'Cook Helper', 'Pria, usia maks. 25 tahun', '2025-04-20 05:00:00', '2025-04-20 05:00:00'),
('JOB004', 'Pastry Chef', 'Pria, usia maks. 25 tahun', '2025-04-20 05:00:00', '2025-04-20 05:00:00'),
('JOB005', 'Barista', 'Pria/wanita, usia maks. 25 tahun', '2025-04-20 05:00:00', '2025-04-20 05:00:00'),
('JOB006', 'Cleaning Service', 'Pria/wanita, usia maks. 30 tahun', '2025-04-20 05:00:00', '2025-04-20 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `magang`
--

CREATE TABLE `magang` (
  `magang_id` varchar(50) NOT NULL,
  `pelamar_id` varchar(50) DEFAULT NULL,
  `total_skor` decimal(10,2) DEFAULT NULL,
  `status_seleksi` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `magang`
--

INSERT INTO `magang` (`magang_id`, `pelamar_id`, `total_skor`, `status_seleksi`, `created_at`, `updated_at`) VALUES
('MG001', 'PL001', 4.40, 'accepted', '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
('MG002', 'PL002', 3.60, 'accepted', '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
('MG003', 'PL003', 4.80, 'accepted', '2025-04-20 12:00:00', '2025-04-20 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE `pelamar` (
  `pelamar_id` varchar(50) NOT NULL,
  `periode_id` varchar(20) DEFAULT NULL,
  `job_id` varchar(50) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_wa` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `lama_pengalaman` int(11) DEFAULT NULL,
  `tempat_pengalaman` int(11) DEFAULT NULL,
  `deskripsi_tempat` text DEFAULT NULL,
  `cv_gdrive_id` varchar(50) DEFAULT NULL,
  `cv_gdrive_link` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`pelamar_id`, `periode_id`, `job_id`, `nama`, `email`, `nomor_wa`, `tgl_lahir`, `alamat`, `pendidikan`, `lama_pengalaman`, `tempat_pengalaman`, `deskripsi_tempat`, `cv_gdrive_id`, `cv_gdrive_link`, `created_at`, `updated_at`) VALUES
('PL001', 'PER001', 'JOB001', 'Budi Santoso', 'budi@email.com', '2147483647', '1995-05-15', 'Jakarta Selatan', 'S1 Teknik Informatika', 3, 2, 'Bekerja di perusahaan teknologi sebagai programmer', 'gdrive001', 'drive.google.com/cv_budi', '2025-04-20 12:00:00', '2025-04-20 19:25:02'),
('PL002', 'PER001', 'JOB002', 'Ani Wijaya', 'ani@email.com', '2147483647', '1997-08-21', 'Bandung', 'S1 Manajemen', 2, 1, 'Bekerja di perusahaan retail sebagai staff marketing', 'gdrive002', 'drive.google.com/cv_ani', '2025-04-20 12:00:00', '2025-04-20 19:25:02'),
('PL003', 'PER002', 'JOB004', 'Citra Dewi', 'citra@email.com', '2147483647', '1996-02-10', 'Surabaya', 'S1 Akuntansi', 4, 2, 'Bekerja di firma akuntan dan perusahaan manufaktur', 'gdrive003', 'drive.google.com/cv_citra', '2025-04-20 12:00:00', '2025-04-20 19:25:02');

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
  `durasi_minggu_magang` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`periode_id`, `nama_periode`, `tanggal_mulai`, `tanggal_selesai`, `deskripsi`, `durasi_minggu_magang`, `created_at`, `updated_at`) VALUES
('PER001', 'Periode Rekrutmen Q2 2025', '2025-04-01', '2025-06-30', 'Rekrutmen untuk posisi Web Developer Q2', 12, '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
('PER002', 'Periode Rekrutmen Q2 2025', '2025-04-01', '2025-06-30', 'Rekrutmen untuk posisi UI/UX Designer Q2', 8, '2025-04-20 12:00:00', '2025-04-20 12:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `periode_job`
--

CREATE TABLE `periode_job` (
  `periode_job_id` varchar(50) NOT NULL,
  `periode_id` varchar(20) NOT NULL,
  `job_id` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_job`
--

INSERT INTO `periode_job` (`periode_job_id`, `periode_id`, `job_id`, `created_at`, `updated_at`) VALUES
('PJ001', 'PER001', 'JOB001', '2025-04-20 19:25:02', '2025-04-20 19:25:02'),
('PJ002', 'PER002', 'JOB004', '2025-04-20 19:25:02', '2025-04-20 19:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `tes_kemampuan`
--

CREATE TABLE `tes_kemampuan` (
  `tes_id` varchar(50) NOT NULL,
  `pelamar_id` varchar(50) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `jadwal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_kemampuan`
--

INSERT INTO `tes_kemampuan` (`tes_id`, `pelamar_id`, `skor`, `catatan`, `jadwal`, `created_at`, `updated_at`) VALUES
('TS001', 'PL001', 85, 'Memiliki kemampuan logika dan problem solving yang baik', '2023-05-10', '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
('TS002', 'PL002', 78, 'Kemampuan analisis cukup baik namun perlu ditingkatkan', '2023-05-10', '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
('TS003', 'PL003', 90, 'Sangat baik dalam analisis data dan pemecahan masalah', '2023-05-11', '2025-04-20 12:00:00', '2025-04-20 12:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'jiwaraga', 'jiwaraga123', 'jiwaraga@perusahaan.com', 'hr', '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
(2, 'cook', 'cook123', 'cook@perusahaan.com', 'cook', '2025-04-20 12:00:00', '2025-04-20 12:00:00'),
(3, 'pastry', 'pastry123', 'pastry@perusahaan.com', 'pastry', '2025-04-20 12:00:00', '2025-04-20 12:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluasi_mingguan_magang`
--
ALTER TABLE `evaluasi_mingguan_magang`
  ADD PRIMARY KEY (`evaluasi_id`),
  ADD UNIQUE KEY `uq_evaluasi_mingguan` (`magang_id`,`minggu_ke`),
  ADD KEY `magang_id` (`magang_id`),
  ADD KEY `pelamar_id` (`pelamar_id`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`interview_id`),
  ADD KEY `pelamar_id` (`pelamar_id`);

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
  ADD KEY `pelamar_id` (`pelamar_id`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`pelamar_id`),
  ADD KEY `periode_id` (`periode_id`),
  ADD KEY `pelamar_ibfk_2` (`job_id`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`periode_id`);

--
-- Indexes for table `periode_job`
--
ALTER TABLE `periode_job`
  ADD PRIMARY KEY (`periode_job_id`),
  ADD KEY `periode_id` (`periode_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `tes_kemampuan`
--
ALTER TABLE `tes_kemampuan`
  ADD PRIMARY KEY (`tes_id`),
  ADD KEY `pelamar_id` (`pelamar_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluasi_mingguan_magang`
--
ALTER TABLE `evaluasi_mingguan_magang`
  ADD CONSTRAINT `evaluasi_mingguan_magang_ibfk_1` FOREIGN KEY (`magang_id`) REFERENCES `magang` (`magang_id`),
  ADD CONSTRAINT `evaluasi_mingguan_magang_ibfk_2` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`pelamar_id`);

--
-- Constraints for table `interview`
--
ALTER TABLE `interview`
  ADD CONSTRAINT `interview_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`pelamar_id`);

--
-- Constraints for table `magang`
--
ALTER TABLE `magang`
  ADD CONSTRAINT `magang_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`pelamar_id`);

--
-- Constraints for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD CONSTRAINT `pelamar_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`),
  ADD CONSTRAINT `pelamar_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`);

--
-- Constraints for table `periode_job`
--
ALTER TABLE `periode_job`
  ADD CONSTRAINT `periode_job_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`),
  ADD CONSTRAINT `periode_job_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`);

--
-- Constraints for table `tes_kemampuan`
--
ALTER TABLE `tes_kemampuan`
  ADD CONSTRAINT `tes_kemampuan_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`pelamar_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
