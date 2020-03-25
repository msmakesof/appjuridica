<?php
ob_start();
session_start();
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
//if(!isset($_SESSION)) {}

if( !isset($_SESSION['IdUsuario']) && !isset($_SESSION['NombreUsuario']) )
{
	header("Location: ../../index.html");
    exit;
} 
//ob_start(); 
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
$empresa = "AppJuridica";
if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
 }
$nombre_lnk = "contactoempresa";
$nombre = "";
$email  = "";
$usuario ="";
if( isset($_POST['ƒ×']) && !empty($_POST['ƒ×']) )
{    
     $usuario = trim($_POST['ƒ×']);   
}
if( isset($_POST['id']) && !empty($_POST['id']) )
{    
    $pid = trim($_POST['id']);   
}
if( isset($_POST['ne']) && !empty($_POST['ne']) )
{    
    $pne = trim($_POST['ne']);   
}
if( isset($_POST['ie']) && !empty($_POST['ie']) )
{    
    $pie = trim($_POST['ie']);   
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
                <a class="navbar-brand" href="../../index.html">
                <img src="../../images/logomw.fw.png" style="margin-top: -10px;">
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
                    <img src="../../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                        
                        <span id="xNom"><?php echo $_SESSION["NombreUsuario"]; ?></span>                   
                    </div>

                    <div class="email">                       
                        <span id="xMail"><?php echo $_SESSION["EmailUsuario"]; ?></span>
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
            <?php require_once('menu.php'); 
			//echo dirname($_SERVER['PHP_SELF'])."/../";
			//echo require __DIR__."/../";
			//	include("/../../menu/menu.php");
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
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    INFORMACION CONTACTO <?php echo strtoupper($nombre_lnk); ?>: <?php echo strtoupper($pne); ?>
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
											
											<a id="nuevo" class="btn btn-warning btn-xs waves-effect" style="color:red" onclick="addiContacto(<?php echo $pid;?>,'<?php echo $pne; ?>', <?php echo $pie ;?>)" >
												<i class="material-icons" style="color:red">assignment</i>Nuevo
											</a>
																						
                                        </li>
										<li>
											<a id="salir" class="btn btn-default btn-xs waves-effect">
												<i class="material-icons">input</i>Salir
											</a>
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
										<th>Tipo Documento</th>
										<th>Identificaci&oacute;n</th>
                                        <th>Email</th>
                                        <th>Celular</th>
										<th>Estado</th>										
										<th>Borrar.</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>										
										<th>Tipo Documento</th>
										<th>Identificaci&oacute;n</th>                                        
                                        <th>Email</th>
                                        <th>Celular</th>
										<th>Estado</th>										
										<th>Borrar</th>
                                    </tr>
                                </tfoot>
                                <tbody>
<?php
require_once('../../Connections/DataConex.php');
$soportecURL = "S";
$url         = urlServicios."consultadetalle/consultadetalle_ContactoEmpresa.php?IdMostrar=0";
$existe      = "";
$usulocal    = "";
$siguex      = "";
//echo("<script>console.log('PHP: ".$url."');</script>");
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

    $mempresa =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $mempresa = json_decode($mempresa, true);
    //echo("<script>console.log('PHP: ".print_r($mempresa)."');</script>");
    //echo("<script>console.log('PHP: ".count($m['emp_empresa'])."');</script>");
    
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
    $mempresa = json_decode($resultado, true);	        
} 
if( $mempresa['estado'] < 2)
{
    for($i=0; $i<count($mempresa['emp_contactoempresa']); $i++)
    {
        $NombreUsuario = trim($mempresa['emp_contactoempresa'][$i]['NombreUsuario']);		
        $archivo = $NombreUsuario.".php";
        $idTabla = $mempresa['emp_contactoempresa'][$i]['COE_IdContacto'];
		$IdEmpresa = $mempresa['emp_contactoempresa'][$i]['COE_IdEmpresa'];		
		$Identificacion = $mempresa['emp_contactoempresa'][$i]['COE_Identificacion'];
		$Email = trim($mempresa['emp_contactoempresa'][$i]['COE_Email']);
		$Celular = trim($mempresa['emp_contactoempresa'][$i]['COE_Celular']);
        $Estado = $mempresa['emp_contactoempresa'][$i]['NombreEstado'];
		$TipoDocumento = $mempresa['emp_contactoempresa'][$i]['COE_IdTipoDocumento'];
		$NombreDocumento = $mempresa['emp_contactoempresa'][$i]['TDO_Nombre'];
    ?>
        <tr>
            <td>				
				<a href="javascript:void(0);" onclick="editar(<?php echo $idTabla; ?>,<?php echo $pie; ?>,'<?php echo $pne; ?>')"><?php echo $NombreUsuario; ?></a>
            </td>			
            <td><?php echo $NombreDocumento; ?></td>
			<td><?php echo $Identificacion; ?></td>
			<td><?php echo $Email; ?></td>
            <td><?php echo $Celular; ?></td>
            <td><?php echo $Estado; ?></td>			
			<td>
				<a href="javascript:void(0);" onclick='borraremp(<?php echo $idTabla; ?>,"<?php echo $NombreUsuario; ?>")'>
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
					data="../forms/editar<?php echo $nombre_lnk ;?>.php" id="carga" ></object>
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
						type="text/html" data="../forms/form-validationBase<?php echo $nombre_lnk ;?>.php" id="crear">
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
    });

	$("#xnuevo").on("click", function(){        
        window.location = 'emp_adicontacto.php';
    });
	$("#salir").on("click", function(){        
        window.location = 'emp_empresa.php';
    });

	function editar(id, ie, ne) 
	{    	
		$.post('../forms/editarcontacto.php', { 'id': id, 'ie': ie, 'ne': ne }, function (result) {
			WinId = window.open('','_self');
			WinId.document.open();
			WinId.document.write(result);
			WinId.document.close();
		});
	}
	
	function addiContacto(id, ne, ie) 
	{    	
		$.post('emp_adicontacto.php', { 'id': id, 'ne' : ne, 'ie': ie }, function (result) {
			WinId = window.open('','_self');
			WinId.document.open();
			WinId.document.write(result);
			WinId.document.close();
		});
	}
	
	function retornar(id, ie, ne){
		$.post('emp_contactoempresa.php', { 'id': id, 'ie': ie, 'ne': ne }, function (result) {				
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
								var id = <?php echo $idTabla; ?>;
								var ie = <?php echo $pie; ?>;
								var ne = "<?php echo $pne; ?>";								
								retornar(id, ie, ne);
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
<?php ob_end_flush(); ?>