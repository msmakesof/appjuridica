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


-- Volcando estructura de base de datos para appjudicial
CREATE DATABASE IF NOT EXISTS `appjudicial` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `appjudicial`;

-- Volcando estructura para tabla appjudicial.aud_logauditoria
CREATE TABLE IF NOT EXISTS `aud_logauditoria` (
  `AUD_IdLog` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `AUD_Accion` mediumtext COMMENT 'Accion registrada en el sistema',
  `AUD_FechaHora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y Hora de la realización de la acción.',
  PRIMARY KEY (`AUD_IdLog`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Log de Auditoria';

-- Volcando datos para la tabla appjudicial.aud_logauditoria: 0 rows
DELETE FROM `aud_logauditoria`;
/*!40000 ALTER TABLE `aud_logauditoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `aud_logauditoria` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.cli_cliente
CREATE TABLE IF NOT EXISTS `cli_cliente` (
  `CLI_IdCliente` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id del cliente para contro',
  `CLI_Identificacion` bigint(20) DEFAULT NULL COMMENT 'Nro de identificacion.',
  `CLI_TipoDocumento` tinyint(4) DEFAULT NULL COMMENT 'Tipo de Documento del cliente.',
  `CLI_Apellido1` char(50) DEFAULT NULL COMMENT 'Primer Apellido del cliente.',
  `CLI_Apellido2` char(50) DEFAULT NULL COMMENT 'Segundo Apellido del cliente.',
  `CLI_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre(s) del cliente.',
  `CLI_TelefonoFijo` char(10) DEFAULT NULL COMMENT 'Telefono Fijo.',
  `CLI_Celular` char(15) DEFAULT NULL COMMENT 'Ceular.',
  `CLI_Email` char(80) NOT NULL COMMENT 'Email ',
  `CLI_Direccion` char(150) DEFAULT NULL COMMENT 'Direccion.',
  `CLI_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado (Activo /Inactivo) del cliente.',
  `CLI_IdTipoCliente` tinyint(4) DEFAULT NULL COMMENT 'Id Tipo del Cliente.',
  `CLI_UsuarioCrea` bigint(20) DEFAULT NULL COMMENT 'Usuario que Crea.',
  `CLI_FechaCrea` datetime DEFAULT NULL COMMENT 'Fecha de Creacion.',
  `CLI_UsuarioModifica` bigint(20) DEFAULT NULL COMMENT 'Usuario que modifica.',
  `CLI_FechaModifica` datetime DEFAULT NULL COMMENT 'Fecha modificacion.',
  PRIMARY KEY (`CLI_IdCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Informacion general del Cliente.';

-- Volcando datos para la tabla appjudicial.cli_cliente: 1 rows
DELETE FROM `cli_cliente`;
/*!40000 ALTER TABLE `cli_cliente` DISABLE KEYS */;
INSERT INTO `cli_cliente` (`CLI_IdCliente`, `CLI_Identificacion`, `CLI_TipoDocumento`, `CLI_Apellido1`, `CLI_Apellido2`, `CLI_Nombre`, `CLI_TelefonoFijo`, `CLI_Celular`, `CLI_Email`, `CLI_Direccion`, `CLI_Estado`, `CLI_IdTipoCliente`, `CLI_UsuarioCrea`, `CLI_FechaCrea`, `CLI_UsuarioModifica`, `CLI_FechaModifica`) VALUES
	(1, 79243925, 1, 'SANCHEZ', 'SIERRA', 'MAURICIO', NULL, '3142674416', 'msmakesof@gmail.com', 'calle 153', 1, 1, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `cli_cliente` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.cli_tipocliente
CREATE TABLE IF NOT EXISTS `cli_tipocliente` (
  `TCL_IdTipoCliente` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id de control',
  `TCL_Nombre` varchar(50) NOT NULL COMMENT 'Nombre o descripcion',
  `TCL_Estado` tinyint(4) NOT NULL COMMENT 'Estado del cliente (Activo/Inactivo)',
  PRIMARY KEY (`TCL_IdTipoCliente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tipo de Cliente.';

-- Volcando datos para la tabla appjudicial.cli_tipocliente: 0 rows
DELETE FROM `cli_tipocliente`;
/*!40000 ALTER TABLE `cli_tipocliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cli_tipocliente` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_ciudad
CREATE TABLE IF NOT EXISTS `gen_ciudad` (
  `CIU_IdCiudades` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id control',
  `CIU_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `CIU_Abreviatrua` char(4) NOT NULL COMMENT 'Abreviatura',
  `CIU_IdDepartamento` smallint(6) NOT NULL COMMENT 'Departamento donde se encuentra ubicada.',
  `CIU_Estado` tinyint(4) NOT NULL COMMENT 'Estado (Activo/Inactivo)',
  PRIMARY KEY (`CIU_IdCiudades`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='información de la Ciudad.';

-- Volcando datos para la tabla appjudicial.gen_ciudad: 0 rows
DELETE FROM `gen_ciudad`;
/*!40000 ALTER TABLE `gen_ciudad` DISABLE KEYS */;
/*!40000 ALTER TABLE `gen_ciudad` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_configuracion
CREATE TABLE IF NOT EXISTS `gen_configuracion` (
  `CON_IdConfiguracion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `CON_TituloApp` char(50) NOT NULL COMMENT 'Nombre de la App o Herramienta',
  `CON_Logo` char(100) NOT NULL COMMENT 'ubicacion del logo',
  `CON_Estado` tinyint(4) NOT NULL COMMENT 'Estado del registro',
  PRIMARY KEY (`CON_IdConfiguracion`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Tabla base de configuración.';

-- Volcando datos para la tabla appjudicial.gen_configuracion: 1 rows
DELETE FROM `gen_configuracion`;
/*!40000 ALTER TABLE `gen_configuracion` DISABLE KEYS */;
INSERT INTO `gen_configuracion` (`CON_IdConfiguracion`, `CON_TituloApp`, `CON_Logo`, `CON_Estado`) VALUES
	(1, 'Dependiente Judicial.', 'images/logojur.jpg', 1);
/*!40000 ALTER TABLE `gen_configuracion` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_control
CREATE TABLE IF NOT EXISTS `gen_control` (
  `CON_IdControl` int(11) NOT NULL AUTO_INCREMENT,
  `CON_LlaveAcceso` varchar(500) DEFAULT NULL,
  `CON_IdEstado` int(1) DEFAULT NULL,
  `CON_LlaveInicial` varchar(50) DEFAULT NULL,
  `CON_LlaveIv` varchar(50) DEFAULT NULL,
  `CON_MetodoEncriptacion` varchar(50) DEFAULT NULL,
  `CON_TipoHash` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`CON_IdControl`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla appjudicial.gen_control: 1 rows
DELETE FROM `gen_control`;
/*!40000 ALTER TABLE `gen_control` DISABLE KEYS */;
INSERT INTO `gen_control` (`CON_IdControl`, `CON_LlaveAcceso`, `CON_IdEstado`, `CON_LlaveInicial`, `CON_LlaveIv`, `CON_MetodoEncriptacion`, `CON_TipoHash`) VALUES
	(1, 'V14l1br390$MKS', 1, '\'muni\'', '\'muni123\'', 'AES-256-CBC', 'sha256');
/*!40000 ALTER TABLE `gen_control` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_departamento
CREATE TABLE IF NOT EXISTS `gen_departamento` (
  `DEP_IdDepartamento` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id Control.',
  `DEP_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `DEP_Pais` smallint(6) NOT NULL COMMENT 'Id del Pais al cual pertenece el Departamento.',
  `DEP_Estado` tinyint(4) NOT NULL COMMENT 'Estado Ativo/Inactivo.',
  PRIMARY KEY (`DEP_IdDepartamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='información general del Departamento.';

-- Volcando datos para la tabla appjudicial.gen_departamento: 0 rows
DELETE FROM `gen_departamento`;
/*!40000 ALTER TABLE `gen_departamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `gen_departamento` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_estado
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
CREATE TABLE IF NOT EXISTS `gen_festivo` (
  `FES_IdFestivo` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id de Control',
  `FES_Festivo` date DEFAULT NULL COMMENT 'Dia Festivo',
  `FES_VanciaJudicial` char(1) NOT NULL COMMENT 'Paramarcar si el dia se contempla como Vancia Judicial, los dias que los juzgados no prestan servicio.',
  `FES_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo/Inactivo',
  PRIMARY KEY (`FES_IdFestivo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relaciona los dias Festivo por año.';

-- Volcando datos para la tabla appjudicial.gen_festivo: 0 rows
DELETE FROM `gen_festivo`;
/*!40000 ALTER TABLE `gen_festivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `gen_festivo` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_pais
CREATE TABLE IF NOT EXISTS `gen_pais` (
  `PAI_IdPais` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `PAI_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre del Pais.',
  `PAI_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado Activo/Inactivo.',
  PRIMARY KEY (`PAI_IdPais`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='informacion del Pais al cual pertenece un Departamento.';

-- Volcando datos para la tabla appjudicial.gen_pais: 0 rows
DELETE FROM `gen_pais`;
/*!40000 ALTER TABLE `gen_pais` DISABLE KEYS */;
/*!40000 ALTER TABLE `gen_pais` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_tabla
CREATE TABLE IF NOT EXISTS `gen_tabla` (
  `TAB_IdTabla` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id control',
  `TAB_Nombre_Tabla` char(50) NOT NULL COMMENT 'Nombre',
  `TAB_NombreMostrar` char(50) NOT NULL COMMENT 'Nombre a Mostrar',
  `TAB_IdEstadoTabla` tinyint(4) NOT NULL COMMENT 'Estado',
  PRIMARY KEY (`TAB_IdTabla`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tablas del sistema';

-- Volcando datos para la tabla appjudicial.gen_tabla: 0 rows
DELETE FROM `gen_tabla`;
/*!40000 ALTER TABLE `gen_tabla` DISABLE KEYS */;
/*!40000 ALTER TABLE `gen_tabla` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.gen_tipodocumento
CREATE TABLE IF NOT EXISTS `gen_tipodocumento` (
  `TDO_IdTipoDocumento` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id del Tipo de Documento de Identificacion',
  `TDO_Abreviatura` char(4) NOT NULL COMMENT 'Abreviatura para el del Tipo de Documento de Identificacion',
  `TDO_Nombre` char(100) NOT NULL COMMENT 'Nombre del Tipo de Documento de Identificacion',
  `TDO_Estado` tinyint(4) NOT NULL COMMENT 'Estado del registro en la tabla .',
  PRIMARY KEY (`TDO_IdTipoDocumento`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Infomación de los diferentes tipos de documento de identificacion.';

-- Volcando datos para la tabla appjudicial.gen_tipodocumento: 1 rows
DELETE FROM `gen_tipodocumento`;
/*!40000 ALTER TABLE `gen_tipodocumento` DISABLE KEYS */;
INSERT INTO `gen_tipodocumento` (`TDO_IdTipoDocumento`, `TDO_Abreviatura`, `TDO_Nombre`, `TDO_Estado`) VALUES
	(1, 'CC', 'Cédula de Ciudadanía', 1);
/*!40000 ALTER TABLE `gen_tipodocumento` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.juz_area
CREATE TABLE IF NOT EXISTS `juz_area` (
  `ARE_IdArea` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `ARE_Nombre` char(100) NOT NULL COMMENT 'Nombre',
  `ARE_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo/Inactivo',
  PRIMARY KEY (`ARE_IdArea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Area a la cual pertence el Juzgado.';

-- Volcando datos para la tabla appjudicial.juz_area: 0 rows
DELETE FROM `juz_area`;
/*!40000 ALTER TABLE `juz_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `juz_area` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.juz_juzgado
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Información general del Juzgado';

-- Volcando datos para la tabla appjudicial.juz_juzgado: 0 rows
DELETE FROM `juz_juzgado`;
/*!40000 ALTER TABLE `juz_juzgado` DISABLE KEYS */;
/*!40000 ALTER TABLE `juz_juzgado` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.juz_piso
CREATE TABLE IF NOT EXISTS `juz_piso` (
  `PIS_IdPiso` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `PIS_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `PIS_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo/Inactivo',
  PRIMARY KEY (`PIS_IdPiso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Piso de ubicacion del Juzgado.';

-- Volcando datos para la tabla appjudicial.juz_piso: 0 rows
DELETE FROM `juz_piso`;
/*!40000 ALTER TABLE `juz_piso` DISABLE KEYS */;
/*!40000 ALTER TABLE `juz_piso` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.juz_tipojuzgado
CREATE TABLE IF NOT EXISTS `juz_tipojuzgado` (
  `TJU_IdTipoJuzgado` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id control',
  `TJU_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `TJU_Estado` tinyint(4) NOT NULL COMMENT 'Estado (activo)Inactivo)',
  PRIMARY KEY (`TJU_IdTipoJuzgado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tipo de Juzgado.';

-- Volcando datos para la tabla appjudicial.juz_tipojuzgado: 0 rows
DELETE FROM `juz_tipojuzgado`;
/*!40000 ALTER TABLE `juz_tipojuzgado` DISABLE KEYS */;
/*!40000 ALTER TABLE `juz_tipojuzgado` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_actuacionprocesal
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
CREATE TABLE IF NOT EXISTS `pro_claseproceso` (
  `CPR_IdClaseProceso` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `CPR_Nombre` char(150) DEFAULT NULL COMMENT 'Nombre.',
  `CPR_Dias` tinyint(4) DEFAULT NULL COMMENT 'Días que dura etapa del Proceso.',
  `CPR_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado Activo/Inactivo.',
  PRIMARY KEY (`CPR_IdClaseProceso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Clase de Proceso.';

-- Volcando datos para la tabla appjudicial.pro_claseproceso: 0 rows
DELETE FROM `pro_claseproceso`;
/*!40000 ALTER TABLE `pro_claseproceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_claseproceso` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_estadoproceso
CREATE TABLE IF NOT EXISTS `pro_estadoproceso` (
  `EPR_IdEstado` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `EPR_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre del estado del proceso.',
  `EPR_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo / Inactivo',
  PRIMARY KEY (`EPR_IdEstado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Estado del Proceso.';

-- Volcando datos para la tabla appjudicial.pro_estadoproceso: 0 rows
DELETE FROM `pro_estadoproceso`;
/*!40000 ALTER TABLE `pro_estadoproceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_estadoproceso` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_proceso
CREATE TABLE IF NOT EXISTS `pro_proceso` (
  `PRO_IdProceso` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `PRO_NumeroProceso` bigint(30) NOT NULL COMMENT 'Número del Proceso',
  `PRO_FechaInicio` datetime NOT NULL COMMENT 'Fecha en la cual inicia el proceso',
  `PRO_IdUsuario` datetime NOT NULL COMMENT 'Abogado titular del Proceso',
  `PRO_IdUbicacion` smallint(6) NOT NULL COMMENT 'Estado o Ubicacion',
  `PRO_IdClaseProceso` smallint(6) NOT NULL COMMENT 'Tipo o Clase del Proceso',
  `PRO_IdJuzgadoOrigen` smallint(6) NOT NULL COMMENT 'Juzgado Origen',
  `PRO_EstadoProceso` smallint(6) NOT NULL COMMENT 'Estado del Proceso',
  PRIMARY KEY (`PRO_IdProceso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Informacion general del Proceso.';

-- Volcando datos para la tabla appjudicial.pro_proceso: 0 rows
DELETE FROM `pro_proceso`;
/*!40000 ALTER TABLE `pro_proceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_proceso` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_procesosxjuzgado
CREATE TABLE IF NOT EXISTS `pro_procesosxjuzgado` (
  `PxJ_IdJuzgado` smallint(6) DEFAULT NULL COMMENT 'Id del Juzgado',
  `PxJ_IdProceso` int(11) DEFAULT NULL COMMENT 'Id del Proceso'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relaciona cada proceso en que juzgado se encuentra';

-- Volcando datos para la tabla appjudicial.pro_procesosxjuzgado: 0 rows
DELETE FROM `pro_procesosxjuzgado`;
/*!40000 ALTER TABLE `pro_procesosxjuzgado` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_procesosxjuzgado` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_procesoxcliente
CREATE TABLE IF NOT EXISTS `pro_procesoxcliente` (
  `PxC_IdCliente` bigint(20) DEFAULT NULL COMMENT 'Id del Cliente',
  `PxC_IdProceso` int(11) DEFAULT NULL COMMENT 'Id del Proceso'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='relacion del Proceso x Cliente';

-- Volcando datos para la tabla appjudicial.pro_procesoxcliente: 0 rows
DELETE FROM `pro_procesoxcliente`;
/*!40000 ALTER TABLE `pro_procesoxcliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_procesoxcliente` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_tipoactuacionprocesal
CREATE TABLE IF NOT EXISTS `pro_tipoactuacionprocesal` (
  `TAP_IdTipoActuacionProcesal` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `TAP_Nombre` char(50) NOT NULL COMMENT 'Nombre',
  `TAP_Estado` tinyint(4) NOT NULL COMMENT 'Estado Activo/Inactivo',
  PRIMARY KEY (`TAP_IdTipoActuacionProcesal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='diferentes Tipos de Actuaciones Procesales.';

-- Volcando datos para la tabla appjudicial.pro_tipoactuacionprocesal: 0 rows
DELETE FROM `pro_tipoactuacionprocesal`;
/*!40000 ALTER TABLE `pro_tipoactuacionprocesal` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_tipoactuacionprocesal` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.pro_ubicacion
CREATE TABLE IF NOT EXISTS `pro_ubicacion` (
  `UBI_IdUbicacion` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Id Control',
  `UBI_Nombre` char(50) DEFAULT NULL COMMENT 'Nombre',
  `UBI_Estado` tinyint(4) DEFAULT NULL COMMENT 'Estado',
  PRIMARY KEY (`UBI_IdUbicacion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Ubicación o Estado del Proceso.';

-- Volcando datos para la tabla appjudicial.pro_ubicacion: 0 rows
DELETE FROM `pro_ubicacion`;
/*!40000 ALTER TABLE `pro_ubicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_ubicacion` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.usu_accion
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
CREATE TABLE IF NOT EXISTS `usu_accionxrol` (
  `AxR_IdAccionRol` int(3) DEFAULT NULL,
  `AxR_IdRol` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Accion por cada Rol';

-- Volcando datos para la tabla appjudicial.usu_accionxrol: 0 rows
DELETE FROM `usu_accionxrol`;
/*!40000 ALTER TABLE `usu_accionxrol` DISABLE KEYS */;
/*!40000 ALTER TABLE `usu_accionxrol` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.usu_rol
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
CREATE TABLE IF NOT EXISTS `usu_tipousuario` (
  `TUS_ID_TipoUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del tipo de Usuario',
  `TUS_Nombre` char(50) NOT NULL COMMENT 'Nombre del Tipo de Usuario',
  `TUS_Estado` tinyint(4) NOT NULL COMMENT 'Estado del Usuario.',
  `TUS_FechaCreado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha Creacion del Tipo de Usuario',
  `TUS_UsuarioCrea` int(11) NOT NULL COMMENT 'Usuario q crea el Tipo Servicio',
  PRIMARY KEY (`TUS_ID_TipoUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tipo de Usuario que existe en el sistema.';

-- Volcando datos para la tabla appjudicial.usu_tipousuario: 0 rows
DELETE FROM `usu_tipousuario`;
/*!40000 ALTER TABLE `usu_tipousuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usu_tipousuario` ENABLE KEYS */;

-- Volcando estructura para tabla appjudicial.usu_usuario
CREATE TABLE IF NOT EXISTS `usu_usuario` (
  `USU_IdUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del Usuario',
  `USU_TipoDocumento` tinyint(4) NOT NULL COMMENT 'Tipo Documento Identificacion',
  `USU_Identificacion` char(20) NOT NULL COMMENT 'Nro de Identificacion',
  `USU_PrimerApellido` char(30) NOT NULL COMMENT 'Primer Apellido',
  `USU_SegundoApellido` char(30) NOT NULL COMMENT 'Segundo Apellido',
  `USU_Nombre` char(30) NOT NULL COMMENT 'Nombre(s) ',
  `USU_Email` char(80) NOT NULL COMMENT 'Email',
  `USU_Celular` char(20) NOT NULL COMMENT 'Nro Celular',
  `USU_Usuario` char(40) NOT NULL COMMENT 'Usuario o Login',
  `USU_Clave` char(40) NOT NULL COMMENT 'Clave o Contraseña',
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Información general del Usuario.';

-- Volcando datos para la tabla appjudicial.usu_usuario: 1 rows
DELETE FROM `usu_usuario`;
/*!40000 ALTER TABLE `usu_usuario` DISABLE KEYS */;
INSERT INTO `usu_usuario` (`USU_IdUsuario`, `USU_TipoDocumento`, `USU_Identificacion`, `USU_PrimerApellido`, `USU_SegundoApellido`, `USU_Nombre`, `USU_Email`, `USU_Celular`, `USU_Usuario`, `USU_Clave`, `USU_TipoUsuario`, `USU_Estado`, `USU_FechaCreado`, `USU_UsuarioCrea`, `USU_FechaModificado`, `USU_UsuarioModifica`, `USU_FechaEstado`, `USU_UsuarioEstado`, `USU_IdInterno`, `USU_Local`) VALUES
	(1, 1, '79243925', 'SANCHEZ', 'SIERRA', 'MAURICIO', 'msmakesof@gmail.com', '3142674416', 'msmakesof@gmail.com', '123456', 1, 1, '2018-05-06 03:08:38', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 2147483647, 0, 30791989463187.746);
/*!40000 ALTER TABLE `usu_usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
