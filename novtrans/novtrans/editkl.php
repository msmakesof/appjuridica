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

$id = $_POST['id'];
if($id ==""){$id = $_GET['id'];}
//echo "id................$id<br>";

/////////  PRIVILEGIOS  ////////////
$colname_rs_privilegios = $usuario;
//echo $colname_rs_privilegios;
$colname_rs_privilegios = "-1";
if (isset($usuario)) {
	$colname_rs_privilegios = $usuario;
}


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {	

		$updateSQL = "UPDATE jqcalendar SET observacion = '".$_POST['observacion']."' WHERE Id = $id";
		mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
    $Result1 = mysql_query($updateSQL, $cnn_plan_mejora) or die(mysql_error());
		mysql_query ("SET NAMES 'utf8'");
		mysql_set_charset('utf8');

?>  
<script type="text/javascript">
$(document).ready(function() {  
	  $("#msg").css({ color: "#FFFFFF", background: "#CC0000", font: "Verdana", size: 10}).html("<div align='center'>ACTUALIZADO correctamente!!!</div>").fadeOut(5000);
});
</script>

<?php	
}


mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_privilegios = "SELECT nombreEmp, cod_suc, control, graba, modifica, consulta, borra, racolp, admin FROM empleados WHERE usuario = '$colname_rs_privilegios'";
//echo "$query_rs_privilegios<br>";
$rs_privilegios = mysql_query($query_rs_privilegios, $cnn_plan_mejora) or die(mysql_error());
$row_rs_privilegios = mysql_fetch_assoc($rs_privilegios);
$totalRows_rs_privilegios = mysql_num_rows($rs_privilegios);	
mysql_query ("SET NAMES 'utf8'");
mysql_set_charset('utf8');	
			
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


mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_jc = "select jqcalendar.* from jqcalendar join tipo_auditoria on tipo_auditoria.cod_ti_audit = jqcalendar.tipo_auditoria join auditoria on auditoria.id = jqcalendar.auditoria join listachqxtipoaudit on listachqxtipoaudit.id_listacheq = jqcalendar.listachq where jqcalendar.id = ".$id;
$rs_jc = mysql_query($query_rs_jc, $cnn_plan_mejora) or die(mysql_error());
$row_rs_jc = mysql_fetch_assoc($rs_jc);
$totalRows_rs_jc = mysql_num_rows($rs_jc);
mysql_query ("SET NAMES 'utf8'");
mysql_set_charset('utf8');

mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
$query_rs_adj = "SELECT * FROM tbl_temp_files_act WHERE idpm=".$id."; ";
$rs_adj = mysql_query($query_rs_adj, $cnn_plan_mejora) or die(mysql_error());
$row_rs_adj = mysql_fetch_assoc($rs_adj);
$totalRows_rs_adj = mysql_num_rows($rs_adj);
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="../../acciones/css/gral.css" media="all"/>
<link rel="stylesheet" type="text/css" href="../../fondo.css" media="all"/>
<link rel="stylesheet" href="../../tinybox2/style.css" />
<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/mako.css"/>
<script type="text/javascript" src="../../tinybox2/tinybox.js"></script>
<script type="text/javascript">
function grabar(formName,action){			
		if (document.form1.observacion.value == "")
		{
			alert("ATENCION: Debe seleccionar informacion en el campo Observacion.");
			return;
		}

		action = "submit" ;
		document.form1.MM_update.value = "form1" ;  
		var myString = "document."+formName+"."+action+"();";
		eval(myString);
}
</script> 
		 
