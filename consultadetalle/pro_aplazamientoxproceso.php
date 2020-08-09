<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/pro_proceso.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $LNK_TABLA = "FESTIVO";
        $lnk_tabla = strtolower($LNK_TABLA);

    if (isset($_GET['IdMostrar'])) {
        // Tratar retorno
        $tap = $_GET['TAP'];
        $np = $_GET['NP'];

        $retorno = PRO_PROCESO::getAllTAP($tap, $np);

        if ($retorno) 
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de pro_proceso
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

    elseif (isset($_GET['IdTabla'])) {

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
		$par2 = $_GET['idtabla'];

        $retorno = GEN_FESTIVO::existetabla($par1,$par2);
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

   
    elseif(isset($_GET['asigna']) )
    {
        //Obtener Parametros
        $par1 = $_GET['TAP'];        
        $par2 = $_GET['OPC'];
        $par3 = $_GET['NP'];

        $retorno = PRO_PROCESO::asigna($par1, $par2, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
             // Enviar objeto json de pro_proceso
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