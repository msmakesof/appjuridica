<?php
include_once("../tables/header.inc.php");
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

$Tabla ="USUARIOS";
$idTabla = 0;
$idtabla = 0;
//$idTabla = 0;
require_once('../../apis/empresa/Empresa.php');
require_once('../../apis/general/tipodocumento.php');
require_once('../../apis/general/tipousuario.php');

if( isset($_GET['f'])  && !empty($_GET['f']) )
{    
    $idTabla = trim($_GET['f']);
}

$strowreg =0;
$row_rs_tabla = 0;
$Nombreciudad = "";
$idTabla = ""; 
if ( isset( $_POST["id"]))
{ 
    $idTabla = $_POST["id"];
}
require_once('../../apis/usuario/infoUsuario.php');

$idtabla = $muser['usu_usuario']['USU_IdUsuario'];
$idEmpresa = $muser['usu_usuario']['USU_IdEmpresa'];
$TipoDocumento = $muser['usu_usuario']['USU_TipoDocumento'];
$NumeroDocumento = trim($muser['usu_usuario']['USU_Identificacion']);
$Apellido1 = trim($muser['usu_usuario']['USU_PrimerApellido']);
$Apellido2 = trim($muser['usu_usuario']['USU_SegundoApellido']);
$NombreAlumno = trim($muser['usu_usuario']['USU_Nombre']);
$Email = trim($muser['usu_usuario']['USU_Email']);
$Direccion = trim($muser['usu_usuario']['USU_Direccion']);
$Celular = trim($muser['usu_usuario']['USU_Celular']);
$Usuario = trim($muser['usu_usuario']['USU_Usuario']);
$Clave = $muser['usu_usuario']['USU_Clave'];
$EstadoEst = $muser['usu_usuario']['USU_Estado'];
$EsAbogado = $muser['usu_usuario']['USU_EsAbogado'];
$TipoUsuario = $muser['usu_usuario']['USU_TipoUsuario'];
$TarjetaProfesional = $muser['usu_usuario']['USU_TarjetaProfesional'];
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
	<link href="../../css/sweet/main.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../../css/themes2/alertify.default.css" id="toggleCSS" />
	
	
	<!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
	
    <!-- Sweet Alert Plugin Js -->
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

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/form-validation.js"></script>
    <script src="../../plugins/jquery-validation/localization/messages_es.js"></script>

    <script src="../../js/pages/ui/dialogs.js"></script>
	
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>    

    <script src="../../js/alertify.min.js"></script>
    <script src="../../js/jquery.numeric.js"></script>

</head>

