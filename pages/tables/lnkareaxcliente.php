<?php
if($_POST)
{  
   //recibo los datos y los decodifico con PHP
   $misDatosJSON = json_decode($_POST["datos"]);
   
   //con esto podría mostrar todos los datos del JSON recibido
   //print_r($misDatosJSON);
   echo json_encode($misDatosJSON);
   
   
   
	$soportecURL = "S";
	$url         = urlServicios."consultadetalle/cli_areaxcliente.php?IdMostrar=0";
	$existe      = "";
	$usulocal    = "";
	$siguex      = "";
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

		$mareaxcliente =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
		$mareaxcliente = json_decode($mareaxcliente, true);
		//echo("<script>console.log('PHP: ".print_r($mareaxcliente)."');</script>");
		//echo("<script>console.log('PHP: ".count($m['cli_areaxcliente'])."');</script>");
		
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
		$mareaxcliente = json_decode($resultado, true);	        
	} 
	
	if( $mareaxcliente['estado'] < 2)
	{
		$nombre_Tabla="";
		for($i=0; $i<count($mareaxcliente['cli_areaxcliente']); $i++)
		{
			$NombreTabla = trim($mareaxcliente['cli_areaxcliente'][$i]['NombreEmpresa']);
			$NombreCorporacion = trim($mareaxcliente['cli_areaxcliente'][$i]['NombreCorporacion']);		
			$archivo = $NombreTabla.".php";
			$idTabla = $mareaxcliente['cli_areaxcliente'][$i]['ARC_Id_AreaCliente'];
		 }
	}	
   
   
}   
?>