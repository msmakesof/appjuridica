<?php
include_once("../pages/tables/header.inc.php");
//require_once ('../Connections/DataConex.php'); 
/**
**
**  BY iCODEART
**
**********************************************************************
**                      REDES SOCIALES                            ****
**********************************************************************
**                                                                ****
** FACEBOOK: https://www.facebook.com/icodeart                    ****
** TWIITER: https://twitter.com/icodeart                          ****
** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
** GITHUB: https://github.com/icodeart                            ****
** TELEGRAM: https://telegram.me/icodeart                         ****
** EMAIL: info@icodeart.com                                       ****
**                                                                ****
**********************************************************************
**********************************************************************
**/

// Definimos nuestra zona horaria
date_default_timezone_set("America/Bogota");

// incluimos el archivo de funciones
include 'funciones.php';

// incluimos el archivo de configuracion
include 'config.php';
$LogoInterno = LogoInterno; 
$LogoInterno = substr($LogoInterno,3);
$empresa = Company;

// Verificamos si se ha enviado el campo con name from
if (isset($_POST['from'])) 
{

    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from']!="" AND $_POST['to']!="") 
    {
		/**/	
        // Recibimos el fecha de inicio y la fecha final desde el form
        $Datein = date('d/m/Y H:i:s', strtotime($_POST['from']));
        $Datefi = date('d/m/Y H:i:s', strtotime($_POST['to']));		
		
		$inicio = _formatear($Datein);
		// y la formateamos con la funcion _formatear
		$final  = _formatear($Datefi);
		// Recibimos el fecha de inicio y la fecha final desde el form

		$orderDate = date('Y/m/d H:i:s', strtotime($_POST['from']));
		$inicio_normal = $orderDate;

		// y la formateamos con la funcion _formatear		
		$orderDate2 = date('Y/m/d H:i:s', strtotime($_POST['to']));
		$final_normal  = $orderDate2;			

		// Recibimos los demas datos desde el form
		$titulo = evaluar(strtoupper($_POST['title']));

		// y con la funcion evaluar
		$body   = evaluar($_POST['evento']);

		// reemplazamos los caracteres no permitidos
		$clase  = evaluar($_POST['class']);
		
		$tipousuario = evaluar($_POST['tipousuario']);
		
		$responsable = evaluar($_POST['responsable']);
		
		$proceso = evaluar($_POST['proceso']);
		
		$tipo = evaluar($_POST['tipo']);		
	
		/*
		// insertamos el evento
		$query="INSERT INTO agenda VALUES(null,'$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal',$tipousuario, $responsable, $proceso, '$tipo' )";

		// Ejecutamos nuestra sentencia sql
		$conexion->query($query) or die('<script type="text/javascript">
			alert("Horario No Disponible ");</script>');

		header("Location:$base_url"); 		

		// Obtenemos el ultimo id insetado
		$im=$conexion->query("SELECT MAX(id) AS id FROM agenda");
		$row = $im->fetch_row();  
		$id = trim($row[0]);

		// para generar el link del evento
		////$link = "$base_url"."descripcion_evento.php?id=$id";
		$link = "descripcion_evento.php?id=$id";

		// y actualizamos su link
		$query="UPDATE agenda SET url = '$link' WHERE id = $id";

		// Ejecutamos nuestra sentencia sql
		$conexion->query($query); 
		*/
		
		// redireccionamos a nuestro calendario
		header("Location:$base_url");	
    }
}

