-- MySQL dump 10.13  Distrib 8.0.30, for macos12.5 (arm64)
--
-- Host: 192.168.0.3    Database: expense_claim
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `additional_information`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `additional_information` (
                                          `id` int NOT NULL AUTO_INCREMENT,
                                          `expense_id` int DEFAULT NULL,
                                          `text` text COLLATE utf8mb4_unicode_ci,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additional_information`
--

/*!40000 ALTER TABLE `additional_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `additional_information` ENABLE KEYS */;

--
-- Table structure for table `bank`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bank` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `participant_id` int DEFAULT NULL,
                        `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `address` tinytext COLLATE utf8mb4_unicode_ci,
                        `holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `type` int DEFAULT NULL,
                        `currency` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `number` int DEFAULT NULL,
                        `number_type` int DEFAULT NULL,
                        `code` int DEFAULT NULL,
                        `code_type` int DEFAULT NULL,
                        PRIMARY KEY (`id`),
                        KEY `bank_bank_code_type_id_fk` (`code_type`),
                        KEY `bank_bank_number_type_id_fk` (`number_type`),
                        KEY `bank_participant_id_fk` (`participant_id`),
                        CONSTRAINT `bank_bank_code_type_id_fk` FOREIGN KEY (`code_type`) REFERENCES `bank_code_type` (`id`),
                        CONSTRAINT `bank_bank_number_type_id_fk` FOREIGN KEY (`number_type`) REFERENCES `bank_number_type` (`id`),
                        CONSTRAINT `bank_participant_id_fk` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;

--
-- Table structure for table `bank_code_type`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bank_code_type` (
                                  `id` int NOT NULL AUTO_INCREMENT,
                                  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_code_type`
--

/*!40000 ALTER TABLE `bank_code_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_code_type` ENABLE KEYS */;

--
-- Table structure for table `bank_number_type`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bank_number_type` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_number_type`
--

/*!40000 ALTER TABLE `bank_number_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_number_type` ENABLE KEYS */;

--
-- Table structure for table `claim`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `claim` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `participant_id` int DEFAULT NULL,
                         `claim_date` date DEFAULT NULL,
                         `visit_date` date DEFAULT NULL,
                         `site_number` int DEFAULT NULL,
                         `study_reference` int DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         KEY `claim_participant_id_fk` (`participant_id`),
                         CONSTRAINT `claim_participant_id_fk` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `claim`
--

/*!40000 ALTER TABLE `claim` DISABLE KEYS */;
/*!40000 ALTER TABLE `claim` ENABLE KEYS */;

--
-- Table structure for table `expense`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `type` int DEFAULT NULL,
                           `amount` int DEFAULT NULL,
                           `unit_type` int DEFAULT NULL,
                           `claim_id` int DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense`
--

/*!40000 ALTER TABLE `expense` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense` ENABLE KEYS */;

--
-- Table structure for table `expense_type`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_type` (
                                `id` int NOT NULL AUTO_INCREMENT,
                                `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_type`
--

/*!40000 ALTER TABLE `expense_type` DISABLE KEYS */;
INSERT INTO `expense_type` VALUES (1,'Rail Fare'),(2,'Taxi Fare');
/*!40000 ALTER TABLE `expense_type` ENABLE KEYS */;

--
-- Table structure for table `expense_unit`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_unit` (
                                `id` int NOT NULL AUTO_INCREMENT,
                                `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_unit`
--

/*!40000 ALTER TABLE `expense_unit` DISABLE KEYS */;
INSERT INTO `expense_unit` VALUES (1,'Currency'),(2,'Mileage');
/*!40000 ALTER TABLE `expense_unit` ENABLE KEYS */;

--
-- Table structure for table `other_expense`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `other_expense` (
                                 `id` int NOT NULL AUTO_INCREMENT,
                                 `name` int DEFAULT NULL,
                                 `participant_id` int DEFAULT NULL,
                                 PRIMARY KEY (`id`),
                                 KEY `other_expense_participant_id_fk` (`participant_id`),
                                 CONSTRAINT `other_expense_participant_id_fk` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `other_expense`
--

/*!40000 ALTER TABLE `other_expense` DISABLE KEYS */;
/*!40000 ALTER TABLE `other_expense` ENABLE KEYS */;

--
-- Table structure for table `participant`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participant` (
                               `id` int NOT NULL AUTO_INCREMENT,
                               `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               `email` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participant`
--

/*!40000 ALTER TABLE `participant` DISABLE KEYS */;
/*!40000 ALTER TABLE `participant` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-16  2:55:34
