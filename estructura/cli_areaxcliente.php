<?php
/**
 * Representa el la estructura de las $IdEdificio
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="cli_areaxcliente";
$Llave ="ARC_Id_AreaCliente";
class CLI_AREAXCLIENTE
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la Ciudad '$IdTabla'
     *
     * @param $IdTabla Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT ".$GLOBALS['Llave'].", ARC_IdEmpresa, ARC_IdTipoJuzgado, ARC_IdArea,			
			  CONCAT_WS(' ',E.EMP_Nombre,E.EMP_Nombre2,E.EMP_Apellido,E.EMP_Apellido2) AS NombreEmpresa 
			, TJU_Nombre AS NombreCorporacion, JA.ARE_Nombre AS NombreArea ".
            " FROM ".$GLOBALS['TABLA'].
			" JOIN emp_empresa E ON E.EMP_IdEmpresa = ".$GLOBALS['TABLA']. ".ARC_IdEmpresa ".
			" JOIN juz_tipojuzgado TJ ON TJ.TJU_IdTipoJuzgado = ".$GLOBALS['TABLA']. ".ARC_IdTipoJuzgado ".
			" JOIN juz_area JA ON JA.ARE_IdArea = cli_areaxcliente.ARC_IdArea AND JA.ARE_Estado = 1 ".
			" WHERE cli_areaxcliente.ARC_Estado = 1 ORDER BY NombreEmpresa ;";
			
			//echo $consulta;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

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
        // Consulta de la tabla de tablas
        $consulta = "SELECT ".$GLOBALS['Llave'].", EDI_Nombre, EDI_Direccion, EDI_Estado ".
            " FROM ".$GLOBALS['TABLA'].
            " WHERE ".$GLOBALS['Llave']." = ? ORDER BY EDI_Nombre; ";

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
            return "Err.Stru(ln49)...$consulta";
        }
    }


    /**
     * Obtiene los campos de una gen_departamento con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstadoTabla)
    {
        // Consulta de la GEN_EDIFICIO
        $consulta = "SELECT ".$GLOBALS['Llave'].", EDI_Nombre, EDI_Estado".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE EDI_Estado = ? ORDER BY EDI_Nombre; ";

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
            return "Err.Stru(ln80)...$consulta";
        }
    }


    /**
     * Obtiene los campos de una GEN_EDIFICIO con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstadoTabla)
    {
        // Consulta de la gen_departamento
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, EDI_Nombre, EDI_Estado ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE ".$GLOBALS['Llave']." = ? ;";

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
     * @param $IdTabla           identificador
     * @param $Nombre            nuevo Nombre
	 * @param $Nombre            nuevo Direccion
     * @param $IdEstadoTabla     nueva Estado       
     * 
     */
    public static function update(
        $nombre,        
		$direccion,
        $estado,
        $idtabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET EDI_Nombre=?, EDI_Direccion=?, EDI_Estado=? " .
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $direccion, $estado, $idtabla ));

        return $cmd;
    }

    /**
     * Insertar un nuevo Edificio
     *         
     * @param $Items            Array
     * @return PDOStatement
     */
    public static function insert( $Items )	
    {
        $Items =  str_replace("[","", $Items);
		$Items =  str_replace("]","", $Items);
		$AItems = explode(",", $Items);		
		
		$IdEmpresa = $AItems[0]; 	  // IdEmpresa
		$IdTipojuzgado = $AItems[1];  // IdTipojuzgado => Corporación / Jurisdicción		
		unset($AItems[0],$AItems[1]);
		
		$consulta = "UPDATE ". $GLOBALS['TABLA']. " SET ARC_Estado = 0 WHERE ARC_IdEmpresa = $IdEmpresa AND ARC_IdTipoJuzgado = $IdTipojuzgado; ";
		 // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);
		$cmd->execute(); 
		
		$opc = array_slice($AItems, 0);
		
		for($i=0; $i<count($opc); $i++)
		{		
			$IdArea = $opc[$i];			
			$datoUnico[] = '('.$IdEmpresa.', '.$IdTipojuzgado.', '.$IdArea.', 1)'; 
			// Sentencia INSERT
			$comando = "INSERT INTO cli_areaxcliente ( ARC_IdEmpresa, ARC_IdTipoJuzgado, ARC_IdArea, ARC_Estado ) VALUES ". implode(', ', $datoUnico);
		}				

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array( $Items )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la gen_Edificio
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

    /**
     * Verifica si existe el Edificio
     *
     * @param $IdEdificio identificador de la gen_Edificio
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Nombre, $par2)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe FROM ".$GLOBALS['TABLA'].
        " WHERE EDI_Nombre = ? AND ". $GLOBALS['Llave']. " <> ? ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Nombre, $par2));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return $e;
        }
    }
}

?>