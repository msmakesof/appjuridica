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
     */
    public static function getAll()
    {
        $consulta = "SELECT ".$GLOBALS['Llave'].", PRO_NumeroProceso, PRO_FechaInicio, 
            PRO_IdUsuario, concat_WS(' ', USU_Nombre, USU_PrimerApellido,USU_SegundoApellido) AS AsignadoA,
            PRO_IdUbicacion, UBI_Nombre AS Ubicacion, 
            PRO_IdClaseProceso, CPR_Nombre AS ClaseProceso,
            PRO_IdJuzgadoOrigen, JUZ_Ubicacion AS Juzgado, 
            PRO_EstadoProceso, 
            CASE PRO_EstadoProceso WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla 
            FROM ".$GLOBALS['TABLA'].
            " JOIN usu_usuario ON usu_usuario.USU_IdUsuario = PRO_IdUsuario ".
            " JOIN pro_ubicacion ON pro_ubicacion.UBI_IdUbicacion = PRO_IdUbicacion ".
            " JOIN pro_claseproceso ON pro_claseproceso.CPR_IdClaseProceso = PRO_IdClaseProceso ".
            " LEFT JOIN juz_juzgado ON juz_juzgado.JUZ_IdJuzgado = PRO_IdJuzgadoOrigen ".
            " ORDER BY PRO_NumeroProceso; ";
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
                            UBI_Nombre,
                            UBI_Estado
                            FROM ".$GLOBALS['TABLA'].
                            " WHERE ".$GLOBALS['Llave']." = ? ORDER BY UBI_Nombre; ";

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
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, UBI_Nombre, UBI_Estado ".
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
            " SET UBI_Nombre=?, UBI_Estado=? " .
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
     * @param $IdTabla               identificador
     * @param $Proceso               Proceso     
     * @param $Fechainicio           Fechainicio
     * @param $Asignadoa             Asignadoa     
     * @param $Ubicacion             Ubicacion   
     * @param $Claseproceso          Claseproceso      
     * @param $Demandante            Demandante 
     * @param $Demandado             Demandado
     * @param $Estado                Estado 
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
        $Estado
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
            " PRO_EstadoProceso " . 
            " )".     
            " VALUES(?,?,?,?,?,?,?,?,?) ;";

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
                $Estado
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la GEN_GRUPO
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
     * @param $IdUsuario identificador de la GEN_GRUPO
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Nombre)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, UBI_Nombre FROM ".$GLOBALS['TABLA'].
        " WHERE UBI_Nombre = ? ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Nombre));
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