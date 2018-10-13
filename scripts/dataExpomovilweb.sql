-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5280
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para movilweb
DROP DATABASE IF EXISTS `movilweb`;
CREATE DATABASE IF NOT EXISTS `movilweb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `movilweb`;

-- Volcando estructura para tabla movilweb.centrosacopio
DROP TABLE IF EXISTS `centrosacopio`;
CREATE TABLE IF NOT EXISTS `centrosacopio` (
  `IdCentroAcopio` int(3) NOT NULL AUTO_INCREMENT,
  `NombreCentroAcopio` varchar(80) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`IdCentroAcopio`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.centrosacopio: 67 rows
DELETE FROM `centrosacopio`;
/*!40000 ALTER TABLE `centrosacopio` DISABLE KEYS */;
INSERT INTO `centrosacopio` (`IdCentroAcopio`, `NombreCentroAcopio`, `Estado`) VALUES
	(1, 'CEDI BARRANQUILLA', NULL),
	(2, 'CEDI MEDELLIN', NULL),
	(3, 'CEDI BOGOTA', NULL),
	(4, 'CEDI FUSAGASUGA', NULL),
	(5, 'CEDI SOACHA', NULL),
	(6, 'CEDI MADRID', NULL),
	(7, 'CEDI ZIPAQUIRA', NULL),
	(8, 'PRUEBAS', NULL),
	(9, 'CEDI CARTAGENA1 ROBERTO', NULL),
	(10, 'CEDI CARTAGENA2 JORGE', NULL),
	(11, 'CEDI CALI', NULL),
	(12, 'CEDI VILLAVICENCIO1 JULIETA', NULL),
	(13, 'CEDI ACACIAS', '1'),
	(14, 'CEDI PEREIRA1 NICOLAS', NULL),
	(15, 'CEDI MANIZALES', NULL),
	(16, 'CEDI VILLAVICENCIO2 NANCY', NULL),
	(17, 'CEDI PEREIRA2 ALDEMAR', NULL),
	(18, 'CEDI SANTAROSA', NULL),
	(19, 'CEDI ARMENIA', '1'),
	(20, 'CEDI DOSQUEBRADAS ANA', NULL),
	(21, 'CEDI CARTAGO', NULL),
	(22, 'CEDI MONTELIBANO', NULL),
	(23, 'CEDI MONTERIA', NULL),
	(24, 'CEDI SINCELEJO', NULL),
	(25, 'CEDI BARRANCABERMEJA2 CARMEN', NULL),
	(26, 'CEDI MAGANGUE', NULL),
	(27, 'CEDI CERETE', NULL),
	(28, 'CEDI BUCARAMANGA1 ROBERTO', NULL),
	(29, 'CEDI BUCARAMANGA2 FLOR', NULL),
	(30, 'CEDI SAHAGUN', NULL),
	(31, 'CEDI CUCUTA2 LUIS', NULL),
	(32, 'CEDI IBAGUE', NULL),
	(33, 'CEDI CUCUTA1 LUZ ESTELLA', NULL),
	(34, 'CEDI SANTA MARTA', NULL),
	(35, 'CEDI NEIVA', NULL),
	(36, 'CEDI TULUA', NULL),
	(37, 'CEDI PALMIRA', NULL),
	(38, 'CEDI BUGA', NULL),
	(39, 'CEDI VALLEDUPAR', NULL),
	(40, 'CEDI RIOHACHA', NULL),
	(41, 'CEDI FLORENCIA', NULL),
	(42, 'CEDI GIRARDOT', NULL),
	(43, 'CEDI BARRANCABERMEJA3 EUSEBIO', NULL),
	(44, 'CEDI POPAYAN', NULL),
	(45, 'CEDI BUENAVENTURA', NULL),
	(46, 'CEDI YOPAL', NULL),
	(47, 'CEDI IPIALES', NULL),
	(48, 'CEDI PASTO', NULL),
	(49, 'CEDI LA DORADA', NULL),
	(50, 'CEDI SAN GIL', NULL),
	(51, 'CEDI PITALITO', NULL),
	(52, 'CEDI LORICA', NULL),
	(53, 'CEDI ARSERMA', NULL),
	(54, 'CEDI MAICAO', NULL),
	(55, 'CEDI CIENAGA', NULL),
	(56, 'CEDI QUIBDO', NULL),
	(57, 'CEDI PUERTO ASIS', NULL),
	(58, 'CEDI CARMEN DE BOLIVAR', NULL),
	(59, 'CEDI TUMACO', NULL),
	(60, 'CEDI OCANA', NULL),
	(61, 'TALLERES MEDELLIN', NULL),
	(62, 'TALLERES RIONEGRO', NULL),
	(63, 'CEDI LOGUIN', NULL),
	(64, 'CEDI LA CEJA', NULL),
	(65, 'CEDI EL ESPINAL', NULL),
	(66, 'CEDI FUNDACION', NULL),
	(67, 'CEDI BARRANCABERMEJA1 ANTONIO', NULL);
/*!40000 ALTER TABLE `centrosacopio` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.clases
DROP TABLE IF EXISTS `clases`;
CREATE TABLE IF NOT EXISTS `clases` (
  `IdClase` int(11) NOT NULL AUTO_INCREMENT,
  `Sede` int(11) DEFAULT NULL,
  `Salon` int(3) DEFAULT NULL,
  `Materia` int(3) DEFAULT NULL,
  `Nivel` int(3) DEFAULT NULL,
  `Horario` int(3) DEFAULT NULL,
  `Profesor` int(11) DEFAULT NULL,
  `Estado` int(1) DEFAULT NULL,
  `dia` varchar(1) DEFAULT NULL,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  `FechaGraba` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `IdEvento` date DEFAULT NULL,
  PRIMARY KEY (`IdClase`)
) ENGINE=MyISAM AUTO_INCREMENT=379 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.clases: 81 rows
DELETE FROM `clases`;
/*!40000 ALTER TABLE `clases` DISABLE KEYS */;
INSERT INTO `clases` (`IdClase`, `Sede`, `Salon`, `Materia`, `Nivel`, `Horario`, `Profesor`, `Estado`, `dia`, `desde`, `hasta`, `FechaGraba`, `IdEvento`) VALUES
	(298, 1, 2, 28, 1, 8, 19, 1, '1', '2017-09-04', '2017-09-09', '2017-09-07 23:33:50', '2017-09-04'),
	(299, 1, 2, 27, 1, 3, 19, 1, '3', '2017-09-04', '2017-09-09', '2017-09-07 23:34:08', '2017-09-06'),
	(300, 1, 2, 14, 1, 9, 19, 1, '5', '2017-09-04', '2017-09-09', '2017-09-07 23:38:21', '2017-09-08'),
	(301, 1, 1, 14, 1, 8, 18, 1, '1', '2017-09-18', '2017-09-23', '2017-09-17 12:24:43', '2017-09-18'),
	(302, 1, 1, 12, 6, 3, 18, 1, '3', '2017-09-18', '2017-09-23', '2017-09-17 12:24:54', '2017-09-20'),
	(303, 1, 1, 22, 1, 5, 18, 1, '5', '2017-09-18', '2017-09-23', '2017-09-17 12:25:03', '2017-09-22'),
	(304, 1, 1, 8, 6, 9, 18, 1, '6', '2017-09-18', '2017-09-23', '2017-09-17 12:25:18', '2017-09-23'),
	(305, 1, 1, 3, 1, 10, 18, 1, '4', '2017-09-18', '2017-09-23', '2017-09-17 12:26:31', '2017-09-21'),
	(306, 1, 2, 23, 1, 3, 18, 1, '1', '2017-10-02', '2017-10-07', '2017-10-16 00:39:35', '2017-10-02'),
	(307, 1, 2, 24, 2, 3, 19, 1, '3', '2017-10-02', '2017-10-07', '2017-10-16 00:34:53', '2017-10-04'),
	(308, 1, 2, 27, 1, 8, 19, 1, '1', '2017-10-09', '2017-10-14', '2017-10-08 23:01:33', '2017-10-09'),
	(309, 1, 2, 2, 1, 5, 19, 1, '2', '2017-10-09', '2017-10-14', '2017-10-08 21:14:06', '2017-10-10'),
	(310, 1, 2, 1, 1, 6, 19, 1, '5', '2017-10-09', '2017-10-14', '2017-10-08 21:14:21', '2017-10-13'),
	(311, 1, 2, 27, 1, 3, 19, 1, '3', '2017-10-09', '2017-10-14', '2017-10-08 21:15:43', '2017-10-11'),
	(312, 1, 2, 27, 1, 6, 0, NULL, NULL, NULL, NULL, '2017-10-16 17:41:39', '2017-10-05'),
	(313, 1, 1, 27, 1, 9, 18, NULL, NULL, NULL, NULL, '2017-10-16 17:44:06', '2017-10-05'),
	(314, 2, 1, 23, 1, 5, 18, 1, NULL, NULL, NULL, '2017-10-16 17:50:42', '0000-00-00'),
	(315, 2, 2, 14, 6, 5, 13, 1, NULL, NULL, NULL, '2017-10-16 17:53:38', '2017-10-12'),
	(316, 1, 2, 15, 6, 8, 19, 1, NULL, NULL, NULL, '2017-10-16 17:55:07', '2017-10-17'),
	(317, 1, 2, 1, 1, 6, 18, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 18:38:08', '2017-10-18'),
	(318, 2, 2, 27, 1, 9, 20, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 18:48:38', '2017-10-19'),
	(319, 1, 2, 16, 6, 9, 1, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 18:55:07', '2017-10-18'),
	(320, 0, 0, 0, 0, 0, 0, 1, NULL, '0000-00-00', '0000-00-00', '2017-10-16 22:02:58', '0000-00-00'),
	(321, 0, 0, 0, 0, 0, 0, 1, NULL, '0000-00-00', '0000-00-00', '2017-10-16 22:05:41', '0000-00-00'),
	(322, 0, 0, 0, 0, 0, 0, 1, NULL, '0000-00-00', '0000-00-00', '2017-10-16 22:27:47', '0000-00-00'),
	(323, 0, 0, 0, 0, 0, 0, 1, NULL, '0000-00-00', '0000-00-00', '2017-10-16 22:29:18', '0000-00-00'),
	(324, 0, 0, 0, 0, 0, 0, 1, NULL, '0000-00-00', '0000-00-00', '2017-10-16 22:34:40', '0000-00-00'),
	(325, 0, 0, 0, 0, 0, 0, 1, NULL, '0000-00-00', '0000-00-00', '2017-10-16 22:36:43', '0000-00-00'),
	(326, 0, 0, 0, 0, 0, 0, 1, NULL, '0000-00-00', '0000-00-00', '2017-10-16 22:37:51', '0000-00-00'),
	(327, 0, 0, 0, 0, 0, 0, 1, NULL, '0000-00-00', '0000-00-00', '2017-10-16 22:39:28', '0000-00-00'),
	(328, 0, 0, 0, 0, 0, 0, 1, NULL, '0000-00-00', '0000-00-00', '2017-10-16 22:40:28', '0000-00-00'),
	(329, 1, 2, 27, 1, 10, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-25 00:27:51', '2017-10-20'),
	(330, 1, 1, 2, 1, 6, 20, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 22:46:09', '2017-10-26'),
	(331, 2, 1, 23, 1, 8, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 22:47:29', '2017-10-24'),
	(332, 1, 2, 16, 6, 5, 18, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 22:48:22', '2017-10-24'),
	(333, 2, 2, 23, 1, 9, 1, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 22:49:13', '2017-10-24'),
	(334, 1, 2, 14, 6, 8, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 22:51:59', '2017-10-25'),
	(335, 1, 2, 2, 1, 5, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 22:53:00', '2017-10-19'),
	(336, 1, 2, 2, 1, 5, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 22:56:10', '2017-10-17'),
	(337, 1, 2, 14, 6, 8, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 22:59:33', '2017-10-12'),
	(338, 1, 2, 14, 6, 5, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 23:00:30', '2017-10-14'),
	(339, 1, 2, 14, 6, 5, 19, 1, NULL, '1970-01-01', '1970-01-31', '2017-10-16 23:02:45', '1970-01-01'),
	(340, 1, 2, 27, 1, 3, 19, 1, NULL, '1970-01-01', '1970-01-31', '2017-10-16 23:07:09', '1970-01-01'),
	(341, 1, 2, 14, 6, 3, 16, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 23:09:25', '2017-10-17'),
	(342, 1, 2, 1, 1, 6, 18, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 23:10:18', '2017-10-17'),
	(343, 1, 2, 15, 6, 5, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-16 23:31:25', '2017-10-12'),
	(344, 1, 2, 23, 1, 10, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-25 00:34:21', '2017-10-21'),
	(345, 1, 2, 2, 1, 3, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-17 00:20:01', '2017-10-27'),
	(346, 1, 2, 2, 1, 8, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-17 00:24:46', '2017-10-27'),
	(347, 1, 2, 2, 1, 8, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-17 00:26:15', '2017-10-27'),
	(348, 1, 2, 2, 1, 8, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-17 00:28:13', '2017-10-27'),
	(349, 1, 2, 2, 1, 8, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-17 00:29:40', '2017-10-27'),
	(350, 1, 1, 2, 1, 3, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-17 00:32:28', '2017-10-28'),
	(351, 2, 1, 16, 6, 9, 19, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-17 00:34:24', '2017-10-05'),
	(352, 2, 2, 23, 1, 9, 18, 1, NULL, '2017-10-01', '2017-10-31', '2017-10-17 00:34:50', '2017-10-06'),
	(353, 2, 1, 16, 6, 9, 19, 1, NULL, '1970-01-01', '1970-01-31', '2017-10-17 00:35:06', '1970-01-01'),
	(354, 2, 2, 16, 6, 9, 19, 1, NULL, '1970-01-01', '1970-01-31', '2017-10-17 00:35:13', '1970-01-01'),
	(355, 1, 2, 23, 1, 5, 19, 1, NULL, '2017-10-25', '2017-10-25', '2017-10-24 01:24:46', '2017-10-25'),
	(356, 2, 1, 23, 1, 6, 19, 1, NULL, '2017-10-25', '2017-10-25', '2017-10-24 01:28:30', '2017-10-25'),
	(357, 1, 2, 16, 6, 6, 19, 1, NULL, '2017-10-25', '2017-10-25', '2017-10-24 23:58:02', '2017-10-25'),
	(358, 1, 2, 2, 1, 8, 19, 1, NULL, '2017-10-25', '2017-10-25', '2017-10-24 06:01:57', '2017-10-25'),
	(359, 2, 1, 15, 6, 10, 18, 1, NULL, '2017-10-25', '2017-10-25', '2017-10-24 06:44:44', '2017-10-25'),
	(360, 1, 1, 1, 1, 5, 20, 1, NULL, '2017-10-26', '2017-10-26', '2017-10-24 06:48:30', '2017-10-26'),
	(361, 2, 2, 23, 1, 6, 1, 1, NULL, '2017-10-26', '2017-10-26', '2017-10-24 06:50:15', '2017-10-26'),
	(362, 2, 2, 27, 1, 9, 1, 1, NULL, '2017-10-26', '2017-10-26', '2017-10-24 06:53:42', '2017-10-26'),
	(363, 1, 2, 2, 1, 5, 19, 1, NULL, '2017-10-27', '2017-10-27', '2017-10-24 06:55:36', '2017-10-27'),
	(364, 2, 2, 15, 6, 10, 20, 1, NULL, '2017-10-27', '2017-10-27', '2017-10-24 23:59:43', '2017-10-27'),
	(365, 2, 1, 2, 1, 8, 18, 1, NULL, '2017-10-27', '2017-10-27', '2017-10-24 06:56:58', '2017-10-27'),
	(366, 1, 2, 2, 1, 6, 20, 1, NULL, '2017-10-24', '2017-10-24', '2017-10-24 06:57:58', '2017-10-24'),
	(367, 1, 1, 23, 1, 5, 20, 1, NULL, '2017-10-24', '2017-10-24', '2017-10-24 07:10:32', '2017-10-24'),
	(368, 1, 2, 14, 6, 6, 19, 1, NULL, '2017-10-24', '2017-10-24', '2017-10-24 07:23:49', '2017-10-24'),
	(369, 1, 2, 23, 1, 5, 19, 1, NULL, '2017-10-28', '2017-10-28', '2017-10-24 22:41:36', '2017-10-28'),
	(370, 1, 1, 1, 1, 9, 18, 1, NULL, '2017-10-28', '2017-10-28', '2017-10-24 22:56:55', '2017-10-28'),
	(371, 1, 2, 15, 6, 5, 1, 1, NULL, '2017-10-28', '2017-10-28', '2017-10-24 23:09:22', '2017-10-28'),
	(372, 2, 2, 1, 1, 9, 19, 1, NULL, '2017-10-28', '2017-10-28', '2017-10-24 23:19:26', '2017-10-28'),
	(373, 1, 2, 27, 1, 9, 1, 1, NULL, '2017-10-27', '2017-10-27', '2017-10-24 23:49:15', '2017-10-27'),
	(374, 2, 2, 14, 6, 6, 18, 1, NULL, '2017-10-26', '2017-10-26', '2017-10-24 23:57:23', '2017-10-26'),
	(375, 2, 2, 15, 6, 6, 1, 1, NULL, '2017-10-31', '2017-10-31', '2017-10-25 00:26:16', '2017-10-31'),
	(376, 1, 1, 16, 6, 9, 19, 1, NULL, '2017-10-31', '2017-10-31', '2017-10-25 00:24:56', '2017-10-31'),
	(377, 1, 2, 14, 6, 5, 19, 1, NULL, '2017-10-19', '2017-10-19', '2017-10-25 03:32:19', '2017-10-19'),
	(378, 1, 2, 16, 6, 6, 19, 1, NULL, '2017-10-13', '2017-10-13', '2017-10-25 04:37:20', '2017-10-13');
/*!40000 ALTER TABLE `clases` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.clasexdia
DROP TABLE IF EXISTS `clasexdia`;
CREATE TABLE IF NOT EXISTS `clasexdia` (
  `IdClasexDia` int(11) NOT NULL AUTO_INCREMENT,
  `IdClase` varchar(11) NOT NULL,
  `Dia` varchar(1) NOT NULL,
  PRIMARY KEY (`IdClasexDia`,`IdClase`,`Dia`)
) ENGINE=MyISAM AUTO_INCREMENT=419 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.clasexdia: 131 rows
DELETE FROM `clasexdia`;
/*!40000 ALTER TABLE `clasexdia` DISABLE KEYS */;
INSERT INTO `clasexdia` (`IdClasexDia`, `IdClase`, `Dia`) VALUES
	(71, '149', '2'),
	(72, '149', '3'),
	(88, '146', '2'),
	(89, '146', '5'),
	(90, '152', '6'),
	(91, '147', '2'),
	(92, '147', '4'),
	(93, '148', '1'),
	(94, '148', '4'),
	(95, '145', '3'),
	(98, '141', '1'),
	(99, '141', '4'),
	(102, '150', '3'),
	(103, '150', '5'),
	(104, '151', '1'),
	(105, '151', '2'),
	(114, '153', '1'),
	(115, '153', '3'),
	(116, '154', '1'),
	(307, '200', '1'),
	(308, '201', '1'),
	(309, '202', '1'),
	(310, '203', '1'),
	(311, '204', '1'),
	(312, '205', '5'),
	(313, '206', '2'),
	(314, '207', '5'),
	(315, '208', '4'),
	(316, '209', '2'),
	(317, '210', '2'),
	(318, '211', '2'),
	(319, '212', '0'),
	(320, '213', '2'),
	(321, '214', '0'),
	(322, '215', '2'),
	(323, '216', '6'),
	(324, '217', '1'),
	(325, '218', '-'),
	(326, '219', '1'),
	(327, '220', '6'),
	(328, '221', '3'),
	(329, '222', '5'),
	(330, '223', '2'),
	(331, '224', '4'),
	(332, '225', '2'),
	(333, '226', '1'),
	(334, '227', '4'),
	(335, '228', '3'),
	(336, '229', '1'),
	(337, '230', '6'),
	(338, '231', '4'),
	(339, '232', '1'),
	(340, '233', '5'),
	(341, '234', '1'),
	(342, '235', '2'),
	(343, '236', '4'),
	(344, '237', '1'),
	(345, '238', '3'),
	(346, '239', '5'),
	(347, '240', '3'),
	(348, '241', '2'),
	(349, '242', '2'),
	(350, '243', '3'),
	(351, '244', '4'),
	(352, '245', '2'),
	(353, '246', '3'),
	(354, '247', '2'),
	(355, '248', '5'),
	(356, '249', '1'),
	(357, '250', '5'),
	(358, '251', '3'),
	(359, '252', '1'),
	(360, '253', '5'),
	(361, '254', '3'),
	(362, '255', '4'),
	(363, '256', '1'),
	(364, '257', '6'),
	(365, '258', '6'),
	(366, '259', '1'),
	(367, '260', '2'),
	(368, '261', '5'),
	(369, '262', '1'),
	(370, '263', '3'),
	(371, '264', '1'),
	(372, '265', '3'),
	(373, '266', '6'),
	(374, '267', '4'),
	(375, '268', '1'),
	(376, '269', '6'),
	(377, '270', '2'),
	(378, '271', '5'),
	(379, '272', '5'),
	(380, '273', '6'),
	(381, '274', '6'),
	(382, '275', '6'),
	(383, '276', '6'),
	(384, '277', '1'),
	(385, '278', '5'),
	(386, '279', '6'),
	(387, '280', '2'),
	(388, '281', '1'),
	(389, '282', '5'),
	(390, '283', '5'),
	(391, '284', '6'),
	(392, '285', '2'),
	(393, '286', '3'),
	(394, '287', '1'),
	(395, '288', '6'),
	(396, '289', '4'),
	(397, '290', '4'),
	(398, '291', '4'),
	(399, '292', '5'),
	(400, '293', '4'),
	(401, '294', '5'),
	(402, '295', '6'),
	(403, '296', '4'),
	(404, '297', '5'),
	(405, '298', '1'),
	(406, '299', '3'),
	(407, '300', '5'),
	(408, '301', '1'),
	(409, '302', '3'),
	(410, '303', '5'),
	(411, '304', '6'),
	(412, '305', '4'),
	(413, '306', '1'),
	(414, '307', '3'),
	(415, '308', '1'),
	(416, '309', '2'),
	(417, '310', '5'),
	(418, '311', '3');
/*!40000 ALTER TABLE `clasexdia` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.clasexestudiante
DROP TABLE IF EXISTS `clasexestudiante`;
CREATE TABLE IF NOT EXISTS `clasexestudiante` (
  `IdClasexEstudiante` int(11) NOT NULL AUTO_INCREMENT,
  `IdEstudiante` int(11) NOT NULL,
  `IdClase` int(11) NOT NULL COMMENT 'Corresponde al horario programado para el nivel',
  `Fechagraba` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `IdAsignado` int(11) NOT NULL,
  `Estado` varchar(1) DEFAULT NULL COMMENT 'A = aceptado, C=Cancelado',
  PRIMARY KEY (`IdClasexEstudiante`,`IdEstudiante`,`IdClase`,`IdAsignado`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.clasexestudiante: 4 rows
DELETE FROM `clasexestudiante`;
/*!40000 ALTER TABLE `clasexestudiante` DISABLE KEYS */;
INSERT INTO `clasexestudiante` (`IdClasexEstudiante`, `IdEstudiante`, `IdClase`, `Fechagraba`, `IdAsignado`, `Estado`) VALUES
	(57, 21, 303, '2017-10-05 01:05:18', 0, 'I'),
	(58, 21, 299, '2017-10-05 01:05:22', 0, 'I'),
	(59, 21, 300, '2017-10-05 01:05:28', 0, 'A'),
	(60, 21, 307, '2017-10-05 01:05:32', 0, 'A');
/*!40000 ALTER TABLE `clasexestudiante` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.conductores
DROP TABLE IF EXISTS `conductores`;
CREATE TABLE IF NOT EXISTS `conductores` (
  `IdConductor` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Id Conductor',
  `IdTransportador` int(3) DEFAULT NULL COMMENT 'Id del Transportador',
  `Nombres` varchar(100) DEFAULT NULL,
  `Nit` int(15) DEFAULT NULL,
  `IdCiudad` int(3) DEFAULT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `ddFechaVencePase` varchar(2) DEFAULT NULL,
  `mmFechaVencePase` varchar(2) DEFAULT NULL,
  `yyFechaVencePase` varchar(4) DEFAULT NULL,
  `Email` varchar(80) DEFAULT NULL,
  `FechaVencePase` date DEFAULT NULL,
  `EstadoConductor` varchar(1) DEFAULT NULL,
  `IdTipoDocumentoConductor` int(2) DEFAULT NULL,
  PRIMARY KEY (`IdConductor`)
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.conductores: 84 rows
DELETE FROM `conductores`;
/*!40000 ALTER TABLE `conductores` DISABLE KEYS */;
INSERT INTO `conductores` (`IdConductor`, `IdTransportador`, `Nombres`, `Nit`, `IdCiudad`, `Direccion`, `Telefono`, `Celular`, `ddFechaVencePase`, `mmFechaVencePase`, `yyFechaVencePase`, `Email`, `FechaVencePase`, `EstadoConductor`, `IdTipoDocumentoConductor`) VALUES
	(1, 1, 'LINA BETZABE LEON VARELA', 24694863, 629, 'CRA 18 A 11 # 28 LA POPA', '3136459165', '3136459165', NULL, NULL, NULL, 'bet3004@hotmail.com', '0000-00-00', NULL, NULL),
	(2, 1, 'CARLOS DAVID MARIN ARENAS', 10099241, 629, 'MZ 11 A CS 17 POBLADO 2', '3205198', '3122377287', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(3, 1, 'JHON FREDDY PLATA SUAREZ', 90874602, 629, 'MZ 14 CS 27 SAMARIA 1', '3127641639', '3127641639', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(4, 1, 'LUIS GABRIEL BARROSO MANGLONES', 18515677, 629, 'MZ 9 CS 27 SAMARIA 1', '3122892873', '3122892873', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(5, 1, 'NICOLAS DARIO OSSA DIAZ', 15902076, 629, 'MITACA TORRE 2 APARTA 203', '3137495519', '3137495519', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(6, 1, 'JUAN CARLOS CANAS', 1088289662, 629, 'MZ 13 A LA LAGUNA', '3146007655', '3146007655', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(7, 2, 'FABIO DE JESUS RAMIREZ GARCIA', 4390773, 263, 'MZ 10 CS 12', '3231416', '3117954163', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(8, 2, 'HERNAN TORRES GIRALDO', 10068546, 629, 'CALLE7 N9-71', '3355891', '3148697737', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(9, 2, 'FABIO FRANCO OSORIO', 10099344, 263, 'CASA 110 RESERVAS DEL LAGO', '3429438', '314653940', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(10, 2, 'SANIN GALLEGO SALAZAR', 10008997, 629, 'MZ 68 CASA26 LA HACIENDA', '3104228219', '3104228219', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(11, 2, 'CARLOS ANDRES PEREZ ARIAS', 1088296420, 629, 'MZ 4 CS 13 A   PANORAMA I', '3218776080', '3218776080', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(12, 1, 'JORGE JHONIER MARTINEZ', 18523899, 629, 'MZ 2 CS 57 VELA 1', '3127347709', '3127347709', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(13, 1, 'JAIR RAMIREZ', 1088, 629, 'CRA 18 A # 11- 28', '3207241077', '3207241077', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(89, 1, 'IVAN DARIO LONDOO', 18619037, 629, 'MZ 5 CS 25 QUINTAS DEL BOSQUE', '3155103250', '3155103250', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(90, 1, 'IVAN DARIO LONDOO', 18619037, 629, 'MZ 5 CS 25 QUINTAS DEL BOSQUE', '3155103250', '3155103250', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(91, 63, 'PRUEBA COTA', 12345, 235, 'HJHJ', '123', '5444', NULL, NULL, NULL, 'DSDFFDF', '0000-00-00', NULL, NULL),
	(92, 64, 'HUGO SUAREZ', 19357956, 104, 'CLL48K SUR 4-92', '8777510', '3114802515', NULL, NULL, NULL, 'operaciones@logicexpress.co', '0000-00-00', NULL, NULL),
	(93, 64, 'DUVERNEY MUNOZ AGUDELO', 1053777237, 104, 'CLL48K SUR 4-92', '3173724366', '3173724366', NULL, NULL, NULL, 'operaciones@logicexpress.co', '0000-00-00', NULL, NULL),
	(94, 65, 'ALFONSO URREA', 80406649, 897, 'CLL 9 1-17 TABIO ESTRELLA DEL NORTE', '8649519', '3124521883', NULL, NULL, NULL, 'alfonsourrea1975@gmail.com', '0000-00-00', NULL, NULL),
	(95, 66, 'LUZ ANGELA LOPEZ', 52194645, 104, 'CALLE 1B N° 82 - 40', '5711813', '3203395004', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(96, 67, 'LUIS ARMANDO LUNARES', 11186477, 104, 'GHGHGH', '4521886', '3124521886', NULL, NULL, NULL, 'HJHJH', '0000-00-00', NULL, NULL),
	(97, 68, 'JORGE ENRIQUE CORTES', 80192451, 104, '-', '3142811807', '3142811807', NULL, NULL, NULL, '-', '0000-00-00', NULL, NULL),
	(98, 64, 'HUGO FERNANDO SUAREZ PINILLA', 80126177, 104, 'VFDGFG', '222', 'SDFD', NULL, NULL, NULL, 'GHGHG', '0000-00-00', NULL, NULL),
	(99, 1, 'SEBASTIAN VALLECILLA', 1088294740, 629, 'MZ H CS 12 LA ALAMEDA CUBA', '3117286794', '3117286794', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(100, 63, 'jhon obando', 123456789, 104, 'cll 89 n 35 45a', '987654', 'no registra', NULL, NULL, NULL, 'no registra', '0000-00-00', NULL, NULL),
	(101, 1, 'LISABDRO GIRALDO LONDOO', 10144254, 629, 'CRA 18 A 11 # 28 LA POPA', '3117634909', '3117634909', NULL, NULL, NULL, 'NO REGISTRA', '0000-00-00', NULL, NULL),
	(102, 70, 'MAURICIO PALACIOS', 1212, 4, '22', '212', 'WW', NULL, NULL, NULL, 'W', '0000-00-00', NULL, NULL),
	(103, 70, 'CARLOS OSPINA', 4433, 249, 'DD', 'DDDD', 'DDD', NULL, NULL, NULL, 'DD', '0000-00-00', NULL, NULL),
	(108, 73, 'ALEXANDER ALVAREZ', 79653163, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(109, 74, 'ANCIZAR GIRALDO', 11251789, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(110, 75, 'JOSE ANTONIO VALERO', 1032409907, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(111, 81, 'RICARDO ACUNA', 79864047, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(115, 78, 'adan agudelo', 5938568, 246, 'no registra', 'no registra', '3134274024', NULL, NULL, NULL, 'no registra', '0000-00-00', NULL, NULL),
	(119, 84, 'RICARDO COGUA', 79363286, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(120, 85, 'ALFREDO OVALLE', 79453604, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(121, 86, 'PEDRO OJEDA', 19301109, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(122, 87, 'JHON DUARTE', 1023878762, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(123, 88, 'HECTOR BETANCOURT', 79448691, 104, 'CRA 69 H 78 47', '3099666', '3165292596', NULL, NULL, NULL, 'TR.EXPRESS2008@HOTMAIL.COM', '0000-00-00', NULL, NULL),
	(124, 90, 'peter jesus becerra villamizar', 13462518, 246, '1', '1', '1', NULL, NULL, NULL, '1', '0000-00-00', NULL, NULL),
	(125, 89, 'luis alfonzo calderon silva', 13352562, 246, '2', '2', '2', NULL, NULL, NULL, '2', '0000-00-00', NULL, NULL),
	(126, 91, 'jose vargas galvis', 88227074, 246, '3', '3', '3', NULL, NULL, NULL, '3', '0000-00-00', NULL, NULL),
	(127, 92, 'juan erazmo sanchez', 1090404779, 246, '4', '4', '4', NULL, NULL, NULL, '4', '0000-00-00', NULL, NULL),
	(128, 93, 'andres vargas', 1093792827, 246, '5', '5', '5', NULL, NULL, NULL, '5', '0000-00-00', NULL, NULL),
	(129, 94, 'adan agudelo', 5938568, 246, '6', '6', '6', NULL, NULL, NULL, '6', '0000-00-00', NULL, NULL),
	(130, 95, 'jose pastor rodriguez', 18933250, 246, 'v', 'v', 'z', NULL, NULL, NULL, 'z', '0000-00-00', NULL, NULL),
	(131, 96, 'alvaro enrique ramirez pabon', 13488227, 246, 'p', 'p', 'p', NULL, NULL, NULL, 'p', '0000-00-00', NULL, NULL),
	(132, 97, 'carmelita rosas', 37342562, 246, 'z', 'z', 'q', NULL, NULL, NULL, 'q', '0000-00-00', NULL, NULL),
	(133, 98, 'ADRIAN VARGAS', 79525908, 104, 'CRA 69 H 78 47', '3099666', '3165292596', NULL, NULL, NULL, 'TR.EXPRESS2008@HOTMAIL.COM', '0000-00-00', NULL, NULL),
	(134, 99, 'SUSANA MARIN', 51643116, 104, 'CRA 69 H 78 47', '3099666', '3165292596', NULL, NULL, NULL, 'TR.EXPRESS2008@HOTMAIL.COM', '0000-00-00', NULL, NULL),
	(135, 100, 'ELIECER ACUNA', 80018719, 104, 'CRA 69 H 78 47', '3099666', '3165292596', NULL, NULL, NULL, 'TR.EXPRESS2008@HOTMAIL.COM', '0000-00-00', NULL, NULL),
	(136, 101, 'maria eugenia ramirez', 28053387, 246, '1', '1', '1', NULL, NULL, NULL, '1', '0000-00-00', NULL, NULL),
	(137, 101, 'maria eugenia ramirez', 28053387, 246, '1', '1', '1', NULL, NULL, NULL, '1', '0000-00-00', NULL, NULL),
	(138, 102, 'sandra patricia caselles', 52900933, 246, 'b', 'b', 'b', NULL, NULL, NULL, 'b', '0000-00-00', NULL, NULL),
	(139, 103, 'FREDY RUIZ', 19336101, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(140, 104, 'MARIA MALAVER', 51572194, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(141, 105, 'ORLANDO ACOSTA', 17311823, 104, 'Cra 69H # 78-47 Las Ferias', '3166222126', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(142, 106, 'LUIS CARLOS PINEROS', 19347601, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(143, 107, 'ALFREDO CALDERON', 17192777, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(144, 108, 'HELI DUARTE', 79559603, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(145, 109, 'MARIO RAMIREZº', 16650322, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(146, 110, 'OLIVERIO', 111111, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(147, 111, 'CRISTIAN GONZALEZ', 333333, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(148, 112, 'ELIECER PULIDO', 755345, 104, '645', '3099666', '3166222126', NULL, NULL, NULL, 'Tggh', '0000-00-00', NULL, NULL),
	(149, 113, 'ALBALUZ', 8654, 104, '645', '3099666', '3166222126', NULL, NULL, NULL, 'Tggh', '0000-00-00', NULL, NULL),
	(151, 114, 'HUGO SUAREZ TR', 44444, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(152, 115, 'JEISSON PINEROS', 66666, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(153, 116, 'JORGE ARDILA', 79187802, 182, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(154, 117, 'RUBEN NINO', 11250761, 104, 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', NULL, NULL, NULL, 'tr.express2008@hotmail.com', '0000-00-00', NULL, NULL),
	(155, 118, 'Hernando', 0, 246, 'no registra', '000', '0000', NULL, NULL, NULL, 'no registra', '0000-00-00', NULL, NULL),
	(156, 119, 'ADRIANO DIAZ', 91014804, 79, '6666', '666', '676', NULL, NULL, NULL, 'UUU', '0000-00-00', NULL, NULL),
	(157, 120, 'DIANA BALLESTEROS', 30206597, 79, 'BARBOSA', '3206508999', '3206508999', NULL, NULL, NULL, 'Y', '0000-00-00', NULL, NULL),
	(158, 121, 'DIEGO BOLIVAR', 1049613139, 953, 'Y', '3193158431', '3193158431', NULL, NULL, NULL, 'Y', '0000-00-00', NULL, NULL),
	(159, 120, 'WILSON TRIANA', 91015620, 79, 'Y', '3204897115', '3204897115', NULL, NULL, NULL, 'Y', '0000-00-00', NULL, NULL),
	(160, 122, 'LUDY PENA', 1018440866, 193, 'Y', '3212325710', '3212325710', NULL, NULL, NULL, 'Y', '0000-00-00', NULL, NULL),
	(161, 123, 'WILMER BECERRA', 74381871, 264, 'Y', '3112203441', '3112203441', NULL, NULL, NULL, 'Y', '0000-00-00', NULL, NULL),
	(162, 124, 'ESPERANZA OBREGON', 181818, 246, 'HJHJKH', '76786786', '7787987', NULL, NULL, NULL, 'HJHJKHK', '0000-00-00', NULL, NULL),
	(163, 123, 'CARLOS DELGADO', 79736622, 862, 'Y', '3114860546', '3193158431', NULL, NULL, NULL, 'T', '0000-00-00', NULL, NULL),
	(164, 73, 'ada diaz castro', 23544444, 19, 'avenida 68 18-97', '4344', '434243', NULL, NULL, NULL, '343243', '0000-00-00', '1', 1),
	(165, 126, 'Pruebas Velotax', 1010170, 104, 'clckkjk', '21212', '7878', NULL, NULL, NULL, 'dsadsd', '0000-00-00', NULL, NULL),
	(166, 127, 'MARIO CANON', 22222, 104, '4444', '34444', '4444', NULL, NULL, NULL, '444', '0000-00-00', NULL, NULL),
	(167, 128, 'Leidy Acuna', 56777, 104, 'Hhvycg', '3099666', '3166222126', NULL, NULL, NULL, 'Tggh', '0000-00-00', NULL, NULL),
	(168, 85, 'dhdfh fh', 65465, 29, 'fhfd hfhfd', '456546', '54645654', NULL, NULL, NULL, 'mail@mail.com', '2017-12-28', '1', 1),
	(169, 113, 'gggg jjjjj', 85785687, 25, 'call 11', '1212121', '22223333', NULL, NULL, NULL, 'mail@mail.com', '2017-12-28', '1', 1),
	(170, 107, 'pedro', 534534534, 3, 'calle 2 45 24', '3142674416', '3254100235', NULL, NULL, NULL, 'pramirez@gmail.com', '2018-02-03', '1', 1);
/*!40000 ALTER TABLE `conductores` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.controlmesactual
DROP TABLE IF EXISTS `controlmesactual`;
CREATE TABLE IF NOT EXISTS `controlmesactual` (
  `IdMes` int(2) NOT NULL AUTO_INCREMENT,
  `NombreMes` varchar(20) DEFAULT NULL,
  `numeroMes` varchar(2) DEFAULT NULL,
  `fechaMes` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `estadoMes` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`IdMes`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.controlmesactual: 8 rows
DELETE FROM `controlmesactual`;
/*!40000 ALTER TABLE `controlmesactual` DISABLE KEYS */;
INSERT INTO `controlmesactual` (`IdMes`, `NombreMes`, `numeroMes`, `fechaMes`, `estadoMes`) VALUES
	(1, '', '9', '2018-09-29 23:07:00', 'A'),
	(2, '', '10', '2018-10-01 08:12:52', 'A'),
	(3, '', '11', '2017-11-27 11:10:51', 'A'),
	(4, '', '12', '2017-12-28 18:09:47', 'A'),
	(5, '', '1', '2018-01-06 11:23:50', 'A'),
	(6, '', '2', '2018-02-03 18:50:54', 'A'),
	(7, '', '5', '2018-05-06 04:04:59', 'A'),
	(8, '', '7', '2018-07-30 21:58:30', 'A');
/*!40000 ALTER TABLE `controlmesactual` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.cupos
DROP TABLE IF EXISTS `cupos`;
CREATE TABLE IF NOT EXISTS `cupos` (
  `IdCupo` tinyint(1) NOT NULL AUTO_INCREMENT,
  `Cantidad` tinyint(1) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`IdCupo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.cupos: 1 rows
