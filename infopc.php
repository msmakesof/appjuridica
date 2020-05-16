<?php
//get_current_user();
echo "*******************************************************************<br/>";
echo "*    Nombre Servidor..........".$_SERVER['SERVER_NAME']."<br/>"; //Imprime el nombre del servidor
$username = get_current_user();
echo "*    Usuario logueado.........$username<br>";
echo "*    Nombre del Equipo......". gethostname()."<br/>";
$serial = shell_exec('wmic path win32_diskdrive where deviceid="\\\\\\\\.\\\\PHYSICALDRIVE0" get serialnumber');
echo "*    Serial HD......................$serial<br>";
$d = explode('DHCPv6. . . . . . . . . .',shell_exec ("ipconfig/all"));  
$d1 = explode(':',$d[1]);  
$d2 = explode(' ',$d1[1]);  
echo "*    MAC Address...............$d2[1]<br>";
echo "*******************************************************************<br/>";

echo "***************"; 
$password="Vialibre90$";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
var_dump($hashed_password);
echo "<br>";
echo "****************";


echo 'SHA-512:      ' . crypt($serial, '$6$rounds=5000$usesomesillystringforsalt$') . "<br/>";

$username = get_current_user();
echo "Usuario logueado...$username<br>";
echo "Remote Address...".$_SERVER['REMOTE_ADDR']."<br/>";
echo "ip Server...".$_SERVER['SERVER_ADDR']."<br/>"; //Imprime la IP del servidor
echo "server name...".$_SERVER['SERVER_NAME']."<br/>"; //Imprime el nombre del servidor
echo "software server...".$_SERVER['SERVER_SOFTWARE']."<br/>"; //Imprime el software que usa el servidor
echo "protocolo...".$_SERVER['SERVER_PROTOCOL']."<br/>"; //Imprime el protocolo usado
echo "metodo peticion...".$_SERVER['REQUEST_METHOD']."<br/>"; //Imprime el método de petición empleado
echo "tiempo respuesta...".$_SERVER['REQUEST_TIME']."<br/>";  //Imprime el tiempo de respuesta
echo "SO y browser...".$_SERVER['HTTP_USER_AGENT']."<br/>"; /*Imprime la información de S.O y navegador del cliente*/
echo "ip Cliente...".$_SERVER["REMOTE_ADDR"]."<br/>";  //Imprime la dirección IP del cliente
/*Imprime puerto empleado por la máquina del usuario para comunicarse con el servidor web. */
echo "puerto...".$_SERVER["REMOTE_PORT"]."<br/>";
echo "hostName...". gethostname()."<br/>";
echo "hostbyName...".gethostbyaddr($_SERVER['REMOTE_ADDR'])."<br/>";

$serial = shell_exec('wmic path win32_diskdrive where deviceid="\\\\\\\\.\\\\PHYSICALDRIVE0" get serialnumber');
echo "serial HD....$serial<br>";

function getRealIP(){

	if (isset($_SERVER["HTTP_CLIENT_IP"])){

		echo $_SERVER["HTTP_CLIENT_IP"]."<br/>";

	}elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

		echo $_SERVER["HTTP_X_FORWARDED_FOR"]."<br/>";

	}elseif (isset($_SERVER["HTTP_X_FORWARDED"])){

		echo $_SERVER["HTTP_X_FORWARDED"]."<br/>";

	}elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){

		echo $_SERVER["HTTP_FORWARDED_FOR"]."<br/>";

	}elseif (isset($_SERVER["HTTP_FORWARDED"])){

		echo $_SERVER["HTTP_FORWARDED"]."<br/>";

	}else{
		echo $_SERVER["REMOTE_ADDR"]."<br/>";
	}
}     

getRealIP();

header('Content-Type: text/html; charset=UTF-8');
$ipServer = $_SERVER['SERVER_ADDR'];
$ipAddress=$_SERVER['REMOTE_ADDR'];

//echo "ipServer.......... $ipServer<br>";
//echo "ipAddress........ $ipAddress<br>";

$ipconfig =   shell_exec ("ipconfig/all");  
 // display those informations   
$info = utf8_encode($ipconfig);
$info = htmlspecialchars($info) ;
/*  
  look for the value of "physical adress"  and use substr() function to 
  retrieve the adress from this long string.
  here in my case i'm using a french cmd.
  you can change the numbers according adress mac position in the string.
*/

$info2 = substr(shell_exec ("ipconfig/all"),1821,18); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Config IP</title> 
</head>
<body>
<?php echo $info. "<br>"; ?>
<?php echo "<br>****************************<br>"; ?>
<?php echo $info2. "<br>"; ?>

<?php
$mac='UNKNOWN';
foreach(explode("\n",str_replace(' ','',trim(`getmac`,"\n"))) as $i)
if(strpos($i,'Tcpip')>-1){$mac=substr($i,0,17);break;}
echo $mac;

echo "<br>****************************<br>";
ob_start();  

//Get the ipconfig details using system commond  
system('ipconfig /all');  

// Capture the output into a variable  
$mycomsys=ob_get_contents();  

// Clean (erase) the output buffer  
ob_clean();  

$find_mac = "Physical"; 
//find the "Physical" & Find the position of Physical text  

$pmac = strpos($mycomsys, $find_mac);  
// Get Physical Address  

$macaddress=substr($mycomsys,($pmac+36),17);  
//Display Mac Address  

echo $macaddress;  
echo "<br>****************************<br>";
$d = explode('DHCPv6. . . . . . . . . .',shell_exec ("ipconfig/all"));  
$d1 = explode(':',$d[1]);  
$d2 = explode(' ',$d1[1]);  
echo $d2[1];
?>