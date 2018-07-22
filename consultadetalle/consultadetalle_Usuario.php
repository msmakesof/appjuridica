<?php
/**
 * Obtiene el detalle de un usuario especificado por
 * su identificador "$IdUsuario"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/usu_usuario.php';
$msj="";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdUsuario'])) {

        // Obtener parámetro IdUsuario
        $parametro = $_GET['IdUsuario'];

        // Tratar retorno
        $retorno = USU_USUARIO::getById($parametro);

        if ($retorno) {
            $usu_usuario["estado"] = "1";
            $usu_usuario["usu_usuario"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($usu_usuario);
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
        $retorno = USU_USUARIO::getByIdEstado($parametro);

        if ($retorno) 
        {
            $usu_usuario["estado"] = "1";
            $usu_usuario["usu_usuario"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($usu_usuario);
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

        // Tratar retorno
        $retorno = USU_USUARIO::getAll($parametro);

        if ($retorno) 
        {
            $usu_usuario["estado"] = "1";
            $usu_usuario["usu_usuario"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($usu_usuario);
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
        $par3  = $_GET['PrimerApellido'];
        $par4  = $_GET['SegundoApellido'];
        $par5  = $_GET['Nombre'];
        $par6  = $_GET['Email']; 

        $retorno = USU_USUARIO::existeusuario($par2,$par3,$par4,$par5,$par6);
        if ($retorno) 
        {
            $usu_usuario["estado"] = "1";
            $usu_usuario["usu_usuario"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($usu_usuario);
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
        $par1  = $_GET['TipoDocumento'];
        $par2  = $_GET['Identificacion'];        
        $par3  = $_GET['PrimerApellido'];
        $par4  = $_GET['SegundoApellido'];
        $par5  = $_GET['Nombre'];
        $par6  = $_GET['Email'];        
        $par7  = $_GET['Direccion'];
        $par8  = $_GET['Celular'];
        $par9  = $_GET['Usuario'];
        $par10 = $_GET['Clave'];
        $par11 = $_GET['TipoUsuario'];
        $par12 = $_GET['Estado'];        
        $par13 = $_GET['IdInterno'];
        $par14 = $_GET['Local'];
        
        $retorno = USU_USUARIO::insert($par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14);        
        $msj =$retorno;
        if ($retorno) 
        {
            $usu_usuario["estado"] = "1";
            $usu_usuario["usu_usuario"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($usu_usuario);
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
        $par5  = $_GET['nombre'];
        $par6  = $_GET['email'];
        $par7  = $_GET['direccion'];        
        $par8  = $_GET['celular'];  
        $par9  = $_GET['email']; // usu
        $par10 = $_GET['clave'];
        $par11 = $_GET['tipousuario'];
        $par12 = $_GET['estado'];
        $par0  = $_GET['idtabla'];    

        $retorno = USU_USUARIO::update($par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par0);
        $msj =$retorno;
        if ($retorno) 
        {
            $usu_usuario["estado"] = "1";
            $usu_usuario["usu_usuario"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($usu_usuario);
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


    elseif (isset($_GET['idU']) && isset($_GET['idC'])) {
        // Obtener parámetro idUsuario y idClave de usu_usuario
        $parametro = $_GET['idU'];
        $parametroC = $_GET['idC'];

        // Tratar retorno
        $retorno = USU_USUARIO::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $usu_usuario["estado"] = "1";
            $usu_usuario["usu_usuario"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($usu_usuario);
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