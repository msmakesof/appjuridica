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
DROP DATABASE IF EXISTS `appjudicial`;
CREATE DATABASE IF NOT EXISTS `appjudicial` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `appjudicial`;

-- Volcando estructura para tabla appjudicial.aud_logauditoria
DROP TABLE IF EXISTS `aud_logauditoria`;
CREATE TABLE IF NOT EXISTS `aud_logauditoria` (
  `AUD_IdLog` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `AUD_Accion` mediumtext COMMENT 'Accion registrada en el sistema',
  `AUD_FechaHora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y Hora de la realización de la acción.',
  `AUD_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`AUD_IdLog`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Log de Auditoria';

-- Volcando datos para la tabla appjudicial.aud_logauditoria: 0 rows
DELETE FROM `aud_logauditoria`;
/*!40000 ALTER TABLE `aud_logauditoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `aud_logauditoria` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.cli_cliente
DROP TABLE IF EXISTS `cli_cliente`;
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

-- Volcando estructura para tabla appjudicial.cli_tipocliente
DROP TABLE IF EXISTS `cli_tipocliente`;
CREATE TABLE IF NOT EXISTS `cli_tipocliente` (
  `TCL_IdTipoCliente` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id de control',
  `TCL_Nombre` varchar(50) NOT NULL COMMENT 'Nombre o descripcion',
  `TCL_Estado` tinyint(4) NOT NULL COMMENT 'Estado del cliente (Activo/Inactivo)',
  PRIMARY KEY (`TCL_IdTipoCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Tipo de Cliente.';

-- Volcando datos para la tabla appjudicial.cli_tipocliente: 2 rows
DELETE FROM `cli_tipocliente`;
/*!40000 ALTER TABLE `cli_tipocliente` DISABLE KEYS */;
INSERT INTO `cli_tipocliente` (`TCL_IdTipoCliente`, `TCL_Nombre`, `TCL_Estado`) VALUES
	(2, 'DEMANDANTE', 1),
	(3, 'DEMANDADO', 1);
/*!40000 ALTER TABLE `cli_tipocliente` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_ciudad
DROP TABLE IF EXISTS `gen_ciudad`;
CREATE TABLE IF NOT EXISTS `gen_ciudad` (
  `CIU_IdCiudades` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id control',
  `CIU_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `CIU_Abreviatura` char(4) NOT NULL COMMENT 'Abreviatura',
  `CIU_IdDepartamento` smallint(6) NOT NULL COMMENT 'Departamento donde se encuentra ubicada.',
  `CIU_Estado` tinyint(4) NOT NULL COMMENT 'Estado (Activo/Inactivo)',
  PRIMARY KEY (`CIU_IdCiudades`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='información de la Ciudad.';

-- Volcando datos para la tabla appjudicial.gen_ciudad: 11 rows
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

-- Volcando estructura para tabla appjudicial.gen_configuracion
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

-- Volcando datos para la tabla appjudicial.gen_configuracion: 1 rows
DELETE FROM `gen_configuracion`;
/*!40000 ALTER TABLE `gen_configuracion` DISABLE KEYS */;
INSERT INTO `gen_configuracion` (`CON_IdConfiguracion`, `CON_TituloApp`, `CON_Logo`, `CON_Version`, `CON_Derechos`, `CON_Empresa`, `CON_Estado`) VALUES
	(1, 'Dependiente Judicial.', 'images/logojur.jpg', '1.0.0', '&copy; 2017', 'AppJuridica', 1);
/*!40000 ALTER TABLE `gen_configuracion` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_control
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

-- Volcando datos para la tabla appjudicial.gen_control: 1 rows
DELETE FROM `gen_control`;
/*!40000 ALTER TABLE `gen_control` DISABLE KEYS */;
INSERT INTO `gen_control` (`CON_IdControl`, `CON_LlaveAcceso`, `CON_IdEstado`, `CON_LlaveInicial`, `CON_LlaveIv`, `CON_MetodoEncriptacion`, `CON_TipoHash`, `CON_Cookie`) VALUES
	(1, 'V14l1br390$MKS-395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60c5b8', 1, '92AE31A79FEEB2A3\'muni\'', '395f426c0e5bd914375837483b791d80854dd9a19dd86fd189', 'AES-256-CBC', 'sha256', 'Pharametrykham');
/*!40000 ALTER TABLE `gen_control` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_departamento
DROP TABLE IF EXISTS `gen_departamento`;
CREATE TABLE IF NOT EXISTS `gen_departamento` (
  `DEP_IdDepartamento` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id Control.',
  `DEP_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `DEP_Pais` smallint(6) NOT NULL COMMENT 'Id del Pais al cual pertenece el Departamento.',
  `DEP_Estado` tinyint(4) NOT NULL COMMENT 'Estado Ativo/Inactivo.',
  `DEP_CodigoDane` char(2) DEFAULT NULL COMMENT 'Código Dane del Departamento, esto para la composicion del numero del Proceso',
  PRIMARY KEY (`DEP_IdDepartamento`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='información general del Departamento.';

-- Volcando datos para la tabla appjudicial.gen_departamento: 33 rows
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

-- Volcando estructura para tabla appjudicial.gen_estado
DROP TABLE IF EXISTS `gen_estado`;
CREATE TABLE IF NOT EXISTS `gen_estado` (
  `EST_IdEstado` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `EST_Abreviatura` char(1) NOT NULL COMMENT 'Abreviatura A=Activo, I=Inactivo',
  `EST_Nombre` char(20) NOT NULL COMMENT 'Nombre',
  PRIMARY KEY (`EST_IdEstado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Estado para uso general (Activo/Inactivo).';

-- Volcando datos para la tabla appjudicial.gen_estado: 0 rows
DELETE FROM `gen_estado`;
/*!40000 ALTER TABLE `gen_estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `gen_estado` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_festivo
DROP TABLE IF EXISTS `gen_festivo`;
CREATE TABLE IF NOT EXISTS `gen_festivo` (
  `FES_IdFestivo` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id de Control',
  `FES_Festivo` char(50) DEFAULT NULL COMMENT 'Dia Festivo',
  `FES_VanciaJudicial` char(1) NOT NULL COMMENT 'Paramarcar si el dia se contempla como Vancia Judicial, los dias que los juzgados no prestan servicio.',
  `FES_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo/Inactivo',
  PRIMARY KEY (`FES_IdFestivo`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Relaciona los dias Festivo por año.';

-- Volcando datos para la tabla appjudicial.gen_festivo: 6 rows
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

-- Volcando estructura para tabla appjudicial.gen_grupo
DROP TABLE IF EXISTS `gen_grupo`;
CREATE TABLE IF NOT EXISTS `gen_grupo` (
  `GRU_IdGrupo` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Grupo',
  `GRU_Nombre` char(50) DEFAULT '0' COMMENT 'Nombre del Grupo',
  `GRU_Estado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`GRU_IdGrupo`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Clasificacion por Grupos para el menu';

-- Volcando datos para la tabla appjudicial.gen_grupo: 5 rows
DELETE FROM `gen_grupo`;
/*!40000 ALTER TABLE `gen_grupo` DISABLE KEYS */;
INSERT INTO `gen_grupo` (`GRU_IdGrupo`, `GRU_Nombre`, `GRU_Estado`) VALUES
	(1, 'GENERAL', 1),
	(3, 'CLIENTE', 1),
	(4, 'JUZGADO', 1),
	(5, 'PROCESO', 1),
	(6, 'USUARIO', 1);
/*!40000 ALTER TABLE `gen_grupo` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_pais
DROP TABLE IF EXISTS `gen_pais`;
CREATE TABLE IF NOT EXISTS `gen_pais` (
  `PAI_IdPais` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `PAI_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre del Pais.',
  `PAI_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado Activo/Inactivo.',
  PRIMARY KEY (`PAI_IdPais`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='informacion del Pais al cual pertenece un Departamento.';

-- Volcando datos para la tabla appjudicial.gen_pais: 1 rows
DELETE FROM `gen_pais`;
/*!40000 ALTER TABLE `gen_pais` DISABLE KEYS */;
INSERT INTO `gen_pais` (`PAI_IdPais`, `PAI_Nombre`, `PAI_Estado`) VALUES
	(1, 'COLOMBIA', 1);
/*!40000 ALTER TABLE `gen_pais` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_tabla
DROP TABLE IF EXISTS `gen_tabla`;
CREATE TABLE IF NOT EXISTS `gen_tabla` (
  `TAB_IdTabla` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id control',
  `TAB_Nombre_Tabla` char(50) NOT NULL COMMENT 'Nombre',
  `TAB_NombreMostrar` char(50) NOT NULL COMMENT 'Nombre a Mostrar',
  `TAB_Grupo` tinyint(4) NOT NULL,
  `TAB_IdEstadoTabla` tinyint(4) NOT NULL COMMENT 'Estado',
  PRIMARY KEY (`TAB_IdTabla`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='Tablas del sistema';

-- Volcando datos para la tabla appjudicial.gen_tabla: 21 rows
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
	(21, 'juz_area', 'AREA', 4, 1),
	(22, 'juz_piso', 'PISO', 4, 1),
	(23, 'juz_tipojuzgado', 'TIPO JUZGADO', 4, 1),
	(24, 'gen_tipopersona', 'TIPO PERSONA', 1, 1),
	(25, 'usu_tipousuario', 'TIPO USUARIO', 6, 1),
	(26, 'juzgado', 'JUZGADO', 4, 1),
	(27, 'gen_grupo', 'GRUPO', 0, 1),
	(28, 'pro_ubicacion', 'UBICACIÓN', 5, 1),
	(29, 'pro_tipoactuacionprocesal', 'TIPO ACTUACIÓN PROCESAL', 5, 1),
	(30, 'pro_estadoproceso', 'ESTADO PROCESO', 5, 1),
	(31, 'pro_claseproceso', 'CLASE PROCESO', 5, 1),
	(32, 'pro_subclaseproceso', 'SUB CLASE PROCESO', 5, 1),
	(33, 'cli_cliente', 'CLIENTE', 3, 1);
/*!40000 ALTER TABLE `gen_tabla` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_tipodocumento
DROP TABLE IF EXISTS `gen_tipodocumento`;
CREATE TABLE IF NOT EXISTS `gen_tipodocumento` (
  `TDO_IdTipoDocumento` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id del Tipo de Documento de Identificacion',
  `TDO_Abreviatura` char(4) NOT NULL COMMENT 'Abreviatura para el del Tipo de Documento de Identificacion',
  `TDO_Nombre` char(100) NOT NULL COMMENT 'Nombre del Tipo de Documento de Identificacion',
  `TDO_Estado` tinyint(4) NOT NULL COMMENT 'Estado del registro en la tabla .',
  PRIMARY KEY (`TDO_IdTipoDocumento`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Infomación de los diferentes tipos de documento de identificacion.';

-- Volcando datos para la tabla appjudicial.gen_tipodocumento: 5 rows
DELETE FROM `gen_tipodocumento`;
/*!40000 ALTER TABLE `gen_tipodocumento` DISABLE KEYS */;
INSERT INTO `gen_tipodocumento` (`TDO_IdTipoDocumento`, `TDO_Abreviatura`, `TDO_Nombre`, `TDO_Estado`) VALUES
	(1, 'CC', 'Cédula de Ciudadanía', 1),
	(2, 'CE', 'Cédula de Extranjería', 1),
	(3, 'TI', 'Tarjeta de Identidad', 1),
	(4, 'PA', 'PASAPORTE', 2),
	(13, 'NUP', 'NUIP', 1);
/*!40000 ALTER TABLE `gen_tipodocumento` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_tipopersona
DROP TABLE IF EXISTS `gen_tipopersona`;
CREATE TABLE IF NOT EXISTS `gen_tipopersona` (
  `TPE_IdTipoPersona` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Identificador',
  `TPE_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre',
  `TPE_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado',
  PRIMARY KEY (`TPE_IdTipoPersona`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Tipo Persona juridica';

-- Volcando datos para la tabla appjudicial.gen_tipopersona: 2 rows
DELETE FROM `gen_tipopersona`;
/*!40000 ALTER TABLE `gen_tipopersona` DISABLE KEYS */;
INSERT INTO `gen_tipopersona` (`TPE_IdTipoPersona`, `TPE_Nombre`, `TPE_Estado`) VALUES
	(1, 'NATURAL', 1),
	(2, 'JURIDICA', 1);
/*!40000 ALTER TABLE `gen_tipopersona` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.jqcalendar
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
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla appjudicial.jqcalendar: 84 rows
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
	(96, '', '', '', '2017-10-31 09:45:00', '2017-10-31 11:15:00', 0, '', '', 376, 1, 1, 16, 6, 9, 19, 1, '0', '2017-10-31', '2017-10-31', '2017-10-25 00:24:56', '2017-10-31'),
	(99, '', '', '', '2018-08-24 06:30:00', '2018-08-24 08:00:00', 0, '', '', 379, 1, 2, 2, 1, 3, 19, 1, '0', '2018-08-24', '2018-08-24', '2018-08-24 21:48:51', '2018-08-24');
/*!40000 ALTER TABLE `jqcalendar` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.juz_area
DROP TABLE IF EXISTS `juz_area`;
CREATE TABLE IF NOT EXISTS `juz_area` (
  `ARE_IdArea` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `ARE_Nombre` char(100) NOT NULL COMMENT 'Nombre',
  `ARE_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo/Inactivo',
  `ARE_Codigo` char(4) DEFAULT NULL COMMENT 'Codigo del Area',
  `ARE_IdTipoJuzgado` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Código del Despacho (corporación, juzgado o entidad)',
  PRIMARY KEY (`ARE_IdArea`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='Area a la cual pertence el Juzgado.';

-- Volcando datos para la tabla appjudicial.juz_area: 16 rows
DELETE FROM `juz_area`;
/*!40000 ALTER TABLE `juz_area` DISABLE KEYS */;
INSERT INTO `juz_area` (`ARE_IdArea`, `ARE_Nombre`, `ARE_Estado`, `ARE_Codigo`, `ARE_IdTipoJuzgado`) VALUES
	(1, 'LABORAL', 1, '05', 3),
	(3, 'CIVIL', 1, '03', 3),
	(4, 'FAMILIA', 1, '10', 3),
	(5, 'ADMINISTRATIVA', 1, '31', 8),
	(6, 'PENAL', 1, '04', 3),
	(8, 'PROMISCUO DE FAMLIA', 1, '84', 3),
	(9, 'ADOLECENTES', 1, '01', 0),
	(10, 'EJECUCION PENAS Y MEDIDAS DE SEGURIDAD', 1, '87', 3),
	(11, 'MENORES', 1, '85', 3),
	(12, 'AGRARIO', 1, '11', 3),
	(13, 'ESPECIALIZADO EN COMERCIO', 1, '86', 3),
	(14, 'PROMISCUO', 1, '89', 3),
	(19, 'PENAL', 1, '04', 4),
	(18, 'CIVIL', 1, '03', 4),
	(20, 'PROMISCUO', 1, '89', 4),
	(21, 'ORDEN PÚBLICO', 1, '07', 9);
/*!40000 ALTER TABLE `juz_area` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.juz_juzgado
DROP TABLE IF EXISTS `juz_juzgado`;
CREATE TABLE IF NOT EXISTS `juz_juzgado` (
  `JUZ_IdJuzgado` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `JUZ_Ubicacion` char(50) DEFAULT NULL COMMENT 'Ubicacion',
  `JUZ_IdCiudad` smallint(6) DEFAULT NULL COMMENT 'Ciudad donde se encuentra ubicado',
  `JUZ_Direccion` char(150) DEFAULT NULL COMMENT 'Dirección',
  `JUZ_Piso` tinyint(4) DEFAULT NULL COMMENT 'Piso de la ubicacion del juzgado',
  `JUZ_IdTipoJuzgado` tinyint(4) DEFAULT NULL COMMENT 'Tipo de Juzgado',
  `JUZ_IdArea` tinyint(4) DEFAULT NULL COMMENT 'Area a la que pertenece el Juzgado',
  `JUZ_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado (Activo/Inactivo)',
  PRIMARY KEY (`JUZ_IdJuzgado`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Información general del Juzgado';

-- Volcando datos para la tabla appjudicial.juz_juzgado: 3 rows
DELETE FROM `juz_juzgado`;
/*!40000 ALTER TABLE `juz_juzgado` DISABLE KEYS */;
INSERT INTO `juz_juzgado` (`JUZ_IdJuzgado`, `JUZ_Ubicacion`, `JUZ_IdCiudad`, `JUZ_Direccion`, `JUZ_Piso`, `JUZ_IdTipoJuzgado`, `JUZ_IdArea`, `JUZ_Estado`) VALUES
	(4, '027', 2, 'Carrera 23 No. 115-85', 1, 3, 6, 1),
	(3, '017', 2, 'Carrera 23 No. 115-85', 6, 3, 5, 1),
	(5, '002', 2, 'Carrera 23 No. 115-85', 6, 4, 6, 1);
/*!40000 ALTER TABLE `juz_juzgado` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.juz_piso
DROP TABLE IF EXISTS `juz_piso`;
CREATE TABLE IF NOT EXISTS `juz_piso` (
  `PIS_IdPiso` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `PIS_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `PIS_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo/Inactivo',
  PRIMARY KEY (`PIS_IdPiso`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Piso de ubicacion del Juzgado.';

-- Volcando datos para la tabla appjudicial.juz_piso: 4 rows
DELETE FROM `juz_piso`;
/*!40000 ALTER TABLE `juz_piso` DISABLE KEYS */;
INSERT INTO `juz_piso` (`PIS_IdPiso`, `PIS_Nombre`, `PIS_Estado`) VALUES
	(1, 'UNO', 1),
	(6, 'TRES', 1),
	(4, 'DOS', 2),
	(7, 'SEIS', 1);
/*!40000 ALTER TABLE `juz_piso` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.juz_tipojuzgado
DROP TABLE IF EXISTS `juz_tipojuzgado`;
CREATE TABLE IF NOT EXISTS `juz_tipojuzgado` (
  `TJU_IdTipoJuzgado` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id control',
  `TJU_Nombre` char(50) NOT NULL COMMENT 'Nombre DE LA CORPORACION, JUZGADO O ENTIDAD',
  `TJU_Estado` tinyint(4) NOT NULL COMMENT 'Estado (activo)Inactivo)',
  `TJU_Codigo` char(2) NOT NULL COMMENT 'Código  DE LA CORPORACION, JUZGADO O ENTIDAD, ACUERDO No. 201 DE 1997 ',
  PRIMARY KEY (`TJU_IdTipoJuzgado`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Tipo de Juzgado.';

-- Volcando datos para la tabla appjudicial.juz_tipojuzgado: 6 rows
DELETE FROM `juz_tipojuzgado`;
/*!40000 ALTER TABLE `juz_tipojuzgado` DISABLE KEYS */;
INSERT INTO `juz_tipojuzgado` (`TJU_IdTipoJuzgado`, `TJU_Nombre`, `TJU_Estado`, `TJU_Codigo`) VALUES
	(4, 'JUZGADO MUNICIPAL', 1, '40'),
	(5, 'PEQUEÑAS CAUSAS', 1, ''),
	(3, 'JUZGADO DE CIRCUITO', 1, '31'),
	(6, 'CIRCUITO DE DESCONGESTIÓN', 1, ''),
	(8, 'JUZGADO ADMINISTRATIVO', 1, '33'),
	(9, 'JUZGADO REGIONAL', 1, '32');
/*!40000 ALTER TABLE `juz_tipojuzgado` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_actuacionprocesal
DROP TABLE IF EXISTS `pro_actuacionprocesal`;
CREATE TABLE IF NOT EXISTS `pro_actuacionprocesal` (
  `APR_IdActuacionProcesal` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `APR_IdProceso` bigint(20) NOT NULL COMMENT 'Número del Proceso',
  `APR_Fecha` datetime NOT NULL COMMENT 'Fecha en la cual se registra la informacion',
  `APR_IdTipoActuacionProcesal` bigint(20) NOT NULL COMMENT 'Nombre de la actuación Procesal ',
  `APR_Observaciones` varchar(50) NOT NULL COMMENT 'Observaciones',
  `APR_IdUsuario` int(11) NOT NULL COMMENT 'Usuario quien realiza el registro de la información',
  PRIMARY KEY (`APR_IdActuacionProcesal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='información detallada de las Actuaciones por Proceso.';

-- Volcando datos para la tabla appjudicial.pro_actuacionprocesal: 0 rows
DELETE FROM `pro_actuacionprocesal`;
/*!40000 ALTER TABLE `pro_actuacionprocesal` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_actuacionprocesal` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_claseproceso
DROP TABLE IF EXISTS `pro_claseproceso`;
CREATE TABLE IF NOT EXISTS `pro_claseproceso` (
  `CPR_IdClaseProceso` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `CPR_Nombre` char(150) DEFAULT NULL COMMENT 'Nombre.',
  `CPR_Dias` tinyint(4) DEFAULT NULL COMMENT 'Días que dura etapa del Proceso.',
  `CPR_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado Activo/Inactivo.',
  PRIMARY KEY (`CPR_IdClaseProceso`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Clase de Proceso.';

-- Volcando datos para la tabla appjudicial.pro_claseproceso: 3 rows
DELETE FROM `pro_claseproceso`;
/*!40000 ALTER TABLE `pro_claseproceso` DISABLE KEYS */;
INSERT INTO `pro_claseproceso` (`CPR_IdClaseProceso`, `CPR_Nombre`, `CPR_Dias`, `CPR_Estado`) VALUES
	(1, 'PROCESOS DECLARATIVOS O DE CONOCIMIENTO', 1, 1),
	(2, 'PROCESOS ESPECIALES', 1, 1),
	(4, 'PROCESOS EJECUTIVOS', 1, 1);
/*!40000 ALTER TABLE `pro_claseproceso` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_estadoproceso
DROP TABLE IF EXISTS `pro_estadoproceso`;
CREATE TABLE IF NOT EXISTS `pro_estadoproceso` (
  `EPR_IdEstado` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `EPR_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre del estado del proceso.',
  `EPR_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo / Inactivo',
  PRIMARY KEY (`EPR_IdEstado`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Estado del Proceso.';

-- Volcando datos para la tabla appjudicial.pro_estadoproceso: 3 rows
DELETE FROM `pro_estadoproceso`;
/*!40000 ALTER TABLE `pro_estadoproceso` DISABLE KEYS */;
INSERT INTO `pro_estadoproceso` (`EPR_IdEstado`, `EPR_Nombre`, `EPR_Estado`) VALUES
	(1, 'ABIERTO', 1),
	(2, 'CERRADO', 1),
	(3, 'REABRIR', 1);
/*!40000 ALTER TABLE `pro_estadoproceso` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_proceso
DROP TABLE IF EXISTS `pro_proceso`;
CREATE TABLE IF NOT EXISTS `pro_proceso` (
  `PRO_IdProceso` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `PRO_IdDemandante` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Id Demandante o Cliente',
  `PRO_IdDemandado` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Id Demandado',
  `PRO_NumeroProceso` char(23) NOT NULL COMMENT 'Número del Proceso',
  `PRO_FechaInicio` datetime NOT NULL COMMENT 'Fecha en la cual inicia el proceso',
  `PRO_IdUsuario` bigint(20) NOT NULL COMMENT 'Abogado titular del Proceso',
  `PRO_IdUbicacion` tinyint(4) NOT NULL COMMENT 'Estado o Ubicacion',
  `PRO_IdClaseProceso` tinyint(4) NOT NULL COMMENT 'Tipo o Clase del Proceso',
  `PRO_IdJuzgadoOrigen` smallint(6) NOT NULL COMMENT 'Juzgado Origen',
  `PRO_EstadoProceso` tinyint(4) NOT NULL COMMENT 'Estado del Proceso',
  PRIMARY KEY (`PRO_IdProceso`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Informacion general del Proceso.';

-- Volcando datos para la tabla appjudicial.pro_proceso: 3 rows
DELETE FROM `pro_proceso`;
/*!40000 ALTER TABLE `pro_proceso` DISABLE KEYS */;
INSERT INTO `pro_proceso` (`PRO_IdProceso`, `PRO_IdDemandante`, `PRO_IdDemandado`, `PRO_NumeroProceso`, `PRO_FechaInicio`, `PRO_IdUsuario`, `PRO_IdUbicacion`, `PRO_IdClaseProceso`, `PRO_IdJuzgadoOrigen`, `PRO_EstadoProceso`) VALUES
	(1, 5, 2, '54635654677997422456800', '2018-09-06 00:00:00', 13, 3, 4, 779, 2),
	(2, 6, 5, '54635654677997422456800', '2018-09-05 00:00:00', 10, 2, 1, 779, 1),
	(3, 5, 2, '54354201854641111111100', '2018-09-20 00:00:00', 11, 2, 2, 546, 2);
/*!40000 ALTER TABLE `pro_proceso` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_procesosxjuzgado
DROP TABLE IF EXISTS `pro_procesosxjuzgado`;
CREATE TABLE IF NOT EXISTS `pro_procesosxjuzgado` (
  `PxJ_IdJuzgado` smallint(6) DEFAULT NULL COMMENT 'Id del Juzgado',
  `PxJ_IdProceso` int(11) DEFAULT NULL COMMENT 'Id del Proceso'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relaciona cada proceso en que juzgado se encuentra';

-- Volcando datos para la tabla appjudicial.pro_procesosxjuzgado: 0 rows
DELETE FROM `pro_procesosxjuzgado`;
/*!40000 ALTER TABLE `pro_procesosxjuzgado` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_procesosxjuzgado` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_procesoxcliente
DROP TABLE IF EXISTS `pro_procesoxcliente`;
CREATE TABLE IF NOT EXISTS `pro_procesoxcliente` (
  `PxC_IdCliente` bigint(20) DEFAULT NULL COMMENT 'Id del Cliente',
  `PxC_IdProceso` int(11) DEFAULT NULL COMMENT 'Id del Proceso'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='relacion del Proceso x Cliente';

-- Volcando datos para la tabla appjudicial.pro_procesoxcliente: 0 rows
DELETE FROM `pro_procesoxcliente`;
/*!40000 ALTER TABLE `pro_procesoxcliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_procesoxcliente` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_subclaseproceso
DROP TABLE IF EXISTS `pro_subclaseproceso`;
CREATE TABLE IF NOT EXISTS `pro_subclaseproceso` (
  `SCP_IdSubClaseProceso` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `SCP_Nombre` char(150) DEFAULT NULL COMMENT 'Nombre.',
  `SCP_IdClaseProceso` tinyint(4) DEFAULT NULL COMMENT 'Clase del Proceso.',
  `SCP_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado Activo/Inactivo.',
  PRIMARY KEY (`SCP_IdSubClaseProceso`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Clase de Sub Proceso.';

-- Volcando datos para la tabla appjudicial.pro_subclaseproceso: 6 rows
DELETE FROM `pro_subclaseproceso`;
/*!40000 ALTER TABLE `pro_subclaseproceso` DISABLE KEYS */;
INSERT INTO `pro_subclaseproceso` (`SCP_IdSubClaseProceso`, `SCP_Nombre`, `SCP_IdClaseProceso`, `SCP_Estado`) VALUES
	(1, 'PROCESO ORDINARIO', 1, 1),
	(2, 'PROCESO ABREVIADO', 1, 1),
	(4, 'PROCESO ESPECIAL DE EXPROPIACIÓN', 2, 1),
	(5, 'PROCESO ESPECIAL DE DESLINDE O AMOJONAMIENTO', 2, 1),
	(6, 'PROCESO EJECUTIVO SINGULAR; O PERSONAL O QUIROGRAFARIO', 4, 1),
	(7, 'PROCESO EJECUTIVO REAL HIPOTECARIO O PRENDARIO', 4, 1);
/*!40000 ALTER TABLE `pro_subclaseproceso` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_tipoactuacionprocesal
DROP TABLE IF EXISTS `pro_tipoactuacionprocesal`;
CREATE TABLE IF NOT EXISTS `pro_tipoactuacionprocesal` (
  `TAP_IdTipoActuacionProcesal` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `TAP_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `TAP_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo/Inactivo',
  PRIMARY KEY (`TAP_IdTipoActuacionProcesal`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='diferentes Tipos de Actuaciones Procesales.';

-- Volcando datos para la tabla appjudicial.pro_tipoactuacionprocesal: 3 rows
DELETE FROM `pro_tipoactuacionprocesal`;
/*!40000 ALTER TABLE `pro_tipoactuacionprocesal` DISABLE KEYS */;
INSERT INTO `pro_tipoactuacionprocesal` (`TAP_IdTipoActuacionProcesal`, `TAP_Nombre`, `TAP_Estado`) VALUES
	(1, 'ACTOS DE DECISIÓN', 1),
	(2, 'ACTOS DE COMUNICACIÓN', 1),
	(3, 'ACTOS DE DOCUMENTACIÓN', 1);
/*!40000 ALTER TABLE `pro_tipoactuacionprocesal` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_ubicacion
DROP TABLE IF EXISTS `pro_ubicacion`;
CREATE TABLE IF NOT EXISTS `pro_ubicacion` (
  `UBI_IdUbicacion` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `UBI_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre',
  `UBI_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado',
  PRIMARY KEY (`UBI_IdUbicacion`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Ubicación o Estado del Proceso.';

-- Volcando datos para la tabla appjudicial.pro_ubicacion: 4 rows
DELETE FROM `pro_ubicacion`;
/*!40000 ALTER TABLE `pro_ubicacion` DISABLE KEYS */;
INSERT INTO `pro_ubicacion` (`UBI_IdUbicacion`, `UBI_Nombre`, `UBI_Estado`) VALUES
	(1, 'DESPACHO', 1),
	(2, 'LETRA', 1),
	(3, 'SECRETARIO', 1),
	(5, 'ARCHIVO', 1);
/*!40000 ALTER TABLE `pro_ubicacion` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.rolxusuario
DROP TABLE IF EXISTS `rolxusuario`;
CREATE TABLE IF NOT EXISTS `rolxusuario` (
  `RxU_IdRolUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `USU_IdUsuario` int(11) DEFAULT NULL COMMENT 'Id Usuario',
  `ROL_IdRol` int(2) DEFAULT NULL COMMENT 'Id Rol',
  PRIMARY KEY (`RxU_IdRolUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Rol o roles por usuario';

-- Volcando datos para la tabla appjudicial.rolxusuario: 0 rows
DELETE FROM `rolxusuario`;
/*!40000 ALTER TABLE `rolxusuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `rolxusuario` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.usu_accion
DROP TABLE IF EXISTS `usu_accion`;
CREATE TABLE IF NOT EXISTS `usu_accion` (
  `ACC_IdAccion` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Id Opcion del menu',
  `ACC_Nombre` varchar(20) DEFAULT NULL COMMENT 'Nombre',
  `ACC_Estado` tinyint(1) DEFAULT NULL COMMENT 'Estado',
  PRIMARY KEY (`ACC_IdAccion`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='Acciones por Rol';

-- Volcando datos para la tabla appjudicial.usu_accion: 6 rows
DELETE FROM `usu_accion`;
/*!40000 ALTER TABLE `usu_accion` DISABLE KEYS */;
INSERT INTO `usu_accion` (`ACC_IdAccion`, `ACC_Nombre`, `ACC_Estado`) VALUES
	(1, 'Crear', 1),
	(2, 'Consultar', 1),
	(3, 'Modificar', 1),
	(4, 'Imprimir', 1),
	(5, 'Borrar', 1),
	(6, 'Cargar Datas', 1);
/*!40000 ALTER TABLE `usu_accion` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.usu_accionxrol
DROP TABLE IF EXISTS `usu_accionxrol`;
CREATE TABLE IF NOT EXISTS `usu_accionxrol` (
  `AxR_IdAccionRol` int(3) DEFAULT NULL,
  `AxR_IdRol` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Accion por cada Rol';

-- Volcando datos para la tabla appjudicial.usu_accionxrol: 0 rows
DELETE FROM `usu_accionxrol`;
/*!40000 ALTER TABLE `usu_accionxrol` DISABLE KEYS */;
/*!40000 ALTER TABLE `usu_accionxrol` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.usu_rol
DROP TABLE IF EXISTS `usu_rol`;
CREATE TABLE IF NOT EXISTS `usu_rol` (
  `ROL_IdRol` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `ROL_Nombre` varchar(50) DEFAULT NULL COMMENT 'Nombre',
  `ROL_Estado` tinyint(1) DEFAULT NULL COMMENT 'Estado',
  PRIMARY KEY (`ROL_IdRol`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Rol que se maneja en el sistema';

-- Volcando datos para la tabla appjudicial.usu_rol: 4 rows
DELETE FROM `usu_rol`;
/*!40000 ALTER TABLE `usu_rol` DISABLE KEYS */;
INSERT INTO `usu_rol` (`ROL_IdRol`, `ROL_Nombre`, `ROL_Estado`) VALUES
	(1, 'Super Administrador', 1),
	(2, 'Administrador', 1),
	(3, 'Operativo', 1),
	(4, 'Basico', 1);
/*!40000 ALTER TABLE `usu_rol` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.usu_tipousuario
DROP TABLE IF EXISTS `usu_tipousuario`;
CREATE TABLE IF NOT EXISTS `usu_tipousuario` (
  `TUS_ID_TipoUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del tipo de Usuario',
  `TUS_Nombre` char(50) NOT NULL COMMENT 'Nombre del Tipo de Usuario',
  `TUS_Estado` tinyint(4) NOT NULL COMMENT 'Estado del Usuario.',
  `TUS_FechaCreado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha Creacion del Tipo de Usuario',
  `TUS_UsuarioCrea` int(11) NOT NULL COMMENT 'Usuario q crea el Tipo Servicio',
  PRIMARY KEY (`TUS_ID_TipoUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Tipo de Usuario que existe en el sistema.';

-- Volcando datos para la tabla appjudicial.usu_tipousuario: 3 rows
DELETE FROM `usu_tipousuario`;
/*!40000 ALTER TABLE `usu_tipousuario` DISABLE KEYS */;
INSERT INTO `usu_tipousuario` (`TUS_ID_TipoUsuario`, `TUS_Nombre`, `TUS_Estado`, `TUS_FechaCreado`, `TUS_UsuarioCrea`) VALUES
	(1, 'ADMINISTRADOR', 1, '2018-07-12 20:49:09', 0),
	(2, 'ABOGADO', 1, '2018-07-12 20:49:37', 0),
	(3, 'DEPENDIENTE JUDICIAL', 1, '2018-07-12 20:50:02', 0);
/*!40000 ALTER TABLE `usu_tipousuario` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.usu_usuario
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

-- Volcando datos para la tabla appjudicial.usu_usuario: 7 rows
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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
