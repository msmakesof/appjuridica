<?php
/**
 * Obtiene todas las usu_usuario de la base de datos
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/usu_usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $usu_usuario = USU_USUARIO::getAll();

    if ($usu_usuario) {

        $datos["estado"] = 1;
        $datos["usu_usuario"] = $usu_usuario;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error en Consulta Usuario"
        ));
    }
}
?>