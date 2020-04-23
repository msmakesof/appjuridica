<?php
include_once("header.inc.php");
require_once ('../../Connections/DataConex.php'); //require_once('../../Connections/cnn_kn.php');
$LogoInterno = LogoInterno;require_once('../../Connections/cnn_kn.php'); 
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

        switch ($theType) 
        {
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
$NombreTabla ="CLIENTE";
$idTabla = 0;
$empresausuario = 0;
require_once('../../apis/general/tipodocumento.php');
require_once('../../apis/general/tipocliente.php');
require_once('../../apis/empresa/Empresa.php');
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
    <!-- <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" /> -->
    <link href="../../css/sweet/sweetalert.css" rel="stylesheet" />
    <link href="../../css/sweet/main.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- mks 20170128
    <link rel="stylesheet" href="../../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../../css/themes2/alertify.default.css" id="toggleCSS" /> -->
    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <!--  <script src="../../plugins/sweetalert/sweetalert.min.js"></script> -->
    <script src="../../js/sweet/functions.js"></script>
    <script src="../../js/sweet/sweetalert.min.js"></script>
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

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

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Waves Effect bootbox.min.js Js -->
    <script src="../../js/bootbox.min.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/form-validation.js"></script>
    <script src="../../plugins/jquery-validation/localization/messages_es.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

    <!-- <script src="../../js/alertify.min.js"></script> -->
    <script src="../../js/jquery.numeric.js"></script>
	 
	<!-- toggle botton
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --> 
	
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script type="text/javascript">
    var nombre ="";
    $(document).ready(function()
    {   		
		$("#msj").hide();
        $("#numerodocumento").numeric();
		$("#numerodocumentorp").numeric();
        $("#celular").numeric();
        $("#telefonoFijo").numeric();
		$("#celularrl").numeric();
		$("#celularrl2").numeric();
		$("#pjur").hide();
		$("#pnat").show();
		$("#rl").hide();
		$("#datopj").hide();
		$("#datopj1").hide();
		$('#activo').prop("checked", true);

		$("#tipodocumento").change(function(){
			var tipodocumento = $("#tipodocumento").val();			
			if (tipodocumento == 2)
			{
				$("#pnat").hide();
				$("#pjur").show();		
				$("#rl").show();
				$("#datopj").show();
				$("#datopj1").show();
			}
			else
			{
				$("#pjur").hide();
				$("#pnat").show();
				$("#rl").hide();
				$("#datopj").hide();
				$("#datopj1").hide();
			}
		});
		
		if($('#verseguimiento').prop('checked') == false )
		{
			$( "#clave" ).prop( "disabled", true );
			$("#clave").attr("placeholder", "No habilitado");
		}
		
		$('#verseguimiento').on('change', function () {			
			if($(this).prop('checked') == false )
			{
				$( "#clave" ).prop( "disabled", true );
				$("#clave").attr("placeholder", "No habilitado");
			}
			else
			{
				$( "#clave" ).prop( "disabled", false );
				$("#clave").attr("placeholder", "");
			}
		});		

        $('#email').on('blur', function() {
            // Expresion regular para validar el correo
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

            // Se utiliza la funcion test() nativa de JavaScript
            if (regex.test($('#email').val().trim())) 
            {                
            } 
            else 
            {                
                swal({
                  title: "Atención:  La dirección de correo no es valida...",
                  text: "un momento por favor.",
                  imageUrl: "../../js/sweet/3red.gif",
                  timer: 1500,
                  showConfirmButton: false
                });
                return false;   
                $("#email").focus();
            }
        });

        function reset () {
            $("#toggleCSS").attr("href", "../../css/themes2/alertify.default.css");
            alertify.set({
                labels : {
                    ok     : "OK",
                    cancel : "Cancelar"
                },
                delay : 5000,
                buttonReverse : false,
                buttonFocus   : "ok"
            });
        }
		
        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'cli_cliente.php';
        }); 

        $("#grabar").on('click', function(e) { 
            var tipodocumento = $("#tipodocumento").val();
            var numerodocumento = $("#numerodocumento").val();
            var nombre = $("#nombre").val();
			var nombren = $("#nombren").val();
            var apellido1 = $("#apellido1").val();
            var apellido2 = $("#apellido2").val();
            var clave = $("#clave").val();            
            var direccion = $("#direccion").val();
            var email = $("#email").val();
            var celular = $("#celular").val();
            var tipocliente = $("#tipocliente").val();
            var estado = $('input:radio[name=estado]:checked').val();
			var seguimiento = $('input:checkbox[name=verseguimiento]:checked').val();
			var empresa = $("#empresa").val();
			var uc = <?php echo $_SESSION['IdUsuario']; ?>
			
			var tipodocumentorl = "";
			var numerodocumentorl = "";
			var nombrerl = "";
			var apellido1rl = "";
			var celularrl= "";
			var emailrl= "";
			var tipodocumentorl2= "";
			var numerodocumentorl2= ""; 
			var nombrerl2 = "";
			var apellidosrl2 = "";
			var celularrl2= "";
			var emailrl2= "";			
			
			tipodocumentorl = $("#tipodocumentorl").val();
			numerodocumentorl = $("#numerodocumentorl").val();
			nombrerl = $("#nombrerl").val();
			apellido1rl = $("#apellido1rl").val();
			celularrl = $("#celularrl").val();
			emailrl = $("#emailrl").val();
			tipodocumentorl2 = $("#tipodocumentorl2").val();
			numerodocumentorl2 = $("#numerodocumentorl2").val();
			nombrerl2 = $("#nombrerl2").val();
			apellidosrl2 = $("#apellidosrl2").val();
			celularrl2 = $("#celularrl2").val();
			emailrl2 = $("#emailrl2").val();			
	
            e.preventDefault();
			
			if( tipodocumento != 2)
			{
				nombre = nombren;
			}
			if( tipodocumento == 2)
			{
				apellido1 = " ";
				apellido2 = " ";
			}
			
			/*
            //if( tipodocumento == "" || numerodocumento == "" || numerodocumento == 0 ||nombre == "" || apellido1 == "" || direccion == "" || celular == "" || estado == undefined || seguimiento == "" || tipocliente == undefined || tipocliente == "" || empresa == "")
			if( numerodocumento == "" || numerodocumento == 0 || nombre == "" || apellido1 == "" || empresa == "" )
            {                
				swal({
                  title: "Error:  Ingrese información en todos los campos Obligatorios ...",
                  text: "un momento por favor.",
                  imageUrl: "../../js/sweet/2.gif",
                  timer: 1500,
                  showConfirmButton: false
                });
                return false;
            }
            else
            {
			}
			*/		
				if( tipodocumento == 2)
				{
					//if( nombre == "" || tipodocumentorl == "" || numerodocumentorl == "" || numerodocumentorl == 0 || nombrerl  == "" || apellido1rl == "" || celularrl == "" || emailrl== "")
					if( tipodocumento == "" || tipodocumentorl == "" || numerodocumento == "" || numerodocumento == 0 || nombre == "" || direccion == "" || numerodocumentorl == "" || numerodocumentorl == 0 || nombrerl  == "" || apellido1rl == "" || empresa == "")
					{
						graba = 0;
						swal({
							title: "Atención:  Ingrese información en los campos Obligatorios, marcados con *.",
							text: "un momento por favor.",
							imageUrl: "../../js/sweet/2.gif",
							timer: 3000,
							showConfirmButton: false
						});
						return false;
					}
					else
					{
						graba = 1;
					}
				}
				else				
				{
					if (tipodocumento == "" || numerodocumento == "" || numerodocumento == 0 || nombre == "" || apellido1 == "" || empresa == "")
					{
						
						graba = 0;
						swal({
							title: "Atención:  Ingrese información en los campos Obligatorios, marcados con *.",
							text: "un momento por favor.",
							imageUrl: "../../js/sweet/2.gif",
							timer: 3000,
							showConfirmButton: false
						});
						return false;
					}
					else
					{
						graba = 1;
					}
				}
				if(graba == 1)
				{
					$.ajax({
						data : {"tipodocumento": tipodocumento, "numerodocumento": numerodocumento, "nombre": nombre, "apellido1": apellido1, "apellido2": apellido2, 
								"clave": clave, "direccion": direccion, "email": email, "celular": celular, "estado": estado, "verseguimiento": seguimiento, 
								"tipocliente": tipocliente, "empresa": empresa, "uc": uc ,
								"tipodocumentorl": tipodocumentorl , "numerodocumentorl": numerodocumentorl , "nombrerl": nombrerl, "apellido1rl": apellido1rl, "celularrl": celularrl , "emailrl": emailrl, 
								"tipodocumentorl2": tipodocumentorl2 , "numerodocumentorl2": numerodocumentorl2 , "nombrerl2": nombrerl2, "apellidosrl2": apellidosrl2, "celularrl2": celularrl2 , "emailrl2": emailrl2
								}, 
						type: "POST",
						dataType: "html",
						url : "../forms/crea_<?php echo strtolower($NombreTabla); ?>.php",
					})  
					.done(function( data, textStatus, jqXHR){                 
						var xrespstr = data.trim();
						var respstr = xrespstr.substr(0,1);
						var msj = xrespstr.substr(2);
						if(respstr == "E")
						{                       
						   swal("Atención:", msj);
						}
						else
						{    
							if( respstr == "S" )
							{  
								setTimeout(function () { 
									swal({
									  title: "Atención:",
									  text: "Registro Grabado Correctamente.",
									  type: "success",
									  confirmButtonText: "OK"
									},
									function(isConfirm){
										if (isConfirm) {
											window.location.href = "cli_cliente.php";
										}
									}); 
								}, 1000);
								
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
						}    
					})
					.fail(function( jqXHR, textStatus, errorThrown ) {
						if ( console && console.log ) 
						{
							console.log( "La solicitud a fallado: " +  textStatus);
							$("#msj").html("");
						}
					});
				}
                
        });
    });    
    </script>    
