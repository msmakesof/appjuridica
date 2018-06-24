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

setlocale(LC_ALL,"es_ES");

$parray= array();
$str = $_POST['pars'];
//print_r(explode('_',$str));
//$array = print_r(explode('_',$str));
$parray = explode('_',$str);
//print_r($array);
$grabado ='';

$horario = "";
$sede = "";
$profesor = "";
$salon = "";
$desde = "";
$hasta = "";
$dia = "";
$fechaEvento =""; 

$materia = "";
$nivel = "";
$dias = array(); 

//echo "k...".count($array)."<br>";
$horario = $parray[0];
$sede = $parray[1];
$profesor = $parray[2];
$salon = $parray[3];
$desde = $parray[4];
$hasta = $parray[5];
$dia = $parray[6]; 
$fechaEvento= $parray[7];
$materia = $parray[8];
$nivel = $parray[9];

$arr_length = 6;
//setlocale(LC_ALL,"es_ES");

if( $horario != '' && $sede != '' && $profesor != '' && $desde != '' && $hasta != '' && $salon != '' && $materia != '' && $nivel != '')
{ 
    $fi = $desde; // $yi.'-'.$mm.'-'.$di;        
    $fechaini = date('Y-m-d', strtotime($fi));
    $mes = substr($fechaini,5,2);
    $nmes = "";
    switch ($mes) 
    {
      case '01':
        $nmes = "Enero";
        break;
      
      case '02':
        $nmes = "Febrero";
        break;

      case '03':
        $nmes = "Marzo";
        break;

      case '04':
        $nmes = "Abril";
        break;

      case '05':
        $nmes = "Mayo";
        break;

      case '06':
        $nmes = "Junio";
        break;

      case '07':
        $nmes = "Julio";
        break;

      case '08':
        $nmes = "Agosto";
        break;        

      case '09':
        $nmes = "Septiembre";
        break;

      case '10':
        $nmes = "Octubre";
        break;

      case '11':
        $nmes = "Noviembre";
        break;

      case '12':
        $nmes = "Diciembre";
        break;
    }
    $fechaDesde = substr($fechaini,8).' de '.$nmes.' de '.substr($fechaini,0,4);
    //echo "fini......$fechaini<br>";


    $fih = $hasta; // $yih.'-'.$mmh.'-'.$dih;        
    $fechafin =  date('Y-m-d', strtotime($fih));
    $mes2 = substr($fechafin,5,2);
    $nmes2 = "";
    switch ($mes2) 
    {
      case '01':
        $nmes2 = "Enero";
        break;
      
      case '02':
        $nmes2 = "Febrero";
        break;

      case '03':
        $nmes2 = "Marzo";
        break;

      case '04':
        $nmes2 = "Abril";
        break;

      case '05':
        $nmes2 = "Mayo";
        break;

      case '06':
        $nmes2 = "Junio";
        break;

      case '07':
        $nmes2 = "Julio";
        break;

      case '08':
        $nmes2 = "Agosto";
        break;        

      case '09':
        $nmes2 = "Septiembre";
        break;

      case '10':
        $nmes2 = "Octubre";
        break;

      case '11':
        $nmes2 = "Noviembre";
        break;

      case '12':
        $nmes2 = "Diciembre";
        break;
    }
    $fechaHasta = substr($fechafin,8).' de '.$nmes2.' de '.substr($fechafin,0,4);
    
    //$nomdia = "";
   // $diasemana ="";
    $diax = "";

/*
    $fechadia = $fechaEvento; // $desde;
    $fdY = substr($fechadia,0,4);
    $fdm = substr($fechadia,5,2);
    $fdd = $dia;
    if($fdd <=9){$fdd = '0'.$dia; } 
    $unefec = $fdY.'-'.$fdm.'-'.$fdd;
    $fecdia = date('Y-m-d', strtotime($unefec));
    echo "$fdm,$fdd,$fdY<br>";
    $numerodia = date("w",mktime(0,0,0,$fdm,$fdd,$fdY));    
    echo "numerodia.....$numerodia<br>";
    if($numerodia == 0)
    {
      $numerodia = 6;
    }
    else
    {  
      $numerodia --;
    }
*/
    $numerodia = $dia;

    //echo "numerodia...$numerodia<br>";
    //echo "diasem....$diasemana<br>";
    //$nomdia = "";
    switch ($numerodia) {
      case 1:
        $diasemana = "Lunes";
        break;
      
      case 2:
        $diasemana = "Martes";
        break;

      case 3:
        $diasemana = "Miercoles";
        break;
      
      case 4:
        $diasemana = "Jueves";
        break;

      case 5:
        $diasemana = "Viernes";
        break;
      
      case 6:
        $diasemana = "Sábado";
        break;        
    }


/* 
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
*/

    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_tipo_x = "SELECT count(clases.IdClase) AS canti FROM clases JOIN clasexdia ON clasexdia.IdClase = clases.IdClase WHERE Sede = $sede AND Salon = $salon AND Materia = $materia AND Nivel = $nivel AND Horario = $horario AND Profesor = $profesor AND Estado = 1 AND desde = '$fechaini' AND hasta = '$fechafin' ;";
    $rs_tipo_x = mysqli_query($cnn_kn,$query_rs_tipo_x) or die(mysqli_error()."err1...$query_rs_tipo_x");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_tipo_x = mysqli_fetch_assoc($rs_tipo_x);
    //echo "sel....$query_rs_tipo_x<br>";
    $reg = 0;
    do
    {
      $reg = $row_rs_tipo_x['canti'];
    } while ( $row_rs_tipo_x = mysqli_fetch_assoc($rs_tipo_x));

    if( $reg == 0)
    {
       mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_suctablax = "SELECT NombreSucursal FROM sucursal WHERE EstadoSucursal = 1 AND IdSucursal = $sede;";
        $rs_tipo_suctablax = mysqli_query($cnn_kn,$query_rs_tipo_suctablax) or die(mysqli_error()."err2...$query_rs_tipo_suctablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_suctablax = mysqli_fetch_assoc($rs_tipo_suctablax);
        $nombresede = $row_rs_tipo_suctablax['NombreSucursal'];

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tablax = "SELECT concat_WS(' ', Nombres_PRO, Apellido1_PRO) as NombreProfesor, Email_PRO FROM profesores WHERE IdProfesor = $profesor ;" ;
        mysqli_set_charset($cnn_kn,"utf8");
        $rs_tablax = mysqli_query($cnn_kn, $query_rs_tablax) or die(mysqli_error()."Err3.....$query_rs_tablax<br>");
        $row_rs_tablax = mysqli_fetch_assoc($rs_tablax);
        $totalRows_rs_tablax = mysqli_num_rows($rs_tablax);

        $NombreProfesor = $row_rs_tablax['NombreProfesor'];
        $Email = $row_rs_tablax['Email_PRO'];
        

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_saltablax = "SELECT NombreSalon FROM salon WHERE Estado = 1 AND IdSalon = $salon;";
        $rs_tipo_saltablax = mysqli_query($cnn_kn,$query_rs_tipo_saltablax) or die(mysqli_error()."err4...$query_rs_tipo_saltablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_saltablax = mysqli_fetch_assoc($rs_tipo_saltablax);
        $nombresalon = $row_rs_tipo_saltablax['NombreSalon'];

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_mattablax = "SELECT NombreMateria FROM materia WHERE Estado = 1 AND IdMateria = $materia;";
        $rs_tipo_mattablax = mysqli_query($cnn_kn,$query_rs_tipo_mattablax) or die(mysqli_error()."err5...$query_rs_tipo_mattablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_mattablax = mysqli_fetch_assoc($rs_tipo_mattablax);
        $nombremateria =$row_rs_tipo_mattablax['NombreMateria'];

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_hortablax = "SELECT Inicio, Final FROM horario WHERE Estado = 1 AND IdHorario = $horario;";
        $rs_tipo_hortablax = mysqli_query($cnn_kn,$query_rs_tipo_hortablax) or die(mysqli_error()."err6...$query_rs_tipo_hortablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_hortablax = mysqli_fetch_assoc($rs_tipo_hortablax);
        $nombrehorario = ' de '.$row_rs_tipo_hortablax['Inicio'] .' a ' . $row_rs_tipo_hortablax['Final'];


        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_nivtablax = "SELECT NombreNivel FROM nivel WHERE Estado = 1 AND IdNivel = $nivel;";
        $rs_tipo_nivtablax = mysqli_query($cnn_kn,$query_rs_tipo_nivtablax) or die(mysqli_error()."err7...$query_rs_tipo_nivtablax");
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
        $insertSQL = "INSERT INTO clases (Sede, Salon, Materia, Nivel, Horario, Profesor, Estado, dia, desde, hasta, FechaGraba, IdEvento) VALUES ($sede, $salon, $materia, $nivel, $horario, $profesor, 1, '$numerodia', '$fechaini', '$fechafin', Now(), '$fechaEvento');";          
        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err8....$insertSQL<br>");        


        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_stablax = "SELECT max(IdClase) xmaximo FROM clases ;";
        $rs_tipo_stablax = mysqli_query($cnn_kn,$query_rs_tipo_stablax) or die(mysqli_error()."err9...$query_rs_tipo_stablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_stablax = mysqli_fetch_assoc($rs_tipo_stablax); 
        $xmaximo = $row_rs_tipo_stablax['xmaximo'];
        mysqli_free_result($rs_tipo_stablax);  

        $id=0;
        
        $insertSQL = "";
        $insertSQL = "INSERT INTO jqcalendar (Id, IdClase, Sede, Salon, Materia, Nivel, Horario, Profesor, Estado, dia, desde, hasta, FechaGraba, IdEvento) VALUES (0, $xmaximo, $sede, $salon, $materia, $nivel, $horario, $profesor, 1, '$numerodia', '$fechaini', '$fechafin', Now(), '$fechaEvento');";          
        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $Result3 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."ErrJQCal....$insertSQL<br>");

        $diaAdd = $numerodia; //$dias[$i];
        $insertSQL = "INSERT INTO clasexdia (IdClasexDia, IdClase, Dia) VALUES (0, $xmaximo, '$diaAdd');";          
        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $Result2 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err10....$insertSQL<br>"); 
        
        if($Result1 && $Result2 && $Result3)
        {
          $grabado = 'S';
        }
        else
        {
           $grabado = 'N';
        }

        /*
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
        $mail->MsgHTML("Profesor(a): <b>". trim($NombreProfesor) ."</b><br><p>Por medio del presente Email se le informa la programación de Clases de acuerdo a la siguiente información.</p><br>Sede: $nombresede<br>Semana del: ". $fechaDesde ." al ". $fechaHasta ."<br>Salón: $nombresalon<br>Tema: $nombremateria<br>Nivel: $nombrenivel<br>Horario: $nombrehorario<br>Dia(s): $diasemana<br><br>Cordialmente,<br><br><br><br>CONINGLES.");
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
        */

    }
    else
    {
      $grabado = 'E';   
    }  
    mysqli_free_result($rs_tipo_x);      
}
else
{
  $grabado = 'N';
} 
echo trim($grabado) ; 
?>