<body class="theme-indigo">
    <?php 
	//include '../tables/secciones.html' ; 
	require_once('../tables/secciones.html');
	?>
	
    <section class="content" style="margin-top:85px;">
        <div class="container-fluid">
			<!--
            <div class="block-header">
                <h2>
                    FORMULARIO: Edición <?php echo $Tabla; ?>.
                    <small>Editar.</small>
                </h2>
            </div> -->
            <!-- Basic Validation -->
            <div class="row info-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>REGISTRO EDICION DE USUARIOS.</h2>
                             <ul class="header-dropdown m-r--5">
                               <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>                                    
                                </li>
                            </ul>
                        </div>
                        <div class="body  table-responsive">
                            <form id="form_validation" method="POST">
							
								<div class="form-group">                                    
									<div class="row">
										<div class="col-md-8"><span style="color:red;">*</span> 
											<label class="form-label">
												Empresa
											</label>                                    
                                                                               
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="empresa" id="empresa" required>
												<option value="" >Seleccione Opción...</option>
												<option value="0" <?php if (trim($idEmpresa) == 0){ echo "selected/=selected/";} else{ echo "";} ?>>Nombre Propio...</option>
                                                <?php
                                                    for($i=0; $i<count($mempresa['emp_empresa']); $i++)
                                                    {
                                                        $EMP_IdEmpresa = $mempresa['emp_empresa'][$i]['EMP_IdEmpresa'];
                                                        $EMP_Nombre = trim($mempresa['emp_empresa'][$i]['EMP_Nombre']);
														$EMP_Nombre2 = trim($mempresa['emp_empresa'][$i]['EMP_Nombre2']);
														$EMP_Apellido = trim($mempresa['emp_empresa'][$i]['EMP_Apellido']);
														$EMP_Apellido2 = trim($mempresa['emp_empresa'][$i]['EMP_Apellido2']);
                                                        $EMP_Identificacion = $mempresa['emp_empresa'][$i]['EMP_Identificacion'];
                                                        $EMP_IdEstado = $mempresa['emp_empresa'][$i]['EMP_IdEstado'];
														$Nombre = $EMP_Nombre.' '.$EMP_Nombre2.' '.$EMP_Apellido.' '.$EMP_Apellido2;
														if($EMP_IdEstado == 1){
                                                ?>															
															<option value="<?php echo $EMP_IdEmpresa; ?>" <?php if (trim($EMP_IdEmpresa) == trim($idEmpresa)){ echo "selected/=selected/";} else{ echo "";} ?>>
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
								
                                <div class="form-group">
                                    <div class="row">
										<div class="col-md-4"><span style="color:red;">*</span> 
											<label class="form-label">
												Tipo Documento
											</label>                                    
											
										   <input type="hidden" class="form-control" name="IdEstudiante" id="IdEstudiante" value="<?php echo $idtabla ;?>" readonly>
											<select class="selectpicker show-tick" data-live-search="true" data-width="90%" name="tipodocumento" id="tipodocumento" required>
												<?php                                                    
													for($i=0; $i<count($mtipodocumento['gen_tipodocumento']); $i++)
													{                                                         
														$TDO_IdTipoDocumento = $mtipodocumento['gen_tipodocumento'][$i]['TDO_IdTipoDocumento'];
														$TDO_Abreviatura = $mtipodocumento['gen_tipodocumento'][$i]['TDO_Abreviatura'];
														$TDO_Nombre = $mtipodocumento['gen_tipodocumento'][$i]['TDO_Nombre'];
												?>                                                
														<option value="<?php echo $TDO_IdTipoDocumento; ?>" <?php if (trim($TDO_IdTipoDocumento) == trim($TipoDocumento)){ echo "selected/=selected/";} else{ echo "";} ?>>
															<?php echo $TDO_Nombre ; ?>                                                
														</option>
												<?php                    
													} 
												?>
											</select>
											 
										</div>
										<div class="col-md-4"><span style="color:red;">*</span> 
											<label class="form-label">Número Documento</label>
											<div class="form-line">
												<input type="text" class="form-control" name="numerodocumento" id="numerodocumento" value="<?php echo $NumeroDocumento ;?>" maxlength="13" required>
												<div id="carga"></div>
											</div>											
										</div>
										
										<div class="col-md-4">
											<label class="form-label">N&uacute;mero Tarjeta Profesional</label>
											<div class="form-line">
											   <input type="text" class="form-control" name="tp" id="tp" value="<?php echo $TarjetaProfesional ?>" maxlength="13" required>
                                               <!-- <div id="carga"></div> -->
											</div>
										</div>
										
									</div>    
								</div>

                                <div class="form-group form-float">
									<div class="row">
										<div class="col-md-4"><span style="color:red;">*</span> 
											<label class="form-label">Nombre </label>
											<div class="form-line">
												<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $NombreAlumno ;?>" required>											   
											</div>
										</div>
										<div class="col-md-4"><span style="color:red;">*</span> 
											<label class="form-label">Primer Apellido</label>
											<div class="form-line">
												<input type="text" class="form-control" name="apellido1" id="apellido1" value="<?php echo $Apellido1 ;?>" required>                                       
											</div>
										</div>
										<div class="col-md-4">
											<label class="form-label">Segundo Apellido</label>
											<div class="form-line">
												<input type="text" class="form-control" name="apellido2" id="apellido2" value="<?php echo $Apellido2 ;?>" required>											   
											</div>
										</div>
									</div>
                                </div>                                

                                 <div class="form-group form-float">
									<div class="row">										
										<div class="col-md-8"><span style="color:red;">*</span> 
											<label class="form-label">Dirección</label>
											<div class="form-line">
												<input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $Direccion ;?>" maxlength="50" required>											   
											</div>
										</div>
										<div class="col-md-4"><span style="color:red;">*</span> 
											 <label class="form-label">Celular</label>
											<div class="form-line">
												<input type="text" class="form-control" name="celular" id="celular" value="<?php echo $Celular ;?>" maxlength="13" required>                                       
											</div>
										</div>
									</div>
                                </div>
								
                                <div class="form-group form-float">
									<div class="row">
										<div class="col-md-8"><span style="color:red;">*</span> 
											<label class="form-label">Email</label>
											<div class="form-line">
												<input type="text" class="form-control" name="email" id="email" value="<?php echo $Email ;?>" maxlength="60" required>                                      
											</div>
											<div id="ecarga"></div>
										</div>
										<div class="col-md-4"><span style="color:red;">*</span> 
											<label class="form-label">Clave</label>
											<div class="form-line">
												<input type="password" class="form-control" name="clave" id="clave" value="<?php echo $Clave ;?>" maxlength="30" required>                                       
											</div>
										</div>										
									</div>
                                </div>                                

                                <div class="form-group form-float">
									<div class="row">
										<div class="col-md-7"><span style="color:red;">*</span> 
											<label class="form-label">Tipo Usuario</label>
										
											<select class="selectpicker show-tick" data-live-search="true" data-width="90%" name="tipousuario" id="tipousuario" required>                                            
												<?php                                                 
													 for($i=0; $i<count($mtipousuario['usu_tipousuario']); $i++)
													{           
														$TUS_IdTipoDocumento = $mtipousuario['usu_tipousuario'][$i]['TUS_ID_TipoUsuario'];                                                    
														$TUS_Nombre = $mtipousuario['usu_tipousuario'][$i]['TUS_Nombre'];
														$TUS_Estado = $mtipousuario['usu_tipousuario'][$i]['TUS_Estado'];
												?>                                            
												<option value="<?php echo $TUS_IdTipoDocumento; ?>" <?php if ($TUS_IdTipoDocumento == $TipoUsuario){ echo "selected";} else{ echo "";} ?>>
													<?php echo $TUS_Nombre ; ?>                                                
												</option>
												<?php                    
													} 
												?>
											</select>
										</div>   
										<div class="col-md-5"><span style="color:red;">*</span> 
											<label class="form-label">Abogado</label>
											<input type="radio" name="abogado" id="si" class="with-gap" value="1" <?php if( $EsAbogado == 1){?>checked="checked"<?php } ?>>
											<label for="si">Si</label>

											<input type="radio" name="abogado" id="no" class="with-gap" value="0" <?php if( $EsAbogado == 0){?>checked="checked"<?php } ?>>
											<label for="no" class="m-l-20">No</label>
										</div>
									</div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Estado</label>
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $EstadoEst == 1){?>checked="checked"<?php } ?>>
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2"<?php if( $EstadoEst == 2){?>checked="checked"<?php } ?>>
                                    <label for="inactivo" class="m-l-20">Inactivo</label>                                    
                                </div>
								
                                <hr>
                                <div class="form-group" style="clear: both; margin-top:20px; margin-bottom:20px;">
									<button class="btn btn-primary waves-effect" type="button" id="grabar">GRABAR</button>								   
									<button type="button" class="btn btn-danger waves-effect" id="borrar">BORRAR</button>
                                    <button class="btn btn-danger waves-effect" type="submit" id="cerrar">SALIR</button>
                                    <div><span style="color:red;">* Campos Obligatorios.</span></div>
								</div>
								
                            </form>                        
                            <div id="msj" style="margin-top:7px;"></div>
                             <form id="mensaje">
                             <label style="font-family: Verdana; font-size: 18; color:red;">Registro ha sido borrado correctamente.</lael>
                            </form>

                    	</div> 
                	</div>                    
                </div>               	           
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>

    <script type="text/javascript">	
	function validanom(nom, ape1, ape2)
	{		
		var iden = $("#numerodocumento").val();
		$.ajax({
			data: {"nom": nom, "ape1": ape1, "ape2": ape2, "iden":iden, "par": "n"},
			type: 'POST',
			dataType: "html",
			url: "../forms/buscaiden.php",
			
			beforeSend: function() {					
				$("#carga").html('<img src="../../images/ajax-loader.gif">');					
				$("#grabar").hide();
				$("#borrar").hide();
				$("#numerodocumento").focus();
				return false;
			},
			success: function(data) {					
				if( data == "N")
				{
					swal({
						title: "Atención :  Existe un usuario registrado con ese Nro. de Identificación.",
						text: "un momento por favor.",
						imageUrl: "../../js/sweet/3red.gif",
						timer: 2000,
						showConfirmButton: false
					});					 
					$("#numerodocumento").focus();
					return false;  
				}
				else{
					$("#grabar").show();
					$("#borrar").show();
				}
			},
			error: function(xhr) { // if error occured
				alert("Error ha ocurrido.");
			},
			complete: function() {					
				$("#carga").html('');
				$("#numerodocumento").focus();
				return false;
			},				
		});
	}
		
    $(document).ready(function()
	{		
        $("#mensaje").hide();
        $("#form_validation").show();
        $("#numerodocumento").numeric();
        $("#celular").numeric();
		$("#tp").numeric();
		
        $('#email').on('blur', function() {
            // Expresion regular para validar el correo
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

            // Se utiliza la funcion test() nativa de JavaScript
            if (regex.test($('#email').val().trim())) 
            {
				var mail = $(this).val();
				var idtabla = 0;
				$.ajax({
					data: {"mail": mail, "par": "e"},
					type: 'POST',
					dataType: "html",
					url: "../forms/buscaiden.php",				
					
					beforeSend: function() {					
						$("#ecarga").html(' <img src="../../images/ajax-loader.gif"><span class="label label-warning"> Verificando información... </span>');					
						$("#grabar").hide();
						$("#borrar").hide();						
					},
					success: function(data) {					
						if( data == "N")
						{
							swal({
								title: "Atención :  Existe un usuario registrado con ese mismo Email.",
								text: "un momento por favor.",
								imageUrl: "../../js/sweet/3red.gif",
								timer: 2000,
								showConfirmButton: false
							});
							return false;
							$("#email").focus();
						}
						else{
							$("#grabar").show();
							$("#borrar").show();							
						}
					},
					error: function(xhr) { // if error occured
						alert("Error ha ocurrido.");
					},
					complete: function() {					
						$("#ecarga").html('');
					},				
				});	
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
		
		$("#numerodocumento").blur(function(){
			
			var iden = $(this).val();
			var idtabla = "<?php echo $idtabla; ?>";
			$.ajax({
				data: {"iden": iden, "idtabla": idtabla, "par": "i"},
				type: 'POST',
				dataType: "html",
				url: "../forms/buscaiden.php",				
				
				beforeSend: function() {					
					$("#carga").html('<img src="../../images/ajax-loader.gif">');					
					$("#grabar").hide();
					$("#borrar").hide();
					
					$("#nombre").prop('disabled', true);
					$("#apellido1").prop('disabled', true);
					$("#apellido2").prop('disabled', true);
				},
				success: function(data) {					
					if( data == "N")
					{
						swal({
							title: "Atención :  Existe un usuario registrado con ese Nro. de Identificación.",
							text: "un momento por favor.",
							imageUrl: "../../js/sweet/3red.gif",
							timer: 2000,
							showConfirmButton: false
						});
						return false;   
						$("#numerodocumento").focus();
					}
					else{
						$("#grabar").show();
						$("#borrar").show();
						$("#nombre").prop('disabled', false);
						$("#apellido1").prop('disabled', false);
						$("#apellido2").prop('disabled', false);
					}
				},
				error: function(xhr) { // if error occured
					alert("Error ha ocurrido.");
				},
				complete: function() {					
					$("#carga").html('');
				},				
			});	
		});
		
		$("#nombre").blur(function(){
			var nom = $(this).val();
			var ape1 = $("#apellido1").val();
            var ape2 = $("#apellido2").val();
			//validanom(nom, ape1, ape2);
		});
		
		$("#apellido1").blur(function(){
			var nom = $("#nombre").val();
			var ape1 = $(this).val();
            var ape2 = $("#apellido2").val();
			//validanom(nom, ape1, ape2);
		});
		
		$("#apellido2").blur(function(){
			var nom = $("#nombre").val();			
            var ape1 = $("#apellido1").val();
			var ape2 = $(this).val();
			//validanom(nom, ape1, ape2);
		});		
		
		
		$("#tipousuario").on("change", function(){
			var tu = $("#tipousuario").val();			
			if(tu == 2){
				$('input[name=abogado][value=1]').prop('checked', true); 
			}
			else{
				$('input[name=abogado][value=0]').prop('checked', true);
			}			
		});
		
		$('input[type=radio][name=abogado]').on('change', function(e) {
            e.preventDefault();
			var abogado = $('input:radio[name=abogado]:checked').val();
			var idtabla =  "<?php echo $idtabla; ?>";			
			$.ajax({
				data : {"idtabla": idtabla },
				type: "POST",
				dataType: 'text',	
				url : "../forms/verusuario.php",
			})
			.done(function( dataX, textStatus, jqXHR ){	    			    
				var xrespstr = dataX;				
				if( xrespstr > 0 )
				{
					swal("Atencion: ", "No puede cambiar a NO Abogado porque tiene "+xrespstr+" Procesos activos.", "success");
					 $('input:radio[name="abogado"][value="1"]').prop('checked', true);
					return false;
				}
				/*
				else
				{
					swal({
						title: "Atencion: ",   
						text: msj,   
						type: "error" 
					});
					return false;  
				}
				*/
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
				//e.stopPropagation();
				if ( console && console.log ) 
				{						
					console.log( "La solicitud a fallado: " +  textStatus);
					$("#msj").html("");
				}
			});
			
        });
		
		$("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'usu_usuario.php';
        });


        $("#form_validation").click(function() {
			$("#msj").html("");
		})
		
		$("#grabar").on('click', function(e) {
            $("#mensaje").hide();
            var tipodocumento = $("#tipodocumento").val();
			var empresa = $("#empresa").val();
            var numerodocumento = $("#numerodocumento").val();
			var tp = $("#tp").val();
            var nombre = $("#nombre").val();
            var apellido1 = $("#apellido1").val();
            var apellido2 = $("#apellido2").val();
            var clave = $("#clave").val();            
            var direccion = $("#direccion").val();
            var email = $("#email").val();
            var celular = $("#celular").val();            
            var tipousuario = $("#tipousuario").val();			
			var estado = $('input:radio[name=estado]:checked').val();
			var abogado = $('input:radio[name=abogado]:checked').val();
			var idtabla =  "<?php echo $idtabla; ?>";
            var OldClave = "<?php echo $Clave; ?>";
            if( empresa == "" || tipodocumento == "" || numerodocumento =="" || nombre == "" || apellido1 == "" || clave =="" || direccion == "" || email == "" || celular == "" || estado == undefined  || tipousuario == "" || abogado == "" )
            {               
                swal({
                  title: "Atención:  Ingrese información en los campos Obligatorios, marcados con *",
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
    				data : {"empresa": empresa, "tipodocumento": tipodocumento, "numerodocumento": numerodocumento, "nombre": nombre, "apellido1": apellido1, "apellido2": apellido2, "clave": clave, "direccion": direccion, "email": email, "celular": celular, "estado": estado, "tipousuario": tipousuario, "idtabla": idtabla, "OldClave": OldClave, "abogado": abogado, "tp": tp },
    				type: "POST",				
    				url : "../forms/editar_usuario.php",
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
            var nomtabla = "<?php echo $NombreAlumno; ?>";

            alertify.confirm( 'Desea borrar este registro?', function (e) {
                if (e) {
                    //after clicking OK
                    $.ajax({
                        data : {"pidtabla": idtabla},
                        type: "POST",
                        dataType: "html",
                        url : "../forms/borrar_usuario.php",
                    })  
                    .done(function( dataX, textStatus, jqXHR ){                       
                        var xrespstr = dataX.trim();
                        var respstr = xrespstr.substr(0,1);
                        var msj = xrespstr.substr(2);         
                        if( respstr == "S" )
                        {            
                            swal("Atencion: ", msj, "success");
                        }
                        else
                        {                    
                            //$("#mensaje").hide();
                            //$("#form_validation").show();
                            //$("#msj").html('<div class="alert alert-danger"><span class="glyphicon-hand-right"></span><strong>  Atención: </strong> <?php echo $Tabla; ?> NO Borrada.</div>').fadeIn(3000);
                            swal({
                                title: "Atencion: ",   
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