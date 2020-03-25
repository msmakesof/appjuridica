<?php
ob_start();
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if( !isset($_SESSION['IdUsuario']) && !isset($_SESSION['NombreUsuario']) )
{
	header("Location: ../");
    exit;
}
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL,"es_ES");

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

require_once('bdd.php');
$sql = "SELECT id, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Inicio</title>	
    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        
    }
	#calendar {
		max-width: 800px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}

	#floating-button{
		width: 55px;
		height: 55px;
		border-radius: 50%;
		background: #db4437;
		position: fixed;
		bottom: 30px;
		right: 30px;
		cursor: pointer;
		box-shadow: 0px 2px 5px #666;
	}

	.plus{
		color: white;
		position: absolute;
		top: 0;
		display: block;
		bottom: 0;
		left: 0;
		right: 0;
		text-align: center;
		padding: 0;
		margin: 0;
		line-height: 55px;
		font-size: 38px;
		font-family: 'Roboto';
		font-weight: 300;
		animation: plus-out 0.3s;
		transition: all 0.3s;
	}

	#container-floating{
		position: fixed;
		width: 70px;
		height: 70px;
		bottom: 30px;
		right: 30px;
		z-index: 50px;
	}

	#container-floating:hover{
		height: 400px;
		width: 90px;
		padding: 30px;
	}

	#container-floating:hover .plus{
		animation: plus-in 0.15s linear;
		animation-fill-mode: forwards;
	}
	
    </style>
</head>

<body class="theme-indigo">
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
            <!--  Notificaciones -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- < Call Search > -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!--
					< #END# Call Search >
                    < Notifications >
					 -->
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
                    <!-- 
					< #END# Notifications >
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
                    <!-- < #END# Tasks > -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
            <!-- Fin Notificaciones -->

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

	
    <!-- Page Content <br><br><br><br><br>-->	
    <div class="container" >
		<div class="text-right">
			<div id="container-floating">
				<div id="floating-button" data-toggle="tooltip" data-placement="left" data-original-title="Create" onclick="adiEvento()">
					<p class="plus">+</p>    
				</div>
			</div>
		</div>
		

		<div class="row">
            <div class="col-lg-12 text-center">                
                <div id="calendar" class="col-centered"></div>
            </div>			
        </div>
        <!-- /.row -->		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form id="elForm" class="form-horizontal" method="POST" action="addEvent.php">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Evento a Agendar</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-4 control-label">Titulo</label>
					<div class="col-sm-8">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-4 control-label">Color</label>
					<div class="col-sm-8">
						<select name="color" class="form-control" id="color">
							<option value="">Seleccionar</option>
							<option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
							<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
							<option style="color:#008000;" value="#008000">&#9724; Verde</option>						  
							<option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
							<option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
							<option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
							<option style="color:#000;" value="#000">&#9724; Negro</option>
						  
						</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="start" class="col-sm-4 control-label">Fecha Inicial</label>
					<div class="col-sm-8">
						<!-- <label for="date">Date Input:</label>  -->
						<input type="date" name="date" id="date" value="" onChange="sinDomingos();" onblur="obtenerfechafinf1();" />
						<!-- <input type="text" name="start" class="form-control" id="start" readonly> -->
						<!-- 
						<div class='input-group date form-line' id="from" readonly required>
							<input type='text' id="startx" name="startx" class="form-control" readonly/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
						-->
					</div>
				  </div>
				  <div class="form-group">
					<label for="end" class="col-sm-4 control-label">Fecha Final</label>
					<div class="col-sm-8">
					  <input type="text" name="end" class="form-control" id="end" readonly>
					</div>
				  </div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
				<input id="elSubmit" type="submit" style="display:none;" />
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="editEventTitle.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modificar Evento</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Titulo</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Color</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
						  <option value="">Seleccionar</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
						  <option style="color:#008000;" value="#008000">&#9724; Verde</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
						  <option style="color:#000;" value="#000">&#9724; Negro</option>
						  
						</select>
					</div>
				  </div>
				    <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete"> Eliminar Evento</label>
						  </div>
						</div>
					</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="ModalMsj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h2 class="modal-title" id="myModalLabel">
					<div class="alert alert-danger">
						<i class="fas fa-exclamation-circle"></i>Atención
					</div>					  
				</h2>
			  </div>
			  <div class="modal-body">				
					<div class="form-group">					
						<div class="col-sm-12">
							<hr class="col-sm-12">
								<label for="title" class="col-sm-11 control-label">
									No se puede Agendar para Fecha pasada o Fines de Semana.
								</label>
							<hr class="col-sm-12">
						</div>					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>				
					</div>				  
			  </div>
			  <div class="modal-footer">				
			  </div>
			  
			</form>
			</div>
		  </div>
		</div>

    </div>
	
			
    <!-- /.container -->
	<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

	<!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">	
	
	<!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
	
	<!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
	<link href="../css/materialize.css" rel="stylesheet">
	<link href="../css/floating-labels.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
	
	
    <script type="text/javascript" src="../fc/js/es-ES.js"></script>
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />
	
	<!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
	
	<!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>
	
	<!-- Custom Js -->
    <script src="../js/admin.js"></script>
	
	<!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
	
	<!-- Demo Js  -->
    <script src="../js/demo.js"></script>	
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.js'></script>
	<script src='js/fullcalendar/locale/es.js'></script>
	
    <!--      
	<link rel="stylesheet" href="fc/css/calendar.css">
	<link rel="stylesheet" href="fc/css/bootstrap-datetimepicker.min.css" />
	<script src="fc/js/underscore-min.js"></script>
    <script src="fc/js/calendar.js"></script>	
	<script src="fc/js/bootstrap.min.js"></script>
	<script src="fc/js/bootstrap-datetimepicker.js"></script>
	<script src="fc/js/bootstrap-datetimepicker.es.js"></script>
	<script src='fc/js/moment.js'></script>
	-->
	 
	<link rel="stylesheet" href="css/jquery.ui.datepicker.mobile.css" /> 
	<script src="js/jQuery.ui.datepicker.js"></script>
	<script src="js/jquery.ui.datepicker.mobile.js"></script>
	 	
		
	<script>	
	$(document).ready(function() {

		var date = new Date();
		var yyyy = date.getFullYear().toString();
		var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
		var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
	
		$('#calendar').fullCalendar({
		//weekend: false,	
		//hiddenDays: [ 0, 6 ],
		header: {
                    language: 'es',
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay',
				},
                    defaultDate: yyyy+"-"+mm+"-"+dd,
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,					
                    select: function(start, end) {
						$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));						
						var x = $('#ModalAdd #end').val();
						var diasemana = (new Date(x).getDay());
						if (Date.parse(end._d) > Date.now() && diasemana >= 0 )
						{
							$('#ModalAdd').modal('show');
						}
						else
						{
							//alert('No se puede agendar para esta fecha');
							$('#ModalMsj').modal('show');
						}
						
                    },
                    eventRender: function(event, element) {
						element.bind('dblclick', function() {
							$('#ModalEdit #id').val(event.id);
							$('#ModalEdit #title').val(event.title);
							$('#ModalEdit #color').val(event.color);
							$('#ModalEdit').modal('show');
						});
                    },
                    eventDrop: function(event, delta, revertFunc) { // si changement de position
                        edit(event);
                    },
                    eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
						edit(event);
                    },
                    events: [
                    <?php foreach($events as $event): 

                        $start = explode(" ", $event['start']);
                        $end = explode(" ", $event['end']);
                        if($start[1] == '00:00:00'){
                            $start = $start[0];
                        }else{
                            $start = $event['start'];
                        }
                        if($end[1] == '00:00:00'){
                            $end = $end[0];
                        }else{
                            $end = $event['end'];
                        }
                    ?>
                        {
                            id: '<?php echo $event['id']; ?>',
                            title: '<?php echo $event['title']; ?>',
                            start: '<?php echo $start; ?>',
                            end: '<?php echo $end; ?>',
                            color: '<?php echo $event['color']; ?>',
                        },
                    <?php endforeach; ?>
                    ]
		});	
		
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}

			id =  event.id;

			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;

			$.ajax({
				url: 'editEventDate.php',
				type: "POST",
				data: {Event:Event},
				success: function(rep) {
					if(rep == 'OK'){
						alert('Evento se ha guardado correctamente');
					}else{
						alert('No se pudo guardar. Inténtalo de nuevo.'); 
					}
				}
			});
		}
	});
	function adiEvento(){
		$('#ModalAdd').modal('show');
		/*
		$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
		$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
		//&& diasemana >= 0
		var x = $('#ModalAdd #end').val();
		var diasemana = (new Date(x).getDay());
		if (Date.parse(end._d) > Date.now()  )
		{
			
		}
		else
		{
			alert('No se puede agendar para esta fecha');
		}
		
		
		var myCalendar = $('#calendar'); 
		myCalendar.fullCalendar();
		var myEvent = {
		  title:"my new event",
		  allDay: true,
		  start: new Date(),
		  end: new Date()
		};
		myCalendar.fullCalendar( 'renderEvent', myEvent );
*/
	};
	
