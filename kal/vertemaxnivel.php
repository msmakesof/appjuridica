<?php 
require_once('../Connections/cnn_kn.php');
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    if (PHP_VERSION < 6) 
    {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

    switch ($theType) 
    {
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
$pars= $_POST['pars'];
$mats= $_POST['mat'];
$idjqcal = $_POST['idjqcal'];

echo "mats.........$mats<br>";
if($idjqcal > 0)
{
  mysqli_select_db($cnn_kn, $database_cnn_kn);
  $query_rs_tipo_matcal = "SELECT Materia FROM jqcalendar WHERE Id = $idjqcal;";
  $rs_tipo_matcal = mysqli_query($cnn_kn,$query_rs_tipo_matcal) or die(mysqli_error()." $query_rs_tipo_matcal");
  mysqli_set_charset($cnn_kn,"utf8");
  $row_rs_tipo_matcal = mysqli_fetch_assoc($rs_tipo_matcal);
  $totalRows_rs_tipo_matcal = mysqli_num_rows($rs_tipo_matcal);
  $mats = $row_rs_tipo_matcal['Materia'];
  mysqli_free_result($rs_tipo_matcal);  
}  


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_mattabla = "SELECT IdMateria, NombreMateria FROM temasxnivel JOIN materia ON temasxnivel.IdTemaTxN = materia.IdMateria AND materia.Estado = 1 WHERE temasxnivel.IdNivelTxN = $pars AND IdEstadoTxN = 1 ORDER BY NombreMateria;";
$rs_tipo_mattabla = mysqli_query($cnn_kn,$query_rs_tipo_mattabla) or die(mysqli_error()."$query_rs_tipo_mattabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla);
$totalRows_rs_tipo_mattabla = mysqli_num_rows($rs_tipo_mattabla);
echo "sql......$query_rs_tipo_mattabla<br>";

$lista = '';
$sel ="";
if($totalRows_rs_tipo_mattabla > 0)
{
  if($row_rs_tipo_mattabla['IdMateria'] == "")
  {
    $sel = "selected";
  }
  $lista .= "<option value='' $sel >Seleccione Topic</option>";
  do
  {
      $idmateria = $row_rs_tipo_mattabla['IdMateria'];
      $nommateria = $row_rs_tipo_mattabla['NombreMateria'];
      if($idmateria == $mats)
      {
        $sel = "selected";
      }
      else
      {
        $sel ="";
      }
     
     $lista .= "<option value='$idmateria' $sel >$nommateria</option>";
  } while($row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla));
}  
echo $lista;
mysqli_free_result($rs_tipo_mattabla);
?>