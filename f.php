<?php
$fec = strtotime(str_replace('/', '-', "21/08/2019 02:21:56"));
echo $fec."<br>";
echo date("Y-m-d H:i:s", $fec);
?>