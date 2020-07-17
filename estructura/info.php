<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
//$TABLA ="gen_tabla";
//$Llave ="TAB_IdTabla";
class PRO_PROCESO
{
    function __construct()
    {
    }
	
	/**
     * Verifica cantidad de Procesos abiertos por Usuario
     *
     * @param $IdUsuario identificador de la tabla: pro_proceso
     * @return bool Respuesta de la consulta
     */
    public static function infoUsuario($IdUsuario, $TipoUsuario, $Empresa)
    {
        $idempresa = $Empresa;
		
		$condiFrom = ""; // Super Admin
		$condiWhere = "";
		if ($TipoUsuario == 1)  // Empresa
		{
			$condiFrom=" JOIN emp_empresa E ON E.EMP_IdEmpresa = $idempresa AND E.EMP_IdEstado = 1 JOIN usu_usuario U ON U.USU_IdEmpresa = E.EMP_IdEmpresa AND U.USU_IdUsuario = P.PRO_IdUsuario ";			
		}
		
		if ($TipoUsuario == 2)  // Abogado
		{		
			$condiFrom = " JOIN usu_usuario U ON U.USU_IdUsuario = P.PRO_IdUsuario AND U.USU_TipoUsuario = 1 ";
			$condiWhere = " AND P.PRO_IdUsuario = $IdUsuario ";
		}
		
		if ($TipoUsuario == 3)  // Dependiente Judicial
		{
			
		}
		
		$consulta = "SELECT COUNT(P.PRO_IdProceso) MisProcesos FROM pro_proceso P $condiFrom 
		WHERE P.PRO_EstadoProceso = 1 $condiWhere ; ";		

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdUsuario, $TipoUsuario, $Empresa));
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
     * Verifica cantidad de Clientes activos por Usuario
     *
     * @param $IdUsuario identificador de la tabla: pro_proceso
     * @return bool Respuesta de la consulta
     */
    public static function clientesxUsuario($IdUsuario, $TipoUsuario, $Empresa)
    {
        $idempresa = $Empresa;
		
		$condiFrom = ""; // Super Admin
		$condiWhere = "";
		if ($TipoUsuario == 1)  // Empresa
		{
			$condiFrom = " JOIN emp_empresa F ON F.EMP_IdEmpresa = $idempresa AND F.EMP_IdEmpresa = C.CLI_Empresa ";			
		}
		
		if ($TipoUsuario == 2)  // Abogado
		{		
			$condiFrom = " JOIN emp_empresa E ON E.EMP_IdEmpresa = C.CLI_Empresa AND E.EMP_IdEstado = 1 JOIN usu_usuario U ON U.USU_IdEmpresa = E.EMP_IdEmpresa AND U.USU_Estado = 1 AND U.USU_IdUsuario = $IdUsuario ";
			$condiWhere = " AND C.cli_empresa = $idempresa ";
		}
		
		if ($TipoUsuario == 3)  // Dependiente Judicial
		{
			
		}
		
		$consulta = "SELECT COUNT(C.CLI_IdCliente) MisClientes FROM cli_cliente C $condiFrom WHERE C.CLI_Estado = 1 $condiWhere ; ";		

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdUsuario, $TipoUsuario, $Empresa));
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
     * Verifica cantidad de Mi Agenda
     *
     * @param $IdUsuario identificador de la tabla: pro_proceso
     * @return bool Respuesta de la consulta
     */
    public static function miAgenda($IdUsuario, $TipoUsuario, $Empresa)
    {
        $idempresa = $Empresa;
		
		$condiFrom = ""; // Super Admin
		$condiWhere = "";
		if ($TipoUsuario == 1)  // Empresa
		{
			$condiFrom = " JOIN emp_empresa F ON F.EMP_IdEmpresa = $idempresa JOIN usu_usuario U ON U.USU_IdEmpresa = F.EMP_IdEmpresa AND U.USU_Estado = 1  AND U.USU_IdUsuario = E.IdAsignado ";
		}
		
		if ($TipoUsuario == 2)  // Abogado
		{		
			$condiWhere = " AND E.IdUsuario = $IdUsuario ";
		}
		
		if ($TipoUsuario == 3)  // Dependiente Judicial
		{
			
		}
		
		$consulta = "SELECT COUNT(E.IdAsignado) MiAgenda FROM agenda E JOIN pro_proceso P ON P.PRO_IdProceso = E.IdProceso AND P.PRO_EstadoProceso = 1
		$condiFrom WHERE DATE_FORMAT(E.inicio_normal, '%Y-%m-%d') = CURDATE() $condiWhere ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdUsuario, $TipoUsuario, $Empresa));
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
     * Verifica cantidad de info Proceso Judicial
     *
     * @param $IdUsuario identificador de la tabla: pro_proceso
     * @return bool Respuesta de la consulta
     */
    public static function infoProcesoJudicial($IdUsuario, $TipoUsuario, $Empresa)
    {
        $idempresa = $Empresa;		
		$condiFrom = ""; // Super Admin
		$condiWhere = "";
		if ($TipoUsuario == 1)  // Empresa
		{
			$condiFrom = " JOIN usu_usuario U ON U.USU_IdUsuario = $IdUsuario AND U.USU_IdEmpresa = $idempresa AND USU_Estado = 1 JOIN  emp_empresa F ON F.EMP_IdEmpresa = $idempresa ";
		}
		
		if ($TipoUsuario == 2)  // Abogado
		{		
			$condiWhere = " AND P.PRO_IdUsuario = $IdUsuario ";
		}
		
		if ($TipoUsuario == 3)  // Dependiente Judicial
		{
			
		}
		
		$consulta = "SELECT COUNT(P.PRO_IdUsuario) MiProcesoJudicial FROM pro_proceso P JOIN pro_actuacionprocesal A ON A.APR_IdProceso = P.PRO_IdProceso AND A.APR_EstadoActProcesal = 1 $condiFrom 
		WHERE P.PRO_EstadoProceso = 1 $condiWhere ; ";		

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdUsuario, $TipoUsuario, $Empresa));
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