<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/gen_tipodocumento.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $LNK_TABLA = "TIPODOCUMENTO";
        $lnk_tabla = strtolower($LNK_TABLA);

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = GEN_TIPODOCUMENTO::getById($parametro);

        if ($retorno) {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
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
        // Obtener parámetro idEstado de gen_tipodocumento
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = GEN_TIPODOCUMENTO::getByIdEstado($parametro);

        if ($retorno) {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
            // Enviar objeto json de gen_tipodocumento
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
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
        $retorno = GEN_TIPODOCUMENTO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
            // Enviar objeto json de gen_tipodocumento
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
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
        $par2 = $_GET['Abreviatura'];

        $retorno = GEN_TIPODOCUMENTO::existetabla($par1, $par2);
        if ($retorno) 
        {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
            // Enviar objeto json de la gen_tipodocumento
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
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
        // Obtener parámetro IdMostrar de gen_tipodocumento
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = GEN_TIPODOCUMENTO::getAll($parametro);

        if ($retorno) 
        {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
            // Enviar objeto json de la gen_tipodocumento
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
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
        $par2 = $_GET['Abreviatura'];         
        $par3 = $_GET['Estado'];

        $retorno = GEN_TIPODOCUMENTO::insert($par1, $par2, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
             // Enviar objeto json de la gen_tipodocumento
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
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
        $par2 = $_GET['abreviatura'];        
        $par3 = $_GET['estado'];
        $par4 = $_GET['idtabla'];

        $retorno = GEN_TIPODOCUMENTO::update($par1, $par2, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
             // Enviar objeto json de la gen_ciudad
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
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

        $retorno = GEN_TIPODOCUMENTO::delete($par0);
        if ($retorno) 
        {
            $gen_tipodocumento["estado"] = "1";
            $gen_tipodocumento["gen_tipodocumento"] = $retorno;
            // Enviar objeto json de la gen_departamento
            header('Content-Type: application/json');
            echo json_encode($gen_tipodocumento);
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