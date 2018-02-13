/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19 : Database - rpt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rpt` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `rpt`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `mi` varchar(15) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isAdmin` tinyint(1) DEFAULT '0',
  `img_url` varchar(255) DEFAULT '../assets/img/avatar/default.png',
  `isDeleted` tinyint(1) DEFAULT '0',
  `gender` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`firstname`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`firstname`,`lastname`,`mi`,`birthday`,`username`,`password`,`created_at`,`updated_at`,`isAdmin`,`img_url`,`isDeleted`,`gender`,`mobile_number`) values (1,'Eddard','Stark','A','1990-01-25','nedd','$2y$10$tJEuASj2hPdPrLqfj83Vi.PrSlFRf.nWJ24jRU4egzFD4z2q90G8a','2018-01-20 13:53:06','2018-01-20 13:53:06',0,'../assets/img/avatar/1.png',0,'Male','639171101126'),(2,'Daenarys','Stormborn','R','1990-11-12','daenarys','$2y$10$d92o1grFmk7wxhhBLJOgC.gnHAseGAzD76iVp/Aikj1q3ZbBMxZcW','2018-01-22 11:45:20','2018-01-22 11:45:20',0,'../assets/img/avatar/2.jpg',0,'Female','639171101126'),(5,'John','Snow','B','1990-01-01','johnsnow','$2y$10$d92o1grFmk7wxhhBLJOgC.gnHAseGAzD76iVp/Aikj1q3ZbBMxZcW','2018-01-22 18:07:08','2018-01-22 18:07:08',0,'../assets/img/avatar/5.png',0,'Male','639171101126'),(7,'Administrator','Administrator','A','1990-11-26','admin','$2y$10$d92o1grFmk7wxhhBLJOgC.gnHAseGAzD76iVp/Aikj1q3ZbBMxZcW','2018-01-25 20:17:49','2018-01-25 20:17:49',1,'../assets/img/avatar/7.jpg',0,'Male','639171101126'),(33,'Ashbee','Morgado','Ashbee','1994-11-26','testaccount','$2y$10$1dNLH9TdwKvu.ILIU9XKuOq.NzpRMMLP3evHNvGdUUeeI0e4psH9a','2018-02-08 14:50:16','2018-02-08 14:50:16',0,'../assets/img/avatar/default.png',0,'Male','639171101126'),(34,'dasda','sdasdsad','Allego','2000-11-11','asdas','$2y$10$FIkNFGYDd1F2I/YlH2gpKeMhlyDP0Sv3L/FmNRWUdcL7CaSkEFCo6','2018-02-08 16:21:32','2018-02-08 16:21:32',0,'../assets/img/avatar/default.png',0,'Male','631955668888');

/*Table structure for table `baranggays` */

DROP TABLE IF EXISTS `baranggays`;

CREATE TABLE `baranggays` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `baranggays` */

insert  into `baranggays`(`id`,`name`,`created_at`,`updated_at`,`isDeleted`) values (1,'Poblacion','2018-01-04 12:21:28','2018-01-04 12:21:28',0),(2,'Cataning','2018-01-04 12:21:32','2018-01-04 12:21:32',0),(3,'Bagumbayan','2018-01-04 12:21:38','2018-01-04 12:21:38',0),(4,'Talisay','2018-01-04 12:21:41','2018-01-04 12:21:41',0),(5,'Malabia','2018-01-04 12:21:46','2018-01-04 12:21:46',0),(6,'San Jose\r\n','2018-01-04 12:21:46','2018-01-04 12:21:46',0),(7,'Ibayo','2018-01-04 12:21:52','2018-01-04 12:21:52',0),(8,'Dona Francisca','2018-01-04 12:21:56','2018-01-04 12:21:56',0),(9,'Cupang Proper','2018-01-04 12:21:59','2018-01-04 12:21:59',0),(10,'Cupang North','2018-01-04 12:22:03','2018-01-04 12:22:03',0),(11,'Cupang West','2018-01-04 12:22:04','2018-01-04 12:22:04',0),(12,'Sibacan','2018-01-04 12:22:07','2018-01-04 12:22:07',0),(13,'Tuyo','2018-01-04 12:22:10','2018-01-04 12:22:10',0),(14,'Puerto Rivas Ibaba','2018-01-04 12:22:18','2018-01-04 12:22:18',0),(15,'Puerto Rivas Itaas','2018-01-04 12:22:21','2018-01-04 12:22:21',0),(16,'Tortugas','2018-01-04 12:22:24','2018-01-04 12:22:24',0),(17,'Central','2018-01-04 12:22:27','2018-01-04 12:22:27',0),(18,'Tenejero','2018-01-04 12:22:30','2018-01-04 12:22:30',0),(19,'Camacho','2018-01-04 12:22:33','2018-01-04 12:22:33',0),(20,'Bagong Silang','2018-01-04 12:22:37','2018-01-04 12:22:37',0),(21,'Puerto Rivas Lote','2018-01-04 12:22:39','2018-01-04 12:22:39',0),(22,'Dangcol','2018-01-04 12:22:44','2018-01-04 12:22:44',0),(23,'Cabog-Cabog','2018-01-04 12:22:47','2018-01-04 12:22:47',0),(24,'Tanato','2018-01-04 12:22:52','2018-01-04 12:22:52',0),(25,'Munting Batangas','2018-01-04 12:22:53','2018-01-04 12:22:53',0);

/*Table structure for table `bills` */

DROP TABLE IF EXISTS `bills`;

