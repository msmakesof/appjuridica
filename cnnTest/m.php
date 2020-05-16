<?php
//$url = "https://litigantes.github.io/array.php";
$url = "http://localhost/appjuridica/cnnTest/array2.php";
//$url = "http://localhost/appjuridica/cnnTest/i.php";

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

	//var_dump($resultado);
	//echo "<br>";
	//echo "cUrl.....$resultado<br>";
    $mnoticiasjudiciales = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $mnoticiasjudiciales = json_decode($mnoticiasjudiciales, true);

   //print_r($mnoticiasjudiciales);
	//echo "<br>";

    //echo("<script>console.log('PHP: ".print_r($mnoticiasjudiciales)."');</script>");
    //echo("<script>console.log('PHP: ".count($m['gen_noticiasjudiciales'])."');</script>");
    
    $json_errors = array(
        JSON_ERROR_NONE => 'No se ha producido ningún error',
        JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
        JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
        JSON_ERROR_SYNTAX => 'Error de Sintaxis',
    );
    //echo "Error : ", $json_errors[json_last_error()], PHP_EOL, PHP_EOL."<br>";        

$NombreTabla = '';
$Texto = '';
$Link = '';

if( $mnoticiasjudiciales['estado'] < 2)
{
	//echo $mnoticiasjudiciales['estado'].'<br>';	
	//$y= count($mnoticiasjudiciales['gen_noticiasjudiciales']);
	//echo "Total......$y";
	//print_r($mnoticiasjudiciales);
    $nombre_Tabla="";
	
//echo $gen_noticiasjudiciales['estado'];
//echo $gen_noticiasjudiciales['gen_noticiasjudiciales']['NOJ_Titular'];

	
	$NombreTabla = trim($mnoticiasjudiciales['gen_noticiasjudiciales']['NOJ_Titular']);
	$Texto = trim($mnoticiasjudiciales['gen_noticiasjudiciales']['NOJ_Texto']);
	$Link = trim($mnoticiasjudiciales['gen_noticiasjudiciales']['NOJ_Link']);
	
	/*
    for($i=0; $i<count($mnoticiasjudiciales['gen_noticiasjudiciales']); $i++)
    {
        $NombreTabla = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Titular']);
		$Texto = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Texto']);
		$Link = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Link']);
        //$archivo = $NombreTabla.".php";
        $idTabla = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_IdNoticia'];
		$FechaCreacion = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_FechaCreacion'];
        $estadoTabla = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['EstadoTabla']);
	}
	*/
	//echo "Resultado........".$NombreTabla.' - '.$Texto.' - '.$Link.'<br>';
}
echo "Resultado........".$NombreTabla.' - '.$Texto.' - '.$Link;
?>
