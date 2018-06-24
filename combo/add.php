<?php

include "db.php";

if(isset($_GET["opt"]) && $_GET["opt"]=="country"){
	$con = connect();
	$con->query("insert into country(name) value (\"$_POST[name]\")");
	setcookie("countryadd",1);
	header("Location: new.php");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="state"){
	$con = connect();
	$con->query("insert into state(name,country_id) value (\"$_POST[name]\",$_POST[country_id])");
	setcookie("stateadd",1);
	header("Location: new.php");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="city"){
	$con = connect();
	$con->query("insert into city(name,state_id) value (\"$_POST[name]\",$_POST[state_id])");
	setcookie("cityadd",1);
	header("Location: new.php");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="all"){
	$con = connect();
	$con->query("insert into combo(country_id,state_id,city_id) value ($_POST[country_id],$_POST[state_id],$_POST[city_id])");
	setcookie("comboadd",1);
	header("Location: index.php");
}
?>