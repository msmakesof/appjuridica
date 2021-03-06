<?php
include_once("../tables/header.inc.php");
require_once ('../../Connections/DataConex.php');

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

$pproceso ="";
if( isset($_POST['idproceso']) )
{
    $pproceso = trim($_POST['idproceso']);
}

$pfechainicio ="";
if( isset($_POST['fechainicio']) )
{
    $pfechainicio = trim($_POST['fechainicio']);
}

$porigen ="";
if( isset($_POST['origen']) )
{
    $porigen = trim($_POST['origen']);
}

$pactpro ="";
if( isset($_POST['actpro']) )
{
    $pactpro = trim($_POST['actpro']);
}

$pfechaestado ="";
if( isset($_POST['fechaestado']) )
{
    $pfechaestado = trim($_POST['fechaestado']);
}

//echo "fecEstado...".$pfechaestado;

$pobservacion ="";
if( isset($_POST['observacion']) )
{
    $pobservacion = trim($_POST['observacion']);
	$pobservacion = str_replace(' ','%20', $pobservacion);
}

$pgasto ="";
if( isset($_POST['gasto']) )
{
    $pgasto = trim($_POST['gasto']);
	if ($pgasto =="")
	{
		$pgasto = 0;
	}
}

$dh = 0;
if(isset($_POST['dh'])){
	$dh = trim($_POST['dh']);
}
$re = "";
if(isset($_POST['re'])){
	$re = trim($_POST['re']);
}
$dr = 0;
if(isset($_POST['dr'])){
	$dr = trim($_POST['dr']);
}

//require_once('../../Connections/DataConex.php');
//Verifico si existe una Tabla con las siguientes caracteristicas
// Nombres iguales 
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
  $parameters = "ExisteActPro=1&Proceso=$pproceso&FechaInicio=$pfechainicio&Origen=$porigen&ActPro=$pactpro&FechaEstado=$pfechaestado&Observacion=$pobservacion";
  $url = urlServicios."consultadetalle/consultadetalle_pro_actuacionprocesal.php?".$parameters;
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
    $existe = $m['pro_actuacionprocesal']['existe'];
    if($existe > 0)
    {
      $sigue = "E-Existe un Proceso registrado con el mismo Código.";
    }
    else
    {      
		$idUsuario = $_SESSION['IdUsuario'];
		$estadoActPro = "1";
		$parameters = "insert=insert&Proceso=$pproceso&Fechainicio=$pfechainicio&Origen=$porigen&ActPro=$pactpro&FechaEstado=$pfechaestado&Observacion=$pobservacion&Usuario=$idUsuario&EstadoActPro=$estadoActPro&Gasto=$pgasto";
		$soportecURL = "S";
		$url         = urlServicios."consultadetalle/consultadetalle_pro_actuacionprocesal.php?".$parameters;
		$existe      = "";
		$usulocal    = "";
		$sigue       = ""; 
		//echo "<script>console.log('ins...'+$url)</script>" ;
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
            $grabadoOK = $m['pro_actuacionprocesal'];
			
            if(!$grabadoOK)
            {
              $sigue = "N-Registro NO ha sido grabado.";
            }
            else
            {
				$sigue = "S-Registro grabado Correctamente.";
			  
				//Tomo el Max(id)
				$parameters = "maxid=maxid";
				$soportecURL = "S";
				$url         = urlServicios."consultadetalle/consultadetalle_pro_actuacionprocesal.php?".$parameters;
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
						$MaxId = $m['pro_actuacionprocesal']['MaxIdProceso'];
						
						//Insertamos en tabla notificar
						$fechaenvio = $pfechaestado;
						$obj = json_decode($dh);
						$dias = $obj->{'1'};
						
						$obj = json_decode($re);
						$re = $obj->{'2'};
						
						$obj = json_decode($dr);
						$dr = $obj->{'3'};
						include('fechahabil.php');
						
						$parameters = "insert=insert&idusuario=$idUsuario&fechahabil=".($FechaHabil)."&idtabla=$MaxId";
						$url = urlServicios."consultadetalle/not_notificar.php?".$parameters;
						//echo "<script>console.log('ins...'+$url)</script>" ;
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
							
							$mestadoactprocesal = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
							$mestadoactprocesal = json_decode($mestadoactprocesal, true); 
							
							$json_errors = array(
								JSON_ERROR_NONE => 'No se ha producido ningún error',
								JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
								JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
								JSON_ERROR_SYNTAX => 'Error de Sintaxis',
							);
							
						}
						
						
						$sigue = $sigue."*".$MaxId;
					}
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