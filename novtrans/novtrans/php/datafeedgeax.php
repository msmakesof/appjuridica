<?php
include_once("dbconfig.php");
include_once("functions.php");

function addCalendar($st, $et, $sub, $ade){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "insert into jqcalendar (subject, starttime, endtime, isalldayevent) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."' )";
			mysql_query ("SET NAMES 'utf8'");
      mysql_set_charset('utf8');
    //echo($sql);
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Registro Grabado correctamente.';
      $ret['Data'] = mysql_insert_id();
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}


function addDetailedCalendar($st, $et, $sub, $ade, $dscr, $loc, $ta, $au, $lc, $color, $observacion, $actividad, $tz){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
		
		// para el manejo del color
		$cadena = substr($sub,0,4);
		switch ($cadena) {
				 case "GRN":
						$color = "6"; // azúl
						break;
						
				 case "SUBG":	
						$color = "18"; // rojo
						break;		

					 case "DIRE":
						$color = "13";  // Naranja
						break;																			

				 case "SUBD":	
						$color = "1";  // Lila
						break;

				 case "COOR":		
						$color = "0"; //  Gris
						break;
						
				case "RACO":		
						$color = "21"; // Café
						break;			
			}
		//
    $sql = "insert into jqcalendar (responsable, starttime, endtime, isalldayevent, description, location, tipo_auditoria, auditoria, listachq, color, observacion, actividad) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($dscr)."', '"
      .mysql_real_escape_string($loc)."', '"
      .mysql_real_escape_string($ta)."', '"
			.mysql_real_escape_string($au)."', '"
			.mysql_real_escape_string($lc)."', '"	
			.mysql_real_escape_string($color)."', '"			
			.mysql_real_escape_string($observacion)."', '"
			.mysql_real_escape_string($actividad)."' )";
      //.mysql_real_escape_string($color)."' )";
			mysql_query ("SET NAMES 'utf8'");
      mysql_set_charset('utf8');
    //echo($sql);
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Registro Grabado correctamente.';
      $ret['Data'] = mysql_insert_id();
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function listCalendarByRange($sd, $ed, $resp){
  $ret = array();
  $ret['events'] = array();
  $ret["issort"] =true;
  $ret["start"] = php2JsTime($sd);
  $ret["end"] = php2JsTime($ed);
	$ret["racol"] = trim($pracol);
  $ret['error'] = null;	
	$condi = "";
	
  try{
		require_once("../../../sesion.class.php");
		$sesion = new sesion();
		$usuario = $sesion->get("usuario");

    $db = new DBConnection();
    $db->getConnection();	
		// new mks77
		$sql = "select racolp, ver from empleados where usuario = '$usuario'";
		$handle = mysql_query($sql);
		mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');
		while ($row = mysql_fetch_object($handle)) {
		  $y = $row->racolp;
			$z = $row->ver;
		}
		$todo =  $y.",".$z;
		$todounido = str_replace(",","','",$todo);
		$condi = " and responsable IN ('$todounido') ";
		$condi2 = " and dirigido_a IN ('$y','T') ";
			
			$sql = "select distinct jqcalendar.*, procesos.nombre_res, tipo_lista.nombre_tl, dirigido_hacia.proceson nomdirigido
from jqcalendar 
join listachqxtipoaudit on listachqxtipoaudit.tipo_auditoria = jqcalendar.tipo_auditoria 
and listachqxtipoaudit.id_auditoria = jqcalendar.auditoria and listachqxtipoaudit.id_listacheq = jqcalendar.listachq 
and listachqxtipoaudit.idproceso = jqcalendar.tipolista 
join procesos on procesos.abr2 = jqcalendar.responsable  and procesos.estado = 'A'
left join tipo_lista on tipo_lista.id = jqcalendar.tipolista 
join procesos dirigido_hacia on dirigido_hacia.abr2 = jqcalendar.dirigido_a and dirigido_hacia.estado = 'A'
where starttime between '".php2MySqlTime($sd)."' and '". php2MySqlTime($ed)."' 
and jqcalendar.tipo_auditoria > 0 $condi and jqcalendar.tipolista = 1
UNION
select distinct jqcalendar.*, procesos.nombre_res, tipo_lista.nombre_tl, dirigido_hacia.proceson nomdirigido
from jqcalendar 
join listachqxtipoaudit on listachqxtipoaudit.tipo_auditoria = jqcalendar.tipo_auditoria 
and listachqxtipoaudit.id_auditoria = jqcalendar.auditoria and listachqxtipoaudit.id_listacheq = jqcalendar.listachq 
and listachqxtipoaudit.idproceso = jqcalendar.tipolista 
join procesos on procesos.abr2 = jqcalendar.responsable and procesos.estado = 'A'
left join tipo_lista on tipo_lista.id = jqcalendar.tipolista 
join procesos dirigido_hacia on dirigido_hacia.abr2 = jqcalendar.dirigido_a  and dirigido_hacia.estado = 'A'
where starttime between  '".php2MySqlTime($sd)."' and '". php2MySqlTime($ed)."'
and jqcalendar.tipo_auditoria > 0 and capacitador in ('$y') and jqcalendar.tipolista = 2
UNION
select distinct jqcalendar.*, procesos.nombre_res, tipo_lista.nombre_tl, dirigido_hacia.proceson nomdirigido
from jqcalendar 
join listachqxtipoaudit on listachqxtipoaudit.tipo_auditoria = jqcalendar.tipo_auditoria 
and listachqxtipoaudit.id_auditoria = jqcalendar.auditoria and listachqxtipoaudit.id_listacheq = jqcalendar.listachq 
and listachqxtipoaudit.idproceso = jqcalendar.tipolista 
join procesos on procesos.abr2 = jqcalendar.responsable and procesos.estado = 'A'
left join tipo_lista on tipo_lista.id = jqcalendar.tipolista 
left join procesos dirigido_hacia on dirigido_hacia.abr2 = jqcalendar.dirigido_a and dirigido_hacia.estado = 'A'
where starttime between  '".php2MySqlTime($sd)."' and '". php2MySqlTime($ed)."'
and jqcalendar.tipo_auditoria > 0 $condi2 and jqcalendar.tipolista = 2
UNION
select distinct jqcalendar.*, procesos.nombre_res, tipo_lista.nombre_tl, dirigido_hacia.proceson nomdirigido
from jqcalendar 
join listachqxtipoaudit on listachqxtipoaudit.tipo_auditoria = jqcalendar.tipo_auditoria 
and listachqxtipoaudit.id_auditoria = jqcalendar.auditoria and listachqxtipoaudit.id_listacheq = jqcalendar.listachq 
and listachqxtipoaudit.idproceso = jqcalendar.tipolista 
join procesos on procesos.abr2 = jqcalendar.responsable and procesos.estado = 'A'
left join tipo_lista on tipo_lista.id = jqcalendar.tipolista 
join procesos dirigido_hacia on dirigido_hacia.abr2 = jqcalendar.dirigido_a  and dirigido_hacia.estado = 'A'
where starttime between  '".php2MySqlTime($sd)."' and  '". php2MySqlTime($ed)."' 
and jqcalendar.tipo_auditoria > 0 AND responsable = '$y' and jqcalendar.tipolista = 3
UNION
select distinct jqcalendar.*, procesos.nombre_res, tipo_lista.nombre_tl, dirigido_hacia.proceson nomdirigido
from jqcalendar 
join listachqxtipoaudit on listachqxtipoaudit.tipo_auditoria = jqcalendar.tipo_auditoria 
and listachqxtipoaudit.id_auditoria = jqcalendar.auditoria and listachqxtipoaudit.id_listacheq = jqcalendar.listachq 
and listachqxtipoaudit.idproceso = jqcalendar.tipolista 
join procesos on procesos.abr2 = jqcalendar.responsable and procesos.estado = 'A' 
left join tipo_lista on tipo_lista.id = jqcalendar.tipolista 
join procesos dirigido_hacia on dirigido_hacia.abr2 = jqcalendar.dirigido_a  and dirigido_hacia.estado = 'A'
where starttime between  '".php2MySqlTime($sd)."' and  '". php2MySqlTime($ed)."' 
and jqcalendar.tipo_auditoria > 0 and dirigido_a in ('$y') and jqcalendar.tipolista = 3
order by StartTime, responsable ";
// and responsable IN ('$y')			
			
    //echo $sql;	
		$handle = mysql_query($sql);
		mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');
		
    while ($row = mysql_fetch_object($handle)) {
      //$ret['events'][] = $row;
      //$attends = $row->AttendeeNames;
      //if($row->OtherAttendee){
      //  $attends .= $row->OtherAttendee;
      //}
      //echo $row->StartTime;
			$imgg = "";
			$fx_dirigido_a = "";
			if($row->observacion != "")
			{
			 		//$imgg = "<img src='../../../imgs/verif.gif'>";  //$row->imagen;
					$imgg = "<span style='float:none;color:#FFFF00;'>■</span>"; 
			}
			
			$txt_dirigido_a = ""; 
			if($row->tipolista > 1)
			{
					if($row->dirigido_a == "$y" && $row->responsable == "$y")
					{$fx_dirigido_a = "<span style='float:none;color:#C00;'>*</span>";}	
					//$txt_dirigido_a = " - Dirigido a: ".$row->nomdirigido."   "; 
					$var_dirigido_a= $row->dirigido_a;
					if($var_dirigido_a == 'T'){$var_dirigido_a = "Todos";}
					$txt_dirigido_a = " - Dirigido a: ".$var_dirigido_a."   "; 
			}
			
      $ret['events'][] = array(
        $row->Id,							
				$fx_dirigido_a." ".$imgg."  - ".$row->responsable." - ".$row->actividad.'  ',
        php2JsTime(mySql2PhpTime($row->StartTime)),
        php2JsTime(mySql2PhpTime($row->EndTime)),
        $row->IsAllDayEvent,
        0, //more than one day event
        //$row->InstanceType,
        0,//Recurring event,
        $row->Color,
        1,//editable
        $row->responsable." - ".$row->nombre_res."   ",
				 //$row->nombre_tl." $txt_dirigido_a ",
				 $row->nombre_tl." $txt_dirigido_a ",
				 $row->tipo_auditoria,
 				 $row->auditoria,
 				 $row->listachq,
				 $row->itemlc,
				 $row->observacion,				 
        ''//$attends
      );
    }
	}catch(Exception $e){
     $ret['error'] = $e->getMessage();
  }
  return $ret;
}

function listCalendar($day, $type){
  $phpTime = js2PhpTime($day);
  //echo $phpTime . "+" . $type;
	$resp = $obs;  // nuevo
  switch($type){
    case "month":
      $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime)+1, 1, date("Y", $phpTime));
      break;
    case "week":
      //suppose first day of a week is monday 
      $monday  =  date("d", $phpTime) - date('N', $phpTime) + 1;
      //echo date('N', $phpTime);
      $st = mktime(0,0,0,date("m", $phpTime), $monday, date("Y", $phpTime));
      $et = mktime(0,0,-1,date("m", $phpTime), $monday+7, date("Y", $phpTime));
      break;
    case "day":
      $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime)+1, date("Y", $phpTime));
      break;
  }
  //echo $st . "--" . $et;
  return listCalendarByRange($st, $et, $resp);
}

