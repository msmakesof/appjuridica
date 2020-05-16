<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title></title>
<!-- Bootstrap Core Css -->
<link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

<link href="../jquery.simpleTicker/jquery.simpleTicker.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


<!-- Bootstrap Core Js -->
<script src="../../plugins/bootstrap/js/bootstrap.js"></script>

<script src="../jquery.simpleTicker/jquery.simpleTicker.js"></script>

<script>
$(function(){
  $.simpleTicker($("#ticker-roll"),{'effectType':'roll'});
});
</script>
<style>
div.ticker{
  margin:1px auto;
}
div.ticker ul{
  margin:auto;
}
</style>
</head>
<body>
<div id="ticker-roll" class="ticker">
	<ul>
		<?php
			$idTabla = 0;
			require_once('../../apis/general/noticiasjudiciales.php');
			for($i=0; $i<count($mnoticiasjudiciales['gen_noticiasjudiciales']); $i++)
			{
				$NJ_IdNoticia = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_IdNoticia'];
				$NJ_Titular = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Titular']);
				$NJ_Texto = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Texto']);
				$NJ_Lnk = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Link']);
		?>
		
			<li>
			
				<div class="card border-primary mb-3" style="max-width: 18rem;">
					<div class="card-header"><?php echo 'Noticias Judiciales'; ?></div>
					<div class="card-body text-primary">
						<h5 class="card-title"><?php echo $NJ_Titular; ?></a></h5>
						<p class="card-text"><?php echo $NJ_Texto ?></p>
						<div><a href="<?php echo $NJ_Lnk; ?>" class="card-link">Ver detalle...</a></div>
					</div>
				</div>
			
			</li>
			
		
		<?php
			}		
		?>
	</ul>
</div><!--/#ticker -->

</body>
</html>