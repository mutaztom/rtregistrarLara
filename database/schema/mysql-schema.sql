/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblcity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(100) DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblcomlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcomlog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address` longtext,
  `status` longtext,
  `smstime` datetime DEFAULT NULL,
  `byuser` longtext,
  `title` longtext,
  `message` longtext,
  `email` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblcontact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontact` (
  `id` int NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `EMail` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `otherPhone` varchar(255) DEFAULT NULL,
  `ownerid` int DEFAULT NULL,
  `ownertype` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblcurrency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcurrency` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fraction` double DEFAULT NULL,
  `isMain` tinyint(1) DEFAULT '0',
  `item` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `shortName` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tbleducation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbleducation` (
  `id` int NOT NULL,
  `item` varchar(255) DEFAULT NULL,
  `aritem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblemployment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblemployment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(100) DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblengclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblengclass` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `aritem` varchar(100) DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblengdegree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblengdegree` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mainid` int DEFAULT NULL,
  `aritem` varchar(100) DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblexchange`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblexchange` (
  `id` int NOT NULL AUTO_INCREMENT,
  `byuser` varchar(255) DEFAULT NULL,
  `currency` int DEFAULT NULL,
  `entryDate` datetime DEFAULT NULL,
  `rate` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblexpense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblexpense` (
  `id` int NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT '0',
  `currency` int DEFAULT NULL,
  `exptype` varchar(255) DEFAULT NULL,
  `formula` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `localCurrency` tinyint(1) DEFAULT '0',
  `owner` int DEFAULT NULL,
  `persent` tinyint(1) DEFAULT '0',
  `refference` varchar(255) DEFAULT NULL,
  `taxable` tinyint(1) DEFAULT '0',
  `taxamount` double DEFAULT NULL,
  `val` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblfees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblfees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `regclass` int DEFAULT NULL,
  `ondate` date DEFAULT NULL,
  `byuser` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `active` bit(1) DEFAULT NULL,
  `regdegree` int DEFAULT NULL,
  `amount` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblidcardtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblidcardtype` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(100) DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblinspection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblinspection` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `byuser` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `orderid` int DEFAULT NULL,
  `ondate` datetime DEFAULT NULL,
  `bymachine` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `notes` text,
  `itemchecked` varchar(200) DEFAULT NULL,
  `inspectresult` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblinspectresults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblinspectresults` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(200) DEFAULT NULL,
  `forfield` varchar(50) DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tbljob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbljob` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblmemberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmemberships` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblnationality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblnationality` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tbloption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbloption` (
  `id` int NOT NULL AUTO_INCREMENT,
  `forfield` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblpaylog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpaylog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `ondate` datetime DEFAULT NULL,
  `bankdate` varchar(20) DEFAULT NULL,
  `paystatus` bit(1) DEFAULT b'0',
  `amount` float DEFAULT NULL,
  `errordet` text,
  `rrn` varchar(50) DEFAULT NULL,
  `rpin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblpayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpayment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(150) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `orderid` int DEFAULT NULL,
  `ondate` date DEFAULT NULL,
  `receipt` varchar(50) DEFAULT NULL,
  `paid` bit(1) NOT NULL,
  `rrn` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblqualification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblqualification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `entity` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `degree` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `appid` int NOT NULL,
  `salary` float DEFAULT NULL,
  `qualtype` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `quality` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `empid` int DEFAULT NULL,
  `pdf` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblregisterrequest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblregisterrequest` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ownerid` int DEFAULT NULL,
  `ondate` date DEFAULT NULL,
  `rpin` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `regcat` int DEFAULT NULL,
  `regclass` int DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `workplace` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `job` int DEFAULT NULL,
  `ecshared` bit(1) DEFAULT b'0',
  `esocnotes` text,
  `esocstatus` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `esocdoc` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `esocuser` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `esocdate` datetime DEFAULT NULL,
  `ecunion` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `unionsecretary` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sciencesocity` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `socitysecretary` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `rejectreason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `decision` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `secgencomments` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `approvalDate` datetime DEFAULT NULL,
  `engcouncilNumber` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meetingno` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meetingdate` date DEFAULT NULL,
  `committeecomment` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `payed` bit(1) DEFAULT b'0',
  `byuser` varchar(50) DEFAULT NULL,
  `onmachine` varchar(50) DEFAULT NULL,
  `modifydate` date DEFAULT NULL,
  `noticed` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblregistrant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblregistrant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regname` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `regid` int DEFAULT NULL,
  `address` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nationality` int DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `photofile` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `job` int DEFAULT NULL,
  `birthplace` int DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `socityMember` bit(1) DEFAULT NULL,
  `hieducid` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `engcouncilid` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cvfile` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `pwd` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `membership` int DEFAULT NULL,
  `engsociety` int DEFAULT NULL,
  `ondate` date DEFAULT NULL,
  `specialization` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblregmemberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblregmemberships` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regid` int DEFAULT NULL,
  `socityid` int DEFAULT NULL,
  `memtype` int DEFAULT NULL,
  `ondate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblrejectreason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblrejectreason` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(200) DEFAULT NULL,
  `forfield` varchar(50) DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblservicelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblservicelog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(150) NOT NULL,
  `serviceid` int DEFAULT NULL,
  `empid` int DEFAULT NULL,
  `ondate` date DEFAULT NULL,
  `byuser` varchar(50) DEFAULT NULL,
  `fromstatus` varchar(50) DEFAULT NULL,
  `tostatus` varchar(50) DEFAULT NULL,
  `machine` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblsocieties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsocieties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblspecialization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblspecialization` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aritem` varchar(100) DEFAULT NULL,
  `forfield` int DEFAULT NULL,
  `mainid` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tblsystemoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsystemoption` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tblname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `defoption` int DEFAULT NULL,
  `aritem` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `vwmembership`;
/*!50001 DROP VIEW IF EXISTS `vwmembership`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vwmembership` AS SELECT 
 1 AS `regid`,
 1 AS `memdate`,
 1 AS `society`,
 1 AS `arsociety`,
 1 AS `membership`,
 1 AS `armembership`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `vwregisterrequest`;
/*!50001 DROP VIEW IF EXISTS `vwregisterrequest`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vwregisterrequest` AS SELECT 
 1 AS `id`,
 1 AS `item`,
 1 AS `ownerid`,
 1 AS `ondate`,
 1 AS `rpin`,
 1 AS `regcat`,
 1 AS `regclass`,
 1 AS `status`,
 1 AS `workplace`,
 1 AS `job`,
 1 AS `ecshared`,
 1 AS `esocnotes`,
 1 AS `esocstatus`,
 1 AS `esocdoc`,
 1 AS `esocuser`,
 1 AS `esocdate`,
 1 AS `ecunion`,
 1 AS `unionsecretary`,
 1 AS `sciencesocity`,
 1 AS `socitysecretary`,
 1 AS `rejectreason`,
 1 AS `decision`,
 1 AS `secgencomments`,
 1 AS `approvalDate`,
 1 AS `engcouncilNumber`,
 1 AS `committeecomment`,
 1 AS `meetingno`,
 1 AS `meetingdate`,
 1 AS `payed`,
 1 AS `regname`,
 1 AS `engclass`,
 1 AS `arengclass`,
 1 AS `engdegree`,
 1 AS `arengdegree`,
 1 AS `regjob`,
 1 AS `byuser`,
 1 AS `onmachine`,
 1 AS `modifydate`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `vwregistrant`;
/*!50001 DROP VIEW IF EXISTS `vwregistrant`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vwregistrant` AS SELECT 
 1 AS `id`,
 1 AS `ondate`,
 1 AS `regname`,
 1 AS `item`,
 1 AS `email`,
 1 AS `regid`,
 1 AS `address`,
 1 AS `nationality`,
 1 AS `phone`,
 1 AS `photofile`,
 1 AS `job`,
 1 AS `birthplace`,
 1 AS `birthdate`,
 1 AS `gender`,
 1 AS `socityMember`,
 1 AS `hieducid`,
 1 AS `engcouncilid`,
 1 AS `cvfile`,
 1 AS `pwd`,
 1 AS `membership`,
 1 AS `engsociety`,
 1 AS `regnationality`,
 1 AS `regjob`,
 1 AS `regbirthplace`,
 1 AS `regmembership`,
 1 AS `regengsociety`*/;
SET character_set_client = @saved_cs_client;
/*!50001 DROP VIEW IF EXISTS `vwmembership`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vwmembership` AS select `tblregmemberships`.`regid` AS `regid`,`tblregmemberships`.`ondate` AS `memdate`,`tblsocieties`.`item` AS `society`,`tblsocieties`.`aritem` AS `arsociety`,`tblmemberships`.`item` AS `membership`,`tblmemberships`.`aritem` AS `armembership` from ((`tblregmemberships` join `tblsocieties` on((`tblregmemberships`.`socityid` = `tblsocieties`.`id`))) left join `tblmemberships` on((`tblregmemberships`.`memtype` = `tblmemberships`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `vwregisterrequest`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vwregisterrequest` AS select `tblregisterrequest`.`id` AS `id`,`tblregisterrequest`.`item` AS `item`,`tblregisterrequest`.`ownerid` AS `ownerid`,`tblregisterrequest`.`ondate` AS `ondate`,`tblregisterrequest`.`rpin` AS `rpin`,`tblregisterrequest`.`regcat` AS `regcat`,`tblregisterrequest`.`regclass` AS `regclass`,`tblregisterrequest`.`status` AS `status`,`tblregisterrequest`.`workplace` AS `workplace`,`tblregisterrequest`.`job` AS `job`,`tblregisterrequest`.`ecshared` AS `ecshared`,`tblregisterrequest`.`esocnotes` AS `esocnotes`,`tblregisterrequest`.`esocstatus` AS `esocstatus`,`tblregisterrequest`.`esocdoc` AS `esocdoc`,`tblregisterrequest`.`esocuser` AS `esocuser`,`tblregisterrequest`.`esocdate` AS `esocdate`,`tblregisterrequest`.`ecunion` AS `ecunion`,`tblregisterrequest`.`unionsecretary` AS `unionsecretary`,`tblregisterrequest`.`sciencesocity` AS `sciencesocity`,`tblregisterrequest`.`socitysecretary` AS `socitysecretary`,`tblregisterrequest`.`rejectreason` AS `rejectreason`,`tblregisterrequest`.`decision` AS `decision`,`tblregisterrequest`.`secgencomments` AS `secgencomments`,`tblregisterrequest`.`approvalDate` AS `approvalDate`,`tblregisterrequest`.`engcouncilNumber` AS `engcouncilNumber`,`tblregisterrequest`.`committeecomment` AS `committeecomment`,`tblregisterrequest`.`meetingno` AS `meetingno`,`tblregisterrequest`.`meetingdate` AS `meetingdate`,`tblregisterrequest`.`payed` AS `payed`,`tblregistrant`.`regname` AS `regname`,`tblengclass`.`item` AS `engclass`,`tblengclass`.`aritem` AS `arengclass`,`tblengdegree`.`item` AS `engdegree`,`tblengdegree`.`aritem` AS `arengdegree`,`tbljob`.`item` AS `regjob`,`tblregisterrequest`.`byuser` AS `byuser`,`tblregisterrequest`.`onmachine` AS `onmachine`,`tblregisterrequest`.`modifydate` AS `modifydate` from ((((`tblregisterrequest` left join `tblregistrant` on((`tblregisterrequest`.`ownerid` = `tblregistrant`.`id`))) left join `tblengclass` on((`tblregisterrequest`.`regclass` = `tblengclass`.`id`))) left join `tblengdegree` on((`tblregisterrequest`.`regcat` = `tblengdegree`.`id`))) left join `tbljob` on((`tblregisterrequest`.`job` = `tbljob`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `vwregistrant`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vwregistrant` AS select `tblregistrant`.`id` AS `id`,`tblregistrant`.`ondate` AS `ondate`,`tblregistrant`.`regname` AS `regname`,`tblregistrant`.`regname` AS `item`,`tblregistrant`.`email` AS `email`,`tblregistrant`.`regid` AS `regid`,`tblregistrant`.`address` AS `address`,`tblregistrant`.`nationality` AS `nationality`,`tblregistrant`.`phone` AS `phone`,`tblregistrant`.`photofile` AS `photofile`,`tblregistrant`.`job` AS `job`,`tblregistrant`.`birthplace` AS `birthplace`,`tblregistrant`.`birthdate` AS `birthdate`,`tblregistrant`.`gender` AS `gender`,`tblregistrant`.`socityMember` AS `socityMember`,`tblregistrant`.`hieducid` AS `hieducid`,`tblregistrant`.`engcouncilid` AS `engcouncilid`,`tblregistrant`.`cvfile` AS `cvfile`,`tblregistrant`.`pwd` AS `pwd`,`tblregistrant`.`membership` AS `membership`,`tblregistrant`.`engsociety` AS `engsociety`,`tblnationality`.`item` AS `regnationality`,`tbljob`.`item` AS `regjob`,`tblcity`.`item` AS `regbirthplace`,`tblmemberships`.`item` AS `regmembership`,`tblsocieties`.`item` AS `regengsociety` from (((((`tblregistrant` left join `tblnationality` on((`tblregistrant`.`nationality` = `tblnationality`.`id`))) left join `tbljob` on((`tblregistrant`.`job` = `tbljob`.`id`))) left join `tblcity` on((`tblregistrant`.`birthplace` = `tblcity`.`id`))) left join `tblmemberships` on((`tblregistrant`.`membership` = `tblmemberships`.`id`))) left join `tblsocieties` on((`tblregistrant`.`engsociety` = `tblsocieties`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
