<?php require_once('Connections/cnn_plan_mejora.php'); ?>
<?php
require_once("sesion.class.php");

$sesion = new sesion();
$usuario = $sesion->get("usuario");

if( $usuario == false )
{	
	header("Location: index.php");		
}
else 
{


if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
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

$colname_rs_empleado = $usuario;

$colname_rs_empleado = "-1";
if (isset($usuario)) {
  $colname_rs_empleado = $usuario;
}
mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_empleado = sprintf("SELECT nombreEmp, cod_suc, control, graba, modifica, consulta, borra, muestra_botones, racol, admin, racolp FROM empleados WHERE usuario = %s", GetSQLValueString($colname_rs_empleado, "text"));
$rs_empleado = mysql_query($query_rs_empleado, $cnn_plan_mejora) or die(mysql_error());
$row_rs_empleado = mysql_fetch_assoc($rs_empleado);
$totalRows_rs_empleado = mysql_num_rows($rs_empleado);

$isadmin = $row_rs_empleado['admin'];
$kontrol = $row_rs_empleado['control'];
$aseguir = str_replace(",","','",$row_rs_empleado['ver']);
$racolp = $row_rs_empleado['racolp'];
//echo $isadmin;
//echo "control..........$kontrol";
$_SESSION['muestra_botones'] = $row_rs_empleado['muestra_botones'];
//
if($kontrol == "A" )
{	
	header("Location: formato/indexgen.php");		
}
//




// MUESTRA LOS VENCIDOS
mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_vencidos = "SELECT * FROM planmanejo WHERE fecha_fin < CURDATE()";
$rs_vencidos = mysql_query($query_rs_vencidos, $cnn_plan_mejora) or die(mysql_error());
$row_rs_vencidos = mysql_fetch_assoc($rs_vencidos);
$totalRows_rs_vencidos = mysql_num_rows($rs_vencidos);

$msg_vencidos = "";
if($totalRows_rs_vencidos==0)
{$msg_vencidos= "No hay vencimientos registrados.";}
else{$msg_vencidos = "Registros con vecimiento ".$totalRows_rs_vencidos;}

// Actividades a seguir de sus procesos y Coordinaciones
mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
if($aseguir != ""){
	 $query_rs_seguir = "SELECT * FROM procesos WHERE abr2 IN ('$aseguir') AND estado = 'A' order By proceson;";
}
else{
	 $query_rs_seguir = "SELECT * FROM procesos WHERE abr2 IN ('$racolp') AND estado = 'A' order By proceson;";
}
$rs_seguir = mysql_query($query_rs_seguir, $cnn_plan_mejora) or die(mysql_error());
$row_rs_seguir = mysql_fetch_assoc($rs_seguir);
$totalRows_rs_seguir = mysql_num_rows($rs_seguir);
$nombre_res = $row_rs_seguir['nombre_res'];
//echo $nombre_res;

// Actividades para el día actual
mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
if($aseguir != ""){ // si se trata de una direccion o subdireccion
$query_rs_vendia = "SELECT * FROM jqcalendar WHERE Location IN ('$racolp') AND StartTime = CURDATE() order By StartTime;";
}
else{
	//$nombre_res
$query_rs_vendia = "SELECT * FROM jqcalendar WHERE responsable IN ('$racolp') AND StartTime = CURDATE() order By StartTime;";
}
$rs_vendia = mysql_query($query_rs_vendia, $cnn_plan_mejora) or die(mysql_error());
$row_rs_vendia = mysql_fetch_assoc($rs_vendia);
$totalRows_rs_vendia = mysql_num_rows($rs_vendia);
//echo $query_rs_vendia;


// Actividades proximas a vencer
mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
if($aseguir != ""){
$query_rs_prox= "select id,StartTime, count(StartTime) as x from jqcalendar WHERE Location IN ('$racolp') AND tipolista = '1' and StartTime between CURDATE() AND CURDATE()+6 GROUP BY StartTime;";
}
else{
	 //$nombre_res
	$query_rs_prox= "select id,StartTime, count(StartTime) as x from jqcalendar WHERE responsable IN ('$racolp') AND tipolista = '1' and StartTime between CURDATE() AND CURDATE()+6 GROUP BY StartTime;";

}
//echo $query_rs_prox;
$rs_prox = mysql_query($query_rs_prox, $cnn_plan_mejora) or die(mysql_error());
$row_rs_prox = mysql_fetch_assoc($rs_prox);
$totalRows_rs_prox = mysql_num_rows($rs_prox);


// Capacitaciones dirigidas por su proceso 
mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_suscapac = "SELECT DISTINCT jqcalendar.StartTime, procesos.nombre_res capacitador, temas.nombre nomtema  FROM jqcalendar JOIN procesos ON procesos.abr2 = jqcalendar.capacitador AND procesos.estado ='A' JOIN temas ON temas.id = jqcalendar.tema WHERE capacitador ='$racolp' AND tipolista = '2' AND YEAR(StartTime) = YEAR(CURDATE()) and MONTH(StartTime) = MONTH(CURDATE())  order By StartTime;";
$rs_suscapac = mysql_query($query_rs_suscapac, $cnn_plan_mejora) or die(mysql_error());
$row_rs_suscapac = mysql_fetch_assoc($rs_suscapac);
$totalRows_rs_suscapac = mysql_num_rows($rs_suscapac);
//echo "capac dirigidas por su proceso: ......$query_rs_suscapac<br>";

// Capacitaciones dirigidas a su proceso
mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_cap_dir_a = "SELECT jqcalendar.*, procesos.nombre_res capacitador, temas.nombre nomtema FROM jqcalendar JOIN procesos ON procesos.abr2 = jqcalendar.capacitador AND procesos.estado ='A' JOIN temas ON temas.id = jqcalendar.tema WHERE dirigido_a IN ('$racolp','T') AND tipolista = '2' AND YEAR(StartTime) = YEAR(CURDATE()) and MONTH(StartTime) = MONTH(CURDATE())  order By StartTime;";
$rs_cap_dir_a = mysql_query($query_rs_cap_dir_a, $cnn_plan_mejora) or die(mysql_error());
$row_rs_cap_dir_a = mysql_fetch_assoc($rs_cap_dir_a);
$totalRows_rs_cap_dir_a = mysql_num_rows($rs_cap_dir_a);
//echo "capac dirigidas a su proceso: ......$query_rs_cap_dir_a<br>";


//
// Cantidad de Comites que Preside su proceso
mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_xprescomite = "SELECT jqcalendar.Id, StartTime, presid.nombre_res as presidente, actividad, secret.nombre_res as nomsecretario FROM jqcalendar left outer JOIN procesos as secret ON secret.abr2 = jqcalendar.secretario left outer JOIN procesos as presid ON presid.abr2 = jqcalendar.responsable left outer JOIN procesos as dirigidoa ON dirigidoa.abr2 = jqcalendar.dirigido_a WHERE responsable IN ('$racolp') AND tipolista = '3' AND YEAR(StartTime) = YEAR(CURDATE()) and MONTH(StartTime) = MONTH(CURDATE()) AND dirigido_a = '$racolp' Order By StartTime;";
$rs_xprescomite = mysql_query($query_rs_xprescomite, $cnn_plan_mejora) or die(mysql_error());
$row_rs_xprescomite = mysql_fetch_assoc($rs_xprescomite);
$totalRows_rs_xprescomite = mysql_num_rows($rs_xprescomite);
//echo "Xprescomite...............$query_rs_xprescomite<br>";

// Comites : Lista que presenta a quien o quienes va dirigido el comité dentro de su proceso
mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_prescomite = "SELECT DISTINCT dirigidoa.nombre_res as nomdirigidoa FROM jqcalendar left outer JOIN procesos as secret ON secret.abr2 = jqcalendar.secretario left outer JOIN procesos as presid ON presid.abr2 = jqcalendar.responsable left outer JOIN procesos as dirigidoa ON dirigidoa.abr2 = jqcalendar.dirigido_a WHERE dirigido_a IN ('$racolp') AND tipolista = '3' AND YEAR(StartTime) = YEAR(CURDATE()) and MONTH(StartTime) = MONTH(CURDATE()) order By nomdirigidoa;";
$rs_prescomite = mysql_query($query_rs_prescomite, $cnn_plan_mejora) or die(mysql_error());
$row_rs_prescomite = mysql_fetch_assoc($rs_prescomite);
$totalRows_rs_prescomite = mysql_num_rows($rs_prescomite);
$nomdirigidoa= "";
do {
		if($nomdirigidoa == ""){
				$nomdirigidoa = $row_rs_prescomite['nomdirigidoa'];												
		}
		else {
				$nomdirigidoa .= ", ".$row_rs_prescomite['nomdirigidoa'];	
		}
}	while($row_rs_prescomite = mysql_fetch_assoc($rs_prescomite));
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>..::: Inter Rapidísimo   -  Plan de Mejoramiento.   :::..</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta content='IE=9' http-equiv='X-UA-Compatible'/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!—[if lt IE 9]>
  <script src="acciones/html5.js"></script>
<![endif]—>

<style>
  body { padding-top: 60px; }
</style>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="acciones/css/base.css" media="all"/>
<link rel="stylesheet" type="text/css" href="acciones/css/tablas.css" media="all"/>
<link rel="stylesheet" type="text/css" href="acciones/css/gral.css" media="all"/>
<link rel="stylesheet" type="text/css" href="fondo.css" media="all"/>
<link rel="stylesheet" href="tinybox2/style.css" />
<link rel="stylesheet" href="libsweb/jqwidgets/styles/jqx.base.css" type="text/css" />
<script src="acciones/jquery181.js"></script>
<script type="text/javascript" src="tinybox2/tinybox.js"></script>
<script type="text/javascript" src="libsweb/scripts/gettheme.js"></script>
<script type="text/javascript" src="libsweb/scripts/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="libsweb/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="libsweb/jqwidgets/jqxmenu.js"></script>
<script>
function abrirVentana(pps) {
    var caracteristicas="width="+screen.availWidth+";";
    caracteristicas+="height="+screen.availHeight;
    window.open(pps,'pps',caracteristicas);
}
</script>
</head>
<body>
 <form ACTION="" METHOD="POST" name="form1">
<div align="center">

<div class="container" id="general">
 <div id="mass" class="row">
  <div id="encabezado" class="span12">
	<div class="span2">&nbsp;</div>
    <div class="kfizq" id="logo"><img src="imgs/logo.jpg" width="222" height="59" /></div>    
    <div class="kfder"><span class="txts">HERRAMIENTA DE PLANEACIÓN, AUDITORÍAS Y MEJORAMIENTO.</span></div>
    <div class="span2"> </div>    
 </div>
 </div>
 <br>
 <div align="center">
 <table width="96%" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td>
		<div id="kfizquierdaf" class="kfimgshadow kfradius btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Bienvenido(a): ".$row_rs_empleado['nombreEmp']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">
		<div id="kfizquierdaf" class="kfimgshadow kfradius btn btn-danger">
		<a href="cerrarsesion.php" class="btn btn-danger"> Cerrar Sesi&oacute;n </a>
		</div>
		</td>
  </tr>
</table>
</div><br><hr>
 <div id='content'>
        <script type="text/javascript">
            $(document).ready(function () {
                var theme = getDemoTheme();
                // Create a jqxMenu
                $("#jqxMenu").jqxMenu({ width: '720', height: '30px', theme: theme });
                $("#jqxMenu").css('visibility', 'visible');
                $("#disabled").jqxCheckBox({ theme: theme, width: '150px', height: '20px' });
                $("#open").jqxCheckBox({ theme: theme, width: '150px', height: '20px' });
                $("#hover").jqxCheckBox({ theme: theme, width: '150px', height: '20px' });
                $("#topLevelArrows").jqxCheckBox({ theme: theme, width: '200px', height: '20px' });
                $("#animation").jqxCheckBox({ theme: theme, width: '150px', height: '20px' });
                $("#animation").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the menu's animation.
                    if (!value) {
                        $("#jqxMenu").jqxMenu({ animationShowDuration: 0, animationHideDuration: 0, animationShowDelay: 0 });
                    }
                    else {
                        $("#jqxMenu").jqxMenu({ animationShowDuration: 300, animationHideDuration: 200, animationShowDelay: 200 });
                    }
                });
                $("#disabled").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the menu
                    if (!value) {
                        $("#jqxMenu").jqxMenu({ disabled: false });
                    }
                    else {
                        $("#jqxMenu").jqxMenu({ disabled: true });
                    }
                });
                $("#hover").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the menu's hover effect.
                    if (!value) {
                        $("#jqxMenu").jqxMenu({ enableHover: false });
                    }
                    else {
                        $("#jqxMenu").jqxMenu({ enableHover: true });
                    }
                });
                $("#open").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the opening of the top level menu items when the user hovers them.
                    if (!value) {
                        $("#jqxMenu").jqxMenu({ autoOpen: false });
                    }
                    else {
                        $("#jqxMenu").jqxMenu({ autoOpen: true });
                    }
                });
                $("#topLevelArrows").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the opening of the top level menu items when the user hovers them.
                    if (!value) {
                        $("#jqxMenu").jqxMenu({ showTopLevelArrows: false });
                    }
                    else {
                        $("#jqxMenu").jqxMenu({ showTopLevelArrows: true });
                    }
                });
								
								$('#grupos').click(function(){
								  window.location.href = 'dataTables/grupos.php';
							 });
            });
        </script>
        <div id='jqxWidget' style='height: auto;'>
            <div id='jqxMenu' style='visibility: hidden; margin-left: 5px;'>
                <ul>
                    <li>.: Administraci&oacute;n
                        <ul style='width: 270px;'>
                            <li>
															<a href="#" onclick="TINY.box.show({iframe:'addconex.php',boxid:'frameless',width:1000,height:540,fixed:false,maskid:'blackmask',maskopacity:40,closejs:function(){closeJS()}})">
