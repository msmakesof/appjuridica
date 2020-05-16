<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
		<title></title>
	</head>
	<body>
		<!-- Bootstrap Core Css -->
		<link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	
		<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../../jsNews/dist/jquery.easy-ticker.min.js"></script>
		
		<!-- Bootstrap Core Js -->
		<script src="../../plugins/bootstrap/js/bootstrap.js"></script>

		<script type="text/javascript">
		$(document).ready(function(){

			var myET = $('.myTicker').easyTicker({
				direction: 'up',
				easing: 'swing',
				speed: 'slow',
				interval: 3000,
				height: 'auto',
				visible: 1,
				mousePause: true,
				controls: {
					up: '.up',
					down: '.down',
					toggle: '.toggle',
					stopText: 'Stop !!!'
				},
				callbacks: {
					before: function(ul, li){
						console.log(this, ul, li);
						$(li).css('color', 'red');
					},
					after: function(ul, li){
						console.log(this, ul, li);
					}
				}
			}).data('easyTicker');

			cc = 1;
			$('.add').click(function(){
				$('.myTicker ul').append('<li>' + cc + ' Triangles can be made easily using CSS also without any images. This trick requires only div tags and some</li>');
				cc++;
			});

			$('.visible-3').click(function(){
				myET.options['visible'] = 3;

			});

			$('.visible-all').click(function(){
				myET.stop();
				myET.options['visible'] = 0 ;
				myET.start();
			});

		});
		</script>
		<div class="myTicker">
			<ul>
				<?php
					$idTabla = 0;
					require_once('../../apis/general/noticiasjudiciales.php');
					for($i=0; $i<count($mnoticiasjudiciales['gen_noticiasjudiciales']); $i++)
					{
						$NJ_IdNoticia = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_IdNoticia'];
						$NJ_Titular = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Titular'];
						$NJ_Texto = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Texto'];
						$NJ_Lnk = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Link'];
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
		</div>
		<style>
		.myTicker{
			border: 1px solid red;
			width: 400px;
		}
		.myTicker ul{
			padding: 0;
		}
		.myTicker li{
			list-style: none;
			border-bottom: 1px solid green;
			padding: 10px;
		}
		.et-run{
			background: red;
		}
		.et-item-visible{
			color: blue !important;
		}
		</style>

	</body>
</html>