DELETE FROM `cupos`;
/*!40000 ALTER TABLE `cupos` DISABLE KEYS */;
INSERT INTO `cupos` (`IdCupo`, `Cantidad`, `Estado`) VALUES
	(1, 5, '1');
/*!40000 ALTER TABLE `cupos` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.estadoactivo
DROP TABLE IF EXISTS `estadoactivo`;
CREATE TABLE IF NOT EXISTS `estadoactivo` (
  `IdEstadoActivo` int(1) NOT NULL AUTO_INCREMENT,
  `NombreActivo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdEstadoActivo`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.estadoactivo: 2 rows
DELETE FROM `estadoactivo`;
/*!40000 ALTER TABLE `estadoactivo` DISABLE KEYS */;
INSERT INTO `estadoactivo` (`IdEstadoActivo`, `NombreActivo`) VALUES
	(1, 'Activo'),
	(2, 'Inactivo');
/*!40000 ALTER TABLE `estadoactivo` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.estudiante
DROP TABLE IF EXISTS `estudiante`;
CREATE TABLE IF NOT EXISTS `estudiante` (
  `IdEstudiante` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del Estudiante',
  `TipoDocumento_EST` smallint(2) DEFAULT NULL COMMENT 'Tipo Documento de Identificacion',
  `NumeroDocumento_EST` varchar(20) NOT NULL COMMENT 'Numero del Documento de Identificacion',
  `Nombres_EST` varchar(55) DEFAULT NULL COMMENT 'Nombre Estudiantes',
  `Apellido1_EST` varchar(55) DEFAULT NULL COMMENT 'Primer Apellido',
  `Apellido2_EST` varchar(55) DEFAULT NULL COMMENT 'Segundo Apellido',
  `FechaCreacion_EST` datetime DEFAULT NULL,
  `Usuario_EST` varchar(45) DEFAULT NULL COMMENT 'Usuario',
  `Clave_EST` varchar(25) DEFAULT NULL COMMENT 'Clave del Estudiante',
  `Estado_EST` int(1) DEFAULT NULL,
  `IdCiudad_EST` smallint(3) DEFAULT NULL,
  `Direccion_EST` varchar(255) DEFAULT NULL,
  `Email_EST` varchar(105) DEFAULT NULL,
  `Celular_EST` varchar(20) DEFAULT NULL COMMENT 'Nro Telefono Celular',
  `TelefonoFijo_EST` varchar(15) DEFAULT NULL COMMENT 'Nro. Telefono Fijo',
  `Estado_IdEstado` int(11) NOT NULL,
  `Sucursal_EST` int(1) DEFAULT NULL,
  PRIMARY KEY (`IdEstudiante`,`NumeroDocumento_EST`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.estudiante: 18 rows
DELETE FROM `estudiante`;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` (`IdEstudiante`, `TipoDocumento_EST`, `NumeroDocumento_EST`, `Nombres_EST`, `Apellido1_EST`, `Apellido2_EST`, `FechaCreacion_EST`, `Usuario_EST`, `Clave_EST`, `Estado_EST`, `IdCiudad_EST`, `Direccion_EST`, `Email_EST`, `Celular_EST`, `TelefonoFijo_EST`, `Estado_IdEstado`, `Sucursal_EST`) VALUES
	(1, 1, '798754', 'mao', 'san', '', '2017-05-15 23:27:32', '', '', 1, 0, 'calle 153', 'msmakesof@gmail.com', '868686', '464632', 0, 1),
	(2, 1, '663465436', 'mao', 'san', '', '2017-05-17 15:34:52', '', '', 1, 0, 'calle 153 # 94-51', 'msmakesof@gmail.com', '5476', '58876', 0, 1),
	(8, 1, '5674757', 'Mauricio', 'Sanchez Sierra', '', '2017-05-16 16:05:45', '', '', 1, 0, 'calle 153 # 94-51', 'msmakesof@gmail.com', '65634', '3463443', 0, 1),
	(9, 1, '89078908790', 'azul', 'sanchez', '', '2017-05-16 16:14:04', '', '123456', 1, 0, 'calle 153 # 94-51', 'azul@gmail.com', '4536354', '', 0, 1),
	(10, 1, '5465464564', 'juana', 'san', '', '2017-05-17 18:09:45', '', '', 1, 0, 'calle 123', 'juana@mail.com', '67657657', '', 0, 3),
	(14, 2, '978979', 'ljkljlkj', 'jlkjljñlk', '', '2017-05-18 19:27:47', '', '', 1, 0, 'cdacadscadsga ggh56y655', 'kjlkjlkj@mail.com', '6365', '3634', 0, 1),
	(15, 2, '536345645', 'Fanny lu', 'Restrepo', '', '2017-05-18 19:32:13', '', '123456', 1, 0, 'sd ghgj87987978', 'Fannyly@mail.com', '788785', '', 0, 1),
	(28, 1, '54565', 'artag', 'hernandez', NULL, '2017-06-26 15:11:48', NULL, '123456', 1, 0, 'calle 56', 'artag@gmail.com', '13123123', '', 0, 1),
	(18, 2, '87987999', 'mario', 'bros', '', '2017-05-18 23:54:20', '', '123456', 1, 0, 'carrera 90', 'mar@gmail.com', '97979879', '8789789', 0, 1),
	(19, 4, '6546546', 'mar', 'claro', NULL, '2017-05-29 02:06:28', NULL, '123456', 1, 0, 'carrera 68', 'mar@mail.com', '553535', '', 0, 3),
	(20, 2, '534535', 'xili', 'xua', NULL, '2017-05-29 02:22:54', NULL, '123456', 1, 0, 'diagonal 123', 'mail@gmail.com', '5345435', '', 0, 1),
	(21, 3, '14234124', 'diego', 'alarcon', NULL, '2017-05-29 02:37:51', NULL, '123456', 1, 0, 'calle 89', 'diego@mail.com', '34234', '', 0, 1),
	(22, 1, '65654', 'sofia', 'guti', NULL, '2017-05-29 02:40:54', NULL, '123456', 1, 0, 'calle 153 # 94-51', 'msmakesof@gmail.com', '6464564', '', 0, 1),
	(23, 2, '76867', 'laura', 'Sanchez Sierra', NULL, '2017-05-29 02:42:09', NULL, '12345', 1, 0, 'calle 153 # 94-51', 'msmakesof@gmail.com', '64564', '', 0, 3),
	(24, 4, '87975', 'ana', 'gomez', NULL, '2017-05-29 02:43:36', NULL, '123456', 1, 0, 'carrera 656', 'gomez@mail.com', '53534', '', 0, 2),
	(25, 1, '645654', 'darcy', 'hernandez', NULL, '2017-05-29 02:45:05', NULL, '123456', 1, 0, 'calle 56', 'h5435@mail.com', '534535', '', 0, 3),
	(26, 1, '86465', 'carlo', 'castro', NULL, '2017-05-29 02:55:33', NULL, '123456', 1, 0, 'carrera 45', 'cc@mail.com', '52534534', '', 0, 3),
	(27, 1, '65368', 'nairo', 'quintana', NULL, '2017-05-29 02:56:56', NULL, '123456', 1, 0, 'calle 153 # 94-51', 'msmakesof@gmail.com', '4564564', '', 0, 1);
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.eventos
DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `body` text COLLATE utf8_spanish_ci,
  `url` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `class` varchar(48) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'event-important',
  `start` varchar(16) COLLATE utf8_spanish_ci DEFAULT NULL,
  `end` varchar(16) COLLATE utf8_spanish_ci DEFAULT NULL,
  `start_normal` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  `end_normal` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla movilweb.eventos: 1 rows
DELETE FROM `eventos`;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` (`id`, `title`, `body`, `url`, `class`, `start`, `end`, `start_normal`, `end_normal`) VALUES
	(19, 'gsdgfsdg', 'dgdfg', 'http://127.0.0.1/bootstrap-calendar/modificado/evento-detalles.php?id=19', 'event-success', '1496899320000', '1496899320000', '08/06/2017 00:22', '08/06/2017 00:22');
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.eventos2
DROP TABLE IF EXISTS `eventos2`;
CREATE TABLE IF NOT EXISTS `eventos2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `body` text COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `class` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'event-important',
  `start` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `end` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `inicio_normal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `final_normal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla movilweb.eventos2: 1 rows
DELETE FROM `eventos2`;
/*!40000 ALTER TABLE `eventos2` DISABLE KEYS */;
INSERT INTO `eventos2` (`id`, `title`, `body`, `url`, `class`, `start`, `end`, `inicio_normal`, `final_normal`) VALUES
	(36, '1', '19', 'http://localhost/coningles/Calendario/descripcion_evento.php?id=36', '2', '1483678800000', '1488776400000', '01/06/2017', '06/06/2017');