</script>
<script type="text/javascript">
var $=jQuery.noConflict();
	$(document).ready(function() {
		
		/*
		var ddx = "<?php echo $fecha_actual; ?>";
		var exclude_dates = ['2019-04-18', '2019-04-19'];
		$('#startx').datetimepicker({
			language: 'es',											
			daysOfWeekDisabled: [0, 6],
			datesDisabled: exclude_dates,
			autoclose: true,
			defaultDate: "<?php echo $fecha_actualdef; ?>", //dd,											
			format:'DD/MM/YYYY HH:mm:ss',
			minDate: ddx,
			viewMode: 'days'
		});
		*/
		
		$( document ).bind( "mobileinit", function(){
			$.mobile.page.prototype.options.degradeInputs.date = true;
		});
		
		$("#date").datepicker({
			//"dateFormat" : "dd-mm-yy" //any valid format that you want to have
			/* 
			var ddx = "<?php echo $fecha_actual; ?>";
			var exclude_dates = ['2019-04-18', '2019-04-19'];
			//$('#startx').datetimepicker({
			language: 'es',											
			daysOfWeekDisabled: [0, 6],
			datesDisabled: exclude_dates,
			autoclose: true,
			defaultDate: "<?php echo $fecha_actualdef; ?>", //dd,											
			format:'DD/MM/YYYY HH:mm:ss',
			minDate: ddx,
			viewMode: 'days'
			*/			
		});
	})
	
	var elDate = document.getElementById('date');
	var elForm = document.getElementById('elForm');
	var elSubmit = document.getElementById('elSubmit');

	function sinDomingos(){
		var day = new Date(elDate.value ).getUTCDay();
		console.log(Date(elDate.value ));
		// Días 0-6, 0 es Domingo 6 es Sábado
		elDate.setCustomValidity(''); // limpiarlo para evitar pisar el fecha inválida
		if( day == 0 || day == 6 )
		{
		   elDate.setCustomValidity('Sábados y Domingos no disponibles, por favor seleccione otro día');
		} 
		else 
		{
		   elDate.setCustomValidity('');
		}
		if(!elForm.checkValidity()) 
		{
			elSubmit.click()
		};
	}

	function obtenerfechafinf1(){
		sinDomingos();
	}
</script>
</body>

</html>
<?php ob_end_flush();?>