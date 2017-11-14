<?php

require 'RedisServer.php';

$redisServer = RedisServer::getRedisInstance();

$serv = new Swoole\Websocket\Server("0.0.0.0", 9501);

$serv->on('open', function($server, $req) {
    echo "open --------> fd:".$req->fd . PHP_EOL;
});

$serv->on('message', function(\Swoole\WebSocket\Server $server, $frame) use($redisServer) {
    echo "message --------> ". json_encode($frame, JSON_UNESCAPED_UNICODE) . PHP_EOL;
    $server->push($frame->fd, json_encode(["hello", "world"]));

    $fd = $frame->fd;
    $data = json_decode($frame->data, true);

    switch ($data['type']) {
        case 'login': // 登录
            $redisServer::login($data['uid'], $fd);
            break;
        case 'msg': // 发送消息
            $fds = $redisServer::getFdsByUid($data['to_uid']);
            foreach ($fds as $fd) {
                $d = [
                    'type' => 'msg',
                    'from_uid' => $data['from_uid'],
                    'content' => $data['content'],
                ];
                $server->push($fd, json_encode($d, JSON_UNESCAPED_UNICODE));
            }
            break;
    }
});

$serv->on('close', function($server, $fd) use($redisServer) {
    echo "close --------> fd:" . $fd . PHP_EOL;
    $redisServer::close($fd);
});

$serv->start();



/** ------------------------------------------------------------------
 *  ---------------------- TCP Server --------------------------------
 * -------------------------------------------------------------------
 */

// swoole监听一个tcp端口来处理第三方客户端的请求
$tcp_server = $serv->addlistener('0.0.0.0', 9502, SWOOLE_SOCK_TCP);

$tcp_server->on('connect', function($serv, $fd) use($redisServer){
    echo "tcp connect  --------> fd:" . $fd . PHP_EOL;
});

$tcp_server->on('receive', function ($serv, $fd, $from_id, $data) {
    echo "tcp receive --------> fd:" . $fd . json_encode($data) . PHP_EOL;
});

$tcp_server->on('close', function ($serv, $fd) {
    echo "tcp close --------> fd:" . $fd . PHP_EOL;
});