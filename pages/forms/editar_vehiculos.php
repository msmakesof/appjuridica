<?php require_once('../../Connections/cnn_kn.php'); ?>
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

$idvehiculo ="";
if(isset($_POST['idvehiculo'])){
  $idvehiculo = trim($_POST['idvehiculo']);
}

$placa ="";
if(isset($_POST['placa'])){
  $placa = trim($_POST['placa']);
}
//echo "tipodocumento....$tipodocumento";

$transportador ="";
if(isset($_POST['transportador'])){
  $transportador = trim($_POST['transportador']);
}

$xxconductor ="";
if(isset($_POST['xxconductor'])){
  $xxconductor = trim($_POST['xxconductor']);
}

$modelo ="";
if(isset($_POST['modelo'])){
  $modelo = trim($_POST['modelo']);
}

$tipovehiculo ="";
if(isset($_POST['tipovehiculo'])){
  $tipovehiculo = trim($_POST['tipovehiculo']);
}

$tipocar ="";
if(isset($_POST['tipocar'])){
  $tipocar = trim($_POST['tipocar']);
}

$cantpedidos ="";
if(isset($_POST['cantidadpedidos'])){
  $cantpedidos = trim($_POST['cantidadpedidos']);
}

$centroacopio ="";
if(isset($_POST['centroacopio'])){
  $centroacopio = trim($_POST['centroacopio']);
}

$estado ="";
if(isset($_POST['estado'])){
  $estado = trim($_POST['estado']);
}

$strowreg =0;
$row_rs_tabla = 0;
$estadotxt = "";
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tabla = "SELECT IdVehiculo FROM vehiculos WHERE IdVehiculo = $idvehiculo; "; 
//echo "qry_usu......$query_rs_tabla" ;
$rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err.....$query_rs_tabla<br>");
$row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
$totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

if( $totalRows_rs_tabla == 1 )
{	
	  $insertSQL = "UPDATE vehiculos SET Placa = '$placa' , IdTransportador = $transportador, IdConductor = 'xxconductor', Modelo = '$modelo', IdTipoVehiculo = '$tipovehiculo', IdTipoCar = '$tipocar', CantidadPedidos =$cantpedidos, IdCentroAcopio = $centroacopio, EstadoVehiculo = $estado WHERE IdVehiculo = $idvehiculo;";
	  mysqli_select_db($cnn_kn, $database_cnn_kn);
	  $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");
	  $sigue = "N";
	if( $Result1 )
	{	   
	   $sigue = "S";
	}	 
	echo $sigue;
}
mysqli_free_result($rs_tabla);
mysqli_close($cnn_kn);
?>