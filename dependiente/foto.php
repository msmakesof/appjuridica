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
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script>
$(document).ready(function()
{
    //$('.selectpicker').selectpicker();
// }) 

// $(function() {
	// function slideMenu() {
	// 	var activeState = $("#menu-container .menu-list").hasClass("active");
	// 	$("#menu-container .menu-list").animate({left: activeState ? "0%" : "-100%"}, 400);
	// }
	// $("#menu-wrapper").click(function(event) {
	// 	event.stopPropagation();
	// 	$("#hamburger-menu").toggleClass("open");
	// 	$("#menu-container .menu-list").toggleClass("active");
	// 	slideMenu();

	// 	$("body").toggleClass("overflow-hidden");
	// });

	// $(".menu-list").find(".accordion-toggle").click(function() {
	// 	$(this).next().toggleClass("open").slideToggle("fast");
	// 	$(this).toggleClass("active-tab").find(".menu-link").toggleClass("active");

	// 	$(".menu-list .accordion-content").not($(this).next()).slideUp("fast").removeClass("open");
	// 	$(".menu-list .accordion-toggle").not(jQuery(this)).removeClass("active-tab").find(".menu-link").removeClass("active");
	// });	
	
	$("#camaraopc").show();
	$("#camaraopc").on('click', function(){
		//$("#ppal").css('display', 'none');
		$("#camara").css('display', 'block');
		//$("#menu-wrapper").click();
	});

}); 
</script>
</head>
<body style="font-family:Verdana;color:#aaaaaa;">

	<div style="overflow:auto">
			
		
		<div id="camaraopc">
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
            
            <a href="./">Volver</a>
		</div>
	</div>	
</body>
<script src="js/camjs/script.js"></script>
</html>
