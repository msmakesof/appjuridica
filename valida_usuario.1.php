<?php require_once('Connections/cnn_kn.php'); ?>
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

$usuario ="";
if(isset($_POST['pusuario']))
{
	$usuario = trim($_POST['pusuario']);
}


mysqli_select_db($cnn_kn,$database_cnn_kn);
$query_rs_usuarios = "SELECT USU_Email correoP, CONCAT_WS(' ',USU_Nombre,USU_PrimerApellido,USU_SegundoApellido) Nombres 
FROM usu_usuario WHERE USU_Local = $usuario AND USU_Estado = 1 ;" ;
$rs_usuarios = mysqli_query($cnn_kn, $query_rs_usuarios) or die(mysqli_error()."Err.....$query_rs_usuarios<br>");
echo $query_rs_usuarios;
$row_rs_usuarios = mysqli_fetch_assoc($rs_usuarios);
$totalRows_rs_usuarios = mysqli_num_rows($rs_usuarios);

$row_rs_usuariosAcceso = "";
$usaSP = "";

//if ($usuresultado = mysqli_query($cnn_kn, $query_rs_usuarios)) {
if( $totalRows_rs_usuarios == 1 )
{
	do{
		$Email_usuario = $row_rs_usuarios["correoP"];		
		$Nombres_usuario = $row_rs_usuarios["Nombres"];
	} while($row_rs_usuarios = mysqli_fetch_assoc($rs_usuarios));
	$usaSP = array("$Email_usuario", "$Nombres_usuario");

	echo json_encode($usaSP);
}		
mysqli_close($cnn_kn); 
?>
