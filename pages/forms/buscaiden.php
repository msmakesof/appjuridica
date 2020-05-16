<?php
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); 

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

$par = "";
if(isset($_POST['par'])){
  $par = trim($_POST['par']);
}

$iden = "";
if(isset($_POST['iden'])){
  $iden = trim($_POST['iden']);
}

if ($par == "i") /* Busqueda por Identificacion */
{
	$idUsuario = "";
	if(isset($_POST['idtabla'])){
	  $idUsuario = trim($_POST['idtabla']);
	}
}

if ($par == "n") /* Busqueda por Nombres y Apellidos */
{	
	$nom = "";
	if(isset($_POST['nom'])){
	  $nom = trim($_POST['nom']);
	}
	
	$ape1 = "";
	if(isset($_POST['ape1'])){
	  $ape1 = trim($_POST['ape1']);
	}
	
	$ape2 = "";
	if(isset($_POST['ape2'])){
	  $ape2 = trim($_POST['ape2']);
	}
}

if ($par == "e") /* Busqueda por Email */
{
	$mail = "";
	if(isset($_POST['mail'])){
	  $mail = trim($_POST['mail']);
	}	
}

$existe = "";
$sigue = "";
$parameters = "";
//Verifico si existe un usuario con las siguientes caracteristicas: Nro documento igual
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{  	
	if ($par == "i")
	{
		$parameters = "BuscaIden=1&Identificacion=$iden&IdTabla=$idUsuario";
		$url = urlServicios."consultadetalle/consultadetalle_Usuario.php?".$parameters;
	}
	
	if ($par == "n")
	{
		$parameters = "BuscaNombre=1&Nom=$nom&Ape1=$ape1&Ape2=$ape2&Iden=$iden";
		$url = urlServicios."consultadetalle/consultadetalle_Usuario.php?".$parameters;
	}
	
	if ($par == "e")
	{
		$parameters = "BuscaEmail=1&Email=$mail";
		$url = urlServicios."consultadetalle/consultadetalle_Usuario.php?".$parameters;
	}
	////echo "<script>console.log('A.'+$url);</script>";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, 0);
	
	$resultado = curl_exec ($ch);         
	$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$curl_errno= curl_errno($ch);
	curl_close($ch);
	
	if($resultado === false || $curl_errno > 0)
	{		
		$sigue = "N - Curl Error: " . $curl_errno;
	}
	else
	{
		$m = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
		$m = json_decode($m, true);		
		$existe = $m['usu_usuario']['existe'];
		
		if($existe > 0 )
		{			
			$sigue = "N";
		}
		else
		{
			$sigue = "S";
		}
	}
}
echo $sigue;	
?>