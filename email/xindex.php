<?php 
include_once("../pages/tables/header.inc.php");
//require_once ('../Connections/DataConex.php');

if (!function_exists("GetSQLValueString")) 
{
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    if (PHP_VERSION < 6) 
    {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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

$origen = "";
$accion = "";
if(isset($_POST["origen"]))
{
  $origen = $_POST["origen"];
}

$emailAbogado = "";
$IdenDemandante = "";
$IdenDemandado = "";
$AbreDemandante ="";
$AbreDemandado ="";
$subject = "";
$mensaje = "";
if ($origen == "a")
{
	$from ="";
	if( isset($_POST['from']) )
	{
		$from = trim($_POST['from']);
		//$from = str_replace(' ','%20', $from);
	}

	$to ="";
	if( isset($_POST['to']) )
	{
		$to = trim($_POST['to']);
		//$to = str_replace(' ','%20', $to);
	}

	$proceso ="";
	if( isset($_POST['proceso']) )
	{
		$proceso = trim($_POST['proceso']);	
	
		//Busco el email del abogago q tiene asignado el Proceso
		$pproceso = $proceso;
		require_once('../apis/proceso/procesoemail.php');
		
		//Busco el email del abogago q tiene asignado el Proceso
		$emailAbogado = $mproceso['pro_proceso']['USU_Email'];;
		//
	}

	$responsable ="";
	if( isset($_POST['responsable']) )
	{
		$responsable = trim($_POST['responsable']);
	}

	$tipo ="";
	if( isset($_POST['tipo']) )
	{
		$tipo = trim($_POST['tipo']);
	}

	$title ="";
	if( isset($_POST['title']) )
	{
		$title = trim($_POST['title']);
		//$title = str_replace(' ','%20', $title);    
	}

	$body ="";
	if( isset($_POST['body']) )
	{
		$body = trim($_POST['body']);
		//$body = str_replace(' ','%20', $body);
	}

	$nr ="";
	if( isset($_POST['nr']) )
	{
		$nr = strtoupper(trim($_POST['nr']));
	}
	$np ="";
	if( isset($_POST['np']) )
	{
		$np = trim($_POST['np']);
	}
	
	/*
	$subject = "**  Agenda Proceso Nro. $np **" ;
	$mensaje = "<p>Le ha sido asignada una actividad en su Agenda con la siguiente informaci&oacute;n:<br><hr>
				<b>Fecha/Hora Inicio:</b> $to <br>
				<b>Fecha/Hora Finalizaci&oacute;n:</b> $from<br>
				<b>Apoderado(a):</b> $nr<br>
				<b>Tipo de Actividad:</b> $title<br>
				<b>Observaciones:</b> $body<hr><br><br>
				</p>Cordialmente,<br><br><br>Sistema de Gesti&oacute;n de Agenda.<br>AppJur&iacute;dica";
	*/
}
else
{
	$pnombre="";
	if( isset($_POST['pnombre']) )
	{
		$pnombre = trim($_POST['pnombre']);
	}
	$pfechainicio = "";
	if( isset($_POST['pfechainicio']) )
	{
		$pfechainicio = trim($_POST['pfechainicio']);
	}
	$pusuario ="";
	if( isset($_POST['pusuario']) )
	{
		$pusuario = trim($_POST['pusuario']);
	}
	$pubicacion = "";
	if( isset($_POST['pubicacion']) )
	{
		$pubicacion = trim($_POST['pubicacion']);
	}
	$pclaseproceso = "";
	if( isset($_POST['pclaseproceso']) )
	{
		$pclaseproceso = trim($_POST['pclaseproceso']);
	}
	$pjuzgado  ="";
	if( isset($_POST['pjuzgado']) )
	{
		$pjuzgado = trim($_POST['pjuzgado']);
	}
	$pestado = "";
	if( isset($_POST['pestado']) )
	{
		$pestado = trim($_POST['pestado']);
	}
	$pproceso = "";
	$maxid = "";
	if( isset($_POST['maxid']) )
	{
		$maxid = $_POST['maxid'];
	}	
	
	if(isset($_POST['accion']))
	{
		$accion = $_POST['accion'];
	}	
	
	$pnproceso = "";
	if( isset($_POST['pnproceso']) )
	{
		$pnproceso = trim($_POST['pnproceso']);
	}
	
	if(isset($_POST['enviaemailcli']))
	{
		$enviaemailcli =$_POST['enviaemailcli'];
	}
	
	if( isset($_POST['pproceso']) )
	{
		//$pproceso = trim($_POST['pproceso']);		
		$pproceso = $maxid;

		require_once('../apis/proceso/procesoemail.php');
		
		//Busco el email del abogado q tiene asignado al Proceso
		$NumeroProceso = $mproceso['pro_proceso']['PRO_NumeroProceso'];
		$emailAbogado = $mproceso['pro_proceso']['USU_Email'];
		$IdenDemandante = $mproceso['pro_proceso']['IdenDemandante'];
		$EmailCliente = trim($mproceso['pro_proceso']['EmailCliente']);
		$IdenDemandado = $mproceso['pro_proceso']['IdenDemandado'];
		$AbreDemandante = trim($mproceso['pro_proceso']['AbreDemandante']);
		$AbreDemandado = trim($mproceso['pro_proceso']['AbreDemandado']);
		//
		if($accion == "u")
		{
			$pproceso = $NumeroProceso;
		}
		if(strlen($pproceso) < 23 )
		{
			$pproceso = $maxid;
		}
	}
	
	$pcliente = "";
	if( isset($_POST['pcliente']) )
	{
		$pcliente = trim($_POST['pcliente']);
	}
	$pdemandado = "";
	if( isset($_POST['pdemandado']) )
	{
		$pdemandado = trim($_POST['pdemandado']);
	}
	$pespecialidad = "";
	if( isset($_POST['pespecialidad']) )
	{
		$pespecialidad = trim($_POST['pespecialidad']);
	}
	$pdespacho = "";
	if( isset($_POST['pdespacho']) )
	{
		$pdespacho = trim($_POST['pdespacho']);
	}
	$nombreciu = "";
	if( isset($_POST['nombreciu']) )
	{
		$nombreciu = trim($_POST['nombreciu']);
	}
	$corporacion ="";
	if( isset($_POST['corporacion']) )
	{
		$corporacion = trim($_POST['corporacion']);
	}
	$area ="";
	if( isset($_POST['area']) )
	{
		$area = trim($_POST['area']);
	}
	$despacho ="";
	if( isset($_POST['despacho']) )
	{
		$despacho = trim($_POST['despacho']);
	}
	$asignadoa ="";
	if( isset($_POST['asignadoa']) )
	{
		$asignadoa = strtoupper(trim($_POST['asignadoa']));
	}
	$ubicacion ="";
	if( isset($_POST['ubicacion']) )
	{
		$ubicacion = trim($_POST['ubicacion']);
	}
	$claseproceso = "";
	if( isset($_POST['claseproceso']) )
	{
		$claseproceso = trim($_POST['claseproceso']);
	}
	$cliente ="";
	if( isset($_POST['cliente']) )
	{
		$cliente = strtoupper(trim($_POST['cliente']));
	}
	$demandado = "";
	if( isset($_POST['demandado']) )
	{
		$demandado = strtoupper(trim($_POST['demandado']));
	}
	$txtEstado = "";
	
	if(strlen($pproceso) < 23)
	{
		$txtEstado = " en Reparto.";
	}
	
	/*
	$subject = "**  Proceso Nro. $pproceso asignado  **" ;
	$mensaje = "<p>Le ha sido asignado el Proceso Judicial con la siguiente informaci&oacute;n:<br><hr>				
				<b>Proceso Nro.:</b> $pproceso<br>
				<b>Ciudad:</b> $nombreciu<br>
				<b>Corporaci&oacute;n / Juzgado:</b> $corporacion<br>
				<b>Especialidad / Area:</b> $area<br>
				<b>Despacho:</b> $despacho<br>
				<b>Fecha/Hora Creaci&oacute;n:</b> $pfechainicio <br>
				<b>Apoderado(a):</b> $asignadoa<br>				
				<b>Ubicaci&oacute;n:</b> $ubicacion<br>
				<b>Clase Proceso:</b> $claseproceso<br>				
				<b>Estado:</b> Activo $txtEstado<br>
				<b>Cliente:</b> $cliente<br>
				$AbreDemandante No. : $IdenDemandante<br>	
				<b>Demandado:</b> $demandado<br>
				$AbreDemandado No. : $IdenDemandado<br><br>					
				</p>Cordialmente,<br><br><br>Sistema de Gesti&oacute;n de Procesos.<br>Litigantes";
	*/
}
?>

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
		let asunto = "";
		let mensaje = "";
		let emailAbogado = "";
		let emailCliente = "";
		
		//asunto  = "<?php echo $subject; ?>";
		//mensaje = "<?php echo $mensaje; ?>";
		emailAbogado = "<?php echo $emailAbogado; ?>";
		emailCliente = "<?php echo $EmailCliente; ?>";		
		
		pnombre = "<?php echo $pnombre; ?>";
		pfechainicio = "<?php echo $pfechainicio; ?>";
		pusuario  = "<?php echo $pusuario; ?>";
		pubicacion  = "<?php echo $pubicacion; ?>";		
		pclaseproceso = "<?php echo $pclaseproceso; ?>";
		pjuzgado = "<?php echo $pjuzgado; ?>";
		pestado = "<?php echo $pestado; ?>";
		
		pproceso = "<?php echo $pproceso; ?>";
		pcliente = "<?php echo $pcliente; ?>";
		pdemandado = "<?php echo $pdemandado; ?>";
		pespecialidad = "<?php echo $pespecialidad; ?>";
		pdespacho = "<?php echo $pdespacho; ?>";
		origen = "<?php echo $origen; ?>";
		nombreciu = "<?php echo $nombreciu; ?>";
		corporacion = "<?php echo $corporacion; ?>";
		area = "<?php echo $area; ?>";
		despacho = "<?php echo despacho; ?>";
		asignadoa = "<?php echo $asignadoa; ?>";
		ubicacion = "<?php echo $ubicacion; ?>";
		claseproceso = "<?php echo $claseproceso; ?>";
		cliente = "<?php echo $cliente; ?>";
		demandado = "<?php echo $demandado; ?>";
		maxid = "<?php echo $maxid; ?>";
		//
		
		$.ajax({			
			data : {"pnombre": nombre, "pfechainicio": fechainicio, "pusuario": usuario, "pubicacion": ubicacion, "pclaseproceso": claseproceso ,"pjuzgado": juzgado,"pestado": estado, "pproceso": pproceso,"pcliente": cliente, "pdemandado":demandado, "pespecialidad":especialidad, "pdespacho":despacho, "origen": origen, "nombreciu": nombreciu, "corporacion": corporacion, "area": area, "despacho": despacho, "asignadoa": asignadoa, "ubicacion": ubicacion, "claseproceso": claseproceso, "cliente": cliente, "demandado": demandado, "maxid": maxid},
			type: "POST",
			dataType: "html",
			url : "./email.php",
		
			beforeSend: function () 
			{ 				
				$("#precargamsj").html('<div><img src="../../loading/carga.gif"/></div>');                
			},
			success: function( dataX, textStatus, jqXHR )
			{
				console.log('dataX ....' + dataX);
				$("#precargamsj").hide();
				var respstr = dataX.trim(); 
				 if( respstr.substr(0,1) == "S" )
				{   						
					//relocate("tables/");
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
	
	})
	</script>


    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader" style="z-index:3000 !important;">			
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p> Enviando Email ...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    
	<!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
	
	<div id="precargamsj"></div> 