<!--<a href="addconex.php">-->
															<img src="imgs/conexion4.png" width="25" height="25" style='float: left; margin-right: 5px;' /> Conexi&oacute;n
															<div align="center" style="float:none;font-size:9px;color:#36F;">
																(Consultar, Crear, Modificar, Borrar.)
															</div></a>
														</li>
														<li>
														<a href="#" onclick="TINY.box.show({iframe:'addcorreo.php',boxid:'frameless',width:1000,height:680,fixed:false,maskid:'blackmask',maskopacity:40,closejs:function(){closeJS()}})">
															<img src="imgs/email4.png" width="25" height="25" style='float: left; margin-right: 5px;' />
															Correo
															<div align="center" style="float:none;font-size:9px;color:#36F;">
																(Consultar, Crear, Modificar, Borrar.)
															</div></a>
														</li>
														<li>
															<img src="imgs/grupos3.png" width="25" height="25" style='float: left; margin-right: 5px;' />
															<!--<a href="grupos/index.php">Grupos</a>-->
															<a href="javascript:void(0);" id="grupos">Grupos</a>
															<div align="center" style="float:none;font-size:9px;color:#36F;">
																(Consultar, Crear, Modificar, Borrar.)
															</div>
														</li>
														<li>
															<img src='imgs/users.jpg' width="25" height="25" style='float: left; margin-right: 5px;' />
															<a href="usuarios/index.php">Usuarios</a>														
															<div align="center" style="float:none;clear:both;font-size:9px;color:#36F;">
																(Consultar, Crear, Modificar, Borrar.)
															</div>
														</li>
														
                        </ul>
                    </li>
                    <!--<li>.: Grupos
                        <ul style='width: 270px;'>
                            <li>
															<img src="imgs/grupos.jpg" width="56" height="52" style='float: left; margin-right: 5px;' />
															<a href="grupos/index.php">Grupos</a>
															<div align="center" style="float:none;font-size:9px;color:#36F;">
																(Consultar, Crear, Modificar, Borrar.)
															</div>
														</li>
                        </ul>
                    </li>-->
                    <li>.: Procedimientos
                      <ul style='width: 200px;'>
                            <li>
														<img src='imgs/auditores.jpg' width="30" height="30" style='float: left; margin-right: 5px;' />
														<a href="tipo_audita/index.php">Fuentes</a>
													  </li>
                            <li>
														<img src='ci.jpg' width="40" height="40" style='float: left; margin-right: 5px;' />
														<a href="listar/index.php">Planes</a>														
														</li>
                            <li>
														<img src='lista.jpg' width="25" height="25" style='float: left; margin-right: 5px;' />
														<a href="#AllProducts">Lista de Chequeo</a>
														<ul style='width: 220px;'>
                                    <li><a href="acciones/index.php">Plan de Mejoramiento</a></li>
                                    <li><a href="cronos/index.php">Cronograma</a></li>                                   
                                </ul>
														</li>
														<li>
														<img src='ci.jpg' width="40" height="40" style='float: left; margin-right: 5px;' />
														<a href="cronos/indexmes.php">Importar por Mes</a>														
														</li>
                        </ul>
                    </li>                   
                    <li>.: Planes
                       <ul style='width: 200px;'>
													<li>
													<img src='imgs/detalle_au_mini.png' width="40" height="40" style='float: left; margin-right: 5px;'/>
													<a href="#none">de Mejoramiento</a>
															<ul style='width: 100px;'>
																	<li><a href="formato/consulta.php">Consultas</a></li>
															</ul>
													</li>
													<li>
													<img src='imgs/crono.png' width="40" height="40" style='float: left; margin-right: 5px;'/>
													<a href="#none">Cronograma</a>
															<ul style='width: 170px;'>
																	<li><a href="formato/consultacr.php">Consultas</a></li>
																	<?php if($isadmin == 'Y') {?>
																	<li><a href="novtrans/novtrans/sample.php">Calendario General</a></li>  																			
																	<?php } else { ?>
																				<?php if($kontrol == 'S') {?>
																		    <li><a href="novtrans/novtrans/sample.php">Calendario General</a></li>  
																	      <?php } ?>			
																	<li><a href="novtrans/novtrans/samplep.php">Mi Calendario</a></li>  
																	<?php } ?>
															</ul>
													</li>												
                       </ul>
                    </li>
                    <li>.: Presentación
                        <ul style='width: 180px;'>
                            <li>
														<img src='imgs/encxsuc.jpg' width="40" height="40" style='float: left; margin-right: 5px;' />
														<a href="#Presentacion" onclick="abrirVentana('7_aspectos_de_mejoramiento.pdf')" target="_blank">Ver Presentación</a>
														</li>
                        </ul>
                    </li>
										 <li>.: Soporte
                        <ul style='width: 150px;'>
                            <li><a href="#SupportHome">Contácto</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <br />
        </div>
    </div>

