<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
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

require_once('../../apis/general/ciudadesxdepto.php');

$idTabla = ""; 
if ( isset( $_GET["id"]))
{ 
    $idTabla = $_GET["id"];
}

$Tabla ="ACTUACIONPROCESAL";
$strowreg =0;
$idtabla = 0;
$row_rs_tabla = 0;
$Nombreciudad = "";
$yy = date("Y");

require_once('../../apis/proceso/proceso.php');

$idtabla = $mproceso['pro_proceso']['PRO_IdProceso'];
$IdDemandante = $mproceso['pro_proceso']['PRO_IdDemandante'];
$IdDemandado = trim($mproceso['pro_proceso']['PRO_IdDemandado']);
$NumeroProceso = trim($mproceso['pro_proceso']['PRO_NumeroProceso']);
$nroproceso = substr($NumeroProceso,16,5);
$FechaInicio = trim($mproceso['pro_proceso']['PRO_FechaInicio']);
$FechaInicio = date('Y-m-d', strtotime($FechaInicio));
$IdUsuario = trim($mproceso['pro_proceso']['PRO_IdUsuario']);
$IdUbicacion = trim($mproceso['pro_proceso']['PRO_IdUbicacion']);
$IdClaseProceso = trim($mproceso['pro_proceso']['PRO_IdClaseProceso']);
$IdJuzgadoOrigen = trim($mproceso['pro_proceso']['PRO_IdJuzgadoOrigen']);
$EstadoProceso = trim($mproceso['pro_proceso']['PRO_EstadoProceso']);
$IdArea = $mproceso['pro_proceso']['PRO_IdArea']; // Areaa o Especialidad
$IdJuzgado = trim($mproceso['pro_proceso']['PRO_IdJuzgado']);

$FechaCierre = trim($mproceso['pro_proceso']['PRO_FechaCierre']);
$ObservacionCierre = trim($mproceso['pro_proceso']['PRO_ObservacionCierre']);
$IdUsuarioCierre = trim($mproceso['pro_proceso']['PRO_IdUsuarioCierre']);
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


    <!--  --> <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
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
	<script src="../../fc/js/bootstrap-datetimepicker.js"></script>    
	<script src="../../fc/js/bootstrap-datetimepicker.es.js"></script>
	<link rel="stylesheet" href="../../fc/css/bootstrap-datetimepicker.min.css" />	
</head>

