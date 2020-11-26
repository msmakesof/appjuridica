<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="gen_festivo";
$Llave ="FES_IdFestivo";
class GEN_FESTIVO
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
        $consulta = "SELECT ".$GLOBALS['Llave'].", FES_Festivo, FES_VanciaJudicial, ".
            " CASE FES_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla ".
            " FROM ".$GLOBALS['TABLA']." ORDER BY FES_Festivo; ";
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
                            FES_Festivo,
                            FES_VanciaJudicial,
                            FES_Estado ".
                            " FROM ".$GLOBALS['TABLA'].
                            " WHERE ".$GLOBALS['Llave']." = ? ORDER BY FES_Festivo; ";

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
        // Consulta de la GEN_PAIS
        $consulta = "SELECT ".$GLOBALS['Llave'].", FES_Festivo, FES_VanciaJudicial, FES_Estado".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE FES_Estado = ? ORDER BY FES_Festivo; ";

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
     * Obtiene los campos de una GEN_PAIS con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstadoTabla)
    {
        // Consulta de la gen_departamento
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, FES_Festivo, FES_VanciaJudicial, FES_Estado ".
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
     * @param $Nombre            nuevo Nombre Tabla
     * @param $VanciaJudicial    nueva Nombre VanciaJudicial a mostrar
     * @param $IdEstadoTabla     nueva Estado       
     * 
     */
    public static function update(
        $nombre,
        $vanciaJudicial,
        $estado,
        $idtabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET FES_Festivo=?, FES_VanciaJudicial=?, FES_Estado=? " .
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $vanciaJudicial, $estado, $idtabla ));

        return $cmd;
    }

    /**
     * Insertar un nuevo festivo
     *         
     * @param $IdTabla            identificador
     * @param $Nombre             nuevo Nombre Ciudad
     * @param $VanciaJudicial     nueva Nombre VanciaJudicial a mostrar
     * @param $Estado             Estado   
     * @return PDOStatement
     */
    public static function insert(        
        $Nombre,        
        $VanciaJudicial,       
        $Estado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " .            
            " FES_Festivo," . 
            " FES_VanciaJudicial," .
            " FES_Estado" . 
            " )".     
            " VALUES(?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Nombre, 
                $VanciaJudicial,               
                $Estado
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la gen_festivo
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
     * Verifica si existe el festivo
     *
     * @param $IdUsuario identificador de la gen_festivo
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Nombre)  //, $par2
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe FROM ".$GLOBALS['TABLA'].
        " WHERE FES_Festivo = ? ; ";	// AND ". $GLOBALS['Llave']. " <> ?

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Nombre));  // , $par2
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