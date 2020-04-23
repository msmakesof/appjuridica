<?php


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
 
//Enviamos el correo electrónico
$mail->Send();
if(!$mail->send()) 
{
	echo "N - EMail Error: " . $mail->ErrorInfo;
}
else
{
	echo "S";
}
	//fin send email
?>