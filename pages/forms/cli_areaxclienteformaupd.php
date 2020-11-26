<?php 
if(isset($_SESSION['tiempo']) ) {

    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 120;//2min en este caso.

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

	//Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
	if($vida_session > $inactivo)
	{
		//Removemos sesión.
		session_unset();
		//Destruimos sesión.
		session_destroy();              
		//Redirigimos pagina.
		header("Location: ../../index.php");
		exit();
	}
} 
else 
{
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); 
$LogoInterno = LogoInterno; 
//require_once('../../Connections/config2.php');
//echo "<br><br><br><br><br><br><br><br><br>";
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

        switch ($theType) 
        {
            case "text":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;    
            case "long":
            case "int":
            $theValue = ($theValue != "") ? intval($theValue) : "NULL";
            break;
            case "double":
            $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
            break;
            case "date":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
            case "defined":
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
        }
        return $theValue;
    }
}


$NombreTabla ="AREAXCLIENTE";
$idTabla = 0;
$tipoCLiente = 0 ;
//require_once('../../apis/juzgado/juzgado.php');
//require_once('../../apis/cliente/infoCliente.php');
$yy = date("Y");
$empresa = Company;
if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
}
$id = "";
$id2 = "";
$id3 = "";
$ver = "";
if( isset($_POST['id'])  && !empty($_POST['id']) )
{    
    $id = trim($_POST['id']);
}

if( isset($_POST['id2'])  && !empty($_POST['id2']) )
{    
    $id2 = trim($_POST['id2']);
}

if( isset($_POST['id3'])  && !empty($_POST['id3']) )
{    
    $id3 = trim($_POST['id3']);
}
$nombre_lnk = "areaxcliente";
$nombre = "";
$email  = "";
$usuario ="";
//$url ="../../consultadetalle/consultadetalle_juzgado.php?IdTabla=$id2";
$url = urlServicios."consultadetalle/cli_areaxcliente.php?IdEmpresa=$id2&IdTipoJuzgado=$id3";
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

	$mareaxcliente =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
	$mareaxcliente = json_decode($mareaxcliente, true);
	//echo("<script>console.log('PHP: ".print_r($mareaxcliente)."');</script>");
	//echo("<script>console.log('PHP: ".count($m['cli_areaxcliente'])."');</script>");
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	//echo "Error : ", $json_errors[json_last_error()], PHP_EOL, PHP_EOL."<br>";
	if( $mareaxcliente['estado'] < 2)
	{
		//print_r($mareaxcliente);
	}
}
else
{
	$soportecURL = "N";
	echo "No hay soporte para cURL";
}

if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
{    
    $usuario = trim($_POST['ƒ×']);
}
else
{
    $usuario ="";
}

