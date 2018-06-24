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

$coo_User = $_COOKIE['okuser_xc'];
if ($coo_User == "")
{
  header("Location: ../../"); /* Redirect browser */
  exit();  
}

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



//if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
if($usuario != "" || $coo_User != "")
{    
    //if($idestudiante == "")
    //{
    //    header("Location: ../index.html");
    //    die();
    //}


    //$usuario = trim($_POST['ƒ×']);
    if($coo_User != "" )
    {
        $usuario = $coo_User;
    }
    
    mysqli_select_db($cnn_kn, $database_cnn_kn);    
    $query_rs_usuario = "SELECT CONCAT_WS(' ',Nombres_PRO,Apellido1_PRO,Apellido2_PRO) Nombre, Email_PRO, IdProfesor FROM profesores WHERE Estado_PRO = 1 AND Email_PRO = '$usuario' ;" ;
    $rs_usuario = mysqli_query($cnn_kn, $query_rs_usuario) or die(mysqli_error()."Err.....$query_rs_usuario");
    $row_rs_usuario = mysqli_fetch_assoc($rs_usuario);
    $totalRows_rs_usuario = mysqli_num_rows($rs_usuario);
    
    //echo "<br><br><br><br><br><br><br><br><br>..................$query_rs_usuario<br>";
    
    //if ($resultado = mysqli_query($cnn_kn, $query_rs_usuario)) 
    //{
        //while($strowreg = mysqli_fetch_assoc($resultado))
        //{
            //$nombre = $strowreg['Nombre'];
            //$email = $strowreg['Email_usuario'];
            $nombre = strtoupper($row_rs_usuario['Nombre']);
            $email = $row_rs_usuario['Email_PRO'];   
            $idestudiante = $row_rs_usuario['IdProfesor'];
            //echo $nombre;
        //}
    //}
    mysqli_free_result($rs_usuario);

    $cantidadClases = 0;
    $cantidadClaseAsignada = 0;
    $CuposTotal = 0;
    $CuposDisponibles = 0;
    $TotalCuposDisponibles = 0;
    $idClase = 0;
    $cantidadNivelAsignado = 0;
    $reservada ="No";

    // mysqli_select_db($cnn_kn, $database_cnn_kn);
    // $query_rs_tabla = "SELECT estudiante.IdEstudiante, nivelasignado.* , sucursal.NombreSucursal, nivel.NombreNivel, materia.NombreMateria, salon.NombreSalon, CONCAT_WS(' - ', horario.Inicio,horario.final) as NombreHorario, concat_WS(' ', profesores.Nombres_PRO, profesores.Apellido1_PRO) as NombreProfesor, clases.IdClase, clases.IdClase, clases.desde, clases.hasta
    // FROM estudiante 
    // left JOIN nivelasignado ON nivelasignado.IdEstudiante = estudiante.IdEstudiante AND nivelasignado.Estado = 1
    // JOIN clases ON clases.Nivel = nivelasignado.IdNivel  AND clases.hasta > curdate() 
    // JOIN sucursal ON sucursal.IdSucursal = clases.Sede AND sucursal.IdSucursal = estudiante.Sucursal_EST
    // JOIN nivel ON nivel.IdNivel = clases.Nivel
    // JOIN materia ON materia.IdMateria = clases.Materia
    // JOIN salon ON salon.IdSalon = clases.Salon
    // JOIN horario ON horario.IdHorario = clases.Horario
    // JOIN profesores ON profesores.IdProfesor = clases.Profesor
    // WHERE estudiante.IdEstudiante = $idestudiante AND estudiante.Estado_EST = 1;";
    // echo $query_rs_tabla;
    // $rs_tabla = mysqli_query($cnn_kn,$query_rs_tabla) or die(mysqli_error()."$query_rs_tabla");
    // mysqli_set_charset($cnn_kn,"utf8");
    // $row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
    

    // do{
    //     $idClase = $row_rs_tabla['IdClase'];
    // } while ($row_rs_tabla = mysqli_fetch_assoc($rs_tabla));
    // //echo $idClase;
    // mysqli_free_result($rs_tabla);
    //echo "<br><br><br><br><br>";

    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_mesactual = "SELECT controlmesactual.*, mes.NombreMes Mes FROM controlmesactual JOIN mes ON mes.idMes = controlmesactual.numeroMes WHERE estadoMes = 'A' ORDER BY fechaMes DESC LIMIT 1; ";
    $rs_mesactual = mysqli_query($cnn_kn,$query_rs_mesactual) or die(mysqli_error()."$query_rs_mesactual");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_mesactual = mysqli_fetch_assoc($rs_mesactual);
    $nombremes = $row_rs_mesactual['Mes'];
    $fechaMes = $row_rs_mesactual['fechaMes'];
    $y = substr($fechaMes,0,4);    
    mysqli_free_result($rs_mesactual);
    //echo "$query_rs_mesactual<br>";

    
    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_nivelxest = "SELECT MAX(clases.Nivel) cantnivel FROM clases WHERE clases.Profesor = $idestudiante AND clases.Estado = '1' AND '$fechaMes' BETWEEN desde AND hasta;";
    $rs_nivelxest = mysqli_query($cnn_kn,$query_rs_nivelxest) or die(mysqli_error()."$query_rs_nivelxest");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_nivelxest = mysqli_fetch_assoc($rs_nivelxest);
    $cantidadNivelAsignado = $row_rs_nivelxest['cantnivel'];
    mysqli_free_result($rs_nivelxest);
    //echo "$query_rs_nivelxest<br>";

    $NombreNivel ="";
    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_nivel = "SELECT NombreNivel FROM nivel WHERE substring(NombreNivel,1,1) = '2' AND Estado = 1;";
    //echo $query_rs_nivel;
    $rs_nivel = mysqli_query($cnn_kn,$query_rs_nivel) or die(mysqli_error()."$query_rs_nivel");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_nivel = mysqli_fetch_assoc($rs_nivel);
    $totalRows_rs_nivel = mysqli_num_rows($rs_nivel);

    if($totalRows_rs_nivel > 0)
    {
        //$NombreNivel = trim($row_rs_nivel['NombreNivel']);
    }
    mysqli_free_result($rs_nivel);

    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_tipo_tabla = "SELECT count(clasexestudiante.IdEstudiante) as cantclases, clases.IdClase FROM clasexestudiante JOIN clases ON clases.IdClase = clasexestudiante.IdClase AND clases.Estado = 1 WHERE clasexestudiante.IdEstudiante = $idestudiante AND clasexestudiante.Estado = 'A';";
    $rs_tipo_tabla = mysqli_query($cnn_kn,$query_rs_tipo_tabla) or die(mysqli_error()."$query_rs_tipo_tabla");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla);
    //echo $query_rs_tipo_tabla;
    do{
        $cantidadClaseAsignada = $row_rs_tipo_tabla['cantclases'];
        $idClase = $row_rs_tipo_tabla['IdClase'];
        if(is_null($idClase) ){$idClase = 0;}        
        if($cantidadClaseAsignada > 0){$reservada ="Si";}
    } while ($row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla));


    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_cupos = "SELECT DISTINCT count(IdEstudiante) Cantidad FROM clases JOIN clasexestudiante ON clasexestudiante.IdClase = clases.IdClase AND clasexestudiante.Estado = 'A'
