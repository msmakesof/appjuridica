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

mysqli_free_result($rs_keyED);
?>