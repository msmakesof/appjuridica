﻿<?php 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
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
$NombreTabla ="JUZGADO";
$idTabla = 0;
require_once('../../apis/general/ciudad.php');
require_once('../../apis/general/piso.php');
require_once('../../apis/general/tipojuzgado.php');
require_once('../../apis/general/area.php');

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
    <!-- <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" /> -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" />
    

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- mks 20170128
    <link rel="stylesheet" href="../../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../../css/themes2/alertify.default.css" id="toggleCSS" /> -->
    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery-2.1.1.js"></script>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>
    

    <!-- Sweet Alert Plugin Js -->
    <!--  <script src="../../plugins/sweetalert/sweetalert.min.js"></script> -->
    <script src="../../js/sweet/functions.js"></script>
    <script src="../../js/sweet/sweetalert.min.js"></script>
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>


    

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js" />

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

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->

    
</head>

<body class="theme-indigo">
      
     <section class="content" style="margin-top:15px;">
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
                        <!--<div class="header">
                            <h2>REGISTRO DE TABLAS.</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>                                    
                                </li>
                            </ul>
                        </div>-->
                        <div class="body">
                            <form id="form_validation" method="POST">

                                <div style="form-group form-float"> 
                                    <label class="form-label">
                                        Tipo Corporaci&oacute;n
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="tipojuzgado" id="tipojuzgado" required>
                                            <option value="" >Seleccione Corporaci&oacute;n...</option>
                                            <?php
                                                for($i=0; $i<count($mtipojuzgado['juz_tipojuzgado']); $i++)
                                                {
                                                    $TJU_IdTipoJuzgado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_IdTipoJuzgado'];                                                    
                                                    $TJU_Nombre = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Nombre'];
                                                    $TJU_Estado = $mtipojuzgado['juz_tipojuzgado'][$i]['TJU_Estado'];
                                            ?>
                                                    <option value="<?php echo $TJU_IdTipoJuzgado; ?>" >
                                                        <?php echo $TJU_Nombre ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
								
								<div style="form-group form-float">                                     
                                    <label class="form-label">
                                    Especialidad - Area
                                    </label>                                    
                                    <div class="col-sm-4">
                                        <!-- <div class="con-json"> -->
                                       <!-- <select id="area" name="area" class="selectpicker show-tick" data-live-search="true" data-width="80%" required>
                                            <option value="">-- Seleccione Especializacion.... --</option>
                                            <div id="divarea"></div>
                                        </select> -->
                                        <!-- <select id="area" class="selectpicker show-tick" data-live-search="true" data-width="80%" required>
                                        </select> -->                                           

                                                    
                                        <!-- </div> -->
                                        <select id="xarea" name="xareax" class="selectpicker show-tick" data-live-search="true" data-width="80%" required>
                                       <!-- <option value="">-- Seleccione Especializacion.... --</option> -->
                                        </select> 
                                    </div>                                    
                                </div>
                                
                                                                  
                                

                                <div class="form-group form-float" style="clear:both;">
                                    <label class="form-label">N&uacute;mero Despacho</label>
                                    <div class="form-line">                                        
                                        <input type="text" class="form-control" name="ubicacion" id="ubicacion" value="" maxlength="3" required>                                    
                                    </div>
                                </div>								
								
                                <div style="form-group form-float" style="clear:both;">                                     
                                    <label class="form-label" style="text-align:left;">
                                        Ciudad
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="ciudad" id="ciudad" required>
                                            <option value="" >Seleccione Ciudad...</option>
                                            <?php
                                                for($i=0; $i<count($mciudad['gen_ciudad']); $i++)
                                                {
                                                    $CIU_IdCiudades = $mciudad['gen_ciudad'][$i]['CIU_IdCiudades'];                                                    
                                                    $CIU_Nombre = $mciudad['gen_ciudad'][$i]['CIU_Nombre'];
                                                    $CIU_Estado = $mciudad['gen_ciudad'][$i]['CIU_Estado'];
                                            ?>
                                                    <option value="<?php echo $CIU_IdCiudades; ?>" >
                                                        <?php echo $CIU_Nombre ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                

                                <div class="form-group form-float" style="clear: both;">
                                    <label class="form-label">Direcci&oacute;n</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="" required>
                                       <!-- -->
                                    </div>
                                </div>


                                <div style="form-group form-float">                                     
                                    <label class="form-label">
                                        Piso
                                    </label>                                    
                                    <div class="col-sm-4">                                       
                                        <select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="piso" id="piso" required>
                                            <option value="" >Seleccione Opción...</option>
                                            <?php
                                                for($i=0; $i<count($mpiso['juz_piso']); $i++)
                                                {
                                                    $PIS_IdPiso = $mpiso['juz_piso'][$i]['PIS_IdPiso'];                                                    
                                                    $PIS_Nombre = $mpiso['juz_piso'][$i]['PIS_Nombre'];
                                                    $PIS_Estado = $mpiso['juz_piso'][$i]['PIS_Estado'];
                                            ?>
                                                    <option value="<?php echo $PIS_IdPiso; ?>" >
                                                        <?php echo $PIS_Nombre ; ?>                                                
                                                    </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    Fruit:
                                    <select name="xname" id="xfruitName">
                                        <option value="3">Apple</option>
                                        <option value="4">Banana</option>
                                        <option value="8">Orange</option>
                                        <option value="9">Pear</option>
                                    </select>
                                    Variety:
                                    <select name="xvariety" id="xfruitVariety">
                                    </select>
                                </div>
                                
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Estado</label>
                                    <input type="radio" name="estado" id="activo" class="with-gap" value="1">
                                    <label for="activo">Activo</label>

                                    <input type="radio" name="estado" id="inactivo" class="with-gap" value="2">
                                    <label for="inactivo" class="m-l-20">Inactivo</label>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit" id="grabar">GRABAR</button>

                                <!-- <div id="g" class='alert'>GRabado</div> -->
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

  <script type="text/javascript">
    var nombre ="";
    var id ='';

    function populateFruitVariety() {   
        // $.getJSON('../tables/urlink.php', { funcion: "ja", origen:$('#tipojuzgado').val()}, function(data) {
        //     var zzz = data.juz_areasxtipojuzgado;
        //     var select = $('#xarea');
        //     var options = select.prop('options');
        //     $('option', select).remove();

        //     $.each(zzz, function(index, array) {
        //         options[options.length] = new Option(array['variety']);
        //     });

        // });

        $.getJSON('../tables/urlink.php', {funcion: "ja", origen: $('#tipojuzgado').val()}, function (data) {
            var zdata= data.juz_areasxtipojuzgado;
            var selectedOption = '0';
            var newOptions = zdata;
            var select = $('#xarea');
            if(select.prop) 
            {
                var options = select.prop('options');
            }
            else 
            {
                var options = select.attr('options');
            }
            $('option', select).remove();

            $.each(newOptions, function(val, text) {
                options[options.length] = new Option(text.ARE_Nombre, val.ARE_IdArea);
            });
            select.val(selectedOption);
        });

    }

    function fpopulateFruitVariety() {
        /*
        $.getJSON('fruit-varities.php', {fruitName: $('#fruitName').val()}, function (data) {	
            ---/* ok
            var select = $('#fruitVariety');
            var options = select.prop('options');
            $('option', select).remove();

            $.each(data, function (index, array) {
                options[options.length] = new Option(array['variety']);
            });
            ---/ ---
            var selectedOption = '1';
            var newOptions = data;
            var select = $('#fruitVariety');
            if(select.prop) {
            var options = select.prop('options');
            }
            else {
            var options = select.attr('options');
            }
            $('option', select).remove();

            $.each(newOptions, function(val, text) {
                options[options.length] = new Option(text.variety, val.fruit_id);
            });
            select.val(selectedOption);

        });
        */


        $.getJSON('../tables/urlink.php', {funcion: "ja", origen: $('#tipojuzgado').val()}, function (data) {
            var zdata= data.juz_areasxtipojuzgado;
            var selectedOption = '0';
            var newOptions = zdata;
            var select = $('#xfruitVariety');
            if(select.prop) {
            var options = select.prop('options');
            }
            else {
            var options = select.attr('options');
            }
            $('option', select).remove();

            $.each(newOptions, function(val, text) {
                options[options.length] = new Option(text.ARE_Nombre, val.ARE_IdArea);
            });
            select.val(selectedOption);
        });


        }

    $(document).ready(function()
    {       
        $("#msj").hide();
        $("#ubicacion").numeric(); 
        $("#piso").numeric();
        //$('.selectpicker').selectpicker();
        //$("#area").prop('disabled', true);


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

        
        //populateFruitVariety();
        $('#tipojuzgado').change(function() {
            populateFruitVariety();
        });


        $('#xfruitName').change(function () {
            fpopulateFruitVariety();
        });
        

        
        $("#vvtipojuzgado").on('change', function () {
            var options ='<select id="xarea" class="selectpicker show-tick" data-live-search="true" data-width="80%" required>';
            var id_category = $(this).val();                                                   
            $("#area").empty();
            $.getJSON('urlareaxjuzgado.php?id='+id_category,function(data){
                console.log(data);
                $.each(data, function(id,value){
                    //$("#area").html('<option value="'+id+'">'+value+'</option>');
                    options += '<option value="'+id+'">'+value+'</option>';
                });
                options +='</select>';
                $("div#area").html(options);
                console.log(options);
            });           
        });        

       
        $( "#mtipojuzgado" ).on( "change", function() {
        var intId=$(this).val();
        var datos = {id: intId};          //{ funcion: "ja", origen: intId };
        var url= 'urlareaxjuzgado.php';   //'../tables/urlink.php';

        var request = $.ajax
        ({
            url: url,
            method: 'GET',
            data: datos,
            dataType: 'html'
        });

        request.done(function( respuesta ) 
        {
            //console.log(respuesta);
            if(!respuesta.hasOwnProperty('error'))
            {
                // $.each(respuesta, function(k, v) {
                //     if (k != "estado")
                //     {
                //         for(i=0; i< v.length ; i++)
                //         {
                //             var vARE_IdArea = v[i].ARE_Codigo;
                //             var vARE_Nombre = v[i].ARE_Nombre;
                //             $('#area').append('<option value="' + vARE_IdArea + '">' + vARE_Nombre + '</option>');
                //         }
                //     }    
                // });
                
                $('#xarea').html(respuesta);
                //$('#xarea').trigger('change');
                //alert(respuesta);

                var newOptions = {
                '1' : 'Red',
                '2' : 'Blue',
                '3' : 'Green',
                '4' : 'Yellow'
            };
            var selectedOption = 'green';

            var select = $('#xarea');
            if(select.prop) {
            var options = select.prop('options');
            }
            else {
            var options = select.attr('options');
            }
            $('option', select).remove();

            $.each(newOptions, function(val, text) {
                options[options.length] = new Option(text, val);
            });
            select.val(selectedOption);
            }
            else
            {
                //Puedes mostrar un mensaje de error en algún div del DOM
            }
        });

        request.fail(function( jqXHR, textStatus ) 
        {
            alert( "Hubo un error: " + textStatus );
        });

    });
        
        $("#xxtipojuzgado").on('change', function(e) {
            var _tipojuzgado = $("#tipojuzgado").val();
            var option = '';
            $.ajax({
                url: "../tables/urlink.php",
                method: "GET",
                data: {funcion: "ja", origen: _tipojuzgado},
                //dataType: "html",
                success: function(data) {                    
                    var zz =JSON.parse(data);
                    
                    //$.each(data, function(id,value){
                        //if(id=="juz_areasxtipojuzgado")
                        //{
                            var zzz = zz.juz_areasxtipojuzgado;
                            
                            //$("#area")[0].appendTo('<option value="">Seleccione Despacho...</option>');
                            //option += '<option value="">Seleccione Despacho...</option>';

                            option +='<select class="selectpicker show-tick" data-live-search="true" data-width="80%" name="tipojuzgado" id="tipojuzgado" required>';
                            option +='<option value="" >Seleccione Corporaci&oacute;n...</option>';
                            option +='<?php
                                        for($i=0; $i<count($mtipojuzgado["juz_tipojuzgado"]); $i++)
                                        {
                                            $TJU_IdTipoJuzgado = $mtipojuzgado["juz_tipojuzgado"][$i]["TJU_IdTipoJuzgado"];                                                    
                                            $TJU_Nombre = $mtipojuzgado["juz_tipojuzgado"][$i]["TJU_Nombre"];
                                            $TJU_Estado = $mtipojuzgado["juz_tipojuzgado"][$i]["TJU_Estado"];
                                        ?>';
                                            option +='<option value="<?php echo $TJU_IdTipoJuzgado; ?>" >';
                                            option +='<?php echo $TJU_Nombre ; ?>';
                                            option +='</option>';
                            option +='<?php } ?>';
                            option +='</select>';

                            // $.each(zzz, (key, value) => {
                            //     $("<option/>", {
                            //         "value": key,
                            //         "text": value
                            //     }).appendTo($("#area"));
                            // });
                            

                            //for(var i=0; i < zzz.length; i++)
                            // {
                            //     var ARE_IdArea = zz[i].ARE_IdArea;
                            //     var ARE_Nombre = zz[i].ARE_Nombre;
                            //     option +="<option value='" + ARE_IdArea + "'>" + ARE_Nombre + "</option>";
                            //     //$(newRow).appendTo("#area");
                            //     $("#area").append('<option value="' + ARE_IdArea + '">' + ARE_Nombre + '</option>');
                            //     //$("#area")[0].append($('<option', {value: ARE_IdArea , text: ARE_Nombre} ));
                            // }
                            //$('#area')[0].append(option);
                            $("div#divarea").html(option);
                            //$("#area")[0];
                            //$("#area").prop('disabled', false);
                            //$("#area").html('<select id="area" class="selectpicker show-tick" data-live-search="true" data-width="80%" name="area" required>'+option+'</select>');
                        //}    
                    //});
                }
            });
            
        });

       

        $("#grabar").on('click', function(e) { 
            var ubicacion = $("#ubicacion").val();
            ubicacion = ubicacion.toUpperCase();
            var ciudad = $("#ciudad").val();
            var direccion = $("#direccion").val();
            var piso = $("#piso").val();            
            var tipojuzgado = $("#tipojuzgado").val();
            var area = $("#area").val();            
            var estado = $('input:radio[name=estado]:checked').val();
            e.preventDefault();

            if( ubicacion == "" || ciudad =="" || direccion == "" || piso == "" || tipojuzgado == "" || area == "" || estado == undefined )
            {
                swal({
                  title: "Error:  Ingrese información en todos los campos...",
                  text: "un momento por favor.",
                  imageUrl: "../../js/sweet/2.gif",
                  timer: 1500,
                  showConfirmButton: false
                });
                return false;
            }

            else
            {
                $.ajax({
                    data : {"ubicacion": ubicacion, "ciudad": ciudad, "direccion": direccion, "piso": piso, "tipojuzgado": tipojuzgado, "area": area, "estado": estado}, 
                    type: "POST",
                    dataType: "html",
                    url : "crea_<?php echo strtolower($NombreTabla); ?>.php",
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
                        //$('#form_validation')[0].reset();
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
    </script>    
</body>

</html>