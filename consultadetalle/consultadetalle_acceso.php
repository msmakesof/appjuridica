<?php
/**
 * Obtiene el detalle de un usuario especificado por
 * su identificador "$IdUsuario"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/acceso.php';
$msj="";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(isset($_GET['insert']) )
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
        
        $retorno = USU_USUARIO::insert($par0,$par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par15);        
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