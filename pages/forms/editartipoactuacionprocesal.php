<?php
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php'); 
$LogoInterno = LogoInterno;
require_once('../../Connections/config2.php'); 
?>
<?php
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
      if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
      }

      $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

      switch ($theType) {
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
$idTabla = 0;
//require_once('../../apis/proceso/origenactprocesal.php');
if( isset($_GET['f'])  && !empty($_GET['f']) )
{    
    $idTabla = trim($_GET['f']);
}
//echo $idTabla."<br>";
$Tabla ="TIPOACTUACIONPROCESAL";
$idtabla = 0;

if ( isset( $_POST["id"]))
{ 
    $idTabla = $_POST["id"];
}
$parIdTabla= $idTabla;

require_once('../../apis/proceso/tipoactuacionprocesal.php');
$NombreTAP = trim($mtipoactuacionprocesal['pro_tipoactuacionprocesal']['TAP_Nombre']); //echo "ntes...$Nombre";
$diashabiles = $mtipoactuacionprocesal['pro_tipoactuacionprocesal']['TAP_DiasHabiles'];
$origen = $mtipoactuacionprocesal['pro_tipoactuacionprocesal']['TAP_IdOrigen'];
$estado = $mtipoactuacionprocesal['pro_tipoactuacionprocesal']['TAP_Estado'];
$notifica = $mtipoactuacionprocesal['pro_tipoactuacionprocesal']['TAP_Notifica'];
$Periodo = $mtipoactuacionprocesal['pro_tipoactuacionprocesal']['TAP_IdPeriodo'];
$Area = $mtipoactuacionprocesal['pro_tipoactuacionprocesal']['TAP_IdArea'];
$idtabla = $mtipoactuacionprocesal['pro_tipoactuacionprocesal']['TAP_IdTipoActuacionProcesal'];
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

     <!-- Bootstrap Select Css -->
     <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="../../css/sweet/main.css" rel="stylesheet" />
	
	<!-- Bootstrap Select Css -->
	<link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../../css/themes2/alertify.default.css" id="toggleCSS" />

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>    
</head>

<body class="theme-indigo">

    <?php 	
	require_once('../tables/secciones.html');
	?>
      
     <section class="content" style="margin-top:85px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORMULARIO: <?php echo $Tabla; ?>.
                    <!--<small>Editar.</small>-->
                </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row info-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>REGISTRO EDICION DE <?php echo $Tabla; ?>.</h2>
                           <!--  <ul class="header-dropdown m-r--5">
                               <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>                                    
                                </li>
                            </ul>-->
                        </div>
                        <div class="body  table-responsive">
                            <form id="form_validation" method="POST">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12"><span style="color:red;">*</span>                                            
                                            <label class="form-labelx" style="color:#626060;font-family: 'Roboto', Arial, Tahoma, sans-serif;font-weight: bold;">
                                                Corporacion / Area - Especialidad - Sala :
                                            </label>                                                
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="area" id="area" required>
                                                <option value="" >Seleccione Opción...</option>
                                                <?php
                                                $idTabla = 0;
                                                require_once('../../apis/general/area.php');
                                                for($i=0; $i<count($marea['juz_area']); $i++)
                                                {
                                                    $IdArea = $marea['juz_area'][$i]['ARE_IdArea'];
                                                    $Nombre = trim($marea['juz_area'][$i]['ARE_Nombre']);
                                                    $Estado = $marea['juz_area'][$i]['ARE_Estado'];
                                                    $corporacion = trim($marea['juz_area'][$i]['corporacion']);
                                                ?>
                                                    <option value="<?php echo $IdArea; ?>" <?php if ($IdArea == $Area){ echo "selected";} else{ echo "";} ?>  style="font-size: 11px !important;">
                                                        <?php echo $corporacion .' - '. $Nombre ; ?>                                                
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3"><span style="color:red;">*</span>
                                            <label class="form-labelx" style="color:#626060;font-family: 'Roboto', Arial, Tahoma, sans-serif;font-weight: bold;">
                                                Origen / Autor:
                                            </label>                                                
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="origen" id="origen" required>
                                                <option value="" >Seleccione Opción...</option>
                                                <?php
                                                $idTabla = 0;
                                                require_once('../../apis/proceso/origenactprocesal.php');
                                                for($i=0; $i<count($morigenactprocesal['pro_origenactprocesal']); $i++)
                                                {
                                                    $IdOrigen = $morigenactprocesal['pro_origenactprocesal'][$i]['OAP_IdOrigen'];
                                                    $Nombre = $morigenactprocesal['pro_origenactprocesal'][$i]['OAP_Nombre'];
                                                    $Estado = $morigenactprocesal['pro_origenactprocesal'][$i]['OAP_Estado']; 
                                                ?>
                                                    <option value="<?php echo $IdOrigen; ?>" <?php if ($IdOrigen == $origen){ echo "selected";} else{ echo "";} ?> >
                                                        <?php echo $Nombre ; ?>                                                
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9"><span style="color:red;">*</span>
                                            <label class="form-label">Nombre</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $NombreTAP ;?>" required>                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>                               

                                <!-- 
								<div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div style="text-align:center;">
                                                <div class="badge badge-warning">Crear TERMINOS</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top:-5px; border-bottom-style: dotted; border-bottom-width: 1px; color: black">
								-->
                                
                                <div class="form-group">
                                    <div class="row">
										<div style="text-align:center; background-color: orange; margin-bottom: 10px">
											<div style="color:white; font-weight:bold;">Modificar TERMINOS</div>
										</div>
										
										<div id="xzonaterminos">					                                        
                                        
                                            <div class="col-lg-2 col-md-2 col-sm-2"><span style="color:red;">*</span>
                                                <label class="form-label">D&iacute;as: </label>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="dias" id="dias" required maxlength="2">
                                                </div>
                                                <div style="font-size:10px">m&aacute;ximo: 30</div>                                            
                                            </div>

                                            <div class="col-lg-2 col-md-2 col-sm-2"><span style="color:red;">*</span>                                            
                                                <label class="form-label">Recordatorio: </label>
                                                <input type="radio" name="notifica" id="no" class="with-gap" value="2">                                                
                                                <label for="no">No</label>                                                    
                                                <input type="radio" name="notifica" id="si" class="with-gap" value="1">
                                                <label for="si" class="m-l-20">Si</label>                                            
                                            </div>

                                            <div id="hper">            
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <label class="form-labelx" style="color:#626060;font-family: 'Roboto', Arial, Tahoma, sans-serif;font-weight: bold;">
                                                        Periodicidad :
                                                    </label>                                            
                                                    <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="periodo" id="periodo" required>
                                                        <option value="" >Seleccione Opción...</option>
                                                        <?php
                                                        $idTabla = 0;
                                                        require_once('../../apis/general/periodo.php');
                                                        for($i=0; $i<count($mperiodo['gen_periodo']); $i++)
                                                        {
                                                            $IdPeriodo = $mperiodo['gen_periodo'][$i]['PER_IdPeriodo'];
                                                            $Nombre = $mperiodo['gen_periodo'][$i]['PER_Nombre'];
                                                            $Estado = $mperiodo['gen_periodo'][$i]['PER_Estado']; 
                                                        ?>
                                                            <option value="<?php echo $IdPeriodo; ?>" >
                                                                <?php echo $Nombre ; ?>                                                
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-2 col-sm-2"><span style="color:red;">*</span>
                                                <label class="form-label">Repetici&oacute;n: </label><br>
                                                <input type="radio" name="repite" id="nr" class="with-gap" value="2">
                                                <label for="nr">No</label>
                                                <input type="radio" name="repite" id="sr" class="with-gap" value="1">
                                                <label for="sr" class="m-l-20">Si</label>
                                            </div>

                                            <div id="hrep">
                                                <div class="col-lg-2 col-md-2 col-sm-2"><span style="color:red;">*</span>
                                                    <label class="form-label">D&iacute;as:</label>                                    
                                                    <div class="form-line">                                        
                                                        <input type="text" class="form-control" name="diasrep" id="diasrep" required maxlength="2">
                                                    </div>
                                                    <div style="font-size:10px">m&aacute;ximo: 30</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                <button class="btn btn-info btn-sm waves-effect" type="button" id="aditer">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div style="overflow-x:auto;" id="items">
                                                <?php include('terminos.inc.php'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5"><span style="color:red;">*</span>
                                            <label class="form-label">Estado: </label>
                                            <input type="radio" name="estado" id="activo" class="with-gap" value="1" <?php if( $estado == 1){?>checked="checked"<?php } ?>>
                                            <label for="activo">Activo</label>

                                            <input type="radio" name="estado" id="inactivo" class="with-gap" value="2"<?php if( $estado == 2){?>checked="checked"<?php } ?>>
                                            <label for="inactivo" class="m-l-20">Inactivo</label>        
                                        </div>
                                    </div>
                                </div>
								
                                <hr>
                                <div class="form-group" style="clear: both; margin-top:20px; margin-bottom:20px;">                               
									<button class="btn btn-primary waves-effect" type="button" id="grabar">GRABAR</button>
								   <!--  <button type="button" class="btn btn-danger waves-effect" id="borrar" onclick="borrarc(<?php echo $idtabla ; ?>);">BORRAR</button> -->
                                    <button type="button" class="btn btn-danger waves-effect" id="borrar">BORRAR</button>
                                    <button class="btn btn-danger waves-effect" type="submit" id="cerrar">SALIR</button>
                                    <div><span style="color:red;">* Campos Obligatorios.</span></div>
								</div>
								
                            </form>                        
                            <div id="msj" style="margin-top:7px;"></div>


                             <form id="mensaje">
                             <label style="font-family: Verdana; font-size: 18; color:red;">Registro ha sido borrado correctamente.</lael>
                            </form>

                    	</div> 
                	</div>                    
                </div>               	           
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>

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

    <!-- Sweet Alert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/form-validation.js"></script>
    <script src="../../plugins/jquery-validation/localization/messages_es.js"></script>

    <script src="../../js/pages/ui/dialogs.js"></script>
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script> 
    <script src="../../js/jquery.numeric.js"></script>   

    <script src="../../js/alertify.min.js"></script>

    <script type="text/javascript">    
    $(document).ready(function()
	{			
		$("#mensaje").hide();
        $("#hper").hide();
        $("#dias").numeric();
        $("#diasrep").numeric();
        //$("#zonaterminos").hide();
        $("#hrep").hide();        
        $("#form_validation").show();
        $("#form_validation").click(function() {
			$("#msj").html("");
		});

        $("#si").prop('checked', 'checked');        
        $("#nr").prop('checked', 'checked');
        var valnotifica = 0;
        if($('input:radio[name=notifica]:checked').val() == 1){
            valnotifica = 1;
            $("#hper").show(); 
        }

        $("input[name=notifica]").change(function () {	 
			if($(this).val() == 1 ){
                $("#hper").show();
            }
            else{
                $("#hper").hide();
            }
		});

         $("input[name=repite]").change(function () {	 
			if($(this).val() == 1 ){
                $("#hrep").show();
            }
            else{
                $("#hrep").hide();
            }
		});        

        // var verperiodo = <?php echo $notifica ; ?>;
        // if(verperiodo == 1){
        //     $("#hper").show(); 
        // }

        $("#dias").on('change', function(e){
            var dias = $("#dias").val();
            if(dias > 30)
            {
                swal("Atencion:", "No puede digitar un valor mayor a 30");
                e.stopPropagation();
                $("#dias").val('');
                return false; 
            }
        })

        $("#crear").on('click', function(e) {
            $("#zonaterminos").show();
        }); 
		
		$("#grabar").on('click', function(e) {
            $("#mensaje").hide();
			var nombre = $("#nombre").val();
            nombre = nombre.toUpperCase();
            //var dias = $("#dias").val();
            var origen = $("#origen").val();
            var area = $("#area").val();
            //var periodo = $("#periodo").val();
			//var notifica = $('input:radio[name=notifica]:checked').val();
            var estado = $('input:radio[name=estado]:checked').val();
			var idtabla = "<?php echo $idtabla; ?>";

            if( estado == undefined || nombre == "" || origen == "" || area == "" )
            {                 
                swal("Atencion:", "Debe seleccionar los campos Obligatorios.");
                e.stopPropagation();
                return false;
            }
			else{
                $.ajax({
                    data : {"nombre": nombre, "origen": origen, "estado": estado, "area":area, "idtabla": idtabla},
                    type: "POST",
                    dataType: "html",
                    url : "../forms/editar_<?php echo strtolower($Tabla); ?>.php",
                })  
                .done(function( dataX, textStatus, jqXHR ){	
                    // 				
                    var xrespstr = dataX.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2); 
                    
                    if( respstr == "S" )
                    {
                        swal("Atención: ", msj, "success");
                        return false;                                    
                    }
                    else
                    {					
                        swal({
                            title: "Atención: ",   
                            text: msj,   
                            type: "error" 
                        });
                        return false;                    
                    }
                })
                .fail(function( jqXHR, textStatus, errorThrown ) {
                    //e.stopPropagation();
                    if ( console && console.log ) 
                    {						
                        console.log( "La solicitud a fallado: " +  textStatus);
                        $("#msj").html("");
                    }
                });
            }    
		});

        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'pro_tipoactuacionprocesal.php';
        });

        $("#aditer").on("click", function(e){
            var datos = [];
            var objeto = {};
            var dias = $("#dias").val();
            var notifica = $('input:radio[name=notifica]:checked').val();
            var periodo = $("#periodo").val();            
            var repite = $('input:radio[name=repite]:checked').val();
            var diasrep = $("#diasrep").val();
            var idtabla = "<?php echo $idtabla; ?>";
            if (diasrep == "")
            {
                diasrep = 0;
            }
            var condi = 0;            

            if(valnotifica == 1){ 
                if (periodo == ""){ condi = 1 ; }
            }

            e.preventDefault();
            if( dias == "" || dias > 30  || notifica == undefined || repite == undefined || condi > 0 )
            { 
                swal("Atención:", "Debe seleccionar los campos obligatorios.");
                e.stopPropagation();
                return false;
            }
            else{  
                var nombreperiodo = $('select[name="periodo"] option:selected').text();
                nombreperiodo = $.trim(nombreperiodo);
                datos.push({
                    "dias": dias,
                    "notifica": notifica,
                    "periodo": periodo,
                    "nombreperiodo":nombreperiodo,
                    "repite": repite,
                    "diasrep": diasrep
                });
                
                objeto.datos = datos;

                $.ajax({                    
                    data : {"pdias": dias, "pnotifica": notifica, "pperiodo": periodo, "prepite":repite, "pdiasrep":diasrep, "pdatos":JSON.stringify(datos), "pidtabla":idtabla},
                    type: "POST",
                    dataType: "html",
                    url : "../forms/crea_terminos.php",
                })
                .done(function( data, textStatus, jqXHR){                  
                    var xrespstr = data.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);
                    if(respstr == "E")
                    {         
                        swal("Atención:", msj);
                    }
                    else
                    {    
                        if( respstr == "S" )
                        {                        
                            $("#items").load("../forms/terminos.inc.php?parIdTabla=<?php echo $parIdTabla; ?>");
                            swal("Atención: ", msj, "success");
                            return false;
                        }
                        else
                        {
                           swal({
                                title: "Atención: ",   
                                text: msj,   
                                type: "error" 
                            });
                            return false;       
                        }
                    }    
                })
                .fail(function( jqXHR, textStatus, errorThrown ) {
                    if ( console && console.log ) 
                    {
                        console.log( "La solicitud a fallado: " +  textStatus);
                        $("#msj").html("");
                    }
                });
            }
        });

	
    $("#borrar").on('click', function() {   
        var idtabla  = "<?php echo $idtabla; ?>";        
        var nomtabla = "<?php echo $Nombre; ?>";

        alertify.confirm( 'Desea borrar este registro?', function (e) {
            if (e) {
                //after clicking OK
                $.ajax({
                    data : {"pidtabla": idtabla},
                    type: "POST",
                    dataType: "html",
                    url : "../forms/borrar_<?php echo strtolower($Tabla); ?>.php",
                })  
                .done(function( dataX, textStatus, jqXHR ){                       
                    var xrespstr = dataX.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);        
                    if( respstr == "S" )
                    {            
                       swal("Atención: ", msj, "success");
                       //$('#defaultModalEditar').css('display', 'none');
                       //window.location="../tables/gen_tabla.php";                       
                    }
                    else
                    {                    
                        swal({
                            title: "Atención: ",   
                            text: msj,   
                            type: "error" 
                        });                    
                    }
                })
                .fail(function( jqXHR, textStatus, errorThrown ) {
                    //e.stopPropagation();
                    if ( console && console.log ) 
                    {                       
                        console.log( "La solicitud a fallado: " +  textStatus);
                        $("#msj").html("");
                    }
                });
            } 
            else {
                //after clicking Cancel
            }
        });   
    });
});

function del(id)
{
    swal({
        title: "¿Desea eliminar este item?",
        text: "No podrá recuperar el item después de ser eliminado",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false },

        function(isConfirm){
        if (isConfirm) 
        {
            $.ajax({
                data : {"pidtabla": id},
                type: "POST",
                dataType: "html",
                url : "../forms/borrar_terminos.php",
            })  
            .done(function( dataX, textStatus, jqXHR ){                       
                var xrespstr = dataX.trim();
                var respstr = xrespstr.substr(0,1);
                var msj = xrespstr.substr(2);        
                if( respstr == "S" )
                { 
                    $("#fila"+id).remove();
                    swal("Atención: ", msj, "success");
                }
                else
                {                    
                    swal({
                        title: "Atención: ",   
                        text: msj,   
                        type: "error" 
                    });                    
                }
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                //e.stopPropagation();
                if ( console && console.log ) 
                {                       
                    console.log( "La solicitud a fallado: " +  textStatus);
                    $("#msj").html("");
                }
            });
        } else {
            swal("¡Atención!",
                    "Acción de borrado cancelada...",
                    "error"
            );
        }
    });
}
</script>
    
</body>

</html>
