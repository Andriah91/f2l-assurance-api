-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 20, 2024 at 07:49 AM
-- Server version: 10.5.21-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vhfekhbg_f2l_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `contrats`
--

CREATE TABLE `contrats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contrats`
--

INSERT INTO `contrats` (`id`, `title`, `creation_date`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(37, 'cc1', '2024-04-03', 61, '2024-04-24 17:48:52', '2024-04-24 17:48:52', NULL),
(38, 'dzsef', '2024-04-19', 64, '2024-04-25 10:05:52', '2024-04-25 10:05:52', NULL),
(39, 'Contrat voiture', '2024-04-25', 63, '2024-04-25 11:10:10', '2024-04-25 11:10:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `contrat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `titre`, `path`, `type`, `contrat_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(75, 'dd1', 'DeppdTMYlbPueXqVnOUVX5tk5IcIwaW2LczVCsxq.bmp', 'bmp', 37, '2024-04-24 17:49:17', '2024-04-24 17:49:28', '2024-04-24 17:49:28'),
(78, 'fesf', 'LGLi364LBNeaBVTyGGBqZywXTUpN0Q73cDd49XWl.jpg', 'jpg', 38, '2024-04-25 10:06:08', '2024-04-25 10:06:15', '2024-04-25 10:06:15'),
(81, 'asdas', 'RGL0oJkDWpTtdn6mM2sQqMjToc5EPKYCbHQvn61D.png', 'jpg', 39, '2024-06-14 03:21:57', '2024-06-14 03:21:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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
(10, '2024_06_13_204508_create_publicities_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `path`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'fgd', 'CAOQmtREQylDci5fj9H2TKIxvuvttosL7fyEQBIL.bmp', 'chft', '2024-04-24 17:49:47', '2024-04-24 17:49:53', '2024-04-24 17:49:53'),
(4, 'Test F2L', '7Y530ze4q4MpZqLxeEZrqHIgMGOBsjLpxNF36kCz.png', 'Test F2L', '2024-04-25 12:45:52', '2024-04-30 02:36:45', '2024-04-30 02:36:45'),
(5, 'asdasda', 'fvY4NGEXhCfdXpvz1ydZt9JbcRvOjjGkZasSeGbG.png', 'sdasdasdasd', '2024-04-25 13:16:33', '2024-04-25 13:16:33', NULL),
(6, 'asdasda', 'tdMRjElXrSwcLmoUV2sUx7xe2SJ0g3ksy0I7QDD4.png', 'sdasdasdasd', '2024-04-25 13:23:09', '2024-04-25 13:23:09', NULL),
(7, 'xcvxc', 'vcQDL9vztTgpUkJW8wyQVhOE5eprn5I8t8V923LD.png', 'vxcvxcvx', '2024-04-25 13:28:12', '2024-04-25 13:28:12', NULL),
(8, 'xcvxc', '25Ix8ap55Jm9xX4GXWrTXFoDuyFbdIRQTklmhqrD.png', 'vxcvxcvx', '2024-04-25 13:29:33', '2024-04-25 13:29:33', NULL),
(9, 'xcvxc', 'hRdl6zdLQBHDDBp37p1yshrkLNWZv4gKkqvATelg.png', 'vxcvxcvx', '2024-04-25 13:30:12', '2024-04-25 13:30:12', NULL),
(10, 'xcvxc', 'b2NgnvLr162TOmibe7LW5IkJA5NfDSvvh6VtRjQt.png', 'vxcvxcvx', '2024-04-25 13:34:19', '2024-04-25 13:34:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publicities`
--

CREATE TABLE `publicities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publicities`
--

INSERT INTO `publicities` (`id`, `titre`, `link`, `path`, `type`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Banner', 'https://www.assurances-f2l.fr/', 'LGLi364LBNeaBVTyGGBqZywXTUpN0Q73cDd49XWl.jpg', 'jpg', 1, '2024-06-14 06:52:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `registration_number` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `registration_number`, `phone`, `email`, `is_valid`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `is_admin`) VALUES
(59, 'admin1', 'rajaona', NULL, NULL, 'admin1@gmail.com', 1, NULL, '$2y$10$5YyjH4MPrLgOKOff2jbEeup4UHqZMSoZ1yde/e5vwn.z0aGMmLrLG', NULL, '2024-04-24 16:35:54', '2024-04-24 16:35:54', NULL, 1),
(60, 'aaa', 'aaa', '12345678', '231456789', 'aaa@gmail.com', 0, NULL, '$2y$10$ZhmmWJAEh03dWenPpFIlKuBiz2dxp8X7ND9hSeRLAbqnGtkzySEY2', NULL, '2024-04-24 16:36:54', '2024-04-24 16:36:54', NULL, 0),
(61, 'bbb', 'bbb', '11111111', '124587563', 'bbb@gmail.com', 1, NULL, '$2y$10$QcmsmvVq/XUfdkqzchWgE.37B0x9PmkO64ZHH2sRAFTTM8vjgSfti', NULL, '2024-04-24 17:48:03', '2024-04-25 12:55:22', NULL, 0),
(62, 'admin2', 'admin2', NULL, NULL, 'admin2@gmail.com', 1, NULL, '$2y$10$ewD0ZzSrpvFwKFRdiUusR.AFbm6yJdIQPUwO2hKxqgGO8qioSiygK', NULL, '2024-04-24 17:48:24', '2024-04-24 17:48:36', '2024-04-24 17:48:36', 1),
(63, 'Daniel', 'Solofo', '121284', '+23059723272', 'arasolofomamp@gmail.com', 1, NULL, '$2y$10$rM2IzijQ9Yqol7n4UGfno.0IPEppgrADmU0Pk65bOCbwr4VkXSzja', NULL, '2024-04-25 04:55:46', '2024-04-25 04:55:46', NULL, 0),
(64, 'cawdad', 'dwadawd', '754123689', '846257813', 'cawdad@gmail.com', 1, NULL, '$2y$10$DduYXEPxihRlSFA14kTfCuFVYz0iPLyW3n6Wfe/3SWGbNTY8qxmca', NULL, '2024-04-25 10:05:42', '2024-04-25 12:57:26', NULL, 0),
(65, 'Admin', 'F2L', NULL, NULL, 'admin@f2l-assurance.fr', 1, NULL, '$2y$10$uJZfb1h4M30k0LHxSqn2QOZzO07FMzZ3BXD7tB9i/f2QIaugEiKwC', NULL, '2024-04-25 11:26:19', '2024-04-25 11:26:19', NULL, 1),
(66, 'qweqw', 'eqweqw', '54564564', '555555555', 'asdasdas@adasda.sd', 0, NULL, '$2y$10$3.ECAUJu7jX7JWBSbiXyGu0G8lllPkGTMhleP/C8XZQbqMHYVk0nK', NULL, '2024-04-25 13:23:46', '2024-04-25 13:23:46', NULL, 0),
(67, 'benjamin', 'faujanet', '1', '+33659549663', 'benjamin.radiostar@gmail.com', 1, NULL, '$2y$10$o3D9Nb5GjtvSHepf.GoDfeF1EsEpSluycTQ/t9jceK.cpXCpi6zDq', NULL, '2024-06-18 19:05:15', '2024-06-18 19:05:15', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrats_user_id_foreign` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_contrat_id_foreign` (`contrat_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `publicities`
--
ALTER TABLE `publicities`
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
-- AUTO_INCREMENT for table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publicities`
--
ALTER TABLE `publicities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contrats`
--
ALTER TABLE `contrats`
  ADD CONSTRAINT `contrats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
