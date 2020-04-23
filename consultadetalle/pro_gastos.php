<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/pro_gastos.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) 
	{

        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];

        // Tratar retorno
        $retorno = PRO_GASTO::getById($parametro);

        if ($retorno) {
            $pro_gasto["estado"] = "1";
            $pro_gasto["pro_gasto"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_gasto);
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
        // Obtener parámetro IdMostrar de PRO_GASTO
        $par  = $_GET['IdMostrar'];
		$par2 = $_GET['E'];
		$par3 = $_GET['Proceso'];
		$par4 = $_GET['IdTipouser'];  // IdUsuario = Abogado      IDEmpresa = Admin
		
        if($par == 0)
        {
            $par == "";
        }

        // Tratar retorno $par2, 
        $retorno = PRO_GASTO::getAll($par4, $par3);

        if ($retorno) 
        {
            $pro_gasto["estado"] = "1";
            $pro_gasto["pro_gasto"] = $retorno;
            // Enviar objeto json de la PRO_GASTO
            header('Content-Type: application/json');
            echo json_encode($pro_gasto);
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
        $par3 = $_GET['Concepto'];
		$par4 = $_GET['Gasto'];		

        $retorno = PRO_GASTO::existeactpro($par1, $par2, $par3, $par4);
        if ($retorno) 
        {
            $pro_gasto["estado"] = "1";
            $pro_gasto["pro_gasto"] = $retorno;
            // Enviar objeto json de PRO_GASTO
            header('Content-Type: application/json');
            echo json_encode($pro_gasto);
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
		$retorno = PRO_GASTO::MaxId($parametro);
		if ($retorno) {
            $pro_gasto["estado"] = "1";
            $pro_gasto["pro_gasto"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_gasto);
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
        $par3 = $_GET['Concepto'];
		$par4 = $_GET['Usuario'];		
		$par5 = $_GET['Gasto'];

        $retorno = PRO_GASTO::insert($par1, $par2, $par3, $par4, $par5);
        $msj = $retorno;
        if($retorno)
        {
            $pro_gasto["estado"] = "1";
            $pro_gasto["pro_gasto"] = $retorno;
             // Enviar objeto json de la PRO_GASTO
            header('Content-Type: application/json');
            echo json_encode($pro_gasto);
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
		$par2 = $_GET['concepto'];
		$par3 = $_GET['gasto'];
        $par4 = $_GET['idtabla'];

        $retorno = PRO_GASTO::update($par1, $par2, $par3, $par4);
        $msj = $retorno;
        if($retorno)
        {
            $pro_gasto["estado"] = "1";
            $pro_gasto["pro_gasto"] = $retorno;
             // Enviar objeto json de la PRO_GASTO
            header('Content-Type: application/json');
            echo json_encode($pro_gasto);
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

        $retorno = PRO_GASTO::delete($par0);
        if ($retorno) 
        {
            $pro_gasto["estado"] = "1";
            $pro_gasto["pro_gasto"] = $retorno;
            // Enviar objeto json de la PRO_GASTO
            header('Content-Type: application/json');
            echo json_encode($pro_gasto);
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