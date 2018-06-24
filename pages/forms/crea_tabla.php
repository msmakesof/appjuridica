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
if( isset($_POST['pnombre']) )
{
	  $pnombre = trim($_POST['pnombre']);
}

$pestado ="";
if( isset($_POST['pestado']) )
{
	  $pestado = trim($_POST['pestado']);
}

$piata ="";
if( isset($_POST['piata']) )
{
 	  $piata = trim($_POST['piata']);
}
$strowreg =0;
$row_rs_tabla = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tabla = "SELECT Id_Tabla, Id_EstadoTabla FROM gen_tablas WHERE trim(Nombre_Tabla) = '$pnombre' ;" ;
//echo "qry_usu......$query_rs_tabla" ;
$rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err Ln53.....$query_rs_tabla<br>");
$row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
$totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

while( $strowreg = mysqli_fetch_array($rs_tabla, MYSQLI_ASSOC) )
{ 
	$idciudad = $strowreg["Id_Tabla"];
	$estadociudad = $strowreg["Id_EstadoTabla"];
}

$sigue   = "";
$Result1 = "";
if( $row_rs_tabla >= 1 )
{
   //echo "<span style='clear:both;width:100%;background-color:#900; color:#FFF; font-size:10.5px; font-family:verdana; text-align:center; padding:5px'> * Tabla: $pnombre !Ya se encuentra registrada.<span>";
      $sigue="E";
}
else
{
	//mysqli_next_result($cnn_ok); //función clave 	
	$insertSQL = "INSERT INTO gen_tablas (Nombre_Tabla, Id_EstadoTabla) VALUES ('$pnombre', $pestado);";
	//echo "insert......$insertSQL<br>";	
	 mysqli_select_db($cnn_kn, $database_cnn_kn);
	 $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err Ln72....$insertSQL<br>");
}

if( $Result1 )
{	   
	  $sigue="S";
}	 
echo $sigue;

mysqli_free_result($rs_tabla);
mysqli_close($cnn_kn);
?>