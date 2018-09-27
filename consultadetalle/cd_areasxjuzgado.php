<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/areasxjuzgado.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla']) && isset($_GET['fn'])) {

        if($_GET['fn'] == "jd")
        {
            // Obtener parámetro IdTabla = ARE_IdTipoJuzgado
            $parametro = $_GET['IdTabla'];

            $valor = explode('-',$parametro); 
            $TipoJuzgado = $valor[0];
            $Area = $valor[1];   

            // Tratar retorno            
            $retorno = AREASXJUZGADO::getById($TipoJuzgado, $Area);

            if ($retorno) 
            {
                $ja_areasxjuzgado["estado"] = "1";
                $ja_areasxjuzgado["juz_areasxjuzgado"] = $retorno;
                // Enviar objeto json de la meta
                header('Content-Type: application/json');
                echo json_encode($ja_areasxjuzgado);
            } 
            else 
            {
                // Enviar respuesta de error general
                print json_encode(
                    array(
                        'estado' => '2',
                        'mensaje' => 'No se obtuvo resultado en la consulta Juzgados x Especialidad.',
                        'sql ' => $retorno
                    )
                );
            }
        }    
    }
}
?>