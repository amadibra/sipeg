/*
SQLyog Enterprise - MySQL GUI v7.1 
MySQL - 5.0.45-community-nt : Database - dbsipeg
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbsipeg` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;

USE `dbsipeg`;

/*Table structure for table `admin_dosir` */

DROP TABLE IF EXISTS `admin_dosir`;

CREATE TABLE `admin_dosir` (
  `nipeg` varchar(10) NOT NULL,
  `kd_posisi` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `admin_dosir` */

insert  into `admin_dosir`(`nipeg`,`kd_posisi`) values ('86111925Z',''),('7092200K3\r',''),('ziron',''),('laura','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
