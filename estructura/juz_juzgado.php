<?php
/**
 * Representa el la estructura de las $IdJuzgado
 * almacenadas en la base de datos
 */
require '../Connections/database.php';
$TABLA ="juz_juzgado";
$Llave ="JUZ_IdJuzgado";
class JUZ_JUZGADO
{
    function __construct()
    {
    }

    /**
     * Retorna todas las filas especificadas de la tabla '$IdJuzgado'
     *
     * @param $IdJuzgado Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT ".$GLOBALS['Llave'].",
        JUZ_Ubicacion,
        JUZ_IdCiudad,
        JUZ_Direccion,
        JUZ_Telefono,
        JUZ_Piso,
        JUZ_IdTipoJuzgado,
        JUZ_IdArea,
		JUZ_Email,
		JUZ_Edificio,
		PIS_Numero,
        CASE JUZ_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla, 
        CIU_Nombre , TJU_Nombre, ARE_Nombre
        FROM ".$GLOBALS['TABLA'] .
        " JOIN gen_ciudad ON JUZ_IdCiudad = gen_ciudad.CIU_IdCiudades ".
        " JOIN juz_tipojuzgado ON JUZ_IdTipoJuzgado = juz_tipojuzgado.TJU_IdTipoJuzgado ".
		" JOIN juz_piso ON PIS_IdPiso = JUZ_Piso AND PIS_Estado = 1 ".
        " JOIN juz_area ON JUZ_IdArea = juz_area.ARE_IdArea ";

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
     * Obtiene los campos de una meta con un identificador
     * determinado
     *
     * @param $IdJuzgado Identificador de la $IJuzgado
     * @return mixed
     */
    public static function getById($IdUsuario)
    {
        // Consulta de la tabla de usuario
        $consulta = "SELECT ".$GLOBALS['Llave'].",
                    JUZ_Ubicacion,
                    JUZ_IdCiudad,
                    JUZ_Direccion,
                    JUZ_Telefono,
                    JUZ_Piso,
                    JUZ_IdTipoJuzgado,
                    JUZ_IdArea,
                    JUZ_Estado,
					JUZ_Email,
					JUZ_Edificio,
                    CASE JUZ_Estado WHEN 1 THEN 'Activo' ELSE 'Inactivo' END EstadoTabla, 
                    CIU_Nombre , TJU_Nombre, ARE_Nombre
                    FROM ". $GLOBALS['TABLA'].
                    " JOIN gen_ciudad ON JUZ_IdCiudad = gen_ciudad.CIU_IdCiudades ".
                    " JOIN juz_tipojuzgado ON JUZ_IdTipoJuzgado = juz_tipojuzgado.TJU_IdTipoJuzgado ".
                    " JOIN juz_area ON JUZ_IdArea = juz_area.ARE_IdArea ".
                    " WHERE ".$GLOBALS['Llave']." = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdUsuario));
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
     * Obtiene los campos de una usu_usuario con un estado Activo
     * determinado
     *
     * @param $IdJuzgado Identificador de la tabla
     * @return mixed
     */
    public static function getByIdEstado($IdUsuario)
    {
        // Consulta de la usu_usuario
        $consulta = "SELECT JUZ_Estado
                        FROM ". $GLOBALS['TABLA'].
                        " WHERE ".$GLOBALS['Llave']." = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdUsuario));
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
     * Obtiene los campos de una usu_usuario con un estado Activo
     * determinado
     *
     * @param $IdJuzgado Identificador de la tabla
     * @param $IdClave   Clave
     * @return mixed
     */
    public static function getByIdExiste($IdUsuario,$IdClave)
    {
        // Consulta de la usu_usuario
        $consulta = "SELECT Count(".$GLOBALS['Llave'].") AS TotalUsuario, JUZ_Ubicacion, JUZ_IdCiudad, 
                        JUZ_Direccion, JUZ_Piso, JUZ_IdTipoJuzgado, JUZ_IdArea
                        FROM ". $GLOBALS['TABLA'].
                        " WHERE ".$GLOBALS['Llave']." = ? AND USU_Clave = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($IdUsuario,$IdClave));
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
     * @param $IdJuzgado           identificador
     * @param $Ubicacion           nuevo titulo
     * @param $Ciudad              nueva descripcion
     * @param $Direccion           nueva Direccion
     * @param $Telefono            nueva Telefono
     * @param $Piso                nueva categoria
     * @param $TipoJuzgado         nueva Nombre
     * @param $Area                nueva Email
     * @param $Estado              nueva Celular    
     * @param $IdUsuario           nueva Id Interno Cliente   
     * 
     */
    public static function update(        
        $Ubicacion,
        $Ciudad,
        $Direccion,
        $Telefono,
        $Piso,
        $TipoJuzgado,        
        $Area,
        $Estado,
		$Email, 
		$Edificio,		
        $IdUsuario
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ". $GLOBALS['TABLA'].
            " SET JUZ_Ubicacion=?, JUZ_IdCiudad=?, JUZ_Direccion=?, JUZ_Telefono=?, JUZ_Piso=?, JUZ_IdTipoJuzgado=?, JUZ_IdArea=?, ".
            " JUZ_Estado=?, JUZ_Email=?, JUZ_Edificio=? " .
            " WHERE ". $GLOBALS['Llave'] ." =? ;";
            ////echo $consulta;
            ////echo "<br>".$Ubicacion.' / '. $Ciudad.' / '.  $Direccion.' / '.  $Telefono.' / '.  $Piso.' / '.  $TipoJuzgado.' / '.  $Area.' / '.  $Estado.' / '.  $Email.' / '.  $Edificio.' / '.  $IdUsuario;
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Ubicacion, $Ciudad, $Direccion, $Telefono, $Piso, $TipoJuzgado, $Area, $Estado, $Email, $Edificio, $IdUsuario ));

        return $cmd;
    }

    /**
     * Insertar un nuevo Usuario
     *         
     * @param $IdJuzgado           identificador
     * @param $Ubicacion           nuevo titulo
     * @param $Ciudad              nueva descripcion
     * @param $Direccion           nueva direccion
     * @param $Telefono            nueva telefono
     * @param $Piso                nueva categoria
     * @param $TipoJuzgado         nueva Nombre
     * @param $Area                nueva Email
     * @param $Estado              nueva Celular
     * @return PDOStatement
     */

    public static function insert( $Ubicacion, $Ciudad, $Direccion, $Telefono, $Piso, $TipoJuzgado, $Area, $Estado, $Email, $Edificio)
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ". $GLOBALS['TABLA'] ."( " .            
            " JUZ_Ubicacion," .
            " JUZ_IdCiudad," .
            " JUZ_Direccion," .
            " JUZ_Telefono," . 
            " JUZ_Piso," .
            " JUZ_IdTipoJuzgado," .
            " JUZ_IdArea," .
            " JUZ_Estado, " .
			" JUZ_Email, " .
			" JUZ_Edificio " .
            " ) VALUES(?,?,?,?,?,?,?,?,?,?);";
        try {
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(
                array( $Ubicacion, $Ciudad, $Direccion, $Telefono, $Piso, $TipoJuzgado, $Area, $Estado, $Email, $Edificio )    
            );
           
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return $e;
        }    
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $IdJuzgado identificador de la usu_usuario
     * @return bool Respuesta de la eliminación
     */
    public static function delete($IdUsuario)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM ". $GLOBALS['TABLA'] ." WHERE ". $GLOBALS['Llave']. " =? ;";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($IdUsuario));
    }

    /**
     * Verifica si existe el usuario
     *
     * @param $IdJuzgado identificador de la usu_usuario
     * @return bool Respuesta de la consulta
     */
    public static function existejuzgado($Ubicacion, $Ciudad, $TipoJuzgado, $Area, $idtabla) //($Ubicacion, $Ciudad, $Direccion, $Piso, $TipoJuzgado, $Area)
    {
        $consulta = "SELECT count(". $GLOBALS['Llave']. ") existe
        FROM " .$GLOBALS['TABLA'].
		" WHERE JUZ_Ubicacion = ? AND JUZ_IdCiudad = ? AND JUZ_IdTipoJuzgado = ? AND JUZ_IdArea = ? AND ". $GLOBALS['Llave'] ." <> ? ;";
		
		//echo "queyr....$consulta".$Ubicacion.' - '.$Ciudad.' - '.$TipoJuzgado.' - '.$Area.' - '.$idtabla;
		
        ////" WHERE JUZ_Ubicacion = ? AND JUZ_IdCiudad = ? AND JUZ_Direccion = ? AND JUZ_Piso = ? AND JUZ_IdTipoJuzgado =? AND JUZ_IdArea =? ;";
		////, JUZ_Ubicacion, JUZ_IdCiudad, JUZ_Direccion, JUZ_Piso, JUZ_IdTipoJuzgado, JUZ_IdArea

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
                ////$comando->execute(array($Ubicacion, $Ciudad, $Direccion, $Piso, $TipoJuzgado, $Area));
				$comando->execute(array($Ubicacion, $Ciudad, $TipoJuzgado, $Area, $idtabla));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return e;
        }
    }
}

?>