<div class="xdemoproc">
	<div class="body">
		<div class="table-responsive">
			<table class="table table-hover dashboard-task-infos">
				<thead>
					<tr>
						<th># Radicado / Proceso</th>
						<th>Fecha Notificaci&oacute;n</th>
						<th>Apoderado</th>
						<th>Nombre</th>
						<th>Empresa</th>						
						<th>Avance</th>
					</tr>
				</thead>										
				<tbody>	
					<?php					
						$idTabla = 0;
						$pusuario = $_SESSION['IdUsuario'];
						$ptipousuario = $_SESSION["TipoUsuario"];
						$empresa = $_SESSION['IdEmpresa'];
						$diascalcula = 2;
						include('../../apis/proceso/robotnotifica.php');
						$color = "";
						//$regs = count($mproceso['robotnotifica']);  
						/*							
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
						*/	
						if($mproceso['estado'] == 1)
						{
							for($j=0; $j<count($mproceso['robotnotifica']); $j++)
							{
								$IdActProcesal = $mproceso['robotnotifica'][$j]['NOT_IdActProcesal'];
								$FechaEnvio = substr($mproceso['robotnotifica'][$j]['NOT_FechaEnvio'], 0,10);
								$Nombre = trim($mproceso['robotnotifica'][$j]['TAP_Nombre']);
								$IdProceso = $mproceso['robotnotifica'][$j]['PRO_IdProceso'];
								$NumeroProceso = $mproceso['robotnotifica'][$j]['PRO_NumeroProceso'];
								$IdEmpresa = $mproceso['robotnotifica'][$j]['USU_IdEmpresa'];
								$Empresa = strtoupper(trim($mproceso['robotnotifica'][$j]['Empresa']));
								$Apoderado = strtoupper(trim($mproceso['robotnotifica'][$j]['Apoderado']));
								if(strlen($NumeroProceso) < 23 )
								{
									$NumeroProceso = $IdProceso ;
								}
					?>		
							<tr>
								<td><?php echo $NumeroProceso; ?></td>
								<td><?php echo $FechaEnvio; ?></td>
								<td><?php echo $Apoderado; ?></td>								
								<td><?php echo $Nombre ; ?></td>
								<td><?php echo $Empresa ; ?></td>
								<td>
									<div class="progress">
										<div class="progress-bar bg-<?php echo $color; ?>" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
									</div>
								</td>
							</tr>
					<?php
							}
						}								
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>