/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.1.69-community : Database - list
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`list` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `list`;

/*Table structure for table `cdlist` */

DROP TABLE IF EXISTS `cdlist`;

CREATE TABLE `cdlist` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL,
  `note` text NOT NULL,
  `endtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*Data for the table `cdlist` */

insert  into `cdlist`(`id`,`username`,`note`,`endtime`) values (37,'wml','fw','2013-07-17 00:00:00'),(38,'wml','swg','2013-07-24 00:22:00'),(63,'wml','48元，正品高档红豆杉筷子  ','2013-07-13 00:00:22'),(64,'def','去找实习！','2013-07-17 02:14:30'),(65,'def','C1牌驾驶培训  ','2013-07-11 23:57:38'),(68,'wjj','去泡妞','2013-07-30 05:09:07');

/*Table structure for table `userinfo` */

DROP TABLE IF EXISTS `userinfo`;

CREATE TABLE `userinfo` (
  `userid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL,
  `password` char(32) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `userinfo` */

insert  into `userinfo`(`userid`,`username`,`password`) values (1,'wjj','wjj'),(2,'wml','wml'),(3,'thj','thj'),(4,'dxx','dxx'),(5,'cpw','cpw'),(6,'abc','abc'),(7,'def','def');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
