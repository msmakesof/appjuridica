<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/pro_ubicacion.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = PRO_UBICACION::getById($parametro);

        if ($retorno) {
            $pro_ubicacion["estado"] = "1";
            $pro_ubicacion["pro_ubicacion"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_ubicacion);
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
        // Obtener parámetro idEstado de PRO_UBICACION
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = PRO_UBICACION::getByIdEstado($parametro);

        if ($retorno) {
            $pro_ubicacion["estado"] = "1";
            $pro_ubicacion["pro_ubicacion"] = $retorno;
            // Enviar objeto json de PRO_UBICACION
            header('Content-Type: application/json');
            echo json_encode($pro_ubicacion);
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
        // Obtener parámetro idUsuario y idClave de usu_usuario
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = USU_GRUPO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $pro_ubicacion["estado"] = "1";
            $pro_ubicacion["pro_ubicacion"] = $retorno;
            // Enviar objeto json de  PRO_UBICACION
            header('Content-Type: application/json');
            echo json_encode($pro_ubicacion);
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

        $retorno = PRO_UBICACION::existetabla($par1);
        if ($retorno) 
        {
            $pro_ubicacion["estado"] = "1";
            $pro_ubicacion["pro_ubicacion"] = $retorno;
            // Enviar objeto json de PRO_UBICACION
            header('Content-Type: application/json');
            echo json_encode($pro_ubicacion);
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
        // Obtener parámetro IdMostrar de PRO_UBICACION
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = PRO_UBICACION::getAll($parametro);

        if ($retorno) 
        {
            $pro_ubicacion["estado"] = "1";
            $pro_ubicacion["pro_ubicacion"] = $retorno;
            // Enviar objeto json de la PRO_UBICACION
            header('Content-Type: application/json');
            echo json_encode($pro_ubicacion);
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
        $par3 = $_GET['Estado'];

        $retorno = PRO_UBICACION::insert($par1, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $pro_ubicacion["estado"] = "1";
            $pro_ubicacion["pro_ubicacion"] = $retorno;
             // Enviar objeto json de la PRO_UBICACION
            header('Content-Type: application/json');
            echo json_encode($pro_ubicacion);
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
        $par3 = $_GET['estado'];
        $par4 = $_GET['idtabla'];

        $retorno = PRO_UBICACION::update($par1, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $pro_ubicacion["estado"] = "1";
            $pro_ubicacion["pro_ubicacion"] = $retorno;
             // Enviar objeto json de la PRO_UBICACION
            header('Content-Type: application/json');
            echo json_encode($pro_ubicacion);
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

        $retorno = PRO_UBICACION::delete($par0);
        if ($retorno) 
        {
            $pro_ubicacion["estado"] = "1";
            $pro_ubicacion["pro_ubicacion"] = $retorno;
            // Enviar objeto json de la PRO_UBICACION
            header('Content-Type: application/json');
            echo json_encode($pro_ubicacion);
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