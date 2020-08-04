<?php
/**
 * Obtiene el detalle de una Tabla especificada por
 * su identificador "$ITabla"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/pro_terminos.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdTabla'])) {
        // Obtener parámetro IdTabla
        $parametro = $_GET['IdTabla'];  // Este esel Id del Tipo Act Procesal

        // Tratar retorno
        $retorno = PRO_TERMINOS::getByIdTAP($parametro);

        if ($retorno) {
            $pro_terminos["estado"] = "1";
            $pro_terminos["pro_terminos"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($pro_terminos);
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
	elseif(isset($_GET['insert']) )
    {
        //Obtener Parametros
        $par1 = $_GET['IdTAP'];        
        $par2 = $_GET['Datos'];

        $retorno = PRO_TERMINOS::insert($par1, $par2);
        $msj = $retorno;
        if($retorno)
        {
            $pro_terminos["estado"] = "1";
            $pro_terminos["pro_terminos"] = $retorno;
             // Enviar objeto json de la PRO_TERMINOS
            header('Content-Type: application/json');
            echo json_encode($pro_terminos);
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
	
	elseif (isset($_GET['ExisteTabla']) )
    {
        $par1 = $_GET['Dias'];
        $par2 = $_GET['Notifica'];
        $par3 = $_GET['Periodo'];
        $par4 = $_GET['Repite'];
        $par5 = $_GET['DiasRep'];        
		$par6 = $_GET['idtabla'];        
        $retorno = PRO_TERMINOS::existetabla($par1,$par3,$par4,$par5,$par6,$par7);
        if ($retorno) 
        {
            $pro_terminos["estado"] = "1";
            $pro_terminos["pro_terminos"] = $retorno;
            // Enviar objeto json de PRO_TERMINOS
            header('Content-Type: application/json');
            echo json_encode($pro_terminos);
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

        $retorno = PRO_TERMINOS::delete($par0);
        if ($retorno) 
        {
            $pro_terminos["estado"] = "1";
            $pro_terminos["pro_terminos"] = $retorno;
            // Enviar objeto json de la PRO_TERMINOS
            header('Content-Type: application/json');
            echo json_encode($pro_terminos);
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
}

?>