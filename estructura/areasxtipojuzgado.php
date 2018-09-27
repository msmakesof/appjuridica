<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
// $TABLA ="juz_area";
// $Llave ="ARE_IdArea";
class AREASXTIPOJUZGADO
{
    function __construct()
    {
    }
    /**
    * Retorna todas las filas especificadas de consulta AREASXTIPOJUZGADO por '$IdTabla'
    *
    * @param $IdTabla Identificador del registro
    * @return array Datos del registro
    */
    public static function getById($IdTabla)
    {
        // Consulta de la tabla de tablas
        // $consulta = "SELECT ARE_IdArea,
		// 			ARE_Nombre,                            
		// 			ARE_Estado, 
		// 			ARE_Codigo 
		// 			FROM juz_area
		// 			WHERE ARE_IdTipoJuzgado = ? AND ARE_Estado = 1 
        //             ORDER BY ARE_Nombre; ";

            $consulta = "SELECT ARE_IdArea,
					ARE_Nombre, ARE_Codigo
					FROM juz_area
					WHERE ARE_IdTipoJuzgado = ? AND ARE_Estado = 1 
                    ORDER BY ARE_Nombre; ";
        try 
        {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) 
        {
            return false;
        }
    }
}
?>