<?php
include_once("./header.inc.php");
require_once ('../../Connections/DataConex.php'); 

$IdUsuario = $_SESSION['IdUsuario'];
$soportecURL = "S";
$url   = urlServicios."consultadetalle/usu_conectado.php?update=update&Nuevoestado=0&IdUsuario=$IdUsuario&Estado=1";
//echo("<script>console.log('PHP usuario CIERRA: ".$url."');</script>");
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
	
	//print_r ($m);

	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	
	$existe = $m['estado']; //$m['usu_conectado']['estado']; //  
	//echo $existe;
	if ($existe == 1)
	{
		$_SESSION['Usuario'] = "";
		$_SESSION['NombreUsuario'] = "" ;
		$_SESSION['EmailUsuario'] = "" ;
		$_SESSION['user_id'] = "";
		$_SESSION['opcMenu'] = "";	
		$_SESSION['TipoUsuario'] = "";	
		$_SESSION['IdUsuario'] = "" ;
		$_SESSION['IdEmpresa'] = "";
		$_SESSION['EsAbogado'] = "";
		$_SESSION['Desarrollador'] = "";
		header("Location: ../../");
		exit;		
	}
	//	
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