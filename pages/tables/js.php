<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
//echo "<script type='text/javascript'>		sessionStorage.setItem('_utmworker', '".$_SESSION['user_id']."');</script>";

$length = 256; $chars = 'b0c9d8f7g6h5j4k3l2m1nprstvwxyzaeiou1234567890'; $result = ""; 
for ($p = 0; $p < $length; $p++) 
{
	$result .= ($p%2) ? $chars[mt_rand(20, 23)] : $chars[mt_rand(0, 44)]; 
} 
//echo $result ;
?>
<script type="text/javascript">
    var img = "<?php echo $result; ?>";
	sessionStorage.setItem('_utmworker', "<?php echo $_SESSION['user_id'];?>");
</script>
<?php	
	//require_once('../../Connections/DataConex.php');
	//require_once('../Connections/config2.php');
	
	$clavelocal = encryptor('decrypt', $_SESSION['user_id']);
	$soportecURL = "S";
    $url = urlServicios."consultadetalle/consultadetalle_Usuario.php?IdLocal=$clavelocal";
	//echo("<script>console.log('PHP usuario Local: ".$url."');</script>");
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
		//echo("<script>console.log('PHP usuario Local arr: ". var_dump ($m)."');</script>");
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
	
	if( $m['estado'] == 1)
	{		
		for($i=0; $i<count($m['usu_usuario']); $i++)
		{
			$usuesAbogado = $m['usu_usuario'][$i]['USU_EsAbogado'] ;	
			$essuperadmin = $m['usu_usuario'][$i]['USU_EsSuperAdmin'];
			$tipousuario = $m['usu_usuario'][$i]['USU_TipoUsuario'];
		}
	}
?>