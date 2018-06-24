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
$cantidadAsignado = 0;
$txt ="No hay Programación.";
 
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_tabla = "SELECT estudiante.IdEstudiante, clasexestudiante.*, sucursal.NombreSucursal, nivel.NombreNivel, materia.NombreMateria, salon.NombreSalon, CONCAT_WS(' - ', horario.Inicio,horario.final) as NombreHorario, concat_WS(' ', profesores.Nombres_PRO, profesores.Apellido1_PRO) as NombreProfesor, clases.IdClase, clases.desde, clases.hasta, clases.IdEvento
FROM estudiante 
-- JOIN nivelasignado ON nivelasignado.IdEstudiante = estudiante.IdEstudiante AND nivelasignado.Estado = 2 
JOIN clasexestudiante ON clasexestudiante.IdEstudiante = estudiante.IdEstudiante AND clasexestudiante.Estado = 'A'
-- JOIN clases ON clases.Nivel = nivelasignado.IdNivel
JOIN clases ON clases.IdClase = clasexestudiante.IdClase 
JOIN sucursal ON sucursal.IdSucursal = clases.Sede AND sucursal.IdSucursal = estudiante.Sucursal_EST
JOIN nivel ON nivel.IdNivel = clases.Nivel
JOIN materia ON materia.IdMateria = clases.Materia
JOIN salon ON salon.IdSalon = clases.Salon
JOIN horario ON horario.IdHorario = clases.Horario
JOIN profesores ON profesores.IdProfesor = clases.Profesor
WHERE estudiante.IdEstudiante = $id AND estudiante.Estado_EST = 1 ORDER BY nivel.NombreNivel, clases.desde, clases.hasta;";
$rs_tipo_tabla = mysqli_query($cnn_kn,$query_rs_tipo_tabla) or die(mysqli_error()."$query_rs_tipo_tabla ln67");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla);
$totalRows_rs_tipo_tabla = mysqli_num_rows($rs_tipo_tabla);
// echo "valor tabla........................................................$query_rs_tipo_tabla <br> idEstud....$id<br>";
$idclase = $row_rs_tipo_tabla['IdClase'];
$idnivelasignado = $row_rs_tipo_tabla['IdAsignado'];
//$cantidadAsignado = $row_rs_tipo_tabla['cantidadAsignado'];


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_nivtabla = "SELECT IdNivel, NombreNivel FROM nivel WHERE Estado = 1 ORDER BY NombreNivel;";
$rs_tipo_nivtabla = mysqli_query($cnn_kn,$query_rs_tipo_nivtabla) or die(mysqli_error()."$query_rs_tipo_nivtabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla);

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
        <!-- JQuery DataTable Css 20160903 MKS-->
        <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <script type="text/javascript" src="../../Calendario/js/es-ES.js"></script>
        <script src="../../Calendario/js/jquery.min.js"></script>
        <script src="../../Calendario/js/moment.js"></script>
        <script src="../../Calendario/js/bootstrap.min.js"></script>

        <!-- Jquery DataTable Plugin Js -->
        <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <!-- Waves Effect Plugin Js -->
        <script src="../../plugins/node-waves/waves.js"></script>
        <!--   <script src="<?=$base_url?>js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="<?=$base_url?>css/bootstrap-datetimepicker.min.css" />
       <script src="<?=$base_url?>js/bootstrap-datetimepicker.es.js"></script> -->
       <!--  <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script> -->
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
      });

    })
  </script>  
  
