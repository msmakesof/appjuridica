<?php 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
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

$pnombre ="";
if( isset($_POST['pnombre']) )
{
	  $pnombre = trim($_POST['pnombre']);
}

$pnombremostrar ="";
if( isset($_POST['pnombremostrar']) )
{
	  $pnombremostrar = trim($_POST['pnombremostrar']);
}

$pestado ="";
if( isset($_POST['pestado']) )
{
	  $pestado = trim($_POST['pestado']);
}

require_once('../../Connections/DataConex.php');
//Verifico si existe una Tabla con las siguientes caracteristicas
// Nombres iguales 
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
  $parameters = "ExisteTabla=1&Nombre=$pnombre&Nombremostrar=$pnombremostrar";
  $url = urlServicios."consultadetalle/consultadetalle_gen_tabla.php?".$parameters;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_VERBOSE, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_POST, 0);

  $resultado = curl_exec ($ch);         
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $curl_errno= curl_errno($ch);
  curl_close($ch);

  if($resultado === false || $curl_errno > 0)
  {
      //echo 'Curl error: ' . curl_error($ch);
      $sigue = "N - Curl Error: " . $curl_errno;
  }
  else
  {          
    
    $m = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $m = json_decode($m, true);
    //print_r ($m);
    $existe = $m['gen_tabla']['existe'];
    if($existe > 0)
    {
      $sigue = "E-Existe una Tabla registrado con el mismo Nombre.";
    }
    else
    {
      //
      // $llave = $GLOBALS['secret_key'];
      // $interno = rand(10000000,100000123456789);
      // $local = rand(10000000,1234567890000);
      // $clave = encryptor('encrypt',$clave);
      //$parameters = "insert=insert&TipoDocumento=$tipodocumento&Identificacion=$numerodocumento&PrimerApellido=$apellido1&SegundoApellido=$apellido2&Nombre=$nombre&Email=$email&Direccion=$direccion&Celular=$celular&Usuario=$email&Clave=$clave&TipoUsuario=$tipousuario&Estado=$estado&IdInterno=$interno&Local=$local";
      //$parameters = array("insert" => "insert", "TipoDocumento" => "$tipodocumento","Identificacion" => "$numerodocumento","PrimerApellido" => "$apellido1", "SegundoApellido" => "$apellido2","Nombre" => "$nombre","Email" => "$email", "Direccion" => "$direccion","Celular" => "$celular", "Usuario" => "$email", "Clave" => "$clave", "TipoUsuario" => "$tipousuario", "Estado" => "$estado", "IdInterno" => "$interno", "Local" => "$local");

      $parameters = "insert=insert&Nombre=$pnombre&Nombremostrar=$pnombremostrar";
      $soportecURL = "S";
      $url         = urlServicios."consultadetalle/consultadetalle_gen_tabla.php?".$parameters;
      $existe      = "";
      $usulocal    = "";
      $sigue       = "";
      //$verbose = fopen("php://appjuridica/tempoErr", 'w');
      if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
      {    
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_VERBOSE, true);
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_TIMEOUT, 30);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
          curl_setopt($ch, CURLOPT_POST, 0);          
          //curl_setopt($handle, CURLOPT_STDERR, $verbose);
          //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));    

          $resultado = curl_exec ($ch);         
          $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          $curl_errno = curl_errno($ch);
          $curl_msj = curl_error($ch) ;
          curl_close($ch);
          
          if($resultado === false || $curl_errno > 0)
          {
              //echo 'Curl error: ' . curl_error($ch);
              $sigue = "N-Se presentó problema... ". $curl_errno.' '.$curl_msj;
          }
          else
          {          
            //echo "Curl Err_no returned.... $curl_errno <br/>";
            $m = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
            $m = json_decode($m, true);
            $grabadoOK = $m['gen_tabla'];
            if(!$grabadoOK)
            {
              $sigue = "N-Registro NO ha sido grabado.";
            }
            else
            {
              $sigue = "S-Registro grabado Correctamente.";
            }  
          }

          $json_errors = array(
            JSON_ERROR_NONE => 'No se ha producido ningún error',
            JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
            JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
            JSON_ERROR_SYNTAX => 'Error de Sintaxis',
          );
            //echo "Error : ", $json_errors[json_last_error()], PHP_EOL, PHP_EOL."<br>";        
      }
      else
      {
          $soportecURL = "N";
          //echo "No hay soporte para cURL";
          $sigue ="N-No hay soporte para cURL";
      } 

      if($soportecURL == "N")
      {
          require_once('./unirest/vendor/autoload.php');
          $response = Unirest\Request::get($url, array("X-Mashape-Key" => "MY SECRET KEY"));
          $resultado = $response->raw_body;
          $resultado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);
          $m = json_decode($resultado, true);	        
      }
      //
    }
    
  }

}  



// $strowreg =0;
// $row_rs_tabla = 0;
// mysqli_select_db($cnn_kn, $database_cnn_kn);
// $query_rs_tabla = "SELECT Id_Tabla, Id_EstadoTabla FROM gen_tablas WHERE trim(Nombre_Tabla) = '$pnombre' ;" ;
// //echo "qry_usu......$query_rs_tabla" ;
// $rs_tabla = mysqli_query($cnn_kn, $query_rs_tabla) or die(mysqli_error()."Err Ln53.....$query_rs_tabla<br>");
// $row_rs_tabla = mysqli_fetch_assoc($rs_tabla);
// $totalRows_rs_tabla = mysqli_num_rows($rs_tabla);

// while( $strowreg = mysqli_fetch_array($rs_tabla, MYSQLI_ASSOC) )
// { 
// 	$idciudad = $strowreg["Id_Tabla"];
// 	$estadociudad = $strowreg["Id_EstadoTabla"];
// }

// $sigue   = "";
// $Result1 = "";
// if( $row_rs_tabla >= 1 )
// {
//    //echo "<span style='clear:both;width:100%;background-color:#900; color:#FFF; font-size:10.5px; font-family:verdana; text-align:center; padding:5px'> * Tabla: $pnombre !Ya se encuentra registrada.<span>";
//       $sigue="E";
// }
// else
// {
// 	//mysqli_next_result($cnn_ok); //función clave 	
// 	$insertSQL = "INSERT INTO gen_tablas (Nombre_Tabla, Id_EstadoTabla) VALUES ('$pnombre', $pestado);";
// 	//echo "insert......$insertSQL<br>";	
// 	 mysqli_select_db($cnn_kn, $database_cnn_kn);
// 	 $Result1 = mysqli_query($cnn_kn, $insertSQL) or die(mysqli_error()."Err Ln72....$insertSQL<br>");
// }

// if( $Result1 )
// {	   
// 	  $sigue="S";
// }	 
echo $sigue;

// mysqli_free_result($rs_tabla);
// mysqli_close($cnn_kn);
?>