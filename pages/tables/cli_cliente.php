<?php
include_once("header.inc.php");
require_once ('../../Connections/DataConex.php'); //('../../Connections/cnn_kn.php');
$LogoInterno = LogoInterno;
require_once('../../Connections/config2.php');
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
$empresa = Company;
//if( isset($_POST['id']){ echo "id...".$_POST['id'];}
/*
if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
 }
 */
$nombre_lnk = "cliente";
$nombre = "";
$email  = "";
$usuario ="";
if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
{    
    $usuario = trim($_POST['ƒ×']);   
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
	
	<link href="../../css/sweet/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css 20160903 MKS-->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
	
	<script src="../../js/sweet/sweetalert.min.js"></script>
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

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
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
			<?php
			// Administrador(1) o Abogado(2)
			$class = "user-info";
			$classFont = "";				
			if($_SESSION["TipoUsuario"] == 1 OR $_SESSION["TipoUsuario"] == 4 ) 
			{
				$class = $class;
			}
			if($_SESSION["TipoUsuario"] == 2 ) 
			{
				$class = "user-info";
				$classFont = "font-style: italic;";
			}
			?>
            <div class="<?php echo $class; ?>">
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
                <div class="info-container" style="width:100%; float:left !important; <?php echo $classFont; ?>">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                        
                        <span id="xNom"><?php echo $_SESSION['NombreUsuario']; ?></span>                   
                    </div>

                    <div class="email">                       
                        <span id="xMail"><?php echo $_SESSION['EmailUsuario']; ?></span>
                    </div>
                    
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>
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
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
					<?php 
					$texto ="";
					if($_SESSION['TipoUsuario'] == 2 )  // 2.Abogado
					{
						$texto .= " Asignado."; 
					}
					?>
                    INFORMACION DE: <?php echo strtoupper($nombre_lnk); echo $texto; ?>
                    <small>Opciones: <a href="#" target="_blank">consultar, crear, modificar.</a></small>
                </h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Opciones para Exportar
                            </h2>
                            <ul class="header-dropdown m-r--1">
                                <li class="dropdown">                                   
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons" style="font-size:24px;color:red">add_circle_outline</i>                                                
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                       <li>
										<!--  
                                        <a href="javascript:void(0);" onclick="crear('../pages/forms/form-validationBase<?php echo $nombre_lnk ;?>.php')" 
                                            class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#defaultModal">
                                            Nuevo...
                                        </a>
										-->
										<a id="nuevo" class="btn btn-warning btn-xs waves-effect">Nuevo</a>	
                                        
                                      <!--  <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">Nuevo</button>-->
                                        </li>                                        
                                    </ul>                                    
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive" id="zonaquery">
                         <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="grid">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Identificaci&oacute;n</th>
                                        <th>Email</th>
                                        <th>Dirección</th>
										<th>Celular</th>
										<?php if($_SESSION['TipoUsuario'] == 2){
											echo "<th>Proceso</th>";
										} ?>
										<th>Empresa</th>
										<th>Estado</th>																				
										<th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Identificaci&oacute;n</th>                                        
                                        <th>Email</th>
                                        <th>Dirección</th>
										<th>Celular</th>
										<?php if($_SESSION['TipoUsuario'] == 2){
											echo "<th>Proceso</th>";
										} ?>
										<th>Empresa</th>
										<th>Estado</th>										
										<th>Acción</th>
                                    </tr>
                                </tfoot>
                                <tbody>
<?php
//require_once('../../Connections/DataConex.php');
$soportecURL = "S";
$condi = 0;
$sesionUsuario = $_SESSION['TipoUsuario'];
if($sesionUsuario != 4 )  // SA  => Muestra todos los clientes.
{
	if($_SESSION['TipoUsuario'] == 2 )  // 2.Abogado => Solo mostrarà los clientes del abogado
	{
		$condi = $_SESSION['IdUsuario']; 
	}
	else // 1.Admin => Mostrarà todos los clientes de la empresa a la cual pertenece el usuario
	{
		$condi = $_SESSION['IdEmpresa']; 
	}
}
$url  = urlServicios."consultadetalle/consultadetalle_Cliente.php?IdMostrar=0&p2=$sesionUsuario&p3=". $condi ."&p4=1" ;
$existe      = "";
$usulocal    = "";
$siguex      = "";
//echo("<script>console.log('PHP cli: ".$url."');</script>");
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

    $mcliente =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $mcliente = json_decode($mcliente, true);
    //echo("<script>console.log('PHP: ".print_r($mcliente)."');</script>");
    //echo("<script>console.log('PHP: ".count($m['cli_cliente'])."');</script>");
    
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
    $mcliente = json_decode($resultado, true);	        
} 
if( $mcliente['estado'] < 2)
{
    for($i=0; $i<count($mcliente['cli_cliente']); $i++)
    {
        $NombreUsuario = trim(strtoupper($mcliente['cli_cliente'][$i]['NombreUsuario']));
        $archivo = $NombreUsuario.".php";
        $idTabla = $mcliente['cli_cliente'][$i]['CLI_IdCliente'];
        $Email = trim($mcliente['cli_cliente'][$i]['CLI_Email']);
        $Direccion = trim(strtoupper($mcliente['cli_cliente'][$i]['CLI_Direccion']));
		$Celular = trim($mcliente['cli_cliente'][$i]['CLI_Celular']);
        $EstadoUsuario = $mcliente['cli_cliente'][$i]['EstadoUsuario'];
        $NombreEmpresa = trim(strtoupper($mcliente['cli_cliente'][$i]['NombreEmpresa']));
        $Identificacion = trim($mcliente['cli_cliente'][$i]['CLI_Identificacion']);
		if($_SESSION['TipoUsuario'] == 2){
			$Proceso = trim($mcliente['cli_cliente'][$i]['PRO_NumeroProceso']);
		}
    ?>
        <tr>
            <td>
				<!-- <a href="javascript:void(0);" onclick="cambiar('../pages/forms/editar<?php echo $nombre_lnk; ?>.php?f=<?php //echo $idTabla; ?>')" class="nav nav-tabs nav-stacked" data-toggle="modal" data-target="#defaultModalEditar" style="text-decoration:none;"><?php //echo $NombreUsuario; ?></a> -->
				<a href="javascript:void(0);" onclick="editar(<?php echo $idTabla; ?>)"><?php echo $NombreUsuario; ?></a>
            </td>
            <td><?php echo $Identificacion; ?></td>        
            <td><?php echo $Email; ?></td>
            <td><?php echo $Direccion; ?></td>
			<td><?php echo $Celular; ?></td>
			<?php if($_SESSION['TipoUsuario'] == 2){
				echo "<td>$Proceso</td>";
			} ?>
			<td><?php echo $NombreEmpresa; ?></td>
            <td><?php echo $EstadoUsuario; ?></td>
			<td>
				<a href="javascript:void(0);" onclick='borraremp(<?php echo $idTabla; ?>,"<?php echo $NombreUsuario; ?>");'>
					<img src="../../images/borrar.png" width="25" height="25">
				</a>
			</td>
        </tr>
    <?php                          
    } 
}
?>
 </tbody>
