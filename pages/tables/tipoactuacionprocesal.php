<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
else
{
    header('Location: ../../index.php');
}
$idTabla = 0;
require_once('../../apis/proceso/origenactprocesal.php');
$NombreTabla ="TIPOACTUACIONPROCESAL";
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
    <!-- <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" /> -->
    <link href="../../css/sweet/sweetalert.css" rel="stylesheet" />
    <link href="../../css/sweet/main.css" rel="stylesheet" />


    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

<!-- mks 20170128
    <link rel="stylesheet" href="../../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../../css/themes2/alertify.default.css" id="toggleCSS" /> -->

 <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> -->
  
<!-- Sweet Alert Plugin Js -->
   <!--  <script src="../../plugins/sweetalert/sweetalert.min.js"></script> -->
    <script src="../../js/sweet/functions.js"></script>
     <script src="../../js/sweet/sweetalert.min.js"></script>

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
    <script src="../../js/jquery.numeric.js"></script>

    <!--  <script src="../../js/alertify.min.js"></script> -->

    <style>
        table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
        }

        th, td {
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}
    </style>

    <script type="text/javascript">
    var nombre ="";
    var datos = [];
    var objeto = {};
    var datosx = [];
    $(document).ready(function()
    {           
        $("#dias").numeric();
        $("#diasrep").numeric();
        $("#msj").hide();
        $("#zonaterminos").hide();
        $("#hper").hide();
        $("#hrep").hide();

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

        $("#si").prop('checked', 'checked');        
        $("#nr").prop('checked', 'checked');
        $("#activo").prop('checked', 'checked');
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


        $("#cerrar").on('click', function(e) {
            e.preventDefault();
            window.location = 'pro_tipoactuacionprocesal.php';
        });

       
        $("#aditer").on('click', function(e) { 
            var dias = $("#dias").val();
            var notifica = $('input:radio[name=notifica]:checked').val();
            var periodo = $("#periodo").val();            
            var repite = $('input:radio[name=repite]:checked').val();
            var diasrep = $("#diasrep").val();
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

                var existe = false;
                for(var i= 0; i < datos["length"]; i++) 
                {                   
                    var vdia = datos[i].dias;
                    var vnotifik = datos[i].notifica;
                    var vperiodo = datos[i].periodo;
                    var vnomper = datos[i].nombreperiodo;
                    var vrepit = datos[i].repite;
                    var vdr = datos[i].diasrep;

                    if( vdia == dias && vnotifik == notifica && vperiodo == periodo && vrepit == repite && vdr == diasrep )
                    {
                        existe = true;
                    }
                }
                if(existe)
                {
                    swal("Atención:", "Ya fue adicionado un Término con las mismas especificaciones.");
                    e.stopPropagation();
                    return false;
                }
                else
                {
                    datos.push({
                    "dias": dias,
                    "notifica": notifica,
                    "periodo": periodo,
                    "nombreperiodo":nombreperiodo,
                    "repite": repite,
                    "diasrep": diasrep
                    });

                    datosx = datos;

                    objeto.datos = datos;
                    console.log(JSON.stringify(objeto));

                    var items ="";
                    items +="<table>";
                    items +="    <tr>";
                    items +="         <th>Dias</th>";
                    items +="        <th>Recordatorio</th>";
                    items +="        <th>Periodicidad</th>";
                    items +="        <th>Repetición</th>";
                    items +="        <th>Dias Repite</th>";
                    items +="        <th>Borrar</th>";
                    items +="    </tr>";

                    var dataobj = JSON.stringify(objeto);                    
                    for(var i= 0; i < datos["length"]; i++) 
                    {                   
                        var vdia = datos[i].dias;
                        var vnotifik = datos[i].notifica;
                        var vnomper = datos[i].nombreperiodo;
                        var vrepit = datos[i].repite;
                        var vdr = datos[i].diasrep;
                        var datanotifik = "No";
                        var datarepite = "No";
                        if(vnotifik == 1 ){datanotifik = "Si";}
                        if(vrepit == 1 ){datarepite = "Si";}
                        
                        items +="<tr id='"+[i]+"'>";
                        items +="<td>" + vdia + "</td>";
                        items +="<td>" + datanotifik + "</td>";
                        items +="<td>" + vnomper + "</td>";
                        items +="<td>" + datarepite + "</td>";
                        items +="<td>" + vdr + "</td>";
                        items +="<td><a href='#' onClick='del("+[i]+")'><img src='../../images/borrar.png' id='"+[i]+"'></a></td>";
                        items +="</tr>";
                    }
                    items +="</table>";
                }
            }
            $("#items").html(items);
            $("#periodo option").prop("selected", false).trigger( "change" );
            $("#dias").val('');
            $("#diasrep").val('');
        });
                
        $("#grabar").on('click', function(e) { 
           
            var nombre = $("#nombre").val();
            nombre = nombre.toUpperCase();
            var origen = $("#origen").val();
            var area = $("#area").val();            
            var estado = $('input:radio[name=estado]:checked').val();
            var datos = datosx; 
            e.preventDefault();
            if( estado == undefined || nombre == "" || origen == "" || area == "" || datos.length == 0 )
            {                 
                swal("Atención:", "Debe seleccionar los campos obligatorios y/o Adicionar Términos...");
                e.stopPropagation();
                return false;
            }
            else
            {
                $.ajax({                    
                    data : {"pnombre": nombre, "pestado": estado, "porigen": origen, "parea":area, "pdatos":JSON.stringify(datos)},
                    type: "POST",
                    dataType: "html",
                    url : "../forms/crea_<?php echo strtolower($NombreTabla); ?>.php",
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
    });

    function existe(parnombre)
    {                       
        alertify.alert("Tipo Actuacion Procesal: "+ parnombre +" !Ya se encuentra registrada.");
            $("#msj").html("Echo....");
    }

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
                datos.splice(id, 1);
                $('#'+id).remove();
                swal("¡Correcto!",
                        "Item ha sido borrado",
                        "success"
                    );
            } else {
                swal("¡Atención!",
                        "Acción de borrado cancelada...",
                        "error"
                );
            }
        });
    }
    </script>    
