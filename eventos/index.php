<?php
require_once('../Connections/cnn_kn.php'); 
require_once('../Connections/config2.php');

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

// require_once('../Connections/DataConex.php');
// $soportecURL = "S";
// $url         = urlServicios."consultadetalle/consultadetalle_pro_proceso.php?IdMostrar=0";
// $existe      = "";
// $usulocal    = "";
// $siguex      = "";
// //echo("<script>console.log('PHP proproceso: $url');</script>");
// if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
// {
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_VERBOSE, true);
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_TIMEOUT, 30);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//     curl_setopt($ch, CURLOPT_POST, 0);
//     $resultado = curl_exec ($ch);
//     curl_close($ch);

//     $mproceso =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
//     $mproceso = json_decode($mproceso, true);
//     //echo("<script>console.log('PHP: ".print_r($mproceso)."');</script>");
//     //echo("<script>console.log('PHP: ".count($m['pro_proceso'])."');</script>");
    
//     $json_errors = array(
//         JSON_ERROR_NONE => 'No se ha producido ningún error',
//         JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
//         JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
//         JSON_ERROR_SYNTAX => 'Error de Sintaxis',
//         );
//     //echo "Error : ", $json_errors[json_last_error()], PHP_EOL, PHP_EOL."<br>";        
// }
// else
// {
//     $soportecURL = "N";
//     echo "No hay soporte para cURL";
// } 

// if($soportecURL == "N")
// {
//     require_once('./unirest/vendor/autoload.php');
//     $response = Unirest\Request::get($url, array("X-Mashape-Key" => "MY SECRET KEY"));
//     $resultado = $response->raw_body;
//     $resultado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);
//     $mproceso = json_decode($resultado, true);	        
// } 

// if( $mproceso['estado'] != 2)
// {
//     $nombre_Tabla="";
//     for($i=0; $i<count($mproceso['pro_proceso']); $i++)
//     {
//         $NombreTabla = trim($mproceso['pro_proceso'][$i]['PRO_NumeroProceso']);        
//         $archivo = $NombreTabla.".php";
//         $idTabla = $mproceso['pro_proceso'][$i]['PRO_IdProceso'];
//         $AsignadoA =$mproceso['pro_proceso'][$i]['AsignadoA'];
//         $Ubicacion =$mproceso['pro_proceso'][$i]['Ubicacion'];
//         $ClaseProceso =$mproceso['pro_proceso'][$i]['ClaseProceso'];
//         $Juzgado =$mproceso['pro_proceso'][$i]['Juzgado'];
//         $estadoTabla = trim($mproceso['pro_proceso'][$i]['EstadoTabla']);
//     }
// }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<style>
* {
  box-sizing: border-box;
}
.menu {
  float:left;
  width:20%;
  text-align:center;
}
.menu a {
  background-color:#e5e5e5;
  padding:8px;
  margin-top:7px;
  display:block;
  width:100%;
  color:black;
}
.main {
  float:left;
  width:60%;
  padding:0 20px;
}
.right {
  background-color:#e5e5e5;
  float:left;
  width:20%;
  padding:15px;
  margin-top:7px;
  text-align:center;
}

@media only screen and (max-width:620px) {
  /* For mobile phones: */
  .menu, .main, .right {
    width:100%;
  }
}

input#abrir-cerrar{
	visibility:hidden; position: absolute; top: 9999px;
}

input#abrir-cerrar:checked ~ #sidebar{
	width:300px;
}

input#abrir-cerrar:checked +label[for="abrir-cerrar"], input#abrir-cerrar:checked ~ #contenido{
	margin-left: 300px;
	transition: margin-left.4s;
}

input#abrir-cerrar:checked +label[for="abrir-cerrar"].cerrar{
	display:inline;
}
input#abrir-cerrar:checked +label[for="abrir-cerrar"].abrir{
	display:none;
}

/* menu */
ul { list-style: none; }
a { text-decoration: none; color: black;}
body {
   font-family: 'Dosis', sans-serif;
  background: #FFF;
}
#menu-wrapper {
    overflow: hidden;
    max-width: 100%;
    cursor: pointer;
}


#menu-wrapper #hamburger-menu {
    position: relative;
    width: 25px;
    height: 20px;
    margin: 15px;
}

#menu-wrapper #hamburger-menu span {
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    left: 0;
    display: block;
    width: 100%;
    height: 2px;
    border-radius: 10px;
    color: black;
    background-color: red;
    position: absolute;
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: .4s ease-in-out;
    transition: .4s ease-in-out;
}

