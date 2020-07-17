<?php
session_start();  
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if( !isset($_SESSION['IdUsuario']) && !isset($_SESSION['NombreUsuario']) )
{
	//session_start(); 
	session_unset();
	session_destroy();
	header("Location: ../../index.php");
    exit();
}
?>