WHERE clases.Profesor = $idestudiante AND clases.Estado = 1 AND '$fechaMes' BETWEEN desde AND hasta ;";
    $rs_cupos = mysqli_query($cnn_kn,$query_rs_cupos) or die(mysqli_error()."$query_rs_cupos");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_cupos = mysqli_fetch_assoc($rs_cupos);
    $CuposTotal = $row_rs_cupos['Cantidad'];
    
    mysqli_select_db($cnn_kn, $database_cnn_kn);  
	$query_rs_ctacupos = "SELECT count(clases.Profesor) Cantidad FROM clases 
JOIN clasexestudiante ON clasexestudiante.IdClase = clases.IdClase AND clasexestudiante.Estado = 'A'
WHERE clases.Estado = 1 AND clases.Profesor = $idestudiante AND '$fechaMes' BETWEEN clases.desde AND clases.hasta;";
    //"SELECT count(Profesor) Cantidad FROM clases WHERE Estado = 1 AND Profesor = $idestudiante AND '$fechaMes' BETWEEN desde AND hasta;";    
    $rs_ctacupos = mysqli_query($cnn_kn,$query_rs_ctacupos) or die(mysqli_error()."$query_rs_ctacupos");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_ctacupos = mysqli_fetch_assoc($rs_ctacupos);    
    $TotalProgramadasAlumno = $row_rs_ctacupos['Cantidad'];
    
    //echo "<br><br><br><br><br><br><br><br><br>.............$query_rs_ctacupos";

    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_tipo_ntabla = "SELECT profesores.IdProfesor, concat_WS(' ', profesores.Nombres_PRO, profesores.Apellido1_PRO) as NombreProfesor, sucursal.NombreSucursal, nivel.NombreNivel, materia.NombreMateria, salon.NombreSalon, 
