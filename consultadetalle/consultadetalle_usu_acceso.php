<?php
/**
 * Obtiene el detalle de un usuario especificado por
 * su identificador "$IdUsuario"
 */
header('Access-Control-Allow-Origin: *');
require '../estructura/usu_acceso.php';
$msj="";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['insert']) )
    {
        // Obtener parámetros 
		$par0  = $_GET['IdUsuario'];        
        $par1  = $_GET['IpInterna'];
        $par2  = $_GET['FechaAcceso'];
        $par3  = $_GET['NombreHost'];
        $par4  = $_GET['Puerto'];
        $par5  = $_GET['Servidor'];        
        $par6  = $_GET['Agente'];
        $par7  = $_GET['IpExterna'];
        $par8  = $_GET['hostname'];
        $par9  = $_GET['region'];
        $par10  = $_GET['pais'];
        $par11  = $_GET['latitud'];
        $par12  = $_GET['longitud'];
        $par13  = $_GET['organizacion'];
        $par14  = $_GET['codigopostal'];
        /*    */
        $retorno = USU_ACCESO::insert($par0, $par1, $par2, $par3, $par4, $par5, $par6, $par7, $par8, $par9, $par10, $par11, $par12, $par13, $par14 );
        $msj =$retorno;
        if ($retorno) 
        {
            $usu_acceso["estado"] = "1";
            $usu_acceso["usu_acceso"] = $retorno;
            // Enviar objeto json de la usu_acceso
            header('Content-Type: application/json');
            echo json_encode($usu_acceso);
        } 
        else 
        {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '22',
                    'mensaje' => 'No se obtuvo el registro.',
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