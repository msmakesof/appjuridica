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
            EPR_Nombre AS EstadoTabla 
            FROM ".$GLOBALS['TABLA'].
            " LEFT JOIN usu_usuario ON usu_usuario.USU_IdUsuario = PRO_IdUsuario ".
            " JOIN pro_ubicacion ON pro_ubicacion.UBI_IdUbicacion = PRO_IdUbicacion ".
            " JOIN pro_claseproceso ON pro_claseproceso.CPR_IdClaseProceso = PRO_IdClaseProceso ".
            " LEFT JOIN juz_juzgado ON juz_juzgado.JUZ_IdJuzgado = PRO_IdJuzgadoOrigen ".
            " JOIN pro_estadoproceso ON pro_estadoproceso.EPR_IdEstado = PRO_EstadoProceso AND pro_estadoproceso.EPR_Estado = 1 ".
            " WHERE PRO_NumeroProceso > '' ".
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
                            PRO_IdUsuarioCierre
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
        $IdTabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET PRO_NumeroProceso=?, PRO_Fechainicio=?, PRO_IdUsuario=?, PRO_IdUbicacion=?, PRO_IdClaseProceso=?, ".
            " PRO_IdDemandante =?, PRO_IdDemandado=?, PRO_EstadoProceso=? ".
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Proceso, $Fechainicio, $Asignadoa, $Ubicacion, $Claseproceso, $Demandante, $Demandado, $Estado, $IdTabla ));

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
        $Despacho
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
            " PRO_IdJuzgado".
            " )".     
            " VALUES(?,?,?,?,?,?,?,?,?,?,?) ;";

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
                $Despacho
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
    public static function existetabla($Proceso, $Demandante, $Demandado)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, PRO_NumeroProceso FROM ".$GLOBALS['TABLA'].
        " WHERE PRO_NumeroProceso = ? AND PRO_IdDemandante = ? AND PRO_IdDemandado = ? ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Proceso, $Demandante, $Demandado));
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
}
?>