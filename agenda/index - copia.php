<?php
ob_start();
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if( !isset($_SESSION['IdUsuario']) && !isset($_SESSION['NombreUsuario']) )
{
	header("Location: ../index.html");
    exit;
}
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL,"es_ES");

/* Fehca y Hora del server para que desde el cliente no puedan modificar la fecha */
//setlocale(LC_ALL,"es_CO");
$zonahoraria = date_default_timezone_get();
//echo 'Zona horaria predeterminada del server: ' . $zonahoraria;
$zonahoraria = date_default_timezone_set('America/Bogota');
//echo '<br>Zona horaria predeterminada: ' . $zonahoraria;
$zonahoraria1 = date_default_timezone_get('America/Bogota');
//echo '<br>Zona horaria predeterminada: ' . $zonahoraria1;
$hoy = getdate();
//print_r($hoy);
$nombredia = "";
$nrodia = $hoy['wday'];
$dia = $hoy['mday'];
switch($nrodia)
{
	case 0:
		$nombredia = "Sun";
		$dia = $dia + 1;
		break;
	case 1:
		$nombredia = "Mon";
		break;
	case 2:
		$nombredia = "Tue";
		break;
	case 3:
		$nombredia = "Wed";
		break;
	case 4:
		$nombredia = "Thu";
		break;
	case 5:
		$nombredia = "Fri";
		break;
	case 6:
		$nombredia = "Sat";
		$dia = $dia + 2;
		break;	
}
$diahoy = $hoy['mday'] ;
if( strlen($diahoy) == 1 )
{
	$diahoy = "0".$diahoy;
}

$fecha_actual = $nombredia." ". date("M") ." ". $diahoy ." ". $hoy['year']." ". $hoy['hours'].":".$hoy['minutes'].":".$hoy['seconds']." GMT-0500 (hora estándar de Colombia)";
$fecha_actualdef = $nombredia." ". date("M") ." ". $dia ." ". $hoy['year']." ". $hoy['hours'].":".$hoy['minutes'].":".$hoy['seconds']." GMT-0500 (hora estándar de Colombia)";
//echo $fecha_actual; 
$comparaph = substr($fecha_actual, 0,15);
echo "<script>
	var x = new Date();
	var fechajs = x.toString();
	comparajs = fechajs.substring(0,15);
	var comparaphp = '". $comparaph ."';
	if (comparajs !== comparaphp)
	{
		alert('Tu computador tiene fecha diferente a la actual.  Debes revisar.  '+comparajs +' / '+comparaphp);
		window.location = 'inde.php';
		
	}
