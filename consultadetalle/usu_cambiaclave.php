<?php
/**
 * Obtiene el detalle de una meta especificada por
 * su identificador "idControl"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/usu_cambiaclave.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['Busca'])) {
        
        $par1 = $_GET['Email'];
        $par2 = $_GET['Codigo'];

        // Tratar retorno
        $retorno = USU_CAMBIACLAVE::getById($par1, $par2);

        if ($retorno) {
            $usu_cambiaclave["estado"] = "1";
            $usu_cambiaclave["usu_cambiaclave"] = $retorno;
            // Enviar objeto json de la gen_control
            header('Content-Type: application/json');
            echo json_encode($usu_cambiaclave);
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
        // Obtener parámetro idEstado de gen_control
        $parametro = $_GET['idEstado'];

        // Tratar retorno
        $retorno = USU_CAMBIACLAVE::getByIdEstado($parametro);

        if ($retorno) {
            $usu_cambiaclave["estado"] = "1";
            $usu_cambiaclave["usu_cambiaclave"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($usu_cambiaclave);
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
    elseif (isset($_GET['Insert'])) {
        // Obtener parámetro idEstado de gen_control
        $par1 = $_GET['Email'];
        $par2 = $_GET['Codigo'];
        $par3 = 1;        

        // Tratar retorno
        $retorno = USU_CAMBIACLAVE::insert($par1, $par2, $par3);

        if ($retorno) {
            $usu_cambiaclave["estado"] = "1";
            $usu_cambiaclave["usu_cambiaclave"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($usu_cambiaclave);
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
    elseif (isset($_GET['Update'])) {
        // Obtener parámetro idEstado de gen_control
        $par1 = $_GET['mail'];
        $par3 = $_GET['codigo'];
        $par5 = 0;

        // Tratar retorno
        $retorno = USU_CAMBIACLAVE::update($par1, $par3, $par5);

        if ($retorno) {
            $usu_cambiaclave["estado"] = "1";
            $usu_cambiaclave["usu_cambiaclave"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($usu_cambiaclave);
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
    elseif (isset($_GET['VerificaData'])) {
        // Obtener parámetro idEstado de gen_control
        $par1 = $_GET['mail'];        
        $par2 = $_GET['codigo'];        

        // Tratar retorno
        $retorno = USU_CAMBIACLAVE::verificadata($par1, $par2);

        if ($retorno) {
            $usu_cambiaclave["estado"] = "1";
            $usu_cambiaclave["usu_cambiaclave"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($usu_cambiaclave);
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
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}
?>