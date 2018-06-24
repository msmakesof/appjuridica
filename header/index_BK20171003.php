<?php 
require_once('../Connections/cnn_kn.php'); 
require_once('../Connections/config2.php'); 
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

$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

date_default_timezone_set('America/Bogota');
setlocale(LC_ALL,"es_ES");

$script_tz = date_default_timezone_get();
//echo "zona horario.....$script_tz<br>";
//echo strftime("El año es %Y y el mes es %B");

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_mes = "SELECT * FROM controlmesactual WHERE MONTH(fechaMes) = MONTH(NOW()) ;" ;
$rs_mes = mysqli_query($cnn_kn, $query_rs_mes) or die(mysqli_error()."Err.....$query_rs_mes");
$row_rs_mes = mysqli_fetch_assoc($rs_mes);
$totalRows_rs_mes = mysqli_num_rows($rs_mes);
if ( $totalRows_rs_mes == 0)
{
    $insertSQL = "INSERT INTO controlmesactual (IdMes, NombreMes, numeroMes, fechaMes, estadoMes) VALUES (0, '', MONTH(Now()), Now(), 'I');";
    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");
}

$updSQL = "UPDATE controlmesactual SET estadoMes = 'A', fechaMes = Now() WHERE MONTH(fechaMes) = MONTH(NOW());";
mysqli_select_db($cnn_kn, $database_cnn_kn);    
$Result1 = mysqli_query($cnn_kn, $updSQL) or die(mysqli_error()."Err....$updSQL<br>");
mysqli_free_result($rs_mes);

$nombremes = "";
$yy = "";
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_mesx = "SELECT * FROM controlmesactual WHERE MONTH(fechaMes) = MONTH(NOW()) AND estadoMes = 'A';" ;
$rs_mesx = mysqli_query($cnn_kn, $query_rs_mesx) or die(mysqli_error()."Err.....$query_rs_mesx");
$row_rs_mesx = mysqli_fetch_assoc($rs_mesx);
$totalRows_rs_mesx = mysqli_num_rows($rs_mesx);
//echo $query_rs_mesx;
if ( $totalRows_rs_mesx > 0)
{
    $yy = substr($row_rs_mesx['fechaMes'],0,4);
    $nromes = $row_rs_mesx['numeroMes'];
    switch ($nromes)
    {
        case '1':
            $nombremes = "Enero";
            break;
        
        case '2':
            $nombremes = "Febrero";
            break;

        case '3':
            $nombremes = "Marzo";
            break;

        case '4':
            $nombremes = "Abril";
            break;
            
        case '5':
            $nombremes = "Mayo";
            break;
            
         case '6':
            $nombremes = "Junio";
            break;
            
        case '7':
            $nombremes = "Julio";
            break;
            
        case '8':
            $nombremes = "Agosto";
            break;
            
        case '9':
            $nombremes = "Septiembre";
            break;

        case '10':
            $nombremes = "Octubre";
            break;

        case '11':
            $nombremes = "Noviembre";
            break;

        case '12':
            $nombremes = "Diciembre";
            break;
    }    
}
echo $nombremes;
mysqli_free_result($rs_mesx);

if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
}

$nombre = "";
$email  = "";

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
        while($strowreg = mysqli_fetch_assoc($resultado))
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



