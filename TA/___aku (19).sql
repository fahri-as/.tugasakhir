-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 09:20 PM
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_smart_details_MAG005', 'a:3:{s:7:\"details\";a:6:{i:1;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:0;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}}i:2;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}}i:3;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}}i:4;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}}i:5;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}}i:6;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}}}s:5:\"ranks\";a:6:{i:1;i:2;i:2;i:2;i:3;i:2;i:4;i:2;i:5;i:2;i:6;i:2;}s:9:\"timestamp\";i:1747163985;}', 1747250385),
('laravel_cache_smart_details_MAGqIrlIkUi', 'a:3:{s:7:\"details\";a:6:{i:1;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:0;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}}i:2;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}}i:3;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}}i:4;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}}i:5;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}}i:6;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";d:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}}}s:5:\"ranks\";a:6:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;i:5;i:1;i:6;i:1;}s:9:\"timestamp\";i:1747163985;}', 1747250385);

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
('1', 'JOB001', 'Keahlian Dasar Memasak', 'K1', 'Kemampuan dalam teknik dasar memasak seperti menumis, menggoreng, merebus, dll.', 0.4162, '2025-05-05 02:26:29', '2025-05-12 17:59:42'),
('10', 'JOB004', 'Kemampuan Kerja Sama Tim', 'K5', 'Kemampuan bekerja sama dalam tim dapur, komunikasi, dan koordinasi dengan anggota tim lain.', 0.0624, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('2', 'JOB001', 'Kualitas Hasil Masakan', 'K2', 'Kualitas rasa, penampilan, dan tekstur dari hasil masakan yang dihasilkan.', 0.2618, '2025-05-05 02:26:29', '2025-05-12 17:59:42'),
('3', 'JOB001', 'Pemahaman Kebersihan dan Keamanan', 'K3', 'Pemahaman dan implementasi standar kebersihan dan keamanan pangan dalam bekerja.', 0.1610, '2025-05-05 02:26:29', '2025-05-12 17:59:42'),
('4', 'JOB001', 'Konsistensi & Ketelitian', 'K4', 'Konsistensi hasil masakan dan ketelitian dalam proses persiapan dan pemasakan.', 0.0986, '2025-05-05 02:26:29', '2025-05-12 17:59:42'),
('5', 'JOB001', 'Kemampuan Kerja Sama Tim', 'K5', 'Kemampuan bekerja sama dalam tim dapur, komunikasi, dan koordinasi dengan anggota tim lain.', 0.0624, '2025-05-05 02:26:29', '2025-05-12 17:59:42'),
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
('00bbb334-550a-4bd7-98c2-e1232189a5d2', '5', '4', 2.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('01d69da7-197f-40e5-a4d7-bfcabdc62187', '3', '3', 1.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('03b7781a-8ca2-4ccf-88c1-000d6817bb1e', '7', '9', 0.3333, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('03c4e04d-95cb-4e07-97f8-f0385312a1aa', '10', '8', 3.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('043fe5b4-4823-4f2f-9636-07baf3d1fb97', '4', '3', 2.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('0ca2e769-150f-4f5b-99e0-91df7dd8abc9', '7', '8', 0.5000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('110a9a2f-cae5-4b0a-ac64-42ff34687031', '10', '6', 5.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('17675184-e0fb-4bb0-bd0b-cd3ffcc6cfc5', '10', '7', 4.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('21a139dd-e76d-40f5-a3c9-a9d1119084d0', '4', '5', 0.5000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('26cf4470-8fae-46ca-8073-3138108fde6f', '5', '5', 1.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('2b50b4fc-0c16-4d14-953a-a311ce1db059', '1', '1', 1.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('2b5fa091-42ed-4ae4-aefb-1c6f6130f913', '10', '9', 2.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('30401b7d-2d28-47c1-8965-d181c55f021a', '2', '5', 0.2500, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('33f5d765-b29f-4c47-836f-3b9c07a9cc3b', '8', '7', 2.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('368d2dac-292f-4899-b3db-18a8cffba860', '3', '4', 0.5000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('4d5ef8de-5f7c-4d9d-81d7-843242c8a12a', '3', '2', 2.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('4df4f170-e32b-4cd9-a620-eb294c17f804', '8', '6', 3.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('4f2da4cc-e674-4ba3-849e-5a797ba046f5', '9', '9', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('4f57863d-d1bc-42a1-a97d-db8447c621f9', '8', '8', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('50afbb9f-9f2d-4aa7-bf2d-51bd13ce308b', '8', '9', 0.5000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('5592c742-7b75-452a-b3cd-8076a4bcee2e', '4', '1', 4.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('56f6c370-b921-42b6-b466-f9023f2617b4', '5', '3', 3.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('58338f02-f988-4994-b2d3-a92a7329499d', '6', '6', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('5e5cdc94-e1d6-4c0c-8f4e-b6c1fcdbe32c', '9', '7', 3.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('648abfdd-2b04-49b9-b9c6-e2ab5e2924b6', '8', '10', 0.3333, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('6518499e-f437-410a-9551-ada1cc9dd037', '5', '2', 4.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('66be85d5-569c-4de0-9807-708cbbda4867', '9', '8', 2.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('69ee5d0a-1f32-47fb-9633-98c642303a59', '9', '6', 4.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('72e4f03f-14cb-4d5b-947e-5670fa1928a1', '4', '2', 3.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('81040d47-9317-4783-88ca-0c8e977b1b49', '1', '2', 0.5000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('87ce4f06-ad52-4fd1-8e4e-2c4e543255d7', '9', '10', 0.5000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('8b41dbb9-50cc-4875-8de4-37611c6df64b', '4', '4', 1.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('911d150f-9237-475f-b3ea-becb2647b693', '2', '4', 0.3333, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('949deaa5-5bf4-4f15-b66f-fdd43deaa61b', '10', '10', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('9b541e91-9638-468e-b612-d3e4d1c53dc1', '2', '1', 2.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('a7398017-1539-43ea-9b7d-77901f4e1848', '6', '10', 0.2000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('af44dd82-7f53-40b3-8e36-6cd38f49bb97', '3', '1', 3.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('b1b12d2c-7643-4e6a-88e0-a3cc9ec4ea35', '1', '5', 0.2000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('b217d082-6a68-4a5e-ad77-0fa277cc557b', '6', '7', 0.5000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('c03f30b9-548a-4dab-ae78-73918a8cb28d', '1', '3', 0.3333, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('c3a78d57-b512-4608-855e-98a6fe7005a8', '1', '4', 0.2500, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('d1fa19fc-ed5f-403a-954c-d77a90c8bbd1', '2', '3', 0.5000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('d23e2ce8-15f3-4abb-9a13-3d48d6bd8af3', '7', '10', 0.2500, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('d445286d-d84d-41e3-8c03-f92c9e7ae7df', '6', '9', 0.2500, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('d58f4880-97d5-4542-aeb3-c9e8a490484b', '2', '2', 1.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('da8fa4bb-6ba0-4a46-b74a-e440db868efa', '5', '1', 5.0000, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('ef733f13-2118-4480-9b89-6bb8e569b63a', '3', '5', 0.3333, '2025-05-13 00:59:42', '2025-05-12 17:59:42'),
('f69859d0-1697-4f3d-952c-08227e7a3c06', '7', '7', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('f75825d1-c00d-44e5-91a2-c75b998c9ed2', '6', '8', 0.3333, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('feea5a84-cb2d-45b8-96ba-931784008962', '7', '6', 2.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_mingguan_magang`
--

CREATE TABLE `evaluasi_mingguan_magang` (
  `evaluasi_id` varchar(50) NOT NULL,
  `magang_id` varchar(50) NOT NULL,
  `rating_id` varchar(50) DEFAULT NULL,
  `criteria_id` varchar(50) DEFAULT NULL,
  `minggu_ke` int(11) NOT NULL,
  `skor_minggu` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluasi_mingguan_magang`
--

INSERT INTO `evaluasi_mingguan_magang` (`evaluasi_id`, `magang_id`, `rating_id`, `criteria_id`, `minggu_ke`, `skor_minggu`, `created_at`, `updated_at`) VALUES
('01d71555-9dbc-407e-9fbe-a6f4792869b0', 'MAGqIrlIkUi', '3', '1', 5, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('01feb11e-3977-4c45-9232-889fd3f4ff80', 'MAG006', NULL, '5', 5, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('02bad171-d1fc-430b-9d96-513b6d334d2d', 'MAGqIrlIkUi', '3', '5', 3, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('02d412dd-d6b4-4e47-a4f4-498bb3efde8a', 'MAG005', '3', '4', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0370a101-87a4-4d99-96fd-7843c8131062', 'MAG005', '3', '4', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0422b647-fba9-4890-a00f-44f9d3efb4d8', 'MAG005', '3', '4', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('04c9cf52-1712-48bb-9dbe-cb082634a967', 'MAGqIrlIkUi', '3', '4', 3, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('0875e229-a9d4-4337-9b7c-a06c44a68c91', 'MAG005', '3', '3', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0a7aa6c3-4aa2-4589-939b-a4753560e9bd', 'MAG006', NULL, '1', 2, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('0af9cf7f-d5d6-465a-9e7a-d591a7225a60', 'MAG005', '3', '2', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0cc7662e-0591-445d-95d1-aaaed306dc18', 'MAG004', '3', '7', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('0fb88368-c0da-4fc7-b6aa-f7e44d63a731', 'MAG004', '3', '10', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('1033ba38-8501-43ca-958b-a6c6274f4076', 'MAG004', '3', '6', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('10ec686a-2507-4ccb-aef8-d3828aa7deea', 'MAG006', '2', '4', 1, 2.00, '2025-05-13 12:12:47', '2025-05-13 12:19:44'),
('14f1a9d9-6903-4316-8183-6fe1698f5fc7', 'MAG005', '3', '5', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('1689c9eb-2f63-40c2-89da-18e1de82bf15', 'MAG005', '3', '3', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('184d60d8-b3dd-4113-86a6-d717a59d1233', 'MAGqIrlIkUi', '3', '4', 4, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('1a4612c0-6b71-4cb9-a287-1b7c4411067b', 'MAG004', '3', '8', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('1d3b4b56-8ea4-4a40-ad5f-dbff5881ac5e', 'MAG005', '3', '1', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('1e4f8cfa-a605-44c6-adb7-39ee24c00e5b', 'MAGqIrlIkUi', '3', '5', 1, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('1f03c226-3371-457a-99f1-40f13bb61bdc', 'MAG005', '3', '3', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('267d73be-258d-437b-bef0-5f042c5436af', 'MAG005', '3', '5', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('286eaaf2-f06f-4cef-b8f9-53b1b7fae66c', 'MAGqIrlIkUi', '3', '4', 5, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('29da804a-ebd4-40f9-a348-5ff27188d626', 'MAGqIrlIkUi', '3', '2', 6, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('2a5b73a2-fbfd-43e2-be47-97351994415d', 'MAG006', NULL, '1', 5, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('2aa769bf-0493-4e10-9a62-85cc4b2535aa', 'MAG005', '3', '1', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('2db1b09b-c9c4-45ce-bb44-cc9075800179', 'MAG005', '3', '3', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('2f945b08-de77-4985-a487-f32e9000c974', 'MAG005', '3', '1', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('342a3e0a-bf9b-42e0-9501-886331acb945', 'MAG006', NULL, '5', 6, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('3f96ed1e-73e7-4cf9-b480-855003bcea61', 'MAGqIrlIkUi', '3', '3', 4, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('403ff669-e631-4524-9635-8bf2a34bdf1f', 'MAG005', '3', '1', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('4597f533-fef2-44db-b7dd-5944c9f9d39e', 'MAGqIrlIkUi', '3', '3', 1, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('49a8e7c1-666b-43eb-94e3-ff0faa384841', 'MAGqIrlIkUi', '3', '5', 2, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('4da2509c-2a47-446b-b82c-e76dcc4cfcb6', 'MAGqIrlIkUi', '3', '4', 2, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('4dba5bd3-8e87-4b09-95c9-a7783664a615', 'MAG005', '3', '5', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('4fa83d61-7720-46ca-885b-7c8857cb64b1', 'MAGqIrlIkUi', '3', '1', 6, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('5076a52f-62a7-46c7-b46e-b1276f42f0b9', 'MAGqIrlIkUi', '3', '4', 6, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('51600094-ab87-473d-959f-f84d5fefc3ff', 'MAG006', NULL, '2', 3, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('5178fa50-c6c1-4eb2-ab36-68febeb889c2', 'MAG005', '3', '4', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('52905216-92d1-4d9c-aa0e-950ac6607b7e', 'MAGqIrlIkUi', '3', '2', 2, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('52fe7e80-d419-4f29-bb63-2a5273490b85', 'MAG006', NULL, '2', 2, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('5309244a-f4ed-4816-8226-7b5dd8cb2c7f', 'MAG006', NULL, '3', 3, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('54b6df8d-c3df-457c-a497-2e671577430b', 'MAG005', '3', '5', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('58d26e28-a25e-4416-9ee4-e5fcfaa3ab4b', 'MAG006', NULL, '5', 4, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('590b6805-601d-49bb-93b6-fc90742ce4f9', 'MAG005', '3', '5', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('593db108-5aba-4930-87e7-ab1e8a42a618', 'MAG004', '3', '7', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('595de64f-56f8-4a77-bba1-d150706168d4', 'MAG005', '3', '1', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('5a78a98b-a810-4413-a914-09f1ee96b66e', 'MAG006', NULL, '4', 3, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('5a90211b-6c17-4fca-8fb4-66ba3d6747f6', 'MAG006', NULL, '3', 5, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('61654292-50f7-4b22-b69b-78f3804df44f', 'MAG006', NULL, '1', 6, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('651d72bf-ee1f-461d-b3c4-7540cad5de8a', 'MAG004', '3', '6', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('67a0ffdd-32cf-45b6-9cd2-c449ab9aecc1', 'MAG004', '3', '10', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('67a4c506-b3bc-46d8-b28f-a9cd80ac9ecf', 'MAG004', '3', '7', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('686908d5-4f32-4b26-9b3a-c45aaa789122', 'MAG004', '3', '10', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('6b47e018-6f81-47bb-a0a4-8e36b31f3377', 'MAG004', '3', '9', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('6ca06425-8422-48c6-b095-256bf2403b58', 'MAG006', NULL, '4', 6, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('6e42d08f-f1ad-43ea-8f2b-82680a33dc33', 'MAG004', '3', '9', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('74c309a7-f429-4593-a0aa-82319df12f75', 'MAGqIrlIkUi', '3', '2', 3, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('77a1a809-062a-458d-b13a-bfc8b24949dd', 'MAG006', NULL, '4', 4, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('78e4c377-1c56-423f-9b71-3220400af852', 'MAG006', NULL, '2', 4, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('792bf4cc-3d35-43ba-8204-4c59a1cf3695', 'MAG004', '3', '8', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('7a060814-4c3b-43c6-83cd-6b0a6b8f4f58', 'MAGqIrlIkUi', '3', '2', 5, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('7a37f70e-398c-4dbe-be3b-a8a1f560c421', 'MAG006', NULL, '3', 2, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('7ff171f7-5801-4bb6-9a86-7cb74506da1c', 'MAG006', '4', '5', 1, 4.00, '2025-05-13 12:12:47', '2025-05-13 12:19:45'),
('83239ac2-600c-4a44-9189-6415873fe0c3', 'MAG004', '3', '9', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('84ee7f47-7eaf-4157-906e-62edc5a21957', 'MAG006', NULL, '1', 4, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('942367f5-0343-4e5d-9a2c-69dad504bc6c', 'MAG006', NULL, '2', 6, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('95bec172-9ac1-4ba0-afbf-ceb90193f1a4', 'MAG004', '3', '6', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('978ca3cf-1fdc-4eac-bd2d-2d5e4f5ee9e3', 'MAG005', '3', '2', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('9dcb87ff-7a60-45fe-8c83-6b7133e80d27', 'MAG005', '3', '3', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('a5729ce5-b36c-40dd-ac82-c78bdf27b09b', 'MAGqIrlIkUi', '3', '5', 5, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('a638f598-4487-4709-b528-0f4deb4e52fd', 'MAGqIrlIkUi', '3', '3', 6, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('a723e7ab-cb01-4deb-80c8-bc21339ae9d3', 'MAG006', NULL, '5', 2, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('a8e288e3-c60e-4773-b6af-5ad47c69206b', 'MAG006', NULL, '1', 3, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('a92ddaf6-17a2-430a-8037-fcd55f9ab241', 'MAG006', '3', '3', 1, 3.00, '2025-05-13 12:12:47', '2025-05-13 12:19:43'),
('aa7f333e-9a1c-49fe-84e1-cb1bba04e5f1', 'MAG004', '3', '9', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('ad95b5c4-584e-406d-81c2-c9d1ce397aa3', 'MAG006', NULL, '2', 5, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('b2f74bba-aa28-45a2-b625-54d5bf321e25', 'MAG005', '3', '1', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('b3f18a09-a61e-4119-a600-86cd397a02f4', 'MAGqIrlIkUi', '3', '5', 4, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('b51284c4-9f15-49cb-ace7-6507455db653', 'MAG006', NULL, '5', 3, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('b5651a14-e43f-4375-8c96-4e7ccaa3973d', 'MAG005', '3', '5', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('b64822b4-3207-45ec-8b94-5e367318abd8', 'MAG006', NULL, '3', 6, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('b9cd6ebe-09e5-4c53-9539-618f486bc3d3', 'MAG004', '3', '8', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('bb78cf91-6d96-4ba8-a2bd-35ebb77dbea6', 'MAGqIrlIkUi', '3', '1', 4, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('bc649b4c-cca1-4b76-809c-4e540bf6b638', 'MAG006', NULL, '4', 5, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('c2717cde-dec8-45d8-aafe-ea805d5bdcdd', 'MAG005', '3', '4', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('c547dff3-a16a-46c7-aac3-d0bc05bd5bd2', 'MAG005', '3', '3', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('c9eb9969-b39a-43cb-a26a-1d4a733aaa83', 'MAG005', '3', '4', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('ca8cd9b7-fb01-4bf7-bbcc-822813ced22f', 'MAG004', '3', '7', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('cbb9b069-9aad-40ca-81e3-9411726b124d', 'MAG006', NULL, '4', 2, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('ccebd969-0ece-44ea-bf24-64da379358f0', 'MAG004', '3', '10', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('d2094158-462a-4b5e-956d-bcb72dceef02', 'MAGqIrlIkUi', '3', '5', 6, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('d2299b6b-c9ff-4b1f-be1f-dfc7ef69d2b9', 'MAGqIrlIkUi', '3', '3', 5, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('d6b6e194-e569-44a6-b85e-6018ad5edd52', 'MAG005', '3', '2', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('dbccea0e-30c6-40eb-a922-de2a8649f779', 'MAGqIrlIkUi', '3', '1', 1, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('df4149f9-a77d-4785-9b17-89ad83275878', 'MAGqIrlIkUi', '3', '3', 2, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('e032d24e-7612-4397-9384-9a0188604e29', 'MAGqIrlIkUi', '3', '2', 4, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('e1c29744-efa7-49f7-8d57-e27e9c3adca8', 'MAGqIrlIkUi', '3', '1', 3, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('e9945b65-8341-4657-bf7d-185d9a00d59f', 'MAG006', NULL, '3', 4, 0.00, '2025-05-13 12:12:47', '2025-05-13 12:12:47'),
('ef6cf83c-0c39-465d-a5da-b658d60b4dd5', 'MAGqIrlIkUi', '3', '3', 3, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('ef733031-5c29-4aa1-bea7-fe0eb658c95e', 'MAG006', '2', '2', 1, 2.00, '2025-05-13 12:12:47', '2025-05-13 12:18:39'),
('f5b508ab-70f9-4a3f-8a57-aa316bb939e0', 'MAG004', '3', '8', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('f7622214-e3d7-45bf-8933-0ecf7326991d', 'MAGqIrlIkUi', '3', '2', 1, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('f77abb7c-8c32-4e8d-a696-fb4b52878852', 'MAG005', '3', '2', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('f8e119a7-5147-4350-b23f-efee4efb0861', 'MAG005', '3', '2', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('fa2314f7-621f-4828-84da-ff73ce29860b', 'MAG005', '3', '2', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('fe1f0a99-295e-4a78-919d-1aa37710c493', 'MAG004', '3', '6', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('fe249a97-73d8-4144-9d7c-cd5ffadcbaa7', 'MAGqIrlIkUi', '3', '1', 2, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54'),
('fefb4e9d-dcb4-4c8c-bfd6-59d78e80ebab', 'MAGqIrlIkUi', '3', '4', 1, 3.00, '2025-05-13 10:27:54', '2025-05-13 10:27:54');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`interview_id`, `pelamar_id`, `user_id`, `kualifikasi_skor`, `komunikasi_skor`, `sikap_skor`, `total_skor`, `jadwal`, `status_seleksi`, `created_at`, `updated_at`) VALUES
('INT001', 'PL001', 1, 4, 4, 4, 4.00, '2025-05-01 00:00:00', 'Pending', '2025-04-20 05:00:00', '2025-05-06 11:03:27'),
('INT002', 'PL002', 2, 5, 5, 5, 5.00, '2025-05-02 00:00:00', 'Pending', '2025-04-20 05:00:00', '2025-05-06 11:03:40'),
('INT004', 'PL012', 2, 0, 0, 0, 0.00, '2025-05-12 10:30:00', 'Tes Kemampuan', '2025-05-11 19:14:27', '2025-05-11 19:43:53'),
('INT005', 'PL011', 2, 0, 0, 0, 0.00, '2025-05-12 10:35:00', 'Tes Kemampuan', '2025-05-11 19:14:41', '2025-05-11 19:15:45'),
('INT007', 'PL013', 2, 0, 0, 0, 0.00, '2025-05-12 11:00:00', 'Tes Kemampuan', '2025-05-11 19:50:37', '2025-05-11 19:50:48'),
('INT008', 'PL009', 2, 0, 0, 0, 0.00, '2025-05-12 11:00:00', 'Tes Kemampuan', '2025-05-11 19:58:32', '2025-05-11 20:00:14'),
('INT009', 'PL010', 2, 0, 0, 0, 0.00, '2025-05-15 01:30:00', 'Tes Kemampuan', '2025-05-13 10:25:57', '2025-05-13 10:27:22'),
('INT010', 'PL005', 2, 0, 0, 0, 0.00, '2025-05-15 01:30:00', 'Tes Kemampuan', '2025-05-13 10:26:12', '2025-05-13 10:27:39');

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
  `status_seleksi` enum('Pending','Lulus','Tidak Lulus','Sedang Berjalan') DEFAULT 'Pending',
  `jadwal_mulai` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `magang`
--

INSERT INTO `magang` (`magang_id`, `pelamar_id`, `user_id`, `total_skor`, `rank`, `status_seleksi`, `jadwal_mulai`, `created_at`, `updated_at`) VALUES
('MAG001', 'PL001', 1, 0.00, 1, 'Lulus', NULL, '2025-04-20 05:00:00', '2025-05-12 11:04:16'),
('MAG002', 'PL002', 2, 0.00, NULL, 'Pending', NULL, '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('MAG004', 'PL012', 2, 0.00, NULL, 'Sedang Berjalan', '2025-05-13 01:30:00', '2025-05-12 10:28:26', '2025-05-12 10:28:26'),
('MAG005', 'PL011', 2, 4.99, 2, 'Sedang Berjalan', '2025-05-14 01:30:00', '2025-05-13 10:09:11', '2025-05-13 12:19:45'),
('MAG006', 'PL005', 2, 0.05, 3, 'Sedang Berjalan', '2025-05-14 03:30:00', '2025-05-13 12:12:47', '2025-05-13 12:19:45'),
('MAGmE1y3NaD', 'PL007', 2, 0.00, 4, 'Tidak Lulus', NULL, '2025-05-12 11:04:16', '2025-05-12 11:04:16'),
('MAGqIrlIkUi', 'PL010', 2, 4.99, 1, 'Sedang Berjalan', '2025-05-15 01:30:00', '2025-05-12 11:04:16', '2025-05-13 12:19:45'),
('MAGScLpDJ4i', 'PL006', 2, 0.00, 3, 'Tidak Lulus', NULL, '2025-05-12 11:04:16', '2025-05-12 11:04:16');

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
(3, '2025_05_13_190513_update_evaluasi_mingguan_magang_table_make_rating_nullable', 3);

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
  `status_seleksi` enum('Pending','Interview','Sedang Berjalan') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`pelamar_id`, `periode_id`, `job_id`, `nama`, `email`, `nomor_wa`, `tgl_lahir`, `alamat`, `pendidikan`, `lama_pengalaman`, `tempat_pengalaman`, `deskripsi_tempat`, `berkas_cv`, `status_seleksi`, `created_at`, `updated_at`) VALUES
('PL001', 'PER001', 'JOB001', 'John Doe', 'john.doe@example.com', '08123456789', '1990-01-01', 'Jakarta', 'S1', 5, 'PT. ABC', 'Pengalaman kerja di perusahaan besar.', 'cv_johndoe.pdf', 'Sedang Berjalan', '2025-04-20 05:00:00', '2025-05-08 18:00:45'),
('PL002', 'PER001', 'JOB002', 'Jane Smith', '  jane.smith@example.com', '08123456789', '1990-01-01', 'Jakarta', 'S1', 5, 'PT. ABC', 'Pengalaman kerja di perusahaan besar.', 'cv_janesmith.pdf', 'Pending', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PL003', 'PER002', 'JOB003', 'Alice Johnson', 'alice.johnson@example.com', '08123456789', '1990-01-01', 'Jakarta', 'S1', 5, 'PT. ABC', 'Pengalaman kerja di perusahaan besar.', 'cv_alicejohnson.pdf', 'Pending', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PL004', 'PER001', 'JOB002', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 2, NULL, NULL, NULL, 'Pending', '2025-05-07 13:05:49', '2025-05-07 13:05:49'),
('PL005', 'PER002', 'JOB001', 'Fahri An', 'fahriabangpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 4, 'wqeqwe', '111', '/storage/cv_files/PL005_CV.pdf', 'Sedang Berjalan', '2025-05-07 13:17:36', '2025-05-13 12:12:47'),
('PL006', '12', 'JOB001', 'Fahri Andika Sanjaya', 'fahriabangpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 2, 'wqeqwe', 'wqdqwe', '/storage/cv_files/PL006_CV.pdf', 'Pending', '2025-05-07 13:27:31', '2025-05-07 13:27:31'),
('PL007', '12', 'JOB001', 'Fahri Andika Sanjaya', 'fahriabangpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 4, 'wqeqwe', 'wqeqwe', 'cv_files/PL007_CV.pdf', 'Pending', '2025-05-07 13:49:32', '2025-05-07 13:49:32'),
('PL008', '12', 'JOB004', 'Fahri Andika Sanjaya', 'fahriabangpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 4, 'wqeqwe', 'wqeqwe', 'cv_files/PL008_CV.pdf', 'Pending', '2025-05-07 16:58:03', '2025-05-07 16:58:03'),
('PL009', 'PER002', 'JOB003', 'Fahri Andika Sanjaya', 'fahriabangpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 9, 'wqeqwe', 'gdfsgsdfgsg', 'cv_files/PL009_CV.pdf', 'Interview', '2025-05-08 18:04:49', '2025-05-11 19:58:32'),
('PL010', 'PER002', 'JOB001', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 9, 'wqeqwe', 'gdfsgsdfgsg', 'cv_files/PL010_CV.pdf', 'Sedang Berjalan', '2025-05-10 12:12:42', '2025-05-13 10:27:54'),
('PL011', 'PER002', 'JOB001', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 4, 'wqeqwe', '1', 'cv_files/PL011_CV.docx', 'Sedang Berjalan', '2025-05-11 19:13:22', '2025-05-13 10:09:11'),
('PL012', 'PER002', 'JOB004', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 1, 'wqeqwe', '1', 'cv_files/PL012_CV.docx', 'Sedang Berjalan', '2025-05-11 19:13:56', '2025-05-12 10:28:26'),
('PL013', 'PER002', 'JOB005', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 3, 'wqeqwe', '1', 'cv_files/PL013_CV.pdf', 'Interview', '2025-05-11 19:50:27', '2025-05-11 19:50:37');

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
('PER002', 'Periode 2', '2025-06-01', '2025-07-01', 'Periode kedua untuk rekrutmen.', '2025-04-20 05:00:00', '2025-05-12 20:22:02', 6);

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
('PER001', 'JOB006', '2025-05-11 15:25:43', '2025-05-11 15:25:43'),
('PER002', 'JOB001', '2025-05-11 19:12:54', '2025-05-11 19:12:54'),
('PER002', 'JOB002', '2025-05-11 19:12:54', '2025-05-11 19:12:54'),
('PER002', 'JOB003', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PER002', 'JOB004', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PER002', 'JOB005', '2025-05-11 15:07:34', '2025-05-11 15:07:34');

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
('9VPqRo3Wh6Uej3iQeeLj65iamNDmdaFwEf6M2HxJ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ3p2bTIxemNhRXV1NU1iamdzMlJtTUxUTUR3OGw4WlowVVJQR00yaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkvZXZhbHVhdGlvbnM/cGVyaW9kZV9pZD1QRVIwMDImd2Vlaz0xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1747163985);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_kemampuan`
--

INSERT INTO `tes_kemampuan` (`tes_id`, `user_id`, `pelamar_id`, `catatan`, `jadwal`, `skor`, `status_seleksi`, `created_at`, `updated_at`) VALUES
('TES001', 1, 'PL001', 'Tes kemampuan memasak dasar.', '2025-05-10 00:00:00', 85, 'Pending', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('TES002', 2, 'PL002', 'Tes kemampuan memasak dasar.', '2025-05-11 00:00:00', 80, 'Pending', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('TES006', 2, 'PL011', NULL, '2025-05-12 10:30:00', 0, 'Magang', '2025-05-11 19:15:45', '2025-05-13 10:09:11'),
('TES008', 2, 'PL012', NULL, '2025-05-12 11:00:00', 0, 'Magang', '2025-05-11 19:43:53', '2025-05-12 10:28:26'),
('TES009', 2, 'PL013', NULL, '2025-05-12 11:00:00', 0, 'Pending', '2025-05-11 19:50:48', '2025-05-11 19:50:58'),
('TES010', 2, 'PL009', NULL, '2025-05-12 11:30:00', 0, 'Pending', '2025-05-11 20:00:14', '2025-05-11 20:00:14'),
('TES011', 2, 'PL010', NULL, '2025-05-15 01:30:00', 0, 'Magang', '2025-05-13 10:27:22', '2025-05-13 10:27:54'),
('TES012', 2, 'PL005', NULL, '2025-05-15 01:30:00', 0, 'Magang', '2025-05-13 10:27:39', '2025-05-13 12:12:47');

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL
) ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'hr_jiwaraga', '$2y$12$WIVHFZyu8TJYnMWSJo/3Z..t0IIyAbbk4mZ8daCy9SVKcmk9C3z5C', 'jiwaraga@perusahaan.com', 'hr', '2025-04-20 05:00:00', '2025-05-10 20:27:06', 'aruokd3rMkYBnOP0x4dowiF4dw9zAfk5sz2rDNBDFwyfa7JsrmI7VITxai3M'),
(2, 'cook', '$2y$12$3EqqNgvpwx.97vgLhkv3Q.jxLjCgYKxm2hLhY6pqQE7ZimrS5e0/u', 'cook@perusahaan.com', 'cook', '2025-04-20 05:00:00', '2025-05-11 22:57:43', 'mvilBn5GJfPc7p4RAyOFpDGcHdn0bGkKuSSBJ4V0AGyWcyDc4Ic55WKCxTQO'),
(3, 'pastry', '$2y$12$CmjDs5.XIqyWOBo77busku86IE74V1Eg4Jn5TBlADww77Q71QU./m', 'pastry@perusahaan.com', 'pastry', '2025-04-20 05:00:00', '2025-05-08 23:40:59', 'FBB5Fg7HVKmYnvIyq0reutAWrdpVMKQLgOdTGp6s1KfZ5iRioc9swTBQ7nEM');

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
  ADD UNIQUE KEY `UK_Evaluasi_Mingguan` (`magang_id`,`minggu_ke`,`criteria_id`),
  ADD KEY `FK_Evaluasi_Mingguan_Magang_Rating_Scales` (`rating_id`),
  ADD KEY `IDX_Evaluasi_Mingguan_Magang_Minggu` (`magang_id`,`minggu_ke`),
  ADD KEY `fk_evaluasi_criteria` (`criteria_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `FK_Evaluasi_Mingguan_Magang_Rating_Scales` FOREIGN KEY (`rating_id`) REFERENCES `rating_scales` (`rating_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evaluasi_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`criteria_id`) ON DELETE SET NULL;

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
