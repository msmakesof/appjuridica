<?php

/**
 * Representa el la estructura de las $TUS_ID_TipoUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';

class GEN_TIPOUSUARIO
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$TUS_ID_TipoUsuario'
     *
     * @param $TUS_ID_TipoUsuario Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM usu_tipousuario ORDER BY TUS_Nombre; ";
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
     * @param $ID_TipoUsuario Identificador de la $ID_TipoUsuario
     * @return mixed
     */
    public static function getById($ID_TipoUsuario)
    {
        // Consulta de la tabla de tablas
        $consulta = "SELECT TUS_ID_TipoUsuario,
                            TUS_Nombre,                            
                            TUS_Estado,
                            TUS_FechaCreado
                            FROM usu_tipousuario
                            WHERE TUS_ID_TipoUsuario = ? ORDER BY TUS_Nombre; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($ID_TipoUsuario));
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
     * Obtiene los campos de una usu_tipousuario con un estado Activo
     * determinado
     *
     * @param $IdEstado Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstado)
    {
        // Consulta de la usu_tipousuario
        $consulta = "SELECT TUS_ID_TipoUsuario, TUS_Nombre, TUS_Estado
                    FROM usu_tipousuario
                    WHERE TUS_Estado = ? ORDER BY TUS_Nombre; ";

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
     * Obtiene los campos de una usu_tipousuario con un estado Activo
     * determinado y un total de registros que cumplan la condición del estado
     * Cuenta la cantidad de registros activos
     *
     * @param $IdEstado Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstado)
    {
        // Consulta de la usu_tipousuario
        $consulta = "SELECT Count(TUS_ID_TipoUsuario) AS TotalTablas, TUS_Nombre, TUS_Estado 
                    FROM usu_tipousuario
                    WHERE TUS_Estado = ? ;";

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
     * @param $TUS_ID_TipoUsuario  identificador
     * @param $TUS_Nombre          nuevo Abreviatura     
     * @param $TUS_Estado           nueva Estado       
     * 
     */
    public static function update(
        $ID_TipoUsuario,
        $TUS_Nombre,        
        $TUS_Estado     
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE usu_tipousuario" .
            " SET TUS_Nombre=?, TUS_FechaCreado=now(), TUS_Estado=? " .
            " WHERE TUS_ID_TipoUsuario=? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($TUS_Nombre, $TUS_Estado, $ID_TipoUsuario ));

        return $cmd;
    }

    /**
     * Insertar un nuevo Tipo Usuario
     *         
     * @param $ID_TipoUsuario   identificador
     * @param $TUS_Nombre           nuevo Abreviatura     *
     * @param $TUS_Estado           nueva Estado   
     * @return PDOStatement
     */
    public static function insert(        
        $TUS_Nombre,
        $TUS_Estado        
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO usu_tipousuario ( " .            
            " TUS_Nombre," .
            " TUS_Estado," .
            " TUS_FechaCreado," . 
            " )".     
            " VALUES(?,?,now()) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $TUS_Nombre,                
                $TUS_Estado
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $ID_TipoUsuario identificador de la usu_tipousuario
     * @return bool Respuesta de la eliminación
     */
    public static function delete($ID_TipoUsuario)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM usu_tipousuario WHERE TUS_ID_TipoUsuario = ? ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdTipoDocumento));
    }
}

?>