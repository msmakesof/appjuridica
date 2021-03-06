<?php
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); //('../../Connections/cnn_kn.php');
require_once('../../Connections/config2.php'); 
/*
//require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/DataConex.php');
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
else
{
    header('Location: ../../index.php');
}
*/
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

$IdUsuario ="";
if( isset($_GET['IdUsuario']) )
{
    $IdUsuario = trim($_GET['IdUsuario']);    
}

$ipInterna ="";
if( isset($_GET['ipInterna']) )
{
    $ipInterna = trim($_GET['ipInterna']);    
}

$fechaHoraIngreso ="";
if( isset($_GET['fechaHoraIngreso']) )
{
    $fechaHoraIngreso = trim($_GET['fechaHoraIngreso']);
    $fechaHoraIngreso = str_replace(' ','%20', $fechaHoraIngreso);    
}

$nombreHost ="";
if( isset($_GET['nombreHost']) )
{
    $nombreHost = trim($_GET['nombreHost']);
    //$nombreHost = str_replace(' ','%20', $nombreHost);
}

$puerto ="";
if( isset($_GET['puerto']) )
{
    $puerto = trim($_GET['puerto']);    
}

$servidor ="";
if( isset($_GET['servidor']) )
{
    $servidor = trim($_GET['servidor']);
    $servidor = str_replace(' ','%20', $servidor);
}

$agente ="";
if( isset($_GET['agente']) )
{
    $agente = trim($_GET['agente']);
    $agente = str_replace(' ','%20', $agente);
}

$ipExterna ="";
if( isset($_GET['ipExterna']) )
{
    $ipExterna = trim($_GET['ipExterna']);    
}

$hostname ="";
if( isset($_GET['hostname']) )
{
    $hostname = trim($_GET['hostname']);
    //$hostname = str_replace(' ','%20', $hostname);
}

$region ="";
if( isset($_GET['region']) )
{
    $region = trim($_GET['region']);
    $region = str_replace(' ','%20', $region);
}

$pais ="";
if( isset($_GET['pais']) )
{
    $pais = trim($_GET['pais']);
    //$hostname = str_replace(' ','%20', $hostname);
}

$latitud ="";
if( isset($_GET['latitud']) )
{
    $latitud = trim($_GET['latitud']);    
}

$longitud ="";
if( isset($_GET['longitud']) )
{
    $longitud = trim($_GET['longitud']);    
}

$organizacion ="";
if( isset($_GET['organizacion']) )
{
    $organizacion = trim($_GET['organizacion']);
    $organizacion = str_replace(' ','%20', $organizacion);    
}

$codigopostal="";
if( isset($_GET['codigopostal']) )
{
    $codigopostal = trim($_GET['codigopostal']);    
}
//require_once('../../Connections/DataConex.php');
//Verifico si existe una Tabla con las siguientes caracteristicas
// Nombres iguales 
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
         
    $parameters = "insert=insert&IdUsuario=$IdUsuario&IpInterna=$ipInterna&FechaAcceso=$fechaHoraIngreso&NombreHost=$nombreHost&Puerto=$puerto&Servidor=$servidor&Agente=$agente&IpExterna=$ipExterna&hostname=$hostname&region=$region&pais=$pais&latitud=$latitud&longitud=$longitud&organizacion=$organizacion&codigopostal=$codigopostal";
    $soportecURL = "S";
    $url = urlServicios."consultadetalle/consultadetalle_usu_acceso.php?".$parameters;
    $sigue       = ""; 
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
        //curl_setopt($handle, CURLOPT_STDERR, $verbose);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));    

        $resultado = curl_exec ($ch);         
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_errno = curl_errno($ch);
        $curl_msj = curl_error($ch) ;
        curl_close($ch);
        
        if($resultado === false || $curl_errno > 0)
        {
            //echo 'Curl error: ' . curl_error($ch);
            $sigue = "N-Se presentó problema... ". $curl_errno.' '.$curl_msj;
        }
        else
        {          
            //echo "Curl Err_no returned.... $curl_errno <br/>";
            $m = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
            $m = json_decode($m, true);
            $grabadoOK = $m['usu_acceso'];
            if(!$grabadoOK)
            {
                $sigue = "N";
            }
            else
            {
                $sigue = "S";
            }  
        }

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
echo $sigue;
?>