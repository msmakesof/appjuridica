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

$apellido1 ="";
if(isset($_POST['apellido1'])){
  $apellido1 = trim($_POST['apellido1']);
}
$clave ="";
if(isset($_POST['clave'])){
  $clave = trim($_POST['clave']);
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
$telefonofijo ="";
if(isset($_POST['telefonofijo'])){
  $telefonofijo = trim($_POST['telefonofijo']);
}
$sucursal ="";
if(isset($_POST['sucursal'])){
  $sucursal = trim($_POST['sucursal']);
}

$estado ="";
if(isset($_POST['estado'])){
  $estado = trim($_POST['estado']);
}
$strowreg =0;
$row_rs_base = 0;

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_base = "SELECT IdEstudiante FROM estudiante WHERE NumeroDocumento_EST = $numerodocumento AND TipoDocumento_EST = $tipodocumento;" ;
//echo "qry_usu......$query_rs_base" ;
$rs_base = mysqli_query($cnn_kn, $query_rs_base) or die(mysqli_error()."Err.....$query_rs_base<br>");
$row_rs_base = mysqli_fetch_assoc($rs_base);
$totalRows_rs_base = mysqli_num_rows($rs_base);

while($strowreg = mysqli_fetch_array($rs_base, MYSQLI_ASSOC))
{ 
	$idciudad = $strowreg["Id_Tabla"];
	$estadociudad = $strowreg["Id_EstadoTabla"];
}

if( $row_rs_base >= 1 )
{   
   echo "E";
}
else
{
	//mysqli_next_result($cnn_ok); //función clave 	
	$insertSQL = "INSERT INTO estudiante (TipoDocumento_EST , NumeroDocumento_EST, Nombres_EST, Apellido1_EST, Clave_EST, Estado_EST, Direccion_EST, Email_EST, Celular_EST, TelefonoFijo_EST, Sucursal_EST, FechaCreacion_EST, IdCiudad_EST) VALUES ($tipodocumento, $numerodocumento,'$nombre', '$apellido1', '$clave', $estado, '$direccion', '$email', '$celular', '$telefonofijo', $sucursal, Now(), 0);";
	//echo "insert......$insertSQL<br>";	
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