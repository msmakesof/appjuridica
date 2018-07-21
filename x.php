<?php

// $m= '{"estado":"1","gen_configuracion":{"CON_IdConfiguracion":"1","CON_TituloApp":"Dependiente Judicial.","CON_Logo":"images\\/logojur.jpg","CON_Estado":"1"}}';

// $mr = str_replace("images\\/","images/", $m);

// $m = json_decode($mr,true);
// print_r ($m);

date_default_timezone_set('America/Bogota');
echo "fecha: ".date('Y-m-d g:ia');

echo "*********************";
$x = rand(10000000,100000123456789);
echo "x....$x<br>";
?>
