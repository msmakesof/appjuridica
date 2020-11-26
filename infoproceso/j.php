<?php	
	$idTabla = 0;
	require_once("../apis/proceso/procesoshoy.php");
	
	$x='';
	$x .= '<div class="body">
				<div class="table-responsive">
					<table class="table table-hover dashboard-task-infos">
						<thead>
							<tr>
								<th># Proceso</th>
								<th>Fecha Inicio</th>
								<th>Apoderado</th>
								<th>Act. Procesal</th>
								<th>Fec. Ult ActProc</th>								
								<th>Avance</th>
							</tr>
						</thead>										
						<tbody>';
							
							for($i=0; $i<count($mproceso['pro_proceso']); $i++)
							{								
								$IdProceso = $mproceso['pro_proceso'][$i]['PRO_IdProceso'];
								$NumeroProceso = trim($mproceso['pro_proceso'][$i]['PRO_NumeroProceso']);
								$FechaInicio = substr($mproceso['pro_proceso'][$i]['PRO_FechaInicio'],0,10);
								$Apoderado = trim(strtoupper($mproceso['pro_proceso'][$i]['Apoderado']));
								$FechaUltActuacion = substr($mproceso['pro_proceso'][$i]['FC'],0,10);
								$Observaciones = trim($mproceso['pro_proceso'][$i]['APR_Observaciones']);
								$NombreActProcesal = trim($mproceso['pro_proceso'][$i]['TAP_Nombre']);		
								
								switch ($i)
								{
									case 0:
										$color = "green";
										break;
									case 1:
										$color = "orange";
										break;
									case 2:
										$color = "light-blue";
										break;
									case 3:
										$color = "red";
										break;	
									case 4:
										$color = "blue";
										break;
								}
								
								$x .= '<tr>
									<td>'. $NumeroProceso. '</td>
									<td>'. $FechaInicio .'</td>
									<td>'. $Apoderado .'</td>
									<td><span class="label bg-'.$color.'">'. $NombreActProcesal .'</span></td>
									<td>'. $FechaUltActuacion .'</td>									
									<td>
										<div class="progress">
											<div class="progress-bar bg-'.$color.'" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
										</div>
									</td>
								</tr>';							
							}
						
		$x .= '			</tbody>
					</table>
				</div>
			</div>';
	echo $x ; 
?>