<?php	
	$idTabla = 0;
	require_once("../apis/general/noticiasjudicialesnews.php");
	//$reg = $_GET['id'];	
	$x=''; 
	for($i=0; $i<count($mnoticiasjudiciales['gen_noticiasjudiciales']); $i++)
	{
		//if( $i >= $reg ){		
		$NJ_IdNoticia = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_IdNoticia'];
		$NJ_Titular = strtoupper(trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Titular']));
		$NJ_Texto = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Texto']);
		$NJ_Lnk = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Link']);
		$x .= '<li class="news-item"><div style="font-weight:bold;">'. $NJ_Titular.'</div>
			<div style="font-size:11.5px;">'. $NJ_Texto .'</div>		
			<div style="font-size:11px; text-align:right !important;">
				<a href="#">Leer M&aacute;s...
					<i class="material-icons" style="color:red !important; font-size:15px !important">
						message
					</i>
				</a>
			</div>
		</li>';
		//}
	}
	echo $x ; 
?>