<?php
/*
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
*/ 
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); //rrequire_once('../../Connections/cnn_kn.php');
$LogoInterno = LogoInterno; 
require_once('../../Connections/config2.php');
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

//echo $_REQUEST['hf'];
$idTabla = ""; 
if ( isset( $_POST["id"]))
{ 
    $idTabla = $_POST["id"];
}

//echo "post....".$idTabla;

$Tabla ="PROCESO";
$strowreg =0;
$idtabla = 0;
$row_rs_tabla = 0;
$Nombreciudad = "";
$yy = date("Y");

require_once('../../apis/proceso/proceso.php');
$txtEstado = "";
$idtabla = $mproceso['pro_proceso']['PRO_IdProceso'];
$IdDemandante = $mproceso['pro_proceso']['PRO_IdDemandante'];
$IdDemandado = trim($mproceso['pro_proceso']['PRO_IdDemandado']);
$EstadoProceso = trim($mproceso['pro_proceso']['PRO_EstadoProceso']);
$NumeroProceso = trim($mproceso['pro_proceso']['PRO_NumeroProceso']);
$nroproceso = substr($NumeroProceso,16,5);
if(strlen($nroproceso) < 5)
{
	$nroproceso = $idtabla;
	if($EstadoProceso <> 2)
	{
		$txtEstado = "Estado en Reparto.";
	}
}	
$FechaInicio = trim($mproceso['pro_proceso']['PRO_FechaInicio']);
$FechaInicio = date('Y-m-d', strtotime($FechaInicio));
$IdUsuario = trim($mproceso['pro_proceso']['PRO_IdUsuario']);
$IdUbicacion = trim($mproceso['pro_proceso']['PRO_IdUbicacion']);
$IdClaseProceso = trim($mproceso['pro_proceso']['PRO_IdClaseProceso']);
$IdJuzgadoOrigen = trim($mproceso['pro_proceso']['PRO_IdJuzgadoOrigen']);
$IdArea = $mproceso['pro_proceso']['PRO_IdArea']; // Area o Especialidad
$IdJuzgado = trim($mproceso['pro_proceso']['PRO_IdJuzgado']);
$FechaCierre = trim($mproceso['pro_proceso']['PRO_FechaCierre']);
$ObservacionCierre = trim($mproceso['pro_proceso']['PRO_ObservacionCierre']);
$IdUsuarioCierre = trim($mproceso['pro_proceso']['PRO_IdUsuarioCierre']);
$EnviaEmail = $mproceso['pro_proceso']['PRO_EnviaEmail'];
$Representante = $mproceso['pro_proceso']['PRO_RepresentanteDe'];
$FechaCreado = $mproceso['pro_proceso']['PRO_FechaCreado'];