if($id != "" && $id2 != "" && $id3 != "")
{
	$ver = "S";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <!-- <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" /> -->
    <link href="../../css/sweet/sweetalert.css" rel="stylesheet" />
    <link href="../../css/sweet/main.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- mks 20170128
    <link rel="stylesheet" href="../../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../../css/themes2/alertify.default.css" id="toggleCSS" /> -->
    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <!--  <script src="../../plugins/sweetalert/sweetalert.min.js"></script> -->
    <script src="../../js/sweet/functions.js"></script>
    <script src="../../js/sweet/sweetalert.min.js"></script>
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="../../plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Waves Effect bootbox.min.js Js -->
    <script src="../../js/bootbox.min.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/form-validation.js"></script>
    <script src="../../plugins/jquery-validation/localization/messages_es.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

    <!-- <script src="../../js/alertify.min.js"></script> -->
    <script src="../../js/jquery.numeric.js"></script>
	 
	<!-- toggle botton --> 
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript">
    var nombre ="";
    $(document).ready(function()
    {       
        $("#msj").hide();		
		
        function reset () {
            $("#toggleCSS").attr("href", "../../css/themes2/alertify.default.css");
            alertify.set({
                labels : {
                    ok     : "OK",
                    cancel : "Cancelar"
                },
                delay : 5000,
                buttonReverse : false,
                buttonFocus   : "ok"
            });
        }
		
		if("<?php echo $ver; ?>" == "S")
		{
			///console.log("<>")
			$.getJSON('../tables/urlink.php', {funcion: "ja", origen: $('#tipojuzgado').val()}, function (data) {
				var zdata= data.juz_areasxtipojuzgado; 				
				var name = "";
				var id = "";
				var nom = "";			
				$("#lbltxt").html("");
				$("#mappend").html("");
				$("#zonatodos").hide();				
				if (zdata != undefined)
				{						
					if(zdata.length > 0 )
					{
						$("#zonatodos").show();
						if(zdata.length == 1 )
						{							
							$("#zonatodos").hide();
						}						
						$("#divtodos").show();
					}
					else{
						$("#zonatodos").hide();
						$("#divtodos").hide();
					}
					
					for (var i = 0; i < zdata.length; i++) {				
						id = zdata[i].ARE_IdArea;
						nom = zdata[i].ARE_Nombre;
						console.log('id...'+id)
						var opcchk = "";
						<?php							
							for($j=0;$j<count($mareaxcliente['cli_areaxcliente']);$j++)
							{
								$Id = $mareaxcliente['cli_areaxcliente'][$j]['ARC_Id_AreaCliente'];
								$IdEmpresa = $mareaxcliente['cli_areaxcliente'][$j]['ARC_IdEmpresa'];
								$IdTipoJuzgado = $mareaxcliente['cli_areaxcliente'][$j]['ARC_IdTipoJuzgado'];
								$IdArea = $mareaxcliente['cli_areaxcliente'][$j]['ARC_IdArea'];
						?>
								
								if(<?php echo $IdArea; ?> == id)
								{
									opcchk = "checked";									
								}
						<?php
							}
						?>						
						name += "<input class='chk-box' type='checkbox' id='" + id + "' "+ opcchk +" name='itemchk' value='"+id+"' /><label for='"+id+"'>" + nom + "</label><br>";
					}
					$("#lbltxt").html("<span style='color:red;'>*</span> Seleccione Area(s) o Especialidad(es):");
					$("#mappend").append(name);
				}
				else
				{
					$("#zonatodos").hide();					
					$("#lbltxt").html("<b>Atención:</b> No existe información disponible para esa Jurisdicción.");					
				}
				$("#divtodos").show();				
			});
		}
		
		
		
		$("#todos").on('click', function(e){
			$(".chk-box").prop("checked", this.checked);
		});		
		 
		$('#tipojuzgado').change(function() 
		{            
            var nameARE_Codigo = $('#tipojuzgado option:selected').text();
            _tipojuzgado = nameARE_Codigo.trim();
            _tipojuzgado = _tipojuzgado.substring(0, 2);
			$("#todos").prop("checked", false);
			
			$.getJSON('../tables/urlink.php', {funcion: "ja", origen: $('#tipojuzgado').val()}, function (data) {
				var zdata= data.juz_areasxtipojuzgado; 				
				var name = "";
				var id = "";
				var nom = "";			
				$("#lbltxt").html("");
				$("#mappend").html("");
				$("#zonatodos").hide();				
				if (zdata != undefined)
				{						
					if(zdata.length > 0 )
					{
						$("#zonatodos").show();
						if(zdata.length == 1 )
						{							
							$("#zonatodos").hide();
						}						
						$("#divtodos").show();
					}
					else{
						$("#zonatodos").hide();
						$("#divtodos").hide();
					}
					
					
					
					for (var i = 0; i < zdata.length; i++) {				
						id = zdata[i].ARE_IdArea;
						nom = zdata[i].ARE_Nombre;						
						
						name += "<input class='chk-box' type='checkbox' id='"+id+"' name='itemchk' value='"+id+"' /><label for='"+id+"'>" + nom + "</label><br>";
							
					}
					$("#lbltxt").html("<span style='color:red;'>*</span> Seleccione Area(s) o Especialidad(es):");
					$("#mappend").append(name);
				}
				else
				{
					$("#zonatodos").hide();					
					$("#lbltxt").html("<b>Atención:</b> No existe información disponible para esa Jurisdicción.");					
				}
				$("#divtodos").show();				
			});
        });
		
		
		$("#grabar").on('click', function(e) 
		{				
			var empresa = $('#zip').val();
			var tipojuzgado = $('#tipojuzgado').val()
			
			if ( empresa != "" && tipojuzgado != "")
			{	
				var selected = [];
				selected.push(empresa);
				selected.push(tipojuzgado);
				
				$(":checkbox[name=itemchk]").each(function() {
					if (this.checked) {
						// agregas cada elemento.
						selected.push($(this).val());
					}
				});			
				
				if (selected.length) {
					console.log(selected);
					$.ajax({				
						type: 'POST',
						dataType: 'json', 
						data: "datos="+JSON.stringify(selected),
						url: '../forms/cli_areaxcliente.php',						
						success: function(data) {
							if(data == 1)
							{
								setTimeout(function () {
									swal("Atención:", "Grabado correctamente.", "success");
								}, 2000);								
								window.location = 'cli_areaxcliente.php';
							}	
						},
						error: function(xhr, status, error) {
							alert(status);
						},
						dataType: 'text'				   
					});
				}	
			}
			 else 
            {                
                swal({
                  title: "Atención:  Debe Seleccionar Empresa y/o Corporación / Juridiscción ...",
                  text: "un momento por favor.",
                  imageUrl: "../../js/sweet/3red.gif",
                  timer: 2500,
                  showConfirmButton: false
                });
                return false;             
            }
			
        });
		
		$("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'cli_areaxcliente.php';
        }); 
        

        $("#grabar").on('click', function(e) { 
   
        });	
		
    });    
    </script>    
