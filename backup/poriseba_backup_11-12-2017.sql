Warning: Using a password on the command line interface can be insecure.
-- MySQL dump 10.13  Distrib 5.6.38, for Linux (x86_64)
--
-- Host: localhost    Database: poriseba
-- ------------------------------------------------------
-- Server version	5.6.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ambulance_master`
--

DROP TABLE IF EXISTS `ambulance_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ambulance_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `vehicle_no` varchar(30) DEFAULT NULL,
  `country_id` int(10) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `all_time` tinyint(1) DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `ac` tinyint(1) DEFAULT '0' COMMENT '0=No,1=yes',
  `oxygen` tinyint(1) DEFAULT '0' COMMENT '0=No,1=yes',
  `lifesupport` tinyint(1) NOT NULL DEFAULT '0',
  `description` text,
  `contact_no` text,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>inactive,1=>active,3=>delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ambulance_master`
--

LOCK TABLES `ambulance_master` WRITE;
/*!40000 ALTER TABLE `ambulance_master` DISABLE KEYS */;
INSERT INTO `ambulance_master` VALUES (4,'bandhab sangha','WB-15B-2032',1,1,1,1,'55G, THAKURDAS BABU LANE, SERAMPORE','22.75734436993417','88.33924937102506',1,1,1,0,'NA','9830272974',NULL,1,'2017-12-04 19:49:22',NULL),(5,'BATTALA','XXX',1,1,1,1,'XXX','22.74980766103783','88.34763276162414',1,1,1,0,'XXX','9836545258',NULL,0,'2017-12-04 19:56:06','2017-12-10 20:40:44'),(6,'dilip smriti sangha','XXX',1,1,1,1,'raja rammohan roy sarani, serampore.','22.754369380130655','88.3362452098911',1,1,1,0,'xxx','9831982454,9830272974',NULL,0,'2017-12-04 20:08:02','2017-12-10 20:40:14'),(7,'jhawtala','XXX',1,1,1,1,'jhawtala serampore','22.75259536119251','88.3430704197433',1,1,1,0,'xxx','9804888270',NULL,0,'2017-12-04 20:21:49','2017-12-04 20:24:19'),(8,'maniktala','XXX',1,1,1,1,'maniktala, serampore','','',1,0,1,0,'xxx','9831041031',NULL,0,'2017-12-04 20:30:51','2017-12-10 20:39:59'),(9,'milan chakra','XXX',1,1,1,1,'firingi danga road, serampore','22.748499483138843','88.33440934277496',1,1,1,0,'xxx','7044575862',NULL,0,'2017-12-04 20:39:13','2017-12-10 20:39:20'),(10,'Tin bazar sarbajananin durga utsav committee','WB 17 0090',1,1,1,1,'Tin bazar, serampore, hooghly, west bengal, pin-712201','22.754812782019968','88.34443668874655',1,1,1,0,'Xxx','9163599759,9748039004','20171210_1512900504_IMG_20171210_073045.jpg',0,'2017-12-10 15:35:54','2017-12-10 23:40:14'),(11,'Tin bazar sarbajananin durga utsav committee','WB 17 1010',1,1,1,1,'Tin bazar, serampore, hooghly, west bengal, pin-712201','22.754879038974977','88.34443182586438',1,0,1,0,'Xxx','9748039004,9163599759','20171210_1512929267_IMG-20171210-WA0016.jpg',0,'2017-12-10 23:34:14','2017-12-11 15:13:26'),(12,'Xxx','Wb 15 B 6392',1,1,1,1,'Xxxx','22.748331','88.33850529999995',1,1,1,0,'Xxx','9681060857','20171210_1512929927_IMG-20171210-WA0026.jpg',0,'2017-12-10 23:44:12','2017-12-10 23:48:47'),(13,'Xxx','WB 15 B 4513',1,1,1,1,'Xxx','22.756820014691268','88.3458438238647',1,0,1,0,'Xxx','Xxx','20171211_1512984801_IMG-20171210-WA0007.jpg',0,'2017-12-11 15:03:21',NULL),(14,'Xxx','WB 15 B 4051',1,1,1,1,'Xxx','22.756810121041802','88.3457901796844',1,0,1,0,'Xxx','Xxx','20171211_1512985062_IMG-20171210-WA0006.jpg',0,'2017-12-11 15:07:42',NULL),(15,'Name: Tin bazar sarbajananin durga utsav committee','WB 17 0432',1,1,1,1,'Tin bazar, serampore, hooghly, west bengal, pin-712201','22.754896353105845','88.34446133016354',1,0,1,0,'Xxx','9748039004,9163599759','20171211_1512985374_IMG-20171210-WA0002.jpg',0,'2017-12-11 15:12:54',NULL),(16,'Xxx','WB 15 B 3998',1,1,1,1,'Xxx','22.756582566906207','88.34582236619258',1,0,1,0,'Xxx','9830731376','20171211_1512985739_IMG-20171210-WA0022.jpg',0,'2017-12-11 15:18:59',NULL),(17,'Aurobinda sangha','Xxx',1,1,1,1,'Bager bagan, ghosh para, sheorahphuly, 712204','','',1,0,1,0,'Xxx','9804553348',NULL,0,'2017-12-11 15:24:27',NULL),(18,'Apanjan club','Xxx',1,1,1,1,'Janata sarani, hind motor, uttarpara, debipukur, 712233.','','',1,0,1,0,'Xxx','03326943400',NULL,0,'2017-12-11 15:29:15',NULL),(19,'Jyoti choudhury puja committee','Xxx',1,1,1,1,'G.t.road, battala, serampore, hooghly, 712201','22.749221480848757','88.34710982651973',1,0,1,0,'Xxx','9831041031',NULL,0,'2017-12-11 15:41:38',NULL),(20,'Sikha paul','Xxx',1,1,1,1,'32/a, p.g.bhaduri, hooghly, 712201.','','',1,0,1,0,'Xxx','+913326524668',NULL,0,'2017-12-11 20:19:14',NULL),(21,'Sadhana sangha','Xxx',1,1,1,1,'68, g.t.road, hooghly, 712201','','',1,0,1,0,'Xxx','+919831847361,+919836545258,+919681249029',NULL,0,'2017-12-11 20:23:33',NULL),(22,'Gopinath smriti kishore sangha','Xxx',1,1,1,1,'Serampore, hooghly, 712203','','',1,0,1,0,'Xxx','+919830272066,+919748416435,+919231907950,+919903608163',NULL,0,'2017-12-11 20:28:28',NULL);
/*!40000 ALTER TABLE `ambulance_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blood_bank_master`
--

DROP TABLE IF EXISTS `blood_bank_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blood_bank_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `country_id` int(10) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `open_time` varchar(20) DEFAULT NULL,
  `close_time` varchar(20) DEFAULT NULL,
  `close_day` int(10) DEFAULT NULL,
  `description` text,
  `contact_no` text,
  `establishment_date` date DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>inactive,1=>active,3=>delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blood_bank_master`
--

LOCK TABLES `blood_bank_master` WRITE;
/*!40000 ALTER TABLE `blood_bank_master` DISABLE KEYS */;
INSERT INTO `blood_bank_master` VALUES (1,'asasas',1,1,1,1,'sasas','22.7564627','88.34025899999999','2:22 PM','4:22 PM',2,'sasas','212121212',NULL,NULL,3,'2017-11-26 17:22:57','2017-11-26 17:26:10'),(2,'aasas',1,1,1,1,'sasas','22.756520599999998','88.3403001','5:05 PM','5:20 PM',2,'sasas','1212121212','2017-12-18','20171203_1512300942_Chrysanthemum.jpg',3,'2017-12-03 17:05:42',NULL),(3,'sdsd',1,1,1,1,'sdsd','22.7565167','88.3402991','5:08 PM','5:08 PM',1,'sdsdsd','212121212','2017-12-04','20171203_1512301133_Desert.jpg',3,'2017-12-03 17:08:54',NULL),(4,'dfdfdfdff',1,1,1,1,'jhjgggjg','-38.3680144','142.23330850000002','9:08 PM','12:08 AM',1,'gfgfgfffg','11113434434,1111,1111','2007-02-14','20171203_1512315566_Hydrangeas.jpg',3,'2017-12-03 21:08:48','2017-12-03 21:09:26');
/*!40000 ALTER TABLE `blood_bank_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `district_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Serampore',1);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'IND','India',91);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `day_master`
--

DROP TABLE IF EXISTS `day_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `day_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `day_master`
--

LOCK TABLES `day_master` WRITE;
/*!40000 ALTER TABLE `day_master` DISABLE KEYS */;
INSERT INTO `day_master` VALUES (1,'Monday'),(2,'Tuesday'),(3,'Wednesday'),(4,'Thursday'),(5,'Friday'),(6,'Saturday'),(7,'Sunday');
/*!40000 ALTER TABLE `day_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnostic_centre`
--

DROP TABLE IF EXISTS `diagnostic_centre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnostic_centre` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `establishment_date` date NOT NULL,
  `country_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `district_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `open_time` varchar(20) DEFAULT NULL,
  `close_time` varchar(20) DEFAULT NULL,
  `close_day` int(10) DEFAULT NULL,
  `contact_no` text,
  `medical_tests` text COMMENT 'implode with comma ids from medical_test table',
  `others` text NOT NULL COMMENT 'facilities are not present',
  `e_report` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No,1=yes',
  `website` varchar(100) DEFAULT NULL,
  `home_collection` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No,1=yes',
  `image` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>inactive,1=>active,3=>delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnostic_centre`
