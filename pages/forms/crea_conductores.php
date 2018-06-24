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

$tipodocumento ="";
if(isset($_POST['tipodocumento'])){
  $tipodocumento = trim($_POST['tipodocumento']);
}
//echo "tipodocumento....$tipodocumento";

$numerodocumento ="";
if(isset($_POST['numerodocumento'])){
  $numerodocumento = trim($_POST['numerodocumento']);
}

$nombre ="";
if(isset($_POST['nombre'])){
  $nombre = trim($_POST['nombre']);
}

$telefono ="";
if(isset($_POST['telefono'])){
  $telefono = trim($_POST['telefono']);
}

$direccion ="";
if(isset($_POST['direccion'])){
  $direccion = trim($_POST['direccion']);
}

$email ="";
if(isset($_POST['email'])){
  $email = trim($_POST['email']);
}

$celular ="";
if(isset($_POST['celular'])){
  $celular = trim($_POST['celular']);
}

$estado ="";
if(isset($_POST['estado'])){
  $estado = trim($_POST['estado']);
}

$transportador ="";
if(isset($_POST['transportador'])){
  $transportador = trim($_POST['transportador']);
}

$ciudad="";
if(isset($_POST['ciudad'])){
  $ciudad = trim($_POST['ciudad']);
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
$query_rs_base = "SELECT IdConductor FROM conductores WHERE Nit = $numerodocumento AND IdTipoDocumentoConductor = $tipodocumento;" ;
$rs_base = mysqli_query($cnn_kn, $query_rs_base) or die(mysqli_error()."Err.....$query_rs_base<br>");
$row_rs_base = mysqli_fetch_assoc($rs_base);
$totalRows_rs_base = mysqli_num_rows($rs_base);

while($strowreg = mysqli_fetch_array($rs_base, MYSQLI_ASSOC))
{ 
	$idciudad = $strowreg["IdConductor"];
	//$estadociudad = $strowreg["Id_EstadoTabla"];
}

if( $row_rs_base >= 1 )
{   
   echo "E";
}
else
{
	$insertSQL = "INSERT INTO conductores (Nombres, IdTransportador, Nit, IdCiudad, Direccion, Telefono, Celular, Email, FechaVencePase, EstadoConductor, IdTipoDocumentoConductor) VALUES ( '$nombre', $transportador, '$numerodocumento', $ciudad, '$direccion', '$telefono', '$celular', '$email', Now(), '$estado', $tipodocumento);";

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