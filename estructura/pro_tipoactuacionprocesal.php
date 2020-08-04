<?php
/**
 * Representa el la estructura de las $IdGRUPO
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="pro_tipoactuacionprocesal";
$Llave ="TAP_IdTipoActuacionProcesal";
class PRO_TIPOACTUACIONPROCESAL
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
        $consulta = "SELECT ".$GLOBALS['Llave'].", TAP_Nombre, OAP_Nombre AS Origen, 
            TAP_IdArea, ARE_Nombre AS area, TJU_Nombre AS corporacion,   
            CASE TAP_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla            
            FROM ".$GLOBALS['TABLA']."
            LEFT JOIN pro_origenactprocesal ON OAP_IdOrigen = TAP_IdOrigen AND OAP_Estado = 1
            LEFT JOIN juz_area ON ARE_IdArea = TAP_IdArea
            LEFT JOIN juz_tipojuzgado ON TJU_IdTipoJuzgado = ARE_IdTipoJuzgado
            ORDER BY TAP_Nombre; ";
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
                            TAP_Nombre, TAP_DiasHabiles, TAP_IdOrigen, TAP_Estado,
                            TAP_Notifica, TAP_IdPeriodo, TAP_IdArea
                            FROM ".$GLOBALS['TABLA'].
                            " WHERE ".$GLOBALS['Llave']." = ? ORDER BY TAP_Nombre; ";
        //echo "$consulta";

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
     * Obtiene los campos de una PRO_TIPOACTUACIONPROCESAL con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstadoTabla)
    {
        // Consulta de la PRO_TIPOACTUACIONPROCESAL
        $consulta = "SELECT ".$GLOBALS['Llave'].", TAP_Nombre, TAP_DiasHabiles, TAP_IdOrigen, TAP_Notifica, TAP_IdPeriodo, TAP_IdArea, TAP_Estado ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE TAP_Estado = ? ORDER BY TAP_Nombre; ";

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
     * Obtiene los campos de una PRO_TIPOACTUACIONPROCESAL con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstadoTabla)
    {
        // Consulta de la PRO_TIPOACTUACIONPROCESAL
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, TAP_Nombre, TAP_Estado ".
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
     * @param $Dias                nuevo Dias
     * @param $Origen              nuevo Origen
     * @param $IdEstadoTabla       nueva Estado 
     * @param $Area    
     * @param $Periodo
     * @param $Notifica
     */
    public static function update(
        $NombreTabla,        
        $Origen,        
        $IdEstadoTabla,
        $Area,        
        $IdTabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET TAP_Nombre=?, TAP_IdOrigen =?, TAP_Estado=?, TAP_IdArea=? " .
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($NombreTabla, $Origen, $IdEstadoTabla, $Area, $IdTabla ));

        return $cmd;
    }

    /**
     * Insertar un nueva Tabla
     *         
     * @param $IdTabla            identificador
     * @param $Nombre             nuevo Nombre      
     * @param $Dias               Dias
     * @param $Origen             Origen
     * @param $Estado             Estado
     * @param $Area
     * @param $Periodo
     * @param $Notifica      
     * @return PDOStatement
     */
    public static function insert(        
        $Nombre,
        //$Dias,
        $Origen,
        $Area,
        //$Periodo,
        //$Notifica,        
        $Estado        
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " . 
            " TAP_Nombre," .
            //" TAP_DiasHabiles," .
            " TAP_IdOrigen," .
            " TAP_IdArea," .
            //" TAP_IdPeriodo," .
            //" TAP_Notifica," .
            " TAP_Estado" . 
            " )".     
            " VALUES(?,?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Nombre,
                //$Dias,
                $Origen,
                $Area,
                //$Periodo,
                //$Notifica,
                $Estado
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la PRO_TIPOACTUACIONPROCESAL
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
     * @param $IdUsuario identificador de la PRO_TIPOACTUACIONPROCESAL
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Nombre,  $Origen, $Area, $par2)
    {
        //$Dias, $Periodo, $Notifica,
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, TAP_Nombre FROM ".$GLOBALS['TABLA'].
        " WHERE TAP_Nombre = ? AND  TAP_IdOrigen = ? AND TAP_IdArea =? AND ". $GLOBALS['Llave']. " <> ?; ";
        //TAP_DiasHabiles =? AND TAP_IdPeriodo=? AND TAP_Notifica =? AND
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Nombre, $Origen, $Area, $par2));
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
     * Verifica si existe el Grupo
     *
     * @param $IdUsuario identificador de la PRO_TIPOACTUACIONPROCESAL
     * @return bool Respuesta de la consulta
     */
    public static function maxid()
    {        
        $consulta = "SELECT MAX(". $GLOBALS['Llave']. ") MaxId FROM ".$GLOBALS['TABLA']." ; ";
        
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array());
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