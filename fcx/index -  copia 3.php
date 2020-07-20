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

        // Recibimos el fecha de inicio y la fecha final desde el form
        $Datein = date('d/m/Y H:i:s', strtotime($_POST['from']));
        $Datefi = date('d/m/Y H:i:s', strtotime($_POST['to']));
        $inicio = _formatear($Datein);
        // y la formateamos con la funcion _formatear
        $final  = _formatear($Datefi);
        // Recibimos el fecha de inicio y la fecha final desde el form


        ////$orderDate = date('d/m/Y H:i:s', strtotime($_POST['from']));
        $orderDate = date('Y/m/d H:i:s', strtotime($_POST['from']));
        $inicio_normal = $orderDate;

        // y la formateamos con la funcion _formatear
        ////$orderDate2 = date('d/m/Y H:i:s', strtotime($_POST['to']));
        $orderDate2 = date('Y/m/d H:i:s', strtotime($_POST['to']));
        $final_normal  = $orderDate2;

        // Recibimos los demas datos desde el form
        $titulo = evaluar(strtoupper($_POST['title']));

        // y con la funcion evaluar
        $body   = evaluar($_POST['event']);

        // reemplazamos los caracteres no permitidos
        $clase  = evaluar($_POST['class']);
		
		$tipousuario = evaluar($_POST['tipousuario']);
		
		$responsable = evaluar($_POST['responsable']);
		
		$proceso = evaluar($_POST['proceso']);
		
		$tipo = evaluar($_POST['tipo']);

        // insertamos el evento
        $query="INSERT INTO agenda VALUES(null,'$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal',$tipousuario, $responsable, $proceso, '$tipo' )";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query) or die('<script type="text/javascript">
			//alert("Horario No Disponible ")
			swal({
				title: "Atención:  Horario No Disponible.",
				text: "un momento por favor.",
				imageUrl: "../js/sweet/2.gif",
				timer: 1500,
				showConfirmButton: false
			});
			return false;
			</script>');

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

        // redireccionamos a nuestro calendario
        //header("Location:$base_url"); 
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
//echo $monthNameSpanish;
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



    <!-- Bootstrap Core CSS index
    <link href="../plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Preloader Css -->
    <link href="../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />	
	<link href="../css/sweet/sweetalert.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />	
	
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />


     <!-- jQuery Version 1.11.1
    <script src="../plugins/jquery/jquery.js"></script>  -->

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/calendar.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/es-ES.js"></script>
    <!-- --><script src="js/jquery.min.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    

    
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
    <div class="container">
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
            <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->
            
        </div>

        <!--ventana modal para el calendario-->
        <div class="modal fade" id="events-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                       <div class="modal-header">
                        <a href="#" data-dismiss="modal" style="float: right;"> <i class="glyphicon glyphicon-remove "></i> </a>
                        <br>
                    </div>
                    <div class="modal-body" style="height: 400px">
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
            var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

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

                //$("#tipousuario").on('change', function(){
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
                                    //options[options.length] = new Option(text.NP, text.PRO_IdProceso);
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

                /*
                $("#add_evento").click( function()
                {
                    //$("#tipousuario").empty();
                    //$("#responsable").empty();
                    //$("#title").val('');
                    //$("#body").val('');
                });

                $('#add_evento').on('show.bs.modal', function (event) {
                    $("#add_evento input").val("");
                    $("#add_evento textarea").val("");
                    $("#add_evento select").val("");
                    //$("#exampleModal input[type='checkbox']").prop('checked', false).change();
                });
               

                $('#add_evento').on('hidden.bs.modal', function (e) {
                    $("#tipousuario").empty();
                    $("#responsable").empty();
                    $("#title").val('');
                    $("#body").val('');
                })
                 */

                $("#add_evento").on('hidden.bs.modal', function () {
                        alert("Esta accion se ejecuta al cerrar el modal");
                        //$("#tipousuario").val('');
                        $(this)
                            .find("input,textarea,select")
                            .val('')
                            .end();                            
                        $("#title").val('');
                        $("#body").val('');
                });
                
                
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
                <!-- </div> -->
                
                <div class="modal-body" style="margin-top:-15px;">
                    <form action="" method="post">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="from">Fecha Inicio</label>
                                    <div class='input-group date' id='from'>
                                        <input type='text' id="from" name="from" class="form-control" readonly />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                                    <!-- <br> -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="to">Fecha Final</label>
                                    <div class='input-group date' id='to'>
                                        <input type='text' name="to" id="to" class="form-control" readonly />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>    

                            </div>
                        </div>

                        <div class="form-group" style="margin-top:-15px;">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">                                            
                                    <label for="tipo">Tipo Usuario</label>                                                
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
                                    <label for="tipo">Asignar a</label>                                                
                                    <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="responsable" id="responsable" required>    
                                        <option value="">Seleccione a quien se Asigna la Agenda</option>                                               
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



                        <!-- <br> -->
                        <label for="tipo">Tipo de evento</label>
                        <select class="form-control" name="class" id="tipo">
                            <option value="event-info">Informacion</option>
                            <option value="event-success">Exito</option>
                            <option value="event-important">Importantante</option>
                            <option value="event-warning">Advertencia</option>
                            <option value="event-special">Especial</option>
                        </select>

                        <br>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="title">Título o Asunto</label>
                                    <div class="form-line">
                                        <input type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <br> -->

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="body">Descripci&oacute;n del Evento</label>
                                    <div class="form-line">
                                        <textarea id="body" name="event" required class="form-control" rows="3" placeholder="Digite descripción del evento"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(function () {
                                $('#from').datetimepicker({
                                    language: 'es',
                                    minDate: new Date()
                                });
                                $('#to').datetimepicker({
                                    language: 'es',
                                    minDate: new Date()
                                });

                            });
                        </script>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
                        </div>  
                    </form>
                </div>
                </div>            
            </div>
        </div>
    </div>
    <!-- Fin CAlendario --> 


    <!-- jQuery Version 1.11.1
    <script src="../plugins/jquery/jquery.js"></script>  -->
    <!-- Bootstrap Core JavaScript 
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->    
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>	<!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <!-- Demo Js -->
    <script src="../js/demo.js"></script>


	<!-- Sweet Alert Plugin Js -->   
    <script src="../js/sweet/functions.js"></script>
    <script src="../js/sweet/sweetalert.min.js"></script>
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>    
	
</body>
</html>