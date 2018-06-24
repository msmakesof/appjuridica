<?php
include_once("../../Connections/cnn_kn.php");
require_once('../../Connections/config2.php'); 
//$IdjqCal =  $_GET["id"];

if(isset($_GET['id'])) 
{ 
    $IdjqCal =  $_GET["id"];
}
echo $IdjqCal;
$isadmin = "Y";
if($IdjqCal == 0)
{
    // es nuevo
}
//$event = "";
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
        function getCalendarByRange($id)
        {
            try{
    			$db = new DBConnection();
    			$db->getConnection();
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
    }    


//echo $event;
?>
<!DOCTYPE html>
<html>
  <head>
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

        $(function () {
            var dateToday = new Date();
            $('.form_date').datetimepicker({
                language:  'es',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                minDate: dateToday,       
            });
            $('.form_date').datetimepicker('setDaysOfWeekDisabled', [0]);
        });

        $(document).ready(function() {
            
            $("#Savebtn").click(function() { $("#fmEdit").submit(); });
            $("#Closebtn").click(function() { CloseModelWindow(); });
            $("#Deletebtn").click(function() {
                if (confirm("Está seguro que desea borrar esta Programación?")) 
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

            $("#nivel").on("change", function(){
                var x = $("#nivel").val(); 
                var mat = $("#materia").val();         
                $.ajax({
                    //this is the php file that processes the data 
                    url: "vertemaxnivel.php",
                    //GET method is used
                    type: "POST",
                    data: "pars="+x+"&mat="+mat, 
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
                          imageUrl: "../../sweet/2.gif",
                          timer: 2000,
                          showConfirmButton: false
                        });
                        return false;                       
                    }  
                });
            });

                var x = $("#nivel").val(); 
                var mat = "<?php echo $materiasel ;?>";         
                $.ajax({
                    //this is the php file that processes the data 
                    url: "vertemaxnivel.php",
                    //GET method is used
                    type: "POST",
                    data: "pars="+x+"&mat="+mat, 
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
                          imageUrl: "../../sweet/2.gif",
                          timer: 2000,
                          showConfirmButton: false
                        });
                        return false;                       
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
        <form action="php/datafeedgea.php?method=adddetails<?php echo isset($event); ?>&id=<?php echo $IdjqCal ; ?>" class="fform" id="fmEdit" method="post">				            
          <label>                    
            <span>                        * Sede:              
            </span>                    
            <!-- <div id="calendarcolor"></div> -->
                <select name="sede" id="sede" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly"  <?php } ?>>

                <?php 
                if($IdjqCal > 0)
                {
                ?>
                    <option value="" <?php if (!(strcmp("", $event->Sede))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
                    <option value="" <?php if (!(strcmp("", $event->Sede))) {echo "selected=\"selected\"";} ?>>------------</option>
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


            <label for="from" class="col-md-2 control-label">Semana Desde</label>
            <div class="form-group">                        
                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php echo $event->desde; ?>" id="from" name="from" readonly >
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <!-- <input type="hidden" id="dtp_input2" value="" /> -->
            </div>  

             <label for="to" class="col-md-2 control-label">Semana Hasta</label>
            <div class="form-group">
                
                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" id="to" name="to" readonly value="<?php echo $event->hasta; ?>">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <!-- <input type="hidden" id="dtp_input2" value="" /> -->
            </div>

          <label>                    
            <span>                        * Horario:
            </span>                    
                  <select name="horario" id="horario" class="form-control" <?php if($isadmin != "Y") {?> readonly="readonly" <?php } ?>>
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
            <span>                        * Topic:
            </span>                    
			<select name="materia" id="materia" class="form-control">				 	
		    </select>              
          </label>
          <div id="Msg"></div>               
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
?>