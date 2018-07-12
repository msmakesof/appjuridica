<?php
/**
 * Obtiene el detalle de un Tipo Documento especificada por
 * su identificador "$IdTipoDocumento"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_tipodocumento.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTipoDocumento'])) {

        // Obtener parámetro IdTipoDocumento
        $parametro = $_GET['IdTipoDocumento'];

        // Tratar retorno
        $retorno = GEN_TIPODOCUMENTO::getById($parametro);

        if ($retorno) {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en tipo documento'
                )
            );
        }
    }
    elseif (isset($_GET['IdEstado'])) {
        // Obtener parámetro idEstado de gen_tipodocumento
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = GEN_TIPODOCUMENTO::getByIdEstado($parametro);

        if ($retorno) {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
            // Enviar objeto json de la gen_tipodocumento
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Tipo Documento'
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