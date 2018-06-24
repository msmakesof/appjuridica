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
include 'config.php';

$id ="";
$coo_User = trim($_COOKIE['okuser_xc']);
if ($coo_User == "")
{
  header("Location: ../../"); /* Redirect browser */
  exit();  
}
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_usuario = "SELECT IdEstudiante FROM estudiante WHERE Estado_EST = 1 AND Email_EST = '$coo_User' ;" ;
$rs_usuario = mysqli_query($cnn_kn, $query_rs_usuario) or die(mysqli_error()."Err.....$query_rs_usuario");
$row_rs_usuario = mysqli_fetch_assoc($rs_usuario);
$totalRows_rs_usuario = mysqli_num_rows($rs_usuario);
//echo "<br><br><br><br><br><br><br>$query_rs_usuario";
$id = $row_rs_usuario['IdEstudiante'];
//echo "............................................................id............$id";

$nivel = "";
if( isset($_POST['nivel']) && !empty($_POST['nivel']) )
{    
    $nivel = trim($_POST['nivel']);
}

$cantidad = 0;
$idclase = 0;
$idnivelasignado = 0;
$txt ="No hay Programación.";
$cuposReservados = 0;
$cuposDisponibles = 0;
$cupos = 0;
$continua ="";

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_cupos = "SELECT Cantidad FROM cupos WHERE Estado = 1 ;";
$rs_cupos = mysqli_query($cnn_kn,$query_rs_cupos) or die(mysqli_error()."$query_rs_cupos");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_cupos = mysqli_fetch_assoc($rs_cupos);
$cupos = $row_rs_cupos['Cantidad'];
mysqli_free_result($rs_cupos);
 
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_tabla = "SELECT clases.*, sucursal.NombreSucursal, salon.NombreSalon, materia.NombreMateria, nivel.NombreNivel
, CONCAT_WS(' - ', horario.Inicio,horario.final) as NombreHorario 
, concat_WS(' ', profesores.Nombres_PRO, profesores.Apellido1_PRO) as NombreProfesor
FROM clases
JOIN sucursal ON sucursal.IdSucursal = clases.Sede AND sucursal.EstadoSucursal = 1
JOIN salon ON salon.IdSalon = clases.Salon AND salon.Estado = 1
JOIN materia ON materia.IdMateria = clases.Materia AND materia.Estado = 1
JOIN nivel ON nivel.IdNivel = clases.Nivel AND nivel.Estado = 1
JOIN horario ON horario.IdHorario = clases.Horario AND horario.Estado = 1 
JOIN profesores ON profesores.IdProfesor = clases.Profesor AND profesores.Estado_PRO = 1
WHERE clases.Estado = 1;";

