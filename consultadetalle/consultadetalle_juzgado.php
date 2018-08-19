<?php
/**
 * Obtiene el detalle de un usuario especificado por
 * su identificador "$IdUsuario"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/juz_juzgado.php';
$msj="";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdUsuario'])) {

        // Obtener parámetro IdUsuario
        $parametro = $_GET['IdUsuario'];

        // Tratar retorno
        $retorno = JUZ_JUZGADO::getById($parametro);

        if ($retorno) {
            $juz_juzgado["estado"] = "1";
            $juz_juzgado["juz_juzgado"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($juz_juzgado);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    }
    elseif (isset($_GET['idEstado'])) {
        // Obtener parámetro idEstado de usu_usuario
        $parametro = $_GET['idEstado'];

        // Tratar retorno
        $retorno = JUZ_JUZGADO::getByIdEstado($parametro);

        if ($retorno) 
        {
            $juz_juzgado["estado"] = "1";
            $juz_juzgado["juz_juzgado"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($juz_juzgado);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    } 
    elseif (isset($_GET['IdMostrar'])) {
        // Obtener parámetro IdMostrar de usu_usuario
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = JUZ_JUZGADO::getAll($parametro);

        if ($retorno) 
        {
            $juz_juzgado["estado"] = "1";
            $juz_juzgado["juz_juzgado"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($juz_juzgado);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    
    }

    elseif(isset($_GET['ExisteJuzgado']) )
    {
        $par2  = $_GET['Ubicacion'];        
        $par3  = $_GET['Ciudad'];
        $par4  = $_GET['Direccion'];
        $par5  = $_GET['Piso'];
        $par6  = $_GET['TipoJuzgado'];
        $par7  = $_GET['Area'];

        $retorno = JUZ_JUZGADO::existejuzgado($par2,$par3,$par4,$par5,$par6,$par7);
        if ($retorno) 
        {
            $juz_juzgado["estado"] = "1";
            $juz_juzgado["juz_juzgado"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($juz_juzgado);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro al verificar Si Existe Registro'
                )
            );
        }
    }

    elseif(isset($_GET['insert']) )
    {
        // Obtener parámetros        
        $par1 = $_GET['Ubicacion'];
        $par2 = $_GET['Ciudad'];        
        $par3 = $_GET['Direccion'];
        $par4 = $_GET['Piso'];
        $par5 = $_GET['TipoJuzgado'];
        $par6 = $_GET['Area'];
        $par7 = $_GET['Estado'];
        
        $retorno = JUZ_JUZGADO::insert($par1,$par2,$par3,$par4,$par5,$par6,$par7);        
        $msj =$retorno;
        if ($retorno) 
        {
            $juz_juzgado["estado"] = "1";
            $juz_juzgado["juz_juzgado"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($juz_juzgado);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro al insertar Registro'
                )
            );
        }
    }
    
    elseif(isset($_GET['update']) )
    {
        // Obtener parámetros               
        $par1 = $_GET['Ubicacion'];
        $par2 = $_GET['Ciudad'];        
        $par3 = $_GET['Direccion'];
        $par4 = $_GET['Piso'];
        $par5 = $_GET['TipoJuzgado'];
        $par6 = $_GET['Area'];
        $par7 = $_GET['Estado'];
        $par0 = $_GET['idtabla'];    

        $retorno = JUZ_JUZGADO::update($par1,$par2,$par3,$par4,$par5,$par6,$par7,$par0);
        $msj =$retorno;
        if ($retorno) 
        {
            $juz_juzgado["estado"] = "1";
            $juz_juzgado["juz_juzgado"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($juz_juzgado);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    }

    elseif(isset($_GET['delete']) )
    {
        $par0  = $_GET['pidtabla'];

        $retorno = JUZ_JUZGADO::delete($par0);
        if ($retorno) 
        {
            $juz_juzgado["estado"] = "1";
            $juz_juzgado["juz_juzgado"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($juz_juzgado);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    }

    elseif (isset($_GET['idU']) && isset($_GET['idC'])) 
    {
        // Obtener parámetro idUsuario y idClave de usu_usuario
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = JUZ_JUZGADO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $juz_juzgado["estado"] = "1";
            $juz_juzgado["juz_juzgado"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($juz_juzgado);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    }
    else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador...',
                'msj' => print_r($msj),
                'msj2' => var_dump ($msj)
            )
        );
    }
}
?>