</head>

<body class="theme-indigo">
    <?php require_once('secciones.html'); ?>  
    <section class="content" style="margin-top:85px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORMULARIO: <?php echo $NombreTabla; ?>.
                    <small>acción: Crear.</small>
                </h2>
            </div>
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <!--<div class="header">
                            <h2>REGISTRO DE TABLAS.</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>                                    
                                </li>
                            </ul>
                        </div>-->
                        <div class="body">
                            <form id="form_validation" method="POST">

                                <div class="form-group">                                    							                                    
									<div class="row">
										
										<div class="col-md-4">
											<label class="form-label">
												Tipo Cliente
											</label>
											<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="tipocliente" id="tipocliente" required>
												<option value="" >Seleccione Opción...</option>
												<?php
													for($i=0; $i<count($mtipocliente['cli_tipocliente']); $i++)
													{
														$TCL_IdTipoCliente = $mtipocliente['cli_tipocliente'][$i]['TCL_IdTipoCliente'];                                                    
														$TCL_Nombre = $mtipocliente['cli_tipocliente'][$i]['TCL_Nombre'];
														$TCL_Estado = $mtipocliente['cli_tipocliente'][$i]['TCL_Estado'];
														if($TCL_IdTipoCliente == 1) {
												?>
															<option value="<?php echo $TCL_IdTipoCliente; ?>" <?php echo "selected"; ?>>
																<?php echo $TCL_Nombre ; ?>                                                
															</option>
												<?php
														}
													}
												?>
											</select>
										</div>
										<div class="col-md-4">
											<label class="form-label"><span style="color:red;">*</span> 
												Tipo Documento
											</label>                                    
                                                                               
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="tipodocumento" id="tipodocumento" required>
                                             <option value="" >Seleccione Opción...</option>
                                                <?php
                                                    for($i=0; $i<count($mtipodocumento['gen_tipodocumento']); $i++)
                                                    {
                                                        $TDO_IdTipoDocumento = $mtipodocumento['gen_tipodocumento'][$i]['TDO_IdTipoDocumento'];
                                                        $TDO_Abreviatura = $mtipodocumento['gen_tipodocumento'][$i]['TDO_Abreviatura'];
                                                        $TDO_Nombre = $mtipodocumento['gen_tipodocumento'][$i]['TDO_Nombre'];
                                                        //$TDO_Estado = $m['gen_tipodocumento'][$i]['TDO_Estado'];
                                                ?>
                                                        <option value="<?php echo $TDO_IdTipoDocumento; ?>" >
                                                            <?php echo $TDO_Nombre ; ?>                                                
                                                        </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    
										<div class="col-md-4"> 
											<label class="form-label"> <span style="color:red;">*</span> N&uacute;mero Documento</label>
											<div class="form-line">
											   <input type="text" class="form-control" name="numerodocumento" id="numerodocumento" value="" maxlength="13" required  placeholder="No digitar puntos ni guiones.">
											</div>
										</div>
									</div>
                                </div>

                                <div class="form-group form-float">
									
									<div class="form-group form-float" id="pjur">
										<div class="row">
											<div class="col-md-12">
												<label class="form-label"><span style="color:red;">*</span> Nombre Empresa</label>
												<div class="form-line">
													<input type="text" class="form-control" name="nombre" id="nombre" value="" required>
												   <!-- -->
												</div>
											</div>
										</div>
									</div>
								
									<div class="form-group form-float" id="pnat">
										<div class="row">
											<div class="col-md-4">
												<label class="form-label"><span style="color:red;">*</span> Nombre</label>
												<div class="form-line">
													<input type="text" class="form-control" name="nombren" id="nombren" value="" required>											   
												</div>
											</div>
											
											<div class="col-md-4">
												<label class="form-label"><span style="color:red;">*</span> Primer Apellido</label>
												<div class="form-line">
													<input type="text" class="form-control" name="apellido1" id="apellido1" value="" required>											   
												</div>
											</div>                                

											<div class="col-md-4">
												<label class="form-label">Segundo Apellido</label>
												<div class="form-line">
													<input type="text" class="form-control" name="apellido2" id="apellido2" value="" required>											   
												</div>
											</div>
										</div>
									</div>
								</div>	

                                <div class="form-group form-float">
									<div class="row">
										<div class="col-md-5">
											<label class="form-label"> <span id="datopj" style="color:red;">*</span> Direcci&oacute;n</label>
											<div class="form-line">
												<input type="text" class="form-control" name="direccion" id="direccion" value="" maxlength="50" required>                                
											</div>
										</div>
										
										<div class="col-md-3">
											<label class="form-label">N&uacute;mero Celular</label>
											<div class="form-line">
												<input type="text" class="form-control" name="celular" id="celular" value="" maxlength="13" required>                                       
											</div>
										</div>
										
										<div class="col-md-4">
											<label class="form-label">Email</label>
											<div class="form-line">
											   <input type="text" class="form-control" name="email" id="email" value="" maxlength="60" required>                                       
											</div>
										</div>
									</div>
								</div>								
									
								<div class="form-group form-float">
									<div class="row">
										
										<div class="col-md-3">
											<label class="form-label">Autoriza acceso a la herramienta para que el cliente pueda ver seguimiento de su proceso?											
												<input id="verseguimiento" type="checkbox" data-toggle="toggle" data-on="Aceptar" data-off="Cancelar" data-onstyle="success" data-offstyle="danger" data-size="sm">
											</label>									
											<hr style="margin-top:5px">
										</div>
										
										<div class="col-md-3">
											<label class="form-label">Clave</label>
											<div class="form-line">
												<input type="password" class="form-control" name="clave" id="clave" value="" maxlength="30" required>                                       
											</div>
										</div>
									
										<div class="col-md-2">
											<label class="form-label">Estado</label>
											<input type="radio" name="estado" id="activo" class="with-gap" value="1">
											<label for="activo">Activo</label>

											<input type="radio" name="estado" id="inactivo" class="with-gap" value="0">
											<label for="inactivo" class="m-l-20">Inactivo</label>
										</div>
										
										<div class="col-md-4">
											<label class="form-label"><span style="color:red;">*</span>
												Empresa encargada del Proceso
											</label>
											<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="empresa" id="empresa" required>
												<option value="" >Seleccione Opción...</option>
												<?php
													
													if($_SESSION["TipoUsuario"] <= 2)
													{														
														$empresausuario = $_SESSION['IdEmpresa'];
														for($i=0; $i<count($mempresa['emp_empresa']); $i++)
														{
															$IdEmpresa = $mempresa['emp_empresa'][$i]['EMP_IdEmpresa'];                                                    
															$Nombre = trim($mempresa['emp_empresa'][$i]['NombreEmpresa']);
															$Estado = $mempresa['emp_empresa'][$i]['EMP_IdEstado'];
														}
												?>			
														<option value="<?php echo $IdEmpresa; ?>" <?php if($IdEmpresa == $empresausuario) { echo 'selected';} ?> >
															<?php echo $Nombre ; ?>                                                
														</option>
												<?php			
													}
													else
													{
														for($i=0; $i<count($mempresa['emp_empresa']); $i++)
														{
															$IdEmpresa = $mempresa['emp_empresa'][$i]['EMP_IdEmpresa'];                                                    
															$Nombre = trim($mempresa['emp_empresa'][$i]['NombreEmpresa']);
															$Estado = $mempresa['emp_empresa'][$i]['EMP_IdEstado'];															
												?>														
															<option value="<?php echo $IdEmpresa; ?>" <?php if($empresausuario > 0) { echo 'selected';} ?> >
																<?php echo $Nombre ; ?>                                                
															</option>
												<?php
														}
													}
												?>
											</select>
										</div>
										
									</div>	
                                </div>
								
								<div class="form-group form-float" id="rl">
									<?php include './cli_contactos.inc.php' ; ?>
                                </div>
								
                                <button class="btn btn-primary waves-effect" type="submit" id="grabar">GRABAR</button>
								<button class="btn btn-danger waves-effect" type="submit" id="cerrar">SALIR</button>
								<div><span style="color:red;">* Campos Obligatorios.</span></div>
                            </form>                        
                    	</div>
                	</div>    
                </div>               
            </div>
            <!-- #END# Basic Validation --> 
             <div class="row clearfix">         
                <div id="msj">

                     <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" >
                                <div class="modal-header">
                                    <!-- <h4 class="modal-title" id="defaultModalLabel">Crear</h4> -->
                                </div>
                                
                                <div class="modal-body">                         
                                    <object type="text/html" data="mensajes.php?id=ES" ></object>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> 
                                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="cerrarModalC">CERRAR Crear.</button>-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
             </div>
        </div>
    </section>  
</body>
</html>
<?php //ob_end_flush(); ?>