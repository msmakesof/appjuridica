<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
// $TABLA ="cli_cliente";
// $Llave ="CLI_IdCliente";
class CLIENTEXDEMANDADO
{
    function __construct()
    {
    }
    /**
    * Retorna todas las filas especificadas de consulta CLIENTEXDEMANDADO por '$IdTabla'
    *
    * @param $IdTabla Identificador del registro
    * @return array Datos del registro
    */
    //public static function getById($IdTabla)
    public static function getById($Cliente, $Demandado)
    {
        // Consulta
        $condi="";
        if($Cliente != ""  && ($Demandado == "" || $Demandado != null))
        {
            $condi=" CLI_IdCliente <> $Cliente";
        }
        if($Demandado != ""  && ($Cliente == "" || $Cliente != null))
        {
            $condi=" CLI_IdCliente <> $Demandado";
        }
        $consulta = "SELECT CLI_IdCliente, concat_ws(' ', CLI_Nombre, CLI_PerimerApellido, CLI_SegundoApellido) AS NombreCliente
        FROM cli_cliente            
        WHERE $condi AND CLI_Estado = 1; ";
        try 
        {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada            
            $comando->execute(array($Cliente, $Demandado));

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) 
        {
            return false;
        }
    }
	
	public static function getByDoc($Cliente, $Demandado)
    {
        // Consulta        
        $consulta = "SELECT COUNT(CLI_Identificacion) tot, 
				CASE 
					WHEN COUNT(CLI_Identificacion) > 1 THEN 'Demandante y Demandado No puede serl el mismo.' 
					WHEN COUNT(CLI_Identificacion) < 1 THEN 'ZZ' END AS Total
				FROM cli_cliente WHERE CLI_IdCliente = $Cliente OR CLI_IdCliente = $Demandado AND CLI_Estado = 1
				GROUP BY CLI_Identificacion ; ";
			// echo $consulta;
        try 
        {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada            
            $comando->execute(array($Cliente, $Demandado));            
			$row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } 
        catch (PDOException $e) 
        {
            return $e;
        }
    }
}
?>