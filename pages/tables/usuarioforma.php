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
$NombreTabla ="USUARIOS";
$idTabla = 0;
require_once('../../apis/empresa/Empresa.php');
require_once('../../apis/general/tipodocumento.php');
require_once('../../apis/general/tipousuario.php');

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

    <script type="text/javascript">
    var nombre ="";
    $(document).ready(function()
    {       
        $('#activo').prop("checked", true);
        $("#msj").hide();
        $("#numerodocumento").numeric();
        $("#celular").numeric();
        $("#telefonoFijo").numeric();

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

        $("#numerodocumento").blur(function(){
			
			var iden = $(this).val();
			var idtabla = 0;
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
            window.location = 'usu_usuario.php';
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
        

        $("#grabar").on('click', function(e) {
			var empresa = $("#empresa").val();
            var tipodocumento = $("#tipodocumento").val();
            var numerodocumento = $("#numerodocumento").val();
            var nombre = $("#nombre").val();
            var apellido1 = $("#apellido1").val();
            var apellido2 = $("#apellido2").val();
            var clave = $("#clave").val();            
            var direccion = $("#direccion").val();
            var email = $("#email").val();
            var celular = $("#celular").val();
            var tipousuario = $("#tipousuario").val();            
			var abogado = $('input:radio[name=abogado]:checked').val();            
            var estado = $('input:radio[name=estado]:checked').val();
            e.preventDefault();

            if( empresa== "" || tipodocumento == "" || numerodocumento =="" || nombre == "" || apellido1 == "" || direccion == "" || email == "" || celular == "" || estado == undefined || tipousuario == "" || abogado == "" || clave == "" )
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
                    data : {"empresa": empresa, "tipodocumento": tipodocumento, "numerodocumento": numerodocumento, "nombre": nombre, "apellido1": apellido1, "apellido2": apellido2, "clave": clave, "direccion": direccion, "email": email, "celular": celular, "estado": estado, "tipousuario": tipousuario, "abogado": abogado}, 
                    type: "POST",
                    dataType: "html",
                    url : "../forms/crea_usuario.php",
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
    <section class="content" style="margin-top:80px;">
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
										<div class="col-md-8"><span style="color:red;">*</span> 
											<label class="form-label">
												Empresa
											</label>                                    
                                                                               
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="empresa" id="empresa" required>
                                             <option value="" >Seleccione Opción...</option>
											 <option value="0" >Nombre Propio...</option>
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
															<option value="<?php echo $EMP_IdEmpresa; ?>" >
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
                                        
										<div class="col-md-4"><span style="color:red;">*</span> 
											<label class="form-label">N&uacute;mero Documento</label>
											<div class="form-line">
											   <input type="text" class="form-control" name="numerodocumento" id="numerodocumento" value="" maxlength="13" required>
                                               <div id="carga"></div>
											</div>
										</div> 
									</div>
                                </div>

                                <div class="form-group form-float">
									<div class="row">
										<div class="col-md-4"><span style="color:red;">*</span> 
											<label class="form-label">Nombre</label>
											<div class="form-line">
												<input type="text" class="form-control" name="nombre" id="nombre" value="" required>											   
											</div>
										</div>
										
										<div class="col-md-4"><span style="color:red;">*</span> 
											<label class="form-label">Primer Apellido</label>
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

                                <div class="form-group form-float">
									<div class="row">										
										<div class="col-md-8"><span style="color:red;">*</span> 
											<label class="form-label">Direcci&oacute;n</label>
											<div class="form-line">
												<input type="text" class="form-control" name="direccion" id="direccion" value="" maxlength="50" required>										   
											</div>
										</div>
										<div class="col-md-4"><span style="color:red;">*</span>                                
											<label class="form-label">Celular</label>
											<div class="form-line">
												<input type="text" class="form-control" name="celular" id="celular" value="" maxlength="13" required>
											</div>
										</div>
									</div>
                                </div>
								
                                <div class="form-group form-float">
									<div class="row">
										<div class="col-md-8"><span style="color:red;">*</span> 
											<label class="form-label">Email</label>
											<div class="form-line">
												<input type="text" class="form-control" name="email" id="email" value="" maxlength="60" required>                                       
											</div>
										</div>
										<div class="col-md-4"><span style="color:red;">*</span>
											<label class="form-label">Clave</label>
											<div class="form-line">
												<input type="password" class="form-control" name="clave" id="clave" value="" maxlength="30" required>										   
											</div>
										</div>										
									</div>
                                </div> 

                                <div style="form-group form-float">
									<div class="row">
										<div class="col-md-7"><span style="color:red;">*</span> 
											<label class="form-label">
												Tipo Usuario
											</label>                                    
											                                       
												<select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="tipousuario" id="tipousuario" required>
													<option value="" >Seleccione Opción...</option>
													<?php
														for($i=0; $i<count($mtipousuario['usu_tipousuario']); $i++)
														{
															$TUS_IdTipoDocumento = $mtipousuario['usu_tipousuario'][$i]['TUS_ID_TipoUsuario'];                                                    
															$TUS_Nombre = $mtipousuario['usu_tipousuario'][$i]['TUS_Nombre'];
															$TUS_Estado = $mtipousuario['usu_tipousuario'][$i]['TUS_Estado'];
													?>
															<option value="<?php echo $TUS_IdTipoDocumento; ?>" >
																<?php echo $TUS_Nombre ; ?>                                                
															</option>
													<?php
														}
													?>
												</select>
											
										</div>
										<div class="col-md-5"><span style="color:red;">*</span> 
											<label class="form-label">Abogado</label>
											<input type="radio" name="abogado" id="si" class="with-gap" value="1">
											<label for="si">Si</label>

											<input type="radio" name="abogado" id="no" class="with-gap" value="0">
											<label for="no" class="m-l-20">No</label>
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