<!-- <div id="cuerpox">
 <div id="kfizquierdaf" class="kfimgshadow kfradius btn btn-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Zona de Procedimientos.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></div>
 <div class="kbtexto" id="kmarcohead">		
    <a href="tipo_audita/index.php"><div id="kfizquierda" class="kfradius kfimgshadow">
     <span  class="fuentetest3">FUENTE DE LOS PLANES</span>
    </div></a>  

    <a href="listar/index.php"><div id="kfizquierda3" class="kfradius kfimgshadow">
        <span  class="fuentetest3"> NOMBRE DE PLAN DE MEJORAMIENTO</span>
         </div></a>  

    <a href="acciones/index.php"><div id="kfizquierda1" class="kfradius kfimgshadow">
     <span  class="fuentetest3">LISTA DE CHEQUEO</span>        
     
    </div></a>  

    <a href="formato/consulta.php"><div id="kfizquierda4" class="kfradius kfimgshadow">
         <span  class="fuentetest3">PLAN DE MEJORAMIENTO</span>
     </div></a>  
  
  
</div>
 </div> 
-->
	<div id="kfizquierdaf" class="kfimgshadow kfradius btn btn-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Zona de Administraci&oacute;n.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></div>
	
	<div class="kbtexto" id="kmarcohead">
		<div id="kfdir" class="kfimgshadow kfradius">BASICA.<br> 
			<p>
			<?php if($row_rs_empleado['control'] == 'S'){ ?>
			<img src="imgs/users.jpg" /><a href="usuarios/index.php" class="fuentetest3">&nbsp;Usuarios.</a>
			<?php }	else { echo "Opcion no disponile."; } ?>
			</p>
			<p>
			 <?php if($row_rs_empleado['control'] == 'S'){ ?>
			<img src="imgs/grupos.jpg" width="56" height="52" /><a href="grupos/index.php" class="fuentetest3">&nbsp;Grupos.</a>
			<?php }	else { echo "Opcion no disponile."; } ?>
			</p>
		</div>
	
		<div id="kfdir" class="kfimgshadow kfradius">INDICADORES<br> 
		 <p>
			<?php if($row_rs_empleado['control'] == 'S'){ ?>
			<img src="imgs/indicadores.jpg" /><a href="indicador.php" class="fuentetest3">&nbsp;Ver Detalle</a>
			<?php }	else { echo "Opcion no disponile."; } ?>
			</p>	
			<p>
			<?php if($row_rs_empleado['control'] == 'S'){ ?>
			<img src="imgs/agrupar.jpg" width="56" height="52" /><a href="det_grupos.php" class="fuentetest3">&nbsp;Ver Grupos</a>
			<?php }	else { echo "Opcion no disponile."; } ?>
			</p>	
		</div>

		<div id="kfdir" class="kfimgshadow kfradius">AUDITORIAS<br> 
			<p>
			<?php if($row_rs_empleado['control'] == 'S'){ ?>
		  <img src="imgs/auditores.jpg" width="50" height="50" /><a href="formato/auditar.php" class="fuentetest3">&nbsp;Gesti&oacute;n Auditor</a>
			<?php }	else { echo "Opcion no disponile."; } ?>
			</p>
			<p>
			<?php if($row_rs_empleado['control'] == 'S'){ ?>
		  <img src="imgs/info_auditorias.jpg" width="50" height="50" /><a href="info_final.php" class="fuentetest3">&nbsp;Informe General</a>
			<?php }	else { echo "Opcion no disponile."; } ?>
			</p>
		</div>
		
		<div id="kfdir" class="kfimgshadow kfradius">GESTION AUDITORIAS<br> 
			<p>
			<?php if($row_rs_empleado['control'] == 'S'){ ?>
		  <img src="imgs/procs.jpg" width="60" height="50" /><a href="chart/examples/column-rotated-labels/index_detalle_consol_x_resp_temp.php" class="fuentetest3">&nbsp;Procesos</a>
			<?php }	else { echo "Opcion no disponile."; } ?>
			</p>
			<p>
			<?php if($row_rs_empleado['control'] == 'S'){ ?>
		  <img src="imgs/presup.jpg" width="60" height="50" /><a href="pres1.php" class="fuentetest3">&nbsp;Presupuesto</a>
			<?php }	else { echo "Opcion no disponile."; } ?>
			</p>
		</div>
		
	</div>
  
	

	
	<div class="kfradiuslabel kfimgshadowlabel"> 
	<div align="center" style="float:none;clear:both;color:#F00;height:190px; padding-bottom:7px">
