<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="usu_acceso";
$Llave ="UAC_IdUsuAcceso";
class USU_ACCESO
{
    function __construct()
    {
    }

    /**
     * Insertar un nuevo Acceso de Usuario
     *         
     * @param $IdUsuario         identificador
     * @param $IpInterna         nuevo IpInterna
     * @param $FechaAcceso       nueva FechaAcceso
     * @param $NombreHost        nueva NombreHost
     * @param $Puerto            nueva Puerto
     * @param $Servidor          nueva Servidor
     * @param $Agente            nueva Agente
     * @return PDOStatement
     */

     //  
    public static function insert( $IdUsuario, $IpInterna, $FechaAcceso, $NombreHost, $Puerto, $Servidor, $Agente, $IpExterna, $hostname, $region, $pais, $latitud, $longitud, $organizacion, $codigopostal )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] .
                " ( UAC_IdUsuario, 
                    UAC_IpInterna,
                    UAC_FechaAcceso,
                    UAC_NombreHost,
                    UAC_Puerto,
                    UAC_Servidor,
                    UAC_Agente,
                    UAC_IpProveedor,
                    UAC_HostProveedor,
                    UAC_Region,
                    UAC_Pais,
                    UAC_Latitud,
                    UAC_Longitud,
                    UAC_Organizacion,
                    UAC_CodigoPostal
                  )
                  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        try {
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(
                array($IdUsuario, $IpInterna, $FechaAcceso, $NombreHost, $Puerto, $Servidor, $Agente, $IpExterna, $hostname, $region, $pais, $latitud, $longitud, $organizacion, $codigopostal)
            );
            // 
           
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
     
    public static function delete($IdUsuario)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM ". $GLOBALS['TABLA'] ." WHERE ". $GLOBALS['Llave']. " = ? ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdUsuario));
    }
    */
}
?>