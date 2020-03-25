<?php
/**
 * Obtiene el detalle de una Tabla especificada porIdEstado
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/men_submenu.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = MEN_SUBMENU::getById($parametro);

        if ($retorno) {
            $men_submenu["estado"] = "1";
            $men_submenu["men_submenu"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($men_submenu);
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
	elseif (isset($_GET['IdMenu'])) {

        // Obtener parámetro IdMenu
        $parametro = $_GET['IdMenu'];

        // Tratar retorno
        $retorno = MEN_SUBMENU::getByIdMenu($parametro);

        if ($retorno) {
            $men_submenu["estado"] = "1";
            $men_submenu["men_submenu"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($men_submenu);
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
        // Obtener parámetro idEstado de MEN_MENU
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = MEN_SUBMENU::getByIdEstado($parametro);

        if ($retorno) {
            $men_submenu["estado"] = "1";
            $men_submenu["men_submenu"] = $retorno;
            // Enviar objeto json de MEN_MENU
            header('Content-Type: application/json');
            echo json_encode($men_submenu);
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
        // Obtener parámetro idUsuario y idClave de MEN_MENU		
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = MEN_SUBMENU::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $men_submenu["estado"] = "1";
            $men_submenu["men_submenu"] = $retorno;
            // Enviar objeto json de USU_ACCION
            header('Content-Type: application/json');
            echo json_encode($men_submenu);
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

        $retorno = MEN_SUBMENU::existetabla($par1);
        if ($retorno) 
        {
            $men_submenu["estado"] = "1";
            $men_submenu["men_submenu"] = $retorno;
            // Enviar objeto json de MEN_MENU
            header('Content-Type: application/json');
            echo json_encode($men_submenu);
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
        // Obtener parámetro IdMostrar de MEN_MENU
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = MEN_SUBMENU::getAll($parametro);

        if ($retorno) 
        {
            $men_submenu["estado"] = "1";
            $men_submenu["men_submenu"] = $retorno;
            // Enviar objeto json de MEN_MENU
            header('Content-Type: application/json');
            echo json_encode($men_submenu);
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
        $par2 = $_GET['Icono'];
        $par3 = $_GET['Estado'];
		$par4 = $_GET['Menu'];
		$par5 = $_GET['Link'];

        $retorno = MEN_SUBMENU::insert($par1, $par2, $par3, $par4, $par5);
        $msj = $retorno;
        if($retorno)
        {
            $men_submenu["estado"] = "1";
            $men_submenu["men_submenu"] = $retorno;
             // Enviar objeto json de MEN_MENU
            header('Content-Type: application/json');
            echo json_encode($men_submenu);
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
        $par2 = $_GET['icono'];		
        $par3 = $_GET['estado'];
        $par4 = $_GET['menu'];
		$par5 = $_GET['link'];
		$par6 = $_GET['idtabla'];

        $retorno = MEN_SUBMENU::update($par1, $par2, $par3, $par4, $par5, $par6);
        $msj = $retorno;
        if($retorno)
        {
            $men_submenu["estado"] = "1";
            $men_submenu["men_submenu"] = $retorno;
             // Enviar objeto json de MEN_MENU
            header('Content-Type: application/json');
            echo json_encode($men_submenu);
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

        $retorno = MEN_SUBMENU::delete($par0);
        if ($retorno) 
        {
            $men_submenu["estado"] = "1";
            $men_submenu["men_submenu"] = $retorno;
            // Enviar objeto json de MEN_MENU
            header('Content-Type: application/json');
            echo json_encode($men_submenu);
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