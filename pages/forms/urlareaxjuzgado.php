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


if(isset($_GET['id']))
{
   $id = $_GET['id'];
}
else
{
    $id ="";
}
//$id= 8;
//echo "<script>alert($id);</script>";

$row_rs_tabla = 0;
if($id !="")
{
    mysqli_select_db($cnn_kn, $database_cnn_kn);
    $query_rs_tabla = "SELECT ARE_IdArea, ARE_Nombre FROM juz_area WHERE ARE_IdTipoJuzgado = $id; "; 
    //echo "qry_usu......$query_rs_tabla<br>" ;
    $rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err.....$query_rs_tabla<br>");
    $row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
    $totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

    $areas = array();
    $xoptions='';//<select id="area" name="area" class="selectpicker show-tick" data-live-search="true" data-width="80%" required>';
    //if( $totalRows_rs_tabla > 0 )
    //{
        do
        {
            //$areas[$row_rs_tabla['ARE_IdArea']] = $row_rs_tabla['ARE_Nombre'];
            $idarea = $row_rs_tabla["ARE_IdArea"];
            $nom = $row_rs_tabla["ARE_Nombre"];
            //echo $idarea." - ".$nom ."<br >";

            $xoptions .='<option value="'.$idarea.'">'.$nom.'</option>';

        } while($row_rs_tabla = mysqli_fetch_assoc($rs_tabla));
        //$xoptions .='</select>';
        echo $xoptions;
        //print_r(json_encode($areas));
        //echo $options;
    //}
    mysqli_free_result($rs_tabla);
    mysqli_close($cnn_kn);
}
?>