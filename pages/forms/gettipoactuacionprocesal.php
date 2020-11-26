<?php
$idTabla = $_GET['id'];
include('../../apis/proceso/terminos.php');
$diashabiles = "";
$array = [];
for($i=0; $i<count($mterminos['pro_terminos']); $i++)
{
	$diashabiles = $mterminos['pro_terminos'][$i]['TER_DiasHabiles'];
	$repite = $mterminos['pro_terminos'][$i]['TER_Repite'];
	$diasrepite = $mterminos['pro_terminos'][$i]['TER_DiasRep'];
}
$array = array(1 => "$diashabiles", 2 => "$repite", 3 => "$diasrepite");
echo json_encode($array, true);
?>