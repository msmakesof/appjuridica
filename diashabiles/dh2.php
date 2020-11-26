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
set_time_limit(0);
date_default_timezone_set('America/Bogota');
require "admin/global_conex.inc";
echo "****************************************************************************************<br>";
echo "*   Ambiente => PRUEBAS.   *<br>";
echo "*   Iniciando... ".date("d-m-Y H:i:s")."<br>";
echo "****************************************************************************************<br>";
$seguir = "N";
/*
$added= mysql_query("ALTER TABLE ost_ticket ADD diasHabilesAbierto TINYINT(4) NULL DEFAULT NULL");
if($added !== FALSE)
{
   echo("Columna diasHabilesAbierto ha sido adicionanda .");
   $seguir = "S";
}else{
   echo("AtenciĂ³n, no se pudo adicionar columna a Tabla.");
   $seguir = "N";
}
*/
$y = $_GET['y'] ;
$sql = "SELECT created, closed, FechaVtoHabil, ticket_id FROM ost_ticket WHERE YEAR(created) = 2019 ORDER BY ticket_id DESC; ";
$CantidadDiasHabiles = 0;
if ($res_tickets = mysql_query($sql))
{
while ($row = mysql_fetch_assoc($res_tickets))
{
$fechaIni = date('Y-m-d', strtotime($row['created']));
$fechaCrea= date('Y-m-d', strtotime($row['created']));
$fechaFin = date('Y-m-d', strtotime($row['closed']));
$fecha    = date("d-m-Y", strtotime($row['created']));
//echo "fecha....$fecha<br>";
//echo "fechaCrea....$fechaCrea<br>";

$fechaIni = date("d-m-Y",strtotime($row['created']));
//echo " FI...$fechaIni<br>";
$fch_fin = date("d-m-Y");
//echo "$fch_fin<br>";
$TotalDias = 0;
$DiasNoLaborables = 0;
$DiasFeriados = 0;
$Cnt = 0;
$EvalDate = "";

//-- Contamos cantidad de festivos
$sql = "SELECT COUNT(IdFestivo) DiasFeriados FROM ost_Festivo WHERE Festivo >= '" . date("Y-m-d", strtotime($fechaIni)) ."' AND Festivo <= '". date("Y-m-d", strtotime($fch_fin))."' AND WEEKDAY(Festivo) <= 4 ";
//echo "sql DFeriados...$sql<br>";
if ($res_festivo = mysql_query($sql))
{
while ($filas = mysql_fetch_array($res_festivo))
{
$DiasFeriados = $filas['DiasFeriados'];
}
}

$TotalDias = round(abs(strtotime($fch_fin) - strtotime($fechaIni))/86400);
//**echo "Total Días Calendario...$TotalDias<br>";
//**echo "Dias Feriados...........$DiasFeriados<br>";

while ( $Cnt < $TotalDias )
{
$EvalDate = strtotime ( '+'. $Cnt .'day' , strtotime($fechaIni) ) ;
$dia_semana = date('w', $EvalDate); // dia semana
if( (int)$dia_semana == 0 || (int)$dia_semana == 6)
{
$DiasNoLaborables ++;
$sql = "SELECT COUNT(IdFestivo) total FROM ost_Festivo WHERE Festivo = '". date("Y-m-d", $EvalDate) ."'";
if ($res_festivo = mysql_query($sql))
{
while ($filas = mysql_fetch_array($res_festivo))
{
$festivox = $filas['total'];
if($festivox > 0)
{
$DiasNoLaborables -- ;
}
}
}
}
$Cnt++;
}
//**echo "Días No Laborales.....$DiasNoLaborables<br>";

$DiasHabiles = 0;
$diasTrans = 0;
$Lapso = 15;
$fecha = "";
$fechafinal = "";
$f = date("Y-m-d", strtotime ( '+1 day' , strtotime($fechaIni) ) );
while ( $DiasHabiles < $Lapso )
{
$fecha = date("Y-m-d", strtotime ( '+'. $diasTrans .' days' , strtotime($f) ) );

$EvalDate = strtotime ( '+'. $diasTrans .' days' , strtotime($f) );
$dia_semana = date('w', $EvalDate); // dia semana
if( (int)$dia_semana > 0 && (int)$dia_semana < 6)
{
$sql = "SELECT COUNT(IdFestivo) total FROM ost_Festivo WHERE Festivo = '". date("Y-m-d", $EvalDate) ."'";
if ($res_festivo = mysql_query($sql))
{
while ($filas = mysql_fetch_array($res_festivo))
{
$festivox = $filas['total'];
if ($festivox == 0)
{
//echo "fec.....$fecha<br>";
$DiasHabiles++;
}
}
}
}
$diasTrans++;
}

$fechaFin = date("Y-m-d", strtotime ( '+'. $diasTrans .' day' , strtotime($fechaIni) ) );
//echo "dfecfin....$fechaFin<br>";

$EvalDate = $fechaFin;
$dia_semana = date('w', $EvalDate); // dia semana
if( (int)$dia_semana == 6)
{
$fechaFin = date("Y-m-d", strtotime ( '-1 day' , ($fechaFin) ) ) ;
}

$fechaHabil = $fechaFin;  
$fechaHabilGraba = date("Y-m-d",strtotime($fechaHabil));
//echo $fechaHabil."<br>"; // Fecha Vto Habil

$cuentaDiasHabiles = $TotalDias - ($DiasNoLaborables + $DiasFeriados);

// Si día de creación es sábado, domingo o festivo sumo 1 día a $cuentaDiasHabiles
$sumadiaHabil = 0;
//$EvalDate = $fechaCrea;
//echo "<br>fcrea.....$fechaCrea / ";
$dia_semana = date('w', strtotime($fechaCrea));
//echo "diasem ...$dia_semana<br>";
if( (int)$dia_semana == 0  )
{
$sumadiaHabil = 1;
}
$sql = "SELECT COUNT(IdFestivo) total FROM ost_Festivo WHERE Festivo = '". date("Y-m-d",strtotime($row['created'])) ."'";
if ($res_festivo = mysql_query($sql))
{
while ($filas = mysql_fetch_array($res_festivo))
{
$festivox = $filas['total'];
if ($festivox == 1)
{
$sumadiaHabil = 1;
}
}
}
//

$cuentaDiasHabiles = $cuentaDiasHabiles + $sumadiaHabil;

$fechaIni = date("d-m-Y",strtotime($row['created']));
$fechaFin = $row['closed'];
if (!is_null($fechaFin))
{
$fechaFin = date("d-m-Y",strtotime($row['closed']));
}
else
{
$fechaFin = date("d-m-Y");
}

//**echo "Fecha Habil..........$fechaHabilGraba<br>";

$sqlfest="UPDATE ost_ticket SET FechaVtoHabil = '$fechaHabilGraba' ,";
$sqlfest.=" diasHabilesAbierto = $cuentaDiasHabiles ";
$sqlfest.=" WHERE ticket_id=".$row['ticket_id'];
//**echo "<br>upd.........$sqlfest";
if(mysql_query($sqlfest)){ echo '';}

echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
echo "Ticket...".$row['ticket_id'].' - Creado...'.$fechaIni.' - Cerrado:...'.$fechaFin."<br>";
echo "upd.........$sqlfest<br>";
        echo " Total Días Calendario...$TotalDias / Dias Feriados...$DiasFeriados / Días No Laborales...$DiasNoLaborables / Fecha Habil...$fechaHabilGraba / Dias Habiles Transcurridos...$cuentaDiasHabiles<br>";
//echo "<br>--------------------------------------------------------------------------------------------------------------<br>";
}
}
echo "<br> Finalizado... ".date("d-m-Y H:i:s")."<br>";
?>