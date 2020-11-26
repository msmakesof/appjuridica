<?php 
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php');
require_once('../../Connections/config2.php');
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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
$idtabla = 0;
if(isset($_POST['idproceso'])){
	$idtabla = trim($_POST['idproceso']);
}

$fechainicio ="";
if(isset($_POST['fechainicio'])){
	$fechainicio = trim($_POST['fechainicio']);
	$fechainiciomks = str_replace(' ', '%20', $fechainicio);
}
$origen ="";
if(isset($_POST['origen'])){
  $origen = trim($_POST['origen']);  
}

$actpro ="";
if(isset($_POST['actpro'])){
  $actpro = trim($_POST['actpro']);  
}

$fechaestado ="";
if(isset($_POST['fechaestado'])){
	$fechaestado = trim($_POST['fechaestado']);
	$fechaestado = str_replace(' ', '%20', $fechaestado );
}

$observacion ="";
if(isset($_POST['observacion'])){
    $observacion = trim($_POST['observacion']);
    $observacion = str_replace(' ', '%20', $observacion);
}
$gasto = 0;
if(isset($_POST['gasto'])){
	$gasto = trim($_POST['gasto']);
}
$dh = 0;
if(isset($_POST['dh'])){
	$dh = trim($_POST['dh']);
}
$re = "";
if(isset($_POST['re'])){
	$re = trim($_POST['re']);
}
$dr = 0;
if(isset($_POST['dr'])){
	$dr = trim($_POST['dr']);
}
require_once('../../apis/proceso/actuacionprocesal.upd.php');
?>