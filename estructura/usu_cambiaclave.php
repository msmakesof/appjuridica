<?php

/**
 * Representa el la estructura de las $IdCorreo
 * almacenadas en la base de datos
 */
require '../Connections/database.php';

class USU_CAMBIACLAVE
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
        $consulta = "SELECT * FROM usu_cambiaclave";
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
    public static function getById($Correo, $Codigo)
    {
        // Consulta de la usu_cambiaclave
        $consulta = "SELECT CAC_FechaExpide
                    FROM usu_cambiaclave
                    WHERE CAC_Email = ? AND CAC_Codigo = ? AND CAC_Estado = 1; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Correo, $Codigo));
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
     * Obtiene los campos de una usu_cambiaclave con un estado Activo
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
                            FROM usu_cambiaclave
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
     * @param $Email              identificador
     * @param $Clave1             nuevo titulo
     * @param $Codigo             nueva descripcion
     * @param $LlaveInicial       nueva fecha limite de cumplimiento
     * @param $LlaveIv            nueva categoria     
     */
    public static function update( $Estado, $Codigo, $Email )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE usu_cambiaclave" .
            " SET CAC_Estado=? " .
            " WHERE CAC_Codigo = ? AND CAC_Email=? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array( $Estado, $Codigo, $Email ));

        return $cmd;
    }

    /**
     * Insertar una nueva usu_cambiaclave
     *    
     * @param $LlaveAcceso          nuevo titulo
     * @param $IdEstado             nueva descripcion
     * @param $LlaveInicial         nueva fecha limite de cumplimiento
     * @param $LlaveIv              nueva categoria
     * @param $MetodoEncriptacion   nueva prioridad
     * @param $TipoHash             nueva categoria
     * @return PDOStatement
     */
    public static function insert( $Email, $Codigo, $Estado )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO usu_cambiaclave ( " .
            " CAC_Email," .
            " CAC_Codigo," .
            " CAC_Estado, ".
            " CAC_FechaExpide )" .
            " VALUES( ?,?,?,TIMESTAMPADD(HOUR,1,SYSDATE()))";

           //echo "$comando / $Email, $Codigo, $Estado, $Tiempo"; 

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array($Email, $Codigo, $Estado )
        );
    }

    /**
     * Obtiene los campos de una meta con un identificador
     * determinado
     *
     * @param $IdCorreo Identificador de la $IdCorreo
     * @return mixed
     */
    public static function verificadata($Email, $Codigo)
    {
        // Consulta de la usu_cambiaclave
        $consulta = "SELECT count(CAC_FechaExpide) AS Total
                    FROM usu_cambiaclave
                    WHERE CAC_Email = ? AND CAC_Codigo = ? AND CAC_Estado = 1 AND SYSDATE() <= CAC_FechaExpide; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Email, $Codigo));
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
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdCorreo identificador de la usu_cambiaclave
     * @return bool Respuesta de la eliminación
     */
    public static function delete($IdCorreo)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM usu_cambiaclave WHERE $IdCorreo=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdCorreo));
    }
}

?>