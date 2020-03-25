<?php
ob_start();
if(!isset($_SESSION)) 
{ 
   session_start(); 
}
//$var2 = $_COOKIE['_gus'] ;
//if($var2 == null || $var2 == "")
if( $var2 == "" || is_null($var2) )  // Si el hosting no permite trabajar con cookies
{
    $var2 = $_SESSION["user_id"];
}
//echo '<script type="text/javascript">';
//echo 'alert('.$var2.')';
//echo '</script>';
//if( !isset($var2) || $var2 != "" || !is_null($var2) )
//{
?>	
<?php
//}
//header("location: ../header/");
$url ="../header/";
if (!headers_sent())
{    
    header('Location: '.$url);
    exit;
}
else
{  
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$url.'";';
	echo '</script>';
	echo '<noscript>';
	echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
	echo '</noscript>'; 
	exit;
}
ob_end_flush();
?>