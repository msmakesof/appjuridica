<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!-- Acción sobre el botó con id=boton y actualizamos el div con id=capa -->
		<script type="text/javascript">
			$(document).ready(function() {				
				$("#capa").load('https://litigantes.github.io/viajar.html #contenido');
				
			});
		</script>
<?php
//include('fnx/fixer.php');
 
		

$url =  "<div id='capa'></div>";  //"https://boshika.co/post.php";
echo "url......$url";

$ch = curl_init($url);

//attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POST, false);
//return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//ejecuto el POST request
$result = curl_exec($ch);

//echo $result ;
curl_close($ch);

$txt = trim($result);
$var = json_decode($txt);

$hostname_cnn_kn = $var[0]->DHO_Host;
$database_cnn_kn = $var[0]->DHO_Data;
$username_cnn_kn = $var[0]->DHO_Usuario;
$password_cnn_kn = $var[0]->DHO_Clave;

/*
echo "<br>*******************<br>";
echo "host...".$hostname_cnn_kn;
echo "<br>*******************<br>";
echo "DataBase...".$database_cnn_kn;
echo "<br>*******************<br>";
echo "Usuario...".$username_cnn_kn;
echo "<br>*******************<br>";
echo "Clave...".$password_cnn_kn;
*/
$dominio="litigantes";
$Company="Litigantes";
$cnn_kn = mysqli_connect($hostname_cnn_kn, $username_cnn_kn, $password_cnn_kn) or trigger_error(mysqli_error(),E_USER_ERROR);
mysqli_set_charset($cnn_kn,"utf8");

if($cnn_kn)
{
	echo "<br>Conectado...";
/*
echo "<br>*******************<br>";

$hostHN = encryptor('encrypt', $hostname_cnn_kn);
echo "Cifrada HN..............$hostHN<br>";

$hostHNd = encryptor('decrypt', $hostHN);
echo "Descifrada HNd..........$hostHNd<br>";

$DBDBN = encryptor('encrypt', $DB);
echo "Cifrada DB..............$DBDBN<br>";

$DBDBNd = encryptor('decrypt', $DBDBN);
echo "Descifrada DBd..........$DBDBNd<br>";

echo "<br>*******************<br>";
*/

	define("HOSTNAME", "$hostname_cnn_kn");// Nombre del host
	define("HOSTNAMEP", "litigantes.lawyer");// Nombre del host	
	define("DATABASE", "$database_cnn_kn"); // Nombre de la base de datos
	define("USERNAME", "$username_cnn_kn"); // Nombre del usuario
	define("PASSWORD", "$password_cnn_kn"); // Nombre de la constraseÃ±a
	define("WEBSITE", "$dominio"); // Nombre del sitio web
	define("urlServicios","https://".HOSTNAMEP."/".WEBSITE."/");   /// Url para llamar servicios
	define("LogoInterno", "../../images/logoLitigant.gif");
	define("Company", "$Company");
}
else
{
	echo "Error conexión DATABASE ...".mysqli_error();
}



/*
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
*/
?>