<?php
ob_start();
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if( !isset($_SESSION['IdUsuario']) && !isset($_SESSION['NombreUsuario']) )
{
	header("Location: ../../index.html");
    exit;
}

include('../../Connections/cnn_kn.php'); 
include('../../Connections/config2.php'); 
include('../../Connections/DataConex.php');
include('js.php');
//echo "<br><br><br><br><br><div style='margin-left:280px;'>En MWXxxxXMMMMMXMMXMMxxxXWWWwwm.....".$_SESSION['IdUsuario'].' - '.$_SESSION['NombreUsuario']." - ".$clavelocal." - ms: ". $ms." - abog: ".$usuesAbogado." - sa: ".$essuperadmin."</div>";
include('info.php');
//require_once('../../header/info.php');
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
		if (PHP_VERSION < 6) 
		{
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		}

		$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

		  switch ($theType) 
		  {
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
//$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

date_default_timezone_set('America/Bogota');
setlocale(LC_ALL,"es_ES");
$script_tz = date_default_timezone_get();

		$q="";
		require_once('../../Connections/DataConex.php');
		$soportecURL = "S";
		$url         = urlServicios."consultadetalle/consultadetalle_men_menu.php?IdMostrar=0";
		$existe      = "";
		$usulocal    = "";
		$siguex      = "";
		//echo "url...$url";
		//echo "<script>console.log(menu...". $url .");</script>";
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

			$mmenu =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
			$mmenu = json_decode($mmenu, true);
			//echo("<script>console.log('PHP: ".print_r($mmenu)."');</script>");
			//echo("<script>console.log('PHP: ".count($m['men_menu'])."');</script>");
			
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
			$mmenu = json_decode($resultado, true);	        
		} 

		if( $mmenu['estado'] < 2)
		{
			$nombre_Tabla="";
			//$q = "";
			for($i=0; $i<count($mmenu['men_menu']); $i++)
			{				
				$NombreMenu = trim($mmenu['men_menu'][$i]['MEN_Nombre']).' --';        
				$archivo = $NombreMenu.".php";
				$idTabla = $mmenu['men_menu'][$i]['MEN_IdMenu'];
				$Icono = trim($mmenu['men_menu'][$i]['MEN_Icono']);
				$Orden = $mmenu['men_menu'][$i]['MEN_Orden'];
				$LnkMenu = trim($mmenu['men_menu'][$i]['MEN_Link']);
				$Idestado = trim($mmenu['men_menu'][$i]['MEN_Estado']);	
				$estadoTabla = trim($mmenu['men_menu'][$i]['EstadoTabla']);
				
				if( $Icono != 'na')
				{				
					$q .="
						<li>
							<a href='". $LnkMenu."'>
								<i class='material-icons'>". $Icono. "</i>
								<span>". $NombreMenu ."</span>
							</a>";
							
							require_once('../../Connections/DataConex.php');
							$soportecURL = "S";
							$url         = urlServicios."consultadetalle/consultadetalle_men_submenu.php?IdMenu=$idTabla";
							$existe      = "";
							$usulocal    = "";
							$siguex      = "";
							//echo "<br>suburl...$url";
							//echo "<script>console.log(submenu...". $url .");</script>";
							//echo "submenu...". $url;
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

								$msubmenu =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
								$msubmenu = json_decode($msubmenu, true);
								//echo("<script>console.log('PHP: ".print_r($msubmenu)."');</script>");
								//echo("<script>console.log('PHP: ".count($m['men_submenu'])."');</script>");
								
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
								$msubmenu = json_decode($resultado, true);	        
							}
							
							if( $msubmenu['estado'] < 2)
							{							
								//echo "<ul class='vml-menu'>";
								$q .="<ul class='ml-menu'>";
								for($x=0; $x<count($msubmenu['men_submenu']); $x++)
								{
									$IdSubMenu = trim($msubmenu['men_submenu'][$x]['SME_IdSubMenu']);
									$NombreSubMenu = trim($msubmenu['men_submenu'][$x]['SME_Nombre']);								
									$Iconosm = trim($msubmenu['men_submenu'][$x]['SME_Icono']);
									$IdMenu = trim($msubmenu['men_submenu'][$x]['SME_IdMenu']);					
									$LnkSubMenu = trim($msubmenu['men_submenu'][$x]['SME_Link']);
									$Estado = trim($msubmenu['men_submenu'][$x]['SME_Estado']);
									$NombreMenu = trim($msubmenu['men_submenu'][$x]['NombreMenu']);
									
									//echo $NombreSubMenu;
									
									$q .="									
										<li>
											<a href='". $LnkSubMenu ."' class='menu-toggle'>
												<i class='material-icons'>". $Iconosm ."</i>
												<span>". $NombreSubMenu. "</span>
											</a>  
										</li>";									
								}
								$q .="</ul>";
							}
							
					$q .= "</li>";							
		
				} // Fin If
			} // fin For
			
		}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bienvenido a | <?php echo $empresa; ?> Administrador</title>
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

    <!-- Morris Chart Css -->
    <link href="../../plugins/morrisjs/morris.css" rel="stylesheet" />	

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
                    <img src="../../images/logoaj.png" style="margin-top: -10px;">
                </a>
            </div>
            <!--  Notificaciones  -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!--< Call Search >-->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- < #END# Call Search > 					
                    < Notifications >  -->
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
                    <!-- < #END# Notifications > 
                    < Tasks >  -->
					
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
                    <!-- < #END# Tasks >-->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
           <!--  Fin Notificaciones -->

        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
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
                            <li><a href="../../"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php //include_once('menu.php'); 
			//echo $q;		
			?>      
