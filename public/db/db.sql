-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 12:48 PM
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
-- Database: `tenancy_sinlui`
--

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
(1, 'X-TKJ12', 'Aktif', '2021-10-27 06:55:39', '2021-11-12 15:05:55', 5, 4, 1);

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
  `jurusan_idjurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kelas`
--

CREATE TABLE `jadwal_kelas` (
  `class_list_idclass_list` int(11) NOT NULL,
  `class_list_wali_kelas` int(11) NOT NULL,
  `mata_pelajaran_idmatapelajaran` int(11) NOT NULL,
  `hari` varchar(45) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`idjenis_pembayaran`, `nama_jenis`, `created_at`, `updated_at`) VALUES
(2, 'SPP', '2021-10-27 12:34:30', '2021-10-27 12:34:30'),
(4, 'tesqwe', '2021-11-12 15:45:19', '2021-11-12 15:47:36');

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
(1, 'Keterampilan', '2', '123', 'XI', 'gege', 'hehewoakwoawk', 'Aktif', '2021-11-16 08:13:44', NULL, 1),
(2, 'Pengetahuan', '1', '123', 'X', 'hehe', 'haha', NULL, '2021-11-16 07:23:34', '2021-11-16 07:23:34', 1),
(3, 'Pengetahuan', '2', '11', 'X', 'heh', NULL, 'Aktif', '2021-11-16 07:27:05', '2021-11-16 07:27:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `idmata_pelajaran` int(11) NOT NULL,
  `nama_mp` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guru_pengajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`idmata_pelajaran`, `nama_mp`, `status`, `created_at`, `updated_at`, `guru_pengajar`) VALUES
(1, 'Jaringan Komputer', 'Aktif', NULL, NULL, 1),
(2, 'Pemrograman Web', 'Aktif', NULL, NULL, 5),
(3, 'Agama', 'Aktif', NULL, NULL, 5),
(4, 'PKN', 'Aktif', NULL, NULL, 5),
(5, 'Matematika', 'Aktif', '2021-10-27 19:43:36', '2021-10-27 19:43:36', 5),
(7, 'uuuuas', 'Aktif', '2021-11-12 15:34:08', '2021-11-12 15:35:52', 5);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_per_penilaian`
--

CREATE TABLE `nilai_per_penilaian` (
  `penilaian_idpenilaian` int(11) NOT NULL,
  `idmata_pelajaran` int(11) NOT NULL,
  `idkompetensi_dasar` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ferdiannovendra15@gmail.com', '$2y$10$6WPjCawHduA/CQ/fudeHGegtG88TpfG2Gspupfvgvuxjm6nKy2JEm', '2021-10-22 05:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `idpenilaian` int(11) NOT NULL,
  `jenispenilaian` enum('Pengetahuan','Keterampilan') DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `teknik_penilaian` enum('Tulis','Lisan','Penugasan') DEFAULT NULL,
  `mata_pelajaran_idmata_pelajaran` int(11) NOT NULL,
  `bobot` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_has_kompetensi_dasar`
--

CREATE TABLE `penilaian_has_kompetensi_dasar` (
  `penilaian_idpenilaian` int(11) NOT NULL,
  `penilaian_idmata_pelajaran` int(11) NOT NULL,
  `idkompetensi_dasar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `idclass` int(11) NOT NULL,
  `idwalikelas` int(11) NOT NULL,
  `idmatapelajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `presensi_idpresensi` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL,
  `time_presensi` datetime DEFAULT NULL,
  `status_presensi` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'genap', '2021/2022', '2021-10-10', '2022-10-15', '2021-10-19 01:42:45', '2021-11-12 12:23:38'),
(2, 'ganjil', '2021/2022', '2022-02-23', '2022-04-13', '2021-11-12 10:19:38', '2021-11-12 10:19:38'),
(3, 'ganjil', '2022/2023', '2021-11-12', '2021-12-04', '2021-11-12 10:20:02', '2021-11-12 10:20:02'),
(4, 'genap', '2023/2024', '2021-12-11', '2022-02-26', '2021-11-12 10:20:39', '2021-11-12 10:20:39'),
(5, 'genap', '2025/2026', '2021-11-06', '2021-11-25', '2021-11-12 10:24:02', '2021-11-12 10:24:02'),
(7, 'genap', '2023/2024', '2021-12-11', '2022-03-05', '2021-11-12 11:52:13', '2021-11-12 11:52:13');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_di_kelas`
--

CREATE TABLE `siswa_di_kelas` (
  `users_idusers` int(11) NOT NULL,
  `classlist_idclass` int(11) NOT NULL,
  `semester_idsemester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, NULL, 'ferdian', NULL, 'ferdiannovendra15@gmail.com', '$2y$10$pDOMKX8iT5KwkmMUzW1G.uLwjBPHf5pBDq/EUr1C4JQekgYyQbw0a', NULL, NULL, 'admin', NULL, NULL, NULL, NULL, NULL, '2021-10-01 09:22:15', '2021-10-01 23:54:18'),
