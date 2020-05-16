<?php
/**
 * Provee las constantes para conectarse a la base de datos
 * Mysql.
 */

include('../fnx/fixer.php');

$hostname_cnn_kn = "boshika.co";
$database_cnn_kn = "boshikac_appjudicial";
$username_cnn_kn = "boshikac_msmakesof";
$password_cnn_kn = "B0sh1K4_F1ll3rW4y";

$claveHN = encryptor('encrypt', $hostname_cnn_kn);
echo "Cifrada HN..............$claveHN<br>";

$claveHNd = encryptor('decrypt', $claveHN);
echo "Descifrada HNd..........$claveHNd<br>";

$claveDB = encryptor('encrypt', $database_cnn_kn);
echo "Cifrada DB..............$claveDB<br>";

$claveDBd = encryptor('decrypt', $claveDB);
echo "Descifrada DBd..........$claveDBd<br>";

/*
$hostname_cnn_kn = "litigantes.lawyer";
$database_cnn_kn = "litigant_appjudicial";
$username_cnn_kn = "litigant_makesof";
$password_cnn_kn = "L1t1g4Nt3_fR33W4Y";
*/
$dominio="litigantes";
$Company="Litigantes";
$cnn_kn = mysqli_connect($hostname_cnn_kn, $username_cnn_kn, $password_cnn_kn) or trigger_error(mysqli_error(),E_USER_ERROR);
mysqli_set_charset($cnn_kn,"utf8");

if($cnn_kn)
{
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
?>