-- --------------------------------------------------------
-- Host:                         sv-procon.uet.vnu.edu.vn
-- Server version:               5.7.34-0ubuntu0.18.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table irrigation_database.agriculture_plants
DROP TABLE IF EXISTS `agriculture_plants`;
CREATE TABLE IF NOT EXISTS `agriculture_plants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plant_id` bigint(20) unsigned DEFAULT NULL,
  `plant_state_id` tinyint(3) unsigned DEFAULT NULL,
  `FarmID` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `growth_period` mediumint(7) unsigned DEFAULT NULL,
  `temperature` float DEFAULT NULL,
  `moisture` float DEFAULT NULL,
  `light` text COLLATE utf8_unicode_ci,
  `note` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.Controlling
DROP TABLE IF EXISTS `Controlling`;
CREATE TABLE IF NOT EXISTS `Controlling` (
  `ControllingID` bigint(20) NOT NULL,
  `DeviceID` bigint(20) DEFAULT NULL,
  `PlotID` int(11) DEFAULT NULL,
  `AmountOfWater` float DEFAULT NULL,
  `WateringDuration` int(11) DEFAULT NULL,
  `TimeOfControl` datetime DEFAULT NULL,
  PRIMARY KEY (`ControllingID`),
  KEY `DeviceID` (`DeviceID`),
  KEY `PlotID` (`PlotID`),
  CONSTRAINT `Controlling_ibfk_1` FOREIGN KEY (`DeviceID`) REFERENCES `Devices` (`DeviceID`) ON UPDATE CASCADE,
  CONSTRAINT `Controlling_ibfk_2` FOREIGN KEY (`PlotID`) REFERENCES `Plots` (`PlotID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.Devices
DROP TABLE IF EXISTS `Devices`;
CREATE TABLE IF NOT EXISTS `Devices` (
  `DeviceID` bigint(20) NOT NULL,
  `DeviceTypeID` int(11) DEFAULT NULL,
  `DeviceName` varchar(50) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `PlotID` int(11) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `FarmID` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`DeviceID`),
  KEY `DeviceTypeID` (`DeviceTypeID`),
  KEY `PlotID` (`PlotID`),
  CONSTRAINT `Devices_ibfk_1` FOREIGN KEY (`DeviceTypeID`) REFERENCES `DeviceTypes` (`DeviceTypeID`) ON UPDATE CASCADE,
  CONSTRAINT `Devices_ibfk_2` FOREIGN KEY (`PlotID`) REFERENCES `Plots` (`PlotID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.DeviceTypes
DROP TABLE IF EXISTS `DeviceTypes`;
CREATE TABLE IF NOT EXISTS `DeviceTypes` (
  `DeviceTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `DeviceType` varchar(50) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`DeviceTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.Farms
DROP TABLE IF EXISTS `Farms`;
CREATE TABLE IF NOT EXISTS `Farms` (
  `FarmID` int(11) NOT NULL AUTO_INCREMENT,
  `LocateID` varchar(50) DEFAULT NULL,
  `Area` double DEFAULT NULL,
  `FarmTypeID` int(11) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`FarmID`),
  KEY `UserID` (`UserID`),
  KEY `FarmTypeID` (`FarmTypeID`),
  KEY `LocateID` (`LocateID`),
  CONSTRAINT `Farms_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON UPDATE CASCADE,
  CONSTRAINT `Farms_ibfk_2` FOREIGN KEY (`FarmTypeID`) REFERENCES `FarmTypes` (`FarmTypeID`) ON UPDATE CASCADE,
  CONSTRAINT `Farms_ibfk_3` FOREIGN KEY (`LocateID`) REFERENCES `Locates` (`LocateID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.FarmTypes
DROP TABLE IF EXISTS `FarmTypes`;
CREATE TABLE IF NOT EXISTS `FarmTypes` (
  `FarmTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `FarmType` varchar(50) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`FarmTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.farm_plants
DROP TABLE IF EXISTS `farm_plants`;
CREATE TABLE IF NOT EXISTS `farm_plants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `FarmID` bigint(20) unsigned DEFAULT NULL,
  `plant_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.Locates
DROP TABLE IF EXISTS `Locates`;
CREATE TABLE IF NOT EXISTS `Locates` (
  `LocateID` varchar(50) NOT NULL,
  `LocateName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`LocateID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.plants
DROP TABLE IF EXISTS `plants`;
CREATE TABLE IF NOT EXISTS `plants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cultivars` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'giong cay trong',
  `plant_type_id` smallint(6) DEFAULT NULL,
  `growth_period` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Thoi gian sinh truong',
  `planting_time` text COLLATE utf8_unicode_ci COMMENT 'thoi gian gieo trong',
  `plant_density` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'mat do cay trong',
  `width_bed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Do rong hang',
  `height_bed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'do cao cua hang',
  `row_spacing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'khoa cach giua cac hang',
  `tree_spacing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'khoang cach giua cac cay',
  `soil_type_id` tinyint(3) unsigned DEFAULT NULL COMMENT 'Dat canh tac',
  `info` text COLLATE utf8_unicode_ci COMMENT 'Thong tin khac',
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.plant_states
DROP TABLE IF EXISTS `plant_states`;
CREATE TABLE IF NOT EXISTS `plant_states` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `note` text COLLATE utf8_unicode_ci,
  `created_user` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_user` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.plant_state_infos
DROP TABLE IF EXISTS `plant_state_infos`;
CREATE TABLE IF NOT EXISTS `plant_state_infos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plant_state_id` tinyint(3) unsigned NOT NULL,
  `plant_id` bigint(20) unsigned NOT NULL,
  `growth_period_state` mediumint(8) unsigned DEFAULT NULL COMMENT 'thoi gian sinh truong cua trang thai',
  `temperature` float DEFAULT NULL COMMENT 'Nhiet do',
  `moisture` float DEFAULT NULL COMMENT 'do am',
  `light` text COLLATE utf8_unicode_ci COMMENT 'cuong do anh sang',
  `note` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.plant_types
DROP TABLE IF EXISTS `plant_types`;
CREATE TABLE IF NOT EXISTS `plant_types` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `created_user` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_user` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.Plots
DROP TABLE IF EXISTS `Plots`;
CREATE TABLE IF NOT EXISTS `Plots` (
  `PlotID` int(11) NOT NULL AUTO_INCREMENT,
  `Area` double DEFAULT NULL,
  `PlotTypeID` int(11) DEFAULT NULL,
  `FarmID` int(11) DEFAULT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`PlotID`),
  KEY `FarmID` (`FarmID`),
  KEY `PlotTypeID` (`PlotTypeID`),
  CONSTRAINT `Plots_ibfk_1` FOREIGN KEY (`FarmID`) REFERENCES `Farms` (`FarmID`) ON UPDATE CASCADE,
  CONSTRAINT `Plots_ibfk_2` FOREIGN KEY (`PlotTypeID`) REFERENCES `PlotTypes` (`PlotTypeID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.PlotTypes
DROP TABLE IF EXISTS `PlotTypes`;
CREATE TABLE IF NOT EXISTS `PlotTypes` (
  `PlotTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `PlotType` varchar(50) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`PlotTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.Sensing
DROP TABLE IF EXISTS `Sensing`;
CREATE TABLE IF NOT EXISTS `Sensing` (
  `SensingID` bigint(20) NOT NULL AUTO_INCREMENT,
  `DeviceID` bigint(20) DEFAULT NULL,
  `PlotID` int(11) DEFAULT NULL,
  `SoilMoisture` float DEFAULT NULL,
  `Humidity` float DEFAULT NULL,
  `Temperature` float DEFAULT NULL,
  `LightLevel` int(11) DEFAULT NULL,
  `TimeOfMeasurement` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`SensingID`),
  KEY `PlotID` (`PlotID`),
  KEY `DeviceID` (`DeviceID`),
  CONSTRAINT `Sensing_ibfk_1` FOREIGN KEY (`PlotID`) REFERENCES `Plots` (`PlotID`) ON UPDATE CASCADE,
  CONSTRAINT `Sensing_ibfk_2` FOREIGN KEY (`DeviceID`) REFERENCES `Devices` (`DeviceID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41410 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.soil_types
DROP TABLE IF EXISTS `soil_types`;
CREATE TABLE IF NOT EXISTS `soil_types` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.Users
DROP TABLE IF EXISTS `Users`;
CREATE TABLE IF NOT EXISTS `Users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `UPassword` varchar(50) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.WeatherForecastAtATimes
DROP TABLE IF EXISTS `WeatherForecastAtATimes`;
CREATE TABLE IF NOT EXISTS `WeatherForecastAtATimes` (
  `WeatherForecastID` int(11) NOT NULL,
  `ForecastTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `EpochTime` bigint(20) DEFAULT NULL,
  `ForecastStatus` varchar(50) DEFAULT NULL,
  `IsDayLight` tinyint(1) DEFAULT NULL,
  `Temperature` float DEFAULT NULL,
  `WindSpeed` float DEFAULT NULL,
  `RelativeHumidity` float DEFAULT NULL,
  `RainProbability` tinyint(4) DEFAULT NULL,
  `PrecipitationProbability` tinyint(4) DEFAULT NULL,
  `RainValue` float DEFAULT NULL,
  `CloudCover` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`WeatherForecastID`,`ForecastTime`),
  CONSTRAINT `WeatherForecastAtATimes_ibfk_1` FOREIGN KEY (`WeatherForecastID`) REFERENCES `WeatherForecasts` (`WeatherForecastID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table irrigation_database.WeatherForecasts
DROP TABLE IF EXISTS `WeatherForecasts`;
CREATE TABLE IF NOT EXISTS `WeatherForecasts` (
  `WeatherForecastID` int(11) NOT NULL AUTO_INCREMENT,
  `LocateID` varchar(50) NOT NULL,
  `CurrentTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`WeatherForecastID`),
  KEY `LocateID` (`LocateID`),
  CONSTRAINT `WeatherForecasts_ibfk_1` FOREIGN KEY (`LocateID`) REFERENCES `Locates` (`LocateID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=763 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
