-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.1.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5280
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para appjudicial
CREATE DATABASE IF NOT EXISTS `appjudicial` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `appjudicial`;

-- Volcando estructura para tabla appjudicial.cli_cliente
CREATE TABLE IF NOT EXISTS `cli_cliente` (
  `CLI_IdCliente` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id del cliente para contro',
  `CLI_Identificacion` bigint(20) DEFAULT NULL COMMENT 'Nro de identificacion.',
  `CLI_TipoDocumento` tinyint(4) DEFAULT NULL COMMENT 'Tipo de Documento del cliente.',
  `CLI_PrimerApellido` char(50) DEFAULT NULL COMMENT 'Primer Apellido del cliente.',
  `CLI_SegundoApellido` char(50) DEFAULT NULL COMMENT 'Segundo Apellido del cliente.',
  `CLI_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre(s) del cliente.',
  `CLI_TelefonoFijo` char(10) DEFAULT NULL COMMENT 'Telefono Fijo.',
  `CLI_Celular` char(15) DEFAULT NULL COMMENT 'Ceular.',
  `CLI_Email` char(80) NOT NULL COMMENT 'Email ',
  `CLI_Direccion` char(150) DEFAULT NULL COMMENT 'Direccion.',
  `CLI_Usuario` char(150) DEFAULT NULL,
  `CLI_Clave` char(150) DEFAULT NULL,
  `CLI_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado (Activo /Inactivo) del cliente.',
  `CLI_IdTipoCliente` tinyint(4) DEFAULT NULL COMMENT 'Id Tipo del Cliente.',
  `CLI_UsuarioCrea` bigint(20) DEFAULT NULL COMMENT 'Usuario que Crea.',
  `CLI_FechaCreado` datetime DEFAULT NULL COMMENT 'Fecha de Creacion.',
  `CLI_UsuarioModifica` bigint(20) DEFAULT NULL COMMENT 'Usuario que modifica.',
  `CLI_FechaModificado` datetime DEFAULT NULL COMMENT 'Fecha modificacion.',
  `CLI_UsuarioEstado` int(11) DEFAULT NULL,
  `CLI_IdInterno` double DEFAULT NULL,
  `CLI_Local` double DEFAULT NULL,
  PRIMARY KEY (`CLI_IdCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Informacion general del Cliente.';

-- Volcando datos para la tabla appjudicial.cli_cliente: 5 rows
DELETE FROM `cli_cliente`;
/*!40000 ALTER TABLE `cli_cliente` DISABLE KEYS */;
INSERT INTO `cli_cliente` (`CLI_IdCliente`, `CLI_Identificacion`, `CLI_TipoDocumento`, `CLI_PrimerApellido`, `CLI_SegundoApellido`, `CLI_Nombre`, `CLI_TelefonoFijo`, `CLI_Celular`, `CLI_Email`, `CLI_Direccion`, `CLI_Usuario`, `CLI_Clave`, `CLI_Estado`, `CLI_IdTipoCliente`, `CLI_UsuarioCrea`, `CLI_FechaCreado`, `CLI_UsuarioModifica`, `CLI_FechaModificado`, `CLI_UsuarioEstado`, `CLI_IdInterno`, `CLI_Local`) VALUES
	(1, 79243925, 1, 'SANCHEZ', 'SIERRA', 'MAURICIO', NULL, '3142674416', 'msmakesof@gmail.com', 'calle 153', 'msmakesof@gmail.com', 'ZmRjWFBsNlRIZllWNDV2b2tuL0ZsZz09', 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 767655443, 1, 'jaramillo', 'quizalle', 'jaime', NULL, '345453554', 'jaramillo@mail.com', 'calle 26 No. 10-85', 'jaramillo@mail.com', 'ZmRjWFBsNlRIZllWNDV2b2tuL0ZsZz09', 1, 3, NULL, NULL, NULL, NULL, NULL, 351760965, 745819974),
	(3, 544645, 1, 'diaz', 'DIAZ', 'maria FERNANDA', NULL, '4546546', 'mdiaz@gmail.com', 'avenida 12 No. 85-99', 'mdiaz@gmail.com', 'ZmRjWFBsNlRIZllWNDV2b2tuL0ZsZz09', 1, 2, NULL, NULL, NULL, NULL, NULL, 151252155, 1446692128),
	(5, 6475677, 1, 'parra', 'diaz', 'carlos', NULL, '15453465321', 'mail@gmail.com', 'diagonal 15 No. 15-65', 'mail@gmail.com', 'ZmRjWFBsNlRIZllWNDV2b2tuL0ZsZz09', 1, 3, NULL, NULL, NULL, NULL, NULL, 375535020, 1083339290),
	(6, 90978078, 2, 'Lane', 'Kent', 'Luis', NULL, '23424566', 'azullane@gmail.com', 'Carrera 23 No. 115-85', 'azullane@gmail.com', 'ZmRjWFBsNlRIZllWNDV2b2tuL0ZsZz09', 1, NULL, NULL, NULL, NULL, NULL, NULL, 383150333, 1328554562);
/*!40000 ALTER TABLE `cli_cliente` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
