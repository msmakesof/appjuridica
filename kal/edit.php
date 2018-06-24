<?php
include_once("../Connections/cnn_kn.php");
require_once('../Connections/config2.php'); 
include_once("php/functions.php");


$IdjqCal = 0;
$start = "";
if(isset($_GET['id'])) 
{ 
    $IdjqCal = $_GET["id"];
    $Id =$IdjqCal;
}


if(isset($_GET['start']) && $IdjqCal == 0) 
{ 
    $start = php2MySqlTime(js2PhpTime($_GET["start"]));
    //echo $start."<br>";
    //$start = date_format($start, 'd/m/Y H:i:s');
   //$start = php2MySqlTime(js2PhpTime($start));
    if(substr($start, 0,4) != '1970')
    {    
        //$start = php2MySqlTime(js2PhpTime($start));
        $start = substr($start,0,10);    
     }   
}
//echo $IdjqCal." ".$start;


$isadmin = "Y";
// if($IdjqCal == 0)
// {
//     // es nuevo
// }
// else
// {
//     getCalendarByRange($IdjqCal);
// }
$event = "";
?>
<script src="src/jquery.js" type="text/javascript"></script> 
<?php    

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_xclasever = "SELECT IdClase, Sede, Salon, Materia, Profesor, Nivel, Horario, desde, hasta, dia, nivel.NombreNivel, materia.NombreMateria FROM jqcalendar JOIN nivel ON jqcalendar.Nivel = nivel.IdNivel AND nivel.Estado = 1 JOIN materia ON jqcalendar.Materia = materia.IdMateria AND materia.Estado = 1 WHERE jqcalendar.Id = $IdjqCal  ;";            
$rs_xclasever = mysqli_query($cnn_kn,$query_rs_xclasever) or die(mysqli_error()."Err1...$query_rs_clasever");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_xclasever = mysqli_fetch_assoc($rs_xclasever);
$totalRows_rs_xclasever = mysqli_num_rows($rs_xclasever);
$materiasel = $row_rs_xclasever['Materia'];

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_suctabla = "SELECT IdSucursal, NombreSucursal FROM sucursal WHERE EstadoSucursal = 1 ORDER BY NombreSucursal;";
$rs_tipo_suctabla = mysqli_query($cnn_kn,$query_rs_tipo_suctabla) or die(mysqli_error()."$query_rs_tipo_suctabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_suctabla = mysqli_fetch_assoc($rs_tipo_suctabla);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_proftabla = "SELECT IdProfesor, concat_WS(' ', Nombres_PRO, Apellido1_PRO) as NombreProfesor FROM profesores WHERE Estado_PRO = '1' ORDER BY NombreProfesor;";
$rs_tipo_proftabla = mysqli_query($cnn_kn,$query_rs_tipo_proftabla) or die(mysqli_error()."$query_rs_tipo_proftabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_proftabla = mysqli_fetch_assoc($rs_tipo_proftabla);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_saltabla = "SELECT IdSalon, NombreSalon FROM salon WHERE Estado = 1 ORDER BY NombreSalon;";
$rs_tipo_saltabla = mysqli_query($cnn_kn,$query_rs_tipo_saltabla) or die(mysqli_error()."$query_rs_tipo_saltabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_saltabla = mysqli_fetch_assoc($rs_tipo_saltabla);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_nivtabla = "SELECT IdNivel, NombreNivel FROM nivel WHERE Estado = 1 ORDER BY NombreNivel;";
$rs_tipo_nivtabla = mysqli_query($cnn_kn,$query_rs_tipo_nivtabla) or die(mysqli_error()."$query_rs_tipo_nivtabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_mattabla = "SELECT IdMateria, NombreMateria FROM materia WHERE Estado = 1 ORDER BY NombreMateria;";
$rs_tipo_mattabla = mysqli_query($cnn_kn,$query_rs_tipo_mattabla) or die(mysqli_error()."$query_rs_tipo_mattabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_hortabla = "SELECT IdHorario, Inicio, Final FROM horario WHERE Estado = 1 ORDER BY Inicio, Final;";
$rs_tipo_hortabla = mysqli_query($cnn_kn,$query_rs_tipo_hortabla) or die(mysqli_error()."$query_rs_tipo_hortabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_hortabla = mysqli_fetch_assoc($rs_tipo_hortabla);


if($IdjqCal > 0)
{
    include_once("php/dbconfig.php");
    include_once("php/functions.php");
    function getCalendarByRange($IdjqCal){
      try{
        $db = new DBConnection();
        $db->getConnection();
        //$sql = "select * from `jqcalendar` where `id` = " . $id;
        $sql = "SELECT IdClase, Sede, Salon, Materia, Profesor, Nivel, Horario, desde, hasta, dia, IdEvento, Description,  nivel.NombreNivel, materia.NombreMateria FROM jqcalendar JOIN nivel ON jqcalendar.Nivel = nivel.IdNivel AND nivel.Estado = 1 JOIN materia ON jqcalendar.Materia = materia.IdMateria AND materia.Estado = 1 WHERE jqcalendar.Id = ".$IdjqCal ;
        mysql_query ("SET NAMES 'utf8'");
        mysql_set_charset('utf8');
        $handle = mysql_query($sql);
        //echo $sql;
        $row = mysql_fetch_object($handle);
    	}catch(Exception $e){
      }
      return $row;
    }
    if(isset($_GET["id"])){
      $event = getCalendarByRange($_GET["id"]);
    }
}    
?>
<!DOCTYPE html>
<html>
  <head>    
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">    
    <title>Detalles de la Programación de Horario</title>    
    <link href="css/main.css" rel="stylesheet" type="text/css" />       
    <link href="css/dp.css" rel="stylesheet" />    
    <link href="css/dropdown.css" rel="stylesheet" />    
    <link href="css/colorselect.css" rel="stylesheet" />

    <!-- -->
    <link href="../sweet/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">   
    <!-- -->
     
    <script src="src/jquery.js" type="text/javascript"></script>    
    <script src="src/Plugins/Common.js" type="text/javascript"></script>        
    <script src="src/Plugins/jquery.form.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.validate.js" type="text/javascript"></script>     
    <script src="src/Plugins/datepicker_lang_US.js" type="text/javascript"></script>        
    <script src="src/Plugins/jquery.datepicker.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.dropdown.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.colorselect.js" type="text/javascript"></script> 

    <!-- -->
    <script src="../sweet/sweetalert.min.js" type="text/javascript"></script>
    <link href="../cal/sample in bootstrap v3/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- -->
     
    <script type="text/javascript">
        if (!DateAdd || typeof (DateDiff) != "function") {
            var DateAdd = function(interval, number, idate) {
                number = parseInt(number);
                var date;
                if (typeof (idate) == "string") {
                    date = idate.split(/\D/);
                    eval("var date = new Date(" + date.join(",") + ")");
                }
                if (typeof (idate) == "object") {
                    date = new Date(idate.toString());
                }
                switch (interval) {
                    case "y": date.setFullYear(date.getFullYear() + number); break;
                    case "m": date.setMonth(date.getMonth() + number); break;
                    case "d": date.setDate(date.getDate() + number); break;
                    case "w": date.setDate(date.getDate() + 7 * number); break;
                    case "h": date.setHours(date.getHours() + number); break;
                    case "n": date.setMinutes(date.getMinutes() + number); break;
                    case "s": date.setSeconds(date.getSeconds() + number); break;
                    case "l": date.setMilliseconds(date.getMilliseconds() + number); break;
                }
                return date;
            }
        }
        function getHM(date)
        {
             var hour =date.getHours();
             var minute= date.getMinutes();
             var ret= (hour>9?hour:"0"+hour)+":"+(minute>9?minute:"0"+minute) ;
             return ret;
        }
        $(document).ready(function() {
            //debugger;
            var DATA_FEED_URL = "php/datafeed.php";
            var arrT = [];
            var tt = "{0}:{1}";            
            for (var i = 0; i < 24; i++) {
                arrT.push({ text: StrFormat(tt, [i >= 10 ? i : "0" + i, "00"]) }, { text: StrFormat(tt, [i >= 10 ? i : "0" + i, "30"]) });
            }
            $("#timezone").val(new Date().getTimezoneOffset()/60 * -1);
            
            
            $("#stparttime").dropdown({
                dropheight: 200,
                dropwidth:60,
                selectedchange: function() { },
                items: arrT
            });
            $("#etparttime").dropdown({
                dropheight: 200,
                dropwidth:60,
                selectedchange: function() { },
                items: arrT
            });
            

            var check = $("#IsAllDayEvent").click(function(e) {
                if (this.checked) {
                    $("#stparttime").val("00:00").hide();
                    $("#etparttime").val("00:00").hide();
                }
                else {
                    var d = new Date();
                    var p = 60 - d.getMinutes();
                    if (p > 30) p = p - 30;
                    d = DateAdd("n", p, d);
                    $("#stparttime").val(getHM(d)).show();
                    $("#etparttime").val(getHM(DateAdd("h", 1, d))).show();
                }
            });
           /*
            if (check[0].checked) {
                $("#stparttime").val("00:00").hide();
                $("#etparttime").val("00:00").hide();
            }
            */
            $("#Savebtn").click(function(){ 
                $("#fmEdit").submit(); 
            });

            $("#Closebtn").click(function() { 
                CloseModelWindow(); 
                window.location.href = "sample.php"; 
            });

            $("#Deletebtn").click(function() {
                 if (confirm("Está seguro de borrar esta Programación?")) {  
                    var param = [{ "name": "calendarId", value: 8}];                
                    $.post(DATA_FEED_URL + "?method=remove",
                        param,
                        function(data){
                              if (data.IsSuccess) {
                                    alert(data.Msg); 
                                    CloseModelWindow(null,true);
                                    window.location.href = "sample.php"; 
                                }
                                else {
                                    alert("Ocurrió Error.\r\n" + data.Msg);
                                }
                        }
                    ,"json");
                }
            });
            
           $("#stpartdate,#etpartdate").datepicker({ picker: "<button class='calpick'></button>"});    
            var cv =$("#colorvalue").val() ;
            if(cv=="")
            {
                cv="-1";
            }
            $("#calendarcolor").colorselect({ title: "Color", index: cv, hiddenid: "colorvalue" });
            //to define parameters of ajaxform
            var options = {
                beforeSubmit: function() {
                    return true;
                },
                dataType: "json",
                success: function(data) {
                    swal("Good job!", "You clicked the button!", "success");
                    alert('Atencion: '+data.Msg); 

                    if (data.IsSuccess) {                        
                        
                        //  swal({
                        //   title: "Grabado...",
                        //   text: "un momento por favor.",
                        //   imageUrl: "../sweet/ok.png",
                        //   timer: 2000,
                        //   showConfirmButton: false
                        // });
                         CloseModelWindow(null,true); 
                        window.location.href = "sample.php"; 
                    }
                }
            };
            $.validator.addMethod("date", function(value, element) {                             
                var arrs = value.split(i18n.datepicker.dateformat.separator);
                var year = arrs[i18n.datepicker.dateformat.year_index];
                var month = arrs[i18n.datepicker.dateformat.month_index];
                var day = arrs[i18n.datepicker.dateformat.day_index];
                var standvalue = [year,month,day].join("-");
                return this.optional(element) || /^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3-9]|1[0-2])[\/\-\.](?:29|30))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3,5,7,8]|1[02])[\/\-\.]31)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:16|[2468][048]|[3579][26])00[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1-9]|1[0-2])[\/\-\.](?:0?[1-9]|1\d|2[0-8]))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?:\d{1,3})?)?$/.test(standvalue);
            }, "Invalid date format");
            $.validator.addMethod("time", function(value, element) {
                return this.optional(element) || /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])$/.test(value);
            }, "Invalid time format");
            $.validator.addMethod("safe", function(value, element) {
                return this.optional(element) || /^[^$\<\>]+$/.test(value);
            }, "$<> not allowed");
            $("#fmEdit").validate({
                submitHandler: function(form) { $("#fmEdit").ajaxSubmit(options); },
                errorElement: "div",
                errorClass: "cusErrorPanel",
                errorPlacement: function(error, element) {
                    showerror(error, element);
                }
            });
            function showerror(error, target) {
                var pos = target.position();
                var height = target.height();
                var newpos = { left: pos.left, top: pos.top + height + 2 }
                var form = $("#fmEdit");             
                error.appendTo(form).css(newpos);
            }


            window.addEventListener('load', function(){ $('#nivel').trigger('change');}, false);


             //$("#nivel").on("change", function(){
                $("#nivel").change(function(){
                var x = $("#nivel").val(); 
                var mat = $("#materia").val();
                var idjqcal = "<?php echo $IdjqCal;?>" ;
                $.ajax({
                    //this is the php file that processes the data 
                    url: "vertemaxnivel.php",
                    //GET method is used
                    type: "POST",
                    data: "pars="+x+"&mat="+mat+"&idjqcal="+idjqcal, 
                    beforeSend: function() {
                      $("#selmateria").html("cargando...");
                    },
                    success: function (lista) {
                        $("#materia").html(lista);
                    },
                    error: function () {            
                        swal({
                          title: "Error:  No se pudo establecer comunicación...",
                          text: "un momento por favor.",
                          imageUrl: "../sweet/2.gif",
                          timer: 2000,
                          showConfirmButton: false
                        });
                        return false;                       
                    }  
                });
            });
        });
    </script>      
    <style type="text/css">     
    .calpick     {        
        width:16px;   
        height:16px;     
        border:none;        
        cursor:pointer;        
        background:url("sample-css/cal.gif") no-repeat center 2px;        
        margin-left:-22px;    
    }      
    </style>
  </head>
  <body>    
    <div>      
      <div class="toolBotton">           
        <a id="Savebtn" class="imgbtn" href="javascript:void(0);">                
          <span class="Save"  title="Guardar Programamción">Guardar(<u>G</u>)
          </span>          
        </a>                           
        <?php if(isset($event)){ ?>
        <a id="Deletebtn" class="imgbtn" href="javascript:void(0);">                    
          <span class="Delete" title="Borrar Programamción">Borrar(<u>B</u>)
          </span>                
        </a>             
        <?php } ?>            
        <a id="Closebtn" class="imgbtn" href="javascript:void(0);">                
          <span class="Close" title="Cerrar la Ventana" >Cerrar
          </span></a>            
        </a>        
      </div>                  
      <div style="clear: both">         
      </div>        
      <div class="infocontainer"> 
        <?php 
            //echo "jqcal.....$IdjqCal<br>";
            if($IdjqCal == 0)
            {
        ?>
                <form action="php/datafeed.php?method=adddetails<?php echo $event?"&id=".$event->Id:""; ?>&stpartdate=<?php echo $start; ?>" class="fform" id="fmEdit" method="post">
        <?php         
            }
            else
            {    
        ?>
                <form action="php/datafeed.php?method=adddetails<?php echo $event?"&id=".$IdjqCal:""; ?>&stpartdate=<?php echo $start; ?>" class="fform" id="fmEdit" method="post">
        <?php
            }
        ?>    
        <!-- ini -- >   
        <label>                    
            <span>                        * Sede:              
            </span>                    
            <!-- <div id="calendarcolor"></div> -->
                <select name="sede" id="sede" class="form-control">

                <?php 
                if($IdjqCal > 0)
                {
                ?>
                    <option value="" <?php if (!(strcmp("", $event->Sede))) {echo "selected=\"selected\"";} ?>>Seleccione Sede</option>
                    <option value="" <?php if (!(strcmp("", $event->Sede))) {echo "selected=\"selected\"";} ?>>------------</option>
                <?php 
                } 
                else
                {
                ?>
                    <option value="">Seleccione Sede</option>
                    <option value="">------------</option>
                <?php 
                } 
                ?>
                <?php
                    do {  
                ?>
                <?php
                if($IdjqCal > 0)
                {
                ?>
                        <option value="<?php echo $row_rs_tipo_suctabla['IdSucursal']?>"<?php if (!(strcmp($row_rs_tipo_suctabla['IdSucursal'], $event->Sede))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_suctabla['NombreSucursal']?></option>
                <?php
                }
                else
                {    
                ?>
                        <option value="<?php echo $row_rs_tipo_suctabla['IdSucursal']?>"><?php echo $row_rs_tipo_suctabla['NombreSucursal']?></option>
                <?php
                }    
                ?>
                <?php
                    } while ($row_rs_tipo_suctabla = mysqli_fetch_assoc($rs_tipo_suctabla));
                        $rows = mysqli_num_rows($rs_tipo_suctabla);
                        if($rows > 0) {
                            mysqli_data_seek($rs_tipo_suctabla, 0);
                            $row_rs_tipo_suctabla = mysqli_fetch_assoc($rs_tipo_suctabla);
                        }
                ?>
                </select><div id="info_sede"></div>                
        </label> 

         <label>                    
            <span>                        * Profesor:
            </span>                    
            <select name="profesor" id="profesor" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly"  <?php } ?>>
            <?php 
            if($IdjqCal > 0)
            {
            ?>
                <option value="" <?php if (!(strcmp("", $event->Profesor))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
                <option value="" <?php if (!(strcmp("", $event->Profesor))) {echo "selected=\"selected\"";} ?>>------------</option>
            <?php
            }
            else
            {
            ?>    
                <option value="">Seleccione</option>
                <option value="">------------</option>
            <?php 
            }
            ?>
            <?php
                do {  
            ?>
            <?php
            if($IdjqCal > 0)
            {
            ?>
                <option value="<?php echo $row_rs_tipo_proftabla['IdProfesor']?>"<?php if (!(strcmp($row_rs_tipo_proftabla['IdProfesor'], $event->Profesor))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_proftabla['NombreProfesor']?></option>
            <?php
            }
            else
            {
            ?>  
                <option value="<?php echo $row_rs_tipo_proftabla['IdProfesor']?>"><?php echo $row_rs_tipo_proftabla['NombreProfesor']?></option>
            <?php
            }
                } while ($row_rs_tipo_proftabla = mysqli_fetch_assoc($rs_tipo_proftabla));
                    $rows = mysqli_num_rows($rs_tipo_proftabla);
                    if($rows > 0) {
                        mysqli_data_seek($rs_tipo_proftabla, 0);
                        $row_rs_tipo_proftabla = mysqli_fetch_assoc($rs_tipo_proftabla);
                    }
            ?>
            </select>
            <div id="info_profesor"></div>                
          </label> 

          <label>                    
            <span>                        * Salón:
            </span>                               
            <select name="salon" id="salon" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly"  <?php } ?>>
            <?php
            if($IdjqCal > 0)
            {
            ?>
                <option value="" <?php if (!(strcmp("", $event->Salon))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
                <option value="" <?php if (!(strcmp("", $event->Salon))) {echo "selected=\"selected\"";} ?>>------------</option>
            <?php
            }
            else
            {    
            ?>   
                <option value="">Seleccione</option>
                <option value="">------------</option>
            <?php
            }
            
            do {  
            ?>
                <?php                
                if($IdjqCal > 0)
                {
                ?>    
                <option value="<?php echo $row_rs_tipo_saltabla['IdSalon']?>"<?php if (!(strcmp($row_rs_tipo_saltabla['IdSalon'], $event->Salon))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_saltabla['NombreSalon']?></option>
                <?php 
                }
                else
                {    
                ?>        
                <option value="<?php echo $row_rs_tipo_saltabla['IdSalon']?>"><?php echo $row_rs_tipo_saltabla['NombreSalon']?>
                </option>
            <?php
                }
            ?>     
                <?php
                } while ($row_rs_tipo_saltabla = mysqli_fetch_assoc($rs_tipo_saltabla));
                    $rows = mysqli_num_rows($rs_tipo_saltabla);
                    if($rows > 0) {
                        mysqli_data_seek($rs_tipo_saltabla, 0);
                        $row_rs_tipo_saltabla = mysqli_fetch_assoc($rs_tipo_saltabla);
                    }
            ?>
            </select>
            <div id="info_salon"></div>              
          </label>  

           <label>                    
          <span>                        * Horario:
          </span>                    
          <select name="horario" id="horario" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly" <?php } ?>>
            <?php
            if($IdjqCal > 0)
            {
            ?>
                <option value="" <?php if (!(strcmp("", $event->Horario))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
                <option value="" <?php if (!(strcmp("", $event->Horario))) {echo "selected=\"selected\"";} ?>>------------</option>
            <?php
            }
            else
            {    
            ?>
                <option value="">Seleccione</option>
                <option value="">------------</option>
            <?php
            }
            ?>    
            <?php
            do {  
            ?>
            
            <?php
            if($IdjqCal > 0)
            {
            ?>
                <option value="<?php echo $row_rs_tipo_hortabla['IdHorario']?>"<?php if (!(strcmp($row_rs_tipo_hortabla['IdHorario'], $event->Horario))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_hortabla['Inicio'].' - '. $row_rs_tipo_hortabla['Final'] ;?></option>
            <?php
            }
            else
            {
            ?>
            <option value="<?php echo $row_rs_tipo_hortabla['IdHorario']?>"><?php echo $row_rs_tipo_hortabla['Inicio'].' - '. $row_rs_tipo_hortabla['Final'] ;?></option>
            <?php
            }

            } while ($row_rs_tipo_hortabla = mysqli_fetch_assoc($rs_tipo_hortabla));
                $rows = mysqli_num_rows($rs_tipo_hortabla);
                if($rows > 0) {
                    mysqli_data_seek($rs_tipo_hortabla, 0);
                    $row_rs_tipo_hortabla = mysqli_fetch_assoc($rs_tipo_hortabla);
                }
            ?>
            </select>              
          </label>

          <label>                    
            <span>                        * Nivel:
            </span>                    
            <select name="nivel" id="nivel" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly" <?php } ?>>
            <?php
            if($IdjqCal > 0)
            {
            ?>                
                <option value="" <?php if (!(strcmp("", $event->Nivel))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
                <option value="" <?php if (!(strcmp("", $event->Nivel))) {echo "selected=\"selected\"";} ?>>------------</option>
            <?php
            }
            else
            {    
            ?>
                <option value="">Seleccione</option>
                <option value="">------------</option>
            <?php
            }
            ?>    
            <?php
            do {  
            ?>
            <?php
            if($IdjqCal > 0)
            {
            ?>
                <option value="<?php echo $row_rs_tipo_nivtabla['IdNivel']?>"<?php if (!(strcmp($row_rs_tipo_nivtabla['IdNivel'], $event->Nivel))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_nivtabla['NombreNivel']?></option>
            <?php
            }
            else
            {    
            ?>

                <option value="<?php echo $row_rs_tipo_nivtabla['IdNivel']?>"><?php echo $row_rs_tipo_nivtabla['NombreNivel']?>
                </option>

            <?php
            }

            } while ($row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla));
                $rows = mysqli_num_rows($rs_tipo_nivtabla);
                if($rows > 0) {
                    mysqli_data_seek($rs_tipo_nivtabla, 0);
                    $row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla);
                }
            ?>
            </select>              
          </label>
          <label>                    
            <span>                        * Topic:
            </span>                    
            <select name="materia" id="materia" class="form-control">                   
            </select>              
          </label>
          <div id="Msg"></div>   
        <!-- fin -- >                           
          <input id="timezone" name="timezone" type="hidden" value="" /> 
          <input id="stpartdate" name="stpartdate" type="hidden" value="<?php echo $start; ?>" /> 
          <input id="etpartdate" name="etpartdate" type="hidden" value="<?php echo $start; ?>" />  

        </form>         
      </div>         
    </div>
  </body>
</html>
<?php
mysqli_free_result($rs_tipo_suctabla);
mysqli_free_result($rs_tipo_proftabla);
mysqli_free_result($rs_tipo_saltabla);
mysqli_free_result($rs_tipo_hortabla);
mysqli_free_result($rs_xclasever);
mysqli_free_result($rs_tipo_mattabla);
mysqli_free_result($rs_tipo_nivtabla);
?>