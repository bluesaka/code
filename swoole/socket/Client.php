<?php

$client = stream_socket_client("tcp://127.0.0.1:8000", $errno, $errstr) or die("create socket client fail");
fwrite($client, "a message from client");
echo "receive data: ".fread($client, 8192) ."\n";
fclose($client);