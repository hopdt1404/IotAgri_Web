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

-- Dumping data for table single_page_application.agriculture_plants: ~0 rows (approximately)
/*!40000 ALTER TABLE `agriculture_plants` DISABLE KEYS */;
/*!40000 ALTER TABLE `agriculture_plants` ENABLE KEYS */;

-- Dumping data for table single_page_application.Controlling: ~0 rows (approximately)
/*!40000 ALTER TABLE `Controlling` DISABLE KEYS */;
/*!40000 ALTER TABLE `Controlling` ENABLE KEYS */;

-- Dumping data for table single_page_application.cutivation_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `cutivation_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `cutivation_types` ENABLE KEYS */;

-- Dumping data for table single_page_application.Devices: ~3 rows (approximately)
/*!40000 ALTER TABLE `Devices` DISABLE KEYS */;
INSERT INTO `Devices` (`DeviceID`, `DeviceName`, `DeviceTypeID`, `user_id`, `Status`, `FarmID`, `PlotID`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
	(1, 'Sensor 423_JQ', 1, 1, 2, 1, NULL, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:41:23', '2021-07-25 08:57:37'),
	(2, 'Actuator 246_QGSV', 2, 1, 1, 1, NULL, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:42:56', '2021-07-25 08:57:37'),
	(3, 'Gateway 4218_HTE', 3, 1, -1, NULL, NULL, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:55:51', '2021-07-25 09:07:06');
/*!40000 ALTER TABLE `Devices` ENABLE KEYS */;

-- Dumping data for table single_page_application.DeviceTypes: ~4 rows (approximately)
/*!40000 ALTER TABLE `DeviceTypes` DISABLE KEYS */;
INSERT INTO `DeviceTypes` (`DeviceTypeID`, `DeviceType`, `name`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
	(1, 'Sensing', NULL, 'Admin', NULL, '2021-07-15 21:06:06', NULL),
	(2, 'Actuating', NULL, 'Admin', NULL, '2021-07-15 21:06:06', NULL),
	(3, 'Gateway', NULL, 'Admin', NULL, '2021-07-15 21:06:06', NULL),
	(4, 'Controlling', NULL, 'Admin', NULL, '2021-07-15 21:06:06', NULL);
/*!40000 ALTER TABLE `DeviceTypes` ENABLE KEYS */;

-- Dumping data for table single_page_application.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping data for table single_page_application.Farms: ~2 rows (approximately)
/*!40000 ALTER TABLE `Farms` DISABLE KEYS */;
INSERT INTO `Farms` (`FarmID`, `LocateID`, `name`, `Area`, `FarmTypeID`, `Status`, `info`, `UserID`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'OVi coffee', 300.00, 3, 0, 'Farmstay ở Đà Lạt', 1, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:32:03', '2021-07-25 09:22:06'),
	(2, NULL, 'Dalat Milk Farm', 500.00, 5, 0, 'Farmstay ở Đà Lạt - temp', 1, 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:33:15', '2021-07-25 09:23:34');
/*!40000 ALTER TABLE `Farms` ENABLE KEYS */;

-- Dumping data for table single_page_application.FarmTypes: ~10 rows (approximately)
/*!40000 ALTER TABLE `FarmTypes` DISABLE KEYS */;
INSERT INTO `FarmTypes` (`FarmTypeID`, `FarmType`, `name`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
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

-- Dumping data for table single_page_application.farm_plants: ~2 rows (approximately)
/*!40000 ALTER TABLE `farm_plants` DISABLE KEYS */;
INSERT INTO `farm_plants` (`id`, `FarmID`, `plant_id`, `user_id`, `created_at`, `created_user`, `updated_user`, `updated_at`) VALUES
	(1, 1, 2, 1, '2021-07-25 08:57:29', 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:57:37'),
	(2, 1, 1, 1, '2021-07-25 08:57:37', 'hopdt1404@gmail.com', NULL, NULL);
/*!40000 ALTER TABLE `farm_plants` ENABLE KEYS */;

-- Dumping data for table single_page_application.Locates: ~0 rows (approximately)
/*!40000 ALTER TABLE `Locates` DISABLE KEYS */;
/*!40000 ALTER TABLE `Locates` ENABLE KEYS */;

-- Dumping data for table single_page_application.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2017_12_07_122845_create_oauth_providers_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping data for table single_page_application.mst_display: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_display` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_display` ENABLE KEYS */;

-- Dumping data for table single_page_application.mst_operation_info: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_operation_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_operation_info` ENABLE KEYS */;

