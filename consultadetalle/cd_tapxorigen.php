<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/pro_tipoactuacionprocesal.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla']) && isset($_GET['fn'])) {

        if($_GET['fn'] == "or")
        {
            // Obtener parámetro IdTabla 
            $parametro = $_GET['IdTabla'];

            // $valor = explode('-',$parametro); 
            // $TipoJuzgado = $valor[0];
            // $Area = $valor[1];   

            // Tratar retorno            
            $retorno = PRO_TIPOACTUACIONPROCESAL::getIdTapxOrigen($parametro);  // , $Area
			
            if ($retorno) 
            {
                $pro_actuacionprocesal["estado"] = "1";
                $pro_actuacionprocesal["pro_actuacionprocesal"] = $retorno;
                // Enviar objeto json de la meta
                header('Content-Type: application/json');
                echo json_encode($pro_actuacionprocesal);
            } 
            else 
            {
                // Enviar respuesta de error general
                print json_encode(
                    array(
                        'estado' => '2',
                        'mensaje' => 'No se obtuvo resultado en la consulta Origen por Atuación Procesal.',
                        'sql ' => $retorno
                    )
                );
            }
        }    
    }
}
?>