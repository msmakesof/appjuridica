<?php require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
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

date_default_timezone_set('America/Bogota');

$empresa ="";
if(isset($_POST['empresa'])){
  $empresa = trim($_POST['empresa']);
}

$tipodocumento ="";
if(isset($_POST['tipodocumento'])){
  $tipodocumento = trim($_POST['tipodocumento']);
}

$identificacion ="";
if(isset($_POST['identificacion'])){
  $identificacion = trim($_POST['identificacion']);
}

$nombre1 ="";
if(isset($_POST['nombre1'])){
  $nombre1 = trim($_POST['nombre1']);
  $nombre1 = str_replace(" ","%20",strtoupper($nombre1));  
}

$nombre2 ="";
if(isset($_POST['nombre2']) && !empty($_POST['nombre2'])){
  $nombre2 = trim($_POST['nombre2']);
  $nombre2 = str_replace(" ","%20",strtoupper($nombre2));
}

$apellido1 ="";
if(isset($_POST['apellido1']) && !empty($_POST['apellido1'])){
  $apellido1 = trim($_POST['apellido1']);
  $apellido1 = str_replace(" ","%20",strtoupper($apellido1));  
}

$apellido2 ="";
if(isset($_POST['apellido2']) && !empty($_POST['apellido2'])){
  $apellido2 = trim($_POST['apellido2']);
  $apellido2 = str_replace(" ","%20",strtoupper($apellido2));  
}

$email ="";
if(isset($_POST['email'])){
  $email = trim(strtolower($_POST['email']));
}

$celular ="";
if(isset($_POST['celular'])){
  $celular = trim($_POST['celular']);
}

$fijo ="";
if(isset($_POST['fijo'])){
  $fijo = trim($_POST['fijo']);
}

$estado ="";
if(isset($_POST['estado'])){
  $estado = trim($_POST['estado']);
}

$ciudad="";
if(isset($_POST['ciudad'])){
  $ciudad = trim($_POST['ciudad']);
}

$usuario ="";
if(isset($_POST['usuario'])){
  $usuario = trim($_POST['usuario']);
}

$fechacreado = date("Y-m-d H:i:s");
$fechacreado = str_replace(" ","%20",$fechacreado); 

require_once('../../Connections/DataConex.php');
//Verifico si existe un usuario con las siguientes caracteristicas
// Nombres iguales o nro documento igual o email igual
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
  $parameters = "ExisteUsuario=1&Identificacion=$identificacion&Nombre1=$nombre1&Nombre2=$nombre2&Apellido1=$apellido1&Apellido2=$apellido2&Email=$email&TipoDocumento=$tipodocumento";
  $url = urlServicios."consultadetalle/consultadetalle_ContactoEmpresa.php?".$parameters;
  //echo "<script> console.log('Existe Contacto...".$url."')</script>" ;
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
    $existe = $m['emp_contactoempresa']['existe'];
    if($existe > 0)
    {
      $sigue = "E-Existe un Contacto registrado con el mismo Nombre o Número de Identificación o Email.";
    }
    else
    {
      /*
      $llave = $GLOBALS['secret_key'];
      $interno = rand(10000000,100000123456789);
      $local = rand(10000000,1234567890000);
      //$clave = encryptor('encrypt',$clave);
	  */
		$idusuariomodifica = 0;
		$fechamodifica = date("Y-m-d H:i:s");
		$fechamodifica = str_replace(" ","%20",$fechamodifica); 
		$parameters = "insert=insert&IdEmpresa=$empresa&TipoDocumento=$tipodocumento&Identificacion=$identificacion&Nombre1=$nombre1&Nombre2=$nombre2&Apellido1=$apellido1&Apellido2=$apellido2&Email=$email&Celular=$celular&Fijo=$fijo&Estado=$estado&Ciudad=$ciudad&Usuario=$usuario&FechaCreado=$fechacreado&IdUsuarioModifica=$idusuariomodifica&FechaModifica=$fechamodifica";
           
      $soportecURL = "S";
      $url         = urlServicios."consultadetalle/consultadetalle_ContactoEmpresa.php?".$parameters;
      $existe      = "";
      $usulocal    = "";
      $sigue       = "";
	  //echo("<script>console.log('PHP Creacliente: ".$url."');</script>");
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
            $grabadoOK = $m['emp_contactoempresa'];
            if(!$grabadoOK)
            {
              $sigue = "N-Registro NO ha sido grabado.";
            }
            else
            {
              $sigue = "S-Registro grabado Correctamente. $url";
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
echo $sigue;
?>