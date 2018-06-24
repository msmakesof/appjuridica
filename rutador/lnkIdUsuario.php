<?php
    //session_start();
    require_once('../Connections/DataConex.php');    
    $soportecURL = "S";
    $url         = urlServicios."consultadetalle/consultadetalle_Usuario.php?IdUsuario=$IdUsuario";
    $existe      = "";
    $usulocal    = "";
    $siguex      = "";
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
    //$existe    = $m['usu_usuario']['TotalUsuario'];
    //$IdUsuario = $m['usu_usuario']['USU_IdUsuario'];
    echo "<br><br><br><br>";
    print_r($resultado);

    $NombreUsuario = trim($m['usu_usuario']['USU_Nombre']) .' '. trim($m['usu_usuario']['USU_PrimerApellido']).' '. trim($m['usu_usuario']['USU_SegundoApellido']);
    $EmailUsuario = $m['usu_usuario']['USU_Email'];
    
    
    // if($existe == 1)
    // {                  
    //     //require_once('./funciones/valida.php');
    //     //$siguex = $sigue;
    //     $soportecURL = "S";
    //     $url   = urlServicios."consultadetalle/consultadetalle_Usuario.php?IdUsuario=$IdUsuario";
    //     if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
    //     {
    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_VERBOSE, true);
    //         curl_setopt($ch, CURLOPT_URL, $url);
    //         curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //         curl_setopt($ch, CURLOPT_POST, 0);
    //         $resultado = curl_exec ($ch);
    //         curl_close($ch);

    //         $m =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    //         $m = json_decode($m, true);

    //         $json_errors = array(
    //             JSON_ERROR_NONE => 'No se ha producido ningún error',
    //             JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
    //             JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
    //             JSON_ERROR_SYNTAX => 'Error de Sintaxis',
    //             );
    //         //echo "Error : ", $json_errors[json_last_error()], PHP_EOL, PHP_EOL."<br>";             
    //         $usulocal = $m['usu_usuario']['USU_Local'] ;
    //         $nombres =  $m['usu_usuario']['USU_Nombre'].' '.$m['usu_usuario']['USU_PrimerApellido'].' '.$m['usu_usuario']['USU_SegundoApellido'];
    //         $email =  $m['usu_usuario']['USU_Email'];
            
    //         $_SESSION['Usuario'] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $usulocal);
    //         $_SESSION['NombreUsuario'] = $nombres ;
    //         $_SESSION['EmailUsuario'] = $email ;            
    //     }
    //     else
    //     {
    //         $soportecURL = "N";
    //         echo "No hay soporte para cURL";
    //     } 

    // }
    
    
    // if($IdUsuario != "")    
    // {
    //     require_once('./Connections/config2.php');
    //     //require_once('config2.php');
    //     $IdUsuario = encryptor('encrypt',$IdUsuario);
    //     $cookie_name = "Pharametrykham";
    //     $cookie_value = encryptor('encrypt', $usulocal);
    //     setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    // }   
    // $pasar = trim($existe).'-'.trim($IdUsuario);
    // echo $pasar;
?>