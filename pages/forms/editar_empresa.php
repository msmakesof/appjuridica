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

$tipodocumento ="";
if(isset($_POST['tipodocumento'])){
  $tipodocumento = trim($_POST['tipodocumento']);
}

$numerodocumento ="";
if(isset($_POST['numerodocumento'])){
  $numerodocumento = trim($_POST['numerodocumento']);
}

$nombre ="";
if(isset($_POST['nombre'])){
  $nombre = trim($_POST['nombre']);
  $nombre = str_replace(" ","%20",$nombre);  
}

$nombre2 ="";
if(isset($_POST['nombre2']) && !empty($_POST['nombre2'])){
  $nombre2 = trim($_POST['nombre2']);
  $nombre2 = str_replace(" ","%20",$nombre2);
}


$apellido1 ="";
if(isset($_POST['apellido1']) && !empty($_POST['apellido1'])){
  $apellido1 = trim($_POST['apellido1']);
  $apellido1 = str_replace(" ","%20",$apellido1);  
}

$apellido2 ="";
if(isset($_POST['apellido2']) && !empty($_POST['apellido2'])){
  $apellido2 = trim($_POST['apellido2']);
  $apellido2 = str_replace(" ","%20",$apellido2);  
}

$email ="";
if(isset($_POST['email'])){
  $email = trim($_POST['email']);
}

$direccion ="";
if(isset($_POST['direccion'])){
  $direccion = trim($_POST['direccion']);  
  $direccion = str_replace(' ', '%20', $direccion);
  $direccion = str_replace('#',"No.", $direccion);  
}

$celular ="";
if(isset($_POST['celular'])){
  $celular = trim($_POST['celular']);
}

$fijo ="";
if(isset($_POST['fijo'])){
  $fijo = trim($_POST['fijo']);
}

$sitioweb ="";
if(isset($_POST['sitioweb'])){
  $sitioweb = trim($_POST['sitioweb']);
}

$estado ="";
if(isset($_POST['estado'])){
  $estado = trim($_POST['estado']);
}

$tipocliente ="";
if(isset($_POST['tipocliente'])){
  $tipocliente = trim($_POST['tipocliente']);
}

$ciudad="";
if(isset($_POST['ciudad'])){
  $ciudad = trim($_POST['ciudad']);
}

$idempresa="";
if(isset($_POST['Idempresa'])){
  $idempresa = trim($_POST['Idempresa']);
}

require_once('../../apis/empresa/Empresa.upd.php');
?>