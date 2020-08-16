<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/pro_actuacionprocesal.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) 
	{

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = PRO_ACTUACIONPROCESAL::getById($parametro);

        if ($retorno) {
            $pro_actuacionprocesal["estado"] = "1";
            $pro_actuacionprocesal["pro_actuacionprocesal"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_actuacionprocesal);
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
        $retorno = PRO_ACTUACIONPROCESAL::getAll($par4, $par3);

        if ($retorno) 
        {
            $pro_actuacionprocesal["estado"] = "1";
            $pro_actuacionprocesal["pro_actuacionprocesal"] = $retorno;
            // Enviar objeto json de la PRO_ACTUACIONPROCESAL
            header('Content-Type: application/json');
            echo json_encode($pro_actuacionprocesal);
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
        $par3 = $_GET['Origen'];
        $par4 = $_GET['ActPro'];
		$par5 = $_GET['FechaEstado'];
		$par6 = $_GET['Observacion'];		

        $retorno = PRO_ACTUACIONPROCESAL::existeactpro($par1, $par2, $par3, $par4, $par5,$par6);
        if ($retorno) 
        {
            $pro_actuacionprocesal["estado"] = "1";
            $pro_actuacionprocesal["pro_actuacionprocesal"] = $retorno;
            // Enviar objeto json de PRO_ACTUACIONPROCESAL
            header('Content-Type: application/json');
            echo json_encode($pro_actuacionprocesal);
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
		$retorno = PRO_ACTUACIONPROCESAL::MaxId($parametro);
		if ($retorno) {
            $pro_actuacionprocesal["estado"] = "1";
            $pro_actuacionprocesal["pro_actuacionprocesal"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_actuacionprocesal);
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
        $par1 = $_GET['Proceso'];
        $par2 = $_GET['Fechainicio'];
        $par3 = $_GET['Origen'];
		$par4 = $_GET['ActPro'];
        $par5 = $_GET['FechaEstado'];        
        $par6 = $_GET['Observacion'];
		$par7 = $_GET['Usuario'];
		$par8 = $_GET['EstadoActPro'];
		$par9 = $_GET['Gasto'];

        $retorno = PRO_ACTUACIONPROCESAL::insert($par1, $par2, $par3, $par4, $par5, $par6, $par7, $par8, $par9);
        $msj = $retorno;
        if($retorno)
        {
            $pro_actuacionprocesal["estado"] = "1";
            $pro_actuacionprocesal["pro_actuacionprocesal"] = $retorno;
             // Enviar objeto json de la PRO_ACTUACIONPROCESAL
            header('Content-Type: application/json');
            echo json_encode($pro_actuacionprocesal);
        }
        else
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro al Crear',
					'msj' => $msj
                )
            );
        }
    }
	elseif(isset($_GET['update']) )
    {
        //Obtener Parametros
        $par1 = $_GET['fechainicio'];
		$par2 = $_GET['actpro'];		
        $par3 = $_GET['fechaestado'];
		$par4 = $_GET['observacion'];
		$par5 = $_GET['gasto'];
        $par6 = $_GET['idtabla'];

        $retorno = PRO_ACTUACIONPROCESAL::update($par1, $par2, $par3, $par4, $par5, $par6);
        $msj = $retorno;
        if($retorno)
        {
            $pro_actuacionprocesal["estado"] = "1";
            $pro_actuacionprocesal["pro_actuacionprocesal"] = $retorno;
             // Enviar objeto json de la pro_actuacionprocesal
            header('Content-Type: application/json');
            echo json_encode($pro_actuacionprocesal);
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

        $retorno = PRO_ACTUACIONPROCESAL::delete($par0);
        if ($retorno) 
        {
            $pro_actuacionprocesal["estado"] = "1";
            $pro_actuacionprocesal["pro_actuacionprocesal"] = $retorno;
            // Enviar objeto json de la pro_actuacionprocesal
            header('Content-Type: application/json');
            echo json_encode($pro_actuacionprocesal);
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