<!--	<div align="center" style="float:none;clear:both;font-size:12px;color:#F00;font-weight:bold;height:100%; padding-bottom:7px">-->
	<p>.:: ZONA DE INFORMACION Y ACTIVIDADES ::.</p>	<!--</div>-->
	
	<div id="mksdiv">
			<div align="center" style="float:none;font-size:12px;color:#FFF;font-weight:bold;height:20px; background-color:#69F">
				CAPACITACIONES DIRIGIDAS POR SU PROCESO PARA EL MES ACTUAL:	<?php echo $totalRows_rs_suscapac; ?><br>
			</div>
						<?php if($totalRows_rs_suscapac > 0){ ?>
			<table class="tbCss1">
				<tr class="tbHeader1">	
					<td>No.</td>
					<td	width="10%">FECHA</td>
					<td>CAPACITADOR</td>
					<td>TEMA</td>
					<td>DIRIGIDO A</td>
				</tr>
			<?php 
				$canti_suscapac= 1;$texto_dir_a = "";
				$suscapclaseapp="";
				do { 
							$sid_dir_a = $row_rs_suscapac['Id'];
							$sfec_dir_a = $row_rs_suscapac['StartTime'];
							$sfec_dir_a = substr($sfec_dir_a,0,10);
							$scapacitador= $row_rs_suscapac['capacitador'];
							$sdescription_dir_a = trim($row_rs_suscapac['Description']);
							$srespon_dir_a = $row_rs_suscapac['responsable'];
							$saudiencia = $row_rs_suscapac['audiencia'];
							$snomtema = $row_rs_suscapac['nomtema'];
							$sdirigido_cargos = $row_rs_suscapac['dirigido_cargos'];
							if($sfec_dir_a >= date("Y-m-d")){$suscapclaseapp ="badgemks badgemks-warning";}
							else{$suscapclaseapp ="badgemkspas badgemks-pasado";}	
						?>
						<tr class='enlacemks'>
						<td>
						<?php echo $canti_suscapac; ?>
						<!--<a href='novtrans/novtrans/editk.php?id=' class='enlacemks'>
						<span class="<?php //echo $suscapclaseapp;?>"><?php //echo $canti_suscapac ; ?></span></a>-->
						</td>
						<td>
						<?php echo $sfec_dir_a ; ?>
						<!--<a href='novtrans/novtrans/editk.php?id=<?php //echo $sid_dir_a; ?>' class='enlacemks'></a>-->
						</td>
						<td><?php echo $scapacitador ; ?></td>
						<td><?php echo $snomtema ; ?></td>
						<td><?php 
						// Capacitaciones dirigidas por su proceso 
						
						//$query_rs_dira_suscapac = "SELECT jqcalendar.Id, jqcalendar.StartTime, temas.nombre nomtema ,dirigido_a.nombre_res FROM jqcalendar JOIN procesos as dirigido_a ON dirigido_a.abr2 = jqcalendar.dirigido_a AND dirigido_a.estado ='A' JOIN temas ON temas.id = jqcalendar.tema WHERE capacitador ='$racolp' AND tipolista = '2' AND YEAR(StartTime) = YEAR('$sfec_dir_a') and MONTH(StartTime) = MONTH('$sfec_dir_a')  order By StartTime;";
						mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
						$query_rs_dira_suscapac = "SELECT jqcalendar.Id, jqcalendar.StartTime, jqcalendar.observacion, temas.nombre nomtema ,dirigido_a.nombre_res FROM jqcalendar JOIN procesos as dirigido_a ON dirigido_a.abr2 = jqcalendar.dirigido_a AND dirigido_a.estado ='A' JOIN temas ON temas.id = jqcalendar.tema WHERE capacitador ='$racolp' AND tipolista = '2' AND StartTime ='$sfec_dir_a' ORDER By StartTime, nombre_res;";
						$rs_dira_suscapac = mysql_query($query_rs_dira_suscapac, $cnn_plan_mejora) or die(mysql_error());
						$row_rs_dira_suscapac = mysql_fetch_assoc($rs_dira_suscapac);
						$totalRows_rs_dira_suscapac = mysql_num_rows($rs_dira_suscapac);
						//echo "$query_rs_dira_suscapac <br>";
						
						$xsdirigido_cargos="";
						do {
								$hecho = "";
								$paraId = $row_rs_dira_suscapac['Id'];
								$nompros = $row_rs_dira_suscapac['nombre_res'];
								$observacion = $row_rs_dira_suscapac['observacion'];
								if($observacion != ""){$hecho = "<span style='font-size:10;color=#FF0000;'>[S]</span>";}
							if($xsdirigido_cargos == "")
										{
											 $xsdirigido_cargos = "<a href='novtrans/novtrans/editk.php?id=$paraId' class='enlacemks'>$nompros  $hecho</a>";
										}
										else {									
											$xsdirigido_cargos .=  ", <a href='novtrans/novtrans/editk.php?id=$paraId' class='enlacemks'>$nompros  $hecho</a>";
										}	
							
						}while($row_rs_dira_suscapac = mysql_fetch_assoc($rs_dira_suscapac));
						//echo $saudiencia.": ".$sdirigido_cargos ; 
						echo $xsdirigido_cargos ; 
						mysql_free_result($rs_dira_suscapac);
						
						?></td>
						</tr>
						
				<?php			
					$canti_suscapac++;
				} while($row_rs_suscapac = mysql_fetch_assoc($rs_suscapac));?>				
				</table>
				<?php }?>	
	</div>
	
	
	<div id="mksdiv">
			<div align="center" style="float:none;font-size:12px;color:#FFF;font-weight:bold;height:20px; background-color:#69F">
				CAPACITACIONES DIRIGIDAS A SU PROCESO PARA EL MES ACTUAL:	<?php echo  $totalRows_rs_cap_dir_a; ?><br>
			</div>
			<?php if($totalRows_rs_cap_dir_a > 0){ ?>
			<table class="tbCss1">
				<tr class="tbHeader1">	
					<td>No.</td>
					<td	width="10%">FECHA</td>
					<td>CAPACITADOR</td>
					<td>TEMA</td>
					<td>DIRIGIDO A</td>
				</tr>
			<?php 
				$canti_dir_a= 1;$texto_dir_a = "";
				$capclaseapp="";
				do { 
							$id_dir_a = $row_rs_cap_dir_a['Id'];
							$fec_dir_a = $row_rs_cap_dir_a['StartTime'];
							$fec_dir_a = substr($fec_dir_a,0,10);
							$capacitador= $row_rs_cap_dir_a['capacitador'];
							$description_dir_a = trim($row_rs_cap_dir_a['Description']);
							$respon_dir_a = $row_rs_cap_dir_a['responsable'];
							$nomtema = $row_rs_cap_dir_a['nomtema'];
							$dirigido_cargos = $row_rs_cap_dir_a['dirigido_cargos'];
							if($fec_dir_a >= date("Y-m-d")){$capclaseapp ="badgemks badgemks-warning";}
							else{$capclaseapp ="badgemkspas badgemks-pasado";}	
						?>
						<tr class='enlacemks'>
						<td>
						<a href="novtrans/novtrans/editk.php?id=<?php echo $id_dir_a;?>" class='enlacemks'>
						<span class="<?php echo $capclaseapp;?>"><?php echo $canti_dir_a ; ?></span></a>
						</td>
						<td><a href="novtrans/novtrans/editk.php?id=<?php echo $id_dir_a?>" class='enlacemks'><?php echo $fec_dir_a ; ?></a></td>
						<td><?php echo $capacitador ; ?></td>
						<td><?php echo $nomtema ; ?></td>
						<td><?php echo $dirigido_cargos ; ?></td>
						</tr>
						
				<?php			
					$canti_dir_a++;
				} while($row_rs_cap_dir_a = mysql_fetch_assoc($rs_cap_dir_a));?>				
				</table>
				<?php }?>	
	</div>
	
	<br>
		<div id="mksdiv">
			<div align="center" style="float:none;font-size:12px;color:#FFF;font-weight:bold;height:20px; background-color:#36C">
					COMITES A PRESIDIR POR SU PROCESO PARA EL MES ACTUAL:	<?php echo $totalRows_rs_xprescomite; ?><br>
			</div>
					 <?php if($totalRows_rs_xprescomite > 0) { ?>
				  <table class="tbCss1">
						<tr class="tbHeader1">	
							<td>No.</td>
							<td	width="10%">FECHA</td>
							<td>COMITE</td>
							<td>PRESIDENTE</td>
							<td>SECRETARIO</td>
						</tr>
					 <?php 
					 $canti_xprescomite = 1;
					 $presclaseapp="";
					 do { 
								 $id_dir_a = $row_rs_xprescomite['Id'];
								 $fec_xprescomite = $row_rs_xprescomite['StartTime'];
								 $fec_xprescomite = substr($fec_xprescomite,0,10);
								 $act_xprescomite = $row_rs_xprescomite['actividad'];
								 $presidentep = $row_rs_xprescomite['presidente'];
								 $secretariop = $row_rs_xprescomite['nomsecretario'];
								 if($fec_xprescomite >= date("Y-m-d")){$presclaseapp ="badgemks badgemks-warning";}
								 else{$presclaseapp ="badgemkspas badgemks-pasado";}							 
					 ?>
							 <tr class='enlacemks'>
								<td>
								<a href="novtrans/novtrans/editk.php?id=<?php echo $id_dir_a; ?>" class="enlacemks">
							
								<span class="<?php echo $presclaseapp; ?>"><?php echo $canti_xprescomite ; ?></span></a>
								</td>
								<td><a href="novtrans/novtrans/editk.php?id=<?php echo $id_dir_a; ?>" class='enlacemks'><?php echo $fec_xprescomite ; ?></a></td>
								<td><?php echo $act_xprescomite ; ?></td>
								<td><?php echo $presidentep ; ?></td>								
								<td><?php echo $secretariop ; ?></td>
								</tr>
					 <?php 
							 $canti_xprescomite++;
					 } while($row_rs_xprescomite = mysql_fetch_assoc($rs_xprescomite));?>
					 <tr>
					 <td colspan="5"><div style='float:left;font-size:12px;color:#000;font-weight:bold;height:15px;' align="left">
					 Dirigido a:
					 </div>
					  <div style='float:left;font-size:11px;color:#333;' align="justify">
						<?php echo $nomdirigidoa ; ?>
						</div></td>
					 </tr>
					 </table>
			 <?php } else{ ?>
			 <div style='float:none;clear:both;font-size:12px;color:#36C;font-weight:bold;height:15px;' align="center">
			No hay Comités a Presidir por su Proceso para el mes actual.</div>
			 <?php } ?>

		</div>
	
	
	<div id="mksdiv">
			<div align="center" style="float:none;font-size:12px;color:#FFF;font-weight:bold;height:20px; background-color:#36C">
				COMITES DIRIGIDOS A SU PROCESO PARA EL MES ACTUAL:	<?php echo $totalRows_rs_prescomite; ?><br>
			</div>
	
			 <?php if($totalRows_rs_prescomite > 0) { ?>
				  <table class="tbCss1" cellspacing="1" cellpadding="1">
						<tr class="tbHeader1">	
							<td>No.</td>
							<td	width="10%">FECHA</td>
							<td>COMITE</td>
							<td>PRESIDENTE</td>
							<td>SECRETARIO</td>
						</tr>
					 <?php 
					 $canti_comite = 1;
					 $claseapp ="";
					 mysql_data_seek($rs_prescomite, 0);
					 do { 
					 	 $id_dir_a =  $row_rs_prescomite['Id'];
						 $fec_comite = $row_rs_prescomite['StartTime'];
						 $fec_comite = substr($fec_prescomite,0,10);
						 $act_comite = $row_rs_prescomite['actividad'];
						 $presidente = $row_rs_prescomite['presidente'];
						 $secretario = $row_rs_prescomite['nomsecretario'];	
						 if($fec_comite >= date("Y-m-d")){$claseapp ="badgemks badgemks-warning";}
						 else{$claseapp ="badgemkspas badgemks-pasado";}				 
					 ?>
							 <tr class='enlacemks'>
								<td>
								<a href="novtrans/novtrans/editk.php?id=<?php echo $id_dir_a; ?>" class="enlacemks">
								<span class="<?php echo $claseapp; ?>"><?php echo $canti_comite ; ?></span></a>
								</td>
								<td><a href="novtrans/novtrans/editk.php?id=<?php echo $id_dir_a; ?>" class='enlacemks'><?php echo $fec_comite ; ?></a></td>
								<td><?php echo $act_comite ; ?></td>
								<td><?php echo $presidente ; ?></td>								
								<td><?php echo $secretario ; ?></td>
								</tr>
					 <?php 
							 $canti_comite++;
					 } while($row_rs_prescomite = mysql_fetch_assoc($rs_prescomite));?>
					 </table>
			 <?php } else{ ?>
			 <div style='float:none;clear:both;font-size:12px;color:#36C;font-weight:bold;height:15px;' align="center">
			No hay Comités Dirigidos a su Proceso para el mes actual.</div>
			 <?php } ?>
	</div>	
	
	
	<?php 
		$canti= 1;$texto = "";
		do { 
					$id = $row_rs_vendia['Id'];
					$description = trim($row_rs_vendia['Description']);
					$respon = $row_rs_vendia['responsable'];
					$texto .= "<a href='novtrans/novtrans/editk.php?id=$id' class='enlacemks'><span class='badgemks badgemks-warning'>".$canti."</span>-".$respon.":   ".$description."\n"."</a><br>";
			$canti++;
		} while($row_rs_vendia = mysql_fetch_assoc($rs_vendia));
	?>
	<div id="mksdiv">
		<div align="center" style="float:none;font-size:12px;color:#FFF;font-weight:bold;height:20px; background-color:#036">
			CANTIDAD DE ACTIVIDADES A REALIZAR HOY:	<?php echo  $totalRows_rs_vendia; ?><br>
		</div>
			<?php if($totalRows_rs_vendia > 0){ ?>
				<?php echo $texto."\n"; ?>			
			<?php }?>
	</div>
	
	<br>
	
