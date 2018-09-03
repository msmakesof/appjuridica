<?php
// require_once('../../Connections/cnn_kn.php'); 
// require_once('../../Connections/config2.php');
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 

//Comprobamos que el valor no venga vacío
if(isset($_GET['funcion']) && !empty($_GET['funcion'])) {

    require_once('../../Connections/DataConex.php');
    $soportecURL = "S";
    $url = "";
    $funcion = $_GET['funcion'];
    $origen = $_GET['origen'];
    $idTabla = $origen;

    switch ($funcion)
    {
        case "c":
            include('../../apis/general/ciudad.php');
            $mjuzgado= json_encode($mciudad, JSON_PRETTY_PRINT);
            $mjuzgadox = substr($mjuzgado, 1);
            $mjuzgadox= str_replace(")","",$mjuzgadox);    
            $mretorno= "{".$mjuzgadox;
            break;
        
        case "j":
            include('../../apis/juzgado/juzgado.php');
            $mjuzgado= json_encode($mjuzgado, JSON_PRETTY_PRINT);
            $mjuzgadox = substr($mjuzgado, 1);
            $mjuzgadox= str_replace(")","",$mjuzgadox);    
            $mretorno= "{".$mjuzgadox;
            break;
    }    
        
    print_r($mretorno);

    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return array(
                "status" => 0,
                "value" => $mretorno
            );

        case JSON_ERROR_DEPTH:
            return array(
                "status" => 1,
                "value" => 'Maximum stack depth exceeded'
            );

        case JSON_ERROR_STATE_MISMATCH:
            return array(
                "status" => 1,
                "value" => 'Underflow or the modes mismatch'
            );

        case JSON_ERROR_CTRL_CHAR:
            return array(
                "status" => 1,
                "value" => 'Unexpected control character found'
            );

        case JSON_ERROR_SYNTAX:
            return array(
                "status" => 1,
                "value" => 'Syntax error, malformed JSON'
            );

        case JSON_ERROR_UTF8:
            return array(
                "status" => 1,
                "value" => 'Malformed UTF-8 characters, possibly incorrectly encoded'
            );

        default:
            return array(
                "status" => 1,
                "value" => 'Unknown error'
            );
    } 
}
?>