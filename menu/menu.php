<?php  
require_once('../Connections/DataConex.php');   

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

$opcMenu= $_SESSION["opcMenu"] ;

if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
}

$NombreArchivo = basename($_SERVER['PHP_SELF'],".php");

$cad = substr($NombreArchivo,0,3);
$cad2 = substr($NombreArchivo,4);
$archivo = "";

// Sitio Frecuente
$soportecURL = "S";
$url         = urlServicios."consultadetalle/gen_sitiofrecuente.php?IdEstado=1";
//echo("<script>console.log('sitioFrec: ".$url."');</script>");
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

    $msitiofrecuente =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $msitiofrecuente = json_decode($msitiofrecuente, true);  
    
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
    $msitiofrecuente = json_decode($resultado, true);	        
}


// Menu
$soportecURL = "S";
$url         = urlServicios."consultadetalle/consultadetalle_menu.php?IdMostrar=0";
$existe      = "";
$usulocal    = "";
$siguex      = "";
//echo("<script>console.log('Menu select: ".$url."');</script>");
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

    $mmenu =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $mmenu = json_decode($mmenu, true);    
    
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
    $mmenu = json_decode($resultado, true);	        
} 

$NombreTablaMenu = "";
$ruta = '../pages/tables/';
$os = array();
for($i=0; $i<count($mmenu['menu']); $i++)
{
	$NombreTablaMenu = trim($mmenu['menu'][$i]['TAB_Nombre_Tabla']);
    array_push($os, $NombreTablaMenu);
}
?>
<div class="menu">
    <ul class="list">
        <li class="header">MENÚ de NAVEGACIÓN</li>
		<!-- SA  --> 
		<?php		
		if($_SESSION["TipoUsuario"] == 4) {
		?>		
			<li <?php if($ruta.$NombreArchivo == $ruta."index") {} //echo "class='active'"; }?>>            
				<a href="<?php echo $ruta; ?>">
					<i class="material-icons">home</i>
					<span>Inicio</span>
				</a>
			</li>		
			
			<li <?php if (in_array($NombreArchivo, $os)) {echo "class='active'";} ?>>
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">view_list</i>
					<span>Módulo de Administración</span>
				</a>
				<ul class="ml-menu">
					<?php					
					if($_SESSION['Desarrollador'] == '1')
					{
						for($i=0; $i<count($mmenu['menu']); $i++)    
						{
							$NombreTablaMenu = trim($mmenu['menu'][$i]['TAB_Nombre_Tabla']);
							$NombreMostrar = trim($mmenu['menu'][$i]['TAB_NombreMostrar']);
							$archivo = $ruta.$NombreTablaMenu.".php";	
							$desarrollador = trim($mmenu['menu'][$i]['TAB_Desarrollador']);							
							?>
								<li <?php if(trim($NombreArchivo) == $NombreTablaMenu) { echo "class='active'"; }?> >
									<a href="<?php echo $archivo; ?>"><?php echo $NombreMostrar; ?></a>
								</li>
							<?php							
						}
					}
					else
					{
						for($i=0; $i<count($mmenu['menu']); $i++)    
						{
							$NombreTablaMenu = trim($mmenu['menu'][$i]['TAB_Nombre_Tabla']);
							$NombreMostrar = trim($mmenu['menu'][$i]['TAB_NombreMostrar']);
							$archivo = $ruta.$NombreTablaMenu.".php";	
							$desarrollador = trim($mmenu['menu'][$i]['TAB_Desarrollador']);
							
							if($desarrollador == '0') {	
							?>
								<li <?php if(trim($NombreArchivo) == $NombreTablaMenu) { echo "class='active'"; }?> >
									<a href="<?php echo $archivo; ?>"><?php echo $NombreMostrar; ?></a>
								</li>
							<?php
							}
						}
					}
					?>
				</ul>
			</li>			
		
			<li <?php if($NombreArchivo == "emp_empresa" || $NombreArchivo == "usu_usuario" || $NombreArchivo == "usuarioforma" || $NombreArchivo == "editarusuario") { echo "class='active'"; }?>>
				<a href="#" class="menu-toggle">
					<i class="material-icons">home_work</i>
					<span>Módulo Empresas</span>
				</a>
				
				<ul class="ml-menu">
					<li <?php if($NombreArchivo == "emp_empresa") { echo "class='active'"; }?>>
						<a href="<?php echo $ruta; ?>emp_empresa.php" class="menu-toggle">
							<i class="material-icons">location_city</i>
							<span>Empresas</span>
						</a>  
					</li>
					
					<li <?php if($NombreArchivo == "usu_usuario" || $NombreArchivo == "usuarioforma" || $NombreArchivo == "editarusuario") { echo "class='active'"; }?>>
						<a href="<?php echo $ruta; ?>usu_usuario.php" class="menu-toggle">
							<i class="material-icons">people</i>
							<span>Usuarios</span>
						</a>
					</li>					
				</ul>			         
			</li>
			
			<li <?php if($NombreArchivo == "cli_cliente" || $NombreArchivo == "cli_cliented" || $NombreArchivo == "cli_clienteforma" || $NombreArchivo == "cli_clienteformad" || $NombreArchivo == "cli_clienteedita" || $NombreArchivo == "cli_clienteeditad") { echo "class='active'"; }?>>
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">business_center</i>
					<span>Partes Procesales </span>
				</a>
				<ul class="ml-menu">	
					<li <?php if($NombreArchivo == "cli_cliente" || $NombreArchivo == "cli_clienteforma" || $NombreArchivo == "cli_clienteedita") { echo "class='active'"; }?>>
						<a href="<?php echo $ruta; ?>cli_cliente.php" class="menu-toggle">
							<i class="material-icons">assignment_ind</i>
							<span>Información Demandante</span>
						</a>                      
					</li>
					
					<li <?php if($NombreArchivo == "cli_cliented" || $NombreArchivo == "cli_clienteformad" || $NombreArchivo == "cli_clienteeditad") { echo "class='active'"; }?>>
						<a href="<?php echo $ruta; ?>cli_cliented.php" class="menu-toggle">
							<i class="material-icons">person_pin</i>
							<span>Información Demandado</span>
						</a>                      
					</li>
				</ul>
			</li>  		
				

			<li <?php if($NombreArchivo == "pro_proceso" || $NombreArchivo == "editaractprocesales" || $NombreArchivo == "pro_procesoc" || $NombreArchivo == "pro_procesoforma" || $NombreArchivo == "pro_aplazamiento") { echo "class='active'"; }?> >
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">work</i>
					<span>Gesti&oacute;n Procesos</span>
				</a>
				<ul class="ml-menu">
					<li <?php if($NombreArchivo == "pro_aplazamiento") { echo "class='active'"; }?>>
						<a href="pro_aplazamiento.php" id ="xp" name="xp" class="menu-toggle active">
							<i class="material-icons">flag</i>
							<span>Aplazamientos</span>
						</a>
					</li>

					<li <?php if($NombreArchivo == "pro_proceso") { echo "class='active'"; }?>>
						<a href="<?php echo $ruta; ?>pro_proceso.php" id ="np" name="np" class="menu-toggle active">
							<i class="material-icons">gavel</i>
							<span>Consulta Procesos</span>
						</a>
					</li>
					
					<li <?php if($NombreArchivo == "pro_procesoforma") { echo "class='active'"; }?>>
						<a href="<?php echo $ruta; ?>pro_procesoforma.php" id ="ap" name="ap" class="menu-toggle active">
							<i class="material-icons">menu_book</i>
							<span>Nuevo Proceso</span>
						</a>
					</li>
					
					<li <?php if($NombreArchivo == "pro_procesoc") { echo "class='active'"; }?>>	
						<a href="<?php echo $ruta; ?>pro_procesoc.php" id ="cp" name="cp" class="menu-toggle active">
							<i class="material-icons">exit_to_app</i>
							<span>Procesos Cerrados</span>
						</a>					
					</li>
				</ul>
			</li>			
			
			<li <?php if($_SERVER['PHP_SELF'] == "/appjuridica/fcx/index.php") { echo "class='active'"; }?>>
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">today</i>
					<span>AGENDA</span>
				</a>
				<ul class="ml-menu">
					<li>
						<a href="../fcx/default.php" class="menu-toggle">
							<span>Agenda</span>
						</a>  
					</li>
				</ul>
			</li>

			<li>
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">touch_app</i>
					<span>Sitios Frecuentes</span>
				</a>
				<ul class="ml-menu">
					<li>
						<?php							
							for($i=0; $i<count($msitiofrecuente['gen_sitiofrecuente']); $i++)
							{
								$IdSitio = $msitiofrecuente['gen_sitiofrecuente'][$i]['SIF_IdSitio'];
								$Nombre = trim($msitiofrecuente['gen_sitiofrecuente'][$i]['SIF_Nombre']);
								$Link = trim($msitiofrecuente['gen_sitiofrecuente'][$i]['SIF_Link']);							
						?>
							<a href="<?php echo $Link; ?>" class="menu-toggle" target="_blank">
								<span><?php echo $Nombre; ?></span>
							</a>
						<?php
							}
						?>
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
		<?php } ?>
		<!-- Fin SA  --> 		
		
		<!-- Administrador(1) o Abogado(2) -->
		<?php //echo $q; 
		if($_SESSION["TipoUsuario"] <= 2 ) {
		?>
        <li <?php if($NombreArchivo == "index") { echo "class='active'"; }?>>            
			<a href="./">
                <i class="material-icons">home</i>
                <span>Inicio</span>
            </a>
        </li>
		
		<!--
		<li>
            <a href="cli_cliente.php" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Clientes</span>
            </a>                      
        </li>
		-->
		
		<li <?php if($NombreArchivo == "cli_cliente" || $NombreArchivo == "cli_cliented" || $NombreArchivo == "cli_clienteforma" || $NombreArchivo == "cli_clienteformad" || $NombreArchivo == "cli_clienteedita" || $NombreArchivo == "cli_clienteeditad") { echo "class='active'"; }?>>
			<a href="javascript:void(0);" class="menu-toggle">
				<i class="material-icons">business_center</i>
				<span>Partes Procesales </span>
			</a>
			<ul class="ml-menu">	
				<li <?php if($NombreArchivo == "cli_cliente" || $NombreArchivo == "cli_clienteforma" || $NombreArchivo == "cli_clienteedita") { echo "class='active'"; }?>>
					<a href="cli_cliente.php" class="menu-toggle">
						<i class="material-icons">assignment_ind</i>
						<span>Información Demandante</span>
					</a>                      
				</li>
				
				<li <?php if($NombreArchivo == "cli_cliented" || $NombreArchivo == "cli_clienteformad" || $NombreArchivo == "cli_clienteeditad") { echo "class='active'"; }?>>
					<a href="cli_cliented.php" class="menu-toggle">
						<i class="material-icons">person_pin</i>
						<span>Información Demandado</span>
					</a>                      
				</li>
			</ul>
		</li>  	

		<!--
        <li <?php if($opcMenu =="P") { echo "class='active'"; }?> >
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">work</i>
                <span>Gesti&oacute;n Procesos</span>
            </a>
            <ul class="ml-menu">
					<li <?php if($NombreArchivo == "pro_proceso") { echo "class='active'"; }?>>
						<a href="pro_proceso.php" id ="np" name="np" class="menu-toggle active">
							<i class="material-icons">gavel</i>
							<span>Consulta Procesos</span>
						</a>
					</li>
					<li <?php if($NombreArchivo == "pro_procesoforma") { echo "class='active'"; }?>>
						<a href="pro_procesoforma.php" id ="ap" name="ap" class="menu-toggle active">
							<i class="material-icons">menu_book</i>
							<span>Nuevo Proceso</span>
						</a>
					</li>
					<li <?php if($NombreArchivo == "pro_procesoc") { echo "class='active'"; }?>>	
						<a href="pro_procesoc.php" id ="cp" name="cp" class="menu-toggle active">
							<i class="material-icons">exit_to_app</i>
							<span>Procesos Cerrados</span>
						</a>					
					</li>					
				</li>
			</ul>
        </li>
		-->
		
		<li <?php if($NombreArchivo == "pro_proceso" || $NombreArchivo == "editaractprocesales" || $NombreArchivo == "pro_procesoc" || $NombreArchivo == "pro_procesoforma"  || $NombreArchivo == "pro_aplazamiento") { echo "class='active'"; }?> >
			<a href="javascript:void(0);" class="menu-toggle">
				<i class="material-icons">work</i>
				<span>Gesti&oacute;n Procesos</span>
			</a>
			<ul class="ml-menu">
				<li <?php if($NombreArchivo == "pro_aplazamiento") { echo "class='active'"; }?>>
					<a href="pro_aplazamiento.php" id ="xp" name="xp" class="menu-toggle active">
						<i class="material-icons">flag</i>
						<span>Aplazamientos</span>
					</a>
				</li>

				<li <?php if($NombreArchivo == "pro_proceso") { echo "class='active'"; }?>>
					<a href="pro_proceso.php" id ="np" name="np" class="menu-toggle active">
						<i class="material-icons">gavel</i>
						<span>Consulta Procesos</span>
					</a>
				</li>
				
				<li <?php if($NombreArchivo == "pro_procesoforma") { echo "class='active'"; }?>>
					<a href="pro_procesoforma.php" id ="ap" name="ap" class="menu-toggle active">
						<i class="material-icons">menu_book</i>
						<span>Nuevo Proceso</span>
					</a>
				</li>
				
				<li <?php if($NombreArchivo == "pro_procesoc") { echo "class='active'"; }?>>	
					<a href="pro_procesoc.php" id ="cp" name="cp" class="menu-toggle active">
						<i class="material-icons">exit_to_app</i>
						<span>Procesos Cerrados</span>
					</a>					
				</li>
			</ul>
		</li>

        <!--
		<li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">today</i>
                <span>AGENDA</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="../agenda/inde.php" class="menu-toggle">
                        <span>Agenda</span>
                    </a>  
                </li>
            </ul>
        </li>
		-->
		<li>
			<a href="javascript:void(0);" class="menu-toggle">
				<i class="material-icons">today</i>
				<span>AGENDA</span>
			</a>
			<ul class="ml-menu">
				<li>
					<a href="../fcx/default.php" class="menu-toggle">
						<span>Agenda</span>
					</a>  
				</li>
			</ul>
		</li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">touch_app</i>
                <span>Sitios Frecuentes</span>
            </a>
            <ul class="ml-menu">
                <li>
					<a href="https://procesojudicial.ramajudicial.gov.co/Justicia21/Administracion/InicioAplicaciones/InicioJusticia21Web.aspx" class="menu-toggle" target="_blank">
                        <span>Rama Judicial TYBA</span>
                    </a>
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
		<?php } ?>
		<!-- Fin Administrador o Abogado -->
    </ul>
</div>