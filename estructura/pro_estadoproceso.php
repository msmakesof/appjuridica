<?php
/**
 * Representa el la estructura de las $IdGRUPO
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="pro_estadoproceso";
$Llave ="EPR_IdEstado";
class PRO_ESTADOPROCESO
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
    public static function getAll()
    {
        $consulta = "SELECT ".$GLOBALS['Llave'].", EPR_Nombre,  
            CASE EPR_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla
            FROM ".$GLOBALS['TABLA']." ORDER BY EPR_Nombre; ";
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
                            EPR_Nombre,
                            EPR_Estado
                            FROM ".$GLOBALS['TABLA'].
                            " WHERE ".$GLOBALS['Llave']." = ? ORDER BY EPR_Nombre; ";

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
     * Obtiene los campos de una PRO_UBICACION con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstadoTabla)
    {
        // Consulta de PRO_UBICACION
        $consulta = "SELECT ".$GLOBALS['Llave'].", EPR_Nombre, EPR_Estado ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE EPR_Estado = ? ORDER BY EPR_Nombre; ";

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
     * Obtiene los campos de una PRO_UBICACION con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstadoTabla)
    {
        // Consulta de PRO_UBICACION
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, EPR_Nombre, EPR_Estado ".
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
     * @param $IdTabla            identificador
     * @param $Nombre_Tabla        nuevo Nombre Tabla     
     * @param $IdEstadoTabla       nueva Estado       
     * 
     */
    public static function update(
        $NombreTabla,        
        $IdEstadoTabla,
        $IdTabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET EPR_Nombre=?, EPR_Estado=? " .
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($NombreTabla, $IdEstadoTabla, $IdTabla ));

        return $cmd;
    }

    /**
     * Insertar un nueva Tabla
     *         
     * @param $IdTabla            identificador
     * @param $Nombre             nuevo Nombre Tabla     
     * @param $Estado             Estado   
     * @return PDOStatement
     */
    public static function insert(        
        $Nombre,        
        $Estado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " . 
            " EPR_Nombre," .            
            " EPR_Estado" . 
            " )".     
            " VALUES(?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Nombre,                
                $Estado
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la PRO_UBICACION
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
     * Verifica si existe el Grupo
     *
     * @param $IdUsuario identificador de PRO_UBICACION
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Nombre, $par2)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe FROM ".$GLOBALS['TABLA'].
        " WHERE EPR_Nombre = ? AND ". $GLOBALS['Llave']. " <> ?; ";

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
            return -1;
        }
    }
}

?>