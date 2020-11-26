<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/robotnotifica.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	
	if (isset($_GET['IdMostrar'])) {
        // Obtener parámetro IdMostrar de robotnotifica
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }
		$pusuario = $_GET['u'];  // IdUsuario
		$ptipousuario = $_GET['t']; //TipoUsuario
		$pempresa = $_GET['e'];   // Empresa
		$pdiascalcula = $_GET['dc'];

        // Tratar retorno
        $retorno = ROBOTNOTIFICA::getAll($pusuario,$ptipousuario,$pempresa,$pdiascalcula);

        if ($retorno) 
        {
            $robotnotifica["estado"] = "1";
            $robotnotifica["robotnotifica"] = $retorno;
            // Enviar objeto json de la robotnotifica
            header('Content-Type: application/json');
            echo json_encode($robotnotifica);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    
    }
}
?>