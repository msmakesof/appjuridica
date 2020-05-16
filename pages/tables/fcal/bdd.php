<?php
try
{
	include('../../../Connections/DataConex.php');
	$bdd = new PDO("mysql:host=$hostname_cnn_kn;dbname=$database_cnn_kn;charset=utf8", "$username_cnn_kn", "$password_cnn_kn");
	
	//$bdd = new PDO('mysql:host=localhost;dbname=calendar;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Error : '.$e->getMessage());
}
