<?php
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); 
require_once('../../Connections/config2.php');
?>
<?php
  if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    if (PHP_VERSION < 6) {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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

$pdias ="";
if( isset($_POST['pdias']) )
{
    $pdias = trim($_POST['pdias']);    
}

$pnotifica ="";
if( isset($_POST['pnotifica']) )
{
	  $pnotifica = trim($_POST['pnotifica']);
}

$pperiodo ="";
if( isset($_POST['pperiodo']) )
{
	  $pperiodo = trim($_POST['pperiodo']);
}

$prepite ="";
if( isset($_POST['prepite']) )
{
	  $prepite = trim($_POST['prepite']);
}

$pdiasrep ="";
if( isset($_POST['pdiasrep']) )
{
	  $pdiasrep = $_POST['pdiasrep'];
}
$pidtabla ="";
if( isset($_POST['pidtabla']) )
{
	$pidtabla = $_POST['pidtabla'];
}

$pdatos ="";
if( isset($_POST['pdatos']) )
{
	$pdatos = $_POST['pdatos'];
}

//Verifico si existe una registro con las siguientes caracteristicas: Nombres iguales 
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{  
    $parameters = "ExisteTabla=1&Dias=$pdias&Notifica=$pnotifica&Periodo=$pperiodo&Repite=$prepite&DiasRep=$pdiasrep&idtabla=$pidtabla";
    $url = urlServicios."consultadetalle/pro_terminos.php?".$parameters;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 0);

    $resultado = curl_exec ($ch);         
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_errno= curl_errno($ch);
    curl_close($ch);

    if($resultado === false || $curl_errno > 0)
    {      
        $sigue = "N - Curl Error: " . $curl_errno;
    }
    else
    { 
        $m = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
        $m = json_decode($m, true);    
        $existe = $m['pro_terminos']['existe'];
        if($existe > 0)
        {
            $sigue = "E-Existe un Término con la misma información.";
        }
        else
        {     
            $parameters = "insert=insert&IdTAP=$pidtabla&Datos=$pdatos";
            $soportecURL = "S";
            $url         = urlServicios."consultadetalle/pro_terminos.php?".$parameters;
            //echo("<script>console.log('PHP ins: ".$url."');</script>");
            $existe      = "";
            $sigue       = "";      
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
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curl_errno = curl_errno($ch);
                $curl_msj = curl_error($ch) ;
                curl_close($ch);
                
                if($resultado === false || $curl_errno > 0)
                {
                    $sigue = "N-Se presentó problema... ". $curl_errno.' '.$curl_msj;
                }
                else
                {             
                    $m = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
                    $m = json_decode($m, true);
                    $grabadoOK = $m['pro_terminos'];
                    if(!$grabadoOK)
                    {
                        $sigue = "N-Registro NO ha sido grabado.";
                    }
                    else
                    {
                        $sigue = "S-Registro grabado Correctamente.";
                    }  
                }

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
                //echo "No hay soporte para cURL";
                $sigue ="N-No hay soporte para cURL";
            } 

            if($soportecURL == "N")
            {
                require_once('./unirest/vendor/autoload.php');
                $response = Unirest\Request::get($url, array("X-Mashape-Key" => "MY SECRET KEY"));
                $resultado = $response->raw_body;
                $resultado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);
                $m = json_decode($resultado, true);	        
            }      
        }
    }
}
echo $sigue;
?>