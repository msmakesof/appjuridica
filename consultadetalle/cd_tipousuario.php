<?php
/**
 * Obtiene el detalle de un Usuario por su Tipo de Usuario especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/usu_usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla']) && isset($_GET['fn'])) {

        if($_GET['fn'] == "ru")
        {
            // Obtener parámetro IdTabla = Tipo Usuario
            $parametro = $_GET['IdTabla'];          

            // Tratar retorno            
            $retorno = USU_USUARIO::getByTipoUsuario($parametro);

            if ($retorno) 
            {
                $mjuzgado["estado"] = "1";
                $mjuzgado["usu_usuariotipousu"] = $retorno;
                // Enviar objeto json de la meta
                header('Content-Type: application/json');
                echo json_encode($mjuzgado);
            } 
            else 
            {
                // Enviar respuesta de error general
                print json_encode(
                    array(
                        'estado' => '2',
                        'mensaje' => 'No se obtuvo resultado en la consulta Usuario por Tipo Usuario .',
                        'sql ' => $retorno
                    )
                );
            }
        }    
    }
}
?>