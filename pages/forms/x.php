<?php
//$obj = json_decode($json);
//print $obj->{'foo-bar'}; // 12345

$dias ='{"3":"2"}';
echo "gtypo......".gettype($dias);
echo "<br>";

$obj = json_decode($dias);
$dias = $obj->{'3'};
echo "dias....".$dias;

/*
$d = json_encode($dias);
//$d = json_encode($dias, true);
	echo "d = $d<br>";
	foreach ($d as $value) {
	   $dias = $value['1'];
	   print ($dias);
	}
*/
?>