</head>

<body class="theme-indigo">
    <?php require_once('../tables/secciones.html'); ?>
     <section class="content" style="margin-top:85px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORMULARIO ...: <?php echo $NombreTabla; ?>.
                    <small>acción: Editar.</small>
                </h2>
            </div>
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <!--<div class="header">
                            <h2>REGISTRO DE TABLAS.</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>                                    
                                </li>
                            </ul>
                        </div>
                        <div class="body"> -->
						<div class="body table-responsive" id="zonaquery" style="height:680px !important;">
                            <form id="form_validation" method="POST"  autocomplete="ÑÖcompletes">

                                <div class="form-group">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">
											<div class="xcol-xs-10">
												<span style="color:red;">*</span>
												<label class="form-label">Empresa / Abogado:</label>
												<div class="xform-line">                                                    
													<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="zip" id="zip" required>
													<option value="" >Seleccione Opción...</option>
													<?php														
														$idTabla = 0;
														require_once('../../apis/empresa/Empresa.php');
														for($i=0; $i<count($mempresa['emp_empresa']); $i++)
														{
															$EMP_IdEmpresa = trim($mempresa['emp_empresa'][$i]['EMP_IdEmpresa']);
															$NombreEmpresa = strtoupper($mempresa['emp_empresa'][$i]['NombreEmpresa']);
															$EMP_Identificacion = $mempresa['emp_empresa'][$i]['EMP_Identificacion'];
													?>
															<option value="<?php echo $EMP_IdEmpresa; ?>" <?php if($id2 == $EMP_IdEmpresa){echo "selected";} else {echo "";} ?>>
																<?php echo $NombreEmpresa ; ?>                                                
															</option>
													<?php
														}
													?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">
											<div class="xcol-xs-10">
												<span style="color:red;">*</span>
												<label class="form-label">Corporaci&oacute;n / Jurisdicci&oacute;n:</label>                                        
												<select class="selectpicker show-tick" data-live-search="true" data-width="95%" name="tipojuzgado" id="tipojuzgado" required>
													<option value="" >Seleccione Corporaci&oacute;n...</option>
													<?php
														$idTabla = 0;
														require_once('../../apis/general/tipojuzgado.php');
														for($i=0; $i<count($mtipojuzgado['juz_tipojuzgado']); $i++)
														{
															$TJU_IdTipoJuzgado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_IdTipoJuzgado'];                                                    
															$TJU_Nombre = trim($mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Nombre']);
															$TJU_Codigo = trim($mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Codigo']);
															$TJU_Estado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Estado'];
													?>
															<option value="<?php echo $TJU_IdTipoJuzgado; ?>" <?php if($id3 == $TJU_IdTipoJuzgado){echo "selected";} else {echo "";} ?>>
																<?php echo  $TJU_Codigo .'-'. $TJU_Nombre ; ?>                                                
															</option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group">                               
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">												
											<div id="divtodos" name="divtodos">
												<hr>													
												<label id="lbltxt"></label><br>
												<div id="zonatodos">
													<input class='select-all' type='checkbox' id='todos' value="0" name='todos' />
													<label for='todos'>Seleccionar / Desmarcar Todos</label><br>
												</div>
											</div>
											
											<div id="mappend" name="mappend">											
											</div>
											
										</div>
									</div>
								</div>
								
								<div class="form-group">                               
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="row">
											<hr>
										</div>
									</div>
								</div>
								
								<div class="form-group">                               
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="row">
											<button class="btn btn-primary waves-effect" type="submit" id="grabar">GRABAR</button>
											<button class="btn btn-danger waves-effect" type="submit" id="cerrar">SALIR</button>
											<div><span style="color:red;">* Campos Obligatorios.</span></div>
										</div>
									</div>
								</div>
                            </form>                        
                    	</div>
                	</div>    
                </div>               
            </div>
            <!-- #END# Basic Validation --> 
             <div class="row clearfix">         
                <div id="msj">

                     <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" >
                                <div class="modal-header">
                                    <!-- <h4 class="modal-title" id="defaultModalLabel">Crear</h4> -->
                                </div>
                                
                                <div class="modal-body">                         
                                    <object type="text/html" data="mensajes.php?id=ES" ></object>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> 
                                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="cerrarModalC">CERRAR Crear.</button>-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
             </div>
        </div>
    </section>  
</body>
</html>