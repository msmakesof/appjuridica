<?php

/**
 * Representa el la estructura de la tabla configuracion
 * almacenadas en la base de datos
 */
require '../Connections/database.php';

class GEN_CONFIGURACION
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$idConfiguracion'
     *
     * @param $idConfiguracion Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM gen_configuracion";
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
     * @param $idConfiguracion Identificador de la $idConfiguracion
     * @return mixed
     */
    public static function getById($idConfiguracion)
    {
        // Consulta de la gen_configuracion
        $consulta = "SELECT CON_IdConfiguracion,
                            CON_TituloApp,
                            CON_Logo,
                            CON_Estado
                            FROM gen_configuracion
                            WHERE CON_IdConfiguracion = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idConfiguracion));
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
     * Obtiene los campos de una gen_configuracion con un estado Activo
     * determinado
     *
     * @param $idEstado Identificador de la $idEstado
     * @return mixed
     */
    public static function getByIdEstado($idEstado)
    {
        // Consulta de la gen_consulta
        $consulta = "SELECT CON_IdConfiguracion,
                            CON_TituloApp,
                            CON_Logo,
                            CON_Estado
                            FROM gen_configuracion
                            WHERE CON_Estado = ?";

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
     * @param $idConfiguracion    identificador
     * @param $TituloApp          nuevo titulo
     * @param $Logo               nueva Logo
     * @param $Estado             nueva Estado
     */
    public static function update(
        $idConfiguracion,
        $TituloApp,
        $Logo,
        $Estado
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE gen_configuracion" .
            " SET CON_TituloApp=?, CON_Logo=?, CON_Estado=? " .
            " WHERE CON_IdConfiguracion=? ";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($TituloApp, $Logo, $Estado));

        return $cmd;
    }

    /**
     * Insertar una nueva gen_configuracion
     *    
     * @param $TituloApp          nuevo titulo
     * @param $Logo               nueva Logo
     * @param $Estado             nueva Estado
     * @return PDOStatement
     */
    public static function insert(
        $TituloApp,
        $Logo,
        $Estado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO gen_configuracion ( " .
            " CON_TituloApp," .
            " CON_Logo," .
            " CON_Estado )" .
            " VALUES( ?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $TituloApp,
                $Logo,
                $Estado
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idConfiguracion identificador de la gen_configuracion
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idConfiguracion)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM gen_configuracion WHERE $idConfiguracion=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idConfiguracion));
    }
}

?>