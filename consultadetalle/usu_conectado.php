<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/usu_conectado.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) 
	{

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = USU_CONECTADO ::getById($parametro);

        if ($retorno) {
            $usu_conectado["estado"] = "1";
            $usu_conectado["usu_conectado"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($usu_conectado);
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
    elseif (isset($_GET['IdMostrar'])) 
	{
        // Obtener parámetro IdMostrar de PRO_ACTUACIONPROCESAL
        $par  = $_GET['IdMostrar'];
		$par2 = $_GET['E'];
		$par3 = $_GET['Proceso'];
		$par4 = $_GET['IdTipouser'];  // IdUsuario = Abogado      IDEmpresa = Admin
		
        if($par == 0)
        {
            $par == "";
        }

        // Tratar retorno $par2, 
        $retorno = USU_CONECTADO ::getAll($par3, $par4);

        if ($retorno) 
        {
            $usu_conectado["estado"] = "1";
            $usu_conectado["usu_conectado"] = $retorno;
            // Enviar objeto json deusu_conectado
            header('Content-Type: application/json');
            echo json_encode($usu_conectado);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro para Mostrar todos las Actuaciones Procesales'
                )
            );
        }    
    }
	elseif (isset($_GET['ExisteActPro']) )
    {
        $par1 = $_GET['Proceso'];
        $par2 = $_GET['FechaInicio'];
        $par3 = $_GET['ActPro'];
		$par4 = $_GET['FechaEstado'];
		$par5 = $_GET['Observacion'];		

        $retorno = USU_CONECTADO ::existeactpro($par1, $par2, $par3, $par4, $par5);
        if ($retorno) 
        {
            $usu_conectado["estado"] = "1";
            $usu_conectado["usu_conectado"] = $retorno;
            // Enviar objeto json de PRO_ACTUACIONPROCESAL
            header('Content-Type: application/json');
            echo json_encode($usu_conectado);
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
	elseif (isset($_GET['maxid']))
	{
		// Obtener parámetro maxid
		$parametro = $_GET['maxid'];
		
		// Tratar Retorno
		$retorno = USU_CONECTADO ::MaxId($parametro);
		if ($retorno) {
            $usu_conectado["estado"] = "1";
            $usu_conectado["usu_conectado"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($usu_conectado);
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
    elseif(isset($_GET['insert']) )
    {
        //Obtener Parametros
        $par1 = $_GET['IdUsuario'];
		$par2 = $_GET['Ac'];
		$par3 = 1;

        $retorno = USU_CONECTADO ::insert($par1, $par2, $par3);
        $msj = $retorno;
        if($retorno)
        {
            $usu_conectado["estado"] = "1";
            $usu_conectado["usu_conectado"] = $retorno;
             // Enviar objeto json deusu_conectado
            header('Content-Type: application/json');
            echo json_encode($usu_conectado);
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
		$par =  $_GET['Nuevoestado'];
        $par1 = $_GET['IdUsuario'];
		$par2 = $_GET['Estado']; ;		

        $retorno = USU_CONECTADO ::update($par,$par1,$par2);
        $msj = $retorno;
        if($retorno)
        {
            $usu_conectado["estado"] = "1";
            $usu_conectado["usu_conectado"] = $retorno;
             // Enviar objeto json deusu_conectado
            header('Content-Type: application/json');
            echo json_encode($usu_conectado);
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

        $retorno = USU_CONECTADO ::delete($par0);
        if ($retorno) 
        {
            $usu_conectado["estado"] = "1";
            $usu_conectado["usu_conectado"] = $retorno;
            // Enviar objeto json deusu_conectado
            header('Content-Type: application/json');
            echo json_encode($usu_conectado);
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
	else 
	{
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador en consuta detalle del Actuacion Procesal.'
            )
        );
    }
}
?>