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
$NombreTabla ="PROCESO";
$idTabla = 0;
require_once('../../apis/usuario/infoUsuario.php');
require_once('../../apis/proceso/ubicacion.php');
require_once('../../apis/proceso/claseproceso.php');
require_once('../../apis/juzgado/juzgado.php');
require_once('../../apis/general/area.php');
$yy = date("Y");

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

    <script src="../../js/jquery.numeric.js"></script>

    <!-- DateTime picker -->
    <script src="../../calendar/js/moment.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.es.js"></script>    

    <script type="text/javascript">
    var nombre ="";
    $(document).ready(function()
    {       
        $("#msj").hide();
        $('#zip').numeric();
        $('#anio').numeric();
        $('#nproceso').numeric(); 
        $('.selectpicker').selectpicker();
        $('#fechainicio').datetimepicker({
          format: 'YYYY-MM-DD'       
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

            var nombre = $("#proceso").val();
            //nombre = nombre.toUpperCase();
            fechainicio = $("#txtFecha").val();
            usuario = $("#usuario").val();
            ubicacion = $("#ubicacion").val();
            claseproceso = $("#claseproceso").val();
            juzgado = $("#juzgado").val();
            var estado = $('input:radio[name=estado]:checked').val();
            e.preventDefault();
            if( estado == undefined || nombre == "" || fechainicio == "" || usuario == "" || ubicacion == "" || claseproceso == "" || juzgado == "" )
            {                 
                swal("Atencion:", "Debe digitar un Nombre y/o seleccionar un Estado y/o Fecha de Inicio  y/o Usuario  y/o Ubicacion  y/o  clase Proceso  y/o  Juzgado.");
                e.stopPropagation();
                return false;
            }
            else
            {
                $.ajax({
                    data : {"pnombre": nombre, "pfechainicio": $fechainicio, "pusuario": $usuario, "pubicacion": $ubicacion, "pclaseproceso": $claseproceso ,"pjuzgado": $juzgado,"pestado": estado},
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
                            <form id="form_validation" method="POST"  autocomplete="ÑÖcompletes">

                                <div class="form-group" style="clear: both; margin-top:15px;">

                                    <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-5">                                                
                                                <label class="form-label">Zip:</label>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="zip"id="zip" value="" maxlength="5" autocomplete="ÑÖcompletes" required>                                                
                                                </div>
                                            </div>

                                            <div class="col-xs-7">                                                
                                                <label class="form-label">Area:</label>
                                                <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="area" id="area" required>
                                                    <option value="" >Seleccione Area...</option>
                                                <?php
                                                    for($i=0; $i<count($marea['juz_area']); $i++)
                                                    {
                                                        $ARE_IdArea = $marea['juz_area'][$i]['ARE_IdArea'];                                                
                                                        $ARE_Nombre = $marea['juz_area'][$i]['ARE_Nombre'];                                                
                                                ?>
                                                        <option value="<?php echo $ARE_IdArea; ?>" >
                                                            <?php echo $ARE_Nombre ; ?>                                                
                                                        </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                

                                <div class="form-group ">                               
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <label class="form-label">Juzgado:</label>                                        
                                                <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="juzgado" id="juzgado" required>
                                                <option value="" >Seleccione Juzgado...</option>
                                                <?php
                                                    for($i=0; $i<count($mjuzgado['juz_juzgado']); $i++)
                                                    {
                                                        $JUZ_IdJuzgado = $mjuzgado['juz_juzgado'][$i]['JUZ_IdJuzgado'];                                                
                                                        $JUZ_Ubicacion = $mjuzgado['juz_juzgado'][$i]['JUZ_Ubicacion'];                                                
                                                ?>
                                                        <option value="<?php echo $JUZ_IdJuzgado; ?>" >
                                                            <?php echo $JUZ_Ubicacion ; ?>                                                
                                                        </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-5">
                                                <label class="form-label">Año</label>                                        
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="anio" id="anio" value="<?php echo $yy; ?>" maxlength="4" autocomplete="ÑÖcompletes" required>
                                                    <label class="form-label"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                
                                
                                <div class="form-group" style="clear: both;">                                    
                                    
                                    <div class="form-group form-float" style="clear: both;">
                                        <label class="form-label">&nbsp;</label>
                                        <!-- <div style="float: left;"> -->
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nproceso"id="nproceso" value="" maxlength="5" autocomplete="off" required>
                                                <label class="form-label">Proceso:</label>   
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div> 

                                    <div class="form-group form-float" style="clear: both;">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="proceso"id="proceso" value="" maxlength="23" required>
                                            <label class="form-label">Proceso:</label>   
                                        </div>
                                    </div> 

                                <div class="form-group" style="clear: both;">
                                    <div style="float: left;">
                                        <label class="form-label">Fecha Inicio</label>
                                        <div class="col-sm-6">
                                            <div class='input-group date form-line' name="fechainicio" id="fechainicio" required>
                                                <input type='text' id="txtFecha" class="form-control" value="" readonly/>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>        
                                        </div>
                                    </div>    
                                </div> 
                                
                                <div class="form-group form-float" style="clear: both;">
                                    <div style="float: left;">                                     
                                        <label class="form-label">
                                            Asignado a:
                                        </label>                                    
                                        <div class="col-sm-6 row">                                       
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="usuario" id="usuario" required>
                                            <option value="" >Seleccione Asignado...</option>
                                            <?php
                                                for($i=0; $i<count($muser['usu_usuario']); $i++)
                                                {
                                                    $USU_IdUsuario = $muser['usu_usuario'][$i]['USU_IdUsuario'];                                                
                                                    $USU_Nombre = $muser['usu_usuario'][$i]['NombreUsuario'];                                                
                                            ?>
                                                    <option value="<?php echo $USU_IdUsuario; ?>" >
                                                        <?php echo $USU_Nombre ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>                                       
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <div style="float: left;">                                     
                                        <label class="form-label">
                                        Ubicación:
                                        </label>                                    
                                        <div class="col-sm-6 row">                                       
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="ubicacion" id="ubicacion" required>
                                            <option value="" >Seleccione Ubicación...</option>
                                            <?php
                                                for($i=0; $i<count($mubicacion['pro_ubicacion']); $i++)
                                                {
                                                    $UBI_IdUbicacion = $mubicacion['pro_ubicacion'][$i]['UBI_IdUbicacion'];                                                
                                                    $UBI_Nombre = $mubicacion['pro_ubicacion'][$i]['UBI_Nombre'];                                                
                                            ?>
                                                    <option value="<?php echo $UBI_IdUbicacion; ?>" >
                                                        <?php echo $UBI_Nombre ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>                                       
                                </div>


                                <div class="form-group form-float" style="clear: both;">
                                    <div style="float: left;">                                     
                                        <label class="form-label">
                                        Clase Proceso:
                                        </label>                                    
                                        <div class="col-sm-6 row">                                       
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="claseproceso" id="claseproceso" required>
                                            <option value="" >Seleccione Clase Proceso...</option>
                                            <?php
                                                for($i=0; $i<count($mclaseproceso['pro_claseproceso']); $i++)
                                                {
                                                    $CPR_IdClaseProceso = $mclaseproceso['pro_claseproceso'][$i]['CPR_IdClaseProceso'];                                                
                                                    $CPR_Nombre = $mclaseproceso['pro_claseproceso'][$i]['CPR_Nombre'];                                                
                                            ?>
                                                    <option value="<?php echo $CPR_IdClaseProceso; ?>" >
                                                        <?php echo $CPR_Nombre ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>                                       
                                </div>
                                
                                <div class="form-group form-float" style="clear: both;">
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