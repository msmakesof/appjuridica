<?php
/**
 * Representa el la estructura de las $IdGRUPO
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="not_notificar";
$Llave ="NOT_IdNotificar";
class NOT_NOTIFICAR
{
    function __construct()
    {
    }
	
	public static function insert( $Idtabla,$IdUsuario,$FechaHabil)
	{
		$fh = json_decode($FechaHabil, true);

		$query = "UPDATE not_notificar SET NOT_IdEstado = 0, NOT_UsuarioModifica=? WHERE NOT_IdActProcesal=?; ";
		 // Preparar la sentencia
        $cmdx = Database::getInstance()->getDb()->prepare($query);
		$cmdx->execute(array($IdUsuario, $Idtabla));
		
		foreach ($fh as $dato => $valor)
		{	// Preparar la sentencia		
			$query = "INSERT INTO not_notificar (NOT_IdActProcesal, NOT_UsuarioModifica, NOT_FechaEnvio, NOT_IdEstado) VALUES ($Idtabla,$IdUsuario,'$valor',1);";
			$cmdx = Database::getInstance()->getDb()->prepare($query);
			$cmdx->execute(array($Idtabla,$IdUsuario,$FechaHabil));
			//echo $query;
		}
		
		return $sentencia->execute(
			array( $Idtabla,$IdUsuario,$FechaHabil)
        );		
			
	}
}
?>