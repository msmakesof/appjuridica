<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title></title>
<!-- Bootstrap Core Css
<link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet"> -->

<link href="../jquery.simpleTicker/jquery.simpleTicker.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<!-- Bootstrap Core Js 

<script src="../../plugins/bootstrap/js/bootstrap.js"></script> -->

<script src="../jquery.simpleTicker/jquery.simpleTicker.js"></script>


<style>

div.ticker{
  margin:10px auto;
}
div.ticker ul{
  margin:auto;
}

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

</head>
<script>
$(function(){
	pusher = new Pusher('fbaa2643e73295afc8e4');
	canal = pusher.subscribe('canal_prueba');
	
	$.simpleTicker($("#ticker-roll"),{'effectType':'roll'});
	//$.simpleTicker($("#ticker-fade"),{'effectType':'fade'});
	
	setInterval(function() {
		noticias();
	}, 7000);	
});

function noticias() {
	$.ajax({
		url : "listaNoticias.php",		
		type: "GET",
		dataType : 'json',
		/*
		beforeSend: function() {
			$("#MisNews").html('<img src="../../images/ajax-loader.gif">Cargando Noticias');
		},
		*/
		success: function(datas, textStatus, jqXHR)
		{
			arraydata = datas; 
			console.log("arraydata..."+arraydata);
			var bahra =  '';
			
			if(arraydata == "")
			{
				$("#MisNews").html('');
				$("#msj").html("<span style='clear:both;width:100%;background-color:#FF0000; color:#FFF; font-size:10.5px; font-family:verdana; text-align:center; padding:5px'> **** No hay Noticias Creadas. * <span>");
			}
			else
			{
				totalNews = arraydata['gen_noticiasjudiciales'].length;
				var divnews = "";				
				$.each( arraydata['gen_noticiasjudiciales'], function( i, val ) {
					var divnews0 = '';
					var divnews1 = '';
					var divnews2 = '';
					var divnews3 = '';
					var divnews4 = '';
					var divnews5 = '';
					var divnews6 = '';
					var divnews7 = '';
					var divnews8 = '';
					var divnews9 = '';
					var divnews10 = '';
					var divnews11 = '';
					var divnews12 = '';
					
					var estado = arraydata['gen_noticiasjudiciales'][i].NOJ_Estado;
					var idnoticia = arraydata['gen_noticiasjudiciales'][i].NOJ_IdNoticia;
					var link = arraydata['gen_noticiasjudiciales'][i].NOJ_Link;
					var texto = arraydata['gen_noticiasjudiciales'][i].NOJ_Texto;
					var titular = arraydata['gen_noticiasjudiciales'][i].NOJ_Titular;
					
					divnews0 = '<li>';
					divnews1 = '<div class="card border-primary mb-3" style="max-width: 100%; clear: both; overflow: hidden; height: 1% !impotant;">';
					divnews2 = '   <div class="card-header" style="background-color: #2E909F !important;">' + titular + '</div>';
					divnews3 = '   <div class="card-body text-primary" style="height: auto !impotant;">';
					divnews4 = '      <p class="card-text">' + texto + '</p>';
					divnews5 = '      <div style="font-size:11px; color: red !mportant; text-align: right;">';
					divnews6 = '          <a href="' + link + '" class="card-link">';
					divnews7 = '             Leer m&aacute;s...';
					divnews8 = '             <i class="material-icons" style="color:red !important;">message</i>';
					divnews9 = '          </a>';
					divnews10= '      </div>';
					divnews11= '   </div>';
					divnews12= '</div></li>';
					bahra += divnews1+divnews2+divnews3+divnews4+divnews5+divnews6+divnews7+divnews8+divnews9+divnews10+divnews11+divnews12;
				});	
				///$("#MisNews").html(bahra);
				
				$.post('../../ajax.php', {msj: bahra, socket_id : pusher.connection.socket_id }, function(respuesta){					
					$("#MisNews").html(bahra);                                      
				}, 'json'); 
			}			
			
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			$("#msj").html("Error: "+textStatus+' / '+errorThrown);
		}
	});	
}
</script>
<body>
	 <!--/#ticker --> <!-- <h5 class="card-title"><?php //echo $NJ_Titular; ?></h5> --><!-- </div>	<div class="card-footer" style="background-color: #2E909F !important;">	-->
	<div id="ticker-roll" class="ticker">		
			
		<ul>			
			<div id="MisNews"></div>			
		</ul>
			
	</div>
	<div id="msj"></div>	
</body>
</html>