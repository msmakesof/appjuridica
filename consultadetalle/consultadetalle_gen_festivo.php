<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/gen_festivo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $LNK_TABLA = "FESTIVO";
        $lnk_tabla = strtolower($LNK_TABLA);

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = GEN_FESTIVO::getById($parametro);

        if ($retorno) {
            $gen_festivo["estado"] = "1";
            $gen_festivo["gen_festivo"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_festivo);
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
        // Obtener parámetro idEstado de gen_festivo
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = GEN_FESTIVO::getByIdEstado($parametro);

        if ($retorno) {
            $gen_festivo["estado"] = "1";
            $gen_festivo["gen_festivo"] = $retorno;
            // Enviar objeto json de la gen_festivo
            header('Content-Type: application/json');
            echo json_encode($gen_festivo);
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
        $retorno = GEN_FESTIVO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $gen_festivo["estado"] = "1";
            $gen_festivo["gen_festivo"] = $retorno;
            // Enviar objeto json de gen_festivo
            header('Content-Type: application/json');
            echo json_encode($gen_departamento);
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
		//$par2 = $_GET['idtabla'];

        $retorno = GEN_FESTIVO::existetabla($par1); //,$par2
        if ($retorno) 
        {
            $gen_festivo["estado"] = "1";
            $gen_festivo["gen_festivo"] = $retorno;
            // Enviar objeto json de la gen_festivo
            header('Content-Type: application/json');
            echo json_encode($gen_festivo);
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
        // Obtener parámetro IdMostrar de gen_festivo
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = GEN_FESTIVO::getAll($parametro);

        if ($retorno) 
        {
            $gen_festivo["estado"] = "1";
            $gen_festivo["gen_festivo"] = $retorno;
            // Enviar objeto json de la gen_festivo
            header('Content-Type: application/json');
            echo json_encode($gen_festivo);
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
        $par2 = $_GET['VanciaJudicial'];         
        $par3 = $_GET['Estado'];

        $retorno = GEN_FESTIVO::insert($par1, $par2, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $gen_festivo["estado"] = "1";
            $gen_festivo["gen_festivo"] = $retorno;
             // Enviar objeto json de la gen_festivo
            header('Content-Type: application/json');
            echo json_encode($gen_festivo);
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
        $par2 = $_GET['vanciaJudicial']; 
        $par3 = $_GET['estado'];
        $par4 = $_GET['idtabla'];

        $retorno = GEN_FESTIVO::update($par1, $par2, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $gen_festivo["estado"] = "1";
            $gen_festivo["gen_festivo"] = $retorno;
             // Enviar objeto json de la gen_festivo
            header('Content-Type: application/json');
            echo json_encode($gen_festivo);
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

        $retorno = GEN_FESTIVO::delete($par0);
        if ($retorno) 
        {
            $gen_festivo["estado"] = "1";
            $gen_festivo["gen_ciudad"] = $retorno;
            // Enviar objeto json de la gen_festivo
            header('Content-Type: application/json');
            echo json_encode($gen_festivo);
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