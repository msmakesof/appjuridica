<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/pro_estadoproceso.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = PRO_ESTADOPROCESO::getById($parametro);

        if ($retorno) {
            $pro_estadoproceso["estado"] = "1";
            $pro_estadoproceso["pro_estadoproceso"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_estadoproceso);
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
        // Obtener parámetro idEstado de RO_ESTADOPROCESO
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = PRO_ESTADOPROCESO::getByIdEstado($parametro);

        if ($retorno) {
            $pro_estadoproceso["estado"] = "1";
            $pro_estadoproceso["pro_estadoproceso"] = $retorno;
            // Enviar objeto json de RO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_estadoproceso);
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
            $pro_estadoproceso["estado"] = "1";
            $pro_estadoproceso["pro_estadoproceso"] = $retorno;
            // Enviar objeto json de  RO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_estadoproceso);
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

        $retorno = PRO_ESTADOPROCESO::existetabla($par1,$par2);
        if ($retorno) 
        {
            $pro_estadoproceso["estado"] = "1";
            $pro_estadoproceso["pro_estadoproceso"] = $retorno;
            // Enviar objeto json de RO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_estadoproceso);
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
        // Obtener parámetro IdMostrar de PRO_ESTADOPROCESO
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = PRO_ESTADOPROCESO::getAll($parametro);

        if ($retorno) 
        {
            $pro_estadoproceso["estado"] = "1";
            $pro_estadoproceso["pro_estadoproceso"] = $retorno;
            // Enviar objeto json de la RO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_estadoproceso);
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

        $retorno = PRO_ESTADOPROCESO::insert($par1, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $pro_estadoproceso["estado"] = "1";
            $pro_estadoproceso["pro_estadoproceso"] = $retorno;
             // Enviar objeto json de la  PRO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_estadoproceso);
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

        $retorno = PRO_ESTADOPROCESO::update($par1, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $pro_estadoproceso["estado"] = "1";
            $pro_estadoproceso["pro_estadoproceso"] = $retorno;
             // Enviar objeto json de la PRO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_estadoproceso);
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

        $retorno = PRO_ESTADOPROCESO::delete($par0);
        if ($retorno) 
        {
            $pro_estadoproceso["estado"] = "1";
            $pro_estadoproceso["pro_estadoproceso"] = $retorno;
            // Enviar objeto json de la PRO_ESTADOPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_estadoproceso);
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