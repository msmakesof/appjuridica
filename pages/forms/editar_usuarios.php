<?php
session_start();
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
   
} 
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

$idUsuario ="";
if(isset($_POST['idtabla'])){
  $idUsuario = trim($_POST['idtabla']);
}

$empresa ="";
if(isset($_POST['empresa'])){
  $empresa = trim($_POST['empresa']);
}

$tipodocumento ="";
if(isset($_POST['tipodocumento'])){
  $tipodocumento = trim($_POST['tipodocumento']);
}

$numerodocumento ="";
if(isset($_POST['numerodocumento'])){
  $numerodocumento = trim($_POST['numerodocumento']);
}

$nombre ="";
if(isset($_POST['nombre'])){
  $nombre = trim($_POST['nombre']);
  $nombre = str_replace(" ","%20",$nombre);
}

$apellido1 ="";
if(isset($_POST['apellido1'])){
  $apellido1 = trim($_POST['apellido1']);
}

$apellido2 ="";
if(isset($_POST['apellido2'])){
  $apellido2 = trim($_POST['apellido2']);
}

$clave ="";
if(isset($_POST['clave'])){
  $clave = trim($_POST['clave']);
}

$direccion ="";
if(isset($_POST['direccion'])){
  $direccion = trim($_POST['direccion']);  
  $direccion = str_replace(' ', '%20', $direccion);
  $direccion = str_replace('#',"No.", $direccion); 
}
$email ="";
if(isset($_POST['email'])){
  $email = trim($_POST['email']);
}
$celular ="";
if(isset($_POST['celular'])){
  $celular = trim($_POST['celular']);
}

$tipousuario ="";
if(isset($_POST['tipousuario'])){
  $tipousuario = trim($_POST['tipousuario']);
}

$estado ="";
if(isset($_POST['estado'])){
	$estado = trim($_POST['estado']);
}

$abogado ="";
if(isset($_POST['abogado'])){
  $abogado = trim($_POST['abogado']);
}

$OldClave ="";
if(isset($_POST['OldClave'])){
  $OldClave = trim($_POST['OldClave']);
}

if($OldClave != $clave)
{
  $clave = encryptor('encrypt',$clave);
}

require_once('../../apis/usuario/infoUsuariosu.upd.php');
?>