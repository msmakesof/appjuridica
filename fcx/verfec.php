<?php

// Definimos nuestra zona horaria
date_default_timezone_set("America/Bogota");

// incluimos el archivo de funciones
include 'funciones.php';

	// Recibimos el fecha de inicio y la fecha final desde el form
	////$Datein = date('d/m/Y H:i:s', strtotime($_POST['from']));
	////$Datefi = date('d/m/Y H:i:s', strtotime($_POST['to']));	

	//$from = "20/05/2020 16:17:20";  // 1590009420000 // 1590013020000
	//$to = "20/05/2020 17:17:20";
	
	$from = "20/05/2020 06:17:20";  // 1590009420000 // 1590013020000
	$to = "20/05/2020 07:17:20";
	
		$from = strtr($from, '/', '-');
		$to = strtr($to, '/', '-');

	$Datein = date('d/m/Y H:i:s', strtotime($from));
	$Datefi = date('d/m/Y H:i:s', strtotime($to));	
	echo "$Datein // $Datefi<br>";	
	
		
	$inicio = _formatear($Datein);
	// y la formateamos con la funcion _formatear
	$final  = _formatear($Datefi);
	// Recibimos el fecha de inicio y la fecha final desde el form
	echo " _formatear......$inicio // $final<br>";
	
	$inicio2 = _formatear($from);
	// y la formateamos con la funcion _formatear
	$final2  = _formatear($to);
	// Recibimos el fecha de inicio y la fecha final desde el form
	echo " _formatear2....$inicio2 // $final2<br>";
		

	////$orderDate = date('d/m/Y H:i:s', strtotime($_POST['from']));
	//$dt = new DateTime(strtotime($from));
	//echo "dt....".$dt->format('Y/m/d H:i:s')."<br>";
	//echo "dt....$dt<br>";
	
	$from = strtotime($from);
	$orderDate = date('Y/m/d H:i:s', $from);
	$inicio_normal = $orderDate;

	// y la formateamos con la funcion _formatear
	////$orderDate2 = date('d/m/Y H:i:s', strtotime($_POST['to']));
	$orderDate2 = $to; //date('Y/m/d H:i:s', strtotime($to));
	$final_normal  = $orderDate2;
	echo " Normal...$inicio_normal // $final_normal<br>";
	
?>	