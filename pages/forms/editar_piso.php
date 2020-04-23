<?php
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); //('../../Connections/cnn_kn.php');
require_once('../../Connections/config2.php');
/*  
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION))
{ 
  session_start(); 
}
*/ 
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

$nombre ="";
if(isset($_POST['nombre'])){
    $nombre = trim($_POST['nombre']);
    $nombre = str_replace(' ', '%20', $nombre);
}
$numero ="";
if(isset($_POST['numero'])){
    $numero = trim($_POST['numero']);
    $numero = str_replace(' ', '%20', $numero);
}

$estado ="";
if(isset($_POST['estado'])){
	$estado = trim($_POST['estado']);
}

$idtabla = 0;
if(isset($_POST['idtabla'])){
	$idtabla = trim($_POST['idtabla']);
}

require_once('../../apis/general/piso.upd.php');
?>