/*!40000 ALTER TABLE `eventos2` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.funcionario
DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `IdFuncionario` int(4) NOT NULL AUTO_INCREMENT,
  `funIdFuncionario` int(3) DEFAULT NULL,
  `IdCentroAcopio` int(3) DEFAULT NULL,
  `ClaveFuncionario` varchar(255) DEFAULT NULL,
  `EstadoFuncionario` varchar(1) DEFAULT NULL,
  `NombresFuncionario` varchar(80) DEFAULT NULL,
  `ApellidosFuncionario` varchar(80) DEFAULT NULL,
  `IdIpsFuncionario` varchar(3) DEFAULT NULL,
  `IdCargoFuncionario` varchar(2) DEFAULT NULL,
  `ddIngresoFuncionario` varchar(2) DEFAULT NULL,
  `mmIngresoFuncionario` varchar(2) DEFAULT NULL,
  `yyIngresoFuncionario` varchar(4) DEFAULT NULL,
  `EmailFuncionario` varchar(80) DEFAULT NULL,
  `IdTipoDocumentofuncionario` int(2) DEFAULT NULL,
  PRIMARY KEY (`IdFuncionario`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.funcionario: 42 rows
DELETE FROM `funcionario`;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` (`IdFuncionario`, `funIdFuncionario`, `IdCentroAcopio`, `ClaveFuncionario`, `EstadoFuncionario`, `NombresFuncionario`, `ApellidosFuncionario`, `IdIpsFuncionario`, `IdCargoFuncionario`, `ddIngresoFuncionario`, `mmIngresoFuncionario`, `yyIngresoFuncionario`, `EmailFuncionario`, `IdTipoDocumentofuncionario`) VALUES
	(2, 1006794259, 1, '4259', '1', 'JOSE IVAN', 'JARAMILLO', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(3, 1121929349, 1, '9511', '2', 'ANDRES', 'BELTRAN SALCEDO', '', '', NULL, NULL, NULL, 'mail@mail.com', 1),
	(4, 1121936656, 1, '1234', '2', 'EDWIN JAHIR', 'PINZON TORRES', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(5, 39760683, 1, '0683', '2', 'NUBIA STELLA', 'NARVAEZ RODRIGUEZ', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(6, 91001414, 2, '1234', '1', 'LUIS FRANCISCO', 'PINTO MARIN', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(7, 123456789, 3, '1234', '1', 'CLAUDIA PATRICIA', 'ARANGO LOPEZ', '', '', NULL, NULL, NULL, 'mail@gmail.com', 1),
	(8, 65757633, 4, '1234', '2', 'MARTHA PATRICIA', 'RODRIGUEZ MORE', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(9, 30336395, 5, '1234', '1', 'CLAUDIA PATRICIA', 'ARANGO LOPEZ', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(10, 66722412, 6, '1234', '1', 'GLADIS', 'GIRALDO MEDINA', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(11, 0, 7, '1234', '1', 'GONZALO', 'RODRIGUEZ GIL', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(12, 28559497, 4, '1234', '1', 'DIANA MARITZA', 'LOPEZ MORENO', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(13, 98694985, 5, '1234', '1', 'ANDRES FELIPE', 'CADAVID GOMEZ', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(14, 0, 1, 'movi', '1', 'MOVIL', 'WEB', '0', '1', NULL, NULL, NULL, NULL, NULL),
	(15, NULL, 8, '4259', '2', 'JOSE IVAN', 'JARAMILLO', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(16, 1057514986, 8, '1234', '1', 'BLADIMIR', 'CALDERON MOLINA', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(17, 1019111804, 1, '1234', '2', 'GIOVANNA ALEJANDRA', 'GALLEGO', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(18, 1121921216, 1, '9503', '2', 'FABIAN FELIPE', 'GOMEZ AGUILAR', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(19, 1121851050, 1, '1050', '2', 'LEONARDO', 'RIOS PAEZ', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(20, 80513617, 10, '1234', '2', 'EDGAR', 'DELGADILLO', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(21, 30403217, 5, '1234', '1', 'MARTHA JANETH', 'FRANCO TABARES', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(22, 0, 11, '1234', '2', 'LOREY', 'BARRERA', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(23, 0, 1, '1234', '1', 'YETSY LOREY', 'BARRERA GIL', '0', '1', NULL, NULL, NULL, NULL, NULL),
	(24, 41723140, 16, '1234', '1', 'LUZ MARY', 'DIAZ', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(25, 1000223163, 1, '3163', '1', 'ROBINSON JAVIER', 'SANABRIA VARGAS', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(26, 94389299, 12, '1234', '1', 'Giovanny', 'Ruiz', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(27, 122122348, 1, '2348', '2', 'HAIDY MAYERLI', 'ALMEIDA', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(28, 1122122348, 1, '1122', '1', 'HAIDY MAYERLI', 'ALMEIDA', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(29, 86062134, 1, '2134', '1', 'TINO ALBERTO', 'GAZZOLLI CAIRO', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(30, 0, 13, '1234', '1', 'Ruben', 'Pabon', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(31, NULL, 13, '1234', '1', 'Harbey', 'Cuellar', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(33, 24694863, 14, '4863', '1', 'LINA', 'LEON', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(34, 40389643, 1, '9643', '2', 'SANDRA LUCIA', 'BOBADILLA DURAN', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(35, 13007730, 9, '1234', '1', 'Lucio Libardo', 'Hernandez', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(36, 42122600, 15, '1234', '1', 'FRANCY LILIANA', 'VERA', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(37, 0, 11, '1234', '1', 'Humberto', 'Garcia', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(38, 86061524, 1, '1704', '2', 'NELSON ALBERTO', 'MENDOZA ROMERO', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(39, NULL, 11, '1234', '1', 'Luis Ernesto', 'Ruiz', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(40, 1121928501, 1, '1234', '1', 'Camilo Andres', 'Hernandez', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(41, 1121907150, 1, '1234', '1', 'Eduard Orlandro', 'Rivera', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(42, 1119893137, 1, '3137', '1', 'JUAN PABLO', 'GUARNIZO CAMARGO', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(43, 1121888956, 11, '1234', '1', 'Danny Ludin', 'Villar  Acosta', '0', '0', NULL, NULL, NULL, NULL, NULL),
	(44, 1057514986, 8, '1234', '1', 'bladimir', 'calderon molina', '0', '0', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_acciones
DROP TABLE IF EXISTS `gen_acciones`;
CREATE TABLE IF NOT EXISTS `gen_acciones` (
  `IdAccion` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Id Opcion del menu',
  `NombreAccion` varchar(20) DEFAULT NULL,
  `EstadoAccion` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`IdAccion`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.gen_acciones: 6 rows
DELETE FROM `gen_acciones`;
/*!40000 ALTER TABLE `gen_acciones` DISABLE KEYS */;
INSERT INTO `gen_acciones` (`IdAccion`, `NombreAccion`, `EstadoAccion`) VALUES
	(1, 'Crear', 1),
	(2, 'Consultar', 1),
	(3, 'Modificar', 1),
	(4, 'Imprimir', 1),
	(5, 'Borrar', 1),
	(6, 'Cargar Datas', 1);
/*!40000 ALTER TABLE `gen_acciones` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_ciudad
DROP TABLE IF EXISTS `gen_ciudad`;
CREATE TABLE IF NOT EXISTS `gen_ciudad` (
  `CIU_IdCiudades` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id control',
  `CIU_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `CIU_Abreviatura` char(4) NOT NULL COMMENT 'Abreviatura',
  `CIU_IdDepartamento` smallint(6) NOT NULL COMMENT 'Departamento donde se encuentra ubicada.',
  `CIU_Estado` tinyint(4) NOT NULL COMMENT 'Estado (Activo/Inactivo)',
  PRIMARY KEY (`CIU_IdCiudades`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='información de la Ciudad.';

-- Volcando datos para la tabla movilweb.gen_ciudad: 11 rows
DELETE FROM `gen_ciudad`;
/*!40000 ALTER TABLE `gen_ciudad` DISABLE KEYS */;
INSERT INTO `gen_ciudad` (`CIU_IdCiudades`, `CIU_Nombre`, `CIU_Abreviatura`, `CIU_IdDepartamento`, `CIU_Estado`) VALUES
	(1, 'CUCUTA', '001', 10, 1),
	(2, 'BOGOTA', '001', 12, 1),
	(3, 'MEDELLIN', '001', 5, 1),
	(4, 'CALI', '001', 2, 1),
	(5, 'TUNJA', '001', 3, 1),
	(6, 'NEIVA', '001', 8, 1),
	(8, 'PASTO', '001', 11, 1),
	(10, 'SANTA MARTA', '001', 25, 1),
	(11, 'BUCARAMANGA', '001', 9, 1),
	(12, 'RIOHACHA', '001', 6, 1),
	(13, 'BARRANQUILLA', '001', 1, 1);
/*!40000 ALTER TABLE `gen_ciudad` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_configuracion
DROP TABLE IF EXISTS `gen_configuracion`;
CREATE TABLE IF NOT EXISTS `gen_configuracion` (
  `CON_IdConfiguracion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `CON_TituloApp` char(50) NOT NULL COMMENT 'Nombre de la App o Herramienta',
  `CON_Logo` char(100) NOT NULL COMMENT 'ubicacion del logo',
  `CON_Version` char(100) NOT NULL COMMENT 'Versión de la Herramienta',
  `CON_Derechos` char(100) NOT NULL COMMENT 'Año de Creación y Logo de Copy Right',
  `CON_Empresa` char(100) NOT NULL COMMENT 'Nombre Empresa',
  `CON_Estado` tinyint(4) NOT NULL COMMENT 'Estado del registro',
  PRIMARY KEY (`CON_IdConfiguracion`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Tabla base de configuración.';

-- Volcando datos para la tabla movilweb.gen_configuracion: 1 rows
DELETE FROM `gen_configuracion`;
/*!40000 ALTER TABLE `gen_configuracion` DISABLE KEYS */;
INSERT INTO `gen_configuracion` (`CON_IdConfiguracion`, `CON_TituloApp`, `CON_Logo`, `CON_Version`, `CON_Derechos`, `CON_Empresa`, `CON_Estado`) VALUES
	(1, 'Movil Web.', 'images/logomin.fw.png', '1.0.0', '&copy; 2018', 'Movil Web', 1);
/*!40000 ALTER TABLE `gen_configuracion` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_control
DROP TABLE IF EXISTS `gen_control`;
CREATE TABLE IF NOT EXISTS `gen_control` (
  `CON_IdControl` int(11) NOT NULL AUTO_INCREMENT,
  `CON_LlaveAcceso` varchar(500) DEFAULT NULL,
  `CON_IdEstado` int(1) DEFAULT NULL,
  `CON_LlaveInicial` varchar(50) DEFAULT NULL,
  `CON_LlaveIv` varchar(50) DEFAULT NULL,
  `CON_MetodoEncriptacion` varchar(50) DEFAULT NULL,
  `CON_TipoHash` varchar(20) DEFAULT NULL,
  `CON_Cookie` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CON_IdControl`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Tabla de control de acceso.';

-- Volcando datos para la tabla movilweb.gen_control: 1 rows
DELETE FROM `gen_control`;
/*!40000 ALTER TABLE `gen_control` DISABLE KEYS */;
INSERT INTO `gen_control` (`CON_IdControl`, `CON_LlaveAcceso`, `CON_IdEstado`, `CON_LlaveInicial`, `CON_LlaveIv`, `CON_MetodoEncriptacion`, `CON_TipoHash`, `CON_Cookie`) VALUES
	(1, 'V14l1br390$MKS-395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60c5b8', 1, '92AE31A79FEEB2A3\'muni\'', '395f426c0e5bd914375837483b791d80854dd9a19dd86fd189', 'AES-256-CBC', 'sha256', 'Pharametrykham');
/*!40000 ALTER TABLE `gen_control` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_departamento
DROP TABLE IF EXISTS `gen_departamento`;
CREATE TABLE IF NOT EXISTS `gen_departamento` (
  `DEP_IdDepartamento` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id Control.',
  `DEP_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `DEP_Pais` smallint(6) NOT NULL COMMENT 'Id del Pais al cual pertenece el Departamento.',
  `DEP_Estado` tinyint(4) NOT NULL COMMENT 'Estado Ativo/Inactivo.',
  `DEP_CodigoDane` char(2) DEFAULT NULL COMMENT 'Código Dane del Departamento, esto para la composicion del numero del Proceso',
  PRIMARY KEY (`DEP_IdDepartamento`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='información general del Departamento.';

-- Volcando datos para la tabla movilweb.gen_departamento: 33 rows
DELETE FROM `gen_departamento`;
/*!40000 ALTER TABLE `gen_departamento` DISABLE KEYS */;
INSERT INTO `gen_departamento` (`DEP_IdDepartamento`, `DEP_Nombre`, `DEP_Pais`, `DEP_Estado`, `DEP_CodigoDane`) VALUES
	(1, 'ATLANTICO', 0, 1, '08'),
	(2, 'VALLE', 0, 1, '76'),
	(3, 'BOYACA', 0, 1, '15'),
	(4, 'CUNDINAMARCA', 0, 1, '25'),
	(5, 'ANTIOQUIA', 0, 1, '05'),
	(6, 'GUAJIRA', 0, 1, '44'),
	(8, 'HUILA', 0, 1, '41'),
	(9, 'SANTANDER', 0, 1, '68'),
	(10, 'NORTE DE SANTANDER', 0, 1, '54'),
	(11, 'NARIÑO', 0, 1, '52'),
	(12, 'BOGOTÁ', 1, 1, '11'),
	(13, 'BOLIVAR', 1, 1, '13'),
	(14, 'ARAUCA', 1, 1, '81'),
	(15, 'ARCHIPIELAGO DE SAN ANDRES Y PROVIDENCIA', 1, 1, '88'),
	(16, 'CALDAS', 1, 1, '17'),
	(17, 'CAQUETA', 1, 1, '18'),
	(18, 'CASANARE', 1, 1, '85'),
	(19, 'CAUCA', 1, 1, '19'),
	(20, 'CESAR', 1, 1, '20'),
	(21, 'CHOCO', 1, 1, '27'),
	(22, 'CORDOBA', 1, 1, '23'),
	(23, 'GUAINIA', 1, 1, '94'),
	(24, 'GUAVIARE', 1, 1, '95'),
	(25, 'MAGDALENA', 1, 1, '47'),
	(26, 'META', 1, 1, '50'),
	(27, 'PUTUMAYO', 1, 1, '86'),
	(28, 'QUINDIO', 1, 1, '63'),
	(29, 'RISARALDA', 1, 1, '66'),
	(30, 'SUCRE', 1, 1, '70'),
	(31, 'TOLIMA', 1, 1, '73'),
	(32, 'VALLE DEL CAUCA', 1, 1, '76'),
	(33, 'VAUPES', 1, 1, '97'),
	(34, 'VICHADA', 1, 1, '99');
/*!40000 ALTER TABLE `gen_departamento` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_estado
DROP TABLE IF EXISTS `gen_estado`;
CREATE TABLE IF NOT EXISTS `gen_estado` (
  `Id_Estado` int(1) NOT NULL AUTO_INCREMENT,
  `Nombre_Estado` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`Id_Estado`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla movilweb.gen_estado: 2 rows
DELETE FROM `gen_estado`;
/*!40000 ALTER TABLE `gen_estado` DISABLE KEYS */;
INSERT INTO `gen_estado` (`Id_Estado`, `Nombre_Estado`) VALUES
	(1, 'SI'),
	(2, 'NO');
/*!40000 ALTER TABLE `gen_estado` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_festivo
DROP TABLE IF EXISTS `gen_festivo`;
CREATE TABLE IF NOT EXISTS `gen_festivo` (
  `FES_IdFestivo` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id de Control',
  `FES_Festivo` char(50) DEFAULT NULL COMMENT 'Dia Festivo',
  `FES_VanciaJudicial` char(1) NOT NULL COMMENT 'Paramarcar si el dia se contempla como Vancia Judicial, los dias que los juzgados no prestan servicio.',
  `FES_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo/Inactivo',
  PRIMARY KEY (`FES_IdFestivo`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Relaciona los dias Festivo por año.';

-- Volcando datos para la tabla movilweb.gen_festivo: 6 rows
DELETE FROM `gen_festivo`;
/*!40000 ALTER TABLE `gen_festivo` DISABLE KEYS */;
INSERT INTO `gen_festivo` (`FES_IdFestivo`, `FES_Festivo`, `FES_VanciaJudicial`, `FES_Estado`) VALUES
	(1, '2018-08-05', '1', 1),
	(2, '2018-08-07', '1', 1),
	(3, '2018-08-12', '', 1),
	(4, '2018-08-19', '1', 1),
	(6, '2018-10-15', '1', 1),
	(7, '2018-12-25', '1', 1);
/*!40000 ALTER TABLE `gen_festivo` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_grupo
DROP TABLE IF EXISTS `gen_grupo`;
CREATE TABLE IF NOT EXISTS `gen_grupo` (
  `GRU_IdGrupo` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Grupo',
  `GRU_Nombre` char(50) DEFAULT '0' COMMENT 'Nombre del Grupo',
  `GRU_Estado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`GRU_IdGrupo`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Clasificacion por Grupos para el menu';

-- Volcando datos para la tabla movilweb.gen_grupo: 5 rows
DELETE FROM `gen_grupo`;
/*!40000 ALTER TABLE `gen_grupo` DISABLE KEYS */;
INSERT INTO `gen_grupo` (`GRU_IdGrupo`, `GRU_Nombre`, `GRU_Estado`) VALUES
	(1, 'GENERAL', 1),
	(3, 'CLIENTE', 1),
	(4, 'ND', 0),
	(5, 'ND', 0),
	(6, 'USUARIO', 1);
/*!40000 ALTER TABLE `gen_grupo` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_pais
DROP TABLE IF EXISTS `gen_pais`;
CREATE TABLE IF NOT EXISTS `gen_pais` (
  `PAI_IdPais` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `PAI_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre del Pais.',
  `PAI_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado Activo/Inactivo.',
  PRIMARY KEY (`PAI_IdPais`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='informacion del Pais al cual pertenece un Departamento.';

-- Volcando datos para la tabla movilweb.gen_pais: 1 rows
DELETE FROM `gen_pais`;
/*!40000 ALTER TABLE `gen_pais` DISABLE KEYS */;
INSERT INTO `gen_pais` (`PAI_IdPais`, `PAI_Nombre`, `PAI_Estado`) VALUES
	(1, 'COLOMBIA', 1);
/*!40000 ALTER TABLE `gen_pais` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_roles
DROP TABLE IF EXISTS `gen_roles`;
CREATE TABLE IF NOT EXISTS `gen_roles` (
  `IdRol` int(2) NOT NULL AUTO_INCREMENT,
  `NombreRol` varchar(50) DEFAULT NULL,
  `EstadoRol` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`IdRol`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.gen_roles: 4 rows
DELETE FROM `gen_roles`;
/*!40000 ALTER TABLE `gen_roles` DISABLE KEYS */;
INSERT INTO `gen_roles` (`IdRol`, `NombreRol`, `EstadoRol`) VALUES
	(1, 'Super Administrador', 1),
	(2, 'Administrador', 1),
	(3, 'Operativo', 1),
	(4, 'Basico', 1);
/*!40000 ALTER TABLE `gen_roles` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_tabla
DROP TABLE IF EXISTS `gen_tabla`;
CREATE TABLE IF NOT EXISTS `gen_tabla` (
  `TAB_IdTabla` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id control',
  `TAB_Nombre_Tabla` char(50) NOT NULL COMMENT 'Nombre',
  `TAB_NombreMostrar` char(50) NOT NULL COMMENT 'Nombre a Mostrar',
  `TAB_Grupo` tinyint(4) NOT NULL,
  `TAB_IdEstadoTabla` tinyint(4) NOT NULL COMMENT 'Estado',
  PRIMARY KEY (`TAB_IdTabla`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='Tablas del sistema';

-- Volcando datos para la tabla movilweb.gen_tabla: 26 rows
DELETE FROM `gen_tabla`;
/*!40000 ALTER TABLE `gen_tabla` DISABLE KEYS */;
INSERT INTO `gen_tabla` (`TAB_IdTabla`, `TAB_Nombre_Tabla`, `TAB_NombreMostrar`, `TAB_Grupo`, `TAB_IdEstadoTabla`) VALUES
	(1, 'usu_usuario', 'USUARIO', 6, 1),
	(2, 'gen_pais', 'PAIS', 1, 1),
	(3, 'gen_ciudad', 'CIUDAD', 1, 1),
	(4, 'gen_tabla', 'TABLA', 0, 1),
	(5, 'gen_festivo', 'FESTIVO', 1, 1),
	(19, 'gen_tipodocumento', 'TIPO DOCUMENTO', 1, 1),
	(7, 'gen_departamento', 'DEPARTAMENTO', 1, 1),
	(20, 'cli_tipocliente', 'TIPO CLIENTE', 3, 1),
	(21, 'ND', 'ND', 4, 0),
	(22, 'ND', 'ND', 4, 0),
	(23, 'ND', 'ND', 4, 0),
	(24, 'gen_tipopersona', 'TIPO PERSONA', 1, 1),
	(25, 'usu_tipousuario', 'TIPO USUARIO', 6, 1),
	(26, 'ND', 'ND', 4, 0),
	(27, 'gen_grupo', 'GRUPO', 0, 1),
	(28, 'ND', 'ND', 5, 0),
	(29, 'ND', 'ND', 5, 0),
	(30, 'ND', 'ND', 5, 0),
	(31, 'ND', 'ND', 5, 0),
	(32, 'ND', 'ND', 5, 0),
	(33, 'cli_cliente', 'CLIENTE', 3, 1),
	(34, 'acciones', 'ACCIONES', 1, 1),
	(35, 'centrosacopio', 'CENTROSACOPIO', 1, 1),
	(36, 'transportadores', 'TRANSPORTADORES', 1, 1),
	(37, 'conductores', 'CONDUCTORES', 1, 1),
	(38, 'vehiculos', 'VEHICULOS', 1, 1);
/*!40000 ALTER TABLE `gen_tabla` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_tablas
DROP TABLE IF EXISTS `gen_tablas`;
CREATE TABLE IF NOT EXISTS `gen_tablas` (
  `Id_Tabla` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Tabla` varchar(30) DEFAULT NULL,
  `Id_EstadoTabla` int(1) DEFAULT NULL,
  `NombreMostrar` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id_Tabla`)
) ENGINE=MyISAM AUTO_INCREMENT=284 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla movilweb.gen_tablas: 19 rows
DELETE FROM `gen_tablas`;
/*!40000 ALTER TABLE `gen_tablas` DISABLE KEYS */;
INSERT INTO `gen_tablas` (`Id_Tabla`, `Nombre_Tabla`, `Id_EstadoTabla`, `NombreMostrar`) VALUES
	(26, 'temas', 0, 'TEMAS'),
	(27, 'salon', 0, 'SALON'),
	(14, 'usuarios', 1, 'USUARIOS'),
	(20, 'tablas', 1, 'TABLAS'),
	(19, 'horarios', 0, 'HORARIOS'),
	(13, 'estados', 1, 'ESTADOS'),
	(271, 'sedes', 0, 'SEDES'),
	(272, 'alumnos', 0, 'ALUMNOS'),
	(273, 'profesores', 0, 'PROFESORES'),
	(274, 'cupos', 0, 'CUPOS'),
	(275, 'temasxnivel', 0, 'TEMASXNIVEL'),
	(276, 'funcionarios', 1, 'FUNCIONARIOS'),
	(277, 'roles', 1, 'ROLES'),
	(278, 'acciones', 1, 'ACCIONES'),
	(279, 'accionesxrol', 1, 'ACCIONESXROL'),
	(280, 'centrosacopio', 1, 'CENTROSACOPIO'),
	(281, 'transportadores', 1, 'TRANSPORTADORES'),
	(282, 'conductores', 1, 'CONDUCTORES'),
	(283, 'vehiculos', 1, 'VEHICULOS');
/*!40000 ALTER TABLE `gen_tablas` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_tipodocumento
DROP TABLE IF EXISTS `gen_tipodocumento`;
CREATE TABLE IF NOT EXISTS `gen_tipodocumento` (
  `TDO_IdTipoDocumento` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id del Tipo de Documento de Identificacion',
  `TDO_Abreviatura` char(4) NOT NULL COMMENT 'Abreviatura para el del Tipo de Documento de Identificacion',
  `TDO_Nombre` char(100) NOT NULL COMMENT 'Nombre del Tipo de Documento de Identificacion',
  `TDO_Estado` tinyint(4) NOT NULL COMMENT 'Estado del registro en la tabla .',
  PRIMARY KEY (`TDO_IdTipoDocumento`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Infomación de los diferentes tipos de documento de identificacion.';

-- Volcando datos para la tabla movilweb.gen_tipodocumento: 5 rows
DELETE FROM `gen_tipodocumento`;
/*!40000 ALTER TABLE `gen_tipodocumento` DISABLE KEYS */;
INSERT INTO `gen_tipodocumento` (`TDO_IdTipoDocumento`, `TDO_Abreviatura`, `TDO_Nombre`, `TDO_Estado`) VALUES
	(1, 'CC', 'Cédula de Ciudadanía', 1),
	(2, 'CE', 'Cédula de Extranjería', 1),
	(3, 'TI', 'Tarjeta de Identidad', 1),
	(4, 'PA', 'PASAPORTE', 2),
	(13, 'NUP', 'NUIP', 1);
/*!40000 ALTER TABLE `gen_tipodocumento` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_tipopersona
DROP TABLE IF EXISTS `gen_tipopersona`;
CREATE TABLE IF NOT EXISTS `gen_tipopersona` (
  `TPE_IdTipoPersona` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Identificador',
  `TPE_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre',
  `TPE_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado',
  PRIMARY KEY (`TPE_IdTipoPersona`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Tipo Persona juridica';

-- Volcando datos para la tabla movilweb.gen_tipopersona: 2 rows
DELETE FROM `gen_tipopersona`;
/*!40000 ALTER TABLE `gen_tipopersona` DISABLE KEYS */;
INSERT INTO `gen_tipopersona` (`TPE_IdTipoPersona`, `TPE_Nombre`, `TPE_Estado`) VALUES
	(1, 'NATURAL', 1),
	(2, 'JURIDICA', 1);
/*!40000 ALTER TABLE `gen_tipopersona` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.gen_usuarios
DROP TABLE IF EXISTS `gen_usuarios`;
CREATE TABLE IF NOT EXISTS `gen_usuarios` (
  `IdUsuario` int(15) NOT NULL AUTO_INCREMENT,
  `Nombre_usuario` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `Apellido1_usuario` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `Apellido2_usuario` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `IdTipoDocumento_usuario` int(1) DEFAULT NULL,
  `Identificacion_usuario` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `Direccion_usuario` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `IdCiudad_usuario` int(11) DEFAULT NULL,
  `Telefono_usuario` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `Email_usuario` varchar(255) CHARACTER SET latin1 NOT NULL,
  `IdActivo_usuario` int(1) DEFAULT NULL,
  `FechaHoraCreado_usuario` datetime DEFAULT NULL,
  `IdTipoEmpleo_usuario` int(1) DEFAULT NULL,
  `IdProfesion_usuario` int(1) DEFAULT NULL,
  `IdSectorEconomico` int(1) DEFAULT NULL,
  `IdGenero` int(1) DEFAULT NULL COMMENT 'Genero Sexual',
  `clave` blob,
  `IdInterno` double NOT NULL COMMENT 'Valor para control de sesion y otros controles',
  `IdLocal` double DEFAULT NULL COMMENT 'Para el  almacenamiento Local',
  `FechaNacimiento` date DEFAULT NULL COMMENT 'Fecha de Nacimiento',
  `Edad` int(3) DEFAULT NULL COMMENT 'Edad',
  `Habilidades` varchar(5000) DEFAULT NULL COMMENT 'Habilidades',
  `EstadoUsuario` char(1) DEFAULT NULL COMMENT 'Estado del usuario Registrado, Modificado, Inactivo',
  PRIMARY KEY (`IdUsuario`,`Email_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla movilweb.gen_usuarios: 4 rows
DELETE FROM `gen_usuarios`;
/*!40000 ALTER TABLE `gen_usuarios` DISABLE KEYS */;
INSERT INTO `gen_usuarios` (`IdUsuario`, `Nombre_usuario`, `Apellido1_usuario`, `Apellido2_usuario`, `IdTipoDocumento_usuario`, `Identificacion_usuario`, `Direccion_usuario`, `IdCiudad_usuario`, `Telefono_usuario`, `Email_usuario`, `IdActivo_usuario`, `FechaHoraCreado_usuario`, `IdTipoEmpleo_usuario`, `IdProfesion_usuario`, `IdSectorEconomico`, `IdGenero`, `clave`, `IdInterno`, `IdLocal`, `FechaNacimiento`, `Edad`, `Habilidades`, `EstadoUsuario`) VALUES
	(5, 'John', 'Obando', NULL, 1, '56566546', 'CALL 56', 1, '3187345138', 'jhaom7405@gmail.com', 1, '2015-12-16 01:11:42', NULL, 63, NULL, 2, _binary 0x313233343536, 11462328407412.701, 23559429611600.406, NULL, NULL, NULL, 'M'),
	(7, 'Katherine', 'Zuluaga', NULL, 1, '22222', 'cll', 1, '3125485938', 'kzuluaga85@gmail.com', 1, '2016-01-03 02:39:19', NULL, 63, NULL, 1, _binary 0x313233343536, 60487745479203.52, 8371973418045.764, NULL, NULL, NULL, 'M'),
	(8, 'John', 'Ruiz', NULL, 1, '111111', 'carrera', 1, '310251834', 'joruiz@gmail.com', 1, '2016-01-03 03:07:49', NULL, 63, NULL, 2, _binary 0x313233343536, 68051745247144.016, 71181581328792.11, '1997-07-05', 18, 'Experto en diseÃ±o de Modas, corte y confeccion', 'M'),
	(9, 'Mauricio', 'Sanchez', NULL, 1, '344234', 'diagonal 114', 1, '34534534', 'msanchez@gmail.com', 1, '2016-01-03 13:44:28', NULL, 56, NULL, 1, _binary 0x313233343536, 58795492871474, 30791989463187.746, '1980-10-13', 35, 'soy emprendedor', 'M');
