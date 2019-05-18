<?php
include('../Connections/cnn_kn.php');
try
{
    $bdd = new PDO("mysql:host=$hostname_cnn_kn;dbname=$database_cnn_kn;charset=utf8", "$username_cnn_kn", "$password_cnn_kn");
}
catch(Exception $e)
{
    die('Error : '.$e->getMessage());
}
