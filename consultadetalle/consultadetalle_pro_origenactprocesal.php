<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/pro_origenactprocesal.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = PRO_ORIGENACTPROCESAL::getById($parametro);

        if ($retorno) {
            $pro_origenactprocesal["estado"] = "1";
            $pro_origenactprocesal["pro_origenactprocesal"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_origenactprocesal);
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
    elseif (isset($_GET['IdOrigen'])) {
        // Obtener parámetro idEstado de RO_ESTADOPROCESO
        $parametro = $_GET['IdOrigen'];

        // Tratar retorno
        $retorno = PRO_ORIGENACTPROCESAL::getByIdEstado($parametro);

        if ($retorno) {
            $pro_origenactprocesal["estado"] = "1";
            $pro_origenactprocesal["pro_origenactprocesal"] = $retorno;
            // Enviar objeto json de RO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_origenactprocesal);
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
            $pro_origenactprocesal["estado"] = "1";
            $pro_origenactprocesal["pro_origenactprocesal"] = $retorno;
            // Enviar objeto json de  RO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_origenactprocesal);
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
		$par2 = $_GET['idtabla'];

        $retorno = PRO_ORIGENACTPROCESAL::existetabla($par1,$par2);
        if ($retorno) 
        {
            $pro_origenactprocesal["estado"] = "1";
            $pro_origenactprocesal["pro_origenactprocesal"] = $retorno;
            // Enviar objeto json de RO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_origenactprocesal);
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
        // Obtener parámetro IdMostrar de pro_origenactprocesal
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = PRO_ORIGENACTPROCESAL::getAll($parametro);

        if ($retorno) 
        {
            $pro_origenactprocesal["estado"] = "1";
            $pro_origenactprocesal["pro_origenactprocesal"] = $retorno;
            // Enviar objeto json de la RO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_origenactprocesal);
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

        $retorno = PRO_ORIGENACTPROCESAL::insert($par1, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $pro_origenactprocesal["estado"] = "1";
            $pro_origenactprocesal["pro_origenactprocesal"] = $retorno;
             // Enviar objeto json de la  pro_origenactprocesal
            header('Content-Type: application/json');
            echo json_encode($pro_origenactprocesal);
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

        $retorno = PRO_ORIGENACTPROCESAL::update($par1, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $pro_origenactprocesal["estado"] = "1";
            $pro_origenactprocesal["pro_origenactprocesal"] = $retorno;
             // Enviar objeto json de la pro_origenactprocesal
            header('Content-Type: application/json');
            echo json_encode($pro_origenactprocesal);
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

        $retorno = PRO_ORIGENACTPROCESAL::delete($par0);
        if ($retorno) 
        {
            $pro_origenactprocesal["estado"] = "1";
            $pro_origenactprocesal["pro_origenactprocesal"] = $retorno;
            // Enviar objeto json de la pro_origenactprocesal
            header('Content-Type: application/json');
            echo json_encode($pro_origenactprocesal);
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