<script type="text/javascript">
$(document).ready(function() { 	
		<?php if($isadmin != 'Y') {?>
		$("#ta").attr('disabled', 'disabled');
		$("#au").attr('disabled', 'disabled');
		$("#lc").attr('disabled', 'disabled');
		<?php } else {?>
		$("#ta").removeAttr('disabled');
		$("#au").removeAttr('disabled');
		$("#lc").removeAttr('disabled');

		<?php } ?>
		
		// * Cuando es nuevo.
		var tipo_au = $('#ta').val();		
		$('#info_ta').html('');
		//alert("Nombre fuente........"+tipo_au);
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
</head>
<body>
<div id="centrardiv">
		<div class="container" id="general"> 
		 <div id="p2" style="display:inline-block; width: 100%; height:63px; float:left; background-color:#001; layer-background-color:#001; margin-bottom:10px">
					<img src="../../imgs/logo.jpg" width="222" height="59" />
		</div>
 
		<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">		
		<br><hr><div id="msg"></div>
		     <label>                    
            <span>Responsable de la Actividad:</span>                    
           <!-- <div id="calendarcolor"></div>-->
      <input name="responsable" type="text" class="span4" id="responsable" style="width:55%;" value="<?php echo $row_rs_jc["responsable"]; ?>" MaxLength="200" <?php if($isadmin != "Y") {?> readonly <?php } ?>/>
		                     
      <input id="colorvalue" name="colorvalue" type="hidden" value="<?php echo $row_rs_jc["Color"]; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                
          </label>
					
					<label>                    Desde
					 <input MaxLength="10" class="required date" id="stpartdate" name="stpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo $row_rs_jc["StartTime"]; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                       
Hasta                       
              <input MaxLength="10" class="required date" id="etpartdate" name="etpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo $row_rs_jc["EndTime"]; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>               </label>
							
					
					<label>                    
            <span>                        Proceso:
            </span>                    
            <input MaxLength="200" id="Location" name="Location" style="width:65%;" type="text" value="<?php echo $row_rs_jc["Location"]; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly"  <?php } ?>/>                 
          </label>  
					
					<label>                    
            <span>                       Nombre de Fuente:
            </span>       
		        <select name="ta" id="ta" class="span5"> 
				
								<option value="" <?php if (!(strcmp("", $row_rs_jc["tipo_auditoria"]))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
        				<option value="" <?php if (!(strcmp("", $row_rs_jc["tipo_auditoria"]))) {echo "selected=\"selected\"";} ?>>------------</option>
								
								<?php
								do {  
								?>
										<option value="<?php echo $row_rs_ta['cod_ti_audit']; ?>"<?php if (!(strcmp($row_rs_ta['cod_ti_audit'], $row_rs_jc["tipo_auditoria"]))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_ta['nom_ti_audit']; ?></option>
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
						<select name="au" id="au" class="span6">
						 		<option value="" <?php if (!(strcmp("", $row_rs_jc["auditoria"]))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
        				<option value="" <?php if (!(strcmp("", $row_rs_jc["auditoria"]))) {echo "selected=\"selected\"";} ?>>------------</option>
								
								<?php 
								do {  
								?>
								<option value="<?php echo $row_rs_au['id']; ?>"<?php if (!(strcmp($row_rs_au['id'], $row_rs_jc["auditoria"]))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_au['nombre_auditoria']; ?></option>
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
					  <select name="lc" id="lc" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>  class="span6">
					 		<option value="" <?php if (!(strcmp("", $row_rs_lc['id_listacheq']))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
        				<option value="" <?php if (!(strcmp("", $row_rs_lc['id_listacheq']))) {echo "selected=\"selected\"";} ?>>------------</option>
								<?php
								do {  
								?>
										<option value="<?php echo $row_rs_lc['id_listacheq']; ?>"<?php if (!(strcmp($row_rs_lc['id_listacheq'], $row_rs_jc["listachq"]))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_lc['nombre_lc']; ?></option>
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
            <span>                        Actividad a Realizar:
            </span>                    
						<input name="actividad" type="text" id="actividad" style="width:95%; height:28px" value="
<?php echo $row_rs_jc["actividad"]; ?>" <?php if($isadmin != "Y") {?> readonly="readonly" <?php } ?> />                
          </label> 
				
          <label>                    
            <span>                        Descripción de la Actividad a Realizar:
            </span>                    
<textarea name="Description" cols="20" rows="2" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?> id="Description" style="width:95%; height:70px">
<?php echo $row_rs_jc["Description"]; ?>
</textarea>                
          </label>  
	    		 
					<label>                    
            <span>                        Detalle de la Actividad realizada por el responsable y Anexo de Evidencias:
            </span>                    
<textarea name="observacion" cols="20" rows="5" id="observacion" style="width:95%; height:90px">
<?php echo $row_rs_jc["observacion"]; ?>
</textarea>                
          </label>
					
					<label> 
					<a href="#" onClick="grabar('form1','submit');" class="btn btn-primary"> Grabar </a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="../../gestionn.php" class="btn btn-danger"> Salir </a>
					</label> 
					
					<label>                    
          <a href="#" onClick="TINY.box.show({iframe:'../../formato/adac/index.php?id=<?php echo $id; ?>',boxid:'frameless',width:710,height:680,fixed:false,maskid:'blackmask',maskopacity:40,closejs:function(){closeJS()}})">
			<img src="../../imgs/adjuntar.jpg" alt="Nuevo" width="35" height="36" border="0" align="absmiddle"><span class="biggrupo">Adjuntar Archivo(s)</span></a>
			
				<?php if($totalRows_rs_adj>0){ ?>
				<hr>
				<div id="px2" align="center" style="clear:both; display:inline-block; width: 100%; height:23px; float:left; background-color:#06C; layer-background-color:#06C; margin-bottom:10px; font-family:Verdana, Geneva, sans-serif; font-size:14; font-weight:bold; color:#FFF">LISTADO DE ARCHIVOS ADJUNTOS</div>				
				<!--<table width="90%" border="0" cellpadding="0" cellspacing="0" >	-->					
					<?php do { ?>
					<!--<tr >
							<td class="tcontent">&nbsp;</td>-->
							<div id="p2x" style="clear:both; display:inline-block; width: 100%; height:23px; float:left; font-family:Verdana, Geneva, sans-serif; font-size:10; font-weight:bold"><?php echo substr($row_rs_adj['nombre'],11); ?></div>
					<!--</tr>-->
						<?php } while ($row_rs_adj = mysql_fetch_assoc($rs_adj)); ?>			 
				<!--</table>-->
				<br>					
				<?php } ?>	
				
          </label>  
					              
          <input id="timezone" name="timezone" type="hidden" value="" />
					<input id="hf_admin" name="hf_admin" type="hidden" value="<?php echo $isadmin; ?>" />           
          <input type="hidden" name="MM_update" value="form1">
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
mysql_free_result($rs_jc);
mysql_free_result($rs_adj);
}
?>