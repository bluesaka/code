<?php
/**
 * 使用redis存储session
 */
require 'RedisSessionHandler.php';

$redis = new Redis();
$redis->connect('localhost', 6379, 10);

$prefix = 'redis_session:';
$handler = new RedisSessionHandler($redis, $prefix);

session_set_save_handler(
    [&$handler, "open"],
    [&$handler, "close"],
    [&$handler, "read"],
    [&$handler, "write"],
    [&$handler, "destroy"],
    [&$handler, "gc"]
);

session_start();

$_SESSION['name'] = 'adam';
$_SESSION['age'] = 25;

var_dump($_SESSION);
var_dump($redis->get($prefix . session_id())); // 第一次没有值，刷新后有了，延时？