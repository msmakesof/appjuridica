<?php require_once('../Connections/cnn_kn.php'); ?>
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

$id = 0;
if(isset($_POST['pidtabla'])){
	$id = trim($_POST['pidtabla']);
}



$sigue = "N";
$deleteSQL = "DELETE FROM eventos WHERE id = $id ;";
mysqli_select_db($cnn_kn, $database_cnn_kn);
$Result1 = mysqli_query($cnn_kn, $deleteSQL ) or die(mysqli_error()." Err...".$deleteSQL);
if($Result1)
{
     $sigue = "S";
}    

$deleteSQL = "DELETE FROM clases WHERE IdEvento = $id;";
mysqli_select_db($cnn_kn, $database_cnn_kn);
$Result1 = mysqli_query($cnn_kn, $deleteSQL ) or die(mysqli_error()." Err...".$deleteSQL);

if($Result1 && $sigue == "S")
{    
  $sigue = "S"; 
}
else
{
  $sigue = "N";
}   

echo $sigue;
mysqli_close($cnn_kn);
?>