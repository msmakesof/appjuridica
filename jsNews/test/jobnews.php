<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">	
	<style>
		/* === card component ====== 
		 * Variation of the panel component
		 * version 2018.10.30
		 * https://codepen.io/jstneg/pen/EVKYZj
		 */
		.card{ background-color: #fff; border: 1px solid transparent; border-radius: 6px; }
		.card > .card-link{ color: #333; }
		.card > .card-link:hover{  text-decoration: none; }
		.card > .card-link .card-img img{ border-radius: 6px 6px 0 0; }
		.card .card-img{ position: relative; padding: 0; display: table; }
		.card .card-img .card-caption{
		  position: absolute;
		  right: 0;
		  bottom: 16px;
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
		  margin-bottom: 24px;
		}
		.card-default > .card-header,
		.card-default > .card-footer{ color: #333; background-color: #ddd; }
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
		
.Bloque{
	display: block; position: absolute;  top: 150; left: 0; font: 12 Arial; width:222; border: 1 solid black
}

.Cabecera
{
	color: #ffffff; background: #336600;
}

.Contenido
{
	width:220; font: 12 Courier New; background: #F3F3F3; padding: 2 2 2 2;
}

.Nuevo_bloque
{
	border: 1px solid black ; width: 232; height: 150;background: black; color: white; font: 14 Arial; text-align: center
}

.Nuevo_contenido
{
	height: 125; background: white
}

.Contenido_principal
{
	border: none; position: absolute; left: 0; top: 0; width: 100; height: 100; clip: rect(0,222,125,0 ); background: transparent
}
	</style>
<script>  
function Iniciar(){
	Noticias_principal.style.left = Contenido.offsetLeft + Lector_noticias.offsetLeft +4
	Noticias_principal.style.top = Contenido.offsetTop + Lector_noticias.offsetTop
	Noticias_principal.style.width = Contenido.offsetWidth -1
	Noticias_principal.style.height = Contenido.offsetHeight - 1
	S_noticias()
}
var Bloque
var T_inicio = 150
var mi_inicio = 0
var mi_fin = 0
var Top = T_inicio
var start = 1
function S_noticias()
{
	if (Top == 4)
	{
		mi_fin = mi_inicio
		mi_inicio >= (noticia.length-1) ? mi_inicio = 0 : mi_inicio++
		Top = T_inicio
		setTimeout("S_noticias()",2000)
		start=0
		return false
    }
	if (Top == (T_inicio-1)) 
	{
		noticia[mi_fin].style.top = T_inicio
	}
	Top--
	noticia[mi_inicio].style.top = Top
	if (start==0)
	{
		noticia[mi_fin].style.top = Top-146
	}
	setTimeout("S_noticias()",5)
}
</script>
</head>
	<body onload="Iniciar()">
		<div class="container-fluid">
		
		<TABLE ID="Lector_noticias" CLASS="Nuevo_bloque" CELLPADDING=0 CELLSPACING=0 ALIGN="center">
			<TR>
				<TD bgcolor="#990000"><B> Noticias </B></TD>
			</TR>
			<TR>
				<TD ID="Contenido" CLASS="Nuevo_contenido"> </TD>
			</TR>
		</TABLE>
		
		<DIV ID="Noticias_principal" CLASS="Contenido_principal">
		
			<TABLE CLASS="Bloque" ID="noticia" CELLSPACING=0 CELLPADDING=1 BORDER=0>
				<TR CLASS="Cabecera">
					<TD>Tutores.org</TD>
				</TR>
				<TR>
					<TD CLASS="Contenido">Se estan agregando nuevos codigos constantemente<BR>web de webmasters<BR>para webmasters</TD>
				</TR>
			</TABLE>

			<TABLE CLASS="Bloque" ID="noticia" CELLSPACING=0 CELLPADDING=1 BORDER=0>
				<TR CLASS="Cabecera">
					<TD>Foros de tutores.org</TD>
				</TR>
				<TR>
					<TD CLASS="Contenido">No olvides postear mensaje<BR>en nuestros foros</TD>
				</TR>
			</TABLE>
			
			<TABLE CLASS="Bloque" ID="noticia" CELLSPACING=0 CELLPADDING=1 BORDER=0>
				<TR CLASS="Cabecera">
					<TD>Servicios online</TD>
				</TR>
				<TR>
					<TD CLASS="Contenido">Si necesitas interaccion en tu web<BR><A HREF="http://www.tutores.org" TARGET="_blank">Tutores.org</A><BR>Saludos</TD>
				</TR>
			</TABLE>
		</DIV>
			
			
	</body>
</html>