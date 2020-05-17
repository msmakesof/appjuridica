<?php
/**
 * Obtiene el detalle de una Tabla especificada porIdEstado
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/usu_tipousuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = USU_TIPOUSUARIO::getById($parametro);

        if ($retorno) {
            $usu_tipousuario["estado"] = "1";
            $usu_tipousuario["usu_tipousuario"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($usu_tipousuario);
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
	
	elseif (isset($_GET['IdJuridicos'])) {

        // Obtener parámetro IdTabla
        $parametro = trim($_GET['IdJuridicos']);

        // Tratar retorno
        $retorno = USU_TIPOUSUARIO::getByJuridicos($parametro);

        if ($retorno) {
            $usu_tipousuario["estado"] = "1";
            $usu_tipousuario["usu_tipousuario"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($usu_tipousuario);
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
        // Obtener parámetro idEstado de USU_TIPOUSUARIO
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = USU_TIPOUSUARIO::getByIdEstado($parametro);

        if ($retorno) {
            $usu_tipousuario["estado"] = "1";
            $usu_tipousuario["usu_tipousuario"] = $retorno;
            // Enviar objeto json de la USU_TIPOUSUARIO
            header('Content-Type: application/json');
            echo json_encode($usu_tipousuario);
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
        // Obtener parámetro idUsuario y idClave de USU_TIPOUSUARIO
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = USU_USUARIO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $usu_tipousuario["estado"] = "1";
            $usu_tipousuario["usu_tipousuario"] = $retorno;
            // Enviar objeto json de USU_TIPOUSUARIO
            header('Content-Type: application/json');
            echo json_encode($usu_tipousuario);
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

        $retorno = USU_TIPOUSUARIO::existetabla($par1);
        if ($retorno) 
        {
            $usu_tipousuario["estado"] = "1";
            $usu_tipousuario["usu_tipousuario"] = $retorno;
            // Enviar objeto json de la USU_TIPOUSUARIO
            header('Content-Type: application/json');
            echo json_encode($usu_tipousuario);
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
        // Obtener parámetro IdMostrar de USU_TIPOUSUARIO
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = USU_TIPOUSUARIO::getAll($parametro);

        if ($retorno) 
        {
            $usu_tipousuario["estado"] = "1";
            $usu_tipousuario["usu_tipousuario"] = $retorno;
            // Enviar objeto json de USU_TIPOUSUARIO
            header('Content-Type: application/json');
            echo json_encode($usu_tipousuario);
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

        $retorno = USU_TIPOUSUARIO::insert($par1, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $usu_tipousuario["estado"] = "1";
            $usu_tipousuario["usu_tipousuario"] = $retorno;
             // Enviar objeto json de USU_TIPOUSUARIO
            header('Content-Type: application/json');
            echo json_encode($usu_tipousuario);
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

        $retorno = USU_TIPOUSUARIO::update($par1, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $usu_tipousuario["estado"] = "1";
            $usu_tipousuario["usu_tipousuario"] = $retorno;
             // Enviar objeto json de USU_TIPOUSUARIO
            header('Content-Type: application/json');
            echo json_encode($usu_tipousuario);
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

        $retorno = USU_TIPOUSUARIO::delete($par0);
        if ($retorno) 
        {
            $usu_tipousuario["estado"] = "1";
            $usu_tipousuario["usu_tipousuario"] = $retorno;
            // Enviar objeto json de USU_TIPOUSUARIO
            header('Content-Type: application/json');
            echo json_encode($usu_tipousuario);
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