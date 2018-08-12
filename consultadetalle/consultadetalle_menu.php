<?php
/**
 * Obtiene el detalle de una Tabla especificada porIdEstado
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/menu.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = MENU::getById($parametro);

        if ($retorno) {
            $menu["estado"] = "1";
            $menu["menu"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($menu);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Menu'
                )
            );
        }
    }
    elseif (isset($_GET['IdEstado'])) {
        // Obtener parámetro idEstado de MENU
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = MENU::getByIdEstado($parametro);

        if ($retorno) {
            $menu["estado"] = "1";
            $menu["menu"] = $retorno;
            // Enviar objeto json de MENU
            header('Content-Type: application/json');
            echo json_encode($menu);
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
        // Obtener parámetro idUsuario y idClave de MENU
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = USU_USUARIO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $menu["estado"] = "1";
            $menu["menu"] = $retorno;
            // Enviar objeto json de MENU
            header('Content-Type: application/json');
            echo json_encode($menu);
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

        $retorno = MENU::existetabla($par1);
        if ($retorno) 
        {
            $menu["estado"] = "1";
            $menu["menu"] = $retorno;
            // Enviar objeto json de MENU
            header('Content-Type: application/json');
            echo json_encode($menu);
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
        // Obtener parámetro IdMostrar de MENU
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = MENU::getAll($parametro);

        if ($retorno) 
        {
            $menu["estado"] = "1";
            $menu["menu"] = $retorno;
            // Enviar objeto json de la MENU
            header('Content-Type: application/json');
            echo json_encode($menu);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en ConsultaDetalle'
                )
            );
        }
    
    }
    elseif(isset($_GET['insert']) )
    {
        //Obtener Parametros
        $par1 = $_GET['Nombre'];        
        $par3 = $_GET['Estado'];

        $retorno = MENU::insert($par1, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $menu["estado"] = "1";
            $menu["menu"] = $retorno;
             // Enviar objeto json de MENU
            header('Content-Type: application/json');
            echo json_encode($menu);
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
        //$par2 = $_GET['nombremostrar'];
        $par3 = $_GET['estado'];
        $par4 = $_GET['idtabla'];

        $retorno = MENU::update($par1, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $menu["estado"] = "1";
            $menu["menu"] = $retorno;
             // Enviar objeto json de MENU
            header('Content-Type: application/json');
            echo json_encode($menu);
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

        $retorno = MENU::delete($par0);
        if ($retorno) 
        {
            $menu["estado"] = "1";
            $menu["menu"] = $retorno;
            // Enviar objeto json de MENU
            header('Content-Type: application/json');
            echo json_encode($menu);
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