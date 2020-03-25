<?php
//require_once('../Connections/DataConex.php');  // para index.php cambiado desde el header a pages/tables se coloca esta linea en comentario
//require_once('../Connections/config2.php');    // para index.php cambiado desde el header a pages/tables se coloca esta linea en comentario.

require('../../apis/info/infoo.php');   // para index.php cambiado desde el header a pages/tables se agrega ../
$misProcesos = $mproceso['pro_proceso']['MisProcesos'];

require_once('../../apis/info/infoMisClientes.php');  // para index.php cambiado desde el header a pages/tables se agrega ../
$misClientes = $mproceso['pro_proceso']['MisClientes'];

require_once('../../apis/info/infoProcesoJudicial.php');   // para index.php cambiado desde el header a pages/tables se agrega ../
$miProcesoJudicial = $mproceso['pro_proceso']['MiProcesoJudicial'];

require_once('../../apis/info/infoMiAgenda.php');  // para index.php cambiado desde el header a pages/tables se agrega ../
$miAgenda = $mproceso['pro_proceso']['MiAgenda'];
?>