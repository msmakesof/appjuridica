<?php 
require_once('../Connections/cnn_kn.php'); 
require_once('../Connections/config2.php'); 
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

$idclase = trim($_POST['idclase']); 
$sede = trim($_POST['sede']);
$profesor = trim($_POST['profesor']);
$desde = $_POST['from'];
$hasta = $_POST['to'];
$salon = trim($_POST['salon']);
$materia = trim($_POST['materia']);
$horario = trim($_POST['horario']);
$nivel = trim($_POST['nivel']);
$estado = $_POST['estado'];
$dias = $_POST['dias'];
$ddias = $_POST['dias'];
$arr_length = count($dias);
$grabado ='';


if( $sede != '' && $profesor != '' && $desde != '' && $hasta != '' && $salon != '' && $materia != '' && $horario != '' && $nivel != '' && $arr_length > 0)
{  
    
    $fec1 = explode(" ", $desde);
    $di = $fec1[0];
    $mi = $fec1[1];
    $yi = $fec1[2];
    $mm = "";
    switch (strtolower($mi)) 
    {
        case 'enero':
            $mm = "01";
            break;
        
        case 'febrero':
            $mm = "02";
            break;

        case 'marzo':
            $mm = "03";
            break;

        case 'abril':
            $mm = "04";
            break;

        case 'mayo':
            $mm = "05";                 
            break;

        case 'junio':
            $mm = "06";
            break;

        case 'julio':
            $mm = "07";
            break;

        case 'agosto':
            $mm = "08";                 
            break;

        case 'septiembre':
            $mm = "09";
            break;

        case 'octubre':
            $mm = "10";
            break;

        case 'noviembre':
            $mm = "11";
            break;

        case 'diciembre':
            $mm = "12";
            break;
    }

    $fi = $yi.'-'.$mm.'-'.$di;        
    $fechaini =  date('Y-m-d', strtotime($fi));
    

    $fec2 = explode(" ", $hasta);
    $dih = $fec2[0];
    $mih = $fec2[1];
    $yih = $fec2[2];
    $mmh = "";
    switch (strtolower($mih)) 
    {
        case 'enero':
            $mmh = "01";
            break;
        
        case 'febrero':
            $mmh = "02";
            break;

        case 'marzo':
            $mmh = "03";
            break;

        case 'abril':
            $mmh = "04";
            break;

        case 'mayo':
            $mmh = "05";                 
            break;

        case 'junio':
            $mmh = "06";
            break;

        case 'julio':
            $mmh= "07";
            break;

        case 'agosto':
            $mmh = "08";                 
            break;

        case 'septiembre':
            $mmh = "09";
            break;

        case 'octubre':
            $mmh = "10";
            break;

        case 'noviembre':
            $mmh = "11";
            break;

        case 'diciembre':
            $mmh = "12";
            break;
    }

    $fih = $yih.'-'.$mmh.'-'.$dih;        
    $fechafin =  date('Y-m-d', strtotime($fih));
    $nomdia = "";
    $diasemana ="";
    $diax = "";
    for($i=0;$i<$arr_length;$i++) 
    { 
      if($diax == "")
      {  
        $diax = $dias[$i];
      }
      else
      {
       $diax .= ', '.$dias[$i] ; 
      }

      if($dias[$i] == 1)
      {
          $nomdia = "Lunes";
      }
      if($dias[$i] == 2)  
      {
        $nomdia = $nomdia .' Martes';        
      } 
      if($dias[$i] == 3)  
      {
        $nomdia = $nomdia .' Miercoles'; 
      }
      if($dias[$i] == 4)  
      {
        $nomdia = $nomdia .' Jueves';        
      }
      if($dias[$i] == 5)  
      {
        $nomdia = $nomdia .' Viernes';        
      }
      if($dias[$i] == 6)  
      {
        $nomdia = $nomdia .' Sabado';
      }
    }  
    if($arr_length > 1)    
    {
      $diasemana = str_replace(" ", ", ", $nomdia);
      $txt = substr($diasemana, 0,1);
      if($txt == ",")
      {
        $diasemana = substr($diasemana, 1);
      }
    }  
    //echo "diax.......$diax<br>";

    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_tipo_x = "SELECT count(IdClase) AS canti FROM clases WHERE IdClase = $idclase;";
    $rs_tipo_x = mysqli_query($cnn_kn,$query_rs_tipo_x) or die(mysqli_error()."$query_rs_tipo_x");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_tipo_x = mysqli_fetch_assoc($rs_tipo_x);
    //echo "sel....$query_rs_tipo_x<br>";
    $reg = 0;
    do
    {
      $reg = $row_rs_tipo_x['canti'];
    } while ( $row_rs_tipo_x = mysqli_fetch_assoc($rs_tipo_x));

    if( $reg == 1)
    {
       mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_suctablax = "SELECT NombreSucursal FROM sucursal WHERE EstadoSucursal = 1 AND IdSucursal = $sede;";
        $rs_tipo_suctablax = mysqli_query($cnn_kn,$query_rs_tipo_suctablax) or die(mysqli_error()."$query_rs_tipo_suctablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_suctablax = mysqli_fetch_assoc($rs_tipo_suctablax);
        $nombresede = $row_rs_tipo_suctablax['NombreSucursal'];

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tablax = "SELECT concat_WS(' ', Nombres_PRO, Apellido1_PRO) as NombreProfesor, Email_PRO FROM profesores WHERE IdProfesor = $profesor ;" ;
        mysqli_set_charset($cnn_kn,"utf8");
        $rs_tablax = mysqli_query($cnn_kn, $query_rs_tablax) or die(mysqli_error()."Err.....$query_rs_tablax<br>");
        $row_rs_tablax = mysqli_fetch_assoc($rs_tablax);
        $totalRows_rs_tablax = mysqli_num_rows($rs_tablax);

        $NombreProfesor = $row_rs_tablax['NombreProfesor'];
        $Email = $row_rs_tablax['Email_PRO'];
        

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_saltablax = "SELECT NombreSalon FROM salon WHERE Estado = 1 AND IdSalon = $salon;";
        $rs_tipo_saltablax = mysqli_query($cnn_kn,$query_rs_tipo_saltablax) or die(mysqli_error()."$query_rs_tipo_saltablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_saltablax = mysqli_fetch_assoc($rs_tipo_saltablax);
        $nombresalon = $row_rs_tipo_saltablax['NombreSalon'];

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_mattablax = "SELECT NombreMateria FROM materia WHERE Estado = 1 AND IdMateria = $materia;";
        $rs_tipo_mattablax = mysqli_query($cnn_kn,$query_rs_tipo_mattablax) or die(mysqli_error()."$query_rs_tipo_mattablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_mattablax = mysqli_fetch_assoc($rs_tipo_mattablax);
        $nombremateria =$row_rs_tipo_mattablax['NombreMateria'];

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_hortablax = "SELECT Inicio, Final FROM horario WHERE Estado = 1 AND IdHorario = $horario;";
        $rs_tipo_hortablax = mysqli_query($cnn_kn,$query_rs_tipo_hortablax) or die(mysqli_error()."$query_rs_tipo_hortablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_hortablax = mysqli_fetch_assoc($rs_tipo_hortablax);
        $nombrehorario = ' de '.$row_rs_tipo_hortablax['Inicio'] .' a ' . $row_rs_tipo_hortablax['Final'];


        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_nivtablax = "SELECT NombreNivel FROM nivel WHERE Estado = 1 AND IdNivel = $nivel;";
        $rs_tipo_nivtablax = mysqli_query($cnn_kn,$query_rs_tipo_nivtablax) or die(mysqli_error()."$query_rs_tipo_nivtablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_nivtablax = mysqli_fetch_assoc($rs_tipo_nivtablax);
        $nombrenivel = $row_rs_tipo_nivtablax['NombreNivel'];

        mysqli_free_result($rs_tablax);
        mysqli_free_result($rs_tipo_suctablax);
        mysqli_free_result($rs_tipo_saltablax);
        mysqli_free_result($rs_tipo_mattablax);
        mysqli_free_result($rs_tipo_hortablax);
        mysqli_free_result($rs_tipo_nivtablax);

        $insertSQL = "";        
        $insertSQL = "UPDATE clases SET Sede = $sede, Salon = $salon, Materia =$materia, Nivel = $nivel, Horario = $horario, Profesor = $profesor, Estado = 1, desde = '$fechaini', hasta = '$fechafin', Estado = $estado WHERE IdClase = $idclase;";          
        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");

        
        $deleteSQL = "";
        $ResultD = "";
        $deleteSQL = "DELETE FROM clasexdia WHERE IdClase = $idclase;";
        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $ResultD = mysqli_query($cnn_kn, $deleteSQL) or die(mysqli_error()."Err....$deleteSQL<br>");
        

        $id=0;
        for($i=0;$i<$arr_length;$i++) 
        { 
          $insertSQL2 = "";
          $diaAdd = $ddias[$i];
          $insertSQL2 = "INSERT INTO clasexdia (IdClasexDia, IdClase, Dia) VALUES (0, $idclase, '$diaAdd') ;";          
          mysqli_select_db($cnn_kn, $database_cnn_kn);
          $Result1 = mysqli_query($cnn_kn, $insertSQL2) or die(mysqli_error()."Err....$insertSQL2<br>"); 
        }  

        require("../mailer_v204/class.phpmailer.php");
        require("../mailer_v204/class.smtp.php");
         
        //Especificamos los datos y configuración del servidor
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com"; //"correo.interrapidisimo.com";
        $mail->Port = 465;    //25
         
        //Nos autenticamos con nuestras credenciales en el servidor de correo 
        //$mail->Username = "desarrollador3.sistemas@interrapidisimo.com";
        $mail->Username = "msmakesof@gmail.com";
        $mail->Password = "KevinLau77";
         
        //Agregamos la información que el correo requiere
        $mail->From = "msmakesof@gmail.com";                 //"desarrollador3.sistemas@interrapidisimo.com";
        $mail->FromName = "Mauricio Sanchez";    //"Mauricio Sanchez";
        $mail->Subject = "**  Programacion de Clases - CONINGLES  **";
        $mail->AltBody = "";
        //if($_POST['tipo_req'] == 1){
        $mail->MsgHTML("Profesor(a): <b>". trim($NombreProfesor) ."</b><br><p>Por medio del presente Email se le informa la programación de Clases de acuerdo a la siguiente información.</p><br>Sede: $nombresede<br>Semana del: ". $_POST['from'] ." al ". $_POST['to'] ."<br>Salón: $nombresalon<br>Curso: $nombremateria<br>Nivel: $nombrenivel<br>Horario: $nombrehorario<br>Dia(s): $diasemana<br><br>Cordialmente,<br><br><br><br>CONINGLES.");
        //}
        $mail->AddAttachment("");
        // destinatario       
        $mail->AddAddress("$Email", "$NombreProfesor");
        $mail->AddAddress("prada.orlando@gmail.com", "Orlando Prada");
        $mail->AddAddress("liz.rodriguez@coningles.com", "Liz Rodriguez");
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
        
        if($Result1)
        {
          $grabado = 'S';
        }
        else
        {
           $grabado = 'N';
        }  
    }
    else
    {
      //$grabado = 'E';   
    }  
    mysqli_free_result($rs_tipo_x);      
}
else
{
  $grabado = 'N';
} 
echo trim($grabado) ; 
?>