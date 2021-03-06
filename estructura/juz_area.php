<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="juz_area";
$Llave ="ARE_IdArea";
class JUZ_AREA
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la juz_area '$IdTabla'
     *
     * @param $IdTabla Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT ".$GLOBALS['Llave'].", ARE_Nombre, ARE_Codigo, ".
            " CASE ARE_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla, ".
			" TJU_Nombre, TJU_Codigo ".
            " FROM ".$GLOBALS['TABLA'].
			" LEFT JOIN juz_tipojuzgado ON juz_tipojuzgado.TJU_IdTipoJuzgado = ARE_IdTipoJuzgado ".
			" ORDER BY ARE_Nombre; ";
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
        $consulta = "SELECT ".$GLOBALS['Llave'].",
					ARE_Nombre,                            
					ARE_Estado, 
                    ARE_Codigo, 
                    ARE_IdTipoJuzgado ".
					" FROM ".$GLOBALS['TABLA'].
					" WHERE ".$GLOBALS['Llave']." = ? ORDER BY ARE_Nombre; ";

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
     * Obtiene los campos de una gen_departamento con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstadoTabla)
    {
        // Consulta de la JUZ_AREA
        $consulta = "SELECT ".$GLOBALS['Llave'].", ARE_Nombre, ARE_Codigo, ARE_Estado, TJU_Nombre as corporacion ".
                    " FROM ". $GLOBALS['TABLA'].
                    " JOIN juz_tipojuzgado ON TJU_IdTipoJuzgado = ARE_IdTipoJuzgado".
                    " WHERE ARE_Estado = ? ORDER BY corporacion, ARE_Nombre; ";

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
     * Obtiene los campos de una juz_area con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstadoTabla)
    {
        // Consulta de la juz_area
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, ARE_Nombre, ARE_Estado ".
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
     * @param $Codigo            nuevo Codigo
	 * @param $Tipojuzgado       Tipo Juzgado
     * @param $IdEstadoTabla     nueva Estado       
     * 
     */
    public static function update(
        $nombre,
        $codigo,
		$tipojuzgado,
		$estado,
        $idtabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET ARE_Nombre=?, ARE_Codigo =?, ARE_IdTipoJuzgado=?, ARE_Estado=? " .
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $codigo, $tipojuzgado, $estado, $idtabla ));

        return $cmd;
    }

    /**
     * Insertar un nueva juz_area
     *         
     * @param $IdTabla            identificador
     * @param $Nombre             nuevo Nombre 
     * @param $Codigo             nuevo Codigo
     * @param $Estado             Estado
     * @param $Tipojuzgado        Tipo Juzgado 
     * @return PDOStatement
     */
    public static function insert(        
        $Nombre,       
        $Estado,
        $Codigo,
		$Tipojuzgado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " .            
            " ARE_Nombre," .            
            " ARE_Estado," .
            " ARE_Codigo,". 
			" ARE_IdTipoJuzgado".
            " )".     
            " VALUES(?,?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Nombre,                 
                $Estado,
                $Codigo,
				$Tipojuzgado
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de juz_area
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
     * Verifica si existe el Area
     *
     * @param $IdUsuario identificador de juz_area
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Nombre,$Codigo,$TipoJuzgado,$par4)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, ARE_Nombre FROM ".$GLOBALS['TABLA'].
        " WHERE ARE_Nombre = ? AND ARE_Codigo = ? AND ARE_IdTipoJuzgado = ? AND ". $GLOBALS['Llave']. " <> ? ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Nombre,$Codigo,$TipoJuzgado,$par4));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
}

?>