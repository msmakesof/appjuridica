<?php
//$url = "http://servidor2.com/cotizador.php";
$url = "https://litigantes.github.io/array2.php";
$datosProducto =  "hosting=litigants.lawyer&db=litigantes_bd";

$crm = curl_init();
curl_setopt ($crm, CURLOPT_URL, $url);
curl_setopt($crm, CURLOPT_HEADER, 0);
curl_setopt ($crm, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($crm, CURLOPT_POST, 1);
curl_setopt ($crm, CURLOPT_POSTFIELDS, $datosProducto);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // si deseas recibir el resultado como un string la respuesta de la pagina consultada aqui por que esperas solo exito o false lo pongo pr si lo necesitas
$respuesta = curl_exec($crm);
if ($respuesta === FALSE) {
  echo "Error: ".curl_error($crm);
}

curl_close($crm); var_dump($respuesta);
?>