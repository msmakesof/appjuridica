<?php require_once('../../Connections/cnn_kn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) 
{
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    if (PHP_VERSION < 6) 
    {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) 
    {
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
$envia = "";
mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_usuarios = "SELECT IdTipoDocumento, NombreTipoDocumento, Estado FROM tipodocumento ORDER BY NombreTipoDocumento ;" ;
$rs_usuarios = mysqli_query($cnn_kn, $query_rs_usuarios) or die(mysqli_error()."Err.....$query_rs_usuarios<br>");
$row_rs_usuarios = mysqli_fetch_assoc($rs_usuarios);
$totalRows_rs_usuarios = mysqli_num_rows($rs_usuarios);
$emparray = array();   
  //if ($usuresultado = mysqli_query($cnn_kn, $query_rs_usuarios)) 
  //{    // $envia .='<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">    
   	do 
  		{ 			
  			$idUsuario = $row_rs_usuarios["IdTipoDocumento"];
  			$NombreTipoDocumento = $row_rs_usuarios["NombreTipoDocumento"];
  			$Estado = $row_rs_usuarios["Estado"];

        $emparray[] = array('IdTipoDocumento'=>$idUsuario, 'NombreTipoDocumento' => $NombreTipoDocumento, 'Estado' => $Estado ); 			
  			
  		} while($row_rs_usuarios = mysqli_fetch_assoc($rs_usuarios));            
  //}  
//echo $envia;
echo json_encode($emparray);
mysqli_free_result($rs_usuarios); 
?>
