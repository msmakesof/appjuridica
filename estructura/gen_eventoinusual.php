<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="gen_eventoinusual";
$Llave ="EVI_IdEventoInusual";
class gen_eventoinusual
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas del evento '$IdTabla'
     *
     * @param $IdTabla Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT ".$GLOBALS['Llave'].", EVI_Nombre, EVI_FechaInicio, EVI_FechaFinal, ".
            " CASE EVI_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla ".
            " FROM ".$GLOBALS['TABLA'].
            " ORDER BY EVI_FechaInicio, EVI_Nombre; ";
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
        $consulta = "SELECT ".$GLOBALS['Llave'].", EVI_Nombre, EVI_FechaInicio, EVI_FechaFinal, EVI_Estado".                            
                            " FROM ".$GLOBALS['TABLA'].                            
                            " WHERE ".$GLOBALS['Llave']." = ? ORDER BY EVI_Nombre; ";

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
     * Obtiene los campos de una gen_eventoinusual con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstadoTabla)
    {
        // Consulta de la GEN_PAIS
        $consulta = "SELECT ".$GLOBALS['Llave'].", EVI_Nombre, EVI_FechaInicio, EVI_FechaFinal, EVI_Estado".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE EVI_Estado = ? ORDER BY EVI_Nombre; ";

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
     * Obtiene los campos de un gen_eventoinusual con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstadoTabla)
    {
        // Consulta de la gen_departamento
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas ".
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
     * @param $FechaInicio       nueva FechaInicio
     * @param $FechaFinal        nueva FechaFinal
     * @param $IdEstadoTabla     nueva Estado       
     * 
     */
    public static function update($nombre, $fechainicio, $fechafinal, $estado, $idtabla )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET EVI_Nombre = ?, EVI_FechaInicio = ?, EVI_FechaFinal = ?, EVI_Estado = ? " .
            " WHERE ". $GLOBALS['Llave'] ." = ? ;";
			//echo $consulta;

		//echo "$nombre, $fechainicio, $fechafinal, $estado, $idtabla<br>";
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $fechainicio, $fechafinal, $estado, $idtabla ));

        return $cmd;
    }

    /**
     * Insertar un nueva Ciudad
     *         
     * @param $IdTabla            identificador
     * @param $Nombre             nuevo Nombre Ciudad
     * @param $FechaInicio        nueva FechaInicio a mostrar
     * @param $FechaFinal         nueva FechaFinal a mostrar
     * @param $Estado             Estado   
     * @return PDOStatement
     */
    public static function insert(        
        $Nombre,
        $Fechainicio,
        $Fechafinal,       
        $Estado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " .            
            " EVI_Nombre," . 
            " EVI_FechaInicio," .
            " EVI_FechaFinal," .
            " EVI_Estado" . 
            " )".     
            " VALUES(?,?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Nombre, 
                $Fechainicio,
                $Fechafinal,               
                $Estado
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la gen_departamento
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
     * Verifica si existe el Pais
     *
     * @param $IdUsuario identificador de la gen_departamento
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Nombre,$Fechainicio, $Fechafinal, $par4)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, EVI_Nombre FROM ".$GLOBALS['TABLA'].
        " WHERE EVI_Nombre = ? AND EVI_FechaInicio = ? AND EVI_FechaFinal = ? AND ". $GLOBALS['Llave']. " <> ? ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Nombre,$Fechainicio, $Fechafinal, $par4));
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