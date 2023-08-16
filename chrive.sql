-- MariaDB dump 10.19-11.0.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: chrive
-- ------------------------------------------------------
-- Server version	11.0.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `trips_history`
--

DROP TABLE IF EXISTS `trips_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trips_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `dropoff_location` varchar(255) NOT NULL,
  `trip_date` date NOT NULL,
  `trip_time` time NOT NULL,
  `passengers` int(11) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `trips_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trips_history`
--

LOCK TABLES `trips_history` WRITE;
/*!40000 ALTER TABLE `trips_history` DISABLE KEYS */;
INSERT INTO `trips_history` VALUES
(1,1,'dsf','fds','2023-08-25','00:00:14',3,'111'),
(2,6,'jfk','njc','2023-08-10','00:00:14',4,'5453443444'),
(3,6,'fdgg','fdg','2023-08-10','00:00:15',4,'435345'),
(4,1,'Brookyln College','JFK','2023-08-11','00:00:18',4,'234353443'),
(5,7,'nyc','boston','2023-08-11','00:00:20',4,'4389573498'),
(6,1,'100 Wall Street, New York, Manhattan, 10002','120 Wall Street, New York, Manhattan, 10002','2023-08-17','00:00:17',5,'3324346456'),
(7,1,'345345, , Brooklyn, 3453','54353, , Brooklyn, 345','2023-08-09','00:00:15',534,'5345'),
(8,1,'43534, , Manhattan, 3453','345, , Brooklyn, 345','2023-08-08','00:00:14',4,'435345'),
(9,1,'fghfg, , Manhattan, 234','fghfg, , Manhattan, 4234','2023-08-01','00:00:14',43,'345'),
(10,1,'fghfg, , Manhattan, 234','fghfg, , Manhattan, 4234','2023-08-01','00:00:14',43,'345'),
(11,1,'fghfg, , Manhattan, 234','fghfg, , Manhattan, 4234','2023-08-01','14:57:00',43,'345'),
(12,1,'fghfg, , Manhattan, 234','fghfg, , Manhattan, 4234','2023-08-01','14:57:00',43,'345'),
(13,1,'120 Wall Street, Manhattan, 10001','110 Bushwick Ave., , Brooklyn, 1121','2023-08-12','16:50:00',7,'123-456-7890'),
(14,1,'120 Wall Street, Manhattan, 10001','110 Bushwick Ave., , Brooklyn, 677','2023-08-12','16:50:00',7,'123-456-7890'),
(15,1,'120 Wall Street, Manhattan, 10001','110 Bushwick Ave., , Brooklyn, 112','2023-08-12','16:50:00',7,'123-456-7890'),
(16,1,'345345, Manhattan, 53455','435, , Brooklyn, 54','2023-08-16','15:55:00',7,'435-353-4345'),
(17,1,'345345, Manhattan, 53466','435, , Brooklyn, 54354','2023-08-16','15:55:00',7,'437-979-7897');
/*!40000 ALTER TABLE `trips_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'Admin','admin@gmail.com','admin','$2y$10$qoE.K38tpkzCRb3Bkd6uh.ST2Fa8EgLLoOj9RF4PL5rLhY/14jC/e'),
(2,'John Doe','johndoe@gmail.com','johndoe','$2y$10$RS6W0VSQm1oqjZhWLcVx4eLlpCETeg2ZjR3qeG2fbaLg9AqB44JJm'),
(3,'John Smith','johnsmith@gmail.com','johnsmith','$2y$10$RxYNTYH9fQ4CyomnZ6nisuiaijtzEOLGg8cXT4aHFZp3qky.gwcU2'),
(4,'Jack Doe','jackdoe@gmail.com','jackdoe','$2y$10$YclYHBJiT7/pedun/f/.guNO8gS.LwuI.cxif0YEm8WQhgjvW2owC'),
(5,'Jane Smith','janesmith@gmail.com','janesmith','$2y$10$n4GF2tVeUuJGnGpPgXN3DuCIFCG7HFOEXLXZA5vy10y80QWP21SpO'),
(6,'Black Jack','blackjack@gmail.com','blackjack','$2y$10$.aORxLvhtONKcdwBZHqvj.ixUdUYWBM4Lw9o1lrnSi/SAp8q0YsOW'),
(7,'test','test1@test.com','test1','$2y$10$8Wh65bybKYOALUZT9tvCJOFCvDiqGtRbzUn76HY8W0e/RxsKcJWkS'),
(8,'Vivek Sharma','vivek@gmail.com','vivek','$2y$10$SQKyifw0e39/u6ISiPF0bu0iYahbrtoBObj1YBu1UkHPmwlsxdgAO');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-15 23:28:15
