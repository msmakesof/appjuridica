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
$NombreTabla ="VEHICULOS";

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tdusuarios = "SELECT IdTipoDocumento, NombreTipoDocumento, Estado FROM tipodocumento ORDER BY NombreTipoDocumento ;" ;
$rs_tdusuarios = mysqli_query($cnn_kn, $query_rs_tdusuarios) or die(mysqli_error()."Err.....$query_rs_tdusuarios<br>");
$row_rs_tdusuarios = mysqli_fetch_assoc($rs_tdusuarios);
$totalRows_rs_tdusuarios = mysqli_num_rows($rs_tdusuarios);


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_sucusuarios = "SELECT IdCentroAcopio, NombreCentroAcopio, Estado FROM centrosacopio ORDER BY NombreCentroAcopio ;" ;
$rs_sucusuarios = mysqli_query($cnn_kn, $query_rs_sucusuarios) or die(mysqli_error()."Err.....$query_rs_sucusuarios<br>");
$row_rs_sucusuarios = mysqli_fetch_assoc($rs_sucusuarios);
$totalRows_rs_sucusuarios = mysqli_num_rows($rs_sucusuarios);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_transp = "SELECT IdTransportador, concat_WS('',NombreTransportador,ApellidosTransportador) AS NombreTransportador, EstadoTransportador FROM transportadores WHERE EstadoTransportador = 1 ORDER BY NombreTransportador ;" ;
$rs_transp = mysqli_query($cnn_kn, $query_rs_transp) or die(mysqli_error()."Err.....$query_rs_transp<br>");
$row_rs_transp = mysqli_fetch_assoc($rs_transp);
$totalRows_rs_transp = mysqli_num_rows($rs_transp);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_conduc = "SELECT IdConductor, Nombres AS NombreConductor, Nit, EstadoConductor FROM conductores WHERE EstadoConductor = 1 ORDER BY NombreConductor ;" ;
$rs_conduc = mysqli_query($cnn_kn, $query_rs_conduc) or die(mysqli_error()."Err.....$query_rs_conduc<br>");
$row_rs_conduc = mysqli_fetch_assoc($rs_conduc);
$totalRows_rs_conduc = mysqli_num_rows($rs_conduc);

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
    <script src="../../plugins/jquery/jquery-2.1.1.js"></script>

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

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Placa</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="placa" id="placa" value="" maxlength="6" required>
                                       <!-- -->
                                    </div>
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Transportador</label>
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick" data-live-search="true"  name="transportador" id="transportador" required>
                                            <option value="">-- Seleccione Transportador --</option>
                                            <?php                                                 
                                                do                                                 
                                                {           
                                                    $idTransportador = $row_rs_transp["IdTransportador"];
                                                    $NombreTransportador = $row_rs_transp["NombreTransportador"];
                                                    $EstadoTransportador = $row_rs_transp["EstadoTransportador"];
                                            ?>
                                            <option value="<?php echo $idTransportador; ?>" >
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
                                            <input type="text" class="form-control" name="modelo" id="modelo" maxlength="4" value="" required>
                                           <!-- -->
                                        </div>
                                    </div>
                               <!--  </div>

                                <div class="form-group form-float" style="clear: both;"> -->
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
                                                <option value="<?php echo $IdTipoVehiculo; ?>" >
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
                                            <option value="<?php echo $IdTipoCar; ?>" >
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
                                        <input type="text" class="form-control" name="cantidadpedidos" id="cantidadpedidos" maxlength="4" value="" required>
                                       <!-- -->
                                    </div>
                                </div>
                          
                                
                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Centro Acopio</label>
                                    <div class="col-sm-4">
                                        <select class="form-control show-tick" data-live-search="true" data-container="body" data-size="5" name="centroacopio" id="centroacopio" required>
                                            <option value="">-- Seleccione Centro Acopio --</option>
                                            <?php                                                 
                                                do                                                 
                                                {           
                                                    $idCentroAcopio = $row_rs_sucusuarios["IdCentroAcopio"];
                                                    $NombreCentroAcopio = $row_rs_sucusuarios["NombreCentroAcopio"];
                                                    $EstadoSucursal = $row_rs_sucusuarios["Estado"];
                                            ?>
                                            <option value="<?php echo $idCentroAcopio; ?>" >
                                                <?php echo $NombreCentroAcopio; ?>                                                
                                            </option>
                                            <?php                    
                                                } while($row_rs_sucusuarios = mysqli_fetch_assoc($rs_sucusuarios));
                                            ?>
                                        </select>
                                    </div>   
                                </div>
                                
                                <div class="form-group">
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
  
  <script type="text/javascript">
    var nombre ="";
    $(document).ready(function()
    {           
        $("#msj").hide();
        $("#numerodocumento").numeric();
        $("#modelo").numeric();
        $("#cantidadpedidos").numeric();
        
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


        $("#transportador").change(function(){
            $.post("listaconductores.php","idtransportador="+$("#transportador").val(), function(data){
                $("#xconductor").html(data);
                //$.each(data, function (key, value) {
                    //$("#xconductor select").append("<option value=" + value.idConductor + ">" + value.NombreConductor + "</option>");
                //});    
                console.log(data);                   
            });            
        });

        $("#xxconductor").change(function(){ 
            var x = $("#xxconductor").val();
            alert(x);
        });    

        $("#grabar").on('click', function(e) 
        {             
            var placa = $("#placa").val();
            var transportador = $("#transportador").val();
            var xxconductor = $("#xxconductor").val();
            var modelo = $("#modelo").val();
            var tipovehiculo = $("#tipovehiculo").val();
            var tipocar = $("#tipocar").val();
            var cantidadpedidos = $("#cantidadpedidos").val();
            var centroacopio = $("#centroacopio").val();
            var estado = $('input:radio[name=estado]:checked').val();
            e.preventDefault();

            if( transportador == "" || placa =="" || xxconductor == "" || modelo =="" || tipovehiculo == "" || tipocar == "" || cantidadpedidos == "" || estado == undefined || centroacopio == "" )
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
                    data : {"transportador": transportador, "placa": placa, "xxconductor": xxconductor, "modelo": modelo, "tipovehiculo": tipovehiculo, "tipocar": tipocar, "cantidadpedidos": cantidadpedidos, "estado": estado, "centroacopio": centroacopio}, 
                    type: "POST",
                    dataType: "html",
                    url : "crea_<?php echo strtolower($NombreTabla); ?>.php",
                })  
                .done(function( data, textStatus, jqXHR){                 
                    var respstr = data;
                    if(respstr == "E")
                    { 
                        swal("Atencion:", "Tabla " + nombre + " !Ya se encuentra registrado(a)...");                        
                    }
                    else
                    {    
                        if( respstr == "S" )
                        {                        
                            swal("Atencion: ", "Registro grabado Correctamente.", "success");
                            return false;
                        }
                        else
                        {
                            swal("Atencion: ", "Registro No ha sido grabado.", "danger");
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
</body>

</html>
<?php 
mysqli_free_result($rs_tdusuarios);
mysqli_free_result($rs_sucusuarios);
mysqli_free_result($rs_transp);
mysqli_free_result($rs_conduc);
mysqli_free_result($rs_tipoveh);
mysqli_free_result($rs_tipocar);
?>