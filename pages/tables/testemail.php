<?php 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php'); 
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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

$id ="";
$grabado = 'N';
$mailcta = "manager@ok-be.co";
$mailpss = "Vialibre90";
 
  require("../../mailer_v204/class.phpmailer.php");
  require("../../mailer_v204/class.smtp.php");
   
  //Especificamos los datos y configuración del servidor
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPDebug = 1; 
  $mail->SMTPAuth = true; //true;
  $mail->SMTPSecure = "ssl";
  $mail->Host = "a2plcpnl0705.prod.iad2.secureserver.net"; //"correo.interrapidisimo.com";
  $mail->Port = 465;  //465;    //25
   
  //Nos autenticamos con nuestras credenciales en el servidor de correo 
  //$mail->Username = "desarrollador3.sistemas@interrapidisimo.com";
  $mail->Username = $mailcta;
  $mail->Password = $mailpss;
   
  //Agregamos la información que el correo requiere
  $mail->From = $mailcta; //"msmakesof@gmail.com";                 //"desarrollador3.sistemas@interrapidisimo.com";
  $mail->FromName = "Mauricio Sanchez";    //"Mauricio Sanchez";
  $mail->Subject = "**  Inscripcion clase presencial  - CONINGLES  **";
  $mail->AltBody = "";

 $mail->MsgHTML("Hola....Test from sitio web CONINGLES."); 
 /* 
  $mail->MsgHTML("$Nombreestudiante estos son los datos de tu próxima clase presencial: <br>Fecha: <br><Hora: $horario<br>Tema: $nombremateria<br>Lugar: $direccionSede<br><br>Esta es la clase número 1 de 16<br><p>No olvides asistir puntualmente a clase, para poder cumplir con todos los objetivos del nivel y tener tiempo para desarrollar dinámicas y actividades adicionales. Recuerda que llegar 20 minutos tarde todos los días, equivale a perder 6 horas de clase del nivel.</p> <p>Para cancelar la clase reservada lo puedes hacer en nuestra web o telefónicamente bajo los siguientes parámetros: La clase se considera cancelada cuando el estudiante informa:</p><ul><li> Antes de las 5:00 pm  si la clase es en la mañana.</li>
<li>Antes de las 8:00 am si la clase es al medio día</li>
<li>Antes de las 12:00 pm si la clase es en la noche.</li>
<li>El viernes antes de las 5:00 pm si la clase es un lunes o un martes después de un festivo.</li>  
<li>Si el estudiante no informa en estos horarios, la clase se considera DICTADA.</li>
</ul><br>Cordialmente,<br><br><br><br>CONINGLES.");
*/

  $mail->AddAttachment("");
  // destinatario       
  //$mail->AddAddress("$mailestudiante", "$Nombreestudiante");
  $mail->AddAddress("prada.orlando@gmail.com", "Orlando Prada");  
  $mail->AddAddress("msmakesof@gmail.com", "Mauricio Sanchez");        
  $mail->IsHTML(true);
   
  //Enviamos el correo electrónico
  if (!$mail->send()) 
  {
      echo "Mailer Error: " . $mail->ErrorInfo;
  } 
  else 
  {           
      echo "Enviado";
  }        

?>