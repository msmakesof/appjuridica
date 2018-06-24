<?php
/**
 * Obtiene el detalle de una meta especificada por
 * su identificador "idConfiguracion"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_configuracion.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idConfiguracion'])) {

        // Obtener parámetro idConfiguracion
        $parametro = $_GET['idConfiguracion'];

        // Tratar retorno
        $retorno = GEN_CONFIGURACION::getById($parametro);

        if ($retorno) {
            $gen_configuracion["estado"] = "1";
            $gen_configuracion["gen_configuracion"] = $retorno;
            // Enviar objeto json de la gen_configuracion
            header('Content-Type: application/json');
            echo json_encode($gen_configuracion);
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
        // Obtener parámetro idEstado de gen_configuracion
        $parametro = $_GET['idEstado'];

        // Tratar retorno
        $retorno = gen_configuracion::getByIdEstado($parametro);

        if ($retorno) {
            $gen_configuracion["estado"] = "1";
            $gen_configuracion["gen_configuracion"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            
            echo json_encode( $gen_configuracion);
            //echo $gen_configuracion;
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