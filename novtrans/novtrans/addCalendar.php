<?php 
require_once('../../Connections/cnn_kn.php');
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

$pid = $_POST['id'];       
$psede = $_POST['sede']; 
$pprofesor = $_POST['profesor']; 
$psalon = $_POST['salon']; 
$phorario = $_POST['horario']; 
$pnivel = $_POST['nivel']; 
$pmateria = $_POST['materia']; 
$fechaEvento = $_POST['hf_start']; 
//echo "pid.........$pid<br>$fechaEvento<br>";

  $year = substr($fechaEvento,0,4); 
  $mes = substr($fechaEvento,5,2);
  $desde = "";
  $hasta = "";
  $desde = $year.'-'.$mes.'-01';
  switch($mes)
  {
      case 1:
      case 3:
      case 5:
      case 7:
      case 8:
      case 10:
      case 12:        
        $hasta = $year.'-'.$mes.'-31';
        break;
      case 2:        
        $hasta = $year.'-'.$mes.'-29';
        break;
      case 4:
      case 6:
      case 9:
      case 11:
        $hasta = $year.'-'.$mes.'-30';
        break;
  }

$lista = "N";
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_mattabla = "SELECT * FROM jqcalendar WHERE Sede = '$psede' AND Profesor = '$pprofesor' AND Salon = '$psalon' AND Horario = '$phorario ' AND Nivel = '$pnivel' AND Materia = '$pmateria' AND IdEvento = '$fechaEvento' ;";
$rs_tipo_mattabla = mysqli_query($cnn_kn,$query_rs_tipo_mattabla) or die(mysqli_error()."$query_rs_tipo_mattabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla);
$totalRows_rs_tipo_mattabla = mysqli_num_rows($rs_tipo_mattabla);
//echo "sql......$query_rs_tipo_mattabla<br>";

$lista = '';
if($totalRows_rs_tipo_mattabla > 0)
{
  $lista = "R";
}
else
{
    $insertSQL = "";        
    $insertSQL = "INSERT INTO clases (IdClase, Sede, Profesor, Salon, Horario, Nivel, Materia, FechaGraba, IdEvento, Estado, desde, hasta) VALUES (0, $psede, $pprofesor, $psalon, $phorario, $pnivel, $pmateria, Now(), '$fechaEvento', 1, '$desde', '$hasta');";mysqli_select_db($cnn_kn, $database_cnn_kn);
    $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err93....$insertSQL<br>");  

    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_tipo_amattabla = "SELECT max(IdClase) idclase FROM clases;";
    $rs_tipo_amattabla = mysqli_query($cnn_kn,$query_rs_tipo_amattabla) or die(mysqli_error()."$query_rs_tipo_mattabla");
    mysqli_set_charset($cnn_kn,"utf8");
    $row_rs_tipo_amattabla = mysqli_fetch_assoc($rs_tipo_amattabla);
    $totalRows_rs_tipo_amattabla = mysqli_num_rows($rs_tipo_amattabla);
    $idclasemax = $row_rs_tipo_amattabla['idclase'];
    mysqli_free_result($rs_tipo_amattabla);

    $insertSQL = "INSERT INTO jqcalendar (Id, IdClase, Sede, Salon, Materia, Nivel, Horario, Profesor, FechaGraba, IdEvento, Estado, desde, hasta) VALUES (0, $idclasemax, $psede, $psalon, $pmateria, $pnivel, $phorario, $pprofesor, Now(), '$fechaEvento', 1 , '$desde', '$hasta')";
    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $Result2 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err104....$insertSQL<br>");  

    if($Result1 && $Result2)
    {
       $lista = "S";   
    }

}  
echo $lista;
mysqli_free_result($rs_tipo_mattabla);
?>