-- Dumping data for table single_page_application.oauth_providers: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_providers` ENABLE KEYS */;

-- Dumping data for table single_page_application.operation_history: ~0 rows (approximately)
/*!40000 ALTER TABLE `operation_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `operation_history` ENABLE KEYS */;

-- Dumping data for table single_page_application.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping data for table single_page_application.plants: ~2 rows (approximately)
/*!40000 ALTER TABLE `plants` DISABLE KEYS */;
INSERT INTO `plants` (`id`, `name`, `cultivars`, `plant_type_id`, `growth_period`, `planting_time`, `plant_density`, `width_bed`, `height_bed`, `row_spacing`, `tree_spacing`, `soil_type_id`, `info`, `created_at`, `created_user`, `updated_user`, `updated_at`) VALUES
	(1, 'Maize', 'Cereal grain', 5, '70 - 90 days', 'Thời gian gieo trồng', NULL, '20 - 25 cm', '10 - 15cm', '25 - 30 cm', '20 - 25 cm', 5, 'Maize: Cây ngô', '2021-07-16 09:24:14', 'hopdt1404', 'hopdt1404@gmail.com', '2021-07-25 08:46:09'),
	(2, 'Potato', 'Solanum tuberosum', 6, '50 - 60 days', 'Thời gian gieo trồng', NULL, '110 – 120cm', '30cm', '80cm', '40cm- 60cm', 4, 'Potato: cây khoai tây', '2021-07-16 10:05:05', 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 09:00:57');
/*!40000 ALTER TABLE `plants` ENABLE KEYS */;

-- Dumping data for table single_page_application.plant_info: ~0 rows (approximately)
/*!40000 ALTER TABLE `plant_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `plant_info` ENABLE KEYS */;

-- Dumping data for table single_page_application.plant_light_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `plant_light_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `plant_light_types` ENABLE KEYS */;

-- Dumping data for table single_page_application.plant_states: ~6 rows (approximately)
/*!40000 ALTER TABLE `plant_states` DISABLE KEYS */;
INSERT INTO `plant_states` (`id`, `name`, `note`, `created_user`, `created_at`, `updated_user`, `updated_at`) VALUES
	(1, 'Sprout', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(2, 'Seedling', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(3, 'Vegetative', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(4, 'Budding', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(5, 'Flowering', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL),
	(6, 'Ripening', 'https://www.saferbrand.com/articles/plant-growth-stages', 'Admin', '2021-07-17 09:52:33', NULL, NULL);
/*!40000 ALTER TABLE `plant_states` ENABLE KEYS */;

-- Dumping data for table single_page_application.plant_state_infos: ~6 rows (approximately)
/*!40000 ALTER TABLE `plant_state_infos` DISABLE KEYS */;
INSERT INTO `plant_state_infos` (`id`, `plant_state_id`, `plant_id`, `growth_period_state`, `temperature`, `moisture`, `light`, `note`, `created_at`, `created_user`, `updated_user`, `updated_at`) VALUES
	(1, 1, 2, 8, 27, 65, NULL, 'Hạt', '2021-07-25 08:47:07', 'hopdt1404@gmail.com', NULL, NULL),
	(2, 2, 2, 13, 28, 65, '423 (h)', 'Seedling state', '2021-07-25 08:47:54', 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:48:32'),
	(3, 3, 2, 15, 28.5, 70, NULL, 'Vegetative', '2021-07-25 08:52:01', 'hopdt1404@gmail.com', NULL, NULL),
	(4, 4, 2, 17, 30, 63, NULL, 'Budding', '2021-07-25 08:52:55', 'hopdt1404@gmail.com', NULL, NULL),
	(5, 5, 2, 14, 32, 60, NULL, 'Flowering', '2021-07-25 08:53:24', 'hopdt1404@gmail.com', 'hopdt1404@gmail.com', '2021-07-25 08:54:11'),
	(6, 6, 2, 10, 27, 55, NULL, 'Ripening', '2021-07-25 08:54:41', 'hopdt1404@gmail.com', NULL, NULL);
/*!40000 ALTER TABLE `plant_state_infos` ENABLE KEYS */;

-- Dumping data for table single_page_application.plant_types: ~17 rows (approximately)
/*!40000 ALTER TABLE `plant_types` DISABLE KEYS */;
INSERT INTO `plant_types` (`id`, `name`, `created_user`, `created_at`, `updated_user`, `updated_at`) VALUES
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

-- Dumping data for table single_page_application.Plots: ~0 rows (approximately)
/*!40000 ALTER TABLE `Plots` DISABLE KEYS */;
/*!40000 ALTER TABLE `Plots` ENABLE KEYS */;

-- Dumping data for table single_page_application.PlotTypes: ~0 rows (approximately)
/*!40000 ALTER TABLE `PlotTypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `PlotTypes` ENABLE KEYS */;

-- Dumping data for table single_page_application.Sensing: ~0 rows (approximately)
/*!40000 ALTER TABLE `Sensing` DISABLE KEYS */;
/*!40000 ALTER TABLE `Sensing` ENABLE KEYS */;

-- Dumping data for table single_page_application.sensor_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `sensor_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `sensor_detail` ENABLE KEYS */;

-- Dumping data for table single_page_application.soil_types: ~6 rows (approximately)
/*!40000 ALTER TABLE `soil_types` DISABLE KEYS */;
INSERT INTO `soil_types` (`id`, `name`, `info`, `created_at`, `created_user`, `updated_user`, `updated_at`) VALUES
	(1, 'Sandy soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(2, 'Clay Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(3, 'Silt Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(4, 'Peat Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(5, 'Chalk Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL),
	(6, 'Loam Soil', 'https://www.boughton.co.uk/products/topsoils/soil-types/', '2021-07-16 21:29:53', 'Admin', NULL, NULL);
/*!40000 ALTER TABLE `soil_types` ENABLE KEYS */;

-- Dumping data for table single_page_application.stage_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `stage_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_types` ENABLE KEYS */;

-- Dumping data for table single_page_application.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'hopdt1404', 'hopdt1404@gmail.com', NULL, '$2y$10$Gyrelylnps2oW/bBvh68U.uBRaxhGp15rhH9OXBOWryzE2NHDWJJS', 'VoRmU1kbveuQuVWQYdgOaDO9PyaPFuGr6DIe1FRVsmg2aS42Duvr2USJ663k', '2021-07-11 22:50:35', '2021-07-11 22:50:35'),
	(2, 'vnu student', '17021389@vnu.edu.vn', NULL, '$2y$10$UlrUiRslY6dplDVcFXt6feK20.uh7p2SLWxUZyVCvaz4/f0a3ije.', NULL, '2021-07-25 00:11:32', '2021-07-25 00:11:32'),
	(3, 'thjenhop99', 'thjenhop99@gmail.com', NULL, '$2y$10$XVz8PeK0BmN1RNIgT31FduEAp0wAOY1A/kD2O2dqJNiQY1aWuEmsq', NULL, '2021-07-25 09:28:01', '2021-07-25 09:28:01'),
	(4, '17021388', '17021388@vnu.edu.vn', NULL, '$2y$10$U.cUP4Rhj4JXv/m1uaiYxeQ2wSh8TZty6GIY914FFHLTEemkSKxHW', NULL, '2021-07-25 09:29:55', '2021-07-25 09:29:55'),
	(5, '17021387', '17021387@vnu.edu.vn', NULL, '$2y$10$Fvh0s3Ewhv1yrh0B.yEHFey52PE0AkfwVHnnlVa78MabpbYK67Jam', NULL, '2021-07-25 09:32:21', '2021-07-25 09:32:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping data for table single_page_application.Users: ~0 rows (approximately)
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;

-- Dumping data for table single_page_application.user_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;

-- Dumping data for table single_page_application.WeatherForecastAtATimes: ~0 rows (approximately)
/*!40000 ALTER TABLE `WeatherForecastAtATimes` DISABLE KEYS */;
/*!40000 ALTER TABLE `WeatherForecastAtATimes` ENABLE KEYS */;

-- Dumping data for table single_page_application.WeatherForecasts: ~0 rows (approximately)
/*!40000 ALTER TABLE `WeatherForecasts` DISABLE KEYS */;
/*!40000 ALTER TABLE `WeatherForecasts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