$yy = date("Y");
$nroMes = date("n");
setlocale(LC_TIME, 'es_ES');
$monthNum  = $nroMes;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());
$monthNameSpanish = ""; 
switch($monthNum)
{   
    case 1:
    $monthNameSpanish = "Enero";
    break;

    case 2:
    $monthNameSpanish = "Febrero";
    break;

    case 3:
    $monthNameSpanish = "Marzo";
    break;

    case 4:
    $monthNameSpanish = "Abril";
    break;

    case 5:
    $monthNameSpanish = "Mayo";
    break;

    case 6:
    $monthNameSpanish = "Junio";
    break;
	
	case 7:
    $monthNameSpanish = "Julio";
    break;

    case 8:
    $monthNameSpanish = "Agosto";
    break;

    case 9:
    $monthNameSpanish = "Septiembre";
    break;
	
	case 10:
    $monthNameSpanish = "Octubre";
    break;

    case 11:
    $monthNameSpanish = "Noviembre";
    break;

    case 12:
    $monthNameSpanish = "Diciembre";
    break;
}

$hoy = getdate();
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
	
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
	
    <title><?php echo $empresa; ?>:: Agenda</title>

	<!-- Google Fonts 	-->
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
    
	<!-- Sweet Alert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
	
	<!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />	

    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> O -->
    <link rel="stylesheet" href="css/calendar.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
	
	<!-- New -->
	<script src="../plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>
	<script src="../calendar/js/moment.min.js"></script>
	<link rel="stylesheet" href="../fc/css/bootstrap-datetimepicker.min.css" />
	<script src="../fc/js/bootstrap-datetimepicker.js"></script> 
	<script src="../fc/js/bootstrap-datetimepicker.es.js"></script>
	
	<!-- Fin New -->
	
    <script type="text/javascript" src="js/es-ES.js"></script> 
    

<!--
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/moment.js"></script> 
	<script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
-->		
	
<!--
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
-->	
	
    
    <!-- Custom CSS -->
    <style>
	 object{
       width:100%;
       height:390px ;  
	}
    </style>
</head>

