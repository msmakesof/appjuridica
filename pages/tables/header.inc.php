<?php
//ob_start();
session_start();  
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if( !isset($_SESSION['IdUsuario']) && !isset($_SESSION['NombreUsuario']) )
{
	header("Location: ../index.php");
    exit;
}
?>