<div class="menu">
    <ul class="list">
        <li class="header">MENÚ de NAVEGACIÓN</li>
		
		<?php //echo $q; ?>
        <li>            
			<a href="./">
                <i class="material-icons">home</i>
                <span>Inicio</span>
            </a>
        </li>
		
		<li>
            <a href="#" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Módulo Empresas</span>
            </a>
			
            <ul class="ml-menu">
                <li>
                    <a href="emp_empresa.php" class="menu-toggle">
						<i class="material-icons">text_fields</i>
                        <span>Empresas</span>
                    </a>  
                </li>

				<?php //if($_SESSION["TipoUsuario"] == 1) {?>
					<li>
						<a href="usu_usuario.php" class="menu-toggle">
							<i class="material-icons">text_fields</i>
							<span>Usuarios</span>
						</a>
					</li>
				<?php //} ?>
            </ul>
			         
        </li>
		
		<li>
            <a href="cli_cliente.php" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Clientes</span>
            </a>
                      
        </li>
		

		

        <li <?php //if($opcMenu =="P") { echo "class='active'"; }?> >
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">work</i>
                <span>Gesti&oacute;n Procesos</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="pro_proceso.php" id ="np" name="np" class="menu-toggle active">
                        <span>Nuevo Proceso</span>
                    </a>
					<a href="pro_procesoc.php" id ="cp" name="cp" class="menu-toggle active">
                        <span>Procesos Cerrados</span>
                    </a>					
                </li>
            </ul>
        </li>        

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">today</i>
                <span>AGENDA</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../../agenda/inde.php" class="menu-toggle">
                        <span>Agenda</span>
                    </a>  
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">widgets</i>
                <span>Siglo XXI</span>
            </a>
            <ul class="ml-menu">
                <li>
                  <a href="https://procesojudicial.ramajudicial.gov.co/Justicia21/Administracion/InicioAplicaciones/InicioJusticia21Web.aspx" class="menu-toggle" target="_blank">
                        <span>Rama Judicial TYBA</span>
                    </a>
                </li>
            </ul>
        </li>
        
        
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">pie_chart</i>
                <span>Módulo de Recursos.</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="javascript:void(0);">Indicadores</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Gráficas</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Estadísticas</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Reportes</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Otros</a>
                </li>                            
            </ul>
        </li>
       
    </ul>
