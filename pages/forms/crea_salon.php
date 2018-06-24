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

$nombre ="";
if(isset($_POST['nombre'])){
  $nombre = trim($_POST['nombre']);
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
$query_rs_base = "SELECT IdSalon FROM salon WHERE NombreSalon = '$nombre';" ;
//echo "qry_usu......$query_rs_base" ;
$rs_base = mysqli_query($cnn_kn, $query_rs_base) or die(mysqli_error()."Err.....$query_rs_base<br>");
$row_rs_base = mysqli_fetch_assoc($rs_base);
$totalRows_rs_base = mysqli_num_rows($rs_base);

while($strowreg = mysqli_fetch_array($rs_base, MYSQLI_ASSOC))
{ 
	$idciudad = $strowreg["IdSalon"];
	//$estadociudad = $strowreg["Id_EstadoTabla"];
}

if( $row_rs_base >= 1 )
{   
   echo "E";
}
else
{
	//mysqli_next_result($cnn_ok); //función clave 	
	$insertSQL = "INSERT INTO salon (NombreSalon, Sucursal, Estado) VALUES ('$nombre', $sucursal, $estado);";
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