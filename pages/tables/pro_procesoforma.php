<?php
include_once("header.inc.php");
require_once ('../../Connections/DataConex.php'); //require_once('../../Connections/cnn_kn.php');
$LogoInterno = LogoInterno; 
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
    if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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

$NombreTabla ="PROCESO";
$idTabla = 0;
$tipoCLiente = 0 ;
//require_once('../../apis/juzgado/juzgado.php');
//require_once('../../apis/cliente/infoCliente.php');
$yy = date("Y");
$empresa = Company;
if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
}
$nombre_lnk = "proceso";
$nombre = "";
$email  = "";
$usuario ="";
$url ="../../consultadetalle/consultadetalle_juzgado.php?IdTabla";

if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
{    
    $usuario = trim($_POST['ƒ×']);
}
else
{
    $usuario ="";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>.:: <?php echo $empresa; ?>  |  Información Principal ::.</title>
    <!-- Favicon-->
    <link rel="icon" href="../../images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- DateTime Picker 
        <link href="../../calendar/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		-->

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- JQuery DataTable Css 20160903 MKS-->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- Sweet Alert Css -->
        <link href="../../css/sweet/sweetalert.css" rel="stylesheet" />
        <link href="../../css/sweet/main.css" rel="stylesheet" />

        <!-- Bootstrap Select Css -->
        <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

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
	<!--
    <script src="../../calendar/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.es.js"></script>    
	-->
	<script src="../../fc/js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="../../fc/css/bootstrap-datetimepicker.min.css" />
	<script src="../../fc/js/bootstrap-datetimepicker.es.js"></script> 
   <style>
    object{
       width:100%;
       height:390px ;  
	}

    .caja{
        margin-bottom:-10px !important;
        margin-left: 2%;
        margin-right: 20%;
    }
   </style>

   <script type="text/javascript">
    var nombre ="";
    var _zipDeptoCiudad = "";
    var _zip = "";
    var _tipojuzgado = "";
    var _juzgado = "";
    var _area = "";
    var _txtarea = "";
    var _despacho ="";
    var _nProceso = "";
    var _nDv = "";
    var _Proceso = "";

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
            
			options[options.length] = new Option('-- Seleccione Especialidad o Area.... --', '');
            if(newOptions != 'undefined')
            {
                $.each(newOptions, function(val, text) {
                    options[options.length] = new Option(text.ARE_Nombre, text.ARE_Codigo);
                });
            }
            
            select.val(selectedOption);
            $('#area').selectpicker('refresh');
            _area = $('#area').val();
            goDespachos();                 
            nroProceso();            
        });
    }

    function goDespachos() {
        var __area = $('#area').val();
        if( __area == "")
        {
            __area = _area;
        }
        $.getJSON('../tables/urlink.php', {funcion: "jd", origen: $('#tipojuzgado').val() +'-'+ __area }, function (data) {
            var zdata= data.juz_areasxjuzgado;
            var selectedOption = '';
            var newOptions = zdata;
            
            var select = $('#despacho');
            if(select.prop) 
            {
                var options = select.prop('options');
            }
            else 
            {
                var options = select.attr('options');
            }
            $('option', select).remove();
			
			options[options.length] = new Option('-- Seleccione Despacho.... --', '');
            if(newOptions != undefined)
            {
                $.each(newOptions, function(val, text) {
                    options[options.length] = new Option(text.JUZ_Ubicacion, text.JUZ_IdJuzgado);
                });
            }    
            select.val(selectedOption);
            $('#despacho').selectpicker('refresh');
            _txtdespacho = $('#despacho option:selected').text();
            _txtdespacho = _txtdespacho.trim();
            _despacho = _txtdespacho.substring(0, 3);
            nroProceso();
        });
    }

    function nroProceso(){
        _area = "";
        if( _area != "" && _area.substring(0, 1) == "-")
        {
            _area =  $("#area").val();
        }
		
		if(_tipojuzgado.substring(0, 1) == "-")
		{
			_tipojuzgado = "";
		}
		
		if(_despacho.substring(0, 1) == "-")
		{
			_despacho = "";
		}
				
        _Proceso = _zipDeptoCiudad + _tipojuzgado + _area + _despacho + $("#anio").val() + _nProceso + _nDv;
        //$("#proceso").attr("value",_Proceso);
		$("#proceso").prop("value",_Proceso);
        init_contador("#proceso","#muestrocantidadcaracteresid");
    }

    function init_contador(idtextarea, idcontador)
    {        
        var contador = $(idcontador);
        contador.html( $(idtextarea).val().length);
    }

    $(document).ready(function()
    {   
		
		$('#activo').prop("checked", true);
		
        $("#msj").hide();
		$("#area").attr("value", "");
        $('#anio').numeric();
		$('#ndv').numeric();
        $('#consecutivo').numeric();
        $('#nproceso').numeric(); 
        $('.selectpicker').selectpicker();
		var exclude_dates = ['2019-04-18', '2019-04-19'];
		var disabledWeekDays = [0,6];
		var x = new Date();
		var n = x.getDay();
		var y =  new Date();
		var f="";
		if ( n == 6)
		{
			f = y.setDate(x.getDate()+2);
		}
		if ( n == 0 )
		{
			f = y.setDate(x.getDate()+1);
		}
		
        $('#fechainicio').datetimepicker({			
			language: 'es',											
			daysOfWeekDisabled: [0, 6],
			datesDisabled: exclude_dates,
			autoclose: true,
			defaultDate: f,											
			format:'YYYY/MM/DD',
			minDate: new Date(),
			viewMode: 'days'		
        });
        $("#ndv").attr("value", "00");
        _nDv = $("#ndv").val();

        $("#actoprocesal").hide();
        
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

        $('#demandado').prop('disabled', 'disabled');

        $('#cliente').change(function() {
            var __cliente = $('#cliente').val();
            var __demandado = $('#demandado').val();
            $.getJSON('../tables/urlink.php', {funcion: "cd", origen: __cliente +'-'+ __demandado }, function (data) {               

            });
            $("#demandado.selectpicker.show-tick option[value='"+ __cliente+"']").remove();
            if (__cliente != "")
            {
                $('#demandado').prop('disabled', false);
            }
            else
            {
                $('#demandado').prop('disabled','disabled');
                $('#demandado').val("");;
            }

			$.getJSON('../tables/urlink.php', {funcion: "dd", origen: __cliente +'-'+ __demandado }, function (data) {
				var msj = data.juz_areasxjuzgado.Total;
                if(msj != null)
				{
					swal("Atención:", msj, "warning" );
					event.stopPropagation();
					return false;
				}
            });		

        });
        
        $('#demandado').on('click', function() {
            $("#demandado option[value='"+ __cliente+"']").remove();
        });

        $('#demandado').change(function() {
            var __cliente = $('#cliente').val();
            var __demandado = $('#demandado').val();
            $.getJSON('../tables/urlink.php', {funcion: "cd", origen: __cliente +'-'+ __demandado }, function (data) {
                
            });
			
			$.getJSON('../tables/urlink.php', {funcion: "dd", origen: __cliente +'-'+ __demandado }, function (data) {
				var msj = data.juz_areasxjuzgado.Total;
                if(msj != null)
				{
					swal("Atención:", msj, "warning" );
					event.stopPropagation();
					return false;
				}
            });			
        });

        $('#tipojuzgado').change(function() {
            populateFruitVariety();
            var nameARE_Codigo = $('#tipojuzgado option:selected').text();
            _tipojuzgado = nameARE_Codigo.trim();
            _tipojuzgado = _tipojuzgado.substring(0, 2);            
            nroProceso();            
        });

        $('#area').change(function() {
            goDespachos();
            nroProceso();            
        });

         $('#area').focusin(function() {           
            _area = $('#area').val();            
            nroProceso();        
        });

        $('#area').focusout(function() {           
            _area = $('#area').val();            
            nroProceso();        
        });

        $("#zip").on('change', function(e) {
			
			
			_Proceso = "";
			$("#tipojuzgado").val('default').selectpicker("refresh");
			$("#area").val('default').selectpicker("refresh");
			$("#despacho").val('default').selectpicker("refresh");	
			
			
            _zip = $("#zip").val();
            $.ajax({
                url: "urlink.php",
                method: "GET",                
                data: {funcion: "c", origen: _zip},                
                dataType: "text",
                success: function(data) {
                    var zz =JSON.parse(data);
                    _zipDeptoCiudad = zz.gen_ciudad.DEP_CodigoDane+zz.gen_ciudad.CIU_Abreviatura;                   
                    nroProceso();
                }
            });
            nroProceso();            
        });           


        $("#nproceso").on('change', function(e) {
            _nProceso = $("#nproceso").val();
            nroProceso();            
        });
		
		$("#ndv").on('change', function(e) {
            _nDv = $("#ndv").val();
            nroProceso();            
        });

        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'pro_proceso.php';
        });       

        $("#grabar").on('click', function(e) {

            var nombre = $("#proceso").val();
            fechainicio = $("#txtFecha").val();
            usuario = $("#usuario").val();
            ubicacion = $("#ubicacion").val();
            claseproceso = $("#claseproceso").val();
            pproceso = $("#proceso").val();
            juzgado = $("#tipojuzgado").val();
            especialidad = $("#area").val();
            despacho = $("#despacho").val();
            cliente = $("#cliente").val();
            demandado = $("#demandado").val();
			var uc = <?php echo $_SESSION['IdUsuario']; ?>;
			var origen ="p";

            var estado = $('input:radio[name=estado]:checked').val();
			var representa = $('input:radio[name=representa]:checked').val();
            e.preventDefault();
            if( estado == undefined || representa == undefined || nombre == "" || fechainicio == "" || ubicacion == "" || claseproceso == "" || juzgado == "" || cliente == "" || demandado == "" || especialidad == "" || usuario == "") 
            {                 
                swal("Atencion:", "Debe digitar un Nombre y/o seleccionar un Estado y/o Fecha de Inicio y/o Usuario y/o Ubicacion y/o clase Proceso y/o Juzgado y/o especialidad y/o despacho y/o Representante De.");
                e.stopPropagation();
                return false;
            }
            else
            {
                $.ajax({
                    data : {"pnombre": nombre, "pfechainicio": fechainicio, "pusuario": usuario, "pubicacion": ubicacion, "pclaseproceso": claseproceso ,"pjuzgado": juzgado,"pestado": estado, "pproceso": pproceso,"pcliente": cliente, "pdemandado":demandado, "pespecialidad":especialidad, "pdespacho":despacho, "prepresenta":representa, "uc": uc},
                    type: "POST",
                    dataType: "html",
                    url : "../forms/crea_<?php echo strtolower($NombreTabla); ?>.php",
                })
                .done(function( data, textStatus, jqXHR){                 
                    var xrespstr = data.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2,32);
					var maxid = xrespstr.substr(34);
                    if(respstr == "E")
                    {                         
                       swal("Atención:", msj);
                    }
                    else
                    {    
                        if( respstr == "S" )
                        {                        
                            var nombreciu = $('select[name="zip"] option:selected').text();
							var corporacion = $('select[name="tipojuzgado"] option:selected').text();
							var area = $('select[name="area"] option:selected').text();
							var despacho = $('select[name="despacho"] option:selected').text();
							var asignadoa = $('select[name="usuario"] option:selected').text();
							var ubicacion = $('select[name="ubicacion"] option:selected').text();
							var claseproceso = $('select[name="claseproceso"] option:selected').text();
							var cliente = $('select[name="cliente"] option:selected').text();
							var demandado = $('select[name="demandado"] option:selected').text();							
														
							$.ajax({
								data : {"pnombre": nombre, "pfechainicio": fechainicio, "pusuario": usuario, "pubicacion": ubicacion, "pclaseproceso": claseproceso ,"pjuzgado": juzgado,"pestado": estado, "pproceso": pproceso,"pcliente": cliente, "pdemandado":demandado, "pespecialidad":especialidad, "pdespacho":despacho, "origen": origen, "nombreciu": nombreciu, "corporacion": corporacion, "area": area, "despacho": despacho, "asignadoa": asignadoa, "ubicacion": ubicacion, "claseproceso": claseproceso, "cliente": cliente, "demandado": demandado, "maxid": maxid},
								type: "POST",
								dataType: "html",
								url : "../../email/",								
								beforeSend: function () 
								{ 										
									$("#precargamsj").show();
										   
								},
								success: function( dataX, textStatus, jqXHR )
								{
									
									xrespstr = data.trim();							
									swal("Atención: ", msj, "success");
									
									//$('form')[0].reset();							
									$("#zip").val('default').selectpicker("refresh");
									$("#tipojuzgado").val('default').selectpicker("refresh");
									$("#area").val('default').selectpicker("refresh");
									$("#despacho").val('default').selectpicker("refresh");							
									$("#usuario").val('default').selectpicker("refresh");
									$("#ubicacion").val('default').selectpicker("refresh");							
									$("#claseproceso").val('default').selectpicker("refresh");
									$("#cliente").val('default').selectpicker("refresh");							
									$("#demandado").val('default').selectpicker("refresh");
									$("#proceso").val('');
									$("#actoprocesal").show();
									$('#activo').prop("checked", true);
									return false;
									
								},
								error: function( jqXHR, textStatus, errorThrown ) 
								{
									if ( console && console.log ) 
									{
										console.log( "La solicitud a fallado: " +  textStatus);
										$("#msj").html("");
									}
								},
								complete: function( jqXHR, textStatus, errorThrown ) 
								{
									$("#precargamsj").hide();
								}
							});							
													
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
		
		$("#limpiar").on('click', function(e) {
			
		});
		
    });    
    </script>      
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div id="precargamsj" class="page-loader-wrapper">
        <div class="loader">		
            <div class="md-preloader pl-size-md">				
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p>Por Favor espere...</p>
        </div>
    </div>
    <!-- #END# Page Loader --> 
	
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
	
	
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand">
                <img src="<?php echo $LogoInterno; ?>" style="margin-top: -6px;">
                </a>

            </div>

            <!-- Notificaciones -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- <  Call Search > -->
                    <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                    <!-- < #END# Call Search >
                    < Notifications > -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICACIONES</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>3 Revisión Demanda Arte SAS</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Hace 4 mins
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>1 Reunión Proceso Mario Soto</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Hace 22 mins
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Revisar Documentación Cliente</b></h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Hace 39 minutos
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>3 <b>Visitas</b> del día</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Hace 45 minutos
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Revisar Agenda</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Hace 1 Hora
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Actualizar estados de OTM´s</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Hace 1 Hora 13 minutos
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Enviar solicitudes por Correo</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Ayer
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">Ver Todas las Notificaciones</a>
                            </li>
                        </ul>
                    </li>
                    <!-- < #END# Notifications >
                    < Tasks > -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TAREAS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Reporte Agenda
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Revisar cumplimiento por Procesos
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Revisar Actividades Dependiente Judicial
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                 Revisar Actividades Abogados en el mes
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Entrega documentación Clientes
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">Ver Todas las Tareas</a>
                            </li>
                        </ul>
                    </li>
                    <!-- < #END# Tasks > -->
                    <!-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->
                </ul>
            </div>
           <!-- Fin notificaciones -->

        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
				<div style="width:100%;">
                    <div class="image" style="width:20%; float:left !important; ">
						<img src="../../images/user.png" width="48" height="48" alt="User" />
					</div>
					<div style="width:70%; float:left !important; line-height: 10px;">
						<span style="font-size:12px; color:white; padding-left: 10px; white-space: pre-line; line-height: 1;">
							<?php echo strtoupper(trim($_SESSION['NombreEmpresa'])); ?>
						</span>
					</div>
                </div>
                <div class="info-container" style="width:100%; float:left !important;">
					<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                       
                        <span id="xNom">
							<?php echo $_SESSION['NombreUsuario']; ?>
						</span>                   
                    </div>


                    <div class="email">                        
                        <span id="xMail">
							<?php echo $_SESSION['EmailUsuario']; ?>
						</span>
                    </div>


                    <!-- <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo trim($nombre); ?></div>
                    <div class="email"><?php echo trim($email); ?></div> -->
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>
                            <!-- <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Seguimientos</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Tareas</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">book</i>Notificaciones</a></li>
                            <li role="seperator" class="divider"></li> -->
                            <li><a href="./close.php"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php 
                $_SESSION["opcMenu"]="P";
                require_once('menu.php'); 
            ?> 
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">Administrador - <?php echo $empresa; ?></a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">          
           
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    INFORMACION DE: <?php echo strtoupper($nombre_lnk); ?>
                    <small>Opciones: <a href="#" target="_blank">crear Proceso.</a></small>
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <!-- <div class="header">
                            <h2>Opciones para Exportar</h2>
                            <ul class="header-dropdown m-r--1">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons" style="font-size:24px;color:red">add</i>  										      
                                    </a>                                     
                                    
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a id="nuevo" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#defaultModal">Nuevo</a>                                      
                                        </li>                                       
                                    </ul>
                                    
                                </li>
                            </ul>
                        </div> -->
                        <div class="body table-responsive" id="zonaquery">
                            <!-- <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="grid"> -->                               
                                <!-- <tbody> -->
<?php
require_once('../../Connections/DataConex.php');
$soportecURL = "S";
$url         = urlServicios."consultadetalle/consultadetalle_pro_proceso.php?IdMostrar=0";
$existe      = "";
$usulocal    = "";
$siguex      = "";

if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 0);
    $resultado = curl_exec ($ch);
    curl_close($ch);

    $mproceso =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $mproceso = json_decode($mproceso, true);
    //echo("<script>console.log('PHP: ".print_r($mproceso)."');</script>");
    //echo("<script>console.log('PHP: ".count($m['pro_proceso'])."');</script>");
    
    $json_errors = array(
        JSON_ERROR_NONE => 'No se ha producido ningún error',
        JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
        JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
        JSON_ERROR_SYNTAX => 'Error de Sintaxis',
        );
    //echo "Error : ", $json_errors[json_last_error()], PHP_EOL, PHP_EOL."<br>";        
}
else
{
    $soportecURL = "N";
    echo "No hay soporte para cURL";
} 

if($soportecURL == "N")
{
    require_once('./unirest/vendor/autoload.php');
    $response = Unirest\Request::get($url, array("X-Mashape-Key" => "MY SECRET KEY"));
    $resultado = $response->raw_body;
    $resultado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);
    $mproceso = json_decode($resultado, true);	        
} 

if( $mproceso['estado'] < 2)
{
    $nombre_Tabla="";
    for($i=0; $i<count($mproceso['pro_proceso']); $i++)
    {
        $NombreTabla = trim($mproceso['pro_proceso'][$i]['PRO_NumeroProceso']);        
        $archivo = $NombreTabla.".php";
        $idTabla = $mproceso['pro_proceso'][$i]['PRO_IdProceso'];
        $AsignadoA =$mproceso['pro_proceso'][$i]['AsignadoA'];
        $Ubicacion =$mproceso['pro_proceso'][$i]['Ubicacion'];
        $ClaseProceso =$mproceso['pro_proceso'][$i]['ClaseProceso'];
        $Juzgado =$mproceso['pro_proceso'][$i]['Juzgado'];
        $estadoTabla = trim($mproceso['pro_proceso'][$i]['EstadoTabla']);
    ?>
       
    <?php                          
    }
}
?>
 <!-- </tbody> -->
<!-- </table> -->
                        <div >
                        <!-- form -->
                        <form id="form_validation" method="POST" autocomplete="ÑÖcompletes">
                                
                                <div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-xs-10"><span style="color:red;">*</span>                                                 
                                                <label class="form-label">C&oacute;digo DANE Departamento / Municipio:</label>
                                                <div class="xform-line">                                                    
                                                    <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="zip" id="zip" required>
                                                    <option value="" >Seleccione Municipio...</option>
                                                    <?php
                                                        $idTabla = 0;
                                                        require_once('../../apis/general/ciudad.php');
                                                        for($i=0; $i<count($mciudad['gen_ciudad']); $i++)
                                                        {
                                                            $CIU_IdCiudades = $mciudad['gen_ciudad'][$i]['CIU_IdCiudades'];
                                                            $CIU_Nombre = $mciudad['gen_ciudad'][$i]['CIU_Nombre'];
                                                            $CIU_Abreviatura = $mciudad['gen_ciudad'][$i]['CIU_Abreviatura'];                                                                
                                                            $CIU_IdDepartamento = $mciudad['gen_ciudad'][$i]['CIU_IdDepartamento'];
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
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-xs-10"><span style="color:red;">*</span> 
                                                <label class="form-label">Corporaci&oacute;n / Jurisdicci&oacute;n:</label>                                        
                                                <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tipojuzgado" id="tipojuzgado" required>
                                                    <option value="" >Seleccione Corporaci&oacute;n...</option>
                                                    <?php
                                                        $idTabla = 0;
                                                        require_once('../../apis/general/tipojuzgado.php');
                                                        for($i=0; $i<count($mtipojuzgado['juz_tipojuzgado']); $i++)
                                                        {
                                                            $TJU_IdTipoJuzgado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_IdTipoJuzgado'];                                                    
                                                            $TJU_Nombre = trim($mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Nombre']);
                                                            $TJU_Codigo = trim($mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Codigo']);
                                                            $TJU_Estado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Estado'];
                                                    ?>
                                                            <option value="<?php echo $TJU_IdTipoJuzgado; ?>" >
                                                                <?php echo  $TJU_Codigo .'-'. $TJU_Nombre ; ?>                                                
                                                            </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                               

                                <div class="form-group">                               
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-xs-10"><span style="color:red;">*</span> 
                                                <label class="form-label">Especialidad o &Aacute;rea:</label>                                                
                                                <!-- <input type="text" class="form-control" name="area" id="area" value="<?php //echo $JUZ_Area ;?>" maxlength="5" autocomplete="ÑÖcompletes" required> -->
                                                <select id="area" name="area" class="selectpicker show-tick" data-live-search="true" data-width="95%" required>
                                                    <option value="">-- Seleccione Especialidad o Area.... --</option>
                                                </select>                                                
                                            </div>
                                        </div>	
									</div>	
								</div>

                                <div class="form-group">                               
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-xs-9">
                                                <label class="form-label">Despacho</label>                                                
                                                <select id="despacho" name="despacho" class="selectpicker show-tick" data-live-search="true" data-width="95%" required>
                                                    <option value="">-- Seleccione Despacho.... --</option>
                                                </select> 
                                                
                                            </div>
                                        </div>	
									</div>	
								</div>

                                <div class="form-group">                               
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="row">                                            
                                            <div class="ccol-xs-3">
                                                <label class="form-label">Año</label>                                        
                                                <div class="form-line" style="width: 20%">
                                                    <input type="text" class="form-control" name="anio" id="anio" value="<?php echo $yy; ?>" maxlength="4" autocomplete="ÑÖcompletes" required>
                                                    <label class="form-label"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                
                                
                                <div class="form-group">                                    
                                    <div class="col-lg-6 col-md-6 col-sm-5">
                                        <div class="row">
											<div class="xcol-xs-9">
												<label class="form-label">Nro. Consecutivo Radicaci&oacute;n:</label>
                                                <div class="form-line" style="width: 70%">
                                                    <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="nproceso"id="nproceso" min="1" max="99999" maxlength="5" placeholder="Si no tiene número del Radicado dejarlo en blanco." autocomplete="off" required>
                                                </div>                                                    											
											</div>
                                        </div>	
									</div>	
								</div>

								<div class="form-group">                                    
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="row">			
											<div class="xcol-xs-5">
												<label class="form-label">Control:</label>
                                                <div class="form-line" style="width: 35%">
                                                    <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="ndv"id="ndv" min="0" max="99" maxlength="2" autocomplete="off" required>
                                                </div>												
											</div>											
										</div>	
									</div>	
								</div>	

                                <div class="form-group">
									<div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
											<div class="xcol-sm-9"><span style="color:red;">*</span> 
												<label class="form-label">C&oacute;digo &Uacute;nico del Proceso:</label>
												<div class="form-line" style="width: 80%">
													<input type="text" class="form-control" name="proceso"id="proceso" value="" maxlength="23" required readonly/>													
												</div>
                                                <div style="font-size:11px; text-align:right;width: 80%">
                                                    Caracteres: <span id="muestrocantidadcaracteresid">0</span> de 23
                                                </div>	
											</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
									<div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="row">											
											<div class="xcol-sm-6"><span style="color:red;">*</span> 
												<label class="form-label">Fecha Inicio</label>												
												<div class='input-group date form-line' name="fechainicio" id="fechainicio" required>
													<input type='text' id="txtFecha" class="form-control" value="" readonly/>
													<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
													</span>
												</div>
											</div>																						
										</div>
									</div>	
                                </div> 
                                
                                <div class="form-group">
                                    <div class="col-lg-7 col-md-7 col-sm-7">
										<div class="row">											
											<div class="xcol-sm-8"><span style="color:red;">*</span> 
                                                <label class="form-label">Apoderado(a):</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="usuario" id="usuario" required>
												<option value="" >Seleccione Apoderado(a)...</option>
												<?php
                                                    $idTabla = 1;
                                                    require_once('../../apis/usuario/infoUsuarioAbogado.php');
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
									<div class="col-lg-5 col-md-5 col-sm-5">                                
                                        <div class="row">
                                            <div class="xcol-sm-8" style="margin-left:15px;"><span style="color:red;">*</span> 
												<label class="form-label">Representante de: </label>
                                                <div class="form-group">                                                    
													<input type="radio" name="representa" id="acusador" class="with-gap" value="1">
													<label for="acusador">Demandante</label>

													<input type="radio" name="representa" id="acusado" class="with-gap" value="2">
													<label for="acusado" class="m-l-20">Demandado</label>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-sm-6"><span style="color:red;">*</span> 
                                                <label class="form-label">Ubicación:</label>                                                                                   
                                                <select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="ubicacion" id="ubicacion" required>
                                                <option value="" >Seleccione Ubicación...</option>
                                                <?php
                                                    $idTabla = 0;
                                                    require_once('../../apis/proceso/ubicacion.php');
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
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-sm-8"><span style="color:red;">*</span> 
                                                <label class="form-label">Clase Proceso:</label>                                                
                                                    <select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="claseproceso" id="claseproceso" required>
                                                    <option value="" >Seleccione Clase Proceso...</option>
                                                    <?php
                                                        $idTabla = 0;
                                                        require_once('../../apis/proceso/claseproceso.php');
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
                                </div>
								
								<div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">											
											<div class="xcol-sm-8"><span style="color:red;">*</span> 
                                                <label class="form-label">Demandante:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="cliente" id="cliente" required>
												<option value="" >Seleccione Demandante...</option>
												<?php
													$idTabla = 0;
													$tipoCLiente = 1;
                                                    include '../../apis/cliente/infoCliente.php';
													for($i=0; $i<count($mcliente['cli_cliente']); $i++)
													{
                                                        if( $mcliente['cli_cliente'][$i]['CLI_IdTipoCliente'] == 1 )
                                                        {
                                                            $CLI_IdCliente = $mcliente['cli_cliente'][$i]['CLI_IdCliente'];
                                                            $CLI_Nombre = $mcliente['cli_cliente'][$i]['NombreUsuario'];                                                            
												?>
                                                            <option value="<?php echo $CLI_IdCliente; ?>" >
                                                                <?php echo $CLI_Nombre ; ?>
                                                            </option>
												<?php
                                                        }
													}
												?>
												</select>
											</div>
										</div>	
                                    </div>                                       
                                </div>
								
								<div class="form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">											
											<div class="xcol-sm-8"><span style="color:red;">*</span> 
                                                <label class="form-label">Demandado:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="demandado" id="demandado" required>
												<option value="" >Seleccione Demandado...</option>
												<?php
													$idTabla = 0;
													$tipoCLiente = 2;
                                                    include '../../apis/cliente/infoCliente.php';
													for($i=0; $i<count($mcliente['cli_cliente']); $i++)
													{
                                                        if( $mcliente['cli_cliente'][$i]['CLI_IdTipoCliente'] == 2 )
                                                        {
                                                            $CLI_IdCliente = $mcliente['cli_cliente'][$i]['CLI_IdCliente'];
                                                            $CLI_Nombre = $mcliente['cli_cliente'][$i]['NombreUsuario'];                                                        
												?>
                                                            <option value="<?php echo $CLI_IdCliente; ?>" >
                                                                <?php echo $CLI_Nombre ; ?>
                                                            </option>
												<?php
                                                        }
													}
												?>
												</select>
											</div>
										</div>	
                                    </div>                                       
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-9 col-md-9 col-sm-9">                                
                                        <div class="row">
                                            <div class="xcol-sm-8">
                                                <div class="form-group form-float" style="clear: both;">
                                                    <label class="form-label">Estado: </label>
                                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1">
                                                    <label for="activo">Abierto</label>

                                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2">
                                                    <label for="inactivo" class="m-l-20">Cerrado</label>																										
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                <hr>
                                <div class="form-group">
                                    <div class="col-xs-9">                                
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <button class="btn btn-primary waves-effect" type="submit" id="grabar">GRABAR</button>
                                                <button class="btn btn-info waves-effect" type="button" id="actoprocesal">ACTUACION PROCESAL</button>
                                                <button class="btn btn-danger waves-effect" type="submit" id="cerrar">SALIR</button>
												<div><span style="color:red;">* Campos Obligatorios.</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                      
                        </form>                        
                        <!-- end form -->
                        </div>
                        
                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<script type="text/javascript">
 $(document).ready(function () {	 
	$("#cerrarModal").click(function(){
	 	 window.location="pro_<?php echo $nombre_lnk; ?>.php";
	});

	$("#cerrarModalC").click(function(){
	 	 window.location="pro_<?php echo $nombre_lnk; ?>.php";
	});	

    $("#nuevo").on("click", function(){

    });
	
	$("#actoprocesal").on("click", function(){
		var id = "<?php echo $idTabla ?>";
		var proceso ="<?php echo $NombreTabla; ?>";
		$.post('editaractprocesal.php', { 'id': id, 'proceso': proceso }, function (result) {
			WinId = window.open('','_self');
			WinId.document.open();
			WinId.document.write(result);
			WinId.document.close();
		});
		
    });

 });

function cambiar(nuevaurl) 
{ 
    var obj       = $('#carga');
    var container = $(obj).parent();
    $(obj).attr('data', nuevaurl);
    var newobj    = $(obj).clone();
    $(obj).remove();
    $(container).append(newobj);
}

function crear(nuevaurl) 
{ 
    var obj       = $('#crear');
    var container = $(obj).parent();
    $(obj).attr('data', nuevaurl);
    var newobj    = $(obj).clone();
    $(obj).remove();
    $(container).append(newobj);
}

 function maxLengthCheck(object) {
    if (object.value.length > object.maxLength)
    object.value = object.value.slice(0, object.maxLength)
}
    
function isNumeric (evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode (key);
    var regex = /[0-9]|\./;
	var keyCode = evt.keyCode == 0 ? evt.charCode : evt.keyCode;
    if ( !regex.test(key) || keyCode == 46 ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
</script>	
</body>
</html>
<?php //ob_end_flush(); ?>