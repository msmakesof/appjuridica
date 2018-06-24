<?php
/**
 * Obtiene todas las gen_control de la base de datos
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_control.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $gen_control = GEN_CONTROL::getAll();

    if ($gen_control) {

        $datos["estado"] = 1;
        $datos["gen_control"] = $gen_control;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error en Consulta Control"
        ));
    }
}
?>