/*
"SELECT estudiante.IdEstudiante, nivelasignado.* , sucursal.NombreSucursal, nivel.NombreNivel, materia.NombreMateria, salon.NombreSalon, CONCAT_WS(' - ', horario.Inicio,horario.final) as NombreHorario, concat_WS(' ', profesores.Nombres_PRO, profesores.Apellido1_PRO) as NombreProfesor, clases.IdClase, clases.IdClase, clases.desde, clases.hasta, horario.Inicio
FROM estudiante 
JOIN nivelasignado ON nivelasignado.IdEstudiante = estudiante.IdEstudiante AND nivelasignado.Estado = 1
JOIN clases ON clases.Nivel = nivelasignado.IdNivel  AND clases.hasta > curdate() 
JOIN sucursal ON sucursal.IdSucursal = clases.Sede AND sucursal.IdSucursal = estudiante.Sucursal_EST
JOIN nivel ON nivel.IdNivel = clases.Nivel
JOIN materia ON materia.IdMateria = clases.Materia
JOIN salon ON salon.IdSalon = clases.Salon
JOIN horario ON horario.IdHorario = clases.Horario
JOIN profesores ON profesores.IdProfesor = clases.Profesor
WHERE estudiante.IdEstudiante = $id AND estudiante.Estado_EST = 1;";
*/
$rs_tipo_tabla = mysqli_query($cnn_kn,$query_rs_tipo_tabla) or die(mysqli_error()."$query_rs_tipo_tabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla);
//echo "valor tabla........................................................$query_rs_tipo_tabla <br> idEstud....$id<br>";
$idclase = $row_rs_tipo_tabla['IdClase'];
$idnivelasignado = 0; //$row_rs_tipo_tabla['IdAsignado'];   // 0;
$clasedesde = $row_rs_tipo_tabla['desde'];

if ($idclase == 0 || $idnivelasignado == 0)
{
  $continua= "N";
}
else
{  
  mysqli_select_db($cnn_kn, $database_cnn_kn);
  $query_rs_tipo_nivtabla = "SELECT IdNivel, NombreNivel FROM nivel WHERE Estado = 1 ORDER BY NombreNivel;";
  $rs_tipo_nivtabla = mysqli_query($cnn_kn,$query_rs_tipo_nivtabla) or die(mysqli_error()."$query_rs_tipo_nivtabla");
  mysqli_set_charset($cnn_kn,"utf8");
  $row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla);


  mysqli_select_db($cnn_kn, $database_cnn_kn);
  $query_rs_cuposxclase = "SELECT count(IdClasexEstudiante) cantidadAsignados FROM clasexestudiante WHERE Estado = 'A' AND IdClase = $idclase AND IdAsignado = $idnivelasignado;";
  $rs_cuposxclase = mysqli_query($cnn_kn,$query_rs_cuposxclase) or die(mysqli_error()."$query_rs_cuposxclase");
  mysqli_set_charset($cnn_kn,"utf8");
  $row_rs_cuposxclase = mysqli_fetch_assoc($rs_cuposxclase);
  $cuposReservados = $row_rs_cuposxclase['cantidadAsignados'];
  mysqli_free_result($rs_cuposxclase);

  $cuposDisponibles = $cupos - $cuposReservados;

  if($idclase > 0)
  {  
    $txt ="Programación Disponible.";
    mysqli_select_db($cnn_kn, $database_cnn_kn);    
    $query_rs_tipo_suctablax = "SELECT count(IdClasexEstudiante) as cantidad FROM clasexestudiante WHERE IdEstudiante = $id AND IdClase = $idclase AND Estado = 'A';";
    $rs_tipo_suctablax = mysqli_query($cnn_kn,$query_rs_tipo_suctablax) or die(mysqli_error()."$query_rs_tipo_suctablax");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_tipo_suctablax = mysqli_fetch_assoc($rs_tipo_suctablax);
    //echo "$query_rs_tipo_suctablax";
      $cantidad = $row_rs_tipo_suctablax['cantidad'];
    mysqli_free_result($rs_tipo_suctablax);
  }

  if($cantidad ==1)
  {
     $txt ="Reservado.";
  }

  mysqli_free_result($rs_tipo_nivtabla);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>.:: ConIngles  |  Información Principal ::.</title>
    <!-- Favicon-->
      <link rel="icon" href="../../images/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="<?=$base_url?>css/calendar.css"> -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

         <!-- Custom Css -->
        <link href="../../css/style.css" rel="stylesheet">
        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="../../css/themes/all-themes.css" rel="stylesheet" />

       <!-- --> 
       <link href="../../cal/sample in bootstrap v3/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
       <link href="../../cal/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

        <!-- Alertas -->
        <link href="../../sweet/sweetalert.css" rel="stylesheet">
        <!-- Waves Effect Css -->
        <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

        <!--WaitMe Css-->
        <link href="../../../plugins/waitme/waitMe.css" rel="stylesheet" />

        <!-- JQuery DataTable Css 20160903 MKS-->
        <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <script type="text/javascript" src="../../Calendario/js/es-ES.js"></script>
        <script src="../../Calendario/js/jquery.min.js"></script>
        <script src="../../Calendario/js/moment.js"></script>
        <script src="../../Calendario/js/bootstrap.min.js"></script>

        <!-- Wait Me Plugin Js -->
        <script src="../../../plugins/waitme/waitMe.js"></script>

        <!-- Jquery DataTable Plugin Js -->
        <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <!-- Waves Effect Plugin Js -->
        <script src="../../plugins/node-waves/waves.js"></script>
        <!--   <script src="<?=$base_url?>js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="<?=$base_url?>css/bootstrap-datetimepicker.min.css" />
       <script src="<?=$base_url?>js/bootstrap-datetimepicker.es.js"></script> -->
       <!--   -->
       <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../cal/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="../../cal/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
        <!-- Alertas -->
        <script src="../../sweet/sweetalert.min.js"></script>
        <!-- <script src="../../js/pages/tables/jquery-datatable.js"></script> -->

        <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

   <style>
    object{
       width:100%;
       height:390px ;  
  }
   </style>   


   <script type="text/javascript">
    $(document).ready(function () {  
      //var aDatos = [];

      var idclase = "";

      

      $('input[type=checkbox]').click(function() {
        //$("input:checkbox:checked").each(function() {           
        //$("input[type=checkbox]:checked").each(function() {
          if($('input[name=realtime]').is(':checked')){
            var x = $(this).val();
            var estadochk = this.checked;
            var tipoid ="";
            //alert(x);      
          }
          if (estadochk)
          {
            tipoid ="r";
          }
          else
          {
            tipoid ="c";
          }  
           //aDatos.push((this).alt);
           idclase = this.alt;
           //alert(idclase);
           $.ajax({
                //this is the php file that processes the data 
                url: "addclasexnivel.php",
                //GET method is used
                type: "POST",
                data: "id="+tipoid+"&idclase="+idclase+"&estud=<?php echo $id; ?>&nivelasignado=<?php echo $idnivelasignado; ?>",               
                beforeSend: function() {
                    // setting a timeout
                    swal({
                        title: "Actualizando información...",
                        text: "un momento por favor.",
                        imageUrl: "../../sweet/89.gif",
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                success: function (xdata) {
                    //if returned 1/true (process success)
                    var cadstr = xdata.charAt(xdata.length-1);
                    if (cadstr == 'r') 
                    //if (xdata.trim() == 'r') 
                    {
                        //hide the form
                        $('.form1').fadeOut('slow');
                        //show the success message
                        $('.done').fadeIn('slow');
                        //if process.php returned 0/false (send mail failed)
                        swal({
                          title: "Atención:  Registro grabado correctamente. Programación ha sido Reservada.",
                          text: "un momento por favor.",
                          imageUrl: "../../sweet/ok.png",
                          timer: 3000,
                          showConfirmButton: false
                        });
                        setTimeout(function(){
                            location.reload();
                        },2000); 
                    } 
                    // else if (xdata.trim() == 'E')                     
                    // {
                    //   swal({
                    //       title: "Error:  Programacion ya Existe...",
                    //       text: "un momento por favor.",
                    //       imageUrl: "../../sweet/alert.png",
                    //       timer: 3000,
                    //       showConfirmButton: false
                    //     });
                    // }
                    else 
                    {
                      swal({
                          title: "Atención:  Registro Actualizado...Programación Cancelada, podrá ser reservada nuevamente.",
                          text: "un momento por favor.",
                          imageUrl: "../../sweet/alert.png",
                          timer: 3000,
                          showConfirmButton: false
                        });
                    }
                },
                error: function () {
                    //alert("No");
                    //cancel the submit button default behaviours
                    swal({
                      title: "Error:  Valide los campos requeridos...",
                      text: "un momento por favor.",
                      imageUrl: "../../sweet/2.gif",
                      timer: 3000,
                      showConfirmButton: false
                    });
                    return false;                       
                }
            });

        //});
      });  

      $("#grabar").on('click', function(){

          $.ajax({
                //this is the php file that processes the data 
                url: "addclasexnivel.php",
                //GET method is used
                type: "POST",
                data: "id=g&idclase=<?php echo $idclase;?>&estud=<?php echo $id; ?>&nivelasignado=<?php echo $idnivelasignado; ?>",
                beforeSend: function() {
                    // setting a timeout
                    swal({
                        title: "Actualizando información...",
                        text: "un momento por favor.",
                        imageUrl: "../../sweet/89.gif",
                        timer: 3000,
                        showConfirmButton: false
                    });
                },
                success: function (xdata) {
                    //if returned 1/true (process success)
                    if (xdata.trim() == 'S') 
                    {
                        //hide the form
                        $('.form1').fadeOut('slow');
                        //show the success message
                        $('.done').fadeIn('slow');
                        //if process.php returned 0/false (send mail failed)
                        swal({
                          title: "Atención:  Registro grabado correctamente. Programación Reservada.",
                          text: "un momento por favor.",
                          imageUrl: "../../sweet/ok.png",
                          timer: 3000,
                          showConfirmButton: false
                        });
                        setTimeout(function(){
                            location.reload();
                        },2000); 
                    } 
                    // else if (xdata.trim() == 'E')                     
                    // {
                    //   swal({
                    //       title: "Error:  Programacion ya Existe...",
                    //       text: "un momento por favor.",
                    //       imageUrl: "../../sweet/alert.png",
                    //       timer: 3000,
                    //       showConfirmButton: false
                    //     });
                    // }
                    else 
                    {
                      swal({
                          title: "Error:  Registro ya fue grabado...Programación no puede ser reservada nuevamente.",
                          text: "un momento por favor.",
                          imageUrl: "../../sweet/2.gif",
                          timer: 3000,
                          showConfirmButton: false
                        });
                    }
                },
                error: function () {
                    //alert("No");
                    //cancel the submit button default behaviours
                    swal({
                      title: "Error:  Valide los campos requeridos...",
                      text: "un momento por favor.",
                      imageUrl: "../../sweet/2.gif",
                      timer: 3000,
                      showConfirmButton: false
                    });
                    return false;                       
                }
            });
      });


      $("#cancelar").on('click', function(){ 
        var entra = "S";
        var Digital=new Date();
        var hours=Digital.getHours();
        var minutes=Digital.getMinutes();
        var seconds=Digital.getSeconds();
        var dn="am"; 
        if (hours>12)
        {
          dn="pm";
          hours=hours-12;
        }
        else
        {
          hours = "0"+hours;
        }
        if (hours==0)
        {
          hours=12;
        } 
        if (minutes<=9)
        {  
          minutes="0"+minutes;
        }
        var reloj = hours+":"+minutes+" "+dn;
          
        var dnhorario = "<?php echo substr($clasedesde,6); ?>";
        var horarioin = "<?php echo substr($clasedesde,0,2); ?>";

        if(dnhorario == "am" && reloj <= "05:00 pm")
        {
          entra = "N";
        }
        //alert(horainicio);
        //console.log(horainicio < "05:00 pm");
        if (horarioin == "12" && dnhorario == "am" && reloj <= "08:00 am")
        {
          entra = "N"; 
        }

        if (horarioin == "12" && dnhorario == "pm" && reloj >= "12:00 am")
        {
          entra = "N"; 
        }
        //alert(reloj);
        if(entra == "N" )
        {
          swal({
            title: "No puede cancelar Programacion...",
            text: "un momento por favor.",
            imageUrl: "../../sweet/alert.png",
            timer: 3000,
            showConfirmButton: false
          });
        }  
        else
        {
            //alert(7);
            $.ajax({
                  //this is the php file that processes the data 
                  url: "addclasexnivel.php",
                  //GET method is used
                  type: "POST",
                  data: "id=c&idclase=<?php echo $idclase;?>&estud=<?php echo $id; ?>&nivelasignado=<?php echo $idnivelasignado; ?>",
                  beforeSend: function() {
                      // setting a timeout
                      swal({
                          title: "Actualizando información...",
                          text: "un momento por favor.",
                          imageUrl: "../../sweet/89.gif",
                          timer: 3000,
                          showConfirmButton: false
                      });
                  },
                  success: function (xdata) {
                      //if returned 1/true (process success)
                      if (xdata.trim() == 'S') 
                      {
                          //hide the form
                          $('.form1').fadeOut('slow');
                          //show the success message
                          $('.done').fadeIn('slow');
                          //if process.php returned 0/false (send mail failed)
                          swal({
                            title: "Atención:  Registro actualizado correctamente.  Programacion ha sido cancelada.",
                            text: "un momento por favor.",
                            imageUrl: "../../sweet/ok.png",
                            timer: 3000,
                            showConfirmButton: false
                          });
                          setTimeout(function(){
                              location.reload();
                          },2000); 
                          
                      } 
                      // else if (xdata.trim() == 'E')                     
                      // {
                      //   swal({
                      //       title: "Error:  Programacion ya Existe...",
                      //       text: "un momento por favor.",
                      //       imageUrl: "../../sweet/alert.png",
                      //       timer: 3000,
                      //       showConfirmButton: false
                      //     });
                      // }
                      else 
                      {
                        swal({
                            title: "Error:  Registro ya fue grabado...",
                            text: "un momento por favor.",
                            imageUrl: "../../sweet/2.gif",
                            timer: 3000,
                            showConfirmButton: false
                          });
                      }
                  },
                  error: function () {
                      //alert("No");
                      //cancel the submit button default behaviours
                      swal({
                        title: "Error:  Valide los campos requeridos...",
                        text: "un momento por favor.",
                        imageUrl: "../../sweet/2.gif",
                        timer: 3000,
                        showConfirmButton: false
                      });
                      return false;                       
                  }
              });
          }  
        });      
    })
  </script>  
  
</head>
<body class="theme-red">
  <div class="modal-body">
    <form action="" method="post" id="form1">
      <!-- <label for="tipo">Curso</label> -->
        
        <div class="row">
          <div class="col-sm-10"><h2>:: Reservación de Clases.</h2></div>
        </div>

        <div class="row">
          <div class="col-sm-4">
           <!--  <select class="form-control" name="nivel" id="nivel">
              <option value="">Seleccione Nivel</option>
                <?php 
                    do{                                                                
                        $idTablamat = $row_rs_tipo_nivtabla['IdNivel'];                                
                        $NombreNivel = $row_rs_tipo_nivtabla['NombreNivel'];    
                ?>
                      <option value="<?php echo $idTablamat ;?>"><?php echo $NombreNivel ;?></option>
                <?php 
                    } while($row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla));
                ?>
            </select> 
          </div> 
          <div class="col-sm-4">
              <button type="submit" class="btn btn-info waves-effect" data-dismiss="modal" id="buscar">Buscar</button>
          </div>-->
        </div>


        <div class="row">
           <div class="col-xs-12" id="zonahorario">
              <?php 
               //if( $nivel != "")
               // {
              ?>
              <!-- <div class="panel panel-default">
                <div class="panel-heading">Reservar Clase</div>
              </div>   -->
                <table class="table table-striped table-hover dataTable js-exportable" style="border-radius: 15px; -moz-border-radius: 15px; -webkit-border-radius: 15px; width: 100%;" id="grid">
                    <thead>
                        <tr style="text-align: center; background-color: #11203a; color: #CCC;">
                            <th>Sede</th>                            
                            <th>Nivel</th>
                            <th>Tema</th>
                            <th>Salón</th>
                            <th>Fecha </th>
                            <!-- <th>Fecha Final</th>  -->
                            <th>Horario</th>
                            <th>Profesor</th>
                            <th>Día</th>
                            <th>Reservar</th>
                        </tr>
                    </thead>
                    <!--
                    <tfoot>
                        <tr>
                            <th colspan="9">
                              <div class="row">
                                <div class="col-sm-10">Estado Actual: 
                                  <span style="color: #0174DF; font-weight: bold; font-size: 15px;"><?php echo $txt; ?></span>
                                </div>
                              </div>
                            </th>
                        </tr>
                        <tr>    
                            <th colspan="9">
                              <div class="row">
                                <div class="col-sm-10">Cupos Disponibles: 
                                  <span style="color: #0174DF; font-weight: bold; font-size: 15px;"><?php echo $cuposDisponibles; ?></span>
                                </div>
                              </div>
                            </th> 
                        </tr>
                    </tfoot>
                  -->
                    <tbody>

              <?php      
                $nombre_Tabla="";

                do{
                    $nomdia = '';
                    $Sede = $row_rs_tipo_tabla['NombreSucursal'];    
                    //$archivo = $Nombre.".php";
                    $idTabla = $row_rs_tipo_tabla['IdClase'];    
                    $Nombre_Salon = $row_rs_tipo_tabla['NombreSalon'];
                    $Nombre_Materia = $row_rs_tipo_tabla['NombreMateria'];
                    $Nombre_Nivel = $row_rs_tipo_tabla['NombreNivel'];
                    $Nombre_Horario = $row_rs_tipo_tabla['NombreHorario'];
                    $Nombre_Profesor = strtoupper($row_rs_tipo_tabla['NombreProfesor']);
                    $fechaDesde = $row_rs_tipo_tabla['desde'];
                    $fechaHasta = $row_rs_tipo_tabla['hasta'];
                    $IdEvento = $row_rs_tipo_tabla['IdEvento'];


                    if($idTabla != "")
                    {  
                        mysqli_select_db($cnn_kn, $database_cnn_kn);
                        $query_rs_tipo_stablax = "SELECT Dia FROM clasexdia WHERE IdClase = $idTabla ORDER BY Dia;";
                        //echo "mks....$query_rs_tipo_stablax<br>";
                        $rs_tipo_stablax = mysqli_query($cnn_kn,$query_rs_tipo_stablax) or die(mysqli_error()."$query_rs_tipo_stablax");
                        mysqli_set_charset($cnn_kn,"utf8");
                        $row_rs_tipo_stablax = mysqli_fetch_assoc($rs_tipo_stablax);
                        
                        $nd = '';
                        do
                        {        
                            $dia = $row_rs_tipo_stablax['Dia'];
                            switch ($dia) {
                                case 1:
                                     $nd = 'Lunes';
                                     break;         
                                case 2:
                                     $nd = 'Martes';
                                     break;        
                                case 3:
                                     $nd = 'Miercoles';
                                     break;
                                case 4:
                                     $nd = 'Jueves';
                                     break;
                                case 5:
                                     $nd = 'Viernes';
                                     break;
                                case 6:
                                     $nd = 'Sabado';
                                     break;
                             }
                             if($nomdia =="")
                             {
                                $nomdia = $nd;
                             } 
                             else
                             {
                                $nomdia = $nomdia .', '.$nd; 
                             }   

                        } while($row_rs_tipo_stablax = mysqli_fetch_assoc($rs_tipo_stablax));    
                         mysqli_free_result($rs_tipo_stablax);
                    } 
                    $chekeado ="";
                    mysqli_select_db($cnn_kn, $database_cnn_kn);
                    $query_rs_cc = "SELECT IdAsignado, Estado FROM clasexestudiante WHERE IdClase = $idTabla AND IdEstudiante = $id AND Estado = 'A';";
                    $rs_cc = mysqli_query($cnn_kn,$query_rs_cc) or die(mysqli_error()."$query_rs_cc");
                    $row_rs_cc = mysqli_fetch_assoc($rs_cc);
                    $totalRows_rs_cc = mysqli_num_rows($rs_cc);
                    mysqli_set_charset($cnn_kn,"utf8");
                    //echo "chk......$query_rs_cc<br>";

                    if($totalRows_rs_cc == 1)
                    {  
                      //$IdAsignado = $row_rs_cc['IdAsignado'];
                      $estado = $row_rs_cc['Estado'];
                      if ($estado == 'A' )
                      {
                          $chekeado = "checked";
                      }
                    }  
                    mysqli_free_result($rs_cc);   
              ?>
      <tr style="font-size: 11.5px;">
        <td>
          <!-- <a href="<?php echo $nombre_lnk.'edi'; ?>.php?m=<?php echo $idTabla; ?>" class="nav nav-tabs nav-stacked" style="text-decoration:none;"><?php echo $Sede; ?></a>  -->
          <?php echo $Sede; ?>
        </td>                        
        <td><?php echo $Nombre_Nivel; ?></td> 
        <td><?php echo $Nombre_Materia; ?></td>         
        <td><?php echo $Nombre_Salon; ?></td>
        <td><?php echo "Inicio: <br>".$fechaDesde."<br>"; ?><?php echo "Fin:<br> ".$fechaHasta; ?></td>
        <!-- <td><?php echo $fechaHasta; ?></td>  -->
        <td><?php echo $Nombre_Horario; ?></td> 
        <td><?php echo $Nombre_Profesor; ?></td> 
        <td><?php echo $nomdia."<br>".$IdEvento; ?></td>     
        <td>
             <div class="pull-right" style="padding-left: 10px; padding-top: 20px;">
                  <div class="switch panel-switch-btn">
                      <span class="m-r-10 font-8"></span>
                      <label style="font-size: 11.5px;">
                        NO
                        <input type="checkbox" id="realtime" name="realtime" alt="<?php echo $idTabla; ?>" <?php echo $chekeado; ?> >
                        <span class="lever switch-col-cyan"></span>
                        SI
                      </label>
                  </div>
              </div>
        </td>
      </tr>
<?php                          
} while($row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla)); ?>
                    </tbody>
                </table>              
              <?php    
               // } 
              ?>  
           </div>
        </div>  

        <?php if($cuposDisponibles > 0) { ?>
          <div class="col-sm-4">
          <?php if($idclase > 0) { ?>
              <?php if($cantidad  == 0) { ?>
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="grabar">Reservar</button>
              <?php } 
                else {
              ?>  
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cancelar">Cancelar</button>
              <?php } ?>
          <?php } ?>
          </div>
        <?php } 
        else { ?>
            <!-- <div class="row">
              <div class="col-sm-10"> 
                <span style="color: #ce0808; font-weight: bold; font-size: 15px;"><?php echo "No hay Cupos Disponibles."; ?></span>
              </div>
            </div> -->
        <?php }
        ?>
    </form>
  </div>      
  
  
</body>

</html>
<?php 
 
 mysqli_free_result($rs_usuario);
 ?>