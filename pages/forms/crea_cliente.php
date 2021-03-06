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
$fechaCreado = date('Y-m-d g:ia');

$tipodocumento ="";
if(isset($_POST['tipodocumento'])){
  $tipodocumento = trim($_POST['tipodocumento']);
}

$numerodocumento ="";
if(isset($_POST['numerodocumento'])){
  $numerodocumento = trim($_POST['numerodocumento']);
}

$nombre ="";
if(isset($_POST['nombre'])){
  $nombre = trim($_POST['nombre']);
  $nombre = str_replace(" ","%20",$nombre);  
}

$apellido1 ="";
if(isset($_POST['apellido1'])){
  $apellido1 = trim($_POST['apellido1']);
  $apellido1 = str_replace(" ","%20",$apellido1);  
}

$apellido2 ="";
if(isset($_POST['apellido2'])){
  $apellido2 = trim($_POST['apellido2']);
  $apellido2 = str_replace(" ","%20",$apellido2);
}

$clave ="";
if(isset($_POST['clave'])){
  $clave = trim($_POST['clave']);
}
$direccion ="";
if(isset($_POST['direccion'])){
  $direccion = trim($_POST['direccion']);  
  $direccion = str_replace(' ', '%20', $direccion);
  $direccion = str_replace('#',"No.", $direccion);  
}

$email ="";
if(isset($_POST['email'])){
  $email = trim($_POST['email']);
}

$celular ="";
if(isset($_POST['celular'])){
  $celular = trim($_POST['celular']);
}

$tipocliente ="";
if(isset($_POST['tipocliente'])){
  $tipocliente = trim($_POST['tipocliente']);
}

$verseguimiento =0;
if(isset($_POST['verseguimiento'])){
  $verseguimiento = trim($_POST['verseguimiento']);
  if($verseguimiento == "on")
  {
	  $verseguimiento = 1;
  }
}

$estado ="";
if(isset($_POST['estado'])){
  $estado = trim($_POST['estado']);
}

$empresa = "";
if(isset($_POST['empresa'])){
  $empresa = trim($_POST['empresa']);
}

$usuariocrea = "";
if(isset($_POST['uc'])){
  $usuariocrea = trim($_POST['uc']);
}

$tipodocumentorl ="";
if(isset($_POST['tipodocumentorl'])){
  $tipodocumentorl = trim($_POST['tipodocumentorl']);
}

$numerodocumentorl ="";
if(isset($_POST['numerodocumentorl'])){
  $numerodocumentorl = trim($_POST['numerodocumentorl']);
}

$nombrerl ="";
if(isset($_POST['nombrerl'])){
  $nombrerl = trim($_POST['nombrerl']);
  $nombrerl = str_replace(" ","%20",$nombrerl);  
}

$apellido1rl ="";
if(isset($_POST['apellido1rl'])){
  $apellido1rl = trim($_POST['apellido1rl']);
  $apellido1rl = str_replace(" ","%20",$apellido1rl);  
}

$emailrl ="";
if(isset($_POST['emailrl'])){
  $emailrl = trim($_POST['emailrl']);
}

$celularrl ="";
if(isset($_POST['celularrl'])){
  $celularrl = trim($_POST['celularrl']);
}

$tipodocumentorl2 ="";
if(isset($_POST['tipodocumentorl2'])){
  $tipodocumentorl2 = trim($_POST['tipodocumentorl2']);
}

$numerodocumentorl2 ="";
if(isset($_POST['numerodocumentorl2'])){
  $numerodocumentorl2 = trim($_POST['numerodocumentorl2']);
}

$nombrerl2 ="";
if(isset($_POST['nombrerl2'])){
  $nombrerl2 = trim($_POST['nombrerl2']);
  $nombrerl2 = str_replace(" ","%20",$nombrerl2);  
}

$apellidosrl2 ="";
if(isset($_POST['apellidosrl2'])){
  $apellidosrl2 = trim($_POST['apellidosrl2']);
  $apellidosrl2 = str_replace(" ","%20",$apellidosrl2);  
}

$emailrl2 ="";
if(isset($_POST['emailrl2'])){
  $emailrl2 = trim($_POST['emailrl2']);
}

$celularrl2 ="";
if(isset($_POST['celularrl2'])){
  $celularrl2 = trim($_POST['celularrl2']);
}

$casaapto = "";
if(isset($_POST['casaapto'])){
  $casaapto = trim($_POST['casaapto']);
}

$tipoinmueble = "";
if(isset($_POST['tipoinmueble'])){
  $tipoinmueble = trim($_POST['tipoinmueble']);
}


require_once('../../Connections/DataConex.php');
//Verifico si existe un usuario con las siguientes caracteristicas
// Nombres iguales o nro documento igual o email igual
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
  $parameters = "ExisteUsuario=1&Identificacion=$numerodocumento&PrimerApellido=$apellido1&SegundoApellido=$apellido2&Nombre=$nombre&Email=$email&TipoCliente=$tipocliente&IdCliente=0";
  $url = urlServicios."consultadetalle/consultadetalle_Cliente.php?".$parameters;
  //echo "<script>console.log('existe CLI...'+$url);</script>";
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
    $existe = $m['cli_cliente']['existe'];
    if($existe > 0)
    {
      $sigue = "E-Existe un Cliente registrado con el mismo Nombre o Número de Identificación.";
    }
    else
    {
      //
      $llave = $GLOBALS['secret_key'];
      $interno = rand(10000000,100000123456789);
      $local = rand(10000000,1234567890000);
      $clave = encryptor('encrypt',$clave);
		
      $parameters = "insert=insert&TipoDocumento=$tipodocumento&Identificacion=$numerodocumento&PrimerApellido=$apellido1&SegundoApellido=$apellido2&Nombre=$nombre&Email=$email&Direccion=$direccion&Celular=$celular&Usuario=$email&Clave=$clave&Estado=$estado&IdInterno=$interno&Local=$local&Verseguimiento=$verseguimiento&TipoCliente=$tipocliente&Empresa=$empresa&UsuarioCrea=$usuariocrea&TipoDocumentorl=$tipodocumentorl&Identificacionrl=$numerodocumentorl&Nombrerl=$nombrerl&Apellido1rl=$apellido1rl&Emailrl=$emailrl&Celularrl=$celularrl&TipoDocumentorl2=$tipodocumentorl2&Identificacionrl2=$numerodocumentorl2&Nombrerl2=$nombrerl2&Apellidosrl2=$apellidosrl2&Emailrl2=$emailrl2&Celularrl2=$celularrl2&CasaApto=$casaapto&TipoInmueble=$tipoinmueble";
      $soportecURL = "S";
      $url         = urlServicios."consultadetalle/consultadetalle_Cliente.php?".$parameters;
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
            $grabadoOK = $m['cli_cliente'];
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
echo $sigue;
?>