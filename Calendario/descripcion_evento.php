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
$query_rs_tipo_suctabla = "SELECT * FROM sucursal WHERE EstadoSucursal = 1 ;";
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
    
    //incluimos nuestro archivo config
    include 'config.php'; 

    // Incluimos nuestro archivo de funciones
    include 'funciones.php';

    // Obtenemos el id del evento
    $id  = evaluar($_GET['id']);



mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_vtabla = "SELECT eventos.*, clases.* FROM eventos JOIN clases ON clases.IdEvento = eventos.id WHERE id=$id;";
$rs_tipo_vtabla = mysqli_query($cnn_kn,$query_rs_tipo_vtabla) or die(mysqli_error()."$query_rs_tipo_vtabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_vtabla = mysqli_fetch_assoc($rs_tipo_vtabla);

    // y lo buscamos en la base de dato
    //$bd  = $conexion->query("SELECT eventos.*, clases.* FROM eventos JOIN clases ON clases.IdEvento = eventos.id WHERE id=$id");

    // Obtenemos los datos
    //$row = $bd->fetch_assoc();

     //titulo 
    $titulo= $row_rs_tipo_vtabla['title'];  //$row['title'];

    // cuerpo
    $evento=$row_rs_tipo_vtabla['body'];  //$row['body'];

    // // Fecha inicio
    // $inicio=$row['inicio_normal'];
    // // Fecha Termino
    // $final=$row['final_normal'];
    // $sede = $row['Sede'];
    // $profesor = $row['Profesor'];
    // $salon = $row['Salon'];
    // $curso = $row['Materia'];
    // $horario = $row['Horario'];
    // $nivel = $row['Nivel'];


    $inicio = $row_rs_tipo_vtabla['inicio_normal'];

    // Fecha Termino
    $final = $row_rs_tipo_vtabla['final_normal'];
    $sede = $row_rs_tipo_vtabla['Sede'];
    $profesor = $row_rs_tipo_vtabla['Profesor'];
    $salon = $row_rs_tipo_vtabla['Salon'];
    $curso = $row_rs_tipo_vtabla['Materia'];
    $horario = $row_rs_tipo_vtabla['Horario'];
    $nivel = $row_rs_tipo_vtabla['Nivel'];

// Eliminar evento
if (isset($_POST['eliminar_evento'])) 
{
    // $id  = evaluar($_GET['id']);
    // $sql = "DELETE FROM eventos WHERE id = $id";

    // if ($conexion->query($sql)) 
    // {
    //     echo "Evento eliminado";
    // }
    // else
    // {
    //     echo "El evento no se pudo eliminar";
    // }

    $borrados = 0;
    $deleteSQL = "DELETE FROM eventos WHERE id = $id ;";
    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $Result1 = mysqli_query($cnn_kn, $deleteSQL ) or die(mysqli_error()." Err...".$deleteSQL);
    if($Result1)
    {
         $borrados = 1;
    }    

    $deleteSQL = "DELETE FROM clases WHERE IdEvento = $id;";
    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $Result1 = mysqli_query($cnn_kn, $deleteSQL ) or die(mysqli_error()." Err...".$deleteSQL);

    if($Result1 && $borrados > 0)
    {
        echo "Evento eliminado";
        header("Location:$base_url"); 
    }
    else
    {
        echo "El evento no se pudo eliminar";
    }    
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$titulo?></title>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$base_url?>css/calendar.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

     <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

    <script type="text/javascript" src="<?=$base_url?>js/es-ES.js"></script>
    <script src="<?=$base_url?>js/jquery.min.js"></script>
    <script src="<?=$base_url?>js/moment.js"></script>
    <script src="<?=$base_url?>js/bootstrap.min.js"></script>
    <script src="<?=$base_url?>js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="<?=$base_url?>css/bootstrap-datetimepicker.min.css" />

    <link rel="stylesheet" href="../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../css/themes2/alertify.default.css" id="toggleCSS" />

    <script src="<?=$base_url?>js/bootstrap-datetimepicker.es.js"></script>
    <script src="<?=$base_url?>js/underscore-min.js"></script>
    <script src="<?=$base_url?>js/calendar.js"></script>
    <script src="../js/alertify.min.js"></script>
</head>
<body style="background: white;">
    <div class="container" style="margin-top:-5px;">
    	<h2>Programación de Clase</h2>
    	<hr style="margin-top:-5px;">
        <!-- 
        <b>Fecha inicio:</b> <?=$inicio?>
        <b>Fecha termino:</b> <?=$final?>
     	<p><?=$evento?></p> -->
        
        <form action="" method="post">
            <label for="tipo">Sede</label>
            <select class="form-control" name="sede" id="sede">
            <option value="">Seleccione Sede</option>
                <?php 
                do{                                                                
                    $idTabla = $row_rs_tipo_suctabla['IdSucursal'];                                
                    $NombreSucursal = $row_rs_tipo_suctabla['NombreSucursal'];    
                ?>
                <option value="<?php echo $idTabla ;?>" <?php if($idTabla == $sede) {echo "selected";} else{ echo "";} ?>><?php echo $NombreSucursal ;?></option>
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
                <option value="<?php echo $idTablap ;?>" <?php if($idTablap == $profesor) {echo "selected";} else{ echo "";} ?>><?php echo $NombreProfesor ;?></option>
                <?php 
            } while($row_rs_tipo_proftabla = mysqli_fetch_assoc($rs_tipo_proftabla));
                ?>
            </select>

            <label for="from">Semana Desde</label>
            <div class='input-group date' id='from'>
                <input type='text' id="from" name="from" class="form-control" value="<?php echo $inicio ; ?>" readonly />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </div>
            

            <label for="to">Semana Hasta</label>
            <div class='input-group date' id='to'>
                <input type='text' name="to" id="to" class="form-control" value="<?php echo $final; ?>" readonly />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </div>

            <label for="tipo">Salón</label>
            <select class="form-control" name="salon" id="salon">
            <option value="">Seleccione Salón</option>
                <?php 
                    do{                                                                
                        $idTablasal = $row_rs_tipo_saltabla['IdSalon'];                                
                        $NombreSalon = $row_rs_tipo_saltabla['NombreSalon'];    
                ?>
                <option value="<?php echo $idTablasal ;?>" <?php if($idTablasal == $salon) {echo "selected";} else{ echo "";} ?>><?php echo $NombreSalon ;?></option>
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
                <option value="<?php echo $idTablamat ;?>" <?php if($idTablamat == $curso) {echo "selected";} else{ echo "";} ?>><?php echo $NombreMateria ;?></option>
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
                <option value="<?php echo $idTablahor ;?>" <?php if($idTablahor == $horario) {echo "selected";} else{ echo "";} ?>><?php echo $Inicio . ' - ' . $Final ;?></option>
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
                <option value="<?php echo $idTablaniv ;?>" <?php if($idTablaniv == $nivel) {echo "selected";} else{ echo "";} ?>><?php echo $NombreNivel ;?></option>
                <?php 
            } while($row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla));
                ?>
            </select>
            <br>
                    <div class="demo-checkbox">Día:
                    <?php                     
                    $miarray = array(); // creo el array                    
                    do 
                    { 
                        $dia = $row_rs_tipo_vtabla['dia'];
                        array_push($miarray, $dia);
                    } while($row_rs_tipo_vtabla = mysqli_fetch_assoc($rs_tipo_vtabla));
                    ?>
                        <input type="checkbox" id="1" name="dias[]" class="filled-in chk-col-red" value=1 <?php if(in_array(1, $miarray)) {echo "checked";} else{ echo "";} ?>/>
                        <label for="1">Lunes</label>                                
                        <input type="checkbox" id="2" name="dias[]" class="filled-in chk-col-indigo" value=2 <?php if(in_array(2, $miarray)) {echo "checked";} else{ echo "";} ?>/>
                        <label for="2">Martes</label>
                        <input type="checkbox" id="3" name="dias[]" class="filled-in chk-col-blue" value=3 <?php if(in_array(3, $miarray)) {echo "checked";} else{ echo "";} ?>/>
                        <label for="3">Miércoles</label>                                
                        <input type="checkbox" id="4" name="dias[]" class="filled-in chk-col-green" value=4 <?php if(in_array(4, $miarray)) {echo "checked";} else{ echo "";} ?>/>
                        <label for="4">Jueves</label>                                
                        <input type="checkbox" id="5" name="dias[]" class="filled-in chk-col-yellow" value=5 <?php if(in_array(5, $miarray)) {echo "checked";} else{ echo "";} ?>/>
                        <label for="5">Viernes</label>                                
                        <input type="checkbox" id="6" name="dias[]" class="filled-in chk-col-orange" value=6 <?php if(in_array(6, $miarray)) {echo "checked";} else{ echo "";} ?>/>
                        <label for="6">Sabado</label>                                
                    
                    </div>

            <hr>
            <button type="button" class="btn btn-danger" name="eliminar_evento" id="borrar">Eliminar</button>

            <script type="text/javascript">
                $(function () {
                    $('#from').datetimepicker({
                        language: 'es',
                        minDate: new Date()
                    });
                    $('#to').datetimepicker({
                        language: 'es',
                        minDate: new Date()
                    });

                    $("#borrar").on('click', function(){
                        //alert("<?php echo $id; ?>");
                        var idtabla  = "<?php echo $id; ?>";                        
                        alertify.confirm( 'Desea borrar este registro?', function (e) {
                            if (e) {
                                //after clicking OK
                                $.ajax({
                                    data : {"pidtabla": idtabla},
                                    type: "POST",
                                    dataType: "html",
                                    url : "borrarEvento.php",
                                })  
                                .done(function( dataX, textStatus, jqXHR ){                       
                                    var respstr = dataX;        
                                    if( respstr == "S" )
                                    {            
                                        //$("#form_validation").hide();
                                        //$("#mensaje").show();
                                        window.location.href = "index.php";
                                    }
                                    else
                                    {                    
                                         $("#mensaje").hide();
                                         $("#form_validation").show();
                                         $("#msj").html('<div class="alert alert-danger"><span class="glyphicon-hand-right"></span><strong>  Atención: </strong> Programación NO Borrada.</div>').fadeIn(3000);                    
                                    }
                                })
                                .fail(function( jqXHR, textStatus, errorThrown ) {
                                    //e.stopPropagation();
                                    if ( console && console.log ) 
                                    {                       
                                        console.log( "La solicitud a fallado: " +  textStatus);
                                        $("#msj").html("");
                                    }
                                });
                            } 
                            else {
                                //after clicking Cancel
                            }
                        });
                     });                    
                });
            </script>
        </form>        
    </div>
</body>
<!-- <form action="" method="post">
    <button type="submit" class="btn btn-danger" name="eliminar_evento">Eliminar</button>
</form> -->
</html>
<?php 
mysqli_free_result($rs_tipo_suctabla);
mysqli_free_result($rs_tipo_proftabla);
mysqli_free_result($rs_tipo_saltabla);
mysqli_free_result($rs_tipo_mattabla);
mysqli_free_result($rs_tipo_hortabla);
mysqli_free_result($rs_tipo_nivtabla);
mysqli_free_result($rs_tipo_vtabla);
 ?>
