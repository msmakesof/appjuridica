<?php
    require_once('./Connections/DataConex.php');     
    $soportecURL = "S";
    $url         = urlServicios."consultadetalle/consultadetalle_Usuario.php?idU=$usuario&idC=$clave";
    $existe      = "";
    $usulocal    = "";
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
    
    $existe =  $m['usu_usuario']['TotalUsuario'];
    $usulocal= $m['usu_usuario']['Usu_Local'] ;
    //echo trim($existe)."-".trim($usulocal);

    if($existe == 1)
    {              
        //require_once('./funciones/valida.php');
        header('./funciones/valida.php?usulocal'.$usulocal);    
    }
    //
    //$cont = file_get_contents(urlServicios."consultadetalle/consultadetalle_Usuario.php?idU=$usuario&idC=$clave");
    //$obj = json_decode($cont);
    //
    // No olvidar cambiar el nombre usu_usuario por el referenciado en la clase obtener_xxxxxxx
    //$existe = $obj->usu_usuario->TotalUsuario ;  
    //$usulocal= $obj->usu_usuario->Usu_Local ;  
?>