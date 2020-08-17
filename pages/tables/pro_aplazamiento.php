<?php 
include_once("header.inc.php");
require_once ('../../Connections/DataConex.php'); //('../../Connections/cnn_kn.php');
$LogoInterno = LogoInterno;
//require_once('../../Connections/config2.php');
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
$idTabla = 0;
$empresa = Company;
if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
 }
 $nombre_lnk = "aplazamiento";
 $nombre = "";
 $email  = "";
 $usuario ="";
if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
{    
    $usuario = trim($_POST['ƒ×']);
}
else
{
    $usuario ="";
}
if($usuario == "")
{
    $usuario = $_SESSION['IdUsuario'];
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

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="../../css/sweet/main.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- JQuery DataTable Css 20160903 MKS-->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../../css/themes2/alertify.default.css" id="toggleCSS" />

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

   <style>
    object{
       width:100%;
       height:390px ;  
	}
    .procesodiv{
        margin-top: 3px;
        display: flex;  
        align-items: center;
        align-content: center;
        min-height: 2vh;
    }

    .procesodiv2{        
        display: inline-flex !important;  
        vertical-align:middle !important;
            
    }
    .txt{ 
        margin: auto; /* Important */ 
        text-align: center; 
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
                        <span id="xNom"><?php echo $_SESSION['NombreUsuario']; ?></span>                   
                    </div>


                    <div class="email">                        
                        <span id="xMail"><?php echo $_SESSION['EmailUsuario']; ?></span>
                    </div>


                    <!-- <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo trim($nombre); ?></div>
                    <div class="email"><?php //echo trim($email); ?></div> -->
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

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    INFORMACION DE: <?php echo strtoupper($nombre_lnk); ?> 
                    <small>Opciones: <a href="#" target="_blank">consultar, crear, modificar.</a></small>
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" style="min-height: 300px !important; min-width: 100px; overflow:hidden">                        
                        <div class="body" id="zonaquery">
                            <form class='contact_form' ACTION='' METHOD='POST' id='formulario'>
                                
                                <div class="form-group">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">
                                            <label class="form-label" style="font-size: 12;">Seleccione Tipo de Aplazamiento:</label>
                                            <div class="xform-line">													    
                                                
                                                <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tap" id="tap" required>
                                                <option value="">Seleccione Tipo de Aplazamiento:</option>                                                
                                                <?php                                                             
                                                    $idTabla = 0;                                                                                                       
                                                    require_once("../../apis/general/eventoinusual.php");
                                                    for($i=0; $i<count($meventoinusual['gen_eventoinusual']); $i++)
                                                    {
                                                        $IdEventoInusual = $meventoinusual['gen_eventoinusual'][$i]['EVI_IdEventoInusual'];
                                                        $Nombre = $meventoinusual['gen_eventoinusual'][$i]['EVI_Nombre'];
                                                        //$Estado = $meventoinusual['gen_eventoinusual'][$i]['EVI_Estado'];															
                                                ?>
                                                        <option value="<?php echo $IdEventoInusual; ?>" >
                                                            <?php echo $Nombre ; ?>                                                
                                                        </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>	

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">
                                            <label class="form-label" style="font-size: 12;">Buscar Número de Proceso:</label>
                                            <div class="xform-line">													    
                                                
                                                <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="proceso" id="proceso" required>
                                                <option value="">Seleccione Proceso:</option>
                                                <option value="0">Todos</option>
                                                <?php                                                             
                                                    $idTabla = 0;
                                                    $e = "1";
                                                    $iu = $_SESSION['TipoUsuario'];
                                                    $em = $_SESSION['IdEmpresa'];                                                    
                                                    require_once("../../apis/proceso/proceso.php");
                                                    for($i=0; $i<count($mproceso['pro_proceso']); $i++)
                                                    {
                                                        $IdProceso = $mproceso['pro_proceso'][$i]['PRO_IdProceso'];
                                                        $Nombre = $mproceso['pro_proceso'][$i]['PRO_NumeroProceso'];
                                                        
                                                        $nroproceso = substr($Nombre,16,5);
                                                        if(strlen($nroproceso) < 5 )
                                                        {
                                                            $Nombre = $IdProceso.' - Sin Radicado';
                                                        }
                                                ?>
                                                        <option value="<?php echo $IdProceso; ?>" >
                                                            <?php echo $Nombre ; ?>                                                
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
                                            <label class="form-label">Acci&oacute;n a realizar: </label>
                                            <input type="radio" name="opcion" id="consultar" class="with-gap" value="c">
                                            <label for="consultar">Consultar</label>

                                            <input type="radio" name="opcion" id="asignar" class="with-gap" value="a">
                                            <label for="asignar" class="m-l-20">Asignar</label>

                                            <input type="radio" name="opcion" id="desasignar" class="with-gap" value="d">
                                            <label for="desasignar" class="m-l-20">Desasignar</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="row">                                            
                                            <hr style="border-bottom-style: dotted; border-bottom-width: 1px; color: orange; margin-top:-10px">
                                        </div>
                                    </div>
                                </div>

                                <div id="qrytodos">    
                                    <div class="form-group">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row">
                                                <!-- 1x -->
                                                <section class="xcontent" >
                                                    <div class="container-fluid">            
                                                        <!-- Exportable Table -->
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="card">
                                                                    <div class="header">
                                                                        <h2>
                                                                            Opciones para Exportar
                                                                        </h2>
                                                                                                    
                                                                    </div>
                                                                    <div class="body table-responsive" id="zonatab">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- #END# Exportable Table -->
                                                    </div>
                                                </section>
                                                <!-- 1x -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>                               
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

	<!-- Default Editar -->
	<div class="modal fade" id="defaultModalEditar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content" >
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Editar</h4>
				</div>
				
				<div class="modal-body">
					<object type="text/html" 
					style="padding :0px; position: relative; height: 76vh; max-height:76vh; bottom:0; overflow: hidden; margin: 0;"
					data="../forms/editar<?php echo $nombre_lnk ;?>.php" id="carga"></object>                           
				</div>

				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->                            
					<button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="cerrarModal">CERRAR</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Default Size -->
	<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content" >
				<div class="modal-header">
					<!-- <h4 class="modal-title" id="defaultModalLabel">Crear</h4> -->
				</div>
				
				<div class="modal-body">                         
					<object style="padding :0px; position: relative; height: 85vh; max-height:85vh; bottom:0; overflow: hidden; margin: 0;" 
					type="text/html" data="../forms/form-validationBase<?php echo $nombre_lnk ;?>.php" id="crear"></object>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
					<button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="cerrarModalC">CERRAR Crear.</button>
				</div>
			</div>
		</div>
	</div>


    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>
    <script src="../../js/pages/ui/modals.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
    <script src="../../js/alertify.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {	 
	
    $("#qrytodos").hide();

    $("input[name=opcion]").change(function (e) {
        var tap = $("#tap").val();
        var np = $("#proceso").val();
        if(tap == "")
        {
            swal("Atencion:", "Debe seleccionar un Tipo de Aplazamiento.");
            e.stopPropagation();               
            return false; 
        }
        if(np == "")
        {
            swal("Atencion:", "Debe seleccionar un Número de Proceso.");
            e.stopPropagation();               
            return false; 
        }
        
        if($(this).val() == "c" )
        {
            //alert('c');
            $.ajax({                    
                data : {"ptap": tap, "pnp": np},
                type: "POST",
                dataType: "html",
                url : "pro_qryaplaza.inc.php",
            })
            .done(function( data, textStatus, jqXHR){ 
                var datos = JSON.parse(data);
                var items ="";
                items +='<table class="table table-bordered table-striped table-hover dataTable js-exportable" id="grid">';
                items +="   <thead>";
                items +="       <tr>";
                items +="           <th>No. Proceso</th>";
                items +="           <th>Nombre Aplazamiento</th>";
                items +="           <th>Fecha Inicial</th>";
                items +="           <th>Fecha Final</th>";
                items +="       </tr>";
                items +="   </thead>";
                items +="   <tfoot>";
                items +="       <tr>";
                items +="           <th>No. Proceso</th>";
                items +="           <th>Nombre Aplazamiento</th>";
                items +="           <th>Fecha Inicial</th>";
                items +="           <th>Fecha Final</th>";                                     
                items +="       </tr>";
                items +="   </tfoot>";
                items +="   <tbody>";
                        for(var i= 0; i < datos.length; i++) 
                        {
                            var idproceso = datos[i].PRO_IdProceso;
                            var nroproceso = datos[i].PRO_NumeroProceso;
                            var long_proceso = nroproceso.substr(16, 5);
                            if( long_proceso.length < 5)
                            {
                                nroproceso = idproceso+ ' - Sin Radicado';
                            }
                            var nombre = datos[i].EVI_Nombre;
                            var fechainicio = datos[i].EVI_FechaInicio;
                            var fechafin = datos[i].EVI_FechaFinal;
                            items +="<tr>";
                            items +="   <td>" + nroproceso + "</td>";
                            items +="   <td>" + nombre + "</td>";
                            items +="   <td>" + fechainicio + "</td>";
                            items +="   <td>" + fechafin + "</td>";
                            items +="</tr>";
                        }
                items +="   </tbody>";
                items +="</table>";
                $("#zonatab").html(items);
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) 
                {
                    console.log( "La solicitud a fallado: " +  textStatus);
                    $("#msj").html("");
                }
            });    

            $("#qrytodos").show();
        }
        else
        {            
            $("#qrytodos").hide();
            var opc = "";
            var txt = "Aplazamiento";
            if($(this).val() == "a" )
            {
                opc = "a";                 
            }
            else
            {
                opc = "d";
                txt = "Desasignar"; 
            }
            var np = $("#proceso").val();
            swal({
                    title: "¿Desea realizar el proceso de: " + txt + " ?",
                    text: "Esta acción afectará a él o todos los Procesos Activos.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false 
                },

                function(isConfirm)
                {
                    if (isConfirm) 
                    {
                        $.ajax({
                            data : {"ptap": tap, "pnp": np, "opcion": opc},
                            type: "POST",
                            dataType: "html",
                            url : "pro_asignaaplaza.inc.php",
                        })  
                        .done(function( dataX, textStatus, jqXHR ){                       
                            var xrespstr = dataX.trim();
                            var respstr = xrespstr.substr(0,1);
                            var msj = xrespstr.substr(2);        
                            if( respstr == "S" )
                            {
                                swal("Atención: ", msj, "success");
                            }
                            else
                            {                    
                                swal({
                                    title: "Atención: ",   
                                    text: msj,   
                                    type: "error" 
                                });                    
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
                        $("#tap option").prop("selected", false).trigger( "change" );
                        $("#proceso option").prop("selected", false).trigger( "change" );
                    } 
                    else {
                        swal("¡Atención!",
                                "Acción de Asignación cancelada...",
                                "error"
                        );
                    }
                }
            )
            $('input:radio[name=opcion]').attr('checked',false);
            
        }
        // else
        // {
        //     //alert('d');
        //     $("#qrytodos").hide();
        // }
    });

    $("#tap").on('change', function(){
        $('input:radio[name=opcion]').attr('checked',false);
        $("#qrytodos").hide();
    })

    $("#proceso").on('change', function(){
        $('input:radio[name=opcion]').attr('checked',false);
        $("#qrytodos").hide();
    })

 }); 
</script>
</body>
</html>