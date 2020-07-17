<?php
//require_once('../Connections/DataConex.php');  // para index.php cambiado desde el header a pages/tables se coloca esta linea en comentario
//require_once('../Connections/config2.php');    // para index.php cambiado desde el header a pages/tables se coloca esta linea en comentario.

require('../../apis/info/infoo.php');   // para index.php cambiado desde el header a pages/tables se agrega ../
$misProcesos = $mproceso['pro_proceso']['MisProcesos'];

require_once('../../apis/info/infoMisClientes.php');  // para index.php cambiado desde el header a pages/tables se agrega ../
$misClientes = $mproceso['pro_proceso']['MisClientes'];

require_once('../../apis/info/infoProcesoJudicial.php');   // para index.php cambiado desde el header a pages/tables se agrega ../
$miProcesoJudicial = $mproceso['pro_proceso']['MiProcesoJudicial'];

// require_once
$miAgenda = 0;

//include('../../apis/info/infoMiAgenda.php');  // para index.php cambiado desde el header a pages/tables se agrega ../
?>
<script>
setTimeout(() => {
	var miAgenda = "0";
	
	$.ajax({
		data: {"id": <?php echo $id; ?>, "tu": <?php echo $tu; ?>, "em": <?php echo $em; ?>},
		url: '../../apis/info/infoMiAgenda.php',
		type: 'POST',                            
		dataType: 'html',												
		success: function( data, textStatus, jQxhr ){
			miAgenda = data ; 
		},
            error: function( jqXhr, textStatus, errorThrown ){
            console.log( errorThrown );
        }	
	});
}, 10000);
</script>
<?php
	$miAgenda = "<script>miAgenda</script>";
	echo $miAgenda;
?>