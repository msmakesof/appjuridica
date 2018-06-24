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
include 'config.php';
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_suctabla = "SELECT IdSucursal, NombreSucursal FROM sucursal WHERE EstadoSucursal = 1 ORDER BY NombreSucursal;";
$rs_tipo_suctabla = mysqli_query($cnn_kn,$query_rs_tipo_suctabla) or die(mysqli_error()."$query_rs_tipo_suctabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_suctabla = mysqli_fetch_assoc($rs_tipo_suctabla);


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_proftabla = "SELECT IdProfesor, concat_WS(' ', Nombres_PRO, Apellido1_PRO) as NombreProfesor FROM profesores WHERE Estado_PRO = '1' ORDER BY NombreProfesor;";
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
        <!-- Alertas -->
        <link href="../sweet/sweetalert.css" rel="stylesheet">
        <script type="text/javascript" src="<?=$base_url?>js/es-ES.js"></script>
        <script src="<?=$base_url?>js/jquery.min.js"></script>
        <script src="<?=$base_url?>js/moment.js"></script>
        <script src="<?=$base_url?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../cal/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="../cal/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
        <!-- Alertas -->
        <script src="../sweet/sweetalert.min.js"></script>
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
        <form action="" method="post" id="form1">

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
             <!--  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button> -->
              <button type="button" class="btn btn-success" id="grabar"><i class="fa fa-check"></i> Grabar</button>
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

 <script type="text/javascript">
    $(document).ready(function() {

        $("#grabar").on('click', function(){            
            //
            $.ajax({
                //this is the php file that processes the data 
                url: "addclase.php",
                //GET method is used
                type: "POST",
                data: $("#form1").serialize(),
                beforeSend: function() {
                    // setting a timeout
                    swal({
                        title: "Actualizando información...",
                        text: "un momento por favor.",
                        imageUrl: "../sweet/89.gif",
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
                          title: "Atención:  Registro grabado correctamente.",
                          text: "un momento por favor.",
                          imageUrl: "../sweet/ok.png",
                          timer: 3000,
                          showConfirmButton: false
                        });
                        $("#form1")[0].reset();
                    } 
                    else if (xdata.trim() == 'E')                     
                    {
                      swal({
                          title: "Error:  Programacion ya Existe...",
                          text: "un momento por favor.",
                          imageUrl: "../sweet/alert.png",
                          timer: 3000,
                          showConfirmButton: false
                        });
                    }
                    else 
                    {
                      swal({
                          title: "Error:  Valide los campos requeridos...",
                          text: "un momento por favor.",
                          imageUrl: "../sweet/2.gif",
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
                      imageUrl: "../sweet/2.gif",
                      timer: 3000,
                      showConfirmButton: false
                    });
                    return false;                       
                }
            });
            // 
        });
    });
</script>
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