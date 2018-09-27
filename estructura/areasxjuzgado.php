<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
// $TABLA ="juz_area";
// $Llave ="ARE_IdArea";
class AREASXJUZGADO
{
    function __construct()
    {
    }
    /**
    * Retorna todas las filas especificadas de consulta AREASXJUZGADO por '$IdTabla'
    *
    * @param $IdTabla Identificador del registro
    * @return array Datos del registro
    */
    //public static function getById($IdTabla)
    public static function getById($TipoJuzgado, $Area)
    {
        // Consulta
            $consulta = "SELECT juz_juzgado.JUZ_Ubicacion, juz_juzgado.JUZ_IdJuzgado
            FROM juz_area
            JOIN juz_juzgado
            ON juz_juzgado.JUZ_IdTipoJuzgado = juz_area.ARE_IdTipoJuzgado
            AND juz_juzgado.JUZ_IdArea = juz_area.ARE_IdArea 
            WHERE juz_area.ARE_IdTipoJuzgado = ? AND juz_area.ARE_Codigo = ? AND juz_area.ARE_Estado = 1; ";
        try 
        {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($IdTabla));
            $comando->execute(array($TipoJuzgado, $Area));

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) 
        {
            return false;
        }
    }
}
?>