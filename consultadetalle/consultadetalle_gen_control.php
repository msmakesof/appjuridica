<?php
/**
 * Obtiene el detalle de una meta especificada por
 * su identificador "idControl"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_control.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idControl'])) {

        // Obtener parámetro idControl
        $parametro = $_GET['idControl'];

        // Tratar retorno
        $retorno = GEN_CONTROL::getById($parametro);

        if ($retorno) {
            $gen_control["estado"] = "1";
            $gen_control["gen_control"] = $retorno;
            // Enviar objeto json de la gen_control
            header('Content-Type: application/json');
            echo json_encode($gen_control);
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
        $retorno = GEN_CONTROL::getByIdEstado($parametro);

        if ($retorno) {
            $gen_control["estado"] = "1";
            $gen_control["gen_control"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_control);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
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