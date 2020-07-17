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


$origen = "";
$accion = "";
if(isset($_POST["origen"]))
{
  $origen = $_POST["origen"];
}

$emailAbogado = "";
$IdenDemandante = "";
$IdenDemandado = "";
$AbreDemandante ="";
$AbreDemandado ="";
$subject = "";
$mensaje = "";
if ($origen == "a")
{
	$from ="";
	if( isset($_POST['from']) )
	{
		$from = trim($_POST['from']);
		//$from = str_replace(' ','%20', $from);
	}

	$to ="";
	if( isset($_POST['to']) )
	{
		$to = trim($_POST['to']);
		//$to = str_replace(' ','%20', $to);
	}

	$proceso ="";
	if( isset($_POST['proceso']) )
	{
		$proceso = trim($_POST['proceso']);	
	
		//Busco el email del abogago q tiene asignado el Proceso
		$pproceso = $proceso;
		require_once('../apis/proceso/procesoemail.php');
		
		//Busco el email del abogago q tiene asignado el Proceso
		$emailAbogado = $mproceso['pro_proceso']['USU_Email'];;
		//
	}

	$responsable ="";
	if( isset($_POST['responsable']) )
	{
		$responsable = trim($_POST['responsable']);
	}

	$tipo ="";
	if( isset($_POST['tipo']) )
	{
		$tipo = trim($_POST['tipo']);
	}

	$title ="";
	if( isset($_POST['title']) )
	{
		$title = trim($_POST['title']);
		//$title = str_replace(' ','%20', $title);    
	}

	$body ="";
	if( isset($_POST['body']) )
	{
		$body = trim($_POST['body']);
		//$body = str_replace(' ','%20', $body);
	}

	$nr ="";
	if( isset($_POST['nr']) )
	{
		$nr = strtoupper(trim($_POST['nr']));
	}
	$np ="";
	if( isset($_POST['np']) )
	{
		$np = trim($_POST['np']);
	}
	
	$subject = "**  Agenda Proceso Nro. $np **" ;
	$mensaje = "<p>Le ha sido asignada una actividad en su Agenda con la siguiente informaci&oacute;n:<br><hr>
				<b>Fecha/Hora Inicio:</b> $to <br>
				<b>Fecha/Hora Finalizaci&oacute;n:</b> $from<br>
				<b>Apoderado(a):</b> $nr<br>
				<b>Tipo de Actividad:</b> $title<br>
				<b>Observaciones:</b> $body<hr><br><br>
				</p>Cordialmente,<br><br><br>Sistema de Gesti&oacute;n de Agenda.<br>AppJur&iacute;dica";
}
else
{
	$pnombre="";
	if( isset($_POST['pnombre']) )
	{
		$pnombre = trim($_POST['pnombre']);
	}
	$pfechainicio = "";
	if( isset($_POST['pfechainicio']) )
	{
		$pfechainicio = trim($_POST['pfechainicio']);
	}
	$pusuario ="";
	if( isset($_POST['pusuario']) )
	{
		$pusuario = trim($_POST['pusuario']);
	}
	$pubicacion = "";
	if( isset($_POST['pubicacion']) )
	{
		$pubicacion = trim($_POST['pubicacion']);
	}
	$pclaseproceso = "";
	if( isset($_POST['pclaseproceso']) )
	{
		$pclaseproceso = trim($_POST['pclaseproceso']);
	}
	$pjuzgado  ="";
	if( isset($_POST['pjuzgado']) )
	{
		$pjuzgado = trim($_POST['pjuzgado']);
	}
	$pestado = "";
	if( isset($_POST['pestado']) )
	{
		$pestado = trim($_POST['pestado']);
	}
	$pproceso = "";
	$maxid = "";
	if( isset($_POST['maxid']) )
	{
		$maxid = $_POST['maxid'];
	}	
	
	if(isset($_POST['accion']))
	{
		$accion = $_POST['accion'];
	}	
	
	$pnproceso = "";
	if( isset($_POST['pnproceso']) )
	{
		$pnproceso = trim($_POST['pnproceso']);
	}
	
	$enviaemailcli = false;
	/* 20200417: Temporalmente en comentario
	if(isset($_POST['enviaemailcli']))
	{
		$enviaemailcli =$_POST['enviaemailcli'];
	}
	*/
	
	if( isset($_POST['pproceso']) )
	{
		//$pproceso = trim($_POST['pproceso']);		
		$pproceso = $maxid;

		require_once('../apis/proceso/procesoemail.php');
		
		//Busco el email del abogado q tiene asignado al Proceso
		$NumeroProceso = $mproceso['pro_proceso']['PRO_NumeroProceso'];
		$emailAbogado = $mproceso['pro_proceso']['USU_Email'];
		$IdenDemandante = $mproceso['pro_proceso']['IdenDemandante'];
		$EmailCliente = trim($mproceso['pro_proceso']['EmailCliente']);
		$IdenDemandado = $mproceso['pro_proceso']['IdenDemandado'];
		$AbreDemandante = trim($mproceso['pro_proceso']['AbreDemandante']);
		$AbreDemandado = trim($mproceso['pro_proceso']['AbreDemandado']);
		//
		if($accion == "u")
		{
			$pproceso = $NumeroProceso;
		}
		if(strlen($pproceso) < 23 )
		{
			$pproceso = $maxid;
		}
	}
	
	$pcliente = "";
	if( isset($_POST['pcliente']) )
	{
		$pcliente = trim($_POST['pcliente']);
	}
	$pdemandado = "";
	if( isset($_POST['pdemandado']) )
	{
		$pdemandado = trim($_POST['pdemandado']);
	}
	$pespecialidad = "";
	if( isset($_POST['pespecialidad']) )
	{
		$pespecialidad = trim($_POST['pespecialidad']);
	}
	$pdespacho = "";
	if( isset($_POST['pdespacho']) )
	{
		$pdespacho = trim($_POST['pdespacho']);
		if( substr($pdespacho, 0, 2) == "--" )
		{
			$pdespacho = " ** sin asignar. ** ";
		}
	}	
	
	$nombreciu = "";
	if( isset($_POST['nombreciu']) )
	{
		$nombreciu = trim($_POST['nombreciu']);
	}
	$corporacion ="";
	if( isset($_POST['corporacion']) )
	{
		$corporacion = trim($_POST['corporacion']);
	}
	$area ="";
	if( isset($_POST['area']) )
	{
		$area = trim($_POST['area']);
	}
	$despacho ="";
	if( isset($_POST['despacho']) )
	{
		$despacho = trim($_POST['despacho']);
		$pdespacho = trim($_POST['pdespacho']);
		if( substr($pdespacho, 0, 2) == "--" )
		{
			$pdespacho = " ** sin asignar. ** ";
		}
	}
	$asignadoa ="";
	if( isset($_POST['asignadoa']) )
	{
		$asignadoa = strtoupper(trim($_POST['asignadoa']));
	}
	$ubicacion ="";
	if( isset($_POST['ubicacion']) )
	{
		$ubicacion = trim($_POST['ubicacion']);
	}
	$claseproceso = "";
	if( isset($_POST['claseproceso']) )
	{
		$claseproceso = trim($_POST['claseproceso']);
	}
	$cliente ="";
	if( isset($_POST['cliente']) )
	{
		$cliente = strtoupper(trim($_POST['cliente']));
	}
	$demandado = "";
	if( isset($_POST['demandado']) )
	{
		$demandado = strtoupper(trim($_POST['demandado']));
	}
	$txtEstado = "";
	
	if(strlen($pproceso) < 23)
	{
		$txtEstado = " en Reparto.";
	}
	
	$subject = "**  Proceso Nro. $pproceso asignado  **" ;
	$mensaje = "<p>Le ha sido asignado el Proceso Judicial con la siguiente informaci&oacute;n:<br><hr>				
				<b>Proceso Nro.:</b> $pproceso<br>
				<b>Ciudad:</b> $nombreciu<br>
				<b>Corporaci&oacute;n / Juzgado:</b> $corporacion<br>
				<b>Especialidad / Area:</b> $area<br>
				<b>Despacho:</b> $despacho<br>
				<b>Fecha/Hora Creaci&oacute;n:</b> $pfechainicio <br>
				<b>Apoderado(a):</b> $asignadoa<br>				
				<b>Ubicaci&oacute;n:</b> $ubicacion<br>
				<b>Clase Proceso:</b> $claseproceso<br>				
				<b>Estado:</b> Activo $txtEstado<br>
				<b>Cliente:</b> $cliente<br>
				$AbreDemandante No. : $IdenDemandante<br>	
				<b>Demandado:</b> $demandado<br>
				$AbreDemandado No. : $IdenDemandado<br><br>					
				</p>Cordialmente,<br><br><br>Sistema de Gesti&oacute;n de Procesos.<br>Litigantes";
}


