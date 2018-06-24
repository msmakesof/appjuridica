<?php
class DBConnection{	
	function getConnection(){		
			
//		  require_once('../../../Connections/cnn_plan_mejora.php');
//			mysql_select_db($database_cnn_plan_mejora, $cnn_plan_mejora);
//			$query_rs_data = "SELECT * FROM config_Data ;";
//			$rs_data = mysql_query($query_rs_data, $cnn_plan_mejora) or die(mysql_error());
//			$row_rs_data = mysql_fetch_assoc($rs_data);
//			$totalRows_rs_data = mysql_num_rows($rs_data);
//			
//			$servidor= $row_rs_data['servidor'];
//			$datab= $row_rs_data['datab'];
//			$usudata= $row_rs_data['usuario'];
//			$usuclave= $row_rs_data['clave'];
//			mysql_free_result($rs_data);
			
			//mysql_connect("$servidor","$usudata","$usuclave") or die("Could not connect: " . mysql_error());
			//mysql_select_db("$datab") or die("Could not select database: " . mysql_error());
			
			mysql_connect("localhost","root","") or die("Could not connect: " . mysql_error());
			mysql_select_db("ci") or die("Could not select database: " . mysql_error());
			mysql_query ("SET NAMES 'utf8'");
      mysql_set_charset('utf8');
	}
}
?>