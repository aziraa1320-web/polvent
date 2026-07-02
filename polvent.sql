-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 29, 2026 at 08:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polvent`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES
(4, 15, 'REJECT_REGISTRATION', 'Panitia menolak pendaftaran ID 9: Ahmad Fauzi → Hackathon Polbeng 2025', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:20:25'),
(5, 15, 'REJECT_REGISTRATION', 'Panitia menolak pendaftaran ID 3: Budi Santoso → Pelatihan Public Speaking', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:20:29'),
(6, 15, 'REJECT_REGISTRATION', 'Panitia menolak pendaftaran ID 5: Siti Rahayu → Olimpiade Matematika Polbeng', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:20:33'),
(7, 15, 'REJECT_REGISTRATION', 'Panitia menolak pendaftaran ID 7: Ahmad Fauzi → Workshop Laravel 13 & Keamanan Web', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:20:37'),
(8, 15, 'DELETE_REGISTRATION', 'Panitia menghapus pendaftaran Budi Santoso dari event Seminar Keamanan Siber 2025', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:25:37'),
(9, 15, 'DELETE_REGISTRATION', 'Panitia menghapus pendaftaran Budi Santoso dari event Olimpiade Matematika Polbeng', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:25:45'),
(10, 15, 'DELETE_REGISTRATION', 'Panitia menghapus pendaftaran Budi Santoso dari event Pelatihan Public Speaking', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:25:51'),
(11, 15, 'DELETE_REGISTRATION', 'Panitia menghapus pendaftaran Ahmad Fauzi dari event Hackathon Polbeng 2025', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:25:57'),
(12, 15, 'DELETE_REGISTRATION', 'Panitia menghapus pendaftaran Ahmad Fauzi dari event Olimpiade Matematika Polbeng', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:26:13'),
(13, 15, 'DELETE_REGISTRATION', 'Panitia menghapus pendaftaran Ahmad Fauzi dari event Workshop Laravel 13 & Keamanan Web', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:27:06'),
(14, 15, 'DELETE_REGISTRATION', 'Panitia menghapus pendaftaran Siti Rahayu dari event Pelatihan Public Speaking', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:27:55'),
(15, 15, 'DELETE_REGISTRATION', 'Panitia menghapus pendaftaran Siti Rahayu dari event Olimpiade Matematika Polbeng', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:28:00'),
(16, 15, 'DELETE_REGISTRATION', 'Panitia menghapus pendaftaran Siti Rahayu dari event Seminar Keamanan Siber 2025', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:28:08'),
(17, 15, 'CREATE_EVENT', 'Panitia membuat event baru: [7] seminar Bem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:48:57'),
(18, 15, 'UPDATE_EVENT', 'Panitia mengupdate event: [7] seminar Bem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:56:33'),
(19, 15, 'DELETE_EVENT', 'Panitia menghapus event: [7] seminar Bem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:57:02'),
(20, 15, 'CREATE_EVENT', 'Panitia membuat event baru: [8] SEMINAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-15 23:57:48'),
(21, 15, 'DELETE_EVENT', 'Panitia menghapus event: [8] SEMINAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-16 00:02:04'),
(22, 15, 'CREATE_EVENT', 'Panitia membuat event baru: [9] SEMINAR UMUM', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-16 00:02:55'),
(23, 16, 'CREATE_EVENT', 'Panitia membuat event baru: [10] SEMINAR UKMI', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-16 02:15:37'),
(24, 16, 'DELETE_EVENT', 'Panitia menghapus event: [10] SEMINAR UKMI', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-16 02:18:02'),
(25, 16, 'CREATE_EVENT', 'Panitia membuat event baru: [11] SEMINAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-16 02:19:04'),
(28, 15, 'APPROVE_REGISTRATION', 'Panitia menyetujui pendaftaran ID 12: mazira → SEMINAR UMUM', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-16 02:34:17'),
(29, 16, 'APPROVE_REGISTRATION', 'Panitia menyetujui pendaftaran ID 11: mazira → SEMINAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-16 02:35:21'),
(31, 16, 'APPROVE_REGISTRATION', 'Panitia menyetujui pendaftaran ID 13: amee → SEMINAR', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2026-06-16 02:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:2;', 1782435268),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1782435268;', 1782435268),
('laravel-cache-aziraa1320@gmail.comz|127.0.0.1', 'i:1;', 1781699540),
('laravel-cache-aziraa1320@gmail.comz|127.0.0.1:timer', 'i:1781699539;', 1781699539),
('laravel-cache-bd307a3ec329e10a2cff8fb87480823da114f8f4', 'i:1;', 1782362011),
('laravel-cache-bd307a3ec329e10a2cff8fb87480823da114f8f4:timer', 'i:1782362011;', 1782362011),
('laravel-cache-mazirazira01@gmail.com|127.0.0.1:timer', 'i:1781601756;', 1781601756),
('laravel-cache-mazirazira7@gmail.com|127.0.0.1', 'i:2;', 1782435163),
('laravel-cache-mazirazira7@gmail.com|127.0.0.1:timer', 'i:1782435163;', 1782435163),
('laravel-cache-mazirazira9@gmail.com|127.0.0.1', 'i:1;', 1782435269),
('laravel-cache-mazirazira9@gmail.com|127.0.0.1:timer', 'i:1782435269;', 1782435269),
('laravel-cache-msndrakmi@gmail.com|127.0.0.1', 'i:2;', 1782361854),
('laravel-cache-msndrakmi@gmail.com|127.0.0.1:timer', 'i:1782361854;', 1782361854);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` datetime NOT NULL,
  `quota` int UNSIGNED NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `id_panitia` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `quota`, `location`, `organizer`, `poster`, `created_by`, `id_panitia`, `created_at`, `updated_at`) VALUES
