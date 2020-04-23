<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/gen_pais.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = GEN_PAIS::getById($parametro);

        if ($retorno) {
            $gen_pais["estado"] = "1";
            $gen_pais["gen_pais"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_pais);
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
        // Obtener parámetro idEstado de GEN_PAIS
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = GEN_PAIS::getByIdEstado($parametro);

        if ($retorno) {
            $gen_pais["estado"] = "1";
            $gen_pais["gen_pais"] = $retorno;
            // Enviar objeto json de la GEN_PAIS
            header('Content-Type: application/json');
            echo json_encode($gen_pais);
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
            $gen_pais["estado"] = "1";
            $gen_pais["gen_pais"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($gen_pais);
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
		$par2 = $_GET['idtabla'];

        $retorno = GEN_PAIS::existetabla($par1, $par2);
        if ($retorno) 
        {
            $gen_pais["estado"] = "1";
            $gen_pais["gen_pais"] = $retorno;
            // Enviar objeto json de la GEN_PAIS
            header('Content-Type: application/json');
            echo json_encode($gen_pais);
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
        // Obtener parámetro IdMostrar de GEN_PAIS
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = GEN_PAIS::getAll($parametro);

        if ($retorno) 
        {
            $gen_pais["estado"] = "1";
            $gen_pais["gen_pais"] = $retorno;
            // Enviar objeto json de la GEN_PAIS
            header('Content-Type: application/json');
            echo json_encode($gen_pais);
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

        $retorno = GEN_PAIS::insert($par1, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $gen_pais["estado"] = "1";
            $gen_pais["gen_pais"] = $retorno;
             // Enviar objeto json de la GEN_PAIS
            header('Content-Type: application/json');
            echo json_encode($gen_pais);
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
        //$par2 = $_GET['nombremostrar'];
        $par3 = $_GET['estado'];
        $par4 = $_GET['idtabla'];

        $retorno = GEN_PAIS::update($par1, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $gen_pais["estado"] = "1";
            $gen_pais["gen_pais"] = $retorno;
             // Enviar objeto json de la GEN_PAIS
            header('Content-Type: application/json');
            echo json_encode($gen_pais);
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

        $retorno = GEN_PAIS::delete($par0);
        if ($retorno) 
        {
            $gen_pais["estado"] = "1";
            $gen_pais["gen_pais"] = $retorno;
            // Enviar objeto json de la GEN_PAIS
            header('Content-Type: application/json');
            echo json_encode($gen_pais);
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