<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_grupo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = GEN_GRUPO::getById($parametro);

        if ($retorno) {
            $gen_grupo["estado"] = "1";
            $gen_grupo["gen_grupo"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_grupo);
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
    elseif (isset($_GET['IdEstado'])) {
        // Obtener parámetro idEstado de GEN_GRUPO
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = GEN_GRUPO::getByIdEstado($parametro);

        if ($retorno) {
            $gen_grupo["estado"] = "1";
            $gen_grupo["gen_grupo"] = $retorno;
            // Enviar objeto json de la GEN_GRUPO
            header('Content-Type: application/json');
            echo json_encode($gen_grupo);
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
        $retorno = USU_GRUPO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $gen_grupo["estado"] = "1";
            $gen_grupo["gen_grupo"] = $retorno;
            // Enviar objeto json de  gen_GRUPO
            header('Content-Type: application/json');
            echo json_encode($gen_grupo);
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

        $retorno = GEN_GRUPO::existetabla($par1);
        if ($retorno) 
        {
            $gen_grupo["estado"] = "1";
            $gen_grupo["gen_grupo"] = $retorno;
            // Enviar objeto json de la GEN_GRUPO
            header('Content-Type: application/json');
            echo json_encode($gen_grupo);
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
        // Obtener parámetro IdMostrar de GEN_GRUPO
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = GEN_GRUPO::getAll($parametro);

        if ($retorno) 
        {
            $gen_grupo["estado"] = "1";
            $gen_grupo["gen_grupo"] = $retorno;
            // Enviar objeto json de la GEN_PAIS
            header('Content-Type: application/json');
            echo json_encode($gen_grupo);
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
    elseif(isset($_GET['insert']) )
    {
        //Obtener Parametros
        $par1 = $_GET['Nombre'];        
        $par3 = $_GET['Estado'];

        $retorno = GEN_GRUPO::insert($par1, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $gen_grupo["estado"] = "1";
            $gen_grupo["gen_grupo"] = $retorno;
             // Enviar objeto json de la GEN_GRUPO
            header('Content-Type: application/json');
            echo json_encode($gen_grupo);
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
    elseif(isset($_GET['update']) )
    {
        //Obtener Parametros
        $par1 = $_GET['nombre'];        
        $par3 = $_GET['estado'];
        $par4 = $_GET['idtabla'];

        $retorno = GEN_GRUPO::update($par1, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $gen_grupo["estado"] = "1";
            $gen_grupo["gen_grupo"] = $retorno;
             // Enviar objeto json de la GEN_GRUPO
            header('Content-Type: application/json');
            echo json_encode($gen_grupo);
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
    elseif(isset($_GET['delete']) )
    {
        $par0  = $_GET['pidtabla'];

        $retorno = GEN_GRUPO::delete($par0);
        if ($retorno) 
        {
            $gen_grupo["estado"] = "1";
            $gen_grupo["gen_grupo"] = $retorno;
            // Enviar objeto json de la GEN_GRUPO
            header('Content-Type: application/json');
            echo json_encode($gen_grupo);
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