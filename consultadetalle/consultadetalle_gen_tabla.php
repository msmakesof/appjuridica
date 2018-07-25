<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_tabla.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = GEN_TABLA::getById($parametro);

        if ($retorno) {
            $gen_tabla["estado"] = "1";
            $gen_tabla["gen_tabla"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_tabla);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Tabla'
                )
            );
        }
    }
    elseif (isset($_GET['IdEstadoTabla'])) {
        // Obtener parámetro idEstado de gen_tabla
        $parametro = $_GET['IdEstadoTabla'];

        // Tratar retorno
        $retorno = GEN_TABLA::getByIdEstado($parametro);

        if ($retorno) {
            $gen_tabla["estado"] = "1";
            $gen_tabla["gen_tabla"] = $retorno;
            // Enviar objeto json de la gen_tabla
            header('Content-Type: application/json');
            echo json_encode($gen_tabla);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en Tabla'
                )
            );
        }
    } 
    elseif (isset($_GET['idU']) && isset($_GET['idC'])) {
        // Obtener parámetro idUsuario y idClave de usu_usuario
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = USU_USUARIO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $gen_tabla["estado"] = "1";
            $gen_tabla["gen_tabla"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($gen_tabla);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    }

    elseif (isset($_GET['ExisteTabla']) )
    {
        $par1 = $_GET['Nombre'];
        $par2 = $_GET['Nombremostrar'];

        $retorno = GEN_TABLA::existetabla($par1, $par2);
        if ($retorno) 
        {
            $gen_tabla["estado"] = "1";
            $gen_tabla["gen_tabla"] = $retorno;
            // Enviar objeto json de la gen_tabla
            header('Content-Type: application/json');
            echo json_encode($gen_tabla);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    }

    elseif (isset($_GET['IdMostrar'])) {
        // Obtener parámetro IdMostrar de gen_tabla
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = GEN_TABLA::getAll($parametro);

        if ($retorno) 
        {
            $gen_tabla["estado"] = "1";
            $gen_tabla["gen_tabla"] = $retorno;
            // Enviar objeto json de la gen_tabla
            header('Content-Type: application/json');
            echo json_encode($gen_tabla);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    
    }

    else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}
?>