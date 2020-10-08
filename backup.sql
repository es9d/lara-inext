-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`),
  KEY `subject` (`subject_id`,`subject_type`),
  KEY `causer` (`causer_id`,`causer_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'main',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint unsigned NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double(8,2) DEFAULT NULL,
  `lng` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `addresses_model_id_model_type_role_unique` (`model_id`,`model_type`,`role`),
  KEY `addresses_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_uid_unique` (`uid`),
  KEY `companies_owner_id_foreign` (`owner_id`),
  CONSTRAINT `companies_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'5f6a07bb9ec41',1,'My Awesome Company','2020-09-22 14:18:35','2020-09-22 14:18:35'),(2,'5f6a07e6be878',2,'pancy dev\'s Company','2020-09-22 14:19:18','2020-09-22 14:19:18');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_settings`
--

DROP TABLE IF EXISTS `company_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint unsigned DEFAULT NULL,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_settings_company_id_foreign` (`company_id`),
  CONSTRAINT `company_settings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_settings`
--

LOCK TABLES `company_settings` WRITE;
/*!40000 ALTER TABLE `company_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_user`
--

DROP TABLE IF EXISTS `company_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_user` (
  `user_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `company_user_user_id_foreign` (`user_id`),
  KEY `company_user_company_id_foreign` (`company_id`),
  CONSTRAINT `company_user_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `company_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_user`
--

LOCK TABLES `company_user` WRITE;
/*!40000 ALTER TABLE `company_user` DISABLE KEYS */;
INSERT INTO `company_user` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL);
/*!40000 ALTER TABLE `company_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonecode` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'AF','Afghanistan',93),(2,'AL','Albania',355),(3,'DZ','Algeria',213),(4,'AS','American Samoa',1684),(5,'AD','Andorra',376),(6,'AO','Angola',244),(7,'AI','Anguilla',1264),(8,'AQ','Antarctica',0),(9,'AG','Antigua And Barbuda',1268),(10,'AR','Argentina',54),(11,'AM','Armenia',374),(12,'AW','Aruba',297),(13,'AU','Australia',61),(14,'AT','Austria',43),(15,'AZ','Azerbaijan',994),(16,'BS','Bahamas The',1242),(17,'BH','Bahrain',973),(18,'BD','Bangladesh',880),(19,'BB','Barbados',1246),(20,'BY','Belarus',375),(21,'BE','Belgium',32),(22,'BZ','Belize',501),(23,'BJ','Benin',229),(24,'BM','Bermuda',1441),(25,'BT','Bhutan',975),(26,'BO','Bolivia',591),(27,'BA','Bosnia and Herzegovina',387),(28,'BW','Botswana',267),(29,'BV','Bouvet Island',0),(30,'BR','Brazil',55),(31,'IO','British Indian Ocean Territory',246),(32,'BN','Brunei',673),(33,'BG','Bulgaria',359),(34,'BF','Burkina Faso',226),(35,'BI','Burundi',257),(36,'KH','Cambodia',855),(37,'CM','Cameroon',237),(38,'CA','Canada',1),(39,'CV','Cape Verde',238),(40,'KY','Cayman Islands',1345),(41,'CF','Central African Republic',236),(42,'TD','Chad',235),(43,'CL','Chile',56),(44,'CN','China',86),(45,'CX','Christmas Island',61),(46,'CC','Cocos (Keeling) Islands',672),(47,'CO','Colombia',57),(48,'KM','Comoros',269),(49,'CG','Congo',242),(50,'CD','Congo The Democratic Republic Of The',242),(51,'CK','Cook Islands',682),(52,'CR','Costa Rica',506),(53,'CI','Cote D Ivoire (Ivory Coast)',225),(54,'HR','Croatia (Hrvatska)',385),(55,'CU','Cuba',53),(56,'CY','Cyprus',357),(57,'CZ','Czech Republic',420),(58,'DK','Denmark',45),(59,'DJ','Djibouti',253),(60,'DM','Dominica',1767),(61,'DO','Dominican Republic',1809),(62,'TP','East Timor',670),(63,'EC','Ecuador',593),(64,'EG','Egypt',20),(65,'SV','El Salvador',503),(66,'GQ','Equatorial Guinea',240),(67,'ER','Eritrea',291),(68,'EE','Estonia',372),(69,'ET','Ethiopia',251),(70,'XA','External Territories of Australia',61),(71,'FK','Falkland Islands',500),(72,'FO','Faroe Islands',298),(73,'FJ','Fiji Islands',679),(74,'FI','Finland',358),(75,'FR','France',33),(76,'GF','French Guiana',594),(77,'PF','French Polynesia',689),(78,'TF','French Southern Territories',0),(79,'GA','Gabon',241),(80,'GM','Gambia The',220),(81,'GE','Georgia',995),(82,'DE','Germany',49),(83,'GH','Ghana',233),(84,'GI','Gibraltar',350),(85,'GR','Greece',30),(86,'GL','Greenland',299),(87,'GD','Grenada',1473),(88,'GP','Guadeloupe',590),(89,'GU','Guam',1671),(90,'GT','Guatemala',502),(91,'XU','Guernsey and Alderney',44),(92,'GN','Guinea',224),(93,'GW','Guinea-Bissau',245),(94,'GY','Guyana',592),(95,'HT','Haiti',509),(96,'HM','Heard and McDonald Islands',0),(97,'HN','Honduras',504),(98,'HK','Hong Kong S.A.R.',852),(99,'HU','Hungary',36),(100,'IS','Iceland',354),(101,'IN','India',91),(102,'ID','Indonesia',62),(103,'IR','Iran',98),(104,'IQ','Iraq',964),(105,'IE','Ireland',353),(106,'IL','Israel',972),(107,'IT','Italy',39),(108,'JM','Jamaica',1876),(109,'JP','Japan',81),(110,'XJ','Jersey',44),(111,'JO','Jordan',962),(112,'KZ','Kazakhstan',7),(113,'KE','Kenya',254),(114,'KI','Kiribati',686),(115,'KP','Korea North',850),(116,'KR','Korea South',82),(117,'KW','Kuwait',965),(118,'KG','Kyrgyzstan',996),(119,'LA','Laos',856),(120,'LV','Latvia',371),(121,'LB','Lebanon',961),(122,'LS','Lesotho',266),(123,'LR','Liberia',231),(124,'LY','Libya',218),(125,'LI','Liechtenstein',423),(126,'LT','Lithuania',370),(127,'LU','Luxembourg',352),(128,'MO','Macau S.A.R.',853),(129,'MK','Macedonia',389),(130,'MG','Madagascar',261),(131,'MW','Malawi',265),(132,'MY','Malaysia',60),(133,'MV','Maldives',960),(134,'ML','Mali',223),(135,'MT','Malta',356),(136,'XM','Man (Isle of)',44),(137,'MH','Marshall Islands',692),(138,'MQ','Martinique',596),(139,'MR','Mauritania',222),(140,'MU','Mauritius',230),(141,'YT','Mayotte',269),(142,'MX','Mexico',52),(143,'FM','Micronesia',691),(144,'MD','Moldova',373),(145,'MC','Monaco',377),(146,'MN','Mongolia',976),(147,'MS','Montserrat',1664),(148,'MA','Morocco',212),(149,'MZ','Mozambique',258),(150,'MM','Myanmar',95),(151,'NA','Namibia',264),(152,'NR','Nauru',674),(153,'NP','Nepal',977),(154,'AN','Netherlands Antilles',599),(155,'NL','Netherlands The',31),(156,'NC','New Caledonia',687),(157,'NZ','New Zealand',64),(158,'NI','Nicaragua',505),(159,'NE','Niger',227),(160,'NG','Nigeria',234),(161,'NU','Niue',683),(162,'NF','Norfolk Island',672),(163,'MP','Northern Mariana Islands',1670),(164,'NO','Norway',47),(165,'OM','Oman',968),(166,'PK','Pakistan',92),(167,'PW','Palau',680),(168,'PS','Palestinian Territory Occupied',970),(169,'PA','Panama',507),(170,'PG','Papua new Guinea',675),(171,'PY','Paraguay',595),(172,'PE','Peru',51),(173,'PH','Philippines',63),(174,'PN','Pitcairn Island',0),(175,'PL','Poland',48),(176,'PT','Portugal',351),(177,'PR','Puerto Rico',1787),(178,'QA','Qatar',974),(179,'RE','Reunion',262),(180,'RO','Romania',40),(181,'RU','Russia',70),(182,'RW','Rwanda',250),(183,'SH','Saint Helena',290),(184,'KN','Saint Kitts And Nevis',1869),(185,'LC','Saint Lucia',1758),(186,'PM','Saint Pierre and Miquelon',508),(187,'VC','Saint Vincent And The Grenadines',1784),(188,'WS','Samoa',684),(189,'SM','San Marino',378),(190,'ST','Sao Tome and Principe',239),(191,'SA','Saudi Arabia',966),(192,'SN','Senegal',221),(193,'RS','Serbia',381),(194,'SC','Seychelles',248),(195,'SL','Sierra Leone',232),(196,'SG','Singapore',65),(197,'SK','Slovakia',421),(198,'SI','Slovenia',386),(199,'XG','Smaller Territories of the UK',44),(200,'SB','Solomon Islands',677),(201,'SO','Somalia',252),(202,'ZA','South Africa',27),(203,'GS','South Georgia',0),(204,'SS','South Sudan',211),(205,'ES','Spain',34),(206,'LK','Sri Lanka',94),(207,'SD','Sudan',249),(208,'SR','Suriname',597),(209,'SJ','Svalbard And Jan Mayen Islands',47),(210,'SZ','Swaziland',268),(211,'SE','Sweden',46),(212,'CH','Switzerland',41),(213,'SY','Syria',963),(214,'TW','Taiwan',886),(215,'TJ','Tajikistan',992),(216,'TZ','Tanzania',255),(217,'TH','Thailand',66),(218,'TG','Togo',228),(219,'TK','Tokelau',690),(220,'TO','Tonga',676),(221,'TT','Trinidad And Tobago',1868),(222,'TN','Tunisia',216),(223,'TR','Turkey',90),(224,'TM','Turkmenistan',7370),(225,'TC','Turks And Caicos Islands',1649),(226,'TV','Tuvalu',688),(227,'UG','Uganda',256),(228,'UA','Ukraine',380),(229,'AE','United Arab Emirates',971),(230,'GB','United Kingdom',44),(231,'US','United States',1),(232,'UM','United States Minor Outlying Islands',1),(233,'UY','Uruguay',598),(234,'UZ','Uzbekistan',998),(235,'VU','Vanuatu',678),(236,'VA','Vatican City State (Holy See)',39),(237,'VE','Venezuela',58),(238,'VN','Vietnam',84),(239,'VG','Virgin Islands (British)',1284),(240,'VI','Virgin Islands (US)',1340),(241,'WF','Wallis And Futuna Islands',681),(242,'EH','Western Sahara',212),(243,'YE','Yemen',967),(244,'YU','Yugoslavia',38),(245,'ZM','Zambia',260),(246,'ZW','Zimbabwe',263);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precision` int NOT NULL,
  `thousand_separator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decimal_separator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `swap_currency_symbol` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'US Dollar','USD','$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(2,'British Pound','GBP','£',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(3,'Euro','EUR','€',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(4,'South African Rand','ZAR','R',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(5,'Danish Krone','DKK','kr',2,'.',',',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(6,'Israeli Shekel','ILS','NIS ',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(7,'Swedish Krona','SEK','kr',2,'.',',',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(8,'Kenyan Shilling','KES','KSh ',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(9,'Kuwaiti Dinar','KWD','KWD ',3,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(10,'Canadian Dollar','CAD','C$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(11,'Philippine Peso','PHP','P ',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(12,'Indian Rupee','INR','₹',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(13,'Australian Dollar','AUD','$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(14,'Singapore Dollar','SGD','S$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(15,'Norske Kroner','NOK','kr',2,'.',',',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(16,'New Zealand Dollar','NZD','$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(17,'Vietnamese Dong','VND','₫',0,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(18,'Swiss Franc','CHF','Fr.',2,'\'','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(19,'Guatemalan Quetzal','GTQ','Q',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(20,'Malaysian Ringgit','MYR','RM',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(21,'Brazilian Real','BRL','R$',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(22,'Thai Baht','THB','฿',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(23,'Nigerian Naira','NGN','₦',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(24,'Argentine Peso','ARS','$',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(25,'Bangladeshi Taka','BDT','Tk',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(26,'United Arab Emirates Dirham','AED','DH ',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(27,'Hong Kong Dollar','HKD','HK$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(28,'Indonesian Rupiah','IDR','Rp',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(29,'Mexican Peso','MXN','$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(30,'Egyptian Pound','EGP','E£',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(31,'Colombian Peso','COP','$',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(32,'West African Franc','XOF','CFA ',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(33,'Chinese Renminbi','CNY','RMB ',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(34,'Rwandan Franc','RWF','RF ',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(35,'Tanzanian Shilling','TZS','TSh ',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(36,'Netherlands Antillean Guilder','ANG','NAƒ',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(37,'Trinidad and Tobago Dollar','TTD','TT$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(38,'East Caribbean Dollar','XCD','EC$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(39,'Ghanaian Cedi','GHS','‎GH₵',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(40,'Bulgarian Lev','BGN','Лв.',2,' ','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(41,'Aruban Florin','AWG','Afl. ',2,' ','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(42,'Turkish Lira','TRY','TL ',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(43,'Romanian New Leu','RON','RON',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(44,'Croatian Kuna','HRK','kn',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(45,'Saudi Riyal','SAR','‎SِAR',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(46,'Japanese Yen','JPY','¥',0,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(47,'Maldivian Rufiyaa','MVR','Rf',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(48,'Costa Rican Colón','CRC','₡',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(49,'Pakistani Rupee','PKR','Rs ',0,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(50,'Polish Zloty','PLN','zł',2,' ',',',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(51,'Sri Lankan Rupee','LKR','LKR',2,',','.',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(52,'Czech Koruna','CZK','Kč',2,' ',',',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(53,'Uruguayan Peso','UYU','$',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(54,'Namibian Dollar','NAD','$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(55,'Tunisian Dinar','TND','‎د.ت',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(56,'Russian Ruble','RUB','₽',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(57,'Mozambican Metical','MZN','MT',2,'.',',',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(58,'Omani Rial','OMR','ر.ع.',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(59,'Ukrainian Hryvnia','UAH','₴',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(60,'Macanese Pataca','MOP','MOP$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(61,'Taiwan New Dollar','TWD','NT$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(62,'Dominican Peso','DOP','RD$',2,',','.',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(63,'Chilean Peso','CLP','$',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(64,'Serbian Dinar','RSD','RSD',2,'.',',',0,'2020-09-22 14:18:35','2020-09-22 14:18:35');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_same_billandship` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_uid_unique` (`uid`),
  UNIQUE KEY `customers_company_id_email_unique` (`company_id`,`email`),
  KEY `customers_currency_id_foreign` (`currency_id`),
  CONSTRAINT `customers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customers_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimate_items`
--

DROP TABLE IF EXISTS `estimate_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estimate_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `estimate_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `discount_val` bigint unsigned DEFAULT NULL,
  `price` bigint unsigned NOT NULL,
  `total` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estimate_items_product_id_foreign` (`product_id`),
  KEY `estimate_items_estimate_id_foreign` (`estimate_id`),
  KEY `estimate_items_company_id_foreign` (`company_id`),
  CONSTRAINT `estimate_items_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `estimate_items_estimate_id_foreign` FOREIGN KEY (`estimate_id`) REFERENCES `estimates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `estimate_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimate_items`
--

LOCK TABLES `estimate_items` WRITE;
/*!40000 ALTER TABLE `estimate_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `estimate_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimates`
--

DROP TABLE IF EXISTS `estimates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estimates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `estimate_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `estimate_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_per_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_per_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `private_notes` text COLLATE utf8mb4_unicode_ci,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_val` bigint unsigned DEFAULT NULL,
  `sub_total` bigint unsigned NOT NULL,
  `total` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `estimates_uid_unique` (`uid`),
  KEY `estimates_customer_id_foreign` (`customer_id`),
  KEY `estimates_company_id_foreign` (`company_id`),
  CONSTRAINT `estimates_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `estimates_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimates`
--

LOCK TABLES `estimates` WRITE;
/*!40000 ALTER TABLE `estimates` DISABLE KEYS */;
/*!40000 ALTER TABLE `estimates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_categories`
--

DROP TABLE IF EXISTS `expense_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_categories_company_id_foreign` (`company_id`),
  CONSTRAINT `expense_categories_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_categories`
--

LOCK TABLES `expense_categories` WRITE;
/*!40000 ALTER TABLE `expense_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint unsigned DEFAULT NULL,
  `expense_category_id` bigint unsigned DEFAULT NULL,
  `vendor_id` bigint unsigned DEFAULT NULL,
  `expense_date` date NOT NULL,
  `amount` bigint unsigned NOT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_gst` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `expenses_company_id_foreign` (`company_id`),
  KEY `expenses_expense_category_id_foreign` (`expense_category_id`),
  KEY `expenses_vendor_id_foreign` (`vendor_id`),
  CONSTRAINT `expenses_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`),
  CONSTRAINT `expenses_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `expense_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint unsigned NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_val` bigint unsigned DEFAULT NULL,
  `total` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  KEY `invoice_items_product_id_foreign` (`product_id`),
  KEY `invoice_items_company_id_foreign` (`company_id`),
  CONSTRAINT `invoice_items_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoice_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_per_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_per_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `private_notes` text COLLATE utf8mb4_unicode_ci,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_val` bigint unsigned DEFAULT NULL,
  `sub_total` bigint unsigned NOT NULL,
  `total` bigint unsigned NOT NULL,
  `due_amount` bigint unsigned NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_uid_unique` (`uid`),
  KEY `invoices_customer_id_foreign` (`customer_id`),
  KEY `invoices_company_id_foreign` (`company_id`),
  CONSTRAINT `invoices_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `manipulations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_properties` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsive_images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2020_01_01_000001_create_companies_table',1),(3,'2020_01_01_000002_create_users_table',1),(4,'2020_01_01_000004_create_jobs_table',1),(5,'2020_01_01_000005_create_currencies_table',1),(6,'2020_01_01_000006_create_countries_table',1),(7,'2020_01_01_000007_create_notifications_table',1),(8,'2020_01_01_000008_create_permission_tables',1),(9,'2020_01_01_000009_create_customers_table',1),(10,'2020_01_01_000010_create_addresses_table',1),(11,'2020_01_01_000011_create_product_unit_table',1),(12,'2020_01_01_000012_create_products_table',1),(13,'2020_01_01_000013_create_media_table',1),(14,'2020_01_01_000014_create_tax_types_table',1),(15,'2020_01_01_000015_create_taxes_table',1),(16,'2020_01_01_000017_create_invoices_table',1),(17,'2020_01_01_000018_create_invoice_items_table',1),(18,'2020_01_01_000019_create_payment_methods_table',1),(19,'2020_01_01_000020_create_payments_table',1),(20,'2020_01_01_000022_create_estimates_table',1),(21,'2020_01_01_000023_create_estimate_items_table',1),(22,'2020_01_01_000024_create_ expense_categories_table',1),(23,'2020_01_01_000024_create_vendors_table',1),(24,'2020_01_01_000025_create_expenses_table',1),(25,'2020_01_01_000025_create_settings_table',1),(26,'2020_01_01_000026_create_user_settings_table',1),(27,'2020_05_19_172349_create_activity_log_table',1),(28,'2020_09_15_121233_add_is_gst_to_expenses_table',1),(29,'2020_09_16_215125_add_is_same_billandship_to_customer',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` int unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(3,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_methods_company_id_foreign` (`company_id`),
  CONSTRAINT `payment_methods_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` VALUES (1,'Cash',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(2,'Check',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(3,'Credit Card',1,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(4,'Bank Transfer',1,'2020-09-22 14:18:35','2020-09-22 14:18:35');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `invoice_id` bigint unsigned DEFAULT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `payment_method_id` bigint unsigned DEFAULT NULL,
  `transaction_reference` text COLLATE utf8mb4_unicode_ci,
  `amount` bigint unsigned NOT NULL,
  `payment_date` date NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `private_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_uid_unique` (`uid`),
  KEY `payments_customer_id_foreign` (`customer_id`),
  KEY `payments_company_id_foreign` (`company_id`),
  KEY `payments_invoice_id_foreign` (`invoice_id`),
  KEY `payments_payment_method_id_foreign` (`payment_method_id`),
  CONSTRAINT `payments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_units`
--

DROP TABLE IF EXISTS `product_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_units_company_id_foreign` (`company_id`),
  CONSTRAINT `product_units_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_units`
--

LOCK TABLES `product_units` WRITE;
/*!40000 ALTER TABLE `product_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `unit_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  `price` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_uid_unique` (`uid`),
  KEY `products_currency_id_foreign` (`currency_id`),
  KEY `products_unit_id_foreign` (`unit_id`),
  KEY `products_company_id_foreign` (`company_id`),
  CONSTRAINT `products_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `product_units` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','web','2020-09-22 14:18:35','2020-09-22 14:18:35'),(2,'admin','web','2020-09-22 14:18:35','2020-09-22 14:18:35'),(3,'staff','web','2020-09-22 14:18:35','2020-09-22 14:18:35');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_settings`
--

DROP TABLE IF EXISTS `system_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_settings`
--

LOCK TABLES `system_settings` WRITE;
/*!40000 ALTER TABLE `system_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_types`
--

DROP TABLE IF EXISTS `tax_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tax_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` decimal(5,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tax_types_company_id_foreign` (`company_id`),
  CONSTRAINT `tax_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_types`
--

LOCK TABLES `tax_types` WRITE;
/*!40000 ALTER TABLE `tax_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `tax_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `taxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint unsigned DEFAULT NULL,
  `tax_type_id` bigint unsigned DEFAULT NULL,
  `taxable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taxable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `taxes_taxable_type_taxable_id_index` (`taxable_type`,`taxable_id`),
  KEY `taxes_company_id_foreign` (`company_id`),
  KEY `taxes_tax_type_id_foreign` (`tax_type_id`),
  CONSTRAINT `taxes_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `taxes_tax_type_id_foreign` FOREIGN KEY (`tax_type_id`) REFERENCES `tax_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taxes`
--

LOCK TABLES `taxes` WRITE;
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_settings_user_id_foreign` (`user_id`),
  CONSTRAINT `user_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_settings`
--

LOCK TABLES `user_settings` WRITE;
/*!40000 ALTER TABLE `user_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_uid_unique` (`uid`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'5f6a07bb9db10','John','Doe','admin@mail.com',NULL,NULL,'$2y$10$bz4Q3naXXopoqQT.qxrvt.arM1458TpGsYF1HLMwhsL01G6wk5BwK',NULL,'2020-09-22 14:18:35','2020-09-22 14:18:35'),(2,'5f6a07e6bd45b','pancy','dev','pancyboxi@gmail.com','2020-09-22 14:21:23',NULL,'$2y$10$Sj6AlCLIbyub2AFGpXJhI.Z54OmCyjlSLyuJet1U/3BLYtBhwKOE2',NULL,'2020-09-22 14:19:18','2020-09-22 14:21:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint unsigned DEFAULT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vendors_company_id_email_unique` (`company_id`,`email`),
  CONSTRAINT `vendors_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-22 14:27:31
