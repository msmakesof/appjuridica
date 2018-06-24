<?php
    require_once('./Connections/DataConex.php');    
    $soportecURL = "S";
    $url = urlServicios."consultadetalle/consultadetalle_gen_control.php?idEstado=1";
    $llave = "";
    if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 0);
        $resultado = curl_exec ($ch);
        curl_close($ch);

        $m =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
	    $m = json_decode($m, true);

        $json_errors = array(
            JSON_ERROR_NONE => 'No se ha producido ningún error',
            JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
            JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
            JSON_ERROR_SYNTAX => 'Error de Sintaxis',
            );
        //echo "Error : ", $json_errors[json_last_error()], PHP_EOL, PHP_EOL."<br>";        
    }
    else
    {
        $soportecURL = "N";
        echo "No hay soporte para cURL";
    } 
    
    if($soportecURL == "N")
    {
        require_once('./unirest/vendor/autoload.php');
        $response = Unirest\Request::get($url, array("X-Mashape-Key" => "MY SECRET KEY"));
        $resultado = $response->raw_body;
        $resultado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);
        $m = json_decode($resultado, true);	        
    }
    $llave = $m['gen_control']['CON_LlaveAcceso'];        
    //
    // $cont = file_get_contents(urlServicios."consultadetalle/consultadetalle_gen_control.php?idEstado=1");     
    // $obj = json_decode($cont);    
    //$llave = $obj->gen_control->CON_LlaveAcceso ;    
?>