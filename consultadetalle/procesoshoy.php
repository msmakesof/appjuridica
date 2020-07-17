<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/pro_proceso.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $LNK_TABLA = "PROCESOS";
        $lnk_tabla = strtolower($LNK_TABLA);

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = PRO_PROCESO::getByIdHoy($parametro);

        if ($retorno) {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
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
        // Obtener parámetro idEstado de $pro_proceso
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = PRO_PROCESO::getByIdEstadoHoy($parametro);

        if ($retorno) {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de la gen_noticiasjudiciales
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
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
        // Obtener parámetro idUsuario y idClave de $pro_proceso
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = PRO_PROCESO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de $pro_proceso
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
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

        $retorno = PRO_PROCESO::existetabla($par1,$par2,$par3);
        if ($retorno) 
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de pro_procesos
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
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
        // Obtener parámetro IdMostrar de pro_procesos
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = PRO_PROCESO::getAll($parametro);

        if ($retorno) 
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de pro_procesos
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
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
		$par3 = $_GET['Lnk'];
        $par4 = $_GET['Estado'];

        $retorno = PRO_PROCESO::insert($par1, $par2, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
             // Enviar objeto json de pro_procesos
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
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
		$par3 = $_GET['lnk'];
        $par4 = $_GET['estado'];
        $par5 = $_GET['idtabla'];

        $retorno = PRO_PROCESO::update($par1, $par2, $par3, $par4, $par5);
        $msj = $retorno;
        if($retorno)
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
             // Enviar objeto json de pro_procesos
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
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

        $retorno = PRO_PROCESO::delete($par0);
        if ($retorno) 
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de pro_procesos
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
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