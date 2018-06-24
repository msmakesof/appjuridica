<?php require_once('../../Connections/cnn_kn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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
$row_rs_base = 0;

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_key = "SELECT un_LlaveAcceso FROM un_control WHERE un_IdEstado = 1;" ;
$rs_key = mysqli_query($cnn_kn, $query_rs_key) or die(mysqli_error()."Err.....$query_rs_key");
$row_rs_key = mysqli_fetch_assoc($rs_key);
$totalRows_rs_key = mysqli_num_rows($rs_key);
if ($resultado = mysqli_query($cnn_kn, $query_rs_key)) {
  while($strowreg = mysqli_fetch_assoc($resultado))
  { 
    $llave = $strowreg["un_LlaveAcceso"];
  }
}  
mysqli_free_result($rs_key);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_base = "SELECT IdVehiculo FROM vehiculos WHERE Placa = '$placa' ;" ;
$rs_base = mysqli_query($cnn_kn, $query_rs_base) or die(mysqli_error()."Err.....$query_rs_base<br>");
$row_rs_base = mysqli_fetch_assoc($rs_base);
$totalRows_rs_base = mysqli_num_rows($rs_base);

while($strowreg = mysqli_fetch_array($rs_base, MYSQLI_ASSOC))
{ 
	$idciudad = $strowreg["IdVehiculo"];
	//$estadociudad = $strowreg["Id_EstadoTabla"];
}

if( $row_rs_base >= 1 )
{   
   echo "E";
}
else
{
	$insertSQL = "INSERT INTO vehiculos (Placa, IdTransportador, IdConductor, Modelo, IdTipoVehiculo, IdTipoCar, CantidadPedidos, fechavenceseguro, fechavencetecnica, clave, IdCentroAcopio, EstadoVehiculo) VALUES ('$placa', $transportador, $xxconductor, '$modelo', $tipovehiculo, $tipocar, $cantpedidos, '', '', '', $centroacopio, $estado);";
	 mysqli_select_db($cnn_kn, $database_cnn_kn);
	 $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");
	$sigue="N";
	if( $Result1 )
	{	   
	   $sigue="S";
	}	 
	echo $sigue;
}
mysqli_free_result($rs_base);
mysqli_close($cnn_kn);
?>