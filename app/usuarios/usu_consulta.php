<?php
    require_once('../../Connections/DataConex.php');
    require_once('../../Connections/config2.php');

    $usuario ="";
    if(isset($_GET['usuario']))
    {
        $usuario = trim($_GET['usuario']);
    }    

    $clave ="";
    if(isset($_GET['clave']))
    {
        $clave = trim($_GET['clave']);
    }

    $clave = encryptor('encrypt', $clave);    
    $soportecURL = "S";    
    $url         = urlServicios."consultadetalle/UsuarioApp.php?idU=$usuario&idC=$clave";    
    //echo("<script>console.log('UserData: ".$url."');</script>");
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
	echo json_encode($m);
/*	
    $existe    = $m['usu_usuario']['TotalUsuario'];
    $IdUsuario = $m['usu_usuario']['USU_IdUsuario'];      
    
    if($existe == 1 && $IdUsuario != "")
    {		
		$soportecURL = "S";
        $url   = urlServicios."consultadetalle/consultadetalle_Usuario.php?IdUsuario=$IdUsuario";
        //echo("<script>console.log('PHP usuario Existe: ".$url."');</script>");
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
            $email = trim($m['usu_usuario']['USU_Email']);
            $tipousuario = $m['usu_usuario']['USU_TipoUsuario'];
			$idempresa = $m['usu_usuario']['USU_IdEmpresa'];
			$esabogado = $m['usu_usuario']['USU_EsAbogado'];
			$nombreempresa = $m['usu_usuario']['NombreEmpresa'];
            $desarrollador = $m['usu_usuario']['USU_Desarrollador'];
			
			$_SESSION['Usuario'] = "";
			$_SESSION['NombreUsuario'] = "" ;
			$_SESSION['EmailUsuario'] = "" ;
			$_SESSION['user_id'] = "";
			$_SESSION['opcMenu'] = "";	
			$_SESSION['TipoUsuario'] = "";	
			$_SESSION['IdUsuario'] = "" ;
			$_SESSION['IdEmpresa'] = "";
			$_SESSION['EsAbogado'] = "";
			$_SESSION['Desarrollador'] = "";
	
            $_SESSION['Usuario'] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $usulocal);
            $_SESSION['NombreUsuario'] = $nombres ;
            $_SESSION['EmailUsuario'] = $email ;			
			$_SESSION['TipoUsuario'] = $tipousuario;
			$_SESSION['IdEmpresa'] = $idempresa;
			$_SESSION['EsAbogado'] = $esabogado;
			$_SESSION['IdEmpresa'] = $idempresa;
			$_SESSION['NombreEmpresa'] = $nombreempresa ;
			$_SESSION['Desarrollador'] = $desarrollador ;			
			
			$_SESSION['user_id'] = encryptor('encrypt', $usulocal);
			$_SESSION['IdUsuario'] = $IdUsuario ;
			$user_id = $_SESSION['user_id'] ;
			
			// Esto es para registrar usuario y fecha en que se loguea //
			$soportecURL = "S";
			$url   = urlServicios."consultadetalle/usu_conectado.php?insert=insert&IdUsuario=$IdUsuario";
			//echo("<script>console.log('PHP usuario Existe: ".$url."');</script>");
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
			}
			else
			{
				$soportecURL = "N";
				echo "No hay soporte para cURL";
			}
        }
        else
        {
            $soportecURL = "N";
            echo "No hay soporte para cURL";
        }
    }    
	echo trim($existe);
*/
?>