<?php

ini_set('session.gc_maxlifetime', 3600); // 有效期1小时
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379?auth=password');

session_start();

// 操作session前，必须先连接redis
$redis = new Redis();
$redis->connect('localhost', 6379, 10);

$_SESSION['name'] = 'adam';
$_SESSION['age'] = 25;
var_dump($_SESSION);

// 使用redis获取session内容，默认前缀为PHPREDIS_SESSION:
$session = $redis->get('PHPREDIS_SESSION:' .session_id()); // name|s:4:"adam";age|i:25;

/**
 * redis-cli>monitor
 * 1500271635.418818 "AUTH" "password"
 * 1500271635.420818 "GET" "PHPREDIS_SESSION:t246v66uououdljchrmnioi7e0"   // 每次读取都会重新设置有效期，每次写入都会先读取
 * 1500271635.420818 "SETEX" "PHPREDIS_SESSION:t246v66uououdljchrmnioi7e0" "3600" "name|s:4:\"adam\";age|i:25;"
*/