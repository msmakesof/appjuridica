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

$idEstudiante ="";
if(isset($_POST['idtabla'])){
  $idEstudiante = trim($_POST['idtabla']);
}
//echo "ideest....$idEstudiante<br>";

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
// $direccion ="";
// if(isset($_POST['direccion'])){
//   $direccion = trim($_POST['direccion']);
// }
$email ="";
if(isset($_POST['email'])){
  $email = trim($_POST['email']);
}
$celular ="";
if(isset($_POST['celular'])){
  $celular = trim($_POST['celular']);
}
// $telefonofijo ="";
// if(isset($_POST['telefonofijo'])){
//   $telefonofijo = trim($_POST['telefonofijo']);
// }
$sucursal ="";
if(isset($_POST['sucursal'])){
  $sucursal = trim($_POST['sucursal']);
}

$estado ="";
if(isset($_POST['estado'])){
	$estado = trim($_POST['estado']);
}

$strowreg =0;
$row_rs_tabla = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tabla = "SELECT IdEstudiante FROM estudiante WHERE IdEstudiante = $idEstudiante; "; 
//echo "qry_usu......$query_rs_tabla" ;
$rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err.....$query_rs_tabla<br>");
$row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
$totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

if( $totalRows_rs_tabla == 1 )
{
	//mysqli_next_result($cnn_ok); //función clave 	
	$insertSQL = "UPDATE estudiante SET TipoDocumento_EST = $tipodocumento , NumeroDocumento_EST = '$numerodocumento', Nombres_EST = '$nombre', Apellido1_EST = '$apellido1', Clave_EST = '$clave', Estado_EST = $estado, Email_EST = '$email', Celular_EST ='$celular', Sucursal_EST = $sucursal WHERE IdEstudiante = $idEstudiante;";
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