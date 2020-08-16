<?php
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php');
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
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
require_once('../../apis/general/ciudadesxdepto.php');
$idTabla = ""; 
if ( isset( $_POST["id"]))
{ 
    $idTabla = $_POST["id"];
}

$Tabla ="ACTUACIONPROCESAL";
$strowreg =0;
$idtabla = 0;
$row_rs_tabla = 0;
$Nombreciudad = "";
$yy = date("Y");

$e="";
$iu = $_SESSION['TipoUsuario'];
$em = $_SESSION['IdEmpresa'];
require_once('../../apis/proceso/proceso.php');

$idtabla = $mproceso['pro_proceso']['PRO_IdProceso'];
$IdDemandante = $mproceso['pro_proceso']['PRO_IdDemandante'];
$IdDemandado = trim($mproceso['pro_proceso']['PRO_IdDemandado']);
$NumeroProceso = trim($mproceso['pro_proceso']['PRO_NumeroProceso']);
$paramNroProceso = $NumeroProceso; 
if(strlen($NumeroProceso) < 23 )
{
	$paramNroProceso = $idtabla;
}
$nroproceso = substr($NumeroProceso,16,5);
$FechaInicio = trim($mproceso['pro_proceso']['PRO_FechaInicio']);
$FechaInicio = date('Y-m-d', strtotime($FechaInicio));
$IdUsuario = trim($mproceso['pro_proceso']['PRO_IdUsuario']);
$IdUbicacion = trim($mproceso['pro_proceso']['PRO_IdUbicacion']);
$IdClaseProceso = trim($mproceso['pro_proceso']['PRO_IdClaseProceso']);
$IdJuzgadoOrigen = trim($mproceso['pro_proceso']['PRO_IdJuzgadoOrigen']);
$EstadoProceso = trim($mproceso['pro_proceso']['PRO_EstadoProceso']);
$IdArea = $mproceso['pro_proceso']['PRO_IdArea']; // Areaa o Especialidad
$IdJuzgado = trim($mproceso['pro_proceso']['PRO_IdJuzgado']);

