# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Database: afrad-master
# Generation Time: 2018-10-02 14:44:48 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activities`;

CREATE TABLE `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `object_id` int(10) unsigned NOT NULL,
  `ip` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_user_id_foreign` (`user_id`),
  CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(10) unsigned NOT NULL,
  `building_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `building_no` varchar(255) DEFAULT NULL,
  `additional_no` varchar(255) DEFAULT NULL,
  `po_box` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `coordinate` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_city_id_foreign` (`city_id`),
  CONSTRAINT `addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;

INSERT INTO `addresses` (`id`, `city_id`, `building_name`, `phone`, `fax`, `street`, `district`, `building_no`, `additional_no`, `po_box`, `zip_code`, `coordinate`, `description`, `created_at`, `updated_at`)
VALUES
	(1,1,'برج الطيبة',NULL,NULL,'الملك عبد الله','الزهور','20','2212','123456','12345','26.438117039815097, 50.12304312707522',NULL,'2017-12-12 01:20:13','2017-12-12 01:20:13');

/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table areas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `areas`;

CREATE TABLE `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `areas_area_unique` (`area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;

INSERT INTO `areas` (`id`, `area`, `created_at`, `updated_at`)
VALUES
	(1,'الشرقية','2017-12-12 01:19:23','2017-12-12 01:19:23');

/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table banks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banks`;

CREATE TABLE `banks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bank` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `banks_bank_unique` (`bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;

INSERT INTO `banks` (`id`, `bank`, `created_at`, `updated_at`)
VALUES
	(1,'الرجحي','2017-12-12 00:31:14','2017-12-12 00:31:14');

/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table beneficiaries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `beneficiaries`;

CREATE TABLE `beneficiaries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `national_number` varchar(255) NOT NULL,
  `nationality_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sex` varchar(255) NOT NULL DEFAULT 'ذكر',
  `dob` date DEFAULT NULL,
  `dob_hijri_day` int(11) DEFAULT NULL,
  `dob_hijri_month` int(11) DEFAULT NULL,
  `dob_hijri_year` int(11) DEFAULT NULL,
  `marital_status_id` int(10) unsigned DEFAULT NULL,
  `family_role_id` int(10) unsigned DEFAULT NULL,
  `family_member_count` int(11) DEFAULT NULL,
  `son_count` int(11) DEFAULT NULL,
  `daughter_count` int(11) DEFAULT NULL,
  `expertise_id` int(10) unsigned DEFAULT NULL,
  `social_status_id` int(10) unsigned DEFAULT NULL,
  `graduation_id` int(10) unsigned DEFAULT NULL,
  `education_specialty_id` int(10) unsigned DEFAULT NULL,
  `work_experience` varchar(255) DEFAULT NULL,
  `profession_id` int(10) unsigned DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_banned` tinyint(4) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `guardian_id` int(10) unsigned DEFAULT NULL,
  `social_type_id` int(10) unsigned DEFAULT NULL,
  `bank_id` int(10) unsigned DEFAULT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `address_id` int(10) unsigned DEFAULT NULL,
  `resident_id` int(10) unsigned DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beneficiaries_mobile_unique` (`mobile`),
  UNIQUE KEY `beneficiaries_national_number_unique` (`national_number`),
  KEY `beneficiaries_family_role_id_foreign` (`family_role_id`),
  KEY `beneficiaries_graduation_id_foreign` (`graduation_id`),
  KEY `beneficiaries_address_id_foreign` (`address_id`),
  KEY `beneficiaries_marital_status_id_foreign` (`marital_status_id`),
  KEY `beneficiaries_expertise_id_foreign` (`expertise_id`),
  KEY `beneficiaries_education_specialty_id_foreign` (`education_specialty_id`),
  KEY `beneficiaries_guardian_id_foreign` (`guardian_id`),
  KEY `beneficiaries_social_type_id_foreign` (`social_type_id`),
  KEY `beneficiaries_social_status_id_foreign` (`social_status_id`),
  KEY `beneficiaries_profession_id_foreign` (`profession_id`),
  KEY `beneficiaries_nationality_id_foreign` (`nationality_id`),
  KEY `beneficiaries_resident_id_foreign` (`resident_id`),
  CONSTRAINT `beneficiaries_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  CONSTRAINT `beneficiaries_education_specialty_id_foreign` FOREIGN KEY (`education_specialty_id`) REFERENCES `education_specialties` (`id`),
  CONSTRAINT `beneficiaries_expertise_id_foreign` FOREIGN KEY (`expertise_id`) REFERENCES `expertises` (`id`),
  CONSTRAINT `beneficiaries_family_role_id_foreign` FOREIGN KEY (`family_role_id`) REFERENCES `family_roles` (`id`),
  CONSTRAINT `beneficiaries_graduation_id_foreign` FOREIGN KEY (`graduation_id`) REFERENCES `graduations` (`id`),
  CONSTRAINT `beneficiaries_guardian_id_foreign` FOREIGN KEY (`guardian_id`) REFERENCES `guardians` (`id`),
  CONSTRAINT `beneficiaries_marital_status_id_foreign` FOREIGN KEY (`marital_status_id`) REFERENCES `marital_statuses` (`id`),
  CONSTRAINT `beneficiaries_nationality_id_foreign` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`),
  CONSTRAINT `beneficiaries_profession_id_foreign` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`),
  CONSTRAINT `beneficiaries_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`),
  CONSTRAINT `beneficiaries_social_status_id_foreign` FOREIGN KEY (`social_status_id`) REFERENCES `social_statuses` (`id`),
  CONSTRAINT `beneficiaries_social_type_id_foreign` FOREIGN KEY (`social_type_id`) REFERENCES `social_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `beneficiaries` WRITE;
/*!40000 ALTER TABLE `beneficiaries` DISABLE KEYS */;

INSERT INTO `beneficiaries` (`id`, `name`, `parent_id`, `mobile`, `phone`, `national_number`, `nationality_id`, `email`, `sex`, `dob`, `dob_hijri_day`, `dob_hijri_month`, `dob_hijri_year`, `marital_status_id`, `family_role_id`, `family_member_count`, `son_count`, `daughter_count`, `expertise_id`, `social_status_id`, `graduation_id`, `education_specialty_id`, `work_experience`, `profession_id`, `company_name`, `is_active`, `is_banned`, `ban_reason`, `avatar`, `guardian_id`, `social_type_id`, `bank_id`, `iban`, `address_id`, `resident_id`, `notes`, `created_at`, `updated_at`)
VALUES
	(1,'محمد أبو حميدة الجاوي',NULL,'0503400178','01233','2429577709',1,'dheasetia@gmail.com','ذكر','2009-01-19',22,1,1430,1,1,12,6,6,1,NULL,1,1,'تجربية بسيبسيب بيسشب',1,'مؤسسة بالحمر الخيرية',1,0,NULL,'1513137165_IMG_4972.jpg',1,NULL,1,'SA2345678423322444444432',1,1,NULL,'2017-12-12 00:31:29','2018-02-01 02:21:51'),
	(2,'خلال بن عبد الله الخلال',NULL,'0500757705',NULL,'1022969123',1,NULL,'ذكر','2016-09-13',12,12,1437,1,1,12,3,9,1,NULL,1,1,NULL,1,NULL,1,0,NULL,NULL,2,NULL,1,NULL,NULL,NULL,NULL,'2018-07-26 16:35:26','2018-07-26 16:35:26');

/*!40000 ALTER TABLE `beneficiaries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cities_city_unique` (`city`),
  KEY `cities_area_id_foreign` (`area_id`),
  CONSTRAINT `cities_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;

INSERT INTO `cities` (`id`, `city`, `area_id`, `created_at`, `updated_at`)
VALUES
	(1,'الدمام',1,'2017-12-12 01:19:25','2017-12-12 01:19:25');

/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_department_unique` (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;

INSERT INTO `departments` (`id`, `department`, `created_at`, `updated_at`)
VALUES
	(1,'الحاسب الآلي','2017-12-05 03:20:43','2017-12-05 03:20:43'),
	(2,'مجموعة بالحمر القابضة','2018-01-29 04:13:04','2018-01-29 04:13:04');

/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table distribution_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `distribution_items`;

CREATE TABLE `distribution_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seq_num` int(11) DEFAULT NULL,
  `distribution_id` int(10) unsigned NOT NULL,
  `is_money` int(11) NOT NULL DEFAULT '1',
  `item_id` int(10) unsigned NOT NULL,
  `cost` double NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '1',
  `subtotal` double NOT NULL DEFAULT '0',
  `is_received` tinyint(4) NOT NULL DEFAULT '0',
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `distribution_items_distribution_id_foreign` (`distribution_id`),
  KEY `distribution_items_item_id_foreign` (`item_id`),
  CONSTRAINT `distribution_items_distribution_id_foreign` FOREIGN KEY (`distribution_id`) REFERENCES `distributions` (`id`),
  CONSTRAINT `distribution_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table distribution_kinds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `distribution_kinds`;

CREATE TABLE `distribution_kinds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kind` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `distribution_kinds_kind_unique` (`kind`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `distribution_kinds` WRITE;
/*!40000 ALTER TABLE `distribution_kinds` DISABLE KEYS */;

INSERT INTO `distribution_kinds` (`id`, `kind`, `created_at`, `updated_at`)
VALUES
	(1,'سداد ايجار','2018-02-04 09:39:07','2018-02-04 09:39:07');

/*!40000 ALTER TABLE `distribution_kinds` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table distribution_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `distribution_types`;

CREATE TABLE `distribution_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `distribution_types_type_unique` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table distributions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `distributions`;

CREATE TABLE `distributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `distribution_kind_id` int(10) unsigned NOT NULL,
  `beneficiary_id` int(10) unsigned NOT NULL,
  `distribution_date` date NOT NULL,
  `distribution_time` time DEFAULT NULL,
  `distribution_hijri_day` int(11) NOT NULL,
  `distribution_hijri_month` int(11) NOT NULL,
  `distribution_hijri_year` int(11) NOT NULL,
  `distribution_type_id` int(10) unsigned DEFAULT NULL,
  `distribution_file` varchar(255) DEFAULT NULL,
  `transfer_file` varchar(255) DEFAULT NULL,
  `receipt_file` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `is_periodic` tinyint(4) NOT NULL DEFAULT '1',
  `city_id` int(10) unsigned DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `distributions_city_id_foreign` (`city_id`),
  KEY `distributions_distribution_kind_id_foreign` (`distribution_kind_id`),
  CONSTRAINT `distributions_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `distributions_distribution_kind_id_foreign` FOREIGN KEY (`distribution_kind_id`) REFERENCES `distribution_kinds` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `distributions` WRITE;
/*!40000 ALTER TABLE `distributions` DISABLE KEYS */;

INSERT INTO `distributions` (`id`, `distribution_kind_id`, `beneficiary_id`, `distribution_date`, `distribution_time`, `distribution_hijri_day`, `distribution_hijri_month`, `distribution_hijri_year`, `distribution_type_id`, `distribution_file`, `transfer_file`, `receipt_file`, `place`, `is_periodic`, `city_id`, `amount`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'2018-02-03',NULL,17,5,1439,NULL,NULL,NULL,NULL,'حي القادسية',0,1,NULL,'2018-02-04 09:39:50','2018-02-04 09:39:50'),
	(2,1,1,'2018-02-04',NULL,18,5,1439,NULL,NULL,NULL,NULL,'الجبيل',1,1,NULL,'2018-02-05 12:35:39','2018-02-05 12:35:39');

/*!40000 ALTER TABLE `distributions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table documents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `beneficiary_id` int(10) unsigned NOT NULL,
  `document_type_id` int(10) unsigned DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `expiry_hijri_day` int(11) DEFAULT NULL,
  `expiry_hijri_month` int(11) DEFAULT NULL,
  `expiry_hijri_year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_beneficiary_id_foreign` (`beneficiary_id`),
  CONSTRAINT `documents_beneficiary_id_foreign` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;

INSERT INTO `documents` (`id`, `label`, `path`, `beneficiary_id`, `document_type_id`, `extension`, `expiry_date`, `expiry_hijri_day`, `expiry_hijri_month`, `expiry_hijri_year`, `created_at`, `updated_at`)
VALUES
	(1,'عقد إيجار','1517390729_عقد ايجار.JPG',1,NULL,'','2018-08-25',14,12,1439,'2018-02-01 02:25:29','2018-02-01 02:25:29'),
	(3,'سجل الأسرة','1517722950_1328219444.png',1,NULL,'','2018-02-04',18,5,1439,'2018-02-04 22:42:30','2018-02-04 22:42:30');

/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table education_specialties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `education_specialties`;

CREATE TABLE `education_specialties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `specialty` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `education_specialties_specialty_unique` (`specialty`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `education_specialties` WRITE;
/*!40000 ALTER TABLE `education_specialties` DISABLE KEYS */;

INSERT INTO `education_specialties` (`id`, `specialty`, `created_at`, `updated_at`)
VALUES
	(1,'كمبيوتر','2017-12-12 00:29:55','2017-12-12 00:29:55');

/*!40000 ALTER TABLE `education_specialties` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table employees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `job_id` int(10) unsigned NOT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_mobile_unique` (`mobile`),
  UNIQUE KEY `employees_email_unique` (`email`),
  KEY `employees_job_id_foreign` (`job_id`),
  KEY `employees_department_id_foreign` (`department_id`),
  CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `employees_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;

INSERT INTO `employees` (`id`, `name`, `mobile`, `email`, `department_id`, `job_id`, `notes`, `created_at`, `updated_at`)
VALUES
	(1,'د. خالد عبد الله العميري','0500000000','kaomairi55@gmail.com',1,3,NULL,'2017-12-12 14:00:00','2017-12-12 14:00:00'),
	(2,'سعد المهنا','0555555555','smohanna@gmail.com',1,4,NULL,'2017-12-12 14:00:00','2017-12-12 14:00:00');

/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table expense_research
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expense_research`;

CREATE TABLE `expense_research` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_id` int(10) unsigned NOT NULL,
  `research_id` int(10) unsigned NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_research_expense_id_foreign` (`expense_id`),
  KEY `expense_research_research_id_foreign` (`research_id`),
  CONSTRAINT `expense_research_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`),
  CONSTRAINT `expense_research_research_id_foreign` FOREIGN KEY (`research_id`) REFERENCES `researches` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `expense_research` WRITE;
/*!40000 ALTER TABLE `expense_research` DISABLE KEYS */;

INSERT INTO `expense_research` (`id`, `expense_id`, `research_id`, `amount`, `created_at`, `updated_at`)
VALUES
	(1,2,4,200,'2018-02-03 23:06:32','2018-02-03 23:06:32'),
	(2,1,5,1200,'2018-02-04 09:36:41','2018-02-04 09:36:41'),
	(3,2,5,250,'2018-02-04 09:36:41','2018-02-04 09:36:41'),
	(4,3,5,400,'2018-02-04 09:36:41','2018-02-04 09:36:41');

/*!40000 ALTER TABLE `expense_research` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table expenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expenses_expense_unique` (`expense`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;

INSERT INTO `expenses` (`id`, `expense`, `created_at`, `updated_at`)
VALUES
	(1,'إيجار','2018-02-01 02:32:48','2018-02-01 02:32:48'),
	(2,'كهرباء','2018-02-01 02:33:12','2018-02-01 02:33:12'),
	(3,'مواد غذائية','2018-02-03 02:40:02','2018-02-03 02:40:02');

/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table expertises
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expertises`;

CREATE TABLE `expertises` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expertise` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expertises_expertise_unique` (`expertise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `expertises` WRITE;
/*!40000 ALTER TABLE `expertises` DISABLE KEYS */;

INSERT INTO `expertises` (`id`, `expertise`, `created_at`, `updated_at`)
VALUES
	(1,'البرمجة','2017-12-12 00:30:09','2017-12-12 00:30:09');

/*!40000 ALTER TABLE `expertises` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table family_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `family_roles`;

CREATE TABLE `family_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `family_roles_role_unique` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `family_roles` WRITE;
/*!40000 ALTER TABLE `family_roles` DISABLE KEYS */;

INSERT INTO `family_roles` (`id`, `role`, `created_at`, `updated_at`)
VALUES
	(1,'ابن','2017-12-12 00:28:24','2017-12-12 00:28:24');

/*!40000 ALTER TABLE `family_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table graduations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `graduations`;

CREATE TABLE `graduations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `graduation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `graduations_graduation_unique` (`graduation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `graduations` WRITE;
/*!40000 ALTER TABLE `graduations` DISABLE KEYS */;

INSERT INTO `graduations` (`id`, `graduation`, `created_at`, `updated_at`)
VALUES
	(1,'ثانوي','2017-12-12 00:29:43','2017-12-12 00:29:43');

/*!40000 ALTER TABLE `graduations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guardians
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guardians`;

CREATE TABLE `guardians` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guardians_mobile_unique` (`mobile`),
  UNIQUE KEY `guardians_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `guardians` WRITE;
/*!40000 ALTER TABLE `guardians` DISABLE KEYS */;

INSERT INTO `guardians` (`id`, `name`, `mobile`, `phone`, `email`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'خالد العميري','0503400178',NULL,'kaomairi@gmail.com','صديق أمين','2017-12-12 00:31:03','2017-12-12 00:31:03'),
	(2,'أبو حميدل','0503400189',NULL,'hamid@holl.com','زميل','2018-07-26 16:34:52','2018-07-26 16:34:52');

/*!40000 ALTER TABLE `guardians` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table health_conditions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `health_conditions`;

CREATE TABLE `health_conditions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `condition` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `health_conditions_condition_unique` (`condition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table income_research
# ------------------------------------------------------------

DROP TABLE IF EXISTS `income_research`;

CREATE TABLE `income_research` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `income_id` int(10) unsigned NOT NULL,
  `research_id` int(10) unsigned NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_research_income_id_foreign` (`income_id`),
  KEY `income_research_research_id_foreign` (`research_id`),
  CONSTRAINT `income_research_income_id_foreign` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`id`),
  CONSTRAINT `income_research_research_id_foreign` FOREIGN KEY (`research_id`) REFERENCES `researches` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `income_research` WRITE;
/*!40000 ALTER TABLE `income_research` DISABLE KEYS */;

INSERT INTO `income_research` (`id`, `income_id`, `research_id`, `amount`, `created_at`, `updated_at`)
VALUES
	(1,2,4,500,'2018-02-03 23:06:32','2018-02-03 23:06:32'),
	(2,1,5,2500,'2018-02-04 09:36:41','2018-02-04 09:36:41'),
	(3,2,5,500,'2018-02-04 09:36:41','2018-02-04 09:36:41');

/*!40000 ALTER TABLE `income_research` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table incomes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `incomes`;

CREATE TABLE `incomes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `income` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `incomes_income_unique` (`income`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `incomes` WRITE;
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;

INSERT INTO `incomes` (`id`, `income`, `created_at`, `updated_at`)
VALUES
	(1,'راتب تقاعد','2018-02-01 02:31:18','2018-02-01 02:31:18'),
	(2,'فاعل خير','2018-02-01 02:32:19','2018-02-01 02:32:19');

/*!40000 ALTER TABLE `incomes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table item_need_research
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item_need_research`;

CREATE TABLE `item_need_research` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_need_id` int(10) unsigned NOT NULL,
  `research_id` int(10) unsigned NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '1',
  `cost` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_need_research_item_need_id_foreign` (`item_need_id`),
  KEY `item_need_research_research_id_foreign` (`research_id`),
  CONSTRAINT `item_need_research_item_need_id_foreign` FOREIGN KEY (`item_need_id`) REFERENCES `item_needs` (`id`),
  CONSTRAINT `item_need_research_research_id_foreign` FOREIGN KEY (`research_id`) REFERENCES `researches` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `item_need_research` WRITE;
/*!40000 ALTER TABLE `item_need_research` DISABLE KEYS */;

INSERT INTO `item_need_research` (`id`, `item_need_id`, `research_id`, `price`, `quantity`, `cost`, `created_at`, `updated_at`)
VALUES
	(1,2,4,500,2,1,'2018-02-03 23:06:32','2018-02-03 23:06:32'),
	(2,2,5,1800,1,0,'2018-02-04 09:36:41','2018-02-04 09:36:41'),
	(3,3,5,1400,1,0,'2018-02-04 09:36:41','2018-02-04 09:36:41'),
	(4,1,5,1200,2,0,'2018-02-04 09:36:41','2018-02-04 09:36:41');

/*!40000 ALTER TABLE `item_need_research` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table item_needs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item_needs`;

CREATE TABLE `item_needs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_needs_item_unique` (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `item_needs` WRITE;
/*!40000 ALTER TABLE `item_needs` DISABLE KEYS */;

INSERT INTO `item_needs` (`id`, `item`, `created_at`, `updated_at`)
VALUES
	(1,'مكيف','2018-02-01 02:34:59','2018-02-01 02:34:59'),
	(2,'ثلاجة','2018-02-01 02:35:26','2018-02-01 02:35:26'),
	(3,'فرن','2018-02-01 02:35:55','2018-02-01 02:35:55');

/*!40000 ALTER TABLE `item_needs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `items_item_unique` (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;

INSERT INTO `items` (`id`, `item`, `created_at`, `updated_at`)
VALUES
	(1,'سداد ايجار','2018-02-04 09:40:15','2018-02-04 09:40:15');

/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jobs_job_unique` (`job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;

INSERT INTO `jobs` (`id`, `job`, `created_at`, `updated_at`)
VALUES
	(1,'مبرمج','2017-12-05 03:20:36','2017-12-05 03:20:36'),
	(2,'المساندة','2017-12-12 00:23:08','2017-12-12 00:23:08'),
	(3,'مدير المشاريع المنح','2017-12-12 14:00:00','2017-12-12 14:00:00'),
	(4,'الأمين العام','2017-12-12 14:00:00','2017-12-12 14:00:00'),
	(5,'سكرتير المدير التنفيذي','2018-01-29 04:12:41','2018-01-29 04:12:41');

/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table marital_statuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `marital_statuses`;

CREATE TABLE `marital_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `marital_statuses_status_unique` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `marital_statuses` WRITE;
/*!40000 ALTER TABLE `marital_statuses` DISABLE KEYS */;

INSERT INTO `marital_statuses` (`id`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'متزوج','2017-12-12 00:28:07','2017-12-12 00:28:07'),
	(2,'مطلقة','2018-07-26 17:08:30','2018-07-26 17:08:30'),
	(3,'أعزب','2018-07-26 17:08:53','2018-07-26 17:08:53');

/*!40000 ALTER TABLE `marital_statuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2017_08_20_092734_create_cities_table',1),
	(4,'2017_08_20_092810_create_beneficiaries_table',1),
	(5,'2017_08_20_111355_create_family_roles_table',1),
	(6,'2017_08_20_111411_create_jobs_table',1),
	(7,'2017_08_20_111607_create_graduations_table',1),
	(8,'2017_08_20_111657_create_specialties_table',1),
	(9,'2017_08_20_111719_create_documents_table',1),
	(10,'2017_08_20_111731_create_banks_table',1),
	(11,'2017_08_20_111745_create_distributions_table',1),
	(12,'2017_08_20_111847_create_periodic_distributions_table',1),
	(13,'2017_08_20_111916_create_areas_table',1),
	(14,'2017_09_16_103352_create_distribution_items_table',1),
	(15,'2017_09_16_103411_create_items_table',1),
	(16,'2017_09_16_103946_create_addresses_table',1),
	(17,'2017_09_16_140836_create_marital_statuses_table',1),
	(18,'2017_09_16_141032_create_expertises_table',1),
	(19,'2017_09_16_141141_create_poverty_levels_table',1),
	(20,'2017_09_16_141308_create_education_specialties_table',1),
	(21,'2017_09_16_141521_create_guardians_table',1),
	(22,'2017_09_16_141602_create_employees_table',1),
	(23,'2017_09_16_215245_create_department_table',1),
	(24,'2017_09_16_222658_create_social_types_table',1),
	(25,'2017_09_16_232124_create_distribution_kinds_table',1),
	(26,'2017_09_17_131257_create_distribution_types_table',1),
	(27,'2017_09_27_221535_create_social_statuses_table',1),
	(28,'2017_09_28_184431_create_incomes_table',1),
	(29,'2017_09_28_185148_create_income_research_table',1),
	(30,'2017_09_28_185309_create_expenses_table',1),
	(31,'2017_09_28_185429_create_expense_research_table',1),
	(32,'2017_09_28_185435_create_researches_table',1),
	(33,'2017_09_28_185657_create_item_needs_table',1),
	(34,'2017_09_28_185660_create_money_needs_table',1),
	(35,'2017_09_28_220948_create_item_need_research_table',1),
	(36,'2017_09_28_221040_create_money_need_research_table',1),
	(37,'2017_09_30_113219_create_professions_table',1),
	(38,'2017_10_01_110257_create_nationalities_table',1),
	(39,'2017_10_03_133129_create_permission_tables',1),
	(40,'2017_10_04_233737_create_activities_table',1),
	(41,'2017_10_31_113342_create_settings_table',1),
	(42,'2017_11_02_102000_create_research_kinds_table',1),
	(43,'2017_11_16_055900_create_health_conditions_table',1),
	(44,'2017_11_16_055952_create_resident_kinds_table',1),
	(45,'2017_11_16_112847_create_residents_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table models
# ------------------------------------------------------------

DROP TABLE IF EXISTS `models`;

CREATE TABLE `models` (
  `model_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `permission_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;

INSERT INTO `models` (`model_id`, `model_type`, `role_id`, `permission_id`, `created_at`, `updated_at`)
VALUES
	(1,'App\\User',1,NULL,NULL,NULL),
	(2,'App\\User',1,NULL,NULL,NULL),
	(5,'App\\User',1,NULL,NULL,NULL);

/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table money_need_research
# ------------------------------------------------------------

DROP TABLE IF EXISTS `money_need_research`;

CREATE TABLE `money_need_research` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `money_need_id` int(10) unsigned NOT NULL,
  `research_id` int(10) unsigned NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `money_need_research_money_need_id_foreign` (`money_need_id`),
  KEY `money_need_research_research_id_foreign` (`research_id`),
  CONSTRAINT `money_need_research_money_need_id_foreign` FOREIGN KEY (`money_need_id`) REFERENCES `money_needs` (`id`),
  CONSTRAINT `money_need_research_research_id_foreign` FOREIGN KEY (`research_id`) REFERENCES `researches` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `money_need_research` WRITE;
/*!40000 ALTER TABLE `money_need_research` DISABLE KEYS */;

INSERT INTO `money_need_research` (`id`, `money_need_id`, `research_id`, `amount`, `created_at`, `updated_at`)
VALUES
	(1,2,4,1200,'2018-02-03 23:06:32','2018-02-03 23:06:32'),
	(2,2,5,2400,'2018-02-04 09:36:41','2018-02-04 09:36:41');

/*!40000 ALTER TABLE `money_need_research` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table money_needs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `money_needs`;

CREATE TABLE `money_needs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `money_needs_description_unique` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `money_needs` WRITE;
/*!40000 ALTER TABLE `money_needs` DISABLE KEYS */;

INSERT INTO `money_needs` (`id`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'مكيف','2018-02-01 02:33:54','2018-02-01 02:33:54'),
	(2,'متأخرات إيجار','2018-02-01 02:34:28','2018-02-01 02:34:28');

/*!40000 ALTER TABLE `money_needs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table nationalities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nationalities`;

CREATE TABLE `nationalities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nationality` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nationalities_nationality_unique` (`nationality`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `nationalities` WRITE;
/*!40000 ALTER TABLE `nationalities` DISABLE KEYS */;

INSERT INTO `nationalities` (`id`, `nationality`, `created_at`, `updated_at`)
VALUES
	(1,'سعودي','2017-12-12 00:29:17','2017-12-12 00:29:17');

/*!40000 ALTER TABLE `nationalities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table periodic_distributions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `periodic_distributions`;

CREATE TABLE `periodic_distributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `beneficiary_id` int(10) unsigned NOT NULL,
  `distribution_type_id` int(10) unsigned NOT NULL,
  `distribution_date` date NOT NULL,
  `distribution_hijri_day` int(11) NOT NULL,
  `distribution_hijri_month` int(11) NOT NULL,
  `distribution_hijri_year` int(11) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `periodic_distributions_beneficiary_id_foreign` (`beneficiary_id`),
  KEY `periodic_distributions_distribution_type_id_foreign` (`distribution_type_id`),
  CONSTRAINT `periodic_distributions_beneficiary_id_foreign` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`),
  CONSTRAINT `periodic_distributions_distribution_type_id_foreign` FOREIGN KEY (`distribution_type_id`) REFERENCES `periodic_distributions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `guard_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  UNIQUE KEY `permissions_label_unique` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `label`, `guard_name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'see_dashboard','مشاهدة الصفحة الرئيسية','web',NULL,'2017-12-02 08:57:57','2017-12-02 08:57:57'),
	(2,'see_beneficiaries','مشاهدة قائمة المستفيدين','web',NULL,'2017-12-02 08:57:57','2017-12-02 08:57:57'),
	(3,'see_beneficiary','مشاهدة تفاصيل بيانات مستفيد','web',NULL,'2017-12-02 08:57:57','2017-12-02 08:57:57'),
	(4,'add_beneficiary','إضافة مستفيد','web',NULL,'2017-12-02 08:57:57','2017-12-02 08:57:57'),
	(5,'delete_beneficiary','حذف مستفيد','web',NULL,'2017-12-02 08:57:57','2017-12-02 08:57:57'),
	(6,'edit_beneficiary','تعديل بيانات مستفيد','web',NULL,'2017-12-03 03:18:23','2017-12-03 03:18:23'),
	(7,'add_research','إضافة دراسة حالة','web',NULL,'2017-12-03 00:49:19','2017-12-03 00:49:19'),
	(8,'see_researches','مشاهدة البحوث الاجتماععية','web','','2017-12-03 01:39:31','2017-12-03 01:39:31'),
	(9,'see_research','مشاهدة تفاصيل بحث اجتماعي معين','web',NULL,'2017-12-03 02:39:23','2017-12-03 03:18:26'),
	(11,'edit_research','تعديل بيانات دراسة حالة','web',NULL,'2017-12-03 02:40:39','2017-12-03 02:40:39'),
	(12,'delete_research','حذف داسة حالة','web',NULL,'2017-12-03 02:41:01','2017-12-03 02:41:01'),
	(13,'see_distributions','مشاهدة مساعدات','web',NULL,'2017-12-03 03:05:40','2017-12-03 03:05:40'),
	(14,'see_distribution','مشاهدة تفاصيل مساعدة','web',NULL,'2017-12-03 03:06:12','2017-12-03 03:06:12'),
	(15,'add_distribution','إضافة صرف مساعدة','web',NULL,'2017-12-03 03:06:36','2017-12-03 03:06:36'),
	(16,'edit_distribution','تعديل بيانات صرف مساعدة','web',NULL,'2017-12-03 03:06:59','2017-12-03 03:06:59'),
	(17,'delete_distribution','حذف بيانات صرف مساعدة','web',NULL,'2017-12-03 03:07:21','2017-12-03 03:07:21'),
	(18,'see_users','مشاهدة قائمة المستخدمين','web',NULL,'2017-12-03 03:07:46','2017-12-03 03:07:46'),
	(19,'see_user','مشاهدة تفاصيل مستخدم','web',NULL,'2017-12-03 03:08:05','2017-12-03 03:08:05'),
	(20,'add_user','إضافة مستخدم','web',NULL,'2017-12-03 03:08:23','2017-12-03 03:08:23'),
	(21,'edit_user','تعديل بيانات مستخدم','web',NULL,'2017-12-03 03:08:37','2017-12-03 03:08:37'),
	(22,'delete_user','حذف مستخدم','web',NULL,'2017-12-03 03:09:01','2017-12-03 03:09:01'),
	(23,'see_roles','مشاهدة قائمة مجموعات المستخدمين','web',NULL,'2017-12-03 03:09:54','2017-12-03 03:09:54'),
	(24,'see_role','مشاهدة تفاصيل مجموعة مستخدم','web',NULL,'2017-12-03 03:10:23','2017-12-03 03:10:23'),
	(25,'add_role','إضافة مجموعة مستخدم جديد','web',NULL,'2017-12-03 03:11:09','2017-12-03 03:11:09'),
	(26,'edit_role','تعديل مجموعة مستخدم','web',NULL,'2017-12-03 03:11:32','2017-12-03 03:11:32'),
	(27,'delete_role','حذف مجموعة مستخدم','web',NULL,'2017-12-03 03:11:54','2017-12-03 03:11:54');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table poverty_levels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `poverty_levels`;

CREATE TABLE `poverty_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table professions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `professions`;

CREATE TABLE `professions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profession` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `professions_profession_unique` (`profession`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `professions` WRITE;
/*!40000 ALTER TABLE `professions` DISABLE KEYS */;

INSERT INTO `professions` (`id`, `profession`, `created_at`, `updated_at`)
VALUES
	(1,'مبرمج','2017-12-12 00:30:01','2017-12-12 00:30:01');

/*!40000 ALTER TABLE `professions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table research_kinds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `research_kinds`;

CREATE TABLE `research_kinds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kind` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `research_kinds` WRITE;
/*!40000 ALTER TABLE `research_kinds` DISABLE KEYS */;

INSERT INTO `research_kinds` (`id`, `kind`, `created_at`, `updated_at`)
VALUES
	(1,'كبير في السن و عاجز عن العمل','2018-02-01 02:30:21','2018-02-01 02:30:21');

/*!40000 ALTER TABLE `research_kinds` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table researches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `researches`;

CREATE TABLE `researches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `research_kind_id` int(10) unsigned NOT NULL,
  `beneficiary_id` int(10) unsigned NOT NULL,
  `health_condition_id` int(10) unsigned DEFAULT NULL,
  `health_description` text,
  `project_manager_id` int(10) unsigned DEFAULT NULL,
  `employee_research_name` varchar(255) DEFAULT NULL,
  `director_research_name` varchar(255) DEFAULT NULL,
  `researcher_id` int(10) unsigned DEFAULT NULL,
  `general_manager_id` int(10) unsigned DEFAULT NULL,
  `research_date` date DEFAULT NULL,
  `hijri_research_day` int(11) DEFAULT NULL,
  `hijri_research_month` int(11) DEFAULT NULL,
  `hijri_research_year` int(11) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `completed` int(11) NOT NULL DEFAULT '0',
  `researcher_recommendation` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `researches_researcher_id_foreign` (`researcher_id`),
  KEY `researches_research_kind_id_foreign` (`research_kind_id`),
  KEY `researches_health_condition_id_foreign` (`health_condition_id`),
  CONSTRAINT `researches_health_condition_id_foreign` FOREIGN KEY (`health_condition_id`) REFERENCES `health_conditions` (`id`),
  CONSTRAINT `researches_research_kind_id_foreign` FOREIGN KEY (`research_kind_id`) REFERENCES `research_kinds` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `researches` WRITE;
/*!40000 ALTER TABLE `researches` DISABLE KEYS */;

INSERT INTO `researches` (`id`, `research_kind_id`, `beneficiary_id`, `health_condition_id`, `health_description`, `project_manager_id`, `employee_research_name`, `director_research_name`, `researcher_id`, `general_manager_id`, `research_date`, `hijri_research_day`, `hijri_research_month`, `hijri_research_year`, `place`, `completed`, `researcher_recommendation`, `created_at`, `updated_at`)
VALUES
	(1,1,1,NULL,NULL,NULL,'تجربة','تجربة',1,NULL,'2018-02-03',17,5,1439,'المدينة',0,'تجربة','2018-02-03 23:01:57','2018-02-03 23:01:57'),
	(2,1,1,NULL,NULL,NULL,'تجربة','تجربة',1,NULL,'2018-02-03',17,5,1439,'المدينة',0,'تجربة','2018-02-03 23:05:06','2018-02-03 23:05:06'),
	(3,1,1,NULL,NULL,NULL,'تجربة','تجربة',1,NULL,'2018-02-03',17,5,1439,'المدينة',0,'تجربة','2018-02-03 23:05:13','2018-02-03 23:05:13'),
	(4,1,1,NULL,NULL,NULL,'تجربة','تجربة',1,NULL,'2018-02-03',17,5,1439,'المدينة',0,'تجربة','2018-02-03 23:06:32','2018-02-03 23:06:32'),
	(5,1,1,NULL,NULL,NULL,'تجربة','تجربة',2,NULL,'2018-02-03',17,5,1439,'الدمام',0,'حالة المستفيد ضعيفة جدا وهو عاجز عن العمل و لا يوجد لديه أبناء يعملون ، أوصي بسداد إيجار المستفيد لمدة ستة أشهر و تقديم المساعدة له بالأجهزة الكهربائية','2018-02-04 09:36:41','2018-02-04 09:36:41');

/*!40000 ALTER TABLE `researches` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table resident_kinds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `resident_kinds`;

CREATE TABLE `resident_kinds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kind` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resident_kinds_kind_unique` (`kind`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `resident_kinds` WRITE;
/*!40000 ALTER TABLE `resident_kinds` DISABLE KEYS */;

INSERT INTO `resident_kinds` (`id`, `kind`, `created_at`, `updated_at`)
VALUES
	(1,'إيجار','2018-02-01 02:19:57','2018-02-01 02:19:57');

/*!40000 ALTER TABLE `resident_kinds` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table residents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `residents`;

CREATE TABLE `residents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resident_kind_id` int(10) unsigned NOT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `responsible_person` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `bank_id` varchar(255) DEFAULT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `payment_way` varchar(255) DEFAULT NULL,
  `annually_cost` double DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `residents_resident_kind_id_foreign` (`resident_kind_id`),
  CONSTRAINT `residents_resident_kind_id_foreign` FOREIGN KEY (`resident_kind_id`) REFERENCES `resident_kinds` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `residents` WRITE;
/*!40000 ALTER TABLE `residents` DISABLE KEYS */;

INSERT INTO `residents` (`id`, `resident_kind_id`, `owner`, `responsible_person`, `phone`, `fax`, `email`, `mobile`, `bank_id`, `iban`, `payment_way`, `annually_cost`, `description`, `created_at`, `updated_at`)
VALUES
	(1,1,'مكتب الشموخ العقاري','خالد عبدالله سعد','8080800','8888745',NULL,'0500000000','1','SA1280000512608010073469','تحويل',24000,NULL,'2018-02-01 02:21:51','2018-02-01 02:21:51');

/*!40000 ALTER TABLE `residents` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
VALUES
	(1,1),
	(2,1),
	(3,1),
	(4,1),
	(5,1),
	(6,1),
	(7,1),
	(8,1),
	(9,1),
	(11,1),
	(12,1),
	(13,1),
	(14,1),
	(15,1),
	(16,1),
	(17,1),
	(18,1),
	(19,1),
	(20,1),
	(21,1),
	(22,1),
	(23,1),
	(24,1),
	(25,1),
	(26,1),
	(27,1),
	(1,2),
	(2,2),
	(3,2),
	(4,2),
	(5,2),
	(6,2),
	(7,2),
	(8,2),
	(9,2),
	(11,2),
	(12,2),
	(13,2),
	(16,2);

/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `guard_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_label_unique` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `label`, `guard_name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'admin','آدمن','web','administrator','2017-12-05 03:20:01','2017-12-05 03:20:01'),
	(2,'member','مستخدم عادي','web','صلاحية عادي','2017-12-11 05:34:38','2017-12-11 05:34:38');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_research_name` varchar(255) DEFAULT NULL,
  `director_research_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `employee_research_name`, `director_research_name`)
VALUES
	(1,'2018-02-03 14:00:00','2018-02-03 23:06:32','تجربة','تجربة'),
	(2,'2018-02-03 14:00:00','2018-02-03 14:00:00',NULL,NULL);

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table social_statuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `social_statuses`;

CREATE TABLE `social_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `social_statuses_status_unique` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table social_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `social_types`;

CREATE TABLE `social_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `social_types_type_unique` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table specialties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `specialties`;

CREATE TABLE `specialties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `specialty` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `specialties_specialty_unique` (`specialty`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_has_permissions`;

CREATE TABLE `user_has_permissions` (
  `id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`permission_id`),
  KEY `user_has_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `user_has_permissions_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user_has_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_has_roles`;

CREATE TABLE `user_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`id`),
  KEY `user_has_roles_id_foreign` (`id`),
  CONSTRAINT `user_has_roles_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `job_id` int(10) unsigned NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_banned` tinyint(4) NOT NULL DEFAULT '0',
  `phone` varchar(255) DEFAULT NULL,
  `ext` varchar(255) DEFAULT NULL,
  `address_id` int(10) unsigned DEFAULT NULL,
  `last_ip` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_unique` (`mobile`),
  KEY `users_job_id_foreign` (`job_id`),
  CONSTRAINT `users_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `job_id`, `department_id`, `mobile`, `is_active`, `is_banned`, `phone`, `ext`, `address_id`, `last_ip`, `last_login`, `avatar`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'محمد حامد علوي','dheasetia@gmail.com','$2y$10$CJ772oe18Jz4qh12koaO0OBJXjpNp0FZTcOmq9JEQLybjUstMTZWS',2,1,'0503400178',1,0,NULL,NULL,NULL,NULL,NULL,'1532151945_WhatsApp Image 2018-02-02 at 11.06.19.jpeg','k12e5fPdDOZX6Q2ENhJGTav8gyRFw5k33pa0KPUhBTW9a703Sibxk5JgXTrO','2017-12-05 03:20:46','2018-07-21 08:45:57'),
	(2,'د. خالد عبد الله العميري','kaomairi.55@gmail.com','$2y$10$GSIr2C.OndEFM.CEhZ/uxeMYUMYsA02I3YgmBqARHmNLzFbIYwrDC',1,1,'0556838355',1,0,'0138096690',NULL,NULL,NULL,NULL,'1513229474_LWIO1RVe_400x400.jpeg','RfKXxfnrmmdECA2ZHtbX3dGkZkNv2RMoS644Xkm9arExUJMjt2oRTrt3WWxB','2017-12-12 22:58:17','2017-12-14 22:31:14'),
	(5,'محمد غانم عبدالله البنعلي','duheasetia@gmail.com','$2y$10$oLWrrPjq03fkjswK9DHBqev3imZbvcdvvJiYA8QKKsfUkv4WXS8D.',4,1,'0500757705',1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-24 14:43:36','2018-07-27 23:56:24');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
