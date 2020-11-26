<?php
	/*$hostname_cnn_kn = "192.168.0.6";
	$database_cnn_kn = "appjudicial";
	$username_cnn_kn = "usrremoto";
	$password_cnn_kn = "Vialibre90$";*/
	
	$database_cnn_kn = DATABASE;
	$hostname_cnn_kn = HOSTNAME;
	$username_cnn_kn = USERNAME;
	$password_cnn_kn = PASSWORD;

	$mysqli = new mysqli("$hostname_cnn_kn", "$username_cnn_kn", "$password_cnn_kn", "$database_cnn_kn");

	/* comprobar la conexión */
	if ($mysqli->connect_errno) {
		printf("Falló la conexión: %s\n", $mysqli->connect_error);
		exit();
	}
	else
	{
		//echo "Conexion OK<br>";
	}

	/* Consultas de selección que devuelven un conjunto de resultados */
	if ($resultado = $mysqli->query("SELECT FES_festivo FROM gen_festivo ORDER BY FES_festivo;")) {
		//printf("La selección devolvió %d filas.\n", $resultado->num_rows);
	}
	else
	{
		echo "ninguna Fila<br>";
	}
	
	while ($row = $resultado->fetch_assoc())
	{	
		$json[] = $row;
	}

	$data['data'] = $json;
	
	foreach ($data['data'] as $key => $value)
	{
	   foreach($value as $v)
	   {
		   $festivos[] = $v;
	   }  
	}

	date_default_timezone_set('America/Bogota');	
	setlocale(LC_ALL,"es_ES");
	$cuentaHabiles = 0;
	
	/* 
	$fechaenvio ="2020-11-23";
	$dias = 4;
	$re = "1";
	$dr =  2;
	echo "Fecha Inicial..." . $fechaenvio ."<br>";
	echo "***************************************<br>";
	*/
	
	$fechaIni = $fechaenvio;
	
	$fechaIni = substr($fechaIni,0,10);
	$fechaIni = date('Y-m-d', strtotime($fechaIni));

	$date = date($fechaIni);
	$diassumar = $dias + 1;  // # dias + 1 que corresponde al dia siguiente
	$varrepite = $re;  // usado para saber si se repite la notificacion
	$vardiasrepite = $dr;   // usado para saber cada cuantos dias se repite una notificacion
	
	$mod_date = strtotime($date."+ $diassumar days");
	
	/*++++++++++*/
		$fecini = $fechaIni;
		$maximodiashabiles = $diassumar;
		// Convirtiendo en timestamp las fechas
		$fechainicio = strtotime($fecini);
		$fechaHabil ="";
		$cuentaHabiles = 0;
		   
		// Incremento en 1 dia
		$diainc = 24*60*60;
		   
		// Arreglo de dias habiles, inicianlizacion
		$diashabiles = array();
			
		$midia_act = $fecini;
		$arrayFechas = array();
		for ($midia = 1; $midia <= $diassumar; $midia ++)
		{		
			$midia_act = strtotime($midia_act."+ 1 days");
			
			// Si el dia indicado, no es sabado o domingo es habil
			if (!in_array(date('N', ($midia_act)), array(6,7)))
			{
				//echo "mdia....".$midia."<br>";		
				//echo "dia actual....$midia_act<br>";
				//echo "N...".date('N', strtotime($midia_act) )."<br>";				
				$diabusca = date('Y-m-d', ($midia_act));
				//echo "dia busca....$diabusca<br>";

				// Si no es un dia feriado entonces es habil
				if (!in_array($diabusca, $festivos))  //$diasferiados
				{
					////echo "0) mdia................".$midia."<br>";
					////echo "1) Día Semana... ".date('N', ($midia_act))."<br>";
					////echo "2) Día hábil Nro. ...  ".$midia."<br>";
					////echo "3) Fecha Hábil ... ".date('Y-m-d', ($midia_act))."<br>";
					$fechaHabil = date('Y-m-d', ($midia_act) );
					$residuo = $midia % 2;
					if( $residuo == 0 )
					{
						array_push($arrayFechas, $fechaHabil);
					}
				}
				else
				{			
					$midia--;
					if($midia < 0)
					{
						$midia = 0;
					}
				}
				if($midia == $dias)
				{
					break;
				}
			}
			else{
				$midia--;
				if($midia < 0)
				{
					$midia = 0;
				}
			}	
			$midia_act = date('Y-m-d',$midia_act);
		}
		$FechaHabil = json_encode($arrayFechas);
		return $FechaHabil;
	/* liberar el conjunto de resultados */
	$resultado->close();
?>