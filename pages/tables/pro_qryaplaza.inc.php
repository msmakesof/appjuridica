<?php 
include_once("header.inc.php");
require_once ('../../Connections/DataConex.php');
$LogoInterno = LogoInterno;
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
    if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

    switch ($theType) {
        case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;    
        case "long":
        case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
        break;
        case "double":
        $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
        break;
        case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
        case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
        break;
    }
    return $theValue;
    }
}
$ptap = "";
if ( isset( $_POST["ptap"]))
{ 
    $ptap = $_POST["ptap"];
}

$pnp = "";
if ( isset( $_POST["pnp"]))
{ 
    $pnp = $_POST["pnp"];
}

$soportecURL = "S";
$url         = urlServicios."consultadetalle/pro_aplazamientoxproceso.php?IdMostrar=0&TAP=$ptap&NP=$pnp";
$existe      = "";
$usulocal    = "";
//echo "<script>console.log($url)</script>" ;
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

    $mproceso =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $mproceso = json_decode($mproceso, true);
    $json_errors = array(
        JSON_ERROR_NONE => 'No se ha producido ningún error',
        JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
        JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
        JSON_ERROR_SYNTAX => 'Error de Sintaxis',
    );    
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
    $mproceso = json_decode($resultado, true);	        
} 

if( $mproceso['estado'] < 2)
{
    $nombre_Tabla="";
    for($i=0; $i<count($mproceso['pro_proceso']); $i++)
    {
        $NumeroProceso = trim($mproceso['pro_proceso'][$i]['PRO_NumeroProceso']);
        $Nombre = trim($mproceso['pro_proceso'][$i]['EVI_Nombre']);                                                                                        
        $idTabla = $mproceso['pro_proceso'][$i]['PRO_IdProceso'];
        $FechaInicio = $mproceso['pro_proceso'][$i]['EVI_FechaInicio'];
        $FechaFinal = $mproceso['pro_proceso'][$i]['EVI_FechaFinal'];
        //$estadoTabla = trim($mproceso['pro_proceso'][$i]['EstadoTabla']);
    }
}
echo json_encode($mproceso['pro_proceso']);
?>