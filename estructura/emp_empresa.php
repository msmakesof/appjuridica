<?php
/**
 * Representa el la estructura de la  tabla Empresa
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="emp_empresa";
$Llave ="EMP_IdEmpresa";
class EMP_EMPRESA
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
		EMP_IdTipoPersona ,
		EMP_Identificacion ,
		EMP_Nombre ,
		EMP_Direccion  ,
		EMP_TelefonoFijo ,
		EMP_TelefonoCelular ,
		EMP_IdCiudad ,
		EMP_FechaCreacion ,
		EMP_IdEstado ,
		EMP_Nombre2 , 
		EMP_Apellido , 
		EMP_Apellido2 ,
		CIU_Nombre AS NombreCiudad ,
		EST_Nombre AS NombreEstado ,
		TDO_Nombre AS TipoDocumento ,
		concat_ws(' ',EMP_Nombre, EMP_Nombre2,EMP_Apellido,EMP_Apellido2) AS NombreEmpresa,
		COUNT(COE_IdContacto) AS TotalContactos
        FROM ".$GLOBALS['TABLA'].
		" JOIN gen_ciudad ON gen_ciudad.CIU_IdCiudades = ".$GLOBALS['TABLA'].".EMP_IdCiudad 
		  JOIN gen_estado ON gen_estado.EST_IdEstado = ".$GLOBALS['TABLA'].".EMP_IdEstado
		  JOIN gen_tipodocumento ON gen_tipodocumento.TDO_IdTipoDocumento = ".$GLOBALS['TABLA'].".EMP_IdTipoDocumento
		  LEFT JOIN emp_contactoempresa ON COE_IdEmpresa = ".$GLOBALS['TABLA'].".EMP_IdEmpresa
		GROUP BY EMP_IdEmpresa  
		ORDER BY EMP_Nombre; ";
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
						EMP_IdTipoPersona ,
						EMP_IdTipoDocumento ,
						EMP_Identificacion ,
						EMP_Nombre ,
						EMP_Direccion  ,
						EMP_TelefonoFijo ,
						EMP_TelefonoCelular ,
						EMP_Email ,
						EMP_IdCiudad ,
						EMP_SitioWeb ,
						EMP_IdEstado ,
						EMP_Nombre2 , 
						EMP_Apellido , 
						EMP_Apellido2 ".
                        " FROM ".$GLOBALS['TABLA'].
                        " WHERE ".$GLOBALS['Llave']." = ? ORDER BY EMP_Nombre; ";

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
        $consulta = "SELECT ".$GLOBALS['Llave'].", EMP_Nombre ".
                        " FROM ". $GLOBALS['TABLA'].
                        " WHERE EMP_IdEmpresa = ? ORDER BY EMP_Nombre;";

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
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalUsuario, EMP_IdEmpresa, EMP_Identificacion ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE ".$GLOBALS['Llave']." = ? AND EMP_Identificacion = ?";

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
	 * @param $Verseguimiento       marca si autoriza al cliente acceso a la herramenta para que pueda ver el seguimiento del proceso
	 * @param $TipoCliente          nueva Tipo de Cliente
     * 
     */
    public static function update(
		$TipoDocumento ,
		$Identificacion ,		
		$Nombre ,
		$Email ,
		$Direccion  ,
		$TelefonoCelular ,
		$TelefonoFijo ,
		$Sitioweb,
		$IdEstado,
		$IdTipoCliente ,
		$IdCiudad ,
		$Nombre2 , 
		$Apellido1 , 
		$Apellido2 ,		
		$IdEmpresa		
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET EMP_IdTipoDocumento = ? ,				
				EMP_Identificacion = ? ,
				EMP_Nombre = ? ,
				EMP_Email = ? ,
				EMP_Direccion = ? ,
				EMP_TelefonoCelular = ? ,
				EMP_TelefonoFijo = ? ,
				EMP_SitioWeb = ? ,
				EMP_IdEstado = ? ,
				EMP_IdTipoPersona = ? ,
				EMP_IdCiudad = ? ,
				EMP_Nombre2 = ? ,
				EMP_Apellido = ? ,
				EMP_Apellido2 = ? " .
            " WHERE ". $GLOBALS['Llave'] ."= ? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($TipoDocumento, $Identificacion, $Nombre, $Email, $Direccion, $TelefonoCelular,
		 $TelefonoFijo, $Sitioweb, $IdEstado, $IdTipoCliente, $IdCiudad, $Nombre2, $Apellido1, $Apellido2, $IdEmpresa ));
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

    public static function insert( $TipoDocumento, $Identificacion ,$Nombre , $Email, $Direccion, $TelefonoCelular, $TelefonoFijo, 
	$Sitioweb, $IdEstado, $IdInterno, $Local, $TipoCliente, $IdCiudad ,$FechaCreacion, $Nombre2, $Apellido1, $Apellido2 )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " .            
            " 	EMP_IdTipoDocumento,
				EMP_Identificacion ,
				EMP_Nombre ,
				EMP_Email ,
				EMP_Direccion  ,
				EMP_TelefonoCelular ,
				EMP_TelefonoFijo ,
				EMP_SitioWeb ,
				EMP_IdEstado ,
				EMP_IdInterno , 
				EMP_Local ,				
				EMP_IdTipoPersona ,				
				EMP_IdCiudad ,
				EMP_FechaCreacion,				
				EMP_Nombre2 ,
				EMP_Apellido,
				EMP_Apellido2
				 ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        try {
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(
                array($TipoDocumento, $Identificacion ,$Nombre , $Email, $Direccion, $TelefonoCelular, $TelefonoFijo, 
					$Sitioweb, $IdEstado, $IdInterno, $Local, $TipoCliente, $IdCiudad ,$FechaCreacion, 
					$Nombre2, $Apellido1, $Apellido2 )    
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
    public static function existeusuario($Identificacion, $Nombre, $Email, $Ciudad, $IdEmpresa)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe ".        
        " FROM ".$GLOBALS['TABLA'].
        " WHERE EMP_Identificacion = ? AND EMP_Nombre = ? AND EMP_Email = ? AND EMP_IdCiudad = ? AND EMP_IdEmpresa <> ? ;";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Identificacion, $Nombre, $Email, $Ciudad, $IdEmpresa));
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