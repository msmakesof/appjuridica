<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/areasxtipojuzgado.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla']) && isset($_GET['fn'])) {

        if($_GET['fn'] == "ja")
        {
            // Obtener parámetro IdTabla = ARE_IdTipoJuzgado
            $parametro = $_GET['IdTabla']; 

            // Tratar retorno
            $retorno = AREASXTIPOJUZGADO::getById($parametro);

            if ($retorno) 
            {
                $ja_areasxtipojuzgado["estado"] = "1";
                $ja_areasxtipojuzgado["juz_areasxtipojuzgado"] = $retorno;
                // Enviar objeto json de la meta
                header('Content-Type: application/json');
                echo json_encode($ja_areasxtipojuzgado);
            } 
            else 
            {
                // Enviar respuesta de error general
                print json_encode(
                    array(
                        'estado' => '2',
                        'mensaje' => 'No se obtuvo resultado en la consulta Areas x Tipo Juzgado.'
                    )
                );
            }
        }    
    }
}
?>