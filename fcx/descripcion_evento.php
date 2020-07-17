<?php
/**
**
**  BY iCODEART
**
**********************************************************************
**                      REDES SOCIALES                            ****
**********************************************************************
**                                                                ****
** FACEBOOK: https://www.facebook.com/icodeart                    ****
** TWIITER: https://twitter.com/icodeart                          ****
** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
** GITHUB: https://github.com/icodeart                            ****
** TELEGRAM: https://telegram.me/icodeart                         ****
** EMAIL: info@icodeart.com                                       ****
**                                                                ****
**********************************************************************
**********************************************************************
**/    
    //incluimos nuestro archivo config
    include 'config.php'; 

    // Incluimos nuestro archivo de funciones
    include 'funciones.php';

    // Obtenemos el id del evento
    $id  = evaluar($_GET['id']);

    // y lo buscamos en la base de dato
    $bd  = $conexion->query("SELECT A.*, concat_ws(' ', USU_Nombre, USU_PrimerApellido, USU_SegundoApellido) Nombre, P.PRO_NumeroProceso Proceso, ATA_Nombre FROM agenda A JOIN usu_usuario U ON U.USU_IdUsuario = A.IdAsignado JOIN pro_proceso P ON P.PRO_IdProceso = A.IdProceso JOIN age_tipoactividad T ON T.ATA_IdTipoActividad = A.IdTipoActividad WHERE id=$id");

    // Obtenemos los datos
    $row = $bd->fetch_assoc();

    // titulo 
    $titulo=$row['title'];

    // cuerpo
    $evento=$row['body'];

    // Fecha inicio
    $inicio=$row['inicio_normal'];

    // Fecha Termino
    $final=$row['final_normal'];
	
	// Nombre
	$Nombre= strtoupper($row['Nombre']);
	
	// Proceso
	$Proceso= strtoupper($row['Proceso']);
	
	// Tipo Actividad
	$TipoActividad = strtoupper($row['ATA_Nombre']);

// Eliminar evento
if (isset($_POST['eliminar_evento'])) 
{
    $id  = evaluar($_GET['id']);
    $sql = "DELETE FROM agenda WHERE id = $id";
    if ($conexion->query($sql)) 
    {
        echo "Evento eliminado";
    }
    else
    {
        echo "El evento no se pudo eliminar";
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
	<!-- Google Fonts 	-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">	
	<title><?=$titulo?></title>
	
    <link rel="stylesheet" type="text/css" href="<?=$base_url?>css/bootstrap.min.css">
	<!-- Sweet Alert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- Sweet Alert Plugin Js 	-->
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>
	<script src="../js/jsRelocate.js"></script>
	
	
</head>
<body>

	<form action="" method="post">
		<!--
		<div class="alert alert-info">
			<h4><span class="glyphicon glyphicon-calendar" style="color: orange;"></span> <?=$titulo?></h4>
		</div>		
		<b>Para: </b> <?=$Nombre?> <br>
		<b>Nro. Proceso: </b> <?=$Proceso?> <br>
		<b>Fecha inicio (dd/mm/aa): </b> <?=$inicio?> <br>
		<b>Fecha final (dd/mm/aa): </b> <?=$final?>  <br>
		<b>Tipo Actividad: </b> <?=$TipoActividad?>  <br>
		<b>Descripci&oacute;n del Evento:</b><p><?=$evento?></p>
		<div class="modal-footer">
			<div class="alert alert-danger">
				<button type="button" class="btn btn-primary btn-sm" id="cerrar">Cerrar</button>			  
				<button type="button" class="btn btn-danger btn-sm" id="eliminar_evento" name="eliminar_evento">Eliminar</button>
			</div>
		</div>    
		-->
		
		<div class="card border-dark mb-8" style="max-width: 54rem;">
			<div class="card-header bg-transparent border-dark">
				<div class="alert alert-info">
					<span class="glyphicon glyphicon-calendar" style="color: orange;"></span> <?=$titulo?>
				</div>		
			</div>
			<div class="card-body text-dark">
				<h5 class="card-title"><b>Para: </b> <?=$Nombre?> <br></h5>
				<p class="card-text">
					<b>Nro. Proceso: </b> <?=$Proceso?> <br>
					<b>Fecha inicio (dd/mm/aa): </b> <?=$inicio?> <br>
					<b>Fecha final (dd/mm/aa): </b> <?=$final?>  <br>
					<b>Tipo Actividad: </b> <?=$TipoActividad?>  <br>
					<b>Descripci&oacute;n del Evento:</b><p><?=$evento?></p>
				</p>
			</div>
			<div class="card-footer bg-transparent border-dark">
				<div class="alert alert-danger">
					<button type="button" class="btn btn-primary btn-sm" id="cerrar">Cerrar</button>			  
					<button type="button" class="btn btn-danger btn-sm" id="eliminar_evento" name="eliminar_evento">Eliminar</button>
				</div>
			</div>
		</div>
		
	</form>	
		<script type="text/javascript">
		$(document).ready(function()
		{ 
			$("#eliminar_evento").on('click', function(){
				swal({
					title: "Desea borrar este Evento de la Agenda?",
					text: "Esta información no va a ser recuperada una vez borrada!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Borrar",
					cancelButtonText: "Canceler",
					closeOnConfirm: false,
					closeOnCancel: false
					},
					function(isConfirm) {
					if (isConfirm) {
						$.ajax({
							data: {"id": <?php echo $id; ?> },
							type: 'POST',
							dataType: "html",
							url: "borraagenda.php",
							beforeSend: function() {					
								//$("#precargamsj").show();
							},
							success: function(data)
							{
								if(data == 1)
								{										
									swal({										
										type: 'success',
										title: 'Este evento ha sido borrado',
										showConfirmButton: false,
										timer: 2500
									});									
									parent.$('#events-modal').modal('hide');
									return false;									
								}
								else
								{
									swal("Atención!", "Este evento NO ha sido borrado.", "warning");
								}								
							},
							error: function(xhr) { // if error occured								
								swal("Atención!", "Error ha ocurrido.", "error");
							},
							complete: function() {
								//$("#precargamsj").hide();
							},						
						});	
						
					} else {
						swal("Cancelado", "Este evento no fue borrado", "error");
					}
				});
			});			
			
			$("#cerrar").click(function(e){
				e.preventDefault();
				parent.$('#events-modal').modal('hide');
				return false;
			});
			
		});	
		</script>
		
</body>

</html>
