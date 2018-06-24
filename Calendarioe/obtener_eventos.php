
<?php 
require_once('../Connections/cnn_kn.php'); 
require_once('../Connections/config2.php'); 
?>
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


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_suctabla = "SELECT eventos.*, clases.*, concat_WS(' ',Nombres_PRO, Apellido1_PRO) as nombreProfesor, NombreSucursal, NombreMateria, NombreSalon, Inicio, Final FROM eventos JOIN clases ON clases.IdEvento = eventos.id JOIN profesores ON profesores.IdProfesor = clases.Profesor JOIN sucursal ON sucursal.IdSucursal = clases.Sede JOIN materia ON materia.IdMateria = clases.Materia JOIN salon ON salon.IdSalon = clases.Salon JOIN horario ON horario.IdHorario = clases.horario ;";
$rs_tipo_suctabla = mysqli_query($cnn_kn,$query_rs_tipo_suctabla) or die(mysqli_error()."$query_rs_tipo_suctabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_suctabla = mysqli_fetch_assoc($rs_tipo_suctabla);
$numero_filas = mysqli_num_rows($rs_tipo_suctabla);

if($numero_filas > 0)
{    
    $datos = array();
    $i=0; 

    do 
    {
        $datos[$i] = $row_rs_tipo_suctabla; 
        $i++;

    } while($row_rs_tipo_suctabla = mysqli_fetch_assoc($rs_tipo_suctabla));

    echo json_encode(
        array(
            "success" => 1,
            "result" => $datos
        )
    );
}
else
{
     echo "No hay datos"; 
}

mysqli_free_result($rs_tipo_suctabla);
?>
