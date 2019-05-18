<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/eve_evento.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = EVE_EVENTO::getById($parametro);

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
                    'mensaje' => 'No se obtuvo el registro en Proceso por su Id'
                )
            );
        }
    }
    elseif (isset($_GET['IdEstado'])) {
        // Obtener parámetro idEstado de PRO_PROCESO
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = EVE_EVENTO::getByIdEstado($parametro);

        if ($retorno) {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de PRO_PROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro en para saber el estado de un Proceso'
                )
            );
        }
    } 
    elseif (isset($_GET['idU']) && isset($_GET['idC'])) {
        // Obtener parámetro idUsuario y idClave de usu_usuario
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = EVE_EVENTO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de  PRO_PROCESO
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
        $par1 = $_GET['From'];
        $par2 = $_GET['To'];
        $par3 = $_GET['Tipo'];
        $par4 = $_GET['Proceso'];
        $par5 = $_GET['Responsable'];

        $retorno = EVE_EVENTO::existetabla($par1, $par2, $par3, $par4, $par5);
        if ($retorno) 
        {
            $eve_evento["estado"] = "1";
            $eve_evento["eve_evento"] = $retorno;
            // Enviar objeto json de EVE_EVENTO
            header('Content-Type: application/json');
            echo json_encode($eve_evento);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro para saber si existe un registro igual'
                )
            );
        }
    }

    elseif (isset($_GET['IdMostrar'])) {
        // Obtener parámetro IdMostrar de PRO_PROCESO
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = EVE_EVENTO::getAll($parametro);

        if ($retorno) 
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de la PRO_PROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro para Mostrar todos los Procesos'
                )
            );
        }
    
    }
    elseif(isset($_GET['insert']) )
    {
        //Obtener Parametros
        $par1 = $_GET['Title'];
        $par2 = $_GET['Body'];
        $par3 = $_GET['Tipo'];
        $par4 = $_GET['Inicio'];
        $par5 = $_GET['Final'];
        $par6 = $_GET['From'];
        $par7 = $_GET['To'];        
        $par8 = $_GET['Proceso'];
        $par9 = $_GET['Responsable'];

        $retorno = EVE_EVENTO::insert($par1, $par2, $par3, $par4, $par5, $par6, $par7, $par8, $par9);
        $msj = $retorno;
        if($retorno)
        {
            $eve_evento["estado"] = "1";
            $eve_evento["eve_evento"] = $retorno;
             // Enviar objeto json de EVE_EVENTO
            header('Content-Type: application/json');
            echo json_encode($eve_evento);
        }
        else
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro al Crear Evento'
                )
            );
        }
    }
    elseif(isset($_GET['buscamax']))
    {
        $parametro = "";
        // Tratar retorno
        $retorno = EVE_EVENTO::MaxId($parametro);

        if ($retorno) 
        {
            $eve_evento["estado"] = "1";
            $eve_evento["eve_evento"] = $retorno;
            // Enviar objeto json de la EVE_EVENTO
            header('Content-Type: application/json');
            echo json_encode($eve_evento);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro para Mostrar el Registro'
                )
            );
        }
        
    }
    elseif(isset($_GET['updateurl']))
    {
        $par1 = $_GET['maxid'];
        $par2 = $_GET['maxid1'];
        // Tratar retorno
        $retorno = EVE_EVENTO::UpdateUrl($par1, $par2);
        $msj = $retorno;
        if ($retorno) 
        {
            $eve_evento["estado"] = "1";
            $eve_evento["eve_evento"] = $retorno;
            // Enviar objeto json de la EVE_EVENTO
            header('Content-Type: application/json');
            echo json_encode($eve_evento);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro para Mostrar el Registro'
                )
            );
        }
        
    }    
    elseif(isset($_GET['update']) )
    {
        //Obtener Parametros
        $par1 = $_GET['proceso'];        
        $par2 = $_GET['fechainicio'];
        $par3 = $_GET['asignadoa'];
	$par4 = $_GET['ubicacion'];        
        $par5 = $_GET['claseproceso'];
        $par6 = $_GET['demandante'];
	$par7 = $_GET['demandado'];        
        $par8 = $_GET['estado'];
        $par9 = $_GET['idtabla'];

        $retorno = EVE_EVENTO::update($par1, $par2, $par3, $par4, $par5, $par6, $par7, $par8, $par9);
        $msj = $retorno;
        if($retorno)
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
             // Enviar objeto json de la PRO_PROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
        }
        else
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro al Actualizar Proceso'
                )
            );
        }
    }
    //cierre proceso
    elseif(isset($_GET['cierre']) )
    {
        //Obtener Parametros
        $par1 = $_GET['estado'];
        $par2 = $_GET['observacion'];
        $par3 = $_GET['usuario'];       
        $par4 = $_GET['fechacierre'];
        $par5 = $_GET['idtabla'];

        $retorno = EVE_EVENTO::cierre($par1, $par2, $par3, $par4, $par5);
        $msj = $retorno;
        if($retorno)
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
             // Enviar objeto json de la PRO_PROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
        }
        else
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro al Actualizar Proceso'
                )
            );
        }
    }
    elseif(isset($_GET['delete']) )
    {
        $par1 = $_GET['estado'];
        $par0 = $_GET['pidtabla'];

        $retorno = EVE_EVENTO::delete($par1, $par0);
        if ($retorno) 
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de la PRO_PROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro al borrar el Proceso'
                )
            );
        }
    }
    else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador en consuta detalle del Proceso.'
            )
        );
    }
}
?>