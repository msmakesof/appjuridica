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


require_once('../../apis/general/ciudadesxdepto.php');

//echo $_REQUEST['hf'];
$idTabla = ""; 
if ( isset( $_POST["id"]))
{ 
    $idTabla = $_POST["id"];
}

//echo "post....".$idTabla;

$Tabla ="PROCESO";
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


//echo "IdJuzgado....$IdJuzgado";
//GLOBAL $deptoproceso ;GLOBAL $ciudadproceso ;
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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body  table-responsive">
                            <form id="form_validation" method="POST">

                                <!-- <div class="form-group" style="clear: both; margin-top:15px;"> -->
                                    
                                    <div class="form-group">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="row">
												<div class="xcol-xs-10">                                                
													<label class="form-label" style="font-size: 12;">C&oacute;digo DANE Departamento / Municipio:</label>
													<div class="xform-line">
                                                        <?php                                                      
                                                            $deptoproceso = substr($NumeroProceso,0,2);
                                                            $ciudadproceso = substr($NumeroProceso,2,3);                                                        
                                                        ?>    
														<!-- <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="zip" id="zip" min="1" max="99999" maxlength="5" required> -->
                                                        <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="zip" id="zip" required disabled="true">
                                                        <option value="" >Seleccione Municipio...</option>
                                                        <?php                                                             
                                                            $idTabla = 0;   //sxdepto
                                                            
                                                            for($i=0; $i<count($mciudad['gen_ciudad']); $i++)
                                                            {
                                                                $CIU_IdCiudades = $mciudad['gen_ciudad'][$i]['CIU_IdCiudades'];
                                                                $CIU_Nombre = $mciudad['gen_ciudad'][$i]['CIU_Nombre'];
                                                                $CIU_Abreviatura = $mciudad['gen_ciudad'][$i]['CIU_Abreviatura'];                                                                
                                                                $CIU_IdDepartamento = $mciudad['gen_ciudad'][$i]['CIU_IdDepartamento'];
                                                                $DEP_CodigoDane = $mciudad['gen_ciudad'][$i]['DEP_CodigoDane'];                                                                
                                                        ?>
                                                                <option value="<?php echo $CIU_Abreviatura; ?>" <?php if ($DEP_CodigoDane == $deptoproceso && $CIU_Abreviatura == $ciudadproceso){ echo "selected";} else{ echo "";} ?>>
                                                                    <?php echo $CIU_Nombre ; ?>                                                
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
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="row">
                                                <div class="xcol-xs-10">                
													<label class="form-label">Corporaci&oacute;n:</label>
                                                    <?php $corpoproceso = substr($NumeroProceso,5,2); ?>
													<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tipojuzgado" id="tipojuzgado" required  disabled="true">                                                       
													    <option value="" >Seleccione Corporaci&oacute;n...</option>
													    <?php                                                            
                                                            $idTabla = 0;
                                                            require_once('../../apis/general/tipojuzgado.php');
                                                            for($i=0; $i<count($mtipojuzgado['juz_tipojuzgado']); $i++)
                                                            {
                                                                $TJU_IdTipoJuzgado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_IdTipoJuzgado'];                                                    
                                                                $TJU_Nombre = trim($mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Nombre']);
                                                                $TJU_Codigo = trim($mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Codigo']);
                                                                $TJU_Estado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Estado'];
                                                        ?>
                                                            <option value="<?php echo $TJU_IdTipoJuzgado; ?>" <?php if (trim($TJU_Codigo) == trim($corpoproceso)){ echo "selected";} else{ echo "";} ?>>
                                                                <?php echo  $TJU_Codigo .'-'. $TJU_Nombre ; ?>                                                
                                                            </option>
                                                        <?php
                                                            }
                                                        ?>
													</select>                                                    
												</div>
											</div>
										</div>
									</div>                                
                                <!-- </div> -->

                                <div class="form-group">                               
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-xs-6">                                                
                                                <label class="form-label">Especialidad o &Aacute;rea:</label>                                                
                                                <!-- <input type="text" class="form-control" name="area" id="area" value="<?php //echo $JUZ_Area ;?>" maxlength="5" autocomplete="ÑÖcompletes" required> -->
                                                <select id="area" name="area" class="selectpicker show-tick" data-live-search="true" data-width="95%" required  disabled="true">
                                                    <!-- <option value="">-- Seleccione Especializacion.... --</option>                                                         -->
                                                </select>                                                                                                
                                            </div>
                                        </div>	
								    </div>
                                </div>    

                                            
                                <div class="form-group">                               
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">        
                                            <div class="xcol-xs-3">
                                                <label class="form-label">Despacho</label>
                                                <!-- <input type="text" class="form-control" name="despacho" id="despacho" value="" maxlength="3" autocomplete="ÑÖcompletes" required>
                                                <label class="form-label"></label> -->
                                                <select id="despacho" name="despacho" class="selectpicker show-tick" data-live-search="true" data-width="95%" required  disabled="true">
                                                    <option value="">-- Seleccione Despacho.... --</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>	
								</div>
                                            
                                            
                                <div class="form-group">                               
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="row">            
                                            <div class="ccol-xs-3">
                                                <label class="form-label">Año</label>                                        
                                                <div class="form-line" style="width: 20%">
                                                    <input type="text" class="form-control" name="anio" id="anio" value="<?php echo $yy; ?>" maxlength="4" autocomplete="ÑÖcompletes" required  disabled="true">
                                                    <label class="form-label"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="form-group">                                    
                                    <div class="col-lg-6 col-md-6 col-sm-5">
                                        <div class="row">
											<div class="xcol-xs-9">
												<label class="form-label">Nro. Consecutivo Radicaci&oacute;n:</label>
                                                <div class="form-line" style="width: 70%">
                                                    <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="nproceso" id="nproceso" value="<?php echo $nroproceso; ?>" min="1" max="99999" maxlength="5" autocomplete="off" required  disabled="true">
                                                </div>                                                    											
											</div>
                                        </div>	
									</div>	
								</div>

                                <div class="form-group">                                    
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="row">			
											<div class="xcol-xs-5">
												<label class="form-label">Control:</label>
                                                <div class="form-line" style="width: 35%">
                                                    <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="ndv"id="ndv" min="0" max="99" maxlength="2" autocomplete="off" required  disabled="true">
                                                </div>												
											</div>											
										</div>	
									</div>	
								</div>

                                <div class="form-group">
									<div class="col-lg-6 col-md-6 col-sm-5">
                                        <div class="row">
											<div class="xcol-sm-6">
												<label class="form-label">C&oacute;digo &Uacute;nico del Proceso:</label>
												<div class="form-line" style="width: 80%">
													<input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="proceso" id="proceso" value="<?php echo $NumeroProceso; ?>" maxlength="23" required />                                                    
												</div>
                                                <div style="font-size:11px; text-align:right;width: 80%">
                                                        Caracteres: <span id="muestrocantidadcaracteresid">0</span> de 23
                                                </div>
											</div>
                                        </div>
                                    </div>
                                </div>                                

                                <div class="form-group">
									<div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="row">											
											<div class="xcol-sm-6">
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


                                <div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
										<div class="row">											
											<div class="xcol-sm-8">
                                                <label class="form-label">Asignado a:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="usuario" id="usuario" required>
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

                                <div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-sm-6">
                                                <label class="form-label">Ubicación:</label>                                                                                   
                                                <select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="ubicacion" id="ubicacion" required>
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

                                <div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-sm-8">
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

                                <div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">											
											<div class="xcol-sm-8">
                                                <label class="form-label">Demandante:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="demandante" id="demandante" required>
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

                                <div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">											
											<div class="xcol-sm-8">
                                                <label class="form-label">Demandado:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="demandado" id="demandado" required>
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
                                    <div class="col-lg-9 col-md-9 col-sm-9">                                
                                        <div class="row">
                                            <div class="xcol-sm-8">
                                                <div class="form-group form-float" style="clear: both;">
                                                    <label class="form-label">Estado</label>
                                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $EstadoProceso == 1){?>checked="checked"<?php } ?>>
                                                    <label for="activo">Activo</label>

                                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2"<?php if( $EstadoProceso == 2){?>checked="checked"<?php } ?>>
                                                    <label for="inactivo" class="m-l-20">Inactivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
								
                                <hr>
                                <!-- <div class="form-group" style="clear: both; margin-top:10px; margin-bottom:10px;"> -->
								<div class="form-group">
                                    <div class="col-xs-9">                                
                                        <div class="row">
                                            <div class="col-sm-8">	
                                                <button class="btn btn-success waves-effect" type="button" id="grabar">GRABAR</button>
                                                <button class="btn btn-primary waves-effect" type="button" id="actoprocesal">ACTUACION PROCESAL</button>
                                                <!--  <button type="button" class="btn btn-danger waves-effect" id="borrar" onclick="borrarc(<?php echo $idtabla ; ?>);">BORRAR</button> -->
                                                <button type="button" class="btn btn-info waves-effect" id="borrar">CERRAR PROCESO</button>
                                                <button type="submit" class="btn btn-danger waves-effect" id="salir">SALIR</button>
                                            </div>
                                        </div>    
                                    </div>
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
    <script src="../../calendar/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.es.js"></script>  

    <script type="text/javascript">

    var nombre ="";
    var _zipDeptoCiudad = "";
    var _zip = "";
    var _tipojuzgado = "";
    var _juzgado = "";
    var _area = "";
    var _txtarea = "";
    var _despacho ="";
    var _nProceso = "";
    var _nDv = "";
    var _Proceso = "";
    var EspecialidadHTML ="";

    function populateFruitVariety() {
        //alert('popular...'+$('#tipojuzgado').val());
        //console.log('tipoJuzgado popular...'+$('#tipojuzgado').val());
        $.getJSON('../tables/urlink.php', {funcion: "ja", origen: $('#tipojuzgado').val()}, function (data) {
            var zdata= data.juz_areasxtipojuzgado;
            //console.log('fn ja...'+zdata);
            var selectedOption = '0';
            var newOptions = zdata;
            var select = $('#area');
            if(select.prop) 
            {
                var options = select.prop('options');
            }
            else 
            {
                var options = select.attr('options');
            }
            $('option', select).remove();

            $.each(newOptions, function(val, text) {
                options[options.length] = new Option(text.ARE_Nombre, text.ARE_Codigo);
            });
            select.val(selectedOption);
            $('#area').selectpicker('refresh');
            _area = $('#area').val();
            goDespachos();                 
            nroProceso();            
        });
    }

    function goDespachos() {
        var __area = $('#area').val();
        //alert("__area:..."+__area);
        if( __area == "" || __area == null)
        {
            //__area = _area;
            if(_area != "" && _area != null)
            {
                __area = _area;
            }
            else
            {
                __area = <?php echo $IdArea;?>;
            }            
        }
        //alert("_area goDespachos: ..."+__area);
        //alert('tipo Juzgado goDespachos: ....'+$('#tipojuzgado').val());
        
        if( __area != "" && __area != null)
        {
            //console.log('tipoJuzgado goDespacho..'+$('#tipojuzgado').val());
            $.getJSON('../tables/urlink.php', {funcion: "jd", origen: $('#tipojuzgado').val() +'-'+ __area }, function (data) {
                var zdata= data.juz_areasxjuzgado;
                //console.log('zdata_goDespacho..'+zdata);
                var selectedOption = '0';
                var newOptions = zdata;
                var select = $('#despacho');
                if(select.prop) 
                {
                    var options = select.prop('options');
                }
                else 
                {
                    var options = select.attr('options');
                }
                $('option', select).remove();
                $.each(newOptions, function(val, text) {
                    options[options.length] = new Option(text.JUZ_Ubicacion, text.JUZ_IdJuzgado);
                });
                select.val(selectedOption);
                $('#despacho').selectpicker('refresh');
                _txtdespacho = $('#despacho option:selected').text();
                _txtdespacho = _txtdespacho.trim();
                _despacho = _txtdespacho.substring(0, 3);
                nroProceso();
            });
        }    
    }
    
    
    function nroProceso(){
        _area = "";
        if(_tipojuzgado != "")
        {
            _area =  $("#area").val();
        }
        //alert("_area en nroProceso :..."+_area);
        if(_area != "")
        {
            _Proceso = _zipDeptoCiudad + _tipojuzgado + _area + _despacho + $("#anio").val() + _nProceso + _nDv;
            $("#proceso").attr("value",_Proceso);
            init_contador("#proceso","#muestrocantidadcaracteresid");
        }
    }
 

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

        populateFruitVariety();        

        init_contador("#proceso","#muestrocantidadcaracteresid");        

        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'pro_proceso.php';
        }); 

        $('#tipojuzgado').change(function() {
            populateFruitVariety();
            var nameARE_Codigo = $('#tipojuzgado option:selected').text();
            _tipojuzgado = nameARE_Codigo.trim();
            _tipojuzgado = _tipojuzgado.substring(0, 2);            
            nroProceso();            
        });

        $('#area').change(function() {
            goDespachos();
            nroProceso();            
        });

         $('#area').focusin(function() {           
            _area = $('#area').val();
            //alert('area focusin....'+_area);
            //console.log('_area IN'+_area);            
            nroProceso();        
        });

        $('#area').focusout(function() {           
            _area = $('#area').val();
            //alert('area focusout....'+_area);
            nroProceso();        
        });

        $("#ndv").val('00');
        //$("#actoprocesal").hide();


        if( $('#tipojuzgado').val() != "" )
        {
            $.ajax({                
                type: "GET",				
                url : "../../consultadetalle/consultadetalle_juzgado.php?IdMostrar=0",
            })
            .done(function( dataX, textStatus, jqXHR ){	
                var zdata= dataX.juz_juzgado;
                var xrespstr = "";
                var IdArea = "";
                var ARE_Nombre = "";
                var IdJuzgado = "";
                var Ubicacion = "";
                var IdCiudad = "";
                var IdTipoJuzgado = "";  

                var selectedOption = '0';
                var newOptions = zdata;
                var select = $('#area');                
                if(select.prop) 
                {
                    var options = select.prop('options');
                }
                else 
                {
                    var options = select.attr('options');
                }
                $('option', select).remove();

                $.each(newOptions, function(val, text) {
                    options[options.length] = new Option(text.ARE_Nombre, text.JUZ_IdArea);
                });
                select.val(selectedOption);
                $('#area').selectpicker('refresh');

                /*
                EspecialidadHTML+='<option value="">-- Seleccione Especializacion.... --</option>';              
                $.each(dataX.juz_juzgado, function(i, item) 
                {                        
                    IdArea = dataX.juz_juzgado[i].JUZ_IdArea;
                    ARE_Nombre = dataX.juz_juzgado[i].ARE_Nombre;
                    IdJuzgado = dataX.juz_juzgado[i].JUZ_IdJuzgado;
                    Ubicacion = dataX.juz_juzgado[i].JUZ_Ubicacion;
                    IdCiudad = dataX.juz_juzgado[i].JUZ_IdCiudad;                       
                    IdTipoJuzgado = dataX.juz_juzgado[i].JUZ_IdTipoJuzgado;
                    EspecialidadHTML+='<option value="'+IdArea+'">'+ ARE_Nombre +'</option>';
                    //var option = document.createElement("option");
                    //$(option).html(EspecialidadHTML);
                    //$(option).appendTo("#area"); 
                }); 
                */

                /*    
                if(EspecialidadHTML != "")
                {                    
                   // $('#area').append(EspecialidadHTML);
                   $(EspecialidadHTML).appendTo("#area"); 
                }
                else
                {
                    //$('#EspecialidadHTML').hide();
                }
                */

            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) 
                {						
                    console.log( "La solicitud a fallado: " +  textStatus);
                    $("#msj").html("");
                }
            });

            goDespachos();
            nroProceso(); 
        }
        
		
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
            //asignadoa == "" ||
            if( estado == undefined || proceso == "" || fechainicio == "" ||  ubicacion == "" || claseproceso == "" || demandante == "" || demandado == "")
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
    				url : "../forms/editar_<?php echo strtolower($Tabla); ?>.php",
                })  
    			.done(function( dataX, textStatus, jqXHR ){	    			    
    				var xrespstr = dataX.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);    				
    				if( respstr == "S" )
                    {
                        swal("Atención: ", msj, "success");
                        return false;
                        $("#actoprocesal").show();
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
            Swal.fire({
            title: 'Desea Cerrar este Proceso?',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                placeholder: 'Digite breve observaciòn...'
            },
            showCancelButton: true,
            confirmButtonText: 'Cerrar  !',
            cancelButtonText:  'Cancelar!', 
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return fetch(`//api.github.com/users/${login}`)
                .then(response => {
                    if (!response.ok) {
                    throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                    `Request failed: ${error}`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
            if (result.value) {
                Swal.fire({
                title: `${result.value.login}'s avatar`,
                imageUrl: result.value.avatar_url
                })
            }
            })
        })

        $("#xyborrar").on('click', function() {
            var idtabla  = "<?php echo $idtabla; ?>";            
            var estado = 2;
            //
            const swalWithBootstrapButtons = Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
            title: 'Desea Cerrar este Proceso?',
            text: "Digite breve observaciòn sobre el cierre.",
            type: 'question',
            html: '<textarea id="observacion" name="observacion" placeholder="Digite breve observaciòn..." maxlength="150" rows="4" cols="40" autocomplete="off" required></textarea>',            
            showCancelButton: true,
            confirmButtonText: 'Cerrar..!',
            cancelButtonText:  'Cancelar!',            
            reverseButtons: true,
            showLoaderOnConfirm: true,  
                    //
                    preConfirm: (observacion) => {
                        return fetch('../forms/cerrar_<?php echo strtolower($Tabla) ; ?>.php/${observacion}')
                        .then(response => {
                            if (!response.ok) {
                            throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                            `Request failed: ${error}`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                        title: `${result.value.login}'s avatar`,
                        imageUrl: result.value.avatar_url
                        })
                    }
                    //
                }    

            })
            //

        })

	
        $("#xborrar").on('click', function() {
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

        $("#salir").on('click', function(e) {
            e.preventDefault();
            window.location = '../tables/pro_proceso.php';
        });

    });
    </script>    
</body>
</html>