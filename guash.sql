-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: guash
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `asignacion_maquina`
--

DROP TABLE IF EXISTS `asignacion_maquina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asignacion_maquina` (
  `id_asignacion` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int NOT NULL,
  `id_maquina` int NOT NULL,
  PRIMARY KEY (`id_asignacion`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_maquina` (`id_maquina`),
  CONSTRAINT `asignacion_maquina_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  CONSTRAINT `asignacion_maquina_ibfk_2` FOREIGN KEY (`id_maquina`) REFERENCES `maquina` (`id_maquina`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignacion_maquina`
--

LOCK TABLES `asignacion_maquina` WRITE;
/*!40000 ALTER TABLE `asignacion_maquina` DISABLE KEYS */;
INSERT INTO `asignacion_maquina` VALUES (1,23,3),(2,24,3),(3,25,1),(4,26,1),(5,27,1),(6,27,3),(8,29,3),(11,28,3),(12,30,2),(15,31,3),(16,31,2),(17,32,3),(18,32,2),(19,34,2),(20,33,1),(21,33,2),(22,36,2),(23,35,1);
/*!40000 ALTER TABLE `asignacion_maquina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cierre_diario`
--

DROP TABLE IF EXISTS `cierre_diario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cierre_diario` (
  `id_cierre` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `total_pedidos` int NOT NULL,
  `total_ingresos` decimal(10,2) DEFAULT NULL,
  `detergente_usado` int NOT NULL,
  `suavizante_usado` int NOT NULL,
  `otros_insumos_usados` int DEFAULT NULL,
  `energia_consumida` int DEFAULT NULL,
  `agua_consumida` int DEFAULT NULL,
  `gas_consumido` int DEFAULT NULL,
  PRIMARY KEY (`id_cierre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cierre_diario`
--

LOCK TABLES `cierre_diario` WRITE;
/*!40000 ALTER TABLE `cierre_diario` DISABLE KEYS */;
/*!40000 ALTER TABLE `cierre_diario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(45) NOT NULL,
  `apellido_cliente` varchar(45) NOT NULL,
  `correo_cliente` varchar(45) NOT NULL,
  `contra_cliente` varchar(255) NOT NULL,
  `tele_cliente` varchar(45) NOT NULL,
  `id_ubicacion` int DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `referencia` varchar(45) DEFAULT NULL,
  `id_tipo_direcc` int DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `id_ubicacion` (`id_ubicacion`),
  KEY `id_tipo_direcc` (`id_tipo_direcc`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicacion` (`id_ubicacion`),
  CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_tipo_direcc`) REFERENCES `tipo_direcc` (`id_tipo_direcc`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Carlos','Perez','carlos.perez@example.com','root','5555-9999',NULL,NULL,NULL,NULL),(3,'Maria','Juana','mariajuana@gmail.com','$2y$10$Yoa6pAA6pnf/q7xBC2cPZuc0ts3gH.PYGCCYB7ilo5G.z0.sw6cwq','9999-5555',NULL,NULL,NULL,NULL),(6,'Ana','Gomez','ana.gomez@example.com','$2y$10$ZnfZXbuvAYxcQ8EZvxHzYOdNtyFlz6HKQ.dHPYRIl493Efp9KUhtK','5555-9999',NULL,NULL,NULL,NULL),(7,'Luis','Rodriguez','luis.rodriguez@example.com','$2y$10$TqUQSDalkKDcJUHKoeX.BeBqOUjHj6lEs8V8ddU5kJedMosV/vfl.','1234-6542',NULL,NULL,NULL,NULL),(8,'Juan Luis','Vasquez','juanvas@gmail.com','$2y$10$SHQMNXaqvI45PyvACLJzaeenKED/hggqnnpPKrX8518fc1GXHvwQG','54749500',1,'12 Calle','Tienda la Esperanza',1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_cierre`
--

DROP TABLE IF EXISTS `detalle_cierre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_cierre` (
  `id_detalle_cierre` int NOT NULL AUTO_INCREMENT,
  `id_cierre` int NOT NULL,
  `id_pedido` int NOT NULL,
  `id_insumo` int NOT NULL,
  `cantidad_usada` int NOT NULL,
  PRIMARY KEY (`id_detalle_cierre`),
  KEY `id_cierre` (`id_cierre`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_insumo` (`id_insumo`),
  CONSTRAINT `detalle_cierre_ibfk_1` FOREIGN KEY (`id_cierre`) REFERENCES `cierre_diario` (`id_cierre`),
  CONSTRAINT `detalle_cierre_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  CONSTRAINT `detalle_cierre_ibfk_3` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id_insumo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_cierre`
--

LOCK TABLES `detalle_cierre` WRITE;
/*!40000 ALTER TABLE `detalle_cierre` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_cierre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id_estado`),
  UNIQUE KEY `estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (11,'Asignada'),(9,'Cliente no disponible'),(14,'Desactivada'),(10,'Disponible'),(3,'En lavandería'),(7,'Entregado'),(4,'Lavando'),(12,'Mantenimiento'),(15,'Motorista en camino'),(6,'Pendiente de enviar'),(13,'Pendiente de mantenimiento'),(1,'Pendiente de recolectar'),(2,'Recolectado'),(8,'Reprogramado'),(5,'Secando');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

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

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insumos`
--

DROP TABLE IF EXISTS `insumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `insumos` (
  `id_insumo` int NOT NULL AUTO_INCREMENT,
  `nombre_insumo` varchar(45) NOT NULL,
  `cantidad_disponible` int NOT NULL,
  `unidad_medida` varchar(10) NOT NULL,
  PRIMARY KEY (`id_insumo`),
  UNIQUE KEY `nombre_insumo` (`nombre_insumo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insumos`
--

LOCK TABLES `insumos` WRITE;
/*!40000 ALTER TABLE `insumos` DISABLE KEYS */;
/*!40000 ALTER TABLE `insumos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maquina`
--

DROP TABLE IF EXISTS `maquina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maquina` (
  `id_maquina` int NOT NULL AUTO_INCREMENT,
  `id_tipo` int NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `serie` varchar(45) NOT NULL,
  `capacidad` int NOT NULL,
  `estado_id_estado` int NOT NULL,
  PRIMARY KEY (`id_maquina`),
  KEY `id_tipo` (`id_tipo`),
  KEY `estado_id_estado` (`estado_id_estado`),
  CONSTRAINT `maquina_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_maquina` (`id_tipo`),
  CONSTRAINT `maquina_ibfk_2` FOREIGN KEY (`estado_id_estado`) REFERENCES `estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maquina`
--

LOCK TABLES `maquina` WRITE;
/*!40000 ALTER TABLE `maquina` DISABLE KEYS */;
INSERT INTO `maquina` VALUES (1,1,'Xtreme','Whirpool','123456',45,10),(2,2,'Secado','Whirpool','2378964578',45,10),(3,1,'Cleaner','Xiaomi','calidadprecio',40,10);
/*!40000 ALTER TABLE `maquina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motorista_historial`
--

DROP TABLE IF EXISTS `motorista_historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `motorista_historial` (
  `id_historial` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int NOT NULL,
  `id_motorista` int NOT NULL,
  `accion_realizada` enum('Llevado a lavandería','Entregado al cliente') NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historial`),
  KEY `id_pedido_idx` (`id_pedido`),
  KEY `id_motorista_idx` (`id_motorista`),
  CONSTRAINT `historial_motorista_ibfk_2` FOREIGN KEY (`id_motorista`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `historial_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motorista_historial`
--

LOCK TABLES `motorista_historial` WRITE;
/*!40000 ALTER TABLE `motorista_historial` DISABLE KEYS */;
INSERT INTO `motorista_historial` VALUES (3,21,3,'Entregado al cliente','2024-10-06 22:36:02'),(4,22,3,'Entregado al cliente','2024-10-11 20:56:43'),(5,25,3,'Entregado al cliente','2024-10-14 21:16:01'),(6,23,3,'Entregado al cliente','2024-10-14 21:16:29'),(7,24,3,'Entregado al cliente','2024-10-14 21:16:40'),(8,26,3,'Entregado al cliente','2024-10-14 21:17:02'),(9,27,3,'Entregado al cliente','2024-10-15 19:37:38'),(10,29,3,'Entregado al cliente','2024-10-15 19:37:47'),(11,30,3,'Entregado al cliente','2024-10-15 19:46:09'),(12,31,3,'Entregado al cliente','2024-10-15 19:46:17'),(13,33,3,'Entregado al cliente','2024-10-15 19:46:26'),(14,32,3,'Entregado al cliente','2024-10-15 19:46:34');
/*!40000 ALTER TABLE `motorista_historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime(2) DEFAULT NULL,
  `id_cliente` int NOT NULL,
  `programado` int NOT NULL,
  `cant_canasto` int DEFAULT NULL,
  `id_precio_serv` int DEFAULT NULL,
  `total_servicio` int DEFAULT NULL,
  `id_estado` int DEFAULT NULL,
  `detergente` int DEFAULT NULL,
  `suavizante` int DEFAULT NULL,
  `id_motorista` int DEFAULT NULL,
  `id_lavandero` int DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_precio_serv` (`id_precio_serv`),
  KEY `id_estado` (`id_estado`),
  KEY `id_motorista` (`id_motorista`),
  KEY `id_lavandero` (`id_lavandero`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_precio_serv`) REFERENCES `precio_servicio` (`id_precio_serv`),
  CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`id_motorista`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `pedido_ibfk_5` FOREIGN KEY (`id_lavandero`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (21,'2024-10-06 22:35:37.00',8,0,NULL,1,NULL,7,NULL,NULL,3,NULL),(22,'2024-10-11 20:54:25.00',8,0,NULL,3,NULL,7,NULL,NULL,3,NULL),(23,'2024-10-11 21:05:06.00',8,0,NULL,1,NULL,7,NULL,NULL,3,2),(24,'2024-10-12 09:04:59.00',8,0,NULL,1,NULL,7,NULL,NULL,3,2),(25,'2024-10-12 10:19:19.00',8,0,2,1,20,7,NULL,NULL,3,2),(26,'2024-10-14 21:03:25.00',8,0,3,1,30,7,NULL,NULL,3,2),(27,'2024-10-14 21:14:38.00',8,0,3,1,30,7,NULL,NULL,3,2),(28,'2024-10-14 21:14:54.00',8,0,2,1,20,6,NULL,NULL,3,2),(29,'2024-10-14 21:15:04.00',8,0,5,1,50,7,NULL,NULL,3,2),(30,'2024-10-14 22:25:28.00',8,0,2,2,20,7,NULL,NULL,3,2),(31,'2024-10-15 19:03:33.00',8,0,3,3,54,7,NULL,NULL,3,3),(32,'2024-10-15 19:19:24.00',8,0,2,3,36,7,NULL,NULL,3,2),(33,'2024-10-15 19:36:36.00',8,0,1,3,18,7,NULL,NULL,3,2),(34,'2024-10-15 19:36:47.00',8,0,1,2,10,6,NULL,NULL,3,2),(35,'2024-10-15 19:45:35.00',8,0,1,1,10,6,NULL,NULL,3,2),(36,'2024-10-15 19:45:43.00',8,0,1,2,10,6,NULL,NULL,3,2);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precio_servicio`
--

DROP TABLE IF EXISTS `precio_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `precio_servicio` (
  `id_precio_serv` int NOT NULL AUTO_INCREMENT,
  `servicio` varchar(45) NOT NULL,
  `precio` int NOT NULL,
  `vigencia` int NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id_precio_serv`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precio_servicio`
--

LOCK TABLES `precio_servicio` WRITE;
/*!40000 ALTER TABLE `precio_servicio` DISABLE KEYS */;
INSERT INTO `precio_servicio` VALUES (1,'Lavado',10,1,'2024-09-26',NULL),(2,'Secado',10,1,'2024-09-26',NULL),(3,'Lavado y Secado',18,1,'2024-09-26',NULL);
/*!40000 ALTER TABLE `precio_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(45) NOT NULL,
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `nombre_rol` (`nombre_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (2,'Administrador Lavanderia'),(3,'Lavandero'),(4,'Motorista'),(1,'Usuario Master');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_direcc`
--

DROP TABLE IF EXISTS `tipo_direcc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_direcc` (
  `id_tipo_direcc` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_direcc`),
  UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_direcc`
--

LOCK TABLES `tipo_direcc` WRITE;
/*!40000 ALTER TABLE `tipo_direcc` DISABLE KEYS */;
INSERT INTO `tipo_direcc` VALUES (1,'Casa'),(3,'Otro'),(2,'Trabajo');
/*!40000 ALTER TABLE `tipo_direcc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_maquina`
--

DROP TABLE IF EXISTS `tipo_maquina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_maquina` (
  `id_tipo` int NOT NULL AUTO_INCREMENT,
  `nombre_maquina` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo`),
  UNIQUE KEY `nombre_maquina` (`nombre_maquina`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_maquina`
--

LOCK TABLES `tipo_maquina` WRITE;
/*!40000 ALTER TABLE `tipo_maquina` DISABLE KEYS */;
INSERT INTO `tipo_maquina` VALUES (1,'Lavadora'),(2,'Secadora');
/*!40000 ALTER TABLE `tipo_maquina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicacion`
--

DROP TABLE IF EXISTS `ubicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ubicacion` (
  `id_ubicacion` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cod` varchar(5) NOT NULL,
  PRIMARY KEY (`id_ubicacion`),
  UNIQUE KEY `cod` (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicacion`
--

LOCK TABLES `ubicacion` WRITE;
/*!40000 ALTER TABLE `ubicacion` DISABLE KEYS */;
INSERT INTO `ubicacion` VALUES (1,'Puerto Barrios','PB'),(2,'Santo Tomas','ST');
/*!40000 ALTER TABLE `ubicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

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

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (2,'Lavanderia JuanVas','juanvas','e1ef0b99fbe8b79a8005958df26ea0cb6a0cb9cc25184f1925b05cc734ee1d26',2),(3,'Motorista Enmanuel','enma','e1ef0b99fbe8b79a8005958df26ea0cb6a0cb9cc25184f1925b05cc734ee1d26',4);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-15 21:29:03
