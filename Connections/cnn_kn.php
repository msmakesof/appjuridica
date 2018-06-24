<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cnn_kn = "localhost";
$database_cnn_kn = "appjudicial";
$username_cnn_kn = "root";
$password_cnn_kn = "";
$cnn_kn = mysqli_connect($hostname_cnn_kn, $username_cnn_kn, $password_cnn_kn) or trigger_error(mysqli_error(),E_USER_ERROR);
mysqli_set_charset($cnn_kn,"utf8");
?>
