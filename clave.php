<?php
echo hash('sha512','Hola este es el texto a cifrar con has 512');
$time = time();
$fechacrea = date("Y-m-d H:i:s", $time);
echo "<br>";
echo $fechacrea;
echo "<br>";
?>