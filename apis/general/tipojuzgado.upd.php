<?php
include_once("../../pages/tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); //('../../Connections/cnn_kn.php');
require_once('../../Connections/config2.php');
/*
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 
*/
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    if (PHP_VERSION < 6) 
    {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

    switch ($theType) 
    {
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

//require_once('../../Connections/DataConex.php');
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	
	$existeReg = "N";	
	$tabla = 'tipojuzgado';		
	include $_SERVER['DOCUMENT_ROOT']."/$dominio/apis/revisaExiste.php" ;
	if($existeReg == "S")
	{
	
		$parameters = "update=update&nombre=$nombre&codigo=$codigo&estado=$estado&idtabla=$idtabla";
		$soportecURL = "S";
		$url         = urlServicios."consultadetalle/consultadetalle_juz_tipojuzgado.php?".$parameters;
		$existe      = "";
		$usulocal    = "";
		$sigue      = "";
		//echo("<script>console.log('PHP: ".$url."');</script>");
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
			$curl_errno  = curl_errno($ch);
			curl_close($ch);

			$mtipojuzgado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
			$mtipojuzgado = json_decode($mtipojuzgado, true);    
			//echo("<script>console.log('PHP: ".print_r($mtipojuzgado)."');</script>");
			//echo("<script>console.log('PHP resultado: ".$resultado."');</script>");
			//echo("<script>console.log('PHP: ".count($m['juz_tipojuzgado'])."');</script>");
			
			$json_errors = array(
				JSON_ERROR_NONE => 'No se ha producido ningún error',
				JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
				JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
				JSON_ERROR_SYNTAX => 'Error de Sintaxis',
			);

			if($resultado === false || $curl_errno > 0)
			{
				//echo 'Curl error: ' . curl_error($ch);
				$sigue = "N-Registro NO modificado - Curl Error: " . $curl_errno;
			}
			else
			{
			  $sigue = "S-Registro modificado Correctamente.";
			}
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
			$mtipojuzgado = json_decode($resultado, true);	        
		}
	}
}		
echo $sigue;
?>