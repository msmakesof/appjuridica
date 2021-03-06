<?php
include_once("header.inc.php");
require_once ('../../Connections/DataConex.php'); 
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
if( isset($_POST['id']) && !empty($_POST['id']) )
{    
    $pid = trim($_POST['id']);   
}
if( isset($_POST['ne']) && !empty($_POST['ne']) )
{    
    $pne = trim($_POST['ne']);   
}
if( isset($_POST['ie']) && !empty($_POST['ie']) )
{    
    $pie = trim($_POST['ie']);   
}
$NombreTabla ="EMPRESA";
$idTabla = 0;
$fechacreado = date("Y-m-d H:i:s");
require_once('../../apis/general/tipodocumento.php');
require_once('../../apis/general/ciudad.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

	<!-- Bootstrap Core Css  --> 
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet"> 	

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../../css/sweet/sweetalert.css" rel="stylesheet" />
    <link href="../../css/sweet/main.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

	<!-- Jquery Core Js
    <script src="../../plugins/jquery/jquery.min.js"></script> -->
	<script  src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script> 

    <!-- Sweet Alert Plugin Js -->   
    <script src="../../js/sweet/functions.js"></script>
    <script src="../../js/sweet/sweetalert.min.js"></script>
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>    

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

    <script src="../../js/jquery.numeric.js"></script>
	 
	<!-- toggle botton --> 
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript">
    var nombre ="";
	
	function cerrar(id, ne, ie) 
	{    	
		event.preventDefault();
		$.post('emp_contactoempresa.php', { 'id': id ,'ne': ne, 'ie': ie}, function (result) {
			WinId = window.open('','_self');
			WinId.document.open();
			WinId.document.write(result);
			WinId.document.close();
		});
	}
	
    $(document).ready(function()
    {       
        $('#activo').prop("checked", true);
		$("#msj").hide();
        $("#numerodocumento").numeric();
        $("#celular").numeric();
        $("#fijo").numeric();
		
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
                  title: "Error:  La dirección de correo no es valida...",
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
		
		$("#bcerrar").on('click', function(e) {
			e.preventDefault();
			$(location).prop('href', "emp_contactoempresa.php?id=<?php echo $pid; ?>&ne=<?php echo $pne; ?>&ie=<?php echo $pie; ?>");
        });

        $("#grabar").on('click', function(e) {
			var empresa = <?php echo $pie; ?>;
            var tipodocumento = $("#tipodocumento").val();
            var numerodocumento = $("#numerodocumento").val();			
            var nombre = $("#nombre1").val();			
			var nombre2 = $("#nombre2").val();
			var apellido1 = $("#apellido1").val();
			var apellido2 = $("#apellido2").val();            
            var email = $("#email").val();
			var fijo = $("#fijo").val();
            var celular = $("#celular").val();			
			var ciudad = $("#ciudad").val();			
            var estado = $('input:radio[name=estado]:checked').val();
			var usuario = <?php echo $_SESSION['IdUsuario']; ?>;			
			var graba = 0;
            e.preventDefault();

            if( tipodocumento == "" || numerodocumento =="" || nombre == "" || apellido1 == "" || email == "" || celular == "" || estado == undefined || ciudad == "")
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
					data : {"empresa": empresa, "tipodocumento": tipodocumento, "identificacion": numerodocumento, "nombre1": nombre, "nombre2": nombre2, "apellido1": apellido1, "apellido2": apellido2, "email": email, "celular": celular, "estado": estado, "fijo": fijo, "ciudad": ciudad, "usuario": usuario}, 
					type: "POST",
					dataType: "html",
					url : "../forms/crea_adicontacto.php",
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
										//e.preventDefault();										
										cerrar(<?php echo $pid; ?>, '<?php echo $pne; ?>', <?php echo $pie; ?>);
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
                    FORMULARIO CONTACTO EMPRESA: <span class="alert alert-warning" role="alert"><?php echo $NombreTabla; ?> - <?php echo strtoupper($pne); ?>.</span>
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

								<div class="form-group form-float"> 
									<div class="row">
									
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
											<span style="color:red;">*</span> 
											<label class="form-label">N&uacute;mero Documento</label>
											<div class="form-line">
											   <input type="text" class="form-control" name="numerodocumento" id="numerodocumento" value="" maxlength="13" required>
											</div>
										</div>
									</div> 									
                                </div>
							
								
								<div class="form-group form-float" id="pnat">
									<div class="row">
										<div class="col-md-3">
											<span style="color:red;">*</span> 
											<label class="form-label">Primer Nombre</label>
											<div class="form-line">
												<input type="text" class="form-control" name="nombre1" id="nombre1" value="" required>											   
											</div>
										</div>
									
										<div class="col-md-3">
											<label class="form-label">Segundo Nombre</label>
											<div class="form-line">
												<input type="text" class="form-control" name="nombre2" id="nombre2" value="" required>											   
											</div>
										</div>
									
										<div class="col-md-3">
											<span style="color:red;">*</span> 
											<label class="form-label">Primer Apellido</label>
											<div class="form-line">
												<input type="text" class="form-control" name="apellido1" id="apellido1" value="" required>											   
											</div>
										</div>
									
										<div class="col-md-3">
											<label class="form-label">Segundo Apellido</label>
											<div class="form-line">
												<input type="text" class="form-control" name="apellido2" id="apellido2" value="" required>											   
											</div>
										</div>
									</div>
								</div>
                                
                                <div class="form-group form-float">
									<div class="row">
										<div class="col-md-7">
											<span style="color:red;">*</span> 
											<label class="form-label">Email</label>
											<div class="form-line">
											   <input type="text" class="form-control" name="email" id="email" value="" maxlength="60" required>                                       
											</div>
										</div>
										
										<div class="col-md-4">
											<span style="color:red;">*</span> 										
											<label class="form-label">Ciudad</label>
											<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="ciudad" id="ciudad" required>
											 <option value="" >Seleccione Opción...</option>
												<?php
													for($i=0; $i<count($mciudad['gen_ciudad']); $i++)
													{
														$CIU_IdCiudades = $mciudad['gen_ciudad'][$i]['CIU_IdCiudades'];
														$CIU_Abreviatura = $mciudad['gen_ciudad'][$i]['CIU_Abreviatura'];
														$CIU_Nombre = $mciudad['gen_ciudad'][$i]['CIU_Nombre'];														
												?>
														<option value="<?php echo $CIU_IdCiudades; ?>" >
															<?php echo $CIU_Nombre ; ?>                                                
														</option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
                                </div>
								
                                <div class="form-group form-float">
									<div class="row">
										<div class="col-md-4">									
											<label class="form-label">Teléfono Fijo</label>
											<div class="form-line">
												<input type="text" class="form-control" name="fijo" id="fijo" value="" maxlength="10" required>                                       
											</div>
										</div>
										
										<div class="col-md-4">
											<span style="color:red;">*</span> 
											<label class="form-label">Celular</label>
											<div class="form-line">
												<input type="text" class="form-control" name="celular" id="celular" value="" maxlength="13" required>                                       
											</div>
										</div>                                
									</div>									
                                </div>
								
                                <div class="form-group form-float">
                                    <label class="form-label">Estado</label>
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1">
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2">
                                    <label for="inactivo" class="m-l-20">Inactivo</label>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit" id="grabar">GRABAR</button>
								<button class="btn btn-danger waves-effect" onClick="cerrar(<?php echo $pid; ?>, '<?php echo $pne; ?>', <?php echo $pie; ?>)">SALIR</button>
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