#menu-wrapper #hamburger-menu span:nth-child(1) {
    top: 0;
}
#menu-wrapper #hamburger-menu span:nth-child(2) {
    top: 9px;
}
#menu-wrapper #hamburger-menu span:nth-child(3) {
    top: 18px;
}
#menu-wrapper #hamburger-menu.open span:nth-child(1) {
    top: 9px;
    -webkit-transform: rotate(135deg);
    transform: rotate(135deg);
}
#menu-wrapper #hamburger-menu.open span:nth-child(2) {
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    left: -60px;
}
#menu-wrapper #hamburger-menu.open span:nth-child(3) {
    top: 9px;
    -webkit-transform: rotate(-135deg);
    transform: rotate(-135deg);
}

#menu-container .menu-list .menu-submenu {
    padding-top: 20px;
    padding-bottom: 20px;
}
#menu-container .menu-list {
    padding-left: 0;
    display: block;
    position: absolute;
    width: 70%;
    max-width: 450px;
    background: #cce6ff;
    box-shadow: rgba(100,100,100,0.2) 6px 2px 10px;
    z-index: 999;
    overflow-y: auto;
    overflow-x: hidden;
    left: -100%;
}

#menu-container .menu-list li.accordion-toggle, #menu-container .menu-list .menu-login {
    font-size: 16px;
    padding: 20px;
    text-transform: uppercase;
    border-top: 1px solid #dbdcd2;
}
#menu-container .menu-list li:first-of-type {
    border-top: 0;
}

.accordion-toggle, .accordion-content {
    cursor: pointer;
    font-size: 16px;
    position: relative;
    letter-spacing: 1px;
}

 .accordion-content {
    display: none;
}

.accordion-toggle a:before, .accordion-toggle a:after {
    content: '';
    display: block;
    position: absolute;
    top: 50%;
    right: 30px;
    width: 15px;
    height: 2px;
    margin-top: -1px;
    background-color: red;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    -webkit-transition: all 0.3s;
    transition: all 0.3s ease-out;
}

.accordion-toggle a:before {
    -webkit-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    transform: rotate(-90deg);
    opacity: 1;
    z-index: 2;
}

.accordion-toggle.active-tab {
  background: #99ccff;
  transition: all 0.3s ease;
}
.accordion-toggle a.active:before {
    -webkit-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);
    background: #fff !important;
}

.accordion-toggle a.active:after {
    -webkit-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    transform: rotate(180deg);
    background: #fff !important;
    opacity: 0;
}
/* fin menu */

.titulo{
	border-radius: 150px;
	-moz-border-radius: 150px;
	-webkit-border-radius: 150px;
	background-color: #1a8cff;		
	width:50%;
	color: #fff;
	font-size:24px;	
	font-weight: bold;
}
/* Foto */
@media only screen and (max-width: 700px) {
	video {
		max-width: 100%;
	}
}
/* Fin Foto*/
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script>
$(document).ready(function()
{
    //$('.selectpicker').selectpicker();
// }) 

// $(function() {
	function slideMenu() {
		var activeState = $("#menu-container .menu-list").hasClass("active");
		$("#menu-container .menu-list").animate({left: activeState ? "0%" : "-100%"}, 400);
	}
	$("#menu-wrapper").click(function(event) {
		event.stopPropagation();
		$("#hamburger-menu").toggleClass("open");
		$("#menu-container .menu-list").toggleClass("active");
		slideMenu();

		$("body").toggleClass("overflow-hidden");
	});

	$(".menu-list").find(".accordion-toggle").click(function() {
		$(this).next().toggleClass("open").slideToggle("fast");
		$(this).toggleClass("active-tab").find(".menu-link").toggleClass("active");

		$(".menu-list .accordion-content").not($(this).next()).slideUp("fast").removeClass("open");
		$(".menu-list .accordion-toggle").not(jQuery(this)).removeClass("active-tab").find(".menu-link").removeClass("active");
	});	
	
	$("#camara").hide();
	$("#camaraopc").on('click', function(){
		$("#ppal").css('display', 'none');
		$("#camara").css('display', 'block');
		$("#menu-wrapper").click();
	});

}); // jQuery load
function camara(){
	alert(7);
}
</script>
</head>



