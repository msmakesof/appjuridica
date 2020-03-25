<?php 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 
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

$idtabla ="";
if(isset($_POST['idtabla'])){
  $idtabla = trim($_POST['idtabla']);
}

$proceso ="";
if(isset($_POST['proceso'])){
  $proceso = trim($_POST['proceso']);
}

$nproceso ="";
if(isset($_POST['nproceso'])){
  $nproceso = trim($_POST['nproceso']);
}

$cad1 = substr($proceso,0,16);
$cad2 = substr($proceso,-2);
$proceso = $cad1.$nproceso.$cad2;

$fechainicio ="";
if(isset($_POST['fechainicio'])){
  $fechainicio = $_POST['fechainicio'];
}

$asignadoa ="";
if(isset($_POST['asignadoa'])){
  $asignadoa = $_POST['asignadoa'];  
}

$ubicacion ="";
if(isset($_POST['ubicacion'])){
  $ubicacion = $_POST['ubicacion'];
}

$claseproceso ="";
if(isset($_POST['claseproceso'])){
  $claseproceso = $_POST['claseproceso'];  
}
$demandante ="";
if(isset($_POST['demandante'])){
  $demandante = trim($_POST['demandante']);
}
$demandado ="";
if(isset($_POST['demandado'])){
  $demandado = trim($_POST['demandado']);
}

$estado ="";
if(isset($_POST['estado'])){
	$estado = trim($_POST['estado']);
}

$enviaemailcli ="";
if(isset($_POST['enviaemailcli'])){
	$enviaemailcli = $_POST['enviaemailcli'];
}

$representa ="";
if(isset($_POST['representa'])){
	$representa = $_POST['representa'];
}

$usuariomodifica ="";
if(isset($_POST['um'])){
	$usuariomodifica = trim($_POST['um']);
}
require_once('../../apis/proceso/proceso.upd.php');
?>