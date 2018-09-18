<?php 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
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




if( isset($_GET['f'])  && !empty($_GET['f']) )
{    
    $idTabla = trim($_GET['f']);
}
$Tabla ="PROCESO";
$strowreg =0;
$idtabla = 0;
$row_rs_tabla = 0;
$Nombreciudad = "";

require_once('../../apis/proceso/proceso.php');

$idtabla = $mproceso['pro_proceso']['PRO_IdProceso'];
$IdDemandante = $mproceso['pro_proceso']['PRO_IdDemandante'];
$IdDemandado = trim($mproceso['pro_proceso']['PRO_IdDemandado']);
$NumeroProceso = trim($mproceso['pro_proceso']['PRO_NumeroProceso']);
$FechaInicio = trim($mproceso['pro_proceso']['PRO_FechaInicio']);
$FechaInicio = date('Y-m-d', strtotime($FechaInicio));
$IdUsuario = trim($mproceso['pro_proceso']['PRO_IdUsuario']);
$IdUbicacion = trim($mproceso['pro_proceso']['PRO_IdUbicacion']);
$IdClaseProceso = trim($mproceso['pro_proceso']['PRO_IdClaseProceso']);
$IdJuzgadoOrigen = trim($mproceso['pro_proceso']['PRO_IdJuzgadoOrigen']);
$EstadoProceso = trim($mproceso['pro_proceso']['PRO_EstadoProceso']);
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

    <!-- DateTime Picker -->
    <link href="../../calendar/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

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
    <style>
        .caja
        {
            margin-top:-10px;
        }
        .cajax
        {
            margin-top:10px;
        }

        .rowx
        {
            margin-bottom:-24px !important;
        }
    </style>
</head>