</head>

<body class="theme-indigo">
    
    <?php 	
	require_once('secciones.html');
	?>
    
    <section class="content" style="margin-top:85px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    FORMULARIO: <?php echo $NombreTabla; ?>.
                    <small>acción: Crear.</small>
                </h2>
            </div>
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>REGISTRO DE <?php echo $NombreTabla; ?>.</h2>
                            <ul class="header-dropdown m-r--5">
                                <!--<li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>                                    
                                </li>-->
                            </ul>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12"><span style="color:red;">*</span>
                                            <label class="form-label">
                                                Corporacion - Area o Especialidad o Sala :
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
                                                    <option value="<?php echo $IdArea; ?>">
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
                                            <label class="form-label">Origen / Autor:</label>                                        
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="origen" id="origen" required>
                                                <option value="" >Seleccione Opción...</option>
                                                <?php
                                                    for($i=0; $i<count($morigenactprocesal['pro_origenactprocesal']); $i++)
                                                    {
                                                        $IdOrgien = $morigenactprocesal['pro_origenactprocesal'][$i]['OAP_IdOrigen'];
                                                        $Nombre = $morigenactprocesal['pro_origenactprocesal'][$i]['OAP_Nombre'];
                                                        $Estado = $morigenactprocesal['pro_origenactprocesal'][$i]['OAP_Estado']; 
                                                ?>
                                                        <option value="<?php echo $IdOrgien; ?>" >
                                                        <?php echo $Nombre ; ?>                                                
                                                    </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9"><span style="color:red;">*</span>
                                            <label class="form-label">Nombre Actuaci&oacute;n Procesal:</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombre" id="nombre" required>
                                                <label class="form-label"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                
                                <div class="form-group">
                                    <div class="row">                                        
                                        <div id="xzonaterminos">
                                            <div class="col-lg-2 col-md-2 col-sm-2"><span style="color:red;">*</span>                                 
                                                <label class="form-label">D&iacute;as:</label>                                    
                                                <div class="form-line">                                        
                                                    <input type="text" class="form-control" name="dias" id="dias" required maxlength="2">                                                    
                                                </div>
                                                <div style="font-size:10px">m&aacute;ximo: 30</div>
                                            </div>

                                            <div class="col-lg-2 col-md-2 col-sm-2"><span style="color:red;">*</span>                                            
                                                <label class="form-label">Recordatorio: </label><br>
                                                <input type="radio" name="notifica" id="no" class="with-gap" value="2">
                                                <label for="no">No</label>                                                    
                                                <input type="radio" name="notifica" id="si" class="with-gap" value="1">
                                                <label for="si" class="m-l-20">Si</label>                                            
                                            </div>

                                            <div id="hper">            
                                                <div class="col-lg-3 col-md-3 col-sm-3"><span style="color:red;">*</span>
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
                                                            <option value="<?php echo $IdPeriodo; ?>">
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
                                            <div style="overflow-x:auto;" id="items"></div>
                                        </div>
                                    </div>
                                </div>

                                <hr style="margin-top:-5px; border-bottom-style: dotted; border-bottom-width: 1px; color: black">
                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-lg-5 col-md-5 col-sm-5"><span style="color:red;">*</span>
                                        <label class="form-label">Estado: </label>
                                            <input type="radio" name="estado" id="activo" class="with-gap" value="1">
                                            <label for="activo">Activo</label>

                                            <input type="radio" name="estado" id="inactivo" class="with-gap" value="2">
                                            <label for="inactivo" class="m-l-20">Inactivo</label>
                                        </div>

                                    </div>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit" id="grabar">GRABAR</button>
                                <button class="btn btn-danger waves-effect" type="submit" id="cerrar">SALIR</button>
                                <!-- <div id="g" class='alert'>GRabado</div> -->
                            </form>                        
                    	</div>
                	</div>    
                </div>               
            </div>
            <!-- #END# Basic Validation --> 
             <div class="row clearfix">         
                <div id="msj"></div>
             </div>
        </div>
    </section>  
</body>
</html>