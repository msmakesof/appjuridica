<?php
include_once("../../Connections/cnn_plan_mejora.php");
//require_once("../../sesion.class.php");
//$sesion = new sesion();
//$usuario = $sesion->get("usuario");

//if( $usuario == false )
//{	
//	header("Location: ../../index.php");		
//}
//else 
//{
?>
	 <script src="src/jquery.js" type="text/javascript"></script> 
<?php	 

	/////////  PRIVILEGIOS  ////////////
	$colname_rs_privilegios = $usuario;
	//echo $colname_rs_privilegios;
	$colname_rs_privilegios = "-1";
	if (isset($usuario)) {
		$colname_rs_privilegios = $usuario;
	}

    mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
    $query_rs_privilegios = "SELECT nombreEmp, cod_suc, control, graba, modifica, consulta, borra, racolp, admin FROM empleados WHERE usuario = '$colname_rs_privilegios'";
    $rs_privilegios = mysql_query($query_rs_privilegios, $cnn_plan_mejora) or die(mysql_error());
    $row_rs_privilegios = mysql_fetch_assoc($rs_privilegios);
    $totalRows_rs_privilegios = mysql_num_rows($rs_privilegios);			
    			
    $isadmin = $row_rs_privilegios["admin"];
    $racolss = $row_rs_privilegios["racolp"];

    //echo "admin...............$isadmin<br>";
    mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
    $query_rs_ta = "SELECT * FROM tipo_auditoria WHERE estado ='A';";
    $rs_ta = mysql_query($query_rs_ta, $cnn_plan_mejora) or die(mysql_error());
    $row_rs_ta = mysql_fetch_assoc($rs_ta);
    $totalRows_rs_ta = mysql_num_rows($rs_ta);
    mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');


    mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
    $query_rs_au = "SELECT * FROM auditoria;";
    $rs_au = mysql_query($query_rs_au, $cnn_plan_mejora) or die(mysql_error());
    $row_rs_au = mysql_fetch_assoc($rs_au);
    $totalRows_rs_au = mysql_num_rows($rs_au);
    mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');


    mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
    $query_rs_lc = "SELECT * FROM listachqxtipoaudit;";
    $rs_lc = mysql_query($query_rs_lc, $cnn_plan_mejora) or die(mysql_error());
    $row_rs_lc = mysql_fetch_assoc($rs_lc);
    $totalRows_rs_lc = mysql_num_rows($rs_lc);
    mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');

    include_once("php/dbconfig.php");
    include_once("php/functions.php");
    function getCalendarByRange($id)
    {
        try{
			$db = new DBConnection();
			$db->getConnection();
			//$sql = "select * from jqcalendar where id = " . $id;	
			 $sql = "select jqcalendar.*, dirigido_hacia.proceson, medios.nombre as nommedio from jqcalendar join tipo_auditoria on tipo_auditoria.cod_ti_audit = jqcalendar.tipo_auditoria join auditoria on auditoria.id = jqcalendar.auditoria join listachqxtipoaudit on listachqxtipoaudit.id_listacheq = jqcalendar.listachq left join procesos dirigido_hacia on dirigido_hacia.abr2 = jqcalendar.dirigido_a and dirigido_hacia.estado = 'A' left join medios on medios.id = jqcalendar.medio where jqcalendar.id = " . $id;
			mysql_query ("SET NAMES 'utf8'");
			mysql_set_charset('utf8');
			$handle = mysql_query($sql);
			//echo $sql;
			$row = mysql_fetch_object($handle);
    	}
        catch(Exception $e)
        {
        }
      return $row;
    }
    
    if($_GET["id"])
    {
      $event = getCalendarByRange($_GET["id"]);
    }

mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_adj = "SELECT * FROM tbl_temp_files_act WHERE idpm=".$_GET["id"]."; ";
$rs_adj = mysql_query($query_rs_adj, $cnn_plan_mejora) or die(mysql_error());
$row_rs_adj = mysql_fetch_assoc($rs_adj);
$totalRows_rs_adj = mysql_num_rows($rs_adj);

