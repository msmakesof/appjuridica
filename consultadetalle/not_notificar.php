<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/not_notificar.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{	
	if(isset($_GET['insert']) )
    {
		$par1 = $_GET['idtabla'];
		$par2 = $_GET['idusuario'];
        $par3 = $_GET['fechahabil'];        
		
		$retorno = NOT_NOTIFICAR::insert($par1, $par2, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $not_notificar["estado"] = "1";
            $not_notificar["not_notificar"] = $retorno;
             // Enviar objeto json de NOT_NOTIFICAR
            header('Content-Type: application/json');
            echo json_encode($not_notificar);
        }
        else
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro al Crear',
					'msj' => $msj
                )
            );
        }
	}
}
?>