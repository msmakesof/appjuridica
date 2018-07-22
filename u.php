<?php
///////////////////////////////////////////////////////////////////////////////////
//                                                                               //
// This is using a sample local WordPress Install and is not production safe     //
// It uses the  REST and Basic Auth plugins                                      //
//                                                                               //
///////////////////////////////////////////////////////////////////////////////////
// setup user name and password
$username = 'admin';
$password = 'password';

set_time_limit(0);

$interno = rand(10000000,100000123456789);
$local = rand(10000000,1234567890000);
$tipodocumento= 2;
$numerodocumento= 33312345;
$apellido1= 'sanchez';
$apellido2= 'getz';
$nombre= 'roberts';
$clave= '123456';
$direccion= 'transversal%2015%20No.%203-99';
$email= 'robe@gmail.com';
$celular= '3114324234';
$estado= 1;
$tipousuario= 1;
require_once('Connections/DataConex.php');

$parameters = "insert=insert&TipoDocumento=$tipodocumento&Identificacion=$numerodocumento&PrimerApellido=$apellido1&SegundoApellido=$apellido2&Nombre=$nombre&Email=$email&Direccion=$direccion&Celular=$celular&Usuario=$email&Clave=$clave&TipoUsuario=$tipousuario&Estado=$estado&IdInterno=$interno&Local=$local";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/appjuridica/consultadetalle/consultadetalle_Usuario.php?'.$parameters);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);    
    curl_setopt($ch, CURLOPT_POST, 0);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0','Content-Type: application/json'));
    
    $result = curl_exec($ch); 
    $errorCode = curl_getinfo($ch, CURLINFO_HEADER_OUT);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    echo "result.......$result<br>";
    echo "curlerr......".curl_error($ch)."<br>";
    echo "errorCode....$errorCode<br>";
    echo "httpcode.....$httpcode<br>";

    curl_close($ch);
?>