--

LOCK TABLES `diagnostic_centre` WRITE;
/*!40000 ALTER TABLE `diagnostic_centre` DISABLE KEYS */;
INSERT INTO `diagnostic_centre` VALUES (1,'tet','0000-00-00',1,1,1,1,'test','22.756432699999998','88.3402557','4:12 PM','9:12 PM',7,'131133131313,31313131313,313131313',NULL,'',0,NULL,0,'',3,'2017-11-26 16:12:39',NULL),(2,'aasas','2007-12-04',1,1,1,1,'asasas','-38.1979686','141.6162958','5:25 PM','10:30 PM',1,'21212121212','1,5','asasas',1,'http://localhost/poriseba/admin/diagnosticcentre/update?id=5',1,'20171204_1512388864_Penguins.jpg',3,'2017-12-04 17:31:04',NULL);
/*!40000 ALTER TABLE `diagnostic_centre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `state_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts`
--

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` VALUES (1,'Hooghly',1);
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_chamber`
--

DROP TABLE IF EXISTS `doctor_chamber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_chamber` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `doctor_master_id` bigint(20) NOT NULL,
  `chamber_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `address` text,
  `city_id` bigint(20) DEFAULT NULL COMMENT 'city_master table id',
  `district_id` int(11) DEFAULT NULL,
  `state_id` bigint(20) DEFAULT NULL COMMENT 'states table id',
  `country_id` bigint(20) DEFAULT NULL COMMENT 'country_master table id',
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>Inactive,1=>Active,3=>Delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_chamber`
--

LOCK TABLES `doctor_chamber` WRITE;
/*!40000 ALTER TABLE `doctor_chamber` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor_chamber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_chamber_time`
--

DROP TABLE IF EXISTS `doctor_chamber_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_chamber_time` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `doctor_chamber_id` bigint(20) NOT NULL COMMENT 'doctor_chamber table id',
  `day_master_id` int(11) NOT NULL COMMENT 'day_master table id',
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>Inactive,1=>Active,3=>Delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_chamber_time`
--

LOCK TABLES `doctor_chamber_time` WRITE;
/*!40000 ALTER TABLE `doctor_chamber_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor_chamber_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_master`
--

DROP TABLE IF EXISTS `doctor_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `doctor_type_id` int(11) NOT NULL COMMENT 'doctor_type table id',
  `doctor_specialities_id` int(11) NOT NULL COMMENT 'doctor_specialities table id',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `registration_no` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `email_verification_code` varchar(30) DEFAULT NULL,
  `mobile_verified` tinyint(1) DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `mobile_verification_code` varchar(30) DEFAULT NULL,
  `keywords` text COMMENT 'eg. allopathic,surgeon etc',
  `description` text,
  `gender` tinyint(1) DEFAULT '0' COMMENT '0=>Unknown,1=>Male,2=>Female',
  `home_visit` tinyint(1) DEFAULT '0' COMMENT '0=>Unknown,1=>Yes,2=>No',
  `approved_by_doctor` tinyint(1) DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>inactive,1=>active,3=>delete',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_master`
--

LOCK TABLES `doctor_master` WRITE;
/*!40000 ALTER TABLE `doctor_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_specialities`
--

DROP TABLE IF EXISTS `doctor_specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_specialities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_type_id` int(11) NOT NULL DEFAULT '1' COMMENT 'doctor_type table id',
  `speciality` varchar(255) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>inactive,1=>active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_specialities`
--

LOCK TABLES `doctor_specialities` WRITE;
/*!40000 ALTER TABLE `doctor_specialities` DISABLE KEYS */;
INSERT INTO `doctor_specialities` VALUES (1,1,'Anesthesiologist','specializing in the administration of anesthesia',1),(2,1,'Cardiologist','specializing in the treatment of heart disorders',1),(3,1,'Dermatologist','specializing in the treatment of skin disorders',1),(4,1,'Gastroenterologist','specializing in digestive disorders',1),(5,1,'Gerontologist','specializing in the care and treatment of the elderly',1),(6,1,'Gynecologist','specializing in disorders related to the female reproductive system',1),(7,1,'Neurologist','specializing in disorders related to the brain and nervous system',1),(8,1,'Obstetrician','specializing in pregnancy care and delivering babies',1),(9,1,'Oncologist','specializing in the treatment of cancer',1),(10,1,'Orthopedist','treats skeletal problems',1),(11,1,'Pathologist','specializing in tissue diseases',1),(12,1,'Pediatrician','specializing in children’s health care',1),(13,1,'Pulmonologist','specializing in the treatment of respiratory disorders',1),(14,1,'Surgeon','performs operations',1),(15,1,'Urologist','specializing in the treatment of urinary problems',1),(16,1,'mbbs','sadsadsa',1);
/*!40000 ALTER TABLE `doctor_specialities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_type`
--

DROP TABLE IF EXISTS `doctor_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>inactive,1=>active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_type`
--

LOCK TABLES `doctor_type` WRITE;
/*!40000 ALTER TABLE `doctor_type` DISABLE KEYS */;
INSERT INTO `doctor_type` VALUES (1,'ALLOPATHIC',1),(2,'HOMEOPATHIC',1),(3,'AYURVEDIC',1);
/*!40000 ALTER TABLE `doctor_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email_code` varchar(100) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text,
  `variable` text,
  `status` enum('0','1','3') DEFAULT '0' COMMENT '''0''=>''Inactive'', ''1''=>''Active'' , ''3''=>''Deleted''',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES (1,'welcome_email','WelCome Mail','Welcome User','<p>Welcome {{FULL_NAME}},</p>\n<p>Thanks For being a member of {{PROJECT_NAME}}. Hope we will serve you better.</p>\n<p>Here is some important information about your new account.</p>\n<p>Email ID: {{EMAIL}}</p>\n<p><a style=\"color: #fff; background-color: #1f858e; border-color: #18666d; font-weight: 400; text-align: center; cursor: pointer; white-space: nowrap; padding: 6px 12px; font-size: 14px; touch-action: manipulation; vertical-align: middle; border-radius: 2px !important; text-decoration: none;\" href=\"{{LINK}}\">Click to Login</a></p>\n<p>&nbsp;</p>\n<p>Thank you,</p>\n<p>{{PROJECT_NAME}} Team.</p>','Full Name:&nbsp;&nbsp;{{FULL_NAME}}<br/>Project Name:&nbsp;&nbsp;{{PROJECT_NAME}}<br/>Email Id:&nbsp;&nbsp;{{EMAIL}}<br/>\nLogin Url:&nbsp;&nbsp;{{LINK}}<br/>','1','2014-12-19 00:00:00','2017-07-26 11:11:41'),(2,'social_welcome_email','WelCome Mail for social site registration','Welcome User','<p>Welcome {{FULL_NAME}},</p>\n<p>Thanks For being a member of {{PROJECT_NAME}}. Hope we will serve you better.</p>\n<p>Here is some important information about your new account.</p>\n<p>Email ID: {{EMAIL}}</p>\n<p>Password: {{PASSWORD}}</p>\n<p><a style=\"color: #fff; background-color: #1f858e; border-color: #18666d; font-weight: 400; text-align: center; cursor: pointer; white-space: nowrap; padding: 6px 12px; font-size: 14px; touch-action: manipulation; vertical-align: middle; border-radius: 2px !important; text-decoration: none;\" href=\"{{LINK}}\">Click to Login</a></p>\n<p>&nbsp;</p>\n<p>Thank you,</p>\n<p>{{PROJECT_NAME}} Team.</p>','Full Name:&nbsp;&nbsp;{{FULL_NAME}}<br/>Project Name:&nbsp;&nbsp;{{PROJECT_NAME}}<br/>Email Id:&nbsp;&nbsp;{{EMAIL}}<br/>\r\nPassword:&nbsp;&nbsp;{{PASSWORD}}\r\nLogin Url:&nbsp;&nbsp;{{LINK}}<br/>','1','2014-12-19 00:00:00','2017-07-26 11:11:41'),(3,'registration_email_verify','Verify Email','Verify Email Address','<p>Hello <strong>{{FULL_NAME}}</strong>,</p>\n<p>Please verify your email address on click below button for activate your account on our site <a style=\"text-decoration: none; cursor: pointer; font-weight: 600;\" href=\"{{HOME_LINK}}\">{{PROJECT_NAME}}</a></p>\n<p>&nbsp;</p>\n<p><a style=\"color: #fff; background-color: #1f858e; border-color: #18666d; font-weight: 400; text-align: center; cursor: pointer; white-space: nowrap; padding: 6px 12px; font-size: 14px; touch-action: manipulation; vertical-align: middle; border-radius: 2px !important; text-decoration: none;\" href=\"{{LINK}}\">Verify Email Address</a></p>\n<p>&nbsp;</p>\n<p>Thanks,</p>\n<p>{{PROJECT_NAME}} Team.</p>','Full Name:&nbsp;&nbsp;{{FULL_NAME}}<br/>\nProject Name:&nbsp;&nbsp;{{PROJECT_NAME}}<br/>\nHome Link:&nbsp;&nbsp;{{HOME_LINK}}<br/>\nVerify Link:&nbsp;&nbsp;{{LINK}}<br/>','1','2014-12-19 00:00:00','2017-07-26 11:11:41'),(4,'forgot_password','Forgot Password','Reset Your Password','<p>Hello <strong>{{FULL_NAME}}</strong>,</p>\n<p>Plese click on below button to update your password.</p>\n<p>&nbsp;</p>\n<p><a style=\"color: #fff; background-color: #1f858e; border-color: #18666d; font-weight: 400; text-align: center; cursor: pointer; white-space: nowrap; padding: 6px 12px; font-size: 14px; touch-action: manipulation; vertical-align: middle; border-radius: 2px !important; text-decoration: none;\" href=\"{{LINK}}\">Reset Password</a></p>\n<p>&nbsp;</p>\n<p>Thank you,</p>\n<p>{{PROJECT_NAME}} Team.</p>','Full Name:&nbsp;&nbsp;{{FULL_NAME}}<br/>Project Name:&nbsp;&nbsp;{{PROJECT_NAME}}<br/> Reset Link:&nbsp;&nbsp;{{LINK}}','1','2014-12-19 00:00:00','2017-01-18 06:21:57'),(5,'email_verify','Verify Email Address','Verify Email Address','<p>Hello <strong>{{FULL_NAME}}</strong>,</p>\n<p>Please verify your email address by clicking on below button.</p>\n<p><a style=\"color: #fff; background-color: #1f858e; border-color: #18666d; font-weight: 400; text-align: center; cursor: pointer; white-space: nowrap; padding: 6px 12px; font-size: 14px; touch-action: manipulation; vertical-align: middle; border-radius: 2px !important; text-decoration: none;\" href=\"{{LINK}}\">Verify Email Address</a></p>\n<p>&nbsp;</p>\n<p>Thanks,</p>\n<p>{{PROJECT_NAME}} Team.</p>','Full Name:&nbsp;&nbsp;{{FULL_NAME}}<br/>\r\nProject Name:&nbsp;&nbsp;{{PROJECT_NAME}}<br/>\r\nVerify Link:&nbsp;&nbsp;{{LINK}}<br/>','1','2014-12-19 00:00:00','2017-07-26 11:11:41');
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eye_bank_master`
--

DROP TABLE IF EXISTS `eye_bank_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eye_bank_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `country_id` int(10) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `open_time` varchar(20) DEFAULT NULL,
  `close_time` varchar(20) DEFAULT NULL,
  `close_day` int(10) DEFAULT NULL,
  `description` text,
  `contact_no` text,
  `establishment_date` date NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>inactive,1=>active,3=>delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eye_bank_master`
--

LOCK TABLES `eye_bank_master` WRITE;
/*!40000 ALTER TABLE `eye_bank_master` DISABLE KEYS */;
INSERT INTO `eye_bank_master` VALUES (1,'ewewe',1,1,1,1,'ewewe','22.756441799999997','88.3401895','5:31 PM','5:31 PM',3,'wewe','12121212','2017-12-05',NULL,3,'2017-11-26 17:31:22','2017-12-03 17:34:10'),(2,'asaas',1,1,1,1,'asasas','-38.1194459','141.6307776','9:13 PM','12:13 AM',2,'wqwqw','211212,2121212','1986-03-12','20171203_1512315814_Desert.jpg',3,'2017-12-03 21:13:34',NULL);
/*!40000 ALTER TABLE `eye_bank_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_tests`
--

DROP TABLE IF EXISTS `medical_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>inactive,1=>active,3=>delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_tests`
--

LOCK TABLES `medical_tests` WRITE;
/*!40000 ALTER TABLE `medical_tests` DISABLE KEYS */;
INSERT INTO `medical_tests` VALUES (1,'2D Echo',1),(2,'4D Scan',1),(3,'ACTH (Adreno Corticotropic Hormone) Test',1),(4,'Adenosine Deaminase Test',1),(5,'AEC (Absolute Eosinophil Count) Test',1),(6,'AFB (Acid Fast Bacilli) Culture Test',1),(7,'AFP (Alpha Feto Protein) Test',1),(8,'Alberts Stain',1),(9,'Albumin Test',1),(10,'Aldolase Test',1),(11,'Alkaline Phosphatase (ALP) Test',1),(12,'Allergy Test',1),(13,'Ammonia Test',1),(14,'Amylase Test',1),(15,'ANA (Antinuclear Antibody) Test',1),(16,'ANC Profile',1),(17,'ANCA Profile',1),(18,'Anti CCP (ACCP) Test',1),(19,'Anti Phospholipid (APL) Test',1),(20,'Anti TPO Test',1),(21,'Anti-Mullerian Hormone (AMH) Test',1),(22,'Antithyroglobulin Antibody Test',1),(23,'Antithyroid Microsomal Antibody (AMA) Test',1),(24,'APTT (Activated Partial Thromboplastin Time) Test',1),(25,'Arterial Blood Gas (ABG)',1),(26,'Ascitic Fluid Test',1),(27,'ASO Test',1),(28,'Audiometry Test',1),(29,'Beta HCG Test',1),(30,'Beta Thalassemia Test',1),(31,'Bicarbonate Test',1),(32,'Bilirubin Test',1),(33,'Biopsy',1),(34,'Bleeding / Clotting Time Test',1),(35,'Blood Culture Test',1),(36,'Blood Glucose Test',1),(37,'Blood Group Test',1),(38,'Blood Sugar Test',1),(39,'Blood Urea Nitrogen Test',1),(40,'Bone Density Test / Dexa Scan',1),(41,'Bone Scan',1),(42,'C-Peptide Test',1),(43,'CA 15.3 Test',1),(44,'CA 19.9 Test',1),(45,'CA 27.29 Test',1),(46,'CA-125 (Tumor Marker) Test',1),(47,'Calcium Test',1),(48,'Carbamazepine (Tegretol) Test',1),(49,'Cardiolipin Antibodies (ACL)',1),(50,'CBC / Hemogram Test',1),(51,'CD4 Test',1),(52,'CEA (Carcinoembryonic Antigen) Test',1),(53,'Cerebral Spinal Fluid (CSF) Test',1),(54,'Chikungunya Test',1),(55,'Chlamydia Test',1),(56,'Chloride Test',1),(57,'Cholesterol Test',1),(58,'CK-MB Test',1),(59,'Color Doppler',1),(60,'Complement C3',1),(61,'Complement C4',1),(62,'Coombs Test',1),(63,'Cortisol Test',1),(64,'CPK (Creatine Phosphokinase) Test',1),(65,'Creatinine Clearance Test',1),(66,'Creatinine Test',1),(67,'CRP (C-Reactive Protein) Test',1),(68,'Cryptococcal Antigen Test',1),(69,'CT Scan',1),(70,'Cytomegalovirus (CMV) Test',1),(71,'D Dimer Test',1),(72,'Dengue IgG Test',1),(73,'Dengue IgM Test',1),(74,'Dengue NS1 Test',1),(75,'DHEA Test',1),(76,'DMSA Scan',1),(77,'DNA Test',1),(78,'Double Marker Test',1),(79,'ECG',1),(80,'EEG',1),(81,'Electrolytes Test',1),(82,'Electromyography (EMG)',1),(83,'ESR (Erythrocyte Sedimentation Rate) Test',1),(84,'Estradiol (E2) Test',1),(85,'Factor V Leiden Test',1),(86,'Ferritin Test',1),(87,'FNAC Test',1),(88,'Folic Acid Test',1),(89,'FSH (Follicle Stimulating Hormone) Test',1),(90,'Fungal Culture Test',1),(91,'G6PD Test',1),(92,'Gallium Scan',1),(93,'Gamma GT (GGTP) Test',1),(94,'Globulin / AG Ratio',1),(95,'Globulin Test',1),(96,'Glucose Tolerance Test (GTT)',1),(97,'Gram Stain Test',1),(98,'HbA1C Test',1),(99,'HBeAb (Hepatitis B Antibody)',1),(100,'HBsAg Test',1),(101,'HCV Antibody Test',1),(102,'HDL Cholesterol',1),(103,'Helicobacter Pylori Test',1),(104,'Hemoglobin (Hb) Test',1),(105,'Hemoglobin Electrophoresis',1),(106,'Hepatitis A Test',1),(107,'Hepatitis E Test',1),(108,'Herpes Simplex Virus (HSV) Test',1),(109,'HGH Test',1),(110,'HIDA Scan',1),(111,'HIV Test',1),(112,'HLA B27 Test',1),(113,'Homocysteine Test',1),(114,'HSG Test',1),(115,'Insulin Test',1),(116,'Iron Test',1),(117,'Karyotype Test',1),(118,'Kidney / Renal Function Test',1),(119,'L. E. Cells Test',1),(120,'LDH (Lactate Dehydrogenase) Test',1),(121,'LDL Cholesterol',1),(122,'LH (Luteinizing Hormone) Test',1),(123,'Lipase Test',1),(124,'Lipid Profile',1),(125,'Lipoprotein A / LP(a) Test',1),(126,'Lithium Test',1),(127,'Liver Function Test (LFT)',1),(128,'Lupus Anticoagulant (LAC) Test',1),(129,'Magnesium Test',1),(130,'Malaria (Malarial Parasite) Test',1),(131,'Mammography',1),(132,'Mantoux Test',1),(133,'MIBG Scan',1),(134,'Microalbumin Test',1),(135,'Microfilaria Parasite Test',1),(136,'MRI Scan',1),(137,'MUGA Scan',1),(138,'Nerve Conduction Velocity (NCV)',1),(139,'NT Scan',1),(140,'PAP Smear',1),(141,'Paratyphi Test',1),(142,'PCV (Packed Cell Volume) Test',1),(143,'Peripheral Blood Smear Test',1),(144,'PET-CT Scan',1),(145,'Phosphorus Test',1),(146,'Plasma Lactate (Lactic Acid) Test',1),(147,'Platelet Count',1),(148,'Pleural Fluid Analysis',1),(149,'Potassium Test',1),(150,'Pregnancy Test',1),(151,'Progesterone Test',1),(152,'Prolactin Test',1),(153,'Protein Test',1),(154,'Protein/Creatinine Ratio',1),(155,'PSA (Prostate Specific Antigen) Test',1),(156,'PT (Prothrombin Time) Test',1),(157,'PTH (Parathyroid Hormone) Test',1),(158,'Renal Profile',1),(159,'Renal Scan / Kidney Scan',1),(160,'Reticulocyte Count Test',1),(161,'Rheumatoid Arthritis (RA) Factor Test',1),(162,'Rubella Test',1),(163,'Semen Analysis Test',1),(164,'Sex Hormone Test',1),(165,'SGOT Test',1),(166,'SGPT Test',1),(167,'Sickling Test',1),(168,'Sodium Test',1),(169,'Sonography (Ultrasound / USG)',1),(170,'Sperm DNA Fragmentation',1),(171,'Sputum Culture',1),(172,'Sputum Routine Test',1),(173,'Stool Culture',1),(174,'Stool Routine',1),(175,'Stress Echo Test',1),(176,'Stress Test (TMT)',1),(177,'Swine Flu Test (H1N1)',1),(178,'Synovial Fluid Analysis',1),(179,'T3 (Triiodothyronine) Test',1),(180,'T4 (Thyroxine) Test',1),(181,'TB Test',1),(182,'Testosterone Test',1),(183,'Thallium Scan',1),(184,'Thyroglobulin Test',1),(185,'Thyroid Scan',1),(186,'Thyroid Test',1),(187,'TORCH Test',1),(188,'Total Protein Test',1),(189,'Toxoplasma Test',1),(190,'Transferrin Test',1),(191,'Triglycerides Test',1),(192,'Triple Marker Test',1),(193,'Troponin-I Test',1),(194,'TSH (Thyroid Stimulating Hormone) Test',1),(195,'Typhidot Test',1),(196,'Urea Test',1),(197,'Uric Acid Test',1),(198,'Urine Culture',1),(199,'Urine Routine',1),(200,'Valproic Acid',1),(201,'VDRL Test',1),(202,'Vitamin A Test',1),(203,'Vitamin B12 Test',1),(204,'Vitamin C Test',1),(205,'Vitamin D Test',1),(206,'Vitamin E Test',1),(207,'VLDL Test',1),(208,'VQ Scan (Lung Ventilation and Lung Perfusion Scan)',1),(209,'Widal Test',1),(210,'X-Ray',1),(211,'X-Ray Skeletal Survey',1);
/*!40000 ALTER TABLE `medical_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicine_shop_master`
--

DROP TABLE IF EXISTS `medicine_shop_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicine_shop_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `category_id` int(10) NOT NULL,
  `country_id` int(10) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `open_time` varchar(20) DEFAULT NULL,
  `close_time` varchar(20) DEFAULT NULL,
  `close_day` int(10) DEFAULT NULL,
  `contact_no` text,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>inactive,1=>active,3=>delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicine_shop_master`
--

LOCK TABLES `medicine_shop_master` WRITE;
/*!40000 ALTER TABLE `medicine_shop_master` DISABLE KEYS */;
INSERT INTO `medicine_shop_master` VALUES (5,'Prabha homeo',2,1,1,1,1,'Raja rammohan roy sarani, serampore, hooghly, west bengal, 712203','22.754235274406057','88.33697912307048','1:28 AM','3:41 PM',4,'+919830873355',NULL,0,'2017-12-11 15:41:05','2017-12-11 16:57:47'),(6,'Mediview',2,1,1,1,1,'Bhattacharjee street, Serampore','22.75282539545471','88.34294972033763','4:15 PM','4:15 PM',4,'9830245354',NULL,1,'2017-12-11 16:19:03','2017-12-11 16:26:18'),(7,'Susruta',2,1,1,1,1,'N.s avenue, Serampore','','','4:22 PM','4:22 PM',4,'+919830743454',NULL,1,'2017-12-11 16:23:54','2017-12-11 16:27:09'),(8,'Cure up homeo centre',2,1,1,1,1,'G.t.road, battala, serampore','','','4:29 PM','4:29 PM',4,'+919007280915',NULL,1,'2017-12-11 16:30:08',NULL),(9,'Recovery homeo centre',2,1,1,1,1,'Kalitala, serampore','','','4:38 PM','4:38 PM',4,'+913326624519',NULL,1,'2017-12-11 16:39:03',NULL),(10,'Angel homeo centre',2,1,1,1,1,'Sadgope para lane, serampore','','','4:41 PM','4:41 PM',4,'+919051906624',NULL,1,'2017-12-11 16:41:51',NULL),(11,'Sai homeo hall',2,1,1,1,1,'1/B, g.t.road, Moradan, serampore','','','4:49 PM','4:49 PM',4,'+919804910044',NULL,1,'2017-12-11 16:57:26','2017-12-11 17:00:29');
/*!40000 ALTER TABLE `medicine_shop_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(16) NOT NULL,
  `translation` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'es','Desde'),(2,'es','Hasta'),(3,'es','Fecha'),(4,'es','Buscar Un Viaje'),(5,'en','Id'),(6,'en','User Type'),(7,'en','First Name'),(8,'en','Last Name'),(9,'en','Email Id'),(10,'en','Facebook Email Id'),(11,'en','Password'),(12,'en','Contact No.'),(13,'en','Country'),(14,'en','State'),(15,'en','Zip'),(16,'en','Image'),(17,'en','Active Token'),(18,'en','Reset Password Token'),(19,'en','Status'),(20,'en','Registration Date'),(21,'en','Update Date'),(22,'en','Track Id'),(23,'en','User Id'),(24,'en','Vehicle Brand'),(25,'en','Vehicle Model'),(26,'en','Color'),(27,'en','Plate Number'),(28,'en','Vehicle Image'),(29,'en','Cancelation Cause'),(30,'en','Added Date'),(31,'en','Updated Date'),(32,'en','Module'),(33,'en','Title'),(34,'en','Route'),(35,'en','Description'),(36,'en','Keyword'),(37,'en','Updated At'),(38,'en','Category'),(39,'en','Message'),(40,'en','Email Code'),(41,'en','About'),(42,'en','Subject'),(43,'en','Body'),(44,'en','Variable'),(45,'en','Created At'),(46,'en','Mobile Number Is Invalid'),(47,'en','Current Password'),(48,'en','New Password'),(49,'en','Retype Password'),(50,'en','Current Password Is Incorrect.'),(51,'en','Current Password And New Password Can\'t Be Same.');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mortuary_master`
--

DROP TABLE IF EXISTS `mortuary_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mortuary_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `vehicle_no` varchar(30) DEFAULT NULL,
  `country_id` int(10) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `all_time` tinyint(1) DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `ac` tinyint(1) DEFAULT '0' COMMENT '0=No,1=yes',
  `description` text,
  `contact_no` text,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>inactive,1=>active,3=>delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mortuary_master`
--

LOCK TABLES `mortuary_master` WRITE;
/*!40000 ALTER TABLE `mortuary_master` DISABLE KEYS */;
INSERT INTO `mortuary_master` VALUES (3,'Tin bazar sarbajananin durga utsav committee','WB-41F-3178',1,1,1,1,'Tin bazar, serampore, hooghly, west bengal, pin-712201','22.75489440580016','88.34443400653765',1,0,'Tin Bazar\r\nটিন বাজার\r\nSerampore\r\nWest Bengal moturay  non ac van','9748039004,9163599759','20171211_1512987976_IMG-20171210-WA0011.jpg',1,'2017-12-10 11:30:36','2017-12-11 15:56:16'),(4,'Tin bazar sarbajananin durga utsav committee','WB-41F-4860',1,1,1,1,'Tin bazar, serampore, hooghly, west bengal, pin-712201','22.754884512011227','88.3443884089844',1,1,'Tin Bazar\r\nটিন বাজার\r\nSerampore\r\nWest Bengal moturay  non ac van','9163599759,9748039004','20171211_1512988145_IMG-20171210-WA0000.jpg',1,'2017-12-10 15:24:15','2017-12-11 15:59:05'),(5,'Nagrik committee club','Xxx',1,1,1,1,'Serampore','','',1,0,'Xxx','9088658704,8420882960','20171211_1512990958_IMG-20171210-WA0019.jpg',1,'2017-12-11 16:45:58',NULL),(6,'Xxx','WB 41C 7796',1,1,1,1,'Xxx','','',1,0,'Xxx','Xxx',NULL,1,'2017-12-11 16:47:48',NULL);
/*!40000 ALTER TABLE `mortuary_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo`
--

DROP TABLE IF EXISTS `seo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `route` varchar(100) NOT NULL,
  `description` varchar(160) DEFAULT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo`
--

LOCK TABLES `seo` WRITE;
/*!40000 ALTER TABLE `seo` DISABLE KEYS */;
INSERT INTO `seo` VALUES (1,'','poriseba home','site/index','home page','home','2017-10-21 18:53:28'),(2,'','site/error','site/error','123vamos','123vamos','2017-10-21 20:51:19'),(3,'','','registration/index','','','2017-10-22 12:48:22');
/*!40000 ALTER TABLE `seo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services_list`
--

DROP TABLE IF EXISTS `services_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `fa_icon` varchar(100) DEFAULT NULL,
  `border_color` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active,3=delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services_list`
--

LOCK TABLES `services_list` WRITE;
/*!40000 ALTER TABLE `services_list` DISABLE KEYS */;
INSERT INTO `services_list` VALUES (1,'Doctors',NULL,'fa fa-user-md color-1','border-1',NULL,0),(2,'Hospital/Nursing-home',NULL,'fa fa-hospital-o fa-fw color-2','border-2',NULL,0),(3,'Medicine Shops','app\\models\\MedicineShopMaster','fa fa-medkit fa-fw color-6','border-6',NULL,1),(4,'Ambulance','app\\models\\AmbulanceMaster','fa fa-ambulance fa-fw color-4','border-4','',1),(5,'Mortuary Van service','app\\models\\MortuaryMaster','fa fa-car fa-fw color-5','border-5',NULL,1),(6,'Diagnostic Center','app\\models\\DiagnosticCentre','fa fa-h-square fa-fw color-6','border-6',NULL,1),(7,'Physiotherapist',NULL,'fa fa-user-plus color-7','border-7',NULL,0),(8,'Nurse/Aya',NULL,'fa fa-female color-8','border-8',NULL,0),(9,'Fitness Center',NULL,'fa fa-spotify fa-fw color-1','border-1',NULL,0),(10,'Blood Bank','app\\models\\BloodBankMaster','fa fa-tint fa-fw color-2','border-2',NULL,1),(11,'Eye Bank','app\\models\\EyeBankMaster','fa fa-eye fa-fw color-6','border-6',NULL,1),(12,'Old Age Home',NULL,'fa fa-home color-4','border-4',NULL,0),(13,'Pathology Collector',NULL,'fa fa-flask color-5','border-5',NULL,0),(14,'Medical Instrument',NULL,'fa fa-cogs color-6','border-6',NULL,0),(15,'Rehab Centre',NULL,'fa fa-h-square fa-fw color-7','border-7',NULL,0),(16,'Health Insureces Policys',NULL,'fa fa-list color-3','border-3',NULL,0);
/*!40000 ALTER TABLE `services_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `type` set('text','textarea','password','select','select-multiple','radio','checkbox') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `default` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `options` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `is_required` tinyint(1) DEFAULT NULL,
  `is_gui` tinyint(1) DEFAULT NULL,
  `module` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `row_order` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='All Site Mangement';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'facebook_url','Facebook','Facebook url','text','https://www.facebook.com/','https://www.facebook.com/p','',1,1,'Social Link',3),(2,'google_plus_url','Google plus','Google plus url','text','https://plus.google.com/','https://plus.google.com/poriseba.com','',1,1,'Social Link',4),(3,'instagram','Instagram','Instagram url','text','http://www.instagram.com','https://www.instagram.com/poriseba.com','',1,1,'Social Link',5),(5,'nexmo_api_key','Api Key','Nexmo Api Key','text','1','baee486a!','',1,1,'Nexmo',3),(6,'nexmo_api_secret','Api Secret Key','Nexmo Api Secret','text','1','be8a3a49ccd5fb8c','',1,1,'Nexmo',2),(7,'nexmo_from_number','SMS Form Number','Nexmo From Numbert','text','1',NULL,'',1,1,'Nexmo',1),(8,'facebook_app_id','Facebook App Id','Facebook App Id','text','1','255746881581378!','',1,1,'Facebook',1),(9,'facebook_app_secret','Facebook App Secret','Facebook App Secret','text','1','20e9f0a0c324e4d9ce20304e788041d3','',1,1,'Facebook',2),(10,'instagram_client_id','Instagram client id','Instagram client id','text','16e1e7318f8342df8955589ff19e1672!','16e1e7318f8342df8955589ff19e1672!','',1,1,'Social Link',3),(11,'instagram_client_secret','Instagram client secret','Instagram client secret','text','194cbadd52a84f81aa54f7c3d84d81bd!','194cbadd52a84f81aa54f7c3d84d81bd!','',1,1,'Social Link',3),(12,'instagram_access_token','Instagram access token','Instagram access token','text','5326775729.1677ed0.ad54acc2b33b4f82a4704ba859836b57!','5326775729.1677ed0.a2c9ef0fe3024c34a40e003c5dba14b6!','',1,1,'Social Link',3),(13,'google_map_key','google map key','google map key','text','AIzaSyCyOuj28fWTVZQT4XBcgWJFLAk4sI54qlM','AIzaSyBOtvKwP4T1s3wOZ5h9QjDP2dSrly-SJXA','',1,1,'Social Link',3);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sourcemessage`
--

DROP TABLE IF EXISTS `sourcemessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sourcemessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sourcemessage`
--

LOCK TABLES `sourcemessage` WRITE;
/*!40000 ALTER TABLE `sourcemessage` DISABLE KEYS */;
INSERT INTO `sourcemessage` VALUES (1,'app','desde'),(2,'app','hasta'),(3,'app','fecha'),(4,'app','BUSCAR UN VIAJE'),(5,'app','ID'),(6,'app','User Type'),(7,'app','First Name'),(8,'app','Last Name'),(9,'app','Email Id'),(10,'app','Facebook Email Id'),(11,'app','Password'),(12,'app','Contact No.'),(13,'app','Country'),(14,'app','State'),(15,'app','Zip'),(16,'app','Image'),(17,'app','Active Token'),(18,'app','Reset Password Token'),(19,'app','Status'),(20,'app','Registration Date'),(21,'app','Update Date'),(22,'app','Track ID'),(23,'app','User ID'),(24,'app','Vehicle Brand'),(25,'app','Vehicle Model'),(26,'app','Color'),(27,'app','Plate Number'),(28,'app','Vehicle Image'),(29,'app','Cancelation Cause'),(30,'app','Added Date'),(31,'app','Updated Date'),(32,'app','Module'),(33,'app','Title'),(34,'app','Route'),(35,'app','Description'),(36,'app','Keyword'),(37,'app','Updated At'),(38,'app','Category'),(39,'app','Message'),(40,'app','Email Code'),(41,'app','About'),(42,'app','Subject'),(43,'app','Body'),(44,'app','Variable'),(45,'app','Created At'),(46,'app','Mobile number is invalid'),(47,'app','Current Password'),(48,'app','New Password'),(49,'app','Retype Password'),(50,'app','Current password is incorrect.'),(51,'app','Current password and New Password can\'t be same.');
/*!40000 ALTER TABLE `sourcemessage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'West Bengal',1);
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_master`
--

DROP TABLE IF EXISTS `user_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(1) NOT NULL DEFAULT '3' COMMENT '1=>superadmin, 2=>subadmin,3=>user',
  `reg_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>site_reg, 2=>facebook_reg 3=>google_reg',
  `google_id` varchar(250) DEFAULT NULL COMMENT 'google user id',
  `facebook_id` varchar(100) DEFAULT NULL COMMENT 'Facebook Id',
  `user_name` varchar(250) DEFAULT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>unknown, 1=>male, 2=>female',
  `email` varchar(250) DEFAULT NULL,
  `google_email` varchar(250) DEFAULT NULL COMMENT 'email id which are return from google api',
  `facebook_email` varchar(250) DEFAULT NULL COMMENT 'email id which are return from facebook api',
  `email_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>not_verified,1=>verified',
  `email_verification_code` varchar(50) DEFAULT NULL,
  `image` text COMMENT 'User uploaded image',
  `phone_code` int(11) NOT NULL DEFAULT '0' COMMENT 'pk of country_phonecodes table',
  `mobile` varchar(20) DEFAULT NULL,
  `mobile_verification_code` varchar(30) DEFAULT NULL,
  `mobile_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>No, 1=>Yes',
  `dob` varchar(30) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `reset_password_token` varchar(250) NOT NULL,
  `bio` text,
  `activation_token` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>inactive, 1=> active, 2=>suspended,3=>delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_master`
--

LOCK TABLES `user_master` WRITE;
/*!40000 ALTER TABLE `user_master` DISABLE KEYS */;
INSERT INTO `user_master` VALUES (1,1,1,NULL,NULL,'','SuperAdmin','Admin',0,'admin',NULL,NULL,0,NULL,NULL,91,'9038747504','',0,NULL,'$2y$13$5Yff6y19QMMwQn6.r9PQf.sCvG360sNm8DAtd540DlYdE/cW2Nm5W','',NULL,NULL,1,'2017-04-18 07:19:24','2017-04-18 07:19:24');
/*!40000 ALTER TABLE `user_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Admin'),(2,'Sub Admin'),(3,'User');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-11 23:00:01
