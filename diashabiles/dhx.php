<html>
<head>
	<title>Calculo Días Hábiles</title>
</head>
<body>
	<form id="form1" name="form1" method="post" action="dhx.php">
		<input type="date" id="fecha" name="fecha" placeholder="Digite fecha:" min="2018-01-01" max="2021-12-31">
		<input type="number" id="dias" name="dias" min="1" max="365">
		Repetir cada: <input type="number" id="rdias" name="rdias" min="1" max="30"> día(s)
		<input name="Submit" type="submit" value="Calcular" />
	</form>
</body>
</html>
<?php
/**
 * Metodo getDiasHabiles
 *
 * Permite devolver un arreglo con los dias habiles
 * entre el rango de fechas dado excluyendo los
 * dias feriados dados (Si existen)
 *
 * @param string $fechainicio Fecha de inicio en formato Y-m-d
 * @param string $fechafin Fecha de fin en formato Y-m-d
 * @param array $diasferiados Arreglo de dias feriados en formato Y-m-d
 * @return array $diashabiles Arreglo definitivo de dias habiles
 */
if(isset($_POST["Submit"]) )  // && $_SERVER["REQUEST_METHOD"] == "POST"
{
	//echo $_POST['fecha']."<br>";
	$fechaenvio = $_POST['fecha'];
	$dias = $_POST['dias'];
		$diasrepite = $_POST['rdias'];
	echo "dias hábiles a contar...$dias<br>";
	
	$hostname_cnn_kn = "192.168.0.6";
	$database_cnn_kn = "appjudicial";
	$username_cnn_kn = "usrremoto";
	$password_cnn_kn = "Vialibre90$";

	$mysqli = new mysqli("192.168.0.6", "usrremoto", "Vialibre90$", "appjudicial");

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
	if ($resultado = $mysqli->query("SELECT FES_festivo FROM gen_festivo;")) {
		//printf("La selección devolvió %d filas.\n", $resultado->num_rows);
	}
	else
	{
		echo "ninguna Fila<br>";
	}
	//echo "<br>";
	while ($row = $resultado->fetch_assoc())
	{
		//echo $row["FES_festivo"]."<br>";
		$json[] = $row;
	}

	$data['data'] = $json;

	//$festivos();
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

	//print_r($festivos);	//echo "<br><br>";
	$fechaIni = $fechaenvio; //"2020-06-18";

	$date = date($fechaIni);
	$diassumar = $dias + 1;  // # dias + 1 que corresponde al dia siguiente
	$mod_date = strtotime($date."+ $diassumar days");
	//echo "<br>";
	echo "Fecha Inicial..." . $fechaIni ."<br>";
	echo "***************************************<br>";
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
					echo "0) mdia................".$midia."<br>";					
					echo "1) Día hábil Nro. ...  ".$midia."<br>";
					echo "2) Día Semana... ".date('N', ($midia_act))."<br>";
					echo "3) Fecha Hábil ... ".date('Y-m-d', ($midia_act))."<br>";
					$fechaHabil = date('Y-m-d', ($midia_act) );
					$residuo = $midia % 2;
					if( $residuo == 0 )
					{
						array_push($arrayFechas, $fechaHabil);
					}
				}
				else
				{
					//$midia_act = strtotime($midia_act."+ 1 days");
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
			//$midia_act = strtotime($midia_act."+ 1 days");
			$midia_act = date('Y-m-d',$midia_act);
		}
	echo "***************************************<br>";	
	echo "Fecha hábil final ... $fechaHabil<br>";
	echo "***************************************<br>";
	print_r($arrayFechas);
	/* liberar el conjunto de resultados */
	$resultado->close();
}
?>
