<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="men_submenu";
$Llave ="SME_IdSubMenu";
class MEN_SUBMENU
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$IdTabla'
     *
     * @param $IdTabla Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT ".$GLOBALS['Llave'].", SME_Nombre, SME_Icono, SME_IdMenu, SME_Link,  
            CASE SME_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla, M.MEN_Nombre AS NombreMenu
            FROM ".$GLOBALS['TABLA'].
			" JOIN men_menu M ON M.MEN_IdMenu = SME_IdMenu ".
			" ORDER BY SME_Nombre; ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de una tabla con un identificador
     * determinado 
     *
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function getById($IdTabla)
    {
        // Consulta de la tabla de tablas
        $consulta = "SELECT ".$GLOBALS['Llave'].",
					SME_Nombre, SME_Icono, SME_IdMenu, SME_Link, 
					SME_Estado, M.MEN_Nombre AS NombreMenu".
					" FROM ".$GLOBALS['TABLA'].
					" JOIN men_menu M ON M.MEN_IdMenu = SME_IdMenu ".
					" WHERE ".$GLOBALS['Llave']." = ? ORDER BY SME_Nombre; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdTabla));
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
     * Obtiene los campos de una tabla con un identificador
     * determinado 
     *
     * @param $IdTabla Identificador de la $IdTabla
     * @return mixed
     */
    public static function getByIdMenu($IdTabla)
    {
        // Consulta de la tabla de tablas
        $consulta = "SELECT x.SME_IdSubMenu, x.SME_Nombre, x.SME_Icono, x.SME_IdMenu, x.SME_Link, 
						x.SME_Estado, M.MEN_Nombre AS NombreMenu
						FROM men_submenu x
						JOIN men_menu M ON M.MEN_IdMenu = x.SME_IdMenu						
						WHERE x.SME_IdMenu = ? group BY x.SME_IdSubMenu ORDER BY x.SME_Nombre; ";

        try {
            
			// Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            
			// Ejecutar sentencia preparada            
			$comando->execute(array($IdTabla));
			
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Obtiene los campos de USU_TIPOUSUARIO diferente al administrador
     * determinado
     * @param $IdEstadoTabla Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstadoTabla)
    {
        // Consulta de USU_Tipo Usuario
        $consulta = "SELECT ".$GLOBALS['Llave'].", SME_Nombre, SME_Icono, SME_Link, SME_Estado, M.MEN_Nombre AS NombreMenu ".
                    " FROM ". $GLOBALS['TABLA'].
					" JOIN men_menu M ON M.MEN_IdMenu = SME_IdMenu ".
                    " WHERE SME_Estado = ? ORDER BY SME_Nombre; ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdEstadoTabla));
            // Muestra todos los rows
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }


    /**
     * Obtiene los campos de una GEN_TIPOPERSONA con un estado Activo
     * determinado
     *
     * @param $IdEstadoTabla Identificador de Estado de la tabla
     * @return mixed
     */
    public static function getByIdExiste($IdEstadoTabla)
    {
        // Consulta de la GEN_PAIS
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, SME_Nombre, SME_Icono, SME_Link, SME_Estado ".
                " FROM ". $GLOBALS['TABLA'].
                " WHERE SME_IdMenu = ? ;";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdEstadoTabla));
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
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $IdTabla            identificador
     * @param $Nombre_Tabla        nuevo Nombre Tabla
     * @param $NombreMostrar       nueva Nombre Tabla a mostrar
     * @param $IdEstadoTabla       nueva Estado       
     * 
     */
    public static function update(
        $NombreTabla,
        $Icono,
        $IdEstadoTabla,
		$Menu,
		$Link,
        $IdTabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA'].
            " SET SME_Nombre=?, SME_Icono=?, SME_Estado=?, SME_IdMenu=?, SME_Link=? " .
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($NombreTabla, $Icono, $IdEstadoTabla, $Menu, $Link, $IdTabla ));

        return $cmd;
    }

    /**
     * Insertar un nueva Tabla
     *         
     * @param $IdTabla            identificador
     * @param $Nombre             nuevo Nombre Tabla
     * @param $Icono      		  Icono
     * @param $Estado             Estado   
     * @return PDOStatement
     */
    public static function insert(        
        $Nombre,
		$Icono,
        $Estado,
		$Menu,
		$Link
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO  ". $GLOBALS['TABLA'] ."  ( " .            
            " SME_Nombre," .
			" SME_Icono," .
            " SME_Estado," . 
			" SME_IdMenu,".
			" SME_Link".
            " )".     
            " VALUES(?,?,?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Nombre,
				$Icono,
                $Estado,
				$Menu,
				$Link
            )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdTabla identificador de la GEN_TIPOPERSONA
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

    /**
     * Verifica si existe el Pais
     *
     * @param $IdUsuario identificador de la GEN_TIPOPERSONA
     * @return bool Respuesta de la consulta
     */
    public static function existetabla($Nombre)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, SME_Nombre FROM ". $GLOBALS['TABLA'] ." WHERE ". $GLOBALS['Llave']. "= ? ; ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Nombre));
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