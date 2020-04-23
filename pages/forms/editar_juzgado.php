<?php
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); //('../../Connections/cnn_kn.php');
//require_once('../../Connections/config2.php');
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

$ubicacion ="";
if(isset($_POST['ubicacion'])){
    $ubicacion = trim($_POST['ubicacion']);
    $ubicacion = str_replace(' ', '%20', $ubicacion);
}

$ciudad ="";
if(isset($_POST['ciudad'])){
    $ciudad = trim($_POST['ciudad']);    
}

$direccion ="";
if(isset($_POST['direccion'])){
    $direccion = trim($_POST['direccion']);
	$direccion = strtoupper($direccion);
    $direccion = str_replace(' ', '%20', $direccion);
    $direccion = str_replace('#', 'No.', $direccion);    
}

$telefono ="";
if(isset($_POST['telefono'])){
    $telefono = trim($_POST['telefono']);    
}

$piso ="";
if(isset($_POST['piso'])){
    $piso = trim($_POST['piso']);    
}

$tipojuzgado ="";
if(isset($_POST['tipojuzgado'])){
    $tipojuzgado = trim($_POST['tipojuzgado']);    
}

$area ="";
if(isset($_POST['area'])){
    $area = trim($_POST['area']);    
}

$estado ="";
if(isset($_POST['estado'])){
	$estado = trim($_POST['estado']);
}

$email ="";
if( isset($_POST['email']) )
{
    $email = trim($_POST['email']);
	$email = strtolower($email);
}

$edificio ="";
if( isset($_POST['edificio']) )
{
    $edificio = trim($_POST['edificio']);
}

$idtabla = 0;
if(isset($_POST['idtabla'])){
	$idtabla = trim($_POST['idtabla']);
}

require_once('../../apis/juzgado/juzgado.upd.php');
?>