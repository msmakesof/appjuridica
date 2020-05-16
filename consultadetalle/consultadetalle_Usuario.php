<?php
/**
 * Obtiene el detalle de un usuario especificado por
 * su identificador "$IdUsuario"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/usu_usuario.php';
$msj="";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    
    if (isset($_GET['IdMostrar'])) {
        // Obtener parámetro IdMostrar de usu_usuario
        $parametro = $_GET['IdMostrar'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = USU_USUARIO::getAll($parametro);
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
                    'mensaje' => 'Todos -No se obtuvo el registro',
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    
    }
    elseif (isset($_GET['xParIdUsuario'])) {

        // Obtener parámetro IdUsuario
        $parametro = $_GET['xParIdUsuario'];

        // Tratar retorno
        //$retorno = USU_USUARIO::getById($parametro);
        $retorno = USU_USUARIO::getById($parametro);
        $msj =$retorno;
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
                    'mensaje' => 'Por Id: No se obtuvo el registro',
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    }
	elseif (isset($_GET['EsAbogado'])) {

        // Obtener parámetro EsAbogado
        $parametro = $_GET['EsAbogado'];

        // Tratar retorno
        $retorno = USU_USUARIO::getByIdAbogado($parametro);
        $msj =$retorno;
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
                    'mensaje' => 'Por Id Abogdo. No se obtuvo el registro',
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    }
    elseif (isset($_GET['idEstado'])) {
        // Obtener parámetro idEstado de usu_usuario
        $parametro = $_GET['idEstado'];

        // Tratar retorno
        $retorno = USU_USUARIO::getByIdEstado($parametro);
        $msj =$retorno;
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
                    'mensaje' => 'Por Estado- No se obtuvo el registro',
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    }     
	elseif (isset($_GET['IdMostrarSU'])) {
        // Obtener parámetro IdMostrar de usu_usuario solo los Super Administradores
        $parametro = $_GET['IdMostrarSU'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = USU_USUARIO::getAllSU($parametro);
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
                    'mensaje' => ' Todos SU - No se obtuvo el registro',
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    
    }
    elseif (isset($_GET['IdAbogados'])) {
        // Obtener parámetro IdMostrar de usu_usuario
        $parametro = $_GET['IdAbogados'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = USU_USUARIO::usuarioresponsable($parametro);
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
                    'mensaje' => 'Responsable: No se obtuvo el registro',
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }    
    }
    elseif (isset($_GET['BuscaUsuario']) )
    {
        //$par1  = $_GET['empresa'];
        $par1  = $_GET['Identificacion'];        
        $par5  = $_GET['IdUsuario'];
        /*
        $par2  = $_GET['PrimerApellido'];
        $par3  = $_GET['SegundoApellido'];
        $par4  = $_GET['Nombre'];
        
        // ,$par2,$par3,$par4,$par5		
        */
        
        $retorno = USU_USUARIO::buscausuario($par1, $par5);
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
                    'mensaje' => 'BuscaUsuario: No se obtuvo el registro.  '.$msj,
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    }
	elseif (isset($_GET['ExisteUsuarioSU']) )
    {
        $par1  = $_GET['empresa'];
		$par2  = $_GET['Identificacion'];        
        $par3  = $_GET['PrimerApellido'];
        $par4  = $_GET['SegundoApellido'];
        $par5  = $_GET['Nombre'];
        $par6  = $_GET['Email']; 
        $msj =$retorno;
        $retorno = USU_USUARIO::existeusuarioSU($par1,$par2,$par3,$par4,$par5,$par6);
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
                    'mensaje' => 'existeusuarioSU: No se obtuvo el registro',
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    }

    elseif(isset($_GET['insert']) )
    {
        // Obtener parámetros 
		$par0  = $_GET['Empresa'];
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
		$par15 = $_GET['Abogado'];
		$par16 = $_GET['TP'];
        
        $retorno = USU_USUARIO::insert($par0,$par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par15,$par16);
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
                    'mensaje' => 'Insert - No se obtuvo el registro'
                )
            );
        }
    }
	
	elseif(isset($_GET['crearSU']) )
    {
        // Obtener parámetros 
		$par0  = $_GET['Empresa'];
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
		$par15 = $_GET['Abogado'];
		$par16 = $_GET['SuperAdmin'];
        
        $retorno = USU_USUARIO::crearSU($par0,$par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par15,$par16);        
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
                    'mensaje' => 'Crear SU -No se obtuvo el registro'
                )
            );
        }
    }
    
    elseif(isset($_GET['update']) )
    {
        // Obtener parámetros
		$par14 = $_GET['empresa'];
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
		$par13 = $_GET['abogado'];
        $par14 = $_GET['tp'];
		$par0  = $_GET['idtabla'];		

        $retorno = USU_USUARIO::update($par14,$par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par0);
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
                    'mensaje' => 'Update - No se obtuvo el registro'
                )
            );
        }
    }
	
	elseif(isset($_GET['updateSU']) )
    {
        // Obtener parámetros
		$par14 = $_GET['empresa'];
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
		$par13 = $_GET['abogado'];        
		$par0  = $_GET['idtabla'];		

        $retorno = USU_USUARIO::updateSU($par14,$par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par0);
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
                    'mensaje' => 'Update SU - No se obtuvo el registro'
                )
            );
        }
    }

    elseif(isset($_GET['updatepass']) )
    {
        // Obtener parámetros
        $par1  = $_GET['clave'];
        $par0 = $_GET['mail'];

        $retorno = USU_USUARIO::updatepass($par1, $par0);
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
                    'mensaje' => 'Update - No se obtuvo el registro'
                )
            );
        }
    }

    elseif(isset($_GET['delete']) )
    {
        $par0  = $_GET['pidtabla'];

        $retorno = USU_USUARIO::delete($par0);
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
                    'mensaje' => 'Del - No se obtuvo el registro'
                )
            );
        }
    }

    elseif (isset($_GET['idU']) && isset($_GET['idC'])) 
    {
        // Obtener parámetro idUsuario y idClave de usu_usuario
        $parametro = trim($_GET['idU']);
        $parametroC = trim($_GET['idC']);

        // Tratar retorno
        $retorno = USU_USUARIO::getByIdExiste($parametro,$parametroC);
        $msj = $retorno;
        if ($retorno) {
            $usu_usuario["estado"] = "1";
            $usu_usuario["usu_usuario"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($usu_usuario, JSON_PRETTY_PRINT);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'Existe Usu y Cla - No se obtuvo el registro',
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    }
	elseif (isset($_GET['IdLocal'])) {

        // Obtener parámetro IdUsuario
        $parametro = $_GET['IdLocal'];

        // Tratar retorno
        $retorno = USU_USUARIO::getIdLocal($parametro);

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
                    'mensaje' => 'Id Local - No se obtuvo el registro'
                )
            );
        }
    }

    elseif (isset($_GET['BuscaIden']) )
    {       
        $par1  = $_GET['Identificacion'];
        $par2  = $_GET['IdTabla'];

        $retorno = USU_USUARIO::buscaiden($par1,$par2);
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
                    'mensaje' => 'BuscaIden: No se obtuvo el registro.  '.$msj,
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    }
    elseif (isset($_GET['BuscaNombre']) )
    {       
        $par1  = $_GET['Nom'];
        $par2  = $_GET['Ape1'];
        $par3  = $_GET['Ape2'];
        $par4  = $_GET['Iden'];

        $retorno = USU_USUARIO::buscanom($par1,$par2,$par3,$par4);
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
                    'mensaje' => 'BuscaNombre: No se obtuvo el registro.  '.$msj,
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
                )
            );
        }
    }
    elseif (isset($_GET['BuscaEmail']) )
    {       
        $par1  = $_GET['Email'];        

        $retorno = USU_USUARIO::buscaemail($par1);
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
                    'mensaje' => 'BuscaNombre: No se obtuvo el registro.  '.$msj,
                    'msj' => print_r($msj),
                    'msj2' => var_dump ($msj)
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