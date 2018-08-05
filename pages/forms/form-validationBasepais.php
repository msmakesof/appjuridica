<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
else
{
    header('Location: ../../index.html');
}
$NombreTabla ="PAIS";
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


    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

   

<!-- mks 20170128
    <link rel="stylesheet" href="../../css/themes2/alertify.core.css" />
    <link rel="stylesheet" href="../../css/themes2/alertify.default.css" id="toggleCSS" /> -->



 <!-- Jquery Core Js -->
    <!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    


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

    <!--  <script src="../../js/alertify.min.js"></script> -->

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

        
        $("#grabar").on('click', function(e) { 
           
            //var nombremostrar = $("#nombremostrar").val();
            var nombre = $("#nombre").val();
            nombre = nombre.toUpperCase();
            var estado = $('input:radio[name=estado]:checked').val();
            e.preventDefault();
            if( estado == undefined || nombre == "" )
            {                 
                swal("Atencion:", "Debe digitar un Nombre y/o seleccionar un Estado.");
                e.stopPropagation();
                return false;
            }

            else
            {
                $.ajax({
                    data : {"pnombre": nombre, "pestado": estado},
                    type: "POST",
                    dataType: "html",
                    url : "crea_pais.php",
                })  
                .done(function( data, textStatus, jqXHR){                  
                    var xrespstr = data.trim();
                    var respstr = xrespstr.substr(0,1);
                    var msj = xrespstr.substr(2);
                    if(respstr == "E")
                    {         
                        swal("Atencion:", msj);
                    }
                    else
                    {    
                        if( respstr == "S" )
                        {                        
                            swal("Atencion: ", msj, "success");
                            return false;
                        }
                        else
                        {
                           swal({
                                title: "Atencion: ",   
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
            alertify.alert("Pais: "+ parnombre +" !Ya se encuentra registrada.");
             $("#msj").html("Echo....");
        }
    </script>    
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
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nombre"id="nombre" required>
                                        <label class="form-label">Nombre:</label>
                                    </div>
                                </div>      
                                <!-- <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nombremostrar"id="nombremostrar" required>
                                        <label class="form-label">Nombre a Mostrar:</label>
                                    </div>
                                </div>                                -->
                                
                                <div class="form-group">
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
                <div id="msj"></div>
             </div>
        </div>
    </section>  
</body>
</html>