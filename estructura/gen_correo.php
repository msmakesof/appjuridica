<?php

/**
 * Representa el la estructura de las $IdCorreo
 * almacenadas en la base de datos
 */
require '../Connections/database.php';

class GEN_CORREO
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$IdCorreo'
     *
     * @param $IdCorreo Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM gen_correo";
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
     * @param $IdCorreo Identificador de la $IdCorreo
     * @return mixed
     */
    public static function getById($IdCorreo)
    {
        // Consulta de la gen_correo
        $consulta = "SELECT COR_IdCorreo,
                    COR_Autenticador,
                    COR_Seguridad,
                    COR_Servidor,
                    COR_Puerto,
                    COR_Usuario,
                    COR_Clave,
                    COR_TiempoEspera,
                    COR_TextoCuentaOrigen
                    FROM gen_correo
                    WHERE COR_IdCorreo = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdCorreo));
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
     * Obtiene los campos de una gen_correo con un estado Activo
     * determinado
     *
     * @param $idEstado Identificador de la $idEstado
     * @return mixed
     */
    public static function getByIdEstado($idEstado)
    {
        // Consulta de la gen_consulta
        $consulta = "SELECT COR_IdCorreo,
                            COR_Autenticador,
                            COR_Seguridad,
                            COR_Servidor,
                            COR_Puerto,
                            COR_Usuario,
                            COR_Clave
                            FROM gen_correo
                            WHERE COR_Seguridad = ?";

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
     * @param $IdCorreo            identificador
     * @param $LlaveAcceso          nuevo titulo
     * @param $IdEstado             nueva descripcion
     * @param $LlaveInicial         nueva fecha limite de cumplimiento
     * @param $LlaveIv              nueva categoria
     * @param $MetodoEncriptacion   nueva prioridad
     * @param $TipoHash             nueva categoria
     */
    public static function update(
        $IdCorreo,
        $LlaveAcceso,
        $IdEstado,
        $LlaveInicial,
        $LlaveIv,
        $MetodoEncriptacion,
        $TipoHash
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE gen_correo" .
            " SET COR_Autenticador=?, COR_Seguridad=?, COR_Servidor=?, COR_Puerto=?, COR_Usuario=?, COR_Clave=? " .
            " WHERE COR_IdCorreo=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($LlaveAcceso, $IdEstado, $LlaveInicial, $LlaveIv, $MetodoEncriptacion, $TipoHash, $IdCorreo));

        return $cmd;
    }

    /**
     * Insertar una nueva gen_correo
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
        $comando = "INSERT INTO gen_correo ( " .
            " COR_Autenticador," .
            " COR_Seguridad," .
            " COR_Servidor," .
            " COR_Puerto," .
            " COR_Usuario,".
            " COR_Clave )" .
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
     * @param $IdCorreo identificador de la gen_correo
     * @return bool Respuesta de la eliminación
     */
    public static function delete($IdCorreo)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM gen_correo WHERE $IdCorreo=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdCorreo));
    }
}

?>