<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<link href="../../mmscroll/css/site.css" rel="stylesheet" type="text/css" /> 
<script src="../../mmscroll/scripts/jquery.bootstrap.newsbox.min.js" type="text/javascript"></script>
</head>
<body>

<!-- <div class="container"> -->
<div class="mcontenedor">
	<div class="row">

		<div class="col-md-12">
			<div class="panel panel-default">
				<!-- <div class="panel-heading"> <span class="glyphicon glyphicon-list-alt"></span><b>News</b></div> -->
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
						
							<ul class="demo2" style="color:#000000" id="mks">							
							<?php
							
								$idTabla = 0;
								require_once("../apis/general/noticiasjudicialesnews.php");								
								
								$regs = count($mnoticiasjudiciales['gen_noticiasjudiciales']);
								for($i=0; $i<count($mnoticiasjudiciales['gen_noticiasjudiciales']); $i++)
								{
									$NJ_IdNoticia = $mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_IdNoticia'];
									$NJ_Titular = strtoupper(trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Titular']));
									$NJ_Texto = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Texto']);
									$NJ_Lnk = trim($mnoticiasjudiciales['gen_noticiasjudiciales'][$i]['NOJ_Link']);									
							
							?>		
								<li class="news-item"><div style="font-weight:bold;"><?php echo $NJ_Titular; ?></div>
								<div style="font-size:11.5px;"><?php echo $NJ_Texto; ?></div><div style="font-size:11px; text-align:right !important;"><a href="#">Leer M&aacute;s...<i class="material-icons" style="color:red !important; font-size:15px !important">message</i></a></div></li> 
							<?php
								}								
							?>
							</ul>						
							
						</div>
					</div>
				</div>
				<div class="panel-footer"> </div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">	
	var regs = "<?php echo $regs; ?>";
	var newsxpages = 3; //regs / 2;
	var tiempointerval = 18000;
	var newsinterval = 2500;
	if (regs > 6)
	{
		//tiempointerval = tiempointerval + 4000;
		//newsinterval = newsinterval + 500 ;
	}
    $(function () {		
		$(".demo2").bootstrapNews({
            newsPerPage: newsxpages ,
            autoplay: true,
			pauseOnHover: true,
			navigation: false,
            direction: 'up',
            newsTickerInterval: newsinterval,
			getNewsTickerDelay: function() {				
			},
			/*
			getNewsTickerDelay: function() {
				var minimumInterval = 5000;
				var maximumInterval = 7500;
				var additionalInterval = Math.floor(
					Math.random() * (maximumInterval - minimumInterval)
				);
				return minimumInterval + additionalInterval;
			},
			*/
            onToDo: function () {
                //console.log(' mks...'+this);
            }			
        });		
    });
	
	setInterval(() => {		
		$.get("../../mmscroll/i.php", function( data ) {			
			$( ".demo2" ).html( data );
		});
	}, tiempointerval);	
</script>
</body>
</html>