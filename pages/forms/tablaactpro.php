<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title></title>	
	<!-- Jquery Core Js
    <script src="../../plugins/jquery/jquery.min.js"></script> -->
    <!-- Bootstrap Core Js -->
    <!-- Select Plugin Js -->    
	<script src="../../plugins/bootstrap/js/bootstrap.js"></script>
	<script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>
	<script src="../../js/pages/tables/jquery-datatable.js"></script>
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
	<script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
</head>
<body>	
		<table class="table table-bordered table-striped table-hover dataTable js-exportable" id="grid">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Actuaci&oacuten Procesal</th>
					<th>Fecha Estado</th>
					<th>Observaci&oacute;n</th>                                        
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Fecha</th>
					<th>Actuaci&oacuten Procesal</th>
					<th>Fecha Estado</th>
					<th>Observaci&oacute;n</th>                                        
				</tr>
			</tfoot>
			<tbody>
			<?php			
			require_once('../../Connections/DataConex.php');
			$midtabla = 0;
			if( isset($idtabla))
			{
				$midtabla = $idtabla;
			}
			
			if ($midtabla == 0)
			{
				if( isset( $_GET["pidtabla"]))
				{
					$midtabla = $_GET["pidtabla"];
				}
			}
			$soportecURL = "S";
			$url         = urlServicios."consultadetalle/consultadetalle_pro_actuacionprocesal.php?IdMostrar=0&E=1&Proceso=".$midtabla ;
			$existe      = "";
			$usulocal    = "";
			$siguex      = "";
			//echo("<script>console.log('PHP proproceso: $url');</script>");
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

				$mactuacionprocesal =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
				$mactuacionprocesal = json_decode($mactuacionprocesal, true);
				//echo("<script>console.log('PHP: ".print_r($mactuacionprocesal)."');</script>");
				//echo("<script>console.log('PHP: ".count($m['pro_proceso'])."');</script>");
				
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
				$mactuacionprocesal = json_decode($resultado, true);	        
			} 
			
			if( $mactuacionprocesal['estado'] != 2)
			{
				$nombre_Tabla = "";
				$contar = count($mactuacionprocesal['pro_actuacionprocesal']);
				for($i=0; $i < $contar; $i++)
				{
						$idTabla = $mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_IdActuacionProcesal'];			
						$FechaCreacion = $mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_FechaCreacion'];
						$Nombre = $mactuacionprocesal['pro_actuacionprocesal'][$i]['TAP_Nombre'];
						$FechaHabil = $mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_FechaHabil'];
						$Observaciones = trim($mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_Observaciones']);
						$estadoTabla = trim($mactuacionprocesal['pro_actuacionprocesal'][$i]['APR_EstadoActProcesal']);       
				?>
					<tr>            
						<td><?php echo $FechaCreacion; ?></td>
						<td><?php echo $Nombre; ?></td>
						<td><?php echo $FechaHabil; ?></td>            
						<td><?php echo $Observaciones; ?></td>            
					</tr>
				<?php                          
				}
			}
			?>
			</tbody>
		</table>	
</body>
</html>