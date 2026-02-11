-- -------------------------------------------------------------
-- TablePlus 6.8.0(654)
--
-- https://tableplus.com/
--
-- Database: gl
-- Generation Time: 2026-02-11 3:45:25.9360 pm
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_preference` enum('PDF','CSV','EDI') COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_company_id_index` (`company_id`),
  CONSTRAINT `customers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `energy_consumptions`;
CREATE TABLE `energy_consumptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reading` decimal(8,2) NOT NULL,
  `loggedAgainst` timestamp NOT NULL,
  `site_id` bigint unsigned NOT NULL,
  `meter_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `energy_consumptions_customer_id_foreign` (`customer_id`),
  KEY `energy_consumptions_loggedagainst_index` (`loggedAgainst`),
  KEY `energy_consumptions_site_id_index` (`site_id`),
  KEY `energy_consumptions_meter_id_index` (`meter_id`),
  KEY `energy_consumptions_company_id_index` (`company_id`),
  CONSTRAINT `energy_consumptions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `energy_consumptions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `energy_consumptions_meter_id_foreign` FOREIGN KEY (`meter_id`) REFERENCES `meters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `energy_consumptions_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
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

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `meters`;
CREATE TABLE `meters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('gas','electric','solar','wind') COLLATE utf8mb4_unicode_ci NOT NULL,
  `meter_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `site_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meters_customer_id_foreign` (`customer_id`),
  KEY `meters_meter_id_index` (`meter_id`),
  KEY `meters_site_id_index` (`site_id`),
  KEY `meters_company_id_index` (`company_id`),
  CONSTRAINT `meters_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `meters_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `meters_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sites_customer_id_foreign` (`customer_id`),
  KEY `sites_name_index` (`name`),
  KEY `sites_company_id_index` (`company_id`),
  CONSTRAINT `sites_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sites_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `companies` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eldred ColeEnergy Ltd', 'lakin.ismael@example.com', '2026-02-11 14:04:49', '$2y$12$vL0uFN4ktyGlrDeARAjJ9uAykMCanvpZbBheyHOhfvS/G9colXBPe', 'Mb9fIlpKFN', '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(2, 'Marcella Pagac', 'fred@gmail.com', NULL, '$2y$12$/ZZuUMkAWjlYU297fZOMeuRBHgVDdqBcSN068q6F8Jw2my79dDUPi', NULL, '2026-02-11 14:05:10', '2026-02-11 14:05:10');

INSERT INTO `customers` (`id`, `name`, `contact_email`, `contact_phone`, `billing_preference`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'Bergnaum Group', 'stone30@example.net', '07123456789', 'PDF', 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(2, 'Simonis, Goldner and Schoen', 'kasey17@example.net', '07123456789', 'PDF', 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(3, 'Corkery, Erdman and Nitzsche', 'aturner@example.net', '07123456789', 'EDI', 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(4, 'Ryder', 'Trystan_Purdy65@gmail.com', '+447912345678', 'PDF', 2, '2026-02-11 14:05:33', '2026-02-11 14:05:33');

INSERT INTO `energy_consumptions` (`id`, `reading`, `loggedAgainst`, `site_id`, `meter_id`, `company_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 798.47, '2022-01-30 07:58:05', 1, 1, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(2, 4257.60, '2022-01-30 07:58:05', 1, 1, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(3, 4304.33, '2022-01-30 07:58:05', 1, 1, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(4, 1895.68, '2022-01-30 07:58:05', 1, 1, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(5, 3253.87, '2022-01-30 07:58:05', 1, 1, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(6, 3711.04, '1985-07-19 10:52:09', 2, 2, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(7, 592.30, '1985-07-19 10:52:09', 2, 2, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(8, 2223.34, '1985-07-19 10:52:09', 2, 2, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(9, 3405.35, '1985-07-19 10:52:09', 2, 2, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(10, 435.84, '1985-07-19 10:52:09', 2, 2, 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(11, 4364.96, '2005-07-20 02:33:07', 3, 3, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(12, 2304.05, '2005-07-20 02:33:07', 3, 3, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(13, 4411.94, '2005-07-20 02:33:07', 3, 3, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(14, 2489.40, '2005-07-20 02:33:07', 3, 3, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(15, 3481.05, '2005-07-20 02:33:07', 3, 3, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(16, 2761.65, '1981-04-20 14:19:09', 4, 4, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(17, 1427.08, '1981-04-20 14:19:09', 4, 4, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(18, 3484.67, '1981-04-20 14:19:09', 4, 4, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(19, 1470.45, '1981-04-20 14:19:09', 4, 4, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(20, 3433.26, '1981-04-20 14:19:09', 4, 4, 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(21, 2641.96, '2014-12-16 11:57:13', 5, 5, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(22, 2132.66, '2014-12-16 11:57:13', 5, 5, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(23, 4230.29, '2014-12-16 11:57:13', 5, 5, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(24, 1870.36, '2014-12-16 11:57:13', 5, 5, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(25, 1130.44, '2014-12-16 11:57:13', 5, 5, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(26, 4415.63, '2001-04-29 10:52:00', 6, 6, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(27, 4120.02, '2001-04-29 10:52:00', 6, 6, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(28, 1995.09, '2001-04-29 10:52:00', 6, 6, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(29, 3353.87, '2001-04-29 10:52:00', 6, 6, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(30, 2235.83, '2001-04-29 10:52:00', 6, 6, 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49');

INSERT INTO `meters` (`id`, `type`, `meter_id`, `created_at`, `updated_at`, `site_id`, `company_id`, `customer_id`) VALUES
(1, 'wind', 'MTR-22256', '2026-02-11 14:04:49', '2026-02-11 14:04:49', 1, 1, 1),
(2, 'solar', 'MTR-91879', '2026-02-11 14:04:49', '2026-02-11 14:04:49', 2, 1, 1),
(3, 'solar', 'MTR-31718', '2026-02-11 14:04:49', '2026-02-11 14:04:49', 3, 1, 2),
(4, 'solar', 'MTR-89533', '2026-02-11 14:04:49', '2026-02-11 14:04:49', 4, 1, 2),
(5, 'electric', 'MTR-03431', '2026-02-11 14:04:49', '2026-02-11 14:04:49', 5, 1, 3),
(6, 'electric', 'MTR-57138', '2026-02-11 14:04:49', '2026-02-11 14:04:49', 6, 1, 3),
(7, 'gas', 'MTR-30263', '2026-02-11 14:08:51', '2026-02-11 14:08:51', 2, 2, 1);

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_0000023_create_company_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_10_000000_create_customers_table', 1),
(5, '2026_02_10_005908_create_personal_access_tokens_table', 1),
(6, '2026_02_10_020616_create_sites_table', 1),
(7, '2026_02_10_020617_create_meters_table', 1),
(8, '2026_02_10_020627_create_energy_consumptions_table', 1);

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Company', 2, 'api-token', '3c898582d8a80e0edc7dd6da8720113cfab69992ef2de849a87b587c3402a425', '[\"*\"]', NULL, NULL, '2026-02-11 14:05:10', '2026-02-11 14:05:10'),
(2, 'App\\Models\\Company', 2, 'api-token', '480407819a6b4d3ee1479feb8a06176a20e4510560e2e6398a96378fc0e9e72d', '[\"*\"]', '2026-02-11 14:22:25', NULL, '2026-02-11 14:05:23', '2026-02-11 14:22:25');

INSERT INTO `sites` (`id`, `name`, `company_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'Site North Marilyne', 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(2, 'Site Shannyfort', 1, 1, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(3, 'Site Wiegandhaven', 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(4, 'Site Baumbachberg', 1, 2, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(5, 'Site Alysonberg', 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(6, 'Site North Johnpaul', 1, 3, '2026-02-11 14:04:49', '2026-02-11 14:04:49'),
(7, 'North Lucinda', 2, 2, '2026-02-11 14:08:02', '2026-02-11 14:08:02');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;