-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.0.33 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para uptask_mvc
CREATE DATABASE IF NOT EXISTS `uptask_mvc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `uptask_mvc`;

-- Volcando estructura para tabla uptask_mvc.proyectos
CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proyecto` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `propietarioId` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `propietarioId` (`propietarioId`),
  CONSTRAINT `propietarioId` FOREIGN KEY (`propietarioId`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla uptask_mvc.proyectos: ~6 rows (aproximadamente)
INSERT INTO `proyectos` (`id`, `proyecto`, `url`, `propietarioId`) VALUES
	(1, 'Lista de Alumnos del Colegio', 'bv543tv435tv5t3456yt354yt6tff', 2),
	(2, 'Página de Publicidad de Colegios', '94655d393236c00fc008af445a187cc8', 2),
	(3, ' Aplicación de Bienes Raíces con PHP', 'd24684a6dae0abc0ea34bb0c7134f683', 1),
	(4, ' Crear Aplicación Administrativa para Cafetería', 'e9d2a23b19e045ab9047b4681ecce730', 1),
	(5, ' Sistema de Ventas e Inventario de Productos', 'a3c58c804005ed0236d3fa18f045a27b', 1),
	(6, ' Reestructurar Sistema de Laboratorio Clínico Adonay', '4a849c7e591218c3a8b3d9b343eb50d2', 1);

-- Volcando estructura para tabla uptask_mvc.tareas
CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tiempo` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `proyectoId` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `proyectoId` (`proyectoId`),
  CONSTRAINT `proyectoId` FOREIGN KEY (`proyectoId`) REFERENCES `proyectos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla uptask_mvc.tareas: ~23 rows (aproximadamente)
INSERT INTO `tareas` (`id`, `nombre`, `tiempo`, `estado`, `proyectoId`) VALUES
	(1, ' Elegir Plataforma', '1 Hora', 1, 4),
	(2, ' Crear Cuenta de Paypal', '1/2 Hora', 1, 4),
	(3, ' Levantamiento de Información', '10 Horas', 1, 4),
	(4, ' Modelar y Crear Base de Datos', '5 Horas', 0, 4),
	(5, 'Elegir Plataforma de la Aplicación', '1 Hora', 1, 3),
	(6, ' Crear Cuenta de Paypal', '2 Horas', 1, 3),
	(7, ' Recolección de Datos del Proyecto', '15 Horas', 0, 3),
	(8, ' Modelado de Base de Datos', '7 Horas', 1, 3),
	(9, ' Elegir Plataforma', '1 Hora', 1, 5),
	(10, ' Recolección de Datos del Proyecto', '12 Horas', 1, 5),
	(11, ' Recolección de Datos del Proyecto', '15 Horas', 0, 1),
	(13, ' Codificar Pantalla de Dashboard', '5 Horas', 0, 4),
	(14, ' Codificar Menú Lateral de Aplicación', '6 Horas', 0, 4),
	(15, ' Codificar Modelo de Tabla Login', '2 Horas', 0, 4),
	(16, 'Codificar Dashboard de la Aplicación', '6 Horas', 0, 3),
	(17, 'Codificar Modelo de Login', '3 Horas', 0, 3),
	(23, 'Elegir Plataforma', '2 Horas', 1, 3),
	(24, 'Recolección de Datos del Proyecto againg', '12 Horas', 0, 3),
	(25, 'Elegir Plataforma de nuevo', '1 Hora', 1, 3),
	(26, 'Recolección de Datos del Proyecto', '2 Horas', 0, 3),
	(27, ' Recolección de Datos del Proyecto', '2 Horas', 0, 3),
	(28, ' Recolección de Datos del Proyecto ACTUALIZADO', '12 Horas', 0, 3),
	(29, 'Una Nueva Tarea', '2 Horas', 0, 5);

-- Volcando estructura para tabla uptask_mvc.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla uptask_mvc.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `token`, `confirmado`) VALUES
	(1, ' Miguel Angel Vásquez', 'miguelpro@gmail.com', '$2y$10$iauTo5ScWjsVDzLRSLQR7ecnv.xGNz6SSbvIUdcjvg8JV3lukRN.S', '', 1),
	(2, 'José Angel Vásquez', 'developer.javp@gmail.com', '$2y$10$ZnmBIfFb8RtIEmGL8VQ.OO.17TV9WN9ghD4ZM..aExb8ZslUbHJMa', '', 1),
	(3, 'Alejandro Josué Vásquez', 'correo@correo.com', '$2y$10$7PGMLESKmnL.BWXbvv1IsetWPkacinhbS12kgis2fd7w6Tri/EpxW', '', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