<body class="theme-red">

    <section class="xxcontent" >
        <div class="container-fluid">            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body  table-responsive">
                            <form id="form_validation" method="POST">

                                <!-- <div class="form-group" style="clear: both; margin-top:15px;"> -->
									<div class="form-group">
										<div class="col-lg-12 col-md-12 col-sm-12">
											
											<div class="col-lg-2 col-md-2 col-sm-2">
												<div class="row">
													<label class="form-label">Fecha</label>												
													<div class='input-group date form-line' name="fechainicio" id="fechainicio" required>
														<input type='text' id="txtFechaInicio" name="txtFechaInicio" class="form-control" readonly/>
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div>																																	
												</div>
											</div>

											<div class="col-lg-1 col-md-1 col-sm-1">
												<div class="row">&nbsp;
												</div>
											</div>	
									
											<div class="col-lg-8 col-md-8 col-sm-8">
												<div class="row">												                                                
													<label class="form-label" style="font-size: 12;">Actuación Procesal:</label>
													<div class="xform-line">													    
														
														<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="actpro" id="actpro" required>
														<option value="" >Seleccione Actuación Procesal...</option>
														<?php                                                             
															$idTabla = 0;
															require_once('../../apis/proceso/tipoactuacionprocesal.php');
															for($i=0; $i<count($mtipoactuacionprocesal['pro_tipoactuacionprocesal']); $i++)
															{
																$TAP_IdTipoActuacionProcesal = $mtipoactuacionprocesal['pro_tipoactuacionprocesal'][$i]['TAP_IdTipoActuacionProcesal'];
																$TAP_Nombre = $mtipoactuacionprocesal['pro_tipoactuacionprocesal'][$i]['TAP_Nombre'];															
														?>
																<option value="<?php echo $TAP_IdTipoActuacionProcesal; ?>" <?php if ($TAP_IdTipoActuacionProcesal == $ciudadproceso){ echo "selected";} else{ echo "";} ?>>
																	<?php echo $TAP_Nombre ; ?>                                                
																</option>
														<?php
															}
														?>
														</select>
													</div>												
												</div>
											</div>
										</div>
                                    </div>
									
									<div class="form-group">
										<div class="col-lg-12 col-md-12 col-sm-12">									
											<div class="col-lg-2 col-md-2 col-sm-2">
												<div class="row">											
													<label class="form-label">Fecha Estado:</label>												
													<div class='input-group date form-line' name="fechaestado" id="fechaestado" required>
														<input type='text' id="txtFechaEstado" class="form-control"/>
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div>												
												</div>
											</div>
												
											<div class="col-lg-1 col-md-1 col-sm-1">
												<div class="row">&nbsp;
												</div>
											</div>
																		   
											<div class="col-lg-9 col-md-9 col-sm-9">
												<div class="row">																						
													<label class="form-label">Observaciones:</label>
													<div class="form-line">
														<input type="input" class="form-control" name="observacion" id="observacion" maxlength="90" autocomplete="off" required>
													</div>
													<div style="font-size:11px; text-align:right;width: 80%">
														Caracteres: <span id="muestrocantidadcaracteresid">0</span> de 90
													</div>														
												</div>
											</div>	
										</div>
									</div>						
								
                               
                                <!-- <div class="form-group" style="clear: both; margin-top:10px; margin-bottom:10px;"> -->
								<div class="form-group" style="clear: both; margin-top:-10px !important">
                                    <div class="col-lg-12 col-md-12 col-sm-12">                                
                                        <div class="row">
                                            <div class="col-sm-8">	
                                                <button class="btn btn-success waves-effect" type="button" id="grabar">GRABAR</button>
                                                <button type="submit" class="btn btn-danger waves-effect" id="salir">SALIR</button>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
								<hr>																
                            </form>                        
                            <div id="msj" style="margin-top:7px;"></div>                            

                    	</div> 
                	</div>                    
                </div>               	           
            </div>
            <!-- #END# Basic Validation -->			
        </div>
    </section>	  

    <script type="text/javascript">
    function init_contador(idtextarea, idcontador)
    {        
        var contador = $(idcontador);		
		var nro = $(idtextarea).val().length;		
		if(nro <= 90)
		{	
			contador.html( nro );
		}
    }
	
    $(document).ready(function()
	{			
		$("#mensaje").hide();
        $("#form_validation").show();
        $('#proceso').numeric();       
        $('.selectpicker').selectpicker();
		var exclude_dates = ['2019-04-18', '2019-04-19'];
		var disabledWeekDays = [0,6];
        $('#fechainicio').datetimepicker({
			language: 'es',											
			daysOfWeekDisabled: [0, 6],
			datesDisabled: exclude_dates,			
			autoclose: true,
			defaultDate: new Date(),
			minDate: new Date(),
			format: 'YYYY-MM-DD',
			viewMode: 'days'		  
        });
		
		$('#fechaestado').datetimepicker({
			language: 'es',											
			daysOfWeekDisabled: [0, 6],
			datesDisabled: exclude_dates,			
			autoclose: true,
			defaultDate: new Date(),
			minDate: new Date(),
			format: 'YYYY-MM-DD',
			viewMode: 'days'		  
        });		
		
		
		$('#observacion').keypress(function() {
			init_contador("#observacion","#muestrocantidadcaracteresid");
		});		
              

        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'pro_proceso.php';
        }); 

        		
		$("#grabar").on('click', function(e) {
			e.preventDefault();
            $("#mensaje").hide();
            var fechainicio = $("#txtFechaInicio").val();            
            var actpro = $("#actpro").val();
            var fechaestado = $("#txtFechaEstado").val();            
            var observacion = $("#observacion").val();
			var idproceso = "<?php echo $idtabla; ?>";		
			
            if( fechainicio == "" || actpro == "" || fechaestado == "" ||  observacion == "" )
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
    				data : {"idproceso": idproceso, "fechainicio": fechainicio, "actpro": actpro, "fechaestado": fechaestado, "observacion": observacion},
    				type: "POST",				
    				url : "../forms/crea_<?php echo strtolower($Tabla); ?>.php",
                })  
    			.done(function( dataX, textStatus, jqXHR ){	    			    
    				var xrespstr = dataX.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);   				
    				if( respstr == "S" )
                    {
                        swal("Atención: ", msj, "success");						
						$("#mks").load("../forms/tablaactpro.php?pidtabla="+idproceso);	
						$("#form_validation")[0].reset();
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
        
        
        $("#salir").on('click', function(e) {
            e.preventDefault();
            window.location = '../tables/pro_proceso.php';
        });
    });
    </script>    
</body>
</html>