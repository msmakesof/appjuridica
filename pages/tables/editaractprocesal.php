<?php
include_once("header.inc.php");
require_once ('../../Connections/DataConex.php');
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
$nombre_lnk = "actuacionprocesal";
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
$txtnroproceso = "";
$condinroproceso = "";
$nroproceso = $_POST['proceso'];
$cadena = strlen($nroproceso);
if( $cadena <= 22 )
{
	$txtnroproceso = "<span class='label label-danger' style='border-radius: 5px;'>Proceso Radicado. Nro. interno: ". $nroproceso."</span>";
}
else
{
	$txtnroproceso = "<span class='label label-success' style='border-radius: 5px;'>Nro. Proceso: ". $nroproceso."</span>";
	$condinroproceso = $nroproceso;
}

$TotalGastos = 0;
require_once('../../apis/proceso/headproceso.php');
$NombreAbogado = $mproceso['pro_proceso']['NombreAbogado'];
$NombreDemandante = $mproceso['pro_proceso']['NombreDemandante'];
$NombreDemandado = $mproceso['pro_proceso']['NombreDemandado'];
$DocDemandante = $mproceso['pro_proceso']['DocDemandante'];
$DocDemandado = $mproceso['pro_proceso']['DocDemandado'];
$DirDemandante = $mproceso['pro_proceso']['DirDemandante'];
$DirDemandado = $mproceso['pro_proceso']['DirDemandado'];
$DirJuzgado = $mproceso['pro_proceso']['DirJuzgado'];
$Piso = $mproceso['pro_proceso']['JUZ_Piso'];
$Email = $mproceso['pro_proceso']['JUZ_Email'];
$NombreArea = $mproceso['pro_proceso']['NombreArea'];

