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
$IdIpsFuncionario ="";
if(isset($_POST['IdIpsFuncionario'])){
  $IdIpsFuncionario = trim($_POST['IdIpsFuncionario']);
}
$email ="";
if(isset($_POST['email'])){
  $email = trim($_POST['email']);
}
$IdCargoFuncionario ="";
if(isset($_POST['IdCargoFuncionario'])){
  $IdCargoFuncionario = trim($_POST['IdCargoFuncionario']);
}

$estado ="";
if(isset($_POST['estado'])){
	$estado = trim($_POST['estado']);
}
$centroacopio="";
if(isset($_POST['centroacopio'])){
  $centroacopio = trim($_POST['centroacopio']);
}

$strowreg =0;
$row_rs_tabla = 0;
$estadotxt = "";
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tabla = "SELECT IdFuncionario FROM funcionario WHERE IdFuncionario = $idEstudiante; "; 
//echo "qry_usu......$query_rs_tabla" ;
$rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err.....$query_rs_tabla<br>");
$row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
$totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

if( $totalRows_rs_tabla == 1 )
{	
	  $insertSQL = "UPDATE funcionario SET IdTipoDocumentofuncionario = $tipodocumento , funIdFuncionario = $numerodocumento, NombresFuncionario = '$nombre', ApellidosFuncionario = '$apellido1',ClaveFuncionario = '$clave', EstadoFuncionario = '$estado', IdIpsFuncionario ='$IdIpsFuncionario', EmailFuncionario = '$email', IdCargoFuncionario ='$IdCargoFuncionario', IdCentroAcopio = $centroacopio WHERE IdFuncionario = $idEstudiante;";
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