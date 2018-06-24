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

$idtransportador ="";
if(isset($_POST['idtransportador'])){
  $idtransportador = trim($_POST['idtransportador']);
}

$pidconductor ="";
if(isset($_POST['idconductor'])){
  $pidconductor = trim($_POST['idconductor']);
}

$strowreg =0;
$row_rs_tabla = 0;
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tabla = "SELECT IdConductor, Nombres, Nit FROM conductores WHERE IdTransportador = $idtransportador ORDER BY Nombres; "; 
$rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err.....$query_rs_tabla<br>");
$row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
$totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

$selected = "";
$lista = '';
$lista .= '<select id="xxconductor" class="form-control" name="xxconductor" data-live-search="true">';
if( $totalRows_rs_tabla > 0 )
{
  $lista .= "<option value=''> Seleccione Conductor </option>";
  do                                                 
  {           
      $idConductor = $row_rs_tabla["IdConductor"];
      $NombreConductor = $row_rs_tabla["Nombres"];  
      if($idConductor == $pidconductor)
      {
        $selected = "selected=selected";
      }
      else
      {
        $selected = ""; 
      }     

      $lista .= "<option value='$idConductor' $selected>$NombreConductor</option>";
	} while($row_rs_tabla = mysqli_fetch_assoc($rs_tabla));	
}
else
{
  $lista = "<option value=''>-- NO HAY DATOS --</option>";
}
$lista .= '</select>';
echo $lista;
mysqli_free_result($rs_tabla);
?>