//echo "IdJuzgado....$IdJuzgado";
//GLOBAL $deptoproceso ;GLOBAL $ciudadproceso ;
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
                <a class="navbar-brand">
                <img src="<?php echo $LogoInterno; ?>" style="margin-top: -6px;">
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
					<?php 
						$textoCreado ="";
						if($_SESSION['TipoUsuario'] == 4 )  // SA
						{	
							$textoCreado = "           Fecha Creación:  ".$FechaCreado;
						}
					?>
                    FORMULARIO: Edición <?php echo $Tabla;?>. <span class="badge badge-pill badge-info"><?php echo $txtEstado; ?></span><?php echo $textoCreado; ?>
                    <!--<small>Editar.</small>-->
                </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body  table-responsive">
                            <form id="form_validation" method="POST">

                                <!-- <div class="form-group" style="clear: both; margin-top:15px;"> -->
                                    
                                    <div class="form-group">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="row">
												<div class="xcol-xs-10"><span style="color:red;">*</span>                                              
													<label class="form-label" style="font-size: 12;">C&oacute;digo DANE Departamento / Municipio:</label>
													<div class="xform-line">
                                                        <?php                                                      
                                                            $deptoproceso = substr($NumeroProceso,0,2);
                                                            $ciudadproceso = substr($NumeroProceso,2,3);                                                        
                                                        ?>    
														<!-- <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="zip" id="zip" min="1" max="99999" maxlength="5" required> -->
                                                        <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="zip" id="zip" required disabled="true">
                                                        <option value="" >Seleccione Municipio...</option>
                                                        <?php                                                             
                                                            $idTabla = 0;   //sxdepto
                                                            
                                                            for($i=0; $i<count($mciudad['gen_ciudad']); $i++)
                                                            {
                                                                $CIU_IdCiudades = $mciudad['gen_ciudad'][$i]['CIU_IdCiudades'];
                                                                $CIU_Nombre = $mciudad['gen_ciudad'][$i]['CIU_Nombre'];
                                                                $CIU_Abreviatura = $mciudad['gen_ciudad'][$i]['CIU_Abreviatura'];                                                                
                                                                $CIU_IdDepartamento = $mciudad['gen_ciudad'][$i]['CIU_IdDepartamento'];
                                                                $DEP_CodigoDane = $mciudad['gen_ciudad'][$i]['DEP_CodigoDane'];                                                                
                                                        ?>
                                                                <option value="<?php echo $CIU_Abreviatura; ?>" <?php if ($DEP_CodigoDane == $deptoproceso && $CIU_Abreviatura == $ciudadproceso){ echo "selected";} else{ echo "";} ?>>
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
                                                    <?php $corpoproceso = substr($NumeroProceso,5,2); ?>
													<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tipojuzgado" id="tipojuzgado" required  disabled="true">                                                       
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
                                                            <option value="<?php echo $TJU_IdTipoJuzgado; ?>" <?php if (trim($TJU_Codigo) == trim($corpoproceso)){ echo "selected";} else{ echo "";} ?>>
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
                                <!-- </div> -->

                                <div class="form-group">                               
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="xcol-xs-6"><span style="color:red;">*</span>                                                 
                                                <label class="form-label">Especialidad o &Aacute;rea:</label>
												<select id="area" name="area" class="selectpicker show-tick" data-live-search="true" data-width="95%" required  disabled="true">
												<option value="">-- Seleccione Especializacion.... --</option>
												<?php 
													$idTabla = 0;
													require_once('../../apis/general/area.php');
													for($i=0; $i<count($marea['juz_area']); $i++)
													{
														$ARE_IdArea = $marea['juz_area'][$i]['ARE_IdArea'];                                                    
														$ARE_Nombre = trim($marea['juz_area'][$i]['ARE_Nombre']);
														$ARE_Codigo = trim($marea['juz_area'][$i]['ARE_Codigo']);
														$ARE_Estado = $marea['juz_area'][$i]['ARE_Estado'];
												?>                                               
														<option value="<?php echo $ARE_Codigo; ?>" <?php if (trim($ARE_Codigo) == trim($IdArea)){ echo "selected";} else{ echo "";} ?>>
                                                            <?php echo $ARE_Nombre ; ?>                                                
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
                                            <div class="xcol-xs-3">
                                                <label class="form-label">Despacho</label>
                                                <!-- <input type="text" class="form-control" name="despacho" id="despacho" value="" maxlength="3" autocomplete="ÑÖcompletes" required>
                                                <label class="form-label"></label> -->
                                                <select id="despacho" name="despacho" class="selectpicker show-tick" data-live-search="true" data-width="95%" required  disabled="true">
                                                    <option value="">-- Seleccione Despacho.... --</option>
													<?php 
													$idTabla = 0;
													require_once('../../apis/juzgado/juzgado.php');
													for($i=0; $i<count($mjuzgado['juz_juzgado']); $i++)
													{
														$JUZ_IdJuzgado = $mjuzgado['juz_juzgado'][$i]['JUZ_IdJuzgado'];                                                    
														$JUZ_Ubicacion = trim($mjuzgado['juz_juzgado'][$i]['JUZ_Ubicacion']);
														$JUZ_IdArea = trim($mjuzgado['juz_juzgado'][$i]['JUZ_IdArea']);
														$JUZ_Estado = $mjuzgado['juz_juzgado'][$i]['JUZ_Estado'];
												?>
													<option value="<?php echo $JUZ_IdJuzgado; ?>" <?php if (trim($JUZ_IdJuzgado) == trim($IdJuzgado)){ echo "selected";} else{ echo "";} ?>>
                                                        <?php echo $JUZ_Ubicacion ; ?>                                                
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
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="row">            
                                            <div class="ccol-xs-3">
                                                <label class="form-label">Año</label>                                        
                                                <div class="form-line" style="width: 22%">
                                                    <input type="text" class="form-control" name="anio" id="anio" value="<?php echo $yy; ?>" maxlength="4" autocomplete="ÑÖcompletes" required  disabled="true">
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
                                                    <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="nproceso" id="nproceso" value="<?php echo $nroproceso; ?>" min="1" max="99999" maxlength="5" autocomplete="off" required>
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
                                                    <input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="ndv"id="ndv" value="<?php echo substr($NumeroProceso,-2); ?>" min="0" max="99" maxlength="2" autocomplete="off" required  disabled="true">
                                                </div>												
											</div>											
										</div>	
									</div>	
								</div>

                                <div class="form-group">
									<div class="col-lg-6 col-md-6 col-sm-5">
                                        <div class="row">
											<div class="xcol-sm-6"><span style="color:red;">*</span> 
												<label class="form-label">C&oacute;digo &Uacute;nico del Proceso:</label>
												<div class="form-line" style="width: 80%">
													<input type="number" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" class="form-control" name="proceso" id="proceso" value="<?php echo $NumeroProceso; ?>" maxlength="23" required />                                                    
												</div>
                                                <div style="font-size:11px; text-align:right;width: 80%">
                                                        Caracteres: <span id="muestrocantidadcaracteresid"></span> de 23
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
                                                    <input type='text' id="txtFecha" class="form-control" value="<?php echo $FechaInicio ;?>" readonly/>
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
												<select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="usuario" id="usuario" required>
												<option value="" >Seleccione Apoderado(a)...</option>
												<?php
                                                    $idTabla = 1;
                                                    require_once('../../apis/usuario/infoUsuarioAbogado.php');
													for($i=0; $i<count($muser['usu_usuario']); $i++)
													{
														$USU_IdUsuario = $muser['usu_usuario'][$i]['USU_IdUsuario'];                                                
														$USU_Nombre = $muser['usu_usuario'][$i]['NombreUsuario'];                                                
												?>
														<option value="<?php echo $USU_IdUsuario; ?>" <?php if ($USU_IdUsuario == $IdUsuario){ echo "selected";} else{ echo "";} ?>>
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
                                        <div class="row"><span style="color:red;">*</span> 
                                            <div class="xcol-sm-8" style="margin-left:15px;">
												<label class="form-label">Representante de: </label>
                                                <div class="form-group">                                                    
													<input type="radio" name="representa" id="acusador" class="with-gap" value="1" <?php if( $Representante == 0){?>checked="checked"<?php } ?>>
													<label for="acusador">Demandante</label>

													<input type="radio" name="representa" id="acusado" class="with-gap" value="2"  <?php if( $Representante == 1){?>checked="checked"<?php } ?>>
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
                                                        <option value="<?php echo $UBI_IdUbicacion; ?>" <?php if ($UBI_IdUbicacion == $IdUbicacion){ echo "selected";} else{ echo "";} ?>>
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
                                                            <option value="<?php echo $CPR_IdClaseProceso; ?>" <?php if ($CPR_IdClaseProceso == $IdClaseProceso){ echo "selected";} else{ echo "";} ?>>
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
												<select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="demandante" id="demandante" required>
												<option value="" >Seleccione Cliente...</option>
												<?php
                                                    $idTabla = 0;
                                                    require_once('../../apis/cliente/infoCliente.php');
													for($i=0; $i<count($mcliente['cli_cliente']); $i++)
													{
														$CLI_IdCliente = $mcliente['cli_cliente'][$i]['CLI_IdCliente'];                                                
														$CLI_Nombre = $mcliente['cli_cliente'][$i]['NombreUsuario'];                                                
												?>
														<option value="<?php echo $CLI_IdCliente; ?>" <?php if ($CLI_IdCliente == $IdDemandante){ echo "selected";} else{ echo "";} ?>>
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
                                    <div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">											
											<div class="xcol-sm-8"><span style="color:red;">*</span> 
                                                <label class="form-label">Demandado:</label>
												<select class="selectpicker show-tick" data-live-search="true" data-width="94%" name="demandado" id="demandado" required>
												<option value="" >Seleccione Demandado...</option>
												<?php
                                                    $idTabla = 0;
                                                    require_once('../../apis/cliente/infoCliente.php');
													for($i=0; $i<count($mcliente['cli_cliente']); $i++)
													{
														$CLI_IdCliente = $mcliente['cli_cliente'][$i]['CLI_IdCliente'];                                                
														$CLI_Nombre = $mcliente['cli_cliente'][$i]['NombreUsuario'];                                                
												?>
														<option value="<?php echo $CLI_IdCliente; ?>" <?php if ($CLI_IdCliente == $IdDemandado){ echo "selected";} else{ echo "";} ?>>
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
                                    <div class="col-lg-4 col-md-4 col-sm-4">                                
                                        <div class="row">
                                            <div class="xcol-sm-8">
                                                <div class="form-group form-float" style="clear: both;">
                                                    <label class="form-label">Estado: </label>
                                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $EstadoProceso == 1){?>checked="checked"<?php } ?>>
                                                    <label for="activo">Reparto</label>

                                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2"<?php if( $EstadoProceso == 2){?>checked="checked"<?php } ?>>
                                                    <label for="inactivo" class="m-l-20">Cerrado</label>
													
													<label class="form-label">Autoriza enviar email al cliente?
														<input type="checkbox" name="enviaemail" id="enviaemail" data-toggle="toggle" data-size="mini" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" <?php if($EnviaEmail == 1){ ?> checked="checked" <?php } ?>>
													</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>

                                <?php if( $EstadoProceso == 2){ ?> 
                                <div class="form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4">                                
                                        <div class="row">
                                            <div class="xcol-sm-8">
                                                <div class="form-group form-float" style="clear: both;">
                                                    <label class="form-label">Fecha Cierre:</label>
                                                    <div class="form-line" style="width: 45%">                                                   
                                                        <input type='text' id="txtFechaCierre" class="form-control" value="<?php echo $FechaCierre ;?>" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4">                                
                                        <div class="row">
                                            <div class="xcol-sm-8">
                                                <div class="form-group form-float" style="clear: both;">
                                                    <label class="form-label">Motivo Cierre:</label>
                                                    <div class="form-line" style="width: 90%">                                                   
                                                        <input type='text' id="txtObservacion" class="form-control" value="<?php echo $ObservacionCierre ;?>" readonly/>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <?php } ?>
								
                                <hr>
                                <!-- <div class="form-group" style="clear: both; margin-top:10px; margin-bottom:10px;"> -->
								<div class="form-group">
                                    <div class="col-xs-9">                                
                                        <div class="row">
                                            <div class="col-sm-8">	
                                                <button class="btn btn-success waves-effect" type="button" id="grabar">GRABAR</button>
                                                <button class="btn btn-primary waves-effect" type="button" id="actoprocesal">ACTUACION PROCESAL</button>
                                                <!--  <button type="button" class="btn btn-danger waves-effect" id="borrar" onclick="borrarc(<?php echo $idtabla ; ?>);">BORRAR</button> -->
                                                <button type="button" class="btn btn-info waves-effect" id="borrar">CERRAR PROCESO</button>
                                                <button type="submit" class="btn btn-danger waves-effect" id="salir">SALIR</button>
                                                <div><span style="color:red;">* Campos Obligatorios.</span></div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
								
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

    <!-- DateTime picker 
    
    <script src="../../calendar/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.es.js"></script>  
	-->
	<script src="../../calendar/js/moment.min.js"></script>
	<script src="../../fc/js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="../../fc/css/bootstrap-datetimepicker.min.css" />
   <script src="../../fc/js/bootstrap-datetimepicker.es.js"></script>
   
   	<!-- toggle botton --> 
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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
    var EspecialidadHTML ="";

    function populateFruitVariety() 
	{        
        $.getJSON('../tables/urlink.php', {funcion: "ja", origen: $('#tipojuzgado').val()}, function (data) {
            var zdata= data.juz_areasxtipojuzgado;
            console.log('fn ja...'+zdata);
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
	
	function isNumeric(evt) 
	{
        var theEvent = evt || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode (key);
		var regex = /[0-9]|\./;
		var keyCode = evt.keyCode == 0 ? evt.charCode : evt.keyCode;		
		if ( !regex.test(key) || keyCode == 46) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}

	function maxLengthCheck(object)
	{
		if (object.value.length > object.maxLength)
		{
			object.value = object.value.slice(0, object.maxLength);
		}
	}

    function goDespachos() 
	{
        var __area = $('#area').val();        
        if( __area == "" || __area == null)
        {           
            if(_area != "" && _area != null)
            {
                __area = _area;
            }
            else
            {
                __area = <?php echo $IdArea;?>;
            }            
        }
                
        if( __area != "" && __area != null)
        {
            //console.log('tipoJuzgado goDespacho..'+$('#tipojuzgado').val());
            $.getJSON('../tables/urlink.php', {funcion: "jd", origen: $('#tipojuzgado').val() +'-'+ __area }, function (data) {
                var zdata= data.juz_areasxjuzgado;
                //console.log('zdata_goDespacho..'+zdata);
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
    }
    
    function nroProceso(){
		_area =  $("#area").val();
		_nProceso = $("#nproceso").val();
		_Proceso = _zipDeptoCiudad + _tipojuzgado + _area + _despacho + $("#anio").val() + _nProceso + _nDv;		
		init_contador("#proceso","#muestrocantidadcaracteresid");
	}	
    
	function cnroProceso(){
        _area = "";		
        if(_tipojuzgado != "")
        {
            _area =  $("#area").val();
        }
        
        if(_area != "")
        {
            _Proceso = _zipDeptoCiudad + _tipojuzgado + _area + _despacho + $("#anio").val() + _nProceso + _nDv;			
            $("#proceso").attr("value",_Proceso);
            init_contador("#proceso","#muestrocantidadcaracteresid");
        }
    }
 

    function init_contador(idtextarea, idcontador)
    {
        function update_contador(idtextarea, idcontador)
        {
            var contador = $(idcontador);
            var ta = $(idtextarea);
            contador.html(ta.val().length);
        }

        $(idtextarea).keyup(function()
        {
            update_contador(idtextarea, idcontador);
        });

        $(idtextarea).change(function()
        {
            update_contador(idtextarea, idcontador);
        });            
    }
	
	function fx(prespstr)
	{
		if(prespstr == "S")
		{
			var fechainicio = $("#txtFecha").val();
			var usuario = $("#usuario").val();
			var ubicacion = $('select[name="ubicacion"] option:selected').text();
			var claseproceso = $('select[name="claseproceso"] option:selected').text();
			var juzgado = $("#juzgado").val();
			var estado = $('input:radio[name=estado]:checked').val();
			var proceso = $("#proceso").val();
			var cliente = $('select[name="cliente"] option:selected').text();
			var demandado = $('select[name="demandado"] option:selected').text();
			var especialidad = $("#area").val();
			var despacho = $("#despacho").val();		
			var nombreciu = $('select[name="zip"] option:selected').text();		
			var corporacion = $('select[name="tipojuzgado"] option:selected').text();		
			var area = $('select[name="area"] option:selected').text();
			var ddespacho = $('select[name="despacho"] option:selected').text();		
			var asignadoa = $('select[name="usuario"] option:selected').text();		
			var idtabla = "<?php echo $idtabla; ?>";		 
			var nproceso = $("#nproceso").val();		
			var origen ="p";
			//if( nproceso.length == 5)
			//{
			$.ajax({
				data : {"pnombre": nombre, "pfechainicio": fechainicio, "pusuario": usuario, "pubicacion": ubicacion, "pclaseproceso": claseproceso ,"pjuzgado": juzgado,"pestado": estado, "pproceso": proceso, "pnproceso": nproceso,"pcliente": cliente, "pdemandado":demandado, "pespecialidad":especialidad, "pdespacho":despacho, "origen": origen, "nombreciu": nombreciu, "corporacion": corporacion, "area": area, "despacho": ddespacho, "asignadoa": asignadoa, "ubicacion": ubicacion, "claseproceso": claseproceso, "cliente": cliente, "demandado": demandado, "maxid": idtabla, "accion": "u"},
				type: "POST",
				dataType: "html",
				url: "../../email/",
			})
			.done(function( data, textStatus, jqXHR){
				console.log("email..."+data);
				swal("Atención: ", "Proceso Actualizado correctamente.", "success");				
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
				if ( console && console.log ) 
				{
					console.log( "La solicitud a fallado: " +  textStatus);
					$("#msj").html("");
				}
			});
		}
	}


    $(document).ready(function(){			
        $("#mensaje").hide();
        $("#form_validation").show();
        $('#proceso').numeric();
        $('#anio').numeric();
        $('.selectpicker').selectpicker();
		var exclude_dates = ['2019-04-18', '2019-04-19'];
		var disabledWeekDays = [0,6];
        $('#fechainicio').datetimepicker({
          format: 'YYYY-MM-DD',
			datesDisabled: exclude_dates,
			daysOfWeekDisabled: disabledWeekDays		  
        });

        populateFruitVariety();
		
		var x = $("#proceso").val().length;
		$("#muestrocantidadcaracteresid").html("<span>"+x+"</span>");

        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'pro_proceso.php';
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

        $("#ndv").val('00');
        
        if( $('#tipojuzgado').val() != "" )
        {
			$.ajax({                
                type: "GET",				
                url : "../../consultadetalle/consultadetalle_juzgado.php?IdMostrar=0",
            })
            .done(function( dataX, textStatus, jqXHR ){	
                var zdata= dataX.juz_juzgado;
                var xrespstr = "";
                var IdArea = "";
                var ARE_Nombre = "";
                var IdJuzgado = "";
                var Ubicacion = "";
                var IdCiudad = "";
                var IdTipoJuzgado = "";  

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
                    options[options.length] = new Option(text.ARE_Nombre, text.JUZ_IdArea);
                });
                select.val(selectedOption);
                $('#area').selectpicker('refresh');

                /*
                EspecialidadHTML+='<option value="">-- Seleccione Especializacion.... --</option>';              
                $.each(dataX.juz_juzgado, function(i, item) 
                {                        
                    IdArea = dataX.juz_juzgado[i].JUZ_IdArea;
                    ARE_Nombre = dataX.juz_juzgado[i].ARE_Nombre;
                    IdJuzgado = dataX.juz_juzgado[i].JUZ_IdJuzgado;
                    Ubicacion = dataX.juz_juzgado[i].JUZ_Ubicacion;
                    IdCiudad = dataX.juz_juzgado[i].JUZ_IdCiudad;                       
                    IdTipoJuzgado = dataX.juz_juzgado[i].JUZ_IdTipoJuzgado;
                    EspecialidadHTML+='<option value="'+IdArea+'">'+ ARE_Nombre +'</option>';
                    //var option = document.createElement("option");
                    //$(option).html(EspecialidadHTML);
                    //$(option).appendTo("#area"); 
                }); 
                */

                /*    
                if(EspecialidadHTML != "")
                {                    
                   // $('#area').append(EspecialidadHTML);
                   $(EspecialidadHTML).appendTo("#area"); 
                }
                else
                {
                    //$('#EspecialidadHTML').hide();
                }
                */

            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) 
                {						
                    console.log( "La solicitud a fallado: " +  textStatus);
                    $("#msj").html("");
                }
            });

            goDespachos();
            nroProceso(); 
        }
		
	$("#actoprocesal").on("click", function(){
		var id = "<?php echo $idtabla ?>";
		var proceso ="<?php echo $nroproceso; ?>";
		$.post('editaractprocesal.php', { 'id': id, 'proceso': proceso }, function (result) {
			WinId = window.open('','_self');
			WinId.document.open();
			WinId.document.write(result);
			WinId.document.close();
		});
		
    });
		        
		
	$("#grabar").on('click', function(e) {
			e.stopPropagation();
			e.preventDefault();
            $("#mensaje").hide();
            var proceso = $("#proceso").val();
			var nproceso = $("#nproceso").val();            
            var fechainicio = $("#txtFecha").val();
            var asignadoa = $("#usuario").val();
            var ubicacion = $("#ubicacion").val();
            var claseproceso = $("#claseproceso").val();            
			var especialidad = $("#area").val();
            var demandante = $("#demandante").val();
            var demandado = $("#demandado").val();
            var estado = $('input:radio[name=estado]:checked').val();
			var representa = $('input:radio[name=representa]:checked').val();
            var idtabla = "<?php echo $idtabla; ?>";
			var um = <?php echo $_SESSION['IdUsuario']; ?>;
            //asignadoa == "" ||
            if( estado == undefined || representa == undefined || proceso == "" || fechainicio == "" ||  ubicacion == "" || claseproceso == "" || demandante == "" || demandado == "")
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
    			var enviaemailcli = $('#enviaemail').prop('checked');
				//alert("envia email cli..."+enviaemailcli);
				$.ajax({
    				data : {"proceso": proceso, "nproceso": nproceso, "fechainicio": fechainicio, "asignadoa": asignadoa, "ubicacion": ubicacion, "claseproceso": claseproceso, "demandante": demandante, "demandado": demandado, "estado": estado, "idtabla": idtabla, "enviaemailcli": enviaemailcli, "representa": representa, "um": um},
    				type: "POST",				
    				url : "../forms/editar_<?php echo strtolower($Tabla); ?>.php",
                })  
    			.done(function( dataX, textStatus, jqXHR ){	    			    
    				var xrespstr = dataX.trim();					
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);
					//alert(respstr);
    				if( respstr == "S" )
                    {
                        fx(respstr);						
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
        
        $("#salir").on('click', function(e) {
            e.preventDefault();
            window.location = '../tables/pro_proceso.php';
        });

    });
    </script>    
</body>
</html>