<?php
include_once("../pages/tables/header.inc.php");
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL,"es_ES");

/* Fehca y Hora del server para que desde el cliente no puedan modificar la fecha */
//setlocale(LC_ALL,"es_CO");
$zonahoraria = date_default_timezone_get();
//echo 'Zona horaria predeterminada del server: ' . $zonahoraria;
$zonahoraria = date_default_timezone_set('America/Bogota');
//echo '<br>Zona horaria predeterminada: ' . $zonahoraria;
$zonahoraria1 = date_default_timezone_get('America/Bogota');
//echo '<br>Zona horaria predeterminada: ' . $zonahoraria1;
$hoy = getdate();
//print_r($hoy);
$nombredia = "";
$nrodia = $hoy['wday'];
$dia = $hoy['mday'];
if( strlen($dia) == 1 )
{
	$dia = "0".$dia;
}
switch($nrodia)
{
	case 0:
		$nombredia = "Sun";
		//$dia = $dia + 1;
		break;
	case 1:
		$nombredia = "Mon";
		break;
	case 2:
		$nombredia = "Tue";
		break;
	case 3:
		$nombredia = "Wed";
		break;
	case 4:
		$nombredia = "Thu";
		break;
	case 5:
		$nombredia = "Fri";
		break;
	case 6:
		$nombredia = "Sat";
		//$dia = $dia + 2;
		break;	
}
//echo $hoy['month']."<br>";
//echo date("M")."<br>";
$fecha_actual = $nombredia." ". date("M") ." ". $dia ." ". $hoy['year']." ". $hoy['hours'].":".$hoy['minutes'].":".$hoy['seconds']." GMT-0500 (hora estandar de Colombia)";
$comparaph = substr($fecha_actual, 0,15);
?>
<!-- Sweet Alert Css -->
<link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
<!-- Jquery Core Js -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Sweet Alert Plugin Js -->
<script src="../plugins/sweetalert/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- <script src="../js/alertify.min.js"></script> -->
<script type="text/javascript">    
$(document).ready(function()
{
	var x = new Date();
	var fechajs = x.toString();
	comparajs = fechajs.substring(0,15);
	
	console.log(comparajs);
	console.log("<?php echo $comparaph; ?>");
	
	var comparaphp = "<?php echo $comparaph; ?>";
	if (comparajs !== comparaphp)
	{			
		swal("Tu computador tiene fecha diferente a la actual.  Debes revisar esto.", "Desea continuar?", "info", {
			buttons: {
				cancelar: { text: "Cancelar"
				},
				agregar: {
				  text: "Continuar"
				},
			},
		})
		.then((value) => {
			switch (value) {
		 
				case "cancelar":
					swal("Volver a pagina de inicio","","warning");
					//CODIGO DE NO AGREGADO O LO QUE QUIERAS HACER
					window.location = '../';
					break;
			 
				case "agregar":
					  swal("Un momento", "Reidreccionando...", "success");
					  //AQUI CODIGO DONDE AGREGAS
					  window.location = '../';
					  break;
			}
		});
		
		/*
		swal('Atencion: ', 'Tu computador tiene fecha diferente a la actual.  Debes revisar', 'error');
		alertify.confirm( 'Continuar ?', function (e) {
			if (e) {				
				window.location = '../header/';
			}
			else {
				//after clicking Cancel
			}				
		});
		*/		
	}
	else
	{
		//	window.location = 'template.php';
		window.location = 'index.php';
	}
})
</script>