(2, '12342', 'Noven', 'dra', 'nov@gmail.com', NULL, NULL, NULL, 'siswa', NULL, NULL, NULL, NULL, NULL, '2021-10-22 12:06:00', '2021-10-22 12:06:00'),
(3, '43122', 'bryan', 'hugo', 'bryan@gmail.com', NULL, NULL, NULL, 'siswa', NULL, NULL, NULL, NULL, NULL, '2021-10-22 12:06:10', '2021-10-22 12:06:10'),
(4, '51213', 'sean ', 'jember', 'sean@gmail.com', NULL, NULL, NULL, 'siswa', NULL, NULL, NULL, NULL, NULL, '2021-10-22 12:14:45', '2021-10-22 12:14:45'),
(5, '26342', 'starif', 'girsang', 'starif@gmail.com', '$2y$10$2t/sFuWllX9E2Z/jtRNKWud9rZKlpbfSrxaf.N1tu1gBw4eTJqMNy', NULL, NULL, 'guru', NULL, NULL, NULL, NULL, NULL, '2021-10-22 12:20:19', '2021-11-16 08:48:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`idclass_list`,`wali_kelas`),
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
-- Indexes for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  ADD PRIMARY KEY (`class_list_idclass_list`,`class_list_wali_kelas`,`mata_pelajaran_idmatapelajaran`),
  ADD KEY `fk_class_list_has_mata_pelajaran_mata_pelajaran1_idx` (`mata_pelajaran_idmatapelajaran`),
  ADD KEY `fk_class_list_has_mata_pelajaran_class_list1_idx` (`class_list_idclass_list`,`class_list_wali_kelas`);

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
-- Indexes for table `kompetensi_dasar`
--
ALTER TABLE `kompetensi_dasar`
  ADD PRIMARY KEY (`idkompetensi_dasar`),
  ADD KEY `fk_kompetensi_dasar_mata_pelajaran1_idx` (`idmata_pelajaran`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`idmata_pelajaran`),
  ADD KEY `fk_mata_pelajaran_users1_idx` (`guru_pengajar`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_per_penilaian`
--
ALTER TABLE `nilai_per_penilaian`
  ADD PRIMARY KEY (`penilaian_idpenilaian`,`idmata_pelajaran`,`idkompetensi_dasar`,`users_idusers`),
  ADD KEY `fk_penilaian_has_kompetensi_dasar_has_users_users1_idx` (`users_idusers`),
  ADD KEY `fk_penilaian_has_kompetensi_dasar_has_users_penilaian_has_k_idx` (`penilaian_idpenilaian`,`idmata_pelajaran`,`idkompetensi_dasar`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`idpenilaian`,`mata_pelajaran_idmata_pelajaran`),
  ADD KEY `fk_penilaian_mata_pelajaran1_idx` (`mata_pelajaran_idmata_pelajaran`);

--
-- Indexes for table `penilaian_has_kompetensi_dasar`
--
ALTER TABLE `penilaian_has_kompetensi_dasar`
  ADD PRIMARY KEY (`penilaian_idpenilaian`,`penilaian_idmata_pelajaran`,`idkompetensi_dasar`),
  ADD KEY `fk_penilaian_has_kompetensi_dasar_kompetensi_dasar1_idx` (`idkompetensi_dasar`),
  ADD KEY `fk_penilaian_has_kompetensi_dasar_penilaian1_idx` (`penilaian_idpenilaian`,`penilaian_idmata_pelajaran`);

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
  ADD KEY `fk_presensi_jadwal_kelas1_idx` (`idclass`,`idwalikelas`,`idmatapelajaran`);

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
  ADD PRIMARY KEY (`presensi_idpresensi`,`users_idusers`),
  ADD KEY `fk_presensi_has_users_users1_idx` (`users_idusers`),
  ADD KEY `fk_presensi_has_users_presensi1_idx` (`presensi_idpresensi`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`idsemester`);

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
  MODIFY `idclass_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_siswa`
--
ALTER TABLE `detail_siswa`
  MODIFY `iddetail_siswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `idjenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kompetensi_dasar`
--
ALTER TABLE `kompetensi_dasar`
  MODIFY `idkompetensi_dasar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `idmata_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `idpenilaian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `idpresensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekap_keuangan`
--
ALTER TABLE `rekap_keuangan`
  MODIFY `idrekap_keuangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `idsemester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_list`
--
ALTER TABLE `class_list`
  ADD CONSTRAINT `fk_class_list_jurusan1` FOREIGN KEY (`jurusan_idjurusan`) REFERENCES `jurusan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_class_list_semester1` FOREIGN KEY (`semester_idsemester`) REFERENCES `semester` (`idsemester`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_class_list_users1` FOREIGN KEY (`wali_kelas`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_class_list_has_mata_pelajaran_class_list1` FOREIGN KEY (`class_list_idclass_list`,`class_list_wali_kelas`) REFERENCES `class_list` (`idclass_list`, `wali_kelas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_class_list_has_mata_pelajaran_mata_pelajaran1` FOREIGN KEY (`mata_pelajaran_idmatapelajaran`) REFERENCES `mata_pelajaran` (`idmata_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kompetensi_dasar`
--
ALTER TABLE `kompetensi_dasar`
  ADD CONSTRAINT `fk_kompetensi_dasar_mata_pelajaran1` FOREIGN KEY (`idmata_pelajaran`) REFERENCES `mata_pelajaran` (`idmata_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD CONSTRAINT `fk_mata_pelajaran_users1` FOREIGN KEY (`guru_pengajar`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nilai_per_penilaian`
--
ALTER TABLE `nilai_per_penilaian`
  ADD CONSTRAINT `fk_penilaian_has_kompetensi_dasar_has_users_penilaian_has_kom1` FOREIGN KEY (`penilaian_idpenilaian`,`idmata_pelajaran`,`idkompetensi_dasar`) REFERENCES `penilaian_has_kompetensi_dasar` (`penilaian_idpenilaian`, `penilaian_idmata_pelajaran`, `idkompetensi_dasar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_penilaian_has_kompetensi_dasar_has_users_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_penilaian_mata_pelajaran1` FOREIGN KEY (`mata_pelajaran_idmata_pelajaran`) REFERENCES `mata_pelajaran` (`idmata_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penilaian_has_kompetensi_dasar`
--
ALTER TABLE `penilaian_has_kompetensi_dasar`
  ADD CONSTRAINT `fk_penilaian_has_kompetensi_dasar_kompetensi_dasar1` FOREIGN KEY (`idkompetensi_dasar`) REFERENCES `kompetensi_dasar` (`idkompetensi_dasar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_penilaian_has_kompetensi_dasar_penilaian1` FOREIGN KEY (`penilaian_idpenilaian`,`penilaian_idmata_pelajaran`) REFERENCES `penilaian` (`idpenilaian`, `mata_pelajaran_idmata_pelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `fk_presensi_jadwal_kelas1` FOREIGN KEY (`idclass`,`idwalikelas`,`idmatapelajaran`) REFERENCES `jadwal_kelas` (`class_list_idclass_list`, `class_list_wali_kelas`, `mata_pelajaran_idmatapelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rekap_keuangan`
--
ALTER TABLE `rekap_keuangan`
  ADD CONSTRAINT `fk_rekap_keuangan_jenis_pembayaran1` FOREIGN KEY (`idjenis_pembayaran`) REFERENCES `jenis_pembayaran` (`idjenis_pembayaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekap_keuangan_semester1` FOREIGN KEY (`semester_idsemester`) REFERENCES `semester` (`idsemester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekap_keuangan_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rekap_presensi`
--
ALTER TABLE `rekap_presensi`
  ADD CONSTRAINT `fk_presensi_has_users_presensi1` FOREIGN KEY (`presensi_idpresensi`) REFERENCES `presensi` (`idpresensi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_presensi_has_users_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `siswa_di_kelas`
--
ALTER TABLE `siswa_di_kelas`
  ADD CONSTRAINT `fk_siswa_di_kelas_semester1` FOREIGN KEY (`semester_idsemester`) REFERENCES `semester` (`idsemester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_class_list_class_list1` FOREIGN KEY (`classlist_idclass`) REFERENCES `class_list` (`idclass_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_class_list_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
