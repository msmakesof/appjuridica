<?php
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php');
/*
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
*/
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
$NombreTabla ="JUZGADO";
$idTabla = 0;
require_once('../../apis/general/ciudad.php');
require_once('../../apis/general/piso.php');
require_once('../../apis/general/edificio.php');
require_once('../../apis/general/tipojuzgado.php');
require_once('../../apis/general/area.php');
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
    
    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery-2.1.1.js"></script>
    
    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />   

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../../css/sweet/sweetalert.css" rel="stylesheet" />
    <link href="../../css/sweet/main.css" rel="stylesheet" />
  
    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="../../js/sweet/functions.js"></script>
    <script src="../../js/sweet/sweetalert.min.js"></script>
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

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
    <script src="../../js/jquery.numeric.js"></script>    

    <script type="text/javascript">
        function populateFruitVariety() {
            $.getJSON('../tables/urlink.php', {funcion: "ja", origen: $('#tipojuzgado').val()}, function (data) {
                var zdata= data.juz_areasxtipojuzgado;
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
                    options[options.length] = new Option(text.ARE_Nombre, text.ARE_IdArea);
                });
                select.val(selectedOption);
                $('#area').selectpicker('refresh');
            });
        }

        $(document).ready(function()
        {       
            $("#msj").hide();
            $("#ubicacion").numeric();
            $("#telefono").numeric();
            $("#piso").numeric();

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
            
            $('#tipojuzgado').change(function() {
                populateFruitVariety();
            });
			
			$('#edificio').on('change', function(e){
				var id = $('#edificio').val();				
				$.ajax({
					type: 'GET',					
					url: '../../consultadetalle/consultadetalle_gen_edificio.php?IdTabla='+id,
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function(respuesta) {						
						var dir = respuesta.gen_edificio.EDI_Direccion;
						$("#direccion").val(dir);
					},
					error: function() {
						console.log("No se ha podido obtener la información");
					}
				});
			});
			

            $("#grabar").on('click', function(e) { 
                var ubicacion = $("#ubicacion").val();               
                var ciudad = $("#ciudad").val();
                var direccion = $("#direccion").val();
                var telefono = $("#telefono").val();
                var piso = $("#piso").val();            
                var tipojuzgado = $("#tipojuzgado").val();
                var area = $("#area").val();            
                var estado = $('input:radio[name=estado]:checked').val();
				var edificio = $("#edificio").val();
				var email = $("#email").val();				
                e.preventDefault();

                if( ubicacion == "" || ciudad =="" || direccion == "" || piso == "" || tipojuzgado == "" || area == "" || edificio == "" || estado == undefined )
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
                        data : {"ubicacion": ubicacion, "ciudad": ciudad, "direccion": direccion, "telefono":telefono, "piso": piso, "tipojuzgado": tipojuzgado, "area": area, "estado": estado, "edificio": edificio, "email": email}, 
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
                            <form id="form_validation" method="POST">

                                <div style="form-group form-float"> 
                                    <label class="form-label">
                                        Tipo Corporaci&oacute;n
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="tipojuzgado" id="tipojuzgado" required>
                                            <option value="" >Seleccione Corporaci&oacute;n...</option>
                                            <?php
                                                for($i=0; $i<count($mtipojuzgado['juz_tipojuzgado']); $i++)
                                                {
                                                    $TJU_IdTipoJuzgado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_IdTipoJuzgado'];                                                    
                                                    $TJU_Nombre = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Nombre'];
                                                    $TJU_Estado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Estado'];
                                            ?>
                                                    <option value="<?php echo $TJU_IdTipoJuzgado; ?>" >
                                                        <?php echo $TJU_Nombre ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
								
								<div style="form-group form-float">                                     
                                    <label class="form-label">
                                    Especialidad - Area
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select id="area" name="area" class="selectpicker show-tick" data-live-search="true" data-width="80%" required>
                                            <option value="">-- Seleccione Especializacion.... --</option>
                                        </select> 
                                    </div>                                    
                                </div>                         
                                

                                <div class="form-group form-float" style="clear:both;">
                                    <label class="form-label">N&uacute;mero Despacho</label>
                                    <div class="form-line col-sm-4">                                        
                                        <input type="text" class="form-control" name="ubicacion" id="ubicacion" value="" maxlength="3" required>                                    
                                    </div>
                                </div>								
								
                                <div style="form-group form-float" style="clear:both;">                                     
                                    <label class="form-label" style="text-align:left;">
                                        Ciudad
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="ciudad" id="ciudad" required>
                                            <option value="" >Seleccione Ciudad...</option>
                                            <?php
                                                for($i=0; $i<count($mciudad['gen_ciudad']); $i++)
                                                {
                                                    $CIU_IdCiudades = $mciudad['gen_ciudad'][$i]['CIU_IdCiudades'];                                                    
                                                    $CIU_Nombre = $mciudad['gen_ciudad'][$i]['CIU_Nombre'];
                                                    $CIU_Estado = $mciudad['gen_ciudad'][$i]['CIU_Estado'];
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

								<div style="form-group form-float">                                     
                                    <label class="form-label">
                                        Edificio
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="edificio" id="edificio" required>
                                            <option value="" >Seleccione Opción...</option>
                                            <?php
                                                for($i=0; $i<count($medificio['gen_edificio']); $i++)
                                                {
                                                    $EDI_IdEdificio = $medificio['gen_edificio'][$i]['EDI_IdEdificio'];                                                    
                                                    $EDI_Nombre = $medificio['gen_edificio'][$i]['EDI_Nombre'];
													$EDI_Direccion = $medificio['gen_edificio'][$i]['EDI_Direccion'];
                                                    $EDI_Estado = $medificio['gen_edificio'][$i]['EDI_Estado'];
                                            ?>
                                                    <option value="<?php echo $EDI_IdEdificio; ?>" >
                                                        <?php echo $EDI_Nombre ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Direcci&oacute;n</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="" required>                                       
                                    </div>
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Teléfono</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="telefono" id="telefono" maxlength="13" value="" required>                                       
                                    </div>
                                </div>

                                <div style="form-group form-float">                                     
                                    <label class="form-label">
                                        Piso
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="piso" id="piso" required>
                                            <option value="" >Seleccione Opción...</option>
                                            <?php
                                                for($i=0; $i<count($mpiso['juz_piso']); $i++)
                                                {
                                                    $PIS_IdPiso = $mpiso['juz_piso'][$i]['PIS_IdPiso'];                                                    
                                                    $PIS_Numero = $mpiso['juz_piso'][$i]['PIS_Numero'];
                                                    $PIS_Estado = $mpiso['juz_piso'][$i]['PIS_Estado'];
                                            ?>
                                                    <option value="<?php echo $PIS_IdPiso; ?>" >
                                                        <?php echo $PIS_Numero ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>			
								

								<div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Email</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="email" id="email" value="" required>                                       
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