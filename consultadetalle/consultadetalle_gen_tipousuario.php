<?php
/**
 * Obtiene el detalle de un Tipo Usuario especificada por
 * su identificador "$IdTipoUsuario"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_tipousuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTipoUsuario'])) {

        // Obtener parámetro IdTipoUsuario
        $parametro = $_GET['IdTipoUsuario'];

        // Tratar retorno
        $retorno = GEN_TIPOUSUARIO::getById($parametro);

        if ($retorno) {
            $gen_tipousuario["estado"] = "1";
            $gen_tipousuario["gen_tipousuario"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_tipousuario);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en tipo Usuario'
                )
            );
        }
    }
    elseif (isset($_GET['IdEstado'])) {
        // Obtener parámetro idEstado de gen_tipousuario
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = GEN_TIPOUSUARIO::getByIdEstado($parametro);

        if ($retorno) {
            $gen_tipousuario["estado"] = "1";
            $gen_tipousuario["gen_tipousuario"] = $retorno;
            // Enviar objeto json de la gen_tipousuario
            header('Content-Type: application/json');
            echo json_encode($gen_tipousuario);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Tipo Usuario'
                )
            );
        }
    } 
    elseif (isset($_GET['idU']) && isset($_GET['idC'])) {
        // Obtener parámetro idUsuario y idClave de usu_usuario
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = USU_USUARIO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $gen_tabla["estado"] = "1";
            $gen_tabla["gen_tabla"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($gen_tabla);
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