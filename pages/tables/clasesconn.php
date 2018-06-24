<?php 
require_once('../../Connections/cnn_kn.php'); 
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

if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
 }
$nombre_lnk = "clases";
$nombre = "";
$email  = "";

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_nivel_tabla = "SELECT NombreNivel, IdNivel FROM nivel WHERE Estado = 1 ORDER BY NombreNivel;"; 
$rs_nivel_tabla = mysqli_query($cnn_kn,$query_rs_nivel_tabla) or die(mysql_error()."$query_rs_nivel_tabla");
$row_rs_nivel_tabla = mysqli_fetch_assoc($rs_nivel_tabla);


if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
{    
    $usuario = trim($_POST['ƒ×']);
	
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_usuario = "SELECT CONCAT_WS(' ',Nombre_usuario,Apellido1_usuario,Apellido2_usuario) Nombre, Email_usuario 
FROM gen_usuarios WHERE IdActivo_usuario = 1 AND Email_usuario = '$usuario' ;" ;
$rs_usuario = mysqli_query($cnn_kn, $query_rs_usuario) or die(mysqli_error()."Err.....$query_rs_usuario");
$row_rs_usuario = mysqli_fetch_assoc($rs_usuario);
$totalRows_rs_usuario = mysqli_num_rows($rs_usuario);
	$y = "";
	
	if ($resultado = mysqli_query($cnn_kn, $query_rs_usuario)) 
	{
		while($all = mysqli_fetch_assoc($resultado))
		{
			$nombre = $strowreg['Nombre'];
			$email = $strowreg['Email_usuario'];           
		}
	}
	mysqli_free_result($rs_usuario);
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
    <title>.:: ConIngles  |  Información Principal ::.</title>
    <!-- Favicon-->
    <link rel="icon" href="../../images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
   

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.min.css" />
    

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

    <link rel="stylesheet/less" href="../../bselect-development/src/bselect.less" />        
    <link rel="stylesheet" type="text/css" href="../../bselect-development/support/styles/prettify.css">


    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />


    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>    

   <style>
    object{
       width:100%;
       height:390px ;  
	}

    

    /*#filtro option:hover {
      color: #f4a742 !important ; 
      box-shadow: inset 20px 20px #00f !important;
    }*/

    select:hover {
color: #444645;
background: #ddd;
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
                <img src="../../images/logomintxt.png" style="margin-top: -10px;">
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
                        <script type="text/javascript">
                        var jsNombre = "";
                        $(document).ready(function(){
                            var name = sessionStorage.getItem("Trojan");
                            $.post("../../valida_usuario.php", {pusuario: name}, function(result){
                                var respstr = result;            
                                var y = JSON.parse(respstr);
                                jsNombre = y[1]; 
                                $("#xNom").html(jsNombre);
                            });
                        });                    
                        </script>
                        <span id="xNom"></span>                   
                    </div>


                    <div class="email">
                        <script type="text/javascript">
                        var jsEmail = "";
                        $(document).ready(function(){
                            var name = sessionStorage.getItem("Trojan");
                            $.post("../../valida_usuario.php", {pusuario: name}, function(result){
                                var respstr = result;            
                                var y = JSON.parse(respstr);
                                jsEmail = y[0];
                                $("#xMail").html(jsEmail);                         
                            });
                        });                     
                        </script>
                        <span id="xMail"></span>
                    </div>                   
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
            <div class="menu">
                <ul class="list">
                    <li class="header">MENÚ de NAVEGACIÓN</li>
                    <li>
                        <a href="../../header/index.php">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="../../pages/typography.html">
                            <i class="material-icons">text_fields</i>
                            <span>Módulo Usuarios</span>
                        </a>
                    </li>
					
					<li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Módulo de Administración</span>
                        </a>
                        <ul class="ml-menu">
                        <?php
                        mysqli_select_db($cnn_kn, $database_cnn_kn);
                        $query_rs_ntipo_tabla = "SELECT Nombre_Tabla, NombreMostrar FROM gen_tablas WHERE Id_EstadoTabla = 1 ORDER BY Nombre_Tabla;"; 
                        $rs_ntipo_tabla = mysqli_query($cnn_kn,$query_rs_ntipo_tabla) or die(mysql_error()."$query_rs_ntipo_tabla");
                        $row_rs_ntipo_tabla = mysqli_fetch_assoc($rs_ntipo_tabla);
                        //Cantidad de registros
                        $cantidad_rs_ntipo_tabla = mysqli_num_rows($rs_ntipo_tabla);
                        
                        $nombre_Tabla = "";
						$clase = "";
						$NombreArchivo = basename($_SERVER['PHP_SELF'],".php");
                        do{
                            $NombreTablaMenu = trim($row_rs_ntipo_tabla['Nombre_Tabla']);
                            $NombreMostrar = trim($row_rs_ntipo_tabla['NombreMostrar']);							
                            $archivo = $NombreTablaMenu.".php";	
							if( strtoupper($NombreArchivo) == strtoupper($NombreTablaMenu) )
							{ 
								$clase = "class='active'"; 
							}
							else
							{
								$clase = "";	
							}
                            ?>

                            <li <?php echo $clase ;?>>
                                <a href="<?php echo $archivo; ?>"><?php echo $NombreMostrar; ?></a>
                            </li>
                            <?php                          
                        } while($row_rs_ntipo_tabla = mysqli_fetch_assoc($rs_ntipo_tabla));     
                        mysqli_free_result($rs_ntipo_tabla);
                        ?>   
                           
                        </ul>
                    </li>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Módulo Clases</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="clases.php" class="menu-toggle">
                                    <span>Programación de Clases</span>
                                </a>                               
                                <a href="clasescon.php" class="menu-toggle">
                                    <span>Consulta de Programación</span>
                                </a>
                                <a href="clasesconn.php" class="menu-toggle">
                                    <span>Consulta por Nivel</span>
                                </a>     
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Módulo de Estadísticas.</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">Indicadores</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Gráficas</a>
                            </li>
                            <li>
                                <a href="../charts/chartjs.php">Estadísticas</a>
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
                    &copy; 2017 <a href="javascript:void(0);">Administrador - ConIngles</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    CONSULTA PROGRAMACION POR NIVEL
                    <small>Opciones: <a href="#" target="_blank">consultar.</a></small>
                </h2>
            </div>
            

            <!-- <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card" style="height: 500px;">      
                
                <div class="row-form clearfix">                  
                    <div class="row">
                        <div class="span6">                 
                            <select class="languages span5" id="bselect-standard">
                                <option value="">Select an option</option>
                                <option value="Ada">Ada</option>
                                <option value="C">C</option>
                                <option value="C#">C#</option>
                                <option value="C++">C++</option>
                                <option value="C++">CoffeeScript</option>
                                <option value="Dart">Dart</option>
                                <option value="Delphi">Delphi</option>
                                <option value="Erlang">Erlang</option>
                                <option value="F#">F#</option>
                                <option value="FORTRAN">FORTRAN</option>
                                <option value="Go">Go</option>
                                <option value="Haskell">Haskell</option>
                                <option value="Java">Java</option>
                                <option value="JavaScript">JavaScript</option>
                                <option value="Kotlin">Kotlin</option>
                                <option value="Lisp">Lisp</option>
                                <option value="Lua">Lua</option>
                                <option value="MATLAB">MATLAB</option>
                                <option value="Objective-C">Objective-C</option>
                                <option value="Pascal">Pascal</option>
                                <option value="Perl">Perl</option>
                                <option value="PHP">PHP</option>
                                <option value="Python">Python</option>
                                <option value="Ruby">Ruby</option>
                                <option value="Scala">Scala</option>
                                <option value="Shell">Shell</option>
                                <option value="Tcl">Tcl</option>
                                <option value="Visual Basic">Visual Basic</option>
                            </select>
                        </div>
                    </div>        
                </div>
            </div>
            </div>
            </div> -->


            <!-- Exportable Table -->
            <div class="row clearfix">
            <div class="card" style="height: 500px;">  
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          
                       <!-- --><div class="body table-responsive" id="zonaquery" style="height: 500px;">
                                        
                             <div class="block-fluid">
                                <div class="row-form clearfix">   
                                    <div class="controls"> 

                                        <div class="span6">
                                            <label for="bselect-standard">Filtro</label> 
                                            <select class="selectpicker" data-show-subtext="true" data-live-search="true" data-style="btn-info" id="filtro">
                                                <option value="">Seleccione una opcion</option>
                                                <option value="N">Nivel</option>
                                                <option value="F">Franja Horario</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                             </div>   
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>


 <!-- Default Size -->
<!--             <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" >
                        <div class="modal-header">
                            
                        </div>
                        
                        <div class="modal-body">                         
                            <object type="text/html" data="../forms/form-validationBase<?php echo $nombre_lnk; ?>.php" id="crear"></object>
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="cerrarModalC">CERRAR Crear.</button>
                        </div>
                    </div>
                </div>
            </div> -->


    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>    

    <!-- Select Plugin Js -->    
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.3.3/less.min.js"></script>
    <script src="../../bselect-development/src/bselect.js"></script>
    <!-- <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script> --> 
    <script src="../../bselect-development/support/scripts/prettify.js"></script>
    <script src="../../bselect-development/support/scripts/example.js"></script>

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

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function () {	 
    	$("#cerrarModal").click(function(){
    	 	 window.location="<?php echo $nombre_lnk; ?>.php";
    	});

    	$("#cerrarModalC").click(function(){
    	 	 window.location="<?php echo $nombre_lnk; ?>.php";
    	});
       
    });     

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
<?php 
mysqli_free_result($rs_nivel_tabla);
?>