/*!40000 ALTER TABLE `gen_usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.horario
DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `IdHorario` int(3) NOT NULL AUTO_INCREMENT,
  `Inicio` varchar(8) DEFAULT NULL,
  `Final` varchar(8) DEFAULT NULL,
  `Estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`IdHorario`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.horario: 7 rows
DELETE FROM `horario`;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` (`IdHorario`, `Inicio`, `Final`, `Estado`) VALUES
	(3, '06:30 pm', '08:00 pm', 1),
	(10, '11:30 am', '01:00 pm', 1),
	(5, '06:45 pm', '08:15 pm', 1),
	(6, '08:00 am', '09:30 am', 1),
	(8, '05:00 pm', '06:45 pm', 1),
	(9, '09:45 am', '11:15 am', 1),
	(12, '11:00', '12:00', 1);
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.jqcalendar
DROP TABLE IF EXISTS `jqcalendar`;
CREATE TABLE IF NOT EXISTS `jqcalendar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(1) CHARACTER SET utf8 NOT NULL,
  `Location` varchar(1) CHARACTER SET utf8 NOT NULL,
  `Description` varchar(1) CHARACTER SET utf8 NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `IsAllDayEvent` smallint(6) NOT NULL,
  `Color` varchar(200) CHARACTER SET utf8 NOT NULL,
  `RecurringRule` varchar(500) CHARACTER SET utf8 NOT NULL,
  `IdClase` int(11) NOT NULL COMMENT 'IdClase',
  `Sede` int(11) NOT NULL COMMENT 'Sede',
  `Salon` int(3) NOT NULL COMMENT 'Salon',
  `Materia` int(3) NOT NULL COMMENT 'Materia',
  `Nivel` int(3) NOT NULL COMMENT 'Nivel',
  `Horario` int(3) NOT NULL COMMENT 'Horario',
  `Profesor` int(11) NOT NULL COMMENT 'Profesor',
  `Estado` int(1) NOT NULL,
  `dia` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `desde` date NOT NULL COMMENT 'desde',
  `hasta` date NOT NULL,
  `FechaGraba` datetime NOT NULL,
  `IdEvento` date NOT NULL COMMENT 'Se relaciona con procesos.abr2',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla movilweb.jqcalendar: 83 rows
DELETE FROM `jqcalendar`;
/*!40000 ALTER TABLE `jqcalendar` DISABLE KEYS */;
INSERT INTO `jqcalendar` (`Id`, `Subject`, `Location`, `Description`, `StartTime`, `EndTime`, `IsAllDayEvent`, `Color`, `RecurringRule`, `IdClase`, `Sede`, `Salon`, `Materia`, `Nivel`, `Horario`, `Profesor`, `Estado`, `dia`, `desde`, `hasta`, `FechaGraba`, `IdEvento`) VALUES
	(14, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '#568CDE', '', 298, 1, 2, 28, 1, 8, 19, 1, '1', '2017-09-04', '2017-09-09', '2017-09-07 23:33:50', '2017-09-04'),
	(15, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 299, 1, 2, 27, 1, 3, 19, 1, '3', '2017-09-04', '2017-09-09', '2017-09-07 23:34:08', '2017-09-06'),
	(16, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 300, 1, 2, 14, 1, 9, 19, 1, '5', '2017-09-04', '2017-09-09', '2017-09-07 23:38:21', '2017-09-08'),
	(17, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 301, 1, 1, 14, 1, 8, 18, 1, '1', '2017-09-18', '2017-09-23', '2017-09-17 12:24:43', '2017-09-18'),
	(18, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 302, 1, 1, 12, 6, 3, 18, 1, '3', '2017-09-18', '2017-09-23', '2017-09-17 12:24:54', '2017-09-20'),
	(19, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 303, 1, 1, 22, 1, 5, 18, 1, '5', '2017-09-18', '2017-09-23', '2017-09-17 12:25:03', '2017-09-22'),
	(20, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 304, 1, 1, 8, 6, 9, 18, 1, '6', '2017-09-18', '2017-09-23', '2017-09-17 12:25:18', '2017-09-23'),
	(21, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 305, 1, 1, 3, 1, 10, 18, 1, '4', '2017-09-18', '2017-09-23', '2017-09-17 12:26:31', '2017-09-21'),
	(22, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 306, 1, 2, 23, 1, 3, 18, 1, '1', '2017-10-02', '2017-10-07', '2017-10-01 22:18:59', '2017-10-02'),
	(23, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 307, 1, 2, 24, 2, 3, 19, 1, '3', '2017-10-02', '2017-10-07', '2017-10-01 22:19:06', '2017-10-04'),
	(24, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 308, 1, 2, 27, 1, 8, 19, 1, '1', '2017-10-09', '2017-10-14', '2017-10-08 18:13:52', '2017-10-09'),
	(25, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 309, 1, 2, 2, 1, 5, 19, 1, '2', '2017-10-09', '2017-10-14', '2017-10-08 21:14:06', '2017-10-10'),
	(26, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 310, 1, 2, 1, 1, 6, 19, 1, '5', '2017-10-09', '2017-10-14', '2017-10-08 21:14:21', '2017-10-13'),
	(27, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 311, 1, 2, 27, 1, 3, 19, 1, '3', '2017-10-09', '2017-10-14', '2017-10-08 21:15:43', '2017-10-11'),
	(28, 'H', '', '', '2017-10-12 18:00:00', '2017-10-12 17:30:00', 0, '-1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '2017-10-09', '2017-10-14', '0000-00-00 00:00:00', '0000-00-00'),
	(29, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, 1, 20, 2, 6, 1, 27, 0, '', '2017-10-09', '2017-10-14', '2017-10-16 17:41:39', '0000-00-00'),
	(30, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, 1, 18, 1, 9, 1, 27, 0, '', '2017-10-09', '2017-10-14', '2017-10-16 17:44:06', '0000-00-00'),
	(31, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, 1, 1, 1, 8, 6, 16, 1, '', '2017-10-09', '2017-10-14', '2017-10-16 17:49:42', '0000-00-00'),
	(32, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, 2, 18, 1, 5, 1, 23, 1, '', '2017-10-09', '2017-10-14', '2017-10-16 17:50:42', '0000-00-00'),
	(33, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, 2, 13, 2, 5, 6, 14, 1, '', '2017-10-09', '2017-10-14', '2017-10-16 17:53:38', '0000-00-00'),
	(34, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, 1, 19, 2, 8, 6, 15, 1, '', '2017-10-09', '2017-10-14', '2017-10-16 17:55:07', '2017-10-17'),
	(35, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, 1, 18, 2, 6, 1, 1, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 18:38:08', '2017-10-18'),
	(36, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 318, 2, 20, 2, 9, 1, 27, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 18:48:38', '2017-10-19'),
	(37, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 319, 1, 2, 16, 6, 9, 1, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 18:55:07', '2017-10-18'),
	(38, '', '', '', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(39, '', '', '', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(40, '', '', '', '2017-10-20 11:30:00', '2017-10-20 01:00:00', 0, '', '', 329, 1, 2, 27, 1, 10, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 22:44:22', '2017-10-20'),
	(41, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 330, 1, 1, 2, 1, 6, 20, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 22:46:09', '2017-10-26'),
	(42, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 331, 2, 1, 23, 1, 8, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 22:47:29', '2017-10-24'),
	(43, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 332, 1, 2, 16, 6, 5, 18, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 22:48:22', '2017-10-24'),
	(44, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 333, 2, 2, 23, 1, 9, 1, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 22:49:13', '2017-10-24'),
	(45, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 334, 1, 2, 14, 6, 8, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 22:51:59', '2017-10-25'),
	(46, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 335, 1, 2, 2, 1, 5, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 22:53:00', '2017-10-19'),
	(47, '', '', '', '2017-10-17 10:00:00', '2017-10-17 11:30:00', 0, '', '', 336, 1, 2, 2, 1, 5, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 22:56:10', '2017-10-17'),
	(48, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 337, 1, 2, 14, 6, 8, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 22:59:33', '2017-10-12'),
	(49, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 338, 1, 2, 14, 6, 5, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 23:00:30', '2017-10-14'),
	(50, 'z', '', '', '2017-10-17 06:30:00', '2017-10-17 08:00:00', 0, '', '', 341, 1, 2, 14, 6, 3, 16, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 23:09:25', '2017-10-17'),
	(51, 'x', '', '', '2017-10-17 07:30:00', '2017-10-17 08:30:00', 0, '', '', 342, 1, 2, 1, 1, 6, 18, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 23:10:18', '2017-10-17'),
	(52, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 343, 1, 2, 15, 6, 5, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-16 23:31:25', '2017-10-12'),
	(54, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 349, 1, 2, 2, 1, 8, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-17 00:29:40', '2017-10-27'),
	(55, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 350, 1, 1, 2, 1, 3, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-17 00:32:28', '2017-10-28'),
	(56, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 351, 2, 1, 16, 6, 9, 19, 1, '', '2017-10-01', '2017-10-31', '2017-10-17 00:34:24', '2017-10-05'),
	(57, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 352, 2, 2, 23, 1, 9, 18, 1, '', '2017-10-01', '2017-10-31', '2017-10-17 00:34:50', '2017-10-06'),
	(58, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 353, 2, 1, 16, 6, 9, 19, 1, '', '1970-01-01', '1970-01-31', '2017-10-17 00:35:06', '1970-01-01'),
	(59, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 354, 2, 2, 16, 6, 9, 19, 1, '', '1970-01-01', '1970-01-31', '2017-10-17 00:35:13', '1970-01-01'),
	(60, 'u', '', '', '2017-10-06 00:00:00', '2017-10-06 00:00:00', 1, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(61, 'f', '', '', '2017-10-07 00:00:00', '2017-10-07 00:00:00', 1, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(97, '', '', '', '2017-10-19 06:45:00', '2017-10-19 08:15:00', 0, '', '', 377, 1, 2, 14, 6, 5, 19, 1, '0', '2017-10-19', '2017-10-19', '2017-10-25 03:32:19', '2017-10-19'),
	(62, 'c', '', '', '2017-10-07 05:30:00', '2017-10-07 07:00:00', 0, '-1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(63, '1', '6', '1', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(64, '1', '6', '1', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(65, '1', '6', '1', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(66, '1', '6', '2', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(67, '1', '6', '2', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(68, '2', '5', '2', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(69, '1', '5', '2', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(70, '1', '6', '2', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(71, '2', '6', '2', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(72, '1', '6', '2', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(73, '1', '6', '2', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '1', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(74, '1', '3', '2', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 19, '6', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00'),
	(75, '', '', '', '1970-01-01 01:00:00', '1970-01-01 01:00:00', 0, '', '', 355, 1, 2, 23, 1, 5, 19, 1, '0', '1970-01-01', '1970-01-01', '2017-10-24 01:24:46', '1970-01-01'),
	(98, '', '', '', '2017-10-13 08:00:00', '2017-10-13 09:30:00', 0, '', '', 378, 1, 2, 16, 6, 6, 19, 1, '0', '2017-10-13', '2017-10-13', '2017-10-25 04:37:20', '2017-10-13'),
	(77, '', '', '', '2017-10-25 08:00:00', '2017-10-25 09:30:00', 0, '', '', 357, 1, 2, 16, 6, 6, 19, 1, '0', '2017-10-25', '2017-10-25', '2017-10-24 01:45:27', '2017-10-25'),
	(78, '', '', '', '2017-10-25 05:00:00', '2017-10-25 06:45:00', 0, '', '', 358, 1, 2, 2, 1, 8, 19, 1, '0', '2017-10-25', '2017-10-25', '2017-10-24 06:01:57', '2017-10-25'),
	(79, '', '', '', '2017-10-25 11:00:00', '2017-10-25 11:30:00', 0, '', '', 359, 2, 1, 15, 6, 10, 18, 1, '0', '2017-10-25', '2017-10-25', '2017-10-24 06:44:44', '2017-10-25'),
	(80, '', '', '', '2017-10-26 06:45:00', '2017-10-26 08:15:00', 0, '', '', 360, 1, 1, 1, 1, 5, 20, 1, '0', '2017-10-26', '2017-10-26', '2017-10-24 06:48:30', '2017-10-26'),
	(81, '', '', '', '2017-10-26 08:00:00', '2017-10-26 09:30:00', 0, '', '', 361, 2, 2, 23, 1, 6, 1, 1, '0', '2017-10-26', '2017-10-26', '2017-10-24 06:50:15', '2017-10-26'),
	(82, '', '', '', '2017-10-26 09:45:00', '2017-10-26 11:15:00', 0, '', '', 362, 2, 2, 27, 1, 9, 1, 1, '0', '2017-10-26', '2017-10-26', '2017-10-24 06:53:42', '2017-10-26'),
	(83, '', '', '', '2017-10-27 06:45:00', '2017-10-27 08:15:00', 0, '', '', 363, 1, 2, 2, 1, 5, 19, 1, '0', '2017-10-27', '2017-10-27', '2017-10-24 06:55:36', '2017-10-27'),
	(84, '', '', '', '2017-10-27 11:30:00', '2017-10-27 01:00:00', 0, '', '', 364, 2, 2, 15, 6, 10, 20, 1, '0', '2017-10-27', '2017-10-27', '2017-10-24 06:55:55', '2017-10-27'),
	(85, '', '', '', '2017-10-27 05:00:00', '2017-10-27 06:45:00', 0, '', '', 365, 2, 1, 2, 1, 8, 18, 1, '0', '2017-10-27', '2017-10-27', '2017-10-24 06:56:58', '2017-10-27'),
	(86, '', '', '', '2017-10-24 08:00:00', '2017-10-24 09:30:00', 0, '', '', 366, 1, 2, 2, 1, 6, 20, 1, '0', '2017-10-24', '2017-10-24', '2017-10-24 06:57:58', '2017-10-24'),
	(87, '', '', '', '2017-10-24 06:45:00', '2017-10-24 08:15:00', 0, '', '', 367, 1, 1, 23, 1, 5, 20, 1, '0', '2017-10-24', '2017-10-24', '2017-10-24 07:10:32', '2017-10-24'),
	(88, '', '', '', '2017-10-24 08:00:00', '2017-10-24 09:30:00', 0, '', '', 368, 1, 2, 14, 6, 6, 19, 1, '0', '2017-10-24', '2017-10-24', '2017-10-24 07:23:49', '2017-10-24'),
	(89, '', '', '', '2017-10-28 06:45:00', '2017-10-28 08:15:00', 0, '', '', 369, 1, 2, 23, 1, 5, 19, 1, '0', '2017-10-28', '2017-10-28', '2017-10-24 22:41:36', '2017-10-28'),
	(90, '', '', '', '2017-10-28 09:45:00', '2017-10-28 11:15:00', 0, '', '', 370, 1, 1, 1, 1, 9, 18, 1, '0', '2017-10-28', '2017-10-28', '2017-10-24 22:56:55', '2017-10-28'),
	(91, '', '', '', '2017-10-28 06:45:00', '2017-10-28 08:15:00', 0, '', '', 371, 1, 2, 15, 6, 5, 1, 1, '0', '2017-10-28', '2017-10-28', '2017-10-24 23:09:22', '2017-10-28'),
	(92, '', '', '', '2017-10-28 09:45:00', '2017-10-28 11:15:00', 0, '', '', 372, 2, 2, 1, 1, 9, 19, 1, '0', '2017-10-28', '2017-10-28', '2017-10-24 23:19:26', '2017-10-28'),
	(93, '', '', '', '2017-10-27 09:45:00', '2017-10-27 11:15:00', 0, '', '', 373, 1, 2, 27, 1, 9, 1, 1, '0', '2017-10-27', '2017-10-27', '2017-10-24 23:49:15', '2017-10-27'),
	(94, '', '', '', '2017-10-26 08:00:00', '2017-10-26 09:30:00', 0, '', '', 374, 2, 2, 14, 6, 6, 18, 1, '0', '2017-10-26', '2017-10-26', '2017-10-24 23:57:23', '2017-10-26'),
	(95, '', '', '', '2017-10-31 08:00:00', '2017-10-31 09:30:00', 0, '', '', 375, 2, 2, 15, 6, 6, 1, 1, '0', '2017-10-31', '2017-10-31', '2017-10-25 00:12:54', '2017-10-31'),
	(96, '', '', '', '2017-10-31 09:45:00', '2017-10-31 11:15:00', 0, '', '', 376, 1, 1, 16, 6, 9, 19, 1, '0', '2017-10-31', '2017-10-31', '2017-10-25 00:24:56', '2017-10-31');
/*!40000 ALTER TABLE `jqcalendar` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.listachqxtipoaudit
DROP TABLE IF EXISTS `listachqxtipoaudit`;
CREATE TABLE IF NOT EXISTS `listachqxtipoaudit` (
  `id_listacheq` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_lc` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tipo_auditoria` int(11) NOT NULL,
  `id_auditoria` int(11) NOT NULL,
  `objetivo` varchar(1500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alcances` varchar(4000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `procedimientos` varchar(4000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `criterios` varchar(4000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `metodos` varchar(4000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `muestreo` varchar(4000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `proceso` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre del proceso (aplica solo a cronogramas)',
  `idproceso` int(11) NOT NULL COMMENT 'id del proceso',
  `annio` int(4) DEFAULT NULL COMMENT 'Año',
  PRIMARY KEY (`id_listacheq`,`tipo_auditoria`,`id_auditoria`,`proceso`)
) ENGINE=MyISAM AUTO_INCREMENT=207 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.listachqxtipoaudit: 175 rows
DELETE FROM `listachqxtipoaudit`;
/*!40000 ALTER TABLE `listachqxtipoaudit` DISABLE KEYS */;
INSERT INTO `listachqxtipoaudit` (`id_listacheq`, `nombre_lc`, `tipo_auditoria`, `id_auditoria`, `objetivo`, `alcances`, `procedimientos`, `criterios`, `metodos`, `muestreo`, `proceso`, `idproceso`, `annio`) VALUES
	(1, 'Auditorias ISO 9001 - 2012', 1, 40, '', '', '', '', '', '', '', 0, NULL),
	(4, 'test 20121020', 1, 40, '', '', '', '', '', '', '', 0, NULL),
	(3, 'Auditoria de Control-RACOL 2012', 2, 57, '', '', '', '', '', '', '', 0, 2013),
	(5, 'Racol', 146, 61, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procedimientos de: Mensajería y Carga: Operaciones, Transporte y Logística Inversa. Mensajería expresa Masiva. Clientes corporativos. Canales de Venta. Seguridad de la Información. Jurídica. Administrativa. Financiera. Gestión Humana. Riesgos. Control Interno. Planeación directiva.', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(6, 'Agencias Anulada', 0, 0, '', '', '', '', '', '', '', 0, NULL),
	(7, 'Coordinacion', 146, 61, '', '', '', '', '', '', '', 0, 2013),
	(9, 'Canales de Venta - Publicidad', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(10, 'Canales de Venta - Vinculacion PAS', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(11, 'Canales de Venta - Vinculacion Desvinculacion Agencias', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(12, 'Clientes Corporativos - Clientes Corporativos', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(13, 'Clientes Corporativos - Fabrica de Creditos', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(14, 'Clientes Corporativos - Lider', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(15, 'Clientes Corporativos - Servicio al Cliente', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(16, 'Juridica - Defensoria Canales de Venta', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(17, 'Juridica - Defensoria de Clientes', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(18, 'Juridica - Lider', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(143, 'Agencias Anulada', 0, 0, '', '', '', '', '', '', '', 0, NULL),
	(20, 'Canales de Venta - Publicidad 146 62 20 anulada', 0, 0, '', '', '', '', '', '', '', 0, NULL),
	(21, 'Clientes Corporativos-Lider', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(22, 'Clientes Corporativos-Servicio Al Cliente', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(23, 'Clientes Corporativos Fabrica De Credito', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(24, 'Planeación Directiva-Capacitacion', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(25, 'Planeación Directiva-Sige', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(26, 'Clientes Corporativos Clientes Corporativos', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(27, 'Canales De Venta Vinculacion Pas 146 62 27 Anulada', 0, 0, '', '', '', '', '', '', '', 0, NULL),
	(28, 'Canales De Venta Vinculacion Desvinculacion Agencias', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(29, 'Tecnología-Conectividad Y Redes', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(30, 'Tecnología-Desarrollo', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(31, 'Tecnología-Sistemas De Informacion', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(32, 'Gestión Humana-Contratación', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(33, 'Gestión Humana-Procesos Disciplinarios', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(34, 'Gestión Humana-Salud Ocupacional', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(35, 'Gestión Humana-Selección', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(36, 'RESPONSABILIDADES CREACION USUARIOS Y TERCEROS SISTEMAS DE INFORMACION', 147, 64, '', '', '', '', '', '', '', 0, 2013),
	(37, 'Gestion Humana-Contratistas', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(38, 'CONTROL DE CARGOS DE NOMINA', 147, 64, '', '', '', '', '', '', '', 0, 2013),
	(39, 'Mensajeria Masiva', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(40, 'Tecnología-Soporte', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(41, 'Mensajeria y Carga Transportes', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(42, 'Masivos', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(19, 'Agencias', 146, 63, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(44, 'Tramites e Inter Viajes', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(45, 'Mensajeria  y Carga Direccion', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(46, 'Administrativa Compras y Suministros', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(47, 'Mensajeria y Carga Operaciones', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(48, 'Administrativa Gestion Documental', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(49, 'Administrativa Direccion', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(50, 'Control Cuentas', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(51, 'Financiera-Cartera', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(52, 'Gestión Humana-Nómina', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(53, 'Financiera-Giros', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(54, 'MENSAJERIA Y CARGA -LOGISTICA INVERSA', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(55, 'Financiera-Facturacion', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(56, 'Financiera-Impuestos', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(57, 'Riesgos-Seguridad Física', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(58, 'Planeacion Directiva - Sige', 146, 62, 'erificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(59, 'Financiera-Costos y Presupuesto', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(60, 'Planeacion Directiva - Capacitacion Otra', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(61, 'Control Interno - Direccion', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(63, 'Gestion Riesgos-Direccion', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procedimientos de: Mensajería y Carga: Operaciones, Transporte y Logística Inversa. Mensajería expresa Masiva. Clientes corporativos. Canales de Venta. Seguridad de la Información. Jurídica. Administrativa. Financiera. Gestión Humana. Riesgos. Control Interno. Planeación directiva.', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(64, 'Gestion Riesgos-Supervision', 146, 68, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procedimientos de: Mensajería y Carga: Operaciones, Transporte y Logística Inversa. Mensajería expresa Masiva. Clientes corporativos. Canales de Venta. Seguridad de la Información. Jurídica. Administrativa. Financiera. Gestión Humana. Riesgos. Control Interno. Planeación directiva.', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(65, 'Gestion Riesgos-Supervision', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'TC ISO 9001:2008\r\nNormatividad y documentación asociada a los procedimientos de: Mensajería y Carga: Operaciones, Transporte y Logística Inversa. Mensajería expresa Masiva. Clientes corporativos. Canales de Venta. Seguridad de la Información. Jurídica. Administrativa. Financiera. Gestión Humana. Riesgos. Control Interno. Planeación directiva.', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(66, 'Financiera-Direccion', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(67, 'Financiera-Contabilidad', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(68, 'Indicadores 2013 Revisión corte 30 de Junio', 149, 68, 'x', 'x', 'x', 'x', 'x', 'x', '', 0, 2013),
	(69, 'Encuestas de cliente natural a 30 de junio de 2013', 148, 65, 'Identificar las no conformidades que afectan la satisfacción del cliente natural.', 'Todos los clientes naturales de Inter Rapidísimo.', 'GEJ, GEC.', 'Requisitos de los clientes.', 'Encuestas escritas.', '% de clientes naturales.', '', 0, 2013),
	(71, 'Encuestas clientes corporativos a 30 de junio de 2013', 148, 67, 'Identificar las no conformidades que afectan la satisfacción del cliente.', 'Todos los clientes corporativos de INTER RAPIDÍSIMO', 'GEJ - GEC', 'preguntas de la encuesta de clientes corporativos', 'Encuestas escritas', '% de clientes corporativas', '', 0, 2013),
	(72, 'Encuestas canales de venta a 30 de junio de 2013', 148, 66, 'Identificar las no conformidades que no permiten la satisfacción del clientes', 'Todos los canales de venta', 'CVT - GEJ', 'Preguntas satisfacción canales de venta', 'Encuestas escritas', '% de canales de venta', '', 0, 2013),
	(73, 'PQR - NC 2013', 151, 69, 'Establecer acciones de mejora que permitan eliminar la causa raíz de las No Conformidades detectadas en las PQRs.', 'Todos los procesos y RACOL de Inter Rapidísimo.', 'Analisis de PQRs.', 'Incumplimiento requisitos de los clientens.', 'Analisis de PQRs.', 'Aleatorio', '', 0, NULL),
	(74, 'DOFA ENERO A JUNIO 2013', 152, 70, 'Identificar las fortalezas, oportunidades, debilidades y amenazas de los procesos con el fin de implementar las acciones de mejora correspondientes.', 'Todos los procesos de INTER RAPIDÍSIMO.', 'Todos los procedimientos de INTER RAPIDÍSIMO.', 'Todos los procedimientos de INTER RAPIDÍSIMO.', 'Elaboración de la matriz DOFA por proceso con base en la información de indicadores, pqrs, información de otros procesos, lluvia de ideas dentro del proceso, auditorías, encuestas de satisfacción.', '100% de procesos de INTER RAPIDÍSIMO', '', 0, 2013),
	(75, 'NC revisione por la gerencia 2013 agosto 2013 ', 153, 71, 'Identificar las NC de los procesos según análisis de la gerencia.', 'Todos los procesos de Inter Rapidísimo.', 'Todos los procesos de Inter Rapidísimo.', 'Todos los procesos de Inter Rapidísimo.', 'Analisis\r\nRevisión documental', 'Información solicita por la gerencia general de forma aleatoria', '', 0, NULL),
	(78, 'NC IDENTIFICADAS EN LAS REVISIONES DE LA GERENCIA GENERAL', 146, 62, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(77, 'Planeacion Directiva - Gerencia', 146, 62, 'Inter Rapidí­simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. \r\n', 'ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz, así como las actividades y controles documentados en la organización.\r\n', 'GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNormatividad y documentación asociada a los procesos  GLI-GTR-GOP-LIN-MAS-GEC-GEF-GEA-GEH-GEJ-GER-GCI-GSI-PLD\r\n', 'Observación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.\r\nEncuestas proveedores.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2013),
	(79, 'Encuesta de satisfaccion canales de venta  corte agosto de 2013', 148, 66, 'x', 'x', 'x', 'x', 'x', 'x', '', 0, 2013),
	(80, 'Encuestas de satisfacción clientes crédito  corte agosto de 2013', 148, 67, 'x', 'x', 'x', 'x', 'x', 'x', '', 0, 2013),
	(81, 'Comités 2013', 2, 72, 'Realizar seguimiento al cumplimiento de cada uno de los aspectos de los comités establecidos en INTER RAPIDÍSIMO.', 'Todos los comités de INTER RAPIDÍSIMO.', 'Revisión de las actas y presencia en los comités.', 'Reglamentos de los comités e instrucciones emitidas por la gerencia general.', 'Observación, Inspección, Revisión documental', '100% de las sesiones de los comités', '', 0, 2013),
	(82, 'Indicadores Agosto de 2013', 149, 68, 'Establecer los planes de mejoramiento con base en los incumplimientos generados en las metas establecidas para los indicadores de gestión y estratégicos correspondientes al mes de Agosto de 2013.', 'Aplica para todos los procesos de Inter Rapisímo S.A.', 'Todos los procedimientos de los procesos de Inter Rapidísimo S.A. ', 'Incumplimiento en las metas establecidas en los indicadores de gestión.', ' ', ' ', '', 0, 2013),
	(83, 'Indicadores Septiembre de 2013 ', 149, 68, 'Establecer los planes de mejoramiento con base en los incumplimientos generados de las metas establecidas para los indicadores de gestión y estratégicos correspondientes al mes de Septiembre de 2013.', 'Todos lso procesos de la Organización.', 'Todos los procedimientos de la Organización.', '8.2.3. Seguimiento y medición de los procesos.', ' ', ' ', '', 0, 2013),
	(84, 'INSPECCIÓN DE CONTROL ENVÍOS RECLAME OFICINA BOGOTÁ ', 2, 64, 'Verificar el cumplimiento de las órdenes dadas desde la Subgerencia General, respecto a la gestión de telemercadeo de la totalidad de los envíos que se encuentran en reclame oficina del punto principal de la carrera 30 con corte 30 de Diciembre de 2013.', 'Aplica para la totalidad de los envíos asignados a reclame oficina del punto de la carrera 30 con corte 30 de Diciembre de 2013.', 'Todos los relacionados a la gestión de telemercadeo de los envíos asignados a reclame oficina. ', 'Directrices dadas desde la Subgerencia General, dónde se requiere asegurar que la totalidad de los envíos que se encuentran en reclame oficina del punto de la carrera 30 tengan la gestión de telemercadeo. ', 'Inspección \r\nRevisión documental\r\n ', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las misma. ', '', 0, 2013),
	(91, 'ASPECTOS CRÍTICOS DE LOS PROCESOS', 147, 64, 'Evidenciar los aspectos críticos y actividades de impacto de los procesos de la organización.', 'Todos los procesos de la compañía.', 'Todos los procedimientos de la compañía.', 'Normatividad y documentación asociada a los procesos.', 'Muestreo\r\nRevisión de indicadores.\r\nObservación del trabajo realizado.\r\nRevisión documental por parte del auditado.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico. ', '', 0, 2013),
	(101, 'Agencias', 157, 78, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(94, 'Gestión de Compras', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(88, 'Cronogramas 2014', 154, 73, 'Realizar auto-control de las actividades programadas según la planeación establecida para la vigencia 2014.', '.', '.', '.', '.', '.', 'CRONO', 1, NULL),
	(89, 'Capacitaciones 2014', 154, 73, 'Documentar las necesidades de capacitación  de INTER RAPIDÍSIMO para la vigencia 2014, de las cuales su ejecución y evaluación garantizará que los procesos se desarrollen de forma adecuada por todos los colaboradores de la organización.', '.', '.', '.', '1. Planeación de la capacitación.\n2. Preparación de los medios.\n3. Desarrollo de la capacitación.\n4. Evaluación de la capacitación.\n5. Retroalimentación de resultados.\n6. Implementación de planes de mejoramiento.\n', '1. INTERESANTÍSIMO: Se incluye artículo del tema de capacitación en la publicación y se evalúa a través del formato adjunto a la misma.\n\n2. VIDEO - CORTOMETRAJE: Se realiza un video o cortometraje del tema de capacitación el cual se debe proyectar en reuniones, comités o en las pantallas ubicadas en la organización, la evaluación la debe realizar el colaborador a través de la herramienta de capacitación y/o evaluación o por medio físico.\n\n3. CARTELERAS: Se realiza cartelera del tema de capacitación y se ubica en cada sede y piso de INTER RAPIDÍSIMO, la evaluación la debe realizar el colaborador a través de la herramienta de capacitación y/o evaluación o por medio físico.\n\n4. FOLLETO: Se realiza un folleto del tema de capacitación y se entrega a cada colaborador según sea el alcance de la misma, la evaluación la debe realizar el colaborador a través de la herramienta de capacitación y/o evaluación o por medio físico.\n\n5. PAUTAS AUDIO E INFORMACIÓN POR CORREO: Se realizan pautas de audio que se trasmiten por medio de parlantes o de correo y se envía información por correo del tema de capacitación, la evaluación la debe realizar el colaborador a través de la herramienta de capacitación y/o evaluación o por medio físico.\n\n6. PRESENCIAL: Se realiza la capacitación presencial de tema que corresponda, la evaluación la debe realizar el colaborador a través de la herramienta de capacitación y/o evaluación o por medio físico.\n', 'CAPAC', 2, NULL),
	(90, 'Comites 2014', 154, 73, 'Documentar las sesiones de los comités de INTER RAPIDÍSIMO para la vigencia 2014, de las cuales su ejecución garantizará que los procesos se desarrollen de forma adecuada.', '.', '.', '.', '.', '.', 'COMIT', 3, NULL),
	(97, 'Gestión Documental', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(98, 'Gestión de Suministros', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(100, 'Racol', 157, 77, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(102, 'Dirección Tecnología', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(103, 'Gestión de Trámites', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(104, 'Dirección Mensajería y Carga', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(105, 'Gestión de Operaciones', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(106, 'Gestión de Selección', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(107, 'Dirección Gestión Humana', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(108, 'Gestión de Soporte', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(109, 'Gestión de Mantenimiento Vehicular', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(110, 'Subdirección de Transporte', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(115, 'Gestión de Infraestructura', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(112, 'Subdirección de Seguridad de la Información', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(113, 'Gestión Salud Ocupacional', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(114, 'Subdirección de Tecnología', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(116, 'Subdirección de Logística Inversa', 157, 76, 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(117, 'Gestión Logística Inversa', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(118, 'Gestión de Redes y Conectividad', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(119, 'Gestión de Nomina', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(120, 'Gestión Administración de Sistemas de Información', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(121, 'Gestión Procesos Disciplinarios', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(122, 'Gestión Proyectos Logísticos', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(123, 'Gestión de BI', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(124, 'Dirección Mensajería Masiva', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(125, 'Gestión de Audiovisuales', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(126, 'Gestión Mensajería Masiva', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(127, 'Racol Bogotá', 157, 77, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(128, 'Gestión de Desarrollo', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(129, 'Gestión de Riesgos', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(130, 'Subgerencia', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(131, 'Gestión de Capacitación', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(132, 'Gestión de Pagos', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(133, 'Gestión de Contratación ', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(134, 'Gestión Seguridad Físico', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(137, 'Dirección Gestión Administrativa', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(136, 'Servicios Generales', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(138, 'Gestión de Publicidad y Mercadeo', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(139, 'Gestión Defensoría de Clientes', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(140, 'Gestión Defensoría Canales de Venta', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(141, 'Gestión Servicio al Cliente', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(142, 'Dirección Servicio al Cliente', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(144, 'DOFA 2014', 152, 70, 'Plantear acciones planes de mejoramiento que evidencien acciones preventivas y correctivas del proceso de control interno.', 'Proceso GCI', 'Gestión de control interno GCI-GCI-P01 y Auditoria Integral GCI-GCI-P-04', 'Ciumplimiento de los procedimientos Gestión de control interno GCI-GCI-P01 y Auditoria Integral GCI-GCI-P-04 y todos los demás procedimientos de la organización.', 'Autoevaluación.', 'Actividades de control interno.', '', 0, 2014),
	(149, 'Inspección procedimiento de despacho de suministros a agencias ', 152, 70, 'Verificar el cumplimiento de los controles establecidos de las actividades contenidas en el procedimiento de suministros ', 'Verificar el cumplimiento de los controles establecidos de las actividades contenidas en el procedimiento de suministros de la RACOL Florencia agencias de San Vicente del Caguan, Puerto Rico y Paujil.', 'GEA-SUM-P-01', 'GEA-SUM-P-01', 'Inspección, Verificación, análisis, interrogación y confirmación', 'Trazabilidad de las guías donde se despacharon los suministros a la RACOL Florencia agencias de San Vicente del Caguan, Puerto Rico y Paujil, Verificación de los suministros despachados entrega de los mismos y reporte de las guías utilizadas en el periodo posterior al despacho de los suministros.', '', 0, NULL),
	(146, 'Dirección Control Interno', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(147, 'Inspección log inversa 30 mayo 2014', 152, 70, 'Realizar verificación de los controles establecidos en las actividades desarrolladas en logística inversa.', 'Digitalización y archivo de pruebas de entrega Bogotá', 'GLI-LIN-P-01', 'GLI-GLI-P-01', 'Inspección, verificación, análisis, interrogación, confirmación.', 'Generación de reporte y verificación aleatoria de digitalización y archivo de pruebas de entrega.', '', 0, NULL),
	(150, 'Gestión de Impuestos', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(151, 'Dirección Financiera', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(152, 'Gestión Jurídica', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(153, 'Gestión de Cartera', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(154, 'Inspección proceso, recibido de tulas administrativas de las RACOL', 152, 70, 'Verificar el procedimiento de la recepción y revisión de las tulas administrativas en el departamento de contabilidad. ', 'Verificar el procedimiento de la recepción y revisión de las tulas administrativas en el departamento de contabilidad del día 3 de Junio del 2013', 'GEF-CCT-P-01', 'GCB-CON-P-01', 'Observación, indagación, análisis.', 'Procedimiento de recepción de las tulas administrativas del día 31-Mayo- 2014 y 03-junio-2014.', '', 0, NULL),
	(155, 'DOFA 2014 - GESTIÓN PLANEACIÓN DIRECTIVA', 152, 70, 'Planear acciones de mejoramiento que evidencien acciones preventivas y correctivas   correspondientes al proceso de planeación directiva.', 'Proceso GPL.', 'Procedimientos correspondientes al procedimientos de Capacitación, SIGE, Mercadeo y Publicidad.', 'Cumplimiento de los procedimientos correspondientes a Capacitación, SIGE, Mercadeo y Publicidad y todos los procesos de la organización.', 'Autoevaluación.', 'Actividades de planeación directivas (SIGE).', '', 0, 2014),
	(156, 'Dirección Clientes Corporativos', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(157, 'Gestión Créditos Corporativos', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(158, 'Gestión Canales de Venta', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(159, 'Gestión Facturación', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(160, 'Gestión de Contabilidad', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(161, 'Gestión de vinculación ', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(165, 'SIGE', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(164, 'Inspección de los ementos de recogida de los auxiliares de zona', 147, 79, 'Verificar los elementos que deben tener los auxiliares de zona para poder realizar las recogidas.', 'Verificación física de los elementos de recogida (metro, báscula, guías,  calculadora, planillas de recogida) de los auxiliares de Zona.', 'GEO-REC-P-01', 'GEO-REC-P-01', 'Observación, indagación y análisis', 'Se tomo como muestra 17 auxiliares de zona aleatoriamente', '', 0, 2014),
	(166, 'Inspección vehiculos de zona urbana ', 147, 79, 'Verificar el procedimiento para realizar la inspección física de los vehículos de la zona urbana.', 'Verificar el procedimiento para realizar la inspección física de los vehículos y revisar aleatoriamente 6 vehículos con la lista de chequeo GTR-TRA-R-12', 'GTR-MVH-I-01', 'GTR-MVH-I-01', 'OBSERVACIÓN, INDAGACIÓN, ANÁLISIS.', 'Procedimiento de la inspección de vehículos y toma aleatoria de 6 vehículos para realizar la inspección física con el formato GTR-TRA-R-12', '', 0, 2014),
	(167, 'Inspección procedimiento custodia', 147, 79, 'Verificar que se esté cumpliendo con el procedimiento de custodia.', 'Realizar el seguimiento del procedimiento de custodia para verificar que se este cumpliendo correctamente.', 'GLI-CUS-P-01', 'GLI-CUS-P-01', 'Indagación, Observación, Revisión.', 'Seguimiento del proceso de custodia correspondiente a la fecha 01-07-2014.', '', 0, 2014),
	(171, 'GESTIÓN CONTROL DE CUENTAS', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapid�simo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gesti�n Empresarial (SIGE) y as� mismo se refleje en la prestaci�n de los servicios de mensajer�a, giros y carga con oportunidad y seguridad a nivel nacional', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (3) y casa matriz; así como las actividades y controles', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI.\r\n', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo\r\n', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(172, 'Gerencia General', 157, 76, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. 																													', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (7) y casa matriz; así como las actividades y controles documentados en la organización.																													', 'GCI-GCI-P-04 PROCEDIMIENTO AUDITORÍA INTEGRAL																													', '"NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GMP, GCV, GSC, GMC, GOP, GTR, GLI, GMA, GEA, GEJ, GEH, GCO, GCB, GCA, GEF, GCP, GTI, GDE, GSI, GIT, GIN, GCR, GER, GCI."																													', '"Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas."																													', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.																													', '', 0, 2014),
	(176, 'Acciones correctivas ', 154, 81, 'Evidenciar acciones correctivas ', 'N/A', 'N/A', 'N/A', 'N/A', 'Necesidades y no conformidades evidenciadas.', '', 0, 2014),
	(175, 'Gestion Canales de Venta', 158, 81, '-Verificar la completitud de los documentos requeridos para la apertura de los canales de venta así como su contenido.\r\n-Verificar los tiempos de envió de los documentos requeridos para la apertura de los canales de venta.\r\n', 'Verificación del cumplimiento de los requisitos documentales expuestos en los procedimientos Gestión Vinculación P.A.S y Gestión Vinculación Desvinculación Agencias de los últimos 4 meses', 'Procedimiento Gestión Vinculación P.A.S y Procedimiento Gestión Vinculación Desvinculación Agencias.', 'Procedimiento Gestión Vinculación P.A.S y Procedimiento Gestión Vinculación Desvinculación Agencias.', 'Documental aleatoria.', '\r\nCombinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.\r\n', '', 0, 2014),
	(182, 'Auditoria Especial Defensoria del cliente', 158, 81, '•	Verificar el cumplimiento tanto de las actividades como de los controles  establecidos en los procedimientos de servicio al cliente, Defensoría de Clientes.   \r\n•	Verificar el cumplimiento de los tiempos internos para la respuesta de los PQRS.	\r\n•	Verificar correcto el uso de las herramientas de SAC, Canales de Venta, PQR Y PQRS.\r\n•	Verificar el tratamiento de los comentarios en las redes sociales.\r\n•	Verificar el avance sobre la recolección de las encuestas de satisfacción (Cliente peatón, Cliente Corporativo y Canales de Venta).\r\n•	Verificar conocimiento e idoneidad de los perfiles pertenecientes a la dirección.\r\n', 'Verificar el cumplimiento de los procedimientos de Servicio al Cliente, Defensoría del cliente y Defensoría Canales de Venta y el uso de las herramientas tecnológicas asignadas al proceso de Servicio al Cliente.', 'Procedimientos Servicio al Cliente, Gestión defensoría del Cliente y Gestión defensoría de canales de venta. ', 'Procedimientos Servicio al Cliente, Gestión defensoría del Cliente y Gestión defensoría de canales de venta. ', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(183, 'Auditoria Especial Defensoria de Canales de Venta.', 158, 81, '•	Verificar el cumplimiento tanto de las actividades como de los controles  establecidos en los procedimientos de servicio al cliente, Defensoría de Clientes.   \r\n•	Verificar el cumplimiento de los tiempos internos para la respuesta de los PQRS.	\r\n•	Verificar correcto el uso de las herramientas de SAC, Canales de Venta, PQR Y PQRS.\r\n•	Verificar el tratamiento de los comentarios en las redes sociales.\r\n•	Verificar el avance sobre la recolección de las encuestas de satisfacción (Cliente peatón, Cliente Corporativo y Canales de Venta).\r\n•	Verificar conocimiento e idoneidad de los perfiles pertenecientes a la dirección.\r\n', 'Verificar el cumplimiento de los procedimientos de Servicio al Cliente, Defensoría del cliente y Defensoría Canales de Venta y el uso de las herramientas tecnológicas asignadas al proceso de Servicio al Cliente.', 'Procedimientos Servicio al Cliente, Gestión defensoría del Cliente y Gestión defensoría de canales de venta. ', 'Normas aplicadas al procedimiento de Defensoria de Canales de Venta.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(181, 'Auditoria Especial Coordinación de Servicio al Cliente ', 158, 81, '•	Verificar el cumplimiento tanto de las actividades como de los controles  establecidos en los procedimientos de servicio al cliente, Defensoría de Clientes.   \r\n•	Verificar el cumplimiento de los tiempos internos para la respuesta de los PQRS.	\r\n•	Verificar correcto el uso de las herramientas de SAC, Canales de Venta, PQR Y PQRS.\r\n•	Verificar el tratamiento de los comentarios en las redes sociales.\r\n•	Verificar el avance sobre la recolección de las encuestas de satisfacción (Cliente peatón, Cliente Corporativo y Canales de Venta).\r\n•	Verificar conocimiento e idoneidad de los perfiles pertenecientes a la dirección.\r\n', 'Verificar el cumplimiento de los procedimientos de Servicio al Cliente, Defensoría del cliente y Defensoría Canales de Venta y el uso de las herramientas tecnológicas asignadas al proceso de Servicio al Cliente.', 'Procedimientos Servicio al Cliente, Gestión defensoría del Cliente y Gestión defensoría de canales de venta. ', 'Procedimientos Servicio al Cliente, Gestión Defensoría del Cliente y Gestión Defensoría de Canales de Venta.', 'Aplicación de lista de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo\r\nEntrevista a empleados.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2014),
	(185, 'Racol', 159, 82, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional. ', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y 15 gestiones en casa matriz; así como las actividades y controles documentados en la organización.', 'GPL-SIG-P-05 PROCEDIMIENTO AUDITORÍA INTEGRAL', 'NTC ISO 9001:2008\r\nNTC ISO 27001:2005\r\nNormatividad y documentación asociada a los procesos  GPL, GCC, GCV, GMC, GMA, GSC, GEA, GEH, GEF, GCP, GEJ, GTI, GDE, GER y GCI', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'RAC', 0, 2015),
	(187, 'Auditoria Integral 2015 - Gestión Canales de Venta ', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'NTC ISO 9001:2008\r\nProcedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.\r\n', 'NTC ISO 9001:2008\r\nProcedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.\r\n', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'GCV', 0, 2015),
	(188, 'Auditoria Integral 2015 - Gestión Clientes Corporativos', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'GEC', 0, 2015),
	(189, 'Auditoria Integral 2015 - Gestión Desarrollo', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2015),
	(190, 'Auditoria Integral 2015 - Gestión Administrativa', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'GEA', 0, 2015),
	(191, 'Auditoria Integral 2015 - Gestión Servicio al Cliente', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'GSI', 0, 2015),
	(192, 'Auditoria Integral 2015 - Gestión Mensajería y Carga', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', ' ', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'MYC', 0, 2015),
	(193, 'Auditoria Integral 2015 - 23 Racol', 159, 82, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008 y de las actividades y de los controles para mitigar los riesgos asociados a los procesos de Inter Rapidísimo a nivel nacional en las 23 RACOL y casa matriz, así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'RAC', 0, 2015),
	(194, 'Auditoria Integral 2015 - RACOL AM', 159, 82, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'NTC ISO 9001:2008\r\nProcedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.\r\n', 'NTC ISO 9001:2008', ' ', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2015),
	(195, 'Auditoria Integral 2015 - RACOL PM', 159, 82, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo', 'NTC ISO 9001:2008\r\nProcedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo\r\n', ' ', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2015),
	(196, 'Auditoria Integral 2015 - Gestión Humana', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', ' ', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'GEH', 0, 2015),
	(197, 'Auditoria Integral 2015 - Gestión Financiera', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', ' ', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'GEF', 0, 2015),
	(198, 'Auditoria Integral 2015 - Gestión de Riesgos', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'N/A', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'GRI', 0, 2015),
	(199, 'Auditoria Integral 2015 - Gestión Masivos', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados y contratistas.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'MAS', 0, 2015),
	(200, 'Auditoria Integral 2015 - Gestión Juridica', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', 'GEJ', 0, 2015),
	(201, 'Auditoria Integral 2015 - Gestión Giros', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de INTER RAPIDÍSIMO tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de INTER RAPIDÍSIMO a nivel nacional (en las 23  RACOL) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', ' ', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2015),
	(202, 'Auditoria Integral 2015 - Gestión de Infraestructura Tecnológica  ', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales  y reglamentarios y de cada una de las actividades y de los controles de los procedimientos de Inter Rapidisimo tanto en casa matriz como en todas las RACOL, como fin de contribuir a la mejora del sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, Giros y Carga con oportunidad y seguridad a novel nacional', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001 y de las actividades y de los controles para mitigar los riesgos asociados a los procesos de Inter Rapidisimo a nivel nacional en las 23 RACOL y casa matriz, así como las actividades y controles documentados en la organización  ', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidisimo', 'NTC ISO 9001:2008\r\n', ' ', 'Combinación de muestreo basado en juicio para que se tome información con característica diferentes y relevantes y de muestreo estadístico para elegir entre las mismas. ', '', 0, 2015),
	(203, 'Auditoria Integral 2015 - Gestión Control Interno', 159, 84, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (8) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados.', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2015),
	(204, 'Auditoria Integral 2015 - Gestión Planeación Directiva', 159, 82, 'Verificar el cumplimiento de los requisitos de la norma ISO 9001:2008, legales, reglamentarios y de cada una de las actividades y los controles de los procedimientos de Inter Rapidísimo tanto en casa matriz como en todas las RACOL, con fin de contribuir a la mejora del Sistema Integral de Gestión Empresarial (SIGE) y así mismo se refleje en la prestación de los servicios de mensajería, giros y carga con oportunidad y seguridad a nivel nacional.', 'Verificación del cumplimiento de los requisitos de la norma ISO 9001:2008, las actividades y los controles para mitigar los riesgos asociados a  los procesos de Inter Rapidísimo a nivel nacional (en las 23  RACOL), agencias propias (8) y casa matriz; así como las actividades y controles documentados en la organización.', 'Procedimientos, Reglamentos, Políticas, Requisitos Legales de Inter Rapidísimo.', 'NTC ISO 9001:2008', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2015),
	(205, 'Implementación norma NIIF', 161, 85, 'Verificar el cumplimiento de las etapas para la implemetación de la Norma Internacional Financiera NIIF ', 'Verificar la implementación y cumplimiento de la Norma Internacional de Información Financiera unificando los parámetros nacionales vs los internacionales que permitan que la información financiera de Inter Rapidísimo S.A. sea comparable a nivel mundial.', 'Norma Internacional de Información Financiera NIIF.', 'Norma Internacional de Información Financiera NIIF.', 'Aplicación de listas de chequeo.\r\nRevisión documental con participación del auditado.\r\nObservación del trabajo realizado.\r\nVisita al sitio.\r\nMuestreo.\r\nEntrevistas empleados', 'Combinación de muestreo basado en juicio para que se tome información con características diferentes y relevantes y de muestreo estadístico para elegir entre las mismas.', '', 0, 2015),
	(206, 'p: LCH Crono capacitacion', 166, 86, '.', '.', '.', '.', '.', '.', 'CRONO', 0, NULL);
/*!40000 ALTER TABLE `listachqxtipoaudit` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.materia
DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `IdMateria` int(3) NOT NULL AUTO_INCREMENT,
  `NombreMateria` varchar(80) NOT NULL,
  `Estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`IdMateria`,`NombreMateria`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.materia: 32 rows
DELETE FROM `materia`;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` (`IdMateria`, `NombreMateria`, `Estado`) VALUES
	(1, 'WLOVE- HATE', 1),
	(2, 'DESCRIBING PEOPLE', 1),
	(3, 'DREAM HOUSE', 1),
	(5, 'FOOD', 1),
	(6, 'THE SENSES', 1),
	(7, 'TRANSPORTATION', 1),
	(8, 'SUPERHEROES', 1),
	(9, 'AROUND TOWN', 1),
	(10, 'WHAT TIME IS IT?', 1),
	(11, 'AT THE STORE', 1),
	(12, 'FAMILY TREE', 1),
	(13, 'VACATION', 1),
	(14, 'HAVE YOU EVER?', 1),
	(15, 'FUTURE AND TECHNOLOGY', 1),
	(16, 'MOVIES', 1),
	(17, 'TRAVELLING', 1),
	(18, 'BRANDS AND MONEY VALUE', 1),
	(19, 'TECHNO-PRIVACY', 1),
	(20, 'SELLING SUPER-POWER', 1),
	(21, 'SUCCESS VS. PROFIT', 1),
	(22, 'NOMOPHOBIA', 1),
	(23, 'STEREOTYPES', 1),
	(24, 'GRAPHOLOGY', 1),
	(25, 'CHEATING IN SPORTS', 1),
	(26, 'GREED', 1),
	(27, 'DOPING', 1),
	(28, 'ALCOHOL- A SOCIAL AGENT?', 1),
	(29, 'PARANORMAL ACTIVITY', 1),
	(30, 'CONNECTIONS: DESCRIBING CROSS-CULTURAL EXPERINCES', 1),
	(31, 'STRATEGY AND CREATIVITY IN BUSINESS', 1),
	(32, 'EMPLOYMENT AND LEADING TRENDS', 1),
	(33, 'PERFORMANCE AND SATISFACTION IN THE WORKPLACE', 1);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.mes
DROP TABLE IF EXISTS `mes`;
CREATE TABLE IF NOT EXISTS `mes` (
  `idMes` int(11) NOT NULL AUTO_INCREMENT,
  `NombreMEs` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMes`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.mes: 12 rows
DELETE FROM `mes`;
/*!40000 ALTER TABLE `mes` DISABLE KEYS */;
INSERT INTO `mes` (`idMes`, `NombreMEs`) VALUES
	(1, 'ENERO'),
	(2, 'FEBRERO'),
	(3, 'MARZO'),
	(4, 'ABRIL'),
	(5, 'MAYO'),
	(6, 'JUNIO'),
	(7, 'JULIO'),
	(8, 'AGOSTO'),
	(9, 'SEPTIEMBRE'),
	(10, 'OCTUBRE'),
	(11, 'NOVIEMBRE'),
	(12, 'DICIEMBRE');
/*!40000 ALTER TABLE `mes` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.nivel
DROP TABLE IF EXISTS `nivel`;
CREATE TABLE IF NOT EXISTS `nivel` (
  `IdNivel` int(3) NOT NULL AUTO_INCREMENT,
  `NombreNivel` varchar(50) NOT NULL,
  `Estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdNivel`,`NombreNivel`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.nivel: 6 rows
DELETE FROM `nivel`;
/*!40000 ALTER TABLE `nivel` DISABLE KEYS */;
INSERT INTO `nivel` (`IdNivel`, `NombreNivel`, `Estado`) VALUES
	(1, '1. SOCIAL EXECUTIVE', 1),
	(2, '4. SOCIAL EXECUTIVE', 1),
	(3, '6. BUSINESS EXECUTIVE', 1),
	(5, '5. SOCIAL EXECUTIVE', 1),
	(6, '2. SOCIAL EXECUTIVE', 1),
	(7, '3. BUSINESS EXECUTIVE', 1);
/*!40000 ALTER TABLE `nivel` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.nivelasignado
DROP TABLE IF EXISTS `nivelasignado`;
CREATE TABLE IF NOT EXISTS `nivelasignado` (
  `IdAsignado` int(11) NOT NULL AUTO_INCREMENT,
  `IdEstudiante` int(11) DEFAULT NULL,
  `IdNivel` int(3) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `EstadoCierre` tinyint(1) DEFAULT NULL,
  `fechacierre` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `cerradopor` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdAsignado`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.nivelasignado: 10 rows
DELETE FROM `nivelasignado`;
/*!40000 ALTER TABLE `nivelasignado` DISABLE KEYS */;
INSERT INTO `nivelasignado` (`IdAsignado`, `IdEstudiante`, `IdNivel`, `Estado`, `EstadoCierre`, `fechacierre`, `cerradopor`) VALUES
	(19, 26, 5, 1, NULL, NULL, NULL),
	(34, 21, 2, 2, NULL, NULL, NULL),
	(21, 25, 1, 1, NULL, NULL, NULL),
	(24, 22, 1, 1, NULL, NULL, NULL),
	(37, 21, 6, 2, NULL, NULL, NULL),
	(38, 21, 5, 1, NULL, NULL, NULL),
	(39, 24, 1, 2, NULL, NULL, NULL),
	(40, 28, 1, 1, NULL, NULL, NULL),
	(46, 24, 1, 1, NULL, NULL, NULL),
	(73, 9, 1, 1, 1, NULL, NULL);
/*!40000 ALTER TABLE `nivelasignado` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.ordenescargue
DROP TABLE IF EXISTS `ordenescargue`;
CREATE TABLE IF NOT EXISTS `ordenescargue` (
  `IdOrdenCargue` int(10) NOT NULL,
  `CrtInterno` int(12) DEFAULT NULL,
  `IdGenerador` int(4) DEFAULT NULL,
  `Pedido` int(10) DEFAULT NULL,
  `Aignacion` int(4) DEFAULT NULL,
  `IdAcopio` int(3) DEFAULT NULL,
  `Cedula` varchar(20) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Barrio` varchar(100) DEFAULT NULL,
  `Municipio` varchar(100) DEFAULT NULL,
  `Departamento` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Cajas` int(4) DEFAULT NULL,
  `Postventa` varchar(2) DEFAULT NULL,
  `Zona` int(6) DEFAULT NULL,
  `Seccion` varchar(10) DEFAULT NULL,
  `ZonaSeccion` int(6) DEFAULT NULL,
  `Afp` int(3) DEFAULT NULL,
  `Codsap` varchar(10) DEFAULT NULL,
  `Boleta` int(10) DEFAULT NULL,
  `TipoDocumento` varchar(1) DEFAULT NULL,
  `LoteInterno` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IdOrdenCargue`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.ordenescargue: 0 rows
DELETE FROM `ordenescargue`;
/*!40000 ALTER TABLE `ordenescargue` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordenescargue` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.procesos
DROP TABLE IF EXISTS `procesos`;
CREATE TABLE IF NOT EXISTS `procesos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abr` varchar(8) NOT NULL COMMENT 'Abrviatura del Proceso',
  `proceso` varchar(50) NOT NULL,
  `abr2` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Areviatura para cronogramas',
  `proceson` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre proceso',
  `nombre_res` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre del cargo Responsable',
  `estado` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Estado del Proceso',
  `acargo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Procesos a cargo',
  `tipo` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tipo de Proceso',
  `annio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.procesos: 113 rows
DELETE FROM `procesos`;
/*!40000 ALTER TABLE `procesos` DISABLE KEYS */;
INSERT INTO `procesos` (`id`, `abr`, `proceso`, `abr2`, `proceson`, `nombre_res`, `estado`, `acargo`, `tipo`, `annio`) VALUES
	(1, 'JUNTADIR', 'JUNTA DIRECTIVA', 'JDI', 'JUNTA DIRECTIVA', 'JUNTA DIRECTIVA', 'A', '', 'D', '2013,2014,2015'),
	(2, 'SIGE-PLD', 'SIGE', 'SIG', 'SIGE', 'SIGE', 'A', '', 'S', '2013,2014,2015'),
	(3, 'CAPACIT', 'COORDINACION DE CAPACITACION', 'CAP', 'COORDINACION DE CAPACITACION', 'COORDINADOR DE CAPACITACION', 'A', '', 'C', '2013,2014,2015'),
	(4, 'MAS', 'DIRECCION DE MASIVOS', 'GMA', 'DIRECCION DE MASIVOS', 'DIRECTOR DE MASIVOS', 'A', 'MAS', 'D', '2013,2014,2015'),
	(5, 'MYC', 'DIRECCION DE MENSAJERIA Y CARGA', 'GMC', 'DIRECCION DE MENSAJERIA Y CARGA', 'DIRECTOR DE MENSAJERIA Y CARGA', 'A', 'GOP,GLI,GTR,RACOL,MVH,TRA,TEI,LIN,OPE,PRY', 'D', '2013,2014,2015'),
	(6, 'GEC', 'DIRECCION DE CLIENTES CORPORATIVOS', 'GCC', 'DIRECCION DE CLIENTES CORPORATIVOS', 'DIRECTOR DE CLIENTES CORPORATIVOS', 'A', 'FCR', 'D', '2013,2014,2015'),
	(7, 'CVT', 'DIRECCION DE CANALES DE VENTA', 'GCV', 'DIRECCION DE CANALES DE VENTA', 'DIRECTOR DE CANALES DE VENTA', 'A', 'MYP,CVT', 'D', '2013,2014,2015'),
	(8, 'DPA', 'DIRECCION DE PROCESOS DE APOYO', '', '', '', 'A', '', '', '2013,2014,2015'),
	(9, 'GEA', 'SUBDIRECCION ADMINISTRATIVA', 'GEA', 'DIRECCION ADMINISTRATIVA', 'DIRECTOR ADMINISTRATIVA', 'A', 'DOC,COM', 'D', '2013,2014,2015'),
	(10, 'GEH', 'DIRECCION DE GESTION HUMANA', 'GEH', 'DIRECCION GESTION HUMANA', 'DIRECTOR DE GESTION HUMANA', 'A', 'SEL,PRD,CTT,TON,SOC,NOM', 'D', '2013,2014,2015'),
	(11, 'GEF', 'SUBDIRECCION FINANCIERA', 'GEF', 'DIRECCION FINANCIERA', 'DIRECTOR FINANCIERA', 'A', 'GCA,GCP,GCB,CCT,IMP,FAC,CPS', 'D', '2013,2014,2015'),
	(12, 'GTR', 'SUBDIRECCION DE TRANSPORTE', 'GTR', 'SUBDIRECCION DE TRANSPORTES', 'SUBDIRECTOR DE TRANSPORTES', 'A', '', 'S', '2013,2014,2015'),
	(13, 'GOP', 'SUBDIRECCION DE OPERACIONES', 'GOP', 'SUBDIRECCION DE OPERACIONES', 'SUBDIRECTOR DE OPERACIONES', 'A', '', 'S', '2013,2014,2015'),
	(14, 'LIN', 'SUBDIRECCION DE LOGISTICA INVERSA', 'GLI', 'SUBDIRECCION DE LOGISTICA INVERSA', 'SUBDIRECTOR DE LOGÍSTICA INVERSA', 'A', '', 'S', '2013,2014,2015'),
	(15, 'GEJ', 'DIRECCION JURIDICA', 'GEJ', 'DIRECCION JURIDICA', 'DIRECTOR JURIDICA', 'A', '', 'D', '2013,2014,2015'),
	(16, 'GSI', 'DIRECCION DE TEC., COM. Y SEG. INFORMATICA', 'GTI', 'DIRECCION DE TECNOLOGIA, INNOVACION Y SEGURIDAD DE LA INFORMACION', 'DIRECTOR DE TECNOLOGIA, INNOVACION Y SEGURIDAD DE LA INFORMACION', 'A', 'GIN,GIT,GDE,GSI,CYR,AIC,AUD,STC,GCR', 'D', '2013,2014,2015'),
	(17, 'GER', 'DIRECCION DE GESTION DE RIESGOS', 'GER', 'DIRECCION DE GESTION DE RIESGOS', 'DIRECTOR DE GESTION DE RIESGOS', 'A', 'SFI', 'D', '2013,2014,2015'),
	(18, 'GCI', 'DIRECCION DE CONTROL INTERNO', 'GCI', 'DIRECCION DE CONTROL INTERNO', 'DIRECTOR DE CONTROL INTERNO', 'A', '', 'D', '2013,2014,2015'),
	(19, 'PLD', 'PLANEACION DIRECTIVA', 'GPL', 'DIRECCION DE PLANEACION DIRECTIVA', 'DIRECCION DE PLANEACION DIRECTIVA', 'A', 'SIG,CAP,AGN,AIG', 'D', '2013,2014,2015'),
	(21, 'AME', 'AMENAZAS EXTERNAS', 'AME', 'AMENAZAS EXTERNAS', '', 'A', '', 'O', '2013,2014,2015'),
	(22, 'GCA', 'GESTIÓN CARTERA', 'GCA', 'SUBDIRECCION DE CARTERA', 'SUBDIRECTOR DE CARTERA', 'I', '', 'S', NULL),
	(23, '', 'GESTIÓN CONTABILIDAD', 'GCB', 'SUBDIRECCIÓN DE CONTABILIDAD', 'SUBDIRECTOR DE CONTABILIDAD', 'A', '', 'S', '2013,2014,2015'),
	(24, '', 'GESTIÓN COSTOS Y PRESUPUESTO', 'GCP', 'SUBDIRECCIÓN DE COSTOS Y PRESUPUESTO', 'SUBDIRECTOR DE COSTOS Y PRESUPUESTO', 'I', '', 'S', NULL),
	(27, '', 'GESTIÓN SEGURIDAD DE LA INFORMACIÓN', 'GSI', 'SUBDIRECCIÓN DE SEGURIDAD DE LA INFORMACIÓN', 'SUBDIRECTOR DE SEGURIDAD DE LA INFORMACIÓN', 'A', '', 'S', '2013,2014,2015'),
	(29, '', 'GESTIÓN INFRAESTRUCTURA TECNOLÓGICA', 'GIT', 'SUBDIRECCIÓN DE INFRAESTRUCTURA TECNOLÓGICA', 'SUBDIRECTOR DE INFRAESTRUCTURA TECNOLÓGICA', 'A', '', 'S', '2013,2014,2015'),
	(30, '', 'GESTIÓN INTELIGENCIA DE NEGOCIOS', 'GIN', 'SUBDIRECCIÓN DE INTELIGENCIA DE NEGOCIOS', 'SUBDIRECTOR DE INTELIGENCIA DE NEGOCIOS', 'A', '', 'S', '2013,2014,2015'),
	(31, '', 'GESTIÓN DE DESARROLLO', 'GDE', 'SUBDIRECCIÓN DE DESARROLLO', 'SUBDIRECTOR DE DESARROLLO', 'A', '', 'S', '2013,2014'),
	(32, '', 'COORDINACIÓN ADMON SISTEMAS INFO. Y COMUN.   ', 'AIC', 'COORDINACIÓN ADMON SISTEMAS INFO. Y COMUN.   ', 'COORDINADOR ADMON SISTEMAS INFO. Y COMUN.   ', 'A', '', 'C', '2013,2014,2015'),
	(33, '', 'COORDINACIÓN AUDIOVISUALES ', 'AUD', 'COORDINACIÓN AUDIOVISUALES ', 'COORDINADOR AUDIOVISUALES ', 'A', '', 'C', '2013,2014,2015'),
	(34, '', 'COORDINACIÓN CAPACITACION                 ', '', 'COORDINACIÓN CAPACITACION                 ', 'COORDINADOR CAPACITACION                 ', 'I', '', 'X', '2012'),
	(35, '', 'COORDINACIÓN CONTROL DE CUENTAS              ', 'CCT', 'COORDINACIÓN CONTROL DE CUENTAS              ', 'COORDINADOR CONTROL DE CUENTAS              ', 'A', '', 'C', '2013,2014,2015'),
	(36, '', 'COORDINACIÓN COMPRAS                      ', 'COM', 'COORDINACIÓN COMPRAS                      ', 'COORDINADOR DE COMPRAS Y SUMINISTROS                   ', 'A', '', 'C', '2013,2014,2015'),
	(37, '', 'COORDINACIÓN COMPENSACIONES', 'CPS', 'COORDINACIÓN COMPENSACIONES', 'COORDINADOR COMPENSACIONES', 'A', '', 'C', '2013,2014,2015'),
	(38, '', 'COORDINACIÓN CONTRATISTAS                 ', 'CTT', 'COORDINACIÓN CONTRATISTAS                 ', 'COORDINADOR CONTRATISTAS                 ', 'A', '', 'C', '2013,2014,2015'),
	(39, '', 'COORDINACIÓN CANALES DE VENTA             ', 'CVT', 'COORDINACIÓN CANALES DE VENTA             ', 'COORDINADOR CANALES DE VENTA             ', 'A', '', 'C', '2013,2014,2015'),
	(40, '', 'COORDINACIÓN CONECTIVIDAD Y REDES         ', 'CYR', 'COORDINACIÓN CONECTIVIDAD Y REDES         ', 'COORDINADOR CONECTIVIDAD Y REDES         ', 'A', '', 'C', '2013,2014,2015'),
	(41, '', 'COORDINACIÓN DEFENSORIA DEL CLIENTE          ', 'DCL', 'DEFENSORIA DEL CLIENTE          ', 'DEFENSOR DEL CLIENTE', 'A', '', 'C', '2013,2014,2015'),
	(42, '', 'COORDINACIÓN DEFENSORIA CANALES DE VENTA     ', 'DCV', 'DEFENSORIA CANALES DE VENTA     ', 'DEFENSOR DE CANALES DE VENTA', 'A', '', 'C', '2013,2014,2015'),
	(43, '', 'COORDINACIÓN DOCUMENTAL                      ', 'DOC', 'COORDINACIÓN DOCUMENTAL                      ', 'COORDINADOR DE GESTIÓN DOCUMENTAL                      ', 'A', '', 'C', '2013,2014,2015'),
	(44, '', 'COORDINACIÓN FACTURACION                  ', 'FAC', 'COORDINACIÓN FACTURACION                  ', 'COORDINADOR FACTURACION                  ', 'A', '', 'C', '2013,2014,2015'),
	(45, '', 'COORDINACIÓN FABRICA DE CREDITOS          ', 'FCR', 'COORDINACIÓN FABRICA DE CREDITOS          ', 'COORDINADOR FABRICA DE CREDITOS          ', 'A', '', 'C', '2013,2014,2015'),
	(46, '', 'COORDINACIÓN IMPUESTOS                    ', 'IMP', 'COORDINACIÓN IMPUESTOS                    ', 'COORDINADOR IMPUESTOS                    ', 'A', '', 'C', '2013,2014,2015'),
	(47, '', 'COORDINACIÓN LOGISTICA INVERSA            ', 'LIN', 'COORDINACIÓN LOGISTICA INVERSA            ', 'COORDINADOR LOGISTICA INVERSA            ', 'A', '', 'C', '2013,2014,2015'),
	(48, '', 'COORDINACIÓN OPERACIONES MASIVOS                  ', 'MAS', 'COORDINACIÓN OPERACIONES MASIVOS                  ', 'COORDINADOR OPERACIONES MASIVOS                  ', 'A', '', 'C', '2013,2014,2015'),
	(49, '', 'COORDINACIÓN MANTENIMIENTO DE VEHICULOS   ', 'MVH', 'COORDINACIÓN MANTENIMIENTO DE VEHICULOS   ', 'COORDINADOR MANTENIMIENTO DE VEHICULOS   ', 'A', '', 'C', '2013,2014,2015'),
	(50, 'GMP', 'COORDINACIÓN MERCADEO Y PUBLICIDAD', 'MYP', 'COORDINACIÓN MERCADEO Y PUBLICIDAD', 'COORDINADOR MERCADEO Y PUBLICIDAD', 'A', '', 'C', '2013,2014,2015'),
	(51, '', 'COORDINACIÓN NOMINA                       ', 'NOM', 'COORDINACIÓN NOMINA                       ', 'COORDINADOR DE NOMINA                       ', 'A', '', 'C', '2013,2014,2015'),
	(52, '', 'COORDINACIÓN OPERACIONES GMC', 'OPE', 'COORDINACIÓN OPERACIONES GMC', 'COORDINADOR OPERACIONES GMC', 'A', '', 'C', '2013,2014,2015'),
	(53, '', 'COORDINACIÓN PROCESOS DISCIPLINARIOS', 'PRD', 'COORDINACIÓN PROCESOS DISCIPLINARIOS', 'COORDINADOR PROCESOS DISCIPLINARIOS', 'A', '', 'C', '2013,2014,2015'),
	(54, '', 'COORDINACIÓN PROYECTOS LOGÍSTICOS', 'PRY', 'COORDINACIÓN PROYECTOS LOGÍSTICOS', 'COORDINADOR PROYECTOS LOGÍSTICOS', 'A', '', 'C', '2013,2014,2015'),
	(55, '', 'COORDINACIÓN SERVICIO AL CLIENTE          ', 'SCL', 'COORDINACIÓN DE SERVICIO AL CLIENTE          ', 'COORDINADOR DE SERVICIO AL CLIENTE          ', 'A', '', 'C', '2013,2014,2015'),
	(56, '', 'COORDINACIÓN SELECCIÓN                    ', 'SEL', 'COORDINACIÓN SELECCIÓN                    ', 'COORDINADOR SELECCIÓN                    ', 'A', '', 'C', '2013,2014,2015'),
	(57, '', 'COORDINACIÓN SEGURIDAD FISICA             ', 'SFI', 'COORDINACIÓN SEGURIDAD FISICA             ', 'COORDINADOR SEGURIDAD FISICA             ', 'A', '', 'C', '2013,2014,2015'),
	(58, '', 'COORDINACIÓN SIGE                                 ', 'SIG ', 'COORDINACIÓN SIGE                                 ', 'COORDINADOR SIGE                                 ', 'I', '', 'C', NULL),
	(59, '', 'COORDINACIÓN SALUD OCUPACIONAL               ', 'SOC', 'COORDINACIÓN SALUD OCUPACIONAL               ', 'COORDINADOR SALUD OCUPACIONAL               ', 'A', '', 'C', '2013,2014,2015'),
	(60, '', 'COORDINACIÓN SOPORTE TECNICO              ', 'STC', 'COORDINACIÓN SOPORTE TECNICO              ', 'COORDINADOR SOPORTE TECNICO              ', 'A', '', 'C', '2013,2014,2015'),
	(61, '', 'COORDINACIÓN TRAMITES E INTERVIAJES', 'TEI', 'COORDINACIÓN TRAMITES E INTERVIAJES', 'COORDINADOR TRAMITES E INTERVIAJES', 'A', '', 'C', '2013,2014,2015'),
	(62, '', 'COORDINACIÓN CONTRATACION                 ', 'TON', 'COORDINACIÓN CONTRATACION                 ', 'COORDINADOR CONTRATACION                 ', 'A', '', 'C', '2013,2014,2015'),
	(63, '', 'COORDINACIÓN TRANSPORTE                   ', 'TRA', 'COORDINACIÓN TRANSPORTE                   ', 'COORDINADOR TRANSPORTE                   ', 'A', '', 'C', '2013,2014,2015'),
	(64, 'GSC', 'DIRECCIÓN DE SERVICIO AL CLIENTE', 'GSC', 'DIRECCION DE SERVICIO AL CLIENTE', 'DIRECTOR DE SERVICIO AL CLIENTE', 'A', 'SCL,DCL,DCV', 'D', '2013,2014,2015'),
	(65, 'SGE', 'SUBGERENCIA', 'SGE', 'SUBGERENCIA', 'SUBGERENCIA', 'A', '', 'D', '2013,2014,2015'),
	(66, 'GRN', 'GERENCIA', 'GRN', 'GERENCIA', 'GERENCIA', 'A', '', 'D', '2013,2014,2015'),
	(67, '', 'ARAUCA_RACOL', 'R01', 'ARAUCA_RACOL', 'ARAUCA_RACOL', 'A', '1013582957', 'R', '2013,2014,2015'),
	(68, '', 'ARMENIA_RACOL', 'R02', 'ARMENIA_RACOL', 'ARMENIA_RACOL', 'A', '19258722', 'R', '2013,2014,2015'),
	(69, '', 'BARRANQUILLA_RACOL', 'R03', 'BARRANQUILLA_RACOL', 'BARRANQUILLA_RACOL', 'A', '80251482', 'R', '2013,2014,2015'),
	(70, '', 'BOGOTA_RACOL', 'R04', 'BOGOTA_RACOL', 'BOGOTA_RACOL', 'A', '79736288', 'R', '2013,2014,2015'),
	(71, '', 'BUCARAMANGA_RACOL', 'R05', 'BUCARAMANGA_RACOL', 'BUCARAMANGA_RACOL', 'A', '1013582957', 'R', '2013,2014,2015'),
	(72, '', 'CALI_RACOL', 'R06', 'CALI_RACOL', 'CALI_RACOL', 'A', '1073150510', 'R', '2013,2014,2015'),
	(73, '', 'CASA MATRIZ', 'CM', 'CASA MATRIZ', 'CASA MATRIZ', 'A', '', 'R', '2013,2014,2015'),
	(74, '', 'CUCUTA_RACOL', 'R07', 'CUCUTA_RACOL', 'CUCUTA_RACOL', 'A', '1013582957', 'R', '2013,2014,2015'),
	(75, '', 'FLORENCIA_RACOL', 'R08', 'FLORENCIA_RACOL', 'FLORENCIA_RACOL', 'A', '1073150510', 'R', '2013,2014,2015'),
	(76, '', 'IBAGUE_RACOL', 'R09', 'IBAGUE_RACOL', 'IBAGUE_RACOL', 'A', '1073150510', 'R', '2013,2014,2015'),
	(77, '', 'MANIZALES_RACOL', 'R10', 'MANIZALES_RACOL', 'MANIZALES_RACOL', 'A', '19258722', 'R', '2013,2014,2015'),
	(78, '', 'MEDELLIN_RACOL', 'R11', 'MEDELLIN_RACOL', 'MEDELLIN_RACOL', 'A', '19258722', 'R', '2013,2014,2015'),
	(79, '', 'MOCOA_RACOL', 'R12', 'MOCOA_RACOL', 'MOCOA_RACOL', 'A', '1073150510', 'R', '2013,2014,2015'),
	(80, '', 'MONTERIA_RACOL', 'R13', 'MONTERIA_RACOL', 'MONTERIA_RACOL', 'A', '80251482', 'R', '2013,2014,2015'),
	(81, '', 'NEIVA_RACOL', 'R14', 'NEIVA_RACOL', 'NEIVA_RACOL', 'A', '1073150510', 'R', '2013,2014,2015'),
	(82, '', 'PASTO_RACOL', 'R15', 'PASTO_RACOL', 'PASTO_RACOL', 'A', '1073150510', 'R', '2013,2014,2015'),
	(83, '', 'PEREIRA_RACOL', 'R16', 'PEREIRA_RACOL', 'PEREIRA_RACOL', 'A', '19258722', 'R', '2013,2014,2015'),
	(84, '', 'POPAYAN_RACOL', 'R17', 'POPAYAN_RACOL', 'POPAYAN_RACOL', 'A', '1073150510', 'R', '2013,2014,2015'),
	(85, '', 'QUIBDO_RACOL', 'R18', 'QUIBDO_RACOL', 'QUIBDO_RACOL', 'A', '19258722', 'R', '2013,2014,2015'),
	(86, '', 'SINCELEJO_RACOL', 'R19', 'SINCELEJO_RACOL', 'SINCELEJO_RACOL', 'A', '80251482', 'R', '2013,2014,2015'),
	(87, '', 'TUNJA_RACOL', 'R20', 'TUNJA_RACOL', 'TUNJA_RACOL', 'A', '1013582957', 'R', '2013,2014,2015'),
	(88, '', 'VALLEDUPAR_RACOL', 'R21', 'VALLEDUPAR_RACOL', 'VALLEDUPAR_RACOL', 'A', '80251482', 'R', '2013,2014,2015'),
	(89, '', 'VILLAVICENCIO_RACOL', 'R22', 'VILLAVICENCIO_RACOL', 'VILLAVICENCIO_RACOL', 'A', '1013582957', 'R', '2013,2014,2015'),
	(90, '', 'YOPAL_RACOL', 'R23', 'YOPAL_RACOL', 'YOPAL_RACOL', 'A', '1013582957', 'R', '2013,2014,2015'),
	(91, '', 'KOMPRECH', 'KOM', 'KOMPRECH', 'KOMPRECH', 'A', '', 'R', '2013,2014'),
	(93, '', 'COMITES', 'CTS', 'COMITES', 'COMITES', 'A', '', 'R', '2013,2014'),
	(94, '', 'RACOL', 'RAC', 'RACOL', 'RACOL', 'A', '', 'D', '2013,2014,2015'),
	(96, '', 'NO APLICA', 'N/A', 'NO APLICA', 'NO APLICA', 'A', '', '', '2013,2014,2015'),
	(97, '', 'ASISTENTE GERENCIA', 'AGN', 'ASISTENTE GERENCIA', 'ASISTENTE GERENCIA', 'A', '', '', '2013,2014'),
	(98, '', 'ANALISTA', 'AIG', 'ANALISTA', 'ANALISTA', 'A', '', '', '2013,2014'),
	(99, '', 'AGENCIA CARTAGENA', 'ACT', 'AGENCIA CARTAGENA', 'AGENCIA CARTAGENA', 'A', '', 'R', '2013,2014'),
	(100, '', 'AGENCIA RIOHACHA', 'ARI', 'AGENCIA RIOHACHA', 'AGENCIA RIOHACHA', 'A', '', 'R', '2013,2014,2015'),
	(101, '', 'AGENCIA SANTA MARTA', 'AST', 'AGENCIA SANTA MARTA', 'AGENCIA SANTA MARTA', 'A', '', 'R', '2013,2014,2015'),
	(102, '', 'AGENCIA GRANADA', 'AGR', 'AGENCIA GRANADA', 'AGENCIA GRANADA', 'A', '', 'R', '2013,2014,2015'),
	(103, '', 'AGENCIA APARTADO', 'AAP', 'AGENCIA APARTADO', 'AGENCIA APARTADO', 'A', '', 'R', '2013,2014,2015'),
	(104, '', 'AGENCIA GIRARDOT', 'AGG', 'AGENCIA GIRARDOT', 'AGENCIA GIRARDOT', 'A', '', 'R', '2013,2014,2015'),
	(105, '', 'SUBDIRECCION CONECTIVIDAD Y REDES', 'GCR', 'SUBDIRECCION CONECTIVIDAD Y REDES', 'SUBDIRECCION CONECTIVIDAD Y REDES', 'A', '', 'S', '2013,2014,2015'),
	(106, 'GCP', 'SUBDIRECCION DE COSTOS Y PRESUPUESTOS', 'GCP', 'SUBDIRECCION DE COSTOS Y PRESUPUESTOS', 'SUBDIRECCION DE COSTOS Y PRESUPUESTOS', 'A', '', 'S', '2013,2014,2015'),
	(107, 'GCA', 'SUBDIRECCION DE CARTERA', 'GCA', 'SUBDIRECCION DE CARTERA', 'SUBDIRECCION DE CARTERA', 'A', '', 'S', '2013,2014,2015'),
	(108, 'GCB', 'SUBDIRECCION DE CONTABILIDAD', 'GCB', 'SUBDIRECCION DE CONTABILIDAD', 'SUBDIRECCION DE CONTABILIDAD', 'A', '', 'S', '2013,2014,2015'),
	(109, 'GCO', 'DIRECCION DE CONTRATACION', 'GCO', 'DIRECCION DE CONTRATACION', 'DIRECCION DE CONTRATACION', 'A', 'TON', 'D', '2013,2014,2015'),
	(110, 'GIR', 'DIRECCION DE GIROS', 'GIR', 'DIRECCION DE GIROS', 'DIRECCION DE GIROS', 'A', '', 'D', '2015'),
	(112, 'GTS', 'SUBDIRECCION DE TESORERIA', 'GTS', 'SUBDIRECCION DE TESORERIA', 'SUBDIRECCION DE TESORERIA', 'A', '', 'S', '2015'),
	(111, 'GDE', 'DIRECCION DE DESARROLLO', 'GDE', 'DIRECCION DE DESARROLLO', 'DIRECCION DE DESARROLLO', 'A', '', 'D', '2015'),
	(113, 'GCT', 'SUBDIRECCION DE CONTROL DE CUENTAS', 'GCT', 'SUBDIRECCION DE CONTROL DE CUENTAS', 'SUBDIRECCION DE CONTROL DE CUENTAS', 'A', '', 'S', '2015'),
	(114, 'GIP', 'SUBDIRECCION DE IMPUESTOS', 'GIP', 'SUBDIRECCION DE IMPUESTOS', 'SUBDIRECCION DE IMPUESTOS', 'A', '', 'S', '2015'),
	(115, 'TES', 'COORDINACION DE TESORERIA', 'TES', 'COORDINACION DE TESORERIA', 'COORDINACION DE TESORERIA', 'A', '', 'C', '2015'),
	(116, 'TNO', 'SUBDIRECCION TERRITORIAL NORTE', 'TNO', 'SUBDIRECCION TERRITORIAL NORTE', 'SUBDIRECCION TERRITORIAL NORTE', 'A', '', 'S', '2015'),
	(117, 'TSU', 'SUBDIRECCION TERRITORIAL SUR', 'TSU', 'SUBDIRECCION TERRITORIAL SUR', 'SUBDIRECCION TERRITORIAL SUR', 'A', '', 'S', '2015'),
	(118, 'TOC', 'SUBDIRECCION TERRITORIAL OCCIDENTE', 'TOC', 'SUBDIRECCION TERRITORIAL OCCIDENTE', 'SUBDIRECCION TERRITORIAL OCCIDENTE', 'A', '', 'S', '2015'),
	(119, 'TOR', 'SUBDIRECCION TERRITORIAL ORIENTE', 'TOR', 'SUBDIRECCION TERRITORIAL ORIENTE', 'SUBDIRECCION TERRITORIAL ORIENTE', 'A', '', 'S', '2015');
/*!40000 ALTER TABLE `procesos` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.profesores
DROP TABLE IF EXISTS `profesores`;
CREATE TABLE IF NOT EXISTS `profesores` (
  `IdProfesor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del Estudiante',
  `TipoDocumento_PRO` smallint(2) DEFAULT NULL COMMENT 'Tipo Documento de Identificacion',
  `NumeroDocumento_PRO` varchar(20) NOT NULL COMMENT 'Numero del Documento de Identificacion',
  `Nombres_PRO` varchar(55) DEFAULT NULL COMMENT 'Nombre Estudiantes',
  `Apellido1_PRO` varchar(55) DEFAULT NULL COMMENT 'Primer Apellido',
  `Apellido2_PRO` varchar(55) DEFAULT NULL COMMENT 'Segundo Apellido',
  `FechaCreacion_PRO` datetime DEFAULT NULL,
  `Usuario_PRO` varchar(45) DEFAULT NULL COMMENT 'Usuario',
  `Clave_PRO` varchar(25) DEFAULT NULL COMMENT 'Clave del Estudiante',
  `Estado_PRO` varchar(1) DEFAULT NULL,
  `IdCiudad_PRO` smallint(3) DEFAULT NULL,
  `Direccion_PRO` varchar(255) DEFAULT NULL,
  `Email_PRO` varchar(105) DEFAULT NULL,
  `Celular_PRO` varchar(20) DEFAULT NULL COMMENT 'Nro Telefono Celular',
  `TelefonoFijo_PRO` varchar(15) DEFAULT NULL COMMENT 'Nro. Telefono Fijo',
  `Estado_IdEstado` int(11) NOT NULL,
  `Sucursal_PRO` int(1) DEFAULT NULL,
  PRIMARY KEY (`IdProfesor`,`NumeroDocumento_PRO`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.profesores: 14 rows
DELETE FROM `profesores`;
/*!40000 ALTER TABLE `profesores` DISABLE KEYS */;
INSERT INTO `profesores` (`IdProfesor`, `TipoDocumento_PRO`, `NumeroDocumento_PRO`, `Nombres_PRO`, `Apellido1_PRO`, `Apellido2_PRO`, `FechaCreacion_PRO`, `Usuario_PRO`, `Clave_PRO`, `Estado_PRO`, `IdCiudad_PRO`, `Direccion_PRO`, `Email_PRO`, `Celular_PRO`, `TelefonoFijo_PRO`, `Estado_IdEstado`, `Sucursal_PRO`) VALUES
	(1, 1, '798754', 'martha', 'duran', '', '2017-05-15 23:27:32', '', '123456', '1', 0, 'calle 153', 'msmakesof@gmail.com', '868686', '', 0, 1),
	(2, 1, '663465436', 'mao', 'san', '', '2017-05-17 15:34:52', '', '', '1', 0, 'calle 153 # 94-51', 'msmakesof@gmail.com', '5476', '58876', 0, 1),
	(8, 1, '5674757', 'Mauricio', 'Sanchez Sierra', '', '2017-05-16 16:05:45', '', '', '1', 0, 'calle 153 # 94-51', 'msmakesof@gmail.com', '65634', '3463443', 0, 1),
	(9, 1, '89078908790', 'azul', 'san', '', '2017-05-16 16:14:04', '', '123456', '1', 0, 'calle 153 # 94-51', 'msmakesof@gmail.com', '4536354', '', 0, 2),
	(10, 1, '5465464564', 'juana', 'san', '', '2017-05-17 18:09:45', '', '', '1', 0, 'calle 123', 'juana@mail.com', '67657657', '8989898', 0, 2),
	(11, 1, '5465464564', 'juana', 'san', '', '2017-05-17 18:10:31', '', '', '1', 0, 'calle 123', 'juana@mail.com', '67657657', '8989898', 0, 2),
	(12, 1, '5465464564', 'juana', 'san', '', '2017-05-17 18:13:10', '', '', '1', 0, 'calle 123', 'juana@mail.com', '67657657', '8989898', 0, 2),
	(13, 3, '384847', 'Billy', 'San', '', '2017-05-17 19:50:58', '', '', '1', 0, 'Cra 7 no 45-48', 'msmakesof@gmail.com', '54466666', '8837377', 0, 1),
	(14, 2, '978979', 'ljkljlkj', 'jlkjljñlk', '', '2017-05-18 19:27:47', '', '', '1', 0, 'cdacadscadsga ggh56y655', 'kjlkjlkj@mail.com', '6365', '3634', 0, 1),
	(15, 2, '536345645', 'enoc', 'fagua', '', '2017-05-18 19:32:13', '', '123456', '2', 0, 'sd ghgj87987978', 'msmakesof@gmail.com', '788785', '', 0, 1),
	(16, 1, '6575', 'hdd', 'fdhdfdf', '', '2017-05-18 19:41:18', '', '', '1', 0, 'dfhdg', '', '745765', '4574785', 0, 2),
	(20, 1, '123456', 'luigi', 'romero', NULL, '2017-05-29 03:52:55', NULL, '123456', '1', 0, 'calle 153 # 94-51', 'msmakesof@gmail.com', '6456456456', '', 0, 1),
	(18, 2, '87987999', 'mario', 'bros', '', '2017-05-18 23:54:20', '', '123456', '1', 0, 'carrera 90', 'msmakesof@gmail.com', '97979879', '8789789', 0, 1),
	(19, 2, '5435435', 'DONALD', 'trump', '', '2017-05-19 00:55:50', '', '123456', '1', 0, 'calle 74', 'dtrump@gmail.com', '5654645', '', 0, 1);
/*!40000 ALTER TABLE `profesores` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.salon
DROP TABLE IF EXISTS `salon`;
CREATE TABLE IF NOT EXISTS `salon` (
  `IdSalon` int(3) NOT NULL AUTO_INCREMENT,
  `NombreSalon` varchar(20) NOT NULL,
  `Sucursal` int(11) DEFAULT NULL,
  `Estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`IdSalon`,`NombreSalon`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.salon: 3 rows
DELETE FROM `salon`;
/*!40000 ALTER TABLE `salon` DISABLE KEYS */;
INSERT INTO `salon` (`IdSalon`, `NombreSalon`, `Sucursal`, `Estado`) VALUES
	(1, 'One', 1, 1),
	(2, 'London', 1, 1),
	(3, 'Royal', 2, 2);
/*!40000 ALTER TABLE `salon` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.sucursal
DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE IF NOT EXISTS `sucursal` (
  `IdSucursal` int(11) NOT NULL AUTO_INCREMENT,
  `NombreSucursal` varchar(50) DEFAULT NULL,
  `DireccionSucursal` varchar(150) DEFAULT NULL,
  `EstadoSucursal` int(11) DEFAULT NULL,
  `EmailSucursal` varchar(80) DEFAULT NULL,
  `TelefonoSucursal` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`IdSucursal`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.sucursal: 2 rows
DELETE FROM `sucursal`;
/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
INSERT INTO `sucursal` (`IdSucursal`, `NombreSucursal`, `DireccionSucursal`, `EstadoSucursal`, `EmailSucursal`, `TelefonoSucursal`) VALUES
	(1, 'Bogota', 'calle 45', 1, 'chico@gmail.com', ''),
	(2, 'Medellin', 'carrera 7', 1, 'teleport@gmail.com', '9808980');
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.temasxnivel
DROP TABLE IF EXISTS `temasxnivel`;
CREATE TABLE IF NOT EXISTS `temasxnivel` (
  `IdTemaxNivel` int(5) NOT NULL AUTO_INCREMENT,
  `IdNivelTxN` int(3) NOT NULL,
  `IdTemaTxN` int(3) NOT NULL,
  `IdEstadoTxN` int(1) DEFAULT NULL,
  PRIMARY KEY (`IdTemaxNivel`,`IdNivelTxN`,`IdTemaTxN`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.temasxnivel: 19 rows
DELETE FROM `temasxnivel`;
/*!40000 ALTER TABLE `temasxnivel` DISABLE KEYS */;
INSERT INTO `temasxnivel` (`IdTemaxNivel`, `IdNivelTxN`, `IdTemaTxN`, `IdEstadoTxN`) VALUES
	(1, 1, 27, 1),
	(2, 1, 2, 1),
	(3, 1, 1, 1),
	(4, 6, 14, 1),
	(5, 6, 15, 1),
	(6, 6, 16, 1),
	(7, 7, 18, 1),
	(8, 7, 19, 1),
	(9, 7, 20, 1),
	(10, 2, 22, 1),
	(11, 2, 17, 1),
	(12, 2, 24, 1),
	(13, 5, 26, 1),
	(14, 5, 27, 1),
	(15, 5, 28, 1),
	(16, 3, 30, 1),
	(17, 3, 31, 1),
	(18, 3, 32, 1),
	(19, 1, 23, 1);
/*!40000 ALTER TABLE `temasxnivel` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.tipocar
DROP TABLE IF EXISTS `tipocar`;
CREATE TABLE IF NOT EXISTS `tipocar` (
  `IdTipoCar` int(2) NOT NULL AUTO_INCREMENT,
  `NombreTipoCar` varchar(255) DEFAULT NULL,
  `EstadoTipoCar` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`IdTipoCar`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.tipocar: 7 rows
DELETE FROM `tipocar`;
/*!40000 ALTER TABLE `tipocar` DISABLE KEYS */;
INSERT INTO `tipocar` (`IdTipoCar`, `NombreTipoCar`, `EstadoTipoCar`) VALUES
	(1, '1', '1'),
	(2, '2', '1'),
	(3, '3', '1'),
	(4, '4', '1'),
	(5, '5', '1'),
	(6, '6', '1'),
	(7, '7', '1');
/*!40000 ALTER TABLE `tipocar` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.tipodocumento
DROP TABLE IF EXISTS `tipodocumento`;
CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `IdTipoDocumento` int(2) NOT NULL AUTO_INCREMENT,
  `NombreTipoDocumento` varchar(50) DEFAULT NULL,
  `Estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`IdTipoDocumento`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.tipodocumento: 4 rows
DELETE FROM `tipodocumento`;
/*!40000 ALTER TABLE `tipodocumento` DISABLE KEYS */;
INSERT INTO `tipodocumento` (`IdTipoDocumento`, `NombreTipoDocumento`, `Estado`) VALUES
	(1, 'Cédula de Ciudadanía', 1),
	(2, 'Cédula de Extranjería', 1),
	(3, 'Tarjeta de Identidad', 1),
	(4, 'Nit', 1);
/*!40000 ALTER TABLE `tipodocumento` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.tipovehiculo
DROP TABLE IF EXISTS `tipovehiculo`;
CREATE TABLE IF NOT EXISTS `tipovehiculo` (
  `IdTipoVehiculo` int(2) NOT NULL AUTO_INCREMENT,
  `NombreTipoVehiculo` varchar(255) DEFAULT NULL,
  `EstadoTipoVehiculo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`IdTipoVehiculo`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.tipovehiculo: 8 rows
DELETE FROM `tipovehiculo`;
/*!40000 ALTER TABLE `tipovehiculo` DISABLE KEYS */;
INSERT INTO `tipovehiculo` (`IdTipoVehiculo`, `NombreTipoVehiculo`, `EstadoTipoVehiculo`) VALUES
	(1, 'Camioneta', '1'),
	(2, 'Camion', '1'),
	(3, 'Doble Troque', '1'),
	(4, 'Trailer', '1'),
	(5, 'Van', '1'),
	(6, 'MiniVan', '1'),
	(7, 'Bus', '1'),
	(8, 'Otro', '1');
/*!40000 ALTER TABLE `tipovehiculo` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.tipo_lista
DROP TABLE IF EXISTS `tipo_lista`;
CREATE TABLE IF NOT EXISTS `tipo_lista` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `nombre_tl` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre del Tipo de lista',
  `estado_tl` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'estado',
  `sigla` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Sigla del nombre',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.tipo_lista: 4 rows
DELETE FROM `tipo_lista`;
/*!40000 ALTER TABLE `tipo_lista` DISABLE KEYS */;
INSERT INTO `tipo_lista` (`id`, `nombre_tl`, `estado_tl`, `sigla`) VALUES
	(1, 'CRONOGRAMA', 'A', 'CRO'),
	(2, 'CAPACITACION', 'A', 'CAP'),
	(3, 'COMITE', 'A', 'COM'),
	(4, 'AUDITORIA', 'A', 'AUD');
/*!40000 ALTER TABLE `tipo_lista` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.transportadores
DROP TABLE IF EXISTS `transportadores`;
CREATE TABLE IF NOT EXISTS `transportadores` (
  `IdTransportador` int(4) NOT NULL AUTO_INCREMENT,
  `NombreTransportador` varchar(255) DEFAULT NULL,
  `ApellidosTransportador` varchar(255) DEFAULT NULL,
  `NitTransportador` varchar(20) DEFAULT NULL,
  `DireccionTransportador` varchar(89) DEFAULT NULL,
  `TelefonoTransportador` varchar(20) DEFAULT NULL,
  `CelularTransportador` varchar(20) DEFAULT NULL,
  `EmailTransportador` varchar(80) DEFAULT NULL,
  `IdCentroAcopio` int(3) DEFAULT NULL,
  `EstadoTransportador` varchar(1) DEFAULT NULL,
  `IdTipoDocumentoTransportador` int(2) DEFAULT NULL,
  PRIMARY KEY (`IdTransportador`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.transportadores: 59 rows
DELETE FROM `transportadores`;
/*!40000 ALTER TABLE `transportadores` DISABLE KEYS */;
INSERT INTO `transportadores` (`IdTransportador`, `NombreTransportador`, `ApellidosTransportador`, `NitTransportador`, `DireccionTransportador`, `TelefonoTransportador`, `CelularTransportador`, `EmailTransportador`, `IdCentroAcopio`, `EstadoTransportador`, `IdTipoDocumentoTransportador`) VALUES
	(1, 'LINA BETZABE LEON VARELA', NULL, '24694863', 'CRA 18 A 11 # 28 LA POPA', '3136459165', '3136459165', 'bet3004@hotmail.com', 1, '1', NULL),
	(2, 'MARIA DEL CARMEN ZAPATA ARROYAVE', NULL, '42014093', 'MZ 30 CS 5  POBLADO 2', '3406711', '3218302748', 'madecaza7@hotmail.com', 1, '1', NULL),
	(63, 'PRUEBA COTA', NULL, '12345', 'VVVV', '123', '344', 'EWEWE', 2, '1', NULL),
	(64, 'HUGO SUAREZ', NULL, '19357956', 'CLL48K SUR 4-92', '8777510', '3114802515', 'operaciones@logicexpress.co', 2, '1', NULL),
	(65, 'ALFONSO URREA', NULL, '80406649', 'CLL 9 1-17 TABIO ESTRELLA DEL NORTE', '8649519', '3124521883', 'alfonsourrea1975@gmail.com', 2, '1', NULL),
	(66, 'JOSE ALFREDO LOPEZ', NULL, '19220054', 'CALLE 1B N 82 - 46', '5711813', '3112394431', 'NO REGISTRA', 2, '1', NULL),
	(67, 'LUIS ARMANDO LINARES', NULL, '11186477', 'CL 4444', '4521886', '3124521886', 'NO REGISTRA', 2, '1', NULL),
	(68, 'JORGE ENRIQUE CORTES', NULL, '80192451', '-', '3142811807', '3142811807', '-', 2, '1', NULL),
	(69, 'NICOLAS OSA DIAZ', NULL, '15902076', 'CRA 18 A 11 # 28 LA POPA', '3137495519', '3137495519', 'NICOLOSSA@HOTMAIL.COM', 1, '1', NULL),
	(70, 'MAURICIO PALACIOS', NULL, '1111', 'QQ', 'QQQ', 'QQ', 'QQ', 4, '1', NULL),
	(73, 'ALEXANDER ALVAREZ', NULL, '79653163', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(74, 'ANCIZAR GIRALDO', NULL, '11251789', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(75, 'JOSE ANTONIO VALERO', NULL, '1032409907', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(81, 'RICARDO ACUNA', NULL, '79864047', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(84, 'RICARDO COGUA', NULL, '79363286', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(85, 'ALFREDO OVALLE', NULL, '79453604', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(86, 'PEDRO OJEDA', NULL, '19301109', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(87, 'JHON DUARTE', NULL, '1023878762', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(88, 'HECTOR BETANCOURT', NULL, '79448691', 'CRA 69 H 78 47', '3099666', '3165292596', 'TR.EXPRESS2008@HOTMAIL.COM', 4, '1', NULL),
	(89, 'luis alfonzo calderon silva', NULL, '13352562', '1', '1', '1', '1', 4, '1', NULL),
	(90, 'peter jesus becerra villamizar', NULL, '13462518', '1', '1', '1', '1', 4, '1', NULL),
	(91, 'jose vargas galvis', NULL, '88227074', '3', '3', '3', '3', 4, '1', NULL),
	(92, 'juan erazmo sanchez', NULL, '1090404779', '4', '4', '4', '4', 4, '1', NULL),
	(93, 'andres vargas', NULL, '1093792827', '5', '5', '5', '5', 4, '1', NULL),
	(94, 'adan agudelo', NULL, '5938568', '6', '6', '6', '6', 4, '1', NULL),
	(95, 'jose pastor rodriguez', NULL, '18933250', 'v', 'v', 'v', 'v', 4, '1', NULL),
	(96, 'alvaro enrique ramirez pabon', NULL, '13488227', 'p', 'p', 'p', 'p', 4, '1', NULL),
	(97, 'carmelita rosas', NULL, '37342562', 'Z', 'Z', 'Z', 'P', 4, '1', NULL),
	(98, 'ADRIAN VARGAS', NULL, '79525908', 'CRA 69 H 78 47', '3099666', '3165292596', 'TR.EXPRESS2008@HOTMAIL.COM', 4, '1', NULL),
	(99, 'SUSANA MARIN', NULL, '51643116', 'CRA 69 H 78 47', '3099666', '3165292596', 'TR.EXPRESS2008@HOTMAIL.COM', 4, '1', NULL),
	(100, 'ELIECER ACUNA', NULL, '80018719', 'CRA 69 H 78 47', '3099666', '3165292596', 'TR.EXPRESS2008@HOTMAIL.COM', 4, '1', NULL),
	(101, 'maria eugenia ramirez', NULL, '28053387', 'q', 'q', 'q', 'q', 4, '1', NULL),
	(102, 'sandra patricia caselles', NULL, '52900933', 'b', 'b', 'b', 'b', 4, '1', NULL),
	(103, 'FREDY RUIZ', NULL, '19336101', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(104, 'MARIA MALAVER', NULL, '51572194', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(105, 'ORLANDO ACOSTA', NULL, '17311823', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(106, 'LUIS CARLOS PINEROS', NULL, '19347601', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(107, 'ALFREDO CALDERON', NULL, '17192777', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(108, 'HELI DUARTE', NULL, '79559603', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(109, 'MARIO RAMIREZ', NULL, '16650322', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(110, 'OLIVERIO', NULL, '111111', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(111, 'CRISTIAN GONZALEZ', NULL, '333333', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(112, 'ELIECER PULIDO', NULL, '755345', '45:00:00', '3099666', '3166222126', 'TR.EXPRESS2008@HOTMAIL.COM', 4, '1', NULL),
	(113, 'ALBALUZ', NULL, '8654', '645', '3099666', '3166222126', 'Tggh', 4, '1', NULL),
	(114, 'HUGO SUAREZ TR', NULL, '44444', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(115, 'JEISSON PINEROS', NULL, '66666', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(116, 'JORGE ARDILA', NULL, '79187802', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(117, 'RUBEN NINO', NULL, '11250761', 'Cra 69H # 78-47 Las Ferias', '3099666', '3166222126', 'tr.express2008@hotmail.com', 4, '1', NULL),
	(118, 'hernando', NULL, '0', '0', '0', '0', '0', 4, '1', NULL),
	(119, 'ADRIANO DIAZ', NULL, '91014804', '444', '212', '44', '444', 4, '1', NULL),
	(120, 'DIANA BALLESTEROS', NULL, '30206597', 'BARBOSA', '3206508999', '3206508999', 'Y', 4, '1', NULL),
	(121, 'DIEGO BOLIVAR', NULL, '1049613139', 'Y', '3193158431', '3193158431', 'Y', 4, '1', NULL),
	(122, 'LUDY PENA', NULL, '1018440866', 'Y', '321232670', '321232670', 'Y', 4, '1', NULL),
	(123, 'WILMER BECERRA', NULL, '74381871', 'Y', '3112203441', '3112203441', 'Y', 4, '1', NULL),
	(124, 'ESPERANZA OBREGON', NULL, '181818', 'JJKJ', '77', 'JKJ', 'JKJ', 4, '1', NULL),
	(125, 'Pruebas', NULL, '23544444', 'fgfg', '5543535', 'gfgdf', 'dffd', 5, '1', NULL),
	(126, 'Pruebas Velotax', NULL, '1010170', 'cl 33443', '3122', '75776', 'huhhbn', 5, '1', NULL),
	(127, 'MARIO CANON', NULL, '9002600830', '0', '0', '0', '0', 4, '1', NULL),
	(128, 'Leidy Acuna', NULL, '45678', 'Hhvycg', 'Hhggg', '3166222126', 'Ghhchb', 4, '1', NULL);
/*!40000 ALTER TABLE `transportadores` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.un_control
DROP TABLE IF EXISTS `un_control`;
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

-- Volcando estructura para tabla movilweb.usu_usuario
DROP TABLE IF EXISTS `usu_usuario`;
CREATE TABLE IF NOT EXISTS `usu_usuario` (
  `USU_IdUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del Usuario',
  `USU_TipoDocumento` tinyint(4) NOT NULL COMMENT 'Tipo Documento Identificacion',
  `USU_Identificacion` char(20) NOT NULL COMMENT 'Nro de Identificacion',
  `USU_PrimerApellido` char(30) NOT NULL COMMENT 'Primer Apellido',
  `USU_SegundoApellido` char(30) NOT NULL COMMENT 'Segundo Apellido',
  `USU_Nombre` char(30) NOT NULL COMMENT 'Nombre(s) ',
  `USU_Email` char(80) NOT NULL COMMENT 'Email',
  `USU_Direccion` varchar(250) NOT NULL COMMENT 'Dirección de residencia del usuario',
  `USU_Celular` char(20) NOT NULL COMMENT 'Nro Celular',
  `USU_Usuario` char(40) NOT NULL COMMENT 'Usuario o Login',
  `USU_Clave` char(80) NOT NULL COMMENT 'Clave o Contraseña',
  `USU_TipoUsuario` tinyint(4) NOT NULL COMMENT 'Tipo de Usuario',
  `USU_Estado` tinyint(4) NOT NULL COMMENT 'Estado del Usuario',
  `USU_FechaCreado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la cual fue Creado',
  `USU_UsuarioCrea` int(11) NOT NULL COMMENT 'Usuario que creo.',
  `USU_FechaModificado` datetime NOT NULL COMMENT 'Fecha en la cual fue Modificado',
  `USU_UsuarioModifica` int(11) NOT NULL COMMENT 'Usuario que realiza la Modifica',
  `USU_FechaEstado` datetime NOT NULL COMMENT 'Fecha en la cual cambio de Estado el usuario',
  `USU_UsuarioEstado` int(11) NOT NULL COMMENT 'Usuario que cambio el estado de otro usuario',
  `USU_IdInterno` double NOT NULL COMMENT 'Id Control Interno',
  `USU_Local` double NOT NULL COMMENT 'Id Control Interno Cliente',
  PRIMARY KEY (`USU_IdUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='Información general del Usuario.';

-- Volcando datos para la tabla movilweb.usu_usuario: 7 rows
DELETE FROM `usu_usuario`;
/*!40000 ALTER TABLE `usu_usuario` DISABLE KEYS */;
INSERT INTO `usu_usuario` (`USU_IdUsuario`, `USU_TipoDocumento`, `USU_Identificacion`, `USU_PrimerApellido`, `USU_SegundoApellido`, `USU_Nombre`, `USU_Email`, `USU_Direccion`, `USU_Celular`, `USU_Usuario`, `USU_Clave`, `USU_TipoUsuario`, `USU_Estado`, `USU_FechaCreado`, `USU_UsuarioCrea`, `USU_FechaModificado`, `USU_UsuarioModifica`, `USU_FechaEstado`, `USU_UsuarioEstado`, `USU_IdInterno`, `USU_Local`) VALUES
	(6, 1, '79243925', 'Sánchez', 'Sierra', 'Mauricio', 'msmakesof@gmail.com', 'calle 153', '3142674416', 'msmakesof@gmail.com', 'ZmRjWFBsNlRIZllWNDV2b2tuL0ZsZz09', 1, 1, '2018-07-21 20:11:44', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 32215295, 562198784),
	(8, 1, '1112233', 'sanchez', 'serra', 'azul', 'azul@gmail.com', 'calle 35 No. 50 - 11', '3424324234', 'azul@gmail.com', 'ZmRjWFBsNlRIZllWNDV2b2tuL0ZsZz09', 3, 1, '2018-07-22 12:14:03', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 324905088, 998640170),
	(10, 2, '23456', 'diaz', 'bietti', 'carlo luigi', 'carlo@gmail.com', 'avenida 15 No. 102 - 10', '90909090', 'carlo@gmail.com', 'bWdLR3RXUjJ6UzF3emtqdS80TnhnQT09', 3, 1, '2018-07-22 17:26:03', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 57322030, 181720353),
	(11, 3, '1478520855', 'Sanchez', 'G', 'Juanita', 'juanita@gmail.com', 'Carrera 15 No. 123 - 14', '854168885', 'juanita@gmail.com', 'bFVzb3VtOGw3L0FnZmR4a0c1RFFwdz09', 1, 1, '2018-07-22 17:28:30', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 221301135, 1395779771),
	(12, 1, '79693184', 'ruiz', 'lozano', 'john', 'joruiz75@hotmail.com', 'tran 69b 9d 40', '3102531834', 'joruiz75@hotmail.com', 'UHhab3hHQVI4QTM3V3hrR2VvOTZpUT09', 1, 1, '2018-07-24 21:37:11', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 65841661, 1502306766),
	(13, 1, '87686767', 'SANCHEZ', 'SIERRA', 'HAROLD', 'hsanchez@mail.com', 'carrera 95B', '54345345', 'hsanchez@mail.com', 'ZmRjWFBsNlRIZllWNDV2b2tuL0ZsZz09', 2, 1, '2018-08-12 00:05:22', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 134665052, 1245480922),
	(14, 2, '675678', 'TAVERA', '', 'HORACIO', 'HTAVERA@gmail.com', 'calle 25 No. 33 - 25', '56544564', 'HTAVERA@gmail.com', 'ZmRjWFBsNlRIZllWNDV2b2tuL0ZsZz09', 3, 2, '2018-08-20 17:16:14', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 246312679, 1202463754);
/*!40000 ALTER TABLE `usu_usuario` ENABLE KEYS */;

-- Volcando estructura para tabla movilweb.vehiculos
DROP TABLE IF EXISTS `vehiculos`;
CREATE TABLE IF NOT EXISTS `vehiculos` (
  `IdVehiculo` int(4) NOT NULL AUTO_INCREMENT,
  `Placa` varchar(8) DEFAULT NULL,
  `IdTransportador` int(4) DEFAULT NULL,
  `IdConductor` int(3) DEFAULT NULL,
  `Modelo` varchar(4) DEFAULT NULL,
  `IdTipoVehiculo` int(4) DEFAULT NULL,
  `IdTipoCar` int(2) DEFAULT NULL,
  `CantidadPedidos` int(4) DEFAULT NULL,
  `fechavenceseguro` date DEFAULT NULL,
  `ddfechaSeguro` varchar(2) DEFAULT NULL,
  `mmfechaSeguro` varchar(2) DEFAULT NULL,
  `yyfechaSeguro` varchar(4) DEFAULT NULL,
  `fechavencetecnica` date DEFAULT NULL,
  `ddfechaVenceTecnomec` varchar(2) DEFAULT NULL,
  `mmfechaVenceTecnomec` varchar(2) DEFAULT NULL,
  `yyfechaVenceTecnomec` varchar(4) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `IdCentroAcopio` int(3) DEFAULT NULL,
  `EstadoVehiculo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`IdVehiculo`)
) ENGINE=MyISAM AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla movilweb.vehiculos: 78 rows
DELETE FROM `vehiculos`;
/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
INSERT INTO `vehiculos` (`IdVehiculo`, `Placa`, `IdTransportador`, `IdConductor`, `Modelo`, `IdTipoVehiculo`, `IdTipoCar`, `CantidadPedidos`, `fechavenceseguro`, `ddfechaSeguro`, `mmfechaSeguro`, `yyfechaSeguro`, `fechavencetecnica`, `ddfechaVenceTecnomec`, `mmfechaVenceTecnomec`, `yyfechaVenceTecnomec`, `clave`, `IdCentroAcopio`, `EstadoVehiculo`) VALUES
	(1, 'PFJ978', 1, 1, '2008', 6, 6, 30, '2017-03-18', NULL, NULL, NULL, '2016-06-25', NULL, NULL, NULL, '1234', 0, '1'),
	(2, 'PEB656', 1, 2, '1991', 4, 2, 250, '2016-05-02', NULL, NULL, NULL, '2016-04-06', NULL, NULL, NULL, '1234', 0, '1'),
	(3, 'MAL885', 1, 4, '1993', 4, 2, 300, '2016-10-28', NULL, NULL, NULL, '2016-11-13', NULL, NULL, NULL, '1234', 0, '1'),
	(4, 'SXD938', 1, 5, '2011', 4, 2, 300, '2016-09-07', NULL, NULL, NULL, '2016-09-02', NULL, NULL, NULL, '1234', 0, '1'),
	(5, 'DOA713', 1, 3, '1997', 4, 2, 300, '2017-01-04', NULL, NULL, NULL, '2016-07-10', NULL, NULL, NULL, '1234', 0, '1'),
	(6, 'OAV', 1, 6, '2012', 5, 6, 20, '2016-04-18', NULL, NULL, NULL, '2016-04-18', NULL, NULL, NULL, '1234', 0, '1'),
	(7, 'PEI441', 2, 7, '1995', 4, 2, 250, '2016-11-24', NULL, NULL, NULL, '2016-11-27', NULL, NULL, NULL, '1234', 0, '1'),
	(8, 'SJI257', 2, 10, '2008', 4, 2, 300, '2016-06-03', NULL, NULL, NULL, '2016-06-03', NULL, NULL, NULL, '1234', 0, '1'),
	(9, 'WHK278', 2, 9, '2003', 4, 2, 300, '2016-11-03', NULL, NULL, NULL, '2017-02-17', NULL, NULL, NULL, '1234', 0, '1'),
	(10, 'UQG496', 2, 11, '1994', 4, 2, 300, '2016-09-23', NULL, NULL, NULL, '2016-08-24', NULL, NULL, NULL, '1234', 0, '1'),
	(11, 'PED420', 2, 8, '1993', 4, 2, 250, '2016-08-08', NULL, NULL, NULL, '2016-04-29', NULL, NULL, NULL, '1234', 0, '1'),
	(12, 'IGP844', 2, 7, '2016', 6, 6, 35, '2016-01-18', NULL, NULL, NULL, '2016-03-18', NULL, NULL, NULL, '1234', 0, '1'),
	(13, 'MAQ160', 1, 12, '1996', 4, 2, 300, '2016-04-05', NULL, NULL, NULL, '2016-05-11', NULL, NULL, NULL, '1234', 0, '1'),
	(85, 'WLB981', 1, 89, '2012', 4, 2, 200, '2016-07-17', NULL, NULL, NULL, '2016-07-14', NULL, NULL, NULL, '1234', 0, '1'),
	(86, 'AAA000', 63, 100, '2222', 4, 1, 123, '2016-05-13', NULL, NULL, NULL, '2016-05-20', NULL, NULL, NULL, '1234', 0, '1'),
	(88, 'SWL208', 64, 92, '2007', 3, 1, 300, '2016-12-23', NULL, NULL, NULL, '2016-09-05', NULL, NULL, NULL, '1234', 0, '1'),
	(90, 'ZSX356', 64, 93, '2013', 3, 1, 300, '2016-09-24', NULL, NULL, NULL, '2016-10-16', NULL, NULL, NULL, '1234', 0, '1'),
	(91, 'WDC785', 65, 94, '2016', 3, 1, 300, '2017-03-22', NULL, NULL, NULL, '2017-03-22', NULL, NULL, NULL, '1234', 0, '1'),
	(92, 'TLN449', 66, 95, '2012', 7, 4, 120, '2016-06-25', NULL, NULL, NULL, '2016-07-01', NULL, NULL, NULL, '1234', 0, '1'),
	(93, 'TFT823', 67, 96, '2012', 3, 1, 2012, '2016-05-20', NULL, NULL, NULL, '2016-04-15', NULL, NULL, NULL, '1234', 0, '1'),
	(94, 'WFV394', 68, 97, '2015', 3, 1, 1000, '2016-04-04', NULL, NULL, NULL, '2016-04-12', NULL, NULL, NULL, '1234', 0, '1'),
	(95, 'PFV921', 1, 99, '2011', 4, 2, 200, '2016-07-04', NULL, NULL, NULL, '2016-08-04', NULL, NULL, NULL, '1234', 0, '1'),
	(96, 'NAB704', 1, 101, '1999', 4, 2, 200, '2017-04-24', NULL, NULL, NULL, '2017-02-12', NULL, NULL, NULL, '1234', 0, '1'),
	(97, 'BNT878', 64, 92, '2222', 1, 2, 666, '2016-06-02', NULL, NULL, NULL, '2016-07-21', NULL, NULL, NULL, '1234', 0, '1'),
	(99, 'ASD133', 65, 94, '2222', 1, 2, 222, '2016-09-03', NULL, NULL, NULL, '2016-09-22', NULL, NULL, NULL, '1234', 0, '1'),
	(103, 'BEG013', 73, 108, '2009', 4, 1, 180, '2017-08-23', NULL, NULL, NULL, '2017-08-23', NULL, NULL, NULL, '1234', 0, '1'),
	(104, 'AQF905', 74, 109, '2009', 4, 1, 180, '2017-08-23', NULL, NULL, NULL, '2017-08-23', NULL, NULL, NULL, '1234', 0, '1'),
	(106, 'BDQ032', 81, 111, '1994', 4, 1, 190, '2017-08-23', NULL, NULL, NULL, '2017-08-23', NULL, NULL, NULL, '1234', 0, '1'),
	(115, 'SXW963', 84, 119, '2012', 3, 1, 320, '2017-08-24', NULL, NULL, NULL, '2017-08-24', NULL, NULL, NULL, '1234', 0, '1'),
	(117, 'GLC794', 86, 121, '2009', 4, 1, 210, '2017-08-24', NULL, NULL, NULL, '2017-08-24', NULL, NULL, NULL, '1234', 0, '1'),
	(118, 'WNQ934', 87, 122, '2016', 3, 1, 280, '2017-07-24', NULL, NULL, NULL, '2017-07-24', NULL, NULL, NULL, '1234', 0, '1'),
	(119, 'TPY805', 88, 123, '2009', 4, 1, 130, '2017-11-15', NULL, NULL, NULL, '2017-06-07', NULL, NULL, NULL, '1234', 0, '1'),
	(120, 'VFD848', 98, 133, '2014', 7, 1, 120, '2017-11-09', NULL, NULL, NULL, '2017-11-10', NULL, NULL, NULL, '1234', 0, '1'),
	(121, 'AOE360', 70, 102, '1983', 3, 1, 280, '2017-11-15', NULL, NULL, NULL, '2018-11-13', NULL, NULL, NULL, '1234', 0, '1'),
	(122, 'CUC089', 90, 124, '2009', 7, 4, 200, '2016-09-25', NULL, NULL, NULL, '2016-09-25', NULL, NULL, NULL, '1234', 0, '1'),
	(123, 'THZ112', 89, 125, '2014', 4, 2, 200, '2016-09-25', NULL, NULL, NULL, '2016-09-25', NULL, NULL, NULL, '1234', 0, '1'),
	(124, 'TJN747', 91, 126, '2012', 7, 4, 200, '2016-09-25', NULL, NULL, NULL, '2016-09-25', NULL, NULL, NULL, '1234', 0, '1'),
	(125, 'XLL007', 92, 127, '2002', 4, 2, 200, '2016-09-30', NULL, NULL, NULL, '2016-09-30', NULL, NULL, NULL, '1234', 0, '1'),
	(126, 'CIF705', 99, 134, '1994', 4, 1, 150, '2017-09-13', NULL, NULL, NULL, '2017-07-04', NULL, NULL, NULL, '1234', 0, '1'),
	(127, 'CEK813', 93, 128, '1996', 7, 4, 200, '2016-09-25', NULL, NULL, NULL, '2016-09-25', NULL, NULL, NULL, '1234', 0, '1'),
	(128, 'TLA102', 94, 129, '2007', 4, 2, 200, '2016-09-29', NULL, NULL, NULL, '2016-09-29', NULL, NULL, NULL, '1234', 0, '1'),
	(129, 'TTL263', 95, 130, '2012', 4, 2, 200, '2016-09-30', NULL, NULL, NULL, '2016-09-30', NULL, NULL, NULL, '1234', 0, '1'),
	(130, 'BUZ147', 96, 131, '1999', 4, 2, 200, '2016-09-30', NULL, NULL, NULL, '2016-09-30', NULL, NULL, NULL, '1234', 0, '1'),
	(131, 'ZIB180', 97, 132, '1990', 4, 2, 200, '2016-09-25', NULL, NULL, NULL, '2016-09-25', NULL, NULL, NULL, '1234', 0, '1'),
	(132, 'BIO248', 100, 135, '1997', 4, 1, 150, '2017-07-10', NULL, NULL, NULL, '2017-07-04', NULL, NULL, NULL, '1234', 0, '1'),
	(133, 'CCU824', 101, 136, '2011', 4, 2, 200, '2016-09-25', NULL, NULL, NULL, '2016-09-25', NULL, NULL, NULL, '1234', 0, '1'),
	(134, 'AN3U96', 102, 138, '2011', 5, 5, 200, '2016-09-30', NULL, NULL, NULL, '2016-09-30', NULL, NULL, NULL, '1234', 0, '1'),
	(135, 'FEB242', 103, 139, '2009', 4, 1, 180, '2017-08-26', NULL, NULL, NULL, '2017-08-26', NULL, NULL, NULL, '1234', 0, '1'),
	(136, 'UPT216', 104, 140, '2012', 4, 1, 180, '2017-08-26', NULL, NULL, NULL, '2017-08-26', NULL, NULL, NULL, '1234', 0, '1'),
	(137, 'COA660', 105, 141, '2009', 6, 1, 120, '2017-08-26', NULL, NULL, NULL, '2017-08-26', NULL, NULL, NULL, '1234', 0, '1'),
	(138, 'SXX554', 106, 142, '2012', 7, 1, 110, '2017-08-26', NULL, NULL, NULL, '2017-08-26', NULL, NULL, NULL, '1234', 0, '1'),
	(139, 'UPO812', 107, 143, '2012', 7, 1, 120, '2017-08-26', NULL, NULL, NULL, '2017-08-26', NULL, NULL, NULL, '1234', 0, '1'),
	(140, 'SPO030', 108, 144, '2012', 4, 1, 180, '2017-08-27', NULL, NULL, NULL, '2017-08-27', NULL, NULL, NULL, '1234', 0, '1'),
	(141, 'UFR861', 109, 145, '2012', 7, 4, 80, '2017-08-27', NULL, NULL, NULL, '2017-08-27', NULL, NULL, NULL, '1234', 0, '1'),
	(142, 'LAB814', 110, 146, '2009', 3, 1, 280, '2017-08-28', NULL, NULL, NULL, '2017-08-28', NULL, NULL, NULL, '1234', 0, '1'),
	(143, 'UCI202', 111, 147, '2012', 4, 1, 110, '2017-08-28', NULL, NULL, NULL, '2017-08-28', NULL, NULL, NULL, '1234', 0, '1'),
	(145, 'ATA953', 113, 149, '2012', 4, 1, 120, '2017-08-28', NULL, NULL, NULL, '2017-08-28', NULL, NULL, NULL, '1234', 0, '1'),
	(149, 'COR002', 114, 151, '2012', 3, 1, 310, '2017-07-28', NULL, NULL, NULL, '2017-07-28', NULL, NULL, NULL, '1234', 0, '1'),
	(150, 'AOR312', 115, 152, '2012', 3, 1, 320, '2017-06-28', NULL, NULL, NULL, '2017-03-28', NULL, NULL, NULL, '1234', 0, '1'),
	(151, 'TTY845', 112, 148, '2012', 4, 1, 140, '2017-06-05', NULL, NULL, NULL, '2017-05-05', NULL, NULL, NULL, '1234', 0, '1'),
	(153, 'SZY273', 75, 110, '2012', 3, 1, 320, '2017-08-08', NULL, NULL, NULL, '2017-07-08', NULL, NULL, NULL, '1234', 0, '1'),
	(154, 'SMN738', 85, 120, '2012', 4, 1, 140, '2017-05-11', NULL, NULL, NULL, '2017-05-11', NULL, NULL, NULL, '1234', 0, '1'),
	(155, 'TLY906', 116, 153, '2012', 4, 1, 210, '2017-04-14', NULL, NULL, NULL, '2017-05-14', NULL, NULL, NULL, '1234', 0, '1'),
	(156, 'VEL207', 117, 154, '2012', 4, 1, 210, '2017-05-15', NULL, NULL, NULL, '2017-06-15', NULL, NULL, NULL, '1234', 0, '1'),
	(157, 'SWK002', 118, 155, '0', 7, 4, 200, '2017-02-01', NULL, NULL, NULL, '2017-02-01', NULL, NULL, NULL, '1234', 0, '1'),
	(158, 'CIM289', 119, 156, '1998', 4, 1, 1111, '2016-10-20', NULL, NULL, NULL, '2016-10-21', NULL, NULL, NULL, '1234', 0, '1'),
	(160, 'BCS709', 120, 159, '1993', 4, 4, 200, '2016-10-22', NULL, NULL, NULL, '2016-10-23', NULL, NULL, NULL, '1234', 0, '1'),
	(161, 'WLN563', 121, 158, '1998', 4, 1, 100, '2016-10-22', NULL, NULL, NULL, '2016-10-23', NULL, NULL, NULL, '1234', 0, '1'),
	(162, 'DUA079', 122, 160, '1999', 6, 1, 1111, '2016-10-23', NULL, NULL, NULL, '2016-10-24', NULL, NULL, NULL, '1234', 0, '1'),
	(163, 'ARB832', 123, 161, '1999', 4, 4, 1111, '2016-10-23', NULL, NULL, NULL, '2016-10-24', NULL, NULL, NULL, '1234', 0, '1'),
	(164, 'IXJ971', 124, 162, '2000', 7, 4, 200, '2017-02-01', NULL, NULL, NULL, '2017-02-01', NULL, NULL, NULL, '1234', 0, '1'),
	(165, 'ZTA146', 123, 163, '1998', 6, 1, 1000, '2016-11-13', NULL, NULL, NULL, '2016-11-16', NULL, NULL, NULL, '1234', 0, '1'),
	(166, '120', 105, 0, '4343', 5, 7, 3242, '2016-11-04', NULL, NULL, NULL, '2016-11-18', NULL, NULL, NULL, '1234', 66, '1'),
	(167, 'VCG464', 126, 165, '8989', 1, 1, 3233, '2016-11-08', NULL, NULL, NULL, '2016-11-16', NULL, NULL, NULL, '1234', 0, '1'),
	(168, 'VEE307', 127, 166, '777', 7, 1, 6666, '2018-06-01', NULL, NULL, NULL, '2018-06-01', NULL, NULL, NULL, '1234', 0, '1'),
	(169, 'UCI203', 128, 167, '0', 3, 1, 400, '2018-06-01', NULL, NULL, NULL, '2018-06-01', NULL, NULL, NULL, '1234', 0, '1'),
	(170, 'mks777', 64, 92, '2016', 5, 7, 1333, '0000-00-00', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, '', 13, '1'),
	(171, 'mks077', 87, 122, '2015', 1, 7, 1444, '0000-00-00', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, '', 10, '1');
/*!40000 ALTER TABLE `vehiculos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
