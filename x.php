<?php

// $m= '{"estado":"1","gen_configuracion":{"CON_IdConfiguracion":"1","CON_TituloApp":"Dependiente Judicial.","CON_Logo":"images\\/logojur.jpg","CON_Estado":"1"}}';

// $mr = str_replace("images\\/","images/", $m);

// $m = json_decode($mr,true);
// print_r ($m);

date_default_timezone_set('America/Bogota');
echo "fecha: ".date('Y-m-d g:ia');

echo "*********************";
$x = rand(10000000,100000123456789);
echo "x....$x<br>";
echo "<br><br>";
echo "********   sha256  ***********<br>";
echo "hash...";
$str = '123456';
$hash = hash('sha256', $str);
echo $hash;
echo "<br><br>";


echo "********* sha256 con costo *********<br>";
$plaintext = '123456';  //'My secret message 1234';
$password = 'V14l1br390$MKS-395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60c5b8';   //'3sc3RLrpd17';
$method = 'aes-256-cbc';

$key = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
echo "Key:  " . $key . "\n<br>";

// IV must be exact 16 chars (128 bit)
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
$encrypted = base64_encode(openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv));

// My secret message 1234
$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $key, OPENSSL_RAW_DATA, $iv);

echo 'plaintext =     ' . $plaintext . "\n<br>";
echo 'cipher =        ' . $method . "\n<br>";
echo 'encrypted to:  ' . $encrypted . "\n<br>";
echo 'decrypted to:  ' . $decrypted . "\n\n<br>";
?>
