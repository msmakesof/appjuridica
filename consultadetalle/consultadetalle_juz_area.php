<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/juz_area.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $LNK_TABLA = "AREA";
        $lnk_tabla = strtolower($LNK_TABLA);

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = JUZ_AREA::getById($parametro);

        if ($retorno) {
            $juz_area["estado"] = "1";
            $juz_area["juz_area"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($juz_area);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Tabla'
                )
            );
        }
    }
    elseif (isset($_GET['IdEstado'])) {
        // Obtener parámetro idEstado de juz_area
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = JUZ_AREA::getByIdEstado($parametro);

        if ($retorno) {
            $juz_area["estado"] = "1";
            $juz_area["juz_area"] = $retorno;
            // Enviar objeto json de juz_area
            header('Content-Type: application/json');
            echo json_encode($juz_area);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Tabla'
                )
            );
        }
    } 
    elseif (isset($_GET['idU']) && isset($_GET['idC'])) {
        // Obtener parámetro idUsuario y idClave de GEN_tipodocumento
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = JUZ_AREA::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $juz_area["estado"] = "1";
            $juz_area["juz_area"] = $retorno;
            // Enviar objeto json de juz_area
            header('Content-Type: application/json');
            echo json_encode($juz_area);
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

    elseif (isset($_GET['ExisteTabla']) )
    {
        $par1 = $_GET['Nombre'];       

        $retorno = JUZ_AREA::existetabla($par1);
        if ($retorno) 
        {
            $juz_area["estado"] = "1";
            $juz_area["juz_area"] = $retorno;
            // Enviar objeto json de la juz_area
            header('Content-Type: application/json');
            echo json_encode($juz_area);
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

    elseif (isset($_GET['IdMostrar'])) {
        // Obtener parámetro IdMostrar de juz_area
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = JUZ_AREA::getAll($parametro);

        if ($retorno) 
        {
            $juz_area["estado"] = "1";
            $juz_area["juz_area"] = $retorno;
            // Enviar objeto json de la juz_area
            header('Content-Type: application/json');
            echo json_encode($juz_area);
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
    elseif(isset($_GET['insert']) )
    {
        //Obtener Parametros
        $par1 = $_GET['Nombre'];        
        $par2 = $_GET['Estado'];
        $par3 = $_GET['Codigo'];

        $retorno = JUZ_AREA::insert($par1, $par2, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $juz_area["estado"] = "1";
            $juz_area["juz_area"] = $retorno;
             // Enviar objeto json de la juz_area
            header('Content-Type: application/json');
            echo json_encode($juz_area);
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
    elseif(isset($_GET['update']) )
    {
        //Obtener Parametros
        $par1 = $_GET['nombre'];        
        $par2 = $_GET['estado'];
        $par3 = $_GET['codigo'];
        $par4 = $_GET['idtabla'];

        $retorno = JUZ_AREA::update($par1, $par2, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $juz_area["estado"] = "1";
            $juz_area["juz_area"] = $retorno;
             // Enviar objeto json de la gen_ciudad
            header('Content-Type: application/json');
            echo json_encode($juz_area);
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

        $retorno = JUZ_AREA::delete($par0);
        if ($retorno) 
        {
            $juz_area["estado"] = "1";
            $juz_area["juz_area"] = $retorno;
            // Enviar objeto json de la gen_departamento
            header('Content-Type: application/json');
            echo json_encode($juz_area);
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

    else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}
?>