$midtabla = 0;
//echo $_POST["id"];
if( isset($_POST["id"]))  // Este es el id del Proceso la llave
{
	$midtabla = trim($_POST["id"]);
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

    <!-- JQuery DataTable Css 20160903 MKS-->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

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
                            <?php 										
								$pusuario = $_SESSION['IdUsuario'];
								$ptipousuario = $_SESSION["TipoUsuario"];
								$empresa = $_SESSION['IdEmpresa'];
								include('../../apis/proceso/robotnotifica.php');
							?>
                            <span class="label-count"><?php echo count($mproceso['robotnotifica']); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICACIONES</li>
                            <li class="body">
                                <ul class="menu">
									<?php
										for($i=0; $i<count($mproceso['robotnotifica']); $i++)
										{
											$IdActProcesal = $mproceso['robotnotifica'][$i]['NOT_IdActProcesal'];
											$FechaEnvio = substr($mproceso['robotnotifica'][$i]['NOT_FechaEnvio'], 0,10);
											$Nombre = trim($mproceso['robotnotifica'][$i]['TAP_Nombre']);
											$NumeroProceso = $mproceso['robotnotifica'][$i]['PRO_NumeroProceso'];
											$IdEmpresa = $mproceso['robotnotifica'][$i]['USU_IdEmpresa'];
									?>
									<li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?php echo $Nombre; ?></h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> <?php echo $FechaEnvio; ?>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
									<?php										
										}
									?>
									<!--
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
                                    </li> -->
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
                        <span id="xNom">
							<?php 								
								if ( isset( $_SESSION['NombreUsuario'] ) && !empty( $_SESSION['NombreUsuario'] ) ) 
								{
									// Variable definida y no vacia
									echo $_SESSION['NombreUsuario'];
									//header("Content-Type: text/html; charset=UTF-8");
								} 
								else 
								{
									// Variable no definida o vacia
									//header("Content-Type: text/html; charset=UTF-8");
									header('Location: ../../');
								}								 
							?>
						</span>                   
                    </div>


                    <div class="email">                        
                        <span id="xMail">
							<?php								
								if ( isset( $_SESSION['EmailUsuario'] ) && !empty( $_SESSION['EmailUsuario'] ) ) 
								{
									// Variable definida y no vacia
									echo $_SESSION['EmailUsuario'];
									//header("Content-Type: text/html; charset=UTF-8");
								} 
								else 
								{
									// Variable no definida o vacia
									header('Location: ../../');
								}							
								//echo $_SESSION['EmailUsuario']; 
							?>
						</span>
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
			
				<div class="container form-group">                                    
					<div class="row">
				
						<div class="col-lg-6 col-md-5 col-sm-5 col-xs-5">
							<h2>
								INFORMACION DE: <?php echo strtoupper($nombre_lnk); ?> 
								&nbsp;&nbsp;&nbsp;&nbsp;					
								<small>Opciones: <a href="#" target="_blank">consultar, crear, modificar.</a></small>
							</h2>
						</div>    

						<div class="col-lg-6 col-md-5 col-sm-5 col-xs-5">
							<span class="alert alert-warning" role="alert">Abogado: <b><?php echo trim(strtoupper($NombreAbogado)); ?></b></span>
						</div>
					</div>
				</div>
				
						
            </div>
            
            <!-- Exportable Table -->			
            <div class="row clearfix">
				<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">				
										
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">        
							Juzgado: <b><?php echo $NombreArea; ?></b>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">        
							Direcci&oacute;n: <b><?php echo $DirJuzgado; ?></b>
						</div>								
					</div>
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">        
							Piso: <b><?php echo $Piso; ?></b>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">        
							Email: <b><?php echo $Email; ?></b>
						</div>
					</div>
			
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							Demandante: <b><?php echo trim(strtoupper($NombreDemandante)); ?></b>
						</div>                            
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							Documento: <b><?php echo trim(strtoupper($DocDemandante)); ?></b>
						</div>
					</div>
			
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							Direcci&oacute;n: <b><?php echo trim(strtoupper($DirDemandante)); ?></b>                            
						</div>    
					</div>					

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							Demandado: <b><?php echo trim(strtoupper($NombreDemandado)); ?></b>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							Documento: <b><?php echo trim(strtoupper($DocDemandado)); ?></b>
						</div>                             
					</div>
			
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							Direcci&oacute;n: <b><?php echo trim(strtoupper($DirDemandado)); ?></b>
						</div>    
					</div>
											
					
				</div>						

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            Opciones para Exportar
                            <div style="text-align: center; font-size:18px !important;">
                                <?php echo $txtnroproceso .' - ' . $midtabla; ?>
                            </div>
                            </h2>
                            

							<ul class="header-dropdown m-r--1">                                                                
								<li class="dropdown">
                                    
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">                                        
                                        <i class="material-icons" style="font-size:24px;color:red">add_circle_outline</i>                                        
									</a>                                    

									<ul class="dropdown-menu pull-right">
									<li>
									<!-- <a id="nuevo" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#defaultModal">Nuevo</a> -->

										<a id="nuevo" href="javascript:void(0);" onclick="nuevo(<?php echo $midtabla; ?>)" class="btn btn-warning btn-xs waves-effect">
											<i class="material-icons">add_circle</i>Nuevo
										</a>
										<a id="salir" href="javascript:void(0);">
											<i class="material-icons">cancel</i>Salir
										</a>

									<!--  <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">Nuevo</button>-->
										</li>
										<!-- 
										<li><a href="javascript:void(0);">Another action</a></li>
										<li><a href="javascript:void(0);">Something else here</a>
										</li>
										-->
									</ul>
									
								</li>
							</ul>
                        </div>

                        <div class="body table-responsive" id="zonaquery">
                        <form class='contact_form' ACTION='../forms/editarproceso.php' METHOD='POST' id='formulario'>
                         <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="grid">
                                <thead>
                                    <tr>
										<th>Fecha</th>
										<th>Tipo Actuaci&oacuten Procesal</th>
										<th>Fecha Estado</th>
										<th>Observaci&oacute;n</th>
										<th>Gasto</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Fecha</th>
										<th>Tipo Actuaci&oacuten Procesal</th>
										<th>Fecha Estado</th>
										<th>Observaci&oacute;n</th>
										<th>Gasto</th>
                                    </tr>
                                </tfoot>
                                <tbody>
<?php
//require_once('../../Connections/DataConex.php');
/*
if($_SESSION["TipoUsuario"] <= 2 ) {
	$IdUsuario = $_SESSION['IdUsuario'];	
	$empresa = $_SESSION['IdEmpresa'];	
}
*/
$IdTipouser = $_SESSION["TipoUsuario"];
		
	$soportecURL = "S";
	$url         = urlServicios."consultadetalle/consultadetalle_pro_actuacionprocesal.php?IdMostrar=0&E=1&Proceso=".$midtabla."&IdTipouser=".$IdTipouser ;
	$existe      = "";
	$usulocal    = "";
	$siguex      = "";
	//echo("<script>console.log('PHP ConsultaProceso: $url');</script>");
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

		$mactuacionprocesal =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
		$mactuacionprocesal = json_decode($mactuacionprocesal, true);
		//echo("<script>console.log('PHP: ".print_r($mactuacionprocesal)."');</script>");
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
		$mactuacionprocesal = json_decode($resultado, true);	        
	} 
	
	if( $mactuacionprocesal['estado'] != 2)
	{
		$nombre_Tabla = "";
		$contar = count($mactuacionprocesal['pro_actuacionprocesal']);
		
		for($i=0; $i < $contar; $i++)
		{
			$idTablaap = $mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_IdActuacionProcesal'];
			$idProceso = $mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_IdProceso'];			
			$FechaCreacion = $mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_FechaCreacion'];
			$Nombre = $mactuacionprocesal['pro_actuacionprocesal'][$i]['TAP_Nombre'];
			$FechaHabil = $mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_FechaHabil'];
			$Observaciones = trim($mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_Observaciones']);
			$estadoTabla = trim($mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_EstadoActProcesal']);
			$Gasto = trim($mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_Gasto']);
			$TotalGastos += $Gasto;
?>
        <tr>            
			<td href="javascript:void(0);" style="cursor: pointer;" onclick='actproupd("<?php echo $idTablaap; ?>","<?php echo $midtabla; ?>", "<?php echo $nroproceso; ?>")' ><?php echo $idTablaap; ?> - <?php echo $FechaCreacion; ?></td>
			<td><?php echo $Nombre; ?></td>
			<td><?php echo $FechaHabil; ?></td>            
			<td><?php echo $Observaciones; ?></td>
			<td>$ <?php echo number_format($Gasto, 2, '.', ','); ?></td>            
		</tr>
    <?php                          
    }
}
?>
<div class="form-group">
<div style="float: right !important;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	<div class="row">	
		<div style="margin-bottom:-15px; float: right">
			<span class="btn btn-success">Total Gastos: $<?php echo  number_format($TotalGastos, 2, '.', ','); ?></span>
		</div>
	</div>
</div>
</div>

 </tbody>
</table>
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
					<h4 class="modal-title" id="defaultModalLabel">Editar...</h4>
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

    <!-- Select Plugin Js 
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>
	-->

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

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

<script type="text/javascript">
var variableValue;
 $(document).ready(function () {	 
	$("#cerrarModal").click(function(){
	 	 window.location="pro_<?php echo $nombre_lnk; ?>.php";
	});

	$("#cerrarModalC").click(function(){
	 	 window.location="pro_<?php echo $nombre_lnk; ?>.php";
	});	

	
	$("#salir").on("click", function(){       
        window.location = 'pro_proceso.php';
    });

    /*
	$("#cambiar").on("click", function(id){
        //alert(id);
        <?php  $_SESSION["f"] = $idTabla;?>
        //document.getElementById("formulario").submit();
        
        window.location = '../forms/editarproceso.php';
    });
	*/

 }); 

function cambiar(id) 
{
    //alert(id);    	
    $.post('../forms/editarproceso.php', { 'id': id }, function (result) {
        WinId = window.open('','_self');
        WinId.document.open();
        WinId.document.write(result);
        WinId.document.close();
    });
}

function nuevo(id)
{
	$.post('../forms/actprocrea.php', { 'id': id }, function (result) {
        WinId = window.open('','_self');
        WinId.document.open();
        WinId.document.write(result);
        WinId.document.close();
    });
}

function actproupd(idactprocesal, idproceso, nroproceso)
{	
	$.post('../forms/actproupd.php', { 'idactprocesal': idactprocesal, 'idproceso': idproceso, 'nroproceso': nroproceso }, function (result) {
        WinId = window.open('','_self');
        WinId.document.open();
        WinId.document.write(result);
        WinId.document.close();
    });
}

function actprocesal(id) 
{
    //alert(id);    	
    $.post('editaractprocesal.php', { 'id': id }, function (result) {
        WinId = window.open('','_self');
        WinId.document.open();
        WinId.document.write(result);
        WinId.document.close();
    });
}

function xcambiar(nuevaurl) 
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
</script>
</body>
</html>
<?php // ob_end_flush(); ?>