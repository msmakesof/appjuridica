<?php
/**
 * Representa el la estructura de las $IdGRUPO
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="pro_actuacionprocesal";
$Llave ="APR_IdActuacionProcesal";
class PRO_ACTUACIONPROCESAL
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$IdTabla'
     *
     * @param $IdTabla Identificador del registro
     * @return array Datos del registro
     */
	 // 
	 // " LEFT JOIN usu_usuario ON usu_usuario.USU_IdUsuario = pro_actuacionprocesal.APR_IdUsuario ".            
     // 
	 // " WHERE APR_IdProceso = ? AND APR_EstadoActProcesal = ? ".    $par2, $par3
	 
    public static function getAll($par4, $par3)   // $par4 = IdUsuario = Abogado      IDEmpresa = Admin     0 = SA
    {
        $condiWhere = "";
		if($par4 != 4)
		{
			$condiWhere = " JOIN usu_usuario U ON U.USU_IdUsuario = pro_actuacionprocesal.APR_IdUsuario ";
		}
		
		$consulta = "SELECT ".$GLOBALS['Llave'].", APR_IdProceso, 
            APR_IdTipoActuacionProcesal, APR_FechaCreacion, APR_Observaciones, APR_IdUsuario, 
            APR_FechaHabil, APR_EstadoActProcesal, APR_Gasto, TAP_Nombre , PRO_NumeroProceso          
            FROM ".$GLOBALS['TABLA']. 
			" LEFT JOIN pro_tipoactuacionprocesal ON TAP_IdTipoActuacionProcesal = APR_IdTipoActuacionProcesal ".
			" JOIN pro_proceso ON PRO_IdProceso = APR_IdProceso " . $condiWhere .
            " WHERE APR_IdProceso = ? ".
            " ORDER BY APR_FechaCreacion ; ";
			
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($par3));

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
							APR_IdProceso, 
							APR_IdTipoActuacionProcesal, 
							APR_FechaCreacion, 
							APR_Observaciones, 
							APR_IdUsuario, 
							APR_FechaHabil, 
							APR_EstadoActProcesal,
							APR_Gasto
                            FROM ".$GLOBALS['TABLA'].
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
     * Verifica si existe el PRO_ACTUACIONPROCESAL
     *
     * @param $IdUsuario identificador de la PRO_ACTUACIONPROCESAL
     * @return bool Respuesta de la consulta
     */
    public static function existeactpro($Proceso, $FechaInicio, $Origen, $ActPro, $FechaEstado, $Observacion)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, APR_IdActuacionProcesal FROM ".$GLOBALS['TABLA'].
        " WHERE APR_IdActuacionProcesal = ? AND APR_IdOrigen = ? AND APR_FechaCreacion = ? AND APR_IdTipoActuacionProcesal = ? AND APR_FechaHabil = ? 
		AND APR_Observaciones = ? AND APR_EstadoActProcesal = 1; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Proceso, $FechaInicio, $Origen, $ActPro, $FechaEstado, $Observacion));
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
     * Insertar un nuevo Registro
     *         
     * @param $Proceso            Proceso 
     * @param $Fechainicio        Fechainicio
     * @param $Origen             Origen
     * @param $ActPro             ActPro
     * @param $FechaEstado        FechaEstado
     * @param $Observacion        Observacion
	 * @param $Usuario			  Usuario
	 * @param $EstadoActPro		  EstadoActPro
     * @return PDOStatement
     */
    public static function insert(        
        $Proceso,
        $Fechainicio,
        $Origen,
        $ActPro,        
        $FechaEstado,
        $Observacion,
		$Usuario,
		$EstadoActPro,
		$Gasto
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " . 
            " APR_IdProceso, " .            
            " APR_FechaCreacion, " .
            " APR_IdOrigen, ". 
            " APR_IdTipoActuacionProcesal, " .            
            " APR_FechaHabil, " . 
            " APR_Observaciones, " .            
            " APR_IdUsuario, " .
            " APR_EstadoActProcesal, ".
			" APR_Gasto ".
            " )".     
            " VALUES(?,?,?,?,?,?,?,?,?) ;";			

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $Proceso,
                $Fechainicio,
                $Origen,
				$ActPro,        
				$FechaEstado,
				$Observacion,
				$Usuario,
				$EstadoActPro,
				$Gasto
            )
        );
    }
	
	/**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $IdTabla            identificador
     * @param $Nombre_Tabla        nuevo Nombre Tabla
     * @param $NombreMostrar       nueva Nombre Tabla a mostrar
     * @param $IdEstadoTabla       nueva Estado       
     * 
     */
    public static function update(
        $Fechainicio,		
        $Actpro,
        $Fechaestado,
		$Observaciones,
		$Gasto,
        $Idtabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA'] .
            " SET APR_FechaCreacion=?, APR_IdTipoActuacionProcesal=?, APR_FechaHabil=?, APR_Observaciones=?, APR_Gasto=? " .
            " WHERE ". $GLOBALS['Llave']. " =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Fechainicio, $Actpro, $Fechaestado, $Observaciones, $Gasto, $Idtabla ));

        return $cmd;
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
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la pro_actuacionprocesal
     * @return bool Respuesta de la eliminación
     */
    public static function delete($IdTabla)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM ". $GLOBALS['TABLA'] ." WHERE ". $GLOBALS['Llave']. " = ? ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdTabla));
    }
}
?>