// clases
$cantclases = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_ctabla = "SELECT count(IdClase) as cantclases FROM clases WHERE Estado = 1 AND MONTH(hasta) = MONTH(NOW());";
$rs_tipo_ctabla = mysqli_query($cnn_kn,$query_rs_tipo_ctabla) or die(mysqli_error()."$query_rs_tipo_ctabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_ctabla = mysqli_fetch_assoc($rs_tipo_ctabla);
$cantclases = $row_rs_tipo_ctabla['cantclases'];
mysqli_free_result($rs_tipo_ctabla);


// Alumnos
$cantest = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_etabla = "SELECT count(IdEstudiante) as cantest FROM estudiante WHERE Estado_EST = 1 ;";
$rs_tipo_etabla = mysqli_query($cnn_kn,$query_rs_tipo_etabla) or die(mysqli_error()."$query_rs_tipo_etabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_etabla = mysqli_fetch_assoc($rs_tipo_etabla);
$cantest = $row_rs_tipo_etabla['cantest'];
mysqli_free_result($rs_tipo_etabla);

// Profesores
$cantpro = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_ptabla = "SELECT count(IdProfesor) as cantpro FROM profesores WHERE Estado_PRO = 1 ;";
$rs_tipo_ptabla = mysqli_query($cnn_kn,$query_rs_tipo_ptabla) or die(mysqli_error()."$query_rs_tipo_ptabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_ptabla = mysqli_fetch_assoc($rs_tipo_ptabla);
$cantpro = $row_rs_tipo_ptabla['cantpro'];
mysqli_free_result($rs_tipo_ptabla);


//horarios
$canthor = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_htabla = "SELECT count(IdHorario) as canthor FROM horario WHERE Estado = 1 ;";
$rs_tipo_htabla = mysqli_query($cnn_kn,$query_rs_tipo_htabla) or die(mysqli_error()."$query_rs_tipo_htabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_htabla = mysqli_fetch_assoc($rs_tipo_htabla);
$canthor = $row_rs_tipo_htabla['canthor'];
mysqli_free_result($rs_tipo_htabla);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bienvenido a | ConIngles Administrador</title>
    <!-- Favicon-->
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    
    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>   
   
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
                <a class="navbar-brand" href="../index.html">
                    <img src="../images/logomintxt.png" style="margin-top: -10px;">
                </a>
            </div>
            <!--  Notificaciones
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    < Call Search >
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    < #END# Call Search >
                    < Notifications >
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
                    < #END# Notifications >
                    < Tasks >
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
                    < #END# Tasks >
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
            Fin Notificaciones -->

        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">

                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <script type="text/javascript">
                        var jsNombre = "";
                        $(document).ready(function(){
                            var name = sessionStorage.getItem("Trojan");
                            $.post("../valida_usuario.php", {pusuario: name}, function(result){
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
                            $.post("../valida_usuario.php", {pusuario: name}, function(result){
                                var respstr = result;            
                                var y = JSON.parse(respstr);
                                jsEmail = y[0];
                                $("#xMail").html(jsEmail);                         
                            });
                        });                     
                        </script>
                        <span id="xMail"></span>
                    </div>
                    
                    <!-- <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo trim($nombre); ?></div> 
                    <div class="email"><?php echo trim($email); ?></div>-->
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>
                            <!-- <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Seguimientos</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Tareas</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">book</i>Notificaciones</a></li>
                            <li role="seperator" class="divider"></li> -->
                            <li><a href="../index.html"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENÚ de NAVEGACIÓN</li>
                    <li class="active">
                        <a href="#">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <!-- 
                    <li>
                        <a href="">
                            <i class="material-icons">text_fields</i>
                            <span>Módulo Usuarios</span>
                        </a>
                    </li>
                   
                    <li>
                        <a href="pages/helper-classes.html">
                            <i class="material-icons">layers</i>
                            <span>Helper Classes</span>
                        </a>
                    </li>
                    -->                  
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Módulo de Administración</span>
                        </a>
                        <ul class="ml-menu">
                        <?php
                            mysqli_select_db($cnn_kn, $database_cnn_kn);
                            $query_rs_ntipo_tabla = "SELECT Nombre_Tabla FROM gen_tablas WHERE Id_EstadoTabla = 1 ORDER BY Nombre_Tabla;"; 
                            $rs_ntipo_tabla = mysqli_query($cnn_kn,$query_rs_ntipo_tabla) or die(mysql_error()."$query_rs_ntipo_tabla");
                            $row_rs_ntipo_tabla = mysqli_fetch_assoc($rs_ntipo_tabla);
                            //Cantidad de registros
                            $cantidad_rs_ntipo_tabla = mysqli_num_rows($rs_ntipo_tabla);
                            
                            $nombre_Tabla = "";
                            $clase = "";
                            $NombreArchivo = basename($_SERVER['PHP_SELF'],".php");
                            do{
                                $NombreTablaMenu = trim($row_rs_ntipo_tabla['Nombre_Tabla']);                           
                                $archivo = "../pages/tables/".$NombreTablaMenu.".php"; 
                                if( strtoupper($NombreArchivo) == strtoupper($NombreTablaMenu) )
                                { 
                                    $clase = "class='active'"; 
                                }
                                else
                                {
                                    $clase = "";    
                                }
                                ?>

                                <li <?php echo $clase ;?> >
                                    <a href="<?php echo $archivo; ?>"><?php echo strtoupper($NombreTablaMenu); ?></a>
                                </li>
                                <?php                          
                            } while($row_rs_ntipo_tabla = mysqli_fetch_assoc($rs_ntipo_tabla));     
                            mysqli_free_result($rs_ntipo_tabla);
                        ?>   

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Módulo Clases</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../pages/tables/clases.php" class="menu-toggle">
                                    <span>Programación de Clases</span>
                                </a>                               

                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Módulo de Estadísticas</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">Indicadores</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Gráficas</a>
                            </li>
                            <li>
                                <a href="../pages/charts/chartjs.php">Estadísticas</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Reportes</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Otros</a>
                            </li>
                        </ul>
                    </li>
                    <!--
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Example Pages</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/examples/sign-in.html">Sign In</a>
                            </li>
                            <li>
                                <a href="pages/examples/sign-up.html">Sign Up</a>
                            </li>
                            <li>
                                <a href="pages/examples/forgot-password.html">Forgot Password</a>
                            </li>
                            <li>
                                <a href="pages/examples/blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="pages/examples/404.html">404 - Not Found</a>
                            </li>
                            <li>
                                <a href="pages/examples/500.html">500 - Server Error</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">map</i>
                            <span>Maps</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/maps/google.html">Google Map</a>
                            </li>
                            <li>
                                <a href="pages/maps/yandex.html">YandexMap</a>
                            </li>
                            <li>
                                <a href="pages/maps/jvectormap.html">jVectorMap</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">trending_down</i>
                            <span>Multi Level Menu</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item - 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 2</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Menu Item</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle">
                                            <span>Level - 3</span>
                                        </a>
                                        <ul class="ml-menu">
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Level - 4</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages/changelogs.html">
                            <i class="material-icons">update</i>
                            <span>Changelogs</span>
                        </a>
                    </li>
                    -->
                    <li class="header">       </li>

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 <a href="javascript:void(0);"> Administrador - ConIngles</a>.
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
                            <div class="text">CLASES PROGRAMADAS: <?php echo $nombremes. ' de '.$yy ;?> </div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $cantclases; ?>" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">ALUMNOS Activos</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $cantest; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">PROFESORES Activos</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $cantpro; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">HORARIOS Activos</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $canthor; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Alumnos Inscritos (%)</h2>
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
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
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
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-pink">
                            <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                                 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                                 data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                                 data-fill-Color="rgba(0, 188, 212, 0)">
                                12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                            </div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    HOY
                                    <span class="pull-right"><b>Asistencia Alumnos 2</b> <small>Usos</small></span>
                                </li>
                                <li>
                                    AYER
                                    <span class="pull-right"><b>Asistencia Alumnos 8</b> <small>Usos</small></span>
                                </li>
                                <li>
                                    SEMANA PASADA
                                    <span class="pull-right"><b>Asistencia Alumnos 1</b> <small>Usos</small></span>
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
                            <div class="m-b--35 font-bold">ULTIMOS NIVELES</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    INTRODUCCION
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                                <li>
                                    VOCABULARIO
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                                <li>CONVERSACIONES</li>
                                <li>LECTURAS</li>
                                <li>AUDIOVISUALES</li>
                                <li>
                                    GESTION TIEMPOS
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">CONTROL DE DOCUMENTOS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    HOY
                                    <span class="pull-right"><b>2</b> <small>LEGISLACIONES</small></span>
                                </li>
                                <li>
                                    AYER
                                    <span class="pull-right"><b>5</b> <small>CERTIFICACIONES</small></span>
                                </li>
                                <li>
                                    ULTIMA SEMANA
                                    <span class="pull-right"><b>9</b> <small>POLIZAS</small></span>
                                </li>
                                <li>
                                    ULTIMO MES
                                    <span class="pull-right"><b>42</b> <small>DOCUMENTOS GENERALES</small></span>
                                </li>
                                <li>
                                    ULTIMO AÑO
                                    <span class="pull-right"><b>225</b> <small>NOVEDADES</small></span>
                                </li>
                                <li>
                                    TODAS
                                    <span class="pull-right"><b> 752</b> <small></small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>INFORMACION DE TAREAS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
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
                                            <th>Tarea</th>
                                            <th>Estado</th>
                                            <th>Encargado</th>
                                            <th>Avance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Tarea A</td>
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
                                            <td>Tarea B</td>
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
                                            <td>Tarea C</td>
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
                                            <td>Tarea D</td>
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
                                            <td>Tarea E</td>
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
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </section>

   

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="../plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="../plugins/flot-charts/jquery.flot.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>