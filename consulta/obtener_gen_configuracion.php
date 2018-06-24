<?php
/**
 * Obtiene todas las gen_configuracion de la base de datos
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_configuracion.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $gen_configuracion = GEN_CONFIGURACION::getAll();

    if ($gen_configuracion) {

        $datos["estado"] = 1;
        $datos["gen_configuracion"] = $gen_configuracion;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}
?>