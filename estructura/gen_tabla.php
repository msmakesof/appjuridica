<?php

/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';

class USU_USUARIO
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$IdTabla'
     *
     * @param $IdIdTabla Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM gen_tabla";
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
        $consulta = "SELECT TAB_IdTabla,
                            TAB_Nombre_Tabla,
                            TAB_NombreMostrar,
                            TAB_IdEstadoTabla
                            FROM gen_tabla
                            WHERE TAB_IdTabla = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdUsuario));
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
     * Obtiene los campos de una gen_tabla con un estado Activo
     * determinado
     *
     * @param $IdTabla Identificador de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdTabla)
    {
        // Consulta de la gen_tabla
        $consulta = "SELECT TAB_IdEstadoTabla
                    FROM gen_tabla
                    WHERE IdTabla = ?";

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
     * Obtiene los campos de una gen_tabla con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstadoTabla)
    {
        // Consulta de la gen_tabla
        $consulta = "SELECT Count(TAB_IdTabla) AS TotalTablas, TAB_Nombre_Tabla, TAB_NombreMostrar, TAB_IdEstadoTabla 
                    FROM gen_tabla
                    WHERE TAB_IdEstadoTabla = ? ";

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
     * @param $NombreMostrar       nueva Nombre Tabla a mostrar
     * @param $IdEstadoTabla       nueva Estado       
     * 
     */
    public static function update(
        $IdTabla,
        $Nombre_Tabla,
        $NombreMostrar,
        $IdEstadoTabla    
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE gen_tabla" .
            " SET TAB_Nombre_Tabla=?, TAB_NombreMostrar=?, TAB_IdEstadoTabla=? " .
            " WHERE TAB_IdTabla=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Nombre_Tabla, $NombreMostrar, $IdEstadoTabla, $IdTabla ));

        return $cmd;
    }

    /**
     * Insertar un nuevo Usuario
     *         
     * @param $IdTabla            identificador
     * @param $Nombre_Tabla        nuevo Nombre Tabla
     * @param $NombreMostrar       nueva Nombre Tabla a mostrar
     * @param $IdEstadoTabla       nueva Estado   
     * @return PDOStatement
     */
    public static function insert(        
        $Nombre_Tabla,
        $NombreMostrar,
        $IdEstadoTabla
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO gen_tabla ( " .            
            " TAB_Nombre_Tabla," .
            " TAB_NombreMostrar," .
            " TAB_IdEstadoTabla," . 
            " )".     
            " VALUES(?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Nombre_Tabla,
                $NombreMostrar,
                $IdEstadoTabla
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la gen_tabla
     * @return bool Respuesta de la eliminación
     */
    public static function delete($IdTabla)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM gen_tabla WHERE $IdTabla=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdTabla));
    }
}

?>