/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.17 : Database - _wshop_test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`_wshop_api_magasins` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `_wshop_api_magasins`;

/*Table structure for table `magasin` */

DROP TABLE IF EXISTS `magasin`;

CREATE TABLE `magasin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ville` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `tr_date_updated` datetime DEFAULT NULL COMMENT 'via trigger ADD/MODIF',
  PRIMARY KEY (`id`),
  KEY `tr_date_updated` (`tr_date_updated`)
) ENGINE=InnoDB AUTO_INCREMENT=607 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `magasin` */

insert  into `magasin`(`id`,`nom`,`ville`,`cp`,`tr_date_updated`) values
(1,'Magasin Fleury','Fleury',74568,NULL),
(2,'Magasin Stone Temple Pilots','Temple',70423,NULL),
(3,'Magasin Rungis','Rungis',73468,NULL),
(4,'Magasin Marly','Marly',92334,NULL),
(5,'Magasin Xebado','Xebado',12345,NULL),
(6,'Magasin Carré 2','Tarry',08533,NULL),
(7,'Magasin Naum','Quero',13743,NULL),
(8,'Magasin Fleury 2','Fleury-Mero',01754,NULL);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
