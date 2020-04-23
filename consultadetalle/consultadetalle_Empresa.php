<?php
/**
 * Obtiene el detalle de un usuario especificado por
 * su identificador "$IdUsuario"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/emp_empresa.php';
$msj="";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdUsuario'])) {

        // Obtener parámetro IdUsuario
        $parametro = $_GET['IdUsuario'];

        // Tratar retorno
        $retorno = EMP_EMPRESA::getById($parametro);

        if ($retorno) {
            $emp_empresa["estado"] = "1";
            $emp_empresa["emp_empresa"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($emp_empresa);
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
    elseif (isset($_GET['idEstado'])) {
        // Obtener parámetro idEstado de emp_empresa
        $parametro = $_GET['idEstado'];

        // Tratar retorno
        $retorno = EMP_EMPRESA::getByIdEstado($parametro);

        if ($retorno) 
        {
            $emp_empresa["estado"] = "1";
            $emp_empresa["emp_empresa"] = $retorno;
            // Enviar objeto json de la emp_empresa
            header('Content-Type: application/json');
            echo json_encode($emp_empresa);
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
    elseif (isset($_GET['IdMostrar'])) {
        // Obtener parámetro IdMostrar de emp_empresa
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = EMP_EMPRESA::getAll($parametro);

        if ($retorno) 
        {
            $emp_empresa["estado"] = "1";
            $emp_empresa["emp_empresa"] = $retorno;
            // Enviar objeto json de la emp_empresa
            header('Content-Type: application/json');
            echo json_encode($emp_empresa);
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

    elseif(isset($_GET['ExisteUsuario']) )
    {
        $par2  = $_GET['Identificacion'];        
        $par3  = $_GET['Nombre'];
        $par4  = $_GET['Email']; 
		$par5  = $_GET['Ciudad']; 
		$par6  = $_GET['IdEmpresa']; 

        $retorno = EMP_EMPRESA::existeusuario($par2,$par3,$par4,$par5,$par6);
        if ($retorno) 
        {
            $emp_empresa["estado"] = "1";
            $emp_empresa["emp_empresa"] = $retorno;
            // Enviar objeto json de la emp_empresa
            header('Content-Type: application/json');
            echo json_encode($emp_empresa);
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
        date_default_timezone_set('America/Bogota');
		$time = time();
		$fechacrea = date("Y-m-d H:i:s", $time);
		// Obtener parámetros        
        $par1  = $_GET['TipoDocumento'];
        $par2  = $_GET['Identificacion'];        
        $par3  = $_GET['Nombre'];
        $par4  = $_GET['Email'];        
        $par5  = $_GET['Direccion'];
        $par6  = $_GET['Celular'];
		$par7  = $_GET['Fijo'];
        $par8  = $_GET['Sitioweb'];        
        $par9  = $_GET['Estado'];        
        $par10 = $_GET['IdInterno'];
        $par11 = $_GET['Local'];
		$par12 = $_GET['TipoCliente'];
		$par13 = $_GET['Ciudad'];		
		$par14 = $fechacrea ;
		$par15  = $_GET['Nombre2'];
		$par16  = $_GET['Apellido1'];
		$par17  = $_GET['Apellido2'];
        
        $retorno = EMP_EMPRESA::insert($par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par15,$par16,$par17);
        $msj =$retorno;
        if ($retorno) 
        {
            $emp_empresa["estado"] = "1";
            $emp_empresa["emp_empresa"] = $retorno;
            // Enviar objeto json de la emp_empresa
            header('Content-Type: application/json');
            echo json_encode($emp_empresa);
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
        // Obtener parámetros               
        $par1  = $_GET['TipoDocumento'];
        $par2  = $_GET['Identificacion'];        
        $par3  = $_GET['Nombre'];
        $par4  = $_GET['Email'];        
        $par5  = $_GET['Direccion'];
        $par6  = $_GET['Celular'];
		$par7  = $_GET['Fijo'];
        $par8  = $_GET['Sitioweb'];        
        $par9  = $_GET['Estado'];       
		$par10 = $_GET['TipoCliente'];
		$par11 = $_GET['Ciudad'];
		$par12  = $_GET['Nombre2'];
		$par13  = $_GET['Apellido1'];
		$par14  = $_GET['Apellido2'];
		$par0  = $_GET['IdEmpresa'];
		
        $retorno = EMP_EMPRESA::update($par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par0);
        $msj =$retorno;
        if ($retorno) 
        {
            $emp_empresa["estado"] = "1";
            $emp_empresa["emp_empresa"] = $retorno;
            // Enviar objeto json de la emp_empresa
            header('Content-Type: application/json');
            echo json_encode($emp_empresa);
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

        $retorno = EMP_EMPRESA::delete($par0);
        if ($retorno) 
        {
            $emp_empresa["estado"] = "1";
            $emp_empresa["emp_empresa"] = $retorno;
            // Enviar objeto json de la emp_empresa
            header('Content-Type: application/json');
            echo json_encode($emp_empresa);
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

    elseif (isset($_GET['idU']) && isset($_GET['idC'])) 
    {
        // Obtener parámetro idUsuario y idClave de emp_empresa
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = EMP_EMPRESA::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $emp_empresa["estado"] = "1";
            $emp_empresa["emp_empresa"] = $retorno;
            // Enviar objeto json de la emp_empresa
            header('Content-Type: application/json');
            echo json_encode($emp_empresa);
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
    else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador...',
                'msj' => print_r($msj),
                'msj2' => var_dump ($msj)
            )
        );
    }
}
?>