</script>";
include('../Connections/cnn_kn.php'); 
include('../Connections/config2.php');
?>
<?php
if (!function_exists("GetSQLValueString")) {
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

$empresa = "AppJuridica";
$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

// incluimos el archivo de funciones
include 'fc/funciones.php';

// Verificamos si se ha enviado el campo con name from
if (isset($_POST['from'])) 
{

    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from']!="" AND $_POST['to']!="") 
    {
        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio = _formatear($_POST['from']);
        // y la formateamos con la funcion _formatear

        $final  = _formatear($_POST['to']);

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio_normal = $_POST['from'];

        // y la formateamos con la funcion _formatear
        $final_normal  = $_POST['to'];

        // Recibimos los demas datos desde el form
        $titulo = evaluar($_POST['title']);

        // y con la funcion evaluar
        $body   = evaluar($_POST['event']);

        // reemplazamos los caracteres no permitidos
        $clase  = evaluar($_POST['class']);
        $conexion = $cnn_kn;
        // insertamos el evento
        $query="INSERT INTO eve_evento VALUES(null,'$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal')";
//echo "<br><br><br><br><br><br>..............................................................................sel.......$query";
        // Ejecutamos nuestra sentencia sql
        $conexion->query($query); 

        // Obtenemos el ultimo id insetado
        $im=$conexion->query("SELECT MAX(id) AS id FROM eve_evento");
        $row = $im->fetch_row();  
        $id = trim($row[0]);

        // para generar el link del evento
        //$link = "$base_url"."descripcion_evento.php?id=$id";
        $link = "fc/descripcion_evento.php?id=$id";

        // y actualizamos su link
        $query="UPDATE eve_evento SET url = '$link' WHERE id = $id";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query); 

        // redireccionamos a nuestro calendario
        //header("Location:$base_url");        
        header("Location: ./");
    }
}
//
$script_tz = date_default_timezone_get();
$nombre = "";
$email  = "";
?>
<!DOCTYPE html>
<html>
<head>
    <meta "Content-type: application/json; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bienvenido a | <?php echo $empresa; ?> Administrador</title>
    <!-- Favicon-->
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    
     <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    
    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>    
    
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
     
    <link rel="stylesheet" href="fc/css/calendar.css">
    <script type="text/javascript" src="fc/js/es-ES.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="fc/js/moment.js"></script>
    <!--
    <script src="fc/js/jquery.min.js"></script>
    <script src="fc/js/bootstrap.min.js"></script>        
    -->        
    <script src="fc/js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="fc/css/bootstrap-datetimepicker.min.css" />
	<script src="fc/js/bootstrap-datetimepicker.es.js"></script>
	<style>
	.page-headerx {
		padding-bottom: 1px;
		margin: 40px 0 5px;
		border-bottom: 1px solid #eee;
	}
	</style>
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
            <p>Favor espere un momento...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="INICIAR BUSQUEDA ...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="../">
                    <img src="../images/logoaj.png" style="margin-top: -10px;">
                </a>
            </div>
            <!--  Notificaciones
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    < Call Search >
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    < #END# Call Search >
                    < Notifications >
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
                                                <h4>3 Nacionalizaciones de Carga</h4>
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
                                                <h4>1 Gestión de Transporte</h4>
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
                                                <h4>3 <b>Disponibilidad</b> Flota Transporte</h4>
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
                                                <h4>Revisar 3 DTA´s</h4>
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
                        </ul>                    </li>
                    < #END# Notifications >
                    < Tasks >
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
                                                Reporte Min Transporte
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
                                                Revisar cumplimiento por Transportador
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
                                                Revisar OTM´s generados en el mes
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
                                                 Revisar DTA´s generados en el mes
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
                                                Entrega documentación Expo Carga
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
                    < #END# Tasks >
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
            Fin Notificaciones -->

        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">

                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                        
                        <span id="xNom"><?php echo $_SESSION['NombreUsuario']; ?></span>                   
                    </div>

                    <div class="email">                       
                        <span id="xMail"><?php echo $_SESSION['EmailUsuario']; ?></span>
                    </div>
                    
                    <!-- <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo trim($nombre); ?></div> 
                    <div class="email"><?php echo trim($email); ?></div>-->
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>
                            <!-- <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Seguimientos</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Tareas</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">book</i>Notificaciones</a></li>
                            <li role="seperator" class="divider"></li> -->
                            <li><a href="../"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php 
            //include('fc/index.php'); 
            require_once('../menu/menu.php');
            ?>           
            
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);"> Administrador - <?php echo $empresa; ?></a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->       
    </section>

    <section class="content">
        <div class="container-fluid">            
            <!--<div class="block-header"><h2>TABLERO DE CONTROL</h2> </div>  -->

            <!-- Widgets -->
            <div class="row clearfix" style="background: white;">                
                <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Mis Procesos: <?php echo $nombremes. ' '.$yy ;?> </div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $cantclases; ?>" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>  
                -->
                <?php //require_once('fc/'); ?>                
                <!-- 1 -->
                <div class="container" style="width:85%; margin-top: -90px !important">

                    <div class="row" style="width:100%; margin-top: -40px">
                        <div class="page-header"><h2></h2></div> 
                        <div class="pull-left form-inline">
                            <div class="btn-group">
                                <button class="btn btn-primary" data-calendar-nav="prev">
                                    << Anterior
                                </button>
                                <button class="btn" data-calendar-nav="today">Hoy</button>
                                <button class="btn btn-primary" data-calendar-nav="next">
                                    Siguiente >>
                                </button>
                           
                                <button class="btn btn-warning" data-calendar-view="year" style="cursor: pointer">Año</button>
                                <button class="btn btn-warning active" data-calendar-view="month" style="margin-left: 3px; margin-right: 3px; cursor: pointer">Mes</button>
                                <button class="btn btn-warning" data-calendar-view="week" style="margin-right: 3px; cursor: pointer">Semana</button>
                                <button class="btn btn-warning" data-calendar-view="day" style="cursor: pointer">Dia</button>                               
                            
                                <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>+</button>
                            </div>
                        </div>
                        
                        <!--<div class="pull-left form-inline"><br></div>   -->
                        <div class="row">
                            <div id="calendar" style="width: 100%;"></div> <!-- Aqui se mostrara nuestro calendario -->
                            <br>
                        </div>
                    </div><hr>
                    
                    <!--ventana modal para el calendario-->
                    <div class="modal fade" id="events-modal">
                        <div class="modal-dialog">
                            <div class="modal-content" style="height:490px !important;">
                                <div class="modal-body" style="height: 400px !important">
                                    <p>One fine body&hellip;</p>
                                </div>
                                <div class="modal-footer" style="margin-top:-15px;">
									<hr>
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                
                <script src="fc/js/underscore-min.js"></script>
                <script src="fc/js/calendar.js"></script>
                <script type="text/javascript">
                $(document).ready(function(){
					
					$("#modalAgenda").show();
					$("#modalAgendaOk").hide();
					$("#modalErr").hide();					
					
                    //creamos la fecha actual					
                    var date = new Date();
                    var yyyy = date.getFullYear().toString();
                    var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                    var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

                            //establecemos los valores del calendario
                            var options = {

                                // definimos que los eventos se mostraran en ventana modal
                                    modal: '#events-modal', 

                                    // dentro de un iframe
                                    modal_type:'iframe',    

                                    //obtenemos los eventos de la base de datos
                                    events_source: 'fc/obtener_eventos.php', 

                                    // mostramos el calendario en el mes
                                    view: 'month',             

                                    // y dia actual
                                    day: yyyy+"-"+mm+"-"+dd,

                                    // definimos el idioma por defecto
                                    language: 'es-ES', 

                                    //Template de nuestro calendario
                                    tmpl_path: 'fc/tmpls/', 
                                    tmpl_cache: false,

                                    // Hora de inicio
                                    time_start: '08:00', 

                                    // y Hora final de cada dia
                                    time_end: '22:00',   

                                    // intervalo de tiempo entre las hora, en este caso son 30 minutos
                                    time_split: '30',    

                                    // Definimos un ancho del 100% a nuestro calendario
                                    width: '100%', 

                                onAfterEventsLoad: function(events)
                                {
                                    if(!events)
                                    {
                                        return;
                                    }
                                    var list = $('#eventlist');
                                    list.html('');

                                    $.each(events, function(key, val)
                                    {
                                        $(document.createElement('li'))
                                            .html('<a href="' + val.url + '">' + val.title + '</a>')
                                            .appendTo(list);
                                    });
                                },
                                onAfterViewLoad: function(view)
                                {
                                    $('.page-header h2').text(this.getTitle());
                                    $('.btn-group button').removeClass('active');
                                    $('button[data-calendar-view="' + view + '"]').addClass('active');
                                },
                                classes: {
                                    months: {
                                        general: 'label'
                                    }
                                }
                            };

                            // id del div donde se mostrara el calendario
                            var calendar = $('#calendar').calendar(options); 

                            $('.btn-group button[data-calendar-nav]').each(function()
                            {
                                var $this = $(this);
                                $this.click(function()
                                {
                                    calendar.navigate($this.data('calendar-nav'));
                                });
                            });

                            $('.btn-group button[data-calendar-view]').each(function()
                            {
                                var $this = $(this);
                                $this.click(function()
                                {
                                    calendar.view($this.data('calendar-view'));
                                });
                            });

                            $('#first_day').change(function()
                            {
                                var value = $(this).val();
                                value = value.length ? parseInt(value) : null;
                                calendar.setOptions({first_day: value});
                                calendar.view();
                            });
                    });
                </script>
                <!-- fin 1 -->
                
                <!-- 2Modal -->
                <div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                    <div class="modal-dialog" id="modalAgenda">
                        <div class="flex-container modal-content" style="height:520px !important">
                            <div class="modal-header" style="height:70px">
                                <div style="display:table-cell">
                                <h4 class="modal-title" id="myModalLabel">    
                                    <span class="glyphicon glyphicon-list-alt"></span>                                                                    
                                    Agendar Actividad / Visita                                    
                                </h4>
                                </div>                            
                                <div  style="display:table-cell" id="msg">Grabado</div>
                                <hr style="margin-top:-0.5px; border: 0.5px solid red;">                                
                            </div>
                                                           
                        
                            <div class="modal-body" style="height:520px !important">
                                
                                <form action="" method="post">
                                    
                                <div class="form-group" style="margin-top:-33px !important; height:60px  !important;">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">                                                                                  
                                            <label class="form-label">Fecha Inicio</label>												
                                            <div class='input-group date form-line' id="from" readonly required>
                                                <input type='text' id="fromx" name="fromx" class="form-control" readonly/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>                                        
                                        </div>
                                
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">                                        
                                            <label class="form-label">Fecha Final</label>												
                                            <div class='input-group date form-line' id="to" readonly required>
                                                <input type='text' id="tox" name="tox" class="form-control" readonly/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>                                        
                                        </div>
                                    </div>	
                                </div>                                
								
								<div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                            
                                            <label for="tipo">Asignar a</label>                                                
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="responsable" id="responsable" required>    
                                                <option value="">Seleccione a quien se Asigna la Agenda</option>
                                                <?php 
                                                $idTabla = 0;
                                                require_once('../apis/usuario/infoUsuarioagenda.php');                                                    
                                                for($i=0; $i<count($muser['usu_usuario']); $i++)
                                                {
                                                    $USU_IdUsuario = $muser['usu_usuario'][$i]['USU_IdUsuario'];                                                    
                                                    $USU_NombreUsuario = trim($muser['usu_usuario'][$i]['NombreUsuario']);														
                                                ?>
                                                    <option value="<?php echo $USU_IdUsuario; ?>"><?php echo $USU_NombreUsuario; ?></option>                                                    
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>	
                                </div>								
                                
                                <div class="form-group">
                                    <div class="row">                
                                        <div class="col-md-6">                                            
                                            <label for="tipo">N&uacute;mero de Proceso</label>                                                
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="proceso" id="proceso" required>    
                                                <option value="">Seleccione Proceso</option>                                                    
                                            </select>                                            
                                        </div>
                                
                                        <div class="col-md-6">                                           
                                            <label for="tipo">Tipo de Actividad</label>                                                
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tipo" id="tipo" required>    
                                                <option value="event-info">Informaci&oacute;n Proceso</option>
                                                <option value="event-success">Cita en Juzgado</option>
                                                <option value="event-important">Cita con Cliente</option>
                                                <option value="event-warning">Visita a Juzgado</option>
                                                <option value="event-special">Documentos Adjuntos</option>
                                            </select>                                            
                                        </div>
                                    </div>	
                                </div>

                                <div class="form-group">
                                    <div class="row" style="margin-top:20px">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="title">Asunto</label>
                                            <div class="form-line" style="width: 70%">
                                            <input type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título">
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                                
                                <div class="form-group">
                                    <div class="row" style="margin-top:20px">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                            
                                            <label for="body">Observaciones</label>
                                            <div class="form-line" style="width: 90%">
                                            <textarea id="body" name="event" required class="form-control" rows="3"></textarea>
                                            </div>                                            
                                        </div>
                                    </div>	
                                </div>
								
								<div class="modal-footer"  style="margin-top:-20px !important; height:60px;">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                        
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                <i class="fa fa-times"></i> Salir
                                            </button>
                                            <button type="button" class="btn btn-success" id="agregar" onclick="myFunction()">
                                                <i class="fa fa-check"></i> Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <script type="text/javascript">
                                    //var $=jQuery.noConflict();
                                    $(document).ready(function(){ 
										//beforeShowDay: $.datepicker.noWeekends;
										var dd = "<?php echo $fecha_actual; ?>";										
										console.log('dia es: ' + dd);
										var exclude_dates = ['2019-04-18', '2019-04-19'];								
										console.log(new Date());
											
                                        $('#from').datetimepicker({
                                            language: 'es',											
											daysOfWeekDisabled: [0, 6],
											datesDisabled: exclude_dates,
											autoclose: true,
											defaultDate: "<?php echo $fecha_actualdef; ?>", //dd,											
                                            format:'DD/MM/YYYY HH:mm:ss',
											minDate: dd,
                                            viewMode: 'days'
                                        });
                                        $('#to').datetimepicker({
                                            language: 'es',
											daysOfWeekDisabled: [0, 6],
											autoclose: true,
											defaultDate: "<?php echo $fecha_actualdef; ?>", //dd,
                                            format: 'DD/MM/YYYY HH:mm:ss',
                                            minDate: dd,
                                            viewMode: 'days'
                                        });
										
										$("#responsable").on('change', function(){
											var idresponsable = $("#responsable").val();
											//alert(idresponsable);											
											$.ajax({
												data: {"id": idresponsable },
												url: 'fc/procesosxapoderado.php',
												type: 'GET',                            
												dataType: 'json',												
												success: function( data, textStatus, jQxhr ){													
													var zdata = unescape(data);
													zdata = data.pro_proceso;
													var selectedOption = '0';
													var newOptions = zdata;
													var select = $('#proceso');
													if(select.prop) 
													{
														var options = select.prop('options');
													}
													else 
													{
														var options = select.attr('options');
													}
													$('option', select).remove();
													
													if(newOptions != 'undefined')
													{
														$.each(newOptions, function(val, text) {
															options[options.length] = new Option(text.NP, text.PRO_IdProceso);
														});
													}
													
													select.val(selectedOption);
													$('#proceso').selectpicker('refresh');
													_proceso = $('#proceso').val();

												},
												error: function( jqXhr, textStatus, errorThrown ){
													console.log( errorThrown );
												}														
											});											
										});										
                                    });
                                </script>
                                
                                
                                <script type="text/javascript">                                
                                function myFunction() {    
                                    var from = document.getElementById("fromx").value;                                    
                                    var to = document.getElementById("tox").value;
                                    var proceso = document.getElementById("proceso").value;
                                    var responsable = document.getElementById("responsable").value;
                                    var tipo = document.getElementById("tipo").value;
                                    var title = document.getElementById("title").value;
                                    var body = document.getElementById("body").value;
									var nombreres = $('select[name="responsable"] option:selected').text();
									var nroproc = $('select[name="proceso"] option:selected').text();
									var origen = "a";
									
									if(fromx == "" || to =="" || proceso == "" || responsable == "" || tipo == "" || title == "" || body == "")
									{
										$("#modalAgenda").hide();										
										$("#modalAgendaOk").hide();
										$("#modalErr").show();
									}
									else
									{                                    
										$.ajax({
											url: '../pages/forms/crea_evento.php',
											type: 'POST',                            
											dataType: 'html',                                        
											data: {"from": from, "to": to, "proceso": proceso, "responsable" : responsable, "tipo": tipo, "title": title, "body": body},
											success: function( data, textStatus, jQxhr ){                                            
												var xrespstr = data.trim();
												var respstr = xrespstr.substr(0,1);
												var msj = xrespstr.substr(2);											
												
												if(respstr == "N")
												{                         
													$("#modalAgenda").show();
													$("#modalAgendaOk").hide();
													$("#modalErr").hide();
												}
												else
												{    
													if( respstr == "S" )
													{                        
														$.ajax({
															url: '../email/',
															type: 'POST',                            
															dataType: 'html',
															data: {"from": from, "to": to, "proceso": proceso, "responsable" : responsable, "tipo": tipo, "title": title, "body": body, "nr": nombreres, "np": nroproc, "origen": "a" },
															success: function( data, textStatus, jQxhr ){
																console.log(data);
															},
															error: function( jqXhr, textStatus, errorThrown ){
																console.log( errorThrown );
															}														
														});
														
														$("#modalAgenda").hide();
														$("#modalErr").hide();
														$("#modalAgendaOk").show();                         
													}                                                                                              
												}
												
											},
											error: function( jqXhr, textStatus, errorThrown ){
												console.log( errorThrown );
											}
										});
									}
                                }
								
								function salirerr() {									
									$("#modalErr").hide();
									$("#modalAgendaOk").hide();
									$("#modalAgenda").show();
								}
                                </script>
                                
                                </form>
                            </div>
                        </div>
                    </div>
					
					<div class="modal-dialog" id="modalAgendaOk" style="height:30% !important;">
                        <div class="modal-content">
                        <div class="sa-placeholder">
								<div class="container">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <h2>Atención.</h2>
                                            <hr>
                                        </div>                                        
                                    </div>

                                    <div class="row">
										<div class="col-lg-4 col-md-4 col-sm-4">
											<p>Agenda Grabada correctamente.</p>
										</div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="row" style="margin-top:-20px">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="volver" onclick="location.reload(true);">
                                                    <i class="fa fa-times"></i> Salir
                                                </button>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
					
					<div class="modal-dialog" id="modalErr" style="height:30% !important;">
                        <div class="modal-content">
							<div class="sa-placeholder">
								<div class="container">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<h2 style="text-align:center !important;">Atención.</h2>
											<hr>
										</div>										
									</div>									

									<div class="row">
										<div class="col-lg-4 col-md-4 col-sm-4">
											<p>Debe ingresar informacion en todos los campos.</p>
										</div>
									</div>
																	
									<div class="modal-footer">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="row" style="margin-top:-20px">
												<button type="button" class="btn btn-danger" data-dismiss="modal" id="salirerr" onclick="salirerr();">
													<i class="fa fa-times"></i> Salir
												</button>												
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					
                </div>
                <!-- 2 fin -->                
            </div>
            <!-- #END# Widgets -->           
        </div>
    </section>  

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Sweet Alert Plugin Js -->
    <!--  <script src="../../plugins/sweetalert/sweetalert.min.js"></script> -->
    <script src="../js/sweet/functions.js"></script>
    <script src="../js/sweet/sweetalert.min.js"></script>
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>
    
    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/morrisjs/morris.js"></script>

    <!-- ChartJs 
    <script src="../plugins/chartjs/Chart.bundle.js"></script>
    -->

    <!-- Flot Charts Plugin Js 
    <script src="../plugins/flot-charts/jquery.flot.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.time.js"></script>
    -->
    
    <!-- Sparkline Chart Plugin Js 
    <script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>
    -->

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/index.js"></script>

    <!-- Demo Js  -->
    <script src="../js/demo.js"></script> 
   
</body>
</html>
<?php ob_end_flush();?>