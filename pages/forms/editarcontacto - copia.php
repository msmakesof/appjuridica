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
$idTabla = 0;
if( isset($_POST['id']) && !empty($_POST['id']) )
{    
    $pid = trim($_POST['id']);   
}
$Tabla ="CONTACTOEMPRESA";
$idtabla = 0;
//$NombreTabla ="EMPRESA";
//
$idTabla = 0;
$fechacreado = date("Y-m-d H:i:s");
require_once('../../apis/general/tipodocumento.php');
require_once('../../apis/general/ciudad.php');
$idTabla = $pid;
require_once('../../apis/empresa/infoContacto.php');

$IdContacto = $emp_contactoempresa['emp_contactoempresa']['COE_IdContacto'];
$Identificacion = $emp_contactoempresa['emp_contactoempresa']['COE_Identificacion'];
$Apellido1 = $emp_contactoempresa['emp_contactoempresa']['COE_Apellido1'];
$Apellido2 = $emp_contactoempresa['emp_contactoempresa']['COE_Apellido2'];
$Nombre1 = $emp_contactoempresa['emp_contactoempresa']['COE_Nombre1'];
$Nombre2 = $emp_contactoempresa['emp_contactoempresa']['COE_Nombre2'];
$IdTipoDocumento = $emp_contactoempresa['emp_contactoempresa']['COE_IdTipoDocumento'];
$Email = $emp_contactoempresa['emp_contactoempresa']['COE_Email'];
$Fijo = $emp_contactoempresa['emp_contactoempresa']['COE_Fijo'];
$Celular = $emp_contactoempresa['emp_contactoempresa']['COE_Celular'];
$Ciudad = $emp_contactoempresa['emp_contactoempresa']['COE_Ciudad'];
$Estado = $emp_contactoempresa['emp_contactoempresa']['COE_Estado'];
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
    
     <section class="content" style="margin-top:45px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORMULARIO CONTACTO: <?php echo $Tabla; ?> - <?php //echo strtoupper($pne); ?>.
                    <small>acción: Crear.</small>
                </h2>
            </div>
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>REGISTRO EDICION DE <?php echo $Tabla; ?>..</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>                                    
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">

								<div class="form-group form-float"> 
									<div class="row">
									
										<div class="col-md-4">										
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
														<option value="<?php echo $TDO_IdTipoDocumento; ?>" <?php if(trim($TDO_IdTipoDocumento) == trim($IdTipoDocumento)){ echo "selected/=selected/";} else{ echo "";} ?>>
															<?php echo $TDO_Nombre ; ?>                                                
														</option>
												<?php
													}
												?>
											</select>
										</div>
									
										<div class="col-md-4">
											<label class="form-label">N&uacute;mero Documento</label>
											<div class="form-line">
											   <input type="text" class="form-control" name="numerodocumento" id="numerodocumento" value="<?php echo $Identificacion; ?>" maxlength="13" required>
											</div>
										</div>
									</div> 									
                                </div>
							
								
								<div class="form-group form-float" id="pnat">
									<div class="row">
										<div class="col-md-3">
											<label class="form-label">Primer Nombre</label>
											<div class="form-line">
												<input type="text" class="form-control" name="nombre1" id="nombre1" value="<?php echo $Nombre1; ?>" required>											   
											</div>
										</div>
									
										<div class="col-md-3">
											<label class="form-label">Segundo Nombre</label>
											<div class="form-line">
												<input type="text" class="form-control" name="nombre2" id="nombre2" value="<?php echo $Nombre2; ?>" required>											   
											</div>
										</div>
									
										<div class="col-md-3">
											<label class="form-label">Primer Apellido</label>
											<div class="form-line">
												<input type="text" class="form-control" name="apellido1" id="apellido1" value="<?php echo $Apellido1; ?>" required>											   
											</div>
										</div>
									
										<div class="col-md-3">
											<label class="form-label">Segundo Apellido</label>
											<div class="form-line">
												<input type="text" class="form-control" name="apellido2" id="apellido2" value="<?php echo $Apellido2; ?>" required>											   
											</div>
										</div>
									</div>
								</div>
                                
                                <div class="form-group form-float">
									<div class="row">
										<div class="col-md-7">
											<label class="form-label">Email</label>
											<div class="form-line">
											   <input type="text" class="form-control" name="email" id="email" value="<?php echo $Email; ?>" maxlength="60" required>                                       
											</div>
										</div>
										
										<div class="col-md-4">										
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
														<option value="<?php echo $CIU_IdCiudades; ?>" <?php if(trim($CIU_IdCiudades) == trim($Ciudad)){ echo "selected/=selected/";} else{ echo "";} ?>>
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
												<input type="text" class="form-control" name="fijo" id="fijo" value="<?php echo $Fijo; ?>" maxlength="10" required>                                       
											</div>
										</div>
										
										<div class="col-md-4">
											<label class="form-label">Celular</label>
											<div class="form-line">
												<input type="text" class="form-control" name="celular" id="celular" value="<?php echo $Celular; ?>" maxlength="13" required>                                       
											</div>
										</div>                                
									</div>									
                                </div>
								
                                <div class="form-group form-float">
                                    <label class="form-label">Estado</label>
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $Estado == 1){?>checked="checked"<?php } ?>>
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2" <?php if( $Estado == 2){?>checked="checked"<?php } ?>>
                                    <label for="inactivo" class="m-l-20">Inactivo</label>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit" id="grabar">GRABAR</button>
								<!--
								<button class="btn btn-danger waves-effect" onClick="cerrar(<?php echo $pid; ?>, '<?php echo $pne; ?>', <?php echo $pie; ?>)">SALIR</button>
                                -->
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
			
			$.ajax({
				data : {"nombre": nombre, "abreviatura": abreviatura, "depto": depto, "estado": estado, "idtabla": idtabla},
				type: "POST",
				dataType: "html",
				url : "editar_ciudad.php",
            })  
			.done(function( dataX, textStatus, jqXHR ){	
			    // 				
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
		});

	
    $("#borrar").on('click', function() {   
        var idtabla  = "<?php echo $idtabla; ?>";        
        var nomtabla = "<?php echo $Nombre; ?>";

        alertify.confirm( 'Desea borrar este registro?', function (e) {
            if (e) {
                //after clicking OK
                $.ajax({
                    data : {"pidtabla": idtabla},
                    type: "POST",
                    dataType: "html",
                    url : "../forms/borrar_ciudad.php",
                })  
                .done(function( dataX, textStatus, jqXHR ){                       
                    var xrespstr = dataX.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);        
                    if( respstr == "S" )
                    {            
                       swal("Atención: ", msj, "success");                  
                    }
                    else
                    {                    
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