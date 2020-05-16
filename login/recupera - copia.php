<?php
include_once("../pages/tables/header.inc.php");
require_once ('../Connections/DataConex.php');
$Company = Company;	
?>
<html>
	<head>
		<title><?php echo Company; ?> | Recuperar Contrase&nacute;a</title>	
	
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		
		 <!-- Waves Effect Css -->
		<link href="../plugins/node-waves/waves.css" rel="stylesheet" />

		<!-- Animation Css -->
		<link href="../plugins/animate-css/animate.css" rel="stylesheet" />
		
		<!-- Custom Css
		<link href="../css/style.css" rel="stylesheet"> -->
		
		<!-- Jquery Core Js-->	
		<script src="../plugins/jquery/jquery.min.js"></script>
		<script src="../plugins/jquery-validation/jquery.validate.js"></script>		
		
		
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		
		<!-- Bootstrap Core Js
		<script src="js/bootstrap.min.js"></script> -->
		
		<style>
		.checkboxcontainer input {
  display: none;
}

.checkboxcontainer {
  display: inline-block;
  padding-left: 30px;
  position: relative;
  cursor: pointer;
  user-select: none;
}

.checkboxcontainer .checkmark {
  display: inline-block;
  width: 20px;
  height: 20px;
  background: white;
  position: absolute;
  left: 0;
  top: 0;
  border: 1px solid black;
}

.checkboxcontainer input:checked + .checkmark {
  background-color: #1390e5;
  border: 1px solid #1390e5;
}

.checkboxcontainer input:indeterminate + .checkmark {
  background-color: #1390e5;
  border: 1px solid #1390e5;
}

.checkboxcontainer input:checked + .checkmark:after {
  content: "";
  position: absolute;
  height: 6px;
  width: 11px;
  border-left: 2px solid white;
  border-bottom: 2px solid white;
  top: 45%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(-45deg);
}

.checkboxcontainer input:checked:disabled + .checkmark {
    border: 1px solid grey;
    background-color: grey;
}

.checkboxcontainer input:disabled + .checkmark {
    border: 1px solid grey;
}

.checkboxcontainer input:indeterminate + .checkmark:after {
  content: "";
  position: absolute;
  height: 0px;
  width: 11px;
  border-left: 2px solid white;
  border-bottom: 2px solid white;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(180deg);
}

		</style>
		
	</head>
	
	<body>
		
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >				
					
					<div style="padding-top:30px" class="panel-body" >
						<div class="col-sm-6 controls">
							<img src="../images/3.jpg" width="100" height="70">
						</div>
						<div class="col-sm-6 controls">
							<h3><label style="font-size:20px ; font-family: Verdana">LITIGANTES.</label></h3>
						</div>
					</div>
					
					<div id="recpas">
						
						<div class="panel panel-info">
							<div class="panel-heading panel-info">
								<div class="panel-title">Recuperar Contrase&ntilde;a</div>
								<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="../">Volver a Iniciar Sesi&oacute;n</a></div>
							</div>
						</div>	
						
						<div style="padding-top:30px" class="panel-body" >
							
							<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
							
							<form id="loginform" class="form-horizontal" role="form" action="" method="POST" autocomplete="off">
								
								<div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input id="email" type="email" class="form-control" name="email" placeholder="Digite su Correo Electrónico" required>                                        									
								</div>
								<div style="margin-top:1px; margin-left:10;" class="form-group" id="msj">
									<div class="col-sm-10 controls"></div>
								</div>
								
								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">									
										<label class="checkboxcontainer"> Ya tengo un C&oacute;digo activo.
											<input type="checkbox" id="codeok">
										<span class="checkmark"></span>
									</div>
									
								</div>
								
								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
										<button id="btn-login" type="button" class="btn btn-success">Enviar</button>									
									</div>
								</div>
								
								<!--
								<div class="form-group">
									<div class="col-md-12 control">
										<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
											No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
										</div>
									</div>
								</div>    
								-->
							</form>
						</div>
					</div>	
					<div id="carga"></div>
					<div id="cargaexterna" style="margin: auto; width: 100%; border: 1px solid #AED6F1; padding: 10px; " class="col-sm-12 col-md-12"></div>
					
				</div>  
			</div>
		</div>		
		
		<script type="text/javascript">
		$(document).ready(function() {
			
			$("#cargaexterna").hide();
			$("#msj").hide();
			
			$("#btn-login").on('click', function() {
				var email = $("#email").val();				
				
				if(email != "" )
				{					
					var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

					if (regex.test($('#email').val().trim())) 
					{						
						$("#recpas").hide();	
						$("#cargaexterna").show();
						
						var codeok = 0;
						if($("#codeok").prop('checked')) {
							codeok = 1;
						}
						
						$.ajax({
							data: {"mail": email, "codeok": codeok },
							type: 'POST',
							dataType: "html",
							url: "../pages/tables/resetclave.inc.php",
							beforeSend: function() {
								$("#carga").html('<img src="../images/tenor.gif">');
							},
							success: function(htmlexterno) {
								$("#cargaexterna").html(htmlexterno);
							},
							error: function(xhr) { // if error occured
								alert("Error ha ocurrido.");
							},
							complete: function() {					
								$("#carga").html('');
							},
						});		

					} 
					else 
					{						
						$("#msj").html('');
						$("#msj").html('<div class = "alert alert-danger">!!! No es un Correo Electrónico válido.</div>');
						setTimeout(function() {
							$("#msj").html('');
							$("#email").val('');
						}, 2500);
					}					
				}
				else
				{
					$("#msj").show();
					$("#msj").html('');
					$("#msj").html('<div class = "alert alert-danger">!!! Debe digitar su Correo Electrónico.</div>');
					setTimeout(function() {
						$("#msj").html('');						
					}, 2500);
				}					
			});
			
		});
		</script>
	</body>
</html>							