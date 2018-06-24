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

$idTemaxNivel ="";
if(isset($_POST['idtabla'])){
  $idTemaxNivel = trim($_POST['idtabla']);
}
//echo "ideest....$idEstudiante<br>";

$nivel ="";
if(isset($_POST['nombre'])){
  $nivel = trim($_POST['nombre']);
}

$materia ="";
if(isset($_POST['sucursal'])){
  $materia = trim($_POST['sucursal']);
}

$estado ="";
if(isset($_POST['estado'])){
	$estado = trim($_POST['estado']);
}

$strowreg =0;
$row_rs_tabla = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tabla = "SELECT IdTemaxNivel FROM temasxnivel WHERE IdTemaxNivel = $idTemaxNivel; "; 
//echo "qry_usu......$query_rs_tabla" ;
$rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err.....$query_rs_tabla<br>");
$row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
$totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

if( $totalRows_rs_tabla == 1 )
{
	
  mysqli_select_db($cnn_kn, $database_cnn_kn);
  $query_rs_tablax = "SELECT IdTemaxNivel FROM temasxnivel WHERE IdNivelTxN = $nivel AND IdTemaTxN = $materia AND IdEstadoTxN = $estado; "; 
  //echo "qry_usu......$query_rs_tablax" ;
  $rs_tablax = mysqli_query($cnn_kn, $query_rs_tablax) or die(mysqli_error()."Err2.....$query_rs_tablax<br>");
  $row_rs_tablax = mysqli_fetch_assoc($rs_tablax);
  $totalRows_rs_tablax = mysqli_num_rows($rs_tablax);
  $sigue = "N";
  //echo "tot antes de.....$totalRows_rs_tablax<br>";
    if( $totalRows_rs_tablax == 0 )  
    {  
    	$insertSQL = "UPDATE temasxnivel SET IdNivelTxN = $nivel, IdTemaTxN = $materia, IdEstadoTxN = $estado WHERE IdTemaxNivel = $idTemaxNivel;";
    	mysqli_select_db($cnn_kn, $database_cnn_kn);
    	$Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err....$insertSQL<br>");    	
    	if( $Result1 )
    	{	   
    	  $sigue = "S";
    	}
    }

    echo $sigue;
}
mysqli_free_result($rs_tabla);
mysqli_free_result($rs_tablax);
mysqli_close($cnn_kn);
?>