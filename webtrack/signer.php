<?php
$SesStorage ="";
?>
<script type="text/javascript">
    var idStorage = sessionStorage.getItem('_us_utmworker');
</script>
<?php
$SesStorage ="<script> document.write(idStorage) </script>";

function encryptor2($action, $string) {
    echo "action .....$action<br>string.... $string<br>";
    $output = false;

    // hash
    $key = hash($GLOBALS['tipo_hash'], $GLOBALS['secret_key']);
    echo "key....$key<br>";
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash($GLOBALS['tipo_hash'], $GLOBALS['secret_iv']), 0, 16);		
    echo "iv...$iv<br>";
    echo "metodo global....".$GLOBALS['encrypt_method']."<br>";

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $GLOBALS['encrypt_method'], $key, 0, $iv);
        $output = base64_encode($output);
    }
    if( $action == 'decrypt' ){
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = explode('::', base64_decode($string), 2);         
        $output = openssl_decrypt($encrypted_data, $GLOBALS['encrypt_method'], $encryption_key, 0, $iv);
        
    	//decrypt the given text/string/number
        //$output = openssl_decrypt(base64_decode($string), $GLOBALS['encrypt_method'], $key, 0, $iv);        
        //echo "mx....$output<br>";
    }
    echo "salida.....$output<br>";

//$key is our base64 encoded 256bit key that we created earlier. You will probably store and define this key in a config file.
$key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

function my_encrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . $iv);
}

function my_decrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    $iv = substr(hash($GLOBALS['tipo_hash'], $GLOBALS['secret_iv']), 0, 16);
    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

//our data to be encoded
$password_plain = '30791989463187.746';
echo "password_plain.....$password_plain<br>";

//our data being encrypted. This encrypted data will probably be going into a database
//since it's base64 encoded, it can go straight into a varchar or text database field without corruption worry
$password_encrypted = my_encrypt($password_plain, $key);
echo "password_encrypted.....$password_encrypted<br>";

//now we turn our encrypted data back to plain text
$password_decrypted = my_decrypt($password_encrypted, $key);
echo "password_decrypted........$password_decrypted <br>";


    return trim($output);
}

echo "<br><br><br><br>sstorage.....$SesStorage<br>";

//require_once('../Connections/config2.php');
$IdUsuario = encryptor2('decrypt', "'".$SesStorage."'");
echo "<br><br>idusu.....$IdUsuario<br>";

include('../rutador/lnkIdUsuario.php');
?>