CONCAT_WS(' - ', horario.Inicio,horario.final) as NombreHorario,  
clases.IdClase, clases.desde, clases.hasta, clases.IdEvento 
FROM profesores 
JOIN clases ON profesores.IdProfesor = clases.Profesor AND clases.Estado = 1
JOIN clasexestudiante ON clasexestudiante.IdClase = clases.IdClase AND clasexestudiante.Estado = 'A'
JOIN sucursal ON sucursal.IdSucursal = clases.Sede AND sucursal.IdSucursal = profesores.Sucursal_PRO 
JOIN nivel ON nivel.IdNivel = clases.Nivel 
JOIN materia ON materia.IdMateria = clases.Materia 
JOIN salon ON salon.IdSalon = clases.Salon 
JOIN horario ON horario.IdHorario = clases.Horario 
WHERE profesores.IdProfesor = $idestudiante AND profesores.Estado_PRO = 1 
ORDER BY nivel.NombreNivel, clases.desde, clases.hasta; ";
    $rs_tipo_ntabla = mysqli_query($cnn_kn,$query_rs_tipo_ntabla) or die(mysqli_error()."$query_rs_tipo_ntabla");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_tipo_ntabla = mysqli_fetch_assoc($rs_tipo_ntabla);  
    $totalRows_tipo_ntabla = mysqli_num_rows($rs_tipo_ntabla);  
    $NombreNivel = trim($row_rs_tipo_ntabla['NombreNivel']);  
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
                       <!--  <script type="text/javascript">
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
                        </script> -->
                        <span id="xNom"><?php echo $nombre; ?></span>                   
                    </div>


                    <div class="email">
                       <!--  <script type="text/javascript">
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
                        </script> -->
                        <span id="xMail"><?php echo $email; ?></span>
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
           <!--  <div class="menu">
                <ul class="list">
                    <li class="header">MENÚ de NAVEGACIÓN</li>
                    <li class="active">
                        <a href="#">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="material-icons">text_fields</i>
                            <span>Módulo Usuarios</span>
                        </a>
                    </li>                  


                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Módulo Clases</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../pages/tables/clasese.php" class="menu-toggle">
                                    <span>Programación de Clases</span>
                                </a>                               

                            </li>
                        </ul>
                    </li>                   

                    <li class="header"></li>

                </ul>
            </div> -->
            <!-- #Menu -->
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
                        <a href="">
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
                                <a href="../pages/tables/clasese.php" class="menu-toggle">
                                    <span>Reservación de Clases</span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="../pages/tables/clasesea.php" class="menu-toggle">
                                    <span>Programaciones Anteriores</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="../pages/tables/clasesp.php" class="menu-toggle">
                                    <span>Ver Programación</span>
                                </a>
                            </li> 
                            <li>
                                <!-- <a href="../pages/tables/clasesea.php" class="menu-toggle">
                                    <span>Programaciones Anteriores</span>
                                </a> -->
                                &nbsp;
                            </li>
                            <li>
                                <!-- <a href="../pages/tables/clasesea.php" class="menu-toggle">
                                    <span>Programaciones Anteriores</span>
                                </a> -->
                                &nbsp;
                            </li>
                        </ul>
                    </li> 

                    <li class="active">
                        <ul class="ml-menu">
                            <li>
                                <!-- <a href="../pages/tables/clasesea.php" class="menu-toggle">
                                    <span>Programaciones Anteriores</span>
                                </a> -->
                                &nbsp;
                            </li>
                        </ul>
                    </li>     
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
                <h2>:: TABLERO DE INFORMACIÓN para: <?php echo $nombremes .' de '.$y ;?></h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">NIVEL ASIGNADO: <?php echo $NombreNivel; ?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $cantidadNivelAsignado; ?>" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">CLASES PROGRAMADAS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $TotalProgramadasAlumno; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">ALUMNOS REGISTRADOS EN NIVEL</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $CuposTotal; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">date_range</i>
                        </div>
                        <div class="content">
                            <div class="text">CLASES REALZADAS</div>
                            <div class="number count-to" data-from="0" data-to="12" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
           
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                   

                    <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"></div> -->
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                <div class="icon">
                                    <i class="material-icons">history</i>
                                    <small>HORARIO INFORMACION BASICA</small>
                                </div> 
                            </h2>
                            <ul class="header-dropdown m-r--5">                               
                            </ul>
                        </div>
                        <div class="body">
                           <ul class="Xdashboard-stat-list">
                            <?php 
                            if($totalRows_tipo_ntabla > 0)                              
                            {
                            //mysqli_data_seek($rs_tipo_ntabla, 0);
                                do { 
                                        $NombSucursal = trim($row_rs_tipo_ntabla['NombreSucursal']);
                                        $desde = trim($row_rs_tipo_ntabla['desde']);
                                        $hasta = trim($row_rs_tipo_ntabla['hasta']);
                                        $Nombhorario = trim($row_rs_tipo_ntabla['NombreHorario']);
                                        $horariotxt = $NombSucursal.' -  '.$desde .' - '.$hasta.'  '.$Nombhorario;
                                    ?>
                                    <li>
                                        Sede Fecha Horario
                                        <span class="pull-right">
                                            <b></b>
                                            <small><?php echo $horariotxt; ?></small>
                                        </span>
                                    </li>
                                <?php } while ($row_rs_tipo_ntabla = mysqli_fetch_assoc($rs_tipo_ntabla));  
                                
                                $rows = mysqli_num_rows($rs_tipo_ntabla);
                                if($rows > 0) 
                                {
                                    mysqli_data_seek($rs_tipo_ntabla, 0);
                                    $row_rs_tipo_ntabla = mysqli_fetch_assoc($rs_tipo_ntabla);
                                }
                            }
                            else
                            {
                            ?>  
                                <li>                                
                                No hay Clase Reservada.
                                </li>
                            <?php
                            }   
                            ?>
                                <!-- <li>
                                    NIVEL ASIGNADO
                                    <span class="pull-right"><b><?php echo $cantidadNivelAsignado; ?></b> <small></small></span>
                                </li>
                                <li>
                                    CLASE RESERVADA
                                    <span class="pull-right"><b><?php echo $reservada; ?></b> <small></small></span>
                                </li>
                                <li>
                                    CUPOS DISPONIBLES
                                    <span class="pull-right"><b><?php echo $TotalCuposDisponibles; ?></b> <small></small></span>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                
                </div>
                <!-- #END# Visitors -->
                
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-pink">
                            <h2>
                                <div class="icon"><i class="material-icons">flag</i>
                                    <small>NIVELES/TOPICS</small>
                                </div>            
                            </h2>                            
                        </div>
                        <div class="body">
                            <?php 
                            do { 
                                $niveln = $row_rs_tipo_ntabla['NombreNivel'].' - '.$row_rs_tipo_ntabla['NombreMateria'];
                                //echo $niveln;
                            ?>
                            <li>
                                <?php echo strtoupper($niveln); ?>
                                <span class="pull-right"><i class="material-icons">trending_up</i></span>
                            </li>
                            <?php } while($row_rs_tipo_ntabla = mysqli_fetch_assoc($rs_tipo_ntabla)); ?>
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <!-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
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
                </div> -->
                <!-- #END# Answered Tickets -->
           

            <div class="row clearfix">
                <!-- Task Info -->
                <!-- 
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
                </div>-->
                <!-- #END# Task Info -->
               
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
<?php
    mysqli_free_result($rs_tipo_tabla);
    mysqli_free_result($rs_cupos);
    mysqli_free_result($rs_ctacupos);
    mysqli_free_result($rs_tipo_ntabla);
?>