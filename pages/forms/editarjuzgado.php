<?php 
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); //('../../Connections/cnn_kn.php');
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
if (!function_exists("GetSQLValueString")) {
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
require_once('../../apis/general/ciudad.php');
require_once('../../apis/general/piso.php');
require_once('../../apis/general/tipojuzgado.php');
require_once('../../apis/general/area.php');
require_once('../../apis/general/edificio.php');
if( isset($_GET['f'])  && !empty($_GET['f']) )
{    
    $idTabla = trim($_GET['f']);
}

$Tabla ="JUZGADO";
$idtabla = 0;
require_once('../../apis/juzgado/juzgado.php');

$Nombre = trim($mjuzgado['juz_juzgado']['JUZ_Ubicacion']);
$idTabla = $mjuzgado['juz_juzgado']['JUZ_IdJuzgado'];    
$Ciudad = $mjuzgado['juz_juzgado']['JUZ_IdCiudad'];
$NombreCiudad = $mjuzgado['juz_juzgado']['CIU_Nombre'];
$Direccion = $mjuzgado['juz_juzgado']['JUZ_Direccion'];
$Edificio = $mjuzgado['juz_juzgado']['JUZ_Edificio'];
$Email = $mjuzgado['juz_juzgado']['JUZ_Email'];
$Piso = $mjuzgado['juz_juzgado']['JUZ_Piso'];
$TipoJuzgado = $mjuzgado['juz_juzgado']['JUZ_IdTipoJuzgado'];
$NombreTipoJuzgado = $mjuzgado['juz_juzgado']['TJU_Nombre'];
$Piso = $mjuzgado['juz_juzgado']['JUZ_Piso'];
$Telefono = $mjuzgado['juz_juzgado']['JUZ_Telefono'];
$Area = $mjuzgado['juz_juzgado']['JUZ_IdArea'];
$Estado = $mjuzgado['juz_juzgado']['JUZ_Estado'];
$EstadoUsuario = $mjuzgado['juz_juzgado']['EstadoTabla'];

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
      
     <section class="content" style="margin-top:15px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORMULARIO: <?php echo $Tabla ;?>.
                    <!--<small>Editar.</small>-->
                </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row info-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>REGISTRO EDICION DE <?php echo $Tabla; ?>.</h2>
                           <!--  <ul class="header-dropdown m-r--5">
                               <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>                                    
                                </li>
                            </ul>-->
                        </div>
                        <div class="body  table-responsive">
                            <form id="form_validation" method="POST">                                

                                <div style="form-group form-float"> 
                                    <label class="form-label">
                                        Tipo Corporación o Juzgado
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="90%" name="tipojuzgado" id="tipojuzgado" required>
                                            <option value="" >Seleccione Opción...</option>
                                            <?php
                                                for($i=0; $i<count($mtipojuzgado['juz_tipojuzgado']); $i++)
                                                {
                                                    $TJU_IdTipoJuzgado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_IdTipoJuzgado'];                                                    
                                                    $TJU_Nombre = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Nombre'];
                                                    $TJU_Estado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Estado'];
                                            ?>
                                                    <option value="<?php echo $TJU_IdTipoJuzgado; ?>" <?php if ($TJU_IdTipoJuzgado == $TipoJuzgado){ echo "selected";} else{ echo "";} ?>>
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
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="90%" name="area" id="area" required>
                                            <option value="">-- Seleccione Especializacion.... --</option>
                                            <?php
                                                // for($i=0; $i<count($marea['juz_area']); $i++)
                                                // {
                                                //     $ARE_IdArea = $marea['juz_area'][$i]['ARE_IdArea'];                                                    
                                                //     $ARE_Nombre = $marea['juz_area'][$i]['ARE_Nombre'];
                                                //     $ARE_Estado = $marea['juz_area'][$i]['ARE_Estado'];
                                            ?>
                                            <!--
                                                    <option value="<?php //echo $ARE_IdArea; ?>" <?php //if ($ARE_IdArea == $Area){ echo "selected";} else{ echo "";} ?>>
                                                        <?php //echo $ARE_Nombre ; ?>                                                
                                                    </option>
                                            -->        
                                            <?php
                                                // }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="form-group form-float" style="clear:both;">
                                    <div class="col-xs-4">
                                        <label class="form-label">N&uacute;mero o Nombre</label>
                                        <div class="form-line">                                        
                                            <input type="text" class="form-control" name="ubicacion" id="ubicacion" value="<?php echo $Nombre ;?>" maxlength="3" required>                                    
                                        </div>
                                    </div>
                                    <div class="col-xs-8">&nbsp;</div>
                                </div>

                                <div class="form-group form-float" style="clear:both;">                                     
                                    <label class="form-label">
                                        Ciudad
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="90%" name="ciudad" id="ciudad" required>
                                            <option value="" >Seleccione Opción...</option>
                                            <?php
                                                for($i=0; $i<count($mciudad['gen_ciudad']); $i++)
                                                {
                                                    $CIU_IdCiudades = $mciudad['gen_ciudad'][$i]['CIU_IdCiudades'];                                                    
                                                    $CIU_Nombre = $mciudad['gen_ciudad'][$i]['CIU_Nombre'];
                                                    $CIU_Estado = $mciudad['gen_ciudad'][$i]['CIU_Estado'];
                                            ?>
                                                    <option value="<?php echo $CIU_IdCiudades; ?>" <?php if ($CIU_IdCiudades == $Ciudad){ echo "selected";} else{ echo "";} ?>>
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
                                                    <option value="<?php echo $EDI_IdEdificio; ?>" <?php if ($EDI_IdEdificio == $Edificio){ echo "selected";} else{ echo "";} ?>>
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
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $Direccion; ?>" required>                                       
                                    </div>
                                </div>
								
								<div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Tel&eacute;fono</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $Telefono; ?>"  maxlength="13" required>                                       
                                    </div>
                                </div>

                                <div style="form-group form-float">                                     
                                    <label class="form-label">
                                        Piso
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="90%" name="piso" id="piso" required>
                                            <option value="" >Seleccione Opción...</option>
                                            <?php
                                                for($i=0; $i<count($mpiso['juz_piso']); $i++)
                                                {
                                                    $PIS_IdPiso = $mpiso['juz_piso'][$i]['PIS_IdPiso'];                                                    
                                                    $PIS_Numero = $mpiso['juz_piso'][$i]['PIS_Numero'];
                                                    $PIS_Estado = $mpiso['juz_piso'][$i]['PIS_Estado'];
                                            ?>
                                                    <option value="<?php echo $PIS_IdPiso; ?>" <?php if ($PIS_IdPiso == $Piso){ echo "selected";} else{ echo "";} ?>>
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
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $Email ;?>" required>                                       
                                    </div>
                                </div>
								
                                <div class="form-group" style="clear: both;">Estado: 
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $Estado == 1){?>checked="checked"<?php } ?>>
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2"<?php if( $Estado == 2){?>checked="checked"<?php } ?>>
                                    <label for="inactivo" class="m-l-20">Inactivo</label>
                                    
                                </div>
								
                                <hr style="clear: both; margin-top:-5px;">
                                <div class="form-group" style="clear: both; margin-top:20px; margin-bottom:20px;">                                                                  
									<button class="btn btn-primary waves-effect" type="button" id="grabar">GRABAR</button>								   
									<button type="button" class="btn btn-danger waves-effect" id="borrar">BORRAR</button>
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
    <script src="../../js/jquery.numeric.js"></script>

    <script src="../../js/alertify.min.js"></script>

    <script type="text/javascript">
        function populateFruitVariety() {
            $.getJSON('../tables/urlink.php', {funcion: "ja", origen: $('#tipojuzgado').val()}, function (data) {
                var zdata= data.juz_areasxtipojuzgado;
                var selectedOption = "<?php echo $Area; ?>";    //'0'; // el valor por defecto
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
		$("#mensaje").hide();
        $("#ubicacion").numeric();
		$("#telefono").numeric();
        $("#form_validation").show();
        $("#form_validation").click(function() {
			$("#msj").html("");
		})

        populateFruitVariety();
        $('#tipojuzgado').change(function() {
            populateFruitVariety();
        });
		
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
            $("#mensaje").hide();
			var ubicacion = $("#ubicacion").val();            
            var ciudad = $("#ciudad").val();
            var direccion = $("#direccion").val();
			var telefono = $("#telefono").val();
            var piso = $("#piso").val();            
            var tipojuzgado = $("#tipojuzgado").val();
            var area = $("#area").val();
			var edificio = $("#edificio").val();
			var email = $("#email").val();
			var estado = $('input:radio[name=estado]:checked').val();
			var idtabla = "<?php echo $idTabla; ?>";
			
			$.ajax({
				data : {"ubicacion": ubicacion, "ciudad": ciudad, "direccion": direccion, "telefono": telefono, "piso": piso, "tipojuzgado": tipojuzgado, "area": area, "estado": estado, "edificio": edificio, "email": email, "idtabla": idtabla},
				type: "POST",
				dataType: "html",
				url : "editar_<?php echo strtolower($Tabla); ?>.php",
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
        var idtabla  = "<?php echo $idTabla; ?>";
        var nomtabla = "<?php echo $Nombre; ?>";
		//alert(idtabla);
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