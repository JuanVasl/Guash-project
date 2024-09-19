CREATE DATABASE  IF NOT EXISTS `guash` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `guash`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: guash
-- ------------------------------------------------------
-- Server version	8.0.34

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignacion_maquina`
--

LOCK TABLES `asignacion_maquina` WRITE;
/*!40000 ALTER TABLE `asignacion_maquina` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Carlos','Perez','carlos.perez@example.com','root','5555-9999',NULL,NULL,NULL,NULL),(3,'Maria','Juana','mariajuana@gmail.com','$2y$10$Yoa6pAA6pnf/q7xBC2cPZuc0ts3gH.PYGCCYB7ilo5G.z0.sw6cwq','9999-5555',NULL,NULL,NULL,NULL),(6,'Ana','Gomez','ana.gomez@example.com','$2y$10$ZnfZXbuvAYxcQ8EZvxHzYOdNtyFlz6HKQ.dHPYRIl493Efp9KUhtK','5555-9999',NULL,NULL,NULL,NULL),(7,'Luis','Rodriguez','luis.rodriguez@example.com','$2y$10$TqUQSDalkKDcJUHKoeX.BeBqOUjHj6lEs8V8ddU5kJedMosV/vfl.','1234-6542',NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (11,'Asignada'),(9,'Cliente no disponible'),(14,'Desactivada'),(10,'Disponible'),(3,'En lavandería'),(7,'Entregado'),(4,'Lavando'),(12,'Mantenimiento'),(6,'Pendiente de enviar'),(13,'Pendiente de mantenimiento'),(1,'Pendiente de recolectar'),(2,'Recolectado'),(8,'Reprogramado'),(5,'Secado');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maquina`
--

LOCK TABLES `maquina` WRITE;
/*!40000 ALTER TABLE `maquina` DISABLE KEYS */;
/*!40000 ALTER TABLE `maquina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime(2) NOT NULL,
  `id_cliente` int NOT NULL,
  `programado` int NOT NULL,
  `cant_canasto` int DEFAULT NULL,
  `id_precio_serv` int DEFAULT NULL,
  `total_servicio` int DEFAULT NULL,
  `id_estado` int DEFAULT NULL,
  `detergente` int DEFAULT NULL,
  `suavizante` int DEFAULT NULL,
  `id_motorista` int  DEFAULT NULL,
  `id_lavandero` int  DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precio_servicio`
--

LOCK TABLES `precio_servicio` WRITE;
/*!40000 ALTER TABLE `precio_servicio` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_maquina`
--

LOCK TABLES `tipo_maquina` WRITE;
/*!40000 ALTER TABLE `tipo_maquina` DISABLE KEYS */;
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
INSERT INTO `ubicacion` VALUES (1,'Puerto Barrios','PB'),(2,'Santo Tomás de Castilla','ST');
/*!40000 ALTER TABLE `ubicacion` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
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

-- Dump completed on 2024-09-10 13:57:19
