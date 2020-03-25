<?php
/**
 * Representa el la estructura de las $IdUsuario
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="men_menu";
$Llave ="MEN_IdMenu";
class MEN_MENU
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
        $consulta = "SELECT ".$GLOBALS['Llave'].", MEN_Nombre, MEN_Icono, MEN_Orden, MEN_Link, MEN_Estado, 
            CASE MEN_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla
            FROM ".$GLOBALS['TABLA']." ORDER BY MEN_Orden; ";
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
                            MEN_Nombre, MEN_Icono, MEN_Orden, MEN_Link,
                            MEN_Estado".
                            " FROM ".$GLOBALS['TABLA'].
                            " WHERE ".$GLOBALS['Llave']." 
                            = ? ORDER BY MEN_Nombre; ";

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
     * Obtiene los campos de USU_TIPOUSUARIO diferente al administrador
     * determinado
     * @param $IdEstadoTabla Identificador del estado de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdEstadoTabla)
    {
        // Consulta de USU_Tipo Usuario
        $consulta = "SELECT ".$GLOBALS['Llave'].", MEN_Nombre, MEN_Icono, MEN_Orden, MEN_Link, MEN_Estado ".
                    " FROM ". $GLOBALS['TABLA'].
                    " WHERE MEN_Estado = ? ORDER BY MEN_Nombre; ";
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
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalTablas, MEN_Nombre, MEN_Icono, MEN_Orden, MEN_Link, MEN_Estado ".
                " FROM ". $GLOBALS['TABLA'].
                " WHERE MEN_IdMenu = ? ;";

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
	 * @param $Orden      		   Orden
     * @param $IdEstadoTabla       nueva Estado       
     * 
     */
    public static function update(
        $NombreTabla,
        $Icono,
		$Orden,
		$Link, 
        $IdEstadoTabla,
        $IdTabla
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA'].
            " SET MEN_Nombre=?, MEN_Icono=?, MEN_Orden=?, MEN_Link=?, MEN_Estado=? " .
            " WHERE ". $GLOBALS['Llave'] ." =? ;";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($NombreTabla, $Icono, $Orden, $Link, $IdEstadoTabla, $IdTabla ));

        return $cmd;
    }

    /**
     * Insertar un nueva Tabla
     *         
     * @param $IdTabla            identificador
     * @param $Nombre             nuevo Nombre Tabla
     * @param $Icono      		  Icono
	 * @param $Orden      		  Orden
     * @param $Estado             Estado   
     * @return PDOStatement
     */
    public static function insert(        
        $Nombre,
		$Icono,
		$Orden,
		$Link,
        $Estado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO  ". $GLOBALS['TABLA'] ."  ( " .            
            " MEN_Nombre," .
			" MEN_Icono," .
			" MEN_Orden," .
			" MEN_Link," .
            " MEN_Estado" . 
            " )".     
            " VALUES(?,?,?,?,?) ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(                
                $Nombre,
				$Icono,
				$Orden,
				$Link,
                $Estado
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
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe, MEN_Nombre FROM ". $GLOBALS['TABLA'] ." WHERE ". $GLOBALS['Llave']. "= ? ; ";

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
	
	/**
     * Retorna todas las filas especificadas de la tabla '$IdTabla'
     *
     * @param $IdTabla Identificador del registro
     * @return array Datos del registro
     */
    public static function verMenu()
    {
        $consulta = "SELECT M.MEN_IdMenu, M.MEN_Nombre, M.MEN_Icono, M.MEN_Estado, M.MEN_Orden, M.MEN_Link LnkMenu,
						S.SME_IdSubMenu, S.SME_Nombre submenu, S.SME_Link LinkSubmenu
					FROM men_menu M
					LEFT JOIN men_submenu S ON S.SME_IdMenu = M.MEN_IdMenu AND S.SME_Estado = 1
					WHERE M.MEN_Estado = 1 AND M.MEN_Orden IS NOT NULL
					ORDER BY MEN_Orden; ";
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
}

?>