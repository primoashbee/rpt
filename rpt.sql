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
  `firstname` varchar(255) NOT NULL DEFAULT 'Administrato',
  `lastname` varchar(255) DEFAULT 'Administrato',
  `mi` varchar(15) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isAdmin` tinyint(1) DEFAULT '0',
  `img_url` varchar(255) DEFAULT '../images/avatar/default.png',
  `isDeleted` tinyint(1) DEFAULT '0',
  `gender` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`firstname`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`firstname`,`lastname`,`mi`,`birthday`,`username`,`password`,`created_at`,`updated_at`,`isAdmin`,`img_url`,`isDeleted`,`gender`) values (1,'Ashbee','Morgado','A','1994-11-26','primoashbee','1234','2018-01-20 13:53:06','2018-01-20 13:53:06',0,'../images/avatar/default.png',0,'Male'),(2,'Daenarys','Stormborn','R','1990-11-01','daenarys','1234','2018-01-22 11:45:20','2018-01-22 11:45:20',0,'../images/avatar/default.png',0,'Female'),(3,'','','','','admin','admin','2018-01-22 16:45:03','2018-01-22 16:45:03',1,'../assets/img/avatar/3.jpg',0,'');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `properties` */

insert  into `properties`(`id`,`lot_number`,`pin_td`,`baranggay_id`,`class_id`,`value`,`owner_id`,`lattitude`,`longitude`,`created_at`,`updated_at`,`isDeleted`) values (1,'2nd floor','123-1312312-3123131-23',20,'1','150000',2,'14.6741293','120.51129070000002','2018-01-22 14:40:15','2018-01-22 14:40:15',0),(3,'hayaan mo sila','12313',5,'1','12313',1,'14.6741293','120.51129070000002','2018-01-22 14:43:35','2018-01-22 14:43:35',1),(4,'1231','2133',20,'1','12313',2,'14.6741293','120.51129070000002','2018-01-22 14:44:03','2018-01-22 14:44:03',0),(5,'12313','123131',11,'1','123123213123',1,'14.673441778327808','120.54409503936768','2018-01-22 15:53:15','2018-01-22 15:53:15',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