function updateCalendar($id, $st, $et){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "update jqcalendar set"
      . " starttime='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " endtime='" . php2MySqlTime(js2PhpTime($et)) . "' "
      . "where id=" . $id;
			mysql_query ("SET NAMES 'utf8'");
      mysql_set_charset('utf8');
    //echo $sql;
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Registro Actualizado correctamente.';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function updateDetailedCalendar($id, $st, $et, $sub, $ade, $dscr, $loc, $ta, $au, $lc, $color, $observacion, $actividad, $tz){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "update jqcalendar set"
      . " starttime='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " endtime='" . php2MySqlTime(js2PhpTime($et)) . "', "
      . " responsable='" . mysql_real_escape_string($sub) . "', "
      . " isalldayevent='" . mysql_real_escape_string($ade) . "', "
      . " description='" . mysql_real_escape_string($dscr) . "', "
      . " location='" . mysql_real_escape_string($loc) . "', "
			. " tipo_auditoria='" . mysql_real_escape_string($ta) . "', "
			. " auditoria='" . mysql_real_escape_string($au) . "', "
			. " listachq='" . mysql_real_escape_string($lc) . "', "
      . " color='" . mysql_real_escape_string($color) . "', "
			. " observacion='" . mysql_real_escape_string($observacion) . "', "
			. " actividad='" . mysql_real_escape_string($actividad) . "' "							
      . "where id=" . $id;
    //echo $sql;
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Registro Actualizado correctamente.';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function removeCalendar($id){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "delete from jqcalendar where id=" . $id;
	if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Registro Borrado correctamente.';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}




header('Content-type:text/javascript;charset=UTF-8');
$method = $_GET["method"];
$resp = strtoupper($_GET["proc"]);
switch ($method) {
    case "add":
        $ret = addCalendar($_POST["CalendarStartTime"], $_POST["CalendarEndTime"], $_POST["CalendarTitle"], $_POST["IsAllDayEvent"]);
        break;
    case "list":
        $ret = listCalendar($_POST["showdate"], $_POST["viewtype"], $resp); 
        break;
    case "update":
        $ret = updateCalendar($_POST["calendarId"], $_POST["CalendarStartTime"], $_POST["CalendarEndTime"]);
        break; 
    case "remove":
        $ret = removeCalendar( $_POST["calendarId"]);
        break;
    case "adddetails":
        $st = $_POST["stpartdate"] . " " . $_POST["stparttime"];
        $et = $_POST["etpartdate"] . " " . $_POST["etparttime"];
        if(isset($_GET["id"])){
            $ret = updateDetailedCalendar($_GET["id"], $st, $et, 
                $_POST["responsable"], isset($_POST["IsAllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["ta"], $_POST["au"], $_POST["lc"], $_POST["colorvalue"], $_POST["observacion"], $_POST["actividad"], $_POST["timezone"]);
        }else{
            $ret = addDetailedCalendar($st, $et,                    
                $_POST["responsable"], isset($_POST["IsAllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["ta"], $_POST["au"], $_POST["lc"], $_POST["colorvalue"], $_POST["observacion"], $_POST["actividad"], $_POST["timezone"]);
        }        
        break;
}
echo json_encode($ret); 
?>