-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 11:35 PM
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
-- Database: `...jiwaraga`
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_smart_details_MAG001', 'a:3:{s:7:\"details\";a:4:{i:1;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:4;s:16:\"normalized_value\";d:0.75;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.07394999999999999;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:2;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:3;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:4;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:3;s:16:\"normalized_value\";d:0.5;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.1309;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:2;s:16:\"normalized_value\";d:0.25;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.04025;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:3;s:16:\"normalized_value\";d:0.5;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0493;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}}s:5:\"ranks\";a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}s:9:\"timestamp\";i:1748347438;}', 1748433838),
('laravel_cache_smart_details_MAG003', 'a:3:{s:7:\"details\";a:4:{i:1;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:2;a:0:{}i:3;a:0:{}i:4;a:0:{}}s:5:\"ranks\";a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}s:9:\"timestamp\";i:1748237231;}', 1748323631),
('laravel_cache_smart_details_MAG004', 'a:3:{s:7:\"details\";a:4:{i:1;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:2:\"10\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"6\";s:13:\"criteria_name\";s:21:\"Keahlian Dasar Pastry\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"7\";s:13:\"criteria_name\";s:21:\"Kualitas Hasil Pastry\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"8\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"9\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:2;a:0:{}i:3;a:0:{}i:4;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:2:\"10\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"6\";s:13:\"criteria_name\";s:21:\"Keahlian Dasar Pastry\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"7\";s:13:\"criteria_name\";s:21:\"Kualitas Hasil Pastry\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"8\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"9\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}}s:5:\"ranks\";a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}s:9:\"timestamp\";i:1748881582;}', 1748967982),
('laravel_cache_smart_details_MAG005', 'a:3:{s:7:\"details\";a:4:{i:1;a:0:{}i:2;a:0:{}i:3;a:0:{}i:4;a:0:{}}s:5:\"ranks\";a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}s:9:\"timestamp\";i:1748881582;}', 1748967982);

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
  `weight` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`criteria_id`, `job_id`, `name`, `code`, `description`, `weight`, `created_at`, `updated_at`) VALUES