<body style="font-family:Verdana;color:#aaaaaa;">

	<div style="background-color:#56B7E9;padding:5px;text-align:center;">
	  <div style="display:flex;justify-content: center;flex-wrap: wrap;"><span class="titulo">Dependiente Judicial...</span></div>

		<!-- Menu -->
		<div id="menu-container">
			<div id="menu-wrapper">
				<div id="hamburger-menu"><span></span><span></span><span></span></div>
				<!-- hamburger-menu -->
			</div>
			<!-- menu-wrapper -->
			<ul class="menu-list accordion">
				<li id="nav1" class="toggle accordion-toggle"> 
					<span class="icon-plus"></span>
					<a class="menu-link" href="#">Herramientas</a>
				</li>
				<!-- accordion-toggle -->
				<ul class="menu-submenu accordion-content" style="text-align: left !important;">
					<li>
						<i class="material-icons" style="vertical-align: middle;">work</i>
						<span><a id="procesos" class="head" href="../pages/tables/pro_proceso.php">Procesos</a></span>
					</li>
					<li><hr></li>
					<li>
						<i class="material-icons" style="vertical-align: middle;">add_a_photo</i>
						<span><a id="camaraopc" class="head" href="#">Fotos</a></span>
					</li>
					<li><hr></li>
					<li>
						<i class="material-icons" style="vertical-align: middle;">today</i>
						<span><a id="agenda" class="head" href="../kal/sample.php">Agenda</a></span>
					</li>
					<li><hr></li>
					<li>
						<i class="material-icons" style="vertical-align: middle;">keyboard_backspace</i>
						<span><a id="retornar" class="head" href="../webtrack/index.php">Volver</a></span>
					</li>
				</ul>
				<!-- menu-submenu accordon-content-->
				<!-- <li id="nav2" class="toggle accordion-toggle">  -->
					<!-- <span class="icon-plus"></span> -->
					<!-- <a class="menu-link" href="#">Menu2</a> -->
				<!-- </li> -->
				
				<!-- accordion-toggle -->
				<!-- <ul class="menu-submenu accordion-content"> -->
					<!-- <li><a class="head" href="#">Submenu1</a></li> -->
					<!-- <li><a class="head" href="#">Submenu2</a></li> -->
				<!-- </ul> -->
				
				<!-- menu-submenu accordon-content-->
				<!-- <li id="nav3" class="toggle accordion-toggle">  -->
					<!-- <span class="icon-plus"></span> -->
					<!-- <a class="menu-link" href="#">Menu3</a> -->
				<!-- </li> -->
				
				<!-- accordion-toggle -->
				<ul class="menu-submenu accordion-content">
					<li><a class="head" href="#">Submenu1</a></li>
					<li><a class="head" href="#">Submenu2</a></li>
					<li><a class="head" href="#">Submenu3</a></li>
					<li><a class="head" href="#">Submenu4</a></li>
				</ul>
				<!-- menu-submenu accordon-content-->
			</ul>
			<!-- menu-list accordion-->
		</div>
	<!-- menu-container -->
		<!-- End -->
	</div>

	<div style="overflow:auto">
		<div id="ladoizq" class="menu">
			<a href="../pages/tables/pro_proceso.php">Procesos</a>
			<a href="#" onClick="javascript:camara();">Fotos</a>			
			<a href="../webtrack/index.php">Volver</a>
			<!-- <a href="#">Link 4</a> -->
		</div>

		<div id="ppal" class="main">
			<h2>Bienvenido</h2>
			<p>Aqui puedes encontrar los recursos que te ofrece nuestra herramienta para realizar tus actividades diarias.</p>
		</div>
		
		<div id="camara" class="main">
			<div>
				<h3>Informaci&oacute;n del Proceso</h3>			
                <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="xcol-xs-10">                                                
                                <label class="form-label">Seleccione N&uacute;mero del Proceso: </label>
                                <div class="xform-line">                                                    
                                    <!-- <select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="nroproceso" id="nroproceso" required> -->
                                    <select  name="nroproceso" id="nroproceso">    
                                        <option value="" >Seleccione Proceso ...</option>
                                        <?php
                                            $idTabla = 0;
                                            include('../apis/proceso/procesorecursos.php');
                                            for($i=0; $i<count($mproceso['pro_proceso']); $i++)
                                            {
                                                $PRO_IdProceso = $mproceso['pro_proceso'][$i]['PRO_IdProceso'];
                                                $PRO_NroProceso = $mproceso['pro_proceso'][$i]['PRO_NumeroProceso'];                                                
                                        ?>
                                                <option value="<?php echo $PRO_NroProceso; ?>" >
                                                    <?php echo $PRO_NroProceso ; ?>                                                
                                                </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <!-- <label class="form-label">Digite N&uacute;mero del Proceso:</label> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>

			
			<div>	
            <label >Selecciona un dispositivo:</label> 
										<select name="listaDeDispositivos" id="listaDeDispositivos"></select>
										<button id="boton">Tomar foto</button>
										<p id="estado"></p>			
				<!-- <div class="form-group">
					<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="row">
									<div class="xcol-xs-10">
										
									</div>
							</div>
					</div>	
				</div> -->
			</div>
			<br>
			<video muted="muted" id="video"></video>
			<canvas id="canvas" style="display: none;"></canvas>
		</div>

		<div id="ladoder" class="right">
			<h3>Publicaciones</h3>
			<p>Consultar Siglo XXI</p>
		</div>
	</div>

	<div style="background-color:#e5e5e5;text-align:center;padding:10px;margin-top:7px;">� Copyright 2019 -  App Jur&iacute;dica     Diseño ::: msmakesof LabS</div>
</body>
<script src="js/camjs/script.js"></script>
</html>
