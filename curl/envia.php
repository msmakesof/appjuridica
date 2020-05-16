<?php
//Inicio el recurso
$curl = curl_init("https://boshika.co/litigantes/recibe.php"); 
 
//seto las opciones más básicas
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_POST, true); 
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
 
//Le meto los valores que recibo del formulario.....
curl_setopt($curl, CURLOPT_POSTFIELDS, array("hosting"=>'boshika.co')); 
 
//Ejecuto el recurso
$data = curl_exec($curl); 
 
//Lo cierro
curl_close($curl)
?>