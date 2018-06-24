<?php

 $inicio = "04 junio 2017";
 echo "$inicio<br>";
// echo gettype($inicio), "\n";
 //trim($_POST['from']);
        //$fechaini =$inicio;
        // y la formateamos con la funcion _formatear

         $fec1 = explode(" ", $inicio);
         print_r ($fec1);
         $di = $fec1[0];
         $mi = $fec1[1];
         $yi = $fec1[2];
         echo $mi."<br>";
         switch ($mi) 
         {
         	case 'enero':
         		$mm = "01";
         		break;
         	
         	case 'febrero':
         		$mm = "02";
         		break;

			case 'marzo':
         		$mm = "03";
         		break;

         	case 'abril':
         		$mm = "04";
         		break;

         	case 'mayo':
         		$mm = "05";         		
         		break;

         	case 'junio':
         		$mm = "06";
         		break;

         	case 'julio':
         		$mm = "07";
         		break;

         	case 'agosto':
         		$mm = "08";         		
         		break;

         	case 'septiembre':
         		$mm = "09";
         		break;

         	case 'octubre':
         		$mm = "10";
         		break;

         	case 'noviembre':
         		$mm = "11";
         		break;

         	case 'diciembre':
         		$mm = "12";
         		break;
         }

         $fi = $yi.'-'.$mm.'-'.$di; 
         echo "<br>";
 //echo strtotime($inicio)."<br>";
 //       $fi= date_format($inicio, 'Y/m/d' );
          $fi= date('Y-m-d', strtotime($fi));
		  echo "fi....$fi";
		  //echo "<br>";
          //echo strtotime($fi);
?>