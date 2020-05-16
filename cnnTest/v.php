<?php
/*
$x[] = Array( 
		[
			{"estado":"1","gen_noticiasjudiciales":{"NOJ_IdNoticia":"5","NOJ_Titular":				"Asuntos_Legales","NOJ_Texto":"Edictos","NOJ_Link":"https:\/\/www_asuntoslegales_com_co\/edictos","NOJ_Estado":"1"}
			}
		] 
		);

echo $x[0];
*/
echo "**********************<br>";

$y = Array{"estado":"1", Array{"gen_noticiasjudiciales":{"NOJ_IdNoticia":"5","NOJ_Titular":				"Asuntos_Legales","NOJ_Texto":"Edictos","NOJ_Link":"https:\/\/www_asuntoslegales_com_co\/edictos","NOJ_Estado":"1"}
			}
		};

echo json_encode($y, JSON_PRETTY_PRINT);
			

//echo json_encode($x, JSON_PRETTY_PRINT);


/* Original
Array ( [{"estado":"1","gen_noticiasjudiciales":{"NOJ_IdNoticia":"5","NOJ_Titular":"Asuntos_Legales","NOJ_Texto":"Edictos","NOJ_Link":"https:\/\/www_asuntoslegales_com_co\/edictos","NOJ_Estado":"1"}}] => );
*/

?>