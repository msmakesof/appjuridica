<?php
/**
 * Obtiene el detalle de un usuario especificado por
 * su identificador "$IdUsuario"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/usu_usuario.php';
$msj="";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idU']) && isset($_GET['idC'])) 
    {
        // Obtener parámetro idUsuario y idClave de usu_usuario
        $parametro = trim($_GET['idU']);
        $parametroC = trim($_GET['idC']);

        // Tratar retorno
        $retorno = USU_USUARIO::getByIdApp($parametro,$parametroC);
        $msj = $retorno;
        if ($retorno) {
            $usu_usuario["estado"] = "1";
            $usu_usuario["usu_usuario"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($usu_usuario);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro',
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    }
	
    else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador...',
                'msj' => print_r($msj),
                'msj2' => var_dump ($msj)
            )
        );
    }
}
?>