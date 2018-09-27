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
//require_once('../../apis/juzgado/juzgado.php');
require_once('../../apis/cliente/infoCliente.php');
$yy = date("Y");
$empresa = "AppJuridica";
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

        <!-- DateTime Picker -->
        <link href="../../calendar/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

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
    <script src="../../calendar/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.es.js"></script>    

   <style>
    object{
       width:100%;
       height:390px ;  
	}

    .caja{
        margin-bottom:-10px !important;
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

            $.each(newOptions, function(val, text) {
                options[options.length] = new Option(text.ARE_Nombre, text.ARE_Codigo);
            });
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
            var selectedOption = '0';
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
            $.each(newOptions, function(val, text) {
                options[options.length] = new Option(text.JUZ_Ubicacion, text.JUZ_IdJuzgado);
            });
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
            if(_tipojuzgado != "")
            {
                _area =  $("#area").val();
            }
            _Proceso = _zipDeptoCiudad + _tipojuzgado + _area + _despacho + $("#anio").val() + _nProceso + _nDv;
            $("#proceso").attr("value",_Proceso);
            init_contador("#proceso","#muestrocantidadcaracteresid");
        }

    function init_contador(idtextarea, idcontador)
    {        
        var contador = $(idcontador);
        contador.html( $(idtextarea).val().length);
    }

    $(document).ready(function()
    {       
        $("#msj").hide();
		$("#area").attr("value", "");
        //$('#zip').numeric();
        $('#anio').numeric();
		$('#ndv').numeric();
        $('#consecutivo').numeric();
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
            //nombre = nombre.toUpperCase();
            fechainicio = $("#txtFecha").val();
            usuario = $("#usuario").val();
            ubicacion = $("#ubicacion").val();
            claseproceso = $("#claseproceso").val();
            pproceso = $("#proceso").val();
            juzgado = $("#tipojuzgado").val();
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
                    data : {"pnombre": nombre, "pfechainicio": fechainicio, "pusuario": usuario, "pubicacion": ubicacion, "pclaseproceso": claseproceso ,"pjuzgado": juzgado,"pestado": estado},
                    type: "POST",
                    dataType: "html",
                    url : "../forms/crea_<?php echo strtolower($NombreTabla); ?>.php",
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

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
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
                <a class="navbar-brand" href="../../index.html">
                <img src="../../images/logomw.fw.png" style="margin-top: -10px;">
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
                <div class="image">
                    <img src="../../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
					<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                       
                        <span id="xNom"><?php echo $_SESSION['NombreUsuario']; ?></span>                   
                    </div>


                    <div class="email">                        
                        <span id="xMail"><?php echo $_SESSION['EmailUsuario']; ?></span>
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
                            <li><a href="../../"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php require_once('menu.php'); ?> 
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
                        <!-- form -->
                        <form id="form_validation" method="POST"  autocomplete="ÑÖcompletes">

                                <div class="form-group" style="clear: both; margin-top:15px;">
                                    <div class="form-group">
										<div class="col-xs-12 caja">
											<div class="row">
												<div class="col-xs-5">                                                
													<label class="form-label">C&oacute;digo DANE Departamento / Municipio:</label>
													<div class="form-line">
														<!-- <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="zip" id="zip" min="1" max="99999" maxlength="5" required> -->
                                                        <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="zip" id="zip" required>
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

												<div class="col-xs-7">
													<label class="form-label">Corporaci&oacute;n:</label>                                        
													<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="tipojuzgado" id="tipojuzgado" required>
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
                                </div>                                

                                <div class="form-group">                               
                                    <div class="col-xs-12 caja">
                                        <div class="row">
                                            <div class="col-xs-6">                                                
                                                <label class="form-label">Especialidad:</label>
                                                <div class="form-line">
                                                    <!-- <input type="text" class="form-control" name="area" id="area" value="<?php //echo $JUZ_Area ;?>" maxlength="5" autocomplete="ÑÖcompletes" required> -->
                                                    <select id="area" name="area" class="selectpicker show-tick" data-live-search="true" data-width="80%" required>
                                                        <option value="">-- Seleccione Especializacion.... --</option>
                                                    </select> 
                                                </div>                                                
                                            </div>

                                            <div class="col-xs-3">
                                                <label class="form-label">Despacho</label>                                        
                                                <div class="form-line">
                                                    <!-- <input type="text" class="form-control" name="despacho" id="despacho" value="" maxlength="3" autocomplete="ÑÖcompletes" required>
                                                    <label class="form-label"></label> -->
                                                    <select id="despacho" name="despacho" class="selectpicker show-tick" data-live-search="true" data-width="80%" required>
                                                        <option value="">-- Seleccione Despacho.... --</option>
                                                    </select> 
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-3">
                                                <label class="form-label">Año</label>                                        
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="anio" id="anio" value="<?php echo $yy; ?>" maxlength="4" autocomplete="ÑÖcompletes" required>
                                                    <label class="form-label"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                
                                
                                <div class="form-group">                                    
                                    <div class="col-xs-12 caja">
                                        <div class="row">
											<div class="col-xs-6">
												<label class="form-label">Proceso:</label>
                                                <div class="form-line">
                                                    <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="nproceso"id="nproceso" min="1" max="99999" maxlength="5" autocomplete="off" required>
                                                </div>                                                    											
											</div>
											
											<div class="col-xs-3">
												<label class="form-label">Control:</label>
													<div class="form-line">
														<input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="ndv"id="ndv" min="0" max="99" maxlength="2" autocomplete="off" required>
													</div>												
											</div>											
										</div>	
									</div>	
								</div>	

                                <div class="form-group">
									<div class="col-xs-12 caja">
                                        <div class="row">
											<div class="col-sm-6">
												<label class="form-label">C&oacute;digo &Uacute;nico del Proceso:</label>
												<div class="form-line">
													<input type="text" class="form-control" name="proceso"id="proceso" value="" maxlength="23" required readonly/>													
												</div>
                                                <div style="font-size:11px; text-align:right;">
                                                    Caracteres: <span id="muestrocantidadcaracteresid">0</span> de 23
                                                </div>	
											</div>
											
											<div class="col-sm-6">
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
                                    <div class="col-xs-12 caja">
										<div class="row">											
											<div class="col-sm-8">
                                                <label class="form-label">Asignado a:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="usuario" id="usuario" required>
												<option value="" >Seleccione Asignado...</option>
												<?php
                                                    $idTabla = 0;
                                                    require_once('../../apis/usuario/infoUsuario.php');
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
                                </div>

                                <div class="form-group form-float" style="clear: both;">
                                    <div class="col-xs-12 caja">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label">Ubicación:</label>                                                                                   
                                                <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="ubicacion" id="ubicacion" required>
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


                                <div class="form-group form-float" style="clear: both;">
                                    <div class="col-xs-12 caja">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <label class="form-label">Clase Proceso:</label>                                                
                                                    <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="claseproceso" id="claseproceso" required>
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
                                    <div class="col-xs-12 caja">
										<div class="row">											
											<div class="col-sm-8">
                                                <label class="form-label">Demandante:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="cliente" id="cliente" required>
												<option value="" >Seleccione Cliente...</option>
												<?php
													for($i=0; $i<count($mcliente['cli_cliente']); $i++)
													{
														$CLI_IdCliente = $mcliente['cli_cliente'][$i]['CLI_IdCliente'];                                                
														$CLI_Nombre = $mcliente['cli_cliente'][$i]['NombreUsuario'];                                                
												?>
														<option value="<?php echo $CLI_IdCliente; ?>" >
															<?php echo $CLI_Nombre ; ?>                                                
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
                                    <div class="col-xs-12 caja">
										<div class="row">											
											<div class="col-sm-8">
                                                <label class="form-label">Demandado:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="demandado" id="demandado" required>
												<option value="" >Seleccione Demandado...</option>
												<?php
													for($i=0; $i<count($mcliente['cli_cliente']); $i++)
													{
														$CLI_IdCliente = $mcliente['cli_cliente'][$i]['CLI_IdCliente'];                                                
														$CLI_Nombre = $mcliente['cli_cliente'][$i]['NombreUsuario'];                                                
												?>
														<option value="<?php echo $CLI_IdCliente; ?>" >
															<?php echo $CLI_Nombre ; ?>                                                
														</option>
												<?php
													}
												?>
												</select>
											</div>
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
                                <hr>
                                <button class="btn btn-primary waves-effect" type="submit" id="grabar">GRABAR</button>
                                <button class="btn btn-danger waves-effect" type="submit" id="cerrar">CERRAR</button>

                                <!-- <div id="g" class='alert'>GRabado</div> -->
                            </form>                        
                        <!-- end form -->
                        
                        
                        
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
        //window.location='../forms/form-validationBasepais.php';
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
    if ( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
</script>	
</body>
</html>