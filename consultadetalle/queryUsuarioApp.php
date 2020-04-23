<?php
//if(!isset($_SESSION)) 
//{ 
    //session_start(); 
//}
require_once('../Connections/config2.php');       
require_once('../Connections/DataConex.php');    

$existe      = "";
$url =" ** vacio ** ";
$usuario = "";
$clave =  "";
if(isset($_GET['idU']) && isset($_GET['idC'])) {
    $usuario = $_GET['idU'];
    $clave =  $_GET['idC'];
}

    $clave = encryptor('encrypt', $clave);
    //echo("<script>console.log('PHP usuario: ".$clave."');</script>");
    $soportecURL = "S";
    $url         = urlServicios."consultadetalle/consultadetalle_Usuario.php?idU=$usuario&idC=$clave";
    //echo("<script>console.log('clave: ".$clave."');</script>");
    //echo("<script>console.log('UserData: ".$url."');</script>")."<br>";
    //echo "Srv: ".$url."<br>";
    
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
    $existe    = $m['usu_usuario']['TotalUsuario'];
    $IdUsuario = $m['usu_usuario']['USU_IdUsuario'];

    //echo trim($existe);
    echo json_encode($m['usu_usuario']);
    //var_dump($m['usu_usuario']); 
    //echo $url;   
?>