-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2025 at 08:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upgradehub`
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2025_06_10_010941_add_role_to_users_table', 1),
(3, '2025_06_10_012218_create_cache_table', 2),
(4, '2025_06_10_014712_create_produks_table', 3),
(5, '2025_06_10_014712_create_transaksis_table', 3),
(6, '2025_06_10_014712_create_ulasans_table', 3),
(7, '2025_06_10_015605_add_hash_to_produks_table', 3),
(8, '2025_06_10_031700_create_servis_table', 4),
(9, '2025_06_10_063658_add_alamat_pengiriman_to_transaksis_table', 5),
(10, '2025_06_10_143827_add_status_catatan_to_servis_table', 6),
(11, '2025_06_10_155507_add_verifikasi_to_produks_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `toko_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori` enum('baru','bekas','sparepart') NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hash_harga` varchar(255) DEFAULT NULL,
  `verifikasi` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `toko_id`, `nama`, `kategori`, `deskripsi`, `harga`, `stok`, `foto`, `created_at`, `updated_at`, `hash_harga`, `verifikasi`) VALUES
(4, 1, 'ram uhuy', 'baru', '16 giga cuy', 200000, 1, 'produk/zDTlbpn1bJl5BJRPG4Du54jV2Dhu80sWTEh7YY7P.jpg', '2025-06-09 21:30:10', '2025-06-10 09:40:06', 'bcc093b51f2cf7b7d5df44e2d8a050794e9592805b6a2daa0e49eb7cf95adb16', 1),
(5, 1, 'laptop', 'bekas', 'laptop cuy, kapan lagi ada laptop', 3000000, 0, 'produk/3p9SF0J32sOR6aPnaQ6XcudaxbkWp5iJS8SkqDgy.jpg', '2025-06-09 23:00:06', '2025-06-10 09:40:07', '7d1d5fe7d6ff14ada085312bceb6a717135d4d2326b1cadf9891fb81f854046e', 1),
(6, 2, 'ram', 'sparepart', '12 gb', 200000, 0, NULL, '2025-06-09 23:19:06', '2025-06-09 23:27:03', NULL, 0),
(7, 2, 'laptop', 'bekas', 'aman mah pokoknya', 2000000, 1, 'produk/2vmsVmwwMJY8uEIDTuRqQIpglCNANHW9GlX9Z1Lr.jpg', '2025-06-09 23:33:43', '2025-06-10 09:40:08', 'd0780f5d6772095a4699b3ec3395db6092ca0e2f30f9e03b59c238fd9810eefc', 1),
(8, 2, 'keyboard', 'bekas', 'pokoknya bagus', 500000, 1, 'produk/vECUGH0WihDk6wEtWDN2CfZ9sLhKHl5dHHitsyKV.jpg', '2025-06-10 02:34:12', '2025-06-10 09:40:09', '51130d462d7f7de02f00b5a98384d3bea4f515fd15a9bd17db3b22095f5c661c', 1);

-- --------------------------------------------------------

--
-- Table structure for table `servis`
--

CREATE TABLE `servis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `jadwal` datetime NOT NULL,
  `status` enum('menunggu','dijadwalkan','selesai') NOT NULL DEFAULT 'menunggu',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servis`
--

INSERT INTO `servis` (`id`, `pelanggan_id`, `jenis`, `lokasi`, `jadwal`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 2, 'perbaikan', 'padang', '2025-06-11 13:00:00', 'selesai', 'kaga ada masalah', '2025-06-10 07:48:56', '2025-06-10 07:49:31');

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
('fxPM5aezcLIgNlBHFGUBEeyczta1lsxJu2iN6ebY', 6, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUR5RHZVOG5YaGppeHhXb2hFdGNGdTVhdUpyOXpzckhWUnRGT0NhVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1749575002),
('M4qwkyhFUU8D8PUmEjbUTUZPCxJasKSRtuflvz5e', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTGsxWlYxWVpodE9pRU5tbklTUzhIQ0VESTkyRklRSmVhNzVrOUFSNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZWxhbmdnYW4vanVhbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1749749986);

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `pembeli_id` bigint(20) UNSIGNED NOT NULL,
  `toko_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alamat_pengiriman` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `produk_id`, `pembeli_id`, `toko_id`, `jumlah`, `status`, `created_at`, `updated_at`, `alamat_pengiriman`) VALUES
(1, 4, 2, 1, 1, 'selesai', '2025-06-10 01:23:49', '2025-06-10 01:24:14', 'padang'),
(12, 5, 2, 1, 1, 'selesai', '2025-06-10 02:29:25', '2025-06-10 02:32:31', 'padang'),
(13, 4, 2, 1, 1, 'diproses', '2025-06-10 02:31:10', '2025-06-10 02:31:10', 'jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `ulasans`
--

CREATE TABLE `ulasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `pembeli_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `komentar` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaksi_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasans`
--

INSERT INTO `ulasans` (`id`, `produk_id`, `pembeli_id`, `rating`, `komentar`, `created_at`, `updated_at`, `transaksi_id`) VALUES
(5, 4, 2, 5, 'ytrjhu', '2025-06-10 01:35:49', '2025-06-10 01:35:49', 1),
(6, 5, 2, 5, 'mantap gan', '2025-06-10 02:33:03', '2025-06-10 02:33:03', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'pelanggan',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mjd', 'mjd@gmail.com', NULL, '$2y$12$sYjaq.6LqklPwnhZYDvSO.WF91i.gdUNerikMu6PQ9NIpVW5Wz.gi', 'toko', NULL, '2025-06-09 19:10:48', '2025-06-09 19:10:48'),
(2, 'majid', 'majid@gmail.com', NULL, '$2y$12$hXlXgg/aDmS4D3kw0x.0qemXWgkK2FNsYc6Pg1tAL8Rzbg6NTLCE2', 'pelanggan', NULL, '2025-06-09 20:18:24', '2025-06-09 20:18:24'),
(3, 'rahma', 'rh@gmail.com', NULL, '$2y$12$eJN8Q.NgMtAuCIE0suUjgutdGu5q..kiXVsICpl426R5.tgkMdBq6', 'pelanggan', NULL, '2025-06-10 02:34:58', '2025-06-10 02:34:58'),
(5, 'jid', 'jid@gmail.com', NULL, '$2y$12$5KH5agmD8tvFyhsWQ4bCDu9zbWy8uCHr.sGmwAIBtgzO0bifOK7tW', 'teknisi', NULL, '2025-06-10 07:47:20', '2025-06-10 07:47:20'),
(6, 'sen', 'sen@gmail.com', NULL, '$2y$12$e1KoiWGpza4vpEn8jO3youva5jFXHiUUhL2bh/HBKSyB6GwQElH0u', 'admin', NULL, '2025-06-10 08:49:17', '2025-06-10 08:49:17');

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
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servis`
--
ALTER TABLE `servis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `servis`
--
ALTER TABLE `servis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ulasans`
--
ALTER TABLE `ulasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
