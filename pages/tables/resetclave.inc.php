<?php
require_once ('../../Connections/DataConex.php');
require_once('../../Connections/config2.php');  

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

$user_email = trim($_POST['mail']);
$codeok = $_POST['codeok'];
//echo "resetclave------> codeok......$codeok<br>";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if($codeok == 0)
{	

	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	 
	function generate_string($input, $strength = 16) {
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
	 
		return $random_string;
	}

	$code = generate_string($permitted_chars, 8);

	$soportecURL = "S";
	$url   = urlServicios."consultadetalle/gen_correo.php?BuscaId=1&Id=1";
	//echo "<script>console.log('mail...'+$url)</script>";
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
		
		$IdCorreo = $m['gen_correo']['COR_IdCorreo'] ;
		$Autenticador = $m['gen_correo']['COR_Autenticador'] ;
		$Seguridad = $m['gen_correo']['COR_Seguridad'] ;
		$Servidor = trim($m['gen_correo']['COR_Servidor']);
		$Puerto= $m['gen_correo']['COR_Puerto'] ;
		$Usuario= trim($m['gen_correo']['COR_Usuario']) ;
		$Clave = trim($m['gen_correo']['COR_Clave']) ;
		$TiempoEspera = $m['gen_correo']['COR_TiempoEspera'] ;
		$TextoCuentaOrigen = trim($m['gen_correo']['COR_TextoCuentaOrigen']) ;
		
		/*Agrego registro a usu_cambiaclave*/
		$url   = urlServicios."consultadetalle/usu_cambiaclave.php?Insert=insert&Email=$user_email&Codigo=$code";
		
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
			
			$Estado = $m['usu_cambiaclave']['estado'] ;
			
			$url   = urlServicios."consultadetalle/usu_cambiaclave.php?Busca=busca&Email=$user_email&Codigo=$code";
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
				
				$FechaExpide = $m['usu_cambiaclave']['CAC_FechaExpide'] ;
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

	$subject = "**  Cambio de Clave.  **" ;
	$mensaje = "<p>Favor leer con detenimiento las siguientes instrucciones:<br><hr>".
			"<li>Recuerde que su clave es personal e intransferible.</li>".
			"<li>Digite el siguiente c&oacute;digo: <b>$code</b> </li>".
			"<li>Este c&oacute;digo expira en la fecha: $FechaExpide</li></ol>".		
			"<br><br>".
			"Agredecemos su colaboraci&oacute;n.".
			"<br><br>".
			"</p>Cordialmente,<br><br><br>Sistema de Generaci&oacute;n de Claves.<br>Litigantes";

	

	//Create a new PHPMailer instance
	require '../../PHPMailer/src/Exception.php';
	require '../../PHPMailer/src/PHPMailer.php';
	require '../../PHPMailer/src/SMTP.php';

	//Especificamos los datos y configuración del servidor
	$mail = new  PHPMailer() ;
	try 
	{
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug outpu
		//$mail->SMTPDebug = 2;
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = "$Servidor";              			 	// Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = "$Usuario";     						// SMTP username
		$mail->Password   = "$Clave";                          		// SMTP password
		//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption; Puerto 587 OK
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; Puerto 465 OK
		$mail->Port       = $Puerto;

		//el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
		//una cuenta gratuita, por tanto lo pongo a 30  
		$mail->Timeout = $TiempoEspera;
		 
		//Agregamos la información que el correo requiere  
		$mail->setFrom($Usuario, $TextoCuentaOrigen);
		
		////$mail->FromName = "$TextoCuentaOrigen";
		// destinatario o el asignadoa con la si
		$mail->AddAddress($user_email);

		$mail->Subject = $subject;
		$mail->AltBody = "";
		$mail->MsgHTML($mensaje);	

		$mail->AddAttachment("");

		$mail->isHTML(true);

		//se envia el mensaje, si no ha habido problemas 
		//la variable $exito tendra el valor true
		
		$exito = $mail->Send();

		$intentos = 1; 
		while ((!$exito) && ($intentos < 5)) {
			sleep(5);	
			$exito = $mail->Send();
			$intentos = $intentos+1;	
		}	
		
		//Enviamos el correo electrónico : $mail->Send();
		if(!$exito)	
		{
			echo "N - EMail Error: {$mail->ErrorInfo}" ;	
		}
		else
		{
			//echo "S - Email Enviado";		
			include '../../login/cambia_pass.php';		
		} 
		/**/		
		//include '../../login/cambia_pass.php';
	}
	catch (Exception $e) 
	{
		echo "N - Email Error: {$mail->ErrorInfo}";
	}
}
else
{
	$code = 0;
	include '../../login/cambia_pass.php';	
}	
?>