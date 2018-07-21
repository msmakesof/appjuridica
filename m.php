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
//$parameters = array("insert" => "insert", "TipoDocumento" => "$tipodocumento","Identificacion" => "$numerodocumento","PrimerApellido" => "$apellido1", "SegundoApellido" => "$apellido2","Nombre" => "$nombre","Email" => "$email", "Direccion" => "$direccion","Celular" => "$celular", "Usuario" => "$email", "Clave" => "$clave", "TipoUsuario" => "$tipousuario", "Estado" => "$estado", "IdInterno" => "$interno", "Local" => "$local");
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
// // the standard end point for posts in an initialised Curl
// $process = curl_init('http://localhost/appjuridica/consultadetalle/consultadetalle_Usuario.php');
// // create an array of data to use, this is basic - see other examples for more complex inserts
// $datax = array('slug' => 'rest_insert' , 'title' => 'REST API insert' , 'content' => 'The content of our stuff', 'excerpt' => 'smaller' );

// $data = array("insert" => "1", "TipoDocumento" => "$tipodocumento" ,"Identificacion" => "$numerodocumento", "PrimerApellido" => "$apellido1", "SegundoApellido" => "$apellido2", "Nombre" => "$nombre", "Email" => "$email", "Direccion" => "CALLE 153", "Celular" => "$celular", "Usuario" => "$email" ,"Clave" => "$clave", "TipoUsuario" => "$tipousuario","Estado" => "$estado", "IdInterno" => "$interno", "Local" => "$local");
// //echo "<br>****";
// //print_r($data);
// //echo "<br>***";
// $data_string = json_encode($data);
// echo "<br>*** dS: $data_string ***<br>";
// // create the options starting with basic authentication
// //curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
// curl_setopt($process, CURLOPT_TIMEOUT, 30);
// curl_setopt($process, CURLOPT_POST, 1);
// // make sure we are POSTing
// curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
// // this is the data to insert to create the post
// curl_setopt($process, CURLOPT_POSTFIELDS, $data_string);
// // allow us to use the returned data from the request
// curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
// // we are sending json
// curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Length: 0', 'Content-Type: application/json')
// );


// $result = curl_exec($process); 
// $errorCode = curl_getinfo($process, CURLINFO_HEADER_OUT);
// $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);

// echo "result..........$result<br>";
// echo curl_error($process);
// echo "errorCode.......$errorCode<br>";
// echo "httpcode........$httpcode<br>";

// //print_r($_SERVER);
// //log_message('debug', 'HTTP HEADER '. $errorCode); 
// curl_close($process);


////. strlen($data_string)

// //curl_setopt($process, CURLOPT_FAILONERROR, true);
// // process the request
// $return = curl_exec($process);
// echo "return.......$return<br>";
// $http_status = curl_getinfo($process, CURLINFO_HTTP_CODE);
// echo "http status....$http_status<br>";
// $curl_errno= curl_errno($process);

// if ($return === FALSE) {
//     echo "cURL Error: " . curl_error($ch);
// } 
// else 
// {
//     echo "por el else<br/>";
//     $response = json_decode($return,true);
//     echo "<br>reponse...";
//     print_r($response);
//     echo "<br>";
//     echo $response['traceroute']['result'];
// }

// curl_close($process);
// // This buit is to show you on the screen what the data looks like returned and then decoded for PHP use
// echo "Curl Errno returned $curl_errno <br/>";
// echo '<h2>Results</h2>';
// print_r($return);
// echo '<h2>Decoded</h2>';
// $result = json_decode($return, true);
// print_r($result);

?>