<?php
/**
 * Obtiene el detalle de un usuario especificado por
 * su identificador "$IdUsuario"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/emp_contactoempresa.php';
$msj="";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdUsuario'])) {

        // Obtener parámetro IdUsuario
        $parametro = $_GET['IdUsuario'];

        // Tratar retorno
        $retorno = EMP_CONTACTOEMPRESA::getById($parametro);

        if ($retorno) {
            $emp_contactoempresa["estado"] = "1";
            $emp_contactoempresa["emp_contactoempresa"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($emp_contactoempresa);
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
        // Obtener parámetro idEstado de usu_usuario
        $parametro = $_GET['idEstado'];

        // Tratar retorno
        $retorno = EMP_CONTACTOEMPRESA::getByIdEstado($parametro);

        if ($retorno) 
        {
            $emp_contactoempresa["estado"] = "1";
            $emp_contactoempresa["emp_contactoempresa"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($emp_contactoempresa);
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
        // Obtener parámetro IdMostrar de usu_usuario
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }
		
		$Empresa = $_GET['par2'];

        // Tratar retorno
        $retorno = EMP_CONTACTOEMPRESA::getAll($parametro, $Empresa);

        if ($retorno) 
        {
            $emp_contactoempresa["estado"] = "1";
            $emp_contactoempresa["emp_contactoempresa"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($emp_contactoempresa);
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
        $par3  = $_GET['Nombre1'];
		$par4  = $_GET['Nombre2'];		
		$par5  = $_GET['Apellido1'];
        $par6  = $_GET['Apellido2'];
        $par7  = $_GET['Email'];
		$par8  = $_GET['TipoDocumento'];

        $retorno = EMP_CONTACTOEMPRESA::existeusuario($par2,$par3,$par4,$par5,$par6,$par7,$par8);
        if ($retorno) 
        {
            $emp_contactoempresa["estado"] = "1";
            $emp_contactoempresa["emp_contactoempresa"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($emp_contactoempresa);
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
        // Obtener parámetros        
        $par0  = $_GET['IdEmpresa'];
		$par1  = $_GET['TipoDocumento'];
        $par2  = $_GET['Identificacion'];        
        $par3  = $_GET['Nombre1'];
		$par4  = $_GET['Nombre2'];
		$par5  = $_GET['Apellido1'];
        $par6  = $_GET['Apellido2'];        		
        $par7  = $_GET['Email'];        
        $par8  = $_GET['Celular'];
		$par9  = $_GET['Fijo'];                
        $par10 = $_GET['Estado'];
		$par11 = $_GET['Ciudad'];        
        $par12 = $_GET['Usuario'];
		$par13 = $_GET['FechaCreado'];
		$par14 = $_GET['IdUsuarioModifica'];
		$par15 = $_GET['FechaModifica']; 
        
        $retorno = EMP_CONTACTOEMPRESA::insert($par0,$par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par15);
        $msj =$retorno;
        if ($retorno) 
        {
            $emp_contactoempresa["estado"] = "1";
            $emp_contactoempresa["emp_contactoempresa"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($emp_contactoempresa);
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
        $par1  = $_GET['tipodocumento'];
        $par2  = $_GET['numerodocumento'];        
        $par3  = $_GET['apellido1'];
        $par4  = $_GET['apellido2'];
        $par5  = $_GET['nombre1'];
		$par6  = $_GET['nombre2'];
        $par7  = $_GET['email'];
        $par8  = $_GET['fijo'];        
        $par9  = $_GET['celular'];        
        $par10 = $_GET['ciudad'];
		$par11 = $_GET['estado'];	
		$par12 = $_GET['usuarioModifica'];
		$par0  = $_GET['idtabla'];
		
        $retorno = EMP_CONTACTOEMPRESA::update($par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par0);
        $msj =$retorno;
        if ($retorno) 
        {
            $emp_contactoempresa["estado"] = "1";
            $emp_contactoempresa["emp_contactoempresa"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($emp_contactoempresa);
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

        $retorno = EMP_CONTACTOEMPRESA::delete($par0);
        if ($retorno) 
        {
            $emp_contactoempresa["estado"] = "1";
            $emp_contactoempresa["emp_contactoempresa"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($emp_contactoempresa);
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
        // Obtener parámetro idUsuario y idClave de usu_usuario
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = EMP_CONTACTOEMPRESA::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $emp_contactoempresa["estado"] = "1";
            $emp_contactoempresa["emp_contactoempresa"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($emp_contactoempresa);
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