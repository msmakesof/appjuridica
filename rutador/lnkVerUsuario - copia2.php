<?php
    session_start();
?>    
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
<?php  
    require_once('./Connections/DataConex.php');    
    $soportecURL = "S";
    $url         = urlServicios."consultadetalle/consultadetalle_Usuario.php?idU=$usuario&idC=$clave";
    $existe      = "";
    $usulocal    = "";
    $siguex      = "";
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
        curl_close($ch);

        $m =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
	    $m = json_decode($m, true);

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
        echo "No hay soporte para cURL";
    } 
    
    if($soportecURL == "N")
    {
        require_once('./unirest/vendor/autoload.php');
        $response = Unirest\Request::get($url, array("X-Mashape-Key" => "MY SECRET KEY"));
        $resultado = $response->raw_body;
        $resultado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);
        $m = json_decode($resultado, true);	        
    }        
    $existe    = $m['usu_usuario']['TotalUsuario'];
    $IdUsuario = $m['usu_usuario']['USU_IdUsuario'];
    
    
    if($existe == 1)
    {                  
        //require_once('./funciones/valida.php');
        //$siguex = $sigue;
        $soportecURL = "S";
        $url   = urlServicios."consultadetalle/consultadetalle_Usuario.php?IdUsuario=$IdUsuario";
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
            curl_close($ch);

            $m =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
            $m = json_decode($m, true);

            $json_errors = array(
                JSON_ERROR_NONE => 'No se ha producido ningún error',
                JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
                JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
                JSON_ERROR_SYNTAX => 'Error de Sintaxis',
                );
            //echo "Error : ", $json_errors[json_last_error()], PHP_EOL, PHP_EOL."<br>";             
            $usulocal = $m['usu_usuario']['USU_Local'] ;
            $nombres =  $m['usu_usuario']['USU_Nombre'].' '.$m['usu_usuario']['USU_PrimerApellido'].' '.$m['usu_usuario']['USU_SegundoApellido'];
            $email =  $m['usu_usuario']['USU_Email'];
            
            $_SESSION['Usuario'] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $usulocal);
            $_SESSION['NombreUsuario'] = $nombres ;
            $_SESSION['EmailUsuario'] = $email ;            
        }
        else
        {
            $soportecURL = "N";
            echo "No hay soporte para cURL";
        } 

    }
    
    
    if($IdUsuario != "")    
    {
        require_once('./Connections/config2.php'); 
?>

        <script type="text/javascript">
        $(document).ready(function(){
            e.preventDefault();
            var usuario = "<?php echo $usuario; ?>";
            var clave = "<?php echo $clave; ?>";

            $.ajax({
                data : {"pusuario": usuario, "pclave": clave, "sp":"N"},
                type: "POST",
                dataType: "html",
                url : "./valida_usuarioK2.php",
            })  
            .done(function( dataX, textStatus, jqXHR ){	                   				
                var respstr2 = dataX.trim();
                alert(respstr2);
                if( respstr.substr(0,1) == "1" )
                {
                    var varStorage = respstr.substr(2);
                    localStorage.setItem("pusherAttention", varStorage);
                    sessionStorage.setItem("_us_utmworker", varStorage);
                    // document.cookie = "_ga_xp_mainserver="+varStorage+"; expires=Mon, 11 Jul 2016 12:23:00 GMT; path=/";
                    //relocate("header/index.php");
                }
                else
                {                     
                    $("#myModal").modal({backdrop: "static"});
                }															
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) 
                {
                    console.log( "La solicitud a fallado: " +  textStatus);
                }
            });

        }); 
        </script>    
<?php               
        
        // $x="<script type='text/javascript'>
        // sessionStorage.setItem('_utmworker', '$IdUsuario');
        // </script>";  
        // $m = encryptor('encrypt',$x);
        // echo $m;
        // $m = "";
        // echo $m;
       
        //require_once('config2.php');
        $IdUsuario = encryptor('encrypt',$IdUsuario);
        $cookie_name = "_gus";
        $cookie_value = encryptor('encrypt', $usulocal);
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

        $xIdUsuario = encryptor('encrypt',$usulocal);
    }

      //$pasar = trim($existe).'-'.trim($IdUsuario);
      $pasar = trim($existe);
      echo $pasar;
?>