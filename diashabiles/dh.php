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
$hostname_cnn_kn = "192.168.0.13";
$database_cnn_kn = "appjudicial";
$username_cnn_kn = "usrremoto";
$password_cnn_kn = "Vialibre90$";

$mysqli = new mysqli("192.168.0.13", "usrremoto", "Vialibre90$", "appjudicial");

/* comprobar la conexión */
if ($mysqli->connect_errno) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}
else
{
	echo "Conexion OK<br>";
}

/* Consultas de selección que devuelven un conjunto de resultados */
if ($resultado = $mysqli->query("SELECT FES_festivo FROM gen_festivo;")) {
    printf("La selección devolvió %d filas.\n", $resultado->num_rows);

}
else
{
	echo "ninguna Fila<br>";
}
echo "<br>";
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


//global $cuentaHabiles ;
$cuentaHabiles = 0;

function getDiasHabiles($fechainicio, $fechafin, $diasferiados = array(), $maximodiashabiles)
{
	$fecini = $fechainicio;
	// Convirtiendo en timestamp las fechas
	$fechainicio = strtotime($fechainicio);
	$fechafin = strtotime($fechafin);
	$fechaHabil ="";
	$cuentaHabiles = 0;
	   
	// Incremento en 1 dia
	$diainc = 24*60*60;
	   
	// Arreglo de dias habiles, inicianlizacion
	$diashabiles = array();

	// Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
	//for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc)
	for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc)
	{
		//echo $midia."<br>";

		// Si el dia indicado, no es sabado o domingo es habil
		if (!in_array(date('N', $midia), array(6,7)))
		{
		$diabusca = date('Y-m-d', $midia);

			// Si no es un dia feriado entonces es habil
			if (!in_array($diabusca, $diasferiados))
			{
				echo date('N', $midia)."<br>";
				echo date('Y-m-d', $midia)."<br>";
				if( date('Y-m-d', $midia) != $fecini )
				{
					array_push($diashabiles, date('Y-m-d', $midia));
					$fechaHabil = date('Y-m-d', $midia);
					$GLOBALS['cuentaHabiles']++;
				}
			}
		}

		if( count($diashabiles) == $maximodiashabiles)
		{
			break;
		}
	}
   
	return $fechaHabil;  //$diashabiles;
}
print_r($festivos);
echo "<br><br>";
$fechaIni ="2020-06-20";
//$fechaFin ="2020-06-25";


$date = date($fechaIni);  // date("d-m-Y");
//Incrementando 2 dias
$diassumar = 4+1;
$mod_date = strtotime($date."+ $diassumar days");
echo "Fecha Final 0.....".date("Y-m-d",$mod_date) . "\n";
$fechaFin = date("Y-m-d",$mod_date);
echo "<br>";


$max_dh = 30;
echo "Fecha Inicial..." . $fechaIni ."<br>";
echo "Fecha Final....." . $fechaFin ."<br>";
echo "Máx dias habiles..." . $max_dh ."<br>";
//var_dump(getDiasHabiles('2019-01-01', '2019-01-15', $festivos ));

/* obtengo la cantidad de dias hábiles entre las fechas */
//$cantidad_dh = count(getDiasHabiles($fechaIni, $fechaFin, $festivos, $max_dh ));

/* Obtengo la fecha del valor que tenga el $max_dh */
$cantidad_dh = getDiasHabiles($fechaIni, $fechaFin, $festivos, $max_dh );
//echo "dias habiles....".$cantidad_dh."<br>";
echo "ctaHabiles......".$cuentaHabiles;

/* liberar el conjunto de resultados */
$resultado->close();
?>