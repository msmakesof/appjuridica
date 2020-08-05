<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/gen_eventoinusual.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $LNK_TABLA = "EVENTOINUSUAL";
        $lnk_tabla = strtolower($LNK_TABLA);

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = GEN_EVENTOINUSUAL::getById($parametro);

        if ($retorno) {
            $gen_eventoinusual["estado"] = "1";
            $gen_eventoinusual["gen_eventoinusual"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_eventoinusual);
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
        // Obtener parámetro idEstado de gen_departamento
        $parametro = $_GET['IdEstado'];

        // Tratar retorno
        $retorno = GEN_EVENTOINUSUAL::getByIdEstado($parametro);

        if ($retorno) {
            $gen_eventoinusual["estado"] = "1";
            $gen_eventoinusual["gen_eventoinusual"] = $retorno;
            // Enviar objeto json de la gen_eventoinusual
            header('Content-Type: application/json');
            echo json_encode($gen_eventoinusual);
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
        $retorno = GEN_EVENTOINUSUAL::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $gen_departamento["estado"] = "1";
            $gen_departamento["gen_departamento"] = $retorno;
            // Enviar objeto json de la usu_usuario
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
    elseif ( isset($_GET['IdTablacxd']) ){
        $parametro = $_GET['IdTablacxd'];
        $retorno = GEN_EVENTOINUSUAL::ciudadesxdepto($parametro);
        if ($retorno) 
        {
            $gen_eventoinusual["estado"] = "1";
            $gen_eventoinusual["gen_eventoinusual"] = $retorno;
            // Enviar objeto json de la gen_eventoinusual
            header('Content-Type: application/json');
            echo json_encode($gen_eventoinusual);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro Ciudades x Departamento'
                )
            );
        }
    }

    elseif (isset($_GET['ExisteTabla']) )
    {
        $par1 = $_GET['Nombre'];
        $par2 = $_GET['Fechainicio'];
		$par3 = $_GET['Fechafinal'];
		$par4 = $_GET['idtabla'];

        $retorno = GEN_EVENTOINUSUAL::existetabla($par1, $par2, $par3, $par4);
        if ($retorno) 
        {
            $gen_eventoinusual["estado"] = "1";
            $gen_eventoinusual["gen_eventoinusual"] = $retorno;
            // Enviar objeto json de la gen_eventoinusual
            header('Content-Type: application/json');
            echo json_encode($gen_eventoinusual);
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
        // Obtener parámetro IdMostrar de gen_departamento
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = GEN_EVENTOINUSUAL::getAll($parametro);

        if ($retorno) 
        {
            $gen_eventoinusual["estado"] = "1";
            $gen_eventoinusual["gen_eventoinusual"] = $retorno;
            // Enviar objeto json de la gen_eventoinusual
            header('Content-Type: application/json');
            echo json_encode($gen_eventoinusual);
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
        $par2 = $_GET['Fechainicio']; 
        $par3 = $_GET['Fechafinal'];        
        $par4 = $_GET['Estado'];

        $retorno = GEN_EVENTOINUSUAL::insert($par1, $par2, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $gen_eventoinusual["estado"] = "1";
            $gen_eventoinusual["gen_eventoinusual"] = $retorno;
             // Enviar objeto json de la gen_eventoinusual
            header('Content-Type: application/json');
            echo json_encode($gen_eventoinusual);
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
        $par2 = $_GET['fechainicio'];
        $par3 = $_GET['fechafinal']; 
        $par4 = $_GET['estado'];
        $par5 = $_GET['idtabla'];

        $retorno = GEN_EVENTOINUSUAL::update($par1, $par2, $par3, $par4, $par5);
        $msj = $retorno;
        if($retorno)
        {
            $gen_eventoinusual["estado"] = "1";
            $gen_eventoinusual["gen_eventoinusual"] = $retorno;
             // Enviar objeto json de la gen_eventoinusual
            header('Content-Type: application/json');
            echo json_encode($gen_eventoinusual);
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

        $retorno = GEN_EVENTOINUSUAL::delete($par0);
        if ($retorno) 
        {
            $gen_eventoinusual["estado"] = "1";
            $gen_eventoinusual["gen_eventoinusual"] = $retorno;
            // Enviar objeto json de la gen_departamento
            header('Content-Type: application/json');
            echo json_encode($gen_eventoinusual);
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