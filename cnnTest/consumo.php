<?php
/*
$array = {
    "estado": "1",
    "gen_noticiasjudiciales": [
        {
            "NOJ_IdNoticia": "5",
            "NOJ_Titular": "Asuntos Legales",
            "NOJ_Texto": "Edictos",
            "NOJ_Link": "https://www.asuntoslegales.com.co/edictos",
            "NOJ_Estado": "1"
        },
	]
}
*/
//include('array.php');
$soportecURL = "S";
//$url         = urlServicios."consultadetalle/consultadetalle_gen_noticiasjudiciales.php?IdMostrar=0";
//$url = "https://litigantes.github.io/array.php"
$url = "https://litigantes.github.io/i.php";

//echo "<script>console.log($url)</script>" ;
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 0);
    $resultado = curl_exec ($ch);
    curl_close($ch);

    $mnoticiasjudiciales = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $mnoticiasjudiciales = json_decode($mnoticiasjudiciales, true);
    //echo("<script>console.log('PHP: ".print_r($mnoticiasjudiciales)."');</script>");
    //echo("<script>console.log('PHP: ".count($m['gen_noticiasjudiciales'])."');</script>");
    
    $json_errors = array(
        JSON_ERROR_NONE => 'No se ha producido ningún error',
        JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
        JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
        JSON_ERROR_SYNTAX => 'Error de Sintaxis',
    );
    //echo "Error : ", $json_errors[json_last_error()], PHP_EOL, PHP_EOL."<br>";        
}
else
{
    $soportecURL = "N";
    echo "No hay soporte para cURL";
} 

if($soportecURL == "N")
{
    require_once('./unirest/vendor/autoload.php');
    $response = Unirest\Request::get($url, array("X-Mashape-Key" => "MY SECRET KEY"));
    $resultado = $response->raw_body;
    $resultado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);
    $mnoticiasjudiciales = json_decode($resultado, true);	        
} 

if( $mnoticiasjudiciales['estado'] < 2)
{
    $nombre_Tabla="";
    for($i=0; $i<count($mnoticiasjudiciales['gen_noticiasjudiciales']); $i++)
    {
        $NombreTabla = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Titular']);
		$Texto = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Texto']);
		$Link = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Link']);
        $archivo = $NombreTabla.".php";
        $idTabla = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_IdNoticia'];
		$FechaCreacion = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_FechaCreacion'];
        $estadoTabla = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['EstadoTabla']);
	}
	echo "Resultado........".$NombreTabla.' - '.$Texto.' - '.$Link;
}
?>