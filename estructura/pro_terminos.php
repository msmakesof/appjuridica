<?php
/**
 * Representa el la estructura de las $IdGRUPO
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="pro_terminos";
$Llave ="TER_IdTermino";
class PRO_TERMINOS
{
    function __construct()
    {
    }

    /**
     * Insertar un nueva Tabla
     *         
     * @param $IdTabla            identificador
     * @param $Nombre             nuevo Nombre      
     * @param $Datos              Datos
     
     * @return PDOStatement
     */
    public static function insert( $IdTAP, $Datos )
    {
        // Sentencia INSERT     
        $mks= json_decode($Datos, true);        
        $inicia = "";
		$comando = "";
        foreach ($mks as $dato => $valor){
            //echo "dato....$dato<br />";
            if (is_array($valor))
            {                
                $nr = count($valor);
                $i = 1;
                foreach ($valor as $infox => $desc)
                {
                    if($i != 4)
                    {
                        //if($desc == ""){$desc = "0";}
                        if ($i < $nr)
                        {
                            $inicia.= $desc.",";
                        }
                        else
                        {
                            $inicia.= $desc;
                        }
                    }                    
                   $i++;
                }
                $inicia.= ",1,$IdTAP";
                $comando .= "INSERT INTO ". $GLOBALS['TABLA'] .
                    " ( TER_DiasHabiles, TER_Notifica, TER_IdPeriodo, TER_Repite, TER_DiasRep, TER_Estado, TER_IdTipoActProcesal )" . 
                    " VALUES ($inicia);";
				//echo $comando ."\n";								
            } 
            else 
            {
                //echo "x..".$dato ." ". $valor. '<br>';
            }
            $inicia = "";
        }
        //Preparar la sentencia
		$sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute( array($IdTAP, $Datos )  );
    }
	/**
     * Verifica si existe el Termino
     *
     * @param $IdUsuario identificador de la PRO_TERMINOS
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Dias, $Notifica, $Periodo, $Repite, $DiasRep, $par2)
    {
        //$Dias, $Periodo, $Notifica,
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe FROM ".$GLOBALS['TABLA'].
        " WHERE TER_DiasHabiles =? AND TER_Notifica =? AND TER_IdPeriodo =? AND TER_Repite =? AND TER_DiasRep =? AND TER_IdTipoActProcesal =?; ";
        
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Dias, $Notifica, $Periodo, $Repite, $DiasRep, $par2));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // AquÃ­ puedes clasificar el error dependiendo de la excepciÃ³n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	
	/**
     * Obtiene los campos de una tabla con un identificador
     * determinado, que corresponde al IdTipoActuacionProcesal
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function getByIdTAP($IdTabla)
    {
        // Consulta de la tabla de tablas
        $consulta = "SELECT ".$GLOBALS['Llave'].", gen_periodo.PER_Nombre AS NombrePeriodo,
				TER_DiasHabiles, TER_Notifica, TER_IdPeriodo, TER_Repite, PER_Valor,
				TER_DiasRep, TER_Estado, TER_IdTipoActProcesal
				FROM ".$GLOBALS['TABLA'].
				" JOIN pro_tipoactuacionprocesal ON TAP_IdTipoActuacionProcesal = TER_IdTipoActProcesal
				 JOIN gen_periodo ON PER_IdPeriodo = TER_IdPeriodo
				 WHERE TER_IdTipoActProcesal = ? ORDER BY TER_IdTipoActProcesal, PER_Valor, TER_DiasHabiles, TER_IdPeriodo; ";
        //echo "$consulta";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));
            // Capturar primera fila del resultado
            //$row = $comando->fetch(PDO::FETCH_ASSOC);
			return $comando->fetchAll(PDO::FETCH_ASSOC);
            //return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	
	/**
     * Obtiene los campos de una tabla con un identificador
     * determinado     *
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function getById($IdTabla)
    {
        // Consulta de la tabla de tablas
        $consulta = "SELECT ".$GLOBALS['Llave'].",
				TER_DiasHabiles, TER_Notifica, TER_IdPeriodo, TER_Repite,
				TER_DiasRep, TER_Estado, TER_IdTipoActProcesal
				FROM ".$GLOBALS['TABLA'].
				" JOIN pro_tipoactuaionproesal ON TAP_IdTipoActuacionProcesal = TER_IdTipoActProcesal
				 WHERE ".$GLOBALS['Llave']." = ? ORDER BY TER_IdTipoActProcesal, TER_IdPeriodo; ";
        //echo "$consulta";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquðœµedes clasificar el error dependiendo de la excepció®Š            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	/**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la PRO_TERMINOS
     * @return bool Respuesta de la eliminación
     */
    public static function delete($IdTabla)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM ". $GLOBALS['TABLA'] ." WHERE ". $GLOBALS['Llave']. " = ? ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdTabla));
    }
	
}