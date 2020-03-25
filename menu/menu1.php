<?php  
//include('../Connections/config2.php'); 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
//include('../../Connections/cnn_kn.php');
$ruta = __FILE__;
?>
<?php
//echo $_SERVER['PHP_SELF'];
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
$opcMenu= $_SESSION["opcMenu"] ;
if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
}
echo $_SERVER['SERVER_NAME']."<br>";
$rutax= dirname($_SERVER['PHP_SELF'] ); //$_SERVER['PHP_SELF'];
echo $rutax."<br>";
echo basename($_SERVER['PHP_SELF'])."<br>";
echo $_SERVER['REQUEST_URI']."<br>";
echo "__FILE__ : " . __FILE__ . "<br>";  
//echo "docRoot...".$_SERVER['DOCUMENT_ROOT']. "<br>";
echo dirname( $ruta). "<br>";
echo dirname($_SERVER['PHP_SELF'] ). "<br>";
echo dirname( __DIR__ ). "<br>";
?>   
   
<div class="menu">
    <ul class="list">
        <li class="header">MENÚ de NAVEGACIÓN</li>
        <li>
            <a href="../../header/">
                <i class="material-icons">home</i>
                <span>Inicio</span>
            </a>
        </li>
		
		<li>
            <a href="#" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Empresas Cliente...</span>
            </a>
			
            <ul class="ml-menu">
                <li>
                    <a href="../pages/tables/emp_empresa.php" class="menu-toggle">
                        <span>Empresas</span>
                    </a>  
                </li>
            
                <!-- 
				<li>
                    <a href="../pages/tables/emp_contacto.php" class="menu-toggle">
                        <span>Contactos por Empresas</span>
                    </a>  
                </li>
				-->
            </ul>
			         
        </li>
		
		<li>
            <a href="../cliente/" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Clientes</span>
            </a>
			<!--
            <ul class="ml-menu">
                <li>
                    <a href="../pages/tables/cli_cliente.php" class="menu-toggle">
                        <span>Clientes</span>
                    </a>  
                </li>
            </ul>
			-->            
        </li>
		
        <?php if($_SESSION["TipoUsuario"] == 1) {?>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons">text_fields</i>
                    <span>M&oacute;dulo Usuarios</span>
                </a>
            </li>                   
        <?php } ?>

        <?php if($_SESSION["TipoUsuario"] == 1) { ?>
        <li> <!-- class="active" -->
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">view_list</i>
                <span>M&oacute;dulo de Administraci&oacute;n</span>
            </a>
            <ul class="ml-menu">
            <?php
			echo "rx.......$rutax<br>";
			if ($rutax == "/appjuridica/header")
			{
				$rutac = "../";
			}
			else
			{
				$rutac = "../../";
			}
			echo "rutax. from menu..".$rutax;

            require_once($rutac."Connections/DataConex.php");    
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
			$rutadm = dirname($_SERVER['PHP_SELF']); 
			$arx = "";
            for($i=0; $i<count($m['gen_tabla']); $i++)
            {
                $TAB_IdTabla = $m['gen_tabla'][$i]['TAB_IdTabla'];
                $TAB_Nombre_Tabla = $m['gen_tabla'][$i]['TAB_Nombre_Tabla'];
                $TAB_NombreMostrar = trim($m['gen_tabla'][$i]['TAB_NombreMostrar']);
                
                //$archivo = "../pages/tables/".$TAB_Nombre_Tabla.".php";
				
				$archivo = trim($TAB_Nombre_Tabla).".php";
				$arx = $rutadm."/".$archivo;
				
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
                    <a href="<?php echo $arx; ?>"><?php echo $TAB_NombreMostrar; ?></a>
                </li>
            <?php 
            }
            ?>
            </ul>
        </li>
        <?php } ?>

        <li <?php if($opcMenu =="P") { echo "class='active'"; }?> >
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">gavel</i>
                <span>Gesti&oacute;n Procesos</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../pages/tables/pro_proceso.php" class="menu-toggle">
                        <span>Nuevo Proceso</span>
                    </a>
					<a href="../pages/tables/pro_procesoc.php" class="menu-toggle">
                        <span>Procesos Cerrados</span>
                    </a>
                </li>
            </ul>			
        </li>

        

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">account_balance</i>
                <span>Consultar Juzgados..</span>
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
                <span>Agenda</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../agenda/inde.php" class="menu-toggle">
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
					<a href="../dependiente/" class="menu-toggle">
                        <span>Actividades</span>
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
        <?php if($_SESSION["TipoUsuario"] == 1) { ?>
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
        <?php } ?>
       
    </ul>
</div>