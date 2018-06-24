<?php
include_once("../../Connections/cnn_kn.php");
require_once('../../Connections/config2.php'); 
//require_once("../../sesion.class.php");
//$sesion = new sesion();
//$usuario = $sesion->get("usuario");

//if( $usuario == false )
//{	
//	header("Location: ../../index.php");		
//}
//else 
//{
$IdjqCal =  $_GET["id"];
$isadmin = "Y";
?>
	 <script src="src/jquery.js" type="text/javascript"></script> 
<?php	 

	/////////  PRIVILEGIOS  ////////////
	// $colname_rs_privilegios = $usuario;
	// //echo $colname_rs_privilegios;
	// $colname_rs_privilegios = "-1";
	// if (isset($usuario)) {
	// 	$colname_rs_privilegios = $usuario;
	// }

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_xclasever = "SELECT IdClase, Sede, Salon, Materia, Profesor, Nivel, Horario, desde, hasta, dia, nivel.NombreNivel, materia.NombreMateria FROM jqcalendar JOIN nivel ON jqcalendar.Nivel = nivel.IdNivel AND nivel.Estado = 1 JOIN materia ON jqcalendar.Materia = materia.IdMateria AND materia.Estado = 1 WHERE jqcalendar.Id = $IdjqCal  ;";            
$rs_xclasever = mysqli_query($cnn_kn,$query_rs_xclasever) or die(mysqli_error()."Err1...$query_rs_clasever");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_xclasever = mysqli_fetch_assoc($rs_xclasever);
$totalRows_rs_xclasever = mysqli_num_rows($rs_xclasever);

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

    include_once("php/dbconfig.php");
    include_once("php/functions.php");
    function getCalendarByRange($id)
    {
        try{
			$db = new DBConnection();
			$db->getConnection();
			//$sql = "select * from jqcalendar where id = " . $id;	
			 //$sql = "select jqcalendar.*, dirigido_hacia.proceson, medios.nombre as nommedio from jqcalendar join tipo_auditoria on tipo_auditoria.cod_ti_audit = jqcalendar.tipo_auditoria join auditoria on auditoria.id = jqcalendar.auditoria join listachqxtipoaudit on listachqxtipoaudit.id_listacheq = jqcalendar.listachq left join procesos dirigido_hacia on dirigido_hacia.abr2 = jqcalendar.dirigido_a and dirigido_hacia.estado = 'A' left join medios on medios.id = jqcalendar.medio where jqcalendar.id = " . $id;
            $sql = "SELECT IdClase, Sede, Salon, Materia, Profesor, Nivel, Horario, desde, hasta, dia, IdEvento, Description,  nivel.NombreNivel, materia.NombreMateria FROM jqcalendar JOIN nivel ON jqcalendar.Nivel = nivel.IdNivel AND nivel.Estado = 1 JOIN materia ON jqcalendar.Materia = materia.IdMateria AND materia.Estado = 1 WHERE jqcalendar.Id = ".$id ;
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

// mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
// $query_rs_adj = "SELECT * FROM tbl_temp_files_act WHERE idpm=".$_GET["id"]."; ";
// $rs_adj = mysql_query($query_rs_adj, $cnn_plan_mejora) or die(mysql_error());
// $row_rs_adj = mysql_fetch_assoc($rs_adj);
// $totalRows_rs_adj = mysql_num_rows($rs_adj);

$temanombre = "";
?>
<!DOCTYPE html>
<html>
  <head>    
    <!-- <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">  -->
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">   
    <title>Detalle de la Programación</title>        
    <link href="css/main.css" rel="stylesheet" type="text/css" />       
    <link href="css/dp.css" rel="stylesheet" />    
    <link href="css/dropdown.css" rel="stylesheet" />    
    <link href="css/colorselect.css" rel="stylesheet" />        
	
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../tinybox2/style.css" />
    <script type="text/javascript" src="../../tinybox2/tinybox.js"></script>
      
	<!-- <script src="http://dev.powelltechs.com/jquery.readonly/www/trunk/jquery.readonly.js"></script>
    <link rel="stylesheet" href="http://dev.powelltechs.com/jquery.readonly/www/trunk/jquery.readonly.css" type="text/css">--> 
			

    <script src="src/Plugins/Common.js" type="text/javascript"></script>        
    <script src="src/Plugins/jquery.form.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.validate.js" type="text/javascript"></script>     
    <!-- <script src="src/Plugins/datepicker_lang_ES.js" type="text/javascript"></script>        
    <script src="src/Plugins/jquery.datepicker.js" type="text/javascript"></script> -->     
    <script src="src/Plugins/jquery.dropdown.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.colorselect.js" type="text/javascript"></script>    



    <link href="../../cal/sample in bootstrap v3/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
    <link href="../../cal/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="../../Calendario/js/es-ES.js"></script>
    <script src="../../Calendario/js/jquery.min.js"></script>
    <script src="../../Calendario/js/moment.js"></script>
    <script src="../../Calendario/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../cal/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../../cal/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
     
    <script type="text/javascript">        
        $(document).ready(function() {
            
            $("#Savebtn").click(function() { $("#fmEdit").submit(); });
            $("#Closebtn").click(function() { CloseModelWindow(); });
            $("#Deletebtn").click(function() {
                if (confirm("Está seguro que desea borrar este Horario?")) 
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
        <a id="Closebtn" class="imgbtn" style="z-index: 500;" href="javascript:void(0);">                
          <span class="Close" style="font-size: 15px; z-index: 500; margin-top: 2px;" title="Cerrar la ventana" >Cerrar
          </span></a>            
        </a>        
      </div>                  
      <div style="clear: both">         
      </div>        
      <div class="infocontainer">            
        <form action="php/datafeedgea.php?method=adddetails<?php echo isset($event)?"&id=".$event->Id:""; ?>" class="fform" id="fmEdit" method="post">
				<?php //echo "No. ".$event->Id; ?>                 
          <label>                    
            <span>                        * Sede:              
            </span>                    
            <!-- <div id="calendarcolor"></div> -->
                <select name="sede" id="sede" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly"  <?php } ?>>
                    <option value="" <?php if (!(strcmp("", $event->Sede))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
                    <option value="" <?php if (!(strcmp("", $event->Sede))) {echo "selected=\"selected\"";} ?>>------------</option>
                    <?php
                        do {  
                    ?>
                            <option value="<?php echo $row_rs_tipo_suctabla['IdSucursal']?>"<?php if (!(strcmp($row_rs_tipo_suctabla['IdSucursal'], $event->Sede))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_suctabla['NombreSucursal']?></option>
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
                    <option value="" <?php if (!(strcmp("", $event->Profesor))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
                    <option value="" <?php if (!(strcmp("", $event->Profesor))) {echo "selected=\"selected\"";} ?>>------------</option>
                    <?php
                        do {  
                    ?>
                            <option value="<?php echo $row_rs_tipo_proftabla['IdProfesor']?>"<?php if (!(strcmp($row_rs_tipo_proftabla['IdProfesor'], $event->Profesor))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_proftabla['NombreProfesor']?></option>
                    <?php
                        } while ($row_rs_tipo_proftabla = mysqli_fetch_assoc($rs_tipo_proftabla));
                            $rows = mysqli_num_rows($rs_tipo_proftabla);
                            if($rows > 0) {
                                mysqli_data_seek($rs_tipo_proftabla, 0);
                                $row_rs_tipo_proftabla = mysqli_fetch_assoc($rs_tipo_proftabla);
                            }
                    ?>
                    </select><div id="info_profesor"></div>                
          </label>  
					
			<label>                    
            <span>                        * Salón:
            </span>                               
					<select name="salon" id="salon" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly"  <?php } ?>>
					 		<option value="" <?php if (!(strcmp("", $event->Salon))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
    				<option value="" <?php if (!(strcmp("", $event->Salon))) {echo "selected=\"selected\"";} ?>>------------</option>
							<?php
							do {  
							?>
								<option value="<?php echo $row_rs_tipo_saltabla['IdSalon']?>"<?php if (!(strcmp($row_rs_tipo_saltabla['IdSalon'], $event->Salon))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_saltabla['NombreSalon']?></option>
							<?php
							} while ($row_rs_tipo_saltabla = mysqli_fetch_assoc($rs_tipo_saltabla));
								$rows = mysqli_num_rows($rs_tipo_saltabla);
								if($rows > 0) {
									mysqli_data_seek($rs_tipo_saltabla, 0);
									$row_rs_tipo_saltabla = mysqli_fetch_assoc($rs_tipo_saltabla);
								}
							?>
					</select><div id="info_salon"></div>              
          </label>  


            <label for="from" class="col-md-2 control-label">Semana Desde</label>
            <div class="form-group">                        
                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" id="from" name="from" readonly >
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <!-- <input type="hidden" id="dtp_input2" value="" /> -->
            </div>  

             <label for="to" class="col-md-2 control-label">Semana Hasta</label>
                    <div class="form-group">
                        
                        <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" size="16" type="text" value="" id="to" name="to" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <!-- <input type="hidden" id="dtp_input2" value="" /> -->
                    </div>


				
         <!--  <label>                    
            <span>* Fecha Desde / Hasta:
          </span>                    
            <div>  
              <?php if(isset($event)){
                  $sarr = explode(" ", php2JsTime(mySql2PhpTime($event->desde)));
                  $earr = explode(" ", php2JsTime(mySql2PhpTime($event->hasta)));
              }?> 
              Desde                   
              <input MaxLength="10" class="col-md-3 control-label" id="stpartdate" name="stpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo isset($event)?$sarr[0]:""; ?>"  <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                       
             <!--  <input MaxLength="5"  id="stparttime" name="stparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$sarr[1]:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>&nbsp;&nbsp; -->Hasta                       
              <input MaxLength="10" class="col-md-3 control-label" id="etpartdate" name="etpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo isset($event)?$earr[0]:""; ?>"  <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/>                       
              <!-- <input MaxLength="50" class="Xrequired time" id="etparttime" name="etparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$earr[1]:""; ?>" <?php if($isadmin != "Y") {?>  readonly="readonly" <?php } ?>/> -->                                           
                         
            </div>                
          </label>  -->


          <label>                    
            <span>                        * Horario:
            </span>                    
                  <select name="nivel" id="nivel" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly" <?php } ?>>
                        <option value="" <?php if (!(strcmp("", $event->Horario))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
                        <option value="" <?php if (!(strcmp("", $event->Horario))) {echo "selected=\"selected\"";} ?>>------------</option>
                            <?php
                            do {  
                            ?>
                                <option value="<?php echo $row_rs_tipo_hortabla['IdHorario']?>"<?php if (!(strcmp($row_rs_tipo_hortabla['IdHorario'], $event->Horario))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_hortabla['Inicio'].' - '. $row_rs_tipo_hortabla['Final'] ;?></option>
                            <?php
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
					 	<option value="" <?php if (!(strcmp("", $event->Nivel))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
    				    <option value="" <?php if (!(strcmp("", $event->Nivel))) {echo "selected=\"selected\"";} ?>>------------</option>
							<?php
							do {  
							?>
								<option value="<?php echo $row_rs_tipo_nivtabla['IdNivel']?>"<?php if (!(strcmp($row_rs_tipo_nivtabla['IdNivel'], $event->Nivel))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_nivtabla['NombreNivel']?></option>
							<?php
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
            <span>                        * Tema:
            </span>                    
					<select name="materia" id="materia" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly" <?php } ?>>
						 	<option value="" <?php if (!(strcmp("", $event->Materia))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
        				<option value="" <?php if (!(strcmp("", $event->Materia))) {echo "selected=\"selected\"";} ?>>------------</option>
						<?php
					       do {  
						?>
							<option value="<?php echo $row_rs_tipo_mattabla['IdMateria']?>"<?php if (!(strcmp($row_rs_tipo_mattabla['IdMateria'], $event->Materia))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_mattabla['NombreMateria']?></option>
						<?php
							} while ($row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla));
								$rows = mysqli_num_rows($rs_tipo_mattabla);
								if($rows > 0) {
									mysqli_data_seek($rs_tipo_mattabla, 0);
								    $row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla);
								}
						?>
						 </select>              
          </label>  
					
       <!--  <?php if($isadmin == "Y" || $event->capacitador == $racolss ) {?>
					 <label>                    
            <span style="font-family:Verdana, Geneva, sans-serif; font-size:13px;color:#F60">
						► SEGUIMIENTO DE LA ACTIVIDAD POR PARTE DEL PROFESOR:
            </span>                    
<textarea name="seguimiento" cols="20" rows="2" id="seguimiento" style="width:95%; height:70px">
<?php echo isset($event)?$event->Description:""; ?>
</textarea>                
          </label> 
					<?php }	?>		 -->			
					 
					              
          <input id="timezone" name="timezone" type="hidden" value="" /> 
					 <input id="hf_usu" name="hf_usu" type="hidden" value="" />           
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
//}
?>