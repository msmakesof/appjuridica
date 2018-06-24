<?php require_once('../../Connections/cnn_plan_mejora.php'); ?>
<?php
require_once("../../sesion.class.php");

$sesion = new sesion();
$usuario = $sesion->get("usuario");

if( $usuario == false )
{	
	header("Location: ../../index.php");		
}
else 
{
			$pver = $_REQUEST['ver'];
			//echo "pver............$pver";
			/////////  PRIVILEGIOS  ////////////
			$colname_rs_privilegios = $usuario;
			//echo $colname_rs_privilegios;
			$colname_rs_privilegios = "-1";
			if (isset($usuario)) {
				$colname_rs_privilegios = $usuario;
			}
			mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
			$query_rs_privilegios = "SELECT nombreEmp, cod_suc, control, graba, modifica, consulta, borra, racolp, admin, procesos.proceson FROM empleados JOIN procesos ON procesos.abr2 = empleados.racolp WHERE usuario = '$colname_rs_privilegios'";
			$rs_privilegios = mysql_query($query_rs_privilegios, $cnn_plan_mejora) or die(mysql_error());
			$row_rs_privilegios = mysql_fetch_assoc($rs_privilegios);
			$totalRows_rs_privilegios = mysql_num_rows($rs_privilegios);			
			
		  $_SESSION['MM_adminss'] = $row_rs_privilegios["admin"];
			$isadmin = $row_rs_privilegios['admin'];
			$kontrol = $row_rs_privilegios['control'];
			$nomproceso_x = trim($row_rs_privilegios["proceson"]);
			$proceso_x = trim($row_rs_privilegios["racolp"]);
			$xproceso_x = strtolower($proceso_x);
			$proc ="php/datafeed$xproceso_x.php";
			//$proc ="php/datafeedx.php?pr=$xproceso_x";			
			//echo $query_rs_privilegios;
			/////////////////////
?>

<?php 
$sql = "Select ver from empleados where usuario='$usuario'";		
		$handle = mysql_query($sql);
		mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');
		$ver ="";
    while ($row = mysql_fetch_object($handle)) {
				//if($ver ==""){$ver = "'".$row->ver."'";}
				//else{$ver = $ver.",'".$row->ver."'";	}
				$ver =$row->ver;
		}	
		
		$verfin = str_replace(",","','",$ver);	
		//echo $verfin ;
		$GLOBALS['verfin'] = $verfin;
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title>...:::: INTER RAPIDISIMO  - CRONOGRAMA.   ::::.</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="css/dailog.css" rel="stylesheet" type="text/css" />
    <link href="css/calendar.css" rel="stylesheet" type="text/css" /> 
    <link href="css/dp.css" rel="stylesheet" type="text/css" />   
    <link href="css/alert.css" rel="stylesheet" type="text/css" /> 
    <link href="css/main.css" rel="stylesheet" type="text/css" />     

    <script src="src/jquery.js" type="text/javascript"></script>      
    <script src="src/Plugins/Common.js" type="text/javascript"></script>    
    <script src="src/Plugins/datepicker_lang_ES.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.datepicker.js" type="text/javascript"></script>

    <script src="src/Plugins/jquery.alert.js" type="text/javascript"></script>    
    <script src="src/Plugins/jquery.ifrmdailog.js" defer="defer" type="text/javascript"></script>
    <script src="src/Plugins/wdCalendar_lang_ES.js" type="text/javascript"></script>    
    <script src="src/Plugins/jquery.calendar.js" type="text/javascript"></script>   
    
    <script type="text/javascript">
        $(document).ready(function() {     
           //var view="week"; 
					 var view="month"; 
					 	var DATA_FEED_URL = "php/datafeedgeaxx.php";
						/////var DATA_FEED_URL = "<?php //echo $proc; ?>";
            var op = {
                view: view,
                theme:3,
                showday: new Date(),
                EditCmdhandler:Edit,
                DeleteCmdhandler:Delete,
                ViewCmdhandler:View,    
                onWeekOrMonthToDay:wtd,
                onBeforeRequestData: cal_beforerequest,
                onAfterRequestData: cal_afterrequest,
                onRequestDataError: cal_onerror, 
                autoload:true,               
								url: DATA_FEED_URL + "?method=list&proc=<?php echo $xproceso_x; ?>",
								<?php if($row_rs_privilegios["admin"] == "Y"){?>
								quickAddUrl: DATA_FEED_URL + "?method=add", 
								<?php } ?>
                quickUpdateUrl: DATA_FEED_URL + "?method=update",
                quickDeleteUrl: DATA_FEED_URL + "?method=remove"        
            };
            var $dv = $("#calhead");
            var _MH = document.documentElement.clientHeight;
            var dvH = $dv.height() + 2;
            op.height = _MH - dvH;
            op.eventItems =[];

            var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
            $("#caltoolbar").noSelect();
            
            $("#hdtxtshow").datepicker({ picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
            onReturn:function(r){                          
                            var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
                            if (p && p.datestrshow) {
                                $("#txtdatetimeshow").text(p.datestrshow);
                            }
                     } 
            });
            function cal_beforerequest(type)
            {
                var t="Cargando datos...";
                switch(type)
                {
                    case 1:
                        t="Cargando datos...";
                        break;
                    case 2:                      
                    case 3:  
                    case 4:    
                        t="El requerimiento est&aacute; siendo procesado ...";                                   
                        break;
                }
                $("#errorpannel").hide();
                $("#loadingpannel").html(t).show();    
            }
            function cal_afterrequest(type)
            {
                switch(type)
                {
                    case 1:
                        $("#loadingpannel").hide();
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $("#loadingpannel").html("Realizado!");
                        window.setTimeout(function(){ $("#loadingpannel").hide();},2000);
                    break;
                }              
               
            }
            function cal_onerror(type,data)
            {
                $("#errorpannel").show();
            }
            function Edit(data)
            {
               var eurl="edit.php?id={0}&start={2}&end={3}&isallday={4}&title={1}";   
                if(data)
                {
                    var url = StrFormat(eurl,data);
                    OpenModelWindow(url,{ width: 680, height: 690, caption:"Administrador de Planificación InterRapidísimo.",onclose:function(){
                       $("#gridcontainer").reload();
                    }});
                }
            }    
            function View(data)
            {
                var str = "";
                $.each(data, function(i, item){
                    str += "[" + i + "]: " + item + "\n";
                });
                alert(str);               
            }    
            function Delete(data,callback)
            {           
                
                $.alerts.okButton="Aaceptar";  
                $.alerts.cancelButton="Cancelar";  
                hiConfirm("Está seguro que desea borrar este Evento", 'Confirmar',function(r){ r && callback(0);});           
            }
            function wtd(p)
            {
               if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $("#showdaybtn").addClass("fcurrent");
            }
            //to show day view
            $("#showdaybtn").click(function(e) {
                //document.location.href="#day";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("day").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            //to show week view
            $("#showweekbtn").click(function(e) {
                //document.location.href="#week";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("week").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //to show month view
            $("#showmonthbtn").click(function(e) {
                //document.location.href="#month";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("month").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
            $("#showreflashbtn").click(function(e){
                $("#gridcontainer").reload();
            });
            
//            //Add a new event
//            $("#faddbtn").click(function(e) {
//                var url ="edit.php";
//                OpenModelWindow(url,{ width: 500, height: 400, caption: "Crear Nueva Novedad"});
//            });
//            //go to today
            $("#showtodaybtn").click(function(e) {
                var p = $("#gridcontainer").gotoDate().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }


            });
            //previous date range
            $("#sfprevbtn").click(function(e) {
                var p = $("#gridcontainer").previousRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //next date range
            $("#sfnextbtn").click(function(e) {
                var p = $("#gridcontainer").nextRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
        });
    </script>    
</head>
<body>

    <div>
	<img src="../../SINTER LOGIN/imagenes/header-sifi.jpg" width="100%" height="128" />
      <div id="calhead" style="padding-left:1px;padding-right:1px;">          
            <div class="cHead"><div class="ftitle">Cronograma de Actividades Proceso: <?php echo $proceso_x; ?> - <?php echo $nomproceso_x; ?> - INTERRAPIDISIMO.</div>						
					
						<div class="ftitlemks">							
						<div id="p1" style="display:inline-block; width: 98px; float:left; font-family:Verdana, Geneva, sans-serif; color: #06C">Convenciones</div>	
						<div id="p2" style="display:inline-block; width: 60px; float:left; background-color:#568CDE; layer-background-color:#568CDE;">Gerencia</div>	

<div id="p3" style="display:inline-block; width: 85px; float:left; background-color:#E76D6D; layer-background-color:#E76D6D;">SubGerencia</div>					

						<div id="p4" style="display:inline-block; width: 60px; float:left; background-color:#F4B555; layer-background-color:#F4B555;">Dirección</div>	
						
<div id="p6" style="display:inline-block; width: 85px; float:left; background-color:#B191D9; layer-background-color:#B191D9;">SubDirección</div>
<div id="p5" style="display:inline-block; width: 85px; float:left; background-color:#ACACAC; layer-background-color:#ACACAC;">Coordinación</div>	

<div id="p7" style="display:inline-block; width: 85px; float:left; background-color:#C6AA77; layer-background-color:#C6AA77;">Racol</div>					
<div id="p8" style="float:right;color:#FFFF00; background:#369; width: 200px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Observaciones Realizadas</div>
						</div>
						
            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Cargando datos...</div>
             <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Datos no pueden ser cargados, por favor intentelo más tarde</div>
            </div>          
            
            <div id="caltoolbar" class="ctoolbar">
             <!-- <div id="faddbtn" class="fbutton">
                <div><span title='Click para Crear Nuevo Evento' class="addcal">

                Nuevo Evento                
                </span></div>
            </div>-->
            <div class="btnseparator"></div>
             <div id="showtodaybtn" class="fbutton">
                <div><span title='Click para volver al día de Hoy ' class="showtoday">
                Hoy</span></div>
            </div>
              <div class="btnseparator"></div>

            <div id="showdaybtn" class="fbutton">
                <div><span title='Día' class="showdayview">Día</span></div>
            </div>
              <div  id="showweekbtn" class="fbutton fcurrent">
                <div><span title='Semana' class="showweekview">Semana</span></div>
            </div>
              <div  id="showmonthbtn" class="fbutton">
                <div><span title='Mes' class="showmonthview">Mes</span></div>

            </div>
            <div class="btnseparator"></div>
              <div  id="showreflashbtn" class="fbutton">
                <div><span title='Actualizar datos' class="showdayflash">Actualizar</span></div>
                </div>
             <div class="btnseparator"></div>
            <div id="sfprevbtn" title="Anterior"  class="fbutton">
              <span class="fprev"></span>

            </div>
            <div id="sfnextbtn" title="Siguiente" class="fbutton">
                <span class="fnext"></span>
            </div>
            <div class="fshowdatep fbutton">
                    <div>
                        <input type="hidden" name="txtshow" id="hdtxtshow" />
                        <span id="txtdatetimeshow">Calendario</span>

                    </div>
            </div>
            
            <div class="btnseparator"></div>

            <div id="showdaybtn" class="fbutton">
						<?php if($kontrol =='S') {?>
						    <div><a href="../../sub_index.php"><span title='Cerrar' class="showcloseview">Cerrar</span></a></div>
						<?php } else { ?>
                <div><a href="../../gestionn.php"><span title='Cerrar' class="showcloseview">Cerrar</span></a></div>
					  <?php } ?>
            </div>
            
            <div class="clear"></div>
            </div>
      </div>
      <div style="padding:1px;">

        <div class="t1 chromeColor">
            &nbsp;</div>
        <div class="t2 chromeColor">
            &nbsp;</div>
        <div id="dvCalMain" class="calmain printborder">
            <div id="gridcontainer" style="overflow-y: visible;">
            </div>
        </div>
        <div class="t2 chromeColor">

            &nbsp;</div>
        <div class="t1 chromeColor">
            &nbsp;
        </div>   
        </div>
     
  </div>
    
</body>
</html>
<?php mysql_free_result($rs_privilegios); 
}
?>