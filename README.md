<h1>Delivery Management System</h1>

<p>
Modified version of the Sample administrator panel built by Sapienza [<a href="https://github.com/sapienza/CodeIgniter-admin-panel">original project</a>] using CodeIgniter 2.1.2 with Mysql and Twitter Bootstrap.

The documentation below concerns the original project - 

<h2>Changes</h2>
<ul>
  <li>Modified models, created new ones</li>
  <li>Enforced foreign key constraints on several tables
  <li>Modified views.</li>
</ul>

<h2>Requirements</h2>
<ul>
<li>
<a href="http://twitter.github.com/bootstrap/" target="_blank">Bootstrap</a> 2.0.4+</li>
<li>
<a href="http://jquery.com/" target="_blank">jQuery</a> 1.7.1+</li>
<li>jQuery UI</li>
</ul>


<h2>Functionalities:</h2>

<ul>
  <li>Signup/Login/Logout</li> 
  <li>Create, insert, edit and delete deliveries</li>
  <li>Create, insert, edit and delete facilities [ADAM: Modified CRUD statements for both models]</li>
  <li>All forms with back end validation in the controller</li>
  <li>List data content with pagination, search, and filters</li>
</ul>

------------------------------------------------------------------

<h2>Instructions</h2>

<ul>
  <li>Setup your database in application/config/database.php. I have used a database called 'main_dms' so set this up in WAMP/MAMP whatever.</li>
  <li>Dump the mysql at the bottom of this readme</li>
  <li>Access your project url at http://localhost/</li>
  <li>Signup and enjoy!</li>
</ul>


------------------------------------------------------------------

<h2>Mysql Dump</h2>

<p>This dump comes complete with sample data.</p>

```
# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.29)
# Database: main_dms
# Generation Time: 2014-04-01 02:48:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ci_cookies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ci_cookies`;

CREATE TABLE `ci_cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table ci_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`)
VALUES
	('3f53cf1be90f22f807b08ba929a627ed','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.152 Safari/537.36',1396292423,'a:7:{s:9:\"user_data\";s:0:\"\";s:9:\"user_name\";s:5:\"adaam\";s:12:\"is_logged_in\";b:1;s:17:\"facility_selected\";N;s:22:\"search_string_selected\";N;s:5:\"order\";N;s:10:\"order_type\";N;}');

/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table deliveries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `deliveries`;

CREATE TABLE `deliveries` (
  `delivery_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) unsigned NOT NULL,
  `date_stamp` date NOT NULL,
  `time_stamp` time NOT NULL,
  `status_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`delivery_id`),
  KEY `fk_vehicle_id` (`vehicle_id`),
  KEY `fk_status_id` (`status_id`),
  CONSTRAINT `fk_status_id` FOREIGN KEY (`status_id`) REFERENCES `delivery_statuses` (`status_id`),
  CONSTRAINT `fk_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;

INSERT INTO `deliveries` (`delivery_id`, `vehicle_id`, `date_stamp`, `time_stamp`, `status_id`)
VALUES
	(1,1,'0000-00-00','00:00:00',1);

/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table delivery_facility_link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `delivery_facility_link`;

CREATE TABLE `delivery_facility_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) unsigned NOT NULL,
  `delivery_id` int(11) unsigned NOT NULL,
  `authorization_start_time` time DEFAULT NULL,
  `authorization_end_time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_delivery_id` (`delivery_id`),
  KEY `fk_facility_id` (`facility_id`),
  CONSTRAINT `fk_delivery_id` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`delivery_id`),
  CONSTRAINT `fk_facility_id` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`facility_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `delivery_facility_link` WRITE;
/*!40000 ALTER TABLE `delivery_facility_link` DISABLE KEYS */;

INSERT INTO `delivery_facility_link` (`id`, `facility_id`, `delivery_id`, `authorization_start_time`, `authorization_end_time`)
VALUES
	(3,1,1,'13:30:00','14:45:00');

/*!40000 ALTER TABLE `delivery_facility_link` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table delivery_statuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `delivery_statuses`;

CREATE TABLE `delivery_statuses` (
  `status_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `status_description` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `delivery_statuses` WRITE;
/*!40000 ALTER TABLE `delivery_statuses` DISABLE KEYS */;

INSERT INTO `delivery_statuses` (`status_id`, `status_name`, `status_description`)
VALUES
	(1,'booked','The delivery has been booked via the DMS site, but has not taken place yet.'),
	(2,'in progress','The status is changed to \'in progress\' when the vehicle is granted access to the relevant storage facility'),
	(3,'cancelled','The status \'Cancelled\' is set when a delivery is cancelled before it is due.'),
	(4,'expired','The \'Expired\' status represents a missed delivery once the delivery date has passed. This status is automatically set by the system on the day after the delivery was expected.'),
	(5,'done','A delivery is \'done\' once a delivery vehicle leaves the last storage facility on its rounds (a single delivery can consist of many visits to different facilities).');

