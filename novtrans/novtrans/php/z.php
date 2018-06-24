<?php
require_once('../../../Connections/cnn_plan_mejora.php');
require_once("../../../sesion.class.php");

include_once("dbconfig.php");
include_once("functions.php");

$sesion = new sesion();
$usuario = $sesion->get("usuario");
	mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_ver = "Select ver from empleados where usuario='$usuario'";
$rs_ver = mysql_query($query_rs_ver, $cnn_plan_mejora) or die(mysql_error());
$row_rs_ver = mysql_fetch_assoc($rs_ver);
$totalRows_rs_ver = mysql_num_rows($rs_ver);
echo "query..........................$query_rs_ver<br>";
echo "recs:.......$totalRows_rs_ver<br>";
if($totalRows_rs_ver == 1){
	$ver = $row_rs_ver['ver'];
	echo "ver........$ver<br>";
}
$verfin1 = str_replace(",","','",$ver);
$verfin1 = "'GTI','".$verfin1."'";
echo "verfin1..............$verfin1<br>";
mysql_free_result($rs_ver);


echo "<br><br>";
 $db = new DBConnection();
 $db->getConnection();
$sql = "Select ver from empleados where usuario='$usuario'";
    echo "query......$sql<br>";	
		$handle = mysql_query($sql);
		mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');
		
    while ($row = mysql_fetch_object($handle)) {
			$productos[0] = $row->ver;
			$y = $row->ver;
		}
		foreach($productos as $producto){
    echo "producto.......".$producto."<br>";
		$x = $producto;
		}
		 //echo "arreglo....................".$ret."<br>";
		 echo "y........$y<br>";
		 
		$verfin11 = str_replace(",","','",$x);
		$verfin11 = "'GTI','".$verfin11."'";
		echo "ver11..............................$verfin11<br>";
		$condi = " and Location IN ($verfin11)";
		
		$sql = "select jqcalendar.*, procesos.nombre_res, tipo_lista.nombre_tl from jqcalendar join listachqxtipoaudit on listachqxtipoaudit.tipo_auditoria = jqcalendar.tipo_auditoria and listachqxtipoaudit.id_auditoria = jqcalendar.auditoria and listachqxtipoaudit.id_listacheq = jqcalendar.listachq and listachqxtipoaudit.idproceso = jqcalendar.tipolista join procesos on procesos.abr2 = jqcalendar.responsable join tipo_lista on tipo_lista.id = jqcalendar.tipolista where starttime between '2014-01-01' and '2014-01-31' and jqcalendar.tipo_auditoria > 0 $condi;";
    echo "sql......................$sql<br>";	
		$handle = mysql_query($sql);
		mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');
		
		
		echo "<hr>";
		// new mks77
		$sql1 = "select racolp from empleados where usuario = '$usuario'";
		$handle1 = mysql_query($sql1);
		mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');
		while ($row = mysql_fetch_object($handle1)) {
		  $y = $row->racolp;
		}
		
		switch ($y){
		 case 'GEA':
				 $condi = " and Location IN ('GEA','DOC','COM')";
				 break;
		 case 'DOC':
				 $condi = " and responsable IN ('DOC')";
				 break;	 
	}
	echo "condi..............$condi<br>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
</body>
</html>