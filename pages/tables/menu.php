<?php 
//include('../../Connections/cnn_kn.php'); 
//require('../../Connections/config2.php'); 
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
$query_rs_usuario = "SELECT CONCAT_WS(' ',USU_Nombre,USU_PrimerApellido,USU_SegundoApellido) Nombre, USU_Email 
FROM usu_usuario WHERE USU_Estado = 1 AND USU_Email = '$usuario' ;" ;
$rs_usuario = mysqli_query($cnn_kn, $query_rs_usuario) or die(mysqli_error()."Err.....$query_rs_usuario");
$row_rs_usuario = mysqli_fetch_assoc($rs_usuario);
$totalRows_rs_usuario = mysqli_num_rows($rs_usuario);
    $y = "";
    
    if ($resultado = mysqli_query($cnn_kn, $query_rs_usuario)) 
    {
        while($all = mysqli_fetch_assoc($resultado))
        {
            $nombre = $strowreg['Nombre'];
            $email = $strowreg['USU_Email'];           
        }
    }
    mysqli_free_result($rs_usuario);
}
else
{
    $usuario ="";
}
?>   
   
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
            $query_rs_ntipo_tabla = "SELECT TAB_Nombre_Tabla, TAB_NombreMostrar FROM gen_tabla WHERE TAB_IdEstadoTabla = 1 ORDER BY TAB_Nombre_Tabla;"; 
            $rs_ntipo_tabla = mysqli_query($cnn_kn,$query_rs_ntipo_tabla) or die(mysqli_error()."$query_rs_ntipo_tabla");
            $row_rs_ntipo_tabla = mysqli_fetch_assoc($rs_ntipo_tabla);
            //Cantidad de registros
            $cantidad_rs_ntipo_tabla = mysqli_num_rows($rs_ntipo_tabla);
            
            $nombre_Tabla = "";
			$clase = "";
			$NombreArchivo = basename($_SERVER['PHP_SELF'],".php");
            //echo $NombreArchivo;
            do{
                $NombreTablaMenu = trim($row_rs_ntipo_tabla['TAB_Nombre_Tabla']);
                //echo $NombreTablaMenu; 
                $NombreMostrar = trim($row_rs_ntipo_tabla['TAB_NombreMostrar']);							
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

                <li <?php echo $clase ;?> >
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