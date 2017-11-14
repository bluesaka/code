<?php

require 'autoload.php';

$client = new WebSocketClient('127.0.0.1', 9501);
$client->connect();

$post = $_POST;
$data = [
    'from_uid' => $post['from_uid'],
    'to_uid' => $post['to_uid'],
    'content' => $post['content'],
    'type' => 'msg',
];

$client->send(json_encode($data, JSON_UNESCAPED_UNICODE));
$client->disconnect();