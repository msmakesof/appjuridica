<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/gen_noticiasjudiciales.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $LNK_TABLA = "NOTICIASJUDICIALES";
        $lnk_tabla = strtolower($LNK_TABLA);

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = GEN_NOTICIASJUDICIALES::getById($parametro);

        if ($retorno) {
            $gen_noticiasjudiciales["estado"] = "1";
            $gen_noticiasjudiciales["gen_noticiasjudiciales"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_noticiasjudiciales);
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
        $retorno = GEN_NOTICIASJUDICIALES::getByIdEstado($parametro);

        if ($retorno) {
            $gen_noticiasjudiciales["estado"] = "1";
            $gen_noticiasjudiciales["gen_noticiasjudiciales"] = $retorno;
            // Enviar objeto json de la gen_noticiasjudiciales
            header('Content-Type: application/json');
            echo json_encode($gen_noticiasjudiciales);
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
        $retorno = GEN_NOTICIASJUDICIALES::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $gen_noticiasjudiciales["estado"] = "1";
            $gen_noticiasjudiciales["gen_noticiasjudiciales"] = $retorno;
            // Enviar objeto json de gen_noticiasjudiciales
            header('Content-Type: application/json');
            echo json_encode($gen_noticiasjudiciales);
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
		$par2 = $_GET['Texto'];
		$par3 = $_GET['idtabla'];

        $retorno = GEN_NOTICIASJUDICIALES::existetabla($par1,$par2,$par3);
        if ($retorno) 
        {
            $gen_noticiasjudiciales["estado"] = "1";
            $gen_noticiasjudiciales["gen_noticiasjudiciales"] = $retorno;
            // Enviar objeto json de la gen_noticiasjudiciales
            header('Content-Type: application/json');
            echo json_encode($gen_noticiasjudiciales);
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
        // Obtener parámetro IdMostrar de gen_noticiasjudiciales
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = GEN_NOTICIASJUDICIALES::getAll($parametro);

        if ($retorno) 
        {
            $gen_noticiasjudiciales["estado"] = "1";
            $gen_noticiasjudiciales["gen_noticiasjudiciales"] = $retorno;
            // Enviar objeto json de la gen_noticiasjudiciales
            header('Content-Type: application/json');
            echo json_encode($gen_noticiasjudiciales);
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
        $par2 = $_GET['Texto'];         
        $par3 = $_GET['Estado'];

        $retorno = GEN_NOTICIASJUDICIALES::insert($par1, $par2, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $gen_noticiasjudiciales["estado"] = "1";
            $gen_noticiasjudiciales["gen_noticiasjudiciales"] = $retorno;
             // Enviar objeto json de la gen_noticiasjudiciales
            header('Content-Type: application/json');
            echo json_encode($gen_noticiasjudiciales);
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
        $par2 = $_GET['texto']; 
        $par3 = $_GET['estado'];
        $par4 = $_GET['idtabla'];

        $retorno = GEN_NOTICIASJUDICIALES::update($par1, $par2, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $gen_noticiasjudiciales["estado"] = "1";
            $gen_noticiasjudiciales["gen_noticiasjudiciales"] = $retorno;
             // Enviar objeto json de la gen_noticiasjudiciales
            header('Content-Type: application/json');
            echo json_encode($gen_noticiasjudiciales);
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

        $retorno = GEN_NOTICIASJUDICIALES::delete($par0);
        if ($retorno) 
        {
            $gen_noticiasjudiciales["estado"] = "1";
            $gen_noticiasjudiciales["gen_ciudad"] = $retorno;
            // Enviar objeto json de la gen_noticiasjudiciales
            header('Content-Type: application/json');
            echo json_encode($gen_noticiasjudiciales);
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