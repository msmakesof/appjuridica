<?php
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
</body>
</html>	