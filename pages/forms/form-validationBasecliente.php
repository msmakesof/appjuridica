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
$NombreTabla ="CLIENTE";
$idTabla = 0;
require_once('../../apis/general/tipodocumento.php');
require_once('../../apis/general/tipocliente.php');

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
        

        $("#grabar").on('click', function(e) { 
            //nombre = $("#nombre").val();            
            //var estado = $('input:radio[name=estado]:checked').val();

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
            //var telefonofijo = $("#telefonofijo").val();
            //var sucursal = $("#sucursal").val();            
            var estado = $('input:radio[name=estado]:checked').val();
            e.preventDefault();

            if( tipodocumento == "" || numerodocumento =="" || nombre == "" || apellido1 == "" || apellido2 == "" || clave =="" || direccion == "" || email == "" || celular == "" || estado == undefined || tipocliente == "" )
            {
               //swal("Atencion:", "Estudiante " + nombre + " !Ya se encuentra registrado(a)...");
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
                    data : {"tipodocumento": tipodocumento, "numerodocumento": numerodocumento, "nombre": nombre, "apellido1": apellido1, "apellido2": apellido2, "clave": clave, "direccion": direccion, "email": email, "celular": celular, "estado": estado, "tipocliente": tipocliente}, 
                    type: "POST",
                    dataType: "html",
                    url : "crea_<?php echo strtolower($NombreTabla); ?>.php",
                })  
                .done(function( data, textStatus, jqXHR){                 
                    var xrespstr = data.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);
                    if(respstr == "E")
                    {                         
                       //swal("Atencion:", "Usuario: " + nombre + " !Ya se encuentra registrado(a)...");
                       swal("Atención:", msj);
                    }
                    else
                    {    
                        if( respstr == "S" )
                        {                        
                            swal("Atención: ", msj, "success");
                            return false;
                            //window.location="../alumnos.php";
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
                        //$('#form_validation')[0].reset();
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
      
     <section class="content" style="margin-top:15px;">
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
                                    <div style="float: left;">                                     
                                        <label class="form-label">
                                            Tipo Documento
                                        </label>                                    
                                        <div class="col-sm-4">                                       
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
                                    </div>                                        
                                    <!-- /div>

                                    <div class="form-group form-float"> -->
                                    <div style="float: left;"> 
                                        <label class="form-label">N&uacute;mero Documento..</label>
                                        <div class="form-line">
                                           <input type="text" class="form-control" name="numerodocumento" id="numerodocumento" value="" maxlength="13" required>
                                        </div>
                                    </div>    
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Nombre Usuario</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="" required>
                                       <!-- -->
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Primer Apellido</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="apellido1" id="apellido1" value="" required>
                                       <!-- -->
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Segundo Apellido</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="apellido2" id="apellido2" value="" required>
                                       <!-- -->
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Clave</label>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="clave" id="clave" value="" maxlength="30" required>
                                       
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Direcci&oacute;n</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="" maxlength="50" required>
                                       <!-- -->
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Email</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="email" id="email" value="" maxlength="60" required>
                                       <!-- -->
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                     <label class="form-label">Celular</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="celular" id="celular" value="" maxlength="13" required>
                                       <!---->
                                    </div>
                                </div> 

                                <div style="form-group form-float">                                     
                                    <label class="form-label">
                                        Tipo Cliente
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="tipocliente" id="tipocliente" required>
                                            <option value="" >Seleccione Opción...</option>
                                            <?php
                                                for($i=0; $i<count($mtipocliente['cli_tipocliente']); $i++)
                                                {
                                                    $TCL_IdTipoCliente = $mtipocliente['cli_tipocliente'][$i]['TCL_IdTipoCliente'];                                                    
                                                    $TCL_Nombre = $mtipocliente['cli_tipocliente'][$i]['TCL_Nombre'];
                                                    $TCL_Estado = $mtipocliente['cli_tipocliente'][$i]['TCL_Estado'];
                                            ?>
                                                    <option value="<?php echo $TCL_IdTipoCliente; ?>" >
                                                        <?php echo $TCL_Nombre ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- 
                                <div class="form-group form-float">
                                    <label class="form-label">Telefono Fijo</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="telefonoFijo" id="telefonoFijo" value="" maxlength="7" required>
                                       
                                    </div>
                                </div>
                                -->

                                <!-- <div class="form-group form-float">
                                    <label class="form-label">Sede</label>
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick" data-live-search="true" name="sucursal" id="sucursal" required>
                                            <option value="">-- Seleccione Sede --</option>
                                            <?php                                                 
                                                //do                                                 
                                                //{           
                                                //    $idSucursal = $row_rs_sucusuarios["IdSucursal"];
                                                //    $NombreSucursal = $row_rs_sucusuarios["NombreSucursal"];
                                                //    $EstadoSucursal = $row_rs_sucusuarios["EstadoSucursal"];
                                            ?>
                                            <option value="<?php //echo $idSucursal; ?>" >
                                                <?php //echo $NombreSucursal; ?>                                                
                                            </option>
                                            <?php                    
                                                //} while($row_rs_sucusuarios = mysqli_fetch_assoc($rs_sucusuarios));
                                            ?>
                                        </select>
                                    </div>   
                                </div>                               -->
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Estado</label>
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1">
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2">
                                    <label for="inactivo" class="m-l-20">Inactivo</label>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit" id="grabar">GRABAR</button>

                                <!-- <div id="g" class='alert'>GRabado</div> -->
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