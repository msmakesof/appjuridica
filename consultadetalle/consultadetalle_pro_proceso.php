<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/pro_proceso.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = PRO_PROCESO::getById($parametro);

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

    elseif(isset($_GET['IdResponsable'])) {

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdResponsable'];

        // Tratar retorno
        $retorno = PRO_PROCESO::getByIdResponsable($parametro);

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

	elseif (isset($_GET['EmailProceso']))
	{
		// Obtener parámetro EmailProceso
        $parametro = trim($_GET['Proceso']);

        // Tratar retorno
        $retorno = PRO_PROCESO::EmailProceso($parametro);

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
	elseif (isset($_GET['maxid']))
	{
		// Obtener parámetro maxid
		$parametro = $_GET['maxid'];
		
		// Tratar Retorno
		$retorno = PRO_PROCESO::MaxId($parametro);
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
        $retorno = PRO_PROCESO::getByIdEstado($parametro);

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
        $retorno = PRO_PROCESO::getByIdExiste($parametro,$parametroC);

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
        $par1 = $_GET['Proceso'];
        $par2 = $_GET['Demandante'];
        $par3 = $_GET['Demandado'];
		$par4 = $_GET['Fecha'];
		$par5 = $_GET['Asignadoa'];		

        $retorno = PRO_PROCESO::existetabla($par1, $par2, $par3, $par4, $par5);
        if ($retorno) 
        {
            $pro_proceso["estado"] = "1";
            $pro_proceso["pro_proceso"] = $retorno;
            // Enviar objeto json de PRO_PROCESO
            header('Content-Type: application/json');
            echo json_encode($pro_proceso);
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
		$parametro2 = "";
		if( isset($_GET['e']) )
		{
			$parametro2 = $_GET['e'];
		}
		
		
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = PRO_PROCESO::getAll($parametro,$parametro2);

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
        $par1 = $_GET['Demandante'];
        $par2 = $_GET['Demandado'];        
        $par3 = $_GET['Proceso'];        
        $par4 = $_GET['Fechainicio'];
        $par5 = $_GET['Asignadoa'];        
        $par6 = $_GET['Ubicacion'];
        $par7 = $_GET['Claseproceso'];
        $par8 = $_GET['JuzgadoOrigen'];
        $par9 = $_GET['Estado'];
        $par10 = $_GET['Especialidad'];
        $par11 = $_GET['Despacho'];

        $retorno = PRO_PROCESO::insert($par1, $par2, $par3, $par4, $par5, $par6, $par7, $par8, $par9, $par10, $par11);
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
                    'mensaje' => 'No se obtuvo el registro al Crear'
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

        $retorno = PRO_PROCESO::update($par1, $par2, $par3, $par4, $par5, $par6, $par7, $par8, $par9);
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

        $retorno = PRO_PROCESO::cierre($par1, $par2, $par3, $par4, $par5);
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

        $retorno = PRO_PROCESO::delete($par1, $par0);
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