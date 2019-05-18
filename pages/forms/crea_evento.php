<?php 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php');
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
else
{
    header('Location: ../../index.html');
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

// incluimos el archivo de funciones
include '../../agenda/fc/funciones.php';

$inicio ="";
$final  ="";
$from ="";
if( isset($_POST['from']) )
{
    $from = trim($_POST['from']);
    $inicio = _formatear($_POST['from']);
    $from = str_replace(' ','%20', $from);
}

$to ="";
if( isset($_POST['to']) )
{
    $to = trim($_POST['to']);
    $final  = _formatear($_POST['to']);
    $to = str_replace(' ','%20', $to);
}

$proceso ="";
if( isset($_POST['proceso']) )
{
    $proceso = trim($_POST['proceso']);
}

$responsable ="";
if( isset($_POST['responsable']) )
{
    $responsable = trim($_POST['responsable']);
}

$tipo ="";
if( isset($_POST['tipo']) )
{
    $tipo = trim($_POST['tipo']);
}

$title ="";
if( isset($_POST['title']) )
{
    $title = trim($_POST['title']);
    $title = str_replace(' ','%20', $title);    
}

$body ="";
if( isset($_POST['body']) )
{
    $body = trim($_POST['body']);
    $body = str_replace(' ','%20', $body);
}

require_once('../../Connections/DataConex.php');
//Verifico si existe una Tabla con las siguientes caracteristicas
// Nombres iguales 
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
  $parameters = "ExisteTabla=1&From=$from&To=$to&Tipo=$tipo&Proceso=$proceso&Responsable=$responsable";
  $url = urlServicios."consultadetalle/eve_evento.php?".$parameters;
  
  //echo "<script>console.log(Exsite.......$url)</script>" ;
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
    $existe = $m['eve_evento']['existe'];
    if($existe > 0)
    {
      $sigue = "E-Existe un Evento registrado con la misma Información.";
    }
    else
    {
      
      $parameters = "insert=insert&Title=$title&Body=$body&Tipo=$tipo&Inicio=$inicio&Final=$final&From=$from&To=$to&Proceso=$proceso&Responsable=$responsable";
      $soportecURL = "S";
      $url         = urlServicios."consultadetalle/eve_evento.php?".$parameters;
      $existe      = "";
      $usulocal    = "";
      $sigue       = "";
      $sigueins    = "";
      $sigueupd    = "";
      //echo "<script>console.log($url)</script>" ;
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
            //print_r
            //var_dump($m);
            //echo "<script>console.log(m estado....".$m['estado'].")</script>";
            //echo "<script>console.log(m evento....".$m['eve_evento'].")</script>";
            $grabadoOK = $m['eve_evento'];
            if(!$grabadoOK )
            {
              $sigue = "N-Registro NO ha sido grabado.";
            }
            else
            {
                $sigueins    = "S";
                //buscamos el maximo id de eve_evento
                $parameters = "buscamax=buscamax";
                $soportecURL = "S";
                $url         = urlServicios."consultadetalle/eve_evento.php?".$parameters;
                $existe      = "";
                //echo "<script>console.log(url1....$url)</script>";
                $MaxId = 0;
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
                        $m = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);
                        $m = json_decode($m, true);                         
                        $MaxId = $m['eve_evento']['MaxId'];
                        //echo "<script>console.log(maxId....".$MaxId.")</script>";
                        
                        $parameters = "updateurl=updateurl&maxid=$MaxId&maxid1=$MaxId";
                        $soportecURL = "S";
                        $url         = urlServicios."consultadetalle/eve_evento.php?".$parameters;
                        $existe      = "";
                        //echo "<script>console.log(updmaxId....".$url.")</script>";
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
                            
                            $resultado = curl_exec ($ch);
                            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            $curl_errno  = curl_errno($ch);
                            curl_close($ch);
                            
                            if($resultado === false || $curl_errno > 0)
                            {
                                //echo 'Curl error: ' . curl_error($ch);
                                $sigue = "N-Se presentó problema... ". $curl_errno.' '.$curl_msj;
                                $sigueupd    = "";
                            }
                            else
                            {                                
                                $sigueupd    = "S";
                            }
                        }                      
                        
                    }
                }
                
                if($sigueins == "S" && $sigueupd == "S")
                {
                    $sigue = "S-Registro grabado Correctamente.";
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