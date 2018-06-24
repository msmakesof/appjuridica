<?php require_once('../../Connections/cnn_kn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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
$idTabla = 0;
if( isset($_GET['f'])  && !empty($_GET['f']) )
{    
    $idTabla = trim($_GET['f']);
}
$Tabla ="ESTUDIANTES";
$strowreg =0;
$idtabla = 0;
$row_rs_tabla = 0;
$Nombreciudad = "";
$Estado = "";
$SucursalEST = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_atabla = "SELECT IdEstudiante, IdNivel, Estado, fechacierre, EstadoCierre FROM nivelasignado WHERE IdEstudiante = $idTabla AND Estado = 1; "; 
//echo "qry_usu......$query_rs_atabla" ;
$rs_atabla = mysqli_query($cnn_kn, $query_rs_atabla) or die(mysqli_error()."Err.....$query_rs_atabla<br>");
$row_rs_atabla = mysqli_fetch_assoc($rs_atabla);
$totalRows_rs_atabla = mysqli_num_rows($rs_atabla);

$nivelasignado = "";
$EstadoCierre= 1;
if($totalRows_rs_atabla > 0)
{
    $nivelasignado = $row_rs_atabla['IdNivel'];
    $Estado = $row_rs_atabla['Estado'];
    $EstadoCierre = $row_rs_atabla['EstadoCierre'];    
}

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_nivtabla = "SELECT IdNivel, NombreNivel FROM nivel WHERE Estado = 1 ORDER BY NombreNivel;";
$rs_tipo_nivtabla = mysqli_query($cnn_kn,$query_rs_tipo_nivtabla) or die(mysqli_error()."$query_rs_tipo_nivtabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tabla = "SELECT IdEstudiante, TipoDocumento_EST, NumeroDocumento_EST,  concat_WS(' ',Nombres_EST, Apellido1_EST, Apellido2_EST) as nomestud, Email_EST, Estado_EST, Usuario_EST, Clave_EST, IdCiudad_EST, Direccion_EST, Celular_EST, TelefonoFijo_EST, Sucursal_EST FROM estudiante WHERE IdEstudiante = $idTabla ;" ;
//echo "qry_usu......$query_rs_tabla" ;
mysqli_set_charset($cnn_kn,"utf8");
$rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err.....$query_rs_tabla<br>");
$row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
$totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

	$idtabla = $row_rs_tabla["IdEstudiante"];
    $NumeroDocumento = trim($row_rs_tabla['NumeroDocumento_EST']);
    $NombreAlumno = trim($row_rs_tabla['nomestud']);       
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Preloader Css -->
    <link href="../../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../../css/themes2/alertify.default.css" id="toggleCSS" />
</head>

<body class="theme-indigo">
      
     <section class="content" style="margin-top:15px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORMULARIO: Asignación Actual de Nivel por Estudiante.
                    <!--<small>Editar.</small>-->
                </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row info-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">                        
                        <div class="body  table-responsive">
                            <form id="form_validation" method="POST">
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Número Documento y Nombre Estudiante</label>
                                    <div class="xform-line">
                                       <input type="text" class="form-control" name="numerodocumento" id="numerodocumento" value="<?php echo $NumeroDocumento .' - '. strtoupper($NombreAlumno) ;?>" maxlength="13" required>
                                    </div>
                                </div>                                

                                <hr style="margin-top: -25px;">
                                <div style="padding: 7px;"></div> 
                                <div class="form-group" style="margin-top: -11px; margin-bottom: -5px;">
                                      <span style="color:#0a5d99; padding-bottom: 10px; margin-top: -35px;">Seleccione Nivel a Asignar: </span>
                                    <div class="demo-radio-button">
                                        <div class="demo-radio-button">
                                        <!-- 
                                            <input name="group1" type="radio" class="with-gap" id="radio_1" value="1" <?php if($nivelasignado == 1) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_1">Nivel - 1</label>
                                            <input name="group1" type="radio" class="with-gap" id="radio_2" value="2" <?php if($nivelasignado == 2) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_2">Nivel - 2</label>
                                            <input name="group1" type="radio" class="with-gap" id="radio_3" value="3" <?php if($nivelasignado == 3) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_3">Nivel - 3</label>
                                            <input name="group1" type="radio" class="with-gap" id="radio_4" value="4" <?php if($nivelasignado == 4) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_4">Nivel - 4</label>
                                            <input name="group1" type="radio" class="with-gap" id="radio_5" value="5" <?php if($nivelasignado == 5) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_5">Nivel - 5</label>
                                            <input name="group1" type="radio" class="with-gap" id="radio_6" value="6" <?php if($nivelasignado == 6) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_6">Nivel - 6</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_7" value="7" <?php if($nivelasignado == 7) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_7">Nivel - 7</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_8" value="8" <?php if($nivelasignado == 8) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_8">Nivel - 8</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_9" value="9" <?php if($nivelasignado == 9) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_9">Nivel - 9</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_10" value="10" <?php if($nivelasignado == 10) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_10">Nivel - 10</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_11" value="11" <?php if($nivelasignado == 11) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_11">Nivel - 11</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_12" value="12" <?php if($nivelasignado == 12) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_12">Nivel - 12</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_13" value="13" <?php if($nivelasignado == 13) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_13">Nivel - 13</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_14" value="14" <?php if($nivelasignado == 14) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_14">Nivel - 14</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_15" value="15" <?php if($nivelasignado == 15) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_15">Nivel - 15</label> 
                                            <input name="group1" type="radio" class="with-gap" id="radio_16" value="16" <?php if($nivelasignado == 16) {echo 'checked';} else{ echo ''; } ?> />
                                            <label for="radio_16">Nivel - 16</label>                                             
                                             -->
                                            <?php 
                                                do {
                                                    $idradio =$row_rs_tipo_nivtabla['IdNivel'];
                                                    $nomradio  =$row_rs_tipo_nivtabla['NombreNivel'];
                                            ?>
                                                <div style="float: left; width: 190px;">
                                                <input name="group1" type="radio" class="with-gap" id="radio_<?php echo $idradio; ?>"  value="<?php echo $idradio; ?>" <?php if($nivelasignado == $idradio) {echo 'checked';} else{ echo ''; } ?> />
                                                <label for="radio_<?php echo $idradio; ?>"><?php echo $nomradio; ?></label>
                                            </div>
                                            <?php 
                                                }  while($row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla));
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group" style="clear:both; padding-bottom: 12px; padding-top: 12px;">

                                    <span style="color:#0a5d99; padding-bottom: 5px;">Seleccione Estado: </span>
                                    <br>
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $Estado == 1){?>checked="checked"<?php } else{ echo ''; } ?>>
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2"<?php if( $Estado == 2){?>checked="checked"<?php } else{ echo ''; } ?>>
                                    <label for="inactivo" class="m-l-20">Inactivo</label> <br>                                   
                                    <div style="padding: 12px;"></div>                               

                                <div class="form-group" style="clear:both; padding-top: -10px;"> 
                                    <span style="color:#0a5d99; padding-bottom: 5px;">Situaci&oacute;n Actual: </span>
                                    <br>
                                    <input type="radio" name="estadocierre" id="abierto" class="with-gap" value="1" <?php if( $EstadoCierre == 1){?>checked="checked"<?php } else{ echo ''; } ?>>
                                    <label for="abierto">Abierto</label>

                                    <input type="radio" name="estadocierre" id="cerrado" class="with-gap" value="2" <?php if( $EstadoCierre == 2){?>checked="checked"<?php } else{ echo ''; } ?>>
                                    <label for="cerrado" class="m-l-20">Cerrado</label>                                    
                                </div>
                                 <hr>                              
                                <button class="btn btn-primary waves-effect" type="button" id="grabar" style="margin-top:-20px;">GRABAR</button>
                                
                            </form>                        
                            <div id="msj" style="margin-top:7px;"></div>

                             <form id="mensaje">
                             <lael style="font-family: Verdana; font-size: 18; color:red;">Registro ha sido borrado correctamente.</lael>
                            </form>

                    	</div> 
                	</div>                    
                </div>               	           
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>

        <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Jquery Validation Plugin Css -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>
    <!-- JQuery Steps Plugin Js -->
    <script src="../../plugins/jquery-steps/jquery.steps.js"></script>
    <!-- Sweet Alert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/form-validation.js"></script>
    <script src="../../plugins/jquery-validation/localization/messages_es.js"></script>
    <script src="../../js/pages/ui/dialogs.js"></script>
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
    <script src="../../js/alertify.min.js"></script>
    <script src="../../js/jquery.numeric.js"></script>

    <script type="text/javascript">    
    $(document).ready(function()
	{			
		$("#mensaje").hide();
        $("#form_validation").show(); 

        $("#form_validation").click(function() {
			$("#msj").html("");
		})
		
		$("#grabar").on('click', function(e) {
            $("#mensaje").hide();           
            
			var idtabla =  "<?php echo $idtabla; ?>";
            if( idtabla == "" || $('input[type="radio"]:checked').length == "0" )
            {
               //swal("Atencion:", "Estudiante " + nombre + " !Ya se encuentra registrado(a)...");
                swal({
                  title: "Error:  Debe seleccionar un Nivel y/o un Estado...",
                  text: "un momento por favor.",
                  imageUrl: "../../js/sweet/2.gif",
                  timer: 2000,
                  showConfirmButton: false
                });
                return false;
            }
            else
            {
                //var nivel= $("[name='group1']:checked").val();
                var nivel= $('input:radio[name=group1]:checked').val();
                var estado = $('input:radio[name=estado]:checked').val();  
                var estadocierre = $('input:radio[name=estadocierre]:checked').val();                
                //alert(nivel);
    			$.ajax({
    				data : {"nivel": nivel, "idtabla": idtabla, "estado": estado, "estadocierre": estadocierre },
    				type: "POST",				
    				url : "editar_asignanivel.php",
                })  
    			.done(function( dataX, textStatus, jqXHR ){	
    			    // 				
    				var respstr = dataX;
    				
    				if( respstr == "S" )
                    {
                        $("#msj").html('<div class="alert alert-info"><span class="glyphicon glyphicon-ok"></span><strong>  Atención: </strong> Nivel Asignado Correctamente.</div>').fadeOut(4000).delay(2000);                    
                    }
    				else
    				{					
                        $("#msj").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span><strong>  Atención: </strong> Registro NO modificado.  Debe seleccionar Nivel y Estado.</div>').fadeIn(3000);                     
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
		});

	
        // $("#borrar").on('click', function() {   

        //     var idtabla  = "<?php echo $idtabla; ?>";
        //     //alert(idtabla);
        //     var nomtabla = "<?php echo $NombreAlumno; ?>";

        //     alertify.confirm( 'Desea borrar este registro?', function (e) {
        //         if (e) {
        //             //after clicking OK
        //             $.ajax({
        //                 data : {"pidtabla": idtabla},
        //                 type: "POST",
        //                 dataType: "html",
        //                 url : "../forms/borrar_estudiante.php",
        //             })  
        //             .done(function( dataX, textStatus, jqXHR ){                       
        //                 var respstr = dataX;        
        //                 if( respstr == "S" )
        //                 {            
        //                     $("#form_validation").hide();
        //                     $("#mensaje").show();                    
        //                 }
        //                 else
        //                 {                    
        //                      $("#mensaje").hide();
        //                      $("#form_validation").show();
        //                      $("#msj").html('<div class="alert alert-danger"><span class="glyphicon-hand-right"></span><strong>  Atención: </strong> <?php echo $Tabla; ?> NO Borrada.</div>').fadeIn(3000);                    
        //                 }
        //             })
        //             .fail(function( jqXHR, textStatus, errorThrown ) {
        //                 //e.stopPropagation();
        //                 if ( console && console.log ) 
        //                 {                       
        //                     console.log( "La solicitud a fallado: " +  textStatus);
        //                     $("#msj").html("");
        //                 }
        //             });
        //         } 
        //         else {
        //             //after clicking Cancel
        //         }
        //     });
        //  });
    });
    </script>    
</body>

</html>
<?php
mysqli_free_result($rs_atabla);
mysqli_free_result($rs_tabla);
mysqli_free_result($rs_tipo_nivtabla);
mysqli_close($cnn_kn);
?>