</table>                                          
                               
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
					<object class="xmodal-content" type="text/html" 
					style="padding :0px; position: relative; height: 77vh; max-height:77vh; bottom:0; overflow: hidden; margin: 0;" 
					data="../pages/forms/editar<?php echo $nombre_lnk ;?>.php" id="carga" ></object>
				</div>

				<div class="modal-footer">
											
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
					<object 
						style="padding :0px; position: relative; height: 77vh; max-height:77vh; bottom:0; overflow: hidden; margin: 0;" 
						type="text/html" data="../pages/forms/form-validationBase<?php echo $nombre_lnk ;?>.php" id="crear">
					</object>
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
    $(document).ready(function () {	 
    	$("#cerrarModal").click(function(){
    	 	 window.location="cli_<?php echo $nombre_lnk; ?>.php";
    	});

    	$("#cerrarModalC").click(function(){
    	 	 window.location="cli_<?php echo $nombre_lnk; ?>.php";
    	});
		
		$("#nuevo").on("click", function(){        
			window.location = 'cli_clienteforma.php';
		});
    });

	function editar(id) 
	{    	
		$.post('../forms/cli_clienteedita.php', { 'id': id }, function (result) {
			WinId = window.open('','_self');
			WinId.document.open();
			WinId.document.write(result);
			WinId.document.close();
		});
	}

	function borraremp(id, nom){
		var idtabla  = id;        
		var nomtabla = nom;	

		swal({
			title: "Está seguro?",
			text: "El registro no podrá ser recuperado!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Borrar Registro!",
			cancelButtonText: "Cancelar borrado!",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm) {
			var respstr = "";
			if (isConfirm) {
				$.ajax({
                    data : {"pidtabla": idtabla},
                    type: "POST",
                    dataType: "html",
                    url : "../forms/borrar_<?php echo $nombre_lnk; ?>.php",
                })
				.done(function( dataX, textStatus, jqXHR ){                       
                    var xrespstr = dataX.trim();
                    respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);        
                    
					if( respstr == "S" )
					{						
						setTimeout(function() {
							swal({
								title: "Atencion",
								text: "Registro ha sido borrado.",
								type: "success",
								confirmButtonText: "Ok"
							}, function() {
								window.location = "cli_cliente.php";
							}, 1000);
						});
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
			else {
				swal("Cancelando ...", "Registro no borrado", "error");
			}
		});			
	}

    function cambiar(nuevaurl) 
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