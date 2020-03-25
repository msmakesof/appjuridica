<?php 
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
		<!-- subMenu 
			<ul class='ml-menu'>
		 -->
		<?php
		
		//$idTabla = $_GET['idMenu'];
		echo "pSM...$idTablaSM";
			//echo "<ul class='ml-menu'>";
			require_once('../../Connections/DataConex.php');
			$soportecURL = "S";
			$url         = urlServicios."consultadetalle/consultadetalle_men_submenu.php?IdMenu=$idTablaSM";
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
				for($x=0; $x<count($msubmenu['men_submenu']); $x++)
				{
					$IdSubMenu = trim($msubmenu['men_submenu'][$x]['SME_IdSubMenu']);
					$NombreSubMenu = trim($msubmenu['men_submenu'][$x]['SME_Nombre']);								
					$Iconosm = trim($msubmenu['men_submenu'][$x]['SME_Icono']);
					$IdMenu = trim($msubmenu['men_submenu'][$x]['SME_IdMenu']);					
					$LnkSubMenu = trim($msubmenu['men_submenu'][$x]['SME_Link']);
					$Estado = trim($msubmenu['men_submenu'][$x]['SME_Estado']);
					$NombreMenu = trim($msubmenu['men_submenu'][$x]['NombreMenu']);
					
					echo $NombreSubMenu;
			?>	
					
					<li>
						<a href="<?php echo $LnkSubMenu; ?>" class="menu-toggle">
							<i class="material-icons"><?php echo $Iconosm; ?></i>
							<span>SM...<?php echo $NombreSubMenu; ?></span>
						</a>  
					</li>								
			<?php 
					}
					//echo "</ul>";
				}							
			?>					
			<!-- fin SubMenu	-->		
		<?php		
		echo "-------------------------------------------";
		?>