CREATE TABLE `bills` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int(15) unsigned NOT NULL,
  `billing_year` varchar(255) DEFAULT NULL,
  `billing_month` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isPaid` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

/*Data for the table `bills` */

insert  into `bills`(`id`,`property_id`,`billing_year`,`billing_month`,`amount`,`created_at`,`isPaid`) values (55,3,'2018','2','13450','2018-02-12 13:41:52',0),(56,1,'2018','2','1500','2018-02-12 14:01:24',0),(57,4,'2018','2','15000','2018-02-12 14:01:24',0),(58,16,'2018','2','92000','2018-02-12 14:01:24',0),(59,17,'2018','2','10000','2018-02-12 14:01:24',0);

/*Table structure for table `class` */

DROP TABLE IF EXISTS `class`;

CREATE TABLE `class` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `class` */

insert  into `class`(`id`,`type`,`created_at`,`updated_at`,`isDeleted`) values (1,'Commerical','2018-01-22 14:12:06','2018-01-22 14:12:06',0),(2,'Residential','2018-01-22 14:12:12','2018-01-22 14:12:12',0);

/*Table structure for table `cms_info` */

DROP TABLE IF EXISTS `cms_info`;

CREATE TABLE `cms_info` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `vision` longtext,
  `mission` longtext,
  `about` longtext,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vision_img` varchar(255) DEFAULT NULL,
  `mission_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `cms_info` */

insert  into `cms_info`(`id`,`vision`,`mission`,`about`,`created_at`,`vision_img`,`mission_img`) values (1,'WTH','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','2018-02-01 15:48:14','website/images/vision.jpg','website/images/mission.jpg');

/*Table structure for table `cms_slides` */

DROP TABLE IF EXISTS `cms_slides`;

CREATE TABLE `cms_slides` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `tagline` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT '0',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cms_slides` */

insert  into `cms_slides`(`id`,`tagline`,`subtitle`,`img_url`,`isDeleted`,`create_at`) values (1,'City Treasurer\'s Balanga','Subtitle','website/images/wallpaper2.png',0,'2018-02-01 09:36:44'),(2,'Valar Dohaeris','Subtitle','website/images/wallpaper3.png',0,'2018-02-01 09:37:29'),(3,'Valar Morghulis','Subtitle','website/images/wallpaper.png',0,'2018-02-01 09:37:40');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `billing_id` int(15) unsigned NOT NULL,
  `amount_paid` varbinary(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `checkout_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `payments` */

/*Table structure for table `properties` */

DROP TABLE IF EXISTS `properties`;

CREATE TABLE `properties` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `lot_number` varchar(255) DEFAULT NULL,
  `pin_td` varchar(255) DEFAULT NULL,
  `baranggay_id` int(15) DEFAULT NULL,
  `class_id` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `owner_id` int(15) unsigned NOT NULL,
  `lattitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `properties` */

insert  into `properties`(`id`,`lot_number`,`pin_td`,`baranggay_id`,`class_id`,`value`,`owner_id`,`lattitude`,`longitude`,`created_at`,`updated_at`,`isDeleted`) values (1,'2nd floor','123-1312312-3123131-23',20,'1','150000',2,'14.6741293','120.51129070000002','2018-01-22 14:40:15','2018-01-22 14:40:15',0),(3,'hayaan mo sila','12313',5,'1','1345000',1,'14.6741293','120.51129070000002','2018-01-22 14:43:35','2018-01-22 14:43:35',0),(4,'1231','2133',20,'1','1500000',2,'14.6741293','120.51129070000002','2018-01-22 14:44:03','2018-01-22 14:44:03',0),(16,'1231231','1234432112344321',25,'1','9200000',33,'14.678672690466012','120.51129070000002','2018-02-08 14:50:16','2018-02-08 14:50:16',0),(17,'123123123','12344321',1,'1','1000000',34,'14.680457814393256','120.5185604095459','2018-02-08 16:21:32','2018-02-08 16:21:32',0);

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `services` */

insert  into `services`(`id`,`service_name`,`created_at`,`isDeleted`) values (1,'PAYMENT OF REAL PROPERTY TAXES\r\n','2018-02-01 10:45:30',0),(2,'PAYMENT OF BUSINESS TAX','2018-02-01 10:45:35',0),(3,'PAYMENT OF COMMUNITY TAX CERTIFICATE','2018-02-01 10:45:39',0),(4,'PAYMENT OF TRANSFER TAX','2018-02-01 10:45:47',0),(5,'PAYMENT OF OTHER TAXES, PERMIT, FEES, AND SERVICE CHARGES','2018-02-01 10:45:47',0),(6,'\r\nPAYMENT OF MARKET FEES AND CASH TICKETS','2018-02-01 10:45:53',0),(7,'PAYMENT OF STALL RENTALS & SECURING MARKET CLEARANCE AND CERTIFICATIONS\r\n','2018-02-01 10:46:02',0),(8,'PAYMENT ON CALIBRATION OF WEIGHING SCALE','2018-02-01 10:46:05',0),(9,'PAYMENT OF LIVESTOCK','2018-02-01 10:46:10',0);

/* Function  structure for function  `checkIfPaid` */

/*!50003 DROP FUNCTION IF EXISTS `checkIfPaid` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `checkIfPaid`(property_id int) RETURNS decimal(10,0)
    DETERMINISTIC
BEGIN 
  DECLARE property_id int;
  SET property_id = property_id * 1000;
  RETURN property_id;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
