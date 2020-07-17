<div class="demoproc">
	<div class="body">
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
				<tbody>	
					<?php
						$idTabla = 0;
						require_once("../apis/proceso/procesoshoy.php");
						$color = "";
						$regs = count($mproceso['pro_proceso']);
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
							
					?>		
							<tr>
								<td><?php echo $NumeroProceso; ?></td>
								<td><?php echo $FechaInicio; ?></td>
								<td><?php echo $Apoderado; ?></td>								
								<td><span class="label bg-<?php echo $color; ?>"><?php echo $NombreActProcesal ; ?></span></td>
								<td><?php echo $FechaUltActuacion ; ?></td>
								<td>
									<div class="progress">
										<div class="progress-bar bg-<?php echo $color; ?>" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
									</div>
								</td>
							</tr>
					<?php
						}								
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">	
	setInterval(() => {		
		$.get("../../infoproceso/i.php", function( data ) {			
			$( ".demoproc" ).html( data );
		});
	}, 60000);	
</script>
