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

$nivel = $_POST['nivel'];
$estado = $_POST['estado'];
$estadocierre = $_POST['estadocierre'];

//echo "nivel.........$nivel<br>";
//echo "estado.........$estado<br>";
//echo "estadocie.........$estadocierre<br>";


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tabla = "SELECT IdEstudiante, IdAsignado FROM nivelasignado WHERE IdEstudiante = $idEstudiante AND IdNivel = $nivel ; "; 
    // AND Estado = $estado AND EstadoCierre = $estadocierre
//echo "qry_usu......$query_rs_tabla<br>" ;
$rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err.....$query_rs_tabla<br>");
$row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
$totalRows_rs_tabla = mysqli_num_rows($rs_tabla);
//echo "rows......$totalRows_rs_tabla<br>";
$fechacierre = "''";
if( $totalRows_rs_tabla >= 1 )
{
	//mysqli_next_result($cnn_ok); //función clave 	
	//$insertSQL = "DELETE FROM nivelasignado WHERE IdEstudiante = $idEstudiante ;";
  if($estadocierre == 2)
  {
    $fechacierre = "Now()";
  }
  $insertSQL = "UPDATE nivelasignado SET Estado = $estado, fechacierre = $fechacierre, EstadoCierre = $estadocierre WHERE IdEstudiante = $idEstudiante AND IdNivel = $nivel ;";
	mysqli_select_db($cnn_kn, $database_cnn_kn);
	$Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");
}
else
{
  $insertSQL = "INSERT INTO nivelasignado (IdAsignado, IdEstudiante, IdNivel, Estado, EstadoCierre) VALUES (0, $idEstudiante, $nivel, $estado, $estadocierre);";
  mysqli_select_db($cnn_kn, $database_cnn_kn);
  $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");
}
//echo "accion....$insertSQL<br>";
	$sigue = "N";
	if( $Result1 )
	{	   
	   $sigue = "S";
	}	 
	echo $sigue;

mysqli_free_result($rs_tabla);
mysqli_close($cnn_kn);
?>