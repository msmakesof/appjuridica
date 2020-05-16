<?php 
$api = new RestClient;
$result = $api->get($TEST_SERVER_URL, [
‘foo’ => ‘ bar’, ‘baz’ => 1, ‘bat[]’ => [‘foo’, ‘bar’]
]);
$response_json = $result->decode_response();
$this->assertEquals(‘GET’,
$response_json->SERVER->REQUEST_METHOD);
$this->assertEquals(“foo=+bar&baz=1&bat%5B%5D=foo&bat%5B%5D=bar”,
$response_json->SERVER->QUERY_STRING);
$this->assertEquals(“”,
$response_json->body);
?>