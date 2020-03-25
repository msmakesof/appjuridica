<?php
ob_start(); 
// Registro Auditoria
// function regAuditor()
// {
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
	//echo "id....".$_POST['user_id'];
	//echo "id....".$_GET['user_id'];
    $fecha = date_default_timezone_set('America/Bogota'); //configuro un nuevo timezone
    //echo 'TimeZonePHP configurado: ', date_default_timezone_get();
    //echo "<br>";
    //echo date('Y-m-d H:i:s')."<br>";
    $fecha = date('Y-m-d'); 

    $nombre_archivo = "logs_$fecha.txt"; 
    
    if(file_exists($nombre_archivo))
    {
        //$mensaje = "$existe<br>$cookie_value" ;
		$mensaje = "$existe<br>" ;
    }

    else
    {
        //$mensaje = "$existe<br>$cookie_value ";
		$mensaje = "$existe<br>" ;
    }

    if($archivo = fopen($nombre_archivo, "a"))
    {
        if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje."\r\n"))
        {
            //echo "Se ha ejecutado correctamente. ";
        }
        else
        {
            //echo "Ha habido un problema al crear el archivo. ";
        }

        fclose($archivo);
    }
// }   
// return;

// function get_file($file, $local_path, $newfilename) 
// { 
//     $err_msg = ''; 
//     echo "Attempting message download for $file"; 
//     $out = fopen($local_path.$newfilename,"wb"); 
//     if ($out == FALSE)
//     { 
//         print "File not opened"; exit; 
//     } 
//     $ch = curl_init(); 
//     curl_setopt($ch, CURLOPT_FILE, $out); 
//     curl_setopt($ch, CURLOPT_HEADER, 0); 
//     curl_setopt($ch, CURLOPT_URL, $file); 
//     curl_exec($ch); 
//     echo "Error is : ".curl_error ( $ch); 
//     curl_close($ch); //fclose($handle); 
// }  //end function 
 ob_end_flush();
?>