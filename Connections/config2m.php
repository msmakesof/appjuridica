<?php require_once('cnn_kn.php'); ?>

<?php
//echo "*****<br>";
//echo "host...$hostname_cnn_kn<br>";
//echo "*****<br>";
if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
	  if (PHP_VERSION < 6) {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	  }
	
	  $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);
	
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

$soportecURL = "S";
//$url         = urlServicios."consultadetalle/consultadetalle_Usuario.php?idU=$usuario&idC=$clave";


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_keyED = "SELECT CON_LlaveInicial, CON_LlaveIv, CON_MetodoEncriptacion, CON_TipoHash FROM gen_control WHERE CON_IdEstado = 1;" ;
//echo $query_rs_keyED;
$rs_keyED = mysqli_query($cnn_kn, $query_rs_keyED) or die(mysqli_error()."Err.....$query_rs_keyED");
$row_rs_keyED = mysqli_fetch_assoc($rs_keyED);
$totalRows_rs_keyED = mysqli_num_rows($rs_keyED);

if ($resultado = mysqli_query($cnn_kn, $query_rs_keyED)) 
{
	while($strowreg = mysqli_fetch_assoc($resultado))
	{ 
		$secret_key = trim($strowreg["CON_LlaveInicial"]);
		$secret_iv = trim($strowreg["CON_LlaveIv"]);
		$encrypt_method = trim($strowreg["CON_MetodoEncriptacion"]);
		$tipo_hash = trim($strowreg["CON_TipoHash"]);
		
		$GLOBALS['tipo_hash'] = $tipo_hash;
		$GLOBALS['secret_key'] = $secret_key;
		$GLOBALS['secret_iv'] = $secret_iv;
		$GLOBALS['encrypt_method'] = $encrypt_method;
	}
}

// include('../rutador/enlaceControl.php');
// 		$GLOBALS['tipo_hash'] = $tipo_hash;
// 		$GLOBALS['secret_key'] = $secret_key;
// 		$GLOBALS['secret_iv'] = $secret_iv;
// 		$GLOBALS['encrypt_method'] = $encrypt_method;

$sn= $_SERVER['SERVER_NAME'];     // Nombre Servidor
$username = get_current_user();   // Nombre usuario logueado
$np = gethostname();              // Nombre del Equipo donde esta el sitio
$ips = $_SERVER['SERVER_ADDR'];   // IP del Servidor
$fecha = strtotime("now");
$mks = mt_rand();
$clave = "litigantes.lawyer"; // "Carrera 23 No. 115-85"; // "027"; //

//$clave = $fecha;
$clave = "$fecha|$sn|$username|$np|$ips|$clave|$mks";
$clave = encryptor('encrypt', $clave);
echo "Cifrada Llave Inicial...........$clave<br>";

$clave = encryptor('decrypt', $clave);
echo "Descifrada Llave Inicial...........$clave<br>";


$clave1 = "$fecha|$sn|$username|$np|$ips|$clave|$mks"; //"litigantes.lawyer";
$x = password_hash("litigantes", PASSWORD_DEFAULT);
echo "!!! Cifrando ........ $x";

//$x ="12345678980";
$y = password_verify($clave1, $x);
echo "<br>!!! Descifrando .......$y<br>";

define('DB_HOST', filter_var($_SERVER['SERVER_NAME'], FILTER_SANITIZE_STRING));

echo "---------------";
echo DB_HOST;
echo "---------------<br>";

//include(https://drive.google.com/open?id=1FZeuCqqwNXwuGGCIedPtbYxUHeSLF7eW)
include('https://drive.google.com/open?id=1yw0EKNIaVTKCnakwpQ9a4jL6ch9LfP2v');

if($cnn_kn)
{
	define("HOSTNAME", "$hostname_cnn_kn");// Nombre del host
	define("DATABASE", "$database_cnn_kn"); // Nombre de la base de datos
	define("USERNAME", "$username_cnn_kn"); // Nombre del usuario
	define("PASSWORD", "$password_cnn_kn"); // Nombre de la constrase�a
	define("WEBSITE", "$dominio"); // Nombre del sitio web
	define("urlServicios","http://".HOSTNAME."/".WEBSITE."/");   /// Url para llamar servicios
	define("LogoInterno", "../../images/logoLitigant.gif");
	define("Company", "$Company");
}
else
{
	echo "Error conexi�n DATABASE ...".mysqli_error();
}


function encryptor($action, $string) {
    $output = false;

    // hash
    $key = hash($GLOBALS['tipo_hash'], $GLOBALS['secret_key']);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash($GLOBALS['tipo_hash'], $GLOBALS['secret_iv']), 0, 16);		

    //do the encyption given text/string/number
		if( $action == 'encrypt' ) 
		{
        $output = openssl_encrypt($string, $GLOBALS['encrypt_method'], $key, 0, $iv);
        $output = base64_encode($output);
    }
		else if( $action == 'decrypt' )
		{
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $GLOBALS['encrypt_method'], $key, 0, $iv);
    }

    return trim($output);
}

/****   NOTAS  (No borrar esta nota es un ejemplo)   ***/
// Almacenar el hash de la contrase�a
// $caracteres_aleatorios se obtuvo, p.ej., utilizando /dev/random
/*
$consulta  = sprintf("INSERT INTO users(name,pwd) VALUES('%s','%s');",
                 pg_escape_string($nombre_usuario),
                 pg_escape_string(crypt($contrase�a, '$2a$07$' . $caracteres_aleatorios . '$')));
$resultado = pg_query($conexi�n, $consulta);

// Consultar si el usuario envi� la contrase�a correcta
$consulta = sprintf("SELECT pwd FROM users WHERE name='%s';",
                pg_escape_string($nombre_usuario));
$fila = pg_fetch_assoc(pg_query($conexi�n, $consulta));

if ($fila && crypt($contrase�a, $fila['pwd']) == $fila['pwd']) {
    echo 'Bienvenido, ' . htmlspecialchars($nombre_usuario) . '!';
} else {
    echo 'La autenticaci�n ha fallado para ' . htmlspecialchars($nombre_usuario) . '.';
}
*/



mysqli_free_result($rs_keyED);
?>