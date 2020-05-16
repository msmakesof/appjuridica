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

$NombreTabla ="AREAXCLIENTE";
$idTabla = 0;
$tipoCLiente = 0 ;
//require_once('../../apis/juzgado/juzgado.php');
//require_once('../../apis/cliente/infoCliente.php');
$yy = date("Y");
$empresa = Company;
if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
}
$nombre_lnk = "areaxcliente";
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

        <!-- DateTime Picker 
        <link href="../../calendar/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		-->

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
	<!--
    <script src="../../calendar/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../calendar/js/bootstrap-datetimepicker.es.js"></script>    
	-->
	<script src="../../fc/js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="../../fc/css/bootstrap-datetimepicker.min.css" />

	<script src="../../fc/js/bootstrap-datetimepicker.es.js"></script> 
   <style>
    object{
       width:100%;
       height:390px ;  
	}

    .caja{
        margin-bottom:-10px !important;
        margin-left: 2%;
        margin-right: 20%;
    }
   </style>

   <script type="text/javascript">
    $(document).ready(function()
    {   
		$("#divtodos").hide();		
		
		$("#todos").on('click', function(e){
			$(".chk-box").prop("checked", this.checked);
		});		
		 
		$('#tipojuzgado').change(function() 
		{            
            var nameARE_Codigo = $('#tipojuzgado option:selected').text();
            _tipojuzgado = nameARE_Codigo.trim();
            _tipojuzgado = _tipojuzgado.substring(0, 2);
			$("#todos").prop("checked", false);
			
			$.getJSON('../tables/urlink.php', {funcion: "ja", origen: $('#tipojuzgado').val()}, function (data) {
				var zdata= data.juz_areasxtipojuzgado; 				
				var name = "";
				var id = "";
				var nom = "";			
				$("#lbltxt").html("");
				$("#mappend").html("");
				$("#zonatodos").hide();				
				if (zdata != undefined)
				{						
					if(zdata.length > 0 )
					{
						$("#zonatodos").show();
						if(zdata.length == 1 )
						{							
							$("#zonatodos").hide();
						}						
						$("#divtodos").show();
					}
					else{
						$("#zonatodos").hide();
						$("#divtodos").hide();
					}
					
					for (var i = 0; i < zdata.length; i++) {				
						id = zdata[i].ARE_IdArea;
						nom = zdata[i].ARE_Nombre;
						name += "<input class='chk-box' type='checkbox' id='"+id+"' name='itemchk' value='"+id+"' /><label for='"+id+"'>" + nom + "</label><br>";
					}
					$("#lbltxt").html("<span style='color:red;'>*</span> Seleccione Area(s) o Especialidad(es):");
					$("#mappend").append(name);
				}
				else
				{
					$("#zonatodos").hide();					
					$("#lbltxt").html("<b>Atención:</b> No existe información disponible para esa Jurisdicción.");					
				}
				$("#divtodos").show();				
			});
        });		

        $("#grabar").on('click', function(e) 
		{				
			var empresa = $('#zip').val();
			var tipojuzgado = $('#tipojuzgado').val()
			
			if ( empresa != "" && tipojuzgado != "")
			{	
				var selected = [];
				selected.push(empresa);
				selected.push(tipojuzgado);
				
				$(":checkbox[name=itemchk]").each(function() {
					if (this.checked) {
						// agregas cada elemento.
						selected.push($(this).val());
					}
				});			
				
				if (selected.length) {
					console.log(selected);
					$.ajax({				
						type: 'POST',
						dataType: 'json', 
						data: "datos="+JSON.stringify(selected),
						url: '../forms/cli_areaxcliente.php',						
						success: function(data) {
							if(data == 1)
							{
								setTimeout(function () {
									swal("Atención:", "Grabado correctamente.", "success");
								}, 2000);								
								window.location = 'cli_areaxcliente.php';
							}	
						},
						error: function(xhr, status, error) {
							alert(status);
						},
						dataType: 'text'				   
					});
				}	
			}
			 else 
            {                
                swal({
                  title: "Atención:  Debe Seleccionar Empresa y/o Corporación / Juridiscción ...",
                  text: "un momento por favor.",
                  imageUrl: "../../js/sweet/3red.gif",
                  timer: 2500,
                  showConfirmButton: false
                });
                return false;             
            }
			
        });

		$("#cerrar").on('click', function(e) 
		{				
			e.preventDefault();
			window.location = 'cli_areaxcliente.php';
		});
    })
    </script>      
</head>

