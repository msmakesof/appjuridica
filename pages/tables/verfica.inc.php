<?php
require_once ('../../Connections/DataConex.php');

if (!function_exists("GetSQLValueString")) 
{
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    if (PHP_VERSION < 6) 
    {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysqli_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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
// _POST
$mail ="";
if(isset($_POST['mail']))
{
	$mail = trim($_POST['mail']);
}

$clave1 ="";
if(isset($_POST['clave1']))
{
	$clave1 = trim($_POST['clave1']);
}

$clave2 ="";
if(isset($_POST['clave2']))
{
	$clave2 = trim($_POST['clave2']);
}

$codigo ="";
if(isset($_POST['codigo']))
{
	$codigo = trim($_POST['codigo']);
}

$soportecURL = "S";
/* Verifica que el email el codigo existan y este dentro del tiempo maximo antes que expire el codigo */
$url   = urlServicios."consultadetalle/usu_cambiaclave.php?VerificaData=1&mail=$mail&codigo=$codigo";
//echo "<script>console.log('verifData...$url')</script>";
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
    
    $total = $m['usu_cambiaclave']['Total'] ;

    if( $total == 1)
    {
      $url = "";   // Actualiza el estado en CambiaClave
      $url = urlServicios."consultadetalle/usu_cambiaclave.php?Update=update&mail=$mail&codigo=$codigo";  
      //echo "<script>console.log('Upd...$url')</script>";
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

        $estadoupd = $m['estado'];
        if ( $estadoupd == 1)
        {
          /* Ahora actualiza la nueva clave en la tabla de usuario*/
          require_once('../../Connections/config2.php'); 
          $clave1 = encryptor('encrypt', $clave1);

          $url = "";
          $url = urlServicios."consultadetalle/consultadetalle_Usuario.php?updatepass=updatepass&mail=$mail&clave=$clave1"; 
          //echo "<script>console.log('Updpass...$url')</script>";
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
            $estadoupd = $m['estado'];
            if ( $estadoupd == 1)
            {
              echo "S";

            }
            else
            {
              echo "N";
            }  
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
          
        }
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
      
    }
    else
    {
        echo "N";
    }

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

?>