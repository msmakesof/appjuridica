<?php

//["25","4","3","19","20"]
 $Items = ["25","4","3","19","20"];
 
 $IdEmpresa = $Items[0]; 
 $IdTipojuzgado = $Items[1];
 echo $IdEmpresa;
 echo "<br>";
 echo $IdTipojuzgado;
 
 unset($Items[0],$Items[1]);
 
 //var_export($Items);
 $cantidadItems = count($Items);
 echo "<br>";
 echo "Cantid...$cantidadItems";
 echo "<br>";
 
 $opc = array_slice($Items, 0);
 print_r($opc);
 
for($i=0; $i<count($opc); $i++)
{
	echo $i;
	echo "<br>";
	$IdArea = $opc[$i];
	echo $IdArea."<br>";
}
 
 /*
 $item = explode(",", $Items);
		$IdEmpresa = $item[0];     // IdEmpresa
		$IdTipojuzgado = $item[1]; // IdTipojuzgado => Corporación / Jurisdicción
		unset($Items[0],$Items[1]);
		
		$cantidadItems = count($Items);
		
		for($i=0; $i<count($cantidadItems); $i++)
        {
			$IdArea = $cantidadItems[$i];
			//$comando = "INSERT INTO cli_areaxcliente ( ARC_IdEmpresa, ARC_IdTipoJuzgado, ARC_IdArea ) VALUES($IdEmpresa, $IdTipojuzgado, $IdArea) ;" ;
			echo $IdArea;
		}
*/

?>