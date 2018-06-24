<?php 
require_once('../../Connections/cnn_kn.php'); 
require_once('../../Connections/config2.php'); 
?>
<table class="table table-bordered table-striped table-hover dataTable js-exportable" id="grid">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Estado</th> 
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Nombre</th>
            <th>Estado</th>                                        
        </tr>
    </tfoot>
    <tbody>
<?php

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_tabla = "SELECT Nombre_Tabla, Nombre_Estado FROM gen_tablas JOIN gen_estado ON gen_estado.Id_Estado = Id_EstadoTabla ORDER BY Nombre_Tabla;";
$rs_tipo_tabla = mysqli_query($cnn_kn,$query_rs_tipo_tabla) or die(mysql_error()."$query_rs_tipo_tabla");
$row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla);
//Cantidad de registros
$cantidad_rs_tipo_tabla = mysqli_num_rows($rs_tipo_tabla);

$nombre_Tabla="";
do{
	$NombreTabla = trim($row_rs_tipo_tabla['Nombre_Tabla']);
	$archivo = $NombreTabla.".php";
	$estadoTabla = trim($row_rs_tipo_tabla['Nombre_Estado']);
   
?>
    <tr>
        <td><?php echo $NombreTabla; ?></td>
        <td><?php echo $estadoTabla; ?></td>               
    </tr>
<?php                          
}while($row_rs_tipo_tabla = mysqli_fetch_assoc($rs_tipo_tabla)); ?>

 </tbody>
    </table>
<?php                                                    
mysqli_free_result($rs_tipo_tabla); 
?>