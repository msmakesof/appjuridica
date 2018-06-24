-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5277
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para movilweb
CREATE DATABASE IF NOT EXISTS `movilweb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `movilweb`;

-- Volcando estructura para tabla movilweb.un_control
CREATE TABLE IF NOT EXISTS `un_control` (
  `IdControl` int(11) NOT NULL AUTO_INCREMENT,
  `un_LlaveAcceso` varchar(500) DEFAULT NULL,
  `un_IdEstado` int(1) DEFAULT NULL,
  `un_LlaveInicial` varchar(50) DEFAULT NULL,
  `un_LlaveIv` varchar(50) DEFAULT NULL,
  `un_MetodoEncriptacion` varchar(50) DEFAULT NULL,
  `un_TipoHash` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdControl`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla movilweb.un_control: 1 rows
DELETE FROM `un_control`;
/*!40000 ALTER TABLE `un_control` DISABLE KEYS */;
INSERT INTO `un_control` (`IdControl`, `un_LlaveAcceso`, `un_IdEstado`, `un_LlaveInicial`, `un_LlaveIv`, `un_MetodoEncriptacion`, `un_TipoHash`) VALUES
	(1, 'V14l1br390$MKS', 1, '\'muni\'', '\'muni123\'', 'AES-256-CBC', 'sha256');
/*!40000 ALTER TABLE `un_control` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