</head>
<body class="theme-red">
  <div class="modal-body">
    <form action="" method="post" id="form1">
      <!-- <label for="tipo">Curso</label> -->
        
        <div class="row">
          <div class="col-sm-10"><h2>:: Información Programación de Clases.</h2></div>
        </div>

        <!-- <div class="row">
          <div class="col-sm-10">Estado Actual: <span style="color: #0174DF; font-weight: bold; font-size: 15px;"><?php echo $txt; ?></span></div>
        </div> -->
        <div style="padding-top: 10px;"></div>

        <div class="row">
          <div class="col-sm-10"><span class="label label-info"><b>Nivel:</b> <?php echo trim($row_rs_tipo_tabla['NombreNivel']); ?></span></div>
        </div>

        <div class="row">
          <div class="col-sm-10"><span class="label label-info"><b>Profesor:</b> <?php echo trim($row_rs_tipo_tabla['NombreProfesor']); ?></span></div>
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
           <div class="col-sm-10" id="zonahorario">
              <?php 
               if( $totalRows_rs_tipo_tabla > 0)
               {
              ?>
                <table class="table table-bordered table-striped table-hover dataTable table-condensed js-exportable" id="grid">
                    <thead>
                        <tr style="text-align: center; background-color: #11203a; color: #CCC;">
                            <!-- <th>Nivel</th> -->
                            <th>Sede</th>
                            <th>Topic</th>
                            <th>Salón</th>
                            <!-- <th>Fecha Inicio</th>
                            <th>Fecha Final</th> -->
                            <th>Fecha</th>
                            <th>Horario</th>
                            <!-- <th>Profesor</th> -->
                           <!--  <th>Día</th> -->
                           <!--  <th>Estado</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="10"></th>
                            <!-- <th>Nivel</th>
                            <th>Sede</th>
                            <th>Curso</th>
                            <th>Salón</th>
                            <th>Horario</th>
                            <th>Profesor</th>
                            <th>Día(s)</th>
                            <th>Estado</th> -->
                        </tr>
                    </tfoot>
                    <tbody>

              <?php      
                $nombre_Tabla="";

                do{
                    $txtNivelEstado ='';
                    $nomdia = '';
                    $Sede = $row_rs_tipo_tabla['NombreSucursal'];    
                    //$archivo = $Nombre.".php";
                    $idTabla = $row_rs_tipo_tabla['IdClase'];
                    $Nombre_Salon = $row_rs_tipo_tabla['NombreSalon'];
                    $Nombre_Materia = $row_rs_tipo_tabla['NombreMateria'];
                    $Nombre_Nivel = $row_rs_tipo_tabla['NombreNivel'];
                    $FechaClase = trim($row_rs_tipo_tabla['IdEvento']);
                    $Nombre_Horario = trim($row_rs_tipo_tabla['NombreHorario']);
                    $Nombre_Profesor = $row_rs_tipo_tabla['NombreProfesor'];
                    $fechaDesde = $row_rs_tipo_tabla['desde'];
                    $fechaHasta = $row_rs_tipo_tabla['hasta'];

                    //$EstadoNivel = $row_rs_tipo_tabla['nivelasignado.Estado'];
                    //e//cho "ivell...$EstadoNivel";
                    if($cantidadAsignado == 1)
                    {
                        $txtNivelEstado = 'En curso';
                    }
                    else
                    {
                        $txtNivelEstado = 'Realizado.'; 
                    }


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
              ?>
      <tr>
        <!-- <td><?php echo $Nombre_Nivel; ?></td> -->
        <td>
          <!-- <a href="<?php echo $nombre_lnk.'edi'; ?>.php?m=<?php echo $idTabla; ?>" class="nav nav-tabs nav-stacked" style="text-decoration:none;"><?php echo $Sede; ?></a>  -->
          <?php echo $Sede; ?>
        </td>
        <td><?php echo $Nombre_Materia; ?></td>         
        <td><?php echo $Nombre_Salon; ?></td>         
        <!-- <td><?php echo $fechaDesde; ?></td>
        <td><?php echo $fechaHasta; ?></td> -->
        <td><?php echo $FechaClase; ?></td>
        <td><?php echo $Nombre_Horario; ?></td> 
        <!-- <td><?php echo strtoupper($Nombre_Profesor); ?></td>  -->
        <!-- <td><?php echo $nomdia; ?></td> -->
       <!--  <td><span style="color: red; font-weight: bold; font-size: 12px;"><?php echo $txtNivelEstado ; ?></span></td>  -->
      </tr>
<?php                          
} while($row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla)); ?>
                    </tbody>
                </table>
              <?php    
                } 
                else
                {
                  echo "<div style='clear:both;font-size:14; background-color:red; color:white; text-align:center;-moz-border-radius: 15px;border-radius: 15px;'>No hay información Registrada.</div>";
                }
              ?>  
           </div>
        </div>  
        <div class="col-sm-4">
          <?php 
          if($totalRows_rs_tipo_tabla > 0)
          {
          ?>
          <div style='-moz-border-radius: 15px;border-radius: 15px;'><b>Clases Programadas:</b> <span  class="badge"><?php echo $totalRows_rs_tipo_tabla ;?></span> </div>
          <?php
          }  
          ?>

        <?php //if($idclase > 0) { ?>
            <?php //if($cantidad  == 0) { ?>
              <!-- <button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="grabar">Reservar</button> -->
            <?php //} ?>  
           <!--  <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="cancelar">Cancelar</button> -->
        <?php //} ?>      
        </div>
    </form>
  </div>      
  
  
</body>

</html>
<?php 
 mysqli_free_result($rs_tipo_nivtabla);
 mysqli_free_result($rs_usuario);
 ?>