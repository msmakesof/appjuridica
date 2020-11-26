<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
class ROBOTNOTIFICA
{
	 function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas para verificar notificaciones
     *
     * @param $IdTabla Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll($pusuario,$ptipousuario,$pempresa,$pdiascalcula)
    {
			$condi = "";
			$condifecha = " between DATE_ADD(CURDATE(),INTERVAL $pdiascalcula DAY) AND DATE_ADD(CURDATE(),INTERVAL $pdiascalcula DAY) ";
			$condiempresa = "";
			if ( $ptipousuario != 4 && $pempresa == 0)
			{
				$condi = " AND PRO_IdUsuario = $pusuario ";
			}
			if( $pempresa != 0 && $pempresa != ""  )
			{	
				$condiempresa = " AND USU_IdEmpresa = $pempresa ";
			}
			if($pdiascalcula > 0)
			{
				$condifecha = " between DATE_ADD(CURDATE(),INTERVAL $pdiascalcula-1 DAY) AND DATE_ADD(CURDATE(),INTERVAL $pdiascalcula DAY) ";
			}
			
			$consulta = "SELECT NOT_IdActProcesal, NOT_FechaEnvio, TAP_Nombre, PRO_IdProceso, PRO_NumeroProceso, USU_IdEmpresa,
			CONCAT_WS(' ',USU_Nombre,USU_PrimerApellido,USU_SegundoApellido) AS Apoderado,
			CONCAT_WS(' ',EMP_Nombre,EMP_Nombre2,EMP_Apellido,EMP_Apellido2) AS Empresa
			FROM not_notificar
			JOIN pro_actuacionprocesal ON APR_IdActuacionProcesal = NOT_IdActProcesal 
			   AND APR_EstadoActProcesal = 1
			JOIN pro_proceso ON PRO_IdProceso = APR_IdProceso AND pro_estadoproceso = 1 ". $condi ."
			JOIN pro_tipoactuacionprocesal ON TAP_IdTipoActuacionProcesal = APR_IdTipoActuacionProcesal 
			   AND APR_EstadoActProcesal = 1
			JOIN usu_usuario ON USU_IdUsuario = PRO_IdUsuario AND USU_Estado = 1 ". $condiempresa ."
			LEFT JOIN emp_empresa ON EMP_IdEmpresa = USU_IdEmpresa AND EMP_IdEstado = 1 
			WHERE NOT_IdEstado = 1 AND NOT_FechaEnvio ". $condifecha ." 
			ORDER BY NOT_FechaEnvio;";
			//echo $consulta;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute( array($pusuario,$ptipousuario,$pempresa,$pdiascalcula) );

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
	}
}
?>