(9, 'SEMINAR UMUM', 'acara meb jjshudlhudheudceujhuei', '2026-08-22 08:30:00', 20, NULL, NULL, 'posters/uKEENNwhj9lE6MZVMlQqp387i6x6ioJJyrsS0PA1.jpg', 15, 15, '2026-06-16 00:02:55', '2026-06-18 21:33:14'),
(11, 'SEMINAR', 'hdgciubcuygweicbuyhcsjbe', '2026-10-22 10:30:00', 2, NULL, NULL, 'posters/uKEENNwhj9lE6MZVMlQqp387i6x6ioJJyrsS0PA1.jpg', 16, 16, '2026-06-16 02:19:04', '2026-06-18 21:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_histories`
--

CREATE TABLE `login_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('success','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_histories`
--

INSERT INTO `login_histories` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-15 20:49:34', '2026-06-15 20:49:34'),
(2, 13, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-15 21:17:01', '2026-06-15 21:17:01'),
(3, NULL, 'ziramazira9@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-15 21:19:46', '2026-06-15 21:19:46'),
(4, NULL, 'admin@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-15 21:24:35', '2026-06-15 21:24:35'),
(5, NULL, 'admin@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-15 21:25:00', '2026-06-15 21:25:00'),
(6, NULL, 'panitia@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-15 21:25:35', '2026-06-15 21:25:35'),
(7, NULL, 'panitia@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-15 21:26:08', '2026-06-15 21:26:08'),
(8, NULL, 'admin@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-15 22:27:41', '2026-06-15 22:27:41'),
(9, NULL, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-15 23:06:44', '2026-06-15 23:06:44'),
(10, NULL, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-15 23:07:24', '2026-06-15 23:07:24'),
(11, NULL, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-15 23:07:51', '2026-06-15 23:07:51'),
(12, 13, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-15 23:10:01', '2026-06-15 23:10:01'),
(13, 15, 'zikrirupat1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-15 23:17:32', '2026-06-15 23:17:32'),
(14, 15, 'zikrirupat1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-15 23:43:36', '2026-06-15 23:43:36'),
(15, NULL, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-16 01:56:41', '2026-06-16 01:56:41'),
(16, NULL, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-16 01:57:19', '2026-06-16 01:57:19'),
(17, NULL, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-16 02:10:59', '2026-06-16 02:10:59'),
(18, NULL, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-16 02:11:54', '2026-06-16 02:11:54'),
(19, 13, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-16 02:12:30', '2026-06-16 02:12:30'),
(20, 16, 'msndrakmi2@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-16 02:14:45', '2026-06-16 02:14:45'),
(21, NULL, 'mazirazira01@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-16 02:21:36', '2026-06-16 02:21:36'),
(22, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-16 02:30:32', '2026-06-16 02:30:32'),
(23, 15, 'zikrirupat1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-16 02:33:15', '2026-06-16 02:33:15'),
(24, 16, 'msndrakmi2@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-16 02:35:09', '2026-06-16 02:35:09'),
(25, NULL, 'msndrakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-16 02:36:29', '2026-06-16 02:36:29'),
(26, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-16 02:38:01', '2026-06-16 02:38:01'),
(27, NULL, 'msndrakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-16 02:42:11', '2026-06-16 02:42:11'),
(28, NULL, 'msndrakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-16 02:42:33', '2026-06-16 02:42:33'),
(29, 16, 'msndrakmi2@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-16 02:44:07', '2026-06-16 02:44:07'),
(30, 16, 'msndrakmi2@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 04:28:39', '2026-06-17 04:28:39'),
(31, 15, 'zikrirupat1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 04:30:41', '2026-06-17 04:30:41'),
(32, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-17 05:21:12', '2026-06-17 05:21:12'),
(33, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-17 05:21:36', '2026-06-17 05:21:36'),
(34, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-17 05:21:38', '2026-06-17 05:21:38'),
(35, NULL, 'aziraa1320@gmail.comz', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-17 05:31:20', '2026-06-17 05:31:20'),
(36, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 05:31:44', '2026-06-17 05:31:44'),
(37, 15, 'zikrirupat1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 18:01:35', '2026-06-17 18:01:35'),
(38, NULL, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-17 18:04:32', '2026-06-17 18:04:32'),
(39, NULL, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-17 18:04:57', '2026-06-17 18:04:57'),
(40, 13, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 18:05:27', '2026-06-17 18:05:27'),
(41, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 18:23:59', '2026-06-17 18:23:59'),
(42, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 18:28:16', '2026-06-17 18:28:16'),
(43, 13, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 18:31:38', '2026-06-17 18:31:38'),
(44, 15, 'zikrirupat1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 18:34:24', '2026-06-17 18:34:24'),
(45, NULL, 'aziraa1320@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-17 18:42:29', '2026-06-17 18:42:29'),
(46, 20, 'msndrakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'success', '2026-06-18 21:29:10', '2026-06-18 21:29:10'),
(47, 13, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'success', '2026-06-18 21:44:33', '2026-06-18 21:44:33'),
(48, NULL, 'msndrakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-24 21:21:00', '2026-06-24 21:21:00'),
(49, NULL, 'msndrakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-24 21:21:37', '2026-06-24 21:21:37'),
(50, 20, 'msndrakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-24 21:22:43', '2026-06-24 21:22:43'),
(51, NULL, 'msndrakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-24 21:29:54', '2026-06-24 21:29:54'),
(52, NULL, 'msndrakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-24 21:30:23', '2026-06-24 21:30:23'),
(53, 13, 'masnidarakmi@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-24 21:32:30', '2026-06-24 21:32:30'),
(54, NULL, 'mazirazira7@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-25 17:51:43', '2026-06-25 17:51:43'),
(55, NULL, 'mazirazira7@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-25 17:52:36', '2026-06-25 17:52:36'),
(56, NULL, 'mazirazira9@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'failed', '2026-06-25 17:53:29', '2026-06-25 17:53:29'),
(57, 15, 'zikrirupat1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'success', '2026-06-25 17:53:59', '2026-06-25 17:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_01_000010_add_role_nim_to_users_table', 1),
(5, '2026_01_01_000011_create_events_table', 1),
(6, '2026_01_01_000012_create_registrations_table', 1),
(7, '2026_01_01_000013_create_activity_logs_table', 1),
(8, '2026_01_01_000014_add_id_panitia_to_events_table', 2),
(9, '2026_06_13_082346_create_login_histories_table', 2),
(10, '2026_06_13_105730_add_otp_fields_to_users_table', 2),
(11, '2026_06_16_100000_add_security_fields_to_users_table', 2),
(12, '2026_06_17_100000_add_profile_photo_to_users_table', 3),
(13, '2026_06_17_100001_add_location_to_events_table', 3),
(14, '2026_06_17_123728_add_profile_fields_to_users_table', 4),
(15, '2026_06_20_065628_add_organizer_to_events_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('QwuXpNKYMOGPRetD2bWcD0Ct8L5Mn9DyxzkGx6tq', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ3Mnp1VDVKSzZWaHAwZzgwbmExMUxqWGpxeE82aFU5U3hGcjlGYjl5IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImFkbWluLmRhc2hib2FyZCJ9LCJjYXB0Y2hhX2Fuc3dlciI6NSwiY2FwdGNoYV9xdWVzdGlvbiI6IjMgKyAyIiwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEzfQ==', 1782361953),
('txiVl0BR98OqZzqtPjKKFzKlzvUPZoJTITMiz7Ws', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJEVjJFVHBXTTVJcllKU3ZWcFFIclZ3aG8ya2RxYmxyVHlqYVFsVlNyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wYW5pdGlhXC9kYXNoYm9hcmQiLCJyb3V0ZSI6InBhbml0aWEuZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwiY2FwdGNoYV9hbnN3ZXIiOjE1LCJjYXB0Y2hhX3F1ZXN0aW9uIjoiNiArIDkiLCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MTV9', 1782435240);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','panitia','mahasiswa') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mahasiswa',
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nim` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_studi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `angkatan` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `is_otp_verified` tinyint(1) NOT NULL DEFAULT '0',
  `otp_resend_count` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `otp_resend_locked_until` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `profile_photo`, `nim`, `phone`, `jurusan`, `program_studi`, `angkatan`, `email_verified_at`, `password`, `otp_code`, `otp_expires_at`, `is_otp_verified`, `otp_resend_count`, `otp_resend_locked_until`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'masnidar akmi', 'masnidarakmi@gmail.com', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$yghyidoX6bChNWhvm08ieeemnIe4hOGjQNk8kXpnWPwMhTkWK8Rnm', NULL, NULL, 1, 0, NULL, 'HPUUtnUDYguo1Fy4M7r60qZzlhbTUTCKyUQUJieyWrkXt7remplrkjmsmIrx', '2026-06-15 21:16:09', '2026-06-15 23:09:21'),
(15, 'BEM polbeng', 'zikrirupat1@gmail.com', 'panitia', 'profile-photos/P33JpgpCIe7EXgUuU2VFfCdjTsulFA6eR78LiaX9.png', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$Q1tBkfQxwj8foxexo0WXN.jndm8PaAm8rPGb2SxChKGiRuVnZVU9K', NULL, NULL, 1, 0, NULL, 'vHfoTEXjdbbwSdbBBJTo5157v9wFJCpIsTCxgysT44ijzSjhnvzaHTQWRQgK', '2026-06-15 23:15:38', '2026-06-17 18:34:51'),
(16, 'UKMI', 'msndrakmi2@gmail.com', 'panitia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$.eTWMyN4VodeWbg0JqjyWubFkwPp6f9UALB2gCUfUjQp.tq.4/de.', NULL, NULL, 1, 0, NULL, 'hUgzH3TXUGOosJRm1dXco3zmlYyRxMog6Zl5OqzhuynZ1PjHcJWPeWH8XMfT', '2026-06-16 02:14:00', '2026-06-16 02:14:00'),
(20, 'masnidar akmi', 'msndrakmi@gmail.com', 'mahasiswa', 'profile-photos/AIORPemKtyrrXPK5DtyOC8CRjd4bN4dxT6Ae68os.jpg', NULL, '082287355966', 'Teknik Informatika', 'Keamanan Sistem Informasi', '2024', NULL, '$2y$12$17.4oeqrWtjth4An9nWhK.grccmm3cNhmv48CkotPL4j3QE17aGrq', NULL, NULL, 1, 0, NULL, 'zSQxjNPfpui2BulDGDGyedpBbn1KLq8bgCNDwA5YeRPiFxESJHrwcGulD9n6', '2026-06-18 21:22:52', '2026-06-18 21:39:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_created_by_foreign` (`created_by`),
  ADD KEY `events_id_panitia_foreign` (`id_panitia`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registrations_user_id_event_id_unique` (`user_id`,`event_id`),
  ADD KEY `registrations_event_id_foreign` (`event_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_histories`
--
ALTER TABLE `login_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_id_panitia_foreign` FOREIGN KEY (`id_panitia`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD CONSTRAINT `login_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
