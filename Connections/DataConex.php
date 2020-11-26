<?php
/**
 * Provee las constantes para conectarse a la base de datos
 * Mysql.
 */
 
$hostname_cnn_kn = "192.168.0.3";
$database_cnn_kn = "appjudicial";
$username_cnn_kn = "usrremoto";
$password_cnn_kn = "Vialibre90$";
$dominio="appjuridica";
$Company="Litigantes";
/*
$hostname_cnn_kn = "litigantes.lawyer";
$database_cnn_kn = "litigant_appjudicial";
$username_cnn_kn = "litigant_makesof";
$password_cnn_kn = "L1t1g4Nt3_fR33W4Y";
$dominio="litigantes";
*/
$cnn_kn = mysqli_connect($hostname_cnn_kn, $username_cnn_kn, $password_cnn_kn) or trigger_error(mysqli_error(),E_USER_ERROR);
mysqli_set_charset($cnn_kn,"utf8");

if($cnn_kn)
{
	define("HOSTNAME", "$hostname_cnn_kn");// Nombre del host
	define("DATABASE", "$database_cnn_kn"); // Nombre de la base de datos
	define("USERNAME", "$username_cnn_kn"); // Nombre del usuario
	define("PASSWORD", "$password_cnn_kn"); // Nombre de la constraseña
	define("WEBSITE", "$dominio"); // Nombre del sitio web
	define("urlServicios","http://".HOSTNAME."/".WEBSITE."/");   /// Url para llamar servicios
	define("LogoInterno", "../../images/logoLitigant.gif");
	define("Company", "$Company");
}
else
{
	echo "Error conexión DATABASE ...".mysqli_error();
}	
?>