-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: worldfitsbd
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `calendario_rutinario`
--

DROP TABLE IF EXISTS `calendario_rutinario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendario_rutinario` (
  `id_calendario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_personalizado` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`id_calendario`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `calendario_rutinario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendario_rutinario`
--

LOCK TABLES `calendario_rutinario` WRITE;
/*!40000 ALTER TABLE `calendario_rutinario` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendario_rutinario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_gyms`
--

DROP TABLE IF EXISTS `categorias_gyms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias_gyms` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_gyms`
--

LOCK TABLES `categorias_gyms` WRITE;
/*!40000 ALTER TABLE `categorias_gyms` DISABLE KEYS */;
INSERT INTO `categorias_gyms` VALUES (1,'Categoria 1'),(2,'Crossfit'),(3,'Categoria 2');
/*!40000 ALTER TABLE `categorias_gyms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_rutinas`
--

DROP TABLE IF EXISTS `categorias_rutinas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias_rutinas` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_rutinas`
--

LOCK TABLES `categorias_rutinas` WRITE;
/*!40000 ALTER TABLE `categorias_rutinas` DISABLE KEYS */;
INSERT INTO `categorias_rutinas` VALUES (1,'Tren Superior'),(2,'Tren Inferiror');
/*!40000 ALTER TABLE `categorias_rutinas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dias_semana`
--

DROP TABLE IF EXISTS `dias_semana`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dias_semana` (
  `id_dia` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_dia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dias_semana`
--

LOCK TABLES `dias_semana` WRITE;
/*!40000 ALTER TABLE `dias_semana` DISABLE KEYS */;
INSERT INTO `dias_semana` VALUES (0,'Domingo'),(1,'Lunes'),(2,'Martes'),(3,'Miercoles'),(4,'Jueves'),(5,'Viernes'),(6,'Sabado');
/*!40000 ALTER TABLE `dias_semana` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ejercicio_rutinas`
--

DROP TABLE IF EXISTS `ejercicio_rutinas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ejercicio_rutinas` (
  `id_relacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_rutina` int(11) DEFAULT NULL,
  `id_ejercicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_relacion`),
  KEY `id_rutina` (`id_rutina`),
  KEY `id_ejercicio` (`id_ejercicio`),
  CONSTRAINT `ejercicio_rutinas_ibfk_1` FOREIGN KEY (`id_rutina`) REFERENCES `rutinas` (`id_rutina`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ejercicio_rutinas_ibfk_2` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicios` (`id_ejercicio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ejercicio_rutinas`
--

LOCK TABLES `ejercicio_rutinas` WRITE;
/*!40000 ALTER TABLE `ejercicio_rutinas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ejercicio_rutinas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ejercicios` (
  `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `Instrucctiones` varchar(200) NOT NULL,
  `equipoNecesario` varchar(300) DEFAULT NULL,
  `repeticiones` varchar(10) NOT NULL,
  `seires` varchar(10) NOT NULL,
  `tiempo_descanso` int(11) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `direccion_media` varchar(200) DEFAULT NULL,
  `dateLastUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ejercicios`
--

LOCK TABLES `ejercicios` WRITE;
/*!40000 ALTER TABLE `ejercicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `ejercicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genero` (
  `id_genero` tinyint(1) NOT NULL,
  `genero` varchar(100) NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Masculino'),(2,'Femenino'),(3,'Otro');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infogyms`
--

DROP TABLE IF EXISTS `infogyms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `infogyms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `description` varchar(300) NOT NULL,
  `mission` varchar(300) NOT NULL,
  `vision` varchar(300) NOT NULL,
  `pathImage` varchar(200) NOT NULL,
  `time_start_morning_DAY` varchar(100) DEFAULT NULL,
  `time_end_morning_DAY` varchar(100) DEFAULT NULL,
  `time_start_afternoon_DAY` varchar(100) DEFAULT NULL,
  `time_end_afternoon_DAY` varchar(100) DEFAULT NULL,
  `time_start_morning_END` varchar(100) DEFAULT NULL,
  `time_end_morning_END` varchar(100) DEFAULT NULL,
  `time_start_afternoon_END` varchar(100) DEFAULT NULL,
  `time_end_afternoon_END` varchar(100) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `mail` varchar(200) DEFAULT NULL,
  `direction` varchar(200) DEFAULT NULL,
  `id_pay` int(11) DEFAULT NULL,
  `id_gerente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_gerente` (`id_gerente`),
  KEY `id_pay` (`id_pay`),
  CONSTRAINT `infogyms_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_gyms` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `infogyms_ibfk_2` FOREIGN KEY (`id_gerente`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `infogyms_ibfk_3` FOREIGN KEY (`id_pay`) REFERENCES `payment_methods_gyms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infogyms`
--

LOCK TABLES `infogyms` WRITE;
/*!40000 ALTER TABLE `infogyms` DISABLE KEYS */;
/*!40000 ALTER TABLE `infogyms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods_gyms`
--

DROP TABLE IF EXISTS `payment_methods_gyms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_methods_gyms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods_gyms`
--

LOCK TABLES `payment_methods_gyms` WRITE;
/*!40000 ALTER TABLE `payment_methods_gyms` DISABLE KEYS */;
INSERT INTO `payment_methods_gyms` VALUES (1,'Transfierencia'),(2,'Efectivo');
/*!40000 ALTER TABLE `payment_methods_gyms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relacion_calendario_rutinas`
--

DROP TABLE IF EXISTS `relacion_calendario_rutinas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relacion_calendario_rutinas` (
  `id_relacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_calendario` int(11) DEFAULT NULL,
  `id_dia` int(11) DEFAULT NULL,
  `id_rutina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_relacion`),
  KEY `id_calendario` (`id_calendario`),
  KEY `id_dia` (`id_dia`),
  KEY `id_rutina` (`id_rutina`),
  CONSTRAINT `relacion_calendario_rutinas_ibfk_1` FOREIGN KEY (`id_calendario`) REFERENCES `calendario_rutinario` (`id_calendario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relacion_calendario_rutinas_ibfk_2` FOREIGN KEY (`id_dia`) REFERENCES `dias_semana` (`id_dia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relacion_calendario_rutinas_ibfk_3` FOREIGN KEY (`id_rutina`) REFERENCES `rutinas` (`id_rutina`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relacion_calendario_rutinas`
--

LOCK TABLES `relacion_calendario_rutinas` WRITE;
/*!40000 ALTER TABLE `relacion_calendario_rutinas` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacion_calendario_rutinas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relacion_dia_rutina`
--

DROP TABLE IF EXISTS `relacion_dia_rutina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relacion_dia_rutina` (
  `id_relacion_d_r` int(11) NOT NULL AUTO_INCREMENT,
  `id_dia` int(11) DEFAULT NULL,
  `id_rutina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_relacion_d_r`),
  KEY `id_dia` (`id_dia`),
  KEY `id_rutina` (`id_rutina`),
  CONSTRAINT `relacion_dia_rutina_ibfk_1` FOREIGN KEY (`id_dia`) REFERENCES `dias_semana` (`id_dia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relacion_dia_rutina_ibfk_2` FOREIGN KEY (`id_rutina`) REFERENCES `rutinas` (`id_rutina`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relacion_dia_rutina`
--

LOCK TABLES `relacion_dia_rutina` WRITE;
/*!40000 ALTER TABLE `relacion_dia_rutina` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacion_dia_rutina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Invitado'),(3,'Super-Admin'),(4,'Gerente de gimnasio');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rutinas`
--

DROP TABLE IF EXISTS `rutinas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rutinas` (
  `id_rutina` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRutina` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `objetivo` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rutina`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `rutinas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_rutinas` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutinas`
--

LOCK TABLES `rutinas` WRITE;
/*!40000 ALTER TABLE `rutinas` DISABLE KEYS */;
/*!40000 ALTER TABLE `rutinas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_registration_indexes`
--

DROP TABLE IF EXISTS `user_registration_indexes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_registration_indexes` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `IMC` int(11) NOT NULL,
  PRIMARY KEY (`id_registro`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `user_registration_indexes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_registration_indexes`
--

LOCK TABLES `user_registration_indexes` WRITE;
/*!40000 ALTER TABLE `user_registration_indexes` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_registration_indexes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `peso_actual` float NOT NULL,
  `altura_actual` float NOT NULL,
  `id_genero` tinyint(1) DEFAULT NULL,
  `telefono` varchar(20) NOT NULL,
  `pr` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `imgPerfil` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_genero` (`id_genero`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Usuario','Administrador','admin@gmail.com','$2y$10$oVz5nr6qgn6yQ2aJ1bHGC.3GbjfSJ6hgtigA/d4brWmrcncLXj3Ru',46,1.7,1,'3115963326',NULL,'2024-08-07 11:18:33',1,'../view/user img/default_img.PNG');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-07 11:19:31