<body class="theme-indigo">
      
     <section class="content" style="margin-top:5px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORMULARIO: Edición <?php echo $Tabla; ?>.
                    <!--<small>Editar.</small>-->
                </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row info-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <!--<div class="header">
                            <h2>REGISTRO EDICION DE ESTUDIANTES.</h2>
                             <ul class="header-dropdown m-r--5">
                               <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>                                    
                                </li>
                            </ul>
                        </div>-->
                        <div class="body  table-responsive">
                            <form id="form_validation" method="POST">

                                <div class="form-group">
									<div class="col-xs-12 cajax">
                                        <div class="row rowx">
											<div class="col-sm-6">
												<label class="form-label">C&oacute;digo &Uacute;nico del Proceso:</label>
												<div class="form-line">
													<input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="proceso" id="proceso" value="<?php echo $NumeroProceso; ?>" maxlength="23" required />                                                    
												</div>
                                                <div style="font-size:11px;">
                                                        Caracteres: <span id="muestrocantidadcaracteresid">0</span> de 23
                                                    </div>
											</div>
											
											<div class="col-sm-6">
												<label class="form-label">Fecha Inicio</label>												
												<div class='input-group date form-line' name="fechainicio" id="fechainicio" required>
													<input type='text' id="txtFecha" class="form-control" value="<?php echo $FechaInicio ;?>" readonly/>
													<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
													</span>
												</div>
											</div>																						
										</div>
									</div>	
                                </div>


                                <div class="xform-group">
                                    <div class="col-xs-12">
										<div class="row rowx">											
											<div class="col-sm-8">
                                                <label class="form-label">Asignado a:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="usuario" id="usuario" required>
												<option value="" >Seleccione Asignado...</option>
												<?php
                                                    $idTabla = 0;
                                                    require_once('../../apis/usuario/infoUsuario.php');
													for($i=0; $i<count($muser['usu_usuario']); $i++)
													{
														$USU_IdUsuario = $muser['usu_usuario'][$i]['USU_IdUsuario'];                                                
														$USU_Nombre = $muser['usu_usuario'][$i]['NombreUsuario'];                                                
												?>
														<option value="<?php echo $USU_IdUsuario; ?>" <?php if ($USU_IdUsuario == $IdUsuario){ echo "selected";} else{ echo "";} ?>>
															<?php echo $USU_Nombre ; ?>                                                
														</option>
												<?php
													}
												?>
												</select>
											</div>
										</div>	
                                    </div>                                       
                                </div>

                                <div class="xform-group form-float" style="clear: both;">
                                    <div class="col-xs-12">
                                        <div class="row rowx">
                                            <div class="col-sm-6">
                                                <label class="form-label">Ubicación:</label>                                                                                   
                                                <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="ubicacion" id="ubicacion" required>
                                                <option value="" >Seleccione Ubicación...</option>
                                                <?php
                                                    $idTabla = 0;
                                                    require_once('../../apis/proceso/ubicacion.php');
                                                    for($i=0; $i<count($mubicacion['pro_ubicacion']); $i++)
                                                    {
                                                        $UBI_IdUbicacion = $mubicacion['pro_ubicacion'][$i]['UBI_IdUbicacion'];                                                
                                                        $UBI_Nombre = $mubicacion['pro_ubicacion'][$i]['UBI_Nombre'];                                                
                                                ?>
                                                        <option value="<?php echo $UBI_IdUbicacion; ?>" <?php if ($UBI_IdUbicacion == $IdUbicacion){ echo "selected";} else{ echo "";} ?>>
                                                            <?php echo $UBI_Nombre ; ?>                                                
                                                        </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="xform-group form-float" style="clear: both;">
                                    <div class="col-xs-12">
                                        <div class="row rowx">
                                            <div class="col-sm-8">
                                                <label class="form-label">Clase Proceso:</label>                                                
                                                    <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="claseproceso" id="claseproceso" required>
                                                    <option value="" >Seleccione Clase Proceso...</option>
                                                    <?php
                                                        $idTabla = 0;
                                                        require_once('../../apis/proceso/claseproceso.php');
                                                        for($i=0; $i<count($mclaseproceso['pro_claseproceso']); $i++)
                                                        {
                                                            $CPR_IdClaseProceso = $mclaseproceso['pro_claseproceso'][$i]['CPR_IdClaseProceso'];                                                
                                                            $CPR_Nombre = $mclaseproceso['pro_claseproceso'][$i]['CPR_Nombre'];                                                
                                                    ?>
                                                            <option value="<?php echo $CPR_IdClaseProceso; ?>" <?php if ($CPR_IdClaseProceso == $IdClaseProceso){ echo "selected";} else{ echo "";} ?>>
                                                                <?php echo $CPR_Nombre ; ?>                                                
                                                            </option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="xform-group">
                                    <div class="col-xs-12">
										<div class="row rowx">											
											<div class="col-sm-8">
                                                <label class="form-label">Demandante:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="demandante" id="demandante" required>
												<option value="" >Seleccione Cliente...</option>
												<?php
                                                    $idTabla = 0;
                                                    require_once('../../apis/cliente/infoCliente.php');
													for($i=0; $i<count($mcliente['cli_cliente']); $i++)
													{
														$CLI_IdCliente = $mcliente['cli_cliente'][$i]['CLI_IdCliente'];                                                
														$CLI_Nombre = $mcliente['cli_cliente'][$i]['NombreUsuario'];                                                
												?>
														<option value="<?php echo $CLI_IdCliente; ?>" <?php if ($CLI_IdCliente == $IdDemandante){ echo "selected";} else{ echo "";} ?>>
															<?php echo $CLI_Nombre ; ?>                                                
														</option>
												<?php
													}
												?>
												</select>
											</div>
										</div>	
                                    </div>
                                </div>

                                <div class="xform-group">
                                    <div class="col-xs-12">
										<div class="row rowx">											
											<div class="col-sm-8">
                                                <label class="form-label">Demandado:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="demandado" id="demandado" required>
												<option value="" >Seleccione Demandado...</option>
												<?php
                                                    $idTabla = 0;
                                                    require_once('../../apis/cliente/infoCliente.php');
													for($i=0; $i<count($mcliente['cli_cliente']); $i++)
													{
														$CLI_IdCliente = $mcliente['cli_cliente'][$i]['CLI_IdCliente'];                                                
														$CLI_Nombre = $mcliente['cli_cliente'][$i]['NombreUsuario'];                                                
												?>
														<option value="<?php echo $CLI_IdCliente; ?>" <?php if ($CLI_IdCliente == $IdDemandado){ echo "selected";} else{ echo "";} ?>>
															<?php echo $CLI_Nombre ; ?>                                                
														</option>
												<?php
													}
												?>
												</select>
											</div>
										</div>	
                                    </div>                                       
                                </div>

                                
                                <div class="form-group">
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $EstadoProceso == 1){?>checked="checked"<?php } ?>>
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2"<?php if( $EstadoProceso == 2){?>checked="checked"<?php } ?>>
                                    <label for="inactivo" class="m-l-20">Inactivo</label>                                    
                                </div>
								
                                <hr>
                                <div class="form-group" style="clear: both; margin-top:10px; margin-bottom:10px;">
									<button class="btn btn-primary waves-effect" type="button" id="grabar">GRABAR</button>
								   <!--  <button type="button" class="btn btn-danger waves-effect" id="borrar" onclick="borrarc(<?php echo $idtabla ; ?>);">BORRAR</button> -->
									<button type="button" class="btn btn-danger waves-effect" id="borrar">CERRAR</button>
								</div>
								
                            </form>                        
                            <div id="msj" style="margin-top:7px;"></div>
                             <form id="mensaje">
                             <label style="font-family: Verdana; font-size: 18; color:red;">Registro ha sido borrado correctamente.</label>
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
    <script src="../../js/sweet/functions.js"></script>
    <script src="../../js/sweet/sweetalert.min.js"></script>
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

    <!-- DateTime picker -->
    <script src="../../calendar/js/moment.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.es.js"></script>  

    <script type="text/javascript"> 

    function init_contador(idtextarea, idcontador)
    {
        function update_contador(idtextarea, idcontador)
        {
            var contador = $(idcontador);
            var ta = $(idtextarea);
            contador.html(ta.val().length);
        }

        $(idtextarea).keyup(function()
        {
            update_contador(idtextarea, idcontador);
        });

        $(idtextarea).change(function()
        {
            update_contador(idtextarea, idcontador);
        });            
    }

    $(document).ready(function()
	{			
		$("#mensaje").hide();
        $("#form_validation").show();
        $('#proceso').numeric();
        $('#anio').numeric();
        $('.selectpicker').selectpicker();
        $('#fechainicio').datetimepicker({
          format: 'YYYY-MM-DD'       
        });

        init_contador("#proceso","#muestrocantidadcaracteresid");        

        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'pro_proceso.php';
        }); 
        
		
		$("#grabar").on('click', function(e) {
            $("#mensaje").hide();
            var proceso = $("#proceso").val();            
            var fechainicio = $("#txtFecha").val();
            var asignadoa = $("#usuario").val();
            var ubicacion = $("#ubicacion").val();
            var claseproceso = $("#claseproceso").val();
            //juzgado = $("#juzgado").val();
            var demandante = $("#demandante").val();
            var demandado = $("#demandado").val();
            var estado = $('input:radio[name=estado]:checked').val();
            var idtabla = "<?php echo $idtabla; ?>";
            if( estado == undefined || proceso == "" || fechainicio == "" || asignadoa == "" || ubicacion == "" || claseproceso == "" || demandante == "" || demandado == "")
            {               
                swal({
                  title: "Error:  Ingrese información en todos los campos...",
                  text: "un momento por favor.",
                  imageUrl: "../../js/sweet/2.gif",
                  timer: 1500,
                  showConfirmButton: false
                });
                return false;
            }
            else
            {
    			$.ajax({
    				data : {"proceso": proceso, "fechainicio": fechainicio, "asignadoa": asignadoa, "ubicacion": ubicacion, "claseproceso": claseproceso, "demandante": demandante, "demandado": demandado, "estado": estado, "idtabla": idtabla },
    				type: "POST",				
    				url : "editar_<?php echo strtolower($Tabla); ?>.php",
                })  
    			.done(function( dataX, textStatus, jqXHR ){	    			    
    				var xrespstr = dataX.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);    				
    				if( respstr == "S" )
                    {
                        swal("Atención: ", msj, "success");
                        return false;
                    }
    				else
    				{
                        swal({
                            title: "Atención: ",   
                            text: msj,   
                            type: "error" 
                        });
                        return false;  
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

	
        $("#borrar").on('click', function() {
            var idtabla  = "<?php echo $idtabla; ?>";            
            var estado = 2;
            alertify.confirm( 'Desea Cerrar este Proceso?', function (e) {
                if (e) {
                    //after clicking OK
                    $.ajax({
                        data : {"pidtabla": idtabla, "estado": estado},
                        type: "POST",
                        dataType: "html",
                        url : "../forms/borrar_<?php echo strtolower($Tabla) ; ?>.php",
                    })  
                    .done(function( dataX, textStatus, jqXHR ){                       
                        var xrespstr = dataX.trim();
                        var respstr = xrespstr.substr(0,1);
                        var msj = xrespstr.substr(2);         
                        if( respstr == "S" )
                        {            
                            //$("#form_validation").hide();
                            //$("#mensaje").show();
                            swal("Atención: ", msj, "success");
                        }
                        else
                        {                    
                            //$("#mensaje").hide();
                            //$("#form_validation").show();
                            //$("#msj").html('<div class="alert alert-danger"><span class="glyphicon-hand-right"></span><strong>  Atención: </strong> <?php echo $Tabla; ?> NO Borrada.</div>').fadeIn(3000);
                            swal({
                                title: "Atención: ",   
                                text: msj,   
                                type: "error" 
                            });
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
</body>
</html>