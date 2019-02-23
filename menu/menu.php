<?php 
include('../Connections/cnn_kn.php'); 
//include('../Connections/config2.php'); 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
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

// $nombre = "";
// $email  = "";
// if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
// {    
//     $usuario = trim($_POST['ƒ×']);
   
// mysqli_select_db($cnn_kn, $database_cnn_kn);
// $query_rs_usuario = "SELECT USU_Email AS Email_usuario, CONCAT_WS(' ',USU_Nombre,USU_PrimerApellido,USU_SegundoApellido) Nombre 
// FROM usu_usuario WHERE USU_Email = '$usuario' AND USU_Estado = 1 ;" ;
// $rs_usuario = mysqli_query($cnn_kn, $query_rs_usuario) or die(mysqli_error()."Err.....$query_rs_usuario");
// $row_rs_usuario = mysqli_fetch_assoc($rs_usuario);
// $totalRows_rs_usuario = mysqli_num_rows($rs_usuario);
//     $y = "";
    
//     if ($resultado = mysqli_query($cnn_kn, $query_rs_usuario)) 
//     {
//         while($all = mysqli_fetch_assoc($resultado))
//         {
//             $nombre = $strowreg['Nombre'];
//             $email = $strowreg['Email_usuario'];           
//         }
//     }
//     mysqli_free_result($rs_usuario);
// }
// else
// {
//     $usuario ="";
// }


?>   
   
<div class="menu">
    <ul class="list">
        <li class="header">MENÚ de NAVEGACIÓN</li>
        <li>
            <a href="../header/index.php">
                <i class="material-icons">home</i>
                <span>Inicio</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);">
                <i class="material-icons">text_fields</i>
                <span>M&oacute;dulo Usuarios</span>
            </a>
        </li>                   

        <li> <!-- class="active" -->
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">view_list</i>
                <span>M&oacute;dulo de Administraci&oacute;n</span>
            </a>
            <ul class="ml-menu">
            <?php

            require_once('../Connections/DataConex.php');    
            $soportecURL = "S";
            $url         = urlServicios."consultadetalle/consultadetalle_gen_tabla.php?IdEstadoTabla=1";
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

                $m =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
                $m = json_decode($m, true);
                //echo("<script>console.log('PHP: ".print_r($m)."');</script>");
                //echo("<script>console.log('PHP: ".count($m['gen_tabla'])."');</script>");
                
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
                $m = json_decode($resultado, true);	        
            }  

            $nombre_Tabla = "";
            $clase = "";
            $NombreArchivo = basename($_SERVER['PHP_SELF'],".php");
            for($i=0; $i<count($m['gen_tabla']); $i++)
            {
                $TAB_IdTabla = $m['gen_tabla'][$i]['TAB_IdTabla'];
                $TAB_Nombre_Tabla = $m['gen_tabla'][$i]['TAB_Nombre_Tabla'];
                $TAB_NombreMostrar = trim($m['gen_tabla'][$i]['TAB_NombreMostrar']);
                
                $archivo = "../pages/tables/".$TAB_Nombre_Tabla.".php";
               //echo("<script>console.log('PHP: ".$archivo."');</script>");
                if( strtoupper($NombreArchivo) == strtoupper($TAB_Nombre_Tabla) )
                { 
                    $clase = "class='active'"; 
                }
                else
                {
                    $clase = "";	
                }
            ?>

                <li <?php echo $clase ;?> >
                    <a href="<?php echo $archivo; ?>"><?php echo $TAB_NombreMostrar; ?></a>
                </li>
            <?php 
            }
            ?>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">work</i>
                <span>Gesti&oacute;n Procesos</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../pages/tables/pro_proceso.php" class="menu-toggle">
                        <span>Nuevo Proceso</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <!-- <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">widgets</i>
                <span>Ubicaci&oacute;n</span>
            </a> -->
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
                <i class="material-icons">account_balance</i>
                <span>Consultar Juzgados</span>
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
                <i class="material-icons">today</i>
                <span>AGENDA</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../kal/sample.php" class="menu-toggle">
                        <span>Agenda</span>
                    </a>  
                </li>
            </ul>
        </li>
		
		<li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Dependiente Judicial</span>
            </a>
            <ul class="ml-menu">
                <li>
					<a href="../eventos/" class="menu-toggle">
                        <span>Herramientas</span>
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