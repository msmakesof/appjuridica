<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title></title>
<!-- Bootstrap Core Css
<link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet"> -->

<link href="../../jTicker/jquery.simpleTicker/jquery.simpleTicker.css" rel="stylesheet">

<!-- Bootstrap Core Js 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.js"></script> -->

<script src="../../jTicker/jquery.simpleTicker/jquery.simpleTicker.js"></script>


<style>
		.card{ background-color: #fff; border: 1px solid transparent; border-radius: 6px; }
		.card > .card-link{ color: #333; }
		.card > .card-link:hover{  text-decoration: none; }
		.card > .card-link .card-img img{ border-radius: 6px 6px 0 0; }
		.card .card-img{ position: relative; padding: 0; display: table; }
		.card .card-img .card-caption{
		  position: absolute;
		  right: 0;
		  bottom: 10px;
		  left: 0;
		}
		.card .card-body{ display: table; width: 100%; padding: 12px; }
		.card .card-header{ border-radius: 6px 6px 0 0; padding: 8px; }
		.card .card-footer{ border-radius: 0 0 6px 6px; padding: 8px; }
		.card .card-left{ position: relative; float: left; padding: 0 0 8px 0; }
		.card .card-right{ position: relative; float: left; padding: 8px 0 0 0; }
		.card .card-body h1:first-child,
		.card .card-body h2:first-child,
		.card .card-body h3:first-child, 
		.card .card-body h4:first-child,
		.card .card-body .h1,
		.card .card-body .h2,
		.card .card-body .h3, 
		.card .card-body .h4{ margin-top: 0; }
		.card .card-body .heading{ display: block;  }
		.card .card-body .heading:last-child{ margin-bottom: 0; }

		.card .card-body .lead{ text-align: center; }

		@media( min-width: 768px ){
		  .card .card-left{ float: left; padding: 0 8px 0 0; }
		  .card .card-right{ float: left; padding: 0 0 0 8px; }
			
		  .card .card-4-8 .card-left{ width: 33.33333333%; }
		  .card .card-4-8 .card-right{ width: 66.66666667%; }

		  .card .card-5-7 .card-left{ width: 41.66666667%; }
		  .card .card-5-7 .card-right{ width: 58.33333333%; }
		  
		  .card .card-6-6 .card-left{ width: 50%; }
		  .card .card-6-6 .card-right{ width: 50%; }
		  
		  .card .card-7-5 .card-left{ width: 58.33333333%; }
		  .card .card-7-5 .card-right{ width: 41.66666667%; }
		  
		  .card .card-8-4 .card-left{ width: 66.66666667%; }
		  .card .card-8-4 .card-right{ width: 33.33333333%; }
		}

		/* -- default theme ------ */
		.card-default{ 
		  border-color: #ddd;
		  background-color: #fff;
		  margin-bottom: 14px !important;
		}
		.card-default > .card-header,
		.card-default > .card-footer{ color: #333; background-color: #219061 !important; }
		.card-default > .card-header{ border-bottom: 1px solid #ddd; padding: 8px; }
		.card-default > .card-footer{ border-top: 1px solid #ddd; padding: 8px; }
		.card-default > .card-body{  }
		.card-default > .card-img:first-child img{ border-radius: 6px 6px 0 0; }
		.card-default > .card-left{ padding-right: 4px; }
		.card-default > .card-right{ padding-left: 4px; }
		.card-default p:last-child{ margin-bottom: 0; }
		.card-default .card-caption { color: #fff; text-align: center; text-transform: uppercase; }


		/* -- price theme ------ */
		.card-price{ border-color: #999; background-color: #ededed; margin-bottom: 24px; }
		.card-price > .card-heading,
		.card-price > .card-footer{ color: #333; background-color: #fdfdfd; }
		.card-price > .card-heading{ border-bottom: 1px solid #ddd; padding: 8px; }
		.card-price > .card-footer{ border-top: 1px solid #ddd; padding: 8px; }
		.card-price > .card-img:first-child img{ border-radius: 6px 6px 0 0; }
		.card-price > .card-left{ padding-right: 4px; }
		.card-price > .card-right{ padding-left: 4px; }
		.card-price .card-caption { color: #fff; text-align: center; text-transform: uppercase; }
		.card-price p:last-child{ margin-bottom: 0; }

		.card-price .price{ 
		  text-align: center; 
		  color: #337ab7; 
		  font-size: 3em; 
		  text-transform: uppercase;
		  line-height: 0.7em; 
		  margin: 24px 0 16px;
		}
		.card-price .price small{ font-size: 0.4em; color: #66a5da; }
		.card-price .details{ list-style: none; margin-bottom: 24px; padding: 0 18px; }
		.card-price .details li{ text-align: center; margin-bottom: 8px; }
		.card-price .buy-now{ text-transform: uppercase; }
		.card-price table .price{ font-size: 1.2em; font-weight: 700; text-align: left; }
		.card-price table .note{ color: #666; font-size: 0.8em; }
</style>
<script>
$(function(){
	$.simpleTicker($("#ticker-roll"),{'effectType':'roll'});
	//$.simpleTicker($("#ticker-fade"),{'effectType':'fade'});
	
	/*
	var refreshId =  setInterval( function(){
		$('#news').load('../../jTicker/demo/index.php'); //actualizas el div  
	}, 5000 );
	*/	
});


/*
$(function() {
	setInterval(function() {
		$('#news').load('../../jTicker/demo/index.php'); //actualizas el div  
	}, 7000);
});
*/
</script>
</head>
<body>
<div id="news">
<div id="ticker-roll" class="ticker">
	
	<ul>
		<?php
			$idTabla = 0;
			require_once('../../apis/general/noticiasjudiciales.php');
			for($i=0; $i<count($mnoticiasjudiciales['gen_noticiasjudiciales']); $i++)
			{
				$NJ_IdNoticia = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_IdNoticia'];
				$NJ_Titular = strtoupper(trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Titular']));
				$NJ_Texto = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Texto']);
				$NJ_Lnk = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Link']);
		?>
		
			<li>			
				<div class="card border-primary mb-3" style="max-width: 100%; clear: both; overflow: hidden; height: 1% !impotant;">
					<div class="card-header" style="background-color: #2E909F !important;"><?php echo $NJ_Titular; ?></div>
					<div class="card-body text-primary" style="height: auto !impotant;">
						<!-- <h5 class="card-title"><?php echo $NJ_Titular; ?></h5> -->
						<p class="card-text"><?php echo $NJ_Texto; ?></p>						
					<!-- 
					</div>
					<div class="card-footer" style="background-color: #2E909F !important;">
					-->
						<div style="font-size:11px; color: red !mportant; text-align: right;">							
							<a href="<?php echo $NJ_Lnk; ?>" class="card-link">
								Leer m&aacute;s...
								<i class="material-icons" style="color:red !important;">message</i>
							</a>
						</div>
					</div>
				</div>
			
			</li>		
		<?php
			}		
		?>
	</ul>	
</div><!--/#ticker -->
</div>
</body>
</html>