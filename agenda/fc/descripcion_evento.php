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
if(!isset($_SESSION)) 
{ 
    session_start(); 
}    
    //incluimos nuestro archivo config
    //include 'config.php'; 
include('../../Connections/cnn_kn.php'); 
include('../../Connections/config2.php');

    // Incluimos nuestro archivo de funciones
    include 'funciones.php';
    $conexion = $cnn_kn;

    // Obtenemos el id del evento
    $id  = evaluar($_GET['id']);

    // y lo buscamos en la base de dato
    $bd  = $conexion->query("SELECT eve_evento.*, PRO_NumeroProceso, "
            ." concat_ws(' ',U.USU_PrimerApellido,U.USU_SegundoApellido,U.USU_Nombre) Nombre "
            . "FROM eve_evento "
            . "JOIN pro_proceso ON eve_evento.IdProceso = pro_proceso.PRO_IdProceso "
            . "JOIN usu_usuario U ON U.USU_IdUsuario = eve_evento.IdUsuario "
            . "WHERE id=$id");

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
    
    // Tipo Actividad
    $tipoactividad=$row['class'];
    
    // Nro Proceso
    $nroproceso = $row['PRO_NumeroProceso'];
    
    // Asignado A
    $nombre=$row['Nombre'];

// Eliminar evento
if (isset($_POST['eliminar_evento'])) 
{
    $id  = evaluar($_GET['id']);
    $sql = "DELETE FROM eve_evento WHERE id = $id";
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
    <title><?php echo $titulo ?></title>
     <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
      <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>
</head>
<body>
    <h3><?php echo $titulo; ?></h3>
    <hr>
    <p>
    <b>Fecha Inicio: </b> <?php echo $inicio; ?>
    <b>Fecha Finalizaci&oacute;n: </b> <?php echo $final; ?>
    </p>
    <p><b>N&uacute;mero de Proceso: </b> <?php echo $nroproceso; ?></p>
    <p><b>Asignado a: </b><?php echo $nombre; ?></p>
    <p><b>Tipo de Actividad: </b><?php echo $tipoactividad; ?></p>
    <p><b>Observaciones: </b> <?php echo $evento; ?></p>
</body>
<form action="" method="post">
    <button type="submit" class="btn btn-danger" name="eliminar_evento">Eliminar</button>
</form>
</html>