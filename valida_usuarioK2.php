<?php	
	session_start(); 
	require_once('Connections/cnn_kn.php');	
	require_once('rutador/enlaceControl.php');
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

    $theValue = function_exists("mysqli_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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

$usuario ="";
if(isset($_POST['pusuario']))
{
	$usuario = trim($_POST['pusuario']);
}

$clave ="";
if(isset($_POST['pclave']))
{
	$clave = trim($_POST['pclave']);
}

$usaSP="";
if(isset($_POST['sp']))
{
	$usaSP = $_POST['sp'];
}

$existe = 0;
if ($usuario != "" && $clave != "")
{	
	require_once('rutador/lnkVerUsuario.php');
}
else
{
	header('Location: index.html');
	exit;
}
?>