<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="gen_ciudad";
$Llave ="CIU_IdCiudades";
class GEN_CIUDAD
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
        $consulta = "SELECT ".$GLOBALS['Llave'].", CIU_Nombre, CIU_Abreviatura, CIU_IdDepartamento, ".
            " CASE CIU_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla, ".
            " DEP_Nombre ".
            " FROM ".$GLOBALS['TABLA'].
            " JOIN gen_departamento ON DEP_IdDepartamento = CIU_IdDepartamento ".
            " ORDER BY CIU_Nombre; ";
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
                            CIU_Nombre,
                            CIU_Abreviatura,
                            CIU_IdDepartamento,
                            CIU_Estado, 
                            DEP_CodigoDane ".
                            " FROM ".$GLOBALS['TABLA'].
                            " JOIN gen_departamento ON gen_departamento.DEP_IdDepartamento = CIU_IdDepartamento ".
                            " WHERE ".$GLOBALS['Llave']." = ? ORDER BY CIU_Nombre; ";

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
        $consulta = "SELECT ".$GLOBALS['Llave'].", CIU_Nombre, CIU_Abreviatura, CIU_IdDepartamento, CIU_Estado".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE CIU_Estado = ? ORDER BY CIU_Nombre; ";

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
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, CIU_Nombre, CIU_IdDepartamento, CIU_Estado ".
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
     * @param $Abreviatura       nueva Nombre Abreviatura
     * @param $Departamento      nueva Nombre Departamento
     * @param $IdEstadoTabla     nueva Estado       
     * 
     */
    public static function update(
        $nombre,
        $abreviatura,
        $depto,
        $estado,
        $idtabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET CIU_Nombre=?, CIU_Abreviatura = ?, CIU_IdDepartamento=?, CIU_Estado=? " .
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $abreviatura, $depto, $estado, $idtabla ));

        return $cmd;
    }

    /**
     * Insertar un nueva Ciudad
     *         
     * @param $IdTabla            identificador
     * @param $Nombre             nuevo Nombre Ciudad
     * @param $Abreviatura        nueva Nombre Abreviatura a mostrar
     * @param $Departamento       nueva Nombre Departamento a mostrar
     * @param $Estado             Estado   
     * @return PDOStatement
     */
    public static function insert(        
        $Nombre,
        $Abreviatura,
        $Depto,       
        $Estado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " .            
            " CIU_Nombre," . 
            " CIU_Abreviatura," .
            " CIU_IdDepartamento," .
            " CIU_Estado" . 
            " )".     
            " VALUES(?,?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Nombre, 
                $Abreviatura,
                $Depto,               
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
    public static function existetabla($Nombre,$Abreviatura, $Departamento)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, CIU_Nombre FROM ".$GLOBALS['TABLA'].
        " WHERE CIU_Nombre = ? AND CIU_Abreviatura = ? AND CIU_IdDepartamento = ?; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Nombre,$Abreviatura, $Departamento));
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
     * Verifica si existe el Pais
     *
     * @param $IdUsuario identificador de la gen_departamento
     * @return bool Respuesta de la consulta
     */
    public static function ciudadesxdepto($parametro) //($Deptoproceso, $Ciudadproceso)
    {
        $consulta = "SELECT CIU_IdCiudades, CIU_Nombre, CIU_Abreviatura, CIU_IdDepartamento, 
                CIU_Estado, gen_departamento.DEP_CodigoDane
            FROM gen_departamento
            JOIN gen_ciudad 
                ON gen_ciudad.CIU_IdDepartamento = gen_departamento.DEP_IdDepartamento
                AND gen_ciudad.CIU_Abreviatura > ''
            WHERE gen_departamento.DEP_CodigoDane > '' ORDER BY CIU_Nombre; ";        

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($parametro)); //$Deptoproceso, $Ciudadproceso));

            // Muestra todos los rows
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
}

?>