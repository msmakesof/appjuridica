<?php 
//require_once('cnn_kn.php'); 
//require_once('config2.php'); 
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
$empresa = "MovilWeb";
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
            <a href="javascript:void(0);">
                <i class="material-icons">text_fields</i>
                <span>Módulo Usuarios</span>
            </a>
        </li>                   

        <li class="active">
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

                <li <?php echo $clase ;?>
                    <a href="<?php echo $archivo; ?>"><?php echo $NombreMostrar; ?></a>
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
                <span>Cargar Datas</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <!--
                    <a href="../pages/tables/clases.php" class="menu-toggle">
                     ///<a href="../actualizacion.html" class="menu-toggle"> //
                        <span>Programación de Clases</span>
                    </a>  
                    -->

                    <!-- <a href="../kal/sample.php" class="menu-toggle">
                        <span>Programación de Clases</span>
                    </a>  -->                               

                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">widgets</i>
                <span>Comparaci&oacute;n de Cajas</span>
            </a>
            <ul class="ml-menu">
                <li>
                   <!--  <a href="../kal/sample.php" class="menu-toggle">
                        <span>Comparaci&oacute;n de Cajas</span>
                    </a>  --> 
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">widgets</i>
                <span>Consultar Estado de Pedidos</span>
            </a>
            <ul class="ml-menu">
                <li>
                   <!--  <a href="../kal/sample.php" class="menu-toggle">
                        <span>Comparaci&oacute;n de Cajas</span>
                    </a>  --> 
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">widgets</i>
                <span>Ordenes de Cargue</span>
            </a>
            <ul class="ml-menu">
                <li>
                   <!--  <a href="../kal/sample.php" class="menu-toggle">
                        <span>Comparaci&oacute;n de Cajas</span>
                    </a>  --> 
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">widgets</i>
                <span>Boletas</span>
            </a>
            <ul class="ml-menu">
                <li>
                   <!--  <a href="../kal/sample.php" class="menu-toggle">
                        <span>Comparaci&oacute;n de Cajas</span>
                    </a>  --> 
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