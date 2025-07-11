-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: noticia
-- ------------------------------------------------------
-- Server version	9.3.0

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
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noticias` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `titulo` varchar(50) DEFAULT NULL,
  `contenido` text,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_noticia` varchar(30) NOT NULL DEFAULT 'sin asignar',
  `imagen` longblob,
  `tipo_imagen` varchar(100) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` VALUES (1,'ejemplo titulo','el perro pepe ','2025-07-06 23:22:49','noticia',"imagesDb/686da6451b84c-Ruben-feng.jpg"," imagesDb/686da6451b84c-Ruben-feng.jpg",'ruben'),(2,'titulo1','Jhon lenon','2025-07-06 23:23:17','noticia',NULL,NULL,'ruben'),(3,'dbawdawfa','awdawdawgdaw','2025-07-07 00:56:15','notcia',NULL,NULL,'ddddd'),(4,'dxzccczx','ffffffsdffsefs','2025-07-07 00:56:29','dd',NULL,NULL,'haoiwd');
INSERT INTO noticias (titulo, contenido, fecha, tipo_noticia, tipo_imagen, autor, imagen)
VALUES (
  'Aprende a hacer mewing en 10 sencillos pasos',
  'Mewinistico',
  '2025-07-08 17:57:37',
  'sexual',
  'image/png',
  'V.kr',
  'imagesDb/686da261c15a8-rey.png'
);

/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;

--
-- Table structure for table `table_name`
--

DROP TABLE IF EXISTS `table_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_name` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido` varchar(50) DEFAULT NULL,
  `Usuario` varchar(50) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `HashMagic` varchar(50) DEFAULT NULL,
  `FechaSistema` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='dawd';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_name`
--

/*!40000 ALTER TABLE `table_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_name` ENABLE KEYS */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido` varchar(50) DEFAULT NULL,
  `Usuario` varchar(50) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `HashMagic` varchar(255) DEFAULT NULL,
  `FechaSistema` date DEFAULT NULL,
  `secret_2fa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Usuario` (`Usuario`),
  UNIQUE KEY `Correo` (`Correo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='dawd';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (5,'test','test','test','test@test.com','$2y$12$fVBzDVuX5FSKmqWmKlyeXu.azJfrrOTk2C3OOHWdP14AVc942hTpi','2025-07-06','2MDX2CYSOKWN3ZYJ');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

--
-- Dumping routines for database 'noticia'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-06 19:58:21
