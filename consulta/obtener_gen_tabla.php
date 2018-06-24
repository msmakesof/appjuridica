<?php
/**
 * Obtiene todas las gen_tabla de la base de datos
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_tabla.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $gen_tabla = GEN_TABLA::getAll();

    if ($gen_tabla) {

        $datos["estado"] = 1;
        $datos["gen_tabla"] = $gen_tabla;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error en Consulta Tablas"
        ));
    }
}
?>