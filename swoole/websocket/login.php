<?php
require 'autoload.php';

$client = new WebSocketClient('127.0.0.1', 9501);
$client->connect();

$data = [
    'uid' => $_POST['uid'],
    'type' => 'login',
];

$client->send(json_encode($data));
$client->disconnect();

return true;