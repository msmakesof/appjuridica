<?php
include_once("../../Connections/cnn_plan_mejora.php");

require_once("../../sesion.class.php");

$sesion = new sesion();
$usuario = $sesion->get("usuario");

if( $usuario == false )
{	
	header("Location: ../../index.php");		
}
else 
{
	?>
<!--	 <script src="src/jquery.js" type="text/javascript"></script> -->
	  <script type="text/javascript" src="../../jquery181.js"></script>
<?php	 
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

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
$racolss = strtolower(trim($row_rs_privilegios["racolp"]));
$url = "php/datafeed$racolss.php";


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
function getCalendarByRange($id){
  try{
			$db = new DBConnection();
			$db->getConnection();
			//$sql = "select * from jqcalendar where id = " . $id;	
			 $sql = "select jqcalendar.* from jqcalendar join tipo_auditoria on tipo_auditoria.cod_ti_audit = jqcalendar.tipo_auditoria join auditoria on auditoria.id = jqcalendar.auditoria join listachqxtipoaudit on listachqxtipoaudit.id_listacheq = jqcalendar.listachq where jqcalendar.id = " . $id;
			mysql_query ("SET NAMES 'utf8'");
			mysql_set_charset('utf8');
			$handle = mysql_query($sql);
			//echo $sql;
			$row = mysql_fetch_object($handle);
	}catch(Exception $e){
  }
  return $row;
}
if($_GET["id"]){
  $event = getCalendarByRange($_GET["id"]);
}

mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_adj = "SELECT * FROM tbl_temp_files_act WHERE idpm=".$_GET["id"]."; ";
$rs_adj = mysql_query($query_rs_adj, $cnn_plan_mejora) or die(mysql_error());
$row_rs_adj = mysql_fetch_assoc($rs_adj);
$totalRows_rs_adj = mysql_num_rows($rs_adj);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
  <head>    
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">    
    <title>Detalle de la Novedad</title>    
    <link href="css/main.css" rel="stylesheet" type="text/css" />       
    <link href="css/dp.css" rel="stylesheet" />    
    <link href="css/dropdown.css" rel="stylesheet" />    
    <link href="css/colorselect.css" rel="stylesheet" />   
		<link rel="stylesheet" type="text/css" href="../../acciones/css/gral.css" media="all"/>
     
		 <link rel="stylesheet" href="../../tinybox2/style.css" />
		
     <script type="text/javascript" src="../../tinybox2/tinybox.js"></script>
      
    <script src="src/Plugins/Common.js" type="text/javascript"></script>        
    <script src="src/Plugins/jquery.form.js" type="text/javascript"></script>     
<!--    <script src="src/Plugins/jquery.validate.js" type="text/javascript"></script> -->    
    <script src="src/Plugins/datepicker_lang_ES.js" type="text/javascript"></script>        
<!--    <script src="src/Plugins/jquery.datepicker.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.dropdown.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.colorselect.js" type="text/javascript"></script>  --> 
     
		 		<script type="text/javascript">
		function grabar(formName,action){
				
	//		var indicec=null;
//				function toma_seleccionc(campo){
//					indicec=document.fmEdit.au.selectedIndex;
//				}
//				function pon_seleccionc(campo){
//					document.fmEdit.au.options[indicec].selected=true;
//				}
				
					if (document.fmEdit.observacion.value == "")
				{
					alert("ATENCION: Debe seleccionar informacion en el campo Observacion.");
					return;
				}
		
				action = "submit" ; 	  
				var myString = "document."+formName+"."+action+"();";
				eval(myString);
		}
    </script> 
		 
 	
						
		<script type="text/javascript">
		$(document).ready(function() { 	
		
		alert("..."+document.fmEdit.hf_admin.value);	
		// * Cuando es nuevo.
		var tipo_au = $('#ta').val();		
		$('#info_ta').html('');
		if(tipo_au == "") {
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
      if(tipo_au == "") {
			$('#info_ta').html('<font color="red" size="2"> Debe seleccionar información en Tipo de Auditoría.</font>').fadeOut(3000);
		}
		else{
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
   <div id="centrardiv">
	<div class="container" id="general"> 	   
		 <div class="kfizq" id="logo"><img src="../../imgs/logo.jpg" width="222" height="59" /></div> 
		  <form action="<?php echo $editFormAction; ?>" class="fform" id="fmEdit" method="post">     
      <div class="toolBotton">
			 <?php //if($isadmin == "Y") {?>       
        <a href="#" onClick="grabar('fmEdit','submit');">    				           
          Grabar(<u>G</u>)
        </a>                         
        <?php //} ?> 		 
				 
			  <?php if(isset($event) && $isadmin == "Y"){ ?>
        <a id="Deletebtn" class="imgbtn" href="javascript:void(0);">                    
          <span class="Delete" title="Borrar la Actividad.">Borrar(<u>B</u>)
          </span>                
        </a>             
        <?php } ?>            
        <!--<a id="Closebtn" class="imgbtn" href="javascript:void(0);">-->
				<a id="Closebtn" class="imgbtn" href="../../gestionn.php">                  
          <span class="Close" title="Cerrar la ventana" >Cerrar
          </span></a>            
        </a>        
      </div>                  
      <div style="clear: both">         
      </div>        
      <div class="infocontainer">            
                        
          <label>                    
            <span>                        *Responsable de la Actividad:              
            </span>                    
            <div id="calendarcolor">
            </div>
          <input name="Subject" type="text" class="required safe" id="Subject" style="width:85%;" value="<?php echo isset($event)?$event->Subject:"" ?>" MaxLength="200" <?php if($isadmin != "Y") {?> readonly <?php } ?>/>                     
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
              <input MaxLength="10" class="required date" id="stpartdate" name="stpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo isset($event)?$sarr[0]:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                       
              <input MaxLength="5" class="Xrequired time" id="stparttime" name="stparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$sarr[1]:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>&nbsp;&nbsp;Hasta                       
              <input MaxLength="10" class="required date" id="etpartdate" name="etpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo isset($event)?$earr[0]:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                       
              <input MaxLength="50" class="Xrequired time" id="etparttime" name="etparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$earr[1]:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly"  <?php } ?>/>                                            
              <label class="checkp"> 
               <?php if($isadmin != "Y") {?>
							  <input name="IsAllDayEvent" type="checkbox" id="IsAllDayEvent" value="1" readonly disabled="disabled" />
							<?php } else {?>
                <input id="IsAllDayEvent" name="IsAllDayEvent" type="checkbox" value="1" <?php if(isset($event)&&$event->IsAllDayEvent!=0) {echo "checked";} ?>/>                Todo el día                
								<?php } ?>
							</label>                  
            </div>                
          </label>
										                 
          <label>                    
            <span>                        Proceso:
            </span>                    
            <input MaxLength="200" id="Location" name="Location" style="width:95%;" type="text" value="<?php echo isset($event)?$event->Location:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly"  <?php } ?>/>                 
          </label>  
					
					<label>                    
            <span>                        Nombre de Fuente:
            </span>               
						
						<?php if($isadmin != "Y") {?>
						<input name="ta" type="text" class="required safe" id="ta" style="width:5%;" value="<?php echo isset($event)?$event->tipo_auditoria:"" ?>" MaxLength="200" <?php if($isadmin != "Y") {?> readonly <?php } ?>/>
						<?php echo $row_rs_ta['nom_ti_audit']?>
						 <?php } else {?>  
						              
				  <select name="ta" id="ta" <?php if($isadmin != "Y") {?> readonly="readonly" <?php } ?>>
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
						  <?php } ?> 
          </label>  
					

					<label>                    
            <span>                        Nombre Auditoría:
            </span>  
						<?php //echo "admin? $isadmin"; ?>
					  <select name="au" id="au" <?php if($isadmin == "") { ?> OnFocus="toma_seleccionc(this)" OnChange="pon_seleccionc(this)" <?php } ?>/>
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
					  <select name="lc" id="lc" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>>
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
					               
          <label>                    
            <span>                        Descripción de la Actividad a Realizar:
            </span>                    
<textarea name="Description" cols="20" rows="2" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?> id="Description" style="width:95%; height:70px">
<?php echo isset($event)?$event->Description:""; ?>
</textarea>                
          </label>  
					
					
					 <label>                    
            <span>                        Observaciones realizadas por el responsable de la Actividad:
            </span>                    
<textarea name="observacion" cols="20" rows="5" id="observacion" style="width:95%; height:170px">
<?php echo isset($event)?$event->observacion:""; ?>
</textarea>                
          </label> 
					
					
					<label> 
					<a href="#" onClick="grabar('form1','submit');">
					<img src="../../imgs/btn_aplicar.jpg" width="122" height="30" border="0" align="absmiddle" class="someClass" title="Grabar Actividad." />
					</a>
					</label> 
					
					<label>                    
          <a href="#" onClick="TINY.box.show({iframe:'../../formato/adac/index.php?id=<?php echo $event->Id; ?>',boxid:'frameless',width:610,height:550,fixed:false,maskid:'blackmask',maskopacity:40,closejs:function(){closeJS()}})">
			<img src="../../imgs/adjuntar.jpg" alt="Nuevo" width="35" height="36" border="0" align="absmiddle"><span class="biggrupo">Adjuntar Archivo(s)</span></a>
			
<!--			<a href="../../formato/adac/index.php?id=<?php //echo $event->Id; ?>" target="_blank" >
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
					<input id="hf_admin" name="hf_admin" type="hidden" value="<?php echo $isadmin; ?>" />           
        </form>         
      </div>         
    </div>
		<!--</div>-->
  </body>
</html>
<?php
mysql_free_result($rs_privilegios); 
mysql_free_result($rs_ta);
mysql_free_result($rs_au);
mysql_free_result($rs_lc);
mysql_free_result($rs_adj);
}
?>