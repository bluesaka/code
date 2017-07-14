<?php

$serv = stream_socket_server("tcp://0.0.0.0:8000", $errno, $errstr) or die("create socket server fail");
while (1) {
    $conn = stream_socket_accept($serv);
    if (pcntl_fork() == 0) {
        echo "accept data: ". fread($conn, 8192) ."\n";
        fwrite($conn, "Server response hello\n");
        fclose($conn);
        exit(0);
    }
}