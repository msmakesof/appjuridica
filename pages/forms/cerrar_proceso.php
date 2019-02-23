<?php require_once('../../Connections/cnn_kn.php'); 
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

$estado = 0;
if(isset($_POST['estado'])){
	$estado = trim($_POST['estado']);
}

$observacion = "";
if(isset($_POST['observacion'])){
	$observacion = trim($_POST['observacion']);
}

$usuario = $_COOKIE['_geo']; ; 
if($usuario =="")
{
    $usuario = $_SESSION["user_id"];
}
date_default_timezone_set("America/Bogota");
$fechaCierre = date("Y-m-d h:i:sa");

$pidtabla = 0;
if(isset($_POST['pidtabla'])){
	$pidtabla = trim($_POST['pidtabla']);
}

//echo "<script>console.log($pidtabla $estado $observacion  $usuario $fechaCierre)</script>";
require_once('../../apis/proceso/proceso.clo.php');
?>