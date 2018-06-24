<?php
    require_once('../Connections/DataConex.php');

    //$cont = file_get_contents(urlServicios."consultadetalle/consultadetalle_gen_configuracion.php?idEstado=1");     
    //$obj = json_decode($cont);

    /*
    $handler = curl_init("http://www.google.es");
    $response = curl_exec ($handler);
    curl_close($handler);
    echo $response;
*/

//     $handler = curl_init();
// curl_setopt($handler, CURLOPT_URL, "http://localhost/appjuridica/consultadetalle/consultadetalle_gen_configuracion.php");
// curl_setopt($handler, CURLOPT_POST,true);
// curl_setopt($handler, CURLOPT_POSTFIELDS, "idEstado=1");
// $response = curl_exec ($handler);
// curl_close($handler);

//$json=str_replace('},]',"}]",$json);

if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://localhost/appjuridica/consultadetalle/consultadetalle_gen_configuracion.php?idEstado=1");
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt ($ch, CURLOPT_POST, 0);
    $resultado = curl_exec ($ch);
    curl_close($ch); 
    
    //print_r($resultado);
    $resultado = json_decode($resultado, true);
    
    $titulo1 = $resultado['gen_configuracion']['CON_TituloApp'];
        //var_dump($resultado);
    echo "<br><br>";    
    echo "titu1...$titulo1<br>";
    $logo = $resultado['gen_configuracion']['CON_Logo'] ;  
    echo $logo;  
}
else
{
	echo "No hay soporte para cURL";
}

echo "<br>*************   unirest   ********<br>";
require_once('../unirest/vendor/autoload.php');


$cpf = "1";
$response = Unirest\Request::get("http://localhost/appjuridica/consultadetalle/consultadetalle_gen_configuracion.php?idEstado=".$cpf,
  array(
    "X-Mashape-Key" => "MY SECRET KEY"
  )
);
echo "<br>";
echo $response->raw_body;
$getResponseVal = $response->raw_body;
$my = json_decode($getResponseVal, true);
echo  print_r($my);
echo "<br>logomy....". $my['gen_configuracion']['CON_Logo'] ."<br>";
echo "<br>*****************************<br>";
/*
$headers = array('Accept' => 'application/json');
$query = array('idEstado' => '1');

$response = Unirest\Request::post('http://localhost/appjuridica/consultadetalle/consultadetalle_gen_configuracion.php', $headers, $query);
//http://localhost/appjuridica/consultadetalle/consultadetalle_gen_configuracion.php?idEstado=1
$response->code;        // HTTP Status code
$response->headers;     // Headers
$response->body;        // Parsed body
$response->raw_body;    // Unparsed body
echo "<br>"; print_r($response->code);
echo "<br>". print_r($response->headers);
echo "<br>"; print_r($response->body);
echo "<br>". print_r($response);
echo "<br>*****************************";

$headersx = array('Accept' => 'application/json');
$datax = array('idEstado' => '1');

$bodyx = Unirest\Request\Body::json($datax);

$responsex = Unirest\Request::post('http://localhost/appjuridica/consultadetalle/consultadetalle_gen_configuracion.php', $headersx, $bodyx);


$getResponseVal = $responsex->raw_body;
$getDecodeData = json_decode($getResponseVal);
print_r($getDecodeData);
//$getSpecificValue = $getSpecificValue['nome'];

echo "<br>response.....";
print_r($responsex);
echo "<br>";
*/
/*
    // abrimos la sesión cURL
$ch = curl_init();
 
// definimos la URL a la que hacemos la petición
curl_setopt($ch, CURLOPT_URL,"http://localhost/appjuridica/consultadetalle/consultadetalle_gen_configuracion.php");
// indicamos el tipo de petición: POST
curl_setopt($ch, CURLOPT_POST, TRUE);
// definimos cada uno de los parámetros
curl_setopt($ch, CURLOPT_POSTFIELDS, "idEstado=1");
 
// recibimos la respuesta y la guardamos en una variable
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$remote_server_output = curl_exec ($ch);
 
// cerramos la sesión cURL
curl_close ($ch);

print_r($remote_server_output);
*/
  //  $titulo = $obj->gen_configuracion->CON_TituloApp ;    
  //  $logo = $obj->gen_configuracion->CON_Logo ;    
?>