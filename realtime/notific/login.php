<?php
	/* 
		Simula una sesi�n de usuario seg�n el GET['u']
		Ej: http://localhost/jack_notifications/login.php?u=1
	*/
	@session_start();
	$_SESSION['user_id'] = $_GET['u'];