$temanombre = "";
?>
<!DOCTYPE html>
<html>
  <head>    
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">    
    <title>Detalle de la Novedad</title>    
    <link href="css/main.css" rel="stylesheet" type="text/css" />       
    <link href="css/dp.css" rel="stylesheet" />    
    <link href="css/dropdown.css" rel="stylesheet" />    
    <link href="css/colorselect.css" rel="stylesheet" />   
     
	<link rel="stylesheet" href="../../tinybox2/style.css" />
    <script type="text/javascript" src="../../tinybox2/tinybox.js"></script>
      
		<!-- <script src="http://dev.powelltechs.com/jquery.readonly/www/trunk/jquery.readonly.js"></script>
     <link rel="stylesheet" href="http://dev.powelltechs.com/jquery.readonly/www/trunk/jquery.readonly.css" type="text/css">--> 
			
    <script src="src/Plugins/Common.js" type="text/javascript"></script>        
    <script src="src/Plugins/jquery.form.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.validate.js" type="text/javascript"></script>     
    <script src="src/Plugins/datepicker_lang_ES.js" type="text/javascript"></script>        
    <script src="src/Plugins/jquery.datepicker.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.dropdown.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.colorselect.js" type="text/javascript"></script>    
     
    <script type="text/javascript">
        if (!DateAdd || typeof (DateDiff) != "function") 
        {
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
            for (var i = 0; i < 24; i++) 
            {
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
                if (this.checked) 
                {
                    $("#stparttime").val("00:00").hide();
                    $("#etparttime").val("00:00").hide();
                }
                else 
                {
                    var d = new Date();
                    var p = 60 - d.getMinutes();
                    if (p > 30) p = p - 30;
                    d = DateAdd("n", p, d);
                    $("#stparttime").val(getHM(d)).show();
                    $("#etparttime").val(getHM(DateAdd("h", 1, d))).show();
                }
            });
            if (check[0].checked) 
            {
                $("#stparttime").val("00:00").hide();
                $("#etparttime").val("00:00").hide();
            }
            $("#Savebtn").click(function() { $("#fmEdit").submit(); });
            $("#Closebtn").click(function() { CloseModelWindow(); });
            $("#Deletebtn").click(function() {
                if (confirm("Está seguro que desea borrar esta Actividad?")) 
                {  
                    var param = [{ "name": "calendarId", value: 8}];                
                    $.post(DATA_FEED_URL + "?method=remove",
                        param,
                        function(data){
                            if (data.IsSuccess) 
                            {
                               alert(data.Msg); 
                               CloseModelWindow(null,true);                            
                            }
                            else 
                            {
                                alert("Error .\r\n" + data.Msg);
                            }
                        }
                    ,"json");
                }
            });
            
           $("#stpartdate,#etpartdate").datepicker({ picker: "<button class='calpick'></button>"});    
            var cv = $("#colorvalue").val() ;
            if(cv == "")
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
                    alert(data.Msg);
                    if (data.IsSuccess) {
                        CloseModelWindow(null,true);  
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
            }, "Formato de Fecha no Válido");
            $.validator.addMethod("time", function(value, element) {
                return this.optional(element) || /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])$/.test(value);
            }, "Formato de Hora no Válido");
            $.validator.addMethod("safe", function(value, element) {
                return this.optional(element) || /^[^$\<\>]+$/.test(value);
            }, "$<> no permitido");
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
        });
    </script> 
		
		<script type="text/javascript">
		$(document).ready(function() {   
			<?php if($isadmin != 'Y') {?>
			$('#ta option:not(:selected)').attr('disabled',true);
			$('#au option:not(:selected)').attr('disabled',true);
			$('#lc option:not(:selected)').attr('disabled',true);
		<?php } else { ?>
			$('#ta option:not(:selected)').removeAttr('disabled');
			$('#au option:not(:selected)').removeAttr('disabled');
			$('#lc option:not(:selected)').removeAttr('disabled');

		<?php } ?>
		
		// * Cuando es nuevo.
		var tipo_au = $('#ta').val();		
		$('#info_ta').html('');
		if(tipo_au == "") 
        {
			//alert(tipo_au);
			$.post("../../cronos/lista_auditoria.php?tipo_auditoria="+ tipo_au ,  function(data){
			$("#au").html(data);
			});
			
			var audita = $('#au').val();
			//alert(audita);
			if(audita ==""){						
			$.post("../../cronos/consul_listschq_de_index.php?tipo_auditoria="+ tipo_au +"&auditoria="+ audita,  function(data){
			$("#lc").html(data);			
			});
			}
		}
		// *  Fin Nuevo
		
			
	$('#ta').change(function(){		
		var tipo_au = $('#ta').val(); 
		var audita = $('#au').val();
		$('#info_ta').html('');
        if(tipo_au == "") 
        {
			$('#info_ta').html('<font color="red" size="2"> Debe seleccionar información en Tipo de Auditoría.</font>').fadeOut(3000);
		}
		else
        {
			$('#au').html('<img src="../../../indicator_green.gif" alt="" />');

			$.get("../../cronos/lista_auditoria.php?tipo_auditoria="+ tipo_au ,  function(data){
			$("#au").html(data);
			});
			
			$.post("../../cronos/consul_listschq_de_index.php?tipo_auditoria="+ tipo_au +"&auditoria="+ audita,  function(data){
			$("#lc").html(data);
			});
		}
    });
		
		$('#au').change(function(){		
			var tipo_au = $('#ta').val(); 
			var audita = $('#au').val();
			$('#info_ta').html('');
			
			if(tipo_au == "" || audita == "")
			{
				 $('#info_ta').html('<font color="red" size="2"> Debe seleccionar información en Tipo de Auditoria y/o Nombre de Auditoria.</font>').fadeOut(3000);
			}
			else
			{
				$('#lc').html('<img src="../../../indicator_green.gif" alt="" />');
						
				$.post("../../cronos/consul_listschq_de_index.php?tipo_auditoria="+ tipo_au +"&auditoria="+ audita ,  function(data){
						$("#lc").html(data);
				});            
			}
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
			  <?php //if($isadmin == "Y") {?>       
        <a id="Savebtn" class="imgbtn" href="javascript:void(0);">                
          <span class="Save"  title="Grabar Actividad.">Grabar(<u>G</u>)
          </span>          
        </a>                         
        <?php //} ?> 
				 
			  <?php if(isset($event) && $isadmin == "Y"){ ?>
        <a id="Deletebtn" class="imgbtn" href="javascript:void(0);">                    
          <span class="Delete" title="Borrar la Actividad.">Borrar(<u>B</u>)
          </span>                
        </a>             
        <?php } ?>            
        <a id="Closebtn" class="imgbtn" href="javascript:void(0);">                
          <span class="Close" title="Cerrar la ventana" >Cerrar
          </span></a>            
        </a>        
      </div>                  
      <div style="clear: both">         
      </div>        
      <div class="infocontainer">            
        <form action="php/datafeedgea.php?method=adddetails<?php echo isset($event)?"&id=".$event->Id:""; ?>" class="fform" id="fmEdit" method="post">
				<?php echo "No. ".$event->Id; ?>                 
          <label>                    
            <span>                        *Responsable de la Actividad:              
            </span>                    
            <div id="calendarcolor">
            </div>
            <input name="responsable" type="text" class="required safe" id="responsable" style="width:85%;" value="<?php echo isset($event)?$event->responsable:"" ?>" MaxLength="200" <?php if($isadmin != "Y") {?> readonly <?php } ?>/>                     
            <input id="colorvalue" name="colorvalue" type="hidden" value="<?php echo isset($event)?$event->Color:"" ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                
          </label>                 
          <label>                    
            <span>*Fecha/Hora:
          </span>                    
            <div>  
              <?php if(isset($event)){
                  $sarr = explode(" ", php2JsTime(mySql2PhpTime($event->StartTime)));
                  $earr = explode(" ", php2JsTime(mySql2PhpTime($event->EndTime)));
              }?>                    
              <input MaxLength="10"  id="stpartdate" name="stpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo isset($event)?$sarr[0]:""; ?>"  <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                       
              <input MaxLength="5"  id="stparttime" name="stparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$sarr[1]:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>&nbsp;&nbsp;Hasta                       
              <input MaxLength="10" class="xrequired date" id="etpartdate" name="etpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo isset($event)?$earr[0]:""; ?>"  <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                       
              <input MaxLength="50" class="Xrequired time" id="etparttime" name="etparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$earr[1]:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                                            
              <label class="checkp"> 
							<?php if($isadmin != "Y") {?>
							  <input name="IsAllDayEvent" type="checkbox" id="IsAllDayEvent" value="1" readonly disabled="disabled"/>
							<?php } else {?>
                <input id="IsAllDayEvent" name="IsAllDayEvent" type="checkbox" value="1" <?php if(isset($event)&&$event->IsAllDayEvent!=0) {echo "checked";} ?>/>                Todo el día                
								<?php } ?>
              </label>                    
            </div>                
          </label>
										                 
          <label>                    
            <span>                        Proceso:
            </span>                    
            <input MaxLength="200" id="Location" name="Location" style="width:95%;" type="text" value="<?php echo isset($event)?$event->Location:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                 
          </label>  
					
					<label>                    
            <span>                        Nombre de Fuente:
            </span>                               
						 <select name="ta" id="ta" <?php if($isadmin != "Y") {?> readonly="readonly"  <?php } ?>>
						 		<option value="" <?php if (!(strcmp("", $event->tipo_auditoria))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
        				<option value="" <?php if (!(strcmp("", $event->tipo_auditoria))) {echo "selected=\"selected\"";} ?>>------------</option>
								<?php
								do {  
								?>
										<option value="<?php echo $row_rs_ta['cod_ti_audit']?>"<?php if (!(strcmp($row_rs_ta['cod_ti_audit'], $event->tipo_auditoria))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_ta['nom_ti_audit']?></option>
								<?php
								} while ($row_rs_ta = mysql_fetch_assoc($rs_ta));
									$rows = mysql_num_rows($rs_ta);
									if($rows > 0) {
											mysql_data_seek($rs_ta, 0);
										  $row_rs_ta = mysql_fetch_assoc($rs_ta);
									}
								?>
						 </select><div id="info_ta"></div>              
          </label>  
					

					<label>                    
            <span>                        Nombre Auditoría:
            </span>                    
					  <select name="au" id="au" <?php if($isadmin != "Y") {?> readonly="readonly" <?php } ?>>
						 		<option value="" <?php if (!(strcmp("", $event->auditoria))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
        				<option value="" <?php if (!(strcmp("", $event->auditoria))) {echo "selected=\"selected\"";} ?>>------------</option>
								<?php
								do {  
								?>
										<option value="<?php echo $row_rs_au['id']?>"<?php if (!(strcmp($row_rs_au['id'], $event->auditoria))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_au['nombre_auditoria']?></option>
								<?php
								} while ($row_rs_au = mysql_fetch_assoc($rs_au));
									$rows = mysql_num_rows($rs_au);
									if($rows > 0) {
											mysql_data_seek($rs_au, 0);
										  $row_rs_au = mysql_fetch_assoc($rs_au);
									}
								?>
						 </select>              
          </label>  


					<label>                    
            <span>                        Lista de Chequeo:
            </span>                    
					  <select name="lc" id="lc" <?php if($isadmin != "Y") {?> readonly="readonly" <?php } ?>>
						 		<option value="" <?php if (!(strcmp("", $event->listachq))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
        				<option value="" <?php if (!(strcmp("", $event->listachq))) {echo "selected=\"selected\"";} ?>>------------</option>
								<?php
								do {  
								?>
										<option value="<?php echo $row_rs_lc['id_listacheq']?>"<?php if (!(strcmp($row_rs_lc['id_listacheq'], $event->listachq))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_lc['nombre_lc']?></option>
								<?php
								} while ($row_rs_lc = mysql_fetch_assoc($rs_lc));
									$rows = mysql_num_rows($rs_lc);
									if($rows > 0) {
											mysql_data_seek($rs_lc, 0);
										  $row_rs_lc = mysql_fetch_assoc($rs_lc);
									}
								?>
						 </select>              
          </label>  
					
					<?php if($event->tipolista == 3) { ?>
					<label>                    
            <span>                        Dirigido A:
            </span>                    
						<input name="dirigido_a" type="text" id="dirigido_a" style="width:95%; height:26px" value="
<?php echo isset($event)?$event->proceson:""; ?>" <?php if($isadmin != "Y") {?>readonly="readonly" <?php }?>/>          </label>
					<?php } ?>
					
					<label>                    
            <span>                        Actividad a Realizar:
            </span>                    
						<input name="actividad" type="text" id="actividad" style="width:95%; height:26px" value="
<?php echo isset($event)?$event->actividad:""; ?>" <?php if($isadmin != "Y") {?>readonly="readonly" <?php }?>/>                
          </label>
					
					 <?php if($event->tipolista == 2) { ?> 
					<label>                    
            <span>                        Medio:
            
						<input name="medio" type="text" id="medio" style="width:3%; height:16px" value="
<?php echo isset($event)?$event->medio:""; ?>" <?php if($isadmin != "Y") {?>readonly="readonly" <?php }?>/></span>						<input name="nommedio" type="text" id="nommedio" style="width:95%; height:26px" value="
<?php echo isset($event)?$event->nommedio:""; ?>" <?php if($isadmin != "Y") {?>readonly="readonly" <?php }?>/>                
          </label>
					<?php } ?>               
												 
          <label>                    
            <span>                        Descripción de la Actividad a Realizar:
            <?php if($event->tipolista == 2) { ?> 
						<input name="Description" type="text" id="Description" style="width:3%; height:16px" value="
<?php echo isset($event)?$event->Description:""; ?>" <?php if($isadmin != "Y") {?>readonly="readonly" <?php }?>/>										
						</span>
						<?php //if($event->tipolista == 2)	{
								mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
								$query_rs_tlc = "SELECT * FROM temas WHERE id=".$event->tema."; ";
								$rs_tlc = mysql_query($query_rs_tlc, $cnn_plan_mejora) or die(mysql_error());
								$row_rs_tlc = mysql_fetch_assoc($rs_tlc);
								$totalRows_rs_tlc = mysql_num_rows($rs_tlc);
								//echo "tlc.......$query_rs_tlc";
								$temanombre = $row_rs_tlc['nombre'];
								mysql_free_result($rs_tlc);						
							//echo $temanombre;

						?>						              
<textarea name="xDescription" cols="20" rows="2" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?> id="xDescription" style="width:95%; height:70px"><?php echo $temanombre; ?></textarea>                
            
						<?php }	else {?>						              
<textarea name="Description" cols="20" rows="2" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?> id="Description" style="width:95%; height:70px"><?php echo isset($event)?$event->Description:""; ?></textarea>               
						
						<?php }	?>
					</label>
					 <label>                    
            <span>                        Observaciones realizadas por el responsable de la Actividad:
            </span>                    
<textarea name="observacion" cols="20" rows="2" id="observacion" style="width:95%; height:70px">
<?php echo isset($event)?$event->observacion:""; ?>
</textarea>                
          </label> 
					
					 <?php if($isadmin == "Y" || $event->capacitador == $racolss ) {?>
					 <label>                    
            <span style="font-family:Verdana, Geneva, sans-serif; font-size:13px;color:#F60">
						► SEGUIMIENTO DE LA ACTIVIDAD POR PARTE DEL CAPACITADOR, SIGE O COORDINADOR DE CAPACITACION:
            </span>                    
<textarea name="seguimiento" cols="20" rows="2" id="seguimiento" style="width:95%; height:70px">
<?php echo isset($event)?$event->seguimiento:""; ?>
</textarea>                
          </label> 
					<?php }	?>
					
					<label>                    
          <a href="#" onClick="TINY.box.show({iframe:'../../formato/adac/index.php?id=<?php echo $event->Id; ?>',boxid:'frameless',width:610,height:550,fixed:true,maskid:'blackmask',maskopacity:40,closejs:function(){closeJS()}})">
			<img src="../../imgs/adjuntar.jpg" alt="Nuevo" width="35" height="36" border="0" align="absmiddle"><span class="biggrupo">Adjuntar Archivo(s)</span></a>
			
	<!--		<a href="../../formato/adac/index.php?id=<?php //echo $event->Id; ?>" target="new"  >
			<img src="../../imgs/adjuntar.jpg" alt="Nuevo" width="35" height="36" border="0" align="absmiddle"><span class="biggrupo">Adjuntar Archivo(s)</span></a>-->
			
				<?php if($totalRows_rs_adj>0){ ?>
				<hr>
				<table width="90%" border="0" cellpadding="0" cellspacing="0" >
				<tr><td colspan="1" class="titheaders" align="center"><b>LISTADO DE ARCHIVOS ADJUNTOS</b></td></tr>			
					<?php do { ?>
					<tr >
							<td class="tcontent">&nbsp;<?php echo substr($row_rs_adj['nombre'],11); ?></td>
						</tr>
						<?php } while ($row_rs_adj = mysql_fetch_assoc($rs_adj)); ?>			 
				</table>
				<br>					
				<?php } ?>	
				
          </label>  
					              
          <input id="timezone" name="timezone" type="hidden" value="" /> 
					 <input id="hf_usu" name="hf_usu" type="hidden" value="" />           
        </form>         
      </div>         
    </div>
  </body>
</html>
<?php
mysql_free_result($rs_privilegios); 
mysql_free_result($rs_ta);
mysql_free_result($rs_au);
mysql_free_result($rs_lc);
mysql_free_result($rs_adj);
//}
?>