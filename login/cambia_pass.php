<?php
	require_once ('../../Connections/DataConex.php');
	require_once('../../Connections/config2.php');  
	
	$user_email = $_POST['mail'];  
	$codigo = $code;
	
	if( $codigo == 0 )
	{
		$codigo = $_POST['codeok'];
	}
	//echo "code.....$code" ;
	//echo "cambia_pass--------> userid......$user_email / codigo .....$codigo";
	
	
	//Verifico que ese email exista
	$soportecURL = "S";
    $url   = urlServicios."consultadetalle/consultadetalle_Usuario.php?BuscaEmail=1&Email=$user_email";
	if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
    {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 0);
		$resultado = curl_exec ($ch);
		curl_close($ch);

		$m =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
		$m = json_decode($m, true);

		$json_errors = array(
			JSON_ERROR_NONE => 'No se ha producido ningún error',
			JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
			JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
			JSON_ERROR_SYNTAX => 'Error de Sintaxis',
		);
	}
	else
    {
        $soportecURL = "N";
        echo "No hay soporte para cURL";
    } 
    
    if($soportecURL == "N")
    {
        require_once('./unirest/vendor/autoload.php');
        $response = Unirest\Request::get($url, array("X-Mashape-Key" => "MY SECRET KEY"));
        $resultado = $response->raw_body;
        $resultado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);
        $m = json_decode($resultado, true);	        
    }  	
	
	$existe = $m['usu_usuario']['existe'];
	
	if( $existe == 1)
	{
?>
<!--
	<html>
		<head>
			<title>Cambiar Contrase&ntilde;a</title>			
			<link rel="stylesheet" href="css/bootstrap.min.css" >
			<link rel="stylesheet" href="css/bootstrap-theme.min.css" >			
			<script src="js/bootstrap.min.js" ></script>			
		</head>		
		<body>
		-->
		<script src="../plugins/jquery/jquery.min.js"></script>			
			<script src="../plugins/jquery-validation/jquery.validate.js"></script>
			<script src="../js/jsRelocate.js"></script>
			
			<div >		
				<div class="ccontainer" style="width:100% !important;">    
					<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12 col-md-offset-0 col-sm-10 col-sm-offset-2">                    
						<div class="panel panel-info" >
							<div class="panel-heading">
								<div class="panel-title">Cambiar Contrase&ntilde;a</div>
								<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Volver a Inicio</a></div>
							</div>     
							
							<div style="padding-top:30px" class="panel-body" >
								
								<form id="loginform" class="form-horizontal" role="form" action="guarda_pass.php" method="POST" autocomplete="off">
									
									<input type="hidden" id="user_id" name="user_id" value ="<?php echo $user_email; ?>" />
									
									<input type="hidden" id="token" name="token" value ="<?php //echo $token; ?>" />
									
									<div class="form-group">
										<label for="codigo" class="col-md-3 control-label" style="font-size:11px">C&oacute;digo</label>
										<div class="col-md-9">
											<input type="input" class="form-control" name="codigo" id="codigo" placeholder="Digite Código" required maxlength="12">
										</div>
									</div>
									
									<div class="form-group">
										<label for="password" class="col-md-3 control-label" style="font-size:11px">Nueva Contrase&ntilde;a</label>
										<div class="col-md-9">
											<input type="password" class="form-control" name="password" id="password" placeholder="Contrase&ntilde;a" required>
										</div>
									</div>
									
									<div class="form-group">
										<label for="con_password" class="col-md-3 control-label" style="font-size:11px">Confirmar Contrase&ntilde;a</label>
										<div class="col-md-9">
											<input type="password" class="form-control" name="con_password" id="con_password" placeholder="Confirmar Contrase&ntilde;a" required>
										</div>
									</div>
									
									<div style="margin-top:1px; margin-left:10;" class="form-group" id="msjx">
										<div class="col-sm-10 controls"></div>
									</div>									
									
									<div style="margin-top:10px" class="form-group">
										<div class="col-sm-12 controls">
											<div id="carga"></div>
											<button id="btn-loginx" type="button" class="btn btn-success">Modificar</button>
										</div>
									</div>   
								</form>
							</div>                     
						</div>  
					</div>
				</div>
			
			</div>
			
			<script type="text/javascript">
			var enviar = false;
			$(document).ready(function() {				
				
				$("#msjx").html('');
				$("#btn-loginx").prop("disabled", true);
				var clave = $("#password").val();
				var clave2 = $("#con_password").val();
				var codigo = $("#codigo").val();
				
				
				$("#btn-loginx").on('click', function(){				
					var pass1 = $("#password").val();
					var pass2 = $("#con_password").val();
					var token = $("#codigo").val();
					
					if( token != "" && pass1 != "" && pass2 != "" )
					{
						if ( pass1 === pass2 ) {
							if( enviar )
							{								
								var mail = "<?php echo $user_email; ?>";
								$.ajax({
									data: { "mail": mail, "clave1": pass1, "clave2": pass2, "codigo": token },
									type: 'POST',
									dataType: "html",
									url: "../pages/tables/verfica.inc.php",
									beforeSend: function() {
										$("#msjx").html('');
										$("#msjx").html('<img src="../images/ajax-loader.gif">Espere un momento...');
									},
									success: function(data) {										
										var respstr = data.trim();										
										if( respstr.substr(0,1) == "S" )
										{
											$("#btn-loginx").prop("disabled", false);
											$("#password").val('');
											$("#con_password").val('');
											$("#codigo").val('');
											$("#msjx").html('');
											$("#msjx").html('<div class = "alert alert-success">Cambio de Clave realizado correctamente.</div>');
											setTimeout(function() {
												$("#msjx").html('');
											}, 4000);
											relocate("../");
										}
										else
										{
											$("#msjx").html('');
											$("#msjx").html('<div class = "alert alert-danger">!!! Còdigo ingresado Incorrecto o expiró el Plazo para realizar el cambio de Clave o el usuario no Existe.</div>');
											setTimeout(function() {
												$("#msjx").html('');
											}, 4000);
										}
										
									},
									error: function(xhr) { // if error occured
										alert("Error ha ocurrido.");
									},
									complete: function() {					
										$("#carga").html('');
									},
								});		
								
							}	
						}
						else{
							$("#msjx").html('');
							$("#msjx").html('<div class = "alert alert-danger">!!! Las claves digitadas son diferentes.</div>');
							setTimeout(function() {
								$("#msjx").html('');
							}, 2500);
						}
					}
					else
					{
						$("#msjx").html('');
						$("#msjx").html('<div class = "alert alert-danger">!!! Debe digitadar información en todos los campos.</div>');
						setTimeout(function() {
							$("#msjx").html('');
						}, 2500);
					}
				});
				
				$("#password").on('keyup', verif);
				$("#con_password").on('keyup', verif);
			});			
			
			var verif = function(){
				if( $("#password").val() == $("#con_password").val() )
				{
					var c1 = $("#password").val().length;
					var c2 = $("#con_password").val().length;
					if ( c1 >= 8 && c2 >= 8 )
					{	
						enviar = true;
						$("#btn-loginx").prop("disabled", false);
					}
					else
					{
						$("#btn-loginx").prop("disabled", true);
						$("#msjx").html('');
						$("#msjx").html('<div class = "alert alert-danger">!!! La clave debe tener una longitud mìnimo de 8 caracteres.</div>');
						setTimeout(function() {
							$("#msjx").html('');
						}, 2500);
					}
				}
				else
				{
					$("#btn-loginx").prop("disabled", true);
					$("#msjx").html('');
					$("#msjx").html('<div class = "alert alert-danger">!!! Las claves digitadas son diferentes.</div>');
					setTimeout(function() {
						$("#msjx").html('');
					}, 2500);
				}
			};			
			</script>
	<!-- 		
		</body>
	</html>	
	-->
<?php 
	}
	else
	{
?>
	<!-- 
	<html>
		<head>
			<title>Cambiar Contrase&ntilde;a</title>			
			<link rel="stylesheet" href="css/bootstrap.min.css" >
			<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
			<script src="js/bootstrap.min.js" ></script>			
		</head>		
		<body>
	-->	
			<div >		
				<div class="ccontainer" style="width:100% !important;">    
					<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12 col-md-offset-0 col-sm-10 col-sm-offset-2">                    
						<div class="panel panel-info" >
							<div class="panel-heading">
								<div class="panel-title">Cambiar Contrase&ntilde;a</div>
								<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Volver a Inicio</a></div>
							</div>
						</div>
						
						<div style="padding-top:15px" class="panel-body">
							<div class = "alert alert-danger">No es posible realizar esta acci&oacute;n, favor envie un email a: soporte@litigantes.com</div>
						</div>
						
					</div>
				</div>
			</div>
	<!--
		</body>
	</html>
	-->	
<?php 
	}
?>