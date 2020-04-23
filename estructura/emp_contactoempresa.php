<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="emp_contactoempresa";
$Llave ="COE_IdContacto";
class EMP_CONTACTOEMPRESA
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
    public static function getAll($par1,$par2)
    {
        $consulta = "SELECT ".$GLOBALS['Llave']." ,
        COE_IdEmpresa,		
        COE_IdTipoDocumento,
		COE_Identificacion,
        COE_Apellido1,
        COE_Apellido2,
        COE_Nombre1,
		COE_Nombre2,
        COE_Email,
        COE_Celular,                
        CASE COE_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END NombreEstado, 
        concat_WS(' ',COE_Nombre1, COE_Nombre2, COE_Apellido1, COE_Apellido2) AS NombreUsuario, TDO_Nombre 
        FROM ".$GLOBALS['TABLA'].
		" JOIN gen_tipodocumento ON gen_tipodocumento.TDO_IdTipoDocumento = COE_IdTipoDocumento 
		WHERE COE_IdEmpresa = $par2 
		ORDER BY COE_Nombre1, COE_Nombre2, COE_Apellido1, COE_Apellido2; ";
		//echo $consulta;
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
        $consulta = "SELECT ".$GLOBALS['Llave'].",
                        COE_Identificacion,
                        COE_IdTipoDocumento,
                        COE_Apellido1,
                        COE_Apellido2,
                        COE_Nombre1,
						COE_Nombre2,
                        COE_Email,
                        COE_Fijo,
                        COE_Celular,
						COE_Ciudad,                        
                        COE_FechaCreado,                        
                        COE_Estado ".                        
                        " FROM ".$GLOBALS['TABLA'].
                        " WHERE ".$GLOBALS['Llave']." = ? ORDER BY COE_Nombre1, COE_Nombre2, COE_Apellido1, COE_Apellido2; ";

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
        $consulta = "SELECT ".$GLOBALS['Llave'].", concat_WS(' ',COE_Nombre1, COE_Nombre2, COE_Apellido1, COE_Apellido2) AS Nombre ".
                        " FROM ". $GLOBALS['TABLA'].
                        " WHERE CLI_IdUsuario = ? ORDER BY Nombre;";

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
    public static function getByIdExiste($IdUsuario)
    {
        // Consulta de la usu_usuario
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalUsuario, COE_Estado ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE ".$GLOBALS['Llave']." = ? ";

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
	 * @param $Verseguimiento       marca si autoriza al cliente acceso a la herramenta para que pueda ver el seguimiento del proceso
	 * @param $TipoCliente          nueva Tipo de Cliente
     * 
     */
    public static function update(        
        $tipodocumento,
        $numerodocumento,
        $apellido1,
        $apellido2,
        $nombre1,
		$nombre2,        
        $email,
		$fijo,		
        $celular,
		$ciudad,
        $estado,
		$usuarioModifica, 	
        $idtabla		
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET COE_IdTipoDocumento=?, COE_Identificacion=?, COE_Apellido1=?, COE_Apellido2=?, COE_Nombre1=?, COE_Nombre2=?, COE_Email=?, ".
            " COE_Fijo=?, COE_Celular=?, COE_Ciudad=?, COE_Estado=?, COE_IdUsuarioModifica=? " .
            " WHERE ". $GLOBALS['Llave'] ."=? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($tipodocumento, $numerodocumento, $apellido1, $apellido2, $nombre1, $nombre2, $email, $fijo, $celular, $ciudad, $estado, $usuarioModifica, $idtabla ));

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
     * @param $Estado               nueva Estado
     * @param $FechaCreado          nueva Fecha creado
     * @param $UsuarioCrea          nueva Usuario que crea
     * @param $FechaModificado      nueva Fecha Modificado
     * @param $UsuarioModifica      nueva Usuario que modifica
     * @param $FechaEstado          nueva Fecha Estado
     * @param $UsuarioEstado        nueva Usuario Estado
     * @param $IdInterno            nueva Id Interno
     * @param $Local                nueva Id Interno Cliente 
	 * @param $Verseguimiento       marca si autoriza al cliente acceso a la herramenta para que pueda ver el seguimiento del proceso
	 * @param $TipoCliente          nueva Tipo de usuario
     * @return PDOStatement
     */

    public static function insert( $IdEmpresa, $TipoDocumento, $Identificacion, $Nombre1, $Nombre2, $Apellido1, $Apellido2, $Email, $Celular, $Fijo, $Estado, $Ciudad, $Usuario, $FechaCreado, $IdUsuarioModifica, $FechaModifica)
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " . 
			" COE_IdEmpresa," .
            " COE_IdTipoDocumento," .
            " COE_Identificacion," .
			" COE_Nombre1," .
			" COE_Nombre2," .
            " COE_Apellido1," . 
            " COE_Apellido2," .           
            " COE_Email," .
			" COE_Celular," .
            " COE_Fijo," .            
            " COE_Estado," .                       
            " COE_Ciudad, COE_IdUsuarioCrea, COE_FechaCreado, COE_IdUsuarioModifica, COE_FechaModifica " .
            " ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        try {
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(
                array($IdEmpresa, $TipoDocumento, $Identificacion, $Nombre1, $Nombre2, $Apellido1, $Apellido2, $Email, $Celular, $Fijo, $Estado, $Ciudad, $Usuario, $FechaCreado, $IdUsuarioModifica, $FechaModifica )
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
        $comando = "DELETE FROM ". $GLOBALS['TABLA'] ." WHERE ". $GLOBALS['Llave']. " = ? ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdUsuario));
    }

    /**
     * Verifica si existe el usuario
     *
     * @param $IdUsuario identificador de la usu_usuario
     * @return bool Respuesta de la consulta
     */
    public static function existeusuario($Identificacion, $Nombre1, $Nombre2, $PrimerApellido, $SegundoApellido, $Email, $TipoDocumento)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, COE_Identificacion, COE_Apellido1, COE_Apellido2, COE_Nombre1, COE_Nombre2, COE_Email ".        
        " FROM ".$GLOBALS['TABLA'].
        " WHERE COE_Identificacion = ? AND COE_Nombre1 = ? AND COE_Nombre2 = ? AND COE_Apellido1 = ? AND COE_Apellido2 = ? AND COE_Email = ? AND COE_IdTipoDocumento = ? ";
		//echo "sql Existe contacto...".$consulta;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Identificacion, $Nombre1, $Nombre2, $PrimerApellido, $SegundoApellido, $Email, $TipoDocumento));
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