if( isset($_POST['Asunto']) )
{
	$asunto = trim($_POST['Asunto']);
	$asunto = str_replace(' ','%20', $asunto);
}

if( isset($_POST['Mensaje']) )
{
	$mensaje = trim($_POST['Mensaje']);
	$mensaje = str_replace(' ','%20', $mensaje);
}

if( isset($_POST['EmailAbogado']) )
{
	$emailAbogado = trim($_POST['EmailAbogado']);
	//$emailAbogado = str_replace(' ','%20', $emailAbogado);
}

if( isset($_POST['Emailcliente']) )
{
	$EmailCliente = trim($_POST['Emailcliente']);	
}


require("../mailer_v204/class.phpmailer.php");
require("../mailer_v204/class.smtp.php");

//Especificamos los datos y configuración del servidor
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "mail.litigantes.lawyer"; 
$mail->Port = 465;
 
//Nos autenticamos con nuestras credenciales en el servidor de correo 
$mail->Username = "notificaciones@litigantes.lawyer";
$mail->Password = "Vialibre90$";

//el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
//una cuenta gratuita, por tanto lo pongo a 30  
$mail->Timeout=10;
 
//Agregamos la información que el correo requiere
$mail->From = "notificaciones@litigantes.lawyer";  		//"$mail_usu_por";   
$mail->FromName = "Notificador Litigantes";            //"$usu_por";    
$mail->Subject = $subject;
$mail->AltBody = "";
//if($_POST['tipo_req'] == 1){
$mail->MsgHTML($mensaje);
//}
$mail->AddAttachment("");
// destinatario o el asignadoa con la si
$mail->AddAddress("$emailAbogado", "Abogado asignado");
$mail->AddAddress("msmakesof@gmail.com", "Usuario msmakesof");
if($enviaemailcli)
{
	$mail->AddAddress("$EmailCliente", "$cliente");
}
$mail->IsHTML(true);

//se envia el mensaje, si no ha habido problemas 
//la variable $exito tendra el valor true
$exito = $mail->Send();

$intentos = 1; 
while ((!$exito) && ($intentos < 5)) {
	sleep(5);
	//echo $mail->ErrorInfo;
	$exito = $mail->Send();
	$intentos = $intentos+1;	
}
 
//Enviamos el correo electrónico : $mail->Send();
//if(!$mail->Send()) 
 if(!$exito)	
{
	echo "N - EMail Error: " . $mail->ErrorInfo;
}
else
{
	echo "S";
}
//fin send email
?>
