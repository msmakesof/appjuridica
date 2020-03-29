<?php
	session_start(); 
	
	//require_once('../Connections/cnn_kn.php');	
/* */
        //grabo datos del acceso
        /**         
         * Obtener y guardar la IP de un visitante en PHP         
         * @author parzibyte
         */
		$IdUsuario =  $_SESSION['IdUsuario'];
        # Para obtener la fecha correcta hay que poner la zona horaria
        date_default_timezone_set("America/Bogota");
        $fechaHoraIngreso = date("Y-m-d H:i:s");
        # Si no hay REMOTE_ADDR entonces ponemos "Desconocida"
        $ipInterna = empty($_SERVER["REMOTE_ADDR"]) ? "Desconocida" : $_SERVER["REMOTE_ADDR"];        
        $nombreHost = gethostbyaddr($_SERVER['REMOTE_ADDR']);            
        $servidor = $_SERVER['SERVER_NAME'];
        $puerto = $_SERVER['REMOTE_PORT'];
        $agente = $_SERVER['HTTP_USER_AGENT'];
        
		/*
		$parameters = "insert=insert&IdUsuario=$IdUsuario&IpInterna=$ipInterna&FechaAcceso=$fechaHoraIngreso&NombreHost=$nombreHost&Puerto=$puerto&Servidor=$servidor&Agente=$agente";        
        $url   = urlServicios."consultadetalle/consultadetalle_usu_acceso.php?".$parameters;
        //echo "<script>console.log(".$url.");</script>";

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

            $json_errors = array(
                JSON_ERROR_NONE => 'No se ha producido ningún error',
                JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
                JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
                JSON_ERROR_SYNTAX => 'Error de Sintaxis',
            );
            
            //echo $m['$usu_acceso']['estado'];  //[$usu_acceso["estado"];
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
        */ 
?>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../js/jsRelocate.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	let IdUsuario = "";
	let ipInterna = "";
	let fechaHoraIngreso = "";
	let nombreHost = "";
	let puerto = "";
	let servidor = "";
	let agente = "";
	let ipExterna = "";
	let hostname = "";
	let region = "";
	let pais = "";
	let lat_long = "";
	let latitud = "";
	let longitud = "";
	let organizacion = "";
	let codigopostal = "";	
    $.getJSON("https://ipinfo.io", function (response) {
        ipExterna = response.ip;
		hostname = response.hostname;
		region = response.region;
		pais = response.country;		
		lat_lon = response.loc.split(',');
        var coords = {
            latitud: lat_lon[0],
            longitud: lat_lon[1]
        };
		latitud = coords.latitud;
		longitud = coords.longitud;		
		organizacion = response.org;
		codigopostal = response.postal;
		
		IdUsuario = "<?php echo $IdUsuario; ?>";
		ipInterna = "<?php echo $ipInterna; ?>";
		fechaHoraIngreso = "<?php echo $fechaHoraIngreso; ?>";
		nombreHost = "<?php echo $nombreHost; ?>";
		puerto = "<?php echo $puerto; ?>";
		servidor = "<?php echo $servidor; ?>";
		agente = "<?php echo $agente; ?>";
		
		$.ajax({			
			data : {"IdUsuario":IdUsuario, "ipInterna":ipInterna, "fechaHoraIngreso":fechaHoraIngreso, "nombreHost":nombreHost, "puerto":puerto, "servidor":servidor, "agente":agente,"ipExterna":ipExterna,"hostname":hostname,"region":region,"pais":pais,"latitud":latitud,"longitud":longitud,"organizacion":organizacion,"codigopostal":codigopostal},
			type: "GET",
			dataType: "html",
			url : "forms/crea_usuacceso.php",
		})
		.done(function( dataX, textStatus, jqXHR ){
			var respstr = dataX.trim(); 
			 if( respstr.substr(0,1) == "S" )
			{   						
				relocate("tables/");
			}
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			if ( console && console.log ) 
			{
				console.log( "La solicitud a fallado: " +  textStatus);
			}
		});		
    });	
})
</script>