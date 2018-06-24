<?php require_once('../../Connections/cnn_kn.php'); ?>
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
$Tabla ="VEHICULOS";
$strowreg =0;
$idtabla = 0;
$row_rs_tabla = 0;
$Nombreciudad = "";


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_transp = "SELECT IdTransportador, concat_WS('',NombreTransportador,ApellidosTransportador) AS NombreTransportador, EstadoTransportador FROM transportadores WHERE EstadoTransportador = 1 ORDER BY NombreTransportador ;" ;
$rs_transp = mysqli_query($cnn_kn, $query_rs_transp) or die(mysqli_error()."Err.....$query_rs_transp<br>");
$row_rs_transp = mysqli_fetch_assoc($rs_transp);
$totalRows_rs_transp = mysqli_num_rows($rs_transp);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipoveh = "SELECT IdTipoVehiculo, NombreTipoVehiculo FROM tipovehiculo WHERE EstadoTipoVehiculo = 1 ORDER BY NombreTipoVehiculo ;" ;
$rs_tipoveh = mysqli_query($cnn_kn, $query_rs_tipoveh) or die(mysqli_error()."Err.....$query_rs_tipoveh<br>");
$row_rs_tipoveh = mysqli_fetch_assoc($rs_tipoveh);
$totalRows_rs_tipoveh = mysqli_num_rows($rs_tipoveh);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipocar = "SELECT IdTipoCar, NombreTipoCar FROM tipocar WHERE EstadoTipoCar = 1 ORDER BY NombreTipoCar ;" ;
$rs_tipocar = mysqli_query($cnn_kn, $query_rs_tipocar) or die(mysqli_error()."Err.....$query_rs_tipocar<br>");
$row_rs_tipocar = mysqli_fetch_assoc($rs_tipocar);
$totalRows_rs_tipocar = mysqli_num_rows($rs_tipocar);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_sucusuarios = "SELECT IdCentroAcopio, NombreCentroAcopio, Estado FROM centrosacopio ORDER BY NombreCentroAcopio ;" ;
$rs_sucusuarios = mysqli_query($cnn_kn, $query_rs_sucusuarios) or die(mysqli_error()."Err.....$query_rs_sucusuarios<br>");
$row_rs_sucusuarios = mysqli_fetch_assoc($rs_sucusuarios);
$totalRows_rs_sucusuarios = mysqli_num_rows($rs_sucusuarios);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tabla = "SELECT IdVehiculo, Placa, IdTransportador, IdConductor, Modelo, IdTipoVehiculo, IdTipoCar, CantidadPedidos, fechavenceseguro, fechavencetecnica, clave, IdCentroAcopio, EstadoVehiculo FROM vehiculos WHERE IdVehiculo = $idTabla ;" ;
//echo "qry_usu......$query_rs_tabla" ;
mysqli_set_charset($cnn_kn,"utf8");
$rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err.....$query_rs_tabla<br>");
$row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
$totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

	$idtabla = $row_rs_tabla["IdVehiculo"];
    $Placa = trim($row_rs_tabla['Placa']);
    $IdConductor = $row_rs_tabla["IdConductor"];
    $IdTransportador = trim($row_rs_tabla['IdTransportador']);
    $Modelo = trim($row_rs_tabla['Modelo']);
    $IdTipoVehiculo = trim($row_rs_tabla['IdTipoVehiculo']);
    $IdTipoCar = $row_rs_tabla['IdTipoCar'];
    $cantidadpedidos = $row_rs_tabla['CantidadPedidos'];
    $centroacopio = $row_rs_tabla['IdCentroAcopio'] ;
    $EstadoEst = $row_rs_tabla['EstadoVehiculo'];    
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

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Placa</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="placa" id="placa" value="<?php echo $Placa ;?>" required>
                                       <!-- -->
                                    </div>
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Transportador</label>
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick" data-live-search="true" name="transportador" id="transportador" required>
                                            <option value="">-- Seleccione Transportador --</option>
                                            <?php                                                 
                                                do                                                 
                                                {           
                                                    $idTransportador = $row_rs_transp["IdTransportador"];
                                                    $NombreTransportador = $row_rs_transp["NombreTransportador"];
                                                    $EstadoTransportador = $row_rs_transp["EstadoTransportador"];
                                            ?>
                                            <option value="<?php echo $idTransportador; ?>" <?php if (trim($idTransportador) == trim($IdTransportador)){ echo "selected/=selected/";} else{ echo "";} ?>>
                                                <?php echo $NombreTransportador; ?>                                                
                                            </option>
                                            <?php                    
                                                } while($row_rs_transp = mysqli_fetch_assoc($rs_transp));
                                            ?>
                                        </select>
                                    </div>   
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Conductor</label>
                                    <div class="col-sm-4" id="xconductor"> 
                                        <!-- <select id="xxconductor" class="form-control" name="xxconductor" data-live-search="true">     <option value="">-- SELECCIONE --</option>                                       
                                        </select> -->
                                    </div>  
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <div style="float: left;">  
                                        <label class="form-label">Modelo</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="modelo" id="modelo" maxlength="4" value="<?php echo $Modelo ;?>" required>
                                           <!-- -->
                                        </div>
                                    </div>
                               
                                    <div style="float: left;">
                                        <label class="form-label">Tipo Vehiculo</label>
                                        <div class="col-sm-4">
                                            <select class="form-control show-tick" data-live-search="true" data-container="body"  data-size="5" name="tipovehiculo" id="tipovehiculo" required>
                                                <option value="">-- Seleccione Tipo Vehiculo --</option>
                                                <?php                                                 
                                                    do                                                 
                                                    {           
                                                        $IdTipoVehiculo = $row_rs_tipoveh["IdTipoVehiculo"];
                                                        $NombreTipoVehiculo = $row_rs_tipoveh["NombreTipoVehiculo"];
                                                ?>
                                                <option value="<?php echo $IdTipoVehiculo; ?>" <?php if (trim($IdTipoVehiculo) == trim($IdTipoVehiculo)){ echo "selected/=selected/";} else{ echo "";} ?>>
                                                    <?php echo $NombreTipoVehiculo; ?>                                                
                                                </option>
                                                <?php                    
                                                    } while($row_rs_tipoveh = mysqli_fetch_assoc($rs_tipoveh));
                                                ?>
                                            </select>
                                        </div>
                                    </div>   
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Tipo Car</label>
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick" data-live-search="true" data-container="body" data-size="5" name="tipocar" id="tipocar" required>
                                            <option value="">-- Seleccione Tipo Car --</option>
                                            <?php                                                 
                                                do                                                 
                                                {           
                                                    $IdTipoCar = $row_rs_tipocar["IdTipoCar"];
                                                    $NombreTipoCar = $row_rs_tipocar["NombreTipoCar"];
                                            ?>
                                            <option value="<?php echo $IdTipoCar; ?>" <?php if (trim($IdTipoCar) == trim($IdTipoCar)){ echo "selected/=selected/";} else{ echo "";} ?>>
                                                <?php echo $NombreTipoCar; ?>                                                
                                            </option>
                                            <?php                    
                                                } while($row_rs_tipocar = mysqli_fetch_assoc($rs_tipocar));
                                            ?>
                                        </select>
                                    </div>   
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Cantidad Pedidos</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="cantidadpedidos" id="cantidadpedidos" maxlength="4" value="<?php echo $cantidadpedidos; ?>" required>
                                       <!-- -->
                                    </div>
                                </div>                                

                                <div class="form-group form-float">
                                    <label class="form-label">Centro Acopio</label>
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick" data-live-search="true" name="centroacopio" id="centroacopio" required>
                                            <option value="">-- Seleccione Centro Acopio --</option>
                                            <?php                                                 
                                                do                                                 
                                                {           
                                                    $idCentroAcopio = $row_rs_sucusuarios["IdCentroAcopio"];
                                                    $NombreCentroAcopio = $row_rs_sucusuarios["NombreCentroAcopio"];
                                                    $EstadoSucursal = $row_rs_sucusuarios["Estado"];
                                            ?>
                                            <option value="<?php echo $idCentroAcopio; ?>" <?php if (trim($idCentroAcopio) == trim($centroacopio)){ echo "selected/=selected/";} else{ echo "";} ?>>
                                                <?php echo $NombreCentroAcopio; ?>
                                            </option>
                                            <?php                    
                                                } while($row_rs_sucusuarios = mysqli_fetch_assoc($rs_sucusuarios));
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
                             <lael style="font-family: Verdana; font-size: 18; color:red;">Registro ha sido borrado correctamente.</lael>
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
        $("#modelo").numeric();
        $("#cantidadpedidos").numeric();
        $("#msj").html("<span style='color:red; font-family:Verdana; font-size:10px;'>Todos los campos son Obligatorios.</span>");        

        $("#form_validation").click(function() {
			$("#msj").html("");
		});

        $.post("listaconductores.php","idtransportador="+$("#transportador").val()+"&idconductor=<?php echo $IdConductor;?>", function(data){
            $("#xconductor").html(data);                    
            console.log(data);                   
        });

        $("#xxconductor").change(function(){
            var x = $("#xxconductor").val();
            $.post("listaconductores.php","idtransportador="+$("#transportador").val()+"&idconductor="+$("#xxconductor").val(), function(data){
                $("#xconductor").html(data);                    
                console.log(data);                   
            });            
        });            

        $("#transportador").change(function(){
            $.post("listaconductores.php","idtransportador="+$("#transportador").val(), function(data){
                $("#xconductor").html(data);                    
                console.log(data);                   
            });            
        });
		
		$("#grabar").on('click', function(e) {
            $("#mensaje").hide();
            var idvehiculo = <?php echo $idtabla; ?> 
            var placa = $("#placa").val();
            var transportador = $("#transportador").val();
            var xxconductor = $("#xxconductor").val();
            var modelo = $("#modelo").val();
            var tipovehiculo = $("#tipovehiculo").val();
            var tipocar = $("#tipocar").val();
            var cantidadpedidos = $("#cantidadpedidos").val();
            var centroacopio = $("#centroacopio").val();            
			var estado = $('input:radio[name=estado]:checked').val();
			var idtabla =  "<?php echo $idtabla; ?>";
            if( placa == "" || transportador =="" || xxconductor == "" || modelo == "" || tipovehiculo =="" || tipocar == "" || cantidadpedidos == "" || centroacopio == "" || estado == undefined )
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
    				data : {"idvehiculo": idvehiculo, "placa": placa, "transportador": transportador, "xxconductor": xxconductor, "modelo": modelo, "tipovehiculo": tipovehiculo, "tipocar": tipocar, "cantidadpedidos": cantidadpedidos, "centroacopio": centroacopio, "estado": estado,"idtabla": idtabla },                
    				type: "POST",				
    				url : "editar_<?php echo strtolower($Tabla); ?>.php",
                })  
    			.done(function( dataX, textStatus, jqXHR ){
    				var respstr = dataX;    				
    				if( respstr == "S" )
                    {
                        $("#msj").html('<div class="alert alert-info"><span class="glyphicon glyphicon-ok"></span><strong>  Atención: </strong> Registro modificado Correctamente.</div>').fadeOut(4000).delay(2000);
                    }
    				else
    				{					
                        $("#msj").html('<div class="alert alert-danger"><span class="glyphicon-hand-right"></span><strong>  Atención: </strong> Registro NO modificado.</div>').fadeIn(3000);
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
                        var respstr = dataX;        
                        if( respstr == "S" )
                        {            
                            $("#form_validation").hide();
                            $("#mensaje").show();                    
                        }
                        else
                        {                    
                             $("#mensaje").hide();
                             $("#form_validation").show();
                             $("#msj").html('<div class="alert alert-danger"><span class="glyphicon-hand-right"></span><strong>  Atención: </strong> <?php echo $Tabla; ?> NO Borrada.</div>').fadeIn(3000);                    
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
<?php
mysqli_free_result($rs_transp);
mysqli_free_result($rs_tipoveh);
mysqli_free_result($rs_tipocar);
mysqli_free_result($rs_sucusuarios);
mysqli_close($cnn_kn);
?>