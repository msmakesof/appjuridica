<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="cli_cliente";
$Llave ="CLI_IdCliente";
class CLI_CLIENTE
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
    public static function getAll($all, $par2, $par3, $par4)
    {
        $campos = "";
		$condi = "";
		$condiSel = "";
		$condiWhere="";
		$campos = "";
		$Where = "";
		if($par3 > 0)	
		{	
			if($par2 == 2 ) // Abogado
			{
				$campos = ", P.PRO_NumeroProceso ";
				$condiSel .= " JOIN usu_usuario ON usu_usuario.USU_IdUsuario = $par3 AND usu_usuario.USU_Estado = 1 AND usu_usuario.USU_EsAbogado = 1 AND usu_usuario.USU_IdEmpresa = emp_empresa.EMP_IdEmpresa ";
				$condiSel .= " JOIN pro_proceso P ON P.PRO_IdUsuario = usu_usuario.USU_IdUsuario AND (P.PRO_IdDemandante = CLI_IdCliente OR P.PRO_IdDemandado = CLI_IdCliente) ";
			}
			else // Admin
			{
				$condiWhere = " WHERE CLI_Empresa = ".$par3;
			}
		}		
		
		$consulta = "SELECT ".$GLOBALS['Llave']." ,
			CLI_TipoDocumento,
			CLI_Identificacion,
			CLI_PrimerApellido,
			CLI_SegundoApellido,
			CLI_Nombre,
			CLI_Email,
			CLI_Celular,
			CLI_Usuario,
			CLI_Clave,
			CLI_Direccion,
			CLI_Estado,
			CLI_FechaCreado,
			CLI_UsuarioCrea,
			CLI_FechaModificado,
			CLI_UsuarioModifica,        
			CLI_UsuarioEstado,
			CLI_IdInterno,
			CLI_Local ,
			CLI_IdTipoCliente, 
			CLI_Empresa,
			CASE CLI_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoUsuario,
			concat_WS(' ',CLI_Nombre, CLI_PrimerApellido, CLI_SegundoApellido) AS NombreUsuario, 
			concat_WS(' ',EMP_Nombre, EMP_Nombre2, EMP_Apellido, EMP_Apellido2) AS NombreEmpresa
			$campos
        FROM ".$GLOBALS['TABLA']."  
		LEFT JOIN emp_empresa ON emp_empresa.EMP_IdEmpresa = CLI_Empresa AND emp_empresa.EMP_IdEstado = 1
		$condiSel
		$condiWhere 
		WHERE CLI_IdTipoCliente = $par4 	
		ORDER BY CLI_Nombre; ";
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
                        CLI_TipoDocumento,
                        CLI_Identificacion,
                        CLI_PrimerApellido,
                        CLI_SegundoApellido,
                        CLI_Nombre,
                        CLI_Email,
                        CLI_Direccion,
                        CLI_Celular,
                        CLI_Usuario,
                        CLI_Clave,                       
                        CLI_Estado,
                        CLI_FechaCreado,
                        CLI_UsuarioCrea,
                        CLI_FechaModificado,
                        CLI_UsuarioModifica,                        
                        CLI_UsuarioEstado,
                        CLI_IdInterno,
                        CLI_Local ,
						CLI_SeguimientoProceso,
						CLI_IdTipoCliente,
						CLI_Empresa, CLI_FechaCreado,
						CLI_IdTipoDocumentoRepLegal, CLI_IdentificacionRepLegal, CLI_NombreRepLegal, CLI_APellidosRepLegal,
						CLI_EmailRepLegal, CLI_CelularRepLegal, CLI_IdTipoDocumentoContacto, CLI_IdentificacionContacto,
						CLI_NombreContacto, CLI_APellidosContacto, CLI_EmailContacto, CLI_CelularContacto
						FROM ".$GLOBALS['TABLA'].
                        " WHERE ".$GLOBALS['Llave']." = ? ORDER BY CLI_Nombre; ";

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
        $consulta = "SELECT ".$GLOBALS['Llave'].", CLI_Nombre ".
                        " FROM ". $GLOBALS['TABLA'].
                        " WHERE CLI_IdUsuario = ? ORDER BY CLI_Nombre;";

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
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalUsuario, Usu_IdInterno, CLI_IdUsuario, CLI_Local, CLI_Estado ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE ".$GLOBALS['Llave']." = ? AND CLI_Clave = ?";

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
	 * @param $CLI_Empresa			nueva CLI_Empresa
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
		$TipoCliente,        
        $Estado,		
		$Verseguimiento,
		$Empresa,
		$UsuarioModifica,
		$TipoDocumentorl, 
		$Identificacionrl, 
		$Nombrerl, 
		$Apellido1rl, 
		$Emailrl, 
		$Celularrl ,
		$TipoDocumentorl2, 
		$Identificacionrl2, 
		$Nombrerl2, 
		$Apellidosrl2, 
		$Emailrl2, 
		$Celularrl2,
        $IdUsuario		
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET CLI_TipoDocumento=?, CLI_Identificacion=?, CLI_PrimerApellido=?, CLI_SegundoApellido=?, CLI_Nombre=?, CLI_Email=?, ".
            " CLI_Direccion=?, CLI_Celular=?, CLI_Usuario=?, CLI_Clave=?, CLI_IdTipoCliente=? , CLI_Estado=?, CLI_SeguimientoProceso=?, CLI_Empresa=?, CLI_UsuarioModifica=?, " .
			" CLI_IdTipoDocumentoRepLegal=?, CLI_IdentificacionRepLegal=?, CLI_NombreRepLegal=?, CLI_APellidosRepLegal=?, CLI_EmailRepLegal=?, CLI_CelularRepLegal=?, " .
			" CLI_IdTipoDocumentoContacto=?, CLI_IdentificacionContacto=?,CLI_NombreContacto=?, CLI_APellidosContacto=?, CLI_EmailContacto=?, CLI_CelularContacto=? " .
            " WHERE ". $GLOBALS['Llave'] ."=? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($TipoDocumento, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email, $Direccion, $Celular, $Usuario, $Clave, $TipoCliente, $Estado, $Verseguimiento, $Empresa, $UsuarioModifica	,$TipoDocumentorl, $Identificacionrl, $Nombrerl, $Apellido1rl, $Emailrl, $Celularrl ,$TipoDocumentorl2, $Identificacionrl2, $Nombrerl2, $Apellidosrl2, $Emailrl2, $Celularrl2, $IdUsuario ));

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
	 * @param $CLI_Empresa			nueva CLI_Empresa
	 * @param $IdUsuarioCrea        nuevo IdUsuarioCrea
     * @return PDOStatement
     */

    public static function insert( $TipoDocumento, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email, $Direccion, $Celular, $Usuario, $Clave, $TipoCliente, $Estado, $IdInterno, $Local, $Verseguimiento, $Empresa, $IdUsuarioCrea,$TipoDocumentorl, $Identificacionrl, $Nombrerl, $Apellido1rl, $Emailrl, $Celularrl ,$TipoDocumentorl2, $Identificacionrl2, $Nombrerl2, $Apellidosrl2, $Emailrl2, $Celularrl2)
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ." ( " .            
            " CLI_TipoDocumento," .
            " CLI_Identificacion," .
            " CLI_PrimerApellido," . 
            " CLI_SegundoApellido," .
            " CLI_Nombre," .
            " CLI_Email," .
            " CLI_Direccion," .
            " CLI_Celular," .
            " CLI_Usuario," .
            " CLI_Clave," . 
			" CLI_IdTipoCliente," .
            " CLI_Estado, " .
            " CLI_IdInterno, CLI_Local, CLI_SeguimientoProceso, CLI_Empresa, CLI_UsuarioCrea ,
			  CLI_IdTipoDocumentoRepLegal, CLI_IdentificacionRepLegal, CLI_NombreRepLegal, CLI_APellidosRepLegal,
			  CLI_EmailRepLegal, CLI_CelularRepLegal, CLI_IdTipoDocumentoContacto, CLI_IdentificacionContacto,
			  CLI_NombreContacto, CLI_APellidosContacto, CLI_EmailContacto, CLI_CelularContacto
			) 
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
			//echo "sql insert cliente...".$comando;
        try {
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(
                array($TipoDocumento, $Identificacion, $PrimerApellido, $SegundoApellido, $Nombre, $Email, $Direccion, $Celular, $Usuario, $Clave, $TipoCliente, $Estado, $IdInterno, $Local, $Verseguimiento, $Empresa, $IdUsuarioCrea, $TipoDocumentorl, $Identificacionrl, $Nombrerl, $Apellido1rl, $Emailrl, $Celularrl , $TipoDocumentorl2, $Identificacionrl2, $Nombrerl2, $Apellidosrl2, $Emailrl2, $Celularrl2 )    
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
    public static function existeusuario($Identificacion, $TipoCliente, $PrimerApellido, $SegundoApellido, $Nombre, $IdCliente)
    {
		
        //$consulta = "SELECT count(CLI_IdCliente) AS existe, CLI_Identificacion, CLI_IdTipoCliente, CLI_PrimerApellido, CLI_SegundoApellido, CLI_Nombre, CLI_Email, CLI_IdCliente  ".        
		//" WHERE CLI_Identificacion = ? AND CLI_IdTipoCliente = ? AND CLI_PrimerApellido = ? AND CLI_SegundoApellido = ? AND CLI_Nombre = ? AND CLI_Email = ? AND CLI_IdCliente <> ?;";
		$consulta = "SELECT count(CLI_IdCliente) AS existe ". 
        " FROM cli_cliente ".
        " WHERE CLI_Identificacion = ? AND CLI_IdTipoCliente = ? AND CLI_PrimerApellido = ? AND CLI_SegundoApellido = ? AND CLI_Nombre = ? AND CLI_IdCliente <> ?;";
		
		/*
		$consulta = "SELECT count(". $GLOBALS['Llave']. ") AS existe ".        
        " FROM ".$GLOBALS['TABLA'].
        " WHERE CLI_Identificacion = $Identificacion AND CLI_IdTipoCliente = $TipoCliente AND CLI_PrimerApellido = '$PrimerApellido' AND CLI_SegundoApellido = '$SegundoApellido' AND CLI_Nombre = '$Nombre' AND CLI_Email = '$Email' AND CLI_IdCliente <> $IdCliente;";
		*/
		//echo "qry.....$consulta";
		
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Identificacion, $TipoCliente, $PrimerApellido, $SegundoApellido, $Nombre, $IdCliente));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row ;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
}

?>