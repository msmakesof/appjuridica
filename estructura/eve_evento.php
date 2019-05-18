<?php
/**
 * Representa el la estructura de las $IdGRUPO
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="eve_evento";
$Llave ="Id";
class EVE_EVENTO
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
     * @param $Title               identificador
     * @param $Body               Proceso     
     * @param $Tipo           Fechainicio
     * @param $From             Asignadoa     
     * @param $To             Ubicacion   
     * @param $Inicio          Claseproceso      
     * @param $Final            Demandante 
     * @param $Proceso             Demandado
     * @param $Responsable                Estado     
     * @return PDOStatement
     */
    public static function insert(        
        $Title,
        $Body,        
        $Tipo,
        $Inicio,                
        $Final,
        $From,    
        $To,                    
        $Proceso,
        $Responsable        
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " . 
            " title, " .            
            " body, " . 
            " class, " .            
            " start, " . 
            " end, " .            
            " inicio_normal, " . 
            " final_normal, " .            
            " IdProceso, " . 
            " IdUsuario " .            
            " )".     
            " VALUES(?,?,?,?,?,?,?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $Title,
                $Body,        
                $Tipo,
                $Inicio,                
                $Final,
                $From,    
                $To,                            
                $Proceso,
                $Responsable
            )
        );
    }
    
    /**
     * Busca el maximo Id de la tabla eve_eventos
     * No envia parametros de entrada
     */
    public static function MaxId($parametro)
    {
        $consulta = "SELECT MAX(".$GLOBALS['Llave'].") AS MaxId 
            FROM ".$GLOBALS['TABLA'];
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($parametro));
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
     * actualiza url  para la agenda
     */
    public static function UpdateUrl(
        $MaxId,
        $MaxId1    
    )
    {
      // Creando consulta UPDATE
        $parUrl = "fc/descripcion_evento.php?id=";
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET url = '$parUrl' ? ".
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($MaxId, $MaxId1 ));

        return $cmd;  
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
     * Verifica si existe el Evento
     *
     * @param $IdUsuario identificador de Evento
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($From, $To, $Tipo, $Proceso, $Responsable)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, Id FROM ".$GLOBALS['TABLA'].
        " WHERE inicio_normal = ? AND final_normal = ? AND IdProceso = ? AND IdUsuario = ? ;";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($From, $To, $Tipo, $Proceso, $Responsable));
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