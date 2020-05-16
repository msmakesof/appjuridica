<?php
include 'Connections/DataConex.php';
$Company = Company;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>.:: <?php echo  $Company; ?>  |  Principal ::.</title>
    <!-- Favicon-->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
     
    <style>
        .modal-header, h4 {
            background-color: red;
            color:white !important;
            text-align: center;
            font-size: 30px;
        }
        .modal-footer, .close {
            background-color: #f9f9f9;
        }
		
		#div-cookies {
			position: fixed;
			bottom: 0px;
			left: 0px;
			width: 100%;
			background-color: white;
			box-shadow: 0px -5px 15px gray;
			padding: 7px;
			text-align: center;
		}
    </style>
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo"></div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="post">
                	<div style="font-family: verdana; font-size: 26px; color: #00568C; font-weight: bold; text-align:center;" id="titulo"></div>
                	<div style="text-align: center !important;" id="logo"></div>
                	<hr>
                    <div style="font-size: 19px; font-weight: bold; color: #000045;text-align: center;margin-top: -10px; margin-bottom: -10px;">Bienvenido</div>
                    <hr>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" id="username" item-label-path="Digite su Usuario" placeholder="Digite su Usuario" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Digite su Clave" required>
                        </div>
                    </div>
                    <div id="err"></div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Recordarme...</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit" id="ingresar" name="ingresar">INGRESAR</button>
                        </div>
                    </div>
					<hr>
                    <div class="row m-t-15 m-b--20">                    	                  
                        <div class="col-xs-5 align-right">
                            <a href="login/"> Olvid&eacute; mi Clave</a>
                        </div>
						<div class="col-xs-7 align-right">
                            <a href="#" style="font-size:11px; color: gray">Trato de Datos Personales.</a>
                        </div>
                    </div>
					
					<div class="row m-t-15 m-b--20">                    	                  
                        <div class="col-xs-5 align-left">
                            <a hreflang="pp" href="#" style="font-size:11px; color: gray">Política de Privacidad.</a>
                        </div>
						<div class="col-xs-7 align-right">
                            <a hreflang="tc" href="#" style="font-size:11px; color:gray">Términos y Condiciones de Uso.</a>
                        </div>
                    </div>

                     <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">                            
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">ATENCI&Oacute;N:</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col text-center">
                                        <img src="images/datoerrado.gif">
                                    </div>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>                        
                        </div>
                    </div>
					
					 <!-- Modal -->
                    <div class="modal fade" id="Modalrc" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-center">                            
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">ATENCI&Oacute;N:</h4>
                                </div>
                                <div class="modal-body">
									<hr>
									
									<div class="row">
										<div class="col-xs-12 col-md-12" p-t-5>
											<div class="col text-center">
												<label>Digite su Correo Electrn&oacute;nico o usuario para enviar un link donde podrá cambiar su clave:</label>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-8 col-md-8" p-t-3>
											<div class="col text-center">												
												<input type="email" class="form-control" name="email" id="email" item-label-path="Digite su Email" placeholder="Digite su Email" required autofocus>										
											</div>
										</div>
									</div>
										
									<div class="row">
										<div class="g-recaptcha" data-sitekey="6LfPF-8UAAAAAKQmQHsE6XSOaJmb8Kw_DjUbZxiP"></div>										
									</div>
										
									<div class="row">
										<div class="col-xs-9 col-md-9" p-t-3>
											<div class="col text-center" id="carga">
											</div>
										</div>										
									</div>
									
									<div class="row">
										<div class="col-xs-4 col-md-4" p-t-3>
											<div id="msjx">
												<h5><span class="badge badge-pill label-danger">Debe digitar un email / Digito una direccón de email No Válida.</span></h5>
											</div>
										</div>
									</div>                                    
									
                                </div>
                                <div class="modal-footer">
									<button type="button" class="btn btn-info" id="enviar" name="enviar">Enviar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        
                        </div>
                    </div>
					
                </form>
            </div>
		</div>
		        
		<div id="div-cookies" style="display: none;">
			Este portal web utiliza cookies para mejorar tu experiencia en nuestro portal. Si no cambias esta
            configuración en tu navegador, entenderemos que aceptas el uso de las mismas.<br>
			<button type="button" class="btn btn-sm btn-primary" id="acceptCookies">
				Acepto.
			</button>
		</div>
	
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>
    <script src="plugins/jquery-validation/localization/messages_es.js"></script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
    <script src="js/jsRelocate.js"></script>
	
    <script type="text/javascript">
    $(document).ready(function()
	{           
		var ac = 0;
		$("#msjx").hide();
		$('#div-cookies').show();
		$.ajax({
            type: "POST",
            dataType: "html",
            url : "encabezado.php",
        })  
        .done(function( dataX, textStatus, jqXHR ){          
            var cadena = dataX;
            var porciones = cadena.split('-');
            titulo = porciones[0];
            logo = porciones[1];
            $("#titulo").html(titulo);
            $("#logo").html('<img src="'+ logo +'" width="253" height="199">');
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            if ( console && console.log ) 
            {
                console.log( "La solicitud a fallado: " +  textStatus);
            }
        });

        $("#msj").html(""); 
		$( "#username" ).focus(function() {
		  $("#msj").html(""); 
		});
		
        $( "#password" ).focus(function() {
		  $("#msj").html(""); 
		});	

		$("#ingresar").click( function(e) 
		{            
			$("#msj").html("");
            var usuario = $("#username").val();
			var clave = $("#password").val();				 
			var entra = "N";

			if( usuario != "" )
			{				
				entra = "S";
			}				

			if( clave != "" )
            {   
			   entra = "S";
			}

            if( usuario == "" || clave == "" )
            {
                e.stopPropagation();
            }            

			if( entra == "S" )
            {                
				e.preventDefault();
                $.ajax({
					data : {"pusuario": usuario, "pclave": clave, "sp":"N", "ac": ac},
					type: "POST",
					dataType: "html",
					url : "valida_usuarioK2.php",
                })  
				.done(function( dataX, textStatus, jqXHR ){	                   				
					var respstr = dataX.trim();                   
                    if( respstr.substr(0,1) == "1" )
                    {                           
                        relocate("pages/indice.php");
                    }
                    else
                    {                     
                        $("#myModal").modal({backdrop: "static"});
                    }															
				})
				.fail(function( jqXHR, textStatus, errorThrown ) {
				 	if ( console && console.log ) 
					{
						console.log( "La solicitud a fallado: " +  textStatus);
				 	}
				});
			}	 
	    });
		
		var sendmai = false;		
		$("#email").blur( function(e) 
		{
			var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
			if (regex.test($('#email').val().trim())) {				
				$("#msjx").hide();
				sendmai = true;
			} 
			else 
			{
				$("#msjx").show();
				sendmai = false;
				$("#email").val('');
				setTimeout(function()
				{
					$("#msjx").hide();
				},2500);
			}
		});
		
		//	$("#rrc").click( function() {});
		
		$("#cenviar").click( function(e) 
		{
			$("#msjx").hide();
			var email = $("#email").val();
			
			if ( email == "" )
			{
				$("#msjx").show();
				setTimeout(function()
				{
					$("#msjx").hide();
				},2000);	
			}
			else
			{
				if(sendmai)
				{	
					$("#msjx").hide();					
					/**/
					$.ajax({
						data: {"rc": email},
						type: 'POST',
						dataType: "html",
						url: "enviaclave.php",				
						
						beforeSend: function() {					
							$("#carga").html('<img src="images/ajax-loader.gif"> Enviando Información... Un momento por favor.');							
						},
						success: function(data) {
							
							alert(data);
							//if (data == "S")
							$("#email").val('');
							/*
							if( data == "N")
							{
								swal({
									title: "Atención :  Existe un usuario registrado con ese Nro. de Identificación.",
									text: "un momento por favor.",
									imageUrl: "../../js/sweet/3red.gif",
									timer: 2000,
									showConfirmButton: false
								});
								return false;
							}
							else{								
							}
							*/
						},
						error: function(xhr) { // if error occured
							alert("Error ha ocurrido.");
						},
						complete: function() {					
							$("#carga").html('');
						},				
					});	
					/**/
				}
				else
				{
					$("#email").val('');
				}				
			}			
		});

		$("#acceptCookies").click( function(e) 
		{			
			localStorage.acceptCookies = 'true';
			ac = 1;
			$('#div-cookies').hide();
		});		
	});
    </script>    
</body>
</html>