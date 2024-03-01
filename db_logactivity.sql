-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 02:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_logactivity`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE `group_user` (
  `id_group_user` bigint(20) UNSIGNED NOT NULL,
  `kd_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_worklist`
--

CREATE TABLE `group_worklist` (
  `id_group_worklist` bigint(20) UNSIGNED NOT NULL,
  `kd_worklist_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_worklist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `handler_cabang`
--

CREATE TABLE `handler_cabang` (
  `id_handler_cabang` bigint(20) UNSIGNED NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_handler` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_tiket_laporan`
--

CREATE TABLE `log_tiket_laporan` (
  `id_log_tiket_laporan` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_tiket_mandiri`
--

CREATE TABLE `log_tiket_mandiri` (
  `id_log_tiket_mandiri` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_tiket_person_worklist`
--

CREATE TABLE `log_tiket_person_worklist` (
  `id_log_tiket_personal` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_tiket_worklist_group`
--

CREATE TABLE `log_tiket_worklist_group` (
  `id_log_tiket_group` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_09_19_123144_create_tbl_cabang_table', 1),
(5, '2022_09_19_123255_create_handler_cabang_table', 1),
(6, '2022_09_19_133416_create_tbl_akses_table', 1),
(7, '2022_09_19_163354_create_tbl_group_table', 1),
(8, '2022_09_19_165630_create_tbl_worklist_table', 1),
(9, '2022_09_19_165850_create_group_worklist_table', 1),
(10, '2022_09_19_170627_create_worklist_person_table', 1),
(11, '2022_09_19_215654_create_group_user_table', 1),
(12, '2022_09_21_142607_create_tbl_laporan_table', 1),
(13, '2022_09_21_143148_create_type_laporan_table', 1),
(14, '2022_09_21_143728_create_tbl_tiket_laporan_table', 1),
(15, '2022_09_21_143930_create_tbl_tiket_worklist_table', 1),
(16, '2022_09_21_152350_create_tbl_tiket_group_worklist_table', 1),
(17, '2022_09_21_152407_create_tbl_tiket_person_worklist_table', 1),
(18, '2022_09_21_175605_create_type_worklist_table', 1),
(19, '2022_09_21_183226_create_log_tiket_person_worklist_table', 1),
(20, '2022_09_21_183309_create_log_tiket_worklist_group_table', 1),
(21, '2022_09_21_183333_create_log_tiket_laporan_table', 1),
(22, '2022_11_24_143204_create_posts_table', 1),
(23, '2023_01_11_075613_create_tbl_tiket_mandiri', 1),
(24, '2023_01_11_111104_create_log_tiket_mandiri', 1),
(25, '2023_05_27_024937_create_tbl_kinerja_table', 1),
(26, '2023_06_21_101810_create_tbl_periode_table', 1),
(27, '2023_06_22_121332_create_tbl_schedule_table', 1),
(28, '2023_07_04_195329_create_tbl_biodata_table', 1),
(29, '2023_07_07_080015_create_tbl_schadule_log_table', 1),
(30, '2023_07_08_130545_create_tbl_tiket_task_table', 1),
(31, '2023_07_08_233541_create_tbl_tiket_task_log_table', 1),
(32, '2023_07_21_081048_create_tbl_tiket_laporan_log_table', 1),
(33, '2023_10_25_073614_create_tbl_piket_user', 2),
(34, '2023_11_13_135211_create_users_handler_table', 3),
(35, '2023_11_13_221904_create_tbl_kinerja_sub_table', 3),
(36, '2023_11_14_043542_create_users_handler_record_log_table', 3),
(37, '2023_11_14_135546_create_users_handler_backup_table', 3),
(38, '2023_11_27_082248_create_tbl_laporan_user_table', 3),
(39, '2023_11_27_134009_create_tbl_laporan_user_log_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akses`
--

CREATE TABLE `tbl_akses` (
  `kd_akses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_akses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biodata`
--

CREATE TABLE `tbl_biodata` (
  `id_biodata` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_biodata`
--

INSERT INTO `tbl_biodata` (`id_biodata`, `id_user`, `kd_cabang`, `nip`, `nama_lengkap`, `tgl_lahir`, `tempat_lahir`, `no_hp`, `alamat`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'user-8FKFP', 'PA', '33.2231.2314', 'Optimus Prime', '2024-02-01', 'Pontianak', 'agusprasetyoraharjo@gmail.com', 'Jl Perintis Gg madrasah RBK 2 no D2 , Kubu Raya', 'data_file/fileupload/user1/user-8FKFPpp.jpg', '2024-02-29 01:43:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cabang`
--

CREATE TABLE `tbl_cabang` (
  `id_cabang` int(11) NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_entitas_cabang` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longtitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_cabang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cabang`
--

INSERT INTO `tbl_cabang` (`id_cabang`, `kd_cabang`, `kd_entitas_cabang`, `nama_cabang`, `latitude`, `longtitude`, `city`, `alamat`, `phone`, `status_cabang`, `created_at`, `updated_at`) VALUES
(1, '35', 'PTP', 'PRAMITA TASIKMALAYA', '-7.3271497', '108.156606', 'TASIKMALAYA', 'Jl.Sutisna Senjaya No.39 Tasik Malaya', '0265-3164636', NULL, '2022-09-25 02:06:15', NULL),
(2, '00', 'PTP', 'PRAMITA PUSAT ( NGAGEL )', '-7.29165785351978', '112.7559789', 'SURABAYA', 'Jl. Ngagel Jaya No.71', '031-5051900', NULL, '2022-09-25 00:27:11', NULL),
(3, 'AA', 'PTP', 'PRAMITA CIK DITIRO', '-77,791', '110.375401', 'YOGYAKARTA', 'Jl. Cik Di Tiro No.17, Terban, Kec. Gondokusuman, Yogyakarta 55223', '0274 510378', NULL, '2022-09-25 01:37:02', NULL),
(4, 'AB', 'PTP', 'PRAMITA SULTAN AGUNG', '-7.80157', '110.376862', 'YOGYAKARTA', 'Jl. Sultan Agung No.67, Gunungketur, Pakualaman, Yogyakarta-55166', '0274 510378', NULL, '2022-09-25 01:45:35', NULL),
(5, 'BA', 'PTP', 'PRAMITA MATRAMAN', '-6.2010872', '106.8527472', 'JAKARTA', 'Jl. Matraman Raya 24', '021 - 85908530', NULL, '2022-09-25 01:22:21', NULL),
(6, 'BB', 'PTP', 'PRAMITA KEBON JERUK', '-6.2016741', '106.7673583', 'JAKARTA', 'Jl. Kelapa Dua Raya 18', '021 - 53672592', NULL, '2022-09-25 01:25:10', NULL),
(7, 'BC', 'PTP', 'PRAMITA JAKARTA SAMANHUDI', '-6.201755', '106.7720107', 'JAKARTA', 'Jl. Samanhudi 21', '021 - 3513332', NULL, '2022-09-25 01:47:30', NULL),
(8, 'BD', 'PTP', 'PRAMITA RAGUNAN', '-6.286379', '106.8304038', 'JAKARTA', 'Jl. Ragunan Raya P-3', '021- 27808563', NULL, '2022-09-25 02:02:04', NULL),
(9, 'DA', 'PTP', 'PRAMITA MARTADINATA', '-6.90832', '107.62459', 'BANDUNG', 'Jl. L. L. R.E. Martadinata No.135, Cihapit, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40114', '022 727 1946', NULL, '2022-09-25 01:25:53', NULL),
(10, 'DB', 'PTP', 'PRAMITA TOHA', '-6.94319', '107.60788', 'BANDUNG', 'Jl. Moh. Toha No.163, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40243', '022 520 1915', NULL, '2022-09-25 01:34:02', NULL),
(11, 'DC', 'PTP', 'PRAMITA PAJAJARAN', '-6.90679', '107.59367', 'BANDUNG', 'Jl. Pajajaran No.86, Pamoyanan, Kec. Cicendo, Kota Bandung, Jawa Barat 40173', '022 6021881', NULL, '2022-09-25 01:34:34', NULL),
(12, 'DC1', 'PTP', 'PRAMITA PASIRKALIKI', '-6.89891', '107.59721', 'BANDUNG', 'Jl. Pasir Kaliki No.215, Sukabungah, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162', '022 82066333', NULL, '2022-09-25 01:36:28', NULL),
(13, 'DD', 'PTP', 'PRAMITA BANDUNG CIMAHI', '-6.8699', '107.53533', 'BANDUNG', 'Jl. Jend. H. Amir Machmud No.460, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526', '022 8780 0636', NULL, '2022-09-25 01:48:08', NULL),
(14, 'DE', 'PTP', 'PRAMITA CIPTO MANGUNKUSUMO', '-6.722596', '108.550885', 'CIREBON', 'Jl. DR. Cipto Mangunkusumo No.95, Pekiringan, Kec. Kesambi, Cirebon, Jawa Barat 45131', '0231 248990', NULL, '2022-09-25 01:38:12', NULL),
(15, 'EA', 'PTP', 'PRAMITA DIPONEGORO', '3.578354', '98.672791', 'MEDAN', 'Jl. Pangeran Diponegoro No.37, Madras Hulu, Kec. Medan Polonia, Medan-20151', '061 4525925', NULL, '2022-09-25 01:38:57', NULL),
(16, 'EB', 'PTP', 'PRAMITA YAMIN', '3.596805', '98.686968', 'MEDAN', 'Jl. Prof. HM. Yamin Sh No.92A, Sidodadi, Medan, Sumatra Utara-20234', '061 4577997', NULL, '2022-09-25 01:39:31', NULL),
(17, 'FA', 'PTP', 'PRAMITA AHMAD YANI', '-0.94314', '100.356718', 'PADANG', 'Jl. Jend. A Yani No.39, Kp. Jao, Kec. Padang Barat, Padang, Sumatera Barat-25112', '0751 893277', NULL, '2022-09-25 01:46:13', NULL),
(18, 'GA', 'PTP', 'PRAMITA PEKANBARU SUDIRMAN', '0.5010717', '101.4508158', 'PEKANBARU', 'Jl. Jenderal Sudirman No No.14CD, Tengkerang Tengah, Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28128', '0761 7874747', NULL, '2022-09-25 01:53:07', NULL),
(19, 'HA', 'PTP', 'PRAMITA PANJAITAN', '-6.9854956', '110.4185644', 'SEMARANG', 'Jl. Mayor Jend. D.I. Panjaitan No.7, Kampung Kali, Miroto, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50134', '024 358 4088', NULL, '2022-09-25 01:42:57', NULL),
(20, 'HB', 'PTP', 'PRAMITA MAGELANG BAMBANG SUGENG', '-7.506906', '110.22395', 'MAGELANG', 'Jl Mayjen Bambang Soegeng No.A2, Mertoyudan Sarangan, Sarangan, Banyurojo, Kec. Mertoyudan, Magelang, Jawa Tengah 56172', '0293 3201370', NULL, '2022-09-25 01:56:59', NULL),
(21, 'HC', 'PTP', 'PRAMITA SALATIGA', '-7.330121', '110.49569', 'SALATIGA', 'Jl. Osamaliki No.90, Mangunsari, Kec. Sidomukti, Kota Salatiga, Jawa Tengah 50721', '0283 4533666', NULL, '2022-09-25 01:59:55', NULL),
(22, 'HD', 'PTP', 'PRAMITA TEGAL', '-6.8655087', '109.1314116', 'TEGAL', 'Jl. Gajah Mada No.88, Mintaragen, Kec. Tegal Tim., Kota Tegal, Jawa Tengah 52125', '0283 4533666', NULL, '2022-09-25 02:01:04', NULL),
(23, 'JA', 'PTP', 'PRAMITA VETERAN', '-2.9758515', '104.756088', 'PALEMBANG', 'Jl. Veteran No.173, Kepandean Baru, Kec. Ilir Tim. I, Palembang, Sumatera Selatan-30126', '0711 312588', NULL, '2022-09-25 01:41:08', NULL),
(24, 'JB', 'PTP', 'PRAMITA PALEMBANG AHMAD DAHLAN', '-2.9872692', '104.7435655', 'PALEMBANG', 'Jl. KH. Ahmad Dahlan No.70, 26 Ilir D. I, Kec. Bukit Kecil, Palembang, Sumatera Selatan 30136', '0711 314677', NULL, '2022-09-25 01:54:12', NULL),
(25, 'JC', 'PTP', 'PRAMITA PALEMBANG AHMAD YANI', '-2.9978657', '104.7716572', 'PALEMBANG', 'Jl. Jenderal Ahmad Yani No.88, 16 Ulu, Kec. Seberang Ulu II, Palembang, Sumatera Selatan-30111', '0711 5620744', NULL, '2022-09-25 01:55:22', NULL),
(26, 'LA', 'PTP', 'PRAMITA ADITYAWARMAN', '-7.2931977', '112.7297597', 'SURABAYA', 'Jl. Adityawarman No. 73 - 75', '031 - 5682416', NULL, '2022-09-25 01:27:01', NULL),
(27, 'LB', 'PTP', 'PRAMITA HR MUHAMMAD', '-7.2829605', '112.6865863', 'SURABAYA', 'Jl. HR Muhammad 128 Kav 354', '031 - 7345727', NULL, '2022-09-25 01:30:05', NULL),
(28, 'LC', 'PTP', 'PRAMITA MULYOSARI', '-7.260657', '112.7930974', 'SURABAYA', 'Jl. Mulyosari 50-52 PEE 14-15', '031 - 5929222', NULL, '2022-09-25 01:31:41', NULL),
(29, 'LD', 'PTP', 'PRAMITA JEMUR ANDAYANI', '-7.3288391', '112.7426313', 'SURABAYA', 'Jl. Jemur Andayani 67', '031 - 8477700', NULL, '2022-09-25 01:28:25', NULL),
(30, 'LF', 'PTP', 'PRAMITA PARANG KUSUMO', '-7.2393627', '112.728728', 'SURABAYA', 'Jl. Parang Kusumo 2\"', '031 - 3554990', NULL, '2022-09-25 01:44:50', NULL),
(31, 'LM', 'PTP', 'PRAMITA MADIUN PAHLAWAN', '-7.6298748', '111.5171747', 'MADIUN', 'Jl. Pahlawan No.60, Kec. Kartoharjo, Madiun, Jawa Timur-63121', '0351 462999', NULL, '2022-09-25 01:49:51', NULL),
(32, 'NA', 'PTP', 'PRAMITA DENPASAR', '-8.669895', '115.215324', 'DENPASAR', 'Jl. Diponegoro 148, Denpasar-Bali', '0361-4456773', NULL, '2022-09-25 02:03:27', NULL),
(33, 'PA', 'SIMA', 'PRAMITA PONTIANAK', '-0.04148708701832165', '109.32569066528895', 'PONTIANAK', 'Jl. Sultan Abdurrahman No. 9A', '0561 - 8101400', NULL, '2022-09-25 02:02:47', NULL),
(34, 'SA', 'PTP', 'PRAMITA BALIKPAPAN MT HARYONO', '-1.1415275', '116.6766866', 'BALIKPAPAN', 'Jl. Mt. Haryono Dalam V No.7, Sungai Nangka, Kota Balikpapan, Kalimantan Timur-76114', '0542 851 0977', NULL, '2022-09-25 01:51:43', NULL),
(35, 'TA', 'PTP', 'PRAMITA MANADO', '1.4832731', '124.8366643', 'MANADO', 'Jl. Garuda No.79, RT.4/RW.5, Mahakeret Bar., Kec. Wenang, Kota Manado, Sulawesi Utara', '0431 8809991', NULL, '2022-09-25 01:58:10', NULL),
(36, 'VA', 'PTP', 'PRAMITA MAKASSAR KARUNRUNG', '-5.1449555', '119.4122216', 'MAKASSAR', 'Jl. Karunrung No.9, Sawerigading, Kec. Ujung Pandang, Makassar, Sulawesi Selatan-90114', '0411 8940250', NULL, '2022-09-25 01:56:20', NULL),
(37, 'VB', 'PTP', 'PRAMITA MAKASSAR HERTASNING', '-5.1649966', '119.4288515', 'MAKASSAR', 'Jl. Letjen Hertasning Ruko Pena Mas no 3-4 Makassar', '0411-4097970', NULL, '2022-09-25 02:08:14', NULL),
(38, 'cabang2', 'PTP', 'cabang2', '', '', 'Kab. Kubu Raya', 'Jl Perintis Gg madrasah RBK 2 no D2 , Kubu Raya', '+6289694107336', NULL, '2023-11-01 09:40:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE `tbl_group` (
  `kd_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kinerja`
--

CREATE TABLE `tbl_kinerja` (
  `id_kinerja` bigint(20) UNSIGNED NOT NULL,
  `kd_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_kinerja`
--

INSERT INTO `tbl_kinerja` (`id_kinerja`, `kd_kinerja`, `kinerja`, `jenis_kinerja`, `status_kinerja`, `created_at`, `updated_at`) VALUES
(1, 'P001', '% up Time sistem', '1', '1', '2023-11-12 23:47:37', '2023-11-12 23:47:37'),
(2, 'P002', 'Realisasi Update system aplikasi (team)', '1', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(3, 'P003', 'Kecepatan penanganan kerusakan sistem  soft ware', '1', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(8, 'P004', 'Realisasi monitoring  back up data harian', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(9, 'P005', 'Realisasi monitoring  back up data bulanan', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(10, 'P006', 'Capaian waktu pembelajaran', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(11, 'P007', 'Realisasi monitoring kapasitas ruang simpan', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(12, 'P008', 'Realisasi monitoring pengiriman hasil via WA dan email', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(13, 'P009', 'Realisasi pekerjaan maintenance hardware komputer', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(14, 'P010', 'Realisasi Update system aplikasi (individual)', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(15, 'P011', 'Kecepatan penanganan kerusakan hardware', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(16, 'P012', 'Realisasi penanganan  keluhan pengguna terhadap soft ware dan hardware', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26'),
(17, 'P013', 'Capaian waktu pembelajaran', '2', '1', '2023-11-12 23:53:26', '2023-11-12 23:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kinerja_sub`
--

CREATE TABLE `tbl_kinerja_sub` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_kinerja_sub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_jenis_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kinerja_sub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kinerja_sub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kinerja_sub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point_kinerja_sub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_kinerja_sub`
--

INSERT INTO `tbl_kinerja_sub` (`id`, `kd_kinerja_sub`, `kd_kinerja`, `kd_jenis_kinerja`, `kinerja_sub`, `jenis_kinerja_sub`, `status_kinerja_sub`, `point_kinerja_sub`, `created_at`, `updated_at`) VALUES
(1, 'P00101', 'P001', 'server', 'Server utama BISONE\r\n', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(2, 'P00401', 'P004', 'server', 'Web Server', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(3, 'P00402', 'P004', 'server', 'Maria DB Server', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(4, 'P00403', 'P004', 'network', 'Hub utama', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(5, 'P00404', 'P004', 'network', 'LAN jaringan', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(6, 'P00405', 'P004', 'network', 'VPN Telkom', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(7, 'P00406', 'P004', 'network', 'Jaringan Internet', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(8, 'P00407', 'P004', 'pc', 'Komputer FO', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(9, 'P00408', 'P004', 'pc', 'Komputer Sampling', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(10, 'P00409', 'P004', 'pc', 'Komputer Lab', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(11, 'P00410', 'P004', 'pc', 'Komputer Adm Lab', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(12, 'P00411', 'P004', 'pc', 'Komputer Radiologi', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(13, 'P00412', 'P004', 'pc', 'Komputer CR', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(14, 'P00413', 'P004', 'pc', 'Komputer Adm Radiologi', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(15, 'P00801', 'P008', 'massages', 'Aplikasi WA hasil', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37'),
(16, 'P00802', 'P008', 'massages', 'Aplikasi email hasil', '1', '1', '1', '2023-11-13 08:23:37', '2023-11-13 08:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id_laporan` bigint(20) UNSIGNED NOT NULL,
  `kd_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_laporan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan_user`
--

CREATE TABLE `tbl_laporan_user` (
  `id_laporan` bigint(20) UNSIGNED NOT NULL,
  `tiket_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_laporan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_respon_laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_selesai_laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan_user_log`
--

CREATE TABLE `tbl_laporan_user_log` (
  `id_laporan_log` bigint(20) UNSIGNED NOT NULL,
  `tiket_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_penyelesaian` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periode`
--

CREATE TABLE `tbl_periode` (
  `id_periode` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `awal_tgl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akhir_tgl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_piket_user`
--

CREATE TABLE `tbl_piket_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_piket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_piket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_piket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_piket_user`
--

INSERT INTO `tbl_piket_user` (`id`, `id_piket`, `id_user`, `kd_cabang`, `tgl_piket`, `status_piket`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2', '3', '4', '2023-10-30 00:31:37', '2023-10-30 00:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schadule_log`
--

CREATE TABLE `tbl_schadule_log` (
  `id_log_schedule` bigint(20) UNSIGNED NOT NULL,
  `kd_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_schedule` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_schedule_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id_schedue` bigint(20) UNSIGNED NOT NULL,
  `kd_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_akhir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket_group_worklist`
--

CREATE TABLE `tbl_tiket_group_worklist` (
  `id_tiket_group_worklist` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_worklist_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tiket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket_laporan`
--

CREATE TABLE `tbl_tiket_laporan` (
  `id_tiket_laporan` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tiket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_laporan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket_laporan_log`
--

CREATE TABLE `tbl_tiket_laporan_log` (
  `id_tbl_tiket_laporan_log` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket_mandiri`
--

CREATE TABLE `tbl_tiket_mandiri` (
  `id_tiket_mandiri` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_tugas` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket_person_worklist`
--

CREATE TABLE `tbl_tiket_person_worklist` (
  `id_tiket_worklist_person` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_worklist_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tiket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket_task`
--

CREATE TABLE `tbl_tiket_task` (
  `id_tiket_task` bigint(20) UNSIGNED NOT NULL,
  `kd_tiket_task` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_leader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_task` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_v` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_task` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket_task_log`
--

CREATE TABLE `tbl_tiket_task_log` (
  `id_tiket_task_log` bigint(20) UNSIGNED NOT NULL,
  `kd_tiket_task` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_task_log` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buat_task_log` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_task_log` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_task` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket_worklist`
--

CREATE TABLE `tbl_tiket_worklist` (
  `id_tiket_worklist` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tiket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_buat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_worklist`
--

CREATE TABLE `tbl_worklist` (
  `id_worklist` bigint(20) UNSIGNED NOT NULL,
  `kd_worklist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_worklist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_worklist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_worklist` int(11) NOT NULL,
  `point_worklist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_kinerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_worklist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_laporan`
--

CREATE TABLE `type_laporan` (
  `type_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_worklist`
--

CREATE TABLE `type_worklist` (
  `type_worklist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria_worklist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_akses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cabang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_user`, `name`, `email`, `email_verified_at`, `password`, `kd_akses`, `cabang`, `status_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, '1', 'Pramita Cabang Pontianak', 'agus@rahrajo.com', NULL, '$2y$10$0RE.d.xoD1SgRxli0nI6J./jFD2is4XJPdv7AfkrvkVUHuoHFNWhu', '1', NULL, '1', NULL, '2022-09-18 16:09:36', '2022-09-18 16:09:36'),
(12, 'user-gq4uM', 'Admin', 'admin', NULL, '$2y$10$ihdkRmR6NKIUy1xba4sjauJVMnQUiEQl246coecpEg9Lxtt/Xqf8e', '2', NULL, '1', NULL, '2022-09-25 19:27:32', NULL),
(13, 'user-8FKFP', 'User 1', 'user1', NULL, '$2y$10$BdvXICh/L/8TiZE2und5E.vIsWIiD7UiQhojbT6PSZ3jS92kHMQ/q', '3', NULL, '1', NULL, '2023-10-25 00:21:30', NULL),
(14, 'user-V9HTW', 'User 2', 'user2', NULL, '$2y$10$JuXWSl4WnI3meHK1VaXKmOyyKlU8w7n0QXdMa5bk2R/d6iifsLMKu', '4', NULL, '1', NULL, '2024-02-29 01:38:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_handler`
--

CREATE TABLE `users_handler` (
  `id_users_handler` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_handler`
--

INSERT INTO `users_handler` (`id_users_handler`, `id_user`, `kd_cabang`, `created_at`, `updated_at`) VALUES
(1, 'user-8FKFP', 'PA', '2024-02-29 01:48:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_handler_backup`
--

CREATE TABLE `users_handler_backup` (
  `id_users_handler_backup` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_hendler_backup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_handler_record_log`
--

CREATE TABLE `users_handler_record_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_kinerja_sub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_jenis_kinerja_sub` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_record` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_kinerja_sub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kinerja_sub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_handler_record_log`
--

INSERT INTO `users_handler_record_log` (`id`, `kd_kinerja_sub`, `kd_jenis_kinerja_sub`, `id_user`, `kd_cabang`, `tgl_record`, `ket_kinerja_sub`, `status_kinerja_sub`, `created_at`, `updated_at`) VALUES
(1, 'P00101', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(2, 'P00401', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(3, 'P00402', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(4, 'P00403', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(5, 'P00404', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(6, 'P00405', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(7, 'P00406', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(8, 'P00407', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(9, 'P00408', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(10, 'P00409', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(11, 'P00410', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(12, 'P00411', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(13, 'P00412', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(14, 'P00413', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(15, 'P00801', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL),
(16, 'P00802', NULL, 'user-8FKFP', 'PA', '2024-02-29', 'N', '0', '2024-02-29 01:52:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `worklist_person`
--

CREATE TABLE `worklist_person` (
  `id_worklist_person` bigint(20) UNSIGNED NOT NULL,
  `kd_worklist_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_worklist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id_group_user`),
  ADD KEY `group_user_kd_group_index` (`kd_group`),
  ADD KEY `group_user_id_user_index` (`id_user`);

--
-- Indexes for table `group_worklist`
--
ALTER TABLE `group_worklist`
  ADD PRIMARY KEY (`id_group_worklist`),
  ADD UNIQUE KEY `group_worklist_kd_worklist_group_unique` (`kd_worklist_group`),
  ADD KEY `group_worklist_kd_group_index` (`kd_group`),
  ADD KEY `group_worklist_kd_worklist_index` (`kd_worklist`);

--
-- Indexes for table `handler_cabang`
--
ALTER TABLE `handler_cabang`
  ADD PRIMARY KEY (`id_handler_cabang`),
  ADD KEY `handler_cabang_kd_cabang_index` (`kd_cabang`),
  ADD KEY `handler_cabang_kd_group_index` (`kd_group`);

--
-- Indexes for table `log_tiket_laporan`
--
ALTER TABLE `log_tiket_laporan`
  ADD PRIMARY KEY (`id_log_tiket_laporan`),
  ADD KEY `log_tiket_laporan_no_tiket_index` (`no_tiket`),
  ADD KEY `log_tiket_laporan_id_user_index` (`id_user`);

--
-- Indexes for table `log_tiket_mandiri`
--
ALTER TABLE `log_tiket_mandiri`
  ADD PRIMARY KEY (`id_log_tiket_mandiri`),
  ADD KEY `log_tiket_mandiri_no_tiket_index` (`no_tiket`),
  ADD KEY `log_tiket_mandiri_id_user_index` (`id_user`);

--
-- Indexes for table `log_tiket_person_worklist`
--
ALTER TABLE `log_tiket_person_worklist`
  ADD PRIMARY KEY (`id_log_tiket_personal`),
  ADD KEY `log_tiket_person_worklist_no_tiket_index` (`no_tiket`),
  ADD KEY `log_tiket_person_worklist_id_user_index` (`id_user`);

--
-- Indexes for table `log_tiket_worklist_group`
--
ALTER TABLE `log_tiket_worklist_group`
  ADD PRIMARY KEY (`id_log_tiket_group`),
  ADD KEY `log_tiket_worklist_group_no_tiket_index` (`no_tiket`),
  ADD KEY `log_tiket_worklist_group_kd_group_index` (`kd_group`),
  ADD KEY `log_tiket_worklist_group_id_user_index` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_akses`
--
ALTER TABLE `tbl_akses`
  ADD UNIQUE KEY `tbl_akses_kd_akses_unique` (`kd_akses`);

--
-- Indexes for table `tbl_biodata`
--
ALTER TABLE `tbl_biodata`
  ADD PRIMARY KEY (`id_biodata`),
  ADD UNIQUE KEY `tbl_biodata_id_user_unique` (`id_user`),
  ADD KEY `tbl_biodata_kd_cabang_index` (`kd_cabang`);

--
-- Indexes for table `tbl_cabang`
--
ALTER TABLE `tbl_cabang`
  ADD PRIMARY KEY (`id_cabang`),
  ADD UNIQUE KEY `tbl_cabang_kd_cabang_unique` (`kd_cabang`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD UNIQUE KEY `tbl_group_kd_group_unique` (`kd_group`);

--
-- Indexes for table `tbl_kinerja`
--
ALTER TABLE `tbl_kinerja`
  ADD PRIMARY KEY (`id_kinerja`),
  ADD UNIQUE KEY `tbl_kinerja_kd_kinerja_unique` (`kd_kinerja`);

--
-- Indexes for table `tbl_kinerja_sub`
--
ALTER TABLE `tbl_kinerja_sub`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_kinerja_sub_kd_kinerja_sub_unique` (`kd_kinerja_sub`);

--
-- Indexes for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD UNIQUE KEY `tbl_laporan_kd_laporan_unique` (`kd_laporan`),
  ADD KEY `tbl_laporan_kd_kinerja_index` (`kd_kinerja`),
  ADD KEY `tbl_laporan_type_laporan_index` (`type_laporan`);

--
-- Indexes for table `tbl_laporan_user`
--
ALTER TABLE `tbl_laporan_user`
  ADD PRIMARY KEY (`id_laporan`),
  ADD UNIQUE KEY `tbl_laporan_user_tiket_laporan_unique` (`tiket_laporan`);

--
-- Indexes for table `tbl_laporan_user_log`
--
ALTER TABLE `tbl_laporan_user_log`
  ADD PRIMARY KEY (`id_laporan_log`);

--
-- Indexes for table `tbl_periode`
--
ALTER TABLE `tbl_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `tbl_piket_user`
--
ALTER TABLE `tbl_piket_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_piket_user_id_piket_unique` (`id_piket`);

--
-- Indexes for table `tbl_schadule_log`
--
ALTER TABLE `tbl_schadule_log`
  ADD PRIMARY KEY (`id_log_schedule`),
  ADD KEY `tbl_schadule_log_kd_schedule_index` (`kd_schedule`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id_schedue`),
  ADD UNIQUE KEY `tbl_schedule_kd_schedule_unique` (`kd_schedule`);

--
-- Indexes for table `tbl_tiket_group_worklist`
--
ALTER TABLE `tbl_tiket_group_worklist`
  ADD PRIMARY KEY (`id_tiket_group_worklist`),
  ADD UNIQUE KEY `tbl_tiket_group_worklist_no_tiket_unique` (`no_tiket`),
  ADD KEY `tbl_tiket_group_worklist_kd_worklist_group_index` (`kd_worklist_group`),
  ADD KEY `tbl_tiket_group_worklist_kd_kinerja_index` (`kd_kinerja`),
  ADD KEY `tbl_tiket_group_worklist_id_user_index` (`id_user`);

--
-- Indexes for table `tbl_tiket_laporan`
--
ALTER TABLE `tbl_tiket_laporan`
  ADD PRIMARY KEY (`id_tiket_laporan`),
  ADD UNIQUE KEY `tbl_tiket_laporan_no_tiket_unique` (`no_tiket`),
  ADD KEY `tbl_tiket_laporan_kd_laporan_index` (`kd_laporan`),
  ADD KEY `tbl_tiket_laporan_id_user_index` (`id_user`);

--
-- Indexes for table `tbl_tiket_laporan_log`
--
ALTER TABLE `tbl_tiket_laporan_log`
  ADD PRIMARY KEY (`id_tbl_tiket_laporan_log`),
  ADD KEY `tbl_tiket_laporan_log_no_tiket_index` (`no_tiket`),
  ADD KEY `tbl_tiket_laporan_log_id_user_index` (`id_user`);

--
-- Indexes for table `tbl_tiket_mandiri`
--
ALTER TABLE `tbl_tiket_mandiri`
  ADD PRIMARY KEY (`id_tiket_mandiri`),
  ADD UNIQUE KEY `tbl_tiket_mandiri_no_tiket_unique` (`no_tiket`),
  ADD KEY `tbl_tiket_mandiri_id_user_index` (`id_user`),
  ADD KEY `tbl_tiket_mandiri_kd_cabang_index` (`kd_cabang`);

--
-- Indexes for table `tbl_tiket_person_worklist`
--
ALTER TABLE `tbl_tiket_person_worklist`
  ADD PRIMARY KEY (`id_tiket_worklist_person`),
  ADD UNIQUE KEY `tbl_tiket_person_worklist_no_tiket_unique` (`no_tiket`),
  ADD KEY `tbl_tiket_person_worklist_kd_worklist_person_index` (`kd_worklist_person`),
  ADD KEY `tbl_tiket_person_worklist_kd_kinerja_index` (`kd_kinerja`),
  ADD KEY `tbl_tiket_person_worklist_id_user_index` (`id_user`);

--
-- Indexes for table `tbl_tiket_task`
--
ALTER TABLE `tbl_tiket_task`
  ADD PRIMARY KEY (`id_tiket_task`),
  ADD KEY `tbl_tiket_task_id_leader_index` (`id_leader`),
  ADD KEY `tbl_tiket_task_kd_cabang_index` (`kd_cabang`),
  ADD KEY `tbl_tiket_task_kd_kinerja_index` (`kd_kinerja`);

--
-- Indexes for table `tbl_tiket_task_log`
--
ALTER TABLE `tbl_tiket_task_log`
  ADD PRIMARY KEY (`id_tiket_task_log`),
  ADD KEY `tbl_tiket_task_log_kd_tiket_task_index` (`kd_tiket_task`),
  ADD KEY `tbl_tiket_task_log_id_user_index` (`id_user`);

--
-- Indexes for table `tbl_tiket_worklist`
--
ALTER TABLE `tbl_tiket_worklist`
  ADD PRIMARY KEY (`id_tiket_worklist`),
  ADD UNIQUE KEY `tbl_tiket_worklist_no_tiket_unique` (`no_tiket`),
  ADD KEY `tbl_tiket_worklist_kd_group_index` (`kd_group`),
  ADD KEY `tbl_tiket_worklist_id_user_index` (`id_user`);

--
-- Indexes for table `tbl_worklist`
--
ALTER TABLE `tbl_worklist`
  ADD PRIMARY KEY (`id_worklist`),
  ADD UNIQUE KEY `tbl_worklist_kd_worklist_unique` (`kd_worklist`),
  ADD KEY `tbl_worklist_type_worklist_index` (`type_worklist`);

--
-- Indexes for table `type_laporan`
--
ALTER TABLE `type_laporan`
  ADD UNIQUE KEY `type_laporan_type_laporan_unique` (`type_laporan`);

--
-- Indexes for table `type_worklist`
--
ALTER TABLE `type_worklist`
  ADD UNIQUE KEY `type_worklist_type_worklist_unique` (`type_worklist`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_user_unique` (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_index` (`id`),
  ADD KEY `users_kd_akses_index` (`kd_akses`);

--
-- Indexes for table `users_handler`
--
ALTER TABLE `users_handler`
  ADD PRIMARY KEY (`id_users_handler`);

--
-- Indexes for table `users_handler_backup`
--
ALTER TABLE `users_handler_backup`
  ADD PRIMARY KEY (`id_users_handler_backup`);

--
-- Indexes for table `users_handler_record_log`
--
ALTER TABLE `users_handler_record_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worklist_person`
--
ALTER TABLE `worklist_person`
  ADD PRIMARY KEY (`id_worklist_person`),
  ADD UNIQUE KEY `worklist_person_kd_worklist_person_unique` (`kd_worklist_person`),
  ADD KEY `worklist_person_id_user_index` (`id_user`),
  ADD KEY `worklist_person_kd_worklist_index` (`kd_worklist`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id_group_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_worklist`
--
ALTER TABLE `group_worklist`
  MODIFY `id_group_worklist` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `handler_cabang`
--
ALTER TABLE `handler_cabang`
  MODIFY `id_handler_cabang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_tiket_laporan`
--
ALTER TABLE `log_tiket_laporan`
  MODIFY `id_log_tiket_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_tiket_mandiri`
--
ALTER TABLE `log_tiket_mandiri`
  MODIFY `id_log_tiket_mandiri` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_tiket_person_worklist`
--
ALTER TABLE `log_tiket_person_worklist`
  MODIFY `id_log_tiket_personal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_tiket_worklist_group`
--
ALTER TABLE `log_tiket_worklist_group`
  MODIFY `id_log_tiket_group` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_biodata`
--
ALTER TABLE `tbl_biodata`
  MODIFY `id_biodata` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cabang`
--
ALTER TABLE `tbl_cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_kinerja`
--
ALTER TABLE `tbl_kinerja`
  MODIFY `id_kinerja` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_kinerja_sub`
--
ALTER TABLE `tbl_kinerja_sub`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_laporan_user`
--
ALTER TABLE `tbl_laporan_user`
  MODIFY `id_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_laporan_user_log`
--
ALTER TABLE `tbl_laporan_user_log`
  MODIFY `id_laporan_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `id_periode` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_piket_user`
--
ALTER TABLE `tbl_piket_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_schadule_log`
--
ALTER TABLE `tbl_schadule_log`
  MODIFY `id_log_schedule` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id_schedue` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tiket_group_worklist`
--
ALTER TABLE `tbl_tiket_group_worklist`
  MODIFY `id_tiket_group_worklist` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tiket_laporan`
--
ALTER TABLE `tbl_tiket_laporan`
  MODIFY `id_tiket_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tiket_laporan_log`
--
ALTER TABLE `tbl_tiket_laporan_log`
  MODIFY `id_tbl_tiket_laporan_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tiket_mandiri`
--
ALTER TABLE `tbl_tiket_mandiri`
  MODIFY `id_tiket_mandiri` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tiket_person_worklist`
--
ALTER TABLE `tbl_tiket_person_worklist`
  MODIFY `id_tiket_worklist_person` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tiket_task`
--
ALTER TABLE `tbl_tiket_task`
  MODIFY `id_tiket_task` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tiket_task_log`
--
ALTER TABLE `tbl_tiket_task_log`
  MODIFY `id_tiket_task_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tiket_worklist`
--
ALTER TABLE `tbl_tiket_worklist`
  MODIFY `id_tiket_worklist` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_worklist`
--
ALTER TABLE `tbl_worklist`
  MODIFY `id_worklist` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_handler`
--
ALTER TABLE `users_handler`
  MODIFY `id_users_handler` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_handler_backup`
--
ALTER TABLE `users_handler_backup`
  MODIFY `id_users_handler_backup` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_handler_record_log`
--
ALTER TABLE `users_handler_record_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `worklist_person`
--
ALTER TABLE `worklist_person`
  MODIFY `id_worklist_person` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
