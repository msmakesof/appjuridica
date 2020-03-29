<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>.:: Dependiente Judicial  |  Principal ::.</title>
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
        <div class="logo">
            
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="post">
                	<div style="font-family: verdana; font-size: 26px; color: #00568C; font-weight: bold;" id="titulo"></div>
                	<div style="text-align: center;" id="logo"></div>
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
					<!--
					<div class="row m-t-15 m-b--20">
						<div class="col-xs-12">                            
							<div id="msj"></div>
                        </div>
					</div>
					-->
					<hr>
                    <div class="row m-t-15 m-b--20">                    	                  
                        <div class="col-xs-5 align-right">
                            <a href="#">Olvid&eacute; mi Clave?</a>
                        </div>
						<div class="col-xs-7 align-right">
                            <a href="#">Trato de Datos Personales</a>
                        </div>
                    </div>

                     <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">                        
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">ATENCI&Oacute;N:</h4>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        <img src="images/noexiste.jpg">
                                    </p>
                                    <p>No existe Información para el Usuario digitado.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="ip"></div>
<div id="address"></div>
<!--
Respuesta completa: 
<pre id="details"></pre>
-->
		
		<div id="div-cookies" style="display: none;">
			Necesitamos usar cookies para que funcione todo, si permanece aquí acepta su uso, más información en
			<a hreflang="es" href="/info/aviso-legal">Aviso Legal</a>
			y la
			<a hreflang="es" href="/info/politica-de-privacidad">Política de Privacidad</a>.
			<button type="button" class="btn btn-sm btn-primary" id="acceptCookies">
				Acepto el uso de cookies
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
					data : {"pusuario": usuario, "pclave": clave, "sp":"N"},
					type: "POST",
					dataType: "html",
					url : "valida_usuarioK2.php",
                })  
				.done(function( dataX, textStatus, jqXHR ){	                   				
					var respstr = dataX.trim();                   
                    if( respstr.substr(0,1) == "1" )
                    {   						
                        //relocate("pages/tables/");
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
		
		function checkAcceptCookies() {
			if (localStorage.acceptCookies == 'true') 
            {
                alert(7);
			} 
            else 
            {
				$('#div-cookies').show();
			}
		}
		function acceptCookies() {
			localStorage.acceptCookies = 'true';
			$('#div-cookies').hide();
            
		}
		//$(document).ready(function() {
		checkAcceptCookies();
		//});
	});
    /*
    var ip="";
    $.get("https://ipinfo.io", function (response) {    
        $("#ip").html("IP: " + response.ip);
        ip = response.ip;        
        $("#address").html("Ubicaci&#243;n: " + response.city + ", " + response.region);
        $("#details").html(JSON.stringify(response, null, 4));    
    }, "jsonp");
    */
    </script>
    <!-- <div id="resultado"></div> -->
    <?php
    /*
        $ipPublica = "";
        $ipPublica = "<script> document.writeln(ip); </script>";        
        $dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ipPublica));        
        var_dump($dataArray);
        //ipinterna=$ipInterna&fechaHoraIngreso=$fechaHoraIngreso&nombreHost=$nombreHost&servidor=$servidor&puerto=$puerto&agente=$agente&ippublica=$ipPublica
    */
    ?>
</body>

</html>