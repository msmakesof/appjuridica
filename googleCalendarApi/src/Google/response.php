<?php
// response.php (esta es la respuesta desde google hacia mi sitio)
$client = new Google_Client();
$client->setApplicationName('Mi Calendario Demo');
$client->setAuthConfigFile(getcwd().'/protected/vendors/google/client_secret_536651336306-lrqhfg1pmmgr80sbc2es4q0rfesujmd2.apps.googleusercontent.com.json');

$code = $_GET['code'];
$error = $_GET['error'];

$client->authenticate($code);
$access_token = $client->getAccessToken();
$client->setAccessToken($access_token);

// Si todo sale bien, access_token será algo como esto
// {
// “access_token”:”sKobWy_tdz5bGpA”,
// “token_type”:”Bearer”,
// “expires_in”:3600,
// “refresh_token”:”TktKCNa6SUnDPZOwvBa”,
// “created”:1434075564
// }
echo $access_token;
// ************ FIN DEL ARCHIVO RESPONSE ************
?>