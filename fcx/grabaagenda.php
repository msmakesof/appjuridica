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
include 'config.php';
$empresa = Company;

date_default_timezone_set("America/Bogota");
// incluimos el archivo de funciones
include 'funciones.php';	

	// Recibimos fecha de inicio y fecha final desde el form
	$fi = $_POST['from'];
	$ff = $_POST['to'];
	
		$from = strtr($fi, '/', '-');
		$to = strtr($ff, '/', '-');		
	
	$Datein = date('d/m/Y H:i:s', strtotime($from));
	$Datefi = date('d/m/Y H:i:s', strtotime($to));	
		
	// y la formateamos con la funcion _formatear	
	$inicio = _formatear($Datein);
	$final  = _formatear($Datefi);
	
	// Recibimos fecha de inicio y fecha final desde el form
	$from = strtotime($from);
	$orderDate = date('Y/m/d H:i:s', $from);	
	$inicio_normal = $orderDate;

	// y la formateamos con la funcion _formatear		
	$to = strtotime($to);
	$orderDate2 = date('Y/m/d H:i:s', $to);
	$final_normal  = $orderDate2;
	
	// Recibimos los demas datos desde el form
	$titulo = evaluar(strtoupper($_POST['title']));

	// y con la funcion evaluar
	$evento   = evaluar($_POST['evento']);

	// reemplazamos los caracteres no permitidos
	////$clase  = evaluar($_POST['class']);
	
	$tipousuario = evaluar($_POST['tipousuario']);
	
	$responsable = evaluar($_POST['responsable']);
	
	$proceso = evaluar($_POST['proceso']);
	
	$tipo = evaluar($_POST['tipo']);
	
	$tipoact = evaluar($_POST['tipoact']);
	
	$respuesta = "";
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;

	// Verificar si existe una agenda creada con las mismas especificaciones	
	$soportecURL = "S";
	
	$url   = urlServicios."consultadetalle/agenda.php?Buscadoble=1&FI=$inicio&FF=$final&TU=$tipousuario&RE=$responsable&PR=$proceso&TI=$tipo&TA=$tipoact";
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
		$cuantos = $m['agenda']['existe'] ;
		
		if($cuantos > 0)
		{
			$respuesta = "E";
		}
		else
		{
			// insertamos el evento
			$query="INSERT INTO agenda  (id, title, body, url, class, start, end, inicio_normal, final_normal,IdTipoUsuario, IdAsignado, IdProceso, IdTipoActividad ) VALUES(null,'$titulo','$evento','','$tipo','$inicio','$final','$inicio_normal','$final_normal',$tipousuario, $responsable, $proceso, '$tipoact' )";
			$conexion->query($query);

			// Obtenemos el ultimo id insetado
			$im=$conexion->query("SELECT MAX(id) AS id FROM agenda");
			$row = $im->fetch_row();  
			$id = trim($row[0]);

			// para generar el link del evento			
			$link = "descripcion_evento.php?id=$id";

			// y actualizamos su link
			$query="UPDATE agenda SET url = '$link' WHERE id = $id";

			// Ejecutamos nuestra sentencia sql
			$conexion->query($query);
			
			$grabado = "S";
			/**/
			// Envio email 
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
			$idTabla = $responsable;
			include('../apis/usuario/infoUsuarioagenda.php');
			
			$NombreRes = strtoupper($muser['usu_usuario']['Nombre']);
			$user_email = trim($muser['usu_usuario']['USU_Email']);	

			$subject = "**  Agenda Proceso Nro. $proceso **" ;
			$mensaje = "<p>Sr(a). $NombreRes, le ha sido asignada una actividad en su Agenda con la siguiente informaci&oacute;n:<br><hr>
						<b>Fecha/Hora Inicio (dd/mm/aa): </b>" . $_POST['from'] . "<br>
						<b>Fecha/Hora Finalizaci&oacute;n (dd/mm/aa): </b>" . $_POST['from'] . "<br>				
						<b>Tema:</b> $titulo<br>
						<b>Observaciones:</b> $evento<hr><br><br>
						</p>Cordialmente,<br><br><br>Sistema de Gesti&oacute;n de Agenda.<br>$empresa";
			
			$enviado = "N";
			//Create a new PHPMailer instance
			include('../PHPMailer/src/Exception.php');
			include('../PHPMailer/src/PHPMailer.php');
			include('../PHPMailer/src/SMTP.php');

			//Especificamos los datos y configuración del servidor
			$mail = new PHPMailer() ;
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
				$mail->AddAddress("msmakesof@gmail.com");

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
					$enviado = "S";			
				}				
			}
			catch (Exception $e) 
			{
				echo "N - Email Error: {$mail->ErrorInfo}";
			}			
			
			//Fin Envio correo 
			if ($grabado == "S" )  // && $enviado == "S"
			{
				$respuesta = "S";
			}	
			
			$respuesta = "S";			
		}		
	}
echo $respuesta ;
?>