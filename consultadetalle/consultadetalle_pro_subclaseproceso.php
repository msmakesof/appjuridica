<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/pro_subclaseproceso.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = PRO_SUBCLASEPROCESO::getById($parametro);

        if ($retorno) {
            $pro_subclaseproceso["estado"] = "1";
            $pro_subclaseproceso["pro_subclaseproceso"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_subclaseproceso);
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
        // Obtener parámetro idEstado de PRO_CLASEPROCESO
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = PRO_SUBCLASEPROCESO::getByIdEstado($parametro);

        if ($retorno) {
            $pro_subclaseproceso["estado"] = "1";
            $pro_subclaseproceso["pro_subclaseproceso"] = $retorno;
            // Enviar objeto json de PRO_CLASEPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_subclaseproceso);
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
            $pro_subclaseproceso["estado"] = "1";
            $pro_subclaseproceso["pro_subclaseproceso"] = $retorno;
            // Enviar objeto json de  PRO_CLASEPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_subclaseproceso);
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
        $par2 = $_GET['ClaseProceso'];

        $retorno = PRO_SUBCLASEPROCESO::existetabla($par1, $par2);
        if ($retorno) 
        {
            $pro_subclaseproceso["estado"] = "1";
            $pro_subclaseproceso["pro_subclaseproceso"] = $retorno;
            // Enviar objeto json de PRO_CLASEPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_subclaseproceso);
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
        // Obtener parámetro IdMostrar de PRO_CLASEPROCESO
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = PRO_SUBCLASEPROCESO::getAll($parametro);

        if ($retorno) 
        {
            $pro_subclaseproceso["estado"] = "1";
            $pro_subclaseproceso["pro_subclaseproceso"] = $retorno;
            // Enviar objeto json de la PRO_CLASEPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_subclaseproceso);
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
        $par2 = $_GET['ClaseProceso'];
        $par3 = $_GET['Estado'];

        $retorno = PRO_SUBCLASEPROCESO::insert($par1, $par2, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $pro_subclaseproceso["estado"] = "1";
            $pro_subclaseproceso["pro_subclaseproceso"] = $retorno;
             // Enviar objeto json de la  PRO_CLASEPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_subclaseproceso);
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
        $par2 = $_GET['claseproceso'];
        $par3 = $_GET['estado'];
        $par4 = $_GET['idtabla'];

        $retorno = PRO_SUBCLASEPROCESO::update($par1, $par2, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $pro_subclaseproceso["estado"] = "1";
            $pro_subclaseproceso["pro_subclaseproceso"] = $retorno;
             // Enviar objeto json de la PRO_CLASEPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_subclaseproceso);
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

        $retorno = PRO_SUBCLASEPROCESO::delete($par0);
        if ($retorno) 
        {
            $pro_subclaseproceso["estado"] = "1";
            $pro_subclaseproceso["pro_subclaseproceso"] = $retorno;
            // Enviar objeto json de la PRO_CLASEPROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_subclaseproceso);
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