-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 10:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_26_233259_create_tb_log_table', 1),
(6, '2023_05_26_233727_create_tb_m_jabatan_table', 1),
(7, '2023_05_26_234428_create_tb_m_user_teacher_table', 1),
(8, '2023_05_27_000658_create_tb_m_jurusan_table', 1),
(9, '2023_05_27_002342_create_tb_m_mapel_table', 1),
(10, '2023_05_27_002626_create_tb_t_mapel_table', 1),
(11, '2023_05_27_004456_create_tb_t_materi_table', 1),
(12, '2023_05_27_041814_create_tb_m_period_table', 1),
(13, '2023_05_27_041904_create_tb_t_period_class_table', 1),
(14, '2023_05_27_042234_create_tb_m_gedung_table', 1),
(15, '2023_05_27_042346_create_tb_m_ruang_table', 1),
(16, '2023_05_27_042611_create_tb_t_class_table', 1),
(17, '2023_05_27_043425_create_tb_t_presensi_table', 1),
(18, '2023_05_27_050510_create_tb_t_student_table', 1),
(19, '2023_05_27_050522_create_tb_m_tugas_table', 1),
(20, '2023_05_27_050548_create_tb_t_tugas_table', 1),
(21, '2023_05_27_050600_create_tb_t_nilai_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `id_log` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `useraccess` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`id_log`, `module`, `action`, `useraccess`, `created_at`, `updated_at`) VALUES
(1, 'Data_Teacher', 'Tambah data user guru', 'Administrator', '2023-05-30 03:49:36', '2023-05-30 03:49:36'),
(2, 'Data_Student', 'Import data user siswa', 'Administrator', '2023-05-30 12:58:08', '2023-05-30 12:58:08'),
(3, 'Data_Teacher', 'Tambah data jabatan', 'Administrator', '2023-05-30 13:12:05', '2023-05-30 13:12:05'),
(4, 'Data_Teacher', 'Update data user guru', 'Administrator', '2023-05-30 13:12:22', '2023-05-30 13:12:22'),
(5, 'Data_Teacher', 'Update data user guru', 'Administrator', '2023-05-30 13:12:38', '2023-05-30 13:12:38'),
(6, 'Data_Teacher', 'Update data user guru', 'Administrator', '2023-05-30 13:12:50', '2023-05-30 13:12:50'),
(7, 'Data_Akademik', 'Tambah data mapel', 'Administrator', '2023-05-30 13:43:18', '2023-05-30 13:43:18'),
(8, 'Data_Akademik', 'Tambah data Ploting mapel', 'Administrator', '2023-05-30 16:59:17', '2023-05-30 16:59:17'),
(9, 'Data_Akademik', 'Update data ploting mapel', 'Administrator', '2023-05-30 17:59:40', '2023-05-30 17:59:40'),
(10, 'Data_Akademik', 'Update data ploting mapel', 'Administrator', '2023-05-30 18:00:02', '2023-05-30 18:00:02'),
(11, 'Data_Akademik', 'Update data ploting mapel', 'Administrator', '2023-05-30 18:02:22', '2023-05-30 18:02:22'),
(12, 'Data_Akademik', 'Tambah data period', 'Administrator', '2023-05-31 04:09:19', '2023-05-31 04:09:19'),
(13, 'Data_Akademik', 'Tambah data period', 'Administrator', '2023-05-31 04:12:57', '2023-05-31 04:12:57'),
(14, 'Data_Akademik', 'Tambah data period', 'Administrator', '2023-05-31 04:34:11', '2023-05-31 04:34:11'),
(15, 'Data_Akademik', 'Tambah data period', 'Administrator', '2023-05-31 05:56:13', '2023-05-31 05:56:13'),
(16, 'Data_Akademik', 'Tambah data Ploting Class Period', 'Administrator', '2023-05-31 07:24:50', '2023-05-31 07:24:50'),
(17, 'Data_Akademik', 'Update data Ploting Class Period', 'Administrator', '2023-05-31 07:35:30', '2023-05-31 07:35:30'),
(18, 'Data_Akademik', 'Update data Ploting Class Period', 'Administrator', '2023-05-31 07:35:35', '2023-05-31 07:35:35'),
(19, 'Data_Akademik', 'Update data Ploting Class Period', 'Administrator', '2023-05-31 07:35:43', '2023-05-31 07:35:43'),
(20, 'Data_Akademik', 'Update data Ploting Class Period', 'Administrator', '2023-05-31 07:36:06', '2023-05-31 07:36:06'),
(21, 'Data_Akademik', 'Tambah Data Ploting Class & Mapel', 'Administrator', '2023-05-31 11:17:11', '2023-05-31 11:17:11'),
(22, 'Data_Akademik', 'Update Data Ploting Class $ Mapel', 'Administrator', '2023-05-31 11:35:25', '2023-05-31 11:35:25'),
(23, 'Data_Akademik', 'Update Data Ploting Class $ Mapel', 'Administrator', '2023-05-31 11:37:15', '2023-05-31 11:37:15'),
(24, 'Data_Student', 'Update data user siswa', 'Administrator', '2023-05-31 11:38:04', '2023-05-31 11:38:04'),
(25, 'Data_Student', 'Update data user siswa', 'Administrator', '2023-05-31 11:38:13', '2023-05-31 11:38:13'),
(26, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:05:56', '2023-05-31 16:05:56'),
(27, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:06:36', '2023-05-31 16:06:36'),
(28, 'Data_Ruang', 'Tambah Gedung', 'Administrator', '2023-05-31 16:07:11', '2023-05-31 16:07:11'),
(29, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:07:19', '2023-05-31 16:07:19'),
(30, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:07:45', '2023-05-31 16:07:45'),
(31, 'Data_Ruang', 'Tambah Gedung', 'Administrator', '2023-05-31 16:11:15', '2023-05-31 16:11:15'),
(32, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:11:30', '2023-05-31 16:11:30'),
(33, 'Data_Ruang', 'Tambah Gedung', 'Administrator', '2023-05-31 16:24:10', '2023-05-31 16:24:10'),
(34, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:24:19', '2023-05-31 16:24:19'),
(35, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:24:24', '2023-05-31 16:24:24'),
(36, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:24:31', '2023-05-31 16:24:31'),
(37, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:24:56', '2023-05-31 16:24:56'),
(38, 'Data_Ruang', 'Tambah Gedung', 'Administrator', '2023-05-31 16:28:05', '2023-05-31 16:28:05'),
(39, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:28:16', '2023-05-31 16:28:16'),
(40, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:28:27', '2023-05-31 16:28:27'),
(41, 'Data_Ruang', 'Tambah Ruangan', 'Administrator', '2023-05-31 16:28:38', '2023-05-31 16:28:38'),
(42, 'Data_Akademik', 'Tambah Data Ploting Class & Mapel', 'Administrator', '2023-05-31 16:30:17', '2023-05-31 16:30:17'),
(43, 'Data_Student', 'Update data user siswa', 'Administrator', '2023-05-31 16:30:31', '2023-05-31 16:30:31'),
(44, 'Data_Student', 'Update data user siswa', 'Administrator', '2023-05-31 16:30:42', '2023-05-31 16:30:42'),
(45, 'Data_Student', 'Import data user siswa', 'Administrator', '2023-06-01 07:26:47', '2023-06-01 07:26:47'),
(46, 'Data_Akademik', 'Tambah data Ploting mapel', 'Administrator', '2023-06-01 07:59:41', '2023-06-01 07:59:41'),
(47, 'Data_Akademik', 'Tambah Data Ploting Class & Mapel', 'Administrator', '2023-06-01 08:00:28', '2023-06-01 08:00:28'),
(48, 'Data_Student', 'Update data user siswa', 'Administrator', '2023-06-01 08:05:35', '2023-06-01 08:05:35'),
(49, 'Data_Akademik', 'Tambah data mapel', 'Administrator', '2023-06-01 08:11:11', '2023-06-01 08:11:11'),
(50, 'Data_Akademik', 'Tambah data mapel', 'Administrator', '2023-06-01 08:11:17', '2023-06-01 08:11:17'),
(51, 'Data_Akademik', 'Tambah data mapel', 'Administrator', '2023-06-01 08:11:27', '2023-06-01 08:11:27'),
(52, 'Data_Akademik', 'Tambah data Ploting mapel', 'Administrator', '2023-06-01 08:12:12', '2023-06-01 08:12:12'),
(53, 'Data_Akademik', 'Tambah data Ploting mapel', 'Administrator', '2023-06-01 08:12:33', '2023-06-01 08:12:33'),
(54, 'Data_Akademik', 'Tambah data Ploting mapel', 'Administrator', '2023-06-01 08:13:13', '2023-06-01 08:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_gedung`
--

CREATE TABLE `tb_m_gedung` (
  `id_mg` bigint(20) UNSIGNED NOT NULL,
  `name_mg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_m_gedung`
--

INSERT INTO `tb_m_gedung` (`id_mg`, `name_mg`, `created_at`, `updated_at`) VALUES
(4, 'Gedung A', '2023-05-31 16:24:10', '2023-05-31 16:24:10'),
(5, 'Gedung B', '2023-05-31 16:28:05', '2023-05-31 16:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_jabatan`
--

CREATE TABLE `tb_m_jabatan` (
  `id_mja` bigint(20) UNSIGNED NOT NULL,
  `name_mja` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_mapel`
--

CREATE TABLE `tb_m_mapel` (
  `id_mm` bigint(20) UNSIGNED NOT NULL,
  `name_mm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_m_mapel`
--

INSERT INTO `tb_m_mapel` (`id_mm`, `name_mm`, `created_at`, `updated_at`) VALUES
(2, 'Fisika', '2023-05-30 13:43:18', '2023-05-30 13:43:18'),
(3, 'Biologi', '2023-06-01 08:11:11', '2023-06-01 08:11:11'),
(4, 'Matematika', '2023-06-01 08:11:17', '2023-06-01 08:11:17'),
(5, 'Bahasa Indonesia', '2023-06-01 08:11:27', '2023-06-01 08:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_period`
--

CREATE TABLE `tb_m_period` (
  `id_mper` bigint(20) UNSIGNED NOT NULL,
  `name_mper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_mp` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_m_period`
--

INSERT INTO `tb_m_period` (`id_mper`, `name_mper`, `status_mp`, `created_at`, `updated_at`) VALUES
(4, '2026/2027', 1, '2023-05-31 04:34:11', '2023-05-31 06:02:56'),
(5, '2027/2028', 1, '2023-05-31 05:56:13', '2023-05-31 05:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_ruang`
--

CREATE TABLE `tb_m_ruang` (
  `id_mr` bigint(20) UNSIGNED NOT NULL,
  `id_mg` bigint(20) UNSIGNED NOT NULL,
  `name_mr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_m_ruang`
--

INSERT INTO `tb_m_ruang` (`id_mr`, `id_mg`, `name_mr`, `created_at`, `updated_at`) VALUES
(8, 4, 'A302', '2023-05-31 16:24:24', '2023-05-31 16:24:24'),
(9, 4, 'A303', '2023-05-31 16:24:31', '2023-05-31 16:24:31'),
(10, 4, 'A301', '2023-05-31 16:24:56', '2023-05-31 16:24:56'),
(11, 5, 'B301', '2023-05-31 16:28:16', '2023-05-31 16:28:16'),
(12, 5, 'B302', '2023-05-31 16:28:27', '2023-05-31 16:28:27'),
(13, 5, 'B303', '2023-05-31 16:28:38', '2023-05-31 16:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_tugas`
--

CREATE TABLE `tb_m_tugas` (
  `id_mt` bigint(20) UNSIGNED NOT NULL,
  `id_tc` bigint(20) UNSIGNED NOT NULL,
  `id_mut` bigint(20) UNSIGNED NOT NULL,
  `desk_tj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmb_tj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_tj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline_tt` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_user_teacher`
--

CREATE TABLE `tb_m_user_teacher` (
  `id_mut` bigint(20) UNSIGNED NOT NULL,
  `id_mja` bigint(20) UNSIGNED DEFAULT NULL,
  `nip` bigint(20) NOT NULL,
  `name_mut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttl_mut` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender_mut` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_mut` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notelp_mut` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_mut` enum('tetap','honorer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_mut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_mut` enum('admin','guru') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_m_user_teacher`
--

INSERT INTO `tb_m_user_teacher` (`id_mut`, `id_mja`, `nip`, `name_mut`, `ttl_mut`, `gender_mut`, `alamat_mut`, `notelp_mut`, `email`, `status_mut`, `foto_mut`, `role_mut`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 21416255201039, 'Risma Marina', 'Bandung/11/08/1999', 'P', 'Bandung Pangalengan', 85172469936, 'rismamarina@gmail.com', 'tetap', NULL, 'admin', 'eyJpdiI6IjZ6NWNBV0pxSC9lRmI3TFFTSE9QNHc9PSIsInZhbHVlIjoiQkxlNzNjdWgyNW5pS3V5bi9qTG5iZz09IiwibWFjIjoiYjJjN2FmODE4YmJiMDJkYjc0ODQwNjA1YTJiN2Q1MzMyOTA1MWRjYTg0YjVjYjdmYmY3YmY5ZmYyYzAzYTUwMyIsInRhZyI6IiJ9', 'active', '2023-05-30 03:49:36', '2023-05-30 13:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_class`
--

CREATE TABLE `tb_t_class` (
  `id_tc` bigint(20) UNSIGNED NOT NULL,
  `id_tpc` bigint(20) UNSIGNED NOT NULL,
  `id_mr` bigint(20) UNSIGNED DEFAULT NULL,
  `name_tc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_t_class`
--

INSERT INTO `tb_t_class` (`id_tc`, `id_tpc`, `id_mr`, `name_tc`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 'X-IPA-1', '2023-05-31 11:17:11', '2023-05-31 11:17:11'),
(4, 2, 8, 'X-IPA-1', '2023-06-01 08:00:28', '2023-06-01 08:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_mapel`
--

CREATE TABLE `tb_t_mapel` (
  `id_tm` bigint(20) UNSIGNED NOT NULL,
  `id_tpc` bigint(20) UNSIGNED NOT NULL,
  `id_mm` bigint(20) UNSIGNED NOT NULL,
  `id_mut` bigint(20) UNSIGNED NOT NULL,
  `kode_mm_tm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_t_mapel`
--

INSERT INTO `tb_t_mapel` (`id_tm`, `id_tpc`, `id_mm`, `id_mut`, `kode_mm_tm`, `created_at`, `updated_at`) VALUES
(3, 2, 2, 1, 'Fisika Turunan', '2023-06-01 07:59:41', '2023-06-01 07:59:41'),
(4, 2, 3, 1, 'Biologi', '2023-06-01 08:12:12', '2023-06-01 08:12:12'),
(5, 2, 4, 1, 'Matematika Diskrit', '2023-06-01 08:12:33', '2023-06-01 08:12:33'),
(6, 2, 5, 1, 'Kosakata', '2023-06-01 08:13:13', '2023-06-01 08:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_materi`
--

CREATE TABLE `tb_t_materi` (
  `id_tmat` bigint(20) UNSIGNED NOT NULL,
  `id_tm` bigint(20) UNSIGNED NOT NULL,
  `judul_tmat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desk_tmat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmb_tmat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_tmat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_tmat` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_nilai`
--

CREATE TABLE `tb_t_nilai` (
  `id_tn` bigint(20) UNSIGNED NOT NULL,
  `id_tu` bigint(20) UNSIGNED NOT NULL,
  `nilai_tn` int(11) NOT NULL,
  `description_tn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_period_class`
--

CREATE TABLE `tb_t_period_class` (
  `id_tpc` bigint(20) UNSIGNED NOT NULL,
  `id_mper` bigint(20) UNSIGNED NOT NULL,
  `name_tpc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_tpc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_t_period_class`
--

INSERT INTO `tb_t_period_class` (`id_tpc`, `id_mper`, `name_tpc`, `description_tpc`, `created_at`, `updated_at`) VALUES
(2, 5, 'X-IPA', 'Semester 1 dan 2', '2023-05-31 07:24:50', '2023-05-31 07:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_presensi`
--

CREATE TABLE `tb_t_presensi` (
  `id_tp` bigint(20) UNSIGNED NOT NULL,
  `id_mus` bigint(20) UNSIGNED NOT NULL,
  `status` enum('masuk','pulang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_t_presensi`
--

INSERT INTO `tb_t_presensi` (`id_tp`, `id_mus`, `status`, `tanggal`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 5, 'masuk', '2023-06-01 14:52:04', -6.323386, 107.30056, '2023-06-01 07:52:04', '2023-06-01 07:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_t_tugas`
--

CREATE TABLE `tb_t_tugas` (
  `id_tu` bigint(20) UNSIGNED NOT NULL,
  `id_mus` bigint(20) UNSIGNED NOT NULL,
  `id_mt` bigint(20) UNSIGNED NOT NULL,
  `desk_tj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmb_tj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_tj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_mus` bigint(20) UNSIGNED NOT NULL,
  `nis` bigint(20) NOT NULL,
  `id_tc` bigint(20) UNSIGNED DEFAULT NULL,
  `name_mus` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttl_mus` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender_mus` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_mus` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notelp_mus` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_mus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_mus` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_mus`, `nis`, `id_tc`, `name_mus`, `ttl_mus`, `gender_mus`, `alamat_mus`, `notelp_mus`, `email`, `foto_mus`, `password`, `status_mus`, `created_at`, `updated_at`) VALUES
(5, 123456, 4, 'Aldimas laksono', 'Semarang/05/10/200', 'L', 'Semarang', 123456789, 'aldimaslaksono.bigbos@gmail.com', NULL, 'eyJpdiI6InQyYzE5akdzM2RoaHJHelQzUmlHYXc9PSIsInZhbHVlIjoiei9BQ0lzVEZSbXA3d2NvQWJiRlduRUN6K2dzUGEwN2dBTXB1TlNUZEYrYz0iLCJtYWMiOiJhODlmNmEyNjRiMGQwOWI1ZWEyNTQ3NWRjMmRlMjU0ZDU3OGEwODYxZWJlMmE3Zjg5MzUxZDg4ZjE2Mzc0YzE0IiwidGFnIjoiIn0=', 'active', '2023-06-01 07:26:47', '2023-06-01 08:05:35'),
(6, 654321, 2, 'risma marina', 'Bandung/11/08/1999', 'P', 'Pangalengan', 987654321, 'rismamarina.lorenzo@gmail.com', NULL, 'eyJpdiI6InE3MVgreHZHR3F3TGRmNE01elNkWGc9PSIsInZhbHVlIjoiSzBWaFZOdnJlNU11L0pXUkpuQXBXQT09IiwibWFjIjoiYmQ5NmI3MjdkYjE2MjY5OWIyMGNjMjY3YmVjNjJhYzJjYWRiZDc5MTBlZDg0ZDYwZjQ3YjI4M2QyNjdiYjNhNSIsInRhZyI6IiJ9', 'active', '2023-06-01 07:26:47', '2023-06-01 07:26:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tb_m_gedung`
--
ALTER TABLE `tb_m_gedung`
  ADD PRIMARY KEY (`id_mg`);

--
-- Indexes for table `tb_m_jabatan`
--
ALTER TABLE `tb_m_jabatan`
  ADD PRIMARY KEY (`id_mja`);

--
-- Indexes for table `tb_m_mapel`
--
ALTER TABLE `tb_m_mapel`
  ADD PRIMARY KEY (`id_mm`);

--
-- Indexes for table `tb_m_period`
--
ALTER TABLE `tb_m_period`
  ADD PRIMARY KEY (`id_mper`);

--
-- Indexes for table `tb_m_ruang`
--
ALTER TABLE `tb_m_ruang`
  ADD PRIMARY KEY (`id_mr`),
  ADD KEY `tb_m_ruang_id_mg_foreign` (`id_mg`);

--
-- Indexes for table `tb_m_tugas`
--
ALTER TABLE `tb_m_tugas`
  ADD PRIMARY KEY (`id_mt`),
  ADD KEY `tb_m_tugas_id_tc_foreign` (`id_tc`),
  ADD KEY `tb_m_tugas_id_mut_foreign` (`id_mut`);

--
-- Indexes for table `tb_m_user_teacher`
--
ALTER TABLE `tb_m_user_teacher`
  ADD PRIMARY KEY (`id_mut`),
  ADD KEY `tb_m_user_teacher_id_mja_foreign` (`id_mja`);

--
-- Indexes for table `tb_t_class`
--
ALTER TABLE `tb_t_class`
  ADD PRIMARY KEY (`id_tc`),
  ADD KEY `tb_t_class_id_tpc_foreign` (`id_tpc`),
  ADD KEY `tb_t_class_id_mr_foreign` (`id_mr`);

--
-- Indexes for table `tb_t_mapel`
--
ALTER TABLE `tb_t_mapel`
  ADD PRIMARY KEY (`id_tm`),
  ADD KEY `tb_t_mapel_id_mm_foreign` (`id_mm`),
  ADD KEY `tb_t_mapel_id_mut_foreign` (`id_mut`),
  ADD KEY `id_tcp` (`id_tpc`);

--
-- Indexes for table `tb_t_materi`
--
ALTER TABLE `tb_t_materi`
  ADD PRIMARY KEY (`id_tmat`),
  ADD KEY `tb_t_materi_id_tm_foreign` (`id_tm`);

--
-- Indexes for table `tb_t_nilai`
--
ALTER TABLE `tb_t_nilai`
  ADD PRIMARY KEY (`id_tn`),
  ADD KEY `tb_t_nilai_id_tu_foreign` (`id_tu`);

--
-- Indexes for table `tb_t_period_class`
--
ALTER TABLE `tb_t_period_class`
  ADD PRIMARY KEY (`id_tpc`),
  ADD KEY `tb_t_period_class_id_mper_foreign` (`id_mper`);

--
-- Indexes for table `tb_t_presensi`
--
ALTER TABLE `tb_t_presensi`
  ADD PRIMARY KEY (`id_tp`),
  ADD KEY `tb_t_presensi_id_mus_foreign` (`id_mus`);

--
-- Indexes for table `tb_t_tugas`
--
ALTER TABLE `tb_t_tugas`
  ADD PRIMARY KEY (`id_tu`),
  ADD KEY `tb_t_tugas_id_mus_foreign` (`id_mus`),
  ADD KEY `tb_t_tugas_id_mt_foreign` (`id_mt`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_mus`),
  ADD KEY `id_tc` (`id_tc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tb_m_gedung`
--
ALTER TABLE `tb_m_gedung`
  MODIFY `id_mg` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_m_jabatan`
--
ALTER TABLE `tb_m_jabatan`
  MODIFY `id_mja` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_m_mapel`
--
ALTER TABLE `tb_m_mapel`
  MODIFY `id_mm` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_m_period`
--
ALTER TABLE `tb_m_period`
  MODIFY `id_mper` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_m_ruang`
--
ALTER TABLE `tb_m_ruang`
  MODIFY `id_mr` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_m_tugas`
--
ALTER TABLE `tb_m_tugas`
  MODIFY `id_mt` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_m_user_teacher`
--
ALTER TABLE `tb_m_user_teacher`
  MODIFY `id_mut` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_t_class`
--
ALTER TABLE `tb_t_class`
  MODIFY `id_tc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_t_mapel`
--
ALTER TABLE `tb_t_mapel`
  MODIFY `id_tm` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_t_materi`
--
ALTER TABLE `tb_t_materi`
  MODIFY `id_tmat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_t_nilai`
--
ALTER TABLE `tb_t_nilai`
  MODIFY `id_tn` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_t_period_class`
--
ALTER TABLE `tb_t_period_class`
  MODIFY `id_tpc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_t_presensi`
--
ALTER TABLE `tb_t_presensi`
  MODIFY `id_tp` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_t_tugas`
--
ALTER TABLE `tb_t_tugas`
  MODIFY `id_tu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_mus` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_m_ruang`
--
ALTER TABLE `tb_m_ruang`
  ADD CONSTRAINT `tb_m_ruang_id_mg_foreign` FOREIGN KEY (`id_mg`) REFERENCES `tb_m_gedung` (`id_mg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_m_tugas`
--
ALTER TABLE `tb_m_tugas`
  ADD CONSTRAINT `tb_m_tugas_id_mut_foreign` FOREIGN KEY (`id_mut`) REFERENCES `tb_m_user_teacher` (`id_mut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_m_tugas_id_tc_foreign` FOREIGN KEY (`id_tc`) REFERENCES `tb_t_class` (`id_tc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_m_user_teacher`
--
ALTER TABLE `tb_m_user_teacher`
  ADD CONSTRAINT `m_user_teacher_foreign` FOREIGN KEY (`id_mja`) REFERENCES `tb_m_jabatan` (`id_mja`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_t_class`
--
ALTER TABLE `tb_t_class`
  ADD CONSTRAINT `tb_t_class_id_mr_foreign` FOREIGN KEY (`id_mr`) REFERENCES `tb_m_ruang` (`id_mr`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_t_class_id_tpc_foreign` FOREIGN KEY (`id_tpc`) REFERENCES `tb_t_period_class` (`id_tpc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_t_mapel`
--
ALTER TABLE `tb_t_mapel`
  ADD CONSTRAINT `tb_t_mapel_ibfk_1` FOREIGN KEY (`id_tpc`) REFERENCES `tb_t_period_class` (`id_tpc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_t_mapel_id_mm_foreign` FOREIGN KEY (`id_mm`) REFERENCES `tb_m_mapel` (`id_mm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_t_mapel_id_mut_foreign` FOREIGN KEY (`id_mut`) REFERENCES `tb_m_user_teacher` (`id_mut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_t_materi`
--
ALTER TABLE `tb_t_materi`
  ADD CONSTRAINT `tb_t_materi_id_tm_foreign` FOREIGN KEY (`id_tm`) REFERENCES `tb_t_mapel` (`id_tm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_t_nilai`
--
ALTER TABLE `tb_t_nilai`
  ADD CONSTRAINT `tb_t_nilai_id_tu_foreign` FOREIGN KEY (`id_tu`) REFERENCES `tb_t_tugas` (`id_tu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_t_period_class`
--
ALTER TABLE `tb_t_period_class`
  ADD CONSTRAINT `tb_t_period_class_id_mper_foreign` FOREIGN KEY (`id_mper`) REFERENCES `tb_m_period` (`id_mper`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_t_presensi`
--
ALTER TABLE `tb_t_presensi`
  ADD CONSTRAINT `tb_t_presensi_id_mus_foreign` FOREIGN KEY (`id_mus`) REFERENCES `users` (`id_mus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_t_tugas`
--
ALTER TABLE `tb_t_tugas`
  ADD CONSTRAINT `tb_t_tugas_id_mt_foreign` FOREIGN KEY (`id_mt`) REFERENCES `tb_m_tugas` (`id_mt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_t_tugas_id_mus_foreign` FOREIGN KEY (`id_mus`) REFERENCES `users` (`id_mus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_tc`) REFERENCES `tb_t_class` (`id_tc`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