<div id="kfizquierda3Z" class="kfradius kfimgshadow">
<div style="float:none;clear:both;font-size:12px;color:#FFF;font-weight:bold;height:20px; background-color:#36C;margin-left:50px;">
	Actividades Próximas a Realizar:
	<?php 
		if($totalRows_rs_prox > 0) {
			$total_acts = 0;	
			$txt_acts = "";
			do {
				  $fechaprox = substr($row_rs_prox['StartTime'],0,10);
					$veces = $row_rs_prox['x'];
					$total_acts = $total_acts+$veces;
	?>
	<div align="center" style="float:none;clear:both;font-size:10px;color: #09C;height:12px; position:inherit;">
	<?php echo "  Fecha: $fechaprox &nbsp;&nbsp;&nbsp;&nbsp; Actividades: $veces"; ?>
	</div>
	<?php 
			} while($row_rs_prox = mysql_fetch_assoc($rs_prox));
			$txt_acts ="Total Actividades: $total_acts";
	}
	else {$txt_acts = "No hay Actividades a realizar.";}	
	?>
	<br>
			<div style='float:none;clear:both;font-size:12px;color:#36C;font-weight:bold;height:15px;'>
			<?php echo $txt_acts; ?></div>
	</div>
	</div>

	<div id="kfizquierda3Z" class="kfradius kfimgshadow">
	<div align="center" style="float:none;clear:both;font-size:12px;color:#FFF;font-weight:bold;height:20px; background-color:#36C;margin-left:50px;">
	Actividades a Seguir: <br>
	<?php if($aseguir != ""){ 
				do {
					$proceson = $row_rs_seguir['proceson'];
					$abr2 = $row_rs_seguir['abr2'];
	?>
	<div align="center" style="float:none;clear:both;font-size:10px;color:#6CF;height:12px; position:inherit;">
	<a href="novtrans/novtrans/samplepsig.php?abr2=<?php echo $abr2; ?>">
	<?php echo $proceson; ?>
	</a>
	</div>
	<?php	
				} while($row_rs_seguir = mysql_fetch_assoc($rs_seguir));
	} 
	else {?>
		<div style='float:none;clear:both;font-size:12px;color:#36C;font-weight:bold;height:15px'>
		<?php echo "  No hay Actividades a seguir.";	?>
		</div>
	<?php } ?>	
	</div>
	</div>

</div>
</div>
	
	
			 <div id="" class="row" align="center">
					<div id="footer" class="span12" align="center">
							<span class="btn-small">Todos los derechos reservados - Inter Rapid&iacute;simo.</span>
					</div>
			 </div> 
   
	 </div>
	 
</div>  

</div>
</form>
</body>
</html>
<?php
mysql_free_result($rs_empleado);

mysql_free_result($rs_vencidos);
if($aseguir != ""){mysql_free_result($rs_seguir);}
mysql_free_result($rs_vendia);
mysql_free_result($rs_prox);
}	
mysql_free_result($rs_cap_dir_a);
mysql_free_result($rs_suscapac);
mysql_free_result($rs_comite);
mysql_free_result($rs_prescomite);
mysql_free_result($rs_xprescomite);
?>
