<?php 
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); 
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
	$fechainicio = str_replace(' ', '%20', $fechainicio);
}

$concepto ="";
if(isset($_POST['concepto'])){
    $concepto = trim($_POST['concepto']);
    $concepto = str_replace(' ', '%20', $concepto);
}

$gasto = 0;
if(isset($_POST['gasto'])){
	$gasto = trim($_POST['gasto']);
}
require_once('../../apis/proceso/gasto.upd.php');
?>