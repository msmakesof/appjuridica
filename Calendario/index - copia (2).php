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

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_suctabla = "SELECT IdSucursal, NombreSucursal FROM sucursal WHERE EstadoSucursal = 1 ORDER BY NombreSucursal;";
$rs_tipo_suctabla = mysqli_query($cnn_kn,$query_rs_tipo_suctabla) or die(mysqli_error()."$query_rs_tipo_suctabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_suctabla = mysqli_fetch_assoc($rs_tipo_suctabla);


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_proftabla = "SELECT IdProfesor, concat_WS(' ', Nombres_PRO, Apellido1_PRO) as NombreProfesor FROM profesores WHERE Estado_PRO = 'A' ORDER BY NombreProfesor;";
$rs_tipo_proftabla = mysqli_query($cnn_kn,$query_rs_tipo_proftabla) or die(mysqli_error()."$query_rs_tipo_proftabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_proftabla = mysqli_fetch_assoc($rs_tipo_proftabla);


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_saltabla = "SELECT IdSalon, NombreSalon FROM salon WHERE Estado = 1 ORDER BY NombreSalon;";
$rs_tipo_saltabla = mysqli_query($cnn_kn,$query_rs_tipo_saltabla) or die(mysqli_error()."$query_rs_tipo_saltabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_saltabla = mysqli_fetch_assoc($rs_tipo_saltabla);


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_mattabla = "SELECT IdMateria, NombreMateria FROM materia WHERE Estado = 1 ORDER BY NombreMateria;";
$rs_tipo_mattabla = mysqli_query($cnn_kn,$query_rs_tipo_mattabla) or die(mysqli_error()."$query_rs_tipo_mattabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla);


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_hortabla = "SELECT IdHorario, Inicio, Final FROM horario WHERE Estado = 1 ORDER BY Inicio, Final;";
$rs_tipo_hortabla = mysqli_query($cnn_kn,$query_rs_tipo_hortabla) or die(mysqli_error()."$query_rs_tipo_hortabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_hortabla = mysqli_fetch_assoc($rs_tipo_hortabla);


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_nivtabla = "SELECT IdNivel, NombreNivel FROM nivel WHERE Estado = 1 ORDER BY NombreNivel;";
$rs_tipo_nivtabla = mysqli_query($cnn_kn,$query_rs_tipo_nivtabla) or die(mysqli_error()."$query_rs_tipo_nivtabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla);

/**
**
**  BY iCODEART
**
**********************************************************************
**                      REDES SOCIALES                            ****
**********************************************************************
**                                                                ****
** FACEBOOK: https://www.facebook.com/icodeart                    ****
** TWIITER: https://twitter.com/icodeart                          ****
** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
** GITHUB: https://github.com/icodeart                            ****
** TELEGRAM: https://telegram.me/icodeart                         ****
** EMAIL: info@icodeart.com                                       ****
**                                                                ****
**********************************************************************
**********************************************************************
**/

// Definimos nuestra zona horaria
//date_default_timezone_set("America/Bogota");

// incluimos el archivo de funciones
include 'funciones.php';

// incluimos el archivo de configuracion
include 'config.php';

// Verificamos si se ha enviado el campo con name from
//echo "post from ".$_POST['from'];
if (isset($_POST['from'])) 
{
    $fechaini = "";
    $fechafin = "";
    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from']!="" AND $_POST['to']!="") 
    {
        $sede = evaluar($_POST['sede']);
        $profesor = evaluar($_POST['profesor']);
        $salon = evaluar($_POST['salon']);
        $materia = evaluar($_POST['materia']);
        $horario = evaluar($_POST['horario']);
        $nivel = evaluar($_POST['nivel']);
        $dias = $_POST['dias'];
        $arr_length = count($dias); 

        

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tipo_suctablax = "SELECT NombreSucursal FROM sucursal WHERE EstadoSucursal = 1 AND IdSucursal = $sede;";
        $rs_tipo_suctablax = mysqli_query($cnn_kn,$query_rs_tipo_suctablax) or die(mysqli_error()."$query_rs_tipo_suctablax");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_tipo_suctablax = mysqli_fetch_assoc($rs_tipo_suctablax);
        $nombresede = $row_rs_tipo_suctablax['NombreSucursal'];

        mysqli_select_db($cnn_kn, $database_cnn_kn);
        $query_rs_tablax = "SELECT concat_WS(' ', Nombres_PRO, Apellido1_PRO) as NombreProfesor, Email_PRO FROM profesores WHERE IdProfesor = $profesor ;" ;
        //echo "qry_usu......$query_rs_tabla" ;
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



        // Recibimos el fecha de inicio y la fecha final desde el form
        //$fechaini = date("Y-m-d",strtotime($_POST['from']));

        $inicio = trim($_POST['from']);
        //$fechaini =$inicio;
        // y la formateamos con la funcion _formatear

        $fec1 = explode(" ", $inicio);
         print_r ($fec1);
         $di = $fec1[0];
         $mi = $fec1[1];
         $yi = $fec1[2];
         echo $mi."<br>";
         switch ($mi) 
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

/*
$pizza  = "porción1 porción2 porción3 porción4 porción5 porción6";
$porciones = explode(" ", $pizza);
echo $porciones[0]; // porción1
echo $porciones[1]; // porción2
*/




        //$fechafin = date("Y-m-d",strtotime($_POST['to']));
        //$final  = _formatear($_POST['to']);
$fechafin = $_POST['to'];

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio_normal = $_POST['from'];

        // y la formateamos con la funcion _formatear
        $final_normal  = $_POST['to'];

        // Recibimos los demas datos desde el form
        $titulo = $sede; // evaluar($_POST['title']);

        // y con la funcion evaluar
        $body   = $profesor ; // evaluar($_POST['event']);

        // reemplazamos los caracteres no permitidos
        $clase  =  $materia; //evaluar($_POST['class']);     
        
        

        // if($sede == "" || $profesor == "" || $salon == "" || $materia == "" || $horario == "" || $nivel == "" || $inicio == "" || $final == "")
        // {
        
        // }
        // else
        // {    
            // //// insertamos el evento
            // //$query="INSERT INTO eventos VALUES(null,'$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal')";

            // $insertSQL ="";
            // $insertSQL = "INSERT INTO eventos VALUES(null,'$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal')";
            // mysqli_select_db($cnn_kn, $database_cnn_kn);
            // $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");


            // //// Ejecutamos nuestra sentencia sql
            // //$conexion->query($query); 

            // //// Obtenemos el ultimo id insetado
            // //$im=$conexion->query("SELECT MAX(id) AS id FROM eventos");
            // //$row = $im->fetch_row();  
            // //$id = trim($row[0]);


            // mysqli_select_db($cnn_kn, $database_cnn_kn);
            // $query_rs_tipo_xtablax = "SELECT MAX(id) AS id FROM eventos;";
            // $rs_tipo_xtablax = mysqli_query($cnn_kn,$query_rs_tipo_xtablax) or die(mysqli_error()."$query_rs_tipo_xtablax");
            // mysqli_set_charset($cnn_kn,"utf8");
            // $row_rs_tipo_xtablax = mysqli_fetch_assoc($rs_tipo_xtablax);
            // $id = $row_rs_tipo_xtablax['id'];

            // mysqli_free_result($rs_tipo_xtablax);

            // // para generar el link del evento
            // $link = "$base_url"."descripcion_evento.php?id=$id";

            // //// y actualizamos su link
            // //$query="UPDATE eventos SET url = '$link' WHERE id = $id";
            // $updSQL ="";
            // $updSQL = "UPDATE eventos SET url = '$link' WHERE id = $id";
            // mysqli_select_db($cnn_kn, $database_cnn_kn);
            // $Result1 = mysqli_query($cnn_kn, $updSQL) or die(mysqli_error()."Err....$updSQL<br>");


            //// Ejecutamos nuestra sentencia sql
            //$conexion->query($query); 
            $id=0;

            for($i=0;$i<$arr_length;$i++) 
            { 
                $insertSQL = "";
                $diaAdd = $dias[$i];
                $insertSQL = "INSERT INTO clases (Sede, Salon, Materia, Nivel, Horario, Profesor, Estado, dia, desde, hasta, FechaGraba, IdEvento) VALUES ($sede, $salon, $materia, $nivel, $horario, $profesor, 1, '$diaAdd', '$fechaini', '$fechafin', Now(), $id);";
               echo "insert......$insertSQL<br>";    
                mysqli_select_db($cnn_kn, $database_cnn_kn);
                $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");               
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
            $mail->Subject = "**  Programación de Clases - CONINGLES  **";
            $mail->AltBody = "";
            //if($_POST['tipo_req'] == 1){
            $mail->MsgHTML("Profesor(a): <b>". trim($NombreProfesor) ."</b><br><p>Por medio del presente Email se le informa la programación de Clases de acuerdo a la siguiente información.</p><br>Sede: $nombresede<br>Semana del: ". $_POST['from'] ." al ". $_POST['to'] ."<br>Salón: $nombresalon<br><br>Curso: $nombremateria <br>Horario: $nombrehorario<br>Nivel: $nombrenivel<br><br>Cordialmente,<br><br><br><br>CONINGLES.");
            //}
            $mail->AddAttachment("");
            // destinatario       
            $mail->AddAddress("$Email", "$NombreProfesor");
            $mail->IsHTML(true);
             
            //Enviamos el correo electrónico
            //$mail->Send();

            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Mensaje Enviado!";
            }
            //fin send email

            // redireccionamos a nuestro calendario
            header("Location:$base_url"); 
       ///}    
    }
}

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <title>Calendario Programación de Clases</title>



        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="<?=$base_url?>css/calendar.css"> -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

         <!-- Custom Css -->
        <link href="../css/style.css" rel="stylesheet">
        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="../css/themes/all-themes.css" rel="stylesheet" />

       <!-- --> 
<link href="../cal/sample in bootstrap v3/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link href="../cal/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">


        <script type="text/javascript" src="<?=$base_url?>js/es-ES.js"></script>
        <script src="<?=$base_url?>js/jquery.min.js"></script>
        <script src="<?=$base_url?>js/moment.js"></script>
        <script src="<?=$base_url?>js/bootstrap.min.js"></script>

      <!--   <script src="<?=$base_url?>js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="<?=$base_url?>css/bootstrap-datetimepicker.min.css" />
       <script src="<?=$base_url?>js/bootstrap-datetimepicker.es.js"></script> -->


       <!--  <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="../cal/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="../cal/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
    </head>

</head>
<body style="background: white; padding:20px;">

        <div class="container">
            <div class="row">
                <div class="page-header" style="margin-top: -13px;"><h2> Programación de Clases</h2></div>                        
                <!-- <div class="pull-right form-inline"><br>
                    <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Añadir Clase</button>
                </div> -->
            </div>    
        </div>
       <!--  <hr> -->

<div class="modal-body">
        <form action="" method="post">

                    <label for="tipo">Sede</label>
                    <select class="form-control" name="sede" id="sede">
                    <option value="">Seleccione Sede</option>
                        <?php 
                            do{                                                                
                                $idTabla = $row_rs_tipo_suctabla['IdSucursal'];                                
                                $NombreSucursal = $row_rs_tipo_suctabla['NombreSucursal'];    
                        ?>
                        <option value="<?php echo $idTabla ;?>"><?php echo $NombreSucursal ;?></option>
                        <?php 
                    } while($row_rs_tipo_suctabla = mysqli_fetch_assoc($rs_tipo_suctabla));
                        ?>
                    </select>


                    <label for="tipo">Profesor</label>
                    <select class="form-control" name="profesor" id="profesor">
                    <option value="">Seleccione Profesor</option>
                        <?php 
                            do{                                                                
                                $idTablap = $row_rs_tipo_proftabla['IdProfesor'];                                
                                $NombreProfesor = $row_rs_tipo_proftabla['NombreProfesor'];    
                        ?>
                        <option value="<?php echo $idTablap ;?>"><?php echo $NombreProfesor ;?></option>
                        <?php 
                    } while($row_rs_tipo_proftabla = mysqli_fetch_assoc($rs_tipo_proftabla));
                        ?>
                    </select>

                    <!-- <label for="from">Semana Desde</label>
                    <div class='input-group date' id='from'>
                        <input type='text' id="from" name="from" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>
                    

                    <label for="to">Semana Hasta</label>
                    <div class='input-group date' id='to'>
                        <input type='text' name="to" id="to" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div> -->

                    
                    <label for="from" class="col-md-2 control-label">Semana Desde</label>
                    <div class="form-group">                        
                        <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" size="16" type="text" value="" id="from" name="from" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <!-- <input type="hidden" id="dtp_input2" value="" /> -->
                    </div>    
                    <label for="to" class="col-md-2 control-label">Semana Hasta</label>
                    <div class="form-group">
                        
                        <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" size="16" type="text" value="" id="to" name="to" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <!-- <input type="hidden" id="dtp_input2" value="" /> -->                    
                    </div>

                    <label for="tipo">Salón</label>
                    <select class="form-control" name="salon" id="salon">
                    <option value="">Seleccione Salón</option>
                        <?php 
                            do{                                                                
                                $idTablasal = $row_rs_tipo_saltabla['IdSalon'];                                
                                $NombreSalon = $row_rs_tipo_saltabla['NombreSalon'];    
                        ?>
                        <option value="<?php echo $idTablasal ;?>"><?php echo $NombreSalon ;?></option>
                        <?php 
                    } while($row_rs_tipo_saltabla = mysqli_fetch_assoc($rs_tipo_saltabla));
                        ?>
                    </select>


                    <label for="tipo">Curso</label>
                    <select class="form-control" name="materia" id="materia">
                    <option value="">Seleccione Curso</option>
                        <?php 
                            do{                                                                
                                $idTablamat = $row_rs_tipo_mattabla['IdMateria'];                                
                                $NombreMateria = $row_rs_tipo_mattabla['NombreMateria'];    
                        ?>
                        <option value="<?php echo $idTablamat ;?>"><?php echo $NombreMateria ;?></option>
                        <?php 
                    } while($row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla));
                        ?>
                    </select>


                    <label for="tipo">Horario</label>
                    <select class="form-control" name="horario" id="horario">
                    <option value="">Seleccione Horario</option>
                        <?php 
                            do{                                                                
                                $idTablahor = $row_rs_tipo_hortabla['IdHorario'];                                
                                $Inicio = $row_rs_tipo_hortabla['Inicio'];
                                $Final = $row_rs_tipo_hortabla['Final'];
                        ?>
                        <option value="<?php echo $idTablahor ;?>"><?php echo $Inicio . ' - ' . $Final ;?></option>
                        <?php 
                    } while($row_rs_tipo_hortabla = mysqli_fetch_assoc($rs_tipo_hortabla));
                        ?>
                    </select>

                    <label for="tipo">Nivel</label>
                    <select class="form-control" name="nivel" id="nivel">
                    <option value="">Seleccione Nivel</option>
                        <?php 
                            do{                                                                
                                $idTablaniv = $row_rs_tipo_nivtabla['IdNivel'];                                
                                $NombreNivel = $row_rs_tipo_nivtabla['NombreNivel'];                                
                        ?>
                        <option value="<?php echo $idTablaniv ;?>"><?php echo $NombreNivel ;?></option>
                        <?php 
                    } while($row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla));
                        ?>
                    </select>
                    <br>
                    <div class="demo-checkbox">Día:
                        <input type="checkbox" id="1" name="dias[]" class="filled-in chk-col-red" value=1 />
                        <label for="1">Lunes</label>                                
                        <input type="checkbox" id="2" name="dias[]" class="filled-in chk-col-indigo" value=2 />
                        <label for="2">Martes</label>
                        <input type="checkbox" id="3" name="dias[]" class="filled-in chk-col-blue" value=3 />
                        <label for="3">Miércoles</label>                                
                        <input type="checkbox" id="4" name="dias[]" class="filled-in chk-col-green" value=4 />
                        <label for="4">Jueves</label>                                
                        <input type="checkbox" id="5" name="dias[]" class="filled-in chk-col-yellow" value=5 />
                        <label for="5">Viernes</label>                                
                        <input type="checkbox" id="6" name="dias[]" class="filled-in chk-col-orange" value=6 />
                        <label for="6">Sabado</label>                                
                    </div>                 

                <script type="text/javascript">
                    $(function () {
                        // $('#from').datetimepicker({
                        //     language: 'es',
                        //     minDate: new Date(),
                        //     format: 'MM/DD/YYYY'

                        // });
                        // $('#to').datetimepicker({
                        //     language: 'es',
                        //     minDate: new Date(),
                        //     format: 'MM/DD/YYYY'
                        // });

                         var dateToday = new Date();
                        $('.form_date').datetimepicker({
                            language:  'es',
                            weekStart: 1,
                            todayBtn:  1,
                            autoclose: 1,
                            todayHighlight: 1,
                            startView: 2,
                            minView: 2,
                            forceParse: 0,
                            minDate: dateToday,       
                        });

                        $('.form_date').datetimepicker('setDaysOfWeekDisabled', [0]);
                    });
                </script>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
              <button type="submit" class="btn btn-success">
              <i class="fa fa-check"></i> Grabar</button>
            </div>  
        </form>
    </div>


<div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Agregar nueva Programación</h4>
      </div>

  </div>
</div>
</div>
</body>
</html>
<?php 
mysqli_free_result($rs_tipo_suctabla);
mysqli_free_result($rs_tipo_proftabla);
mysqli_free_result($rs_tipo_saltabla);
mysqli_free_result($rs_tipo_mattabla);
mysqli_free_result($rs_tipo_hortabla);
mysqli_free_result($rs_tipo_nivtabla);
?>