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

$coo_User = $_COOKIE['okuser_xc'];
if ($coo_User == "")
{
  header("Location: ../../"); /* Redirect browser */
  exit();  
}
//echo "<br><br><br><br><br><br><br><br><br><br><br><br>cook....$coo_User";

if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
}

$nombre_lnk = "clasesp";
$nombre = "";
$email  = "";
$idE = "";
if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
{    
    $usuario = trim($_POST['ƒ×']);    
}
else
{
    $usuario ="";
}

$idestudiante = 0;
if($usuario != "" || $coo_User != "")
{
    if($coo_User != "" )
    {
        $usuario = $coo_User;
    }    
    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_usuario = "SELECT CONCAT_WS(' ',Nombres_PRO,Apellido1_PRO,Apellido2_PRO) Nombre, Email_PRO, IdProfesor FROM profesores WHERE Estado_PRO = 1 AND Email_PRO = '$usuario' ;" ;
    //AND  Clave_EST = '$clave'
    $rs_usuario = mysqli_query($cnn_kn, $query_rs_usuario) or die(mysqli_error()."Err.....$query_rs_usuario");
    $row_rs_usuario = mysqli_fetch_assoc($rs_usuario);
    $totalRows_rs_usuario = mysqli_num_rows($rs_usuario);
    
    //echo "<br><br><br><br><br><br>---usurio...........$query_rs_usuario<br>";
    //if($totalRows_rs_usuario == 1)
    //{
        //do{
            $nombre = $row_rs_usuario['Nombre'];
            $email = $row_rs_usuario['Email_PRO'];   
            $idestudiante = $row_rs_usuario['IdProfesor'];
        //} while ($row_rs_usuario = mysqli_fetch_assoc($rs_usuario));
    //}    
    mysqli_free_result($rs_usuario);
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
                        <!-- <script type="text/javascript">
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
                        </script> -->
                        <span id="xNom"><?php echo $nombre; ?></span>                   
                    </div>


                    <div class="email">
                        <!-- <script type="text/javascript">
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
                        </script> -->
                        <span id="xMail"><?php echo $email; ?></span>
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
            <div class="menu">
                <ul class="list">
                    <li class="header">MENÚ de NAVEGACIÓN</li>
                    
                   <!--  <li>
                        <a href="#">
                            <i class="material-icons">text_fields</i>
                            <span>Módulo Usuarios</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="../../header/indexep.php">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>

                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Módulo Clases</span>
                        </a>
                        <ul class="ml-menu">
                            <!-- <li>
                                <a href="clasese.php" class="menu-toggle">
                                    <span>Reservación de Clases</span>
                                </a>
                            </li> -->
                           <!--  <li>
                                <a href="clasesea.php" class="menu-toggle">
                                    <span>Programaciones Anteriores</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="clasesp.php" class="menu-toggle">
                                    <span>Ver Programación</span>
                                </a>
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
        <!-- #END# Left Sidebar -->

    </section>

    <section class="content">
    <div class="body">
        <div class="container-fluid">
        <?php 
        //echo $idestudiante; 
        echo "<object type='text/html' data='claseprofesornivel.php?id=$idestudiante' id='carga' style='height: 780px; width: 100%; margin: 2px;'></object>;"
        ?>            
        </div>
    </div>    
    </section>


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
<?php  ?>
