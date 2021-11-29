-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.27-0ubuntu0.21.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table IoT_Agri.plant_state_infos: ~28 rows (approximately)
/*!40000 ALTER TABLE `plant_state_infos` DISABLE KEYS */;
REPLACE INTO `plant_state_infos` (`id`, `plant_state_id`, `plant_id`, `growth_period_state`, `temperature`, `moisture`, `light`, `note`, `created_at`, `created_user`, `updated_at`, `updated_user`) VALUES
	(1, 1, 1, 15, 29.00, 65.00, NULL, NULL, '2021-08-07 06:37:11', 'hopdt1404@gmail.com', '2021-11-02 22:50:44', 'hopdt1404@gmail.com'),
	(2, 2, 1, 15, 29.00, 65.00, NULL, NULL, '2021-08-07 06:37:36', 'hopdt1404@gmail.com', '2021-11-02 22:52:21', 'hopdt1404@gmail.com'),
	(3, 3, 1, 15, 30.00, 65.00, NULL, NULL, '2021-08-07 06:38:03', 'hopdt1404@gmail.com', '2021-11-02 22:53:14', 'hopdt1404@gmail.com'),
	(4, 4, 1, 10, 31.00, 68.00, '400', NULL, '2021-08-07 06:38:30', 'hopdt1404@gmail.com', NULL, NULL),
	(5, 5, 1, 30, 26.00, 70.00, NULL, NULL, '2021-08-07 06:39:09', 'hopdt1404@gmail.com', '2021-11-02 22:52:58', 'hopdt1404@gmail.com'),
	(6, 6, 1, 20, 30.00, 60.00, NULL, NULL, '2021-08-07 06:39:37', 'hopdt1404@gmail.com', '2021-11-02 22:50:30', 'hopdt1404@gmail.com'),
	(7, 1, 5, 10, 25.00, 60.00, NULL, NULL, '2021-11-01 20:19:00', 'hopdt1404@gmail.com', '2021-11-02 22:27:10', 'hopdt1404@gmail.com'),
	(8, 6, 5, 15, 30.00, 70.00, NULL, NULL, '2021-11-02 22:28:29', 'hopdt1404@gmail.com', NULL, NULL),
	(9, 2, 5, 15, 27.00, 68.00, NULL, NULL, '2021-11-02 22:29:09', 'hopdt1404@gmail.com', NULL, NULL),
	(10, 3, 5, 15, 28.00, 70.00, NULL, NULL, '2021-11-02 22:29:56', 'hopdt1404@gmail.com', NULL, NULL),
	(11, 4, 5, 20, 29.00, 70.00, NULL, NULL, '2021-11-02 22:30:35', 'hopdt1404@gmail.com', NULL, NULL),
	(12, 5, 5, 30, 28.00, 70.00, NULL, NULL, '2021-11-02 22:31:05', 'hopdt1404@gmail.com', NULL, NULL),
	(13, 6, 4, 20, 30.00, 60.00, NULL, NULL, '2021-11-02 22:32:57', 'hopdt1404@gmail.com', NULL, NULL),
	(14, 1, 4, 10, 28.00, 70.00, NULL, NULL, '2021-11-02 22:33:25', 'hopdt1404@gmail.com', NULL, NULL),
	(15, 2, 4, 15, 27.00, 65.00, NULL, NULL, '2021-11-02 22:34:01', 'hopdt1404@gmail.com', NULL, NULL),
	(16, 3, 4, 20, 29.00, 70.00, NULL, NULL, '2021-11-02 22:34:44', 'hopdt1404@gmail.com', NULL, NULL),
	(17, 4, 4, 25, 29.00, 70.00, NULL, NULL, '2021-11-02 22:35:33', 'hopdt1404@gmail.com', NULL, NULL),
	(18, 5, 4, 45, 30.00, 70.00, NULL, NULL, '2021-11-02 22:36:08', 'hopdt1404@gmail.com', NULL, NULL),
	(19, 1, 2, 10, 28.00, 65.00, NULL, NULL, '2021-11-02 22:37:21', 'hopdt1404@gmail.com', NULL, NULL),
	(20, 2, 2, 15, 28.00, 70.00, NULL, NULL, '2021-11-02 22:37:48', 'hopdt1404@gmail.com', '2021-11-02 22:41:01', 'hopdt1404@gmail.com'),
	(21, 6, 2, 10, 30.00, 75.00, NULL, NULL, '2021-11-02 22:38:13', 'hopdt1404@gmail.com', '2021-11-02 22:40:42', 'hopdt1404@gmail.com'),
	(22, 3, 2, 15, 29.00, 70.00, NULL, NULL, '2021-11-02 22:38:51', 'hopdt1404@gmail.com', '2021-11-02 22:41:37', 'hopdt1404@gmail.com'),
	(23, 4, 2, 10, 28.00, 70.00, NULL, NULL, '2021-11-02 22:39:11', 'hopdt1404@gmail.com', '2021-11-02 22:41:47', 'hopdt1404@gmail.com'),
	(24, 5, 2, 25, 28.00, 75.00, NULL, NULL, '2021-11-02 22:39:42', 'hopdt1404@gmail.com', '2021-11-02 22:43:05', 'hopdt1404@gmail.com'),
	(25, 1, 3, 15, 26.00, 60.00, NULL, NULL, '2021-11-10 21:49:54', 'admin@gmail.com', NULL, NULL),
	(26, 2, 3, 15, 28.00, 65.00, NULL, NULL, '2021-11-10 21:50:12', 'admin@gmail.com', NULL, NULL),
	(27, 3, 3, 20, 28.00, 65.00, NULL, NULL, '2021-11-10 21:50:27', 'admin@gmail.com', NULL, NULL),
	(28, 4, 3, 25, 27.00, 65.00, NULL, NULL, '2021-11-10 21:50:48', 'admin@gmail.com', NULL, NULL),
	(29, 5, 3, 30, 28.00, 70.00, NULL, NULL, '2021-11-10 21:51:02', 'admin@gmail.com', '2021-11-10 21:51:16', 'admin@gmail.com'),
	(30, 6, 3, 10, 29.00, 65.00, NULL, NULL, '2021-11-10 21:51:42', 'admin@gmail.com', NULL, NULL);
/*!40000 ALTER TABLE `plant_state_infos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
