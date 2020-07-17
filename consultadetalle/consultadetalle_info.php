<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/info.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdUsuario'])) {

        // Obtener parámetro IdUsuario
        $parametro = $_GET['IdUsuario'];
		$tipousuario = $_GET['tu'];
		$empresa = $_GET['em'];

        // Tratar retorno
        $retorno = PRO_PROCESO::infoUsuario($parametro, $tipousuario, $empresa);

        if ($retorno) {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Proceso por su Id'
                )
            );
        }
    }
	elseif (isset($_GET['ClientesxUsuario'])) {

        // Obtener parámetro ClientesxUsuario
        $parametro = $_GET['ClientesxUsuario'];
		$tipousuario = $_GET['tu'];
		$empresa = $_GET['em'];
		
        // Tratar retorno
        $retorno = PRO_PROCESO::clientesxUsuario($parametro, $tipousuario, $empresa);

        if ($retorno) {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Proceso por su Id'
                )
            );
        }
    }
	
	elseif (isset($_GET['MiAgenda'])) {

        // Obtener parámetro MiAgenda
        $parametro = $_GET['MiAgenda'];
		$tipousuario = $_GET['tu'];
		$empresa = $_GET['em'];

        // Tratar retorno
        $retorno = PRO_PROCESO::miAgenda($parametro, $tipousuario, $empresa);

        if ($retorno) {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Proceso por su Id'
                )
            );
        }
    }
	elseif (isset($_GET['infoProcesoJudicial'])) {

        // Obtener parámetro infoProcesoJudicial
        $parametro = $_GET['infoProcesoJudicial'];
		$tipousuario = $_GET['tu'];
		$empresa = $_GET['em'];

        // Tratar retorno
        $retorno = PRO_PROCESO::infoProcesoJudicial($parametro, $tipousuario, $empresa);

        if ($retorno) {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Proceso por su Id'
                )
            );
        }
    }
	else 
	{
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador en consuta detalle del Proceso.'
            )
        );
    }
}
?>