</div>			
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
        <!-- #END# Left Sidebar -->       
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>TABLERO DE CONTROL</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Procesos Abiertos: </div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $misProcesos; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text">Clientes Activos:</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $misClientes; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">record_voice_over</i>
                        </div>
                        <div class="content">
                            <div class="text">Seguimiento Judicial:</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $miProcesoJudicial; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">web</i>
                        </div>
                        <div class="content">
                            <div class="text">Eventos Agenda:</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $miAgenda ; ?>" data-speed="1000" data-fresh-interval="20"></div>							
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <!-- --><div id="graficaalumno">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Inscritos (%)</h2>
                                <div class="pull-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">Tiempo Real</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0);">Acción</a></li>
                                            <li><a href="javascript:void(0);">Otra Acci&oacute;n</a></li>
                                            <li><a href="javascript:void(0);">Otros</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div id="real_time_chart" class="dashboard-flot-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">                        
                        <div class="body bg-pink">
                            <!-- <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                                 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                                 data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                                 data-fill-Color="rgba(0, 188, 212, 0)">
                                12,10,9,6,5,6,10,5,7,5,12,13,7,12,11                                 
                            </div>-->                             
                            <div class="m-b--35 font-bold">
                                <div class="icon">
                                <i class="material-icons">av_timer</i> Estados de Procesos
                                </div>                                
                            </div>                            
                            <ul class="dashboard-stat-list">
                                <hr>
                                <li>
                                    Por Vencer MAÑANA
                                    <span class="pull-right"><b>2 Procesos.</b> <small></small></span>
                                </li>
                                <li>
                                    VENCIDOS HOY
                                    <span class="pull-right"><b>3 Procesos.</b> <small></small></span>
                                </li>
                                <li>
                                    Vencidos AYER
                                    <span class="pull-right"><b>1 Procesos.</b> <small></small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-cyan"> 
                            <div class="m-b--35 font-bold">
                                <div class="icon">
                                <i class="material-icons">description</i>
                                Informaci&oacute;n Noticias Judiciales
                                </div>
                            </div>

                            <ul class="dashboard-stat-list">
                                <hr>
                                <?php //do{ ?>
                                <li>
                                    <?php //echo trim($row_rs_niveles['NombreNivel']); ?>
                                </li>
                                <?php //} while($row_rs_niveles = mysqli_fetch_assoc($rs_niveles)); ?>                                        
                            </ul>                            
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">
                                <div class="icon">
                                    <i class="material-icons">library_books</i> 
                                     Indicadores
                                </div>        
                            </div>

                            <ul class="dashboard-stat-list">
                                <hr>
                                <?php //do{ ?>
                                <li>
                                    <?php //echo $row_rs_topicxnivel['NombreNivel'] ;?>
                                    <span class="pull-right"><b><?php //echo $row_rs_topicxnivel['total'] ;?></b> <small></small></span>
                                </li>
                                <?php // } while ($row_rs_topicxnivel = mysqli_fetch_assoc($rs_topicxnivel)); ?>
                            </ul>                            
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>

            <div id="infoactividades">
                <div class="row clearfix">
                    <!-- Task Info -->
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="card">
                            <div class="header">
                                <h2>INFORMACION DE ACTIVIDADES</h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0);">Acción</a></li>
                                            <li><a href="javascript:void(0);">Otra acción</a></li>
                                            <li><a href="javascript:void(0);">SOtras</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover dashboard-task-infos">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Actividad</th>
                                                <th>Estado</th>
                                                <th>Encargado</th>
                                                <th>Avance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Proceso A</td>
                                                <td><span class="label bg-green">en Proceso</span></td>
                                                <td>John Diaz</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Proceso B</td>
                                                <td><span class="label bg-blue">Para Hacer</span></td>
                                                <td>Maria Perez</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Proceso C</td>
                                                <td><span class="label bg-light-blue">en Espera</span></td>
                                                <td>Carlos López</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Proceso D</td>
                                                <td><span class="label bg-orange">Pend Aprobación</span></td>
                                                <td>Martha Arias</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Proceso E</td>
                                                <td>
                                                    <span class="label bg-red">Suspendida</span>
                                                </td>
                                                <td>Luis Jiménez</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Task Info -->
                    <!-- Browser Usage -->
                    <div id="enviocomunicados">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="card">
                                <div class="header">
                                    <h2>ENVIO COMUNICADOS </h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="javascript:void(0);">Acción</a></li>
                                                <li><a href="javascript:void(0);">Otra acción</a></li>
                                                <li><a href="javascript:void(0);">Otras</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div id="donut_chart" class="dashboard-donut-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Browser Usage -->
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../../plugins/jquery-countto/jquery.countTo.js"></script>
	
	<!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../../plugins/raphael/raphael.min.js"></script>
    <script src="../../plugins/morrisjs/morris.js"></script>	

    <!-- ChartJs -->
    <script src="../../plugins/chartjs/Chart.bundle.js"></script>
	
    
	<!-- Flot Charts Plugin Js -->
    <!-- --><script src="../../plugins/flot-charts/jquery.flot.js"></script> 
    <script src="../../plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../../plugins/flot-charts/jquery.flot.time.js"></script>
	
    
	<!-- Sparkline Chart Plugin Js -->
    <script src="../../plugins/jquery-sparkline/jquery.sparkline.js"></script>
	
	
    <!-- Custom J../s -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
	
	<script type="text/javascript">
    $(document).ready(function () {		
		$("#graficaalumno").hide();		
	});
	</script>	
</body>
</html>
<?php ob_end_flush();?>