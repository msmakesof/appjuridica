<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=prueba', '$2y$10$bsUgs4N/117YuJm2DIafmOy50jxZ7j.LbRK0w7UPvM1', '');
    foreach($mbd->query('SELECT * from cnn_con WHERE CNN_Id = 2') as $fila) {
        print_r($fila);
    }
    $mbd = null;
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

$consulta = sprintf("SELECT cnn_con WHERE CNN_Id = 2 AND CNN_Servidor='%s';",
pg_escape_string('$2y$10$zUg.EGSy.OcjGxYSMQ3kQeb33t5fDTEQC3mWzNxE2lZ'));
$fila = pg_fetch_assoc(pg_query($conexión, $consulta));
?>