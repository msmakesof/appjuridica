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
    public static function infoUsuario($IdUsuario)
    {
        $consulta = "SELECT COUNT(P.PRO_IdProceso) MisProcesos FROM pro_proceso P JOIN usu_usuario U ON U.USU_IdUsuario = P.PRO_IdUsuario AND U.USU_TipoUsuario = 1
		WHERE P.PRO_IdUsuario = ? AND P.PRO_EstadoProceso = 1 ; ";

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
     * Verifica cantidad de Clientes activos por Usuario
     *
     * @param $IdUsuario identificador de la tabla: pro_proceso
     * @return bool Respuesta de la consulta
     */
    public static function clientesxUsuario($IdUsuario)
    {
        $consulta = "SELECT COUNT(P.PRO_IdProceso) MisClientes FROM pro_proceso P JOIN usu_usuario U ON U.USU_IdUsuario = P.PRO_IdUsuario AND U.USU_TipoUsuario = 1
		WHERE P.PRO_IdUsuario = ? AND P.PRO_EstadoProceso = 1 ; ";

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
     * Verifica cantidad de Mi Agenda
     *
     * @param $IdUsuario identificador de la tabla: pro_proceso
     * @return bool Respuesta de la consulta
     */
    public static function miAgenda($IdUsuario)
    {
        $consulta = "SELECT COUNT(E.IdUsuario) MiAgenda FROM eve_evento E JOIN pro_proceso P ON P.PRO_IdProceso = E.IdProceso AND P.PRO_EstadoProceso = 1
		WHERE E.IdUsuario = ? ; ";

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
     * Verifica cantidad de info Proceso Judicial
     *
     * @param $IdUsuario identificador de la tabla: pro_proceso
     * @return bool Respuesta de la consulta
     */
    public static function infoProcesoJudicial($IdUsuario)
    {
        $consulta = "SELECT COUNT(P.PRO_IdUsuario) MiProcesoJudicial FROM pro_proceso P JOIN pro_actuacionprocesal A ON P.PRO_IdProceso = A.APR_IdProceso AND A.APR_EstadoActProcesal = 1
			WHERE P.PRO_IdUsuario = ? AND P.PRO_EstadoProceso = 1; ";

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
	
}
?>