﻿<?php 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

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
if( isset($_GET['f'])  && !empty($_GET['f']) )
{    
    $idTabla = trim($_GET['f']);
}

$Tabla ="FESTIVO";
$idtabla = 0;

require_once('../../apis/general/festivo.php');

$Nombre = trim($mfestivo['gen_festivo']['FES_Festivo']);
$VanciaJudicial = trim($mfestivo['gen_festivo']['FES_VanciaJudicial']);
$estado = $mfestivo['gen_festivo']['FES_Estado'];
$idtabla = $mfestivo['gen_festivo']['FES_IdFestivo'];

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
                    FORMULARIO: <?php echo $Tabla; ?>.
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
                        <div class="body table-responsive">
                            <form id="form_validation" method="POST">

                                <div class="form-group row">
                                    <div class="col-xs-6">
                                        <label class="form-label">Seleccione Día Festivo</label>                                    
                                        <div class='input-group date form-line' name="nombre" id="nombre" required>
                                            <input type='text' id="txtFecha" class="form-control" value="<?php echo $Nombre; ?>" readonly/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>    
                                </div>                                

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label class="form-label">Vacancia Judicial</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="VanciaJudicial" id="VanciaJudicial" maxlength="1" value="<?php echo $VanciaJudicial; ?>" required>                                       
                                        </div>
                                    </div>
                                </div>               
                                
                                <div class="form-group" style="clear: both;">
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $estado == 1){?>checked="checked"<?php } ?>>
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2"<?php if( $estado == 2){?>checked="checked"<?php } ?>>
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
    
    <!-- DateTime picker -->
    <script src="../../calendar/js/moment.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.es.js"></script>

    <script type="text/javascript">    
    $(document).ready(function()
	{			
		$("#mensaje").hide();
        $('#nombre').datetimepicker({
          format: 'YYYY-MM-DD'       
        });

        $("#form_validation").show();
        $("#form_validation").click(function() {
			$("#msj").html("");
		})
		
		$("#grabar").on('click', function(e) {
            $("#mensaje").hide();
			var nombre = $("#txtFecha").val();            
            var vanciaJudicial = $("#VanciaJudicial").val();		
			var estado = $('input:radio[name=estado]:checked').val();
			var idtabla = "<?php echo $idtabla; ?>";
			
			$.ajax({
				data : {"nombre": nombre, "vanciaJudicial": vanciaJudicial, "estado": estado, "idtabla": idtabla},
				type: "POST",
				dataType: "html",
				url : "editar_<?php echo strtolower($Tabla) ; ?>.php",
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
                    url : "../forms/borrar_<?php echo strtolower($Tabla) ; ?>.php",
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