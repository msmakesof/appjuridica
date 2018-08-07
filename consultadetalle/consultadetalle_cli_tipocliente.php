<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/cli_tipocliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $LNK_TABLA = "TIPOCLIENTE";
        $lnk_tabla = strtolower($LNK_TABLA);

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = CLI_TIPOCLIENTE::getById($parametro);

        if ($retorno) {
            $cli_tipocliente["estado"] = "1";
            $cli_tipocliente["cli_tipocliente"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($cli_tipocliente);
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
        // Obtener parámetro idEstado de cli_tipocliente
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = CLI_TIPOCLIENTE::getByIdEstado($parametro);

        if ($retorno) {
            $cli_tipocliente["estado"] = "1";
            $cli_tipocliente["cli_tipocliente"] = $retorno;
            // Enviar objeto json de cli_tipocliente
            header('Content-Type: application/json');
            echo json_encode($cli_tipocliente);
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
        // Obtener parámetro idUsuario y idClave de GEN_tipodocumento
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = CLI_TIPOCLIENTE::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $cli_tipocliente["estado"] = "1";
            $cli_tipocliente["cli_tipocliente"] = $retorno;
            // Enviar objeto json de cli_tipocliente
            header('Content-Type: application/json');
            echo json_encode($cli_tipocliente);
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

        $retorno = CLI_TIPOCLIENTE::existetabla($par1);
        if ($retorno) 
        {
            $cli_tipocliente["estado"] = "1";
            $cli_tipocliente["cli_tipocliente"] = $retorno;
            // Enviar objeto json de la cli_tipocliente
            header('Content-Type: application/json');
            echo json_encode($cli_tipocliente);
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
        // Obtener parámetro IdMostrar de cli_tipocliente
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = CLI_TIPOCLIENTE::getAll($parametro);

        if ($retorno) 
        {
            $cli_tipocliente["estado"] = "1";
            $cli_tipocliente["cli_tipocliente"] = $retorno;
            // Enviar objeto json de la cli_tipocliente
            header('Content-Type: application/json');
            echo json_encode($cli_tipocliente);
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
        $par2 = $_GET['Estado'];

        $retorno = CLI_TIPOCLIENTE::insert($par1, $par2);
        $msj = $retorno;
        if($retorno)
        {
            $cli_tipocliente["estado"] = "1";
            $cli_tipocliente["cli_tipocliente"] = $retorno;
             // Enviar objeto json de la cli_tipocliente
            header('Content-Type: application/json');
            echo json_encode($cli_tipocliente);
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
        $par2 = $_GET['estado'];
        $par3 = $_GET['idtabla'];

        $retorno = CLI_TIPOCLIENTE::update($par1, $par2, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $cli_tipocliente["estado"] = "1";
            $cli_tipocliente["cli_tipocliente"] = $retorno;
             // Enviar objeto json de la gen_ciudad
            header('Content-Type: application/json');
            echo json_encode($cli_tipocliente);
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

        $retorno = CLI_TIPOCLIENTE::delete($par0);
        if ($retorno) 
        {
            $cli_tipocliente["estado"] = "1";
            $cli_tipocliente["cli_tipocliente"] = $retorno;
            // Enviar objeto json de la gen_departamento
            header('Content-Type: application/json');
            echo json_encode($cli_tipocliente);
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