<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="usu_usuario";
$Llave ="USU_IdUsuario";
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
        $consulta = "SELECT ".$GLOBALS['Llave']." ,
		USU_IdEmpresa,
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
		USU_EsAbogado ,
		USU_Desarrollador,
        CASE USU_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoUsuario,
        concat_WS(' ',USU_Nombre, USU_PrimerApellido, USU_SegundoApellido) AS NombreUsuario ,
		CASE USU_TipoUsuario WHEN 1 THEN CONCAT(TUS_Nombre,'- ABOGADO') ELSE TUS_Nombre END TUS_Nombre, 
		concat_WS(' ',emp_empresa.EMP_Nombre, emp_empresa.EMP_Nombre2, emp_empresa.EMP_Apellido, emp_empresa.EMP_Apellido2) AS NombreEmpresa
        FROM ".$GLOBALS['TABLA'].		
		" JOIN usu_tipousuario ON usu_tipousuario.TUS_ID_TipoUsuario = usu_usuario.USU_TipoUsuario AND usu_tipousuario.TUS_Estado = 1 ".
		" LEFT JOIN emp_empresa ON emp_empresa.EMP_IdEmpresa = USU_IdEmpresa ".
		" WHERE USU_EsSuperAdmin = 0 ".
		" ORDER BY NombreUsuario; ";
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
     * Retorna todas las filas especificadas de la tabla '$IdUsuario'
     *
     * @param $IdUsuario Identificador del registro solo Super Administradores
     * @return array Datos del registro
     */
    public static function getAllSU()
    {
        $consulta = "SELECT ".$GLOBALS['Llave']." ,
		USU_IdEmpresa,
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
		USU_EsAbogado ,
		USU_Desarrollador,
        CASE USU_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoUsuario,
        concat_WS(' ',USU_Nombre, USU_PrimerApellido, USU_SegundoApellido) AS NombreUsuario ,
		CASE USU_EsAbogado WHEN 1 THEN CONCAT(TUS_Nombre,'- ABOGADO') ELSE TUS_Nombre END TUS_Nombre
        FROM ".$GLOBALS['TABLA'].
		" JOIN usu_tipousuario ON usu_tipousuario.TUS_ID_TipoUsuario = usu_usuario.USU_TipoUsuario AND usu_tipousuario.TUS_Estado = 1".
		" WHERE USU_EsSuperAdmin = 1 ".
		" ORDER BY NombreUsuario; ";
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
     * Retorna todas las filas especificadas de la tabla '$IdUsuario' y que sean abogados activos
     * @param $IdUsuario Identificador del registro
     * @return array Datos del registro
     */
    public static function getByIdAbogado()
    {
        $consulta = "SELECT ".$GLOBALS['Llave']." ,
		USU_IdEmpresa,
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
		USU_Desarrollador,
        CASE USU_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoUsuario, 
        concat_WS(' ',USU_Nombre, USU_PrimerApellido, USU_SegundoApellido) AS NombreUsuario
        FROM ".$GLOBALS['TABLA'].		
		" WHERE USU_EsAbogado = 1 AND  USU_Estado = 1 ".
		" ORDER BY NombreUsuario; ";
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
						USU_IdEmpresa,
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
                        USU_Local,
						USU_EsAbogado ,
						USU_Desarrollador,
						concat_WS(' ',emp_empresa.EMP_Nombre, emp_empresa.EMP_Nombre2, emp_empresa.EMP_Apellido, emp_empresa.EMP_Apellido2) AS NombreEmpresa ".
                        " FROM ".$GLOBALS['TABLA'].
						" LEFT JOIN emp_empresa ON emp_empresa.EMP_IdEmpresa = USU_IdEmpresa ".
                        " WHERE ".$GLOBALS['Llave']." = ? ORDER BY USU_Nombre; ";

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
        $consulta = "SELECT ".$GLOBALS['Llave'].", USU_Nombre, USU_PrimerApellido, USU_SegundoApellido, 
						concat_WS(' ', USU_Nombre, USU_PrimerApellido, USU_SegundoApellido ) AS NombreCompleto ".
                        " FROM ". $GLOBALS['TABLA'].
                        " WHERE USU_IdUsuario = ? ORDER BY USU_Nombre;";

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
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalUsuario, Usu_IdInterno, USU_IdUsuario, USU_Local, USU_Estado ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE USU_Usuario = ? AND USU_Clave = ? ;";

        //echo "$consulta / usu..$IdUsuario / cla..$IdClave";

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
     * Obtiene los campos de una meta con un identificador
     * determinado
     *
     * @param $IdUsuario Identificador de la $IdUsuario
     * @return mixed
     */
    public static function getByIdApp($IdUsuario,$IdClave)
    {
        // Consulta de la tabla de usuario
        $consulta = "SELECT USU_Email, USU_TipoUsuario,	concat_WS(' ',USU_Nombre, USU_PrimerApellido, USU_SegundoApellido) AS Nombre ".
                " FROM ".$GLOBALS['TABLA'].						
                " WHERE USU_Usuario = ? AND USU_Clave = ? ; ";
				//echo "$consulta  / $IdUsuario / $IdClave";
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
     * @param $EsAbogado            nueva EsAbogado
	 * @param $Empresa            	nueva Empresa
     * 
     */
    public static function update(
		$Empresa,
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
		$EsAbogado,		
        $IdUsuario
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET USU_IdEmpresa =?, USU_TipoDocumento=?, USU_Identificacion=?, USU_PrimerApellido=?, USU_SegundoApellido=?, USU_Nombre=?, USU_Email=?, ".
            " USU_Direccion=?, USU_Celular=?, USU_Usuario=?, USU_Clave=?, USU_TipoUsuario=?, USU_Estado=?, USU_EsAbogado =? " .
            " WHERE ". $GLOBALS['Llave'] ."=? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Empresa, $TipoDocumento, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email, $Direccion, $Celular, $Usuario, $Clave, $TipoUsuario, $Estado, $EsAbogado, $IdUsuario ));

        return $cmd;
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
     * @param $EsAbogado            nueva EsAbogado
	 * @param $Empresa            	nueva Empresa
     * 
     */
    public static function updateSU(
		$Empresa,
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
		$EsAbogado,		
        $IdUsuario
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET USU_IdEmpresa =?, USU_TipoDocumento=?, USU_Identificacion=?, USU_PrimerApellido=?, USU_SegundoApellido=?, USU_Nombre=?, USU_Email=?, ".
            " USU_Direccion=?, USU_Celular=?, USU_Usuario=?, USU_Clave=?, USU_TipoUsuario=?, USU_Estado=?, USU_EsAbogado =? " .
            " WHERE ". $GLOBALS['Llave'] ."=?  AND USU_EsSuperAdmin = 1;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Empresa, $TipoDocumento, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email, $Direccion, $Celular, $Usuario, $Clave, $TipoUsuario, $Estado, $EsAbogado, $IdUsuario ));

        return $cmd;
    }

    /**
     * Insertar un nuevo Usuario
     *         
	* @param $Empresa        		Empresa
	* @param $TipoDocumento         nuevo titulo
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

    public static function insert( $Empresa, $TipoDocumento, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email, $Direccion, $Celular, $Usuario,
        $Clave, $TipoUsuario,$Estado, $IdInterno, $Local, $Abogado )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " . 
			" USU_IdEmpresa," .
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
            " USU_IdInterno, USU_Local, USU_EsAbogado ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        try {
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(
                array($Empresa, $TipoDocumento, $Identificacion,$PrimerApellido, $SegundoApellido, $Nombre,$Email,
                $Direccion, $Celular, $Usuario,$Clave,$TipoUsuario,$Estado, $IdInterno, $Local, $Abogado )    
            );
           
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return $e;
        }    
    }
	
	    /**
     * Insertar un nuevo Usuario Super Administrador
     *         
	* @param $Empresa        		Empresa
	* @param $TipoDocumento         nuevo titulo
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

    public static function crearSU( $Empresa, $TipoDocumento, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email, $Direccion, $Celular, $Usuario,
        $Clave, $TipoUsuario,$Estado, $IdInterno, $Local, $Abogado, $SuperAdmin )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " . 
			" USU_IdEmpresa," .
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
            " USU_IdInterno, USU_Local, USU_EsAbogado, USU_EsSuperAdmin ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        try {
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(
                array($Empresa, $TipoDocumento, $Identificacion,$PrimerApellido, $SegundoApellido, $Nombre,$Email,
                $Direccion, $Celular, $Usuario,$Clave,$TipoUsuario,$Estado, $IdInterno, $Local, $Abogado, $SuperAdmin )    
            );
           
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return $e;
        }    
    }

    /*
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
    public static function buscausuario($Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $IdUsuario)
    {
        $consulta = "SELECT count(USU_IdUsuario) AS existe 
        FROM usu_usuario
        WHERE USU_Identificacion = ? OR (USU_PrimerApellido = ? AND USU_SegundoApellido = ? AND USU_Nombre = ?)  AND USU_IdUsuario <> ?;";
		
		//echo $consulta ;//." /  $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $IdUsuario";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $IdUsuario));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return $e;
        }
    }
	
	 /**
     * Verifica si existe el usuario con el mismo número de cédula
     *
     * @param $IdUsuario identificador de la usu_usuario
     * @return bool Respuesta de la consulta
     */
    public static function buscaiden($Identificacion, $IdUsuario)
    {
        $consulta = "SELECT count(USU_IdUsuario) AS existe 
        FROM usu_usuario
        WHERE USU_Identificacion = ? AND USU_IdUsuario <> ? ;";
		
		//echo $consulta ;//." /  $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $IdUsuario";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Identificacion, $IdUsuario));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return $e;
        }
    }
	
	
	 /**
     * Verifica si existe el usuario con el mismo número de cédula
     *
     * @param $IdUsuario identificador de la usu_usuario
     * @return bool Respuesta de la consulta
     */
    public static function buscanom($Nom, $Ape1, $Ape2, $Iden)
    {
        $consulta = "SELECT count(USU_IdUsuario) AS existe 
        FROM usu_usuario
        WHERE USU_Nombre = ? AND USU_PrimerApellido = ? AND USU_SegundoApellido = ? AND USU_Identificacion = ? ;";
		
		//echo $consulta ;//." /  $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $IdUsuario";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Nom, $Ape1, $Ape2, $Iden));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return $e;
        }
    }
	
	/**
     * Verifica si existe el usuario Super Administrador
     *
     * @param $IdUsuario identificador de la usu_usuario
     * @return bool Respuesta de la consulta
     */
    public static function existeusuarioSU($empresa, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, USU_Identificacion, USU_PrimerApellido, USU_SegundoApellido, USU_Nombre, USU_Email ".        
        " FROM ".$GLOBALS['TABLA'].
        " WHERE USU_IdEmpresa = ? AND USU_Identificacion = ? OR (USU_PrimerApellido = ? AND USU_SegundoApellido = ? AND USU_Nombre = ?) OR USU_Email = ? AND USU_EsSuperAdmin = 1; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($empresa, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email));
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
     * Seleccionar usuarios tipo Abogado y Dependiente Judicial
     *
     * @param $IdUsuario identificador de la usu_usuario
     * @return bool Respuesta de la consulta
	 * Traemos todos los abogados que tienen uno o mas procesos activos asignados
     */
    public static function usuarioresponsable()
    {
        $consulta = "SELECT DISTINCT ".$GLOBALS['Llave'].", concat_WS(' ',USU_Nombre, USU_PrimerApellido, USU_SegundoApellido) AS NombreUsuario, USU_Email, TUS_Nombre ".
                   " FROM ".$GLOBALS['TABLA'].
				   " JOIN pro_proceso ON pro_proceso.PRO_IdUsuario = USU_IdUsuario AND pro_proceso.PRO_EstadoProceso = 1 ".
				   " JOIN usu_tipousuario ON usu_tipousuario.TUS_ID_TipoUsuario = ".$GLOBALS['TABLA'].".USU_TipoUsuario AND usu_tipousuario.TUS_Estado ".
                   " WHERE USU_EsAbogado IN (1) AND USU_Estado = 1; ";
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
    * Obtiene los campos de un usu_usuario por Tipo de Usuario (Dependiente o Abogado) 
    * determinado que tenga procesos asignados si es Abogado
    * @param $IdUsuario Identificador de la tabla
    * @return mixed
    */
    public static function getByTipoUsuario($IdUsuario)
    {
        // Consulta Por Tipo de Usuario en usu_usuario
		$condi = "";
		$condiwhere = "";
		if($IdUsuario == 2) //  2 = Abogado 
		{
			$condiwhere = " USU_EsAbogado = 1 ";
			$condi = " JOIN pro_proceso ON PRO_EstadoProceso = 1 AND PRO_IdUsuario = USU_IdUsuario ";
		}
		if($IdUsuario == 3) //  3 = Dependiente Judicial
		{
			$condiwhere = " USU_TipoUsuario = ? ";
		}
        $consulta = "SELECT DISTINCT ".$GLOBALS['Llave'].", 
					concat_WS(' ', USU_Nombre, USU_PrimerApellido, USU_SegundoApellido ) AS NombreCompleto ".
					" FROM ". $GLOBALS['TABLA']. $condi .
					" WHERE $condiwhere AND USU_Estado = 1 ORDER BY USU_Nombre;";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada            
			$comando->execute(array($IdUsuario));

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

/**
    * Obtiene los campos de un usu_usuario por IdLocal     
    * @param $IdUsuario Identificador de la tabla
    * @return mixed
    */
    public static function getIdLocal($IdUsuario)
    {
        
        $consulta = "SELECT DISTINCT ".$GLOBALS['Llave'].", 
					USU_EsAbogado, USU_EsSuperAdmin, USU_TipoUsuario ".
					" FROM ". $GLOBALS['TABLA']. 
					" WHERE USU_Local = $IdUsuario AND USU_Estado = 1 ;";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada            
			$comando->execute(array($IdUsuario));

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }	
}
?>