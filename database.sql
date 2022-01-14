-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table vio.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table vio.migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table vio.shoes
CREATE TABLE IF NOT EXISTS `shoes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brandname` varchar(255) DEFAULT NULL,
  `shoename` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `contactinfo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table vio.shoes: ~0 rows (approximately)
/*!40000 ALTER TABLE `shoes` DISABLE KEYS */;
INSERT INTO `shoes` (`id`, `brandname`, `shoename`, `size`, `color`, `condition`, `price`, `contactinfo`) VALUES
	(1, 'VANS', 'VANS AUTHENTIC BLACK AND WHITE', '44', 'BLACK AND WHITE', 'BNIB', '650000', 'vio@gmail.com'),
	(2, 'ADIDAS', 'ADIDAS STAN SMITH', '41', 'WHITE', 'BNIB', '1110000', 'vio@gmail.com'),
	(3, 'CONVERSE', 'CONVERSE 70S BLACK EGRET LOW', '42', 'BLACK', 'BNIB', '650000', 'vio@gmail.com'),
	(4, 'CONVERSE', 'CONVERSE CHUCK 70 HI', '45', 'YELLOW', 'BNOB', '950000', 'vio@gmail.com');
/*!40000 ALTER TABLE `shoes` ENABLE KEYS */;

-- Dumping structure for table vio.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table vio.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
	(1, 'Vio', 'vio@gmail.com', '$2y$10$rpyFpNq7unVI8XywiNgVge3zXVX49TCTHTPH0X8yVOURlqe/G7NdG');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
