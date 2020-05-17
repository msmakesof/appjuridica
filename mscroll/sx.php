﻿<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SX News</title>
    <!-- Bootstrap core CSS ../../mscroll/-->
    <!--   <link href="assets/css/bootstrap.css" rel="stylesheet">  --> 
	<!-- Custom styles for this template
	<link href="assets/css/main.css" rel="stylesheet">  -->
    
    <!--   ../../mscroll/  
    <link href="../../mscroll/assets/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- <link href="../../mscroll/assets/css/prism.css" rel="stylesheet" /> -->
    <link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	


  </head>
  <body>	
	
	<div class="green">
		<div class="container">
			<div class="row">
				<div class="col-md-4 centered">
					<div id="nt-example1-container">
						
		                <!-- 						
						<ul id="nt-example1"></ul> -->
							<div id='mks'></div>							
							
					
		            </div>
				</div>

			</div>
		</div>
	</div>
	 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- <script src="../../mscroll/assets/js/chart.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="../../mscroll/assets/js/prism.js"></script> --> 
	
    <script src="assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="assets/js/jquery.newsTicker.js"></script>
    <script>
	/*
		$('a[href*=#]').click(function() {
			var href = $.attr(this, 'href');
			if (href != "#") {
				$('html, body').animate({
					scrollTop: $(href).offset().top - 81
				}, 500, function () {
					window.location.hash = href;
				});
			}
			else {
				$('html, body').animate({
					scrollTop: 0
				}, 500, function () {
					window.location.hash = href;
				});
			}
			return false;
		});
	*/
		//$(window).load(function(){			
		$(document).ready(function () {		
			$('code.language-javascript').mCustomScrollbar();
			///noticias();
			
			setInterval(function() {		
			noticias();
			//$("#nt-example1").html();
		}, 7000);
			
			function noticias() {
				$.post( "i.php", function( data ) {
					console.log(data);
					$( "#mks" ).html( data );
				});
			}
			
			function xnoticias() {
				//alert(7);
				$.ajax({
					url : "listaNoticias.php",		//../../mscroll/
					type: "POST",
					dataType : 'json',
					/*
					beforeSend: function() {
						$("#MisNews").html('<img src="../../images/ajax-loader.gif">Cargando Noticias');
					},
					*/
					success: function(datas, textStatus, jqXHR)
					{
						//alert(9);
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
							$("#mks").html(bahra);
							
							/*
							$.post('../../ajax.php', {msj: bahra, socket_id : pusher.connection.socket_id }, function(respuesta){					
								$("#mks").html(bahra);                                      
							}, 'json'); 
							*/
						}			
						
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						$("#msj").html("Error: "+textStatus+' / '+errorThrown);
					}
				});	
			}
			
		});
		
		
		var nt_title = $('#nt-title').newsTicker({
			row_height: 40,
			max_rows: 1,
			duration: 3000,
			pauseOnHover: 0
		});
		
		var nt_example1 = $('#nt-example1').newsTicker({
			row_height: 80,
			max_rows: 3,
			duration: 4000                
		});
	  
		var state = 'stopped';
		var speed;
		var add;			
		
	</script>
 </body>
</html>