/*!40000 ALTER TABLE `delivery_statuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table driver_vehicle_link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `driver_vehicle_link`;

CREATE TABLE `driver_vehicle_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) unsigned NOT NULL,
  `vehicle_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_driver_id` (`driver_id`),
  KEY `fk_vehicle_id_2` (`vehicle_id`),
  CONSTRAINT `fk_vehicle_id_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  CONSTRAINT `fk_driver_id` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `driver_vehicle_link` WRITE;
/*!40000 ALTER TABLE `driver_vehicle_link` DISABLE KEYS */;

INSERT INTO `driver_vehicle_link` (`id`, `driver_id`, `vehicle_id`)
VALUES
	(1,1,1);

/*!40000 ALTER TABLE `driver_vehicle_link` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table drivers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `drivers`;

CREATE TABLE `drivers` (
  `driver_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `driver_first_name` varchar(100) DEFAULT NULL,
  `driver_last_name` varchar(100) DEFAULT NULL,
  `driver_phone_number` varchar(20) DEFAULT NULL,
  `company_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;

INSERT INTO `drivers` (`driver_id`, `driver_first_name`, `driver_last_name`, `driver_phone_number`, `company_id`)
VALUES
	(1,'Adam','Bull','01727 764635',1);

/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table facilities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `facilities`;

CREATE TABLE `facilities` (
  `facility_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `facility_name` varchar(100) DEFAULT NULL,
  `facility_latitude` varchar(50) DEFAULT NULL,
  `facility_longitude` varchar(50) DEFAULT NULL,
  `facility_address1` varchar(100) DEFAULT NULL,
  `facility_address2` varchar(100) DEFAULT NULL,
  `facility_address3` varchar(100) DEFAULT NULL,
  `facility_locality` varchar(100) DEFAULT NULL,
  `facility_postcode` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`facility_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `facilities` WRITE;
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;

INSERT INTO `facilities` (`facility_id`, `facility_name`, `facility_latitude`, `facility_longitude`, `facility_address1`, `facility_address2`, `facility_address3`, `facility_locality`, `facility_postcode`)
VALUES
	(1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table membership
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membership`;

CREATE TABLE `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL,
  `membership_type_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mem_type_id` (`membership_type_id`),
  CONSTRAINT `fk_mem_type_id` FOREIGN KEY (`membership_type_id`) REFERENCES `membership_types` (`membership_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

LOCK TABLES `membership` WRITE;
/*!40000 ALTER TABLE `membership` DISABLE KEYS */;

INSERT INTO `membership` (`id`, `first_name`, `last_name`, `email_addres`, `user_name`, `pass_word`, `membership_type_id`)
VALUES
	(1,'Adam','Bull','adam@mbinteractive.co.uk','adaam','d74fdde2944f475adc4a85e349d4ee7b',1);

/*!40000 ALTER TABLE `membership` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table membership_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membership_types`;

CREATE TABLE `membership_types` (
  `membership_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `membership_type_name` varchar(50) DEFAULT NULL,
  `membership_type_description` longtext,
  PRIMARY KEY (`membership_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `membership_types` WRITE;
/*!40000 ALTER TABLE `membership_types` DISABLE KEYS */;

INSERT INTO `membership_types` (`membership_type_id`, `membership_type_name`, `membership_type_description`)
VALUES
	(1,'Receptionist','Part of the Reception role. Also known as \'Delivery Reception Staff\''),
	(2,'Administrative','Part of the Administration role. Also known as \'Admin Staff\''),
	(3,'Delivery Manager','Delivery Managers are superusers - i.e. they have full access to all of the functionality of the DMS');

/*!40000 ALTER TABLE `membership_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table supplier_companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supplier_companies`;

CREATE TABLE `supplier_companies` (
  `company_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL DEFAULT '',
  `company_address1` varchar(100) NOT NULL DEFAULT '',
  `company_address2` varchar(100) DEFAULT NULL,
  `company_address3` varchar(100) DEFAULT NULL,
  `company_locality` varchar(100) DEFAULT NULL,
  `company_postcode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `supplier_companies` WRITE;
/*!40000 ALTER TABLE `supplier_companies` DISABLE KEYS */;

INSERT INTO `supplier_companies` (`company_id`, `company_name`, `company_address1`, `company_address2`, `company_address3`, `company_locality`, `company_postcode`)
VALUES
	(1,'Test Company','21 St Stephens','','','St Albans','al3 4aa');

/*!40000 ALTER TABLE `supplier_companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vehicles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_registration` varchar(50) NOT NULL DEFAULT '',
  `vehicle_make` varchar(50) NOT NULL DEFAULT '',
  `vehicle_model` varchar(50) DEFAULT NULL,
  `vehicle_year_of_production` year(4) DEFAULT NULL,
  `company_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`vehicle_id`),
  KEY `fk_company_id` (`company_id`),
  CONSTRAINT `fk_company_id` FOREIGN KEY (`company_id`) REFERENCES `supplier_companies` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_registration`, `vehicle_make`, `vehicle_model`, `vehicle_year_of_production`, `company_id`)
VALUES
	(1,'AD55 GS0','VW','Polo','2005',1);

/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


```
