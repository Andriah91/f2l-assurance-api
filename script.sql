-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour gestion_contrat
CREATE DATABASE IF NOT EXISTS `gestion_contrat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gestion_contrat`;

-- Listage de la structure de table gestion_contrat. contrats
CREATE TABLE IF NOT EXISTS `contrats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contrats_user_id_foreign` (`user_id`),
  CONSTRAINT `contrats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.contrats : ~3 rows (environ)
INSERT INTO `contrats` (`id`, `title`, `creation_date`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(18, 'contrat1', '2024-03-16', 34, '2024-03-20 21:11:15', '2024-03-20 21:12:39', NULL),
	(19, 'dadwawd', '2024-03-01', 34, '2024-03-20 21:11:24', '2024-03-20 21:11:28', '2024-03-20 21:11:28'),
	(20, 'dDWd', '2024-03-15', 34, '2024-03-20 21:13:19', '2024-03-20 21:13:25', '2024-03-20 21:13:25');

-- Listage de la structure de table gestion_contrat. documents
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrat_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_contrat_id_foreign` (`contrat_id`),
  CONSTRAINT `documents_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.documents : ~1 rows (environ)
INSERT INTO `documents` (`id`, `titre`, `path`, `type`, `contrat_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(53, 'doc1', 'mMyLys1DJJTzn6hOPJSZnDH5kHPzR6R8LSVtzkoF.pdf', 'pdf', 18, '2024-03-20 21:12:10', '2024-03-20 21:12:10', NULL);

-- Listage de la structure de table gestion_contrat. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.failed_jobs : ~0 rows (environ)

-- Listage de la structure de table gestion_contrat. messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.messages : ~0 rows (environ)

-- Listage de la structure de table gestion_contrat. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.migrations : ~8 rows (environ)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_03_07_114309_create_documents_table', 1),
	(6, '2024_03_07_114442_create_messages_table', 1),
	(7, '2024_03_07_153225_create_contrats_table', 2),
	(8, '2024_03_10_182026_create_documents_table', 3);

-- Listage de la structure de table gestion_contrat. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.password_resets : ~0 rows (environ)

-- Listage de la structure de table gestion_contrat. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.personal_access_tokens : ~0 rows (environ)

-- Listage de la structure de table gestion_contrat. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion_contrat.users : ~5 rows (environ)
INSERT INTO `users` (`id`, `first_name`, `last_name`, `registration_number`, `phone`, `email`, `is_valid`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `is_admin`) VALUES
	(31, 'admin2', 'admin2', NULL, NULL, 'admin2@gmail.com', 1, NULL, '$2y$10$a0tu5wj3PTr0wBLAKjvEHOKelGS7cndOXZVdQHIaq0o3mgVttwBVq', NULL, '2024-03-20 21:00:11', '2024-03-20 21:15:07', NULL, 1),
	(32, 'admin1', 'rajaona', NULL, NULL, 'admin1@gmail.com', 1, NULL, '$2y$10$zc/oUZOw5M47n7NSubFMNe78wPO18OyO7/9E6eXFIM/JsPJc7rBrG', NULL, '2024-03-20 21:01:12', '2024-03-20 21:01:12', NULL, 1),
	(34, 'client1', 'client1', '123456', '+33344410934', 'client1@gmail.com', 1, NULL, '$2y$10$NDrPcQzbh5A6PPJutOxkUeWMW2zw0JhVs8FtsdCKdw2K/qfPauJ6u', NULL, '2024-03-20 21:10:29', '2024-03-20 21:10:49', NULL, 0),
	(35, 'dSDadadwdaw', 'wddwadwawd', '34235338783', '+3351515151515', 'zsdasfeafae@gmail.com', 1, NULL, '$2y$10$inYmpsTGZV0UYPr2Cb0IjueY6io5KlN6RZawtG0zBVQ0h71fnLWfa', NULL, '2024-03-20 21:13:51', '2024-03-20 21:14:27', '2024-03-20 21:14:27', 0),
	(36, 'admin3', 'admin3', NULL, NULL, 'admin3@gmail.com', 1, NULL, '$2y$10$osqdjB7w7GxrwojLIJ4zCehum4aMiCOv7Dixbvc7gJxB37u1r.1A6', NULL, '2024-03-20 21:15:32', '2024-03-20 21:15:32', NULL, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
