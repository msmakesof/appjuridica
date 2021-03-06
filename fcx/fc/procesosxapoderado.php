<?php
ob_start();
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include('../../Connections/cnn_kn.php'); 
include('../../Connections/config2.php');
?>
<?php
if (!function_exists("GetSQLValueString")) {
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

require_once('../../Connections/DataConex.php');
$idresponsable = "";
$tipousuario = "";
if (isset($_GET['id']))
{
	$idresponsable = trim($_GET['id']);
}
if (isset($_GET['tu']))
{
	$tipousuario = trim($_GET['tu']);
}

$params = "IdProcesoResponsable=$idresponsable";
$soportecURL = "S";
$url         = urlServicios."consultadetalle/consultadetalle_pro_proceso.php?".$params;
$existe      = "";
$usulocal    = "";
$siguex      = "";

if($tipousuario == 3) // 2 = Abogado , 3 = Dependiente Judicial
{
	$url = urlServicios."consultadetalle/consultadetalle_pro_proceso.php?IdMostrar=0&e=1";
}
//echo("<script>console.log('PHP Apoderado: ".$url."');</script>");
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
	
    $mproceso = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado).PHP_EOL;	
	$mproceso = preg_replace('/\x{feff}$/u', '', $mproceso).PHP_EOL;	
	$mproceso = trim(preg_replace('/\s+/', ' ', $mproceso));
	$mproceso = json_decode($mproceso, true);	
	
    //echo("<script>console.log('PHP: ".print_r($mproceso)."');</script>");
    //echo("<script>console.log('PHP: ".count($m['pro_proceso'])."');</script>");
    
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
    $mproceso = json_decode($resultado, true);	        
}
if( $mproceso['estado'] == 1)
{
	ob_end_clean();
	$filas = json_encode($mproceso['pro_proceso']);	
	header('Content-Type: application/json; charset=utf-8');	
	echo trim($filas);		
}
else
{
	echo '{"mensaje":"No tiene Procesos Asignados"}';
}
?>