<?php 
//include('../../Connections/cnn_kn.php'); 
//require('../../Connections/config2.php'); 
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        if (PHP_VERSION < 6) 
        {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

        switch ($theType) 
        {
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
//require_once('../../header.php');


$empresa = "Litigantes";
if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
}

$opcMenu= $_SESSION["opcMenu"] ;
if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
{    
    $usuario = trim($_POST['ƒ×']);
}
else
{
    $usuario ="";
}
if($usuario == "")
{
    $usuario = $_SESSION["IdUsuario"];
}
	
/*		require_once('../../Connections/DataConex.php');
		$soportecURL = "S";
		$url         = urlServicios."consultadetalle/consultadetalle_men_menu.php?IdMostrar=0";
		$existe      = "";
		$usulocal    = "";
		$siguex      = "";
		//echo "<script>console.log(menu...". $url .");</script>";
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
			//echo("<script>console.log('PHP: ".print_r($mmenu)."');</script>");
			//echo("<script>console.log('PHP: ".count($m['men_menu'])."');</script>");
			
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

		if( $mmenu['estado'] < 2)
		{
			$nombre_Tabla="";
			$q = "";
			for($i=0; $i<count($mmenu['men_menu']); $i++)
			{				
				$NombreMenu = trim($mmenu['men_menu'][$i]['MEN_Nombre']).' --';        
				$archivo = $NombreMenu.".php";
				$idTabla = $mmenu['men_menu'][$i]['MEN_IdMenu'];
				$Icono = trim($mmenu['men_menu'][$i]['MEN_Icono']);
				$Orden = $mmenu['men_menu'][$i]['MEN_Orden'];
				$LnkMenu = trim($mmenu['men_menu'][$i]['MEN_Link']);
				$Idestado = trim($mmenu['men_menu'][$i]['MEN_Estado']);	
				$estadoTabla = trim($mmenu['men_menu'][$i]['EstadoTabla']);
				
				if( $Icono != 'na')
				{				
					$q .="
						<li>
							<a href=". $LnkMenu.">
								<i class='material-icons'>". $Icono. "</i>
								<span>". $NombreMenu ."</span>
							</a>";
							
							require_once('../../Connections/DataConex.php');
							$soportecURL = "S";
							$url         = urlServicios."consultadetalle/consultadetalle_men_submenu.php?IdMenu=$idTabla";
							$existe      = "";
							$usulocal    = "";
							$siguex      = "";
							//echo "<script>console.log(submenu...". $url .");</script>";
							//echo "submenu...". $url;
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

								$msubmenu =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
								$msubmenu = json_decode($msubmenu, true);
								//echo("<script>console.log('PHP: ".print_r($msubmenu)."');</script>");
								//echo("<script>console.log('PHP: ".count($m['men_submenu'])."');</script>");
								
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
								$msubmenu = json_decode($resultado, true);	        
							}
							
							if( $msubmenu['estado'] < 2)
							{							
								//echo "<ul class='vml-menu'>";
								$q .="<ul class='ml-menu'>";
								for($x=0; $x<count($msubmenu['men_submenu']); $x++)
								{
									$IdSubMenu = trim($msubmenu['men_submenu'][$x]['SME_IdSubMenu']);
									$NombreSubMenu = trim($msubmenu['men_submenu'][$x]['SME_Nombre']);								
									$Iconosm = trim($msubmenu['men_submenu'][$x]['SME_Icono']);
									$IdMenu = trim($msubmenu['men_submenu'][$x]['SME_IdMenu']);					
									$LnkSubMenu = trim($msubmenu['men_submenu'][$x]['SME_Link']);
									$Estado = trim($msubmenu['men_submenu'][$x]['SME_Estado']);
									$NombreMenu = trim($msubmenu['men_submenu'][$x]['NombreMenu']);
									
									//echo $NombreSubMenu;
									
									$q .="									
										<li>
											<a href=". $LnkSubMenu ." class='menu-toggle'>
												<i class='material-icons'>". $Iconosm ."</i>
												<span>". $NombreSubMenu. "</span>
											</a>  
										</li>";									
								}
								$q .="</ul>";
							}
							
					$q .= "</li>";							
		
				} // Fin If
			} // fin For
		}
		//echo "-------------------------------------------";
		*/
?>   
  
<div class="menu">
    <ul class="list">
        <li class="header">MENÚ de NAVEGACIÓN</li>
		<!-- SA  --> 
		<?php 
		if($_SESSION["TipoUsuario"] == 4) {
		?>
			<li>            
				<a href="./">
					<i class="material-icons">home</i>
					<span>Inicio</span>
				</a>
			</li>		
			
			<li>
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">view_list</i>
					<span>Módulo de Administración</span>
				</a>
				<ul class="ml-menu">
					<?php
					include('menuInclude.php');
					$NombreArchivo = basename($_SERVER['PHP_SELF'],".php");

					if($_SESSION['Desarrollador'] == '1')
					{
						for($i=0; $i<count($mmenu['menu']); $i++)    
						{
							$NombreTablaMenu = trim($mmenu['menu'][$i]['TAB_Nombre_Tabla']);
							$NombreMostrar = trim($mmenu['menu'][$i]['TAB_NombreMostrar']);
							$archivo = $NombreTablaMenu.".php";	
							$desarrollador = trim($mmenu['menu'][$i]['TAB_Desarrollador']);
							
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
						}
					}
					else
					{
						for($i=0; $i<count($mmenu['menu']); $i++)    
						{
							$NombreTablaMenu = trim($mmenu['menu'][$i]['TAB_Nombre_Tabla']);
							$NombreMostrar = trim($mmenu['menu'][$i]['TAB_NombreMostrar']);
							$archivo = $NombreTablaMenu.".php";	
							$desarrollador = trim($mmenu['menu'][$i]['TAB_Desarrollador']);
							
							if( strtoupper($NombreArchivo) == strtoupper($NombreTablaMenu) )
							{ 
								$clase = "class='active'"; 
							}
							else
							{
								$clase = "";	
							}
							if($desarrollador == '0') {	
							?>
								<li <?php echo $clase ;?> >
									<a href="<?php echo $archivo; ?>"><?php echo $NombreMostrar; ?></a>
								</li>
							<?php
							}
						}
					}
					?>
				</ul>
			</li>			
		
			<li>
				<a href="#" class="menu-toggle">
					<i class="material-icons">home_work</i>
					<span>Módulo Empresas</span>
				</a>
				
				<ul class="ml-menu">
					<li>
						<a href="emp_empresa.php" class="menu-toggle">
							<i class="material-icons">location_city</i>
							<span>Empresas</span>
						</a>  
					</li>
					
					<li>
						<a href="usu_usuario.php" class="menu-toggle">
							<i class="material-icons">people</i>
							<span>Usuarios</span>
						</a>
					</li>					
				</ul>			         
			</li>
		
			<li <?php if($opcMenu =="C") { echo "class='active'"; }?> >
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">business_center</i>
					<span>Partes Procesales </span>
				</a>
				<ul class="ml-menu">	
					<li>
						<a href="cli_cliente.php" class="menu-toggle">
							<i class="material-icons">assignment_ind</i>
							<span>Información Demandante</span>
						</a>                      
					</li>
					
					<li>
						<a href="cli_cliented.php" class="menu-toggle">
							<i class="material-icons">person_pin</i>
							<span>Información Demandado</span>
						</a>                      
					</li>
				</ul>
			</li>  		
				

			<li <?php if($opcMenu =="P") { echo "class='active'"; }?> >
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">work</i>
					<span>Gesti&oacute;n Procesos</span>
				</a>
				<ul class="ml-menu">
					<li>
						<a href="pro_proceso.php" id ="np" name="np" class="menu-toggle active">
							<i class="material-icons">gavel</i>
							<span>Nuevo Proceso</span>
						</a>
						<a href="editaractprocesales.php" id ="ap" name="ap" class="menu-toggle active">
							<i class="material-icons">menu_book</i>
							<span>Actuaciones Procesales</span>
						</a>
						<a href="pro_procesoc.php" id ="cp" name="cp" class="menu-toggle active">
							<i class="material-icons">exit_to_app</i>
							<span>Procesos Cerrados</span>
						</a>					
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
						<a href="../../agenda/inde.php" class="menu-toggle">
							<span>Agenda</span>
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
		<!-- Fin SA  --> 
		
		
		<!-- Administrador(1) o Abogado(2) -->
		<?php //echo $q; 
		if($_SESSION["TipoUsuario"] <= 2 ) {
		?>
        <li>            
			<a href="./">
                <i class="material-icons">home</i>
                <span>Inicio</span>
            </a>
        </li>			
		
		<!--
		<li>
            <a href="#" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Módulo Empresas</span>
            </a>
			
            <ul class="ml-menu">
                <li>
                    <a href="emp_empresa.php" class="menu-toggle">
						<i class="material-icons">text_fields</i>
                        <span>Empresas</span>
                    </a>  
                </li>

				<?php //if($_SESSION["TipoUsuario"] == 4) {?>
					<li>
						<a href="usu_usuario.php" class="menu-toggle">
							<i class="material-icons">text_fields</i>
							<span>Usuarios</span>
						</a>
					</li>
				<?php //} ?>
            </ul>			         
        </li>
		--> 
		<li>
            <a href="cli_cliente.php" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Clientes</span>
            </a>                      
        </li>

        <li <?php if($opcMenu =="P") { echo "class='active'"; }?> >
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">work</i>
                <span>Gesti&oacute;n Procesos</span>
            </a>
            <ul class="ml-menu">
				<li>
					<a href="pro_proceso.php" id ="np" name="np" class="menu-toggle active">
						<i class="material-icons">gavel</i>
						<span>Nuevo Proceso</span>
					</a>
					<a href="editaractprocesales.php" id ="ap" name="ap" class="menu-toggle active">
						<i class="material-icons">menu_book</i>
						<span>Actuaciones Procesales</span>
					</a>
					<a href="pro_procesoc.php" id ="cp" name="cp" class="menu-toggle active">
						<i class="material-icons">exit_to_app</i>
						<span>Procesos Cerrados</span>
					</a>					
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
                    <a href="../../agenda/inde.php" class="menu-toggle">
                        <span>Agenda</span>
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