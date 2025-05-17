-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 01:01 PM
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
-- Database: `...afinal`
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
('laravel_cache_smart_details_MAG001', 'a:3:{s:7:\"details\";a:4:{i:1;a:0:{}i:2;a:0:{}i:3;a:0:{}i:4;a:0:{}}s:5:\"ranks\";a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}s:9:\"timestamp\";i:1747173849;}', 1747260249),
('laravel_cache_smart_details_MAG004', 'a:3:{s:7:\"details\";a:6:{i:1;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:2:\"10\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"6\";s:13:\"criteria_name\";s:21:\"Keahlian Dasar Pastry\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"7\";s:13:\"criteria_name\";s:21:\"Kualitas Hasil Pastry\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"8\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"9\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}}i:2;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:2:\"10\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"6\";s:13:\"criteria_name\";s:21:\"Keahlian Dasar Pastry\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"7\";s:13:\"criteria_name\";s:21:\"Kualitas Hasil Pastry\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"8\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"9\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}}i:3;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:2:\"10\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"6\";s:13:\"criteria_name\";s:21:\"Keahlian Dasar Pastry\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"7\";s:13:\"criteria_name\";s:21:\"Kualitas Hasil Pastry\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"8\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"9\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}}i:4;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:2:\"10\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"6\";s:13:\"criteria_name\";s:21:\"Keahlian Dasar Pastry\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"7\";s:13:\"criteria_name\";s:21:\"Kualitas Hasil Pastry\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"8\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"9\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}}i:5;a:0:{}i:6;a:0:{}}s:5:\"ranks\";a:6:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;i:5;i:1;i:6;i:1;}s:9:\"timestamp\";i:1747173075;}', 1747259475),
('laravel_cache_smart_details_MAG005', 'a:3:{s:7:\"details\";a:6:{i:1;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}}i:2;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}}i:3;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}}i:4;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}}i:5;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}}i:6;a:5:{i:0;a:7:{s:11:\"criteria_id\";s:1:\"1\";s:13:\"criteria_name\";s:22:\"Keahlian Dasar Memasak\";s:13:\"criteria_code\";s:2:\"K1\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.4162\";s:14:\"weighted_score\";d:0.4162;}i:1;a:7:{s:11:\"criteria_id\";s:1:\"2\";s:13:\"criteria_name\";s:22:\"Kualitas Hasil Masakan\";s:13:\"criteria_code\";s:2:\"K2\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.2618\";s:14:\"weighted_score\";d:0.2618;}i:2;a:7:{s:11:\"criteria_id\";s:1:\"3\";s:13:\"criteria_name\";s:33:\"Pemahaman Kebersihan dan Keamanan\";s:13:\"criteria_code\";s:2:\"K3\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.1610\";s:14:\"weighted_score\";d:0.161;}i:3;a:7:{s:11:\"criteria_id\";s:1:\"4\";s:13:\"criteria_name\";s:24:\"Konsistensi & Ketelitian\";s:13:\"criteria_code\";s:2:\"K4\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0986\";s:14:\"weighted_score\";d:0.0986;}i:4;a:7:{s:11:\"criteria_id\";s:1:\"5\";s:13:\"criteria_name\";s:24:\"Kemampuan Kerja Sama Tim\";s:13:\"criteria_code\";s:2:\"K5\";s:9:\"raw_value\";s:4:\"3.00\";s:16:\"normalized_value\";i:1;s:6:\"weight\";s:6:\"0.0624\";s:14:\"weighted_score\";d:0.0624;}}}s:5:\"ranks\";a:6:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;i:5;i:1;i:6;i:1;}s:9:\"timestamp\";i:1747204065;}', 1747290465),
('laravel_cache_smart_details_MAGmE1y3NaD', 'a:3:{s:7:\"details\";a:3:{i:1;a:0:{}i:2;a:0:{}i:3;a:0:{}}s:5:\"ranks\";a:3:{i:1;i:2;i:2;i:2;i:3;i:2;}s:9:\"timestamp\";i:1747173726;}', 1747260126),
('laravel_cache_smart_details_MAGScLpDJ4i', 'a:3:{s:7:\"details\";a:3:{i:1;a:0:{}i:2;a:0:{}i:3;a:0:{}}s:5:\"ranks\";a:3:{i:1;i:1;i:2;i:1;i:3;i:1;}s:9:\"timestamp\";i:1747173726;}', 1747260126);

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
('1', 'JOB001', 'Keahlian Dasar Memasak', 'K1', 'Kemampuan dalam teknik dasar memasak seperti menumis, menggoreng, merebus, dll.', 0.4162, '2025-05-05 02:26:29', '2025-05-13 23:43:51'),
('10', 'JOB004', 'Kemampuan Kerja Sama Tim', 'K5', 'Kemampuan bekerja sama dalam tim dapur, komunikasi, dan koordinasi dengan anggota tim lain.', 0.0624, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('2', 'JOB001', 'Kualitas Hasil Masakan', 'K2', 'Kualitas rasa, penampilan, dan tekstur dari hasil masakan yang dihasilkan.', 0.2618, '2025-05-05 02:26:29', '2025-05-13 23:43:51'),
('3', 'JOB001', 'Pemahaman Kebersihan dan Keamanan', 'K3', 'Pemahaman dan implementasi standar kebersihan dan keamanan pangan dalam bekerja.', 0.1610, '2025-05-05 02:26:29', '2025-05-13 23:43:51'),
('4', 'JOB001', 'Konsistensi & Ketelitian', 'K4', 'Konsistensi hasil masakan dan ketelitian dalam proses persiapan dan pemasakan.', 0.0986, '2025-05-05 02:26:29', '2025-05-13 23:43:51'),
('5', 'JOB001', 'Kemampuan Kerja Sama Tim', 'K5', 'Kemampuan bekerja sama dalam tim dapur, komunikasi, dan koordinasi dengan anggota tim lain.', 0.0624, '2025-05-05 02:26:29', '2025-05-13 23:43:51'),
('6', 'JOB004', 'Keahlian Dasar Pastry', 'K1', 'Kemampuan dalam teknik dasar pembuatan pastry seperti adonan, pengembangan, dekorasi, dll.', 0.4162, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('7', 'JOB004', 'Kualitas Hasil Pastry', 'K2', 'Kualitas rasa, penampilan, tekstur, dan estetika dari hasil pastry yang dihasilkan.', 0.2618, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('8', 'JOB004', 'Pemahaman Kebersihan dan Keamanan', 'K3', 'Pemahaman dan implementasi standar kebersihan dan keamanan pangan dalam bekerja.', 0.1610, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('9', 'JOB004', 'Konsistensi & Ketelitian', 'K4', 'Konsistensi hasil pastry dan ketelitian dalam proses persiapan dan pembuatan.', 0.0986, '2025-05-05 02:26:29', '2025-05-12 18:03:17'),
('CQB0DK', 'JOB001', '111', 'k1011', NULL, 0.0000, '2025-05-17 03:50:20', '2025-05-17 03:50:20');

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
('03b7781a-8ca2-4ccf-88c1-000d6817bb1e', '7', '9', 0.3333, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('03c4e04d-95cb-4e07-97f8-f0385312a1aa', '10', '8', 3.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('0ca2e769-150f-4f5b-99e0-91df7dd8abc9', '7', '8', 0.5000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('0dcaa062-45f5-45b6-9e9a-0d22f1b2f371', '2', '2', 1.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('110a9a2f-cae5-4b0a-ac64-42ff34687031', '10', '6', 5.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('17675184-e0fb-4bb0-bd0b-cd3ffcc6cfc5', '10', '7', 4.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('19d3550f-d267-41fe-a01d-907e4268fd43', '3', '5', 0.3333, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('19f8af38-ab27-4959-9590-76a0526ef4db', '4', '2', 3.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('2b5fa091-42ed-4ae4-aefb-1c6f6130f913', '10', '9', 2.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('33205a24-05d9-4775-97de-ca5f61e133f2', '3', '3', 1.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('33961e89-3f73-47dc-b498-916ebc368c58', '3', '1', 3.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('33f5d765-b29f-4c47-836f-3b9c07a9cc3b', '8', '7', 2.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('38c44b21-b5f5-4d7a-bb02-944a97561000', '5', '4', 2.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('4c598fbd-bb8e-49cb-92f5-6b0a8da482bb', '1', '3', 0.3333, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('4d970058-b519-40c9-9e2e-5b7771dcfaa4', '4', '1', 4.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('4df4f170-e32b-4cd9-a620-eb294c17f804', '8', '6', 3.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('4f2da4cc-e674-4ba3-849e-5a797ba046f5', '9', '9', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('4f57863d-d1bc-42a1-a97d-db8447c621f9', '8', '8', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('50afbb9f-9f2d-4aa7-bf2d-51bd13ce308b', '8', '9', 0.5000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('58338f02-f988-4994-b2d3-a92a7329499d', '6', '6', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('5e5cdc94-e1d6-4c0c-8f4e-b6c1fcdbe32c', '9', '7', 3.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('648abfdd-2b04-49b9-b9c6-e2ab5e2924b6', '8', '10', 0.3333, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('648da7f8-80a2-4be9-8976-6df0a188f7b9', '3', '4', 0.5000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('66be85d5-569c-4de0-9807-708cbbda4867', '9', '8', 2.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('69ee5d0a-1f32-47fb-9633-98c642303a59', '9', '6', 4.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('87ce4f06-ad52-4fd1-8e4e-2c4e543255d7', '9', '10', 0.5000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('8b9d9cbf-ba4a-442d-8336-2c0f85819ec9', '5', '3', 3.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('949deaa5-5bf4-4f15-b66f-fdd43deaa61b', '10', '10', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('a0b4d519-2114-4aa6-a753-f3a310cd9a53', '5', '5', 1.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('a3aaed09-f7b5-45ba-962a-a191b4c1eab7', '1', '4', 0.2500, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('a7398017-1539-43ea-9b7d-77901f4e1848', '6', '10', 0.2000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('a777e535-9133-4127-9c3a-3ae59e926817', '4', '4', 1.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('a7f76696-f467-4022-a350-dcc99806b0f6', '2', '3', 0.5000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('a86a3684-1bf0-4a83-9018-69803b3afd92', '1', '1', 1.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('adfc493b-4252-4960-8065-e0da15060a41', '5', '2', 4.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('b217d082-6a68-4a5e-ad77-0fa277cc557b', '6', '7', 0.5000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('b349ebc0-e0d0-48bd-9fbc-9be04b963b47', '5', '1', 5.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('bb22b936-d801-4b40-8965-775f86a7fe27', '1', '2', 0.5000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('bccc962f-91bb-4a86-ba97-7daf056b7aef', '1', '5', 0.2000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('c142e02b-0e68-4265-affb-ceb8ff2a53e7', '2', '4', 0.3333, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('c6737c07-ca89-4a6f-9f18-1c466ed39685', '2', '1', 2.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('c6a2b22e-2b55-4f43-ae18-6c7a110e9321', '4', '3', 2.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('d23e2ce8-15f3-4abb-9a13-3d48d6bd8af3', '7', '10', 0.2500, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('d3e905d3-06ab-4b3e-b745-a5a84e149af7', '4', '5', 0.5000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('d445286d-d84d-41e3-8c03-f92c9e7ae7df', '6', '9', 0.2500, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('ddd3bafc-4450-45a3-9833-506b4873f83d', '2', '5', 0.2500, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('e72a0fd2-2aeb-4d4e-a87e-19b68379c493', '3', '2', 2.0000, '2025-05-14 06:43:51', '2025-05-13 23:43:51'),
('f69859d0-1697-4f3d-952c-08227e7a3c06', '7', '7', 1.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('f75825d1-c00d-44e5-91a2-c75b998c9ed2', '6', '8', 0.3333, '2025-05-13 01:03:17', '2025-05-12 18:03:17'),
('feea5a84-cb2d-45b8-96ba-931784008962', '7', '6', 2.0000, '2025-05-13 01:03:17', '2025-05-12 18:03:17');

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
  `rating_id` varchar(50) DEFAULT NULL,
  `criteria_rating_id` varchar(50) DEFAULT NULL,
  `criteria_id` varchar(50) DEFAULT NULL,
  `minggu_ke` int(11) NOT NULL,
  `skor_minggu` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluasi_mingguan_magang`
--

INSERT INTO `evaluasi_mingguan_magang` (`evaluasi_id`, `magang_id`, `rating_id`, `criteria_rating_id`, `criteria_id`, `minggu_ke`, `skor_minggu`, `created_at`, `updated_at`) VALUES
('02d412dd-d6b4-4e47-a4f4-498bb3efde8a', 'MAG005', '3', NULL, '4', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0370a101-87a4-4d99-96fd-7843c8131062', 'MAG005', '3', NULL, '4', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0422b647-fba9-4890-a00f-44f9d3efb4d8', 'MAG005', '3', NULL, '4', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0875e229-a9d4-4337-9b7c-a06c44a68c91', 'MAG005', '3', NULL, '3', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0af9cf7f-d5d6-465a-9e7a-d591a7225a60', 'MAG005', '3', NULL, '2', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('0cc7662e-0591-445d-95d1-aaaed306dc18', 'MAG004', '3', NULL, '7', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('0fb88368-c0da-4fc7-b6aa-f7e44d63a731', 'MAG004', '3', NULL, '10', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('1033ba38-8501-43ca-958b-a6c6274f4076', 'MAG004', '3', NULL, '6', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('14f1a9d9-6903-4316-8183-6fe1698f5fc7', 'MAG005', '3', NULL, '5', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('1689c9eb-2f63-40c2-89da-18e1de82bf15', 'MAG005', '3', NULL, '3', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('1a4612c0-6b71-4cb9-a287-1b7c4411067b', 'MAG004', '3', NULL, '8', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('1d3b4b56-8ea4-4a40-ad5f-dbff5881ac5e', 'MAG005', '3', NULL, '1', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('1f03c226-3371-457a-99f1-40f13bb61bdc', 'MAG005', '3', NULL, '3', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('267d73be-258d-437b-bef0-5f042c5436af', 'MAG005', '3', NULL, '5', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('2aa769bf-0493-4e10-9a62-85cc4b2535aa', 'MAG005', '3', NULL, '1', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('2db1b09b-c9c4-45ce-bb44-cc9075800179', 'MAG005', '3', NULL, '3', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('2f945b08-de77-4985-a487-f32e9000c974', 'MAG005', '3', NULL, '1', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('403ff669-e631-4524-9635-8bf2a34bdf1f', 'MAG005', '3', NULL, '1', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('4dba5bd3-8e87-4b09-95c9-a7783664a615', 'MAG005', '3', NULL, '5', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('5178fa50-c6c1-4eb2-ab36-68febeb889c2', 'MAG005', '3', NULL, '4', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('54b6df8d-c3df-457c-a497-2e671577430b', 'MAG005', '3', NULL, '5', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('590b6805-601d-49bb-93b6-fc90742ce4f9', 'MAG005', '3', NULL, '5', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('593db108-5aba-4930-87e7-ab1e8a42a618', 'MAG004', '3', NULL, '7', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('595de64f-56f8-4a77-bba1-d150706168d4', 'MAG005', '3', NULL, '1', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('651d72bf-ee1f-461d-b3c4-7540cad5de8a', 'MAG004', '3', NULL, '6', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('67a0ffdd-32cf-45b6-9cd2-c449ab9aecc1', 'MAG004', '3', NULL, '10', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('67a4c506-b3bc-46d8-b28f-a9cd80ac9ecf', 'MAG004', '3', NULL, '7', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('686908d5-4f32-4b26-9b3a-c45aaa789122', 'MAG004', '3', NULL, '10', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('6b47e018-6f81-47bb-a0a4-8e36b31f3377', 'MAG004', '3', NULL, '9', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('6e42d08f-f1ad-43ea-8f2b-82680a33dc33', 'MAG004', '3', NULL, '9', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('792bf4cc-3d35-43ba-8204-4c59a1cf3695', 'MAG004', '3', NULL, '8', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('83239ac2-600c-4a44-9189-6415873fe0c3', 'MAG004', '3', NULL, '9', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('95bec172-9ac1-4ba0-afbf-ceb90193f1a4', 'MAG004', '3', NULL, '6', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('978ca3cf-1fdc-4eac-bd2d-2d5e4f5ee9e3', 'MAG005', '3', NULL, '2', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('9dcb87ff-7a60-45fe-8c83-6b7133e80d27', 'MAG005', '3', NULL, '3', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('aa7f333e-9a1c-49fe-84e1-cb1bba04e5f1', 'MAG004', '3', NULL, '9', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('b2f74bba-aa28-45a2-b625-54d5bf321e25', 'MAG005', '3', NULL, '1', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('b5651a14-e43f-4375-8c96-4e7ccaa3973d', 'MAG005', '3', NULL, '5', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('b9cd6ebe-09e5-4c53-9539-618f486bc3d3', 'MAG004', '3', NULL, '8', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('c2717cde-dec8-45d8-aafe-ea805d5bdcdd', 'MAG005', '3', NULL, '4', 1, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('c547dff3-a16a-46c7-aac3-d0bc05bd5bd2', 'MAG005', '3', NULL, '3', 5, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('c9eb9969-b39a-43cb-a26a-1d4a733aaa83', 'MAG005', '3', NULL, '4', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('ca8cd9b7-fb01-4bf7-bbcc-822813ced22f', 'MAG004', '3', NULL, '7', 4, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('ccebd969-0ece-44ea-bf24-64da379358f0', 'MAG004', '3', NULL, '10', 3, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('d6b6e194-e569-44a6-b85e-6018ad5edd52', 'MAG005', '3', NULL, '2', 2, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('f5b508ab-70f9-4a3f-8a57-aa316bb939e0', 'MAG004', '3', NULL, '8', 1, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27'),
('f77abb7c-8c32-4e8d-a696-fb4b52878852', 'MAG005', '3', NULL, '2', 4, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('f8e119a7-5147-4350-b23f-efee4efb0861', 'MAG005', '3', NULL, '2', 6, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('fa2314f7-621f-4828-84da-ff73ce29860b', 'MAG005', '3', NULL, '2', 3, 3.00, '2025-05-13 10:09:11', '2025-05-13 10:09:11'),
('fe1f0a99-295e-4a78-919d-1aa37710c493', 'MAG004', '3', NULL, '6', 2, 3.00, '2025-05-12 10:28:27', '2025-05-12 10:28:27');

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
('INT010', 'PL005', 2, 0, 0, 0, 0.00, '2025-05-15 01:30:00', 'Tes Kemampuan', '2025-05-13 10:26:12', '2025-05-13 10:27:39'),
('INT012', 'PL010', 2, 0, 0, 0, 0.00, '2025-05-15 07:30:00', 'Pending', '2025-05-13 16:12:04', '2025-05-13 16:12:04'),
('INT013', 'PL014', 1, 3, 3, 2, 2.67, '2025-05-14 14:30:00', 'Pending', '2025-05-13 23:10:33', '2025-05-13 23:11:45');

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
('MAG004', 'PL012', 2, 2.38, 1, 'Sedang Berjalan', '2025-05-13 01:30:00', '2025-05-12 10:28:26', '2025-05-13 14:51:15'),
('MAG005', 'PL011', 2, 5.00, 1, 'Sedang Berjalan', '2025-05-14 01:30:00', '2025-05-13 10:09:11', '2025-05-13 23:27:45');

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
('PL003', 'PER002', 'JOB003', 'Alice Johnson', 'alice.johnson@example.com', '08123456789', '1990-01-01', 'Jakarta', 'S1', 5, 'PT. ABC', 'Pengalaman kerja di perusahaan besar.', 'cv_alicejohnson.pdf', 'Pending', '2025-04-20 05:00:00', '2025-05-13 16:16:43'),
('PL004', 'PER001', 'JOB002', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 2, NULL, NULL, NULL, 'Pending', '2025-05-07 13:05:49', '2025-05-07 13:05:49'),
('PL005', 'PER002', 'JOB001', 'Fahri An', 'fahriabangpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 4, 'wqeqwe', '111', '/storage/cv_files/PL005_CV.pdf', 'Pending', '2025-05-07 13:17:36', '2025-05-13 23:27:17'),
('PL009', 'PER002', 'JOB003', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 9, 'wqeqwe', 'gdfsgsdfgsg', 'cv_files/PL009_CV.pdf', 'Interview', '2025-05-08 18:04:49', '2025-05-13 16:35:30'),
('PL010', 'PER002', 'JOB001', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 9, 'wqeqwe', 'gdfsgsdfgsg', 'cv_files/PL010_CV.pdf', 'Interview', '2025-05-10 12:12:42', '2025-05-13 16:12:04'),
('PL011', 'PER002', 'JOB001', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 4, 'wqeqwe', '1', 'cv_files/PL011_CV.docx', 'Sedang Berjalan', '2025-05-11 19:13:22', '2025-05-13 10:09:11'),
('PL012', 'PER002', 'JOB004', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'SMA', 1, 'wqeqwe', '1', 'cv_files/PL012_CV.docx', 'Sedang Berjalan', '2025-05-11 19:13:56', '2025-05-12 10:28:26'),
('PL013', 'PER002', 'JOB005', 'Fahri Andika Sanjaya', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'Komp mahdani hafairt blok a no 1', 'D3', 3, 'wqeqwe', '1', 'cv_files/PL013_CV.pdf', 'Interview', '2025-05-11 19:50:27', '2025-05-11 19:50:37'),
('PL014', 'PER002', 'JOB001', 'ari', 'aridedekpadang@gmail.com', '085272127188', '2025-05-14', 'qwe', 'SMA', 4, 'wqeqwe', 'qweq', 'cv_files/PL014_CV.pdf', 'Interview', '2025-05-13 16:21:43', '2025-05-13 23:10:33');

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
('PER002', 'Periode 2', '2025-06-01', '2025-07-01', 'Periode kedua untuk rekrutmen.', '2025-04-20 05:00:00', '2025-05-12 20:22:02', 6),
('PER003', 'Periode 3', '2025-05-01', '2025-05-08', NULL, '2025-05-13 15:11:19', '2025-05-13 15:11:19', 2);

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
('PER003', 'JOB004', '2025-05-13 15:11:19', '2025-05-13 15:11:19');

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
('WO0Ses66Rw3Mj1YHMpSthWNWBCkpgsfKzrsS06uL', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidFNVN1JuYlFyRTVaZzQ5SDVzY3U1SjFQa1lNTk1oa1RDVEFOaU91aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jcml0ZXJpYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1747479500);

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
('TES009', 2, 'PL013', NULL, '2025-05-12 11:00:00', 0, 'Pending', '2025-05-11 19:50:48', '2025-05-13 16:05:35'),
('TES010', 2, 'PL009', NULL, '2025-05-12 11:30:00', 0, 'Lulus', '2025-05-11 20:00:14', '2025-05-13 16:51:50'),
('TES012', 2, 'PL005', NULL, '2025-05-15 01:30:00', 0, 'Pending', '2025-05-13 10:27:39', '2025-05-13 23:27:17');

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
('0a14ccfd-fc31-4c08-a5a2-d5c5ba5521fd', 'MAG005', 1, 1.00, '2025-05-13 13:18:48', '2025-05-13 23:27:45'),
('2a3f3798-9116-4072-8ab5-74b5e3abcbd3', 'MAG005', 6, 1.00, '2025-05-13 13:22:02', '2025-05-13 23:27:45'),
('5f0c2559-f8d0-4ca4-b7e1-e8f3596bebd8', 'MAG005', 3, 1.00, '2025-05-13 13:22:02', '2025-05-13 23:27:45'),
('6e46653f-314c-490d-80bf-a5ff6f0b4e71', 'MAG005', 5, 1.00, '2025-05-13 13:22:02', '2025-05-13 23:27:45'),
('80d9e67a-64ef-4c4e-92b9-cb3d78cd9b4d', 'MAG004', 4, 1.00, '2025-05-13 14:51:15', '2025-05-13 14:51:15'),
('ae20f056-3b13-4d21-be0c-b23968b44bae', 'MAG004', 3, 1.00, '2025-05-13 14:51:15', '2025-05-13 14:51:15'),
('d9a8e96e-298f-4d94-954d-73f45632e55c', 'MAG005', 2, 1.00, '2025-05-13 13:19:31', '2025-05-13 23:27:45'),
('e85ff1ba-8b2f-42f4-a1d8-82e9d979de64', 'MAG004', 2, 1.00, '2025-05-13 13:19:31', '2025-05-13 14:51:15'),
('f573c245-2f03-459c-ab33-01a80e3d397f', 'MAG005', 4, 1.00, '2025-05-13 13:22:02', '2025-05-13 23:27:45'),
('f7e491d9-62de-40e9-8af8-31460942db36', 'MAG004', 1, 1.00, '2025-05-13 13:18:48', '2025-05-13 23:20:12');

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
(2, 'cook', '$2y$12$3EqqNgvpwx.97vgLhkv3Q.jxLjCgYKxm2hLhY6pqQE7ZimrS5e0/u', 'cook@perusahaan.com', 'cook', '2025-04-20 05:00:00', '2025-05-13 23:54:43', '66Gh9dIb4BIR2xHcpaICh3TK9H6RSwwI9gBINH04xbcnk9HlNbxoOHOvujBS'),
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
  ADD KEY `FK_Evaluasi_Mingguan_Magang_Rating_Scales` (`rating_id`),
  ADD KEY `IDX_Evaluasi_Mingguan_Magang_Minggu` (`magang_id`,`minggu_ke`),
  ADD KEY `fk_evaluasi_criteria` (`criteria_id`),
  ADD KEY `fk_evaluasi_criteria_rating` (`criteria_rating_id`);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `FK_Evaluasi_Mingguan_Magang_Rating_Scales` FOREIGN KEY (`rating_id`) REFERENCES `rating_scales` (`rating_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evaluasi_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`criteria_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_evaluasi_criteria_rating` FOREIGN KEY (`criteria_rating_id`) REFERENCES `criteria_rating_scales` (`id`) ON DELETE SET NULL;

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

--
-- Constraints for table `total_skor_minggu_magang`
--
ALTER TABLE `total_skor_minggu_magang`
  ADD CONSTRAINT `fk_total_skor_magang` FOREIGN KEY (`magang_id`) REFERENCES `magang` (`magang_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
