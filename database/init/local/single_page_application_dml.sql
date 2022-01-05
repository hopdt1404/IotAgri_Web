-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.25-0ubuntu0.20.10.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table single_page_application.agriculture_plants
CREATE TABLE IF NOT EXISTS `agriculture_plants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plant_id` bigint unsigned DEFAULT NULL,
  `plant_state_id` tinyint unsigned DEFAULT NULL,
  `FarmID` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `growth_period` mediumint unsigned DEFAULT NULL,
  `temperature` float DEFAULT NULL,
  `moisture` float DEFAULT NULL,
  `light` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.agriculture_plants: ~0 rows (approximately)
/*!40000 ALTER TABLE `agriculture_plants` DISABLE KEYS */;
/*!40000 ALTER TABLE `agriculture_plants` ENABLE KEYS */;

-- Dumping structure for table single_page_application.Controlling
CREATE TABLE IF NOT EXISTS `Controlling` (
  `ControllingID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `DeviceID` bigint unsigned DEFAULT '0',
  `PlotID` bigint unsigned DEFAULT '0',
  `AmountOfWater` double DEFAULT NULL,
  `WateringDuration` int DEFAULT NULL,
  `TimeOfControl` datetime DEFAULT NULL,
  PRIMARY KEY (`ControllingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.Controlling: ~0 rows (approximately)
/*!40000 ALTER TABLE `Controlling` DISABLE KEYS */;
/*!40000 ALTER TABLE `Controlling` ENABLE KEYS */;

-- Dumping structure for table single_page_application.cutivation_types
CREATE TABLE IF NOT EXISTS `cutivation_types` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `cutivation_type` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.cutivation_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `cutivation_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `cutivation_types` ENABLE KEYS */;

-- Dumping structure for table single_page_application.Devices
CREATE TABLE IF NOT EXISTS `Devices` (
  `DeviceID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `DeviceName` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DeviceTypeID` tinyint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `Status` tinyint DEFAULT NULL,
  `FarmID` bigint unsigned DEFAULT NULL,
  `PlotID` bigint unsigned DEFAULT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`DeviceID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.Devices: ~3 rows (approximately)
/*!40000 ALTER TABLE `Devices` DISABLE KEYS */;
REPLACE INTO `Devices` (`DeviceID`, `DeviceName`, `DeviceTypeID`, `user_id`, `Status`, `FarmID`, `PlotID`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
	(1, 'Sensor 423_JQ', 1, 1, 2, 1, NULL, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:41:23', '2021-07-25 08:57:37'),
	(2, 'Actuator 246_QGSV', 2, 1, 1, 1, NULL, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:42:56', '2021-07-25 08:57:37'),
	(3, 'Gateway 4218_HTE', 3, 1, -1, NULL, NULL, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:55:51', '2021-07-25 09:07:06');
/*!40000 ALTER TABLE `Devices` ENABLE KEYS */;

-- Dumping structure for table single_page_application.DeviceTypes
CREATE TABLE IF NOT EXISTS `DeviceTypes` (
  `DeviceTypeID` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `DeviceType` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`DeviceTypeID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.DeviceTypes: ~4 rows (approximately)
/*!40000 ALTER TABLE `DeviceTypes` DISABLE KEYS */;
REPLACE INTO `DeviceTypes` (`DeviceTypeID`, `DeviceType`, `name`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
	(1, 'Sensing', NULL, 'Admin', NULL, '2021-07-15 21:06:06', NULL),
	(2, 'Actuating', NULL, 'Admin', NULL, '2021-07-15 21:06:06', NULL),
	(3, 'Gateway', NULL, 'Admin', NULL, '2021-07-15 21:06:06', NULL),
	(4, 'Controlling', NULL, 'Admin', NULL, '2021-07-15 21:06:06', NULL);
/*!40000 ALTER TABLE `DeviceTypes` ENABLE KEYS */;

-- Dumping structure for table single_page_application.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table single_page_application.Farms
CREATE TABLE IF NOT EXISTS `Farms` (
  `FarmID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `LocateID` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Area` double(10,2) unsigned DEFAULT NULL,
  `FarmTypeID` tinyint unsigned DEFAULT NULL,
  `Status` smallint unsigned NOT NULL DEFAULT '0',
  `info` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `UserID` bigint unsigned NOT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`FarmID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.Farms: ~2 rows (approximately)
/*!40000 ALTER TABLE `Farms` DISABLE KEYS */;
REPLACE INTO `Farms` (`FarmID`, `LocateID`, `name`, `Area`, `FarmTypeID`, `Status`, `info`, `UserID`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'OVi coffee', 300.00, 3, 0, 'Farmstay ở Đà Lạt', 1, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:32:03', '2021-07-25 09:22:06'),
	(2, NULL, 'Dalat Milk Farm', 500.00, 5, 0, 'Farmstay ở Đà Lạt - temp', 1, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:33:15', '2021-07-25 09:23:34');
/*!40000 ALTER TABLE `Farms` ENABLE KEYS */;

-- Dumping structure for table single_page_application.FarmTypes
CREATE TABLE IF NOT EXISTS `FarmTypes` (
  `FarmTypeID` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `FarmType` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`FarmTypeID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.FarmTypes: ~10 rows (approximately)
/*!40000 ALTER TABLE `FarmTypes` DISABLE KEYS */;
REPLACE INTO `FarmTypes` (`FarmTypeID`, `FarmType`, `name`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
	(1, 'Arable Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL),
	(2, 'Pastoral Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL),
	(3, 'Mixed Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL),
	(4, 'Subsistence Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL),
	(5, 'Commercial Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL),
	(6, 'Extensive and Intensive Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL),
	(7, 'Nomadic Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL),
	(8, 'Nomadic Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL),
	(9, 'Poultry Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL),
	(10, 'Fish Farming', NULL, 'Admin', NULL, '2021-07-14 22:54:18', NULL);
/*!40000 ALTER TABLE `FarmTypes` ENABLE KEYS */;

-- Dumping structure for table single_page_application.farm_plants
CREATE TABLE IF NOT EXISTS `farm_plants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `FarmID` bigint unsigned DEFAULT NULL,
  `plant_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.farm_plants: ~2 rows (approximately)
/*!40000 ALTER TABLE `farm_plants` DISABLE KEYS */;
REPLACE INTO `farm_plants` (`id`, `FarmID`, `plant_id`, `user_id`, `created_at`, `created_user`, `updated_user`, `updated_at`) VALUES
	(1, 1, 2, 1, '2021-07-25 08:57:29', 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:57:37'),
	(2, 1, 1, 1, '2021-07-25 08:57:37', 'hopdt1404@gmail.com', NULL, NULL);
/*!40000 ALTER TABLE `farm_plants` ENABLE KEYS */;

-- Dumping structure for table single_page_application.Locates
CREATE TABLE IF NOT EXISTS `Locates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `LocateID` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `LocateName` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `locate` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.Locates: ~0 rows (approximately)
/*!40000 ALTER TABLE `Locates` DISABLE KEYS */;
/*!40000 ALTER TABLE `Locates` ENABLE KEYS */;

-- Dumping structure for table single_page_application.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2017_12_07_122845_create_oauth_providers_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table single_page_application.mst_display
CREATE TABLE IF NOT EXISTS `mst_display` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `display_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint unsigned NOT NULL COMMENT '0: Admin, 1: Farmer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.mst_display: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_display` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_display` ENABLE KEYS */;

-- Dumping structure for table single_page_application.mst_operation_info
CREATE TABLE IF NOT EXISTS `mst_operation_info` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `info` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint unsigned NOT NULL COMMENT '0: Admin, 1: Farmer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.mst_operation_info: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_operation_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_operation_info` ENABLE KEYS */;

-- Dumping structure for table single_page_application.oauth_providers
CREATE TABLE IF NOT EXISTS `oauth_providers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refresh_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_providers_user_id_foreign` (`user_id`),
  KEY `oauth_providers_provider_user_id_index` (`provider_user_id`),
  CONSTRAINT `oauth_providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.oauth_providers: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_providers` ENABLE KEYS */;

-- Dumping structure for table single_page_application.operation_history
CREATE TABLE IF NOT EXISTS `operation_history` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `auth_flg` tinyint(1) NOT NULL COMMENT '0: Admin, 1: Farmer',
  `user_id` bigint unsigned NOT NULL,
  `mst_display_id` bigint NOT NULL,
  `mst_operation_id` bigint NOT NULL,
  `result` int NOT NULL COMMENT '0: Success, 1: Error',
  `detail_info` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Detail info history',
  `ip_address` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'IP addess host',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.operation_history: ~0 rows (approximately)
/*!40000 ALTER TABLE `operation_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `operation_history` ENABLE KEYS */;

-- Dumping structure for table single_page_application.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table single_page_application.plants
CREATE TABLE IF NOT EXISTS `plants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cultivars` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'giong cay trong',
  `plant_type_id` smallint DEFAULT NULL,
  `growth_period` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Thoi gian sinh truong',
  `planting_time` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'thoi gian gieo trong',
  `plant_density` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'mat do cay trong',
  `width_bed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Do rong hang',
  `height_bed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'do cao cua hang',
  `row_spacing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'khoa cach giua cac hang',
  `tree_spacing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'khoang cach giua cac cay',
  `soil_type_id` tinyint unsigned DEFAULT NULL COMMENT 'Dat canh tac',
  `info` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Thong tin khac',
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.plants: ~2 rows (approximately)
/*!40000 ALTER TABLE `plants` DISABLE KEYS */;
REPLACE INTO `plants` (`id`, `name`, `cultivars`, `plant_type_id`, `growth_period`, `planting_time`, `plant_density`, `width_bed`, `height_bed`, `row_spacing`, `tree_spacing`, `soil_type_id`, `info`, `created_at`, `created_user`, `updated_user`, `updated_at`) VALUES
	(1, 'Maize', 'Cereal grain', 5, '70 - 90 days', 'Thời gian gieo trồng', NULL, '20 - 25 cm', '10 - 15cm', '25 - 30 cm', '20 - 25 cm', 5, 'Maize: Cây ngô', '2021-07-16 09:24:14', 'hopdt1404', 'hopdt1404@gmail.com', '2021-07-25 08:46:09'),
	(2, 'Potato', 'Solanum tuberosum', 6, '50 - 60 days', 'Thời gian gieo trồng', NULL, '110 – 120cm', '30cm', '80cm', '40cm- 60cm', 4, 'Potato: cây khoai tây', '2021-07-16 10:05:05', 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 09:00:57');
/*!40000 ALTER TABLE `plants` ENABLE KEYS */;

-- Dumping structure for table single_page_application.plant_info
CREATE TABLE IF NOT EXISTS `plant_info` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cultivationtr` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'canh tac',
  `growth_period` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'thoi gain sinh truong',
  `haverst_period` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ky thu hoach',
  `start_crop` int DEFAULT NULL COMMENT 'bat dau mua vu',
  `end_crop` int DEFAULT NULL COMMENT 'thoi gian ket thuc',
  `width_bed` double(8,2) DEFAULT NULL COMMENT 'do rong luong',
  `height_bed` double(8,2) DEFAULT NULL COMMENT 'chieu cao luong',
  `plant_density` double(8,2) DEFAULT NULL COMMENT 'mat do',
  `row_spacing` double(8,2) DEFAULT NULL COMMENT 'khoang cah giua hang',
  `tree_spacing` double(8,2) DEFAULT NULL COMMENT 'khoang cach giua cay',
  `plant_soil` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cultivar` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.plant_info: ~0 rows (approximately)
/*!40000 ALTER TABLE `plant_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `plant_info` ENABLE KEYS */;

-- Dumping structure for table single_page_application.plant_light_types
CREATE TABLE IF NOT EXISTS `plant_light_types` (
  `id` int NOT NULL,
  `plant_light` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Anh sang cay trong',
  `lowest` double(8,2) DEFAULT NULL,
  `highest` double(8,2) DEFAULT NULL,
  `plant_light_typescol` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.plant_light_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `plant_light_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `plant_light_types` ENABLE KEYS */;

-- Dumping structure for table single_page_application.plant_states
CREATE TABLE IF NOT EXISTS `plant_states` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `note` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.plant_states: ~6 rows (approximately)
/*!40000 ALTER TABLE `plant_states` DISABLE KEYS */;
REPLACE INTO `plant_states` (`id`, `name`, `note`, `created_user`, `created_at`, `updated_user`, `updated_at`) VALUES
	(1, 'Sprout', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(2, 'Seedling', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(3, 'Vegetative', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(4, 'Budding', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(5, 'Flowering', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(6, 'Ripening', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL);
/*!40000 ALTER TABLE `plant_states` ENABLE KEYS */;

-- Dumping structure for table single_page_application.plant_state_infos
CREATE TABLE IF NOT EXISTS `plant_state_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plant_state_id` tinyint unsigned NOT NULL,
  `plant_id` bigint unsigned NOT NULL,
  `growth_period_state` mediumint unsigned DEFAULT NULL COMMENT 'thoi gian sinh truong cua trang thai',
  `temperature` float DEFAULT NULL COMMENT 'Nhiet do',
  `moisture` float DEFAULT NULL COMMENT 'do am',
  `light` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'cuong do anh sang',
  `note` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.plant_state_infos: ~6 rows (approximately)
/*!40000 ALTER TABLE `plant_state_infos` DISABLE KEYS */;
REPLACE INTO `plant_state_infos` (`id`, `plant_state_id`, `plant_id`, `growth_period_state`, `temperature`, `moisture`, `light`, `note`, `created_at`, `created_user`, `updated_user`, `updated_at`) VALUES
	(1, 1, 2, 8, 27, 65, NULL, 'Hạt', '2021-07-25 08:47:07', 'hopdt1404@gmail.com', NULL, NULL),
	(2, 2, 2, 13, 28, 65, '423 (h)', 'Seedling state', '2021-07-25 08:47:54', 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:48:32'),
	(3, 3, 2, 15, 28.5, 70, NULL, 'Vegetative', '2021-07-25 08:52:01', 'hopdt1404@gmail.com', NULL, NULL),
	(4, 4, 2, 17, 30, 63, NULL, 'Budding', '2021-07-25 08:52:55', 'hopdt1404@gmail.com', NULL, NULL),
	(5, 5, 2, 14, 32, 60, NULL, 'Flowering', '2021-07-25 08:53:24', 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:54:11'),
	(6, 6, 2, 10, 27, 55, NULL, 'Ripening', '2021-07-25 08:54:41', 'hopdt1404@gmail.com', NULL, NULL);
/*!40000 ALTER TABLE `plant_state_infos` ENABLE KEYS */;

-- Dumping structure for table single_page_application.plant_types
CREATE TABLE IF NOT EXISTS `plant_types` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.plant_types: ~17 rows (approximately)
/*!40000 ALTER TABLE `plant_types` DISABLE KEYS */;
REPLACE INTO `plant_types` (`id`, `name`, `created_user`, `created_at`, `updated_user`, `updated_at`) VALUES
	(1, 'Annuals', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(2, 'Bulbs', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(3, 'Cactus - Succulents', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(4, 'Climbers', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(5, 'Conifers', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(6, 'Ferns', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(7, 'Fruit', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(8, 'Herbs', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(9, 'Ornamental Grasses', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(10, 'Perennials', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(11, 'Roses', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(12, 'Shrubs', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(13, 'Trees', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(14, 'Palms - Cycads', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(15, 'Bamboos', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(16, 'Aquatic Plants', 'Admin', '2021-07-16 10:49:34', NULL, NULL),
	(17, 'Orchids', 'Admin', '2021-07-16 10:49:34', NULL, NULL);
/*!40000 ALTER TABLE `plant_types` ENABLE KEYS */;

-- Dumping structure for table single_page_application.Plots
CREATE TABLE IF NOT EXISTS `Plots` (
  `PlotID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Area` double(8,2) unsigned DEFAULT NULL,
  `PlotTypeID` tinyint unsigned DEFAULT NULL,
  `FarmID` bigint unsigned DEFAULT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`PlotID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.Plots: ~0 rows (approximately)
/*!40000 ALTER TABLE `Plots` DISABLE KEYS */;
/*!40000 ALTER TABLE `Plots` ENABLE KEYS */;

-- Dumping structure for table single_page_application.PlotTypes
CREATE TABLE IF NOT EXISTS `PlotTypes` (
  `PlotTypeID` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `PlotType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`PlotTypeID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.PlotTypes: ~0 rows (approximately)
/*!40000 ALTER TABLE `PlotTypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `PlotTypes` ENABLE KEYS */;

-- Dumping structure for table single_page_application.Sensing
CREATE TABLE IF NOT EXISTS `Sensing` (
  `SensingID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `DeviceID` bigint unsigned DEFAULT NULL,
  `PlotID` bigint unsigned DEFAULT NULL,
  `SoilMoisture` float unsigned DEFAULT NULL,
  `Humidity` float unsigned DEFAULT NULL,
  `Temperature` float unsigned DEFAULT NULL,
  `LightLevel` smallint unsigned DEFAULT NULL,
  `TimeOfMeasurement` datetime DEFAULT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`SensingID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.Sensing: ~0 rows (approximately)
/*!40000 ALTER TABLE `Sensing` DISABLE KEYS */;
/*!40000 ALTER TABLE `Sensing` ENABLE KEYS */;

-- Dumping structure for table single_page_application.sensor_detail
CREATE TABLE IF NOT EXISTS `sensor_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sensor_id` bigint unsigned DEFAULT NULL,
  `soil_moisture` double(8,2) DEFAULT NULL,
  `humidity` double(8,2) DEFAULT NULL,
  `temperature` double(8,2) DEFAULT NULL,
  `light_level` smallint unsigned DEFAULT NULL,
  `time_of_measurement` datetime DEFAULT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.sensor_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `sensor_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `sensor_detail` ENABLE KEYS */;

-- Dumping structure for table single_page_application.soil_types
CREATE TABLE IF NOT EXISTS `soil_types` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.soil_types: ~6 rows (approximately)
/*!40000 ALTER TABLE `soil_types` DISABLE KEYS */;
REPLACE INTO `soil_types` (`id`, `name`, `info`, `created_at`, `created_user`, `updated_user`, `updated_at`) VALUES
	(1, 'Sandy soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(2, 'Clay Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(3, 'Silt Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(4, 'Peat Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(5, 'Chalk Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(6, 'Loam Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL);
/*!40000 ALTER TABLE `soil_types` ENABLE KEYS */;

-- Dumping structure for table single_page_application.stage_types
CREATE TABLE IF NOT EXISTS `stage_types` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.stage_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `stage_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_types` ENABLE KEYS */;

-- Dumping structure for table single_page_application.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'hopdt1404', 'hopdt1404@gmail.com', NULL, '$2y$10$Gyrelylnps2oW/bBvh68U.uBRaxhGp15rhH9OXBOWryzE2NHDWJJS', 'VoRmU1kbveuQuVWQYdgOaDO9PyaPFuGr6DIe1FRVsmg2aS42Duvr2USJ663k', '2021-07-11 22:50:35', '2021-07-11 22:50:35'),
	(2, 'vnu student', '17021389@vnu.edu.vn', NULL, '$2y$10$UlrUiRslY6dplDVcFXt6feK20.uh7p2SLWxUZyVCvaz4/f0a3ije.', NULL, '2021-07-25 00:11:32', '2021-07-25 00:11:32'),
	(3, 'thjenhop99', 'thjenhop99@gmail.com', NULL, '$2y$10$XVz8PeK0BmN1RNIgT31FduEAp0wAOY1A/kD2O2dqJNiQY1aWuEmsq', NULL, '2021-07-25 09:28:01', '2021-07-25 09:28:01'),
	(4, '17021388', '17021388@vnu.edu.vn', NULL, '$2y$10$U.cUP4Rhj4JXv/m1uaiYxeQ2wSh8TZty6GIY914FFHLTEemkSKxHW', NULL, '2021-07-25 09:29:55', '2021-07-25 09:29:55'),
	(5, '17021387', '17021387@vnu.edu.vn', NULL, '$2y$10$Fvh0s3Ewhv1yrh0B.yEHFey52PE0AkfwVHnnlVa78MabpbYK67Jam', NULL, '2021-07-25 09:32:21', '2021-07-25 09:32:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table single_page_application.Users
CREATE TABLE IF NOT EXISTS `Users` (
  `UserID` bigint unsigned DEFAULT NULL,
  `UserName` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UPassword` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.Users: ~0 rows (approximately)
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;

-- Dumping structure for table single_page_application.user_types
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.user_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;

-- Dumping structure for table single_page_application.WeatherForecastAtATimes
CREATE TABLE IF NOT EXISTS `WeatherForecastAtATimes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `WeatherForecastID` bigint unsigned NOT NULL,
  `ForecastTime` timestamp NOT NULL,
  `EpochTime` bigint unsigned DEFAULT NULL,
  `ForecastStatus` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsDayLight` tinyint unsigned DEFAULT NULL,
  `Temperature` double(8,2) DEFAULT NULL,
  `WindSpeed` double(8,2) DEFAULT NULL,
  `RelativeHumidity` double(8,2) DEFAULT NULL,
  `RainProbability` double(4,1) DEFAULT NULL,
  `PrecipitationProbability` double(4,1) DEFAULT NULL,
  `RainValue` double(8,2) unsigned DEFAULT NULL,
  `CloudCover` smallint unsigned DEFAULT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.WeatherForecastAtATimes: ~0 rows (approximately)
/*!40000 ALTER TABLE `WeatherForecastAtATimes` DISABLE KEYS */;
/*!40000 ALTER TABLE `WeatherForecastAtATimes` ENABLE KEYS */;

-- Dumping structure for table single_page_application.WeatherForecasts
CREATE TABLE IF NOT EXISTS `WeatherForecasts` (
  `WeatherForecastID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `LocateID` bigint unsigned DEFAULT NULL,
  `CurrentTime` timestamp NOT NULL,
  `created_at` datetime NOT NULL,
  `created_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`WeatherForecastID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table single_page_application.WeatherForecasts: ~0 rows (approximately)
/*!40000 ALTER TABLE `WeatherForecasts` DISABLE KEYS */;
/*!40000 ALTER TABLE `WeatherForecasts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
