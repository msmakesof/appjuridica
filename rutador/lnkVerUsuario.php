<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}	
require_once('./Connections/config2.php');       
require_once('./Connections/DataConex.php');    
$clave = encryptor('encrypt', $clave);
//echo("<script>console.log('PHP usuario: ".$clave."');</script>");
$soportecURL = "S";
$url         = urlServicios."consultadetalle/consultadetalle_Usuario.php?idU=$usuario&idC=$clave";
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
$existe   = trim($m['usu_usuario']['TotalUsuario']);
$IdUsuario = $m['usu_usuario']['USU_IdUsuario'];      

if($existe == 1 && $IdUsuario != "")
{    
	
	$soportecURL = "S";
	$url   = urlServicios."consultadetalle/consultadetalle_Usuario.php?xParIdUsuario=$IdUsuario";
	//echo("<script>console.log('PHP usuario Existe: ".$url."');</script>");
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
		$usulocal = $m['usu_usuario']['USU_Local'] ;
		$nombres =  trim($m['usu_usuario']['USU_Nombre']).' '.trim($m['usu_usuario']['USU_PrimerApellido']).' '.trim($m['usu_usuario']['USU_SegundoApellido']);
		$email = trim($m['usu_usuario']['USU_Email']);
		$tipousuario = $m['usu_usuario']['USU_TipoUsuario'];
		$idempresa = $m['usu_usuario']['USU_IdEmpresa'];
		$esabogado = $m['usu_usuario']['USU_EsAbogado'];
		$nombreempresa = trim($m['usu_usuario']['NombreEmpresa']);
		$desarrollador = $m['usu_usuario']['USU_Desarrollador'];
		
		set_time_limit(120);
		$_SESSION['tiempo'] = 120; 
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

		$_SESSION['Usuario'] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $usulocal);
		$_SESSION['NombreUsuario'] = $nombres ;
		$_SESSION['EmailUsuario'] = $email ;			
		$_SESSION['TipoUsuario'] = $tipousuario;
		$_SESSION['IdEmpresa'] = $idempresa;
		$_SESSION['EsAbogado'] = $esabogado;
		$_SESSION['IdEmpresa'] = $idempresa;
		$_SESSION['NombreEmpresa'] = $nombreempresa ;
		$_SESSION['Desarrollador'] = $desarrollador ;			
		
		$_SESSION['user_id'] = encryptor('encrypt', $usulocal);
		$_SESSION['IdUsuario'] = $IdUsuario ;
		$user_id = $_SESSION['user_id'] ;			
		
		/* 20191019: no se trabaja con cookies porque algunos hosting no lo permiten.
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day			
		$cookiename='_geo';
		$value=$IdUsuario;
		$expiry=time()+(86400 * 30);
		$domain='http://localhost/appjuridica/';  //'appjuridica.ok-be.co';
		$secure=true;
		$httponly=true;
		//setcookie($cookie_name,$value,$expiry,$path,$domain,$secure,$httponly);
		setcookie($cookiename, $value, $expiry);
		*/
		
		/* Esto es para registrar usuario y fecha en que se loguea */			
		$soportecURL = "S";
		$url   = urlServicios."consultadetalle/usu_conectado.php?insert=insert&IdUsuario=$IdUsuario&Ac=$ac";
		//echo("<script>console.log('ins: ".$url."');</script>");
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
		}
		else
		{
			$soportecURL = "N";
			echo "No hay soporte para cURL";
		}
	}
	else
	{
		$soportecURL = "N";
		echo "No hay soporte para cURL";
	}    
}    

echo trim($existe);
?>