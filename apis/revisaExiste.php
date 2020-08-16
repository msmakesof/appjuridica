<?php
switch ($tabla)
{
	case 'festivo' :	
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_gen_festivo.php?".$parameters;
		$arreglo= "gen_$tabla";
		break;
		
	case 'juzgado' :	
		$parameters = "ExisteJuzgado=1&Ubicacion=$ubicacion&Ciudad=$ciudad&TipoJuzgado=$tipojuzgado&Area=$area&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_juzgado.php?".$parameters;		
		$arreglo= "juz_$tabla";
		break;
		
	case 'tipojuzgado' :	
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_juz_tipojuzgado.php?".$parameters;		
		$arreglo= "juz_$tabla";
		break;		
	
	case 'area' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&Codigo=$codigo&TipoJuzgado=$tipojuzgado&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_juz_area.php?".$parameters;		
		$arreglo= "juz_$tabla";
		break;

	case 'ciudad' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&Abreviatura=$abreviatura&Departamento=$depto&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_gen_ciudad.php?".$parameters;		
		$arreglo= "gen_$tabla";
		break;

	case 'claseproceso' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_pro_claseproceso.php?".$parameters;	
		$arreglo= "pro_$tabla";
		break;
	
	case 'departamento' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_gen_departamento.php?".$parameters;	
		$arreglo= "gen_$tabla";
		break;
	
	case 'edificio' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_gen_edificio.php?".$parameters;
		$arreglo= "gen_$tabla";
		break;
	
	case 'estadoactprocesal' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_pro_estadoactprocesal.php?".$parameters;
		$arreglo= "pro_$tabla";
		break;
	
	case 'estadoproceso' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_pro_estadoproceso.php?".$parameters;
		$arreglo= "pro_$tabla";
		break;	
	
	case 'notificacion' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_pro_notificacion.php?".$parameters;
		$arreglo= "pro_$tabla";
		break;
		
	case 'pais' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_gen_pais.php?".$parameters;
		$arreglo= "gen_$tabla";
		break;
		
	case 'piso' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&Numero=$numero&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_juz_piso.php?".$parameters;
		$arreglo= "juz_$tabla";
		break;
	
	case 'subclaseproceso' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&ClaseProceso=$claseproceso&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_pro_subclaseproceso.php?".$parameters;
		$arreglo= "pro_$tabla";
		break;
	
	case 'tipoactuacionprocesal' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_pro_tipoactuacionprocesal.php?".$parameters;
		$arreglo= "pro_$tabla";
		break;
	
	case 'ubicacion' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_pro_ubicacion.php?".$parameters;
		$arreglo= "pro_$tabla";
		break;
		
	case 'noticiasjudiciales' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&Texto=$texto&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_gen_noticiasjudiciales.php?".$parameters;
		$arreglo= "gen_$tabla";
		break;
		
	case 'sitiofrecuente' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&Link=$lnk&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/gen_sitiofrecuente.php?".$parameters;
		$arreglo= "gen_$tabla";
		break;
	
	case 'periodo' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&Abreviatura=$abreviatura&Valor=$valor&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_gen_periodo.php?".$parameters;		
		$arreglo= "gen_$tabla";
		break;

	case 'origenactprocesal' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_pro_origenactprocesal.php?".$parameters;
		$arreglo= "pro_$tabla";
		break;

	case 'eventoinusual' :
		$parameters = "ExisteTabla=1&Nombre=$nombre&Fechainicio=$fechainicio&Fechafinal=$fechafinal&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/gen_eventoinusual.php?".$parameters;
		$arreglo= "gen_$tabla";
		break;

	case 'actuacionprocesal' :
		$parameters = "ExisteActPro=1&fechainicio=$fechainicio&origen=$origen&actpro=$actpro&fechaestado=$fechaestado&observacion=$observacion&gasto=$gasto&idtabla=$idtabla";
		$url = urlServicios."consultadetalle/consultadetalle_pro_actuacionprocesal.php?".$parameters;
		$arreglo= "pro_$tabla";
		break;		
	
}	

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
	
	$existe = $m["$arreglo"]["existe"] ;
	if($existe > 0)
	{
		$sigue = "E-Existe un Registrado con la misma información básica.";
	}
	else
	{
		$existeReg = "S";
	}		
}	
?>