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
     * Retorna todas las filas especificadas de la tabla '$IdUsuario'
     *
     * @param $IdUsuario Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT USU_IdUsuario ,
        USU_TipoDocumento,
        USU_Identificacion,
        USU_PrimerApellido,
        USU_SegundoApellido,
        USU_Nombre,
        USU_Email,
        USU_Celular,
        USU_Usuario,
        USU_Clave,
        USU_TipoUsuario,
        USU_Estado,
        USU_FechaCreado,
        USU_UsuarioCrea,
        USU_FechaModificado,
        USU_UsuarioModifica,
        USU_FechaEstado,
        USU_UsuarioEstado,
        USU_IdInterno,
        USU_Local ,
        CASE USU_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoUsuario,
        concat_WS(' ',USU_Nombre, USU_PrimerApellido, USU_SegundoApellido) AS NombreUsuario 
        FROM usu_usuario";
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
     * @param $IdUsuario Identificador de la $IdUsuario
     * @return mixed
     */
    public static function getById($IdUsuario)
    {
        // Consulta de la tabla de usuario
        $consulta = "SELECT USU_IdUsuario,
                        USU_TipoDocumento,
                        USU_Identificacion,
                        USU_PrimerApellido,
                        USU_SegundoApellido,
                        USU_Nombre,
                        USU_Email,
                        USU_Direccion,
                        USU_Celular,
                        USU_Usuario,
                        USU_Clave,
                        USU_TipoUsuario,
                        USU_Estado,
                        USU_FechaCreado,
                        USU_UsuarioCrea,
                        USU_FechaModificado,
                        USU_UsuarioModifica,
                        USU_FechaEstado,
                        USU_UsuarioEstado,
                        USU_IdInterno,
                        USU_Local
                        FROM usu_usuario
                        WHERE USU_IdUsuario = ?";

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
     * Obtiene los campos de una usu_usuario con un estado Activo
     * determinado
     *
     * @param $IdUsuario Identificador de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdUsuario)
    {
        // Consulta de la usu_usuario
        $consulta = "SELECT USU_Estado
                        FROM usu_usuario
                        WHERE USU_IdUsuario = ?";

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
     * Obtiene los campos de una usu_usuario con un estado Activo
     * determinado
     *
     * @param $IdUsuario Identificador de la tabla
     * @param $IdClave   Clave
     * @return mixed
     */
    public static function getByIdExiste($IdUsuario,$IdClave)
    {
        // Consulta de la usu_usuario
        $consulta = "SELECT Count(USU_IdUsuario) AS TotalUsuario, Usu_IdInterno, USU_IdUsuario, USU_Local 
                        FROM usu_usuario
                        WHERE USU_Usuario = ? AND USU_Clave = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdUsuario,$IdClave));
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
     * @param $IdUsuario            identificador
     * @param $TipoDocumento        nuevo titulo
     * @param $Identificacion       nueva descripcion
     * @param $PrimerApellido       nueva fecha limite de cumplimiento
     * @param $SegundoApellido      nueva categoria
     * @param $Nombre               nueva Nombre
     * @param $Email                nueva Email
     * @param $Celular              nueva Celular
     * @param $Usuario              nueva Usuario o Login
     * @param $Clave                nueva Clave
     * @param $TipoUsuario          nueva Tipo de usuario
     * @param $Estado               nueva Estado
     * @param $FechaCreado          nueva Fecha creado
     * @param $UsuarioCrea          nueva Usuario que crea
     * @param $FechaModificado      nueva Fecha Modificado
     * @param $UsuarioModifica      nueva Usuario que modifica
     * @param $FechaEstado          nueva Fecha Estado
     * @param $UsuarioEstado        nueva Usuario Estado
     * @param $IdInterno            nueva Id Interno
     * @param $Local                nueva Id Interno Cliente   
     * 
     */
    public static function update(        
        $TipoDocumento,
        $Identificacion,
        $PrimerApellido,
        $SegundoApellido,
        $Nombre,        
        $Email,
        $Direccion,
        $Celular,
        $Usuario,
        $Clave,
        $TipoUsuario,
        $Estado,
        $IdUsuario
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE usu_usuario" .
            " SET USU_TipoDocumento=?, USU_Identificacion=?, USU_PrimerApellido=?, USU_SegundoApellido=?, USU_Nombre=?, USU_Email=?, ".
            " USU_Direccion=?, USU_Celular=?, USU_Usuario=?, USU_Clave=?, USU_TipoUsuario=?, USU_Estado=? " .
            " WHERE USU_IdUsuario=? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($TipoDocumento, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email, $Direccion, $Celular, $Usuario, $Clave, $TipoUsuario, $Estado, $IdUsuario ));

        return $cmd;
    }

    /**
     * Insertar un nuevo Usuario
     *         
     * @param $TipoDocumento        nuevo titulo
     * @param $Identificacion       nueva descripcion
     * @param $PrimerApellido       nueva fecha limite de cumplimiento
     * @param $SegundoApellido      nueva categoria
     * @param $Nombre               nueva Nombre
     * @param $Email                nueva Email
     * @param $Direccion            nueva Direccion
     * @param $Celular              nueva Celular
     * @param $Usuario              nueva Usuario o Login
     * @param $Clave                nueva Clave
     * @param $TipoUsuario          nueva Tipo de usuario
     * @param $Estado               nueva Estado
     * @param $FechaCreado          nueva Fecha creado
     * @param $UsuarioCrea          nueva Usuario que crea
     * @param $FechaModificado      nueva Fecha Modificado
     * @param $UsuarioModifica      nueva Usuario que modifica
     * @param $FechaEstado          nueva Fecha Estado
     * @param $UsuarioEstado        nueva Usuario Estado
     * @param $IdInterno            nueva Id Interno
     * @param $Local                nueva Id Interno Cliente 
     * @return PDOStatement
     */

    public static function insert( $TipoDocumento, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email, $Direccion, $Celular, $Usuario,
        $Clave, $TipoUsuario,$Estado, $IdInterno, $Local )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO usu_usuario ( " .            
            " USU_TipoDocumento," .
            " USU_Identificacion," .
            " USU_PrimerApellido," . 
            " USU_SegundoApellido," .
            " USU_Nombre," .
            " USU_Email," .
            " USU_Direccion," .
            " USU_Celular," .
            " USU_Usuario," .
            " USU_Clave," .
            " USU_TipoUsuario," .
            " USU_Estado, " .
            " USU_IdInterno, USU_Local ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        try {
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(
                array($TipoDocumento, $Identificacion,$PrimerApellido, $SegundoApellido, $Nombre,$Email,
                $Direccion, $Celular, $Usuario,$Clave,$TipoUsuario,$Estado, $IdInterno, $Local )    
            );
           
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return $e;
        }    
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdUsuario identificador de la usu_usuario
     * @return bool Respuesta de la eliminación
     */
    public static function delete($IdUsuario)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM usu_usuario WHERE USU_IdUsuario =? ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdUsuario));
    }

    public static function existeusuario($Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email)
    {
        $consulta = "SELECT count(USU_IdUsuario) existe, USU_Identificacion, USU_PrimerApellido, USU_SegundoApellido, USU_Nombre, USU_Email
        FROM usu_usuario
        WHERE USU_Identificacion = ? OR (USU_PrimerApellido = ? AND USU_SegundoApellido = ? AND USU_Nombre = ?) OR USU_Email = ?";

        try {
        // Preparar sentencia
        $comando = Database::getInstance()->getDb()->prepare($consulta);
        // Ejecutar sentencia preparada
        $comando->execute(array($Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email));
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