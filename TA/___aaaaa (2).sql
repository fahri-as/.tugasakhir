-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 09:07 PM
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
-- Database: `...aaaaa`
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
('laravel_cache_smart_details_MAG005', 'a:3:{s:7:\"details\";a:6:{i:1;a:4:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:3;s:16:\"normalized_value\";d:0.5;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.0805;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:3;s:16:\"normalized_value\";d:0.5;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0312;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:4;s:16:\"normalized_value\";d:0.75;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.19634999999999997;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:2;s:16:\"normalized_value\";d:0.25;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.02465;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:2;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:4;s:16:\"normalized_value\";d:0.75;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.19634999999999997;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:3;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:2;s:16:\"normalized_value\";d:0.25;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.02465;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:3;s:16:\"normalized_value\";d:0.5;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.2081;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:4;a:1:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:3;s:16:\"normalized_value\";d:0.5;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.2081;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:5;a:0:{}i:6;a:0:{}}s:5:\"ranks\";a:6:{i:1;i:3;i:2;i:2;i:3;i:2;i:4;i:3;i:5;i:3;i:6;i:3;}s:9:\"timestamp\";i:1748181776;}', 1748268176),
('laravel_cache_smart_details_MAG007', 'a:3:{s:7:\"details\";a:6:{i:1;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:2;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:3;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:4;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:5;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:6;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}}s:5:\"ranks\";a:6:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;i:5;i:1;i:6;i:1;}s:9:\"timestamp\";i:1748181776;}', 1748268176),
('laravel_cache_smart_details_MAG008', 'a:3:{s:7:\"details\";a:6:{i:1;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:2;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:3;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:4;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:5;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}i:6;a:5:{i:0;a:9:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:1;a:9:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:2;a:9:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";i:5;s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:3;a:9:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}i:4;a:9:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";i:1;s:16:\"normalized_value\";i:0;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0;s:9:\"min_value\";i:1;s:9:\"max_value\";i:5;}}}s:5:\"ranks\";a:6:{i:1;i:2;i:2;i:3;i:3;i:3;i:4;i:2;i:5;i:2;i:6;i:2;}s:9:\"timestamp\";i:1748181776;}', 1748268176);

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
('02d412dd-d6b4-4e47-a4f4-498bb3efde8a', 'MAG005', NULL, '4', 5, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0316e2dc-a05e-45e5-a455-e71a96cdcc9b', 'MAG008', 'CRS0301', '3', 2, '2025-05-21 20:33:53', '2025-05-22 08:09:54'),
('0370a101-87a4-4d99-96fd-7843c8131062', 'MAG005', 'CRS0402', '4', 3, '2025-05-13 10:09:11', '2025-05-22 09:31:00'),
('0422b647-fba9-4890-a00f-44f9d3efb4d8', 'MAG005', 'CRS0405', '4', 2, '2025-05-13 10:09:11', '2025-05-22 09:06:07'),
('0875e229-a9d4-4337-9b7c-a06c44a68c91', 'MAG005', 'CRS0305', '3', 3, '2025-05-13 10:09:11', '2025-05-22 09:30:42'),
('09698cdf-9eda-4f78-a71b-ed4d2c9f623a', 'MAG008', 'CRS0301', '3', 1, '2025-05-21 20:33:53', '2025-05-22 08:09:41'),
('0aae0901-d9e7-4491-bc3c-b90c0f8233ca', 'MAG008', 'CRS0305', '3', 3, '2025-05-21 20:33:53', '2025-05-23 10:11:37'),
('0af9cf7f-d5d6-465a-9e7a-d591a7225a60', 'MAG005', NULL, '2', 5, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0b68f5e3-592b-4a82-a942-3f869a4927fb', 'MAG007', 'CRS0505', '5', 1, '2025-05-21 18:16:30', '2025-05-22 09:55:08'),
('0c7aeb49-7735-419f-b88c-68c1445c1907', 'MAG007', 'CRS0405', '4', 4, '2025-05-21 18:16:30', '2025-05-25 14:02:16'),
('112acbe5-d105-41aa-80e2-c47cd0c84cbd', 'MAG008', 'CRS0501', '5', 4, '2025-05-21 20:33:53', '2025-05-22 08:10:46'),
('14f1a9d9-6903-4316-8183-6fe1698f5fc7', 'MAG005', NULL, '5', 6, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('15f7c8da-f0e9-4f02-a0a4-e339c46a4ce3', 'MAG008', 'CRS0501', '5', 2, '2025-05-21 20:33:53', '2025-05-22 08:09:57'),
('1689c9eb-2f63-40c2-89da-18e1de82bf15', 'MAG005', 'CRS0303', '3', 1, '2025-05-13 10:09:11', '2025-05-21 18:08:07'),
('16abce8c-8882-4b72-85e2-bff9574df9fa', 'MAG008', 'CRS0501', '5', 6, '2025-05-21 20:33:53', '2025-05-22 08:11:17'),
('17edea7f-3088-482b-a449-26ab2de19ebb', 'MAG008', 'CRS0201', '2', 5, '2025-05-21 20:33:53', '2025-05-22 08:10:57'),
('18c06973-d4c0-4725-857c-b5b3a234a92a', 'MAG008', 'CRS0301', '3', 5, '2025-05-21 20:33:53', '2025-05-22 08:10:59'),
('1a3cbfe4-efbc-44ed-8540-69e183f3e72f', 'MAG007', 'CRS0205', '2', 1, '2025-05-21 18:16:30', '2025-05-21 19:05:27'),
('1a77344f-c060-4f2e-a353-d20695b8aa87', 'MAG007', 'CRS0105', '1', 2, '2025-05-21 18:16:30', '2025-05-22 06:37:12'),
('1d3b4b56-8ea4-4a40-ad5f-dbff5881ac5e', 'MAG005', 'CRS0105', '1', 2, '2025-05-13 10:09:11', '2025-05-22 08:59:08'),
('1f03c226-3371-457a-99f1-40f13bb61bdc', 'MAG005', 'CRS0305', '3', 2, '2025-05-13 10:09:11', '2025-05-22 09:06:09'),
('20248493-d546-4de6-b775-ffbae84c4cbf', 'MAG007', 'CRS0105', '1', 3, '2025-05-21 18:16:30', '2025-05-21 19:08:36'),
('238722b2-0713-43a0-9f1b-ae7c92ec439f', 'MAG007', 'CRS0405', '4', 3, '2025-05-21 18:16:30', '2025-05-21 19:08:39'),
('267d73be-258d-437b-bef0-5f042c5436af', 'MAG005', 'CRS0501', '5', 3, '2025-05-13 10:09:11', '2025-05-22 09:30:45'),
('28dccf5e-8963-4b56-9941-10a45fe84cd5', 'MAG008', 'CRS0401', '4', 1, '2025-05-21 20:33:53', '2025-05-21 20:34:09'),
('2aa769bf-0493-4e10-9a62-85cc4b2535aa', 'MAG005', NULL, '1', 6, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('2db1b09b-c9c4-45ce-bb44-cc9075800179', 'MAG005', NULL, '3', 4, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('2f945b08-de77-4985-a487-f32e9000c974', 'MAG005', 'CRS0103', '1', 3, '2025-05-13 10:09:11', '2025-05-22 09:21:18'),
('36fd16b1-bec4-4fe4-b861-297c54a47bf0', 'MAG008', 'CRS0105', '1', 2, '2025-05-21 20:33:53', '2025-05-22 08:09:52'),
('3e91db4d-ab1a-43c9-9893-cf2314b9d113', 'MAG007', 'CRS0405', '4', 6, '2025-05-21 18:16:30', '2025-05-25 13:53:46'),
('403ff669-e631-4524-9635-8bf2a34bdf1f', 'MAG005', NULL, '1', 5, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('4dba5bd3-8e87-4b09-95c9-a7783664a615', 'MAG005', 'CRS0505', '5', 2, '2025-05-13 10:09:11', '2025-05-22 09:06:26'),
('5178fa50-c6c1-4eb2-ab36-68febeb889c2', 'MAG005', NULL, '4', 6, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('54b6df8d-c3df-457c-a497-2e671577430b', 'MAG005', NULL, '5', 4, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('590b6805-601d-49bb-93b6-fc90742ce4f9', 'MAG005', 'CRS0503', '5', 1, '2025-05-13 10:09:11', '2025-05-22 09:54:16'),
('595de64f-56f8-4a77-bba1-d150706168d4', 'MAG005', 'CRS0103', '1', 4, '2025-05-13 10:09:11', '2025-05-23 17:34:46'),
('603ba2a7-dd5a-4ae1-9b31-f951dafa0056', 'MAG007', 'CRS0405', '4', 2, '2025-05-21 18:16:30', '2025-05-22 06:37:09'),
('6132146e-1856-43cd-8f3a-7d0d8814277a', 'MAG007', 'CRS0105', '1', 4, '2025-05-21 18:16:30', '2025-05-25 14:02:11'),
('69a7b43a-dedc-4764-b64c-1a755ac3d2db', 'MAG007', 'CRS0505', '5', 2, '2025-05-21 18:16:30', '2025-05-22 06:37:08'),
('6a07c730-65fd-4088-a74a-a9449dd4b85f', 'MAG007', 'CRS0305', '3', 2, '2025-05-21 18:16:30', '2025-05-22 06:37:10'),
('6af1c32a-7dcd-4227-8884-365f35fa6dab', 'MAG007', 'CRS0205', '2', 4, '2025-05-21 18:16:30', '2025-05-25 14:02:13'),
('6ced5afa-208f-4423-8b14-f02c7a178934', 'MAG008', 'CRS0201', '2', 4, '2025-05-21 20:33:53', '2025-05-22 08:10:41'),
('7589d6e4-0776-4d02-81fa-8a22b8a31794', 'MAG008', 'CRS0201', '2', 2, '2025-05-21 20:33:53', '2025-05-22 08:09:53'),
('78d86981-3341-454b-938c-77e2ef46e3b4', 'MAG007', 'CRS0405', '4', 5, '2025-05-21 18:16:30', '2025-05-25 13:53:37'),
('795e547c-d847-4867-8ed2-4db4ba746c24', 'MAG008', 'CRS0105', '1', 4, '2025-05-21 20:33:53', '2025-05-22 08:10:40'),
('79ab2f49-117b-465e-9a35-5e6f4ee44b11', 'MAG007', 'CRS0505', '5', 4, '2025-05-21 18:16:30', '2025-05-25 14:02:18'),
('7efe3d66-9f9c-4835-8643-5f6b536ce446', 'MAG008', 'CRS0401', '4', 2, '2025-05-21 20:33:53', '2025-05-22 08:09:56'),
('852d4ed4-ccbe-4ecf-8e4a-c0f2fc968a99', 'MAG007', 'CRS0305', '3', 3, '2025-05-21 18:16:30', '2025-05-21 19:08:38'),
('9131f336-6616-49f8-9620-690ff8c206a9', 'MAG008', 'CRS0105', '1', 1, '2025-05-21 20:33:53', '2025-05-21 20:34:06'),
('95ddcbb0-a7a9-4b2c-8a0c-628b84c441d6', 'MAG008', 'CRS0501', '5', 3, '2025-05-21 20:33:53', '2025-05-22 08:10:12'),
('978ca3cf-1fdc-4eac-bd2d-2d5e4f5ee9e3', 'MAG005', 'CRS0204', '2', 1, '2025-05-13 10:09:11', '2025-05-21 18:08:15'),
('9c9703be-82a7-4bf8-a954-7c08e04898c6', 'MAG008', 'CRS0201', '2', 3, '2025-05-21 20:33:53', '2025-05-22 08:10:05'),
('9dcb87ff-7a60-45fe-8c83-6b7133e80d27', 'MAG005', NULL, '3', 6, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('a11c7e11-7767-498a-ba5c-c586070a7499', 'MAG008', 'CRS0105', '1', 3, '2025-05-21 20:33:53', '2025-05-22 08:10:04'),
('a433cb91-13be-4529-b72a-f130160a605b', 'MAG007', 'CRS0305', '3', 6, '2025-05-21 18:16:30', '2025-05-25 13:53:43'),
('a5c3e772-a93f-4114-97a1-3515fdf6971a', 'MAG008', 'CRS0401', '4', 6, '2025-05-21 20:33:53', '2025-05-22 08:11:19'),
('a64ceaf4-c48f-4b68-be2d-e4d7d6db51c2', 'MAG007', 'CRS0105', '1', 5, '2025-05-21 18:16:30', '2025-05-25 13:53:33'),
('ab0d73d1-7eba-434e-8329-070754b03f03', 'MAG007', 'CRS0405', '4', 1, '2025-05-21 18:16:30', '2025-05-21 20:10:17'),
('ac0cb2ce-c70c-4d41-b369-204148889254', 'MAG008', 'CRS0301', '3', 4, '2025-05-21 20:33:53', '2025-05-22 08:10:42'),
('b44c645f-9c60-44e3-b3a4-db1603f2c93b', 'MAG007', 'CRS0305', '3', 5, '2025-05-21 18:16:30', '2025-05-25 13:53:35'),
('b5651a14-e43f-4375-8c96-4e7ccaa3973d', 'MAG005', NULL, '5', 5, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('b96d36ab-d525-442d-b76e-817fde7951ef', 'MAG007', 'CRS0205', '2', 6, '2025-05-21 18:16:30', '2025-05-25 13:53:42'),
('bc62d206-acef-40e9-9743-f9990548c060', 'MAG008', 'CRS0501', '5', 1, '2025-05-21 20:33:53', '2025-05-22 08:09:44'),
('c2717cde-dec8-45d8-aafe-ea805d5bdcdd', 'MAG005', 'CRS0402', '4', 1, '2025-05-13 10:09:11', '2025-05-21 18:08:09'),
('c547dff3-a16a-46c7-aac3-d0bc05bd5bd2', 'MAG005', NULL, '3', 5, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('c83cab73-8a73-4017-b646-676cab195a58', 'MAG007', 'CRS0205', '2', 3, '2025-05-21 18:16:30', '2025-05-21 19:08:37'),
('c9eb9969-b39a-43cb-a26a-1d4a733aaa83', 'MAG005', NULL, '4', 4, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('ce3da8d1-9fd6-4dfa-9674-2e5c04d05428', 'MAG008', 'CRS0105', '1', 6, '2025-05-21 20:33:53', '2025-05-22 08:11:11'),
('d207e2c8-1cf6-45bb-8f5e-70e39765c55b', 'MAG007', 'CRS0305', '3', 1, '2025-05-21 18:16:30', '2025-05-25 13:13:04'),
('d48247a8-2b50-423e-bf8f-93c614ca2606', 'MAG008', 'CRS0201', '2', 6, '2025-05-21 20:33:53', '2025-05-22 08:11:13'),
('d57fd51a-39fb-4f1f-9003-7536bbd66bc4', 'MAG008', 'CRS0501', '5', 5, '2025-05-21 20:33:53', '2025-05-22 08:11:01'),
('d6b6e194-e569-44a6-b85e-6018ad5edd52', 'MAG005', 'CRS0204', '2', 2, '2025-05-13 10:09:11', '2025-05-22 09:06:06'),
('d732f4a2-d35f-4bf2-afbc-edb733f19768', 'MAG007', 'CRS0505', '5', 6, '2025-05-21 18:16:30', '2025-05-25 13:53:47'),
('dd00fd3c-3765-42b6-8d68-5b77c08aad25', 'MAG008', 'CRS0105', '1', 5, '2025-05-21 20:33:53', '2025-05-22 08:10:55'),
('dd9a4021-ff4e-4b55-9fb8-9e1de1dc66c1', 'MAG007', 'CRS0205', '2', 2, '2025-05-21 18:16:30', '2025-05-22 06:37:11'),
('dde39727-68c9-4368-90e9-823ced6dd72e', 'MAG007', 'CRS0305', '3', 4, '2025-05-21 18:16:30', '2025-05-25 14:02:14'),
('df0a64e6-8000-41cc-8246-96fe975937ca', 'MAG008', 'CRS0301', '3', 6, '2025-05-21 20:33:53', '2025-05-22 08:11:14'),
('df2a2ad2-0538-44f9-9d39-c827fbf19f4d', 'MAG008', 'CRS0401', '4', 5, '2025-05-21 20:33:53', '2025-05-22 08:11:00'),
('e7ff6160-b236-4a9f-8f79-822cc9bad427', 'MAG007', 'CRS0505', '5', 5, '2025-05-21 18:16:30', '2025-05-21 19:09:09'),
('e84e340c-6fae-4013-a20e-7e20a46ad3d6', 'MAG007', 'CRS0105', '1', 6, '2025-05-21 18:16:30', '2025-05-25 13:53:41'),
('f4d7a22d-8ff8-4b76-8e35-ed62bc591ba4', 'MAG007', 'CRS0105', '1', 1, '2025-05-21 18:16:30', '2025-05-25 13:13:27'),
('f63f1967-15ae-458c-af0a-9d73d7f9ddb2', 'MAG008', 'CRS0401', '4', 3, '2025-05-21 20:33:53', '2025-05-22 08:10:11'),
('f684d90c-1908-4bb5-a850-50db46639bbf', 'MAG008', 'CRS0201', '2', 1, '2025-05-21 20:33:53', '2025-05-22 08:09:40'),
('f77abb7c-8c32-4e8d-a696-fb4b52878852', 'MAG005', NULL, '2', 4, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('f8e119a7-5147-4350-b23f-efee4efb0861', 'MAG005', NULL, '2', 6, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('f9f2fae8-009e-4aa9-b1c3-c17c9d1ab7cb', 'MAG007', 'CRS0505', '5', 3, '2025-05-21 18:16:30', '2025-05-21 19:08:40'),
('fa2314f7-621f-4828-84da-ff73ce29860b', 'MAG005', 'CRS0205', '2', 3, '2025-05-13 10:09:11', '2025-05-23 10:12:05'),
('faa8fc51-501e-4531-81fb-c899709ba7c1', 'MAG008', 'CRS0401', '4', 4, '2025-05-21 20:33:53', '2025-05-22 08:10:43'),
('fd4bd3df-23c4-4660-9571-44f39dfbe372', 'MAG007', 'CRS0205', '2', 5, '2025-05-21 18:16:30', '2025-05-25 13:53:34');

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
('INT001', 'PL001', 1, 4, 4, 4, 4.00, '2025-05-01 00:00:00', 'Pending', NULL, NULL, NULL, '2025-04-20 05:00:00', '2025-05-06 11:03:27'),
('INT002', 'PL002', 2, 5, 5, 5, 5.00, '2025-05-02 00:00:00', 'Pending', NULL, NULL, NULL, '2025-04-20 05:00:00', '2025-05-06 11:03:40'),
('INT005', 'PL011', 2, 0, 0, 0, 0.00, '2025-05-12 10:35:00', 'Tes Kemampuan', NULL, NULL, NULL, '2025-05-11 19:14:41', '2025-05-11 19:15:45'),
('INT008', 'PL009', 2, 0, 0, 0, 0.00, '2025-05-12 11:00:00', 'Tes Kemampuan', NULL, NULL, NULL, '2025-05-11 19:58:32', '2025-05-11 20:00:14'),
('INT010', 'PL005', 4, 5, 5, 5, 5.00, '2025-05-15 01:30:00', 'Tes Kemampuan', NULL, NULL, NULL, '2025-05-13 10:26:12', '2025-05-24 18:55:43'),
('INT012', 'PL010', 4, 5, 5, 5, 5.00, '2025-05-15 07:30:00', 'Pending', NULL, NULL, NULL, '2025-05-13 16:12:04', '2025-05-24 19:23:23'),
('INT013', 'PL014', 1, 3, 3, 2, 2.67, '2025-05-14 14:30:00', 'Pending', NULL, NULL, NULL, '2025-05-13 23:10:33', '2025-05-13 23:11:45'),
('INT014', 'PL015', 2, 0, 0, 0, 0.00, '2025-05-17 20:30:00', 'Tes Kemampuan', NULL, NULL, NULL, '2025-05-17 05:09:24', '2025-05-17 05:09:59'),
('INT015', 'PL003', 1, 0, 0, 0, 0.00, '2025-05-19 23:30:00', 'Tes Kemampuan', NULL, NULL, NULL, '2025-05-19 08:05:21', '2025-05-19 08:08:43');

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
('INT_RS_015', 'INT_CRIT_JOB001_3', 5, 'Sangat Baik', 'Kandidat menunjukkan sikap sangat profesional, sangat termotivasi, dan kepribadian yang sangat cocok untuk posisi', '2025-05-24 18:31:19', '2025-05-24 18:31:19');

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
('JOB001', 'Cooks', 'Bertanggung jawab untuk memasak hidangan utama, mengelola proses memasak, dan memastikan kualitas makanan. Syarat: Pria, usia maks. 35 tahun', '2025-04-19 22:00:00', '2025-05-23 13:29:42'),
('JOB002', 'Steward', 'Bertanggung jawab untuk kebersihan peralatan dapur, setup meja, dan mendukung operasional dapur dan restoran. Syarat: Pria, usia maks. 25 tahun', '2025-04-19 22:00:00', '2025-05-23 13:29:42'),
('JOB003', 'Cook Helper', 'Membantu persiapan bahan masakan, mendukung chef dalam proses memasak, dan menjaga kebersihan area kerja. Syarat: Pria, usia maks. 25 tahun', '2025-04-19 22:00:00', '2025-05-23 13:29:42'),
('JOB004', 'Pastry Chef', 'Membuat berbagai jenis kue, pastry, dessert, dan roti. Bertanggung jawab atas semua produk bakery dan patisserie. Syarat: Pria, usia maks. 25 tahun', '2025-04-19 22:00:00', '2025-05-23 13:29:42'),
('JOB005', 'Barista', 'Membuat dan menyajikan berbagai jenis kopi, minuman panas dan dingin, serta memberikan pelayanan yang ramah kepada pelanggan. Syarat: Pria/wanita, usia maks. 25 tahun', '2025-04-19 22:00:00', '2025-05-23 13:29:42'),
('JOB006', 'Cleaning Service', 'Menjaga kebersihan seluruh area restoran, sanitasi fasilitas, dan memastikan lingkungan kerja yang bersih dan nyaman. Syarat: Pria/wanita, usia maks. 30 tahun', '2025-04-19 22:00:00', '2025-05-23 13:29:42');

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
('MAG005', 'PL011', 2, 1.19, 3, 'Sedang Berjalan', '2025-05-14 01:30:00', '2025-05-13 10:09:11', '2025-05-25 14:02:56'),
('MAG007', 'PL005', 2, 5.00, 1, 'Sedang Berjalan', '2025-05-22 02:30:00', '2025-05-21 18:16:30', '2025-05-25 14:02:56'),
('MAG008', 'PL015', 2, 2.20, 2, 'Sedang Berjalan', '2025-05-22 05:00:00', '2025-05-21 20:33:53', '2025-05-25 14:02:56');

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
('PL003', 'PER002', 'JOB003', 'Alice Johnson', 'alice.johnson@example.com', '08123456789', '1990-01-01', 'Jakarta', 'S1', 5, 'PT. ABC', 'Pengalaman kerja di perusahaan besar.', 'cv_alicejohnson.pdf', 'Interview', '2025-04-20 05:00:00', '2025-05-19 08:05:21'),
('PL004', 'PER001', 'JOB002', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 2, NULL, NULL, NULL, 'Pending', '2025-05-07 13:05:49', '2025-05-07 13:05:49'),
('PL005', 'PER002', 'JOB001', 'Fahri An', 'fahriabangpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 4, 'wqeqwe', '111', '/storage/cv_files/PL005_CV.pdf', 'Sedang Berjalan', '2025-05-07 13:17:36', '2025-05-21 18:16:30'),
('PL009', 'PER002', 'JOB003', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 9, 'wqeqwe', 'gdfsgsdfgsg', 'cv_files/PL009_CV.pdf', 'Interview', '2025-05-08 18:04:49', '2025-05-13 16:35:30'),
('PL010', 'PER002', 'JOB001', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 9, 'wqeqwe', 'gdfsgsdfgsg', 'cv_files/PL010_CV.pdf', 'Interview', '2025-05-10 12:12:42', '2025-05-13 16:12:04'),
('PL011', 'PER002', 'JOB001', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 4, 'wqeqwe', '1', 'cv_files/PL011_CV.docx', 'Sedang Berjalan', '2025-05-11 19:13:22', '2025-05-13 10:09:11'),
('PL012', 'PER002', 'JOB004', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 1, 'wqeqwe', '1', 'cv_files/PL012_CV.docx', 'Pending', '2025-05-11 19:13:56', '2025-05-25 12:04:58'),
('PL013', 'PER002', 'JOB005', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 3, 'wqeqwe', '1', 'cv_files/PL013_CV.pdf', 'Pending', '2025-05-11 19:50:27', '2025-05-23 10:29:51'),
('PL014', 'PER002', 'JOB001', 'ari', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'qwe', 'SMA', 4, 'wqeqwe', 'qweq', 'cv_files/PL014_CV.pdf', 'Interview', '2025-05-13 16:21:43', '2025-05-13 23:10:33'),
('PL015', 'PER002', 'JOB001', 'radhika rasidi', 'rasidiradhika11@gmail.com', '085272127188', '2025-05-01', 'Komp mahdani hafairt blok a no 1', 'SMA', 10, 'rumah', 'membantu orang tua', 'cv_files/PL015_CV.pdf', 'Sedang Berjalan', '2025-05-17 05:09:05', '2025-05-21 20:33:53'),
('PL016', 'PER002', 'JOB005', 'sadawdawd', 'fahriandikasanjaya@gmail.com', '085272127188', '2025-05-05', 'Komp mahdani hafairt blok a no 1', 'SMA', 2, 'rumah', '2342424', 'cv_files/PL016_CV.docx', 'Pending', '2025-05-23 10:33:09', '2025-05-23 10:33:09'),
('PL017', 'PER002', 'JOB002', 'sadawdawd', 'fahriandikasanjaya@gmail.com', '085272127188', '2025-05-05', 'qwe', 'D3', 2, '123', '123', 'cv_files/PL017_CV.docx', 'Pending', '2025-05-23 11:03:03', '2025-05-23 11:03:03');

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
('PER001', 'Periode 1', '2025-04-20', '2025-05-20', 'Periode pertama untuk rekrutmen.', '2025-04-20 05:00:00', '2025-05-06 18:08:21', 4),
('PER002', 'Periode 2', '2025-06-01', '2025-07-01', 'Periode kedua untuk rekrutmen.', '2025-04-20 05:00:00', '2025-05-25 10:42:47', 6),
('PER003', 'Periode 3', '2025-05-01', '2025-05-08', NULL, '2025-05-13 15:11:19', '2025-05-13 15:11:19', 2),
('PER004', 'PERIODE 4', '2025-05-23', '2025-05-31', '213', '2025-05-23 14:09:00', '2025-05-23 14:09:00', 3);

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
('PER001', 'JOB001', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PER001', 'JOB002', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PER001', 'JOB006', '2025-05-11 15:25:43', '2025-05-11 15:25:43'),
('PER002', 'JOB001', '2025-05-11 19:12:54', '2025-05-11 19:12:54'),
('PER002', 'JOB002', '2025-05-11 19:12:54', '2025-05-11 19:12:54'),
('PER002', 'JOB003', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PER002', 'JOB004', '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('PER002', 'JOB005', '2025-05-11 15:07:34', '2025-05-11 15:07:34'),
('PER003', 'JOB004', '2025-05-13 15:11:19', '2025-05-13 15:11:19'),
('PER004', 'JOB002', '2025-05-23 14:09:00', '2025-05-23 14:09:00');

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
('21S2h057V88yDaHdI0rXTy7ivseeqwi7oRtSeSdb', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidE50cktpTmJ4UlRYekxsbXg0QWZLU1pPUTBXZDEwZXZEbzNlWUFXQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tYWdhbmciO31zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1748182041);

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
('TES001', 1, 'PL001', 'Tes kemampuan memasak dasar.', '2025-05-10 00:00:00', 85, 'Pending', NULL, '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('TES002', 2, 'PL002', 'Tes kemampuan memasak dasar.', '2025-05-11 00:00:00', 80, 'Pending', NULL, '2025-04-20 05:00:00', '2025-04-20 12:25:02'),
('TES006', 2, 'PL011', NULL, '2025-05-12 10:30:00', 0, 'Magang', NULL, '2025-05-11 19:15:45', '2025-05-13 10:09:11'),
('TES010', 2, 'PL009', NULL, '2025-05-12 11:30:00', 0, 'Lulus', NULL, '2025-05-11 20:00:14', '2025-05-13 16:51:50'),
('TES012', 2, 'PL005', '1w12w', '2025-05-15 01:30:00', 100, 'Magang', NULL, '2025-05-13 10:27:39', '2025-05-24 08:36:26'),
('TES013', 2, 'PL015', NULL, '2025-05-17 20:30:00', 0, 'Magang', NULL, '2025-05-17 05:09:59', '2025-05-21 20:33:53'),
('TES014', 1, 'PL003', NULL, '2025-05-19 23:30:00', 0, 'Pending', NULL, '2025-05-19 08:08:43', '2025-05-19 08:08:43');

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
('TES_RS_005', 'TES_CRIT_JOB001', 5, 'Sangat Baik', 'Kandidat menunjukkan kemampuan yang sangat baik, siap untuk posisi tanpa pelatihan tambahan', 90, 100, '2025-05-24 18:31:19', '2025-05-24 18:31:19');

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
('0a14ccfd-fc31-4c08-a5a2-d5c5ba5521fd', 'MAG005', 1, 0.33, '2025-05-13 13:18:48', '2025-05-25 14:02:56'),
('170662ca-f243-42a5-b42e-173edbf54856', 'MAG008', 4, 0.42, '2025-05-21 20:34:06', '2025-05-25 14:02:56'),
('1c76fb7d-cd87-44a3-bb24-4228f39ed488', 'MAG007', 2, 1.00, '2025-05-21 18:16:37', '2025-05-25 14:02:56'),
('2a3f3798-9116-4072-8ab5-74b5e3abcbd3', 'MAG005', 6, 0.00, '2025-05-13 13:22:02', '2025-05-25 14:02:56'),
('2a9ce14a-12a5-4dff-85c6-ef60dd7ff31d', 'MAG007', 1, 1.00, '2025-05-21 18:16:37', '2025-05-25 14:02:56'),
('2f493b53-43bd-4b7f-8327-c148938c519b', 'MAG007', 4, 1.00, '2025-05-21 18:16:37', '2025-05-25 14:02:56'),
('371beab9-8e6e-408a-aa6e-1b93f290b23a', 'MAG008', 3, 0.58, '2025-05-21 20:34:06', '2025-05-25 14:02:56'),
('427d5bc5-71ad-4226-b3cf-f25ea5b4b788', 'MAG008', 2, 0.42, '2025-05-21 20:34:06', '2025-05-25 14:02:56'),
('5779b58c-8480-4bcc-bb99-806bba1bde36', 'MAG007', 6, 1.00, '2025-05-21 18:16:37', '2025-05-25 14:02:56'),
('5f0c2559-f8d0-4ca4-b7e1-e8f3596bebd8', 'MAG005', 3, 0.66, '2025-05-13 13:22:02', '2025-05-25 14:02:56'),
('6e46653f-314c-490d-80bf-a5ff6f0b4e71', 'MAG005', 5, 0.00, '2025-05-13 13:22:02', '2025-05-25 14:02:56'),
('ac5c3881-2cfb-438f-8c93-cb47af15512c', 'MAG007', 5, 1.00, '2025-05-21 18:16:37', '2025-05-25 14:02:56'),
('beb913f7-0af8-474e-b114-724c8d6e275f', 'MAG008', 5, 0.42, '2025-05-21 20:34:06', '2025-05-25 14:02:56'),
('c46fc6b0-0620-48fd-b3f7-51f27cd16039', 'MAG008', 6, 0.42, '2025-05-21 20:34:06', '2025-05-25 14:02:56'),
('d9a8e96e-298f-4d94-954d-73f45632e55c', 'MAG005', 2, 0.93, '2025-05-13 13:19:31', '2025-05-25 14:02:56'),
('db992240-4852-47c5-9832-8196945af4c1', 'MAG008', 1, 0.42, '2025-05-21 20:34:02', '2025-05-25 14:02:56'),
('eeb809dd-9561-437a-b366-71649c5f7052', 'MAG007', 3, 1.00, '2025-05-21 18:16:37', '2025-05-25 14:02:56'),
('f573c245-2f03-459c-ab33-01a80e3d397f', 'MAG005', 4, 0.21, '2025-05-13 13:22:02', '2025-05-25 14:02:56');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'hr_jiwaraga', '$2y$12$WIVHFZyu8TJYnMWSJo/3Z..t0IIyAbbk4mZ8daCy9SVKcmk9C3z5C', 'jiwaraga@perusahaan.com', 'hr', '2025-04-20 05:00:00', '2025-05-10 20:27:06', 'aruokd3rMkYBnOP0x4dowiF4dw9zAfk5sz2rDNBDFwyfa7JsrmI7VITxai3M'),
(2, 'cook', '$2y$12$3EqqNgvpwx.97vgLhkv3Q.jxLjCgYKxm2hLhY6pqQE7ZimrS5e0/u', 'cook@perusahaan.com', 'cook', '2025-04-20 05:00:00', '2025-05-25 12:16:03', '5sHGvqtbgFIVSOtzGIO4yHEgtGRUVu5DOkkZUJS1YwhrGI79zCTfDcqEpkt4'),
(3, 'pastry', '$2y$12$CmjDs5.XIqyWOBo77busku86IE74V1Eg4Jn5TBlADww77Q71QU./m', 'pastry@perusahaan.com', 'pastry', '2025-04-20 05:00:00', '2025-05-08 23:40:59', 'FBB5Fg7HVKmYnvIyq0reutAWrdpVMKQLgOdTGp6s1KfZ5iRioc9swTBQ7nEM'),
(4, 'fahri', 'ugytfty', 'fahriandikasanjaya@gmail.com', 'hr', '2025-05-23 17:02:57', '2025-05-23 17:02:57', NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
