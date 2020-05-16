<?php

$data ='{
    "estado": "1",
    "gen_noticiasjudiciales": {
        "NOJ_IdNoticia": "5",
        "NOJ_Titular": "Asuntos Legales",
        "NOJ_Texto": "Edictos",
        "NOJ_Link": "https://www.asuntoslegales.com.co/edictos",
        "NOJ_Estado": "1"
    }
}';

$post_string= 'json_param=' . json_encode($data);
//echo $post_string;

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $post_string);
curl_setopt($curl, CURLOPT_URL, 'http://localhost/appjuridica/');  // Set the url path we want to call

//execute post
$result = curl_exec($curl);

//see the results
$json=json_decode($result,true);
curl_close($curl);
print_r($json);

?>