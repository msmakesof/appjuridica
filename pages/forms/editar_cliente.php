<?php 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
  session_start(); 
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
  $apellido1 = str_replace(" ","%20",$apellido1);
}

$apellido2 ="";
if(isset($_POST['apellido2'])){
  $apellido2 = trim($_POST['apellido2']);
  $apellido2 = str_replace(" ","%20",$apellido2);
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

$tipocliente ="";
if(isset($_POST['tipocliente'])){
  $tipocliente = trim($_POST['tipocliente']);
}

$estado ="";
if(isset($_POST['estado'])){
	$estado = trim($_POST['estado']);
}

$OldClave ="";
if(isset($_POST['OldClave'])){
  $OldClave = trim($_POST['OldClave']);
}

if($OldClave != $clave)
{
  $clave = encryptor('encrypt',$clave);
}

$verseguimiento = 0;
if(isset($_POST['verseguimiento'])){
  $verseguimiento = trim($_POST['verseguimiento']);
  //if($verseguimiento == "on")
  //{
//	  $verseguimiento = 1;
  //}
}

$empresa ="";
if(isset($_POST['empresa'])){
	$empresa = trim($_POST['empresa']);
}

$usuariomodifica ="";
if(isset($_POST['uc'])){
	$usuariomodifica = trim($_POST['uc']);
}

$tipodocumentorl ="";
if(isset($_POST['tipodocumentorl'])){
  $tipodocumentorl = trim($_POST['tipodocumentorl']);
}

$numerodocumentorl ="";
if(isset($_POST['numerodocumentorl'])){
  $numerodocumentorl = trim($_POST['numerodocumentorl']);
}

$nombrerl ="";
if(isset($_POST['nombrerl'])){
  $nombrerl = trim($_POST['nombrerl']);
  $nombrerl = str_replace(" ","%20",$nombrerl);  
}

$apellido1rl ="";
if(isset($_POST['apellido1rl'])){
  $apellido1rl = trim($_POST['apellido1rl']);
  $apellido1rl = str_replace(" ","%20",$apellido1rl);  
}

$emailrl ="";
if(isset($_POST['emailrl'])){
  $emailrl = trim($_POST['emailrl']);
}

$celularrl ="";
if(isset($_POST['celularrl'])){
  $celularrl = trim($_POST['celularrl']);
}

$tipodocumentorl2 ="";
if(isset($_POST['tipodocumentorl2'])){
  $tipodocumentorl2 = trim($_POST['tipodocumentorl2']);
}

$numerodocumentorl2 ="";
if(isset($_POST['numerodocumentorl2'])){
  $numerodocumentorl2 = trim($_POST['numerodocumentorl2']);
}

$nombrerl2 ="";
if(isset($_POST['nombrerl2'])){
  $nombrerl2 = trim($_POST['nombrerl2']);
  $nombrerl2 = str_replace(" ","%20",$nombrerl2);  
}

$apellidosrl2 ="";
if(isset($_POST['apellidosrl2'])){
  $apellidosrl2 = trim($_POST['apellidosrl2']);
  $apellidosrl2 = str_replace(" ","%20",$apellidosrl2);  
}

$emailrl2 ="";
if(isset($_POST['emailrl2'])){
  $emailrl2 = trim($_POST['emailrl2']);
}

$celularrl2 ="";
if(isset($_POST['celularrl2'])){
  $celularrl2 = trim($_POST['celularrl2']);
}

require_once('../../apis/cliente/infoCliente.upd.php');
?>