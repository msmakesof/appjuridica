<?php
include_once("../header.inc.php");
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
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<!-- Bootstrap Core Css -->
<link href="../../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="../../../plugins/node-waves/waves.css" rel="stylesheet" />

<!-- Animation Css -->
<link href="../../../plugins/animate-css/animate.css" rel="stylesheet" />

<!-- Preloader Css -->
<link href="../../../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

<!-- Sweet Alert Css -->
<link href="../../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="../../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<!-- Custom Css -->
<link href="../../../css/style.css" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="../../../css/themes/all-themes.css" rel="stylesheet" />

<!-- Jquery Core Js -->
<script src="../../../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../../../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Jquery Validation Plugin Css -->
<script src="../../../plugins/jquery-validation/jquery.validate.js"></script>

<!-- JQuery Steps Plugin Js -->
<script src="../../../plugins/jquery-steps/jquery.steps.js"></script>

<!-- Sweet Alert Plugin Js -->
<script src="../../../plugins/sweetalert/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../../../plugins/node-waves/waves.js"></script>

<!-- Custom Js -->
<script src="../../../js/admin.js"></script>
<script src="../../../js/pages/forms/form-validation.js"></script>
<script src="../../../plugins/jquery-validation/localization/messages_es.js"></script>

<script src="../../../js/pages/ui/dialogs.js"></script>
<!-- Demo Js -->
<script src="../../../js/demo.js"></script>    

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
					window.location = '../close.php';
					break;
			 
				case "agregar":
					  swal("Un momento", "Reidreccionando...", "success");
					  //AQUI CODIGO DONDE AGREGAS
					  window.location = '../close.php';
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
		window.location = 'index.php';
	}
})
</script>
