<?php
/**
 * Representa el la estructura de las $IdGRUPO
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="pro_gasto";
$Llave ="GAS_IdGasto";
class PRO_GASTO
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
	 // " LEFT JOIN usu_usuario ON usu_usuario.USU_IdUsuario = pro_gasto.APR_IdUsuario ".            
     // " LEFT JOIN pro_tipoactuacionprocesal ON TAP_IdTipoActuacionProcesal = APR_IdTipoActuacionProcesal ".
	 // " WHERE APR_IdProceso = ? AND APR_EstadoActProcesal = ? ".    $par2, $par3
	 
    public static function getAll($par4, $par3)   // $par4 = IdUsuario = Abogado      IDEmpresa = Admin     0 = SA
    {
        $condiWhere = "";
		if($par4 != 4)
		{
			$condiWhere = " JOIN usu_usuario U ON U.USU_IdUsuario = pro_gasto.GAS_IdUsuario ";
		}
		
		$consulta = "SELECT ".$GLOBALS['Llave'].", GAS_IdProceso, GAS_FechaGestionGasto, 
            GAS_Concepto, GAS_Valor, PRO_NumeroProceso          
            FROM ".$GLOBALS['TABLA']. 			
			" JOIN pro_proceso ON PRO_IdProceso = GAS_IdProceso " . $condiWhere .
            " WHERE GAS_IdProceso = ? ".
            " ORDER BY GAS_FechaGestionGasto ; ";			
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
						GAS_IdProceso,
						GAS_FechaGestionGasto,
						GAS_Concepto,
						GAS_IdUsuario,
						GAS_Valor
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
     * Verifica si existe el pro_gasto
     *
     * @param $IdUsuario identificador de la pro_gasto
     * @return bool Respuesta de la consulta
     */
    public static function existeactpro($Proceso, $FechaInicio, $Concepto, $Valor)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe FROM ".$GLOBALS['TABLA'].
        " WHERE GAS_IdProceso = ? AND GAS_FechaGestionGasto = ? AND GAS_Concepto = ? AND GAS_Valor = ? ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Proceso, $FechaInicio, $Concepto, $Valor));
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
     * @param $Proceso           Proceso 
     * @param $Concepto          Concepto
     * @param $Valor             Valor
     * @return PDOStatement
     */
    public static function insert(        
        $Proceso,
		$Fechainicio,
        $Concepto,
		$Usuario,
        $Valor
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " . 
            " GAS_IdProceso, " .
            " GAS_FechaGestionGasto, " .
            " GAS_Concepto, " . 
			" GAS_IdUsuario, " .
            " GAS_Valor " .
            " )".     
            " VALUES(?,?,?,?,?) ;";			

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $Proceso,
				$Fechainicio,
				$Concepto,
				$Usuario,
				$Valor
            )
        );
    }
	
	/**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $Proceso           Proceso 
     * @param $Concepto          Concepto
     * @param $Valor             Valor       
     * 
     */
    public static function update(
		$FechaGestionGasto,
        $Concepto,
        $Valor,
        $Idtabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA'] .
            " SET GAS_FechaGestionGasto =?, GAS_Concepto=?, GAS_Valor=? " .
            " WHERE ". $GLOBALS['Llave']. " =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($FechaGestionGasto, $Concepto, $Valor, $Idtabla ));

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
     * @param $IdTabla identificador de la pro_gasto
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