
<?php
	$idTabla = 0;
	require_once("../apis/general/noticiasjudicialesnews.php");							
//echo $mnoticiasjudiciales;  id="nt-example1"
	
	$x='<div class="slider"><ul>';
	for($i=0; $i<count($mnoticiasjudiciales['gen_noticiasjudiciales']); $i++)
	{
		$NJ_IdNoticia = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_IdNoticia'];
		$NJ_Titular = strtoupper(trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Titular']));
		$NJ_Texto = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Texto']);
		$NJ_Lnk = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Link']);
		$x .= '<li><img>'. $NJ_Titular. '<br><a href="#">Leer Más...<i class="material-icons" style="color:red !important;">message</i></a></li>';
	}
	echo $x.='</ul></div>';
?>
<!--
	<li><?php //echo $NJ_Titular; ?>. <a href="#">Read more...</a></li>
	
	<li>Etiam imperdiet volutpat libero eu tristique. Aenean, rutrum felis in. <a href="#">Read more...</a></li>
	<li>Curabitur porttitor ante eget hendrerit adipiscing. Maecenas at magna. <a href="#">Read more...</a></li>
	<li>Praesent ornare nisl lorem, ut condimentum lectus gravida ut. <a href="#">Read more...</a></li>
	<li>Nunc ultrices tortor eu massa placerat posuere. Vivamus viverra sagittis. <a href="#">Read more...</a></li>
	<li>Morbi sodales tellus sit amet leo congue bibendum. Ut non mauris eu neque. <a href="#">Read more...</a></li>
	<li>In pharetra suscipit orci sed viverra. Praesent at sollicitudin tortor, id. <a href="#">Read more...</a> </li>
	<li>Maecenas nec ligula sed est suscipit aliquet sed eget ipsum, suspendisse. <a href="#">Read more...</a></li>
	<li>Onec bibendum consectetur diam, nec euismod urna venenatis eget.. <a href="#">Read more...</a> </li>	
	-->
	
