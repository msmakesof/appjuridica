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


$idTabla = 0;
require_once('../../apis/general/tipodocumento.php');
require_once('../../apis/general/tipocliente.php');

if( isset($_GET['f'])  && !empty($_GET['f']) )
{    
    $idTabla = trim($_GET['f']);
}
$Tabla ="CLIENTE";
$strowreg =0;
$idtabla = 0;
$row_rs_tabla = 0;
$Nombreciudad = "";

require_once('../../apis/cliente/infoCliente.php');

$idtabla = $mcliente['cli_cliente']['CLI_IdCliente'];
$TipoDocumento = $mcliente['cli_cliente']['CLI_TipoDocumento'];
$NumeroDocumento = trim($mcliente['cli_cliente']['CLI_Identificacion']);
$Apellido1 = trim($mcliente['cli_cliente']['CLI_PrimerApellido']);
$Apellido2 = trim($mcliente['cli_cliente']['CLI_SegundoApellido']);
$NombreAlumno = trim($mcliente['cli_cliente']['CLI_Nombre']);
$Email = trim($mcliente['cli_cliente']['CLI_Email']);
$Direccion = trim($mcliente['cli_cliente']['CLI_Direccion']);
$Celular = trim($mcliente['cli_cliente']['CLI_Celular']);
$Usuario = trim($mcliente['cli_cliente']['CLI_Usuario']);
$Clave = $mcliente['cli_cliente']['CLI_Clave'];
$EstadoEst = $mcliente['cli_cliente']['CLI_Estado'];
$TipoCliente = $mcliente['cli_cliente']['CLI_IdTipoCliente'];
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
                                    <div style="float: left;">                                    
                                        <label class="form-label">
                                            Tipo Documento
                                        </label>                                    
                                        <div class="col-sm-4">
                                           <input type="hidden" class="form-control" name="IdEstudiante" id="IdEstudiante" value="<?php echo $idtabla ;?>" readonly>
                                            <select class="form-control show-tick" data-live-search="true" name="tipodocumento" id="tipodocumento" required>
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
                                    </div>                                    
                                    <!-- </div>
                                    <div class="form-group form-float"> -->
                                    <div style="float: left;">
                                        <label class="form-label">Número Documento</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="numerodocumento" id="numerodocumento" value="<?php echo $NumeroDocumento ;?>" maxlength="13" required>
										</div>
									</div>    
								</div>

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Nombre Usuario</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $NombreAlumno ;?>" required>
                                       <!-- -->
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Primer Apellido</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="apellido1" id="apellido1" value="<?php echo $Apellido1 ;?>" required>
                                       <!-- -->
                                    </div>
                                </div>  

                                <div class="form-group form-float">
                                    <label class="form-label">Segundo Apellido</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="apellido2" id="apellido2" value="<?php echo $Apellido2 ;?>" required>
                                       <!-- -->
                                    </div>
                                </div>                                
                                

                                 <div class="form-group form-float">
                                    <label class="form-label">Clave</label>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="clave" id="clave" value="<?php echo $Clave ;?>" maxlength="30" required>
                                       
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Dirección</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $Direccion ;?>" maxlength="50" required>
                                       <!-- -->
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Email</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $Email ;?>" maxlength="60" required>
                                       <!-- -->
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                     <label class="form-label">Celular</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="celular" id="celular" value="<?php echo $Celular ;?>" maxlength="13" required>
                                       <!---->
                                    </div>
                                </div>                              
                                

                                <div class="form-group form-float">
                                    <label class="form-label">Tipo Usuario</label>
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick" data-live-search="true" name="tipocliente" id="tipocliente" required>
                                            <!-- <option value="">-- Seleccione --</option> -->
                                            <?php                                                 
                                                 for($i=0; $i<count($mtipocliente['cli_tipocliente']); $i++)
                                                {           
                                                    $TCL_IdTipoCliente = $mtipocliente['cli_tipocliente'][$i]['TCL_IdTipoCliente'];                                                    
                                                    $TCL_Nombre = $mtipocliente['cli_tipocliente'][$i]['TCL_Nombre'];
                                                    $TCL_Estado = $mtipocliente['cli_tipocliente'][$i]['TCL_Estado'];
                                            ?>                                            
                                            <option value="<?php echo $TCL_IdTipoCliente; ?>" <?php if ($TCL_IdTipoCliente == $TipoCliente){ echo "selected";} else{ echo "";} ?>>
                                                <?php echo $TCL_Nombre ; ?>                                                
                                            </option>
                                            <?php                    
                                                } 
                                            ?>
                                        </select>
                                    </div>   
                                </div>
                                
                                <div class="form-group">
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $EstadoEst == 1){?>checked="checked"<?php } ?>>
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2"<?php if( $EstadoEst == 2){?>checked="checked"<?php } ?>>
                                    <label for="inactivo" class="m-l-20">Inactivo</label>
                                    
                                </div>
                                                               
                                <button class="btn btn-primary waves-effect" type="button" id="grabar">GRABAR</button>
                               <!--  <button type="button" class="btn btn-danger waves-effect" id="borrar" onclick="borrarc(<?php echo $idtabla ; ?>);">BORRAR</button> -->
                                <button type="button" class="btn btn-danger waves-effect" id="borrar">BORRAR</button>
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
        $("#numerodocumento").numeric();
        $("#celular").numeric();
        //$("#telefonoFijo").numeric(); 
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


        $("#form_validation").click(function() {
			$("#msj").html("");
		})
		
		$("#grabar").on('click', function(e) {
            $("#mensaje").hide();
            var tipodocumento = $("#tipodocumento").val();
            var numerodocumento = $("#numerodocumento").val();
            var nombre = $("#nombre").val();
            var apellido1 = $("#apellido1").val();
            var apellido2 = $("#apellido2").val();
            var clave = $("#clave").val();            
            var direccion = $("#direccion").val();
            var email = $("#email").val();
            var celular = $("#celular").val();            
            var tipocliente = $("#tipocliente").val();			
			var estado = $('input:radio[name=estado]:checked').val();
			var idtabla =  "<?php echo $idtabla; ?>";
            var OldClave = "<?php echo $Clave; ?>";
            if( tipodocumento == "" || numerodocumento =="" || nombre == "" || apellido1 == "" || apellido2 == "" || clave =="" || direccion == "" || email == "" || celular == "" || estado == undefined  || tipocliente == "" )
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
    				data : {"tipodocumento": tipodocumento, "numerodocumento": numerodocumento, "nombre": nombre, "apellido1": apellido1, "apellido2": apellido2, "clave": clave, "direccion": direccion, "email": email, "celular": celular, "estado": estado, "tipocliente": tipocliente, "idtabla": idtabla, "OldClave": OldClave },
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
            var nomtabla = "<?php echo $NombreAlumno; ?>";

            alertify.confirm( 'Desea borrar este registro?', function (e) {
                if (e) {
                    //after clicking OK
                    $.ajax({
                        data : {"pidtabla": idtabla},
                        type: "POST",
                        dataType: "html",
                        url : "../forms/borrar_<?php echo strtolower($Tabla); ?>.php",
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