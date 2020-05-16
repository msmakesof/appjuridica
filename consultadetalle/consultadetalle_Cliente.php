<?php
/**
 * Obtiene el detalle de un usuario especificado por
 * su identificador "$CLI_IdCliente"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/cli_cliente.php';
$msj="";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['IdUsuario'])) {

        // Obtener parámetro IdUsuario
        $parametro = $_GET['IdUsuario'];
		//$p2 = $_GET['p2'];
		//$p3 = $_GET['p3'];

        // Tratar retorno
        $retorno = CLI_CLIENTE::getById($parametro);

        if ($retorno) {
            $cli_cliente["estado"] = "1";
            $cli_cliente["cli_cliente"] = $retorno;
            // Enviar objeto json de la meta
            header('Content-Type: application/json');
            echo json_encode($cli_cliente);
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
        $retorno = CLI_CLIENTE::getByIdEstado($parametro);

        if ($retorno) 
        {
            $cli_cliente["estado"] = "1";
            $cli_cliente["cli_cliente"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($cli_cliente);
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
		$p2 = $_GET['p2'];  // Tipo Uusario 2. Abogado, 1. Admin
		
		$p3 = $_GET['p3'];  // $_SESSION['TipoUsuario'] == 2 --> IdUsuario, / $_SESSION['TipoUsuario'] == 1  (Admin)--> IdEmpresa
		
		$p4 = $_GET['p4'];  // Tipo Cliente  ==> 1.Demandante    2.Demandado
		
        // Tratar retorno
        $retorno = CLI_CLIENTE::getAll($parametro, $p2, $p3, $p4);

        if ($retorno) 
        {
            $cli_cliente["estado"] = "1";
            $cli_cliente["cli_cliente"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($cli_cliente);			
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
    elseif (isset($_GET['IdAbogados'])) {
        // Obtener parámetro IdMostrar de usu_usuario
        $parametro = $_GET['IdAbogados'];
        if($parametro == 0)
        {
            $parametro == "";
        }

        // Tratar retorno
        $retorno = CLI_CLIENTE::usuarioresponsable($parametro);

        if ($retorno) 
        {
            $cli_cliente["estado"] = "1";
            $cli_cliente["cli_cliente"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($cli_cliente);
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
    elseif (isset($_GET['ExisteUsuario']) )
    {
        $par2  = $_GET['Identificacion'];        
        $par3  = $_GET['PrimerApellido'];
        $par4  = $_GET['SegundoApellido'];
        $par5  = $_GET['Nombre'];
        //$par6  = $_GET['Email']; ,$par6
		$par7  = $_GET['TipoCliente'];
		$par8  = $_GET['IdCliente'];
		

        $retorno = CLI_CLIENTE::existeusuario($par2,$par7,$par3,$par4,$par5,$par8);
		$msj =$retorno;
        if ($retorno) 
        {
            $cli_cliente["estado"] = "1";
            $cli_cliente["cli_cliente"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($cli_cliente);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro',
					'msj' => print_r($msj),
					'msj2' => var_dump ($msj)
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
        $par11 = $_GET['TipoCliente'];
        $par12 = $_GET['Estado'];        
        $par13 = $_GET['IdInterno'];
        $par14 = $_GET['Local'];
		$par15 = $_GET['Verseguimiento'];
		$par16 = $_GET['Empresa'];
		$par17 = $_GET['UsuarioCrea'];
		
		$par18 = $_GET['TipoDocumentorl'];
		$par19 = $_GET['Identificacionrl'];
		$par20 = $_GET['Nombrerl'];
		$par21 = $_GET['Apellido1rl'];
		$par22 = $_GET['Emailrl'];
		$par23 = $_GET['Celularrl'];
		$par24 = $_GET['TipoDocumentorl2'];
		$par25 = $_GET['Identificacionrl2'];
		$par26 = $_GET['Nombrerl2'];
		$par27 = $_GET['Apellidosrl2'];
		$par28 = $_GET['Emailrl2'];
		$par29 = $_GET['Celularrl2'];
		$par30 = $_GET['CasaApto'];
		$par31 = $_GET['TipoInmueble'];
        
        $retorno = CLI_CLIENTE::insert($par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par15,$par16,$par17,$par18,$par19,$par20,$par21,$par22,$par23,$par24,$par25,$par26,$par27,$par28,$par29,$par30,$par31);
        $msj =$retorno;
        if ($retorno) 
        {
            $cli_cliente["estado"] = "1";
            $cli_cliente["cli_cliente"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($cli_cliente);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro',
					'msj' => print_r($msj),
					'msj2' => var_dump ($msj)
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
        $par11 = $_GET['tipocliente'];
        $par12 = $_GET['estado'];
		$par13 = $_GET['verseguimiento'];
		$par14 = $_GET['empresa'];
		$par15 = $_GET['usuariomodifica'];
		
		$par18 = $_GET['tipodocumentorl'];
		$par19 = $_GET['identificacionrl'];
		$par20 = $_GET['nombrerl'];
		$par21 = $_GET['apellido1rl'];
		$par22 = $_GET['emailrl'];
		$par23 = $_GET['celularrl'];
		$par24 = $_GET['tipodocumentorl2'];
		$par25 = $_GET['identificacionrl2'];
		$par26 = $_GET['nombrerl2'];
		$par27 = $_GET['apellidosrl2'];
		$par28 = $_GET['emailrl2'];
		$par29 = $_GET['celularrl2'];
		$par30 = $_GET['casaapto'];
		$par31 = $_GET['tipoinmueble'];
		
        $par0  = $_GET['idtabla'];    

        $retorno = CLI_CLIENTE::update($par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par15,$par18,$par19,$par20,$par21,$par22,$par23,$par24,$par25,$par26,$par27,$par28,$par29,$par30,$par31,$par0);
        $msj =$retorno;
        if ($retorno) 
        {
            $cli_cliente["estado"] = "1";
            $cli_cliente["cli_cliente"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($cli_cliente);			
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro',
					'msj' => print_r($msj),
					'msj2' => var_dump ($msj)
                )
            );
        }
    }

    elseif(isset($_GET['delete']) )
    {
        $par0  = $_GET['pidtabla'];

        $retorno = CLI_CLIENTE::delete($par0);
        if ($retorno) 
        {
            $cli_cliente["estado"] = "1";
            $cli_cliente["cli_cliente"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($cli_cliente);
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
        $parametro = trim($_GET['idU']);
        $parametroC = trim($_GET['idC']);

        // Tratar retorno
        $retorno = CLI_CLIENTE::getByIdExiste($parametro,$parametroC);

        if ($retorno) {
            $cli_cliente["estado"] = "1";
            $cli_cliente["cli_cliente"] = $retorno;
            // Enviar objeto json de la usu_usuario
            header('Content-Type: application/json');
            echo json_encode($cli_cliente);
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