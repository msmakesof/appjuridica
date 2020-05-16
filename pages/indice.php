<?php
include_once("./tables/header.inc.php");
	//session_start();         
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

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title></title> 
	<!-- Animation Css -->
	<link href="../plugins/animate-css/animate.css" rel="stylesheet" />
	<!-- Preloader Css -->
	<link href="../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
 	
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
			
				beforeSend: function () 
				{ 
					$("#precargamsj").html('<div><img src="../images/load.gif"/></div>');
				},
				success: function( dataX, textStatus, jqXHR )
				{
					$("#precargamsj").hide();
					var respstr = dataX.trim(); 
					 if( respstr.substr(0,1) == "S" )
					{   						
						relocate("tables/");
					}
				},
				error: function( jqXHR, textStatus, errorThrown ) 
				{
					if ( console && console.log ) 
					{
						console.log( "La solicitud a fallado: " +  textStatus);
					}
				}	
			});		
		}).fail(function(d) {

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
				beforeSend: function () 
				{ 
					$("#precargamsj").html('<div><img src="../images/load.gif"/></div>');                
				},
				success: function( dataX, textStatus, jqXHR )
				{
					var respstr = dataX.trim(); 
					 if( respstr.substr(0,1) == "S" )
					{   						
						relocate("tables/");
					}
				},
				error: function( jqXHR, textStatus, errorThrown ) 
				{
					if ( console && console.log ) 
					{
						console.log( "La solicitud a fallado: " +  textStatus);
					}
				}	
			});	
		});	
	})
	</script>
</head>

<body  style="background-color: #ffdd90; opacity: 0.2; background-image: url(../images/img.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed;">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader" style="z-index:3000 !important;">
			<h2>Buen día <?php echo strtoupper($_SESSION['NombreUsuario']) ; ?> ,</h2>
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p> el sistema está preparando todo el Ambiente de Información ...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    
	<!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
	
	<div id="precargamsj"></div> 

</body>
</html>