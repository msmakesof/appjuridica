<?php
/**
 * Representa el la estructura de las $IdGRUPO
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="pro_proceso";
$Llave ="PRO_IdProceso";
class PRO_PROCESO
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$IdTabla'
     *
     * @param $IdTabla Identificador del registro
     * @return array Datos del registro
	 * @parametrousu = IdUsuario
	 * @Estado = Estado del proceso
     */
    public static function getAll($par1, $Estado, $parametrousu, $parametroemp, $parametrotipousu)
    {
        //echo $pars = "$par1, $Estado, $parametrousu, $parametroemp<br>";
        $condi = "";
		$condijoin = "";
		$condijoin2 = ""; 
		if($parametrousu != ""  && $parametrotipousu != "")  //Administrador(1) o Abogado(2)
		{
			if($parametrousu > 0 && $parametrotipousu == 2)   //if($parametrousu == 2)
			{	
				$condi = " AND PRO_IdUsuario = $parametrousu ";
			}
		}
		if($parametroemp != "")
		{
			//$condijoin = "  AND usu_usuario.USU_IdEmpresa = $parametroemp AND usu_usuario.USU_Estado = 1 ";
			$condijoin2 = " JOIN emp_empresa ON emp_empresa.EMP_IdEmpresa = usu_usuario.USU_IdEmpresa AND emp_empresa.EMP_IdEstado = 1 AND emp_empresa.EMP_IdEmpresa = $parametroemp ";
			//" JOIN emp_empresa E ON E.EMP_IdEmpresa = usu_usuario.USU_IdEmpresa AND E.EMP_IdEstado = 1 ";
			$condi = "";
		}
		$consulta = "SELECT ".$GLOBALS['Llave'].", PRO_NumeroProceso, PRO_FechaInicio, 
            PRO_IdUsuario, concat_WS(' ', USU_Nombre, USU_PrimerApellido,USU_SegundoApellido) AS AsignadoA,
            PRO_IdUbicacion, UBI_Nombre AS Ubicacion, 
            PRO_IdClaseProceso, CPR_Nombre AS ClaseProceso,
            PRO_IdJuzgadoOrigen, JUZ_Ubicacion AS Juzgado, 
            PRO_EstadoProceso, PRO_EnviaEmail, PRO_RepresentanteDe ,
            EPR_Nombre AS EstadoTabla ,
			concat_ws(' ',C.CLI_Nombre, C.CLI_PrimerApellido, C.CLI_SegundoApellido) AS NombreDemandante,
            concat_ws(' ',D.CLI_Nombre, D.CLI_PrimerApellido, D.CLI_SegundoApellido) AS NombreDemandado,
            PRO_IdEventoInusual, EVI_Nombre
            FROM ".$GLOBALS['TABLA'].
            " LEFT JOIN usu_usuario ON usu_usuario.USU_IdUsuario = PRO_IdUsuario  AND usu_usuario.USU_Estado = 1 ". $condijoin .
            " JOIN pro_ubicacion ON pro_ubicacion.UBI_IdUbicacion = PRO_IdUbicacion ".
            " JOIN pro_claseproceso ON pro_claseproceso.CPR_IdClaseProceso = PRO_IdClaseProceso ".
            " LEFT JOIN juz_juzgado ON juz_juzgado.JUZ_IdJuzgado = PRO_IdJuzgadoOrigen ".
            " JOIN pro_estadoproceso ON pro_estadoproceso.EPR_IdEstado = PRO_EstadoProceso AND pro_estadoproceso.EPR_Estado = 1 ".
			" JOIN cli_cliente C ON C.CLI_IdTipoCliente = 1 AND C.CLI_Estado = 1 AND C.CLI_IdCliente = ". $GLOBALS['TABLA'].".PRO_IdDemandante ".
            " JOIN cli_cliente D ON D.CLI_IdTipoCliente = 2 AND D.CLI_Estado = 1 AND D.CLI_IdCliente = ". $GLOBALS['TABLA'].".PRO_IdDemandado ".
            " LEFT JOIN gen_eventoinusual ON EVI_IdEventoInusual = PRO_IdEventoInusual AND EVI_Estado = 1 ".
			$condijoin2.
            " WHERE PRO_NumeroProceso > '' AND PRO_EstadoProceso = $Estado ". $condi .
            " ORDER BY PRO_NumeroProceso DESC; ";
			//echo $consulta ;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($par1, $Estado, $parametrousu, $parametroemp));

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de una tabla con un identificador
     * determinado
     *
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function getById($IdTabla)
    {
        // Consulta de la tabla Proceso
        $consulta = "SELECT ".$GLOBALS['Llave'].",
					PRO_IdDemandante,
					PRO_IdDemandado,
					PRO_NumeroProceso, 
					PRO_FechaInicio, 
					PRO_IdUsuario,
					PRO_IdUbicacion,
					PRO_IdClaseProceso,
					PRO_IdJuzgadoOrigen,
					PRO_EstadoProceso,
					PRO_IdArea,
					PRO_IdJuzgado,
					PRO_FechaCierre,
					PRO_ObservacionCierre,
					PRO_IdUsuarioCierre,
					PRO_RepresentanteDe ,
					PRO_EnviaEmail, PRO_FechaCreado, PRO_IdEventoInusual, EVI_Nombre
                    FROM ".$GLOBALS['TABLA'].
                    " LEFT JOIN gen_eventoinusual ON EVI_IdEventoInusual = PRO_IdEventoInusual AND EVI_Estado = 1 ".
					" WHERE ".$GLOBALS['Llave']." = ? ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	
	
	/**
     * Obtiene los campos de una tabla con un identificador
     * determinado
     *
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function getByIdHoy($IdTabla)
    {
        // Consulta de la tabla Proceso
        $consulta = "SELECT pp.PRO_IdProceso, pp.PRO_NumeroProceso, pp.PRO_FechaInicio, concat_ws(' ', uu.USU_Nombre, uu.USU_PrimerApellido , uu.USU_SegundoApellido ) AS Apoderado, ac.FC , ac.APR_Observaciones, ac.TAP_Nombre FROM pro_proceso pp JOIN usu_usuario uu ON uu.USU_IdUsuario = pp.PRO_IdUsuario AND uu.USU_Estado = 1 JOIN (SELECT APR_IdProceso, max(APR_FechaCreacion) AS FC, APR_Observaciones, TAP_Nombre FROM pro_actuacionprocesal join pro_tipoactuacionprocesal on pro_tipoactuacionprocesal.TAP_IdTipoActuacionProcesal = pro_actuacionprocesal.APR_IdTipoActuacionProcesal GROUP BY APR_IdProceso) ac ON ac.APR_IdProceso = pp.PRO_IdProceso WHERE pp.PRO_EstadoProceso =1 ORDER BY pp.PRO_IdProceso ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	
		/**
     * Obtiene los campos de una tabla con un identificador
     * determinado
     *
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function getByIdEstadoHoy($IdTabla)
    {
        // Consulta de la tabla Proceso
        $consulta = "SELECT pp.PRO_IdProceso, pp.PRO_NumeroProceso, pp.PRO_FechaInicio, concat_ws(' ', uu.USU_Nombre, uu.USU_PrimerApellido , uu.USU_SegundoApellido ) AS Apoderado, ac.FC , ac.APR_Observaciones, ac.TAP_Nombre FROM pro_proceso pp JOIN usu_usuario uu ON uu.USU_IdUsuario = pp.PRO_IdUsuario AND uu.USU_Estado = 1 JOIN (SELECT APR_IdProceso, max(APR_FechaCreacion) AS FC, APR_Observaciones, TAP_Nombre FROM pro_actuacionprocesal join pro_tipoactuacionprocesal on pro_tipoactuacionprocesal.TAP_IdTipoActuacionProcesal = pro_actuacionprocesal.APR_IdTipoActuacionProcesal GROUP BY APR_IdProceso) ac ON ac.APR_IdProceso = pp.PRO_IdProceso WHERE pp.PRO_EstadoProceso =1 ORDER BY pp.PRO_IdProceso LIMIT 5; ";
		//echo $consulta;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	
	/**
     * Obtiene los campos de todos los procesos activos que tiene
     * asignado un abogado
     *
     * @param $IdTabla Identificador del Usuario (Abogado)
     * @return mixed
     */
    public static function getByIdResponsable($IdTabla)
    {
        // Consulta de la tabla Proceso
        $consulta = "SELECT ".$GLOBALS['Llave'].",
					PRO_IdDemandante,
					PRO_IdDemandado,
					PRO_NumeroProceso, 
					PRO_FechaInicio, 
					PRO_IdUsuario,
					PRO_IdUbicacion,
					PRO_IdClaseProceso,
					PRO_IdJuzgadoOrigen,
					PRO_EstadoProceso,
					PRO_IdArea,
					PRO_IdJuzgado,
					PRO_FechaCierre,
					PRO_ObservacionCierre,
                    PRO_IdUsuarioCierre,
					PRO_EnviaEmail, 
					PRO_RepresentanteDe , PRO_FechaCreado, 
                    IF(CHAR_LENGTH(PRO_NumeroProceso)<23,CONCAT(PRO_NumeroProceso,'-',PRO_IdProceso),PRO_NumeroProceso) AS NP
					FROM ".$GLOBALS['TABLA'].
					" WHERE PRO_IdUsuario = ? AND PRO_EstadoProceso = 1 ORDER BY PRO_NumeroProceso; ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
	
	/**
     * Obtiene los campos de todos los procesos activos que tiene
     * asignado un abogado
     *
     * @param $IdTabla Identificador del Usuario (Abogado)
     * @return mixed
     */
    public static function getByIdProcesoResponsable($IdTabla)
    {
        // Consulta de la tabla Proceso
        $consulta = "SELECT ".$GLOBALS['Llave'].",					
					PRO_NumeroProceso
					FROM ".$GLOBALS['TABLA'].
					" WHERE PRO_IdUsuario = ? AND PRO_EstadoProceso = 1 ORDER BY PRO_NumeroProceso; ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

/**
     * Obtiene informacio los procesos asignado(s) un abogado     
     * @param $IdTabla Identificador del Usuario (Abogado)
     * @return mixed
     */
    public static function getByIdResponsableProceso($IdTabla)
    {
        // Consulta de la tabla Proceso
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS totalProcesos
					FROM ".$GLOBALS['TABLA'].
					" WHERE PRO_IdUsuario = ? AND PRO_EstadoProceso = 1 ORDER BY PRO_NumeroProceso; ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de una PRO_PROCESO con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstadoTabla)
    {
        // Consulta de la PRO_PROCESO
        $consulta = "SELECT ".$GLOBALS['Llave'].", UBI_Nombre, UBI_Estado ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE UBI_Estado = ? ORDER BY UBI_Nombre; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdEstadoTabla));

            // Muestra todos los rows
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }


    /**
     * Obtiene los campos de una PRO_PROCESO con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstadoTabla)
    {
        // Consulta de la PRO_PROCESO
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, PRO_NumeroProceso, PRO_EstadoProceso ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE ".$GLOBALS['Llave']."  = ? ;";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdEstadoTabla));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }


    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $Proceso            identificador
     * @param $Fechainicio        nuevo Nombre Tabla     
     * @param $Asignadoa       nueva Estado      
     * @param $Ubicacion,
     * @param $Claseproceso
     * @param $Demandante,
     * @param $Demandado,
     * @param $Estado,
	 * @param $Representa,
     * @param $IdTabla      
     * 
     */
    public static function update(
        $Proceso,
        $Fechainicio,
        $Asignadoa,
        $Ubicacion,
        $Claseproceso,
        $Demandante,
        $Demandado,
        $Estado,
		$Enviaemailcli,
		$Representa,
		$UsuarioModifica,
        $IdTabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET PRO_NumeroProceso=?, PRO_Fechainicio=?, PRO_IdUsuario=?, PRO_IdUbicacion=?, PRO_IdClaseProceso=?, ".
            " PRO_IdDemandante =?, PRO_IdDemandado=?, PRO_EstadoProceso=?, PRO_EnviaEmail = ?, PRO_RepresentanteDe =?, PRO_IdUsuarioModifica=? ".
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Proceso, $Fechainicio, $Asignadoa, $Ubicacion, $Claseproceso, $Demandante, $Demandado, $Estado, $Enviaemailcli, $Representa, $UsuarioModifica, $IdTabla ));

        return $cmd;
    }

    /**
     * Insertar un nueva Tabla
     *         
     * @param $IdTabla               identificador
     * @param $Proceso               Proceso     
     * @param $Fechainicio           Fechainicio
     * @param $Asignadoa             Asignadoa     
     * @param $Ubicacion             Ubicacion   
     * @param $Claseproceso          Claseproceso      
     * @param $Demandante            Demandante 
     * @param $Demandado             Demandado
     * @param $Estado                Estado
     * @param $Especialidad          Especialidad o Area
     * @param $Despacho              Despacho
	 * @param $Representa            Representa
     * @return PDOStatement
     */
    public static function insert(        
        $Demandante,
        $Demandado,
        $Proceso,
        $Fechainicio,
        $Asignadoa,
        $Ubicacion,
        $Claseproceso,                
        $JuzgadoOrigen,                
        $Estado,
        $Especialidad,
        $Despacho,
		$Representa,
		$UsuarioCrea
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " . 
            " PRO_IdDemandante, " .            
            " PRO_IdDemandado, " . 
            " PRO_NumeroProceso, " .            
            " PRO_FechaInicio, " . 
            " PRO_IdUsuario, " .            
            " PRO_IdUbicacion, " . 
            " PRO_IdClaseProceso, " .            
            " PRO_IdJuzgadoOrigen, " . 
            " PRO_EstadoProceso, " . 
            " PRO_IdArea, ".
            " PRO_IdJuzgado, ".
			" PRO_RepresentanteDe, ".
			" PRO_IdUsuarioCrea ".
            " )".     
            " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $Demandante,
                $Demandado,
                $Proceso,
                $Fechainicio,
                $Asignadoa,
                $Ubicacion,
                $Claseproceso,                
                $JuzgadoOrigen,                
                $Estado,
                $Especialidad,
                $Despacho,
				$Representa,
				$UsuarioCrea
            )
        );
    }

    /**
     * Cambia estado al registro con el identificador especificado
     *
     * @param $IdTabla identificador de la PRO_Proceso
     * @return bool Respuesta de la eliminación
     */
    public static function delete($Estado, $IdTabla)
    {
        // Sentencia DELETE
        $comando = "UPDATE ". $GLOBALS['TABLA'] ." SET PRO_EstadoProceso = ? WHERE ". $GLOBALS['Llave']. " = ? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($comando);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Estado, $IdTabla ));

        return $cmd;

        /*  Para borrar
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($Estado, $IdTabla));
        */
    }

    /**
     * Verifica si existe el PRO_Proceso
     *
     * @param $IdUsuario identificador de la PRO_Proceso
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Proceso, $Demandante, $Demandado, $Fecha, $Asignadoa)
    {
        $consulta = "SELECT Count(". $GLOBALS['Llave']. ") AS existe, PRO_NumeroProceso FROM ".$GLOBALS['TABLA'].
        " WHERE PRO_NumeroProceso = ? AND PRO_IdDemandante = ? AND PRO_IdDemandado = ? AND PRO_Fechainicio = ? 
		AND PRO_IdUsuario = ? AND PRO_EstadoProceso = 1; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Proceso, $Demandante, $Demandado, $Fecha, $Asignadoa));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Cierre de un Proceso: actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador      
     *
     * @param $Estado             Estado
     * @param $Observacion        Observacion del cierre    
     * @param $Usuario            usuario que realiza cierre
     * @param $FechaCierre        fecha de Cierre
     * @param $Pidtabla      
     */
       
    public static function cierre(
        $Estado,
        $Observacion,
        $Usuario,
        $FechaCierre,       
        $Idtabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET PRO_EstadoProceso=? , PRO_ObservacionCierre=?, PRO_IdUsuarioCierre=?, PRO_FechaCierre=? ".    
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Estado, $Observacion,  $Usuario, $FechaCierre, $Idtabla ));

        return $cmd;
    }
	
	/**
     * Obtiene informacion del email del abogado asignado al Proceso.
     * determinado
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function EmailProceso($IdProceso)
    {
        // Consulta de la tabla Proceso
        $consulta = "SELECT ".$GLOBALS['Llave'].", PRO_NumeroProceso, D.CLI_Email AS EmailCliente, 
					USU_Email, D.CLI_Identificacion AS IdenDemandante, TDD.TDO_Abreviatura AS AbreDemandante,
					DO.CLI_Identificacion AS IdenDemandado, TDDO.TDO_Abreviatura AS AbreDemandado
					FROM ". $GLOBALS['TABLA']. "
					JOIN usu_usuario ON usu_usuario.USU_IdUsuario = pro_proceso.PRO_IdUsuario 
						AND usu_usuario.USU_UsuarioEstado =1
					JOIN cli_cliente D ON D.CLI_IdCliente = pro_proceso.PRO_IdDemandante
					JOIN gen_tipodocumento TDD ON TDD.TDO_IdTipoDocumento = D.CLI_TipoDocumento
					JOIN cli_cliente DO ON DO.CLI_IdCliente = pro_proceso.PRO_IdDemandado
					JOIN gen_tipodocumento TDDO ON TDDO.TDO_IdTipoDocumento = DO.CLI_TipoDocumento					
					WHERE ".$GLOBALS['Llave']." = ? ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdProceso));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	/**
     * Obtiene informacion del email del abogado asignado al Proceso.
     * determinado
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function MaxId($IdProceso)
    {
        // Consulta de la tabla Proceso
        $consulta = "SELECT MAX(".$GLOBALS['Llave'].") AS MaxIdProceso FROM ". $GLOBALS['TABLA'] ;				
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdProceso));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	
	/**
     * Obtiene los campos para el encabezado de una Actuacion Procesal
     * determinada.     
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function getHeadProceso($IdTabla)
    {
        // Consulta de la tabla Proceso
        $consulta = "SELECT ".$GLOBALS['Llave'].",
					PRO_IdDemandante,
					PRO_IdDemandado,
					PRO_IdUsuario,
					PRO_NumeroProceso,
					concat_ws(' ', U.USU_Nombre, U.USU_PrimerApellido, U.USU_SegundoApellido) AS NombreAbogado,
					concat_ws(' ', C.CLI_Nombre, C.CLI_PrimerApellido, C.CLI_SegundoApellido) AS NombreDemandante,
					C.CLI_Identificacion AS DocDemandante, C.CLI_Direccion as DirDemandante,
					concat_ws(' ', D.CLI_Nombre, D.CLI_PrimerApellido, D.CLI_SegundoApellido) AS NombreDemandado,
					D.CLI_Identificacion AS DocDemandado, D.CLI_Direccion as DirDemandado,
					J.JUZ_Direccion AS DirJuzgado, J.JUZ_Piso, J.JUZ_Email, A.ARE_Nombre AS NombreArea 
					FROM ".$GLOBALS['TABLA'].
					" JOIN usu_usuario U ON U.USU_IdUsuario = PRO_IdUsuario AND U.USU_Estado = 1 ".
					" JOIN cli_cliente C ON C.CLI_IdCliente = PRO_IdDemandante AND C.CLI_Estado = 1 ".
					" JOIN cli_cliente D ON D.CLI_IdCliente = PRO_IdDemandado AND D.CLI_Estado = 1 ".
					" JOIN juz_juzgado J ON J.JUZ_IdJuzgado = PRO_IdJuzgado AND J.JUZ_Estado = 1 ".
					" JOIN juz_area A ON A.ARE_IdArea = J.JUZ_IdArea AND A.ARE_Estado = 1 ".
					" WHERE ".$GLOBALS['Llave']." = ? ; ";
			//echo $consulta;

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

        /**
     * Retorna todas las filas especificadas de la tabla '$IdTabla'
     * para presentar el Aplazamiento para cada proceso,
     * @param $IdTabla Identificador del registro
     * @return array Datos del registro
	 * @parametrousu = IdUsuario
	 * @Estado = Estado del proceso
     */
    public static function getAllTAP($tap, $np)
    {   
        $condi = "";
        $idevento = $tap;
        if($np > 0)
        {
            $condi = " AND PRO_NumeroProceso = $np ";
        }
		$consulta = "SELECT ".$GLOBALS['Llave'].", PRO_NumeroProceso, EVI_FechaInicio, EVI_Nombre, EVI_FechaFinal
            FROM ".$GLOBALS['TABLA'].     
            " JOIN gen_eventoinusual ON EVI_IdEventoInusual = $idevento AND EVI_IdEventoInusual = PRO_IdEventoInusual AND EVI_Estado = 1 
             WHERE PRO_EstadoProceso = 1 AND PRO_IdEventoInusual IS NOT NULL $condi 
             ORDER BY PRO_NumeroProceso; ";
			//echo $consulta ;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($tap, $np));

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $Proceso            identificador
     * @param $Fechainicio        nuevo Nombre Tabla     
     */
    public static function asigna( $TAP, $OPC, $IdTabla)    
    {
        $condiWhere = "";
        if($IdTabla == 0)
        {
            $condiWhere = "";
        }
        else
        {
            $condiWhere = " AND ". $GLOBALS['Llave'] ." = $IdTabla ;";
        }

        if($OPC == "d")
        {
            $TAP = 0;
        }

        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. " SET PRO_IdEventoInusual = $TAP ". 
                    " WHERE PRO_EstadoProceso = 1 ". $condiWhere;
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($TAP, $OPC, $IdTabla ));

        return $cmd;
    }
}
?>