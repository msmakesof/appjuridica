<?php
if($_POST)
{  
   //recibo los datos y los decodifico con PHP
   $misDatosJSON = json_decode($_POST["datos"]);
   
   //con esto podría mostrar todos los datos del JSON recibido
   //print_r($misDatosJSON);
   echo json_encode($misDatosJSON);
   
   
}   
?>