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
if( isset($_POST['id']) && !empty($_POST['id']) )
{    
    $id = trim($_POST['id']);
}
//echo $id;

if( isset($_POST['idclase']) && !empty($_POST['idclase']) )
{    
    $idclase = trim($_POST['idclase']);
}

if( isset($_POST['estud']) && !empty($_POST['estud']) )
{    
    $estud = trim($_POST['estud']);
}

////////echo "nivelasignado =".$_POST['nivelasignado'];
/////if( isset($_POST['nivelasignado']) && !empty($_POST['nivelasignado']) )
/////{    
    //echo "99999<br>";
//$nivelasignado = $_POST['nivelasignado'];
///////}
//echo "nivelasignado =$nivelasignado<br>";

$grabado = 'N';
$mailcta = "manager@ok-be.co";
$mailpss = "Vialibre90";
if($id == "r")
{
    mysqli_select_db($cnn_kn, $database_cnn_kn);    
    $query_rs_tipo_suctablax = "SELECT max(IdClasexEstudiante) as cantidad FROM clasexestudiante WHERE IdEstudiante = $estud AND IdClase = $idclase AND Estado = 'A';" ;  // AND IdAsignado = $nivelasignado
    $rs_tipo_suctablax = mysqli_query($cnn_kn,$query_rs_tipo_suctablax) or die(mysqli_error()."$query_rs_tipo_suctablax");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_tipo_suctablax = mysqli_fetch_assoc($rs_tipo_suctablax);

    if($row_rs_tipo_suctablax['cantidad'] <= 0)
    {
        $insertSQL = "";        
        $insertSQL = "INSERT INTO clasexestudiante (IdClasexEstudiante, IdEstudiante, IdClase, Fechagraba, Estado, IdAsignado) VALUES (0, $estud, $idclase ,Now(), 'A', 0);";          
        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");


        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_tabla = "SELECT clases.IdClase, concat_WS(' ', estudiante.Nombres_EST, estudiante.Apellido1_EST) as NombreEstudiante, estudiante.Email_EST , NombreSucursal, NombreSalon, NombreMateria, NombreNivel, CONCAT_WS(' - ', horario.Inicio,horario.final) as NombreHorario, concat_WS(' ', profesores.Nombres_PRO, profesores.Apellido1_PRO) as NombreProfesor, Email_PRO, dia, sucursal.DireccionSucursal, IdEvento
FROM clasexestudiante 
JOIN estudiante ON estudiante.IdEstudiante = clasexestudiante.IdEstudiante  
JOIN clases ON clases.IdClase = clasexestudiante.IdClase AND clases.Estado = 1 
JOIN sucursal ON sucursal.IdSucursal = clases.Sede 
JOIN salon ON salon.IdSalon = clases.Salon 
JOIN materia ON materia.IdMateria = clases.Materia 
JOIN nivel ON nivel.IdNivel = clases.Nivel 
JOIN horario ON horario.IdHorario = clases.Horario 
JOIN profesores ON profesores.IdProfesor = clases.Profesor 
JOIN nivelasignado ON nivelasignado.IdEstudiante = clasexestudiante.IdEstudiante /*AND nivelasignado.IdNivel = clases.Nivel AND nivelasignado.Estado = 1 AND nivelasignado.EstadoCierre = 1 
*/
WHERE clasexestudiante.IdEstudiante = $estud AND clasexestudiante.IdClase = $idclase AND clasexestudiante.Estado = 'A' ; ";
        $rs_tipo_tabla = mysqli_query($cnn_kn,$query_rs_tipo_tabla) or die(mysqli_error()."$query_rs_tipo_tabla");
        //echo "<br><br><br><br><br><br><br><br><br>.........$query_rs_tipo_tabla";
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla);

        $Nombreestudiante = strtoupper($row_rs_tipo_tabla['NombreEstudiante']);
        $horario = $row_rs_tipo_tabla['NombreHorario'];
        $direccionSede = $row_rs_tipo_tabla['DireccionSucursal'];
        $mailestudiante = $row_rs_tipo_tabla['Email_EST'];
        $nombremateria  = $row_rs_tipo_tabla['NombreMateria'];
        $Nombreprofesor = strtoupper($row_rs_tipo_tabla['NombreProfesor']);
        $mailprofesor = $row_rs_tipo_tabla['Email_PRO'];
        $fechaevento = $row_rs_tipo_tabla['IdEvento'];
        mysqli_free_result($rs_tipo_tabla);

        require("../../mailer_v204/class.phpmailer.php");
        require("../../mailer_v204/class.smtp.php");
         
        //Especificamos los datos y configuración del servidor
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "a2plcpnl0705.prod.iad2.secureserver.net"; 
        $mail->Port = 465;    
         
        //Nos autenticamos con nuestras credenciales en el servidor de correo       
        $mail->Username = $mailcta;
        $mail->Password = $mailpss;
         
        //Agregamos la información que el correo requiere
        $mail->From = $mailcta;         
        $mail->FromName = "ConIngles";  
        $mail->Subject = "**  Inscripcion clase presencial  - CONINGLES  **";
        $mail->AltBody = "";
        //if($_POST['tipo_req'] == 1){
        $mail->MsgHTML("$Nombreestudiante estos son los datos de tu próxima clase presencial: <br>Fecha: $fechaevento<br><Hora: $horario<br>Topic: $nombremateria<br>Lugar: $direccionSede<br><br>Esta es la clase número 1 de 16<br><p>No olvides asistir puntualmente a clase, para poder cumplir con todos los objetivos del nivel y tener tiempo para desarrollar dinámicas y actividades adicionales. Recuerda que llegar 20 minutos tarde todos los días, equivale a perder 6 horas de clase del nivel.</p> <p>Para cancelar la clase reservada lo puedes hacer en nuestra web o telefónicamente bajo los siguientes parámetros: La clase se considera cancelada cuando el estudiante informa:</p><ul><li> Antes de las 5:00 pm  si la clase es en la mañana.</li>
  <li>Antes de las 8:00 am si la clase es al medio día</li>
  <li>Antes de las 12:00 pm si la clase es en la noche.</li>
  <li>El viernes antes de las 5:00 pm si la clase es un lunes o un martes después de un festivo.</li>  
  <li>Si el estudiante no informa en estos horarios, la clase se considera DICTADA.</li>
</ul><br>Cordialmente,<br><br><br><br>CONINGLES. <br>");
        //}
        $mail->AddAttachment("");
        // destinatario               
        //$mail->AddAddress("prada.orlando@gmail.com", "Orlando Prada");  
        $mail->AddAddress("msmakesof@gmail.com", "Mauricio Sanchez");        
        $mail->IsHTML(true);
         
        //Enviamos el correo electrónico
        if (!$mail->send()) 
        {
            //echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else 
        {
            //echo "Mensaje Enviado!";
         // require("../../mailer_v204/class.phpmailer.php");
         // require("../../mailer_v204/class.smtp.php");
           
           //Especificamos los datos y configuración del servidor
           $mail = new PHPMailer();
           $mail->IsSMTP();
           $mail->SMTPAuth = true;
           $mail->SMTPSecure = "ssl";
           $mail->Host = "a2plcpnl0705.prod.iad2.secureserver.net"; //
           $mail->Port = 465;  
           
           //Nos autenticamos con nuestras credenciales en el servidor de correo            
           $mail->Username = $mailcta;
           $mail->Password = $mailpss;
           
          //Agregamos la información que el correo requiere
           $mail->From = $mailcta;        
           $mail->FromName = "ConIngles"; 
           $mail->Subject = "**  Inscripcion $Nombreestudiante  $nombremateria $horario **";
           $mail->AltBody = "";
           //if($_POST['tipo_req'] == 1){
           $mail->MsgHTML("El estudiante $Nombreestudiante se ha inscrito a la siguiente clase: <br>Fecha: <br><Hora: $horario<br>Topic: $nombremateria<br>Lugar: $direccionSede<br><br>Esta es la clase número 1 de 16<br><br>Cordialmente,<br><br><br><br>CONINGLES.");
          // //}
           $mail->AddAttachment("");
          // // destinatario
          //$mail->AddAddress("prada.orlando@gmail.com", "Orlando Prada"); 
          //$mail->AddAddress("liz.rodriguez@coningles.com", "Liz Rodriguez"); 
          $mail->AddAddress("msmakesof@gmail.com", "Mauricio Sanchez"); 
          //$mail->AddAddress("$mailprofesor", "$Nombreprofesor");      
          $mail->IsHTML(true);
           
           //Enviamos el correo electrónico
           if (!$mail->send()) 
           {
               //echo "Mailer Error: " . $mail->ErrorInfo;
           } 
           else 
           {
               //echo "Mensaje Enviado!";
             $grabado = 'S';
           }
            $grabado = 'S';
        }


        if($Result1)
        {
          $grabado = 'S';
        }
        else
        {
           $grabado = 'N';
        }
    }   
  mysqli_free_result($rs_tipo_suctablax);
}
if($id == "c") 
{
  $insertSQL = "";        
  $insertSQL = "UPDATE clasexestudiante SET Estado = 'I', IdAsignado = 0 WHERE IdEstudiante = $estud AND IdClase = $idclase AND Estado = 'A'; ";          
    // AND IdAsignado = $nivelasignado;
  mysqli_select_db($cnn_kn, $database_cnn_kn);
  $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");

  if($Result1)
  {
    $grabado = 'S';
    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_tipo_tabla = "SELECT clases.IdClase, concat_WS(' ', estudiante.Nombres_EST, estudiante.Apellido1_EST) as NombreEstudiante, estudiante.Email_EST , NombreSucursal, NombreSalon, NombreMateria, NombreNivel, CONCAT_WS(' - ', horario.Inicio,horario.final) as NombreHorario, concat_WS(' ', profesores.Nombres_PRO, profesores.Apellido1_PRO) as NombreProfesor, Email_PRO, dia, sucursal.DireccionSucursal, IdEvento
FROM clasexestudiante 
JOIN estudiante ON estudiante.IdEstudiante = clasexestudiante.IdEstudiante  
JOIN clases ON clases.IdClase = clasexestudiante.IdClase AND clases.Estado = 1 
JOIN sucursal ON sucursal.IdSucursal = clases.Sede 
JOIN salon ON salon.IdSalon = clases.Salon 
JOIN materia ON materia.IdMateria = clases.Materia 
JOIN nivel ON nivel.IdNivel = clases.Nivel 
JOIN horario ON horario.IdHorario = clases.Horario 
JOIN profesores ON profesores.IdProfesor = clases.Profesor 
JOIN nivelasignado ON nivelasignado.IdEstudiante = clasexestudiante.IdEstudiante /*AND nivelasignado.IdNivel = clases.Nivel AND nivelasignado.Estado = 1 AND nivelasignado.EstadoCierre = 1 
*/
WHERE clasexestudiante.IdEstudiante = $estud AND clasexestudiante.IdClase = $idclase AND clasexestudiante.Estado = 'A' ;";

    //"SELECT IdClase, NombreSucursal, NombreSalon, NombreMateria, NombreNivel, CONCAT_WS(' - ', horario.Inicio,horario.final) as NombreHorario, concat_WS(' ', profesores.Nombres_PRO, profesores.Apellido1_PRO) as NombreProfesor, Email_PRO, dia, sucursal.DireccionSucursal, concat_WS(' ', estudiante.Nombres_EST, estudiante.Apellido1_EST) as NombreEstudiante, estudiante.Email_EST FROM clases JOIN estudiante ON estudiante.IdEstudiante = $estud JOIN sucursal ON sucursal.IdSucursal = clases.Sede JOIN salon ON salon.IdSalon = clases.Salon JOIN materia ON materia.IdMateria = clases.Materia JOIN nivel ON nivel.IdNivel = clases.Nivel JOIN horario ON horario.IdHorario = clases.Horario JOIN profesores ON profesores.IdProfesor = clases.Profesor JOIN nivelasignado ON nivelasignado.IdEstudiante = estudiante.IdEstudiante AND nivelasignado.IdNivel = clases.Nivel AND nivelasignado.IdAsignado = $nivelasignado  ORDER BY IdClase, desde, hasta ;";
      // WHERE clases.Nivel = $nivel
    $rs_tipo_tabla = mysqli_query($cnn_kn,$query_rs_tipo_tabla) or die(mysqli_error()."$query_rs_tipo_tabla");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla);

    $Nombreestudiante = strtoupper($row_rs_tipo_tabla['NombreEstudiante']);
    $horario = $row_rs_tipo_tabla['NombreHorario'];
    $direccionSede = $row_rs_tipo_tabla['DireccionSucursal'];
    $mailestudiante = $row_rs_tipo_tabla['Email_EST'];
    $nombremateria  = $row_rs_tipo_tabla['NombreMateria'];
    $Nombreprofesor = strtoupper($row_rs_tipo_tabla['NombreProfesor']);
    $mailprofesor = $row_rs_tipo_tabla['Email_PRO'];
    $fechaevento = $row_rs_tipo_tabla['IdEvento'];
    mysqli_free_result($rs_tipo_tabla);
    $grabado = 'S';


    // cancelacion clase
       require("../../mailer_v204/class.phpmailer.php");
        require("../../mailer_v204/class.smtp.php");
         
        //Especificamos los datos y configuración del servidor
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "a2plcpnl0705.prod.iad2.secureserver.net"; 
        $mail->Port = 465;    
         
        //Nos autenticamos con nuestras credenciales en el servidor de correo         
        $mail->Username = $mailcta;
        $mail->Password = $mailpss;
         
        //Agregamos la información que el correo requiere
        $mail->From = $mailcta;     
        $mail->FromName = "ConIngles"; 
        $mail->Subject = "**  Cancelacion clase presencial   - Tema: $nombremateria  **";
        $mail->AltBody = "";
        //if($_POST['tipo_req'] == 1){
        $mail->MsgHTML("$Nombreestudiante ha cancelado la inscripción a la siguiente clase: <br>Fecha: $fechaevento<br><Hora: $horario<br>Topic: $nombremateria<br>Lugar: $direccionSede.<br><br>");
        //}
        $mail->AddAttachment("");
        // destinatario       
        //$mail->AddAddress("$mailestudiante", "$Nombreestudiante");
        //$mail->AddAddress("prada.orlando@gmail.com", "Orlando Prada");  
        $mail->AddAddress("msmakesof@gmail.com", "Mauricio Sanchez"); 
        //$mail->AddAddress("$mailprofesor", "$Nombreprofesor");       
        $mail->IsHTML(true);
         
        //Enviamos el correo electrónico
        if (!$mail->send()) 
        {
            //echo "Mailer Error: " . $mail->ErrorInfo;
           //$grabado = 'S';
        } 
        else 
        {
            //echo "Mensaje Enviado!";      
        }  
    //
  }
  else
  {
     $grabado = 'N';
  } 

}  
$grabado = $id ;
echo trim($grabado) ; 
?>