<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');

require '../estructura/gen_ciudad.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $LNK_TABLA = "CIUDAD";
        $lnk_tabla = strtolower($LNK_TABLA);

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = GEN_CIUDAD::getById($parametro);

        if ($retorno) {
            $gen_ciudad["estado"] = "1";
            $gen_ciudad["gen_ciudad"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($gen_ciudad);
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
        $retorno = GEN_CIUDAD::getByIdEstado($parametro);

        if ($retorno) {
            $gen_ciudad["estado"] = "1";
            $gen_ciudad["gen_ciudad"] = $retorno;
            // Enviar objeto json de la gen_ciudad
            header('Content-Type: application/json');
            echo json_encode($gen_ciudad);
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
        $retorno = GEN_CIUDAD::getByIdExiste($parametro,$parametroC);

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
        $retorno = GEN_CIUDAD::ciudadesxdepto($parametro);
        if ($retorno) 
        {
            $gen_ciudad["estado"] = "1";
            $gen_ciudad["gen_ciudad"] = $retorno;
            // Enviar objeto json de la gen_ciudad
            header('Content-Type: application/json');
            echo json_encode($gen_ciudad);
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
        $par2 = $_GET['Abreviatura'];
		$par3 = $_GET['Departamento'];
		$par4 = $_GET['idtabla'];

        $retorno = GEN_CIUDAD::existetabla($par1, $par2, $par3, $par4);
        if ($retorno) 
        {
            $gen_ciudad["estado"] = "1";
            $gen_ciudad["gen_ciudad"] = $retorno;
            // Enviar objeto json de la gen_ciudad
            header('Content-Type: application/json');
            echo json_encode($gen_ciudad);
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
        $retorno = GEN_CIUDAD::getAll($parametro);

        if ($retorno) 
        {
            $gen_ciudad["estado"] = "1";
            $gen_ciudad["gen_ciudad"] = $retorno;
            // Enviar objeto json de la gen_ciudad
            header('Content-Type: application/json');
            echo json_encode($gen_ciudad);
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
        $par3 = $_GET['Depto'];        
        $par4 = $_GET['Estado'];

        $retorno = GEN_CIUDAD::insert($par1, $par2, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $gen_ciudad["estado"] = "1";
            $gen_ciudad["gen_ciudad"] = $retorno;
             // Enviar objeto json de la gen_ciudad
            header('Content-Type: application/json');
            echo json_encode($gen_ciudad);
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
        $par3 = $_GET['depto']; 
        $par4 = $_GET['estado'];
        $par5 = $_GET['idtabla'];

        $retorno = GEN_CIUDAD::update($par1, $par2, $par3, $par4, $par5);
        $msj = $retorno;
        if($retorno)
        {
            $gen_ciudad["estado"] = "1";
            $gen_ciudad["gen_ciudad"] = $retorno;
             // Enviar objeto json de la gen_ciudad
            header('Content-Type: application/json');
            echo json_encode($gen_ciudad);
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

        $retorno = GEN_CIUDAD::delete($par0);
        if ($retorno) 
        {
            $gen_ciudad["estado"] = "1";
            $gen_ciudad["gen_ciudad"] = $retorno;
            // Enviar objeto json de la gen_departamento
            header('Content-Type: application/json');
            echo json_encode($gen_ciudad);
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