$FechaCierre = trim($mproceso['pro_proceso']['PRO_FechaCierre']);
$ObservacionCierre = trim($mproceso['pro_proceso']['PRO_ObservacionCierre']);
$IdUsuarioCierre = trim($mproceso['pro_proceso']['PRO_IdUsuarioCierre']);
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

    <!-- DateTime Picker 
    <link href="../../calendar/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	-->

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
    <style>
        .caja
        {
            margin-top:-10px;
        }
        .cajax
        {
            margin-top:10px;
        }

        .rowx
        {
            margin-bottom:-24px !important;
        }

        #actpro option[value=""] { color: red; }
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
            <p>Por Favor espere...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
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
                <a class="navbar-brand" href="../../index.html">
                <img src="../../images/logomw.fw.png" style="margin-top: -10px;">
                </a>
            </div>

            <!-- Notificaciones -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- <  Call Search > -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
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
            <?php require_once('../tables/menu.php'); ?> 
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
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content" >
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORMULARIO: Crear <?php echo $Tabla;?>. <span class="badge badge-pill badge-info"><?php //echo $txtEstado; ?></span>
                    <!--<small>Editar.</small>-->
                </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body  table-responsive">
                            <form id="form_validation" method="POST">
                                    <div class="form-group">
										<div class="col-lg-12 col-md-12 col-sm-12">
											
											<div class="col-lg-2 col-md-2 col-sm-2">
												<div class="row"><span style="color:red;">*</span>
													<label class="form-label">Fecha</label>												
													<div class='input-group date form-line' name="fechainicio" id="fechainicio" required>
														<input type='text' id="txtFechaInicio" name="txtFechaInicio" class="form-control" readonly/>
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div>																																	
												</div>
                                            </div>

                                            <div class="col-lg-1 col-md-1 col-sm-1">
												<div class="row">&nbsp;
												</div>
                                            </div>
                                            
                                            <div class="col-lg-3 col-md-3 col-sm-3">
												<div class="row"><span style="color:red;">*</span>
													<label class="form-label" style="font-size: 12;">Origen / Autor:</label>
													<div class="xform-line">													    
														
														<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="origen" id="origen" required>
														<option value="" >SeleccioneOrigen / Autor:...</option>
														<?php                                                             
															$idTabla = 0;
															require_once('../../apis/proceso/origenactprocesal.php');
															for($i=0; $i<count($morigenactprocesal['pro_origenactprocesal']); $i++)
															{
                                                                $IdOrigen = $morigenactprocesal['pro_origenactprocesal'][$i]['OAP_IdOrigen'];
                                                                $Nombre = $morigenactprocesal['pro_origenactprocesal'][$i]['OAP_Nombre'];
                                                                $Estado = $morigenactprocesal['pro_origenactprocesal'][$i]['OAP_Estado'];															
														?>
																 <option value="<?php echo $IdOrigen; ?>" >
                                                                    <?php echo $Nombre ; ?>                                                
																</option>
														<?php
															}
														?>
														</select>
													</div>												
												</div>
                                            </div>

											<div class="col-lg-1 col-md-1 col-sm-1">
												<div class="row">&nbsp;
												</div>
											</div>	
									
											<div class="col-lg-5 col-md-5 col-sm-5">
												<div class="row"><span style="color:red;">*</span>
													<label class="form-label" style="font-size: 12;">Actuación Procesal:</label>
													<div class="xform-line">													    
														
														<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="actpro" id="actpro" required>
														    <option value="" >Seleccione Actuación Procesal...</option>
														</select>
													</div>												
												</div>
                                            </div>
                                            
										</div>
                                    </div>   

									<div class="form-group">
										<div class="col-lg-12 col-md-12 col-sm-12">									
											<div class="col-lg-2 col-md-2 col-sm-2">
												<div class="row"><span style="color:red;">*</span>
													<label class="form-label">Fecha Estado:</label>												
													<div class='input-group date form-line' name="fechaestado" id="fechaestado" required>
														<input type='text' id="txtFechaEstado" class="form-control"/>
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div>												
												</div>
											</div>
												
											<div class="col-lg-1 col-md-1 col-sm-1">
												<div class="row">&nbsp;
												</div>
											</div>
																		   
											<div class="col-lg-9 col-md-9 col-sm-9">
												<div class="row"><span style="color:red;">*</span>
													<label class="form-label">Observaciones:</label>
													<div class="form-line">
														<input type="input" class="form-control" name="observacion" id="observacion" maxlength="90" autocomplete="off" required>
													</div>
													<div style="font-size:11px; text-align:right;width: 80%">
														Caracteres: <span id="muestrocantidadcaracteresid">0</span> de 90
													</div>														
												</div>
											</div>	
										</div>
									</div>                                
                                <!-- </div> -->
								
								<div class="form-group">
									<div class="col-lg-12 col-md-12 col-sm-12">									
										<div class="col-lg-3 col-md-3 col-sm-3">
											<div class="row">
												<label class="form-label">Gasto:</label>
												<div class="form-line">
													<input type="input" class="form-control" name="gasto" id="gasto" maxlength="14" required>
												</div>
											</div>											
										</div>
									</div>
								</div>											
								
                               <div class="form-group" style="clear: both; margin-top:-10px !important">
                                    <div class="col-lg-12 col-md-12 col-sm-12">                                
                                        <div class="row">
                                            <div class="col-sm-8">	
                                                <button class="btn btn-success waves-effect" type="button" id="grabar">GRABAR</button>
                                                <button onclick="salir(<?php echo $idtabla; ?>)" class="btn btn-danger waves-effect">SALIR</button>
                                                <div><span style="color:red;">* Campos Obligatorios.</span></div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
								<hr>
								
                            </form>                        
                            <div id="msj" style="margin-top:7px;"></div>
                            <form id="mensaje">
                                <label style="font-family: Verdana; font-size: 18; color:red;">Registro ha sido borrado correctamente.</label>
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

    <!--  --> <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- Sweet Alert Plugin Js -->
    <script src="../../js/sweet/functions.js"></script>
    <script src="../../js/sweet/sweetalert.min.js"></script>
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

	<script src="../../calendar/js/moment.min.js"></script>
	<link rel="stylesheet" href="../../fc/css/bootstrap-datetimepicker.min.css" />
	<script src="../../fc/js/bootstrap-datetimepicker.js"></script>    
	<script src="../../fc/js/bootstrap-datetimepicker.es.js"></script>
   
   	<!-- toggle botton --> 
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript">
	function init_contador(idtextarea, idcontador)
    {        
        var contador = $(idcontador);		
		var nro = $(idtextarea).val().length;		
		if(nro <= 90)
		{	
			contador.html( nro );
		}
    }
	
	function salir(id) 
	{    
		var proceso = "<?php echo $paramNroProceso; ?>";
		event.preventDefault();		
		$.post('editaractprocesal.php', { 'id': id, 'proceso': proceso }, function (result) {
			WinId = window.open('','_self');
			WinId.document.open();
			WinId.document.write(result);
			WinId.document.close();
		});
	}

	$(document).ready(function(){			
        $("#mensaje").hide();
        $("#form_validation").show();
        $('#proceso').numeric();
		$("#gasto").numeric();
		
        $('.selectpicker').selectpicker();
		var exclude_dates = ['2019-04-18', '2019-04-19'];
		var disabledWeekDays = [0,6];
        $('#fechainicio').datetimepicker({
			language: 'es',											
			daysOfWeekDisabled: [0, 6],
			datesDisabled: exclude_dates,			
			autoclose: true,
			defaultDate: new Date(),
			minDate: new Date(),
			format: 'YYYY-MM-DD',
			viewMode: 'days'		  
        });
		
		$('#fechaestado').datetimepicker({			
			language: 'es',
			daysOfWeekDisabled: [0, 6],			
			format: 'YYYY-MM-DD',
			autoclose: true			
        });

        $("#origen").on('change', function(){
            var __origen = $("#origen").val();
            
            $.getJSON('../tables/urlink.php', {funcion: "or", origen: __origen }, function (data) {
                var zdata= data.pro_actuacionprocesal;
                console.log(zdata);
                var selectedOption = '';
                var newOptions = zdata;

                var select = $('#actpro');
                if(select.prop) 
                {
                    var options = select.prop('options');
                }
                else 
                {
                    var options = select.attr('options');
                }
                $('option', select).remove();
                options[options.length] = new Option('-- Seleccione Actuación Procesal... --', '');
                if(newOptions != undefined)
                {
                    $.each(newOptions, function(val, text) {
                        options[options.length] = new Option(text.TAP_Nombre, text.TAP_IdTipoActuacionProcesal);
                    });
                }    
                select.val(selectedOption);
                $('#actpro').selectpicker('refresh');
            });

        })
		
		$('#observacion').keypress(function() {
			init_contador("#observacion","#muestrocantidadcaracteresid");
		});

        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'pro_proceso.php';
        });
		
		$("#grabar").on('click', function(e) {
			e.preventDefault();
            $("#mensaje").hide();
            var fechainicio = $("#txtFechaInicio").val();            
            var origen = $("#origen").val();
            var actpro = $("#actpro").val();
            var fechaestado = $("#txtFechaEstado").val();            
            var observacion = $("#observacion").val();
			var gasto = $("#gasto").val();
			var idproceso = "<?php echo $idtabla; ?>";		
			
            if( fechainicio == "" || origen == "" || actpro == "" || fechaestado == "" ||  observacion == "" )
            {               
                swal({
                  title: "Atención:  Ingrese información en los campos Obligatorios...",
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
    				data : {"idproceso": idproceso, "fechainicio": fechainicio, "actpro": actpro, "fechaestado": fechaestado, "observacion": observacion, "gasto": gasto},
    				type: "POST",				
    				url : "../forms/crea_<?php echo strtolower($Tabla); ?>.php",
                })  
    			.done(function( dataX, textStatus, jqXHR ){	    			    
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
            }    
        });
		
        
        $("#borrar").on('click', function() {
            var idtabla  = "<?php echo $idtabla; ?>";
            var proceso = $("#proceso").val();            
            var estado = 2;
            swal({
                title: "Desea Cerrar el Proceso "+ proceso +"?",
                text: "Digite breve descripción sobre el Motivo del cierre.",
                type: "input",
                confirmButtonColor: '#1138f1',
                cancelButtonColor: '#ff0000',                
                confirmButtonText: 'Cerrar..!',
                cancelButtonText:  'Cancelar!',               
                showCancelButton: true,
                closeOnConfirm: false,
                inputPlaceholder: "Digite breve descripción sobre motivo de cierre...",
                showLoaderOnConfirm: true
                }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("observación debe ser diligenciada.... :)");
                    return false;
                }
                setTimeout(function () { 
                    $.ajax( 
                        {  
                            data : {"idtabla": idtabla, "estado": estado, "observacion": inputValue},
                            type: "POST",
                            url: "../forms/cerrar_<?php echo strtolower($Tabla) ; ?>.php",                                
                            
                            success: function(data)
                            {
                                var xrespstr = data.trim();
                                var respstr = xrespstr.substr(0,1);
                                var msj = xrespstr.substr(2);
                                if( respstr == "S")
                                {
                                    swal({ title: "Proceso "+ proceso +" Cerrado correctamente!", text: msj, type: "success",}, 
                                    function () { location.reload(true); });
                                }
                            }                                
                            
                        }
                    );
                        
                }, 2000); 
                }

            );
 
        });

    });
    </script>    
</body>
</html>