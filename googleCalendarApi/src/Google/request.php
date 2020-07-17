<?php
// request.php (esta es la llamada de mi sitio hacia google)
$client = new Google_Client();
$client->setApplicationName('Mi Calendario Demo');
$client->setAuthConfigFile('google_config.json');
$client->setRedirectUri('response.php');
$client->setScopes(array('https://www.googleapis.com/auth/calendar'));
// $client->setScopes(array('https://www.googleapis.com/auth/calendar', 'https://www.googleapis.com/auth/calendar.readonly'));
$client->setAccessType('offline');
$client->createAuthUrl();
// ************ FIN DEL ARCHIVO REQUEST ************
?>