('1', 'JOB001', 'Keahlian Dasar Memasak', 'K1', 'Kemampuan dalam teknik dasar memasak seperti menumis, menggoreng, merebus, dll.', 0.4162, '2025-05-05 02:26:29', '2025-05-25 12:41:42'),
('10', 'JOB004', 'Kemampuan Kerja Sama Tim', 'K5', 'Kemampuan bekerja sama dalam tim dapur, komunikasi, dan koordinasi dengan anggota tim lain.', 0.0624, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('2', 'JOB001', 'Kualitas Hasil Masakan', 'K2', 'Kualitas rasa, penampilan, dan tekstur dari hasil masakan yang dihasilkan.', 0.2618, '2025-05-05 02:26:29', '2025-05-25 12:41:42'),
('3', 'JOB001', 'Pemahaman Kebersihan dan Keamanan', 'K3', 'Pemahaman dan implementasi standar kebersihan dan keamanan pangan dalam bekerja.', 0.1610, '2025-05-05 02:26:29', '2025-05-25 12:41:42'),
('4', 'JOB001', 'Konsistensi & Ketelitian', 'K4', 'Konsistensi hasil masakan dan ketelitian dalam proses persiapan dan pemasakan.', 0.0986, '2025-05-05 02:26:29', '2025-05-25 12:41:42'),
('5', 'JOB001', 'Kemampuan Kerja Sama Tim', 'K5', 'Kemampuan bekerja sama dalam tim dapur, komunikasi, dan koordinasi dengan anggota tim lain.', 0.0624, '2025-05-05 02:26:29', '2025-05-25 12:41:42'),
('6', 'JOB004', 'Keahlian Dasar Pastry', 'K1', 'Kemampuan dalam teknik dasar pembuatan pastry seperti adonan, pengembangan, dekorasi, dll.', 0.4162, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('7', 'JOB004', 'Kualitas Hasil Pastry', 'K2', 'Kualitas rasa, penampilan, tekstur, dan estetika dari hasil pastry yang dihasilkan.', 0.2618, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('8', 'JOB004', 'Pemahaman Kebersihan dan Keamanan', 'K3', 'Pemahaman dan implementasi standar kebersihan dan keamanan pangan dalam bekerja.', 0.1610, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('9', 'JOB004', 'Konsistensi & Ketelitian', 'K4', 'Konsistensi hasil pastry dan ketelitian dalam proses persiapan dan pembuatan.', 0.0986, '2025-05-05 02:26:29', '2025-05-12 18:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_comparisons`
--

CREATE TABLE `criteria_comparisons` (
  `comparisons_id` varchar(50) NOT NULL,
  `criteria_column_id` varchar(50) NOT NULL,
  `criteria_row_id` varchar(50) NOT NULL,
  `value` decimal(10,4) NOT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria_comparisons`
--

INSERT INTO `criteria_comparisons` (`comparisons_id`, `criteria_column_id`, `criteria_row_id`, `value`, `created_at`, `updated_at`) VALUES
('3a56eb6a-6b80-4c94-b4d2-0bdcd9c3e5ed', '5', '1', 5.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('554b593d-78e2-419f-9415-53940750ac29', '2', '4', 0.3333, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('6997428c-fd2d-463d-9a70-1d7292c54a71', '1', '2', 0.5000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('6f1bb58b-381c-454d-b730-9b651c193b88', '1', '4', 0.2500, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('7d7ecf03-4fa4-40e8-a867-4a6e3d826444', '2', '3', 0.5000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('865ad073-f47f-48cd-a331-480e9cfd1ad2', '2', '1', 2.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('8dbb1f80-f3a1-4021-b054-3f5559290659', '5', '4', 2.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('9431b805-b3a1-458b-bbe0-db99c91d68aa', '2', '5', 0.2500, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('97870b09-c221-4f7c-bcc3-41d14a3f4885', '4', '5', 0.5000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('a069e94b-4c84-4a27-9d76-11039a626d38', '3', '4', 0.5000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('aa9a514f-672a-474c-82e1-88d77f61201f', '4', '1', 4.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('b73a2b01-b11c-4b61-8b9d-ffbfd3f55b70', '5', '3', 3.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('be205c8d-9676-4ea9-a3ee-964b62ba1ab6', '3', '1', 3.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('c7db506b-0360-4135-8a2a-d9a2aeec72d1', '5', '2', 4.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('e37bd9b9-c36e-41d8-9334-588262647646', '4', '3', 2.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('e65728f1-9e8c-46ef-ab63-f969259f5031', '1', '5', 0.2000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('e7a46384-c8f4-427a-9140-426870ef03de', '1', '3', 0.3333, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('eb360e01-242e-4265-8c57-b4d40644b9c1', '3', '2', 2.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('f7502e46-046b-4965-9e62-401aee9cda5b', '4', '2', 3.0000, '2025-05-25 19:41:42', '2025-05-25 12:41:42'),
('ffc3da92-5307-4ebf-b598-d352ec844b47', '3', '5', 0.3333, '2025-05-25 19:41:42', '2025-05-25 12:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_rating_scales`
--

CREATE TABLE `criteria_rating_scales` (
  `id` varchar(50) NOT NULL,
  `criteria_id` varchar(50) NOT NULL,
  `rating_level` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria_rating_scales`
--

INSERT INTO `criteria_rating_scales` (`id`, `criteria_id`, `rating_level`, `name`, `description`, `created_at`, `updated_at`) VALUES
('CRS0101', '1', 1, 'Sangat Kurang Terampil', 'Peserta tidak mampu menunjukkan keterampilan dasar memasak. Tidak memahami teknik dasar seperti menumis, merebus, atau menggoreng. Tidak mampu menggunakan alat dapur dengan benar.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0102', '1', 2, 'Kurang Terampil', 'Peserta menunjukkan pemahaman minimal tentang teknik dasar memasak. Masih sering melakukan kesalahan dalam penggunaan alat dan metode memasak. Membutuhkan pengawasan konstan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0103', '1', 3, 'Cukup Terampil', 'Peserta dapat melakukan teknik dasar memasak dengan pengawasan minimal. Mampu menggunakan alat dapur dengan benar namun terkadang kurang efisien. Memahami perbedaan metode memasak.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0104', '1', 4, 'Terampil', 'Peserta menunjukkan kemampuan yang baik dalam teknik dasar memasak. Mampu menggunakan berbagai metode memasak dengan tepat. Efisien dalam penggunaan alat dapur dan dapat bekerja mandiri.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0105', '1', 5, 'Sangat Terampil', 'Peserta menunjukkan keahlian luar biasa dalam teknik dasar memasak. Mampu menerapkan berbagai metode memasak dengan presisi tinggi. Sangat efisien dalam penggunaan alat dan dapat mengadaptasi teknik sesuai kebutuhan. Mampu mengajarkan keterampilan dasar kepada orang lain.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0201', '2', 1, 'Sangat Kurang Memuaskan', 'Hasil masakan tidak memenuhi standar dasar. Rasa, tekstur, dan penampilan sangat di bawah standar. Tidak dapat disajikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0202', '2', 2, 'Kurang Memuaskan', 'Hasil masakan memiliki beberapa kekurangan dalam rasa, tekstur, atau penampilan. Memerlukan perbaikan signifikan sebelum dapat disajikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0203', '2', 3, 'Cukup Memuaskan', 'Hasil masakan memenuhi standar minimal. Rasa, tekstur, dan penampilan cukup baik meskipun masih ada ruang untuk perbaikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0204', '2', 4, 'Memuaskan', 'Hasil masakan memiliki rasa, tekstur, dan penampilan yang baik. Konsisten dalam kualitas dan memenuhi standar yang diharapkan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0205', '2', 5, 'Sangat Memuaskan', 'Hasil masakan menunjukkan keunggulan dalam rasa, tekstur, dan penampilan. Sangat konsisten, sempurna dalam penyajian, dan mendekati standar profesional.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0301', '3', 1, 'Sangat Kurang Paham', 'Peserta tidak menunjukkan kesadaran akan kebersihan dan keamanan dapur. Sering melanggar protokol dasar kebersihan dan keamanan. Membahayakan diri sendiri dan orang lain.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0302', '3', 2, 'Kurang Paham', 'Peserta menunjukkan pemahaman minimal tentang kebersihan dan keamanan. Masih perlu diingatkan tentang protokol dasar. Terkadang tidak konsisten dalam penerapan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0303', '3', 3, 'Cukup Paham', 'Peserta memahami prinsip dasar kebersihan dan keamanan. Menerapkan protokol standar tetapi kadang membutuhkan pengawasan untuk konsistensi.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0304', '3', 4, 'Paham', 'Peserta menunjukkan pemahaman yang baik tentang kebersihan dan keamanan. Secara konsisten menerapkan protokol dan mampu mengidentifikasi potensi bahaya.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0305', '3', 5, 'Sangat Paham', 'Peserta menunjukkan pemahaman yang mendalam tentang kebersihan dan keamanan. Selalu menerapkan protokol dengan ketat, proaktif dalam mencegah risiko, dan mampu mengedukasi orang lain tentang praktik terbaik.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0401', '4', 1, 'Sangat Tidak Konsisten', 'Peserta menunjukkan tingkat inkonsistensi yang tinggi dalam kualitas dan hasil kerja. Sering tidak teliti dan melakukan kesalahan dasar. Membutuhkan pengawasan konstan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0402', '4', 2, 'Tidak Konsisten', 'Peserta terkadang konsisten tetapi masih sering melakukan kesalahan. Ketelitian masih rendah dan membutuhkan perbaikan signifikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0403', '4', 3, 'Cukup Konsisten', 'Peserta menunjukkan tingkat konsistensi dan ketelitian yang cukup. Masih ada beberapa kesalahan tetapi secara umum dapat diandalkan dengan pengawasan minimal.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0404', '4', 4, 'Konsisten', 'Peserta konsisten dalam menghasilkan kualitas yang baik. Teliti dalam sebagian besar aspek pekerjaan dan jarang melakukan kesalahan signifikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0405', '4', 5, 'Sangat Konsisten', 'Peserta menunjukkan konsistensi dan ketelitian luar biasa. Sangat memperhatikan detail, jarang melakukan kesalahan, dan mampu menjaga standar kualitas tinggi secara konsisten.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0501', '5', 1, 'Sangat Kurang Kooperatif', 'Peserta kesulitan bekerja dengan orang lain. Tidak berkomunikasi secara efektif, sering menimbulkan konflik, dan tidak mendukung tim.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0502', '5', 2, 'Kurang Kooperatif', 'Peserta terkadang dapat bekerja dengan orang lain tetapi masih menunjukkan kesulitan dalam komunikasi dan koordinasi. Kontribusi dalam tim masih terbatas.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0503', '5', 3, 'Cukup Kooperatif', 'Peserta dapat bekerja dengan orang lain dalam tim. Komunikasi cukup baik meskipun terkadang masih ada kesalahpahaman. Berkontribusi dalam upaya tim.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0504', '5', 4, 'Kooperatif', 'Peserta bekerja dengan baik dalam tim. Berkomunikasi secara efektif, berkoordinasi dengan rekan kerja, dan aktif berkontribusi pada upaya tim.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0505', '5', 5, 'Sangat Kooperatif', 'Peserta menunjukkan kemampuan luar biasa dalam kerja tim. Komunikasi sangat efektif, mengoordinasikan pekerjaan dengan sempurna, mendukung rekan kerja, dan sering menjadi pengaruh positif dalam tim.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0601', '6', 1, 'Sangat Kurang Terampil', 'Peserta tidak mampu menunjukkan keterampilan dasar pastry. Tidak memahami teknik dasar seperti mengaduk, memanggang, atau menghias. Tidak mampu menggunakan alat pastry dengan benar.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0602', '6', 2, 'Kurang Terampil', 'Peserta menunjukkan pemahaman minimal tentang teknik dasar pastry. Masih sering melakukan kesalahan dalam penggunaan alat dan metode pembuatan pastry. Membutuhkan pengawasan konstan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0603', '6', 3, 'Cukup Terampil', 'Peserta dapat melakukan teknik dasar pastry dengan pengawasan minimal. Mampu menggunakan alat pastry dengan benar namun terkadang kurang efisien. Memahami perbedaan metode pembuatan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0604', '6', 4, 'Terampil', 'Peserta menunjukkan kemampuan yang baik dalam teknik dasar pastry. Mampu menggunakan berbagai metode pembuatan dengan tepat. Efisien dalam penggunaan alat dan dapat bekerja mandiri.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0605', '6', 5, 'Sangat Terampil', 'Peserta menunjukkan keahlian luar biasa dalam teknik dasar pastry. Mampu menerapkan berbagai metode pembuatan dengan presisi tinggi. Sangat efisien dalam penggunaan alat dan dapat mengadaptasi teknik sesuai kebutuhan. Mampu mengajarkan keterampilan dasar kepada orang lain.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0701', '7', 1, 'Sangat Kurang Memuaskan', 'Hasil pastry tidak memenuhi standar dasar. Rasa, tekstur, penampilan, dan estetika sangat di bawah standar. Tidak dapat disajikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0702', '7', 2, 'Kurang Memuaskan', 'Hasil pastry memiliki beberapa kekurangan dalam rasa, tekstur, penampilan, atau estetika. Memerlukan perbaikan signifikan sebelum dapat disajikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0703', '7', 3, 'Cukup Memuaskan', 'Hasil pastry memenuhi standar minimal. Rasa, tekstur, penampilan, dan estetika cukup baik meskipun masih ada ruang untuk perbaikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0704', '7', 4, 'Memuaskan', 'Hasil pastry memiliki rasa, tekstur, penampilan, dan estetika yang baik. Konsisten dalam kualitas dan memenuhi standar yang diharapkan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0705', '7', 5, 'Sangat Memuaskan', 'Hasil pastry menunjukkan keunggulan dalam rasa, tekstur, penampilan, dan estetika. Sangat konsisten, sempurna dalam penyajian, dan mendekati standar profesional.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0801', '8', 1, 'Sangat Kurang Paham', 'Peserta tidak menunjukkan kesadaran akan kebersihan dan keamanan di area pastry. Sering melanggar protokol dasar kebersihan dan keamanan. Membahayakan diri sendiri dan orang lain.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0802', '8', 2, 'Kurang Paham', 'Peserta menunjukkan pemahaman minimal tentang kebersihan dan keamanan di area pastry. Masih perlu diingatkan tentang protokol dasar. Terkadang tidak konsisten dalam penerapan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0803', '8', 3, 'Cukup Paham', 'Peserta memahami prinsip dasar kebersihan dan keamanan di area pastry. Menerapkan protokol standar tetapi kadang membutuhkan pengawasan untuk konsistensi.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0804', '8', 4, 'Paham', 'Peserta menunjukkan pemahaman yang baik tentang kebersihan dan keamanan di area pastry. Secara konsisten menerapkan protokol dan mampu mengidentifikasi potensi bahaya.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0805', '8', 5, 'Sangat Paham', 'Peserta menunjukkan pemahaman yang mendalam tentang kebersihan dan keamanan di area pastry. Selalu menerapkan protokol dengan ketat, proaktif dalam mencegah risiko, dan mampu mengedukasi orang lain tentang praktik terbaik.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0901', '9', 1, 'Sangat Tidak Konsisten', 'Peserta menunjukkan tingkat inkonsistensi yang tinggi dalam kualitas dan hasil kerja pastry. Sering tidak teliti dan melakukan kesalahan dasar. Membutuhkan pengawasan konstan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0902', '9', 2, 'Tidak Konsisten', 'Peserta terkadang konsisten tetapi masih sering melakukan kesalahan dalam pembuatan pastry. Ketelitian masih rendah dan membutuhkan perbaikan signifikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0903', '9', 3, 'Cukup Konsisten', 'Peserta menunjukkan tingkat konsistensi dan ketelitian yang cukup dalam pembuatan pastry. Masih ada beberapa kesalahan tetapi secara umum dapat diandalkan dengan pengawasan minimal.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0904', '9', 4, 'Konsisten', 'Peserta konsisten dalam menghasilkan kualitas pastry yang baik. Teliti dalam sebagian besar aspek pekerjaan dan jarang melakukan kesalahan signifikan.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS0905', '9', 5, 'Sangat Konsisten', 'Peserta menunjukkan konsistensi dan ketelitian luar biasa dalam pembuatan pastry. Sangat memperhatikan detail, jarang melakukan kesalahan, dan mampu menjaga standar kualitas tinggi secara konsisten.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS1001', '10', 1, 'Sangat Kurang Kooperatif', 'Peserta kesulitan bekerja dengan orang lain di area pastry. Tidak berkomunikasi secara efektif, sering menimbulkan konflik, dan tidak mendukung tim.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS1002', '10', 2, 'Kurang Kooperatif', 'Peserta terkadang dapat bekerja dengan orang lain di area pastry tetapi masih menunjukkan kesulitan dalam komunikasi dan koordinasi. Kontribusi dalam tim masih terbatas.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS1003', '10', 3, 'Cukup Kooperatif', 'Peserta dapat bekerja dengan orang lain dalam tim pastry. Komunikasi cukup baik meskipun terkadang masih ada kesalahpahaman. Berkontribusi dalam upaya tim.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS1004', '10', 4, 'Kooperatif', 'Peserta bekerja dengan baik dalam tim pastry. Berkomunikasi secara efektif, berkoordinasi dengan rekan kerja, dan aktif berkontribusi pada upaya tim.', '2025-05-17 10:38:37', '2025-05-17 10:38:37'),
('CRS1005', '10', 5, 'Sangat Kooperatif', 'Peserta menunjukkan kemampuan luar biasa dalam kerja tim pastry. Komunikasi sangat efektif, mengoordinasikan pekerjaan dengan sempurna, mendukung rekan kerja, dan sering menjadi pengaruh positif dalam tim.', '2025-05-17 10:38:37', '2025-05-17 10:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_mingguan_magang`
--

CREATE TABLE `evaluasi_mingguan_magang` (
  `evaluasi_id` varchar(50) NOT NULL,
  `magang_id` varchar(50) NOT NULL,
  `criteria_rating_id` varchar(50) DEFAULT NULL,
  `criteria_id` varchar(50) DEFAULT NULL,
  `minggu_ke` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluasi_mingguan_magang`
--

INSERT INTO `evaluasi_mingguan_magang` (`evaluasi_id`, `magang_id`, `criteria_rating_id`, `criteria_id`, `minggu_ke`, `created_at`, `updated_at`) VALUES
('17822ee4-d0ae-41f0-b0b6-bd7461b8ac78', 'MAG004', 'CRS1005', '10', 4, '2025-05-31 17:35:55', '2025-05-31 18:37:11'),
('186d5e44-c859-4a34-8fe5-3d0a729fc1d1', 'MAG003', NULL, '5', 2, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('1cee24a6-03c8-4cac-a4f4-cf6e0e2a2a68', 'MAG005', NULL, '5', 3, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('23c43064-da99-4691-8123-c9103c6daf08', 'MAG005', NULL, '1', 2, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('26e9ddd2-21f1-482c-9629-dd957c4ca0ed', 'MAG004', NULL, '10', 3, '2025-05-31 17:35:55', '2025-05-31 18:10:44'),
('2a20e63f-ecff-4b56-ba0b-aca4b4244fc4', 'MAG003', NULL, '3', 4, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('2c945c3e-77c5-4bed-9936-59cc883bc3dd', 'MAG005', NULL, '5', 2, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('30bcb02a-7f76-4e71-ad3d-3a5fbc00ae4b', 'MAG005', NULL, '4', 3, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('3132784d-636e-4efe-af6d-8aa2fac44639', 'MAG003', NULL, '1', 2, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('370e5d75-8956-4ca6-a3c5-5267288a0e2c', 'MAG003', NULL, '4', 3, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('3b640889-cfd7-4644-a075-7c16564af746', 'MAG003', 'CRS0205', '2', 1, '2025-05-26 05:24:41', '2025-05-26 05:27:06'),
('3f48fe5f-f7e5-4bab-9d5d-4de382ead085', 'MAG003', 'CRS0505', '5', 1, '2025-05-26 05:24:41', '2025-05-26 05:27:06'),
('404c6c6f-eca0-4aae-8886-0d653de29926', 'MAG003', NULL, '1', 3, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('40b5aeb7-23de-4cbd-899e-283a7ca78223', 'MAG005', NULL, '4', 1, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('43fcd741-b104-4b40-8b71-c63d5f000f95', 'MAG004', NULL, '9', 3, '2025-05-31 17:35:55', '2025-05-31 18:10:44'),
('44681428-e6f0-45c7-a842-a439b08e8c29', 'MAG005', NULL, '2', 1, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('44d1e92b-ba3f-4493-8f3b-b2d488464f30', 'MAG004', NULL, '6', 3, '2025-05-31 17:35:55', '2025-05-31 18:10:44'),
('47cee83d-b2dd-435a-93bc-7c42508fb8ce', 'MAG004', 'CRS0605', '6', 4, '2025-05-31 17:35:55', '2025-05-31 18:37:10'),
('4803a292-c980-4dcb-8c6f-65554e8c92fe', 'MAG003', NULL, '1', 4, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('4a7dc17f-2b67-4db9-8910-9bcfbe13b54a', 'MAG004', 'CRS0705', '7', 4, '2025-05-31 17:35:55', '2025-05-31 18:37:11'),
('4c954f5d-0ef4-4f6c-b9b2-0ebc0d4452b3', 'MAG005', NULL, '2', 4, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('4d0dc6db-aa05-444a-843f-c5af51bb101a', 'MAG003', NULL, '3', 3, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('4ff2f4e2-b287-445a-9ec0-bf8043b9dc3f', 'MAG003', NULL, '3', 2, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('501e2f17-b78d-48e2-8294-1d5ed5099877', 'MAG003', NULL, '5', 3, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('5509c088-f3a8-4793-886d-c5cfb504f111', 'MAG004', 'CRS0705', '7', 1, '2025-05-31 17:35:55', '2025-05-31 18:08:37'),
('55d33a46-18f5-4828-b1c9-4494802a8bb2', 'MAG003', 'CRS0405', '4', 1, '2025-05-26 05:24:41', '2025-05-26 05:27:06'),
('56948f19-2936-4178-a27a-05c3a3cc72ef', 'MAG003', NULL, '4', 2, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('57ca1681-360a-45cd-b67a-1a44b1113e1a', 'MAG003', NULL, '4', 4, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('61257123-63b9-49a2-8dee-63b272d73d15', 'MAG005', NULL, '1', 3, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('6364039f-9134-410e-9f5f-88f089950ff5', 'MAG003', NULL, '2', 2, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('646974e8-5ad3-41d7-b734-8d7d79e79714', 'MAG005', NULL, '3', 4, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('6911e383-d7a0-49ba-8f4b-2db693c57e49', 'MAG005', NULL, '5', 1, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('69cec309-812f-484e-a7bf-2beaa7cb78b7', 'MAG005', NULL, '1', 1, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('6b299794-57c7-4ce8-b9bd-14f7819dca6d', 'MAG005', NULL, '3', 3, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('6b83e6d7-0d2c-49df-95e7-a907fea408cd', 'MAG004', NULL, '7', 2, '2025-05-31 17:35:55', '2025-05-31 18:20:18'),
('719a4b82-c510-43d8-b102-46f4da43e4c9', 'MAG005', NULL, '4', 4, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('72324656-57a5-4564-9b95-875665fbc647', 'MAG004', NULL, '7', 3, '2025-05-31 17:35:55', '2025-05-31 18:10:44'),
('9073d2dc-ec4e-4f69-8b46-f070d465157f', 'MAG004', NULL, '8', 3, '2025-05-31 17:35:55', '2025-05-31 18:10:44'),
('91f69cfb-9d04-4a27-9b6f-d0f40d6d5aad', 'MAG004', 'CRS0805', '8', 1, '2025-05-31 17:35:55', '2025-05-31 18:08:37'),
('9423a33e-371c-4c9c-a943-fd54c3fc4206', 'MAG004', 'CRS0805', '8', 4, '2025-05-31 17:35:55', '2025-05-31 18:37:11'),
('992309ae-0eed-4e9c-a8fa-855d1d449d6f', 'MAG004', NULL, '6', 2, '2025-05-31 17:35:55', '2025-05-31 18:20:18'),
('9ea3a62f-0b5a-491a-bcf6-116001bf061d', 'MAG004', 'CRS0605', '6', 1, '2025-05-31 17:35:55', '2025-05-31 18:36:31'),
('a0ea8838-4e0e-4313-af35-b0622c35ad8b', 'MAG003', 'CRS0105', '1', 1, '2025-05-26 05:24:41', '2025-05-26 05:27:06'),
('a866ae7f-fc10-4c19-b236-3df98743f096', 'MAG003', NULL, '2', 3, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('aa36cdfb-b7bb-4cd4-861c-780e6fc12151', 'MAG003', NULL, '5', 4, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('ab1451ab-a2aa-4259-8923-3bf69445c559', 'MAG004', 'CRS1005', '10', 1, '2025-05-31 17:35:55', '2025-05-31 18:08:37'),
('b9c48294-62e1-434e-927d-2829658cdfc2', 'MAG005', NULL, '2', 2, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('bbcb299b-aaee-46ea-975d-d46262fbe011', 'MAG005', NULL, '3', 1, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('bc35ddb9-f4c1-4ee9-a289-26b099bc9ebe', 'MAG004', NULL, '8', 2, '2025-05-31 17:35:55', '2025-05-31 18:20:18'),
('be4ff17d-0668-4f1b-a566-df3cec11a80e', 'MAG005', NULL, '5', 4, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('c8e018b7-06a8-4f80-974d-f8a28ceb4400', 'MAG004', 'CRS0905', '9', 4, '2025-05-31 17:35:55', '2025-05-31 18:37:11'),
('d559b074-6124-4e07-bbe9-fefdf29e04e0', 'MAG005', NULL, '4', 2, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('db3e6522-6d55-48b6-bcd4-4caf70a780d2', 'MAG005', NULL, '1', 4, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('dcd6afe0-a0ca-4d83-94ed-0de0bb2c15a4', 'MAG004', NULL, '10', 2, '2025-05-31 17:35:55', '2025-05-31 18:20:18'),
('dfd9fa6d-2ca7-4f5a-b355-aa3c60b9747a', 'MAG004', 'CRS0905', '9', 1, '2025-05-31 17:35:55', '2025-05-31 18:08:37'),
('e6cb3365-c5e5-44ed-b5ce-10aec7a2e074', 'MAG005', NULL, '2', 3, '2025-05-31 17:51:55', '2025-05-31 17:51:55'),
('ea1de38a-4da6-4afa-a582-b52b43dfb28d', 'MAG003', 'CRS0305', '3', 1, '2025-05-26 05:24:41', '2025-05-26 05:27:06'),
('ed5a165d-0d9a-4bd1-b5c5-e41f86bb15bf', 'MAG004', NULL, '9', 2, '2025-05-31 17:35:55', '2025-05-31 18:20:18'),
('edc6c990-a55c-4ea1-b575-4d669f273c2f', 'MAG003', NULL, '2', 4, '2025-05-26 05:24:41', '2025-05-26 05:24:41'),
('f1263a39-d7ec-40c3-bef4-9a361661e748', 'MAG005', NULL, '3', 2, '2025-05-31 17:51:55', '2025-05-31 17:51:55');

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
  `jadwal` datetime DEFAULT NULL,
  `status_seleksi` enum('Pending','Tidak Lulus','Tes Kemampuan') DEFAULT 'Pending',
  `qualifikasi_criteria_id` varchar(50) DEFAULT NULL,
  `komunikasi_criteria_id` varchar(50) DEFAULT NULL,
  `sikap_criteria_id` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`interview_id`, `pelamar_id`, `user_id`, `kualifikasi_skor`, `komunikasi_skor`, `sikap_skor`, `total_skor`, `jadwal`, `status_seleksi`, `qualifikasi_criteria_id`, `komunikasi_criteria_id`, `sikap_criteria_id`, `created_at`, `updated_at`) VALUES
('INT003', 'PL002', 1, 3, 2, 2, 2.33, '2025-05-26 04:36:00', 'Tes Kemampuan', 'INT_CRIT_JOB004_1', 'INT_CRIT_JOB004_2', 'INT_CRIT_JOB004_3', '2025-05-25 21:33:29', '2025-05-31 17:55:43'),
('INT004', 'PL004', 1, 5, 3, 5, 4.33, '2025-05-26 12:21:00', 'Pending', 'INT_CRIT_JOB001_1', 'INT_CRIT_JOB001_2', 'INT_CRIT_JOB001_3', '2025-05-26 05:18:50', '2025-05-26 05:22:59'),
('INT005', 'PL003', 5, 0, 0, 0, 0.00, '2025-05-27 19:44:00', 'Pending', 'INT_CRIT_JOB002_1', 'INT_CRIT_JOB002_2', 'INT_CRIT_JOB002_3', '2025-05-27 12:41:11', '2025-05-31 17:34:20'),
('INT007', '1wAvO0ar7z', 5, 0, 0, 0, 0.00, '2025-05-30 04:14:00', 'Pending', 'INT_CRIT_JOB003_1', 'INT_CRIT_JOB003_2', 'INT_CRIT_JOB003_3', '2025-05-29 21:10:34', '2025-05-31 17:28:20'),
('INT008', 'PL001', 1, 5, 5, 5, 5.00, '2025-06-01 00:40:00', 'Tes Kemampuan', 'INT_CRIT_JOB001_1', 'INT_CRIT_JOB001_2', 'INT_CRIT_JOB001_3', '2025-05-31 17:37:23', '2025-05-31 17:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `interview_criteria`
--

CREATE TABLE `interview_criteria` (
  `criteria_id` varchar(50) NOT NULL,
  `job_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `weight` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview_criteria`
--

INSERT INTO `interview_criteria` (`criteria_id`, `job_id`, `name`, `code`, `description`, `weight`, `created_at`, `updated_at`) VALUES
('INT_CRIT_JOB001_1', 'JOB001', 'Kualifikasi', 'KL', 'Penilaian kesesuaian latar belakang, pendidikan, dan pengalaman kandidat dengan posisi yang dilamar', 0.4000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB001_2', 'JOB001', 'Komunikasi', 'KM', 'Penilaian kemampuan komunikasi, penyampaian ide, dan interaksi selama wawancara', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB001_3', 'JOB001', 'Sikap', 'SK', 'Penilaian sikap profesional, motivasi, dan kepribadian kandidat', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB002_1', 'JOB002', 'Kualifikasi', 'KL', 'Penilaian kesesuaian latar belakang, pendidikan, dan pengalaman kandidat dengan posisi yang dilamar', 0.4000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB002_2', 'JOB002', 'Komunikasi', 'KM', 'Penilaian kemampuan komunikasi, penyampaian ide, dan interaksi selama wawancara', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB002_3', 'JOB002', 'Sikap', 'SK', 'Penilaian sikap profesional, motivasi, dan kepribadian kandidat', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB003_1', 'JOB003', 'Kualifikasi', 'KL', 'Penilaian kesesuaian latar belakang, pendidikan, dan pengalaman kandidat dengan posisi yang dilamar', 0.4000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB003_2', 'JOB003', 'Komunikasi', 'KM', 'Penilaian kemampuan komunikasi, penyampaian ide, dan interaksi selama wawancara', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB003_3', 'JOB003', 'Sikap', 'SK', 'Penilaian sikap profesional, motivasi, dan kepribadian kandidat', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB004_1', 'JOB004', 'Kualifikasi', 'KL', 'Penilaian kesesuaian latar belakang, pendidikan, dan pengalaman kandidat dengan posisi yang dilamar', 0.4000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB004_2', 'JOB004', 'Komunikasi', 'KM', 'Penilaian kemampuan komunikasi, penyampaian ide, dan interaksi selama wawancara', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB004_3', 'JOB004', 'Sikap', 'SK', 'Penilaian sikap profesional, motivasi, dan kepribadian kandidat', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB005_1', 'JOB005', 'Kualifikasi', 'KL', 'Penilaian kesesuaian latar belakang, pendidikan, dan pengalaman kandidat dengan posisi yang dilamar', 0.4000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB005_2', 'JOB005', 'Komunikasi', 'KM', 'Penilaian kemampuan komunikasi, penyampaian ide, dan interaksi selama wawancara', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB005_3', 'JOB005', 'Sikap', 'SK', 'Penilaian sikap profesional, motivasi, dan kepribadian kandidat', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB006_1', 'JOB006', 'Kualifikasi', 'KL', 'Penilaian kesesuaian latar belakang, pendidikan, dan pengalaman kandidat dengan posisi yang dilamar', 0.4000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB006_2', 'JOB006', 'Komunikasi', 'KM', 'Penilaian kemampuan komunikasi, penyampaian ide, dan interaksi selama wawancara', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_CRIT_JOB006_3', 'JOB006', 'Sikap', 'SK', 'Penilaian sikap profesional, motivasi, dan kepribadian kandidat', 0.3000, '2025-05-24 18:31:19', '2025-05-24 18:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `interview_rating_scales`
--

CREATE TABLE `interview_rating_scales` (
  `id` varchar(50) NOT NULL,
  `criteria_id` varchar(50) NOT NULL,
  `rating_level` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview_rating_scales`
--

INSERT INTO `interview_rating_scales` (`id`, `criteria_id`, `rating_level`, `name`, `description`, `created_at`, `updated_at`) VALUES
('INT_RS_001', 'INT_CRIT_JOB001_1', 1, 'Sangat Kurang', 'Kandidat tidak memiliki kualifikasi dan pengalaman yang relevan dengan posisi Cook', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_002', 'INT_CRIT_JOB001_1', 2, 'Kurang', 'Kandidat memiliki sedikit kualifikasi atau pengalaman yang relevan, namun tidak memadai', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_003', 'INT_CRIT_JOB001_1', 3, 'Cukup', 'Kandidat memiliki kualifikasi dan pengalaman dasar yang cukup untuk posisi Cook', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_004', 'INT_CRIT_JOB001_1', 4, 'Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang baik dan relevan dengan posisi Cook', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_005', 'INT_CRIT_JOB001_1', 5, 'Sangat Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang sangat baik, melebihi persyaratan posisi Cook', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_006', 'INT_CRIT_JOB001_2', 1, 'Sangat Kurang', 'Kandidat memiliki kesulitan dalam berkomunikasi, tidak dapat menyampaikan ide dengan jelas', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_007', 'INT_CRIT_JOB001_2', 2, 'Kurang', 'Kandidat berkomunikasi dengan kejelasan minimal, sering kesulitan menyampaikan ide', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_008', 'INT_CRIT_JOB001_2', 3, 'Cukup', 'Kandidat dapat berkomunikasi dengan cukup jelas dan dapat menyampaikan ide-ide dasar', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_009', 'INT_CRIT_JOB001_2', 4, 'Baik', 'Kandidat berkomunikasi dengan baik, dapat menyampaikan ide dengan jelas dan terstruktur', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_010', 'INT_CRIT_JOB001_2', 5, 'Sangat Baik', 'Kandidat berkomunikasi dengan sangat baik, menyampaikan ide dengan jelas, terstruktur, dan persuasif', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_011', 'INT_CRIT_JOB001_3', 1, 'Sangat Kurang', 'Kandidat menunjukkan sikap tidak profesional atau tidak tertarik pada posisi', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_012', 'INT_CRIT_JOB001_3', 2, 'Kurang', 'Kandidat menunjukkan sikap kurang profesional atau kurang motivasi', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_013', 'INT_CRIT_JOB001_3', 3, 'Cukup', 'Kandidat menunjukkan sikap profesional dasar dan motivasi yang cukup', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_014', 'INT_CRIT_JOB001_3', 4, 'Baik', 'Kandidat menunjukkan sikap profesional yang baik dan motivasi yang jelas', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_015', 'INT_CRIT_JOB001_3', 5, 'Sangat Baik', 'Kandidat menunjukkan sikap sangat profesional, sangat termotivasi, dan kepribadian yang sangat cocok untuk posisi', '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('INT_RS_016', 'INT_CRIT_JOB002_1', 1, 'Sangat Kurang', 'Kandidat tidak memiliki kualifikasi dan pengalaman yang relevan dengan posisi Steward', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_017', 'INT_CRIT_JOB002_1', 2, 'Kurang', 'Kandidat memiliki sedikit kualifikasi atau pengalaman yang relevan, namun tidak memadai', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_018', 'INT_CRIT_JOB002_1', 3, 'Cukup', 'Kandidat memiliki kualifikasi dan pengalaman dasar yang cukup untuk posisi Steward', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_019', 'INT_CRIT_JOB002_1', 4, 'Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang baik dan relevan dengan posisi Steward', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_020', 'INT_CRIT_JOB002_1', 5, 'Sangat Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang sangat baik, melebihi persyaratan posisi Steward', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_021', 'INT_CRIT_JOB002_2', 1, 'Sangat Kurang', 'Kandidat memiliki kesulitan dalam berkomunikasi, tidak dapat menyampaikan ide dengan jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_022', 'INT_CRIT_JOB002_2', 2, 'Kurang', 'Kandidat berkomunikasi dengan kejelasan minimal, sering kesulitan menyampaikan ide', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_023', 'INT_CRIT_JOB002_2', 3, 'Cukup', 'Kandidat dapat berkomunikasi dengan cukup jelas dan dapat menyampaikan ide-ide dasar', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_024', 'INT_CRIT_JOB002_2', 4, 'Baik', 'Kandidat berkomunikasi dengan baik, dapat menyampaikan ide dengan jelas dan terstruktur', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_025', 'INT_CRIT_JOB002_2', 5, 'Sangat Baik', 'Kandidat berkomunikasi dengan sangat baik, menyampaikan ide dengan jelas, terstruktur, dan persuasif', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_026', 'INT_CRIT_JOB002_3', 1, 'Sangat Kurang', 'Kandidat menunjukkan sikap tidak profesional atau tidak tertarik pada posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_027', 'INT_CRIT_JOB002_3', 2, 'Kurang', 'Kandidat menunjukkan sikap kurang profesional atau kurang motivasi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_028', 'INT_CRIT_JOB002_3', 3, 'Cukup', 'Kandidat menunjukkan sikap profesional dasar dan motivasi yang cukup', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_029', 'INT_CRIT_JOB002_3', 4, 'Baik', 'Kandidat menunjukkan sikap profesional yang baik dan motivasi yang jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_030', 'INT_CRIT_JOB002_3', 5, 'Sangat Baik', 'Kandidat menunjukkan sikap sangat profesional, sangat termotivasi, dan kepribadian yang sangat cocok untuk posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_031', 'INT_CRIT_JOB003_1', 1, 'Sangat Kurang', 'Kandidat tidak memiliki kualifikasi dan pengalaman yang relevan dengan posisi Cook Helper', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_032', 'INT_CRIT_JOB003_1', 2, 'Kurang', 'Kandidat memiliki sedikit kualifikasi atau pengalaman yang relevan, namun tidak memadai', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_033', 'INT_CRIT_JOB003_1', 3, 'Cukup', 'Kandidat memiliki kualifikasi dan pengalaman dasar yang cukup untuk posisi Cook Helper', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_034', 'INT_CRIT_JOB003_1', 4, 'Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang baik dan relevan dengan posisi Cook Helper', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_035', 'INT_CRIT_JOB003_1', 5, 'Sangat Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang sangat baik, melebihi persyaratan posisi Cook Helper', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_036', 'INT_CRIT_JOB003_2', 1, 'Sangat Kurang', 'Kandidat memiliki kesulitan dalam berkomunikasi, tidak dapat menyampaikan ide dengan jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_037', 'INT_CRIT_JOB003_2', 2, 'Kurang', 'Kandidat berkomunikasi dengan kejelasan minimal, sering kesulitan menyampaikan ide', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_038', 'INT_CRIT_JOB003_2', 3, 'Cukup', 'Kandidat dapat berkomunikasi dengan cukup jelas dan dapat menyampaikan ide-ide dasar', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_039', 'INT_CRIT_JOB003_2', 4, 'Baik', 'Kandidat berkomunikasi dengan baik, dapat menyampaikan ide dengan jelas dan terstruktur', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_040', 'INT_CRIT_JOB003_2', 5, 'Sangat Baik', 'Kandidat berkomunikasi dengan sangat baik, menyampaikan ide dengan jelas, terstruktur, dan persuasif', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_041', 'INT_CRIT_JOB003_3', 1, 'Sangat Kurang', 'Kandidat menunjukkan sikap tidak profesional atau tidak tertarik pada posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_042', 'INT_CRIT_JOB003_3', 2, 'Kurang', 'Kandidat menunjukkan sikap kurang profesional atau kurang motivasi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_043', 'INT_CRIT_JOB003_3', 3, 'Cukup', 'Kandidat menunjukkan sikap profesional dasar dan motivasi yang cukup', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_044', 'INT_CRIT_JOB003_3', 4, 'Baik', 'Kandidat menunjukkan sikap profesional yang baik dan motivasi yang jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_045', 'INT_CRIT_JOB003_3', 5, 'Sangat Baik', 'Kandidat menunjukkan sikap sangat profesional, sangat termotivasi, dan kepribadian yang sangat cocok untuk posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_046', 'INT_CRIT_JOB004_1', 1, 'Sangat Kurang', 'Kandidat tidak memiliki kualifikasi dan pengalaman yang relevan dengan posisi Pastry Chef', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_047', 'INT_CRIT_JOB004_1', 2, 'Kurang', 'Kandidat memiliki sedikit kualifikasi atau pengalaman yang relevan, namun tidak memadai', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_048', 'INT_CRIT_JOB004_1', 3, 'Cukup', 'Kandidat memiliki kualifikasi dan pengalaman dasar yang cukup untuk posisi Pastry Chef', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_049', 'INT_CRIT_JOB004_1', 4, 'Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang baik dan relevan dengan posisi Pastry Chef', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_050', 'INT_CRIT_JOB004_1', 5, 'Sangat Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang sangat baik, melebihi persyaratan posisi Pastry Chef', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_051', 'INT_CRIT_JOB004_2', 1, 'Sangat Kurang', 'Kandidat memiliki kesulitan dalam berkomunikasi, tidak dapat menyampaikan ide dengan jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_052', 'INT_CRIT_JOB004_2', 2, 'Kurang', 'Kandidat berkomunikasi dengan kejelasan minimal, sering kesulitan menyampaikan ide', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_053', 'INT_CRIT_JOB004_2', 3, 'Cukup', 'Kandidat dapat berkomunikasi dengan cukup jelas dan dapat menyampaikan ide-ide dasar', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_054', 'INT_CRIT_JOB004_2', 4, 'Baik', 'Kandidat berkomunikasi dengan baik, dapat menyampaikan ide dengan jelas dan terstruktur', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_055', 'INT_CRIT_JOB004_2', 5, 'Sangat Baik', 'Kandidat berkomunikasi dengan sangat baik, menyampaikan ide dengan jelas, terstruktur, dan persuasif', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_056', 'INT_CRIT_JOB004_3', 1, 'Sangat Kurang', 'Kandidat menunjukkan sikap tidak profesional atau tidak tertarik pada posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_057', 'INT_CRIT_JOB004_3', 2, 'Kurang', 'Kandidat menunjukkan sikap kurang profesional atau kurang motivasi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_058', 'INT_CRIT_JOB004_3', 3, 'Cukup', 'Kandidat menunjukkan sikap profesional dasar dan motivasi yang cukup', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_059', 'INT_CRIT_JOB004_3', 4, 'Baik', 'Kandidat menunjukkan sikap profesional yang baik dan motivasi yang jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_060', 'INT_CRIT_JOB004_3', 5, 'Sangat Baik', 'Kandidat menunjukkan sikap sangat profesional, sangat termotivasi, dan kepribadian yang sangat cocok untuk posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_061', 'INT_CRIT_JOB005_1', 1, 'Sangat Kurang', 'Kandidat tidak memiliki kualifikasi dan pengalaman yang relevan dengan posisi Barista', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_062', 'INT_CRIT_JOB005_1', 2, 'Kurang', 'Kandidat memiliki sedikit kualifikasi atau pengalaman yang relevan, namun tidak memadai', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_063', 'INT_CRIT_JOB005_1', 3, 'Cukup', 'Kandidat memiliki kualifikasi dan pengalaman dasar yang cukup untuk posisi Barista', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_064', 'INT_CRIT_JOB005_1', 4, 'Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang baik dan relevan dengan posisi Barista', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_065', 'INT_CRIT_JOB005_1', 5, 'Sangat Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang sangat baik, melebihi persyaratan posisi Barista', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_066', 'INT_CRIT_JOB005_2', 1, 'Sangat Kurang', 'Kandidat memiliki kesulitan dalam berkomunikasi, tidak dapat menyampaikan ide dengan jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_067', 'INT_CRIT_JOB005_2', 2, 'Kurang', 'Kandidat berkomunikasi dengan kejelasan minimal, sering kesulitan menyampaikan ide', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_068', 'INT_CRIT_JOB005_2', 3, 'Cukup', 'Kandidat dapat berkomunikasi dengan cukup jelas dan dapat menyampaikan ide-ide dasar', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_069', 'INT_CRIT_JOB005_2', 4, 'Baik', 'Kandidat berkomunikasi dengan baik, dapat menyampaikan ide dengan jelas dan terstruktur', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_070', 'INT_CRIT_JOB005_2', 5, 'Sangat Baik', 'Kandidat berkomunikasi dengan sangat baik, menyampaikan ide dengan jelas, terstruktur, dan persuasif', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_071', 'INT_CRIT_JOB005_3', 1, 'Sangat Kurang', 'Kandidat menunjukkan sikap tidak profesional atau tidak tertarik pada posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_072', 'INT_CRIT_JOB005_3', 2, 'Kurang', 'Kandidat menunjukkan sikap kurang profesional atau kurang motivasi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_073', 'INT_CRIT_JOB005_3', 3, 'Cukup', 'Kandidat menunjukkan sikap profesional dasar dan motivasi yang cukup', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_074', 'INT_CRIT_JOB005_3', 4, 'Baik', 'Kandidat menunjukkan sikap profesional yang baik dan motivasi yang jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_075', 'INT_CRIT_JOB005_3', 5, 'Sangat Baik', 'Kandidat menunjukkan sikap sangat profesional, sangat termotivasi, dan kepribadian yang sangat cocok untuk posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_076', 'INT_CRIT_JOB006_1', 1, 'Sangat Kurang', 'Kandidat tidak memiliki kualifikasi dan pengalaman yang relevan dengan posisi Cleaning Service', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_077', 'INT_CRIT_JOB006_1', 2, 'Kurang', 'Kandidat memiliki sedikit kualifikasi atau pengalaman yang relevan, namun tidak memadai', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_078', 'INT_CRIT_JOB006_1', 3, 'Cukup', 'Kandidat memiliki kualifikasi dan pengalaman dasar yang cukup untuk posisi Cleaning Service', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_079', 'INT_CRIT_JOB006_1', 4, 'Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang baik dan relevan dengan posisi Cleaning Service', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_080', 'INT_CRIT_JOB006_1', 5, 'Sangat Baik', 'Kandidat memiliki kualifikasi dan pengalaman yang sangat baik, melebihi persyaratan posisi Cleaning Service', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_081', 'INT_CRIT_JOB006_2', 1, 'Sangat Kurang', 'Kandidat memiliki kesulitan dalam berkomunikasi, tidak dapat menyampaikan ide dengan jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_082', 'INT_CRIT_JOB006_2', 2, 'Kurang', 'Kandidat berkomunikasi dengan kejelasan minimal, sering kesulitan menyampaikan ide', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_083', 'INT_CRIT_JOB006_2', 3, 'Cukup', 'Kandidat dapat berkomunikasi dengan cukup jelas dan dapat menyampaikan ide-ide dasar', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_084', 'INT_CRIT_JOB006_2', 4, 'Baik', 'Kandidat berkomunikasi dengan baik, dapat menyampaikan ide dengan jelas dan terstruktur', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_085', 'INT_CRIT_JOB006_2', 5, 'Sangat Baik', 'Kandidat berkomunikasi dengan sangat baik, menyampaikan ide dengan jelas, terstruktur, dan persuasif', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_086', 'INT_CRIT_JOB006_3', 1, 'Sangat Kurang', 'Kandidat menunjukkan sikap tidak profesional atau tidak tertarik pada posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_087', 'INT_CRIT_JOB006_3', 2, 'Kurang', 'Kandidat menunjukkan sikap kurang profesional atau kurang motivasi', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_088', 'INT_CRIT_JOB006_3', 3, 'Cukup', 'Kandidat menunjukkan sikap profesional dasar dan motivasi yang cukup', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_089', 'INT_CRIT_JOB006_3', 4, 'Baik', 'Kandidat menunjukkan sikap profesional yang baik dan motivasi yang jelas', '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('INT_RS_090', 'INT_CRIT_JOB006_3', 5, 'Sangat Baik', 'Kandidat menunjukkan sikap sangat profesional, sangat termotivasi, dan kepribadian yang sangat cocok untuk posisi', '2025-05-25 20:42:34', '2025-05-25 20:42:34');

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
('JOB001', 'Cooks', 'Bertanggung jawab untuk memasak hidangan utama, mengelola proses memasak, dan memastikan kualitas makanan.', '2025-04-19 22:00:00', '2025-05-31 17:59:26'),
('JOB002', 'Steward', 'Bertanggung jawab untuk kebersihan peralatan dapur, setup meja, dan mendukung operasional dapur dan restoran.', '2025-04-19 22:00:00', '2025-05-31 17:59:32'),
('JOB003', 'Cook Helper', 'Membantu persiapan bahan masakan, mendukung chef dalam proses memasak, dan menjaga kebersihan area kerja.', '2025-04-19 22:00:00', '2025-05-31 17:59:42'),
('JOB004', 'Pastry Chef', 'Membuat berbagai jenis kue, pastry, dessert, dan roti. Bertanggung jawab atas semua produk bakery dan patisserie.', '2025-04-19 22:00:00', '2025-05-31 17:59:50'),
('JOB005', 'Barista', 'Membuat dan menyajikan berbagai jenis kopi, minuman panas dan dingin, serta memberikan pelayanan yang ramah kepada pelanggan.', '2025-04-19 22:00:00', '2025-05-31 17:59:58'),
('JOB006', 'Cleaning Service', 'Menjaga kebersihan seluruh area restoran, sanitasi fasilitas, dan memastikan lingkungan kerja yang bersih dan nyaman.', '2025-04-19 22:00:00', '2025-05-31 18:00:12');

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
  `status_seleksi` enum('Pending','Lulus','Tidak Lulus','Sedang Berjalan') DEFAULT 'Pending',
  `jadwal_mulai` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `magang`
--

INSERT INTO `magang` (`magang_id`, `pelamar_id`, `user_id`, `total_skor`, `rank`, `status_seleksi`, `jadwal_mulai`, `created_at`, `updated_at`) VALUES
('MAG003', 'PL004', 1, 0.10, 1, 'Sedang Berjalan', '2025-05-26 13:30:00', '2025-05-26 05:24:40', '2025-05-26 05:27:06'),
('MAG004', 'PL002', 5, 0.50, 1, 'Sedang Berjalan', '2025-06-01 02:00:00', '2025-05-31 17:35:55', '2025-05-31 18:37:11'),
('MAG005', 'PL001', 5, 0.00, NULL, 'Sedang Berjalan', '2025-06-01 02:00:00', '2025-05-31 17:51:55', '2025-05-31 17:51:55');

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
(2, '2025_05_06_180113_create_cache_table', 2),
(3, '2025_05_13_190513_update_evaluasi_mingguan_magang_table_make_rating_nullable', 3),
(4, '2014_10_12_000000_create_users_table', 4),
(6, '2023_10_10_000000_add_role_to_users_table', 5);

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
  `status_seleksi` enum('Pending','Interview','Sedang Berjalan','Tes Kemampuan','Magang','Selesai') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`pelamar_id`, `periode_id`, `job_id`, `nama`, `email`, `nomor_wa`, `tgl_lahir`, `alamat`, `pendidikan`, `lama_pengalaman`, `tempat_pengalaman`, `deskripsi_tempat`, `berkas_cv`, `status_seleksi`, `created_at`, `updated_at`) VALUES
('1DIITCGDVZ', 'PER001', 'JOB005', 'fikran elyafit', 'fikranelyafit@gmail.com', '12e', '2025-05-30', 'Komp mahdani hafairt blok a no 1', 'D3', 4, 'unandq', 'wqeqwe', 'cv_files/1DIITCGDVZ_CV.docx', 'Pending', '2025-05-29 20:44:14', '2025-05-29 20:44:14'),
('1wAvO0ar7z', 'PER001', 'JOB003', 'falahusna', 'falahusna04@gmail.com', '12e', '2025-05-30', 'qwe', 'S2', 4, 'rumah', 'membnatu orng tua', 'cv_files/1wAvO0ar7z_CV.docx', 'Interview', '2025-05-29 21:07:59', '2025-05-31 17:28:20'),
('3OWhETr9Dm', 'PER001', 'JOB004', 'Fahri Andika Sanjaya', 'fahriandikasanjaya@gmail.com', '085272127188', '2025-05-13', 'qwe', 'S1', 2, 'unand', '231', 'cv_files/3OWhETr9Dm_CV.docx', 'Pending', '2025-05-29 17:43:13', '2025-05-29 17:43:13'),
('bghJ3tq6pE', 'PER001', 'JOB005', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-30', 'Komp mahdani hafairt blok a no 1', 'S2', 4, 'efwefwe', 'werwerwef', 'cv_files/bghJ3tq6pE_CV.docx', 'Pending', '2025-05-29 17:53:33', '2025-05-29 17:53:33'),
('bx0Q0vHjXV', 'PER001', 'JOB002', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-13', 'qwe', 'D3', 3, 'unand', 'qweweq', 'cv_files/bx0Q0vHjXV_CV.docx', 'Pending', '2025-05-29 17:49:02', '2025-05-29 17:49:02'),
('DjKLKp7H0v', 'PER001', 'JOB002', 'Fahri Andika Sanjaya', 'fahriandikasanjaya@gmail.com', '085272127188', '2025-05-13', 'qwe', 'D3', 3, 'unand', '2131', 'cv_files/DjKLKp7H0v_CV.docx', 'Pending', '2025-05-29 17:38:02', '2025-05-29 17:38:02'),
('mQINI3MWLs', 'PER001', 'JOB003', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-13', 'Komp mahdani hafairt blok a no 1', 'S3', 3, 'unandq', 'qwrwq', 'cv_files/mQINI3MWLs_CV.docx', 'Pending', '2025-05-29 17:51:23', '2025-05-29 17:51:23'),
('PL001', 'PER001', 'JOB001', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-05', 'Komp mahdani hafairt blok a no 1', 'S3', 1, '123', '21', 'cv_files/PL001_CV.pdf', 'Magang', '2025-05-25 18:27:36', '2025-05-31 17:51:55'),
('PL002', 'PER001', 'JOB004', 'radhika rasidi', 'rasidiradhika111@gmail.com', '085272127188', '2025-05-05', 'Komp mahdani hafairt blok a no 1', 'D3', 3, '123', '213123', 'cv_files/PL002_CV.docx', 'Magang', '2025-05-25 18:28:19', '2025-05-31 17:35:55'),
('PL003', 'PER001', 'JOB002', 'Fahri Andika Sanjaya', 'fahriandikasanjaya@gmail.com', '12e', '2025-05-26', 'Komp mahdani hafairt blok a no 1', 'S3', 1, '12e1', '12e1', 'cv_files/PL003_CV.docx', 'Interview', '2025-05-25 18:28:44', '2025-05-31 17:34:20'),
('PL004', 'PER002', 'JOB001', 'Fahri Andika Sanjaya', 'fahriandikasanjaya@gmail.com', '12e', '2025-05-26', 'ppp', 'S3', 1, '12e1', 'kmkn', 'cv_files/PL004_CV.pdf', 'Magang', '2025-05-26 05:15:50', '2025-05-26 05:24:40'),
('PL005', 'PER001', 'JOB003', 'Fahri Andika Sanjaya', 'fahriandikasanjaya@gmail.com', '085272127188', '2025-05-30', 'Komp mahdani hafairt blok a no 1', 'S3', 19, 'wada', 'awdawd', 'cv_files/PL005_CV.docx', 'Pending', '2025-05-29 14:59:21', '2025-05-29 14:59:21'),
('PL006', 'PER001', 'JOB004', 'Fahri Andika Sanjaya', 'fahriandikasanjaya@gmail.com', '085272127188', '2025-05-13', 'Komp mahdani hafairt blok a no 1', 'D3', 2, 'unand', 'dfs', 'cv_files/PL006_CV.docx', 'Pending', '2025-05-29 17:23:00', '2025-05-29 17:23:00'),
('PL008', 'PER001', 'JOB002', 'Fahri Andika Sanjaya', 'fahriandikasanjaya@gmail.com', '085272127188', '2025-05-13', '213', 'S2', 4, 'unand', '123', 'cv_files/PL008_CV.docx', 'Pending', '2025-05-29 17:34:34', '2025-05-29 17:34:34');

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
('PER001', 'Periode 1', '2025-05-26', '2025-07-26', 'wefwef', '2025-05-25 18:26:19', '2025-05-25 21:56:58', 4),
('PER002', 'pp', '2025-05-26', '2025-05-29', 'ppok', '2025-05-26 05:14:37', '2025-05-26 05:14:37', 4);

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
('PER001', 'JOB001', '2025-05-25 18:26:19', '2025-05-25 18:26:19'),
('PER001', 'JOB002', '2025-05-25 18:26:19', '2025-05-25 18:26:19'),
('PER001', 'JOB003', '2025-05-25 18:26:19', '2025-05-25 18:26:19'),
('PER001', 'JOB004', '2025-05-25 18:26:19', '2025-05-25 18:26:19'),
('PER001', 'JOB005', '2025-05-25 18:26:19', '2025-05-25 18:26:19'),
('PER001', 'JOB006', '2025-05-25 18:26:19', '2025-05-25 18:26:19'),
('PER002', 'JOB001', '2025-05-26 05:14:37', '2025-05-26 05:14:37'),
('PER002', 'JOB002', '2025-05-26 05:14:37', '2025-05-26 05:14:37'),
('PER002', 'JOB006', '2025-05-26 05:14:37', '2025-05-26 05:14:37');

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
('fjB9fyqxpYDziUdP5kQjHCAoSrGYBS60HTmgnQiT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGVIZUJnSDhmd25XRnNkamloZjZUUG8xWjFWVXNYREJLTHFwYlgyZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jnb3QtcGFzc3dvcmQiO319', 1748882118);

-- --------------------------------------------------------

--
-- Table structure for table `tes_kemampuan`
--

CREATE TABLE `tes_kemampuan` (
  `tes_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pelamar_id` varchar(50) NOT NULL,
  `catatan` text DEFAULT NULL,
  `jadwal` datetime DEFAULT NULL,
  `skor` int(11) DEFAULT 0,
  `status_seleksi` enum('Pending','Tidak Lulus','Lulus','Magang') DEFAULT 'Pending',
  `criteria_id` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_kemampuan`
--

INSERT INTO `tes_kemampuan` (`tes_id`, `user_id`, `pelamar_id`, `catatan`, `jadwal`, `skor`, `status_seleksi`, `criteria_id`, `created_at`, `updated_at`) VALUES
('TES006', 1, 'PL004', NULL, '2025-05-26 12:28:00', 94, 'Magang', 'TES_CRIT_JOB001', '2025-05-26 05:23:21', '2025-05-26 05:24:40'),
('TES007', 5, 'PL002', 'awdwad', '2025-06-17 03:32:00', 85, 'Magang', 'TES_CRIT_JOB004', '2025-05-31 17:32:13', '2025-05-31 17:56:52'),
('TES008', 5, 'PL001', NULL, '2025-06-01 03:41:00', 75, 'Magang', 'TES_CRIT_JOB001', '2025-05-31 17:41:50', '2025-05-31 17:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `tes_kemampuan_criteria`
--

CREATE TABLE `tes_kemampuan_criteria` (
  `criteria_id` varchar(50) NOT NULL,
  `job_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `weight` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_kemampuan_criteria`
--

INSERT INTO `tes_kemampuan_criteria` (`criteria_id`, `job_id`, `name`, `code`, `description`, `weight`, `created_at`, `updated_at`) VALUES
('TES_CRIT_JOB001', 'JOB001', 'Kemampuan Teknis', 'KT', 'Penilaian kemampuan teknis sesuai dengan posisi yang dilamar', 1.0000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_CRIT_JOB002', 'JOB002', 'Kemampuan Teknis', 'KT', 'Penilaian kemampuan teknis sesuai dengan posisi yang dilamar', 1.0000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_CRIT_JOB003', 'JOB003', 'Kemampuan Teknis', 'KT', 'Penilaian kemampuan teknis sesuai dengan posisi yang dilamar', 1.0000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_CRIT_JOB004', 'JOB004', 'Kemampuan Teknis', 'KT', 'Penilaian kemampuan teknis sesuai dengan posisi yang dilamar', 1.0000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_CRIT_JOB005', 'JOB005', 'Kemampuan Teknis', 'KT', 'Penilaian kemampuan teknis sesuai dengan posisi yang dilamar', 1.0000, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_CRIT_JOB006', 'JOB006', 'Kemampuan Teknis', 'KT', 'Penilaian kemampuan teknis sesuai dengan posisi yang dilamar', 1.0000, '2025-05-24 18:31:19', '2025-05-24 18:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `tes_kemampuan_rating_scales`
--

CREATE TABLE `tes_kemampuan_rating_scales` (
  `id` varchar(50) NOT NULL,
  `criteria_id` varchar(50) NOT NULL,
  `rating_level` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `min_score` int(11) DEFAULT NULL,
  `max_score` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_kemampuan_rating_scales`
--

INSERT INTO `tes_kemampuan_rating_scales` (`id`, `criteria_id`, `rating_level`, `name`, `description`, `min_score`, `max_score`, `created_at`, `updated_at`) VALUES
('TES_RS_001', 'TES_CRIT_JOB001', 1, 'Tidak Lulus', 'Kandidat tidak menunjukkan kemampuan dasar memasak yang diperlukan', 0, 59, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_RS_002', 'TES_CRIT_JOB001', 2, 'Kurang', 'Kandidat menunjukkan kemampuan dasar yang minimal, masih memerlukan banyak pelatihan', 60, 69, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_RS_003', 'TES_CRIT_JOB001', 3, 'Cukup', 'Kandidat menunjukkan kemampuan yang cukup, membutuhkan beberapa pelatihan tambahan', 70, 79, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_RS_004', 'TES_CRIT_JOB001', 4, 'Baik', 'Kandidat menunjukkan kemampuan yang baik, siap untuk posisi dengan sedikit pelatihan', 80, 89, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_RS_005', 'TES_CRIT_JOB001', 5, 'Sangat Baik', 'Kandidat menunjukkan kemampuan yang sangat baik, siap untuk posisi tanpa pelatihan tambahan', 90, 100, '2025-05-24 18:31:19', '2025-05-24 18:31:19'),
('TES_RS_006', 'TES_CRIT_JOB002', 1, 'Tidak Lulus', 'Kandidat tidak menunjukkan kemampuan dasar sebagai steward yang diperlukan', 0, 59, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_007', 'TES_CRIT_JOB002', 2, 'Kurang', 'Kandidat menunjukkan kemampuan dasar yang minimal, masih memerlukan banyak pelatihan', 60, 69, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_008', 'TES_CRIT_JOB002', 3, 'Cukup', 'Kandidat menunjukkan kemampuan yang cukup, membutuhkan beberapa pelatihan tambahan', 70, 79, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_009', 'TES_CRIT_JOB002', 4, 'Baik', 'Kandidat menunjukkan kemampuan yang baik, siap untuk posisi dengan sedikit pelatihan', 80, 89, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_010', 'TES_CRIT_JOB002', 5, 'Sangat Baik', 'Kandidat menunjukkan kemampuan yang sangat baik, siap untuk posisi tanpa pelatihan tambahan', 90, 100, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_011', 'TES_CRIT_JOB003', 1, 'Tidak Lulus', 'Kandidat tidak menunjukkan kemampuan dasar sebagai cook helper yang diperlukan', 0, 59, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_012', 'TES_CRIT_JOB003', 2, 'Kurang', 'Kandidat menunjukkan kemampuan dasar yang minimal, masih memerlukan banyak pelatihan', 60, 69, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_013', 'TES_CRIT_JOB003', 3, 'Cukup', 'Kandidat menunjukkan kemampuan yang cukup, membutuhkan beberapa pelatihan tambahan', 70, 79, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_014', 'TES_CRIT_JOB003', 4, 'Baik', 'Kandidat menunjukkan kemampuan yang baik, siap untuk posisi dengan sedikit pelatihan', 80, 89, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_015', 'TES_CRIT_JOB003', 5, 'Sangat Baik', 'Kandidat menunjukkan kemampuan yang sangat baik, siap untuk posisi tanpa pelatihan tambahan', 90, 100, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_016', 'TES_CRIT_JOB004', 1, 'Tidak Lulus', 'Kandidat tidak menunjukkan kemampuan dasar pastry yang diperlukan', 0, 59, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_017', 'TES_CRIT_JOB004', 2, 'Kurang', 'Kandidat menunjukkan kemampuan dasar yang minimal, masih memerlukan banyak pelatihan', 60, 69, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_018', 'TES_CRIT_JOB004', 3, 'Cukup', 'Kandidat menunjukkan kemampuan yang cukup, membutuhkan beberapa pelatihan tambahan', 70, 79, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_019', 'TES_CRIT_JOB004', 4, 'Baik', 'Kandidat menunjukkan kemampuan yang baik, siap untuk posisi dengan sedikit pelatihan', 80, 89, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_020', 'TES_CRIT_JOB004', 5, 'Sangat Baik', 'Kandidat menunjukkan kemampuan yang sangat baik, siap untuk posisi tanpa pelatihan tambahan', 90, 100, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_021', 'TES_CRIT_JOB005', 1, 'Tidak Lulus', 'Kandidat tidak menunjukkan kemampuan dasar barista yang diperlukan', 0, 59, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_022', 'TES_CRIT_JOB005', 2, 'Kurang', 'Kandidat menunjukkan kemampuan dasar yang minimal, masih memerlukan banyak pelatihan', 60, 69, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_023', 'TES_CRIT_JOB005', 3, 'Cukup', 'Kandidat menunjukkan kemampuan yang cukup, membutuhkan beberapa pelatihan tambahan', 70, 79, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_024', 'TES_CRIT_JOB005', 4, 'Baik', 'Kandidat menunjukkan kemampuan yang baik, siap untuk posisi dengan sedikit pelatihan', 80, 89, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_025', 'TES_CRIT_JOB005', 5, 'Sangat Baik', 'Kandidat menunjukkan kemampuan yang sangat baik, siap untuk posisi tanpa pelatihan tambahan', 90, 100, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_026', 'TES_CRIT_JOB006', 1, 'Tidak Lulus', 'Kandidat tidak menunjukkan kemampuan dasar cleaning service yang diperlukan', 0, 59, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_027', 'TES_CRIT_JOB006', 2, 'Kurang', 'Kandidat menunjukkan kemampuan dasar yang minimal, masih memerlukan banyak pelatihan', 60, 69, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_028', 'TES_CRIT_JOB006', 3, 'Cukup', 'Kandidat menunjukkan kemampuan yang cukup, membutuhkan beberapa pelatihan tambahan', 70, 79, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_029', 'TES_CRIT_JOB006', 4, 'Baik', 'Kandidat menunjukkan kemampuan yang baik, siap untuk posisi dengan sedikit pelatihan', 80, 89, '2025-05-25 20:42:34', '2025-05-25 20:42:34'),
('TES_RS_030', 'TES_CRIT_JOB006', 5, 'Sangat Baik', 'Kandidat menunjukkan kemampuan yang sangat baik, siap untuk posisi tanpa pelatihan tambahan', 90, 100, '2025-05-25 20:42:34', '2025-05-25 20:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `total_skor_minggu_magang`
--

CREATE TABLE `total_skor_minggu_magang` (
  `id` varchar(50) NOT NULL,
  `magang_id` varchar(50) NOT NULL,
  `minggu_ke` int(11) NOT NULL,
  `total_skor` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_skor_minggu_magang`
--

INSERT INTO `total_skor_minggu_magang` (`id`, `magang_id`, `minggu_ke`, `total_skor`, `created_at`, `updated_at`) VALUES
('0e63a501-337e-4e21-9072-7adb44c61690', 'MAG004', 4, 1.00, '2025-05-31 17:46:38', '2025-06-02 16:26:22'),
('2073d5c2-e5fd-488c-8b85-af3ee7bf0481', 'MAG003', 1, 1.00, '2025-05-26 05:26:11', '2025-05-26 05:27:15'),
('36cfaa5f-0182-402a-8583-4fa2383742b2', 'MAG004', 3, 0.00, '2025-05-31 17:46:38', '2025-06-02 16:26:22'),
('397181a9-ec26-4c5a-886c-9e78ed45f488', 'MAG005', 3, 0.00, '2025-05-31 17:53:32', '2025-06-02 16:26:22'),
('5a7b0afe-5644-4391-94b7-583890088b2c', 'MAG004', 2, 0.00, '2025-05-31 17:46:38', '2025-06-02 16:26:22'),
('5c52cd61-d331-4613-92ee-fc2de0b6151f', 'MAG005', 1, 0.00, '2025-05-31 17:53:32', '2025-06-02 16:30:26'),
('659bcfcc-ed2a-48c2-9edc-f5c920b245f0', 'MAG003', 3, 0.00, '2025-05-26 05:26:11', '2025-05-26 05:27:10'),
('7daea05c-9370-40c4-9929-f7a725ea736a', 'MAG005', 4, 0.00, '2025-05-31 17:53:32', '2025-06-02 16:26:22'),
('9a3d4f85-be11-417c-9674-4511024ad10c', 'MAG003', 2, 0.00, '2025-05-26 05:26:11', '2025-05-26 05:27:10'),
('af096535-0747-4412-b5c8-888415b5ac0a', 'MAG003', 4, 0.00, '2025-05-26 05:26:11', '2025-05-26 05:27:11'),
('d0528416-8ec1-427b-aacc-50f1b36beddc', 'MAG004', 1, 1.00, '2025-05-31 17:46:38', '2025-06-02 16:26:22'),
('ebf60d15-fc8f-4f36-a514-cf382759970d', 'MAG005', 2, 0.00, '2025-05-31 17:53:32', '2025-06-02 16:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','cook','pastry') NOT NULL DEFAULT 'admin',
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`, `email`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'hr_jiwaraga', '$2y$12$WIVHFZyu8TJYnMWSJo/3Z..t0IIyAbbk4mZ8daCy9SVKcmk9C3z5C', 'admin', 'jiwaraga@perusahaan.com', '2025-04-20 05:00:00', '2025-05-10 20:27:06', 'aruokd3rMkYBnOP0x4dowiF4dw9zAfk5sz2rDNBDFwyfa7JsrmI7VITxai3M'),
(2, 'cook', '$2y$12$3EqqNgvpwx.97vgLhkv3Q.jxLjCgYKxm2hLhY6pqQE7ZimrS5e0/u', 'cook', 'cook@perusahaan.com', '2025-04-20 05:00:00', '2025-06-02 16:34:35', 'WQxXN1KTZJeiiGMqR1jfhqMYTLsDfKdgdH8UtBnOpZLU0iD5Bne8UXDRKhKI'),
(3, 'pastry', '$2y$12$CmjDs5.XIqyWOBo77busku86IE74V1Eg4Jn5TBlADww77Q71QU./m', 'pastry', 'pastry@perusahaan.com', '2025-04-20 05:00:00', '2025-06-02 16:28:50', 'PV2jRPeK9B11NOualMtIHoYDCKL32DtOvP3MccGY3ePZzSLy3O3VdZsUSWWH'),
(4, 'fahri', 'ugytfty', 'admin', 'fahriandikasanjaya@gmail.com', '2025-05-23 17:02:57', '2025-05-23 17:02:57', NULL),
(5, 'admin', '$2y$12$/apcfmEP4.yyxVaJbiYJQOdApg5ag2vCGuHIr3AFzCOm/EFZEm2Ai', 'admin', 'admin@example.com', '2025-05-25 15:11:01', '2025-06-02 16:30:14', 'EKB9nxaBpjcqt20z8O4zOrCeNE21uak5anSJJT6ein3O6oxBpY3AlJtfdHil');

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
-- Indexes for table `criteria_rating_scales`
--
ALTER TABLE `criteria_rating_scales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_criteria_rating_level` (`criteria_id`,`rating_level`);

--
-- Indexes for table `evaluasi_mingguan_magang`
--
ALTER TABLE `evaluasi_mingguan_magang`
  ADD PRIMARY KEY (`evaluasi_id`),
  ADD UNIQUE KEY `UK_Evaluasi_Mingguan` (`magang_id`,`minggu_ke`,`criteria_id`),
  ADD KEY `IDX_Evaluasi_Mingguan_Magang_Minggu` (`magang_id`,`minggu_ke`),
  ADD KEY `fk_evaluasi_criteria` (`criteria_id`),
  ADD KEY `fk_evaluasi_criteria_rating` (`criteria_rating_id`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`interview_id`),
  ADD KEY `FK_Interview_Pelamar` (`pelamar_id`),
  ADD KEY `FK_Interview_User` (`user_id`),
  ADD KEY `fk_interview_qual_criteria` (`qualifikasi_criteria_id`),
  ADD KEY `fk_interview_komun_criteria` (`komunikasi_criteria_id`),
  ADD KEY `fk_interview_sikap_criteria` (`sikap_criteria_id`);

--
-- Indexes for table `interview_criteria`
--
ALTER TABLE `interview_criteria`
  ADD PRIMARY KEY (`criteria_id`),
  ADD KEY `IDX_Interview_Criteria_Job` (`job_id`);

--
-- Indexes for table `interview_rating_scales`
--
ALTER TABLE `interview_rating_scales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_interview_criteria_rating_level` (`criteria_id`,`rating_level`);

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
  ADD KEY `FK_Tes_kemampuan_User` (`user_id`),
  ADD KEY `fk_tes_kemampuan_criteria` (`criteria_id`);

--
-- Indexes for table `tes_kemampuan_criteria`
--
ALTER TABLE `tes_kemampuan_criteria`
  ADD PRIMARY KEY (`criteria_id`),
  ADD KEY `IDX_Tes_Kemampuan_Criteria_Job` (`job_id`);

--
-- Indexes for table `tes_kemampuan_rating_scales`
--
ALTER TABLE `tes_kemampuan_rating_scales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_tes_kemampuan_criteria_rating_level` (`criteria_id`,`rating_level`);

--
-- Indexes for table `total_skor_minggu_magang`
--
ALTER TABLE `total_skor_minggu_magang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_magang_minggu` (`magang_id`,`minggu_ke`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `criteria_rating_scales`
--
ALTER TABLE `criteria_rating_scales`
  ADD CONSTRAINT `fk_criteria_rating_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`criteria_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluasi_mingguan_magang`
--
ALTER TABLE `evaluasi_mingguan_magang`
  ADD CONSTRAINT `FK_Evaluasi_Mingguan_Magang_Magang` FOREIGN KEY (`magang_id`) REFERENCES `magang` (`magang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evaluasi_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`criteria_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_evaluasi_criteria_rating` FOREIGN KEY (`criteria_rating_id`) REFERENCES `criteria_rating_scales` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `interview`
--
ALTER TABLE `interview`
  ADD CONSTRAINT `FK_Interview_Pelamar` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`pelamar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Interview_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_interview_komun_criteria` FOREIGN KEY (`komunikasi_criteria_id`) REFERENCES `interview_criteria` (`criteria_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_interview_qual_criteria` FOREIGN KEY (`qualifikasi_criteria_id`) REFERENCES `interview_criteria` (`criteria_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_interview_sikap_criteria` FOREIGN KEY (`sikap_criteria_id`) REFERENCES `interview_criteria` (`criteria_id`) ON DELETE SET NULL;

--
-- Constraints for table `interview_criteria`
--
ALTER TABLE `interview_criteria`
  ADD CONSTRAINT `FK_Interview_Criteria_Job` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interview_rating_scales`
--
ALTER TABLE `interview_rating_scales`
  ADD CONSTRAINT `fk_interview_rating_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `interview_criteria` (`criteria_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_Tes_kemampuan_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tes_kemampuan_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `tes_kemampuan_criteria` (`criteria_id`) ON DELETE SET NULL;

--
-- Constraints for table `tes_kemampuan_criteria`
--
ALTER TABLE `tes_kemampuan_criteria`
  ADD CONSTRAINT `FK_Tes_Kemampuan_Criteria_Job` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tes_kemampuan_rating_scales`
--
ALTER TABLE `tes_kemampuan_rating_scales`
  ADD CONSTRAINT `fk_tes_kemampuan_rating_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `tes_kemampuan_criteria` (`criteria_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `total_skor_minggu_magang`
--
ALTER TABLE `total_skor_minggu_magang`
  ADD CONSTRAINT `fk_total_skor_magang` FOREIGN KEY (`magang_id`) REFERENCES `magang` (`magang_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
