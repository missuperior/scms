/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.30 : Database - scms_tables
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`scms_tables` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `scms_tables`;

/*Table structure for table `gen_account_logins` */

DROP TABLE IF EXISTS `gen_account_logins`;

CREATE TABLE `gen_account_logins` (
  `acc_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_login` varchar(100) NOT NULL,
  `acc_password` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `account_role_id` int(11) NOT NULL,
  `acc_status` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`acc_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `gen_account_logins` */

insert  into `gen_account_logins`(`acc_login_id`,`acc_login`,`acc_password`,`created_date`,`last_login`,`account_role_id`,`acc_status`) values (1,'admin@scms.com','f865b53623b121fd34ee5426c792e5c33af8c227','2014-02-27',NULL,1,1),(2,'hris@scms.com','f865b53623b121fd34ee5426c792e5c33af8c227','2014-02-27',NULL,2,1);

/*Table structure for table `gen_account_roles` */

DROP TABLE IF EXISTS `gen_account_roles`;

CREATE TABLE `gen_account_roles` (
  `account_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(100) NOT NULL,
  PRIMARY KEY (`account_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `gen_account_roles` */

insert  into `gen_account_roles`(`account_role_id`,`role_title`) values (1,'Administrator'),(2,'HRIS'),(3,'Admissions'),(4,'Accounts'),(5,'Audit');

/*Table structure for table `gen_sub_roles` */

DROP TABLE IF EXISTS `gen_sub_roles`;

CREATE TABLE `gen_sub_roles` (
  `sub_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_role_title` varchar(150) NOT NULL,
  `account_role_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `gen_sub_roles` */

insert  into `gen_sub_roles`(`sub_role_id`,`sub_role_title`,`account_role_id`) values (1,'Data Entry Operator',3),(2,'HRIS Administrator',2),(3,'HRIS Line Adminsitrator',2),(4,'Data Entry Operator',2),(5,'Inquiry Officer',3),(6,'Admission Officer',3),(7,'Admission Incharge',3);

/*Table structure for table `hr_department_roles` */

DROP TABLE IF EXISTS `hr_department_roles`;

CREATE TABLE `hr_department_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `sub_role_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `hr_department_roles` */

insert  into `hr_department_roles`(`role_id`,`department_id`,`sub_role_id`) values (1,1,6),(2,1,7),(3,1,4),(4,4,2),(5,4,3),(6,4,4);

/*Table structure for table `hr_departments` */

DROP TABLE IF EXISTS `hr_departments`;

CREATE TABLE `hr_departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `account_role_id` int(11) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `hr_departments` */

insert  into `hr_departments`(`department_id`,`department_name`,`account_role_id`) values (1,'Operations',2),(2,'Data Control',2),(3,'Inquiry',3),(4,'HR',2),(5,'Prospectus Sales',3),(6,'Form Submission',3);

/*Table structure for table `member_logins` */

DROP TABLE IF EXISTS `member_logins`;

CREATE TABLE `member_logins` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_login` varchar(100) NOT NULL,
  `member_password` varchar(100) NOT NULL,
  `sub_role_id` int(11) NOT NULL,
  `created_date` date DEFAULT NULL,
  `member_status` tinyint(2) DEFAULT NULL,
  `flag_check` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `member_logins` */

/*Table structure for table `temporary_accounts` */

DROP TABLE IF EXISTS `temporary_accounts`;

CREATE TABLE `temporary_accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `sub_role_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temporary_accounts` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
