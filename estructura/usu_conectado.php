<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="usu_conectado";
$Llave ="CNN_IdConectado";
class USU_CONECTADO
{
    function __construct()
    {
    }

    /**
     * Insertar un nuevo Acceso de Usuario
     *         
     * @param $IdUsuario         identificador
     * @param 1			         nuevo Estado
     * @param $AceptaCookie      AceptaCookie
     * @return PDOStatement
     */

     //  
    public static function insert( $IdUsuario, $AceptaCookie, $Estado )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] .
                " ( CNN_IdUsuario, CNN_AceptaCookie, CNN_Estado )VALUES(?,?,?);";
        try {
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(
                array($IdUsuario, $AceptaCookie, $Estado)
            );
            // 
			//$comando = "INSERT INTO usu_conectado (CNN_IdUsuario, CNN_AceptaCookie, CNN_Estado) VALUES ($IdUsuario, $AceptaCookie, '1'); ";
			$sentencia = Database::getInstance()->getDb()->prepare($comando);
			$consulta->execute();			
           
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return $e;
        }    
    }
	
	/**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $IdTabla           identificador
     * @param $Nombre            nuevo Nombre Tabla     
     * @param $IdEstadoTabla     nueva Estado       
     * 
     */
    public static function update(
		$nuevoestado,
        $idusuario,
		$estado		
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA']. 
            " SET CNN_Estado = ? " .
            " WHERE CNN_IdUsuario = ? AND CNN_Estado = ? AND CNN_FechaFinAcceso IS NULL ;";
		
		//echo $consulta .' - '. $nuevoestado .' - '. $idusuario .' - '. $estado .' - '. $fecha;   

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nuevoestado, $idusuario, $estado ));

        return $cmd;
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