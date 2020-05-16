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

$subject = "**  Cambio de Clave.  **" ;
$mensaje = "<p>Favor leer con detenimiento las siguientes instrucciones:<br><hr>".
		"<li>Recuerde que su clave es personal e intransferible.</li>".
		"<li>De click en el siguiente link: <a href='http://localhost/appjuridica/clave.php'>Restaurar Clave</a></li></ol>".
		"<br><br>".
		"Agredecemos su colaboraci&oacute;n.".
		"<br><br>".
		"</p>Cordialmente,<br><br><br>Sistema de Generaci&oacute;n de Claves.<br>Litigantes";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Create a new PHPMailer instance
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'mail.litigantes.lawyer';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = 'notificaciones@litigantes.lawyer';
//Password to use for SMTP authentication
$mail->Password = 'Vialibre90$';
//Set who the message is to be sent from
$mail->setFrom('notificaciones@litigantes.lawyer', 'Magic Mailer');
//Set an alternative reply-to address
$mail->addReplyTo('notificaciones@litigantes.lawyer', 'Magic');
//Set who the message is to be sent to
$mail->addAddress('msmakesof@gmail.com', 'Mauricio Sanchez');
//Set the subject line
$mail->Subject = 'PHPMailer SMTP test';
$mail->Body = "Esta es una prueba de correo"; // Mensaje a enviar
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
echo 'Message sent!';
}
?>