<body class="theme-red">
    <!-- Page Loader -->
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
	
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
	
	
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
                        <span id="xNom">
							<?php echo $_SESSION['NombreUsuario']; ?>
						</span>                   
                    </div>


                    <div class="email">                        
                        <span id="xMail">
							<?php echo $_SESSION['EmailUsuario']; ?>
						</span>
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
                            <li><a href="./close.php"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php 
                $_SESSION["opcMenu"]="P";
                require_once('menu.php'); 
            ?> 
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
						<!-- 
						<div class="header">
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
                        <div class="body table-responsive" id="zonaquery" style="height:680px !important;">                            
							<?php							
							$soportecURL = "S";
							$url         = urlServicios."consultadetalle/cli_areaxcliente.php?IdMostrar=0";
							$existe      = "";
							$usulocal    = "";
							$siguex      = "";
							echo("<script>console.log('PHP: ".$url."');</script>");	
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

								$mareaxcliente =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
								$mareaxcliente = json_decode($mareaxcliente, true);
								//echo("<script>console.log('PHP: ".print_r($mareaxcliente)."');</script>");
								//echo("<script>console.log('PHP: ".count($m['cli_areaxcliente'])."');</script>");
								
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
								$mareaxcliente = json_decode($resultado, true);	        
							} 

							if( $mareaxcliente['estado'] < 2)
							{
								$nombre_Tabla="";
								for($i=0; $i<count($mareaxcliente['cli_areaxcliente']); $i++)
								{
									/*
									$NombreTabla = trim($mareaxcliente['cli_areaxcliente'][$i]['PRO_NumeroProceso']);        
									$archivo = $NombreTabla.".php";
									$idTabla = $mareaxcliente['cli_areaxcliente'][$i]['PRO_IdProceso'];
									$AsignadoA =$mareaxcliente['cli_areaxcliente'][$i]['AsignadoA'];
									$Ubicacion =$mareaxcliente['cli_areaxcliente'][$i]['Ubicacion'];
									$ClaseProceso =$mareaxcliente['cli_areaxcliente'][$i]['ClaseProceso'];
									$Juzgado =$mareaxcliente['cli_areaxcliente'][$i]['Juzgado'];
									$estadoTabla = trim($mareaxcliente['cli_areaxcliente'][$i]['EstadoTabla']);
									*/
								?>
								   
								<?php                          
								}
							}
							?>							
							<!-- <div > -->
							<!-- form -->
							<form id="form_validation" method="POST" autocomplete="ÑÖcompletes">
									
									<div class="form-group">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="row">
												<div class="xcol-xs-10">
													<span style="color:red;">*</span>
													<label class="form-label">Empresa / Abogado:</label>
													<div class="xform-line">                                                    
														<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="zip" id="zip" required>
														<option value="" >Seleccione Opción...</option>
														<?php
															$idTabla = 0;
															require_once('../../apis/empresa/Empresa.php');
															for($i=0; $i<count($mempresa['emp_empresa']); $i++)
															{
																$EMP_IdEmpresa = $mempresa['emp_empresa'][$i]['EMP_IdEmpresa'];
																$NombreEmpresa = strtoupper($mempresa['emp_empresa'][$i]['NombreEmpresa']);
																$EMP_Identificacion = $mempresa['emp_empresa'][$i]['EMP_Identificacion'];                                                                
																//$CIU_IdDepartamento = $mempresa['emp_empresa'][$i]['CIU_IdDepartamento'];
														?>
																<option value="<?php echo $EMP_IdEmpresa; ?>" >
																	<?php echo $NombreEmpresa ; ?>                                                
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
												<div class="xcol-xs-10">
													<span style="color:red;">*</span>
													<label class="form-label">Corporaci&oacute;n / Jurisdicci&oacute;n:</label>                                        
													<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tipojuzgado" id="tipojuzgado" required>
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
									
									<div class="form-group">                               
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="row">												
												<div id="divtodos" name="divtodos">
													<hr>													
													<label id="lbltxt"></label><br>
													<div id="zonatodos">
														<input class='select-all' type='checkbox' id='todos' value="0" name='todos' />
														<label for='todos'>Seleccionar / Desmarcar Todos</label><br>
													</div>
												</div>
												
												<div id="mappend" name="mappend">											
												</div>
												
											</div>
										</div>
									</div>
									
									<div class="form-group">                               
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="row">
												<hr>
											</div>
										</div>
									</div>
	  
								   
									<div class="form-group">
										<div class="col-xs-9">                                
											<div class="row">
											 <hr>
												<div class="col-sm-8">
													<button class="btn btn-primary waves-effect" type="submit" id="grabar" name="grabar">GRABAR</button>
													<button class="btn btn-danger waves-effect" type="submit" id="cerrar">SALIR</button>
													<div><span style="color:red;">* Campos Obligatorios.</span></div>													
												</div>
											</div>
										</div>
									</div>                                                      
							</form>                        
                        <!-- end form -->
                        </div>
                        
                        
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
	
</body>
</html>