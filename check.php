<?php
require_once('Connections/cnn_kn.php'); 
//require_once('verificaSP.php');

if (!function_exists("GetSQLValueString")) 
{
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

$user=$_POST['username'];
$pass=$_POST['password'];   //base64_encode($_POST['password']);
//echo "$pass";
//$hashed_password = password_hash($pass, PASSWORD_DEFAULT);


 $hashFormat = "$2y$10$";
                $salt = "iusesomecrazystrings22";
                $hashF_and_salt = $hashFormat . $salt;
                $contrasena_nueva = crypt($pass, $hashF_and_salt);

echo $contrasena_nueva;

if($user=="msmakesof@gmail.com")
{
    echo 1; //"HI ".$user;   
}
else
{
    echo 0; //"I dont know you.";    
}
?>