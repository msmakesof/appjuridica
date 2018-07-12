<?php

/**
 * Representa el la estructura de las $IdTipoDocumento
 * almacenadas en la base de datos
 */
require '../Connections/database.php';

class GEN_TIPODOCUMENTO
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$IdTipoDocumento'
     *
     * @param $IdTipoDocumento Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM gen_tipodocumento ORDER BY TDO_Nombre; ";
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
     * @param $IdTipoDocumento Identificador de la $IdTipoDocumento
     * @return mixed
     */
    public static function getById($IdTipoDocumento)
    {
        // Consulta de la tabla de tablas
        $consulta = "SELECT TDO_IdTipoDocumento,
                            TDO_Abreviatura,
                            TDO_Nombre,
                            TDO_Estado
                            FROM gen_tipodocumento
                            WHERE TDO_IdTipoDocumento = ? ORDER BY TDO_Nombre; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTipoDocumento));
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
     * Obtiene los campos de una gen_tipodocumento con un estado Activo
     * determinado
     *
     * @param $IdEstado Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstado)
    {
        // Consulta de la gen_tipodocumento
        $consulta = "SELECT TDO_IdTipoDocumento, TDO_Abreviatura, TDO_Nombre
                    FROM gen_tipodocumento
                    WHERE TDO_Estado = ? ORDER BY TDO_Nombre; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdEstado));

            // Muestra todos los rows
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }


    /**
     * Obtiene los campos de una gen_tipodocumento con un estado Activo
     * determinado y un total de registros que cumplan la condición del estado
     * Cuenta la cantidad de registros activos
     *
     * @param $IdEstado Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstado)
    {
        // Consulta de la gen_tipodocumento
        $consulta = "SELECT Count(TDO_IdTipoDocumento) AS TotalTablas, TDO_Abreviatura, TDO_Nombre, TDO_Estado 
                    FROM gen_tipodocumento
                    WHERE TDO_Estado = ? ;";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdEstado));
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
     * @param $IdTipoDocumento     identificador
     * @param $Abreviatura         nuevo Abreviatura
     * @param $Nombre              nueva Nombre 
     * @param $IdEstado            nueva Estado       
     * 
     */
    public static function update(
        $IdTipoDocumento,
        $Abreviatura,
        $Nombre,
        $IdEstado     
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE gen_tipodocumento" .
            " SET TDO_Abreviatura=?, TDO_Nombre=?, TDO_Estado=? " .
            " WHERE TDO_IdTipoDocumento=? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Abreviatura, $Nombre, $IdEstado, $IdTipoDocumento ));

        return $cmd;
    }

    /**
     * Insertar un nuevo Tipo Documento
     *         
     * @param $IdTipoDocumento     identificador
     * @param $Abreviatura         nuevo Abreviatura
     * @param $Nombre              nueva Nombre 
     * @param $IdEstado            nueva Estado   
     * @return PDOStatement
     */
    public static function insert(        
        $Abreviatura,
        $Nombre,
        $IdEstado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO gen_tipodocumento ( " .            
            " TDO_Abreviatura," .
            " TDO_Nombre," .
            " TDO_Estado," . 
            " )".     
            " VALUES(?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Abreviatura,
                $Nombre,
                $IdEstado
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTipoDocumento identificador de la gen_tipodocumento
     * @return bool Respuesta de la eliminación
     */
    public static function delete($IdTipoDocumento)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM gen_tipodocumento WHERE TDO_IdTipoDocumento = ? ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdTipoDocumento));
    }
}

?>