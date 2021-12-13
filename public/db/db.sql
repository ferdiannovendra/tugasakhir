-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 06:20 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenancysinlui`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot_nilai_akhir`
--

CREATE TABLE `bobot_nilai_akhir` (
  `idmata_pelajaran` int(11) NOT NULL,
  `idclass_list` int(11) NOT NULL,
  `bobot_pengetahuan` int(11) NOT NULL,
  `bobot_keterampilan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bobot_nilai_akhir`
--

INSERT INTO `bobot_nilai_akhir` (`idmata_pelajaran`, `idclass_list`, `bobot_pengetahuan`, `bobot_keterampilan`) VALUES
(1, 1, 70, 40);

-- --------------------------------------------------------

--
-- Table structure for table `class_list`
--

CREATE TABLE `class_list` (
  `idclass_list` int(11) NOT NULL,
  `name_class` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wali_kelas` int(11) NOT NULL,
  `jurusan_idjurusan` int(11) NOT NULL,
  `semester_idsemester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_list`
--

INSERT INTO `class_list` (`idclass_list`, `name_class`, `status`, `created_at`, `updated_at`, `wali_kelas`, `jurusan_idjurusan`, `semester_idsemester`) VALUES
(1, 'X-TKJ12', 'Aktif', '2021-10-26 23:55:39', '2021-11-12 08:05:55', 5, 4, 1),
(2, 'X-TPM1', 'Aktif', '2021-11-29 03:28:15', '2021-12-03 06:51:44', 6, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_siswa`
--

CREATE TABLE `detail_siswa` (
  `iddetail_siswa` int(11) NOT NULL,
  `idusers` int(11) NOT NULL,
  `nis` varchar(45) DEFAULT NULL,
  `nisn` varchar(45) DEFAULT NULL,
  `status_dalam_keluarga` enum('kandung','angkat','tiri') DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `sekolah_asal` varchar(85) DEFAULT NULL,
  `kelas_masuk` varchar(5) DEFAULT NULL,
  `jurusan` varchar(45) DEFAULT NULL,
  `jurusan_idjurusan` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data for table `detail_siswa`
--

INSERT INTO `detail_siswa` (`iddetail_siswa`, `idusers`, `nis`, `nisn`, `status_dalam_keluarga`, `anak_ke`, `sekolah_asal`, `kelas_masuk`, `jurusan`, `jurusan_idjurusan`, `updated_at`, `created_at`) VALUES
(2, 2, '789', '901', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL),
(3, 3, '12', '31', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL),
(4, 4, '5213', '1233', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL),
(5, 9, '123123123', '542132', 'kandung', 1, 'IPH', '10', NULL, NULL, '2021-12-10 20:31:22', '2021-12-10 20:31:22'),
(6, 10, '321321321', '242145', 'kandung', 3, 'Sinlui', '10', NULL, NULL, '2021-12-10 20:31:22', '2021-12-10 20:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Senin', '2021-11-28 10:43:55', '2021-11-28 10:43:55'),
(2, 'Selasa', '2021-11-28 10:44:05', '2021-11-28 10:52:41'),
(3, 'Rabu', NULL, NULL),
(4, 'Kamis', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kelas`
--

CREATE TABLE `jadwal_kelas` (
  `idclass_list` int(11) NOT NULL,
  `idmatapelajaran` int(11) NOT NULL,
  `hari_id` int(11) NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jadwal_kelas`
--

INSERT INTO `jadwal_kelas` (`idclass_list`, `idmatapelajaran`, `hari_id`, `jam_mulai`, `jam_akhir`) VALUES
(1, 1, 1, '00:37:00', '01:37:00'),
(1, 1, 2, '00:37:00', '02:38:00'),
(1, 1, 4, '15:28:00', '15:28:00'),
(1, 2, 1, '05:00:00', '06:00:00'),
(2, 1, 1, '13:49:00', '14:49:00'),
(2, 2, 1, '13:49:00', '14:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `idjenis_pembayaran` int(11) NOT NULL,
  `nama_jenis` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama_jurusan` varchar(45) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`, `description`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Teknik Komputer Jaringan', NULL, NULL, NULL, NULL),
(5, 'Teknik Permesinan', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_matapelajaran`
--

CREATE TABLE `kategori_matapelajaran` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_matapelajaran`
--

INSERT INTO `kategori_matapelajaran` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Muatan Lokal', '2021-12-09 08:24:38', '2021-12-09 08:24:38'),
(3, 'Muatan Nasional', '2021-12-09 08:26:27', '2021-12-09 08:26:27'),
(4, 'Muatan Kewilayahan', '2021-12-10 19:12:24', '2021-12-10 19:12:24'),
(5, 'Dasar Bidang Keahlian', '2021-12-10 19:13:25', '2021-12-10 19:13:25'),
(6, 'Dasar Program Keahlian', '2021-12-10 19:14:23', '2021-12-10 19:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi_dasar`
--

CREATE TABLE `kompetensi_dasar` (
  `idkompetensi_dasar` int(11) NOT NULL,
  `jenis_kd` varchar(45) DEFAULT NULL,
  `semester` enum('1','2') DEFAULT NULL,
  `kode_kd` varchar(45) DEFAULT NULL,
  `tingkat_pendidikan` enum('X','XI','XII') DEFAULT NULL,
  `kompetensi_dasar` longtext,
  `ringkasan_deskripsi` longtext,
  `status` varchar(45) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `idmata_pelajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kompetensi_dasar`
--

INSERT INTO `kompetensi_dasar` (`idkompetensi_dasar`, `jenis_kd`, `semester`, `kode_kd`, `tingkat_pendidikan`, `kompetensi_dasar`, `ringkasan_deskripsi`, `status`, `updated_at`, `created_at`, `idmata_pelajaran`) VALUES
(1, 'Pengetahuan', '1', '3.1', 'X', 'Menerapkan logika dan\r\nalgoritma komputer', 'Menerapkan logika dan\r\nalgoritma komputer', 'Aktif', '2021-12-07 14:53:25', '2021-12-07 14:53:25', 1),
(2, 'Pengetahuan', '1', '3.2', 'X', 'Menerapkan metode peta-\r\nminda', 'Menerapkan metode peta-\r\nminda', 'Aktif', '2021-12-07 14:53:25', '2021-12-07 14:53:25', 1),
(3, 'Pengetahuan', '1', '3.3', 'X', 'Mengevaluasi paragraf\r\ndeskriptif, argumentatif,\r\nnaratif dan persuasif', 'Mengevaluasi paragraf\r\ndeskriptif, argumentatif,\r\nnaratif dan persuasif', 'Aktif', '2021-12-07 14:53:25', '2021-12-07 14:53:25', 1),
(4, 'Pengetahuan', '1', '3.4', 'X', 'Menerapkan logika dan\r\noperasi perhitungan data', 'Menerapkan logika dan\r\noperasi perhitungan data', 'Aktif', '2021-12-07 14:53:25', '2021-12-07 14:53:25', 1),
(5, 'Pengetahuan', '1', '3.5', 'X', 'Menganalisis fitur yang tepat\r\nuntuk pembuatan slide', 'Menganalisis fitur yang tepat\r\nuntuk pembuatan slide', 'Aktif', '2021-12-07 14:53:25', '2021-12-07 14:53:25', 1),
(6, 'Keterampilan', '1', '4.1', 'X', 'Menggunakan fungsi-fungsi\r\nperintah (Command)', 'Menggunakan fungsi-fungsi\r\nperintah (Command)', 'Aktif', '2021-12-07 14:53:25', '2021-12-07 14:53:25', 1),
(7, 'Keterampilan', '1', '4.2', 'X', 'Membuat peta-minda', 'Membuat peta-minda', 'Aktif', '2021-12-07 14:53:25', '2021-12-07 14:53:25', 1),
(8, 'Keterampilan', '1', '4.3', 'X', 'Menyusun kembali format\r\ndokumen pengolah kata', 'Menyusun kembali format\r\ndokumen pengolah kata', 'Aktif', '2021-12-07 14:53:25', '2021-12-07 14:53:25', 1),
(9, 'Pengetahuan', '1', '3.14', 'X', 'PTS Ganjil', 'PTS', 'Aktif', '2021-12-09 16:41:35', '2021-12-09 16:41:35', 1),
(10, 'Pengetahuan', '1', '3.14', 'X', 'PAS Ganjil', 'PAS', 'Aktif', '2021-12-09 16:41:35', '2021-12-09 16:41:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_web`
--

CREATE TABLE `master_web` (
  `id` int(11) NOT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `footer_text` longtext,
  `instagram` longtext,
  `facebook` longtext,
  `twitter` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_web`
--

INSERT INTO `master_web` (`id`, `logo`, `footer_text`, `instagram`, `facebook`, `twitter`, `updated_at`, `created_at`) VALUES
(1, 'logo1_20211209183335_logo-st-louis.png', NULL, NULL, NULL, NULL, '2021-12-09 11:33:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `idmata_pelajaran` int(11) NOT NULL,
  `nama_mp` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `skm` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guru_pengajar` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`idmata_pelajaran`, `nama_mp`, `status`, `skm`, `created_at`, `updated_at`, `guru_pengajar`, `id_kategori`) VALUES
(1, 'Jaringan Komputer', 'Aktif', NULL, NULL, NULL, 5, 1),
(2, 'Pemrograman Web', 'Aktif', NULL, NULL, NULL, 6, 3),
(3, 'Agama', 'Aktif', NULL, NULL, NULL, 5, 3),
(4, 'PKN', 'Aktif', NULL, NULL, NULL, 5, 3),
(5, 'Matematika', 'Aktif', NULL, '2021-10-27 12:43:36', '2021-10-27 12:43:36', 5, 3),
(7, 'uuuuas', 'Aktif', 85, '2021-11-12 08:34:08', '2021-12-09 08:48:14', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_akhir`
--

CREATE TABLE `nilai_akhir` (
  `idmata_pelajaran` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `nilai_pengetahuan` int(11) DEFAULT '0',
  `nilai_keterampilan` int(11) DEFAULT '0',
  `nilai_akhir` int(11) DEFAULT '0',
  `predikat` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nilai_akhir`
--

INSERT INTO `nilai_akhir` (`idmata_pelajaran`, `users_id`, `nilai_pengetahuan`, `nilai_keterampilan`, `nilai_akhir`, `predikat`) VALUES
(1, 2, 78, 54, 0, NULL),
(1, 3, 64, 48, 0, NULL),
(1, 4, 88, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_per_penilaian`
--

CREATE TABLE `nilai_per_penilaian` (
  `penilaian_idpenilaian` int(11) NOT NULL,
  `idkompetensi_dasar` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nilai_per_penilaian`
--

INSERT INTO `nilai_per_penilaian` (`penilaian_idpenilaian`, `idkompetensi_dasar`, `users_idusers`, `nilai`) VALUES
(27, 1, 2, 100),
(27, 1, 3, 90),
(27, 2, 2, 80),
(27, 2, 3, 70),
(28, 1, 2, 0),
(28, 1, 3, 0),
(28, 2, 2, 0),
(28, 2, 3, 0),
(28, 3, 2, 100),
(28, 3, 3, 0),
(29, 9, 2, 100),
(29, 9, 3, 0),
(30, 10, 2, 100),
(30, 10, 3, 100),
(32, 6, 2, 0),
(32, 6, 3, 0),
(33, 7, 2, 90),
(33, 7, 3, 80),
(34, 6, 4, 100),
(34, 7, 4, 70),
(35, 6, 4, 90),
(35, 7, 4, 70),
(36, 7, 4, 100),
(37, 1, 4, 100),
(38, 9, 4, 80),
(39, 10, 4, 90);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `idpenilaian` int(11) NOT NULL,
  `jenispenilaian` enum('Pengetahuan','Keterampilan') DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `teknik_penilaian` varchar(45) DEFAULT NULL,
  `idmata_pelajaran` int(11) NOT NULL,
  `bobot` int(2) DEFAULT NULL,
  `idclass` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`idpenilaian`, `jenispenilaian`, `nama`, `teknik_penilaian`, `idmata_pelajaran`, `bobot`, `idclass`, `created_at`, `updated_at`) VALUES
(27, 'Pengetahuan', 'p1', 'Tes Tulis', 1, 1, 1, '2021-12-10 17:12:09', '2021-12-10 17:12:09'),
(28, 'Pengetahuan', 'p2', 'Tes Tulis', 1, 1, 1, '2021-12-10 17:12:09', '2021-12-10 17:12:09'),
(29, 'Pengetahuan', 'PTS', NULL, 1, 2, 1, '2021-12-10 17:12:09', '2021-12-10 17:12:09'),
(30, 'Pengetahuan', 'PAS', NULL, 1, 3, 1, '2021-12-10 17:12:09', '2021-12-10 17:12:09'),
(32, 'Keterampilan', 'k1', 'Projek', 1, 2, 1, '2021-12-10 17:24:54', '2021-12-10 17:24:54'),
(33, 'Keterampilan', 'k2', 'Kinerja', 1, 3, 1, '2021-12-10 17:24:54', '2021-12-10 17:24:54'),
(34, 'Keterampilan', 'k1', 'Kinerja', 1, 2, 2, '2021-12-12 11:34:16', '2021-12-12 11:34:16'),
(35, 'Keterampilan', 'k2', 'Kinerja', 1, 1, 2, '2021-12-12 11:34:16', '2021-12-12 11:34:16'),
(36, 'Keterampilan', 'k3', 'Kinerja', 1, 1, 2, '2021-12-12 11:34:16', '2021-12-12 11:34:16'),
(37, 'Pengetahuan', 'hehe', 'Tes Lisan', 1, 1, 2, '2021-12-12 11:59:02', '2021-12-12 11:59:02'),
(38, 'Pengetahuan', 'PTS', NULL, 1, 2, 2, '2021-12-12 11:59:02', '2021-12-12 11:59:02'),
(39, 'Pengetahuan', 'PAS', NULL, 1, 3, 2, '2021-12-12 11:59:02', '2021-12-12 11:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_has_kompetensi_dasar`
--

CREATE TABLE `penilaian_has_kompetensi_dasar` (
  `penilaian_idpenilaian` int(11) NOT NULL,
  `idkompetensi_dasar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penilaian_has_kompetensi_dasar`
--

INSERT INTO `penilaian_has_kompetensi_dasar` (`penilaian_idpenilaian`, `idkompetensi_dasar`) VALUES
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(28, 3),
(29, 9),
(30, 10),
(32, 6),
(33, 7),
(34, 6),
(34, 7),
(35, 6),
(35, 7),
(36, 7),
(37, 1),
(38, 9),
(39, 10);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `idpresensi` int(11) NOT NULL,
  `materi` varchar(45) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `catatan_pertemuan` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idclass_list` int(11) NOT NULL,
  `idmatapelajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`idpresensi`, `materi`, `start_time`, `end_time`, `catatan_pertemuan`, `created_at`, `updated_at`, `idclass_list`, `idmatapelajaran`) VALUES
(5, 'tes', '2021-12-04 15:13:00', '2021-12-04 15:19:00', 'tes', '2021-12-04 08:15:06', '2021-12-04 08:15:06', 1, 2),
(6, 'kelas', '2021-12-04 16:00:00', '2021-12-04 16:06:00', NULL, '2021-12-04 09:00:20', '2021-12-04 09:00:20', 2, 2),
(7, 'hehehehehe', '2021-12-04 16:33:00', '2021-12-04 17:44:00', NULL, '2021-12-04 09:33:46', '2021-12-04 09:33:46', 1, 2),
(8, 'gdx', '2021-12-04 16:44:00', '2021-12-04 17:50:00', NULL, '2021-12-04 09:44:26', '2021-12-04 09:44:26', 1, 1),
(9, NULL, NULL, NULL, NULL, '2021-12-07 19:19:54', '2021-12-07 19:19:54', 2, 1),
(11, 'Testing', '2021-12-13 18:27:00', '2021-12-13 20:27:00', 'tes', '2021-12-13 10:27:25', '2021-12-13 10:27:25', 1, 1),
(12, 'Tes', '2021-12-13 22:37:00', '2021-12-13 23:39:00', NULL, '2021-12-13 14:37:08', '2021-12-13 14:37:08', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rekap_keuangan`
--

CREATE TABLE `rekap_keuangan` (
  `idrekap_keuangan` int(11) NOT NULL,
  `idjenis_pembayaran` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL,
  `semester_idsemester` int(11) NOT NULL,
  `status` enum('paid','unpaid','dispensasi') DEFAULT NULL,
  `tanggal_pelunasan` date DEFAULT NULL,
  `tenggat_pembayaran` date DEFAULT NULL,
  `bukti_bayar` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rekap_presensi`
--

CREATE TABLE `rekap_presensi` (
  `idpresensi` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `time_presensi` datetime DEFAULT NULL,
  `status_presensi` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rekap_presensi`
--

INSERT INTO `rekap_presensi` (`idpresensi`, `idsiswa`, `time_presensi`, `status_presensi`) VALUES
(5, 2, NULL, 0),
(5, 3, NULL, 0),
(7, 2, NULL, 0),
(7, 3, NULL, 0),
(8, 2, NULL, 1),
(8, 3, NULL, 1),
(9, 4, NULL, 0),
(10, 2, NULL, 0),
(10, 3, NULL, 0),
(11, 2, NULL, 0),
(11, 3, NULL, 0),
(12, 2, NULL, 1),
(12, 3, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `idsemester` int(11) NOT NULL,
  `nama_semester` enum('ganjil','genap') DEFAULT NULL,
  `tahun_ajaran` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`idsemester`, `nama_semester`, `tahun_ajaran`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'ganjil', '2021/2022', '2021-12-01', '2021-12-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `idsetting` int(11) NOT NULL,
  `idsemester` int(11) NOT NULL,
  `kepala_sekolah` int(11) NOT NULL,
  `model_presensi` varchar(45) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`idsetting`, `idsemester`, `kepala_sekolah`, `model_presensi`, `updated_at`, `created_at`) VALUES
(1, 1, 6, 'Satuan', '2021-12-10 19:55:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa_di_kelas`
--

CREATE TABLE `siswa_di_kelas` (
  `users_idusers` int(11) NOT NULL,
  `classlist_idclass` int(11) NOT NULL,
  `semester_idsemester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siswa_di_kelas`
--

INSERT INTO `siswa_di_kelas` (`users_idusers`, `classlist_idclass`, `semester_idsemester`) VALUES
(2, 1, 1),
(3, 1, 1),
(4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nik` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `status` enum('guru','admin','siswa') DEFAULT NULL,
  `remember_token` varchar(45) DEFAULT NULL,
  `religion` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `birth_place` varchar(45) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `name`, `lname`, `email`, `password`, `address`, `phone`, `status`, `remember_token`, `religion`, `gender`, `birth_place`, `birth_date`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ferdian hehe', NULL, 'ferdiannovendra15@gmail.com', '$2y$10$pDOMKX8iT5KwkmMUzW1G.uLwjBPHf5pBDq/EUr1C4JQekgYyQbw0a', NULL, NULL, 'admin', NULL, NULL, NULL, NULL, '2021-11-23', '2021-10-01 02:22:15', '2021-10-01 16:54:18'),
(2, '12342', 'Noven', 'dra', 'nov@gmail.com', '$2y$10$lUjRV8vOTyzoMIq34J62wO34mpSWvstP0CEGP8ykstDxpZkAht7oW', NULL, NULL, 'siswa', NULL, NULL, NULL, NULL, NULL, '2021-10-22 05:06:00', '2021-11-28 22:45:22'),
(3, '43122', 'bryan', 'hugo', 'bryan@gmail.com', NULL, NULL, NULL, 'siswa', NULL, NULL, NULL, NULL, NULL, '2021-10-22 05:06:10', '2021-10-22 05:06:10'),
(4, '51213', 'sean ', 'jember', 'sean@gmail.com', '$2y$10$y9ACL69HbojBef9oCVarVOsfelf8HUxv1RB41QVJKRu2tnYDDrz3u', NULL, NULL, 'siswa', NULL, NULL, NULL, NULL, NULL, '2021-10-22 05:14:45', '2021-12-04 09:03:30'),
(5, '26342', 'starif', 'girsang', 'starif@gmail.com', '$2y$10$1yNpwFPTSP4BwfkutbXPlu8AGMQmtjR2yqXnhklnWkzTPjQZQ4R4e', NULL, NULL, 'guru', NULL, NULL, NULL, NULL, NULL, '2021-10-22 05:20:19', '2021-11-21 07:46:12'),
(6, '263421', 'john', 'doe', 'john@gmail.com', '$2y$10$K7VCJdy2Ho9ukJ6vLIsQd.dZx1LMk.XPSqb3KxYZkb58KrjC20kMK', NULL, NULL, 'guru', NULL, NULL, NULL, NULL, NULL, '2021-10-22 05:20:19', '2021-12-04 09:43:51'),
(9, '1122334455', 'ivan', 'dragono', 'helo@gmail.com', '$2y$10$cEPg//xVOVXSrUHSFj5H6.Ly.nB1Y4djcRN4SNFZN56YGttv580oq', 'purimas', '123456', 'siswa', NULL, 'kristen', 'L', 'Surabaya', '2021-11-21', '2021-12-10 20:31:22', '2021-12-10 20:34:26'),
(10, '6655443322', 'kenneth', 'marciano', 'hehe@gmail.com', '$2y$10$amhPxFC0Fzgdx4qOhiZ.A.wRx03ax6r8k9g5hRKy6.GV.nzk5RHPy', 'bromo', '654321', 'siswa', NULL, 'budha', 'L', 'Surabaya', '2021-11-02', '2021-12-10 20:31:22', '2021-12-10 20:31:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot_nilai_akhir`
--
ALTER TABLE `bobot_nilai_akhir`
  ADD PRIMARY KEY (`idmata_pelajaran`,`idclass_list`),
  ADD KEY `fk_mata_pelajaran_has_class_list_class_list1_idx` (`idclass_list`),
  ADD KEY `fk_mata_pelajaran_has_class_list_mata_pelajaran1_idx` (`idmata_pelajaran`);

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`idclass_list`),
  ADD KEY `fk_class_list_users1_idx` (`wali_kelas`),
  ADD KEY `fk_class_list_jurusan1_idx` (`jurusan_idjurusan`),
  ADD KEY `fk_class_list_semester1_idx` (`semester_idsemester`);

--
-- Indexes for table `detail_siswa`
--
ALTER TABLE `detail_siswa`
  ADD PRIMARY KEY (`iddetail_siswa`),
  ADD KEY `fk_detail_siswa_users_idx` (`idusers`),
  ADD KEY `fk_detail_siswa_jurusan1_idx` (`jurusan_idjurusan`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  ADD PRIMARY KEY (`idclass_list`,`idmatapelajaran`,`hari_id`),
  ADD KEY `fk_class_list_has_mata_pelajaran_mata_pelajaran1_idx` (`idmatapelajaran`),
  ADD KEY `fk_class_list_has_mata_pelajaran_class_list1_idx` (`idclass_list`),
  ADD KEY `fk_jadwal_kelas_hari1_idx` (`hari_id`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`idjenis_pembayaran`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_matapelajaran`
--
ALTER TABLE `kategori_matapelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kompetensi_dasar`
--
ALTER TABLE `kompetensi_dasar`
  ADD PRIMARY KEY (`idkompetensi_dasar`),
  ADD KEY `fk_kompetensi_dasar_mata_pelajaran1_idx` (`idmata_pelajaran`);

--
-- Indexes for table `master_web`
--
ALTER TABLE `master_web`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`idmata_pelajaran`),
  ADD KEY `fk_mata_pelajaran_users1_idx` (`guru_pengajar`),
  ADD KEY `fk_mata_pelajaran_kategori_matapelajaran1_idx` (`id_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD PRIMARY KEY (`idmata_pelajaran`,`users_id`),
  ADD KEY `fk_mata_pelajaran_has_users_users1_idx` (`users_id`),
  ADD KEY `fk_mata_pelajaran_has_users_mata_pelajaran1_idx` (`idmata_pelajaran`);

--
-- Indexes for table `nilai_per_penilaian`
--
ALTER TABLE `nilai_per_penilaian`
  ADD PRIMARY KEY (`penilaian_idpenilaian`,`idkompetensi_dasar`,`users_idusers`),
  ADD KEY `fk_penilaian_has_kompetensi_dasar_has_users_users1_idx` (`users_idusers`),
  ADD KEY `fk_penilaian_has_kompetensi_dasar_has_users_penilaian_has_k_idx` (`penilaian_idpenilaian`,`idkompetensi_dasar`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`idpenilaian`),
  ADD KEY `fk_penilaian_mata_pelajaran1_idx` (`idmata_pelajaran`),
  ADD KEY `fk_penilaian_class_list1_idx` (`idclass`);

--
-- Indexes for table `penilaian_has_kompetensi_dasar`
--
ALTER TABLE `penilaian_has_kompetensi_dasar`
  ADD PRIMARY KEY (`penilaian_idpenilaian`,`idkompetensi_dasar`),
  ADD KEY `fk_penilaian_has_kompetensi_dasar_kompetensi_dasar1_idx` (`idkompetensi_dasar`),
  ADD KEY `fk_penilaian_has_kompetensi_dasar_penilaian1_idx` (`penilaian_idpenilaian`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`idpresensi`),
  ADD KEY `fk_presensi_jadwal_kelas1_idx` (`idclass_list`,`idmatapelajaran`),
  ADD KEY `fk_mp` (`idmatapelajaran`);

--
-- Indexes for table `rekap_keuangan`
--
ALTER TABLE `rekap_keuangan`
  ADD PRIMARY KEY (`idrekap_keuangan`),
  ADD KEY `fk_rekap_keuangan_jenis_pembayaran1_idx` (`idjenis_pembayaran`),
  ADD KEY `fk_rekap_keuangan_users1_idx` (`users_idusers`),
  ADD KEY `fk_rekap_keuangan_semester1_idx` (`semester_idsemester`);

--
-- Indexes for table `rekap_presensi`
--
ALTER TABLE `rekap_presensi`
  ADD PRIMARY KEY (`idpresensi`,`idsiswa`),
  ADD KEY `fk_presensi_has_users_users1_idx` (`idsiswa`),
  ADD KEY `fk_presensi_has_users_presensi1_idx` (`idpresensi`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`idsemester`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`idsetting`),
  ADD KEY `fk_setting_semester1_idx` (`idsemester`),
  ADD KEY `fk_setting_users1_idx` (`kepala_sekolah`);

--
-- Indexes for table `siswa_di_kelas`
--
ALTER TABLE `siswa_di_kelas`
  ADD PRIMARY KEY (`users_idusers`,`classlist_idclass`,`semester_idsemester`),
  ADD KEY `fk_users_has_class_list_class_list1_idx` (`classlist_idclass`),
  ADD KEY `fk_users_has_class_list_users1_idx` (`users_idusers`),
  ADD KEY `fk_siswa_di_kelas_semester1_idx` (`semester_idsemester`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_list`
--
ALTER TABLE `class_list`
  MODIFY `idclass_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_siswa`
--
ALTER TABLE `detail_siswa`
  MODIFY `iddetail_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `idjenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_matapelajaran`
--
ALTER TABLE `kategori_matapelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kompetensi_dasar`
--
ALTER TABLE `kompetensi_dasar`
  MODIFY `idkompetensi_dasar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_web`
--
ALTER TABLE `master_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `idmata_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `idpenilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `idpresensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rekap_keuangan`
--
ALTER TABLE `rekap_keuangan`
  MODIFY `idrekap_keuangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `idsemester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_nilai_akhir`
--
ALTER TABLE `bobot_nilai_akhir`
  ADD CONSTRAINT `fk_mata_pelajaran_has_class_list_class_list1` FOREIGN KEY (`idclass_list`) REFERENCES `class_list` (`idclass_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mata_pelajaran_has_class_list_mata_pelajaran1` FOREIGN KEY (`idmata_pelajaran`) REFERENCES `mata_pelajaran` (`idmata_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `class_list`
--
ALTER TABLE `class_list`
  ADD CONSTRAINT `fk_class_list_jurusan1` FOREIGN KEY (`jurusan_idjurusan`) REFERENCES `jurusan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_class_list_semester1` FOREIGN KEY (`semester_idsemester`) REFERENCES `semester` (`idsemester`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `detail_siswa`
--
ALTER TABLE `detail_siswa`
  ADD CONSTRAINT `fk_detail_siswa_jurusan1` FOREIGN KEY (`jurusan_idjurusan`) REFERENCES `jurusan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detail_siswa_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  ADD CONSTRAINT `fk_class` FOREIGN KEY (`idclass_list`) REFERENCES `class_list` (`idclass_list`),
  ADD CONSTRAINT `fk_hari` FOREIGN KEY (`hari_id`) REFERENCES `hari` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idmatapelajaran` FOREIGN KEY (`idmatapelajaran`) REFERENCES `mata_pelajaran` (`idmata_pelajaran`);

--
-- Constraints for table `kompetensi_dasar`
--
ALTER TABLE `kompetensi_dasar`
  ADD CONSTRAINT `fk_kompetensi_dasar_mata_pelajaran1` FOREIGN KEY (`idmata_pelajaran`) REFERENCES `mata_pelajaran` (`idmata_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD CONSTRAINT `fk_mata_pelajaran_kategori_matapelajaran1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_matapelajaran` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pengajar` FOREIGN KEY (`guru_pengajar`) REFERENCES `users` (`id`);

--
-- Constraints for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD CONSTRAINT `fk_mata_pelajaran_has_users_mata_pelajaran1` FOREIGN KEY (`idmata_pelajaran`) REFERENCES `mata_pelajaran` (`idmata_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mata_pelajaran_has_users_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nilai_per_penilaian`
--
ALTER TABLE `nilai_per_penilaian`
  ADD CONSTRAINT `fk_penilaian_has_kompetensi_dasar_has_users_penilaian_has_kom1` FOREIGN KEY (`penilaian_idpenilaian`,`idkompetensi_dasar`) REFERENCES `penilaian_has_kompetensi_dasar` (`penilaian_idpenilaian`, `idkompetensi_dasar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_penilaian_has_kompetensi_dasar_has_users_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_penilaian_class_list1` FOREIGN KEY (`idclass`) REFERENCES `class_list` (`idclass_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_penilaian_mata_pelajaran1` FOREIGN KEY (`idmata_pelajaran`) REFERENCES `mata_pelajaran` (`idmata_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penilaian_has_kompetensi_dasar`
--
ALTER TABLE `penilaian_has_kompetensi_dasar`
  ADD CONSTRAINT `fk_penilaian_has_kompetensi_dasar_kompetensi_dasar1` FOREIGN KEY (`idkompetensi_dasar`) REFERENCES `kompetensi_dasar` (`idkompetensi_dasar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_penilaian_has_kompetensi_dasar_penilaian1` FOREIGN KEY (`penilaian_idpenilaian`) REFERENCES `penilaian` (`idpenilaian`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `fk_idclass` FOREIGN KEY (`idclass_list`) REFERENCES `class_list` (`idclass_list`),
  ADD CONSTRAINT `fk_mp` FOREIGN KEY (`idmatapelajaran`) REFERENCES `mata_pelajaran` (`idmata_pelajaran`);

--
-- Constraints for table `rekap_keuangan`
--
ALTER TABLE `rekap_keuangan`
  ADD CONSTRAINT `fk_rekap_keuangan_jenis_pembayaran1` FOREIGN KEY (`idjenis_pembayaran`) REFERENCES `jenis_pembayaran` (`idjenis_pembayaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekap_keuangan_semester1` FOREIGN KEY (`semester_idsemester`) REFERENCES `semester` (`idsemester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekap_keuangan_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `setting`
--
ALTER TABLE `setting`
  ADD CONSTRAINT `fk_setting_semester1` FOREIGN KEY (`idsemester`) REFERENCES `semester` (`idsemester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_setting_users1` FOREIGN KEY (`kepala_sekolah`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `siswa_di_kelas`
--
ALTER TABLE `siswa_di_kelas`
  ADD CONSTRAINT `fk_siswa_di_kelas_semester1` FOREIGN KEY (`semester_idsemester`) REFERENCES `semester` (`idsemester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_class_list_class_list1` FOREIGN KEY (`classlist_idclass`) REFERENCES `class_list` (`idclass_list`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
