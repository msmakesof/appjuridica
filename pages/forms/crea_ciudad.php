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

$pnombre ="";
if(isset($_POST['pnombre'])){
	$pnombre = trim($_POST['pnombre']);
}

$pestado ="";
if(isset($_POST['pestado'])){
	$pestado = trim($_POST['pestado']);
}

$piata ="";
if(isset($_POST['piata'])){
	$piata = trim($_POST['piata']);
}
$strowreg =0;
$row_rs_ciudad = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_ciudad = "SELECT Id_Tabla, Id_EstadoTabla FROM gen_tablas WHERE Nombre_Tabla = '$pnombre' ;" ;
//echo "qry_usu......$query_rs_ciudad" ;
$rs_ciudad = mysqli_query($cnn_kn, $query_rs_ciudad) or die(mysqli_error()."Err.....$query_rs_ciudad<br>");
$row_rs_ciudad = mysqli_fetch_assoc($rs_ciudad);
$totalRows_rs_ciudad = mysqli_num_rows($rs_ciudad);

while($strowreg = mysqli_fetch_array($rs_ciudad, MYSQLI_ASSOC))
{ 
	$idciudad = $strowreg["Id_Tabla"];
	$estadociudad = $strowreg["Id_EstadoTabla"];
}

if( $row_rs_ciudad >= 1 )
{
   // echo "<span style='clear:both;width:100%;background-color:#900; color:#FFF; font-size:10.5px; font-family:verdana; text-align:center; padding:5px'> * Tabla: $pnombre !Ya se encuentra registrada.<span>";
   echo "E";
}
else
{
	$pnombre2 = strtoupper($pnombre) ;
	//mysqli_next_result($cnn_ok); //función clave 	
	$insertSQL = "INSERT INTO gen_tablas (Nombre_Tabla,NombreMostrar, Id_EstadoTabla) VALUES ('$pnombre', '$pnombre2', $pestado);";
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
mysqli_free_result($rs_ciudad);
mysqli_close($cnn_kn);
?>