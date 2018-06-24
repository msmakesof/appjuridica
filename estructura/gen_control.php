<?php

/**
 * Representa el la estructura de las $idControl
 * almacenadas en la base de datos
 */
require '../Connections/database.php';

class GEN_CONTROL
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$idControl'
     *
     * @param $idControl Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM gen_control";
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
     * Obtiene los campos de una meta con un identificador
     * determinado
     *
     * @param $idControl Identificador de la $idControl
     * @return mixed
     */
    public static function getById($idControl)
    {
        // Consulta de la gen_control
        $consulta = "SELECT CON_IdControl,
                            CON_LlaveAcceso,
                            CON_IdEstado,
                            CON_LlaveInicial,
                            CON_LlaveIv,
                            CON_MetodoEncriptacion,
                            CON_TipoHash
                            FROM gen_control
                            WHERE CON_IdControl = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idControl));
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
     * Obtiene los campos de una gen_control con un estado Activo
     * determinado
     *
     * @param $idEstado Identificador de la $idEstado
     * @return mixed
     */
    public static function getByIdEstado($idEstado)
    {
        // Consulta de la gen_consulta
        $consulta = "SELECT CON_IdControl,
                            CON_LlaveAcceso,
                            CON_IdEstado,
                            CON_LlaveInicial,
                            CON_LlaveIv,
                            CON_MetodoEncriptacion,
                            CON_TipoHash
                            FROM gen_control
                            WHERE CON_IdEstado = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idEstado));
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
     * @param $idControl            identificador
     * @param $LlaveAcceso          nuevo titulo
     * @param $IdEstado             nueva descripcion
     * @param $LlaveInicial         nueva fecha limite de cumplimiento
     * @param $LlaveIv              nueva categoria
     * @param $MetodoEncriptacion   nueva prioridad
     * @param $TipoHash             nueva categoria
     */
    public static function update(
        $idControl,
        $LlaveAcceso,
        $IdEstado,
        $LlaveInicial,
        $LlaveIv,
        $MetodoEncriptacion,
        $TipoHash
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE gen_control" .
            " SET CON_LlaveAcceso=?, CON_IdEstado=?, CON_LlaveInicial=?, CON_LlaveIv=?, CON_MetodoEncriptacion=?, CON_TipoHash=? " .
            " WHERE CON_IdControl=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($LlaveAcceso, $IdEstado, $LlaveInicial, $LlaveIv, $MetodoEncriptacion, $TipoHash, $idControl));

        return $cmd;
    }

    /**
     * Insertar una nueva gen_control
     *    
     * @param $LlaveAcceso          nuevo titulo
     * @param $IdEstado             nueva descripcion
     * @param $LlaveInicial         nueva fecha limite de cumplimiento
     * @param $LlaveIv              nueva categoria
     * @param $MetodoEncriptacion   nueva prioridad
     * @param $TipoHash             nueva categoria
     * @return PDOStatement
     */
    public static function insert(
        $LlaveAcceso,
        $IdEstado,
        $LlaveInicial,
        $LlaveIv,
        $MetodoEncriptacion,
        $TipoHash
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO gen_control ( " .
            " CON_LlaveAcceso," .
            " CON_IdEstado," .
            " CON_LlaveInicial," .
            " CON_LlaveIv," .
            " CON_MetodoEncriptacion,".
            " CON_TipoHash )" .
            " VALUES( ?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $LlaveAcceso,
                $IdEstado,
                $LlaveInicial,
                $LlaveIv,
                $MetodoEncriptacion,
                $TipoHash
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idControl identificador de la gen_control
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idControl)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM gen_control WHERE $idControl=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idControl));
    }
}

?>