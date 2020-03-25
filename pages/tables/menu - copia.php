<?php 
//include('../../Connections/cnn_kn.php'); 
//require('../../Connections/config2.php'); 
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
?>
 <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet"> 
	<style>
	.sidebar .menu .list .ml-menu {
        list-style: none;
        display: none;
        padding-left: 0; }
        .sidebar .menu .list .ml-menu span {
          font-weight: normal;
          font-size: 14px;
          margin: 3px 0 1px 6px; }
        .sidebar .menu .list .ml-menu li a {
          padding-left: 55px;
          padding-top: 7px;
          padding-bottom: 7px; }
        .sidebar .menu .list .ml-menu li.active a.toggled:not(.menu-toggle) {
          font-weight: 600;
          margin-left: 5px; }
          .sidebar .menu .list .ml-menu li.active a.toggled:not(.menu-toggle):before {
            content: '\E315';
            font-family: 'Material Icons';
            position: relative;
            font-size: 21px;
            height: 20px;
            top: -5px;
            right: 0px; }
        .sidebar .menu .list .ml-menu li .ml-menu li a {
          padding-left: 80px; }
        .sidebar .menu .list .ml-menu li .ml-menu .ml-menu li a {
          padding-left: 95px; }

	</style>
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
$empresa = "AppJuridica";
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
?>   
  
<div class="menu">
    <ul class="list">
        <li class="header">MENÚ de NAVEGACIÓN</li>
		
		<?php
		require_once('../../Connections/DataConex.php');
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
			for($i=0; $i<count($mmenu['men_menu']); $i++)
			{				
				$NombreMenu = trim($mmenu['men_menu'][$i]['MEN_Nombre']);        
				$archivo = $NombreMenu.".php";
				$idTabla = $mmenu['men_menu'][$i]['MEN_IdMenu'];
				$Icono = trim($mmenu['men_menu'][$i]['MEN_Icono']);
				$Orden = $mmenu['men_menu'][$i]['MEN_Orden'];
				$LnkMenu = $mmenu['men_menu'][$i]['MEN_Link'];
				$Idestado = trim($mmenu['men_menu'][$i]['MEN_Estado']);	
				$estadoTabla = trim($mmenu['men_menu'][$i]['EstadoTabla']);
				
				if( $Icono != 'na')
				{
		?>
				
	
				<li>
					<a href="<?php echo $LnkMenu; ?>">
						<i class="material-icons"><?php echo $Icono; ?></i>
						<span><?php echo $NombreMenu; ?></span>
					</a>
					
					
					
					<!-- subMenu 
						<ul class='ml-menu'>
					 -->
					<?php
						//echo "<ul class='ml-menu'>";
						require_once('../../Connections/DataConex.php');
						$soportecURL = "S";
						$url         = urlServicios."consultadetalle/consultadetalle_men_submenu.php?IdMenu=$idTabla";
						$existe      = "";
						$usulocal    = "";
						$siguex      = "";
						//echo "<script>console.log(submenu...". $url .");</script>";
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
							echo "<ul class='ml-menu'>";
							for($x=0; $x<count($msubmenu['men_submenu']); $x++)
							{
								$IdSubMenu = trim($msubmenu['men_submenu'][$x]['SME_IdSubMenu']);
								$NombreSubMenu = trim($msubmenu['men_submenu'][$x]['SME_Nombre']);								
								$Iconosm = trim($msubmenu['men_submenu'][$x]['SME_Icono']);
								$IdMenu = trim($msubmenu['men_submenu'][$x]['SME_IdMenu']);					
								$LnkSubMenu = trim($msubmenu['men_submenu'][$x]['SME_Link']);
								$Estado = trim($msubmenu['men_submenu'][$x]['SME_Estado']);
								$NombreMenu = trim($msubmenu['men_submenu'][$x]['NombreMenu']);
						?>	
															
									
									<li>
										<a href="<?php echo $LnkSubMenu; ?>" class="menu-toggle">
											<i class="material-icons"><?php echo $Iconosm; ?></i>
											<span>SM...<?php echo $NombreSubMenu; ?></span>
										</a>  
									</li>
									
									
						
								
					<?php 
							}
							echo "</ul>";
						}							
					?>					
					<!-- fin SubMenu
						-->
						
				</li>
							
		<?php
				} // Fin If
			} // fin For
		}
		echo "-------------------------------------------";
		?>	
        <li>
            <a href="../../header/index.php">
                <i class="material-icons">home</i>
                <span>Inicio</span>
            </a>
        </li>
		
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

				<?php if($_SESSION["TipoUsuario"] == 1) {?>
					<li>
						<a href="usu_usuario.php" class="menu-toggle">
							<i class="material-icons">text_fields</i>
							<span>Usuarios</span>
						</a>
					</li>
				<?php } ?>
            </ul>
			         
        </li>
		
		<li>
            <a href="cli_cliente.php" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Clientes</span>
            </a>
                      
        </li>
		

		<?php if($_SESSION["TipoUsuario"] == 1) { ?>
			<li>
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">view_list</i>
					<span>Módulo de Administración</span>
				</a>
				<ul class="ml-menu">
					<?php
					include('menuInclude.php');
					$NombreArchivo = basename($_SERVER['PHP_SELF'],".php");

					for($i=0; $i<count($mmenu['menu']); $i++)    
					{
						$NombreTablaMenu = trim($mmenu['menu'][$i]['TAB_Nombre_Tabla']);                
						$NombreMostrar = trim($mmenu['menu'][$i]['TAB_NombreMostrar']);							
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
					}             
					?>				   
				</ul>
			</li>
		<?php } ?>

        <li <?php if($opcMenu =="P") { echo "class='active'"; }?> >
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">work</i>
                <span>Gesti&oacute;n Procesos</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="pro_proceso.php" id ="np" name="np" class="menu-toggle active">
                        <span>Nuevo Proceso</span>
                    </a>
					<a href="pro_procesoc.php" id ="cp" name="cp" class="menu-toggle active">
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
       
    </ul>
</div>