<body style="background: white;" class="theme-red">

    <!-- Page Loader  -->
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
    <!-- Overlay For Sidebars  -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">buscar</i>
        </div>
        <input type="text" placeholder="Inicie ...">
        <div class="close-search">
            <i class="material-icons">cerrar</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
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
                        <span id="xNom"><?php echo $_SESSION["NombreUsuario"]; ?></span>                   
                    </div>

                    <div class="email">                       
                        <span id="xMail"><?php echo $_SESSION["EmailUsuario"]; ?></span>
                    </div>

                    <!-- <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php //echo trim($nombre); ?></div>
                    <div class="email"><?php //echo trim($email); ?></div> -->
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>
                            <li><a href="../pages/tables/close.php"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php include('../menu/menu.php'); ?>
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
    </section>

    <!-- inicio calendario -->
    <div class="container" id="cal">
        <div class="row">
            <div class="page-header"><h3><?php echo $monthNameSpanish .' '. $yy ;?></h3></div>
            <div class="pull-left form-inline"><br>
                <div class="btn-group">
                    <button class="btn btn-primary" data-calendar-nav="prev"><i class="fa fa-arrow-left"></i>  </button>
                    <button class="btn" data-calendar-nav="today">Hoy</button>
                    <button class="btn btn-primary" data-calendar-nav="next"><i class="fa fa-arrow-right"></i>  </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-warning" data-calendar-view="year">Año</button>
                    <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                    <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                    <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                </div>
            </div>
            <div class="pull-right form-inline"><br>
                <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Añadir Evento</button>
            </div>
        </div>
        <br><br><br>
        <div class="row">
			<div id="calendar"></div>
             <!-- Aqui se mostrara nuestro calendario -->            
        </div>

        <!--ventana modal para el calendario-->
        <div class="modal fade" id="events-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                       <div class="modal-header">
                        <a href="#" data-dismiss="modal" style="float: right;"> <i class="glyphicon glyphicon-remove "></i> </a>
                        <br>
                    </div>
                    <div class="modal-body" style="height: 400px !important">
                        <p>One fine body&hellip;</p>
                    </div>
                 
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- </div> -->

        <script src="<?=$base_url?>js/underscore-min.js"></script>
        <script src="<?=$base_url?>js/calendar.js"></script>
        <script type="text/javascript">
        $(document).ready(function()
        {        
            //creamos la fecha actual
            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
            var dd = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

            //establecemos los valores del calendario
            var options = {

                // definimos que los agenda se mostraran en ventana modal
                modal: '#events-modal', 

                    // dentro de un iframe
                    modal_type:'iframe',    

                    //obtenemos los agenda de la base de datos                    
                    events_source: 'obtener_eventos.php', 

                    // mostramos el calendario en el mes
                    view: 'month',             

                    // y dia actual
                    day: yyyy+"-"+mm+"-"+dd,   

                    // definimos el idioma por defecto
                    language: 'es-ES', 

                    //Template de nuestro calendario                    
                    tmpl_path: 'tmpls/',
                    tmpl_cache: false,

                    // Hora de inicio
                    time_start: '08:00', 

                    // y Hora final de cada dia
                    time_end: '18:00',   

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
						$('#page-header').text(this.getTitle());
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
                
                $('#tipousuario').change(function()
                {                   
                    $.getJSON('../pages/tables/urlink.php', {funcion: "ru", origen: $('#tipousuario').val()}, function (data) {
                        var zdata= data.usu_usuariotipousu;
                        var selectedOption = '0';
                        var newOptions = zdata;
                        var select = $('#responsable');
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
                            options[options.length] = new Option("", "Seleccione ");
                            $.each(newOptions, function(val, text) {
                                options[options.length] = new Option(text.NombreCompleto, text.USU_IdUsuario);
                            });
                        }
                        
                        select.val(selectedOption);
                        $('#responsable').selectpicker('refresh');
                        _responsable = $('#responsable').val();
                    });
                });

                $("#responsable").on('change', function()
                {                   
                    var idresponsable = $("#responsable").val();
                    $.ajax({
                        data: {"id": idresponsable },
                        url: 'fc/procesosxapoderado.php',
                        type: 'GET',                            
                        dataType: 'json',												
                        success: function( data, textStatus, jQxhr ){													
                            //var zdata = unescape(data);
                            var zdata = JSON.stringify(data);
                            zdata = data; //data.pro_proceso;
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
                                    options[options.length] = new Option(text.PRO_NumeroProceso, text.PRO_IdProceso);
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
				
				//$('.selectpicker').selectpicker();
				/*
				var exclude_dates = ['2019-04-18', '2019-04-19'];
				
				$('#from').datetimepicker({
						daysOfWeekDisabled: [0, 6],
						datesDisabled: exclude_dates,
						minDate: new Date(),
						startDate: new Date(),
						autoclose: true
					});
				
				$('#to').datetimepicker({ 
						language: 'es',											
						daysOfWeekDisabled: [0, 6],
						format:'DD/MM/YYYY HH:mm:ss', 
						defaultDate: new Date(),
						minDate: new Date()
					});				
				*/
				
                $("#add_evento").on('hidden.bs.modal', function () {                       
					$(this).find("input,textarea,select").val('').end();
					$("#title").val('');
					$("#body").val('');
                });
				
				//var dd = "";				
				//alert('obj...'+objFecha);
				
				var fechahoy = new Date();
				var dayw = new Date().getDay();
alert('fhoy...'+fechahoy+'\n dayw...'+dayw);				
				var dias = 0;
				
				var fh_yyyy = fechahoy.getFullYear().toString();
				var fh_mm = (fechahoy.getMonth()).toString().length == 1 ? "0"+(fechahoy.getMonth()).toString() : (fechahoy.getMonth()).toString();
				var fh_dd = (fechahoy.getDate()).toString().length == 1 ? "0"+(fechahoy.getDate()).toString() : (fechahoy.getDate()).toString();	
				var objFecha = new Date(fh_yyyy, fh_mm, fh_dd, 08, 00, 00);
				
				if (dayw == 6 || dayw == 0)
				{					
					if (dayw == 6)
					{
						dias = 2;
					}	
					if (dayw == 0)
					{
						dias = 1;
					}					
					fechahoy.setDate(fechahoy.getDate() + dias);					
					
					hh = new Date().getHours().toString().length == 1 ? "0"+new Date().getHours().toString(): new Date().getHours().toString();
					mm = new Date().getMinutes().toString().length == 1 ? "0"+new Date().getMinutes().toString(): new Date().getMinutes().toString();
					alert('hh...'+hh+'  mm...'+mm);
				}
				else
				{
					hh = new Date().getHours().toString().length == 1 ? "0"+new Date().getHours().toString(): new Date().getHours().toString();
					mm = new Date().getMinutes().toString().length == 1 ? "0"+new Date().getMinutes().toString(): new Date().getMinutes().toString();
					alert('else hh...'+hh+'  mm...'+mm);
					//fechahoy.setDate(fechahoy.getDate() -1);	
					
				}
				
				//fechahoy = new Date(fechahoy, fh_mm, fh_dd, 08, 00, 00);
				
				$('#add_evento').on('show.bs.modal', function (e) 
				{				
					dd = fechahoy;
					alert('fechoy...'+fechahoy);
					
					/*
					var d = new Date(fechahoy),	month = '' + (d.getMonth() + 1),
					day = '' + d.getDate(),	year = d.getFullYear();

					if (month.length < 2) 
					{	
						month = '0' + month;
					}
					if (day.length < 2) 
					{
						day = '0' + day;
					}
					fa = [day, month, year].join('/');
					*/
					//var dateString = moment(fechahoy).format('DD-MM-YYYY');

					//var dateStringWithTime = moment(fechahoy).format('DD/MM/YYYY HH:mm');
					var dateStringWithTime = moment(new Date()).format('DD/MM/YYYY HH:mm');
					$('#txtfrom').val(dateStringWithTime);
				});				
				
				
				var exclude_dates = ['2020-06-15', '2020-06-22'];				
				 	
				/*
				$('#from').datetimepicker({
					language: 'es',
					datesDisabled: exclude_dates,
					daysOfWeekDisabled: [0, 6],
					todayHighlight: true,
					autoclose: true,
					clearBtn:true,
					format: 'DD/MM/YYYY HH:mm',
					viewMode: 'days',
					minDate: fechahoy,
					defaultDate: objFecha,
				});
				*/
				
				$('.selectpicker').selectpicker();
				
		//var exclude_dates = ['2020-06-15', '2020-06-22'];
		//var exclude_dates = ['15/06/2020', '22/06/2020'];
		//var disabledWeekDays = [0,6];		
        $('#from').datetimepicker({
			language: 'es',
			pickerPosition: 'bottom-left',
			daysOfWeekDisabled: [6, 0],
			disabledDates: [
                        new Date(2020, 06 - 1, 15),
                        new Date(2020, 06 - 1, 22),
                        new Date(2020, 06 - 1, 29),
                    ],
			autoclose: true,
			defaultDate: fechahoy,
			minDate: fechahoy,
			format: 'DD/MM/YYYY HH:mm',
			viewMode: 'days',			
        });
				
				$('#to').datetimepicker({
					language: 'es',
					datesDisabled: exclude_dates,
					pickerPosition: "bottom-left",
					daysOfWeekDisabled: [0, 6],
					todayHighlight: true,
					autoclose: true,
					clearBtn:true,
					format: 'DD/MM/YYYY HH:mm',
					viewMode: 'days',
					minDate: fechahoy,
					defaultDate: objFecha,
				});
				
				
				
				/*
				$('#to').on('change', function(){
					//alert($('#txtfrom').val());
					var fh = new Date(fh_yyyy, fh_mm, fh_dd);
					//alert('fh...'+fh+'  fa...'+new Date());
					if( new Date() < fh )
					{
						//alert('fecha elegida es menor');
						$('#to').datetimepicker({
							defaultDate: fechahoy,
							minDate: fechahoy,
						});
						//$('#txtfrom').val(objFecha);
						return false;
					}
				});
				*/
				
				$("#grabar").on('click', function(e) 
				{					
					var fecini = $('#from').data('date');
					var fecfin = $('#to').data('date');
					var msj="";
					if(fecini >= fecfin )
					{
						swal("Atención:", "Revisar diferencia entre las fechas", "warning");						
						return false;
					}
					else
					{	
						var tu = $('#tipousuario').val();
						var asignar = $('#responsable').val();
						var proceso = $('#proceso').val();
						var tipo = $('#tipo').val();
						var tipoact = $('#tipoact').val();
						var title = $('#title').val();
						var evento = $('#evento').val();
						
						if(tu == "" || asignar == "" || proceso == "" || tipo == "" || tipoact == "" || title == "" || evento == "" )
						{
							swal("Atención:", "Debe ingresar información en todos los campos", "warning");						
							return false;
						}
						else
						{
						
							$.ajax({
								data: {"from": fecini, "to": fecfin, "tipousuario": tu, "responsable": asignar, "proceso": proceso, "tipo": tipo, "tipoact": tipoact, "title": title, "evento": evento, "origen": "a" },
								type: 'POST',
								dataType: "html",
								url: "grabaagenda.php",
								beforeSend: function() {					
									$("#precargamsj").show();
								},
								success: function(data) 
								{									
									var respstr = data.trim();                   
									if( respstr.substr(0,1) == "S" )									
									{									
										$("#add_evento").hide();
										swal("¡Excelente!", "Agenda grabada correctamente.", "success");
										location.reload();
									}	
									else if (respstr.substr(0,1) == "E")
									{
										$("#add_evento").hide();
										swal("¡Atención: ", "Ya Existe una Agenda con la misma información.", "warning");
										location.reload();
									}	
									else
									{
										swal("Atención:", "Error al intentar grabar registro de Agenda. ", "error");
										return false;
									}
								},
								error: function(xhr) { // if error occured
									alert("Error ha ocurrido.");
								},
								complete: function() {					
									$("#precargamsj").hide();
								},	
							});
						}
					}	
				});
				
				setInterval(() => {					
					$('#calendar').calendar(options); 
				}, 10000);           
				
            });	
        </script>

        <div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">                        
                        <h4 class="modal-title" id="myModalLabel">
                            <span class="glyphicon glyphicon-list-alt"></span> Agregar Evento
                        </h4>
                        <hr style="margin-top:7px; border: 0.5px solid red;">
                    </div>                
                
					<div class="modal-body" style="margin-top:-15px;">
						<form action="" method="post" id="">

							<div class="form-group">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label for="from">Fecha Inicial (dd/mm/aa)</label>
										<div class='input-group date' id='from'>
											<div class="form-line">
												<input type='text' id="txtfrom" name="txtfrom" class="form-control" readonly />			
											</div>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
										</div>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label for="to">Fecha Final (dd/mm/aa)</label>
										<div class='input-group date' id='to'>
											<div class="form-line">
												<input type='text' name="txtto" id="txtto" class="form-control" readonly />
											</div>	
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
												
										</div>
									</div>    

								</div>
							</div>						
							
							<!-- 
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div id="datetimepicker1" class="input-append date">
											<input id="xinput" width="312" />
											<script>
												$('#xinput').datetimepicker({ locale: 'es-es', footer: true, modal: true, format: 'dd/mm/yyyy HH:MM' });
											</script>
										</div>
									</div>	
								</div>
							</div>		
							-->		

							<div class="form-group" style="margin-top:-15px;">
								<div class="row">
									<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">                                            
										<label for="tipo">
										<i class="fa fa-tasks" style="color: orange;"></i>
										Tipo Usuario
										</label>                                                
										<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tipousuario" id="tipousuario" required style=" -webkit-padding-start: 20px !important;">    
											<option value="">Seleccione ...</option>
											<?php 
											$idTabla = 1;                                                
											require_once('../apis/general/tipousuarioEvento.php');												
											for($i=0; $i<count($mtipousuario['usu_tipousuario']); $i++)
											{
												$TUS_IdTipoUsuario = $mtipousuario['usu_tipousuario'][$i]['TUS_ID_TipoUsuario'];                                                    
												$TUS_Nombre = $mtipousuario['usu_tipousuario'][$i]['TUS_Nombre'];
												$TUS_Estado = $mtipousuario['usu_tipousuario'][$i]['TUS_Estado'];
											?>
												<option value="<?php echo $TUS_IdTipoUsuario; ?>"><?php echo $TUS_Nombre; ?></option>                                                    
											<?php
											}
											?>
										</select>
									</div>
								
									<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">                                            
										<label for="tipo">				
										<i class="fa fa-users" style="color: orange;"></i>
										Asignar a
										</label>                                                
										<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="responsable" id="responsable" required>    
											<option value="">Seleccione a quien se Asigna la Agenda</option>                                               
										</select>
									</div>
								</div>	
							</div>							

							<div class="form-group">
								<div class="row">                
									<div class="col-md-6">                                            
										<label for="tipo">
										<i class="fa fa-suitcase" style="color: orange;"></i>
										N&uacute;mero de Proceso
										</label>                                                
										<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="proceso" id="proceso" required>    
											<option value="">Seleccione Proceso</option>                                                    
										</select>                                            
									</div>
							
									<div class="col-md-6">                                           
										<label for="tipo">
										<i class="fa fa-stumbleupon" style="color: orange;"></i>
										Tipo de Actividad
										</label>                                                
										<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tipoact" id="tipoact" required>
											<option value="">Seleccione ...</option>
											<option value="1">Informaci&oacute;n Proceso</option>
											<option value="2">Cita en Juzgado</option>
											<option value="3">Cita con Cliente</option>
											<option value="4">Visita a Juzgado</option>
											<option value="5">Documentos Adjuntos</option>
										</select>                                            
									</div>
								</div>	
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<label for="tipo">
										<i class="fa fa-tags" style="color: orange;"></i>
										Tipo de evento
										</label>
										<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tipo" id="tipo" required>
											<option value="">Seleccione Tipo de Evento</option>
											<option value="event-info">Informacion</option>
											<option value="event-success">Exito</option>
											<option value="event-important">Importantante</option>
											<option value="event-warning">Advertencia</option>
											<option value="event-special">Especial</option>
										</select>
									</div>
								</div>	
							</div>			

							<div class="form-group">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<label for="title">
										<i class="fa fa-tasks" style="color: orange;"></i>
										Título o Asunto</label>
										<div class="form-line">
											<input type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título">
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<label for="evento">
										<i class="fa fa-th-list" style="color: orange;"></i>
										Descripci&oacute;n del Evento</label>
										<div class="form-line">
											<textarea id="evento" name="evento" required class="form-control" rows="3" placeholder="Digite descripción del evento"></textarea>
										</div>
									</div>
								</div>
							</div>
							
							<div class="modal-footer">
								<span style="font-size:11px; color: red; text-align_left; float:left">Todos los campos son obligatorios.</span>
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Salir</button>
								<button id="grabar" type="button" class="btn btn-success"><i class="fa fa-check"></i> Grabar</button>								
							</div>  
						</form>
					</div>
                </div>            
            </div>
        </div>
    </div>
    <!-- Fin CAlendario -->

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->    
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>	<!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <!-- Demo Js -->
    <script src="../js/demo.js"></script>

   <!-- Sweet Alert Plugin Js 	-->
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>
	
</body>
</html>
