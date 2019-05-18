<?php
/*
    Tomar una fotografía y guardarla en un archivo
    @date @date 2018-10-22
    @author parzibyte
    @web parzibyte.me/blog
*/

//  original
$imagenCodificada = file_get_contents("php://input"); //Obtener la imagen


if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));

//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
//todo el contenido lo guardamos en un archivo
$imagenDecodificada = base64_decode($imagenCodificadaLimpia);

/* nuevo*/
/*
// Mejor esto:
$datos = json_decode(file_get_contents("php://input"));
$imagenDeCodificada = $datos->foto;
if($imagenDeCodificada == "")exit("No se recibió ninguna imagen");
# Lo siguiente es el nroproceso que enviaron desde el select
$nroproceso = $datos->proceso;
//echo "img...$imagenDeCodificada  - proceso: $nroproceso";
*/
/* fin nuevo */ 


//Calcular un nombre único
$nombreImagenGuardada = "foto_" . uniqid()  . ".jpg";   //. "-$nroproceso"

$tmp_name = $_FILES['imagen']["tmp_name"];
$nuevo_path="imgsfotos/";//.$nombreImagenGuardada;
move_uploaded_file($tmp_name,$nuevo_path);

//Escribir el archivo
file_put_contents($nombreImagenGuardada, $imagenDecodificada);

//Terminar y regresar el nombre de la foto
exit($nombreImagenGuardada);
?>