/*
SQLyog Ultimate v8.55 
MySQL - 5.5.24-log : Database - status
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`status` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `status`;

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `loginid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` char(32) NOT NULL,
  `lastactivity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loginid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`loginid`,`username`,`password`,`lastactivity`) values (1,'narendra','2865a5b14e5a70273a7d311bfc150f4f','2013-12-18 12:11:32'),(2,'pradeeps','e10adc3949ba59abbe56e057f20f883e','2013-12-30 18:03:50'),(5,'rajaaj','e10adc3949ba59abbe56e057f20f883e','2014-01-07 15:34:58'),(6,'abhinandan.kothari','e10adc3949ba59abbe56e057f20f883e','2014-01-07 15:39:26');

/*Table structure for table `report` */

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ticket_no` varchar(10) NOT NULL,
  `title` tinytext NOT NULL,
  `description` text NOT NULL,
  `report_date` date NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `report` */

/*Table structure for table `user_info` */

DROP TABLE IF EXISTS `user_info`;

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `loginid` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact_no` bigint(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login_id` (`loginid`),
  KEY `login_id_2` (`loginid`),
  CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `login` (`loginid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `user_info` */

insert  into `user_info`(`user_id`,`loginid`,`fullname`,`contact_no`,`email_id`) values (1,1,'Narendra Singh',7303140672,'narendra.singh@synergytechservices.com'),(2,2,'Pradeep Shreevastava',7894612354,'pradeep@gmail.com'),(3,5,'Raj Aaj',7897545151,'raj@aaj.com'),(6,6,'Abhinandan Kothari',9988774455,'abhinandan.kothari@gmail.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
