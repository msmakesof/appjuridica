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

//require "../../api/db_config.php";
require_once ('../Connections/DataConex.php');
//require_once "../../fx/fx_Festivos.php";

//$sql = "SELECT Fecha FROM diashabiles";
//$sql = "SELECT Festivo FROM ost_festivo";
///$sql = "SELECT FES_festivo FROM gen_festivo";
///$result = $mysqli->query($sql);

/* comprobar la conexión */
if ($cnn_kn->connect_errno) {
   echo "Falló la conexión: %s\n". $cnn_kn->connect_error;
    exit();
}
else
{
	echo "Conexion OK<br>";
}

/* Consultas de selección que devuelven un conjunto de resultados */
if ($result = $cnn_kn->query("SELECT FES_festivo FROM gen_festivo;")) {
    echo "La selección devolvió %d filas.\n". $result->num_rows;

    /* liberar el conjunto de resultados */
    //$result->close();
}
else
{
	echo "ninguna Fila<br>";
}


while($row = $result->fetch_assoc())
{
    $json[] = $row;
}

$data['data'] = $json;

//$festivos();
foreach ($data['data'] as $key => $value){
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
echo "<br>";
$fechaIni ="2020-06-20";
$fechaFin ="2020-06-25";
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
?>