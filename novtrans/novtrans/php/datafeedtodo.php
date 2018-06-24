<?php
include_once("dbconfig.php");
include_once("functions.php");
function addCalendar($st, $et, $sub, $ade){
  $ret = array();
  try
  {
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
		if(mysql_query($sql)==false)
    {
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }
    else
    {
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Registro Grabado correctamente.';
      $ret['Data'] = mysql_insert_id();
    }
	}
  catch(Exception $e)
  {
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}


function addDetailedCalendar($st, $et, $sub, $ade, $dscr, $loc, $ta, $au, $lc, $color, $tz){
  $ret = array();
  try
  {
    $db = new DBConnection();
    $db->getConnection();
    $sql = "insert into jqcalendar (subject, starttime, endtime, isalldayevent, description, location, tipo_auditoria, auditoria, listachq, color) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($dscr)."', '"
      .mysql_real_escape_string($loc)."', '"
      .mysql_real_escape_string($ta)."', '"
			.mysql_real_escape_string($au)."', '"
			.mysql_real_escape_string($lc)."', "			
			."'13' )";
      //.mysql_real_escape_string($color)."' )";
			mysql_query ("SET NAMES 'utf8'");
      mysql_set_charset('utf8');
    //echo($sql);
		if(mysql_query($sql)==false)
    {
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }
    else
    {
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Registro Grabado correctamente.';
      $ret['Data'] = mysql_insert_id();
    }
	}
  catch(Exception $e)
  {
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function listCalendarByRange($sd, $ed)
{

  $ret = array();
  $ret['events'] = array();
  $ret["issort"] =true;
  $ret["start"] = php2JsTime($sd);
  $ret["end"] = php2JsTime($ed);  
  $ret["desde"] = ($sd);
  $ret["hasta"] = ($ed);
  $ret['error'] = null;
	$condi = "";
	
  try{
    $db = new DBConnection();
    $db->getConnection();

    $sql = "SELECT jqcalendar.*, NombreSucursal, NombreSalon, NombreMateria, NombreNivel, horario.Inicio, horario.Final, concat_WS(' ', Nombres_PRO, Apellido1_PRO) AS NombreProfesor
    FROM jqcalendar 
    JOIN sucursal ON jqcalendar.Sede = sucursal.IdSucursal AND sucursal.EstadoSucursal = 1
    JOIN salon ON jqcalendar.Salon = salon.IdSalon AND salon.Estado = 1 
    JOIN materia ON jqcalendar.Materia = materia.IdMateria AND materia.Estado = 1 
    JOIN nivel ON jqcalendar.Nivel = nivel.IdNivel AND nivel.Estado = 1
    JOIN horario ON jqcalendar.Horario = horario.IdHorario  AND horario.Estado = 1
    JOIN profesores ON jqcalendar.Profesor = profesores.IdProfesor  AND profesores.Estado_PRO = 1
    WHERE desde between '".php2MySqlTime($sd)."' AND '". php2MySqlTime($ed)."' $condi ORDER BY desde, NombreNivel, NombreMateria ;";

    //echo "sql...$sql<br>";	
		$handle = mysql_query($sql);
		mysql_query ("SET NAMES 'utf8'");
    mysql_set_charset('utf8');
		
      //$imgg = "";
      //$imgg = "<span style='float:none;color:#fff;'>■</span>"; 
    while ($row = mysql_fetch_object($handle)) 
    {    
      
      $ret['events'][] = array(
        $row->Id,        
        $row->Inicio." ".$row->Final." - ".$row->NombreNivel." - ".$row->NombreMateria.'  ',
        ////$row->StartTime." ".$row->EndTime." - ".$row->NombreNivel." - ".$row->NombreMateria.'  ',
        php2JsTime(mySql2PhpTime($row->IdEvento)),
        php2JsTime(mySql2PhpTime($row->IdEvento)),
        $row->Final,
        0, //more than one day event        
        0,//Recurring event,
        php2JsTime(mySql2PhpTime($row->Inicio)),
        1,//editable       
         $row->NombreProfesor,         
         $row->NombreSucursal, 
         $row->NombreSalon,          
         $row->desde,
         $row->hasta,
        ''
      );
    }


    /*
    while ($row = mysql_fetch_object($handle)) 
    {
      //$ret['events'][] = $row;
      //$attends = $row->AttendeeNames;
      //if($row->OtherAttendee){
      //  $attends .= $row->OtherAttendee;
      //}
      //echo $row->StartTime;
			$imgg = "";
			//$imgg = "<span style='float:none;color:#fff;'>■</span>"; 
			$ret['events'][] = array(
        $row->Id,
        //$row->actividad."   ",
				$imgg." - ".$row->NombreNivel." - ".$row->NombreMateria.'  ',
        php2JsTime(mySql2PhpTime($row->IdEvento)),
        php2JsTime(mySql2PhpTime($row->IdEvento)),
        $row->Final,
        0, //more than one day event        
        0,//Recurring event,
        php2JsTime(mySql2PhpTime($row->Inicio)),
        1,//editable       
				 $row->NombreProfesor,         
				 $row->NombreSucursal, 
				 $row->NombreSalon, 				 
 				 $row->desde,
				 $row->hasta,
        ''//$attends
      );
    }
    */
	}
  catch(Exception $e)
  {
     $ret['error'] = $e->getMessage();
  }
  return $ret;
}

function listCalendar($day, $type){
  $phpTime = js2PhpTime($day);
  //echo $phpTime . "+" . $type;
  switch($type)
  {
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
  return listCalendarByRange($st, $et);
}

function updateCalendar($id, $st, $et){
  $ret = array();
  try
  {
    $db = new DBConnection();
    $db->getConnection();
    $sql = "update jqcalendar set"
      . " starttime='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " endtime='" . php2MySqlTime(js2PhpTime($et)) . "' "
      . "where id=" . $id;
			mysql_query ("SET NAMES 'utf8'");
      mysql_set_charset('utf8');
    //echo $sql;
		if(mysql_query($sql)==false)
    {
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }
    else
    {
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Registro Actualizado correctamente.';
    }
	}
  catch(Exception $e)
  {
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function updateDetailedCalendar($id, $st, $et, $sub, $ade, $dscr, $loc, $ta, $au, $lc, $color, $tz){
  $ret = array();
  try
  {
    $db = new DBConnection();
    $db->getConnection();
    $sql = "update jqcalendar set"
      . " starttime='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " endtime='" . php2MySqlTime(js2PhpTime($et)) . "', "
      . " subject='" . mysql_real_escape_string($sub) . "', "
      . " isalldayevent='" . mysql_real_escape_string($ade) . "', "
      . " description='" . mysql_real_escape_string($dscr) . "', "
      . " location='" . mysql_real_escape_string($loc) . "', "
			. " tipo_auditoria='" . mysql_real_escape_string($ta) . "', "
			. " auditoria='" . mysql_real_escape_string($au) . "', "
			. " listachq='" . mysql_real_escape_string($lc) . "', "
			//. " color='13' "
      . " color='" . mysql_real_escape_string($color) . "' "
      . "where id=" . $id;
    //echo $sql;
		if(mysql_query($sql)==false)
    {
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }
    else
    {
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Registro Actualizado correctamente.';
    }
	}
  catch(Exception $e)
  {
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
    $sql = "DELETE FROM jqcalendar where id=" . $id;
  	if(mysql_query($sql)==false)
    {
        $ret['IsSuccess'] = false;
        $ret['Msg'] = mysql_error();
      
    }
    else
    {
        $ret['IsSuccess'] = true;
        $ret['Msg'] = 'Registro Borrado correctamente.';
    }
	}
  catch(Exception $e)
  {
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}


header('Content-type:text/javascript;charset=UTF-8');
$method = $_GET["method"];
//echo "metod todo......$method<br>";

switch ($method) 
{
    case "add":
        $ret = addCalendar($_POST["CalendarStartTime"], $_POST["CalendarEndTime"], $_POST["CalendarTitle"], $_POST["IsAllDayEvent"]);
        break;
    case "list":
        $ret = listCalendar($_POST["showdate"], $_POST["viewtype"]);
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
        if(isset($_GET["id"]))
        {
          $ret = updateDetailedCalendar($_GET["id"], $st, $et, 
          $_POST["Subject"], isset($_POST["IsAllDayEvent"])?1:0, $_POST["Description"], 
          $_POST["Location"], $_POST["ta"], $_POST["au"], $_POST["lc"], $_POST["colorvalue"], $_POST["timezone"]);
        }
        else
        {
          $ret = addDetailedCalendar($st, $et,                    
          $_POST["Subject"], isset($_POST["IsAllDayEvent"])?1:0, $_POST["Description"], 
          $_POST["Location"], $_POST["ta"], $_POST["au"], $_POST["lc"], $_POST["colorvalue"], $_POST["timezone"]);
        }        
        break;
}
echo json_encode($ret); 
?>